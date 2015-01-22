<?php
/**
 * 逻辑处理类：基类
 */
namespace Common\Logic;
class BaseLogic {
    
	public $client = '';	//客户端接口调用对象
	
	/* 初始化客户端接口调用对象  */
	public function __construct($uri) {
		$url = C('PLATFORM_URL').$uri;
		$this->client = $this->initHproseObject($url);
		//$this->client = $this->initJsonRpcObject($url);
	}
	
	/**
	 * 返回数据是否为空
	 * @param arr $list
	 * @return multitype:multitype: number |unknown
	 */
	protected function returnListData($list = '') {
		if (! isset($list ['rows']) || ! is_array($list ['rows']) || empty($list['rows'])) {
			return array ('rows' => array (), 'total' => 0);
		} else {
			return $list;
		}
	}
	
	/**
	 * 
	 * @param unknown_type $page
	 * @param unknown_type $pageSize
	 */
	protected function getPage($page,$pageSize){
		$page = $page<=0 ? 1 : $page;
		$pageSize = empty($pageSize) ? C('PAGE_SIZE') : $pageSize;
		return array($page,$pageSize);
	}
	
	/**
	 * 获取Hprose客户端对象
	 * @param string $url
	 */
	public function initHproseObject($url){
		vendor('Hprose.HproseHttpClient');
		$client = new \HproseHttpClient($url);
		return $client;
	}
	
	/**
	 * 获取jsonRPC客户端对象
	 * @param string $url
	 */
	public function initJsonRpcObject($url){
		vendor('jsonRPC.jsonRPCClient');
		$client = new \jsonRPCClient($url);
		return $client;
	}
	
	
}