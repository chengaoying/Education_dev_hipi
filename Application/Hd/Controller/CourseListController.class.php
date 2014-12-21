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
		//一级分类（二级栏目）的ID
		$chId = I('chId',''); 
		//获取该一级分类下的龄段(有可能为空)
		$stage = get_array_for_fieldval(S('Stage'),'chId',$chId);
		
		//龄段id
		$stageId = I('stageId','');
		if(!empty($stageId)) $stage = get_array_for_fieldval($stage,'id',$stageId);
		
		$this->assign(array(
			'chId'	     => $chId,
			'stageId'    => $stageId,
			'stage'   	 => $stage,
			'courseList' => $this->getCourseList(),	
		));
		$this->display();
	}
	
	private function getCourseList(){
		$courseList = array(
				array(
						'id' => 1,
						'name' => 'aa',
						'content' => get_upfile_url('__HD__/images/index/myCourse/a.jpg')
				),
				array(
						'id' => 1,
						'name' => 'bb',
						'content' => get_upfile_url('__HD__/images/index/myCourse/b.jpg')
				),
				array(
						'id' => 1,
						'name' => 'cc',
						'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
				),
				array(
						'id' => 1,
						'name' => 'cc',
						'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
				),
				array(
						'id' => 1,
						'name' => 'cc',
						'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
				),
				array(
						'id' => 1,
						'name' => 'cc',
						'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
				),
				array(
						'id' => 1,
						'name' => 'cc',
						'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
				),
				array(
						'id' => 1,
						'name' => 'cc',
						'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
				),
				array(
						'id' => 1,
						'name' => 'cc',
						'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
				),
				array(
						'id' => 1,
						'name' => 'cc',
						'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
				),
		);
		return $courseList;
	}
	
	
	/**
	 * 早教
	 */
	public function earlyAct(){
		$stageId = I('stageId','');
		if(empty($stageId)){
			$stageList = array(
				array(
					'id' => 1,
					'name' => 'bb',
					'linkImage' => get_upfile_url('__HD__/images/course/early/age_1.png'),
					'focusImage'=> get_upfile_url('__HD__/images/course/early/age_1_over.png'),
				),
				array(
					'id' => 2,
					'name' => 'bb',
					'linkImage' => get_upfile_url('__HD__/images/course/early/age_2.png'),
					'focusImage'=> get_upfile_url('__HD__/images/course/early/age_2_over.png'),
				),
				array(
					'id' => 3,
					'name' => 'bb',
					'linkImage' => get_upfile_url('__HD__/images/course/early/age_3.png'),
					'focusImage'=> get_upfile_url('__HD__/images/course/early/age_3_over.png'),
				),
			);
		}else{
			$stageList = array(
				array(
					'id' => $stageId,
					'name' => 'bb',
					'linkImage' => get_upfile_url('__HD__/images/course/early/age_'.$stageId.'.png'),
					'focusImage'=> get_upfile_url('__HD__/images/course/early/age_'.$stageId.'_over.png'),
				),
			);
		}
		
		$json_stage = json_encode($stageList);
        
		//课程列表
		$courseList = array();
		$courseList = array(
			array(
					'id' => 1,
					'name' => 'aa',
					'content' => get_upfile_url('__HD__/images/index/myCourse/a.jpg')
			),
			array(
					'id' => 1,
					'name' => 'bb',
					'content' => get_upfile_url('__HD__/images/index/myCourse/b.jpg')
			),
			array(
					'id' => 1,
					'name' => 'cc',
					'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
			),
			array(
					'id' => 1,
					'name' => 'cc',
					'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
			),
			array(
					'id' => 1,
					'name' => 'cc',
					'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
			),
			array(
					'id' => 1,
					'name' => 'cc',
					'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
			),
			array(
					'id' => 1,
					'name' => 'cc',
					'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
			),
			array(
					'id' => 1,
					'name' => 'cc',
					'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
			),
			array(
					'id' => 1,
					'name' => 'cc',
					'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
			),
			array(
					'id' => 1,
					'name' => 'cc',
					'content' => get_upfile_url('__HD__/images/index/myCourse/c.jpg')
			),
		);
		$this->assign(array(
            'json_stage' => $json_stage,
            'stageList' => $stageList,
			'courseList' => $courseList,
		));
		$this->display();
	}
	
    
	/**
	 * 幼儿园
	 */
	public function preschoolAct(){
		$stageId = I('stageId',''); //龄段id
		if(!empty($stageId)){
			$stageList = array(
				array(
					'id' => 1,
					'name' => 'bb',
					'linkImage' => get_upfile_url('__HD__/images/course/kinder/small_class.png'),
					'focusImage'=> get_upfile_url('__HD__/images/course/kinder/small_class_over.png'),
				),
				array(
					'id' => 1,
					'name' => 'bb',
					'linkImage' => get_upfile_url('__HD__/images/course/kinder/middle_class.png'),
					'focusImage'=> get_upfile_url('__HD__/images/course/kinder/middle_class_over.png'),
				),
				array(
					'id' => 1,
					'name' => 'bb',
					'linkImage' => get_upfile_url('__HD__/images/course/kinder/big_class.png'),
					'focusImage'=> get_upfile_url('__HD__/images/course/kinder/big_class_over.png'),
				),
			);
		}else{
			$stageList = array(
				array(
					'id' => 1,
					'name' => 'bb',
					'linkImage' => get_upfile_url('__HD__/images/course/kinder/small_class.png'),
					'focusImage'=> get_upfile_url('__HD__/images/course/kinder/small_class_over.png'),
				),
			);
		}
        
		$json_stage = json_encode($stageList);
        
        
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
                'json_class' => $json_class,
                'classList' => $classList,
				'courseList' => $courseList,
		));
		$this->display();
	}
    
    /*
     * 单班
     * 针对幼儿园
     */
    public function preSingleAct() {
        $class = 'small';
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
            'class' => $class,
            'courseList' => $courseList,
        ));
        $this->display();
    }
	
	/**
	 * 小学
	 */
	public function primaryschoolAct(){
		//6个年级
		$gradeList = array();
		$gradeList = array(
				array(
						'id' => 1,
						'name' => 'bb',
						'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_1.png'),
						'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_1_over.png'),
				),
				array(
						'id' => 1,
						'name' => 'bb',
						'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_2.png'),
						'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_2_over.png'),
				),
				array(
						'id' => 1,
						'name' => 'bb',
						'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_3.png'),
						'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_3_over.png'),
				),
				array(
						'id' => 1,
						'name' => 'bb',
						'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_4.png'),
						'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_4_over.png'),
				),
				array(
						'id' => 1,
						'name' => 'bb',
						'linkImage' => get_upfile_url('__HD__/images/course/grade/grade_5.png'),
						'focusImage'=> get_upfile_url('__HD__/images/course/grade/grade_5_over.png'),
				),
				array(
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
     * 单年级
     * 针对小学
     */
    public function primarySingleAct() {
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