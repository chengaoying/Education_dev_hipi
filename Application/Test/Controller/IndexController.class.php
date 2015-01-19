<?php

/**
 * 测试
 * @author CGY
 *
 */

namespace Test\Controller;

class IndexController extends \Think\Controller {
	
	public function indexAct(){
        $this->assign(array(
            'HTTP_HOST' => $_SERVER['HTTP_HOST']
        ));
		$this->display();
	}
	
	
	public function testAct(){
		dump(is_monthly_order());
	}
	
	
	
	public function loginAwardAct()
	{
		
/* 		$login = D('Login','Logic') -> selectOneByRoleId(32);
		dump($login);
		$creditRule = D('CreditRule','Logic') -> selectOneByRuleKey('login');
		dump($creditRule);
		$data = array('roleId'=>1,'ruleId' => 1,'ruleTitle'=>2);
		$creditLog = D('CreditLog','Logic') -> save($data);
		dump($creditLog); 
		$data = array('roleId'=>1,'continueLoginCnt' => 1);
		$login = D('Login','Logic') -> save($data);
		dump($login); 
		
		$login1 = D('Login','Logic') -> selectOneByRoleId(1);
		$login2 = D('Login','Logic') -> selectOneByRoleId(2);
		$date1 = strtotime($login1['lastLoginTime']);
		$date2 = strtotime($login2['lastLoginTime']);
		$date = $date2 - $date1;
		dump($date);
		if($date == 24*3600)
		{
			dump("相差一天:".$date);
		}
		else if($date > 24*3600)
		{
			dump("大于一天:".$date);
		}
		else if($date < 24*3600)
		{
			dump("小于一天:".$date);
		} */
		$roleId = 3;
		$login = D('Login','Logic') -> selectOneByRoleId($roleId);
		//读取积分规则表中登陆奖励
		$creditRule = D('CreditRule','Logic') -> selectOneByRuleKey('login');
		//本次登陆奖励
		$award = 0;
		//连续登陆天数
		$continueLoginCnt = 0;
		
		if(empty($login))//该角色第一次登陆
		{
			//添加到login数据库
			$data = array('roleId'=>$roleId,'continueLoginCnt' => 1);
			$login = D('Login','Logic') -> save($data);
			
			$award = $creditRule['award'];
		}
		else //该角色之前有登陆过，数据库Login中有对应记录
		{
			$timestampLastLogin = strtotime($login['lastLoginTime']);
			$timestampNow = strtotime(date("Y-m-d"));
			$difference = $timestampNow - $timestampLastLogin;
			if($difference < 0)
			{
				echo 'nowtime must be bigger than lasttime';
				exit;
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
				echo 'you have already logined,today';
			}
		}
		if($award > 0)
		{
			//存入积分记录
			$this->addCreditLog($roleId, $creditRule, $award);
		}
		if($continueLoginCnt != 0)
		{
			//修改login
			$data = array('id'=>$login['id'], 'continueLoginCnt' => $continueLoginCnt);
			$login = D('Login','Logic') -> save($data);
		}
		echo '<br/>finish!';
		exit;
	}
	
	/*
	 * 添加到creditlog记录表
	*/
	private function addCreditLog($roleId, $creditRule, $award)
	{	
		$data = array(
				'roleId'=>$roleId,
				'ruleId' => $creditRule['id'],
				'ruleTitle'=>$creditRule['title'],
				'award' => $award,
		);
		$creditLog = D('CreditLog','Logic') -> save($data);
	}
	
	public function perfectInfoAct()
	{
		$roleId = 3;
		//读取积分规则表中登陆奖励
		$creditRule = D('CreditRule','Logic') -> selectOneByRuleKey('perfectInfo');
		$award = $creditRule['award'];
		//存入积分记录
		$this->addCreditLog($roleId, $creditRule, $award);
	}
	
	public function awardAct()
	{
		$result = D('Credit','Logic') -> award('perfectInfo');
		dump($result);
		exit; 
	}
	
	public function everydayLoginAct()
	{
//		$result = D('Credit','Logic') -> everydayLogin($userId = 6,$roleId = 32,$ruleKey = 'everydayLogin',$info = '');
		$result = D('Credit','Logic') -> incOrDec($userId = 6,$roleId = 32,array('point'=>10),$info = '');
		dump($result);
		exit;
	}
	
	
}