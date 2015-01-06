<?php

/**
 * 逻辑处理类：课时相关
 */
namespace Common\Logic;
class SectionLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/SectionApi');
	}
	
	/**
	 * 根据课时id查找单个课时
	 * @param int $sectionId
	 */
	public function querySectionById($sectionId){
		return $this->client->querySectionById($sectionId);
	}
	
	/**
	 * 根据知识点id查找该知识点下的课时列表
	 * @param arr $topicIds	知识点id数组
	 * @param int $pageNo 页号
	 * @param int $pageSize 每页记录数
	 */
	public function querySectionList($topicIds, $pageNo, $pageSize){
		return $this->client->querySectionList($topicIds, $pageNo, $pageSize);
	}
	
	/**
	 * 分页查找所有课时
	 * @param int $sectionId
	 */
	public function querySectionByPrivilege($privilege, $pageNo, $pageSize){
		return $this->client->querySectionListByPrivilege($privilege,$pageNo, $pageSize);
	}
	
}