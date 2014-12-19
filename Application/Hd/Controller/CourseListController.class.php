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
	
	/**
	 * 幼儿园
	 */
	public function preschoolAct(){
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
	
	/**
	 * 小学
	 */
	public function primaryschoolAct(){
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
	
	
	
}