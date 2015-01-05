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
    body{ background-image:url(/static/v1/hd/images/test/video/bj.jpg); }
    
</style>

<style type="text/css">
#div_left{
	position:absolute;
	width:185px;
	height:720px;
	top:0px;
 	left:0px;
	visibility:visible;
	background-image: url(/static/v1/hd/images/play/left_bg.png);
}

#div_top{
	position:absolute;
	width:1280px;
	height:150px;
	top:0px;
 	left:0px;
	visibility:visible;
}

</style>

<script type="text/javascript">
    var buttons=
	[
        /*左边按钮*/
	 	{id:'btn_pre',name:'',action:'',linkImage:'/static/v1/hd/images/play/btn_pre.png',focusImage:'/static/v1/hd/images/play/btn_pre_over.png',selectBox:'',left:'',right:['btn_preview','btn_lesson','btn_exercise'],up:'btn_preview',down:'btn_current'},
        {id:'btn_current',name:'',action:'',linkImage:'/static/v1/hd/images/play/btn_current.png',focusImage:'/static/v1/hd/images/play/btn_current_over.png',selectBox:'',left:'',right:['btn_preview','btn_lesson','btn_exercise'],up:'btn_pre',down:'btn_next'},
        {id:'btn_next',name:'',action:'',linkImage:'/static/v1/hd/images/play/btn_next.png',focusImage:'/static/v1/hd/images/play/btn_next_over.png',selectBox:'',left:'',right:['btn_preview','btn_lesson','btn_exercise'],up:'btn_current',down:''},
        
        /*上边按钮*/
        {id:'btn_preview',name:'',action:'',linkImage:'/static/v1/hd/images/play/btn_preview.png',focusImage:'/static/v1/hd/images/play/btn_preview_over.png',selectBox:'',left:['btn_pre','btn_current','btn_next'],right:'btn_lesson',up:'',down:''},
        {id:'btn_lesson',name:'',action:'',linkImage:'/static/v1/hd/images/play/btn_lesson.png',focusImage:'/static/v1/hd/images/play/btn_lesson_over.png',selectBox:'',left:['btn_preview','btn_pre','btn_current','btn_next'],right:'btn_exercise',up:'',down:''},
        {id:'btn_exercise',name:'',action:'',linkImage:'/static/v1/hd/images/play/btn_exercise.png',focusImage:'/static/v1/hd/images/play/btn_exercise_over.png',selectBox:'',left:['btn_lesson','btn_preview','btn_pre','btn_current','btn_next'],right:'',up:'',down:''},
    ];
    
    window.onload=function()
    {
        Epg.btn.init('btn_current',buttons,true);
    };
</script>    

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 页面左侧 -->
<div id="div_left">
	<!-- 上一集 -->
	<div id="div_btn_pre" style="position:absolute;width:135px;height:60px;left:35px;top:240px;">
		<img id="btn_pre" src="/static/v1/hd/images/play/btn_pre.png" width="125" height="50">
	</div>
	<!-- 正在学习 -->
	<div id="div_btn_current" style="position:absolute;width:135px;height:60px;left:35px;top:320px;">
		<img id="btn_current" src="/static/v1/hd/images/play/btn_current.png" width="125" height="50">
	</div>
	<!-- 下一集 -->
	<div id="div_btn_next" style="position:absolute;width:135px;height:60px;left:35px;top:400px;">
		<img id="btn_next" src="/static/v1/hd/images/play/btn_next.png" width="125" height="50">
	</div>
</div>

<!-- 页面上方 -->
<div id="div_top">
	<!-- 预习-->
	<div id="div_btn_preview" style="position:absolute;width:160px;height:60px;left:720px;top:50px;">
		<img id="btn_preview" src="/static/v1/hd/images/play/btn_preview.png" width="150" height="50">
	</div>
	<!-- 同步课堂-->
	<div id="div_btn_lesson" style="position:absolute;width:160px;height:60px;left:890px;top:50px;">
		<img id="btn_lesson" src="/static/v1/hd/images/play/btn_lesson.png" width="150" height="50">
	</div>
	<!-- 练习-->
	<div id="div_btn_exercise" style="position:absolute;width:160px;height:60px;left:1060px;top:50px;">
		<img id="btn_exercise" title="<?php echo U('Library/detail?id='.$sectionId.'&topicId='.$topicId);?>" src="/static/v1/hd/images/play/btn_exercise.png" width="150" height="50">
	</div>
</div>


<script type="text/javascript">

/**
 * 左侧菜单滚动效果
 */
function scrollMenu()
{
	var curId = Epg.btn.current.id;
	if(curId != 'btn_pre' && curId != 'btn_current' && curId != 'btn_next')
	{
		var divLeft = G('div_left');
		var left = divLeft.style.left.replace("px", "") 
		if(left > -185)
			left -= 20;
		divLeft.style.left = left + "px"; 
		//H('div_left');
		
		/* var divTop = G('div_top');
		divTop.style.top = "0px"; */
	}
	else
	{
		var divLeft = G('div_left');
		divLeft.style.left = "0px";  
		//S('div_left');
		
		/* var divTop = G('div_top');
		var top = divTop.style.top.replace("px", "") 
		if(top > -150)
			top -= 20;
		divTop.style.top = top + "px"; */
	}
}

setInterval('scrollMenu()',100);

var play = function()
{
	var rtsp = "rtsp://192.168.0.5:8554/videos/prog00000002a1270023000008654266.ts";
	Epg.Mp.init(true);//true表示启用默认的遥控器提示功能
	Epg.Mp.fullscreenPlay(rtsp);
}

//setTimeout("play()", 500);

</script>



<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>