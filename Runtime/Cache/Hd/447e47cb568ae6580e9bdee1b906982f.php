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

/* 设置手机号  */
#phone_set{
	position:absolute;
    display: block;
    width:142px;
    height:41px;
    top:100px;
    left:150px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/phone_set.png);
}
</style>

<script type="text/javascript">

/* 页面可点击按钮  */
var buttons=
	[
		{id:'phone',name:'phone',action:'',linkImage:'',focusImage:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',right:'',down:'ok'},
		{id:'ok',name:'确定',action:'submit()',linkImage:'/static/v1/hd/images/usercenter/baseInfo/confirm_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/confirm_2.png',up:'phone',down:''},
	];


window.onload=function()
{
	//Epg.tip('');//显示info信息，3秒后自动隐藏，如果info为空将不会显示
	popup();
	Epg.btn.init('phone',buttons,true);	
	
	//删除0键返回事件
	Epg.key.del(
	{
		KEY_0:'',
	});
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',0);?>" ></a>

<!-- 静态图片 -->
<div id="phone_set"></div>

<form id="form" action="<?php echo U(Role/setNickname);?>" method="post" style="padding:10px">
	<div id="div_phone" style="position:absolute;left:150px;top:200px;">
		<input type="text" id="phone" name="phone" value="<?php echo ($phone); ?>" maxlength="11" style="width:200px;height:40px;font-size:30px;"/><br/><br/>
	</div>
</form>

<!-- 确定按钮 -->
 <div id="div_ok" style="position:absolute;width:140px;height:50px;left:150px;top:300px;">
    <!-- <img id="ok" title="" src="/static/v1/hd/images/usercenter/baseInfo/confirm_1.png" width="140" height="50"> -->
	<a id="focus" style="display:block" href="javascript:submit();" onclick="editSubmit()"
			onmouseover="changeImage('#btn_ok','/static/v1/hd/images/usercenter/baseInfo/confirm_2.png')" 
			onmouseout="changeImage('#btn_ok','/static/v1/hd/images/usercenter/baseInfo/confirm_1.png')"><img 
			id="btn_ok" src="/static/v1/hd/images/usercenter/baseInfo/confirm_1.png" width="140" height="50">
	</a>
</div>

<script type="text/javascript">

function submit(){
	G('form').submit();
}

function focusHandler(){
//	G('phone').focus();
}

function blurHandler(){
//	G('phone').blur();
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