<?php

/**
 * 逻辑处理类：角色加入学习计划的课程
 */
namespace Common\Logic;
class RoleCourseLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/RoleCourseApi');
	}
	
	/**
	 * 加入学习计划
	 * @param int $roleId  角色id
	 * @param int $courseId 课程id
	 * @param string $courseName 课程名
	 * @param string $courseImg 课程图片地址
	 */
	public function addCourse($roleId,$courseId,$courseName,$courseImg){
		return $this->client->addCourse($roleId,$courseId,$courseName,$courseImg);
	}
	
	/**
	 * 查询角色加入学习计划的单个课程
	 * @param int $roleId	角色id
	 * @param int $courseId 课程id
	 * @param int $pageNo 	页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryRoleCourseByCourseId($roleId, $courseId, $pageNo, $pageSize){
		return $this->client->queryRoleCourseByCourseId($roleId, $courseId, $pageNo, $pageSize);
	}
	
	/**
	 * 查询角色加入学习计划的课程列表
	 * @param int $roleId	角色id
	 * @param int $pageNo	页号
	 * @param int $pageSize	每页记录数
	 */
	public function queryRoleCourseList($roleId, $pageNo, $pageSize){
		return $this->client->queryRoleCourseList($roleId, $pageNo, $pageSize);
	}
	
}