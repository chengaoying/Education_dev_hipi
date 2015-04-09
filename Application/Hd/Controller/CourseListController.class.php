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
		
		//获取该一级分类（二级栏目）下的龄段(有可能为空)
		$stageList = get_array_for_fieldval(S('Stage'),'chId',$chId);
		$this->initStageList($stageList);
		
		if(count($stageList) > 0){  //有龄段的一级分类（二级栏目）
			//龄段id(id不为空：从单个龄段入口进入)
			$stageId = I('stageId','');
			if(empty($stageId)) {
				$stageId = $stageList[0]['id'];
			}
			
			//获取课程列表
			//$courses = D('Course','Logic')->queryCourseListByKeys($stageId, '', $page, $pageSize);
			$courses = $this->getCourseList($chKey, $stageId, $page, $pageSize);
			
		}else{  //没有龄段的一级分类，直接查询该一级分类（二级栏目）下的课程
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

		//计算总页数
		$pageCount = get_page_count($courses['total'], $pageSize);
		
		//龄段列表-json格式
		$json_stage = get_array_fieldkey($stageList,array('id','name','linkImage','focusImage','titleImage'));
		$json_stage = json_encode($json_stage);
		
		//返回处理（焦点参数）
		$backUrl = get_back_url('Index/allCourse',0);
		$_preFocus = Session('preFocus');
		if(empty($_preFocus))
			Session('preFocus',I('preFocus'));
		$backUrl .= '?preFocus='. Session('preFocus');
		
		$this->assign(array(
			'chKey'	     => $chKey,
			'stageId'    => $stageId,
			'stageList'  => $stageList,
			'json_stage' => $json_stage,
			'courses' 	 => $courses['rows'],	
			'chId'		 => $chId,
			'page'		 => $page,
			'pageCount'	 => $pageCount,
			'focus'		 => I('focus',''),	
			'preFocus'	 => I('preFocus',''),
			'backUrl'	 => $backUrl,
		));
		$this->display();
	}
	
	/**
	 * 获取课程列表，早、幼教的基础课程只显示一个：
	 * 早教：角色当前月龄的基础课程（一个）
	 * 幼教：显示当前周的基础课程（一个）
	 * @param unknown_type $chKey
	 * @param unknown_type $stageId
	 * @param unknown_type $page
	 * @param unknown_type $pageSize
	 */
	private function getCourseList($chKey,$stageId,$page,$pageSize){
		
		$courseType = get_pro_config_content('proConfig','courseType');
		$k1 = array_search('基础', $courseType); //课程的基础类型的key
		$keys = array_keys($courseType);		//除基础类型之外的课程key
		foreach ($keys as $k => $v)
			if($v == $k1) unset($keys[$k]);
		
		switch ($chKey){
			case 'early': //早教
				//如果是第一页：第一个课程为基础课程
				if($page == 1){
					//根据角色的月龄获取该月龄对应的基础课程
					//如果角色的龄段Id和课程的龄段id不相等，则显示的课程月龄为默认月龄
					//如果相等，则获取角色的月龄并查找对应月龄的基础课程
					if($this->role['stageId'] !== $stageId){
						$month = $this->getDefMonth($stageId);
					}else{
						$month = $this->getMonthOfRole();
						if($this->isValidMonth($this->role,$month))
							$month = $this->getDefMonth($stageId);
					}
					$name = '.'.$month.'月';
					$_courses = D('Course','Logic')->queryCourseListByType($stageId, $k1, $page, $pageSize);
					foreach ($_courses['rows'] as $k=>$v){
						if(strchr($v['name'], $name))
							$c = $v;
					}
						
					if(!empty($c)) $pageSize -= 1;
					$courses = D('Course','Logic')->queryCourseListByType($stageId, $keys, $page, $pageSize);
					if(!empty($c)){
						//手动把基础课程合并到课程列表中
						foreach ($courses['rows'] as $k1 => $v1){
							$_k1 = $k1 + 1;
							$courses['rows'][$_k1] = $v1;
						}
						$courses['rows'][0] = $c;
						$courses['total'] += 1;
					}
					
				}else{
					$courses = D('Course','Logic')->queryCourseListByType($stageId, $keys, $page, $pageSize);
				} 
				break;
			case 'preschool': //幼教
				if($page == 1){
					//根据当前周数显示对应周数的基础课程
					$name = '第'.getCurrentWeek().'周';
					$_courses = D('Course','Logic')->queryCourseListByType($stageId, $k1, $page, $pageSize);
					foreach ($_courses['rows'] as $k=>$v){
						if(strchr($v['name'], $name))
							$c = $v;
					}
					
					if(!empty($c)) $pageSize -= 1;
					$courses = D('Course','Logic')->queryCourseListByType($stageId, $keys, $page, $pageSize);

					if(!empty($c)){
						//手动把基础课程合并到课程列表中
						foreach ($courses['rows'] as $k1 => $v1){
							$_k1 = $k1 + 1;
							$courses['rows'][$_k1] = $v1;
						}
						$courses['rows'][0] = $c;
						$courses['total'] += 1;
					}
				}else{
					$courses = D('Course','Logic')->queryCourseListByType($stageId, $keys, $page, $pageSize);
				} 
				
				break;
			default: //其他年级
				$courses = D('Course','Logic')->queryCourseListByKeys($stageId, '', $page, $pageSize);
				break;
		}
		return $courses;
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
				$stageList[$k]['titleImage'] = get_upfile_url(trim($imgs[2]));
			}
		}	
	}
	
	/**
	 * 早，幼教课程描述
	 */
	public function courseDescAct(){
		$this->assign(array(
			'chKey' 	=> I('chKey',''),
			'backUrl'	=> get_back_url('CourseList/index',1),
		));
		$this->display();
	}
	
}