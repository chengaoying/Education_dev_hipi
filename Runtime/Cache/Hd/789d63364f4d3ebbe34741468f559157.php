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
	width: 1100px;
	height: 332px;
	top: 260px;
	left: 90px;
	background-image: url(/static/v1/hd/images/usercenter/detail/bottom.png);
}

/* 文字 */
#word{
	position: absolute;
	display: block;
	width: 184px;
	height: 28px;
	top:90px;
	left:95px;
	background-image: url(/static/v1/hd/images/usercenter/detail/word.png);
}

</style>

<script type="text/javascript">
	var buttons = [
	/* 栏目  */
	{id:'page_prev',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:'',up:['wrong_3','wrong_2','wrong_1'],left:'ch_2'},
	{id:'page_next',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:'',up:['wrong_3','wrong_2','wrong_1']},

	];
	
	window.onload = function() {
		Epg.btn.init('page_next', buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="bottom"></div>
<div id="word"></div>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>


<!-- 课程名字 -->
<div style="position:absolute;left:290px;top:88px;width:250px;height:37px;line-height:37px;text-align:left;border-style:none">
	<span><?php echo ($courseName); ?></span>
</div>
<?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($i%2==0) { $left = 650; $top= 270 + ($i/2-1)*55; } else { $left = 100; $top= 270 + (($i+1)/2-1)*55; } ?>
	<div style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;width:180px;height:37px;line-height:37px;text-align:right;border-style:none">
		<span><?php echo ($data['name']); ?></span>
	</div>
	<div style="position:absolute; left:<?php echo ($left+210); ?>px; top:<?php echo ($top+15); ?>px;">
		<img src="/static/v1/hd/images/usercenter/detail/progressBottom.png" width="300" height="15">
	</div>
	<div style="position:absolute; left:<?php echo ($left+210); ?>px; top:<?php echo ($top+15); ?>px;">
		<img src="/static/v1/hd/images/usercenter/detail/progress.png" width="<?php echo ($data['length']); ?>" height="15">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 分页 -->
<div style="position:absolute; left:1030px; top:620px;">
	<?php echo ($pageHtml); ?>
</div>


<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>