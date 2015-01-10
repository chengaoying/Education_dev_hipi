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
	 * 通过rulekey查询积分规则
	 * @param string $rulekey
	 */
	public function selectOneByRuleKey($ruleKey){
		return $this->client->selectOneByRuleKey($ruleKey);
	}
	
}