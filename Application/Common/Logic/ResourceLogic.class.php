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