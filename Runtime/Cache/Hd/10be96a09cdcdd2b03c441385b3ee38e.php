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
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }

/* 左侧文字 */
#text_age{
	position: absolute;
    display: block;
    width: 222px;
    height: 43px;
    left: 125px;
    top: 190px;
    background-image:url(/static/v1/hd/images/usercenter/text_age.png);
}  

/* 书包  */
#package{
	position: absolute;
    display: block;
	width: 200px;
    height: 203px;
    left: 170px;
    top: 350px;
    background-image:url(/static/v1/hd/images/usercenter/package.png);
}  

/* 龄段底图 */
#info_bg{
	position: absolute;
    display: block;
	width: 596px;
    height: 530px;
    left: 550px;
    top: 100px;
    background-image:url(/static/v1/hd/images/usercenter/info_bg.png);
}
</style>

<script type="text/javascript">

/* 页面可点击按钮  */
var buttons=
	[
		{id:'s1_1',name:'0-1岁',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s1_2',up:'',down:'s2_1'},
		{id:'s1_2',name:'1-2岁',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s1_1',right:'s1_3',up:'',down:'s2_2'},
		{id:'s1_3',name:'2-3岁',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s1_2',up:'',down:'s2_3'},
		
		{id:'s2_1',name:'小班',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s2_2',up:'s1_1',down:'s3_1'},
		{id:'s2_2',name:'中班',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s2_1',right:'s2_3',up:'s1_2',down:'s3_2'},
		{id:'s2_3',name:'大班',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s2_2',up:'s1_3',down:'s3_3'},
		
		{id:'s3_1',name:'一年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s3_2',up:'s2_1',down:'s3_4'},
		{id:'s3_2',name:'二年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s3_1',right:'s3_3',up:'s2_2',down:'s3_5'},
		{id:'s3_3',name:'三年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s3_2',up:'s2_3',down:'s3_6'},
		{id:'s3_4',name:'四年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s3_5',up:'s3_1',down:'s4_1'},
		{id:'s3_5',name:'五年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s3_4',right:'s3_6',up:'s3_2',down:'s4_2'},
		{id:'s3_6',name:'六年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s3_5',up:'s3_3',down:'s4_3'},
		
		{id:'s4_1',name:'一年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s4_2',up:'s3_4',down:'s5_1'},
		{id:'s4_2',name:'二年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s4_1',up:'s3_5',right:'s4_3',down:'s5_2'},
		{id:'s4_3',name:'三年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s4_2',up:'s3_6',down:'s5_3'},
		
		{id:'s5_1',name:'四年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',right:'s5_2',up:'s4_1',down:'skip'},
		{id:'s5_2',name:'五年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s5_1',right:'s5_3',up:'s4_2',down:'skip'},
		{id:'s5_3',name:'六年级',action:'',linkImage:'/static/v1/hd/images/usercenter/btn.png',focusImage:'/static/v1/hd/images/usercenter/btn_over.png',left:'s5_2',up:'s4_3',down:'skip'},
		
		{id:'skip',name:'跳过',action:'',linkImage:'/static/v1/hd/images/usercenter/btn_skip.png',focusImage:'/static/v1/hd/images/usercenter/btn_skip_over.png',up:'s5_3'},
	];

window.onload=function()
{
	//Epg.tip('');//显示info信息，3秒后自动隐藏，如果info为空将不会显示
	Epg.btn.init('s1_1',buttons,true);	
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',0);?>" ></a>

<!-- 静态图片 -->
<div id="text_age"></div>
<div id="package"></div>
<div id="info_bg"></div>

<!-- 早教 -->
<?php if(is_array($stage['early'])): $i = 0; $__LIST__ = $stage['early'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s1): $mod = ($i % 2 );++$i; $top = 160; $left = 730 + ($i-1)*125; ?>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img id="s1_<?php echo ($i); ?>" title="<?php echo U('Role/changeStage?stageId='.$s1['id']);?>" src="/static/v1/hd/images/usercenter/btn.png" width="110" height="50">
	</div>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img src="/static/v1/hd/images/usercenter/early_<?php echo ($s1['sKey']); ?>.png" width="110" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 幼儿园 -->
<?php if(is_array($stage['preschool'])): $i = 0; $__LIST__ = $stage['preschool'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s2): $mod = ($i % 2 );++$i; $top = 230; $left = 730 + ($i-1)*125; ?>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img id="s2_<?php echo ($i); ?>" title="<?php echo U('Role/changeStage?stageId='.$s2['id']);?>" src="/static/v1/hd/images/usercenter/btn.png" width="110" height="50">
	</div>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;;">
		<img src="/static/v1/hd/images/usercenter/preschool_<?php echo ($s2['sKey']); ?>.png" width="110" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 小学 -->
<?php if(is_array($stage['primaryschool'])): $i = 0; $__LIST__ = $stage['primaryschool'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s3): $mod = ($i % 2 );++$i; if($i > 3){ $top = 380; $left = 730 + ($i-4)*125; }else{ $top = 308; $left = 730 + ($i-1)*125; } ?>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img id="s3_<?php echo ($i); ?>" title="<?php echo U('Role/changeStage?stageId='.$s3['id']);?>" src="/static/v1/hd/images/usercenter/btn.png" width="110" height="50">
	</div>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img src="/static/v1/hd/images/usercenter/primary_<?php echo ($s3['sKey']); ?>.png" width="110" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 初中 -->
<?php if(is_array($stage['middleschool'])): $i = 0; $__LIST__ = $stage['middleschool'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s4): $mod = ($i % 2 );++$i; $top = 457; $left = 730 + ($i-1)*125; ?>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img id="s4_<?php echo ($i); ?>" title="<?php echo U('Role/changeStage?stageId='.$s4['id']);?>" src="/static/v1/hd/images/usercenter/btn.png" width="110" height="50">
	</div>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img src="/static/v1/hd/images/usercenter/middle_<?php echo ($s4['sKey']); ?>.png" width="110" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!--  高中 -->
<?php if(is_array($stage['highschool'])): $i = 0; $__LIST__ = $stage['highschool'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s5): $mod = ($i % 2 );++$i; $top = 538; $left = 730 + ($i-1)*125; ?>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img id="s5_<?php echo ($i); ?>" title="<?php echo U('Role/changeStage?stageId='.$s5['id']);?>" src="/static/v1/hd/images/usercenter/btn.png" width="110" height="50">
	</div>
	<div style="position:absolute;top:<?php echo ($top); ?>px;left:<?php echo ($left); ?>px;">
		<img src="/static/v1/hd/images/usercenter/high_<?php echo ($s5['sKey']); ?>.png" width="110" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 跳过 -->
<div style="position:absolute;left:970px;top:645px;">
	<img id="skip" title="<?php echo U('Role/changeStage');?>?stageId=99" src="/static/v1/hd/images/usercenter/btn_skip.png" width="170" height="40">
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