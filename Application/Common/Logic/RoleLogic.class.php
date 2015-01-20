<?php

/**
 * 逻辑处理类：用户角色信息
 */
namespace Common\Logic;
class RoleLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/RoleApi');
	}
	
	/**
	 * 通过roleId查询单个角色
	 * @param string $roleId
	 */
	public function load($roleId){
		return $this->client->load($roleId);
	}
	
	/**
	 * 保存用户角色信息 
	 * @param arr $role
	 */
	public function save($role){
		return $this->client->saveOrUpdate($role);
	}
	
	/**
	 * 根据用户ID查询用户的角色列表
	 * @param string $userId
	 */
	public function queryRoleList($userId){
		return $this->client->queryRoleList($userId);
	}
	
	/**
	 * 初始化用户的角色信息
	 */
	public function initUserRoleInfo(){
		//查询用户的角色列表
		$user = unserialize(Session('user'));
		$roleList = $this->queryRoleList($user['id']);
		if(empty($roleList) || count($roleList) < 1) {
			Session('role',null);
			Session('roleList',null);
			return;
		}
		$_rid = $roleList[0]['id'];
		
		//把角色列表数组的key改为角色的ID
		foreach ($roleList as $k=>$v){
			$roleList[$v['id']] = $v;
			unset($roleList[$k]);
		}
		//用户的角色列表
		Session('roleList',$roleList);
		
		if(empty($roleList[$user['usedRoleID']])){
			//更新用户最近使用的角色ID
			$user['usedRoleID'] = $_rid;
			D('User','Logic')->save($user);
			Session('user',serialize($user));
		}
		
		//用户最近使用的角色
		Session('role',serialize($roleList[$user['usedRoleID']]));
	}
	
	/**
	 * 切换角色
	 * @param string $roleId
	 */
	public function changeRole($roleId){
		$user = unserialize(Session('user'));
		$user['usedRoleID'] = $roleId;
		$r = D('User','Logic')->save($user);
		if($r['status']){
			Session('user',serialize($user));
			$roleList = Session('roleList');
			Session('role',serialize($roleList[$roleId]));
			return result_data(1,'',unserialize(Session('role')));
		}
		return $r;
	} 
	
}