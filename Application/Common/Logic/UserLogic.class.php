<?php

/**
 * 逻辑处理类：用户信息
 */
namespace Common\Logic;
class UserLogic extends BaseLogic{
	
	protected $client = '';	//客户端接口调用对象
	
	/* 初始化接口地址 */
	public function __construct() {
		$url = C('PLATFORM_URL').'/Api/UserApi';
		$this->client = $this->initHproseObject($url);
	}
	
	/**
	 * 通过userId查询单个用户
	 * @param string $userId
	 */
	public function load($userId){
		return $this->client->load($userId);
	}
	
	/**
	 * 保存用户信息 
	 * @param arr $user
	 */
	public function save($user){
		return $this->client->saveOrUpdate($user);
	}
	
	/**
	 * 登入或注册用户信息
	 */
	public function LoginOrReg(){
		
		//解析访问参数
		$params = I('params');
		$params = html_entity_decode(urldecode($params));
		$params = json_decode($params, true);
		$data['userId']		= $params['userid'];
		$data['userToken']	= $params['usertoken'];
		$data['userName']	= $params['username'];
		$data['stbType']	= $params['stbtype'];
		
		//检验参数userId是否为空
		if(empty($params['userid'])) return result_data(0,'缺少用户参数userid!');
		
		//退出产品之后的返回地址
		Session('back_epg_url',$params['return_url']);
		
		//查询该用户是否已注册,未注册则先注册
		$_user = $this->load($params['userid']);
		if(empty($_user)){
			$r = $this->save($data);
		}else{
			$_user['userToken'] = $params['usertoken'];
			$_user['userName']  = $params['usertoken'];
			$r = $this->save($_user);
		}
		if(!$r['status']){
			return result_data(0,$r['info']);
		}
		Session('user',serialize($_user));
		return result_data(1,'',$_user);
	}
	
	/**
	 * 重新载入用户信息
	 */
	public function reloadUser(){
		$user = unserialize(Session('user'));
		$_user = $this->load($user['userId']);
		Session('user',serialize($_user));
		return $_user;
	}
	
	
}