<?php

/**
 * 逻辑处理类：pv记录
 */
namespace Common\Logic;
class PvLogic extends BaseLogic{
	
	public function __construct() {
		//parent::__construct('/Api/TopicApi');
	}
	
	
	/**
	 * 保存pv，参数$data包含的项：
	 * userid:		机顶盒用户id（OpUserId）
	 * app_label:	应用标签
	 * product_key:	产品key
	 * page_key：	页面key
	 * c_key：		页面按钮key
	 * c_class：		pv类型：pv(普通浏览)  login（登录）res(资源商) ads(广告)
	 * res_providers：资源提供商id
	 * c_name：		页面描述
	 * content_id:	内容id（资源id）
	 * c_url:		页面url
	 */
	public function savePv($data = array()){
		if(empty($data['userid'])){
			$user = unserialize(Session('user'));
			$data['userid'] = $user['OpUserId'];
		}
		if(empty($data['app_label'])) $data['app_label'] = 'education';
		if(empty($data['product_key'])) $data['product_key'] = C('PRO_KEY');
		if(empty($data['page_key'])) $data['page_key'] = CONTROLLER_NAME.'_'.ACTION_NAME;
		if(empty($data['c_class'])) $data['c_class'] = 'pv';
		if(empty($data['c_url'])) $data['c_url'] = HTTP_REFERER;
		
		$param = urlencode(json_encode($data));
		$url = C('PV_URL') . '?params=' . $param;
		$result = file_get_contents($url);
		$result = json_decode($result, true);
		
		save_log('pv',array('url'=>'pvUrl:'.$url,'result'=>'result:'.$result));
	}
	
}