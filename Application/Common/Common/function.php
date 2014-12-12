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