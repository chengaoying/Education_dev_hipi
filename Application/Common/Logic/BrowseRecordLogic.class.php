<?php

/**
 * 逻辑处理类：知识点相关
 * author: wzh
 */
namespace Common\Logic;
class BrowseRecordLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/BrowseRecordApi');
	}
	
	/**
	 * 保存浏览记录
	 * @param arr $param
	 */
	public function saveBrowseRecord($param){
		return $this->client->saveBrowseRecord($param);
	}
	
	/**
	 * 根据知识点id查找浏览记录
	 * @param int $roleId $roleId
	 * @param int $topictId 知识点id
	 * @param int $pageNo 页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryBrowseRecordList($roleId, $topictId, $pageNo, $pageSize){
		return $this->client->queryBrowseRecordList($roleId, $topictId, $pageNo, $pageSize);
	}
	/**
	 * 根据角色id查找最近浏览记录
	 * @param int $roleId 角色id
	 * @param int $pageNo 页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryBrowseRecordListRecentlyWatch($roleId, $pageNo, $pageSize){
		return $this->client->queryBrowseRecordListRecentlyWatch($roleId, $pageNo, $pageSize);
	}
	
	
	/**
	 * 根据type(浏览类型(1-视频，2-课程),keys查找浏览记录
	 * @param int $roleId 角色id
	 * @param int $type	浏览类型
	 * @param int &keys 关键字
	 * @param array $date 日期范围，不需要置null
	 * @param int $pageNo 页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryBrowseRecordListByKeys($roleId, $type, $keys, $date, $pageNo, $pageSize)
	{
		return $this->client->queryBrowseRecordListByKeys($roleId, $type, $keys, $date,$pageNo, $pageSize);
	}
	
}