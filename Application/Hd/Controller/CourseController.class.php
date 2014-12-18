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
    	//栏目数据json格式-前端js使用
    	$json_channel = get_array_fieldkey($this->topChannel,array('id','name','linkImage','focusImage'));
    	$json_channel = json_encode($json_channel);
    	
    	//一级分类（二级栏目）
        $class = $this->getClass();
    	$json_class = get_array_fieldkey(array_slice($class,0,count($class)),array('id','name','chKey','imgUrl','linkUrl'));
    	$json_class = json_encode($json_class);
        
        //dump($json_class);exit;
       	$this->assign(array(
    		'json_channel'	=> $json_channel,
    		'topChannel' 	=> $this->topChannel,
       		'class'			=> $class,
       		'json_class'	=> $json_class,		
    	));
        $this->display();
    }
    
    /*
     * 推荐课程(用户创建角色之后进入的页面)
     */
    public function recommendAct() {
    	//角色信息
    	$roleList = Session('roleList');
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
    		'roleList'		=> $roleList[16],
    	));
        $this->display();
    }
    
    /*
     * 我的课程
     */
    public function myAct() {
        //栏目数据json格式-前端js使用
    	$json_channel = get_array_fieldkey($this->topChannel,array('id','name','linkImage','focusImage'));
        //print_r($json_channel);
    	$json_channel = json_encode($json_channel);
        
        //我的课程
        $myCourse = array();
        $myCourse = array(
            array(
                'id' => 1,
                'name' => 'aa',
                'content' => get_upfile_url('__HD__/images/course/my/a.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'bb',
                'content' => get_upfile_url('__HD__/images/course/my/b.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
        );
        //print_r($myCourse);
        $this->assign(array(
    		'json_channel'	=> $json_channel,
    		'topChannel' 	=> $this->topChannel,
            'myCourse'      => $myCourse,
    	));
        $this->display();
    }
    
    
    /*
     * 某一具体课程
     */
    public function detailAct() {
        //先判断是什么学龄阶段
        $learnType = 3;
        switch ($learnType) {
            case 1: //早教
                $template = 'detail_early';
                $month = 13;//几个月的小孩
                if($month>=1 and $month<=12){
                    $year = 1;
                }else if($month>12 and $month<=24){
                    $year = 2;
                }else if($month>24 and $month<=36){
                    $year = 3;
                }else{
                    $this->showMessage('参数错误');
                }
                //左边栏目列表
                $chList = array();
                $chList = array(
                    array(
                        'id' => 1,
                        'name' => 'aa',
                        'linkImage' => get_upfile_url('__HD__/images/course/early/ch_nav/1month/xinshengerhuli.png'),
                        'focusImage'=> get_upfile_url('__HD__/images/course/early/ch_nav/1month/xinshengerhuli_over.png'),
                    ),
                    array(
                        'id' => 1,
                        'name' => 'bb',
                        'linkImage' => get_upfile_url('__HD__/images/course/early/ch_nav/1month/xinshengerweiyang.png'),
                        'focusImage'=> get_upfile_url('__HD__/images/course/early/ch_nav/1month/xinshengerweiyang_over.png'),
                    ),
                    array(
                        'id' => 1,
                        'name' => 'cc',
                        'linkImage' => get_upfile_url('__HD__/images/course/early/ch_nav/1month/mamabidu.png'),
                        'focusImage'=> get_upfile_url('__HD__/images/course/early/ch_nav/1month/mamabidu_over.png'),
                    ),
                    array(
                        'id' => 1,
                        'name' => 'dd',
                        'linkImage' => get_upfile_url('__HD__/images/course/early/ch_nav/1month/chanfuhuli.png'),
                        'focusImage'=> get_upfile_url('__HD__/images/course/early/ch_nav/1month/chanfuhuli_over.png'),
                    ),
                    array(
                        'id' => 1,
                        'name' => 'ee',
                        'linkImage' => get_upfile_url('__HD__/images/course/early/ch_nav/1month/chanhouyinshianpai.png'),
                        'focusImage'=> get_upfile_url('__HD__/images/course/early/ch_nav/1month/chanhouyinshianpai_over.png'),
                    ),
                    array(
                        'id' => 1,
                        'name' => 'ff',
                        'linkImage' => get_upfile_url('__HD__/images/course/early/ch_nav/1month/qinzishenxintiaoli.png'),
                        'focusImage'=> get_upfile_url('__HD__/images/course/early/ch_nav/1month/qinzishenxintiaoli_over.png'),
                    ),
                );
                //右边视频列表
                $videoList = array();
                $videoList = array(
                    array(
                        'id' => 1,
                        'name' => 'aa',
                        'content' => get_upfile_url('__HD__/images/course/early/a.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'bb',
                        'content' => get_upfile_url('__HD__/images/course/early/b.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'cc',
                        'content' => get_upfile_url('__HD__/images/course/early/c.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'cc',
                        'content' => get_upfile_url('__HD__/images/course/early/d.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'cc',
                        'content' => get_upfile_url('__HD__/images/course/early/e.jpg')
                    ),
                );
                $this->assign(array(
                    'month' => $month,
                    'year' => $year,
                    'chList' => $chList,
                    'json_ch' => json_encode($chList),
                    'videoList' => $videoList,
                ));
                break;
            
            case 2: //幼儿园
                $template = 'detail_kinder';
                $classLevel = 'big'; //哪个班
                $weekDay = 1;//周几
                
                //视频列表
                $videoList = array();
                $videoList = array(
                    array(
                        'id' => 1,
                        'name' => 'aa',
                        'content' => get_upfile_url('__HD__/images/course/kinder/video_1.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'bb',
                        'content' => get_upfile_url('__HD__/images/course/kinder/video_2.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'cc',
                        'content' => get_upfile_url('__HD__/images/course/kinder/video_3.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'cc',
                        'content' => get_upfile_url('__HD__/images/course/kinder/video_4.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'cc',
                        'content' => get_upfile_url('__HD__/images/course/kinder/video_5.jpg')
                    ),
                );
                
                //专题列表
                $specialList = array();
                $specialList = array(
                    array(
                        'id' => 1,
                        'name' => 'aa',
                        'content' => get_upfile_url('__HD__/images/course/kinder/special_1.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'bb',
                        'content' => get_upfile_url('__HD__/images/course/kinder/special_2.jpg')
                    ),
                    array(
                        'id' => 1,
                        'name' => 'cc',
                        'content' => get_upfile_url('__HD__/images/course/kinder/special_3.jpg')
                    ),
                );
                $this->assign(array(
                    'classLevel' => $classLevel,
                    'videoList' => $videoList,
                    'specialList' => $specialList,
                ));
                break;
            
            case 3: //小学
                $template = 'detail_grade';
                $videoList = array();
                $videoList = array(
                		array(
                				'id' => 1,
                				'name' => '第一课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第二课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第三课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第四课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第五课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第六课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第七课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第八课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第九课',
                		),
                		array(
                				'id' => 1,
                				'name' => '第十课',
                		),
                );
                
                $this->assign(array(
                		'videoList'=>$videoList,
                ));
                break;
            
            default:
                break;
        }
        $this->display($template);
    }
    
    
    /*
     * 针对早教
     * 年龄段
     */
    public function ageAct() {
        //课程列表
        $courseList = array();
        $courseList = array(
            array(
                'id' => 1,
                'name' => 'aa',
                'content' => get_upfile_url('__HD__/images/course/my/a.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'bb',
                'content' => get_upfile_url('__HD__/images/course/my/b.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
        );
        $this->assign(array(
            'courseList' => $courseList,
        ));
        $this->display();
    }
    
    /*
     * 针对幼儿园
     * 大中小班
     */
    public function allclassAct() {
        
        //课程列表
        $courseList = array();
        $courseList = array(
            array(
                'id' => 1,
                'name' => 'aa',
                'content' => get_upfile_url('__HD__/images/course/my/a.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'bb',
                'content' => get_upfile_url('__HD__/images/course/my/b.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
        );
        $this->assign(array(
            
            'courseList' => $courseList,
        ));
        $this->display();
    }
    
    /*
     * 针对幼儿园
     * 某一个班
     */
    public function classAct() {
        $classLevel = 'small';
        //课程列表
        $courseList = array();
        $courseList = array(
            array(
                'id' => 1,
                'name' => 'aa',
                'content' => get_upfile_url('__HD__/images/course/my/a.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'bb',
                'content' => get_upfile_url('__HD__/images/course/my/b.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
        );
        $this->assign(array(
            'classLevel' => $classLevel,
            'courseList' => $courseList,
        ));
        $this->display();
    }
    
    /*
     * 针对幼儿园
     * 一周课程
     */
    public function weekAct() {
        $classLevel = 'big';
        $videoList = array();
        $videoList = array(
            1 => array(
                array(
                    'id' => 1,
                    'name' => 'aa',
                    
                ),
                array(
                    'id' => 2,
                    'name' => 'bb'
                ),
                array(
                    'id' => 3,
                    'name' => 'cc'
                ),
                array(
                    'id' => 4,
                    'name' => 'dd'
                ),
                array(
                    'id' => 5,
                    'name' => 'ee'
                ),
            ),
            2 => array(
                array(
                    'id' => 1,
                    'name' => 'aa'
                ),
                array(
                    'id' => 2,
                    'name' => 'bb'
                ),
                array(
                    'id' => 3,
                    'name' => 'cc'
                ),
                array(
                    'id' => 4,
                    'name' => 'dd'
                ),
                array(
                    'id' => 5,
                    'name' => 'ee'
                ),
            ),
            3 => array(
                array(
                    'id' => 1,
                    'name' => 'aa'
                ),
                array(
                    'id' => 2,
                    'name' => 'bb'
                ),
                array(
                    'id' => 3,
                    'name' => 'cc'
                ),
                array(
                    'id' => 4,
                    'name' => 'dd'
                ),
                array(
                    'id' => 5,
                    'name' => 'ee'
                ),
            ),
            4 => array(
                array(
                    'id' => 1,
                    'name' => 'aa'
                ),
                array(
                    'id' => 2,
                    'name' => 'bb'
                ),
                array(
                    'id' => 3,
                    'name' => 'cc'
                ),
                array(
                    'id' => 4,
                    'name' => 'dd'
                ),
                array(
                    'id' => 5,
                    'name' => 'ee'
                ),
            ),
            5 => array(
                array(
                    'id' => 1,
                    'name' => 'aa'
                ),
                array(
                    'id' => 2,
                    'name' => 'bb'
                ),
                array(
                    'id' => 3,
                    'name' => 'cc'
                ),
                array(
                    'id' => 4,
                    'name' => 'dd'
                ),
                array(
                    'id' => 5,
                    'name' => 'ee'
                ),
            ),
            6 => array(
                array(
                    'id' => 1,
                    'name' => 'aa'
                ),
                array(
                    'id' => 2,
                    'name' => 'bb'
                ),
                array(
                    'id' => 3,
                    'name' => 'cc'
                ),
                array(
                    'id' => 4,
                    'name' => 'dd',
                    'content'=>get_upfile_url('__HD__/images/course/kinder/xiaoyingyuan.png'),
                ),
            ),
            7 => array(
                array(
                    'id' => 1,
                    'name' => 'aa'
                ),
                array(
                    'id' => 2,
                    'name' => 'bb'
                ),
                array(
                    'id' => 3,
                    'name' => 'cc',
                ),
                array(
                    'id' => 4,
                    'name' => 'dd',
                    'content'=>get_upfile_url('__HD__/images/course/kinder/xingquban.png'),
                ),
            ),
        );
        
        $this->assign(array(
                    'classLevel' => $classLevel,
                    'videoList' => $videoList,
                ));
        $this->display();
    }
    
    /*
     * 针对小学
     * 所有年级
     */
    public function allgradeAct() {
        //6个年级
        $gradeList = array();
        $gradeList = array(
            1 => array(
                'id' => 1,
                'name' => 'bb',
                'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_1.png'),
                'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_1_over.png'),
            ),
            2 => array(
                'id' => 1,
                'name' => 'bb',
                'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_2.png'),
                'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_2_over.png'),
            ),
            3 => array(
                'id' => 1,
                'name' => 'bb',
                'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_3.png'),
                'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_3_over.png'),
            ),
            4 => array(
                'id' => 1,
                'name' => 'bb',
                'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_4.png'),
                'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_4_over.png'),
            ),
            5 => array(
                'id' => 1,
                'name' => 'bb',
                'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_5.png'),
                'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_5_over.png'),
            ),
            6 => array(
                'id' => 1,
                'name' => 'bb',
                'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_6.png'),
                'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_6_over.png'),
            ),
        );
        $json_grade = json_encode($gradeList);
        //课程列表
        $courseList = array();
        $courseList = array(
            array(
                'id' => 1,
                'name' => 'aa',
                'content' => get_upfile_url('__HD__/images/course/my/a.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'bb',
                'content' => get_upfile_url('__HD__/images/course/my/b.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
        );

        $this->assign(array(
            'json_grade' => $json_grade,
            'gradeList' => $gradeList,
            'courseList' => $courseList,
        ));
        $this->display();
    }
    
    /*
     * 针对小学
     * 某一年级
     */
    public function gradeAct() {
        $grade = 1;
        //课程列表
        $courseList = array();
        $courseList = array(
            array(
                'id' => 1,
                'name' => 'aa',
                'content' => get_upfile_url('__HD__/images/course/my/a.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'bb',
                'content' => get_upfile_url('__HD__/images/course/my/b.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
            array(
                'id' => 1,
                'name' => 'cc',
                'content' => get_upfile_url('__HD__/images/course/my/c.jpg')
            ),
        );

        $this->assign(array(
            'grade' => $grade,
            'json_grade' => $json_grade,
            'courseList' => $courseList,
        ));
        $this->display();
    }
}