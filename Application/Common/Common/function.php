<?php

/**
 * 当前项目通用函数库
 */

/**
 * 判断产品是否支持包月订购
 * 判断方式：后台计费管理中设置并启用了包月计费模式
 */
function is_monthly_order(){
	$chargeMode = S('ChargeMode');
	$type = get_pro_config_content('proConfig','charge');
	$key = array_search('包月', $type);
	foreach ($chargeMode as $k => $v){
		if ($v['type'] == $key) return true;
	}
	return false;
}

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
 * @param string $field 字段key
 */
function get_pro_config_content($cKey,$field=''){
	$conf = S('ProConfig');
	$conf = $conf[$cKey];
	$content = unserialize($conf['content']);
	if(!empty($field)) return $content[$field];
	return $content;
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
	date_default_timezone_set('Etc/GMT-8');     //这里设置了时区
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
//		$info = '日期不正确,日期范围应在1901-12-15<br/>到2038-1-19。如果年份为两位数字则: 0-69 <br/>表示 2000-2069,70-100 表示1970-2000';
		$info = '生日输入错误';
		return result_data(0, $info);
	}
	$m = (date("Y")-date("Y",$birthday_unix))*12+date("m")-date("m",$birthday_unix);
	if(date("d")>=date("d",$birthday_unix))
	{
		$m += 1;
	}
	return result_data(1,'成功',array('monthNum' => $m));
}

/*获取上个页面指定参数的参数值
 *@param string default 默认参数值
 *@param string focusName 要获得的参数名
 *@return 上页地址中有对应的参数,则取参数值;没有或出错,则返回$default
*/
function getFocus($default='',$focusName='')
{
	if(empty($default) || empty($focusName))
	{
		return result_data(0,'缺少参数');
	}
	$url = HTTP_REFERER;//上页面索引，根据focus值得到默认焦点
	//得到开始坐标
	$startPos = strpos($url,'preFocus');

	if($startPos===false) return $default;
	
	$startPos += 9;
	//得到结束坐标
	$endPos1 = strpos($url, '&', $startPos);
	$endPos2 = strpos($url, '/', $startPos);
	$endPos3 = strpos($url, '.', $startPos);
	($endPos = $endPos1) || ($endPos = $endPos2) || ($endPos = $endPos3);

	$endPos = $endPos===false ? strlen($url) : $endPos;
	//得到长度
	$len = $endPos - $startPos;
	//得到focus
	$act = substr($url,$startPos,$len);
	if($act === false) return $default;
	
	return $act;
}

