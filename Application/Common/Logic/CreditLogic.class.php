<?php
/**
 * 逻辑处理类：积分控制
 */
namespace Common\Logic;
class CreditLogic extends BaseLogic{

	
	public function __construct() {
		parent::__construct('/Api/CreditApi');
	}
	
	/*
	* 根据规则更新积分写日志
	* 当角色ID不为空的时候，那主要是根据角色判断
	* @param int $userId 用户ID
	* @param int $roleId 角色ID
	* @param string $ruleKey 规则KEY
	* @param string $info 备注信息
	*/
	public function ruleIncOrDec($userId = 0,$roleId = 0,$ruleKey = '',$info = '')
	{
		return $this->client->ruleIncOrDec($userId, $roleId, $ruleKey, $info);
	}
	
   /*
     * 不按规则更新积分,不写规则记录日志,用于每次要更新的积分值不确定
     * 当角色ID不为空的时候，更新角色表里的字段，否则更新用户表字段
     * @param int $userId 用户ID
     * @param int $roleId 角色ID
     * @$creditData array 更新数据  如 array('point'=>10) point 指更新的字段，10为更新的数量
     */
	public function incOrDec($userId = 0,$roleId = 0,$creditData = array(), $info = '',$log = true)
	{
		return $this->client->incOrDec($userId,$roleId,$creditData, $info,$log);
	}
	
	/*
	* 根据规则更新积分写日志
	* @param int $userId 用户ID
	* @param int $roleId 角色ID
	* @param string $ruleKey 规则KEY
	* @param string $info 备注信息
	*/
	public function everydayLogin($userId = 0,$roleId = 0,$info = '')
	{
		return $this->client->everydayLogin($userId, $roleId, $info);
	}
	
	/*
	* 根据规则更新积分写日志
	* @param int $userId 用户ID
	* @param int $roleId 角色ID
	*/
	public function queryTodayCredit($userId = 0,$roleId = 0)
	{
		return $this->client->queryTodayCredit($userId,$roleId);
	}
	
   /*
     * 更新积分
     * @param int $userId 用户ID
     * @param int $roleId 角色ID
     * @param string $ruleKey 规则KEY
     * @param string $info 备注信息
     * @param int $num目前练习奖励和订购赠送需要用到
     */
	public function updateCredit($userId = 0,$roleId = 0,$ruleKey = '',$info = '',$num=1)
	{
		return $this->client->updateCredit($userId, $roleId, $ruleKey, $info, $num);
	}
	
}