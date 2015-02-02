<?php

/**
 * 逻辑处理类：订购相关
 */
namespace Common\Logic;
class OrderLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/OrderApi');
	}
	
	/**
	 * 产品鉴权
	 */
	public function auth(){
		$user = unserialize(Session('user'));
		$r = $this->client->auth($user['id']);
		
		//更新鉴权状态(用户鉴权信息)
		if($r['status']){//
			
		}
	}
	
	public function order($userId,$backUrl){
		$r = $this->client->order($userId,$backUrl);
	}
	
}