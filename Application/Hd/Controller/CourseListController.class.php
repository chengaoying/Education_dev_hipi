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
	 * 根据角色龄段进入
	 */
	public function indexAct(){
		
	}
	
	
	/**
	 * 早教
	 */
	public function earlyAct(){
        
        $ageList = array();
		$ageList = array(
				array(
						'id' => 1,
						'name' => 'bb',
						'linkImage' => get_upfile_url('__HD__/images/course/early/age_1.png'),
						'focusImage'=> get_upfile_url('__HD__/images/course/early/age_1_over.png'),
				),
				array(
						'id' => 1,
						'name' => 'bb',
						'linkImage' => get_upfile_url('__HD__/images/course/early/age_2.png'),
						'focusImage'=> get_upfile_url('__HD__/images/course/early/age_2_over.png'),
				),
				array(
						'id' => 1,
						'name' => 'bb',
						'linkImage' => get_upfile_url('__HD__/images/course/early/age_3.png'),
						'focusImage'=> get_upfile_url('__HD__/images/course/early/age_3_over.png'),
				),
		);
        
		$json_age = json_encode($ageList);
        
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
            'json_age' => $json_age,
            'ageList' => $ageList,
			'courseList' => $courseList,
		));
		$this->display();
	}
	
    /*
     * 单岁
     * 针对早教
     */
    public function earlySingleAct() {
        $age = '1';
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
            'age' => $age,
            'courseList' => $courseList,
        ));
        $this->display();
    }
    
    
    
	/**
	 * 幼儿园
	 */
	public function preschoolAct(){
        $classList = array();
		$classList = array(
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
        
		$json_class = json_encode($classList);
        
        
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