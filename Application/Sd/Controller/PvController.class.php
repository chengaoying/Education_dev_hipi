<?php

/**
 * 控制器：pv
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class PvController extends CommonController {
	
	/**
	 * 保存pv
	 */
	public function savePvAct(){
		$data = I('get.');
		D('Pv','Logic')->savePv($data);
	}
}