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
        top:30px;
        left:85px;
        width: 235px;
        height: 90px;
        background: url(/static/v1/hd/images/courseList/title/title_<?php echo ($chKey); ?>.png) no-repeat;
    }
</style>

<script type="text/javascript">


var buttons=
	[
        /*龄段*/
	 	{id:'stage_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'stage_2',up:'',down:'course_1'},
        {id:'stage_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'stage_1',right:'stage_3',up:'',down:'course_2'},
        {id:'stage_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'stage_2',right:'stage_4',up:'',down:'course_2'},
        {id:'stage_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'stage_3',right:'stage_5',up:'',down:'course_2'},
        {id:'stage_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'stage_4',right:'stage_6',up:'',down:'course_2'},
        {id:'stage_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'stage_5',right:'',up:'',down:'course_2'},
        
        /* 课程列表 */
        {id:'course_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'',right:'course_2',up:'stage_1',down:'course_6'},
		{id:'course_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'course_1',right:'course_3',up:'stage_2',down:['course_7','course_6']},
		{id:'course_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'course_2',right:'course_4',up:'stage_3',down:['course_8','course_7','course_6']},
		{id:'course_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'course_3',right:'course_5',up:'stage_3',down:['course_9','course_8','course_7','course_6']},
		{id:'course_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'course_4',right:'',up:'stage_3',down:['course_10','course_9','course_8','course_7','course_6']},
		{id:'course_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'',right:'course_7',up:'course_1',down:''},
        {id:'course_7',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'course_6',right:'course_8',up:'course_2',down:''},
		{id:'course_8',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'course_7',right:'course_9',up:'course_3',down:''},
		{id:'course_9',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'course_8',right:'course_10',up:'course_4',down:''},
		{id:'course_10',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'course_9',right:'',up:'course_5',down:''},
	];

var stagelist = <?php echo ($json_stage); ?>;

/* 初始化按钮 属性   */
var initButtons = function(){
	//龄段
	for(var i=0; i<stagelist.length; i++)
	{
		buttons[i].name = stagelist[i].name;
		buttons[i].linkImage = stagelist[i].linkImage;
		buttons[i].focusImage = stagelist[i].focusImage;
	}
	
}

window.onload=function()
{
    initButtons();
	Epg.btn.init('course_1',buttons,true);
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 左上角的栏目LOGO -->
<div class="ch_logo"></div>

<!-- 龄段列表 -->
<?php if(is_array($stageList)): $i = 0; $__LIST__ = $stageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$stage): $mod = ($i % 2 );++$i; $left = 300+($i-1)*90; ?>
    <div id="div_stage_<?php echo ($i); ?>" title="<?php echo U('CourseList/index?chId='.$stage['chId'].'&stageId='.$stage['id']);?>" style="position:absolute;width:80px;height:38px;left:<?php echo ($left); ?>px;top:72px;text-align:center;">
        <img id="stage_<?php echo ($i); ?>" src="<?php echo ($stage['linkImage']); ?>">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 课程列表 -->
<?php if(is_array($courseList)): $i = 0; $__LIST__ = $courseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$course): $mod = ($i % 2 );++$i; if($i > 5){ $top = 415; $left = 80 + ($i-6)*225; }else{ $top = 182; $left = 80 + ($i-1)*225; } ?>
    <div id="div_course_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?chId='.$course['chId'].'&stageId='.$course['stageIds']);?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="course_<?php echo ($i); ?>" src="<?php echo ($course['imgUrl']); ?>" width="210" height="210">
    </div>
    <div id="div_course_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:230px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="course_<?php echo ($i); ?>_focus" src="" width="220" height="220">
    </div>

    <!-- 底部背景投影图 -->
    <?php if($i > 5): $left = 90 + ($i-6)*225; ?>
        <div class="shadow" style="left:<?php echo ($left); ?>px;"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>