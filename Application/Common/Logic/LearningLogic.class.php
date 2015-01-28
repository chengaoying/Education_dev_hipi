<?php
/**
 * 逻辑处理类：学习评价控制
 */
namespace Common\Logic;
class LearningLogic extends BaseLogic{

	
	public function __construct() {
		parent::__construct('/Api/LearningApi');
	}
	
	/*
	 * 统计学习评价进度
	 * @param array courseIds 当前页面的课程id
	 * @param int $roleId 角色ID
	 * @return
	 */
	public function statisticsDataPreschool($courseIds=array(),$roleId=0,$len=0)
	{
		$result = $this->client->statisticsDataPreschool($courseIds,$roleId,$len);
		return $result;
	}
	
	/*
	 * 统计分数
	* @param array courseIds 当前页面的课程id
	* @param int $roleId 角色ID
	* @return
	*/
	public function statisticsScore($stageId=0,$roleId=0,$type=0)
	{
		$result = $this->client->statisticsScore($stageId,$roleId,$type);
		return $result;
	}
	
}