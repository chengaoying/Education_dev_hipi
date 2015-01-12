<?php

/**
 * 逻辑处理类：资源有关
 */
namespace Common\Logic;
class ResourceLogic extends BaseLogic{
	
	public function __construct() {
		parent::__construct('/Api/ResourceApi');
	}
    
    /*
     * 根据keyList查询资源
     * @param array $keyList 查询资源
  	 * @param int $pageNo	页号
	 * @param int $pageSize	每页记录数
     * @param string $field 需要显示的字段
     */
    public function queryResourceListByKeyList($keyList,$pageNo, $pageSize,$field = '') {
        $data = $this->client->queryResourceListByKeyList($keyList,$pageNo, $pageSize,$field);
        return $data;
    }
    
    
     /*
     * 根据视频id集获取资源集
     * @param array $ids 包含资源的id数组
     * @param string $field 需要查询的字段
     * @return array $data 包含资源id和资源code
     */
    public function queryResourceList($ids = array(),$field = '') {
        $data = $this->client->queryResourceList($ids,$field);
        return $data;
    }
}