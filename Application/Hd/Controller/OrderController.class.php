<?php

/**
 * 控制器：订购相关
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class OrderController extends CommonController {
	
	/**
	 * 订购处理(产品包月)
	 */
	public function indexAct(){

		$chargeModes = S('ChargeMode');
		
		//订购处理
		//1.产品包月的订购模式(如果为包月，其他订购模式暂不支持)
		if(is_monthly_order()){
			$chargeMode = get_array_by_key($chargeModes, 'type', '1');
		}else{
			
		}
		
		//处理焦点
		$url = HTTP_REFERER;
		if(strpos($url, '?focus'))
			$url = substr($url, 0, strpos($url, '?focus'));
		if(strpos($url, '&focus'))
			$url = substr($url, 0, strpos($url, '&focus'));
		if(strpos($url, '?')){
			$url .= '&focus=btn_order';
		}else{
			$url .= '?focus=btn_order';
		}
		
		$this->assign(array(
			'chargeMode' => $chargeMode,	
			'backUrl'    => $url,	
		));
		$this->display();
	}
	
	/**
	 * 订购支付
	 */
	public function payAct(){
		$backUrl     = I('backUrl','');
		$r = D('Order','Logic')->order($this->user['id'],$backUrl);
		$r = json_decode($r, true);
		if($r['status']){
			$this->addFloatMessage("订购成功！",$backUrl);
		}else{
			$this->addFloatMessage("订购失败：".$r['info'],$backUrl);
		} 
	}
	
	/**
	 * 订购返回：接口方返回并携带订购信息
	 */
	public function payBackAct(){
		
	}
	
	/**
	 * 退订
	 */
	public function cancelOrderAct(){
		
	}
	
	
}