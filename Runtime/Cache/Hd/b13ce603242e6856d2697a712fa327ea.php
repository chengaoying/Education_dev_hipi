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

	body{ background-image:url(/static/v1/hd/images/usercenter/bg.jpg); }
/* 用户信息背景底框 */
#bottom{
	position: absolute;
	display: block;
	width: 790px;
	height: 433px;
	top: 160px;
	left: 390px;
	background-image: url(/static/v1/hd/images/usercenter/learningEarly/bottom.png);
}

</style>

<script type="text/javascript">
	var faceNum = <?php echo ($face); ?>;
	var channel = <?php echo ($json_channel); ?>;
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'changeNum',down:'ch_2',right:'option_1'}, 
	{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'ch_1',down:'ch_3',right:'option_1'}, 
	{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'ch_2',right:'option_1'},

	{id:'selectFace',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',selectBox:'/static/v1/hd/images/usercenter/leftNavigation/title_kuang.png',right:'nickname',up:'ch_3',down:'changeNum'},
	{id:'changeNum',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account.png',focusImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account_over.png',selectBox:'',right:'sex',up:'selectFace',down:'ch_1'},

	{id:'option_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learningEarly/month.png',focusImage:'/static/v1/hd/images/usercenter/learningEarly/month_over.png',selectBox:'',left:'ch_2',down:'option_2'},
	{id:'option_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learningEarly/all.png',focusImage:'/static/v1/hd/images/usercenter/learningEarly/all_over.png',selectBox:'',left:'ch_2',up:'option_1'},

	];
	
	var initButtons = function()
	{
 		for(var i=0; i<channel.length; i++)
		{
			buttons[i].name = channel[i].name;
			buttons[i].linkImage = channel[i].linkImage;
			buttons[i].focusImage = channel[i].focusImage;
		} 
	}
	window.onload = function() {
		initButtons();
		Epg.btn.init('ch_2', buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="bottom"></div>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>


<!-- 以下是导航栏 -->
<?php if(is_array($channels)): $i = 0; $__LIST__ = $channels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i; $left = 120; $top = 430 + ($i-1)*60; ?>
    <div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility:visible;left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($channel['linkUrl']); ?>"
			src="<?php echo ($channel['linkImage']); ?>" width="170" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- progress -->
<?php $__FOR_START_10086__=1;$__FOR_END_10086__=10;for($i=$__FOR_START_10086__;$i < $__FOR_END_10086__;$i+=1){ $left = 600 + ($i-1)*65; $top = 253; ?>
	
<!-- 	<div  style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img  src="/static/v1/hd/images/usercenter/learnEvaluation1/color_<?php echo ($i); ?>.png" width="45" height="300">
	</div> -->
	<div  style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img  src="/static/v1/hd/images/usercenter/learningEarly/progress.png" width="45" height="<?php echo ($curProgress[$i-1]); ?>">
	</div><?php } ?>

<!-- 选择按钮"本月 总体" -->
<div id="div_option_1" style="position: absolute; left: 400px; top: 250px;">
	<img id='option_1' title="/Hd/Learning/learningEarly?arrange=month"
		src="/static/v1/hd/images/usercenter/learningEarly/month.png" width="140" height="40">
</div>
<div id="div_option_2" style="position: absolute; left:400px; top:300px;">
	<img id='option_2' title="/Hd/Learning/learningEarly?arrange=all"
		src="/static/v1/hd/images/usercenter/learningEarly/all.png" width="140" height="40">
</div>

<!-- 选择头像  -->
<div id="div_selectFace" style="position:absolute;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace" title="<?php echo U('Role/selectFace');?>" src="/static/v1/hd/images/usercenter/baseInfo/face_<?php echo ($face); ?>.png" width="130" height="170">
</div>
<div id="div_selectFace_focus" style="position:absolute;visibility:hidden;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace_focus" title="" src="" width="125" height="165">
</div>
<!-- 切换账号  -->
<div id="div_changeNum" style="position:absolute;left:95px;top:322px;text-align:center;">
	<img id="changeNum" title="<?php echo U('Role/changeNum');?>" src="/static/v1/hd/images/usercenter/leftNavigation/change_account.png" width="110" height="25">
</div>


<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>