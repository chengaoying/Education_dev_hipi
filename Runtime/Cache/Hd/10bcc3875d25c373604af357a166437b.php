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
/* word_month  */
#word_month{
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
		{id:'year',name:'year',action:'',linkImage:'',resize:'-1',focusImage:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',right:'month',down:'ok'},
		{id:'month',name:'month',action:'',linkImage:'',resize:'-1',focusImage:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',right:'day',left:'year',down:'ok'},
		{id:'day',name:'day',action:'',linkImage:'',resize:'-1',focusImage:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',right:'',left:'month',down:'ok'},

		{id:'ok',name:'确定',action:'submit()',linkImage:'/static/v1/hd/images/usercenter/baseInfo/confirm_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/confirm_2.png',up:'year',down:''},
	];


window.onload=function()
{
	popup(0);
	Epg.btn.init('year',buttons,true);	
	
	//删除0键返回事件
  	Epg.key.del(
	{
		KEY_0:'',
	});  
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',0);?>" ></a>

<!-- 静态图片 -->
<div id="birthday_set"></div>
<div id="word_year">年</div>
<div id="word_month">月</div>
<div id="word_day">日</div> 

<form id="form" action="<?php echo U('Role/setBirthday');?>" method="post" style="padding:10px">
	<div id="div_year" style="position:absolute;left:150px;top:202px;">
		<input type="text" id="year" name="year" value="<?php echo ($birthday[0]); ?>" maxlength="4" style="width:103px;height:40px;font-size:30px;" /><br/><br/>
	</div>
	<div id="div_month" style="position:absolute;left:320px;top:202px;">
		<input type="text" id="month" name="month" value="<?php echo ($birthday[1]); ?>" maxlength="2" style="width:103px;height:40px;font-size:30px;"/><br/><br/>
	</div>
	<div id="div_day" style="position:absolute;left:490px;top:202px;">
		<input type="text" id="day" name="day" value="<?php echo ($birthday[2]); ?>" maxlength="2" style="width:103px;height:40px;font-size:30px;"/><br/><br/>
	</div>
</form>

<!-- 确定按钮 -->
 <div id="div_ok" style="position:absolute;width:140px;height:50px;left:150px;top:300px;">
    <!--  <img id="ok" title="" src="/static/v1/hd/images/usercenter/baseInfo/confirm_1.png" width="140" height="50">-->
 	<a id="focus" style="display:block" href="javascript:submit();" onclick="editSubmit()"
			onmouseover="changeImage('#btn_ok','/static/v1/hd/images/usercenter/baseInfo/confirm_2.png')" 
			onmouseout="changeImage('#btn_ok','/static/v1/hd/images/usercenter/baseInfo/confirm_1.png')"><img 
			id="btn_ok" src="/static/v1/hd/images/usercenter/baseInfo/confirm_1.png" width="140" height="50">
	</a>

</div>

<script type="text/javascript">

function changeImage(id,src){
	G(id).src = src;
}

function submit(){
	G('form').submit();
}

function focusHandler(){
//	G(Epg.btn.current.id).focus(); 
}

function blurHandler(){
//	G(Epg.btn.previous.id).blur(); 
}
</script>




<!-- 1.无背景图的文字提示 -->
<div id="popup_1"></div>

<!-- 2.有背景图的文字提示 -->
<div id="popup_2">
	<div id="popup_2_info_bg"></div>
	<div id="popup_2_info"></div>
</div>

</body>
</html>