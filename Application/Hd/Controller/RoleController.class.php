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
		
		$roleList = Session('roleList');
		if(count($roleList) >= 10)
		{
			$this->addFloatMessage('您创建的角色超过10个！',U('Role/changeNum'));
		}
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
				D('Role','Logic')->changeRole($r['data']['id']);//改变当前角色
				
				$stage = $this->getStage($role['stageId']);//根据stageId得到段龄信息；
				$grade = $this->getGrade($stage['chId']);//得到学生信息，如早教，小学，幼教，高中，初中
				if($grade['chKey'] === 'early')
				{
					$this->addFloatMessage('创建角色成功',U('Role/setBirthday'));
				}
				else
				{
					$this->addFloatMessage('创建角色成功',U('Role/userInfo'));
				}
			}else{
				$this->addFloatMessage('角色创建失败：'.$r['info'],U('Role/userInfo'));
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
			
			$focus = $this->getFocus();//获得焦点位置
			$this->assign(array(
				'userInfo' => $userInfo,
				'face' => $face,
				'channels' => $channel,
				'json_channel' => $json_encode,
				'roleId' => $role['id'],
				'focus' => $focus,
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
		$nickName = empty($role['nickName']) ? '去设置' : $role['nickName'];	
		$birthday = empty($role['birthday']) ? '去设置' : $role['birthday'];	
		
		$userInfo = array(
				/*学号*/
/* 				array(
						'name' => 'num',
						'content' => array($role['id']),
				), */
				/*昵称*/
				array(
						'name' => 'nickname',
						'content' => array($nickName),
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
						'content' => array($birthday),
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
/* 				array(
						'name' => 'version',
						'content' => array(''),
				), */
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
	
	/*获取上个页面操作名
	 * 
	 */
	private function getFocus()
	{
		$baseInfo = 'ch_3';//在http_refferr中没有focuse参数时的默认焦点
 		$url = HTTP_REFERER;//上页面索引，根据focus值得到默认焦点
 		//得到开始坐标
 		$startPos = strpos($url,'focus');
 		if($startPos===false) return $baseInfo;
 		$startPos += 6;
 		//得到结束坐标
 		$endPos1 = strpos($url, '&', $startPos);
 		$endPos2 = strpos($url, '/', $startPos);
 		$endPos = $endPos1 || $endPos2;
 		$endPos = $endPos===false ? strlen($url) : $endPos;
 		//得到长度
 		$len = $endPos - $startPos;
 		//得到focus
 		$act = substr($url,$startPos,$len);
 		if($act === false) return $baseInfo;
 		return $act;
/*		$startPos = strpos($url,'/Role');
		if($startPos===false)
		{
			return $baseInfo;
		}
		$startPos += 6;
		$endPos = strpos($url,'?');
		$endPos = $endPos===false ? strlen($url) : $endPos;

		$len = $endPos - $startPos;//操作长度
		
		$act = substr($url,$startPos,$len);
		if($act === false) return $baseInfo;
		
		switch($act)
		{
			case 'setNickname':
				return 'nickname';
			case 'setSex':
				return 'sex';
			case 'setBirthday':
				return 'birthday';
			case 'changeStage':
				return 'stage';
			case 'setPhone':
				return 'phone';
			case 'setVersion':
				return 'version';
			case 'setMulchoice':
				
				break;
			case 'setAdvantage':
				return 'advantage';
			case 'setDisadvantage':
				return 'disadvantage';
			case 'setInterests':
				return 'interests';
			default:
				return $baseInfo;
		}
		 */
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
				
				$stage = $this->getStage($role['stageId']);//根据stageId得到段龄信息；
				$grade = $this->getGrade($stage['chId']);//得到学生信息，如早教，小学，幼教，高中，初中
				if($grade['chKey'] === 'early')
				{
					$this->addFloatMessage('修改龄段成功',U('Role/setBirthday'));
				}
				else 
				{
					$this->addFloatMessage('修改龄段成功',U('Role/userInfo'));
				}
				//header('location:'.U('Role/userInfo'));
			}else{
				$this->addFloatMessage('昵称更新失败：'.$r['info'],U('Role/userInfo'));
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
			$nickName = $role['nickName'];
			if(empty($nickName)) $nickName = '';
			$this->assign(array('nickName' => $nickName));
			$this->display();
		}
		else
		{
			$data = I('post.');
			$role['nickName'] = $data['nickname'];
			$r = D('Role','Logic')->save($role);
			if($r['status']){
				if($role['nickName'])
				{
					D('Credit','Logic') -> ruleIncOrDec($this->user['id'], $this->role['id'], 'nickname', '设置角色昵称');
				}
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				$this->addFloatMessage('修改昵称成功',U('Role/userInfo'));
				//header('location:'.U('Role/userInfo'));
			}else{
				$this->addFloatMessage('昵称更新失败：'.$r['info'],U('Role/userInfo'));
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
			$phone = $user['phone'];
			if(empty($phone)) $phone = '';
			$this->assign(array('phone' => $phone));
			$this->display();
		}
		else
		{
			$data = I('post.');
			$result = $this -> judgePhone($data['phone']);
			if(!$result['status'])
			{
/* 				echo '</br>';
				dump('结果为：'.$result['info']);exit; */
				$this->addFloatMessage($result['info'],U('Role/setPhone'));;
				return;
			}
			$user['phone'] = $data['phone'];
			$u = D('User','Logic')->save($user);
			if($u['status']){
				if($user['phone'])
				{
					D('Credit','Logic') -> ruleIncOrDec($this->user['id'], $this->role['id'], 'phone', '添加电话号码');
				}
				Session('user',serialize($user));//更新sessions
				$this->addFloatMessage('修改手机号成功',U('Role/userInfo'));
				//header('location:'.U('Role/userInfo'));
			}else{
				$this->addFloatMessage('昵称更新失败：'.$u['info'],U('Role/userInfo'));
			}
		}
	}
	
	private function judgePhone($phone)
	{
		if(!empty($phone)||$phone==='0')
		{
			if(!is_numeric($phone))
			{
				$info = '手机号应为数字';
				return result_data(0, $info);
			}
			if(strlen($phone) != 11)
			{
				$info = '手机号应为11位';
				return result_data(0, $info);
			}
		}
		return result_data(1, '操作成功');
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
				if($role['sex'])
				{
					D('Credit','Logic') -> ruleIncOrDec($this->user['id'], $this->role['id'], 'sex', '设置角色sex');
				}
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				$this->addFloatMessage('修改性别成功',U('Role/userInfo'));
				//header('location:'.U('Role/userInfo'));
			}else{
				$this->addFloatMessage('性别修改失败：'.$r['info'],U('Role/userInfo'));
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
		
		$type = I('type');
		if($type == 'advantage')
		{
			$subject = $proConf['subject'];
			$subject_remove = explode(",", $role['disAdvantage']);
			$subject_array = explode(",", $role['advantage']);
			$width_logo = 206;
		}
		if($type == 'disAdvantage')
		{
			$subject = $proConf['subject'];
			$subject_remove = explode(",", $role['advantage']);
			$subject_array = explode(",", $role['disAdvantage']);
			$width_logo = 206;
		}
		if($type == 'interests')
		{
			$subject = $proConf['interest'];
			$subject_remove = null;
			$subject_array = explode(",", $role['interests']);
			$width_logo = 143;
		}
		//$interest = $proConf['interest']; //TODO 兴趣和科目配置分开
		if(!IS_POST)
		{
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
					'width_logo' => $width_logo,
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
				if(count($data)>1)
				{
					D('Credit','Logic') -> ruleIncOrDec($this->user['id'], $this->role['id'], $data['type'], '设置角色'+$data['type']);
				}
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				$this->addFloatMessage('修改成功',U('Role/userInfo'));
				//header('location:'.U('Role/userInfo'));
			}else{
				$this->addFloatMessage('兴趣修改失败：'.$r['info'],U('Role/userInfo'));
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
		
		$stage = $this->getStage($this->role['stageId']);//根据stageId得到段龄信息；
		$grade = $this->getGrade($stage['chId']);//得到学生信息，如早教，小学，幼教，高中，初中
		$stageAge = $grade['chKey'];
		
		if(!IS_POST)
		{
			$birthday = $role['birthday'];
			$birthday_array = explode("-", $birthday);
			for($i=0; $i<3; $i++)//处理生日为空时，确保数组长度也为3，且为0
			{
				if(empty($birthday_array[$i])) 
				{
					$birthday_array[$i] = '';
				}
			}
			
			$this->assign(array(
				'birthday' => $birthday_array,
			)); 
			$this->display();
		}
		else
		{
			$data = I('post.');
			$date = implode("-", $data);
			if(strlen($date)>2)
			{
				$result = $this -> judgeDate($date,$stageAge);
				if(!$result['status'])
				{
					$this->addFloatMessage($result['info'],U('Role/setBirthday'));
					return;
				}
			}
			else 
			{
				$date = '';
			}
			$role['birthday'] = $date;
			$r = D('Role','Logic')->save($role);
			if($r['status']){
				if($role['birthday'])
				{
					D('Credit','Logic') -> ruleIncOrDec($this->user['id'], $this->role['id'], 'birthday', '设置角色birthday');
				}
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				
				//保存成功弹框
				if($stageAge==='early' && !empty($role['birthday']))//早教跳转到推荐页
				{
					$this->addFloatMessage('修改生日成功',U('Index/recommend'));
				}
				else 
				{
					$this->addFloatMessage('修改生日成功',U('Role/userInfo'));
				}
				
				//header('location:'.U('Role/userInfo'));
			}else{
				$this->addFloatMessage('昵称更新失败：'.$r['info'],U('Role/userInfo'));
			}
		}
	}
	
	private function judgeDate($birthday, $stageAge)
	{

		if(!empty($birthday))
		{
			$birthday_array = explode("-", $birthday);
			if(!empty($birthday_array[0])&&!is_numeric($birthday_array[0]) || !empty($birthday_array[1])&&!is_numeric($birthday_array[1]) || !empty($birthday_array[2])&&!is_numeric($birthday_array[2]))
			{
				$info = '日期不正确，日期应为数字';
				return result_data(0, $info);
			}
			
			$birthday_unix = strtotime($birthday);
			if($birthday_unix === false)
			{
				//$info = '日期不正确,日期范围应在1901-12-15<br/>到2038-1-19。如果年份为两位数字则: 0-69 <br/>表示 2000-2069,70-100 表示1970-2000';
				$info = '日期不正确，请重新输入';
				return result_data(0, $info);
			}
			
			$stage = $this->getStage($this->role['stageId']);//根据stageId得到段龄信息；
			$grade = $this->getGrade($stage['chId']);//得到学生信息，如早教，小学，幼教，高中，初中
			if($stageAge === 'early')
			{
				$monthAge = monthNum($birthday);
				if($monthAge['status'])
				{
					if($monthAge['data']['monthNum'] > 36)
					{
						return result_data(0, '你家小朋友不在该龄段</br>内哦，请返回选择其它龄段');
					}
				}
			}
		}
		return result_data(1, '输入成功');
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
				$this->addFloatMessage('修改头像成功',U('Role/userInfo'));
				//header('location:'.U('Role/userInfo'));
			}else{
				$this->addFloatMessage('头像更新失败：'.$r['info'],U('Role/userInfo'));
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
			$pageSize = 4;//每页显示数目
			for($i=$page*$pageSize; ($i<$page*$pageSize+$pageSize)&&($i<count($roleList)); $i++)
			{
				$list[$i-$page*$pageSize]['id'] = $roleList[$i]['id'];
				$list[$i-$page*$pageSize]['name'] = empty($roleList[$i]['nickName']) ? $roleList[$i]['id'] : $roleList[$i]['nickName'];
				$list[$i-$page*$pageSize]['stage'] = $stage[$roleList[$i]['stageId']]['sKey'];
				$list[$i-$page*$pageSize]['face'] = $roleList[$i]['face'];
			}
			$count = count($list);
			if($count < $pageSize)
			{
				$list[$count]['id'] = '';
				$list[$count]['name'] = '';
				$list[$count]['stage'] = '';
				$list[$count]['face'] = 'add';
			}
			
			$left = ($page==0) ? 0 : 1;//可以向左移动则显示左号
			$right = (($page+1)*$pageSize<count($roleList)) ? 1 : 0;
			
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
			
			$r = D('Role','Logic')->changeRole($user['usedRoleID']);
			if($r['status']){
				$this->addFloatMessage('角色切换成功',U('Role/userInfo'));
			}else{
				$this->addFloatMessage('角色切换失败：'.$r['info'],U('Role/userInfo'));
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
		
		if($data['status'])
		{
			$m = $data['data']['monthNum'];
		}
		else 
		{
			$this->showMessage('月份获取失败：'.$data['info']);
		}
		
		//确保月份在1-12
		if($m<=0)
		{
			$m = 1;
		}elseif ($m > 12)
		{
			$m = 12;
		}
		$this->assign(array(
					'm' => 1,
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
		
		//处理焦点
		$url = HTTP_REFERER; 
		if(strpos($url, '?'))
			$url .= '&focus=btn_plan';
		else 
			$url .= '?focus=btn_plan';
		
		if($r['status']){
			$this->addFloatMessage("加入学习计划成功！",$url);
		}else{
			$this->addFloatMessage($r['info'],$url);
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
					$channel[$key]['linkUrl'] = '/Hd/Learning/learningEarly?arrange=month&focus=ch_3';
				}
				else 
				{
					$channel[$key]['linkUrl'] = '/Hd/Learning/learningPreschool?focus=ch_3';
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
				$channel[$k]['titleImage'] = get_upfile_url(trim($imgs[2]));
			}
		}
	
		//把栏目key值初始为从0开始的递增的值，前端按钮调用统一
		$channel = array_slice($channel,0,count($channel));
		$channel = get_array_fieldkey($channel,array('id','name','linkImage','focusImage','titleImage','linkUrl'));
		return $channel;
	}
	
}