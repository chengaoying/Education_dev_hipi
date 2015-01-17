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
		//订购处理
		//1.产品包月的订购模式(如果为包月，其他订购模式暂不支持)
		if(is_monthly_order()){
			//TODO	
			
		}else{
			$chargeMode = S('ChargeMode');
			$chargeMode = array_slice($chargeMode, 0, count($chargeMode));
		}
		
		$this->assign(array(
			'course'     =>	$course,
			'chargeMode' => $chargeMode,	
			'backUrl'    => HTTP_REFERER,	
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
}