<?php

/**
 * 控制器：首页
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class IndexController extends CommonController {
	
	public function indexAct(){
		//欢迎页，如果有跳转至欢迎页
		
		//检查用户是否有角色帐号，没有则跳转至创建角色页面
		//有则使用用户最近使用的角色帐号进入产品首页(推荐课程页)
		$roleList = Session('roleList');
		if(count($roleList) < 1){
			header('location:'.U('Role/createRole'));
		}else{
			header('location:'.U('Index/recommend'));
		}
		exit;
		//$this->display();
	}
	
	/**
	 * 欢迎页
	 */
	public function wecomeAct(){}
	
	/**
	 * 推荐课程首页
	 */
	public function recommendAct(){
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
		
		//最近观看记录
		$record[0] = array('id'=>1,name=>'test');
		$record[1] = array('id'=>2,name=>'test2');
		$record[2] = array('id'=>3,name=>'test3');
		$json_record = json_encode($record);
		 
		$this->assign(array(
			'json_channel'	=> $json_channel,
			'topChannel' 	=> $this->topChannel,
			'left_ad'		=> $left_ad,
			'right_ad'		=> $right_ad,
			'bottom_ad'		=> $bottom_ad,
			'json_ad'		=> $json_ad,
			'record'		=> $record,
			'json_record'	=> $json_record,		
		));
		$this->display();
	}
	
	/**
	 * 全部课程首页
	 */
	public function allCourseAct(){
		//栏目数据json格式-前端js使用
		$json_channel = get_array_fieldkey($this->topChannel,array('id','name','linkImage','focusImage'));
		$json_channel = json_encode($json_channel);
		 
		//一级分类（二级栏目）
		$class = $this->getClass();
		$json_class = get_array_fieldkey(array_slice($class,0,count($class)),array('id','name','chKey','imgUrl','linkUrl'));
		$json_class = json_encode($json_class);
		
		$this->assign(array(
			'json_channel'	=> $json_channel,
			'topChannel' 	=> $this->topChannel,
			'class'			=> $class,
			'json_class'	=> $json_class,
		));
		$this->display();
	}
	
	/**
	 * 我的课程首页
	 */
	public function myCourseAct(){
		//栏目数据json格式-前端js使用
		$json_channel = get_array_fieldkey($this->topChannel,array('id','name','linkImage','focusImage'));
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
	
	
}