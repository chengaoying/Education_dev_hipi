<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">
.page td	{ height:26px; text-align:center;color:#000;font-weight: 600; font-size:22px;}
.page .up	{ width:64px;}
.page .down	{ width:64px;}
.page .now	{ width:150px;}
body {background-color: transparent;}
</style>
</head>
<body>

<style>
    body{ background-image:url(/static/v1/hd/images/common/uc_bg.jpg); }

#text_age{
	position: absolute;
    display: block;
    width: 222px;
    height: 43px;
    left: 125px;
    top: 190px;
    background-image:url(/static/v1/hd/images/usercenter/text_age.png);
}  
#package{
	position: absolute;
    display: block;
	width: 200px;
    height: 203px;
    left: 170px;
    top: 350px;
    background-image:url(/static/v1/hd/images/usercenter/package.png);
}  
#info_bg{
	position: absolute;
    display: block;
	width: 596px;
    height: 386px;
    left: 550px;
    top: 160px;
    background-image:url(/static/v1/hd/images/usercenter/info_bg.png);
}
</style>

<script type="text/javascript">

/* 页面可点击按钮  */
var buttons=
	[
		{id:'s1_1',name:'一年级',action:'J(2)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s1_2',down:'s1_4'},
		{id:'s1_2',name:'二年级',action:'J(5)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s1_1',right:'s1_3',down:'s1_5'},
		{id:'s1_3',name:'三年级',action:'J(10)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s1_2',down:'s1_6'},
		{id:'s1_4',name:'四年级',action:'J(11)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s1_5',up:'s1_1',down:'s2_1'},
		{id:'s1_5',name:'五年级',action:'J(12)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s1_4',right:'s1_6',up:'s1_2',down:'s2_2'},
		{id:'s1_6',name:'六年级',action:'J(13)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s1_5',up:'s1_3',down:'s2_3'},
		
		{id:'s2_1',name:'小班',action:'J(4)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s2_2',up:'s1_4',down:'s3_1'},
		{id:'s2_2',name:'中班',action:'J(6)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s2_1',right:'s2_3',up:'s1_5',down:'s3_2'},
		{id:'s2_3',name:'大班',action:'J(3)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s2_2',up:'s1_6',down:'s3_3'},
		
		{id:'s3_1',name:'0-1岁',action:'J(7)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s3_2',up:'s2_1',down:'skip'},
		{id:'s3_2',name:'1-2岁',action:'J(8)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s3_1',right:'s3_3',up:'s2_2',down:'skip'},
		{id:'s3_3',name:'2-3岁',action:'J(9)',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s3_2',up:'s2_3',down:'skip'},
		
		{id:'skip',name:'跳过',action:'J(99)',linkImage:'/static/v1/hd/images/usercenter/btn_skip.png',focusImage:'/static/v1/hd/images/usercenter/btn_skip_over.png',up:'s3_3'},
	];


window.onload=function()
{
	//Epg.tip('');//显示info信息，3秒后自动隐藏，如果info为空将不会显示
	Epg.btn.init('s1_1',buttons,true);	
};

</script>


<!-- 静态图片 -->
<div id="text_age"></div>
<div id="package"></div>
<div id="info_bg"></div>

<!-- 小学 -->
<?php if(is_array($stage['primaryschool'])): $i = 0; $__LIST__ = $stage['primaryschool'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s1): $mod = ($i % 2 );++$i; if($i > 3){ $top = 270; $left = 730 + ($i-4)*125; }else{ $top = 200; $left = 730 + ($i-1)*125; } ?>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img id="s1_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/btn.png" width="110" height="50">
	</div>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img src="/static/v1/hd/images/usercenter/primary_<?php echo ($s1['sKey']); ?>.png" width="110" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 幼儿园 -->
<?php if(is_array($stage['preschool'])): $i = 0; $__LIST__ = $stage['preschool'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s2): $mod = ($i % 2 );++$i; $top = 360; $left = 730 + ($i-1)*125; ?>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img id="s2_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/btn.png" width="110" height="50">
	</div>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;;">
		<img src="/static/v1/hd/images/usercenter/preschool_<?php echo ($s2['sKey']); ?>.png" width="110" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 早教 -->
<?php if(is_array($stage['early'])): $i = 0; $__LIST__ = $stage['early'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s3): $mod = ($i % 2 );++$i; $top = 450; $left = 730 + ($i-1)*125; ?>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img id="s3_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/btn.png" width="110" height="50">
	</div>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img src="/static/v1/hd/images/usercenter/early_<?php echo ($s3['sKey']); ?>.png" width="110" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 跳过 -->
<div style="position:absolute;left:970px;top:580px;">
	<img id="skip" src="/static/v1/hd/images/usercenter/btn_skip.png" width="170" height="40">
</div>

<script type="text/javascript">

/**
 * 跳转
 * @param id 龄段id 
 */
function J(id){
	location.href = "<?php echo U('Role/createRole');?>" + '?id=' + id;
}

</script>





</body>
</html>