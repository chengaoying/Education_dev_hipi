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
		
		//角色信息，根据角色年级推荐不同的课程
		$stage = $this->getStage($this->role['stageId']);
		$grade = $this->getGrade($stage['chId']);
		
		switch ($grade['chKey']){
			case 'early': //早教
				$this->earlyRecommend();
				break;
			case 'preschool': //幼教
				$this->preschoolRecommend();
				break;
			default: //其他年级
				$this->commonRecommend();
				break;
		}
	}
	
	/**
	 * 早教推荐:
	 * 根据角色月龄来推荐
	 */
	private function earlyRecommend(){
		
		$m = monthNum($this->role['birthday']);
		$roleMonthNum = $m['status']?$m['data']['monthNum']:0;
		
		$proConfig = get_pro_config_content('proConfig');
		//特别推荐（该课程需要有海报图片）
		$k1 = array_search('特别推荐一',$proConfig['keys']);
		$k2 = array_search('特别推荐二',$proConfig['keys']);
		$c = D('Course','Logic')->queryCourseListByKeys($this->role['stageId'],array($k1,$k2),1,5);
		$c = $c['rows'];
		foreach ($c as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$c[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
				$c[$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
			if(strchr($v['keys'], strval($k1))) $c1 = $c[$k];//特别推荐课程一
			if(strchr($v['keys'], strval($k2))) $c2 = $c[$k];//特别推荐课程二
		}
		//一般推荐课程
		$roleStage = $this->getStage($this->role['stageId']); //该角色对应的龄段信息
		$roleGrade = $this->getGrade($roleStage['chId']);//该角色对应的年级信息
		//判断该角色的年级是不是在早教或幼教阶段
		//早、幼教首页是1个成长指标+3个一般推荐
		//小学以上首页是4个一般推荐，
		$key = array_search('一般推荐',$proConfig['keys']);
		if(in_array($roleGrade['chKey'], array('early','preschool'))){
			$isEarly = true;
			$target['stageKey'] = $roleStage['sKey'];
			$target['linkUrl']  = U("Role/growthIndex");
			$courses = D('Course','Logic')->queryCourseListByKeys($this->role['stageId'],array($key),1,3);
		}else{
			$courses = D('Course','Logic')->queryCourseListByKeys($this->role['stageId'],array($key),1,4);
			$target = $courses[0];
			$courses = array_slice($courses, 1, count($courses)-1);
		}
		foreach ($courses['rows'] as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$courses['rows'][$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
				$courses['rows'][$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}
		
		$this->assign(array(
			'json_channel'	=> $json_channel,
			'topChannel' 	=> $this->topChannel,
			'role'			=> $this->role,
			'c1'			=> $c1,
			'c2'			=> $c2,
			'courses'		=> $courses['rows'],
			'isEarly'		=> $isEarly,
			'target'		=> $target,
		));
		$this->display();
	}
	
	/* 幼教推荐 */
	private function preschoolRecommend(){
		
	}
	
	/* 其他通用推荐 */
	private function commonRecommend(){
		
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
		
		$myCourse = D('Course','Logic')->queryUserCourseList($this->user['id'], 1, 10);
		foreach ($myCourse['rows'] as $k=>$v){
			if($v['courseImg']){
				$char = getDelimiterInStr($v['courseImg']);
				$imgs = explode($char, $v['courseImg']);
				$myCourse['rows'][$k]['courseImg']  = get_upfile_url(trim($imgs[0]));
				$myCourse['rows'][$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}
		
		$this->assign(array(
			'json_channel'	=> $json_channel,
			'topChannel' 	=> $this->topChannel,
			'myCourse'      => $myCourse['rows'],
		));
		$this->display();
	}
	
}