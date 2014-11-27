<?php

/**
 * 数据同步：平台同步数据到产品中
 * @author CGY
 *
 */

namespace Api\Controller; 

class SyncController extends \Think\Controller{
	
	public function indexAct(){
		$result = D('Sync','Logic')->syncData();
		$this->ajaxReturn($result);
	}
}