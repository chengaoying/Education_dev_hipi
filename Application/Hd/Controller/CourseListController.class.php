<?php

/**
 * 控制器：课程列表
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class CourseListController extends CommonController {
	
	/**
	 * 课程列表统一入口：
	 */
	public function indexAct(){
		//一级分类（二级栏目）的ID
		$chId = I('chId','');
		$chKey = get_array_keyval(S('Channel'),$chId,'id','chKey');
		
		//获取该一级分类下的龄段(有可能为空)
		$stageList = get_array_for_fieldval(S('Stage'),'chId',$chId);
		$this->initStageList($stageList);
		
		//龄段id(id不为空：从单个龄段入口进入)
		$stageId = I('stageId','');
		if(!empty($stageId)) $stageList = get_array_for_fieldval($stageList,'id',$stageId);
		
		//龄段列表-json格式
		$json_stage = get_array_fieldkey($stageList,array('id','name','linkImage','focusImage'));
		$json_stage = json_encode($json_stage);
		
		$this->assign(array(
			'chKey'	     => $chKey,
			'stageId'    => $stageId,
			'stageList'  => $stageList,
			'json_stage' => $json_stage,
			'courseList' => $this->getCourseList(),	
		));
		$this->display();
	}
	
	/**
	 * 初始化龄段的图片
	 * @param array $stageList
	 */
	private function initStageList(&$stageList){
		$stageList = array_slice($stageList, 0, count($stageList));
		foreach ($stageList as $k => $v){
			if($v['imgUrl']){
				$imgs = explode(PHP_EOL, $v['imgUrl']);
				$stageList[$k]['linkImage']  = get_upfile_url(trim($imgs[0]));
				$stageList[$k]['focusImage'] = get_upfile_url(trim($imgs[1]));
			}
		}	
	}
	
	/* 测试--课程列表 */
	private function getCourseList(){
		$courseList = array();
		for($i=0; $i< 10; $i++){
			$courseList[$i]['id'] = $i;
			$courseList[$i]['chId'] = 20;
			$courseList[$i]['stageIds'] = 7;
			$courseList[$i]['name'] = 'test';
			$courseList[$i]['imgUrl'] = get_upfile_url('__HD__/images/index/myCourse/a.jpg');
		}
		return $courseList;
	}
	
}