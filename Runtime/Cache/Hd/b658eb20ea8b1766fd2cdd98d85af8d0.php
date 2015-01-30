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
//	alert("<?php echo ($info); ?>");
	Epg.popup("<?php echo ($floatMsg); ?>",3,type);
}	

</script>

</head>
<body >


<style>

	body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
/* 用户信息背景底框 */
#bottom{
	position: absolute;
	display: block;
	width: 1110px;
	height: 435px;
	top: 180px;
	left: 85px;
	background-image: url(/static/v1/hd/images/usercenter/bottom.png);
}
/* 文字介绍 */
#word_view{
	position: absolute;
	display: block;
	width: 614px;
	height: 74px;
	top: 90px;
	left: 110px;
	background-image: url(/static/v1/hd/images/usercenter/glory/word_view.png);
}

</style>

<script type="text/javascript">
	var buttons = [

/* 	          	{id:'page_prev',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:''},
	        	{id:'page_next',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:''},
 */	 
				];

	window.onload = function() {
		Epg.key.init();
		Epg.key.set(
				{
					KEY_BACK:'Epg.Button.defBack()',		//返回键
					KEY_0:'Epg.Button.defBack()',			//按0返回
				});
		
	};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Glory/index',1);?>" ></a>

<!-- 静态图片 -->
<!-- <div id="bottom"></div> -->
<div id="word_view"></div>

<?php $__FOR_START_3131__=1;$__FOR_END_3131__=11;for($i=$__FOR_START_3131__;$i < $__FOR_END_3131__;$i+=1){ $left = 130 + (($i-1)%5)*210; $top = 210 + (ceil($i/5)-1)*210; ?>
	<!-- 礼物底  -->
	<div style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img src="/static/v1/hd/images/usercenter/glory/bottom_gift.png" width="190" height="190">
	</div>
	<!-- 礼物  -->
	<div style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img src="/static/v1/hd/images/usercenter/glory/gift/gift_0.png" width="190" height="190">
	</div><?php } ?>

<!-- 分页 -->
<!-- <div style="position:absolute; left:920px; top:105px;">
	<?php echo ($page['pageHtml']); ?>
</div> -->






<!-- 1.无背景图的文字提示 -->
<div id="popup_1"></div>

<!-- 2.有背景图的文字提示 -->
<div id="popup_2">
	<div id="popup_2_info_bg"></div>
	<div id="popup_2_info"></div>
</div>

</body>
</html>