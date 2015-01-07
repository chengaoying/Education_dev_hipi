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
/* logo */
#logo{
	position: absolute;
	display: block;
	width: 245px;
	height: 48px;
	top:190px;
	left:80px;
	background-image: url(/static/v1/hd/images/usercenter/detail/logo.png);
}
/* 文字图片 */
#word{
	position: absolute;
	display: block;
	width: 506px;
	height: 23px;
	top:210px;
	left:460px;
	background-image: url(/static/v1/hd/images/usercenter/detail/word.png);
}

</style>

<script type="text/javascript">
var preBtn = "<?php echo ($preId); ?>";
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/glory_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/glory_2.png',onFocus:'1',selectBox:'',right:'ch_2',down:['page_prev','page_next']}, 
	{id:'ch_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/learning_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/learning_2.png',onFocus:'1',selectBox:'',left:'ch_1',right:'ch_3',down:['page_prev','page_next']}, 
	{id:'ch_3',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/baseInfo_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/baseInfo_2.png',onFocus:'1',selectBox:'',left:'ch_2',down:['page_prev','page_next']},

	{id:'page_prev',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:'',up:'ch_2'},
	{id:'page_next',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:'',up:'ch_2'},
	
	];

	window.onload = function() {
		if(preBtn=='page_prev' || preBtn=='page_next')
		{
			Epg.btn.init(preBtn, buttons, true);
		}
		else
		{
			Epg.btn.init('ch_2', buttons, true);
		}
	};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Learning/learningEvaluation2',1);?>" ></a>
<!-- 静态图片 -->
<div id="bottom"></div>
<div id="logo"></div>
<div id="word"></div>
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
	<img id='ch_2' title="/Hd/Learning/<?php echo ($stageType); ?>"
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


<?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($i%2==0) { $left = 650; $top= 270 + ($i/2-1)*50; } else { $left = 100; $top= 270 + (($i+1)/2-1)*50; } $progress = $data*390/100; ?>
	<div style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		文字
	</div>
	<div style="position:absolute; left:<?php echo ($left+210); ?>px; top:<?php echo ($top+5); ?>px;">
		<img src="/static/v1/hd/images/usercenter/detail/bottom.png" width="293" height="11">
	</div>
	<div style="position:absolute; left:<?php echo ($left+210); ?>px; top:<?php echo ($top+5); ?>px;">
		<img src="/static/v1/hd/images/usercenter/detail/progress.png" width="293" height="11">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 分页 -->
<div style="position:absolute; left:980px; top:560px;">
	<?php echo ($page['pageHtml']); ?>
</div>



<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>