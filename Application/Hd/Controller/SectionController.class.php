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
        $topicId = I('$topicId','');
    	$sectionId = I('sectionId','');
        
		$course = D('Course','Logic')->queryCourseById($courseId);
        $char = getDelimiterInStr($course['topicIds']);
		$topicIds = explode($char,$course['topicIds']);
		$topicIds = array_filter($topicIds);
		$sections = D('Section','Logic')->querySectionList($topicIds,$page,1000);
        //print_r($sections);exit;
        $preSection = $nextSection = '';
        foreach ($sections['rows'] as $key => $value) {
            if($value['id'] == $sectionId){
                if($sections['rows'][$key-1]){
                    $preSection = $sections['rows'][$key-1]['id'];
                }
                if($sections['rows'][$key+1]){
                    $nextSection = $sections['rows'][$key+1]['id'];
                }
                break;
            }
        }
        
		$jumpUrl = 'Resource/play?courseId='.$courseId.'&topicId='.$topicId.'&sectionId='.$sectionId;
		if($preSection){
			$jumpUrl.='&preSection='.$preSection;
		}
		if($nextSection){
			$jumpUrl.='&nextSection='.$nextSection;
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