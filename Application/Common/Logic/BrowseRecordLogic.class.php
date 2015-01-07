<?php

/**
 * 逻辑处理类：知识点相关
 */
namespace Common\Logic;
class BrowseRecordLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/BrowseRecordApi');
	}
	
	/**
	 * 根据角色id查找浏览记录
	 * @param int $roleId	课程id
	 * @param int $pageNo 页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryBrowseRecordList($roleId, $pageNo, $pageSize){
		return $this->client->queryBrowseRecordList($roleId, $pageNo, $pageSize);
	}
	
}