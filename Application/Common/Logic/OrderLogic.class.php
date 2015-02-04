<?php

/**
 * 逻辑处理类：订购相关
 * 描述：
 *    包月订购这块接口没有使用hprose，原因是订购这块的逻辑会涉及页面跳转
 *    而hprose不支持页面跳转(http 302状态)，故采用原始的curl调用接口
 */
namespace Common\Logic;
class OrderLogic extends BaseLogic{
	
	private $auth_url = '';
	private $order_url = '';
	private $cancel_order_url = '';
	
	public function __construct() {
		$this->auth_url =  C('PLATFORM_URL').'/Api/OrderApi/auth';
		$this->order_url =  C('PLATFORM_URL').'/Api/OrderApi/order';
		$this->cancel_order_url =  C('PLATFORM_URL').'/Api/OrderApi/cancelOrder';
	}
	
	/**
	 * 产品鉴权
	 */
	public function auth($userId){
		if(empty($userId)){
			$user = unserialize(Session('user'));
			$userId = $user['id'];
		}
		$url = $this->auth_url.'?userId='.$userId;
		$r = url_data($url);
		
		//更新鉴权状态(用户鉴权信息)
		if($r['status']){//
			
		}
	}
	
	/**
	 * 包月订购
	 * @param unknown_type $userId
	 * @param unknown_type $backUrl
	 */
	public function order($userId,$backUrl){
		if(empty($userId)){
			$user = unserialize(Session('user'));
			$userId = $user['id'];
		}
		$url = $this->order_url.'?userId='.$userId.'&backUrl='.urldecode($backUrl);
		$r = url_data($url);
		return $r;
	}
	
}