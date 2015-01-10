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
	 * 根据contentId查找浏览记录
	 * @param int $contentId	知识点id
	 * @param int $pageNo 页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryBrowseRecordList($contentId, $pageNo, $pageSize){
		return $this->client->queryBrowseRecordList($contentId, $pageNo, $pageSize);
	}
	
	/**
	 * 根据type(浏览类型(1-视频，2-课程，3-题库),keys查找浏览记录
	 * @param int $type	浏览类型
	 * @param int &keys 关键字
	 * @param int $pageNo 页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryBrowseRecordListByKeys($type, $keys, $pageNo, $pageSize)
	{
		return $this->client->queryBrowseRecordListByKeys($type, $keys, $pageNo, $pageSize);
	}
	
}