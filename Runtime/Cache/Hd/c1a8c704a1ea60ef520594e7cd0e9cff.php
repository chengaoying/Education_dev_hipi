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
.page .now	{ width:50px;}
body {background-color: transparent;}

#div_popup{
	position:absolute;
	visibility:hidden;
	width:560px;
	height:357px;
	top:180px;
	left:360px;
	background-image: url(/static/v1/hd/images/common/popup/info_bg.png);
}

</style>
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
/* 小女孩 */
#girl{
	position: absolute;
	display: block;
	width: 194px;
	height: 114px;
	top:150px;
	left:620px;
	background-image: url(/static/v1/hd/images/usercenter/learnEvaluation2/girl.png);
}
/* 文字 */
#word{
	position: absolute;
	display: block;
	width: 462px;
	height: 23px;
	top:215px;
	left:165px;
	background-image: url(/static/v1/hd/images/usercenter/learnEvaluation2/word.png);
}

</style>

<script type="text/javascript">

var nowpage = <?php echo ($page['nowPage']); ?>;
var totalpage = <?php echo ($page['totalPages']); ?>;
var preBtn = "<?php echo ($preId); ?>";
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/glory_1.png',focusImage:'/static/v1/hd/images/usercenter/glory_2.png',selectBox:'',right:'ch_2',down:'detail_1'}, 
	{id:'ch_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learning_1.png',focusImage:'/static/v1/hd/images/usercenter/learning_2.png',selectBox:'',left:'ch_1',right:'ch_3',down:'detail_1'}, 
	{id:'ch_3',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseinfo_1.png',focusImage:'/static/v1/hd/images/usercenter/baseinfo_2.png',selectBox:'',left:'ch_2',down:'detail_1'},

	{id:'detail_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learnEvaluation2/detail_1.png',focusImage:'/static/v1/hd/images/usercenter/learnEvaluation2/detail_2.png',selectBox:'',left:'',down:['detail_2','page_prev','page_next'],up:'ch_2'},
	{id:'detail_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learnEvaluation2/detail_1.png',focusImage:'/static/v1/hd/images/usercenter/learnEvaluation2/detail_2.png',selectBox:'',left:'',down:['detail_3','page_prev','page_next'],up:'detail_1'},
	{id:'detail_3',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learnEvaluation2/detail_1.png',focusImage:'/static/v1/hd/images/usercenter/learnEvaluation2/detail_2.png',selectBox:'',left:'',down:['page_prev','page_next'],up:'detail_2'},

	{id:'page_prev',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:'',up:['detail_3','detail_2','detail_1']},
	{id:'page_next',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:'',up:['detail_3','detail_2','detail_1']},

	
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

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',1);?>" ></a>

<!-- 静态图片 -->
<div id="bottom"></div>
<div id="girl"></div>
<div id="word"></div>


<!-- 以下是导航栏 -->
<!-- 荣誉成就 -->
<div id="div_ch_1" style="position: absolute; left: 100px; top: 75px;">
	<img id='ch_1' title="/Hd/Glory/index"
		src="/static/v1/hd/images/usercenter/glory_1.png" width="92" height="26">
</div>
<!-- 学习评估 -->
<div id="div_ch_2" style="position: absolute; left: 250px; top: 75px;">
	<img id='ch_2' title="/Hd/Learning/<?php echo ($stageType); ?>"
		src="/static/v1/hd/images/usercenter/learning_1.png" width="92" height="26">
</div>
<!-- 基本信息 -->
<div id="div_ch_3" style="position: absolute; left: 400px; top: 75px;">
	<img id='ch_3' title="/Hd/Role/userInfo"
		src="/static/v1/hd/images/usercenter/baseinfo_1.png" width="92" height="26">
</div>



<?php if(is_array($page['data'])): $i = 0; $__LIST__ = $page['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; $left = 160; $top = 270 + ($i-1)*95; $progress = $data*390/100; ?>
	<div style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img src="/static/v1/hd/images/usercenter/learnEvaluation2/evaluation_bottom.jpg" width="960" height="80">
	</div>
	<!-- progress bar -->
	<div style="position:absolute; left:<?php echo ($left+410); ?>px; top:<?php echo ($top+50); ?>px;">
		<img src="/static/v1/hd/images/usercenter/learnEvaluation2/progress.jpg" width="<?php echo ($progress); ?>" height="10">
	</div>
	<!-- detail -->
	<div id="div_detail_<?php echo ($i); ?>" style="position:absolute; left:<?php echo ($left+810); ?>px; top:<?php echo ($top+20); ?>px;">
		<img id="detail_<?php echo ($i); ?>" title="<?php echo U('Learning/detail');?>" src="/static/v1/hd/images/usercenter/learnEvaluation2/detail_1.png" width="59" height="36">
	</div>
	<!-- default -->
	<div id="div_default_<?php echo ($i); ?>" style="position:absolute; left:<?php echo ($left+880); ?>px; top:<?php echo ($top+20); ?>px;">
		<img id="default_<?php echo ($i); ?>" title="<?php echo U('Learning/learningEvaluation2');?>" src="/static/v1/hd/images/usercenter/learnEvaluation2/default_1.png" width="63" height="36">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 分页 -->
<div style="position:absolute; left:920px; top:560px;">
	<?php echo ($page['pageHtml']); ?>
</div>



<!-- 弹窗 -->
<div id="div_popup">
</div>
</body>
</html>