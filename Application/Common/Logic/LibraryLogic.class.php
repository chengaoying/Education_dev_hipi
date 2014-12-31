<?php

/**
 * 逻辑处理类：题目相关
 */
namespace Common\Logic;
class LibraryLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/LibraryApi');
	}
    
    /**
     * 保存角色答的题目
     * @param int $roleId 角色ID
     * @param array $data 需要保存的数组数据包含（$topicId,$sectionId,$libId,$correct,$wrong）
     * @param int $topicId 知识点id
     * @param int $sectionId 课时ID
     * @param int $libId  题目ID
     * @param int $correct 正确答案
     * @param int $wrong 错误答案
     * @return int $status 保存状态 
     */
    public function saveRoleLib($roleId,$data = array()) {
        return $this->client->saveRoleLib($roleId,$data);
    }
    
    /**
     * 查询角色答的错误题目
     * @param int $roleId 角色ID
	 * @param int $topicId 知识点ID
     * @param int $sectionId 课时ID
     * @param int $pageNo 页号
     * @param int $pageSize 每页记录数
     * @return array $data 查询的数组
     */
    public function queryRoleWrongLib($roleId,$topicId,$sectionId,$pageNo,$pageSize) {
        return $this->client->queryRoleWrongLib($roleId,$topicId,$sectionId,$pageNo,$pageSize);
    }
    
    /**
     * 查询题库
     * @param int $topicId 知识点id
     * @param int $sectionId 课程id
     * @return array 返回题库内容
     */
    public function queryLib($topicId,$sectionId) {
    	return $this->client->queryLib($topicId,$sectionId);
    }
    
}