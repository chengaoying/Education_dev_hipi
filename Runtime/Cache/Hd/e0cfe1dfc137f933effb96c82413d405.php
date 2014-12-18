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
    
    /*一周背景*/
    .weekbg{
        position: absolute;
        display: block;
        top:180px;
        left:75px;
        width: 1130px;
        height: 440px;
        background: url(/static/v1/hd/images/course/kinder/week_bg.png) no-repeat;
    }
</style>

<script type="text/javascript">


var buttons=
	[
        /*一周课程*/
        {id:'week_course',name:'',action:'',linkImage:'/static/v1/hd/images/course/kinder/week_course.png',focusImage:'/static/v1/hd/images/course/kinder/week_course_over.png',selectBox:'',left:'',right:'video_1',up:'',down:'video_1'},
        
        /*视频列表*/
	 	{id:'video_1_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'',right:'video_2',up:'',down:'special_1'},
        {id:'video_1_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:'special_1'},
        {id:'video_1_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'week_course',down:['special_2','special_1']},
        {id:'video_1_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_1_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_4',right:'special_1',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_2_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'',right:'video_2',up:'',down:'special_1'},
        {id:'video_2_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:'special_1'},
        {id:'video_2_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'week_course',down:['special_2','special_1']},
        {id:'video_2_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_2_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_4',right:'special_1',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_3_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'',right:'video_2',up:'',down:'special_1'},
        {id:'video_3_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:'special_1'},
        {id:'video_3_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'week_course',down:['special_2','special_1']},
        {id:'video_3_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_3_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_4',right:'special_1',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_4_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'',right:'video_2',up:'',down:'special_1'},
        {id:'video_4_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:'special_1'},
        {id:'video_4_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'week_course',down:['special_2','special_1']},
        {id:'video_4_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_4_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_4',right:'special_1',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_5_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'',right:'video_2',up:'',down:'special_1'},
        {id:'video_5_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:'special_1'},
        {id:'video_5_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'week_course',down:['special_2','special_1']},
        {id:'video_5_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_5_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_4',right:'special_1',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_6_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'',right:'video_2',up:'',down:'special_1'},
        {id:'video_6_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:'special_1'},
        {id:'video_6_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'week_course',down:['special_2','special_1']},
        {id:'video_6_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'week_course',down:['special_3','special_2','special_1']},
        {id:'video_7_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'',right:'video_2',up:'',down:'special_1'},
        {id:'video_7_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:'special_1'},
        {id:'video_7_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'week_course',down:['special_2','special_1']},
        {id:'video_7_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'week_course',down:['special_3','special_2','special_1']},
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

<!-- 一周背景  -->
<div class="weekbg"></div>

<!-- 一周视频列表 -->
<?php if(is_array($videoList)): $i = 0; $__LIST__ = $videoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$week): $mod = ($i % 2 );++$i; if(is_array($week)): $key = 0; $__LIST__ = $week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): $mod = ($key % 2 );++$key; $left = 85+($i-1)*160; $top = 260+($key-1)*72; ?>
        <div id="div_video_<?php echo ($i); ?>_<?php echo ($key); ?>" style="position:absolute;width:150px;height:70px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;line-height: 70px;text-align:center;color:#666;">
            <?php if(($i == 6 and $key == 4) or ($i == 7 and $key == 4)): ?><img id="video_<?php echo ($i); ?>_<?php echo ($key); ?>" src="<?php echo ($video['content']); ?>" width="150" height="139">
            <?php else: ?>
                <?php echo ($video['name']); endif; ?>
        </div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>


</body>
</html>