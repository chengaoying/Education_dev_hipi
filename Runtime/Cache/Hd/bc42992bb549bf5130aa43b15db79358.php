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

#default_tip{
	position: absolute;
	top: 310px;
	left: 490px;
	width: 300px;
	height: 60px;
	color:#F8E391;
	text-align: center;
	line-height:30px;
	background-color:saddlebrown;
	visibility:hidden;
	z-index:99;
}

</style>
<script type="text/javascript">

<?php $floatMsg = Session('floatMessage'); Session('floatMessage',null); ?>

/* 弹窗信息  */
var popup = function(){
	var msg = "<?php echo ($floatMsg); ?>";
	Epg.tip(msg);
}

</script>

</head>
<body>


<style>
    body{ background-image:url(/static/v1/hd/images/common/order/order_bg.png); }
</style>


<script type="text/javascript">

var buttons=
	[
		{id:'btn_pay',name:'',action:'',linkImage:'/static/v1/hd/images/common/order/btn_pay.png',focusImage:'/static/v1/hd/images/common/order/btn_pay_over.png',selectBox:'',left:'',right:'btn_pay_2',up:'btn_pay_2',down:''},
		{id:'btn_pay_1',name:'',action:'',linkImage:'/static/v1/hd/images/common/order/btn_pay.png',focusImage:'/static/v1/hd/images/common/order/btn_pay_over.png',selectBox:'',left:'btn_pay',right:'',up:'',down:'btn_pay_2'},
		{id:'btn_pay_2',name:'',action:'',linkImage:'/static/v1/hd/images/common/order/btn_pay.png',focusImage:'/static/v1/hd/images/common/order/btn_pay_over.png',selectBox:'',left:'btn_pay',right:'',up:'btn_pay_1',down:'btn_pay'},
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

<!-- 单课程单包月 -->
<div id="div_btn_pay" style="position:absolute;width:140px;height:45px;top:560px;left:460px;">
	<img id="btn_pay" title="<?php echo U('Order/pay?courseId='.$course['id'].'&chargeId='.$chargeMode[2]['id'].'&courseStage='.$course['stageIds']);?>" src="/static/v1/hd/images/common/order/btn_pay.png">
</div>
<div id="div_title" style="position:absolute;width:212px;height:31px;top:568px;left:120px;">
	<img id="title" src="/static/v1/hd/images/common/order/title_gradeone_1.png">
</div>

<!-- 全课程单包月 -->
<div id="div_btn_pay_1" style="position:absolute;width:140px;height:45px;top:225px;left:1000px;">
	<img id="btn_pay_1" title="<?php echo U('Order/pay?courseId='.$course['id'].'&chargeId='.$chargeMode[0]['id'].'&courseStage='.$course['stageIds']);?>" src="/static/v1/hd/images/common/order/btn_pay.png">
</div>

<!-- 全课程半年包 -->
<div id="div_btn_pay_2" style="position:absolute;width:140px;height:45px;top:285px;left:1000px;">
	<img id="btn_pay_2" title="<?php echo U('Order/pay?courseId='.$course['id'].'&chargeId='.$chargeMode[1]['id'].'&courseStage='.$course['stageIds']);?>" src="/static/v1/hd/images/common/order/btn_pay.png">
</div>

<div id="div_title_all" style="position:absolute;width:317px;height:72px;top:120px;left:800px;">
	<img id="title_all" src="/static/v1/hd/images/common/order/title_gradeone_all.png">
</div>


<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>