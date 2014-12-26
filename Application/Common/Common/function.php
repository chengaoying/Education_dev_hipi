<?php

/**
 * 当前项目通用函数库
 */

/**
 * 根据广告位的key获取单个广告位
 * @param string $asKey
 */
function get_adSpace($asKey){
	$adSpace = get_array_for_fieldval(S('AdSpace'), 'asKey', $asKey);
	$adSpace = array_slice($adSpace,0,count($adSpace));
	return $adSpace;
}

/**
 * 根据广告位ID获取该广告位下的广告
 * @param int $asId
 */
function get_ad($asId){
	$ads = S('Ad');
	$ads = $ads[$asId];
	$ads = array_slice($ads,0,count($ads));
	return $ads;
}

/**
 * 获取配置中的配置内容content
 * @param string $cKey 配置key
 */
function get_pro_config_content($cKey){
	$conf = S('ProConfig');
	$conf = $conf[$cKey];
	$content = $conf['content'];
	return unserialize($content);
}

/**
 * 用于调试，用好的格式在页面打印数组，易于查看
 * @param unknown_type $array
 */
function p($array)
{
	dump($array, 1, '<pre>', 0);
}


/**
 * 获取缓存
 * @param string $key
 */
function get_cache($name) {
	$data = S($name);
	if (empty($data)) {
		$data = D($name)->updateCache();
	}
	return $data;
}