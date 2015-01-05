<?php

/**
 * 控制器：学习评价
 * @author WZH
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class LearningController extends CommonController {
	
	/**
	 * 显示早教学习评价
	 */
	public function learningEvaluation1Act()
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
		
		$curProgress = array(60,70,50,40,30,20,10,0,100);
		foreach($curProgress as $key => $value)
		{
			$curProgress[$key] = (100-$value)*302/100;
		}
		$this->assign(array(
					'curProgress' => $curProgress,
					'stageType' => $stageType,
					'curProgress' => $curProgress,
					'face' => $role['face'],
					'name' => empty($role['nickName']) ? $role['id'] : $role['nickName'],
				));
		$this->display();
	}
	/**
	 * 显示段龄学习评价
	 */
	public function learningEvaluation2Act()
	{
		$page = I('page',1);
		$pageSize = 5;
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
		$data_get = I('get.');
		$imgPath = '/static/v1/hd/images/common/page';
		$progress = array('50','58','70');
		$progeress = 8;
		$this->assign(array(
					'stageType' => $stageType,
					'pageHtml' => get_array_page(3, 3, $imgPath),
					'preId' => $data_get['preId'],
					'datas' => $progress,
				));
		$this->display();
	}
	
	public function detailAct()
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
		$data_get = I('get.');
		$imgPath = '/static/v1/hd/images/common/page';
		$data = array('50','58','70','80','88','90','100','0','50','58');
		$this->assign(array(
				'stageType' => $stageType,
				'page' => get_array_page(count($data), 12, $imgPath),
				'preId' => $data_get['preId'],
				'datas' => $data,
		));
		$this->display();
	}
	
	
}