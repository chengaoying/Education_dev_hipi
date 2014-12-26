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
		$id = I('id','');
		$user = unserialize(Session('user'));
		if(empty($id)){
			//顶级分类(二级栏目)
			$class = $this->getClass();	
			//龄段
			$stage = S('Stage');
			foreach ($stage as $k=>$v){
				$data[$class[$v['chId']]['chKey']][$v['id']] = $v;
			}
			$this->assign(array('stage' => $data));
		}else{
			$role = array('stageId'=>$id,'userId'=>$user['id'],'status'=>1);
			$r = D('Role','Logic')->save($role);
			if($r['status']){ //创建成功跳转至首页
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				D('Role','Logic')->changeRole($r['data']['id']);//改变当前角色
				header('location:'.U('Index/index'));
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
	{	//protected $fileType = array(1=>'image',2=>'J2ME',3=>'Other');
		$id = I('id','');
		$user = unserialize(Session('user'));
		$role = unserialize(Session('role'));
		$stage = S('Stage');
	
		if(empty($id))
		{
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
						array(
								'name' => 'num',
								'content' => array($role['id']),
							),
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
								'linkUrl' => '/Hd/Role/setAdvantage',
							),
						/*弱项*/
						array(
								'name' => 'disadvantage',
								'content' => $disadvantages,
								'linkUrl' => '/Hd/Role/setDisadvantage',
							),
						/*兴趣*/
						array(
								'name' => 'interests',
								'content' => $interests,
								'linkUrl' => '/Hd/Role/setInterests',
							),
					);
			$face = (empty($role['face'])) ? '0' : $role['face'];
			$this->assign(array(
				'userInfo' => $userInfo,
				'face' => $face,
    		));
		}
		else 
		{
			
		}
		$this->display();
	}
	
	/*
	 * 改变年级
	 */
	public function changeStageAct()
	{
		$id = I('id','');
		$role = unserialize(Session('role'));
		if(empty($id))
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
			$role['stageId'] = $id;
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
		$roleId = $role['id'];
		if(!IS_POST)
		{
			$this->display();
		}
		else
		{
			$data = I('post.');
			$role_data = array('id'=>$roleId,'nickName'=>$data['nickname']);
			$r = D('Role','Logic')->save($role_data);
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
		$roleId = $role['id'];
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
			$role_data = array('id'=>$roleId,'sex'=>$data['sex']);
			$r = D('Role','Logic')->save($role_data);
			if($r['status']){ 
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('性别修改失败：'.$r['info']);
			}
		}
	}
	/*
	 * 设置兴趣
	*/
	public function setInterestsAct()
	{
		$role = unserialize(Session('role'));
		$roleId = $role['id'];
		
		$interestMap = array('music'=>'音乐','draw'=>'画画','handwriting'=>'书法','science'=>'科学','dance'=>'舞蹈'
				,'animation'=>'动漫','movie'=>'电影','writing'=>'写作','handwork'=>'手工'
		);
		if(!IS_POST)
		{
			$interest = array('music','draw','handwriting','science','dance','animation','movie','writing','handwork');
//			$this->interests=$interest;
			$interest_array = explode(",", $role['interests']);
			foreach($interest_array as $key => $value)
			{
				foreach ($interestMap as $key1 => $value1)
				{
					if($value == $value1)
					{
						$interest_data[$key1] = $key1;
					}
				}
			}
//			$this->json_interest = json_encode($interest_data);
			$this->assign(array(
					'json_interest'	=> json_encode($interest_data),
					'interests' => $interest,
			
			));
			$this->display();
		}
		else
		{
			$data = I('post.');
			foreach ($data as $key => $value)
			{
				if($value)
				{
					$interests[] = $interestMap[$key];
				}
			}
			$interests_string = implode(",", $interests);
			$role_data = array('id'=>$roleId,'interests'=>$interests_string);
			$r = D('Role','Logic')->save($role_data);
			if($r['status']){ 
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('兴趣修改失败：'.$r['info']);
			}
		}
	}
	/*
	 * 设置强项
	*/
	public function setAdvantageAct()
	{
		$role = unserialize(Session('role'));
		$roleId = $role['id'];
		$proConf = get_pro_config_content('proConfig');
		$subject = $proConf['subject'];
		
		$subjectMap = array('music'=>'音乐','draw'=>'美术','handwriting'=>'书法','science'=>'科学','dance'=>'舞蹈'
				,'animation'=>'动漫','movie'=>'电影','writing'=>'写作','handwork'=>'手工','math'=>'数学'
				,'chinese'=>'语文','english' => '英语'
		);
		
		if(!IS_POST)
		{
			foreach ($subjectMap as $key => $value)
			{
				if(in_array($value, $subject))
				{
					$subjectData[] = $key;
				}
			}
			
			$advantage_array = explode(",", $role['advantage']);
			foreach($advantage_array as $key => $value)
			{
				foreach ($subjectMap as $key1 => $value1)
				{
					if($value == $value1)
					{
						$advantage_data[$key1] = $key1;
					}
				}
			}
			$this->assign(array(
					'json_subjects'	=> json_encode($advantage_data),
					'subjects' => $subjectData,
			));
			$this->display();
		}
		else
		{
			$data = I('post.');
			foreach ($data as $key => $value)
			{
				if($value)
				{
					$advantage[] = $subjectMap[$key];
				}
			}
			$advantage_string = implode(",", $advantage);
			$role_data = array('id'=>$roleId,'advantage'=>$advantage_string);
			$r = D('Role','Logic')->save($role_data);
			if($r['status']){ 
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('强项修改失败：'.$r['info']);
			}
		}
	}
	/*
	 * 设置弱项
	*/
	public function setDisadvantageAct()
	{
		$role = unserialize(Session('role'));
		$roleId = $role['id'];
		$proConf = get_pro_config_content('proConfig');
		$subject = $proConf['subject'];
		
		$subjectMap = array('music'=>'音乐','draw'=>'美术','handwriting'=>'书法','science'=>'科学','dance'=>'舞蹈'
				,'animation'=>'动漫','movie'=>'电影','writing'=>'写作','handwork'=>'手工','math'=>'数学'
				,'chinese'=>'语文','english' => '英语'
		);
		
		if(!IS_POST)
		{
			foreach ($subjectMap as $key => $value)
			{
				if(in_array($value, $subject))
				{
					$subjectData[] = $key;
				}
			}
			
			$disadvantage_array = explode(",", $role['disAdvantage']);
			foreach($disadvantage_array as $key => $value)
			{
				foreach ($subjectMap as $key1 => $value1)
				{
					if($value == $value1)
					{
						$disadvantage_data[$key1] = $key1;
					}
				}
			}
			$this->assign(array(
					'json_subjects'	=> json_encode($disadvantage_data),
					'subjects' => $subjectData,
			));
			$this->display();
		}
		else
		{
			$data = I('post.');
			foreach ($data as $key => $value)
			{
				if($value)
				{
					$disadvantage[] = $subjectMap[$key];
				}
			}
			$disadvantage_string = implode(",", $disadvantage);
			$role_data = array('id'=>$roleId,'disAdvantage'=>$disadvantage_string);
			$r = D('Role','Logic')->save($role_data);
			if($r['status']){ 
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Role/userInfo'));
			}else{
				$this->showMessage('强项修改失败：'.$r['info']);
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
			$role_data = array('id'=>$roleId,'birthday'=>$date);
			$r = D('Role','Logic')->save($role_data);
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
}