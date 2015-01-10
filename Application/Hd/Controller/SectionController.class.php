<?php

/**
 * 控制器：课时，处理逻辑包括：
 * 1、该课时所属的课程是否收费
 * 2、如果收费，则判断用户是否购买，免费则直接进入流程4
 * 3、没有订购并且课程收费则直接跳转至订购页面
 * 4、如果已订购或者免费，则判断是否有课堂预习、同步课堂、练习题（课时顺序：课堂预习，同步课堂，练习题）。
 * @author CGY
 *
 */
namespace Hd\Controller;
use Common\Controller\CommonController;

class SectionController extends CommonController {
	
    public function indexAct() {
    	
    	$courseId  = I('courseId','');
    	$sectionId = I('sectionId','');
    	$sort = I('sort','');
    	$total = I('total','');
    	
		$course = D('Course','Logic')->queryCourseById($courseId);
		$char = getDelimiterInStr($course['topicIds']);
		$topicIds = explode($char,$course['topicIds']);
		$topicIds = array_filter($topicIds);
		
		$isExistPreVideo = false;
		$isExitsNextVideo = false;
		if($sort>1){
			$isExitPreVideo = true;
			$sorts[] = $sort-1;
		}
		$sorts[] = (int)$sort;
		if($sort<$total){
			$isExitsNextVideo = true;
			$sorts[] = $sort+1;
		}
		$threeVideo = D('Section','Logic')->querySectionListBySort($topicIds,$sorts);
		$jumpUrl = 'Resource/play?sectionId='.$sectionId.'&sort='.$sort.'&total='.$total;
		if($isExitPreVideo){
			$jumpUrl.='&preSectionId='.$threeVideo['rows'][0]['id'];
		}
		if($isExitsNextVideo){
			$jumpUrl.='&nextSectionId='.$threeVideo['rows'][2]['id'];
		}
    	header('location:'.U($jumpUrl));
    	exit;
    	
    	$role = unserialize(Session('role'));
    	
    	//1.判断该课程是否收费
    	$isFree = false;
    	$course = D('Course','Logic')->queryCourseById($courseId);
    	if($course['privilege'] === 1){//收费
    		//2.判断用户是否订购
    		
    	}else{//免费
    		$isFree = true;
    	}
    	
    	//4.判断是否有课堂预习、同步课堂、练习题
    	if($isFree){
    		
    	}
    	
        $this->display();
    }
    
}