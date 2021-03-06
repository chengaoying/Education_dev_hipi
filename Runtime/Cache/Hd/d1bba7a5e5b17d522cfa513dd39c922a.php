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
/* 用户中心 */
#usercenter{
	position: absolute;
	display: block;
	width: 134px;
	height: 34px;
	top: 85px;
	left: 90px;
	background-image: url(/static/v1/hd/images/usercenter/channel/usercenter.png);
}
/* 文字8+1 */
#word{
	position: absolute;
	display: block;
	width: 90px;
	height: 46px;
	top: 540px;
	left: 100px;
	background-image: url(/static/v1/hd/images/usercenter/learnEvaluation1/word.png);
}
/* 树 */
#tree{
	position: absolute;
	display: block;
	width: 233px;
	height: 173px;
	top: 425px;
	left: 195px;
	background-image: url(/static/v1/hd/images/usercenter/learnEvaluation1/tree.png);
}
/* 进度条文字 */
#word2{
	position: absolute;
	display: block;
	width: 655px;
	height: 28px;
	top: 570px;
	left: 495px;
	background-image: url(/static/v1/hd/images/usercenter/learnEvaluation1/word_2.png);
}

</style>

<script type="text/javascript">
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/glory_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/glory_2.png',onFocus:'1',selectBox:'',right:'ch_2',down:'option_1'}, 
	{id:'ch_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/learning_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/learning_2.png',onFocus:'1',selectBox:'',left:'ch_1',right:'ch_3',down:'option_1'}, 
	{id:'ch_3',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/baseInfo_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/baseInfo_2.png',onFocus:'1',selectBox:'',left:'ch_2',down:'option_1'},

	{id:'option_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learnEvaluation1/month_1.png',focusImage:'/static/v1/hd/images/usercenter/learnEvaluation1/month_2.png',selectBox:'',right:'option_2',up:'ch_2'},
	{id:'option_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learnEvaluation1/total_1.png',focusImage:'/static/v1/hd/images/usercenter/learnEvaluation1/total_2.png',selectBox:'',left:'option_1',up:'ch_2'},

	
	];

	window.onload = function() {
		Epg.btn.init('ch_2', buttons, true);
	};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',1);?>" ></a>
<!-- 静态图片 -->
<div id="bottom"></div>
<div id="word"></div>
<div id="tree"></div>
<div id="word2"></div>
<div id="usercenter"></div>


<!-- 以下是导航栏 -->
<!-- 荣誉成就 -->
<div id="div_ch_1" style="position:absolute;visibility:visible;left:300px;top:95px;">
	<img id='ch_1' title="/Hd/Glory/index"
		src="/static/v1/hd/images/usercenter/channel/glory_1.png" width="110" height="33">
</div>
<div id="div_ch_1_focus" style="position:absolute; visibility:hidden;left:300px;top:95px; text-align:center;">
	<img id="ch_1_focus" src="/static/v1/hd/images/usercenter/channel/glory_2.png" width="110" height="33">
</div>
<!-- 学习评估 -->
<div id="div_ch_2" style="position:absolute;visibility:visible;left:450px; top:95px;">
	<img id='ch_2' title="/Hd/Learning/<?php echo ($stageType); ?>?arrange=month"
		src="/static/v1/hd/images/usercenter/channel/learning_1.png" width="110" height="33">
</div>
<div id="div_ch_2_focus" style="position:absolute; visibility:hidden; left:450px; top:95px; text-align:center;">
	<img id="ch_2_focus" src="/static/v1/hd/images/usercenter/channel/learning_2.png" width="110" height="33">
</div>
<!-- 基本信息 -->
<div id="div_ch_3" style="position:absolute;visibility:visible;left:600px; top:95px;">
	<img id='ch_3' title="/Hd/Role/userInfo"
		src="/static/v1/hd/images/usercenter/channel/baseInfo_1.png" width="110" height="33">
</div>
<div id="div_ch_3_focus" style="position:absolute; visibility:hidden; left:600px; top:95px; text-align:center;">
	<img id="ch_3_focus" src="/static/v1/hd/images/usercenter/channel/baseInfo_2.png" width="110" height="33">
</div>


<!-- progress -->
<?php $__FOR_START_30789__=1;$__FOR_END_30789__=10;for($i=$__FOR_START_30789__;$i < $__FOR_END_30789__;$i+=1){ $left = 520 + ($i-1)*70; $top = 270; ?>
	
	<div  style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img  src="/static/v1/hd/images/usercenter/learnEvaluation1/color_<?php echo ($i); ?>.png" width="45" height="300">
	</div>
	<div  style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top-2); ?>px;">
		<img  src="/static/v1/hd/images/usercenter/learnEvaluation1/progress.png" width="47" height="<?php echo ($curProgress[$i-1]); ?>">
	</div><?php } ?>

<!-- 选择按钮"本月 总体" -->
<div id="div_option_1" style="position: absolute; left: 520px; top: 200px;">
	<img id='option_1' title="/Hd/Learning/<?php echo ($stageType); ?>?arrange=month"
		src="/static/v1/hd/images/usercenter/learnEvaluation1/month_1.png" width="100" height="40">
</div>
<div id="div_option_2" style="position: absolute; left:630px; top:200px;">
	<img id='option_2' title="/Hd/Learning/<?php echo ($stageType); ?>?arrange=all"
		src="/static/v1/hd/images/usercenter/learnEvaluation1/total_1.png" width="100" height="40">
</div>

<!-- 头像 -->
<div  style="position:absolute; left:240px; top:195px;">
	<img  src="/static/v1/hd/images/usercenter/baseInfo/face_<?php echo ($face); ?>.png" width="130" height="170">
</div>
<!-- 昵称 -->
<div  style="position:absolute; left:215px; top:370px; border-style:none; width:180px;height:37px;text-align:center;">
	<span style="color:black;"><?php echo ($name); ?></span>
</div>





<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>