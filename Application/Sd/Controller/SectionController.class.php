<?php

/**
 * 控制器：课时
 * 处理流程（正式环境）：
 * 1、判断该课时所属的课程是否收费，收费则进入流程2，免费则进入流程5。
 * 2、判断该课时是否免费，免费则进入流程5，收费则进入流程3。
 * 3、判断用户是否购买，没订购则进入流程4，已订购则进入流程5。
 * 4、直接跳转至订购页面。
 * 5、进入课时，并判断是否有课堂预习、同步课堂、练习题（课时顺序：课堂预习，同步课堂，练习题）。
 * @author CGY
 *
 */
namespace Sd\Controller;
use Common\Controller\CommonController;

class SectionController extends CommonController {
	
    public function indexAct() {
    	
    	$courseId  = I('courseId','');
    	$sectionId = I('sectionId','');
    	
    	//1.判断该课程是否收费
    	//暂不支持课程包的计费方式，所以不用判断课程是否收费
    	$isFree = false;
    	/* $course = D('Course','Logic')->queryCourseById($courseId);
    	if($course['privilege'] == 1){ */
    		//2.判断该课时是否收费
    		$section = D('Section', 'Logic')->querySectionById($sectionId);
    		if($section['privilege'] == 1 && C('DEBUG_MODE') != 1){
    			//3.判断用户是否购买该课程(鉴权)
    			
    			//4.没有订购则进入订购页面
    		}else{
    			$isFree = true;
    		}
    	/* }else{
    		$isFree = true;
    	} */
    	
    	//5.课时流程处理,判断是否有课堂预习、同步课堂、练习题
    	if($isFree){
    		$jumpUrl = 'Resource/play?courseId='.$courseId.'&sectionId='.$sectionId;
    		header('location:'.U($jumpUrl));
    	}
    	exit;
    }
    
}