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
	 * 首页
	 */
	public function indexAct(){
		$courseId = I('courseId','');
		$course = D('Course','Logic')->queryCourseById($courseId);
		
		$this->assign(array(
			'course'	=>	$course,
		));
		$this->display();
	}
	
	/**
	 * 订购支付
	 */
	public function payAct(){
		$courseId = I('courseId','');
		$r = D('Order','Logic')->orderCourse($this->user['id'],$this->role['id'],$courseId);
		if($r['status']){
			$this->addFloatMessage("订购成功！",get_back_url('Index/recommend',1,0,1));
		}else{
			$this->addFloatMessage("订购失败，原因：".$r['info'],get_back_url('Index/recommend',1,0,1));
		}
	}
}