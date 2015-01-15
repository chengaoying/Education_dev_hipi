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

<?php $__FOR_START_21441__=1;$__FOR_END_21441__=11;for($i=$__FOR_START_21441__;$i < $__FOR_END_21441__;$i+=1){ $left = 130 + (($i-1)%5)*210; $top = 210 + (ceil($i/5)-1)*210; ?>
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






<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>