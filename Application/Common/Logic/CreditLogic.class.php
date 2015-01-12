<?php
/**
 * 逻辑处理类：积分控制
 */
namespace Common\Logic;
class CreditLogic extends BaseLogic{

	
	public function __construct() {
		parent::__construct('/Api/CreditApi');
	}

	/**
	 * 通过roleId,key查询用户Login表
	 * @param string $roleId
	 */
	public function selectOneByRoleId($roleId, $key){
		return $this->client->selectOneByRoleId($roleId, $key);
	}
	
	/**
	 * 插入或更新
	 * @param string $data
	 */
	public function save($data){
		return $this->client->saveOrUpdate($data);
	}
	
	/**
	 * 每天登陆奖励
	 * @param string $roleId
	 */
	public function loginAward($key, $roleId, $award=0)
	{
		
		$credit = D('Credit','Logic') -> selectOneByRoleId($roleId,$key);
		if(empty($credit))//该角色第一次登陆
		{
			$data['credit'] = array('roleId'=>$roleId,'key'=>$key,'continueCnt'=>1);;
			$data['award'] = $award;
		}
		else //该角色之前有登陆过，数据库credit表中有对应记录
		{
			$continueCnt = $credit['continueCnt'];
			
			$timeStampLastLogin = strtotime(date("Y-m-d", strtotime($credit['lastTime'])));
			$timeStampNow = strtotime(date("Y-m-d"));
			$difference = $timeStampNow - $timeStampLastLogin;//计算两次登陆差值
			
			if($difference < 0)
			{
				return result_data(0, '当前登陆时间怎么能早于上次登陆时间！');
			}
			else if($difference == 24*3600)//本次登陆时间和上次登陆相差一天，连续登陆中。。。
			{
				if($continueCnt<10&&$continueCnt>0)//连续登陆小于10天
				{
					$data['award'] = $award;
				}else if($continueCnt>=10)
				{
					$data['award'] = $continueCnt+1;
				}
				$data['credit'] = array('id'=>$credit['id'],'continueCnt'=>$continueCnt+1);
			}
			else if($difference > 24*3600) //本次登陆时间和上次登陆相差大于一天，非连续登陆
			{
				$data['award'] = $award;
				//重置连续登陆天数为1
				$data['credit'] = array('id'=>$credit['id'],'continueCnt'=>1);
			}
			else if($difference == 0)//今天已经登陆过，此次登陆不做处理
			{
				return result_data(0, '今天登陆奖励已经使用！');
			}
		}
		
		return result_data(1,'每天登陆奖励成功',$data);
	}
	
	/*
	 * creditlog记录表
	*/
	private function addCreditLog($roleId, $creditRule, $award)
	{	
		$data = array(
				'roleId'=>$roleId,
				'ruleId' => $creditRule['id'],
				'ruleTitle'=>$creditRule['title'],
				'award' => $award,
		);
		return $data;
	}
	
	/*
	 * 需要$num参数的奖励
	 */
	private function numAward($key,$roleId, $award=0,$num=1)
	{
		$num = empty($num) ? 1 : $num;
		dump($award);
		$award = $award*$num;
		$data['award'] = $award;
		
		$credit = D('Credit','Logic') -> selectOneByRoleId($roleId,$key);
		if(empty($credit))
		{
			$data['credit'] = array('roleId'=>$roleId,'key'=>$key,'continueCnt'=>1);
		}
		else 
		{
			$continueCnt = $credit['continueCnt'];
			$data['credit'] = array('id'=>$credit['id'],'continueCnt'=>$continueCnt+1);
		}
		return result_data(1,'成功',$data);
	}
	
	/*
	 * 只能领取一次
	 */
	public function onceAward($key,$roleId, $award=0)
	{
		$credit = D('Credit','Logic') -> selectOneByRoleId($roleId,$key);
		if(empty($credit))
		{
			$data['credit'] = array('roleId'=>$roleId,'key'=>$key,'continueCnt'=>1);
			$data['award'] = $award;
		}
		else
		{
			return result_data(0, "{$key}为单次有效,只能领取一次");
		}
		return result_data(1,'单次奖励领取成功',$data);
	}
	/*
	 * 一天只能领取10次
	 */
	public function someAward($key,$roleId, $award=0)
	{
		$credit = D('Credit','Logic') -> selectOneByRoleId($roleId,$key);
		if(empty($credit))
		{
			$data['credit'] = array('roleId'=>$roleId,'key'=>$key,'continueCnt'=>1);
			$data['award'] = $award;
		}
		else
		{
			$continueCnt = $credit['continueCnt'];
			
			$timeStampLastLogin = strtotime(date("Y-m-d", strtotime($credit['lastTime'])));
			$timeStampNow = strtotime(date("Y-m-d"));
			$difference = $timeStampNow - $timeStampLastLogin;//计算两次登陆差值
			
			if($difference < 0)
			{
				return result_data(0, '当前登陆时间怎么能早于上次登陆时间！');
			}
			else if($difference == 0)//本次登陆时间和上次登陆相差一天，连续登陆中。。。
			{
				if($continueCnt<10)
				{
					$data['award'] = $award;
					$data['credit'] = array('id'=>$credit['id'],'continueCnt'=>$continueCnt+1);
				}
				else 
				{
					return result_data(0, '今天领取次数超过10次，不能领取！');
				}

			}
			else
			{
				$data['award'] = $award;
				//重置连续登陆天数为1
				$data['credit'] = array('id'=>$credit['id'],'continueCnt'=>1);
			}
		}
		return result_data(1,'成功',$data);
	}
	
	/*
	 * 积分奖励
	 * @param $key 奖励关键字
	 * @param $num 获得几次该奖励，用于练习奖励等。例如练习了5分钟。一分钟获得一次该奖励。此时$num=5
	 * */
	public function award($key, $num=1)
	{
		$role = unserialize(Session('role'));
		$roleId = $role['id'];
		//读取奖励规则
		$creditRule = D('CreditRule','Logic') -> selectOneBykey($key);
		if(empty($creditRule)) return result_data(0, '根据'.$key.'读取规则表失败');
		$award = $creditRule['award'];
		
		//根据$key调用不同的处理函数
		switch($key)
		{
			case "login":
				$award = $this -> loginAward($key,$roleId,$award);
				break;
			case "practise":
				$award = $this -> numAward($key, $roleId, $award, $num);
				break;
			case "order":
				$award = $this -> numAward($key, $roleId, $award, $num);
				break;
			case "watchVideo":
				$award = $this -> someAward($key, $roleId, $award);
				break;
			case "perfectInfo":
				$award = $this -> onceAward($key, $roleId, $award);
				break;
			case "christmas":
				$award = $this -> onceAward($key, $roleId, $award);
				break;
			default:
				return result_data(0, 'key没有匹配项');
				break;
		}
		
		if($award['status'])
		{
			//存入数据表
			$result = D('Credit','Logic') -> save($award['data']['credit']);
			if(!$result['status']) return result_data(0, $result['info']);
				
 			//更新角色积分
			$awardAdd = $award['data']['award'];dump($awardAdd);
			$point = empty($role['point']) ? 0 : $role['point'];
			$point += $awardAdd;
			$role['point'] = $point;
			$r = D('Role','Logic')->save($role);
			if($r['status']){
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
			}
			else 
			{
				$info = '角色积分更新失败';
				return result_data(0, $info);
			} 
		}
		else
		{
			$info = $award['info'];
			return result_data(0, $info);
		}
		
		return result_data(1, $award['info']);
	}

	public function test()
	{
		echo 'test';
		exit;
	}
}