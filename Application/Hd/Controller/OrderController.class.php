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
		$this->display();
	}
	
	/**
	 * 支付
	 */
	public function payAct(){
		
	}
}