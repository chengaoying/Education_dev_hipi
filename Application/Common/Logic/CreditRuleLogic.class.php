<?php

/**
 * 逻辑处理类：课程相关
 */
namespace Common\Logic;
class CreditRuleLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/CreditRuleApi');
	}
	
	/**
	 * 通过key查询积分规则
	 * @param string $key
	 */
	public function selectOneByKey($key){
		return $this->client->selectOneByRuleKey($key);
	}
	
}