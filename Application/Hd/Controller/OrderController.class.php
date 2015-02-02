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
	 * 订购处理，流程：
	 * 1.处理产品支持订购的模式（包月，按龄段，按课程）
	 */
	public function indexAct(){
		
		$courseId = I('courseId','');
		$course = D('Course','Logic')->queryCourseById($courseId);
		$chargeModes = S('ChargeMode');
		$chargeModes = array_slice($chargeModes, 0, count($chargeModes));
		
		//订购处理
		//1.产品包月的订购模式(如果为包月，其他订购模式暂不支持)
		if(is_monthly_order()){
			$chargeMode = get_array_by_key($chargeModes, 'type', '1');
			dump($chargeMode);
		}else{
			
		}
		
		//处理焦点
		$url = HTTP_REFERER;
		if(strpos($url, '?'))
			$url .= '&focus=btn_order';
		else 
			$url .= '?focus=btn_order';
		
		$this->assign(array(
			'course'     =>	$course,
			'chargeMode' => $chargeMode,	
			'backUrl'    => $url,	
		));
		$this->display();
	}
	
	/**
	 * 订购支付
	 */
	public function payAct(){
		$courseId 	 = I('courseId','');
		$courseStage = I('courseStage','');
		$chargeId 	 = I('chargeId','');
		$backUrl     = I('backUrl','');
		
		$chargeMode = S('ChargeMode');
		$chargeMode = $chargeMode[$chargeId];
		//dump($chargeMode);exit;
		
		//$r = D('Order','Logic')->orderCourse($this->user['id'],$this->role['id'],$courseId);
		if(true){
			$this->addFloatMessage("订购成功！",$backUrl);
		}else{
			$this->addFloatMessage("订购失败，原因：".$r['info'],$backUrl);
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