<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">

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


<style type="text/css">
#div_left{
	position:absolute;
	width:185px;
	height:720px;
	top:0px;
 	left:0px;
	background-image: url(/static/v1/hd/images/play/left_bg.png);
}

#div_top{
	position:absolute;
	width:1280px;
	height:150px;
	top:0px;
 	left:0px;
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
	<div id="div_btn_pre" style="position:inherit;width:135px;height:60px;left:25px;top:240px;">
		<img id="btn_pre" src="/static/v1/hd/images/play/btn_pre.png" width="125" height="50">
	</div>
	<!-- 正在学习 -->
	<div id="div_btn_current" style="position:inherit;width:135px;height:60px;left:25px;top:320px;">
		<img id="btn_current" src="/static/v1/hd/images/play/btn_current.png" width="125" height="50">
	</div>
	<!-- 下一集 -->
	<div id="div_btn_next" style="position:inherit;width:135px;height:60px;left:25px;top:400px;">
		<img id="btn_next" src="/static/v1/hd/images/play/btn_next.png" width="125" height="50">
	</div>
</div>

<!-- 页面上方 -->
<div id="div_top">
	<!-- 预习-->
	<div id="div_btn_preview" style="position:inherit;width:160px;height:60px;left:720px;top:50px;">
		<img id="btn_preview" src="/static/v1/hd/images/play/btn_preview.png" width="150" height="50">
	</div>
	<!-- 同步课堂-->
	<div id="div_btn_lesson" style="position:inherit;width:160px;height:60px;left:890px;top:50px;">
		<img id="btn_lesson" src="/static/v1/hd/images/play/btn_lesson.png" width="150" height="50">
	</div>
	<!-- 练习-->
	<div id="div_btn_exercise" style="position:inherit;width:160px;height:60px;left:1060px;top:50px;">
		<img id="btn_exercise" src="/static/v1/hd/images/play/btn_exercise.png" width="150" height="50">
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
		
		/* var divTop = G('div_top');
		divTop.style.top = "0px"; */
	}
	else
	{
		var divLeft = G('div_left');
		divLeft.style.left = "0px";
		
		/* var divTop = G('div_top');
		var top = divTop.style.top.replace("px", "") 
		if(top > -150)
			top -= 20;
		divTop.style.top = top + "px"; */
	}
}

setInterval('scrollMenu()',200);

</script>



<!-- 弹窗 -->
<div id="div_popup">
</div>
</body>
</html>