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
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
</style>


<script type="text/javascript">

var buttons=
	[
		{id:'btn_pay',name:'',action:'',linkImage:'/static/v1/hd/images/common/order/btn_order.png',focusImage:'/static/v1/hd/images/common/order/btn_order_over.png',selectBox:'',left:'',right:'',up:'',down:''},
	];

/* 初始化按钮 属性   */
var initButtons = function(){}

window.onload=function()
{
	initButtons();
	Epg.btn.init('btn_pay',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<div style="position:absolute;width:280px; height: 120px;top:150px;left:500px;">
订购课程：<?php echo ($course['name']); ?>
</div>

<div id="div_btn_pay" style="position:absolute;width:90px;height:34px;top:300px;left:560px;">
	<img id="btn_pay" title="<?php echo U('Order/pay?courseId='.$course['id']);?>" src="/static/v1/hd/images/common/order/btn_order.png">
</div>

<!-- 弹窗 -->
<div id="div_popup">
</div>
</body>
</html>