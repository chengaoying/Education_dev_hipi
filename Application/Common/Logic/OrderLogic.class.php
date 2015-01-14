<?php

/**
 * 逻辑处理类：订购相关
 */
namespace Common\Logic;
class OrderLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/OrderApi');
	}
	
	/**
	 * 产品鉴权
	 * @param $userId 用户id
	 */
	public function auth($userId){
		$result = $this->client->auth($userId);
	}
	
	/**
	 * 订购课程
	 * @param int $userId	用户id
	 * @param int $roleId	角色id
	 * @param int $courseId	课程id
	 */
	public function orderCourse($userId,$roleId='',$courseId){
		if(empty($userId)) return result_data(0,'订购异常：用户id(serId)不能为空！');
		if(empty($courseId)) return result_data(0,'订购异常：课程id(courseId)不能为空！');
		return $this->client->orderCourse($userId,$roleId,$courseId);
	}
	
}