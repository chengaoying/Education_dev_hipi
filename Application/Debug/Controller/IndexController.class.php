<?php

/**
 * 调试
 * @author WZH
 *
 */

namespace Debug\Controller;

class IndexController extends \Think\Controller {
	
	public function indexAct(){

		$data = I('get.');
		$this->datas = $data;
		$this->display();
	}
	
}