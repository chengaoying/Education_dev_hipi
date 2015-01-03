<?php

/**
 * 控制器：荣誉成就
 * @author WZH
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class GloryController extends CommonController {
	
	/**
	 * 显示荣誉成就
	 */
	public function indexAct()
	{
		$role = unserialize(Session('role'));
		//顶级分类(二级栏目)
		$class = $this->getClass();
		//龄段
		$stage = S('Stage');
		$chId = $stage[$role['stageId']]['chId'];
		//得到段龄类型，既早教，幼教，小学等的种类
		$stageType = $class[$chId]['chKey'];
		if($stageType == 'early' || $stageType == 'preschool')
		{
			$stageType = 'learningEvaluation1';
		}
		else 
		{
			$stageType = 'learningEvaluation2';
		}
		
		$curProgress = 60;
		$this->assign(array(
					'curProgress' => $curProgress*361/100,
					'stageType' => $stageType,
					
				));
		$this->display();
	}
	/**
	 * 显示全部奖励
	 */
	public function viewAct()
	{
		$imgPath = '/static/v1/hd/images/common/page';
		$data = array('1','1','1','1','1','1','1','1','1','1','1','1','1','1','1');
		$this->assign(array(
					'page' => get_array_page(count($data), 10, $imgPath),
				));
		$this->display();
	}
	
	
}