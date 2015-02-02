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
	public function index1Act(){

		$data = I('get.');
		$this->datas = $data;
		$this->display();
	}
	
	public function testAct()
	{
		$this->display();
	}
}