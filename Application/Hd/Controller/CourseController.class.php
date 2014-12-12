<?php

/**
 * 控制器：课程首页
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class CourseController extends CommonController {
    
    
    /*
     * 全部课程
     */
    public function allAct() {
        
    }
    
    /*
     * 推荐课程(用户创建角色之后进入的页面)
     */
    public function recommendAct() {
    	
    	//栏目数据json格式-前端js使用
    	$json_channel = get_array_fieldkey($this->topChannel,array('id','name','linkImage','focusImage'));
    	$json_channel = json_encode($json_channel);
    	
    	//广告
    	$left_ad   = $this->getAdByasKey('recommend_left');
    	$right_ad  = $this->getAdByasKey('recommend_right');
    	$bottom_ad = $this->getAdByasKey('recommend_bottom');
    	
    	//广告数据json格式-前端js使用
    	//$json_ad[0]  = $left_ad;
    	$json_ad[0]  = $right_ad;
    	$json_ad[1]  = $bottom_ad;
    	$json_ad = get_array_fieldkey($json_ad,array('id','title','content'));
    	$json_ad = json_encode($json_ad);
    	
    	$this->assign(array(
    		'json_channel'	=> $json_channel,
    		'topChannel' 	=> $this->topChannel,
    		'left_ad'		=> $left_ad,
    		'right_ad'		=> $right_ad,		
    		'bottom_ad'		=> $bottom_ad,	
    		'json_ad'		=> $json_ad,		
    	));
        $this->display();
    }
    
    /*
     * 我的课程
     */
    public function myAct() {
        //首先判断该角色属于哪个学习龄段——早教（early），幼儿园（kindergarten）、小学（gradeschool）
        $roleType = 1;
        if($roleType == 1){
            $template = 'my_early';
        }else if($roleType == 2){
            $template = 'my_kinder';
        }else if($roleType == 2){
            $template = 'my_grade';
        }
        
        $this->display($template);
    }
    
}