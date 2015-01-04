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
		$courseId   = I('courseId','');
		$course = D('Course','Logic')->queryCourseById($courseId);
		$chKey = get_array_keyval(S('Channel'),$course['chId'],'id','chKey');
		
		if($chKey == 'early' && $course['typeId'] != 2) //早教课时列表(非专题)
		{
			$this->early($chKey,$course);
		}
		elseif($chKey == 'preschool' && $course['typeId'] != 2) //幼教课时列表(非专题)
		{
			$this->preschool($chKey,$course);
		}
		else  //其他通用课时列表
		{
			$this->common($chKey,$course);
		}
	}
	
	/**
	 * 早教--课时列表 
	 * @param int $chId  栏目id
	 * @param int $chKey 栏目key
	 * @param int $stageId 龄段id
	 */
	private function early($chKey,$course){
		$topicId = I('topic','');
		//该课程知识点列表
		$topics = D('Topic','Logic')->queryTopicList($course['id'],1,10);
		foreach ($topics['rows'] as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
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
			'topics' 	 => $topics['rows'],
			'json_topic' => $json_topic,
			'sections'   => $sections['rows'],
			'courseId'	 =>	$course['id'],	
		));
		$this->display('detail_early');
	}
	
	/**
	 * 幼教--课时列表
	 * @param int $chId
	 * @param int $chKey
	 * @param int $stageId
	 */
	private function preschool($chKey,$course){
		$stage = S('Stage');
		$stage = $stage[$course['stageIds']];
		
		$topicId = I('topic','');
		$week = I('week',date("w"));
		
		//该课程知识点列表
		$topics = D('Topic','Logic')->queryTopicList($course['id'],1,10);
		foreach ($topics['rows'] as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$topics['rows'][$k]['linkImage']   = get_upfile_url(trim($imgs[0]));
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
		$specials = D('Course','Logic')->queryCourseListByType($course['stageIds'], $specialKey, 1, 3);
		
		$this->assign(array(
			'sKey'	 		=> $stage['sKey'],
			'sections' 		=> $sections['rows'],
			'json_topic'	=> $json_topic,	
			'specialList'	=> $specials['rows'],
			'week'			=> $week,	
			'courseId'		=> $course['id'],	
		));
		$this->display('detail_preschool');
	}
	
	/**
	 * 通用--课时列表
	 * @param int $chId
	 * @param int $chKey
	 * @param int $stageId
	 */
	private function common($chKey,$course){
		$page = I('page',1);
		$pageSize = 10;
		
		$imgs = explode(getDelimiterInStr($course['imgUrl']), $course['imgUrl']);
		$course['imgUrl'] = $imgs[0];
		$char = getDelimiterInStr($course['topicIds']);
		$topicIds = explode($char,$course['topicIds']);
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
		$char = getDelimiterInStr($course['topicIds']);
		$topicIds = explode($char,$course['topicIds']);
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
			'courseId' => $courseId,	
		));
		$this->display();
	}
	
}