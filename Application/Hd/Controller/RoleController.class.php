<?php

/**
 * 控制器：角色
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class RoleController extends CommonController {
	
	/**
	 * 创建角色
	 */
	public function createRoleAct(){
		$stageId = I('stageId','');
		if(empty($stageId)){
			//顶级分类(二级栏目)
			$class = $this->getClass();	
			//龄段
			$stage = S('Stage');
			foreach ($stage as $k=>$v){
				$data[$class[$v['chId']]['chKey']][$v['id']] = $v;
			}
			$info['stage'] = $data;
			if($this->role['stageId'] == 99) $info['role'] = $this->role;
			$this->assign($info);
		}else{
			$role = array('id'=>I('id',''),'stageId'=>$stageId,'userId'=>$this->user['id'],'status'=>1);
			$r = D('Role','Logic')->save($role);
			if($r['status']){ //创建成功跳转至首页
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Index/recommend'));
			}else{
				$this->showMessage('角色创建失败：'.$r['info']);
			}
		}
		$this->display();
	}
	
	/*
	 * 用户信息模块
	 */
	public function userInfoAct()
	{	
		$id = I('id','');
		$user = unserialize(Session('user'));
		$role = unserialize(Session('role'));
		
		$channel = $this->initUserCenterChannel();
		$json_encode = json_encode($channel);
	
		if(empty($id))
		{
			$face = (empty($role['face'])) ? '0' : $role['face'];
			$userInfo = $this->getUserInfo($role);
			$this->assign(array(
				'userInfo' => $userInfo,
				'face' => $face,
				'channels' => $channel,
				'json_channel' => $json_encode,
				'roleId' => $role['id'],
    		));
		}
		else 
		{
			
		}
		$this->display();
	}
	
	private function getUserInfo($role){
		$user = unserialize(Session('user'));
		//龄段
		$stage = S('Stage');
		$interests = explode(",", $role['interests']);
		if(empty($role['interests']))
		{
			$interests = array('去设置');
		}
		$advantages = explode(",", $role['advantage']);
		if(empty($role['advantage']))
		{
			$advantages = array('去设置');
		}
		$disadvantages = explode(",", $role['disAdvantage']);
		if(empty($role['disAdvantage']))
		{
			$disadvantages = array('去设置');
		}
		$phone = (empty($user['phone'])) ?'去设置' : $user['phone'];
			
		/* 性别 */
		$sex=( (empty($role['sex'])) ? ('去设置') :( ($role['sex']=='1') ? '男' : '女') );
			
		
		$userInfo = array(
				/*学号*/
/* 				array(
						'name' => 'num',
						'content' => array($role['id']),
				), */
				/*昵称*/
				array(
						'name' => 'nickname',
						'content' => array($role['nickName']),
						'linkUrl' => '/Hd/Role/setNickname',
				),
				/*性别*/
				array(
						'name' => 'sex',
						'content' => array($sex),
						'linkUrl' => '/Hd/Role/setSex',
				),
				/*生日*/
				array(
						'name' => 'birthday',
						'content' => array($role['birthday']),
						'linkUrl' => '/Hd/Role/setBirthday',
				),
				/*年级*/
				array(
						'name' => 'stage',
						'content' => array($stage[$role['stageId']]['name']),
						'linkUrl' => '/Hd/Role/changeStage',
				),
				/*手机*/
				array(
						'name' => 'phone',
						'content' => array($phone),
						'linkUrl' => '/Hd/Role/setPhone',
				),
				/*版本*/
				array(
						'name' => 'version',
						'content' => array(''),
				),
				/*强项*/
				array(
						'name' => 'advantage',
						'content' => $advantages,
						'linkUrl' => '/Hd/Role/setMulchoice?type=advantage',
				),
				/*弱项*/
				array(
						'name' => 'disadvantage',
						'content' => $disadvantages,
						'linkUrl' => '/Hd/Role/setMulchoice?type=disAdvantage',
				),
				/*兴趣*/
				array(
						'name' => 'interests',
						'content' => $interests,
						'linkUrl' => '/Hd/Role/setMulchoice?type=interests',
				),
		);
		return $userInfo;
	}
	
	/*
	 * 改变年级
	 */
	public function changeStageAct()
	{
		$stageId = I('stageId','');
		$role = unserialize(Session('role'));
		if(empty($stageId))
		{
			//顶级分类(二级栏目)
			$class = $this->getClass();
			//龄段
			$stage = S('Stage');
			foreach ($stage as $k=>$v){
				$data[$class[$v['chId']]['chKey']][$v['id']] = $v;
			}
			$this->assign(array('stage' => $data));
			$this->display();
		}
		else 
		{
			if($stageId == 99)//此时为不设置，跳过选项
			{
				header('location:'.U('Role/userInfo'));
				return;
			}
			$role['stageId'] = $stageId;
			$r = D('Role','Logic')->save($role);
			if($r['status']){
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('昵称更新失败：'.$r['info']);
			}
		}
	}
	
	/*
	 * 设置昵称
	 */
	public function setNicknameAct()
	{
		$role = unserialize(Session('role'));
		if(!IS_POST)
		{
			$this->display();
		}
		else
		{
			$data = I('post.');
			$role['nickName'] = $data['nickname'];
			$r = D('Role','Logic')->save($role);
			if($r['status']){ 
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('昵称更新失败：'.$r['info']);
			}
		}
	}
	/*
	 * 设置手机号码
	 */
	public function setPhoneAct()
	{
		$user = unserialize(Session('user'));
		if(!IS_POST)
		{
			$this->display();
		}
		else
		{
			$data = I('post.');
			$user['phone'] = $data['phone'];
			$u = D('User','Logic')->save($user);
			if($u['status']){ 
				Session('user',serialize($user));//更新sessions
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('昵称更新失败：'.$u['info']);
			}
		}
	}
	/*
	 * 设置性别
	*/
	public function setSexAct()
	{
		$role = unserialize(Session('role'));
		if(!IS_POST)
		{
			$json_sex = json_encode(array('sex'=>$role['sex']));
			$this->assign(array(
    			'json_sex'	=> $json_sex,
	
    		));
			$this->display();
		}
		else
		{
			$data = I('post.');
			$role['sex'] = $data['sex'];
			$r = D('Role','Logic')->save($role);
			if($r['status']){ 
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('性别修改失败：'.$r['info']);
			}
		}
	}
	/*
	 * 多选项;用户中心所有属于多选操作的调用此控制器
	*/
	public function setMulchoiceAct()
	{
		$role = unserialize(Session('role'));
		$proConf = get_pro_config_content('proConfig');
		$subject = $proConf['subject'];
		//$interest = $proConf['interest']; //TODO 兴趣和科目配置分开
		if(!IS_POST)
		{
			$type = I('type');
			if($type == 'advantage')
			{
				$subject = $proConf['subject'];
				$subject_remove = explode(",", $role['disAdvantage']);
				$subject_array = explode(",", $role['advantage']);
			}
			if($type == 'disAdvantage')
			{
				$subject = $proConf['subject'];
				$subject_remove = explode(",", $role['advantage']);
				$subject_array = explode(",", $role['disAdvantage']);
			}
			if($type == 'interests')
			{
				$subject = $proConf['interest'];
				$subject_remove = null;
				$subject_array = explode(",", $role['interests']);
			}
			$index = 0;
			foreach ($subject as $key => $value)//获得将来要显示的多选项
			{
				if(empty($subject_remove))
				{
					$index++;
					$subject_display['subject_'.$index] = $key;
				}
				else 
				{
					if(!in_array($value, $subject_remove))
					{
						$index++;
						$subject_display['subject_'.$index] = $key;
					}
				}
			}
			//获得被选中项
			foreach($subject_array as $key => $value)
			{
				foreach ($subject as $key1 => $value1)
				{
					if($value == $value1)//此项被选中
					{
						foreach($subject_display as $key2 => $value2)
						{
							if($key1 == $value2)
							{
								$subject_selected[$key2] = $value2;
							}
						}
					}
				}
			}
			$isEmpty = empty($subject_display) ? 1 : 0;
			$this->assign(array(
					'json_selected'	=> json_encode($subject_selected),
					'subjects' => $subject_display,
					'isEmpty' => $isEmpty,
					'subjects_json' => json_encode($subject_display),
					'count_sub' => count($subject_display),
					'type' => $type,
			));
			$this->display();
		}
		else
		{
			$data = I('post.');
			foreach ($data as $key => $value)//分离出选中项
			{
				if($value && $key!='type')
				{
					$subject_selected[] = $subject[$value];
				}
			}
			$sub = implode(",", $subject_selected);//转换为文字存入数据库
			$role[$data['type']] = $sub;
			$r = D('Role','Logic')->save($role);
			if($r['status']){ 
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('兴趣修改失败：'.$r['info']);
			}
		}
	}
	
	
	/*
	 * 设置生日
	*/
	public function setBirthdayAct()
	{
		$role = unserialize(Session('role'));
		$roleId = $role['id'];
		if(!IS_POST)
		{
			$this->display();
		}
		else
		{
			$data = I('post.');
			$date = implode("-", $data);
			$role['birthday'] = $date;
			$r = D('Role','Logic')->save($role);
			if($r['status']){
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('昵称更新失败：'.$r['info']);
			}
		}
	}
	
	/*
	 * 选择头像
	 */
	public function selectFaceAct()
	{
		$role = unserialize(Session('role'));
		if(!IS_POST)
		{
			$face = (empty($role['face'])) ? '0' : $role['face'];
			$this->assign(array(
					'face' => $face,
			));
			$this->display();
		}
		else
		{
			$data = I('post.');
			foreach ($data as $key => $value)
			{
				if(!empty($value))
				{
					$role['face'] = $value;
					break;
				}
			}
			$r = D('Role','Logic')->save($role);
			if($r['status']){
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('头像更新失败：'.$r['info']);
			}
		}
	}
	
	/*
	 * 切换账号
	 */
	public function changeNumAct()
	{	
		$role = unserialize(Session('role'));
		$user = unserialize(Session('user'));
		$stage = S('Stage');
		if(!IS_POST)
		{
			$page = I('page','');
			$roleList = Session('roleList');
			$roleList = array_values($roleList);//建立数字索引
			$page = empty($page) ? 0 : $page;
			for($i=$page*3; ($i<$page*3+4)&&($i<count($roleList)); $i++)
			{
				$list[$i-$page*3]['id'] = $roleList[$i]['id'];
				$list[$i-$page*3]['name'] = empty($roleList[$i]['nickName']) ? $roleList[$i]['id'] : $roleList[$i]['nickName'];
				$list[$i-$page*3]['stage'] = $stage[$roleList[$i]['stageId']]['sKey'];
				$list[$i-$page*3]['face'] = $roleList[$i]['face'];
			}
			$count = count($list);
			if($count < 4)
			{
				$list[$count]['id'] = '';
				$list[$count]['name'] = '';
				$list[$count]['stage'] = '';
				$list[$count]['face'] = 'add';
			}

			
			$left = ($page==0) ? 0 : 1;//可以向左移动则显示左号
			$right = (($page+1)*3<count($roleList)) ? 1 : 0;
			
			$this->assign(array(
						'lists' => $list,
						'json_lists' => json_encode($list),
						'leftDir' => $left,
						'rightDir' => $right,
						'page' => $page,
						'count' => count($list),
					));
			$this->display();
		}
		else
		{
			$data = I('post.');
			foreach ($data as $key => $value)
			{
				if(!empty($value))
				{
					$user['usedRoleID'] = $value;
					break;
				}
			}
			$u = D('User','Logic')->save($user);
			if($u['status']){
				Session('user',serialize($user));//更新user对应的session
				$roleList = Session('roleList');
				Session('role',serialize($roleList[$user['usedRoleID']]));//更新role对应的session
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('角色切换失败：'.$u['info']);
			}
		}
	}
	
	/*
	 * 成长指标
	 */
	public function growthIndexAct()
	{
		$role = unserialize(Session('role'));
		$birthday=$role['birthday'];
		$data = monthNum($birthday);
		$m = $data['data']['monthNum'];
		//确保月份在1-12
		if($m<=0)
		{
			$m = 1;
		}elseif ($m > 12)
		{
			$m = 12;
		}
		$this->assign(array(
					'm' => $m,
				));
		$this->display();
	}
	
	
	/**
	 * 加入学习计划
	 */
	public function addCourseAct(){
		$courseId = I('courseId','');
		$courseName = I('courseName','');
		$courseImg = I('courseImg','');
		$r = D('RoleCourse','Logic')->addCourse($this->role['id'],$courseId,$courseName,$courseImg);
		if($r['status']){
			$this->addFloatMessage("加入学习计划成功！",U('SectionList/index?courseId='.$courseId));
		}else{
			$this->addFloatMessage($r['info'],U('SectionList/index?courseId='.$courseId));
		}
	}
	
	/**
	 * 初始化用户中心channel
	 */
	private function initUserCenterChannel(){
		$channel = S('Channel');
		$topChannel = get_array_for_fieldval($channel, 'chKey','usercenter');
		$topChannel = array_slice($topChannel,0,count($topChannel));
		$id = $topChannel[0]['id'];
		$channel = get_array_for_fieldval($channel, 'pId',$id);
		$channel = get_array_for_fieldval($channel,'isShow','1');
		
		//角色信息，根据角色不同龄段推荐不同的课程
		$stage = $this->getStage($this->role['stageId']);
		$grade = $this->getGrade($stage['chId']);
		//因为学习评价有两种，所以此处匹配
		foreach($channel as $key => $value)
		{
			if($value['chKey'] == 'learning')
			{
				if($grade['chKey']=='early' || $grade['chKey']=='preschool')
				{
					$channel[$key]['linkUrl'] = '/Hd/Learning/learningEarly?arrange=month';
				}
				else 
				{
					$channel[$key]['linkUrl'] = '/Hd/Learning/learningPreschool';
				}
			}
		}
		//把栏目的图片数组拆开
		foreach ($channel as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$channel[$k]['linkImage']  = get_upfile_url(trim($imgs[0]));
				$channel[$k]['focusImage'] = get_upfile_url(trim($imgs[1]));
				//				$userCenter[$k]['titleImage'] = get_upfile_url(trim($imgs[2]));
			}
		}
	
		//把栏目key值初始为从0开始的递增的值，前端按钮调用统一
		$channel = array_slice($channel,0,count($channel));
		$channel = get_array_fieldkey($channel,array('id','name','linkImage','focusImage','linkUrl'));
		return $channel;
	}
	
}