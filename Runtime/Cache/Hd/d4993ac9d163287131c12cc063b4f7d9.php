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
        background: url(/static/v1/hd/images/course/early/age/ch_logo.png) no-repeat;
    }
</style>

<script type="text/javascript">


var buttons=
	[
        /*年级*/
	 	{id:'age_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'age_2',up:'',down:'course_1'},
        {id:'age_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'age_1',right:'age_3',up:'',down:'course_1'},
        {id:'age_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'age_2',right:'',up:'',down:'course_1'},
        
        /* 课程列表 */
        {id:'course_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'age_1',right:'course_2',up:'age_1',down:'course_6'},
		{id:'course_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_1',right:'course_3',up:'age_1',down:['course_7','course_6']},
		{id:'course_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_2',right:'course_4',up:'age_1',down:['course_8','course_7','course_6']},
		{id:'course_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_3',right:'course_5',up:'age_1',down:['course_9','course_8','course_7','course_6']},
		{id:'course_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_4',right:'course_6',up:'age_1',down:['course_10','course_9','course_8','course_7','course_6']},
		{id:'course_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_5',right:'course_7',up:'course_1',down:''},
        {id:'course_7',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_6',right:'course_8',up:'course_2',down:''},
		{id:'course_8',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_7',right:'course_9',up:'course_3',down:''},
		{id:'course_9',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_8',right:'course_10',up:'course_4',down:''},
		{id:'course_10',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'course_9',right:'',up:'course_5',down:''},
	];



window.onload=function()
{
	Epg.btn.init('age_1',buttons,true);
};
</script>

<!-- 左上角的栏目LOGO -->
<div class="ch_logo"></div>

<!-- 幼儿园大中小班 -->
<div id="div_age_1" style=" position: absolute;left:280px;top:70px;">
    <img id="age_1" src="/static/v1/hd/images/course/early/1.png" width="90" height="38" />
</div>
<div id="div_age_2" style=" position: absolute;left:380px;top:70px;">
    <img id="age_2" src="/static/v1/hd/images/course/early/2.png" width="90" height="38" />
</div>
<div id="div_age_3" style=" position: absolute;left:480px;top:70px;">
    <img id="age_3" src="/static/v1/hd/images/course/early/3.png" width="90" height="38" />
</div>

<!-- 课程列表 -->
<?php if(is_array($courseList)): $i = 0; $__LIST__ = $courseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$course): $mod = ($i % 2 );++$i; if($i > 5){ $top = 415; $left = 80 + ($i-6)*225; }else{ $top = 182; $left = 80 + ($i-1)*225; } ?>
    <div id="div_course_<?php echo ($i); ?>" title="<?php echo U('SectionList/early');?>" style="position:absolute;width:230px;height:210px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="course_<?php echo ($i); ?>" src="<?php echo ($course['content']); ?>" width="210" height="210">
    </div>
    <div id="div_course_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:216px;left:<?php echo ($left); ?>px;top:<?php echo ($top-3); ?>px;text-align:center;">
        <img id="course_<?php echo ($i); ?>_focus" src="" width="216" height="216">
    </div>

    <!-- 底部背景投影图 -->
    <?php if($i > 5): $left = 90 + ($i-6)*225; ?>
        <div class="shadow" style="left:<?php echo ($left); ?>px;"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>