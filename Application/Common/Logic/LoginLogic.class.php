<?php

/**
 * 逻辑处理类：课程相关
 */
namespace Common\Logic;
class LoginLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/LoginApi');
	}
	
	/**
	 * 保存或更新login表
	 * @param string $login
	 */
	public function save($login){
		return $this->client->saveOrUpdate($login);
	}
	
	/**
	 * 通过roleId查询用户Login表
	 * @param string $roleId
	 */
	public function selectOneByRoleId($roleId){
		return $this->client->selectOneByRoleId($roleId);
	}
	
}