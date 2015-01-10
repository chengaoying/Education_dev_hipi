<?php

/**
 * 逻辑处理类：积分记录相关
 */
namespace Common\Logic;
class CreditLogLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/CreditLogApi');
	}
	
	/**
	 * 插入或更新积分获得记录
	 * @param string $data
	 */
	public function save($data){
		return $this->client->saveOrUpdate($data);
	}
	
}