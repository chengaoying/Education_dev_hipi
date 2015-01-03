<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">
.page td	{ height:26px; text-align:center;color:#fff;font-weight: 300; font-size:20px;}
.page .up	{ width:25px;}
.page .down	{ width:25px;}
.page .now	{ width:60px;}
body {background-color: transparent;}

#div_popup{
	position:absolute;
	visibility:hidden;
	width:560px;
	height:357px;
	top:180px;
	left:360px;
	background-image: url(/static/v1/hd/images/common/popup/info_bg.png);
}

</style>
</head>
<body>

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



<!-- 弹窗 -->
<div id="div_popup">
</div>
</body>
</html>