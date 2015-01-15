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

/* 性别文字  */
#sex_bg{
	position:absolute;
    display: block;
    width:73px;
    height:40px;
    top:100px;
    left:100px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/sex.png);
}
/* 提示文字  */
#select_tip{
	position:absolute;
    display: block;
    width:339px;
    height:22px;
    top:110px;
    left:200px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/select_tip_1.png);
}
</style>

<script type="text/javascript">

var sex = <?php echo ($json_sex); ?>;
/* 页面可点击按钮  */
var buttons=
	[
		{id:'male',name:'male',action:'select("male")',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_2.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_1.png',right:'female',down:'ok'},
		{id:'female',name:'female',action:'select("female")',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_2.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_1.png',left:'male',down:'ok'},
		{id:'ok',name:'确定',action:'submit()',linkImage:'/static/v1/hd/images/usercenter/baseInfo/confirm_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/confirm_2.png',up:'male',down:''},
];


window.onload=function()
{
	//Epg.tip('');//显示info信息，3秒后自动隐藏，如果info为空将不会显示
	if(sex['sex']=='2')
	{
		G('sexID').value=2;
		G('div_female_selected').style.visibility = 'visible';
	}
	else if(sex['sex']=='1')
	{
		G('sexID').value=1;
		G('div_male_selected').style.visibility = 'visible';
	}
	Epg.btn.init('male',buttons,true);	
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',1);?>" ></a>

<!-- 静态图片 -->
<div id="sex_bg"></div>
<div id="select_tip"></div>

<form id="form" action="<?php echo U(Role/setSex);?>" method="post" style="padding:10px">
	<input type="hidden" id="sexID" name="sex" value=""/>
</form>
	<!-- 男 -->
	<div id="div_male" style="position:absolute;left:100px;top:200px;">
		<img id="male" name="male" src="/static/v1/hd/images/usercenter/baseInfo/kuang_2.png" style="width:110px;height:50px;"/>
	</div>
	<div id="div_male_word" style="position:absolute;left:100px;top:200px;">
		<img id="male_word" name="male_word" src="/static/v1/hd/images/usercenter/baseInfo/male.png" style="width:110px;height:50px;"/>
	</div>
	<div id="div_male_selected" style="position:absolute;visibility:hidden;left:170px;top:210px;">
		<img id="male_selected" name="male_selected" src="/static/v1/hd/images/usercenter/baseInfo/right.png" style="width:28px;height:22px;"/>
	</div>
	<!-- 女 -->
	<div id="div_female" style="position:absolute;left:250px;top:200px;">
		<img id="female" name="female" src="/static/v1/hd/images/usercenter/baseInfo/kuang_2.png" style="width:110px;height:50px;"/>
	</div>
	<div id="div_female_word" style="position:absolute;left:250px;top:200px;">
		<img id="female_word" name="female_word" src="/static/v1/hd/images/usercenter/baseInfo/female.png" style="width:110px;height:50px;"/>
	</div>
	<div id="div_female_selected" style="position:absolute;visibility:hidden;left:320px;top:210px;">
		<img id="female_selected" name="female_selected" src="/static/v1/hd/images/usercenter/baseInfo/right.png" style="width:28px;height:22px;"/>
	</div>
<!-- 确定按钮 -->
<div id="div_ok" style="position:absolute;width:140px;height:50px;left:100px;top:300px;">
    <img id="ok" title="" src="/static/v1/hd/images/usercenter/baseInfo/confirm_1.png" width="140" height="50">
</div>

<script type="text/javascript">

function submit(){
	G('form').submit();
}

function select(sex)
{
	if(sex == "male")
	{	
		G('div_male_selected').style.visibility = 'visible';
		G('div_female_selected').style.visibility = 'hidden';
		G('sexID').value=1;
	}
	else if(sex == "female")
	{	
		G('div_female_selected').style.visibility = 'visible';
		G('div_male_selected').style.visibility = 'hidden';
		G('sexID').value=2;
	}
}

</script>










<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>