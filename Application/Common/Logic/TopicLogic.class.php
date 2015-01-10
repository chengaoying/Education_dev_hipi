<?php

/**
 * 逻辑处理类：知识点相关
 */
namespace Common\Logic;
class TopicLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/TopicApi');
	}
	
	/**
	 * 根据课程id查找该课程下的知识点
	 * @param int $courseId	课程id
	 * @param int $pageNo 页号
	 * @param int $pageSize 每页记录数
	 */
	public function queryTopicList($courseId, $pageNo, $pageSize){
		return $this->client->queryTopicList($courseId, $pageNo, $pageSize);
	}
	
	/**
	 * 通过知识点id查找单个知识点
	 * @param int $topicId
	 */
	public function queryTopicById($topicId){
		return $this->client->queryTopicById($topicId);
	}
	
}