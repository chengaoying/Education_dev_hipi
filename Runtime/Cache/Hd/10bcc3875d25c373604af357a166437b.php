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
    body{ background-image:url(/static/v1/hd/images/usercenter/baseInfo/info_bg.jpg); }
/* 设置生日  */
#birthday_set{
	position:absolute;
    display: block;
    width:138px;
    height:40px;
    top:100px;
    left:150px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/birthday_set.png);
}
/* kuang_year  */
#kuang_year{
	position:absolute;
    display: block;
    width:110px;
    height:50px;
    top:200px;
    left:150px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/birthday_kuang.png);
}
/* word_year  */
#word_year{
	position:absolute;
    display: block;
	font-size:20px;
	font-color:black;
	border:none;
    top:210px;
    left:275px;	
}
/* word_mouth  */
#word_mouth{
	position:absolute;
    display: block;
	font-size:20px;
	font-color:black;
	border:none;
    top:210px;
    left:450px;	
}
/* word_day  */
#word_day{
	position:absolute;
    display: block;
	font-size:20px;
	font-color:black;
	border:none;
    top:210px;
    left:620px;	
}
  

</style>

<script type="text/javascript">

/* 页面可点击按钮  */
var buttons=
	[
		{id:'year',name:'year',action:'',linkImage:'',focusImage:'',right:'mouth',down:'ok'},
		{id:'mouth',name:'mouth',action:'',linkImage:'',focusImage:'',right:'day',left:'year',down:'ok'},
		{id:'day',name:'day',action:'',linkImage:'',focusImage:'',right:'',left:'mouth',down:'ok'},

		{id:'ok',name:'确定',action:'submit()',linkImage:'/static/v1/hd/images/usercenter/baseInfo/confirm_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/confirm_2.png',up:'year',down:''},
	];


window.onload=function()
{
	//Epg.tip('');//显示info信息，3秒后自动隐藏，如果info为空将不会显示
	Epg.btn.init('year',buttons,true);	
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',1);?>" ></a>

<!-- 静态图片 -->
<div id="birthday_set"></div>
<div id="word_year">年</div>
<div id="word_mouth">月</div>
<div id="word_day">日</div> 

<form id="form" action="<?php echo U(Role/setNickname);?>" method="post" style="padding:10px">
	<div id="div_year" style="position:absolute;left:150px;top:202px;">
		<input type="text" id="year" name="year" value="" style="width:103px;height:40px;font-size:30px;"/><br/><br/>
	</div>
	<div id="div_mouth" style="position:absolute;left:320px;top:202px;">
		<input type="text" id="mouth" name="mouth" value="" style="width:103px;height:40px;font-size:30px;"/><br/><br/>
	</div>
	<div id="div_day" style="position:absolute;left:490px;top:202px;">
		<input type="text" id="day" name="day" value="" style="width:103px;height:40px;font-size:30px;"/><br/><br/>
	</div>
</form>

<!-- 确定按钮 -->
 <div id="div_ok" style="position:absolute;width:140px;height:50px;left:150px;top:300px;">
    <img id="ok" title="" src="/static/v1/hd/images/usercenter/baseInfo/confirm_1.png" width="140" height="50">
</div>

<script type="text/javascript">

function submit(){
	G('form').submit();
}

</script>




<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>