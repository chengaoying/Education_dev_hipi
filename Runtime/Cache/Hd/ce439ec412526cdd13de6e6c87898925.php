<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">
</style>
<script type="text/javascript">

<?php $floatMsg = Session('floatMessage'); Session('floatMessage',null); ?>

/**
 * 页面弹窗，弹窗类型：
 * @param type 弹窗类型：1-小图提示信息，2-大图提示信息，不设置则默认为1
 */
var popup = function(type){
	Epg.popup("<?php echo ($floatMsg); ?>",3,type);
}	

</script>

</head>
<body >

<style>
body	{ background-image:url(/static/v1/hd/images/common/msg/bg.png); }
</style>

<div style="position:absolute;top:255px;left:350px;">
	<img src="/static/v1/hd/images/common/msg/icon_<?php echo ($icon); ?>.png"/>
</div>

<div style="position:absolute;top:295px;left:550px;">
	<font style="font-size:24px;color:#999;"><?php echo ($message); ?></font>
</div>

<div id="back" style="position:absolute;top:395px;left:550px;">
	<a id="a_back" href="<?php echo get_back_url('Index/index',1);?>"
		onmouseover="changeImage('#btn_back','/static/v1/hd/images/common/msg/btn_back_over.png')" 
		onmouseout="changeImage('#btn_back','/static/v1/hd/images/common/msg/btn_back.png')">
		<img id="btn_back" src="/static/v1/hd/images/common/msg/btn_back.png" />
	</a>
</div>



<!-- 1.无背景图的文字提示 -->
<div id="popup_1"></div>

<!-- 2.有背景图的文字提示 -->
<div id="popup_2">
	<div id="popup_2_info_bg"></div>
	<div id="popup_2_info"></div>
</div>

</body>
</html>