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
.page .now	{ width:150px;}
body {background-color: transparent;}
</style>
</head>
<body>

<style type="text/css">
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
    
    /* 左上角栏目logo */
    .ch_logo{
        position: absolute;
        display: block;
        top:60px;
        left:85px;
        width: 185px;
        height: 42px;
        background: url(/static/v1/hd/images/course/kinder/ch_logo.png) no-repeat;
    }
    
    /* 幼儿园哪个班 */
    .classlevel{
        position: absolute;
        display: block;
        top:65px;
        left:265px;
        width: 90px;
        height: 38px;
        background: url(/static/v1/hd/images/course/kinder/<?php echo ($classLevel); ?>_class.png) no-repeat;
    }
    
    
</style>

<script type="text/javascript">


var buttons=
	[
        /*一周课程*/
        {id:'week_course',name:'',action:'',linkImage:'/static/v1/hd/images/course/kinder/week_course.png',focusImage:'/static/v1/hd/images/course/kinder/week_course_over.png',selectBox:'',left:'',right:'video_1',up:'',down:'video_1'},
        
        /*视频列表*/
	 	{id:'video_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'',right:'video_2',up:'',down:'special_1'},
        {id:'video_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:'special_1'},
        {id:'video_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'week_course',down:['special_2','special_1']},
        {id:'video_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_4',right:'special_1',up:'week_course',down:['special_3','special_2','special_1']},
        
        /* 专题列表 */
        {id:'special_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:['video_5','video_4','video_3','video_2','video_1'],right:'special_2',up:'video_1',down:''},
		{id:'special_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'special_1',right:'special_3',up:['video_3','video_2','video_1'],down:''},
		{id:'special_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'special_2',right:'',up:['video_5','video_4','video_3','video_2','video_1'],down:''},
	];


window.onload=function()
{
	Epg.btn.init('week_course',buttons,true);	
};
</script>

<!-- 左上角的栏目LOGO -->
<div class="ch_logo"></div>

<!-- 幼儿园哪个班 -->
<div class="classlevel"></div>

<!-- 一周课程 -->
<div id="div_week_course" title="<?php echo U('Course/week');?>" style="position: absolute;width:98px;height:40px;left:1090px;top:65px;">
        <img id="week_course" src="/static/v1/hd/images/course/kinder/week_course.png" width="98" height="40" />
</div>

<!-- 上面视频列表 -->
<?php if(is_array($videoList)): $i = 0; $__LIST__ = $videoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): $mod = ($i % 2 );++$i; $top = 186; $left = 85 + ($i-1)*225; ?>
    <div id="div_video_<?php echo ($i); ?>" style="position:absolute;width:230px;height:210px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="video_<?php echo ($i); ?>" src="<?php echo ($video['content']); ?>" width="210" height="270">
    </div>
    <div id="div_video_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:216px;left:<?php echo ($left); ?>px;top:<?php echo ($top-3); ?>px;text-align:center;">
        <img id="video_<?php echo ($i); ?>_focus" src="" width="216" height="276">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 下面专题列表 -->
<?php if(is_array($specialList)): $i = 0; $__LIST__ = $specialList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$special): $mod = ($i % 2 );++$i; $top = 476; $left = 95 + ($i-1)*375; $tipTop = 576;$tipLeft = 360 + ($i-1)*375; ?>
    <div id="div_special_<?php echo ($i); ?>" style="position:absolute;width:360px;height:150px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="special_<?php echo ($i); ?>" src="<?php echo ($special['content']); ?>" width="360" height="150">
    </div>
    <div id="div_special_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:216px;left:<?php echo ($left); ?>px;top:<?php echo ($top-3); ?>px;text-align:center;">
        <img id="special_<?php echo ($i); ?>_focus" src="" width="360" height="150">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>