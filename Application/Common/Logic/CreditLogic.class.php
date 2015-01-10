<?php
/**
 * 逻辑处理类：积分记录相关
 */
namespace Common\Logic;
class CreditLogic{

	
	/**
	 * 每天登陆奖励
	 * @param string $roleId
	 */
	public function loginAward($ruleKey, $roleId)
	{
		$login = D('Login','Logic') -> selectOneByRoleId($roleId);
		
		//读取积分规则表中登陆奖励
		$creditRule = D('CreditRule','Logic') -> selectOneByRuleKey($ruleKey);
		if(!$creditRule)
		{
			return result_data(0, $creditRule['info']);
		}
		//本次登陆奖励
		$award = 0;
		//连续登陆天数
		$continueLoginCnt = 0;
		
		if(empty($login))//该角色第一次登陆
		{
			$data_temp = array('roleId'=>$roleId,'continueLoginCnt' => 1);
			$data['login'] = $data_temp;
			$award = $creditRule['award'];
		}
		else //该角色之前有登陆过，数据库Login中有对应记录
		{
			$timestampLastLogin = strtotime($login['lastLoginTime']);
			$timestampNow = strtotime(date("Y-m-d"));
			$difference = $timestampNow - $timestampLastLogin;
			if($difference < 0)
			{
				$info = '当前时间应该晚于上次登陆时间！';
				return result_data(0, $info);
			}
			else if($difference == 24*3600)//本次登陆时间和上次登陆相差一天，连续登陆中。。。
			{
				if($login['continueLoginCnt']<10&&$login['continueLoginCnt']>0)//连续登陆小于10天
				{
					$award = $creditRule['award'];
				}else if($login['continueLoginCnt']>=10)
				{
					$award = $login['continueLoginCnt']+1;
				}
				$continueLoginCnt = $login['continueLoginCnt']+1;
			}
			else if($difference > 24*3600) //本次登陆时间和上次登陆相差大于一天，非连续登陆
			{
				$award = $creditRule['award'];
				//修改login,重置连续登陆天数为1
				$continueLoginCnt = 1;
			}
			else if($difference == 0)//今天已经登陆过，此次登陆不做处理
			{
				$info = '今天登陆奖励已经使用！';
				return result_data(0, $info);
			}
		}
		if($award > 0)
		{
			$data['award'] = $award;
			$data['log'] = $this->addCreditLog($roleId, $creditRule, $award);
		}
		if(!empty($continueLoginCnt))
		{
			$data_temp = array('id'=>$login['id'], 'continueLoginCnt' => $continueLoginCnt);
			$data['login'] = $data_temp;
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
	
	private function OtherAward($ruleKey,$roleId, $num=1)
	{
		//读取积分规则表中登陆奖励
		$creditRule = D('CreditRule','Logic') -> selectOneByRuleKey($ruleKey);
		if(!$creditRule)
		{
			return result_data(0, $creditRule['info']);
		}
		$award = $creditRule['award']*$num;
		$data['award'] = $award;
		$data['log'] = $this->addCreditLog($roleId, $creditRule, $award);
		return result_data(1,$creditRule['title'].'成功',$data);
	}
	
	/*
	 * 积分奖励
	 * @param $ruleKey 通过什么获得积分
	 *  @param $ruleKey 通过什么获得积分
	 * */
	public function award($ruleKey, $num=1)
	{
		$role = unserialize(Session('role'));
		$roleId = $role['id'];
		p($roleId);
		//根据$ruleKey调用不同的处理函数
		switch($ruleKey)
		{
			case "login":
				$award = $this -> loginAward($ruleKey,$roleId);
				break;
			case "practise":
				$award = $this -> OtherAward($ruleKey, $roleId, $num);
				break;
			case "order":
				$award = $this -> OtherAward($ruleKey, $roleId, $num);
				break;
			case "watchVideo":
				$award = $this -> OtherAward($ruleKey, $roleId, $num);
				break;
			case "perfectInfo":
				$award = $this -> OtherAward($ruleKey, $roleId, $num);
				break;
			case "christmas":
				$award = $this -> OtherAward($ruleKey, $roleId, $num);
				break;
			default:
				return result_data(0, 'ruleKey没有匹配项');
				break;
		}
		
		if($award['status'])
		{
			//存入奖励日志数据表
			$log = $award['data']['log'];
			if(!empty($log))
			{
				$result = D('CreditLog','Logic') -> save($log);
				if(!$result['status'])
				{
					return result_data(0, $result['info']);
				}
			}
			//存入登陆数据表
			$login = $award['data']['login'];
			if(!empty($login))
			{
				$result = D('Login','Logic') -> save($login);
				if(!$result['status'])
				{
					return result_data(0, $result['info']);
				}
			}
				
 			//更新角色积分
			$awardAdd = $award['data']['award'];
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