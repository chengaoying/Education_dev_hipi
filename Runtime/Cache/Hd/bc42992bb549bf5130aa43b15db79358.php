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
    body{ background-image:url(/static/v1/hd/images/common/order/order_bg.png); }
</style>


<script type="text/javascript">

var buttons=
	[
		{id:'btn_pay',name:'',action:'',linkImage:'/static/v1/hd/images/common/order/btn_pay.png',focusImage:'/static/v1/hd/images/common/order/btn_pay_over.png',selectBox:'',left:'',right:'',up:'',down:''},
	];

/* 初始化按钮 属性   */
var initButtons = function(){}

window.onload=function()
{
	initButtons();
	Epg.btn.init('btn_pay',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo ($backUrl); ?>" ></a>

<!-- 包月 -->
<div id="div_btn_pay" style="position:absolute;width:170px;height:55px;top:240px;left:980px;">
	<img id="btn_pay" title="<?php echo U('Order/pay?courseId='.$course['id'].'&chargeId='.$chargeMode['id'].'&courseStage='.$course['stageIds']).'?backUrl='.urlencode($backUrl);?>" src="/static/v1/hd/images/common/order/btn_pay.png">
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