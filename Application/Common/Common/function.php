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

/*
 * 根据生日判断距出生月数
 * @param birthday为出生年月日，形式为：2000-01-01/2000-1-1/
 * @return 成功，返回现在距生日的月数，失败返回错误信息
 */
function monthNum($birthday)
{
	$info = '';
	if(empty($birthday))
	{
		$info = '日期不能为空，请去用户中心设置日期！';
		return result_data(0, $info);
	}
	$birthday_array = explode("-", $birthday);
	if(!is_numeric($birthday_array[0]) || !is_numeric($birthday_array[1]) || !is_numeric($birthday_array[2]))
	{
		$info = '日期不正确，日期应为数字';
		return result_data(0, $info);
	}
	
	$birthday_unix=strtotime($birthday);
	if($birthday_unix === false)
	{
		$info = '日期不正确,日期范围应在1901-12-15<br/>到2038-1-19。如果年份为两位数字则: 0-69 <br/>表示 2000-2069,70-100 表示1970-2000';
		return result_data(0, $info);
	}
	$m = (date("Y")-date("Y",$birthday_unix))*12+date("m")-date("m",$birthday_unix);
	if(date("d")>=date("d",$birthday_unix))
	{
		$m += 1;
	}
	return result_data(1,'成功',array('monthNum' => $m));
}





