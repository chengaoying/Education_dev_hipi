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
		
		$page 	  = I('page',1);
		$pageSize = 10;
		
		//一级分类（二级栏目）的ID
		$chId = I('chId','');
		$chKey = get_array_keyval(S('Channel'),$chId,'id','chKey');
		
		//获取该一级分类下的龄段(有可能为空)
		$stageList = get_array_for_fieldval(S('Stage'),'chId',$chId);
		$this->initStageList($stageList);
		
		//龄段id(id不为空：从单个龄段入口进入)
		$stageId = I('stageId','');
		if(!empty($stageId)) {
			$stageList = get_array_for_fieldval($stageList,'id',$stageId);
			$stageList = array_slice($stageList, 0, count($stageList));
			$courses = D('Course','Logic')->queryCourseListByKeys($stageId, '', $page, $pageSize);
		}else{
			$courses = D('Course','Logic')->queryCourseListByChId($chId, $page, $pageSize);
		}
		foreach ($courses['rows'] as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$courses['rows'][$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
				$courses['rows'][$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}

		$pageHtml = get_array_page($courses['total'], $pageSize, '/static/v1/hd/images/common/page');
		
		//龄段列表-json格式
		$json_stage = get_array_fieldkey($stageList,array('id','name','linkImage','focusImage'));
		$json_stage = json_encode($json_stage);
		
		//判断一级分类的入口是不是早教和幼教
		//早教和幼教课程列表的logo都是图片logo，其他为文字logo
		$roleGrade = $this->getGrade($chId);
		if(in_array($roleGrade['chKey'], array('early','preschool')))
			$isEarly = true;
		
		$this->assign(array(
			'chKey'	     => $chKey,
			'stageId'    => $stageId,
			'stageList'  => $stageList,
			'json_stage' => $json_stage,
			'courses' 	 => $courses['rows'],	
			'pageHtml' 	 => $pageHtml,
			'isEarly'	 => $isEarly,
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
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$stageList[$k]['linkImage']  = get_upfile_url(trim($imgs[0]));
				$stageList[$k]['focusImage'] = get_upfile_url(trim($imgs[1]));
			}
		}	
	}
	
}