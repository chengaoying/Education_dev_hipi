<?php

/**
 * 逻辑处理类：用户信息
 */
namespace Common\Logic;
class UserLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/UserApi');
	}
	
	/**
	 * 顶盒帐号(OpUserId)
	 * @param string $OpUserId
	 */
	public function loadByOpUserId($OpUserId){
		return $this->client->loadByOpUserId($OpUserId);
	}
	
	/**
	 * 通过id查询单个用户
	 * @param string $id
	 */
	public function load($id){
		return $this->client->load($id);
	}
	
	/**
	 * 保存用户信息 
	 * @param arr $user
	 */
	public function save($user){
		return $this->client->saveOrUpdate($user);
	}
	
	/**
	 * 用户登入检验，包括的情况：
	 * 1.EPG登入产品，判断是否有params参数
	 * 2.产品之间跳转，携带userId和sign(md5加密)参数
	 * 3.产品内部的页面跳转，判断是否有用户和角色的session
	 */
	public function LoginChecking(){
		$params = I('params');
		if(!empty($params)){ //EPG登入产品
			$result = $this->LoginOrReg($params);
			
		}else{
			$userId = I('userId','');
			$sign	= I('sign','');
			if(!empty($userId)){ //其他产品登入该产品
				//TODO
				
			}else{//产品内部页面跳转
				$user = unserialize(Session('user'));
				if(!$user) {
					$result = result_data(0,'用户信息已过期，请重新登入产品！');
				}else{
					$result = result_data(1,'');
				}
			}
		}
		return $result;
	}
	
	/**
	 * 登入或注册用户信息
	 */
	private function LoginOrReg($params){
		
		//解析访问参数
		$params = html_entity_decode(urldecode($params));
		$params = json_decode($params, true);
		$data['OpUserId']	  = $params['userid'];
		$data['OpUserToken']  = $params['usertoken'];
		$data['OpUserName']	  = $params['username'];
		$data['stbType']	  = $params['stbtype'];
	
		//检验参数userId是否为空
		if(empty($params['userid'])) return result_data(0,'缺少用户参数userid!');
		
		//退出产品之后的返回地址
		Session('back_epg_url',$params['return_url']);
		
		//查询该用户是否已注册,未注册则先注册
		$_user = $this->loadByOpUserId($params['userid']);
		if(empty($_user)){
			$r = $this->save($data);
		}else{
			$_user['OpUserId']    = $params['userid'];
			$_user['OpUserToken'] = $params['usertoken'];
			$_user['OpUserName']  = $params['username'];
			$r = $this->save($_user);
		}
		if(!$r['status']){
			return result_data(0,$r['info']);
		}
		Session('user',serialize($_user));
		
		//加载用户的角色信息，并指定用户最近使用的角色
		D('Role','Logic')->initUserRoleInfo();
		
		return result_data(1,'',$_user);
	}
	
	/**
	 * 重新载入用户信息
	 */
	public function reloadUser(){
		$_user = $this->load(USER_ID);
		Session('user',serialize($_user));
		return $_user;
	}
	
	
}