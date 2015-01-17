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
		
		//检查用户是否有角色帐号或者用户只用一个角色，但该角色为游客，则跳转至创建角色页面(选择龄段页面)
		//其他情况则让用户使用最后一次使用的角色帐号进入产品首页(推荐课程页)
		$roleList = Session('roleList');
		if((empty($roleList)) || (count($roleList) == 1 && $this->role['stageId'] == 99)){
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
	public function welcomeAct(){}
	
	/**
	 * 推荐课程首页
	 */
	public function recommendAct(){
		//栏目数据json格式-前端js使用
		$json_channel = get_array_fieldkey($this->topChannel,array('id','name','linkImage','focusImage','titleImage'));
		$json_channel = json_encode($json_channel);
		//角色信息，根据角色不同龄段推荐不同的课程
		$stage = $this->getStage($this->role['stageId']);
		$grade = $this->getGrade($stage['chId']);
		
		$data['json_channel'] = $json_channel;
		$data['topChannel']   = $this->topChannel;
		$data['role']		  = $this->role;
		$data['focus']		  = I('focus','');
		if($this->role['stageId'] == 99){ //游客
			$this->touristRecommend($data);
		}else{//有帐号
			switch ($grade['chKey']){
				case 'early': //早教
					//计算角色月龄
					//如果角色没有设置出生年月，则默认月龄为1个月
					$m = monthNum($this->role['birthday']);
					$roleMonthNum = $m['status'] ? $m['data']['monthNum'] : 1;
					$value = '.'.$roleMonthNum.'月'; //特别推荐一匹配的月龄
					$this->earlyOrPreschoolRecommend($data,$value);
					break;
				case 'preschool': //幼教
					$value = '第'.getCurrentWeek().'周'; //特别推荐一匹配的周数
					$this->earlyOrPreschoolRecommend($data,$value);
					break;
				default: //其他年级
					$this->commonRecommend($data);
					break;
			}
		}
		$this->assign($data);
		$this->display();
	}
	
	/**
	 * 游客推荐首页处理逻辑
	 * 课程推荐方式为随机推荐
	 * @param array $data 前端使用的数据
	 */
	private function touristRecommend(&$data){
		$proConfig = get_pro_config_content('proConfig');
		//随机推荐（该课程需要有海报图片）
		$k1 = array_search('特别推荐一',$proConfig['keys']);
		$k2 = array_search('特别推荐二',$proConfig['keys']);
		$k3 = array_search('一般推荐',$proConfig['keys']);
		$c = D('Course','Logic')->queryRandomRecommendCourse(array($k1,$k2,$k3));
		foreach ($c as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$c[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
				$c[$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}
		if(!empty($c[1])) $data['c1'] = $c[1];//特别推荐课程一
		if(!empty($c[2])) $data['c2'] = $c[2];//特别推荐课程二
		
		$data['target']  = $c[3][0];  //成长指标推荐位
		$data['courses'] = array_slice($c[3], 1, count($c[3])-1); //一般推荐课程推荐位
	}
	
	/**
	 * 早、幼教推荐:
	 * 早教根据角色月龄来推荐
	 * 幼教根据当前的周来推荐
	 * @param $data array 前端使用的数据
	 * @param $value int  特别推荐的匹配值（早教月龄，幼教周课程）
	 */
	private function earlyOrPreschoolRecommend(&$data,$value){
		$proConfig = get_pro_config_content('proConfig');
		//特别推荐（该课程需要有海报图片）
		$k1 = array_search('特别推荐一',$proConfig['keys']);
		$k2 = array_search('特别推荐二',$proConfig['keys']);
		$param = array($k1=>$value,$k2=>'');
		$c = D('Course','Logic')->queryRecommendCourse($this->role['stageId'],$param);
		foreach ($c as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$c[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
				$c[$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}
		if(!empty($c[1])) $data['c1'] = $c[1];//特别推荐课程一
		if(!empty($c[2])) $data['c2'] = $c[2];//特别推荐课程二
		
		//一般推荐课程
		//早、幼教首页是1个成长指标+3个一般推荐
		$roleStage = $this->getStage($this->role['stageId']); //该角色对应的龄段信息
		$roleGrade = $this->getGrade($roleStage['chId']);//该角色对应的年级信息
		$data['isEarly'] = true;
		$target['stageKey'] = $roleStage['sKey'];
		$target['linkUrl']  = U("Role/growthIndex");
		$key = array_search('一般推荐',$proConfig['keys']);
		$courses = D('Course','Logic')->queryCourseListByKeys($this->role['stageId'],array($key),1,3);
		$courses = $courses['rows'];
		foreach ($courses as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$courses[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
				$courses[$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}
		$data['target']  = $target;  //成长指标推荐位
		$data['courses'] = $courses; //一般推荐课程推荐位
	}
	
	/**
	 *  其他通用推荐
	 * @param $data array 前端使用的数据
	 */
	private function commonRecommend(&$data){
		$proConfig = get_pro_config_content('proConfig');
		//特别推荐（该课程需要有海报图片）
		$k1 = array_search('特别推荐一',$proConfig['keys']);
		$k2 = array_search('特别推荐二',$proConfig['keys']);
		$param = array($k1=>'',$k2=>'');
		$c = D('Course','Logic')->queryRecommendCourse($this->role['stageId'],$param);
		foreach ($c as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$c[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
				$c[$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}
		if(!empty($c[1])) $data['c1'] = $c[1];//特别推荐课程一
		if(!empty($c[2])) $data['c2'] = $c[2];//特别推荐课程二
		
		//一般推荐课程
		$roleStage = $this->getStage($this->role['stageId']); //该角色对应的龄段信息
		$roleGrade = $this->getGrade($roleStage['chId']);//该角色对应的年级信息
		//小学以上首页是4个一般推荐，
		$key = array_search('一般推荐',$proConfig['keys']);
		$courses = D('Course','Logic')->queryCourseListByKeys($this->role['stageId'],array($key),1,4);
		$courses = $courses['rows'];
		$target = $courses[0];
		$courses = array_slice($courses, 1, count($courses)-1);
		foreach ($courses as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$courses[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
				$courses[$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}
		$data['target']  = $target;  //成长指标推荐位
		$data['courses'] = $courses; //一般推荐课程推荐位
	} 
	
	/**
	 * 全部课程首页
	 */
	public function allCourseAct(){
		//栏目数据json格式-前端js使用
		$json_channel = get_array_fieldkey($this->topChannel,array('id','name','linkImage','focusImage','titleImage'));
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
			'focus'			=> I('focus',''),
		));
		$this->display();
	}
	
	/**
	 * 我的课程首页
	 */
	public function myCourseAct(){
		$page 	  = I('page',1);
		$pageSize = 10;
		
		//栏目数据json格式-前端js使用
		$json_channel = get_array_fieldkey($this->topChannel,array('id','name','linkImage','focusImage','titleImage'));
		$json_channel = json_encode($json_channel);
		
		$myCourse = D('RoleCourse','Logic')->queryRoleCourseList($this->role['id'], $page, $pageSize);
		foreach ($myCourse['rows'] as $k=>$v){
			if($v['courseImg']){
				$char = getDelimiterInStr($v['courseImg']);
				$imgs = explode($char, $v['courseImg']);
				$myCourse['rows'][$k]['courseImg']  = get_upfile_url(trim($imgs[0]));
				$myCourse['rows'][$k]['banner']  = get_upfile_url(trim($imgs[1]));
			}
		}
		
		//计算总页数
		$pageCount = intval($myCourse['total']/$pageSize);
		$pageCount = $myCourse['total']%$pageSize>0 ? $pageCount+1 : $pageCount;
		
		$this->assign(array(
			'json_channel'	=> $json_channel,
			'topChannel' 	=> $this->topChannel,
			'myCourse'      => $myCourse['rows'],
			'page'		    => $page,
			'pageCount'	    => $pageCount,
			'focus'			=> I('focus',''),	
		));
		$this->display();
	}
	
}