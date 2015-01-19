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
		$char = getDelimiterInStr($course['chId']);
		$chId = explode($char, $course['chId']);
		$chKey = get_array_keyval(S('Channel'),$chId[0],'id','chKey');
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
		$topicId = I('topicId','');
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
			'topicId'	 => $topicId,		
			'focus'		 => I('focus',''),	
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
		//该课程知识点列表
		$topics = D('Topic','Logic')->queryTopicList($course['id'],1,10);
		$topics = $topics['rows'];
		foreach ($topics as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$topics[$k]['linkImage']   = get_upfile_url(trim($imgs[0]));
				$topics[$k]['focusImage']  = get_upfile_url(trim($imgs[1]));
			}
		}
		
		$topicId = I('topicId','');
		$chId = I('chId','');
		
		//计算上一个课时id，下一个课时id
		if(empty($topicId)){
			$i = (date('w')-1) < 0 ? 6 : (date('w')-1);
			$topicId = $topics[$i]['id'];
		} 
		$k = get_arraykey($topics, 'id', $topicId);
		$prev = $k - 1;
		$next = $k + 1;
		if($prev < 0) $prev = 0;
		if($next > 6) $next = 6;
		$week = $k + 1;
		$week = $week>6 ? 0 : $week;
		$prevTopicId = $topics[$prev]['id'];
		$nextTopicId = $topics[$next]['id'];
		
		$sections = D('Section','Logic')->querySectionList($topicId,1,5);

		//专题列表
		$proConfig = get_pro_config_content('proConfig');
		$key = array_search('嗨皮幼儿园推荐',$proConfig['keys']);
		$char = getDelimiterInStr($course['stageIds']);
		$ids = explode($char, $course['stageIds']);
		$specials = D('Course','Logic')->queryCourseListByKeys($ids[0], array($key), 1, 3);
		foreach ($specials['rows'] as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$specials['rows'][$k]['imgUrl']  = get_upfile_url(trim($imgs[count($imgs)-1]));
			}
		}
		
		$this->assign(array(
			'sections' 		=> $sections['rows'],
			'specialList'	=> $specials['rows'],
			'courseId'		=> $course['id'],	
			'week'			=> $week,	
			'prevTopicId'	=> $prevTopicId,
			'nextTopicId'	=> $nextTopicId,
			'chId'			=> $chId,	
			'focus'		    => I('focus',''),
		));
		if($week==6||$week==0){
			$template = 'detail_preschool_weekend';
		}else{
			$template = 'detail_preschool_workday';
		}
		$this->display($template);
	}
	
	/**
	 * 通用--课时列表
	 * @param int $chId
	 * @param int $chKey
	 * @param int $stageId
	 */
	private function common($chKey,$course){
		$page = I('page',1);
		$pageSize = 12;
		
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
			'focus'		=> I('focus',''),
		));
		$this->display('detail_primaryschool');
	}
	
	/**
	 * 一周课程--课时列表
	 */
	public function weekAct(){
		$courseId = I('courseId','');
		$week = I('week','');
		if(!empty($courseId)) 
			$course = D('Course','Logic')->queryCourseById($courseId);
		else{
			$course = D('Course','Logic')->queryRecommendCourse('',array('第'.$week.'周'));
			$course = $course[0];
		} 
				
		//查找该课程的所有课时(本周课时)，不需要把所有知识点查出来，再查课时
		//方式：把该课程的知识点列表作为一个数组传给接口，就能把该课程的所有课时查询出来
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
		
		//计算周数
		$name = $course['name'];
		if(empty($week))
			$week = preg_replace('/\D/s', '', $name);//课程当前周数，从课程名中获取
		$prevWeek = ($week-1)<1 ? 1 : ($week-1);
		$nextWeek = ($week+1)>52 ? 52 : ($week+1);
		
		$this->assign(array(
			'sections' => $data,
			'courseId' => $courseId,
			'week'	   => $week,
			'prevWeek' => $prevWeek,
			'nextWeek' => $nextWeek,
			'focus'		 => I('focus',''),
		));
		$this->display();
	}
	
}