<?php

/**
 * 逻辑处理类：知识点相关
 * author: wzh
 */
namespace Common\Logic;
class AwardLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/AwardApi');
	}
	
	/**
	 * 发奖品
	* @param int $userId 用户ID
	* @param int $roleId 角色ID
	* @param int $itemId 奖品ID
	* @param int $num 数量
	* @param string $info 描述
	*/
	public function sendItem($userId,$roleId,$itemId,$num,$info) {
		return $this->client->sendItem($userId,$roleId,$itemId,$num,$info);
	}
	
	
	/**
	 * 获取奖品信息
	 * @param int $awardId 奖品id
	 * @return $data
	 */
	public function getAwardInfo($awardId){
		return $this->client->getAwardInfo($awardId);
	}
	
	/**
	 * 专门针对视频播放完成后获得的奖品
	 */
	public function getResourceAward($award) {
		if(!$award) return;
		$isAward = false;
		$randNum = rand ( 1, 100 );
		if ($randNum >= 10 && $randNum < 100) {
			$isAward = true;
		}
		if($isAward){
			$awardNum = rand ( 0, count($award)-1 );
			return $award[$awardNum];
		}
	}
}