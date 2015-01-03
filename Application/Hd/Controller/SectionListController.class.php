<?php

/**
 * 控制器：课时列表
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class SectionListController extends CommonController {
	
	/**
	 * 课时列表统一入口
	 */
	public function indexAct(){
		$chId 	  = I('chId','');
		$stageId  = I('stageId','');
		$courseId = I('courseId','');

		$chKey = get_array_keyval(S('Channel'),$chId,'id','chKey');
		
		if($chKey == 'early') //早教课时列表
		{
			$this->early($chId,$chKey,$stageId,$courseId);
		}
		elseif($chKey == 'preschool') //幼教课时列表
		{
			$this->preschool($chId,$chKey,$stageId,$courseId);
		}
		else  //其他通用课时列表
		{
			$this->common($chId,$chKey,$stageId,$courseId);
		}
	}
	
	/**
	 * 早教--课时列表 
	 * @param unknown_type $chId  栏目id
	 * @param unknown_type $chKey 栏目key
	 * @param unknown_type $stageId 龄段id
	 */
	private function early($chId,$chKey,$stageId,$courseId){
		$month = 13;//几个月的小孩
        $age = 2;
		if($month>=1 and $month<=12){
			$year = 1;
		}else if($month>12 and $month<=24){
			$year = 2;
		}else if($month>24 and $month<=36){
			$year = 3;
		}
		
		$topicId = I('topic','');
		
		//该课程知识点列表
		$topics = D('Topic','Logic')->queryTopicList($courseId,1,10);
		foreach ($topics['rows'] as $k=>$v){
			if($v['imgUrl']){
				$imgs = explode(PHP_EOL, $v['imgUrl']);
				$topics['rows'][$k]['linkImage']  = get_upfile_url(trim($imgs[0]));
				$topics['rows'][$k]['focusImage']  = get_upfile_url(trim($imgs[1]));
			}
		}
		
		//某个知识点下的课时列表
		if(empty($topicId)) $topicId = $topics['rows'][0]['id'];
		$sections = D('Section','Logic')->querySectionList($topicId,1,6);
		
		$json_topic = get_array_fieldkey($topics['rows'],array('id','name','linkImage','focusImage'));
		$json_topic = json_encode($json_topic);
		$this->assign(array(
			'month'  	 => $month,
			'chId' 	 	 => $chId,  
			'topics' 	 => $topics['rows'],
			'json_topic' => $json_topic,
			'sections'   => $sections['rows'],
		));
		$this->display('detail_early');
	}
	
	/**
	 * 幼教--课时列表
	 * @param unknown_type $chId
	 * @param unknown_type $chKey
	 * @param unknown_type $stageId
	 */
	private function preschool($chId,$chKey,$stageId,$courseId){
		$stage = S('Stage');
		$stage = $stage[$stageId];
		
		$topicId = I('topic','');
		$week = I('week',date("w"));
		
		//该课程知识点列表
		$topics = D('Topic','Logic')->queryTopicList($courseId,1,10);
		foreach ($topics['rows'] as $k=>$v){
			if($v['imgUrl']){
				$imgs = explode(PHP_EOL, $v['imgUrl']);
				$topics['rows'][$k]['linkImage']  = get_upfile_url(trim($imgs[0]));
				$topics['rows'][$k]['focusImage']  = get_upfile_url(trim($imgs[1]));
			}
		}
		
		//某个知识点下的课时列表
		if(empty($topicId)) $topicId = $topics['rows'][0]['id'];
		$sections = D('Section','Logic')->querySectionList($topicId,1,5);
		
		$json_topic = get_array_fieldkey($topics['rows'],array('id','name','linkImage','focusImage'));
		$json_topic = json_encode($json_topic);
		
		//专题列表
		$proConfig = get_pro_config_content('proConfig');
		$specialKey = array_search('专题', $proConfig['courseType']);
		$specials = D('Course','Logic')->queryCourseListByType($stageId, $specialKey, 1, 3);
		
		$this->assign(array(
			'sKey'	 		=> $stage['sKey'],
			'sections' 		=> $sections['rows'],
			'json_topic'	=> $json_topic,	
			'specialList'	=> $specials['rows'],
			'week'			=> $week,	
			'courseId'		=> $courseId,	
		));
		$this->display('detail_preschool');
	}
	
	/**
	 * 通用--课时列表
	 * @param unknown_type $chId
	 * @param unknown_type $chKey
	 * @param unknown_type $stageId
	 */
	private function common($chId,$chKey,$stageId,$courseId){
		$page = I('page',1);
		$pageSize = 10;
		
		$course = D('Course','Logic')->queryCourseById($courseId);
		$topicIds = explode(',',$course['topicIds']);
		$topicIds = array_filter($topicIds);
		$sections = D('Section','Logic')->querySectionList($topicIds,$page,$pageSize);
		
		$pageHtml = get_array_page($sections['total'], $pageSize, '/static/v1/hd/images/common/page');
		
		$this->assign(array(
			'course'	=> $course,	
			'sections'	=> $sections['rows'],
			'total'		=> $sections['total'],	
			'pageHtml' 	=> $pageHtml,
		));
		$this->display('detail_primaryschool');
	}
	
	/**
	 * 一周课程--课时列表
	 */
	public function weekAct(){
		$courseId = I('courseId','');
		//查找该课程的所有课时(本周课时)，不需要把所有知识点查出来，再查课时
		//方式：把该课程的知识点列表作为一个数组传给接口，就能把该课程的所有课时查询出来
		$course = D('Course','Logic')->queryCourseById($courseId);
		$topicIds = explode(',',$course['topicIds']);
		$topicIds = array_filter($topicIds);
		$sections = D('Section','Logic')->querySectionList($topicIds,1,31);
		foreach ($topicIds as $kev=>$val){
			foreach ($sections['rows'] as $k => $v){
				if($val == $v['topicId']){
					$data[$val][] = $v;
					unset($sections['rows'][$k]);
				}
			}
		}
		
		$this->assign(array(
			'sections' => $data,
		));
		$this->display();
	}
	
}