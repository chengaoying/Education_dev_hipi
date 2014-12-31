<?php

/**
 * 逻辑处理类：课程相关
 */
namespace Common\Logic;
class CourseLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/CourseApi');
	}
	
	/**
	 * 查询角色的课程列表
	 * @param int $roleId	角色id
	 * @param int $pageNo	页号
	 * @param int $pageSize	每页记录数
	 */
	public function queryRoleCourseList($roleId, $pageNo, $pageSize){
		return $this->client->queryRoleCourseList($roleId, $pageNo, $pageSize);
	}
	
	/**
	 * 通过关键字查询课程列表
	 * @param int $stageId	龄段id
	 * @param int $keys		关键字id
	 * @param int $pageNo	页号
	 * @param int $pageSize	每页记录数
	 */
	public function queryCourseListByKeys($stageId, $keys, $pageNo, $pageSize){
		return $this->client->queryCourseListByKeys($stageId, $keys, $pageNo, $pageSize);
	}
	
	/**
	 * 通过顶级分类（二级栏目）查询课程列表
	 * @param int $chId		分类（栏目）id
	 * @param int $pageNo	页号
	 * @param int $pageSize	每页记录数
	 */
	public function queryCourseListByChId($chId, $pageNo, $pageSize){
		return $this->client->queryCourseListByChId($chId, $pageNo, $pageSize);
	}
}