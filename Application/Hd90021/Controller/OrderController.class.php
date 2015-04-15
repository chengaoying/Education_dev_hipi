<?php

/**
 * 控制器：订购相关
 * @author CGY
 *
 */

namespace Hd90021\Controller;
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
		if(strstr(HTTP_REFERER,'/SectionList/index')){
			session('order_back',HTTP_REFERER);
			$url = get_back_url('SectionList/index',1);
		}else{
			$url = session('order_back');
		}
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
		$backUrl = I('backUrl','');
		$_backUrl = 'http://'.$_SERVER['HTTP_HOST'].U('Order/payBack');
		$_backUrl .= '?backUrl='.urlencode($backUrl);
		
		//订购
		if(!C('DEBUG_MODE')){
			$r = result_data(1,'');
		}else{
			$r = D('Order','Logic')->order($this->user['id'],$_backUrl);
			$r = json_decode($r, true);
		}
			
		if($r['status']){
			header('location:'.$r['data']);
			exit;
			//$this->addFloatMessage("订购成功！",$backUrl);
		}else{
			$this->addFloatMessage("订购失败：".$r['info'],$backUrl);
		} 
	}
	
	/**
	 * 订购返回：接口方返回并携带订购信息
	 */
	public function payBackAct(){
		$backUrl = I('backUrl',U('Index/recommend'));
		$result = I('result','');
		
		if($result['status']){
			$this->addFloatMessage("订购成功！",$backUrl);
		}else{
			$this->addFloatMessage("订购失败：".$result['info'],$backUrl);
		} 
	}
	
	/**
	 * 退订
	 */
	public function cancelOrderAct(){
		
	}
	
	
}