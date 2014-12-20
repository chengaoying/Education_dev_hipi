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
	 * 早教--课时列表
	 */
	public function earlyAct(){
		$template = 'detail_early';
		$month = 13;//几个月的小孩
        $age = 2;
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
			'age' => $age,
			'chList' => $chList,
			'json_ch' => json_encode($chList),
			'videoList' => $videoList,
		));
		$this->display($template);
	}
	
	/**
	 * 幼教--课时列表
	 */
	public function preschoolAct(){
		$template = 'detail_preschool';
		$class = 'big'; //哪个班
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
				'class' => $class,
				'videoList' => $videoList,
				'specialList' => $specialList,
		));
		$this->display($template);
	}
	
	/**
	 * 小学--课时列表
	 */
	public function primaryschoolAct(){
		$template = 'detail_primaryschool';
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
		$this->display($template);
	}
	
	/**
	 * 一周课程--课时列表
	 */
	public function weekAct(){
		$class = 'big';
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
				'class' => $class,
				'videoList' => $videoList,
		));
		$this->display();
	}
	
}