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
	 * 通过关键字查询课程列表
	 * @param int $stageId	龄段id
	 * @param array $keys	关键字id
	 * @param int $pageNo	页号
	 * @param int $pageSize	每页记录数
	 */
	public function queryCourseListByKeys($stageId, $keys, $pageNo, $pageSize){
		return $this->client->queryCourseListByKeys($stageId, $keys, $pageNo, $pageSize);
	}
	
	/**
	 * 推荐课程查询:(有帐号的课程推荐):
	 * 早教：关键字（特别推荐一/特别推荐二）,角色月龄对应的课程
	 * 幼教：关键字（特别推荐一/特别推荐二）,当前周数对应的课程
	 * 小学以上：关键字（特别推荐一/特别推荐二），
	 * @param int $stageId	龄段id
	 * @param array $keys  查询参数	格式：array('key'=>'月龄/周'),(推荐课程的关键字=>课程的月龄（早教）/课程的周数（幼教）)
	 */
	public function queryRecommendCourse($stageId, $keys){
		return $this->client->queryRecommendCourse($stageId, $keys);
	}
	
	/**
	 * 推荐课程查询:(游客的课程推荐):
	 * @param array $keys  关键字数组，格式：array(k1,k2,k3).k1为特别推荐一，k2为特别推荐二，k3为一般推荐
	 */
	public function queryRandomRecommendCourse($keys){
		return $this->client->queryRandomRecommendCourse($keys);
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
	
	/**
	 * 通过课程id查找单个课程
	 * @param int $courseId
	 */
	public function queryCourseById($courseId){
		return $this->client->queryCourseById($courseId);
	}
	
	/**
	 * 通过课程类型查询课程列表
	 * @param int $stageId	龄段id
	 * @param arr $types	课程类型
	 * @param int $pageNo	页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryCourseListByType($stageId, $types, $pageNo, $pageSize){
		if(!is_array($types)) $types = array($types);
		return $this->client->queryCourseListByType($stageId, $types, $pageNo, $pageSize);
	}
	
}