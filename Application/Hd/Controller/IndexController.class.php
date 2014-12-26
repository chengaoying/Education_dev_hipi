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
		
		//角色信息
		$role = unserialize(Session('role'));
		 
		//左上角广告
		$left_ad   = $this->getAdByasKey('recommend_left');
		
		//中间两个课程(关键字为首页的课程)
		$proConfig = get_pro_config_content('proConfig');
		$index = array_search('首页',$proConfig['keys']);
		$courses1 = D('Course','Logic')->queryCourseListByKeys($role['stageId'],$index,1,2);
		
		//右侧推荐课程(关键字为推荐的课程)
		$key = array_search('推荐',$proConfig['keys']);
		$courses2 = D('Course','Logic')->queryCourseListByKeys($role['stageId'],$key,1,6);
		
		//最近观看记录
		$record[0] = array('id'=>1,name=>'test');
		$record[1] = array('id'=>2,name=>'test2');
		$record[2] = array('id'=>3,name=>'test3');
		 
		$this->assign(array(
			'json_channel'	=> $json_channel,
			'topChannel' 	=> $this->topChannel,
			'role'			=> $role,	
			'left_ad'		=> $left_ad,
			'courses1'		=> $courses1,
			'courses2'		=> $courses2,
			'record'		=> $record,
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
		
		$this->assign(array(
			'json_channel'	=> $json_channel,
			'topChannel' 	=> $this->topChannel,
			'myCourse'      => $this->getCourseList(),
		));
		$this->display();
	}
	
	/* 测试--课程列表 */
	private function getCourseList(){
		$courseList = array();
		for($i=0; $i< 10; $i++){
			$courseList[$i]['id'] = $i;
			$courseList[$i]['chId'] = 19;
			$courseList[$i]['stageIds'] = 7;
			$courseList[$i]['name'] = 'test';
			$courseList[$i]['imgUrl'] = get_upfile_url('__HD__/images/index/myCourse/a.jpg');
		}
		return $courseList;
	}
	
}