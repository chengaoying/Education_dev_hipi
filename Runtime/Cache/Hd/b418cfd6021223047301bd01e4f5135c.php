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
        background: url(/static/v1/hd/images/sectionList/title_preschool.png) no-repeat;
    }
    
    .weekinfo{
        position: absolute;
        display: block;
        top:70px;
        left:885px;
        width: 57px;
        height: 26px;
        background: url(/static/v1/hd/images/sectionList/preschool/weekinfo.png) no-repeat;
    }
    
    /* 幼儿园哪个班 */
    .class{
        position: absolute;
        display: block;
        top:70px;
        left:290px;
        width: 54px;
        height: 29px;
        background: url(/static/v1/hd/images/courseList/title/preschool/<?php echo ($sKey); ?>_title.png) no-repeat;
    }
    
	.shadow{
        position: absolute;
        width:1110px;
        height:50px;
        top:617px;
        left:90px;
        background: url(/static/v1/hd/images/common/shadow_3.png) no-repeat;
    }
</style>

<script type="text/javascript">

var buttons=
	[
		/* 订购按钮 */	
		{id:'btn_order',name:'订购',action:'',linkImage:'/static/v1/hd/images/common/order/btn_order.png',focusImage:'/static/v1/hd/images/common/order/btn_order_over.png',selectBox:'',left:'',right:['day_1','day_2','day_3'],up:'',down:['video_2','video_1']},

        //三天
        {id:'day_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'btn_order',right:'day_2',up:'',down:'video_4'},
        {id:'day_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'day_1',right:'day_3',up:'',down:'video_5'},
        {id:'day_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'day_2',right:'btn_week',up:'',down:'video_5'},
        
        /*一周课程*/
        {id:'btn_week',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/preschool/btn_week.png',focusImage:'/static/v1/hd/images/sectionList/preschool/btn_week_over.png',selectBox:'',left:'day_3',right:'',up:'',down:['video_5','video_4','video_3','video_2','video_1']},
        
        /*视频列表*/
	 	{id:'video_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x320.gif',left:'',right:'video_2',up:'btn_week',down:'special_1'},
        {id:'video_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x320.gif',left:'video_1',right:'video_3',up:'btn_week',down:'special_1'},
        {id:'video_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x320.gif',left:'video_2',right:'video_4',up:'btn_week',down:['special_2','special_1']},
        {id:'video_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x320.gif',left:'video_3',right:'video_5',up:'btn_week',down:['special_3','special_2','special_1']},
        {id:'video_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x320.gif',left:'video_4',right:'special_1',up:'btn_week',down:['special_3','special_2','special_1']},
        
        /* 专题列表 */
        {id:'special_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_360x150.gif',left:'',right:'special_2',up:'video_1',down:''},
		{id:'special_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_360x150.gif',left:'special_1',right:'special_3',up:['video_3','video_2','video_1'],down:''},
		{id:'special_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_360x150.gif',left:'special_2',right:'',up:['video_5','video_4','video_3','video_2','video_1'],down:''},
	];
    
var daylist = <?php echo ($json_day); ?>;

/* 初始化按钮 属性   */
var initButtons = function(){
	//栏目
	for(var i=0; i<daylist.length; i++)
	{
		buttons[i+1].name = daylist[i].name;
		buttons[i+1].linkImage = daylist[i].linkImage;
		buttons[i+1].focusImage = daylist[i].focusImage;
	}
	
}

window.onload=function()
{
    initButtons();
	Epg.btn.init('day_3',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 左上角的栏目LOGO -->
<div class="ch_logo"></div>

<!-- 幼儿园哪个班 -->
<div class="class"></div>

<!-- 订购 -->
<div id="div_btn_order" style="position:absolute;width:100px;height:40px;top:65px;left:365px;">
	<img id="btn_order" src="/static/v1/hd/images/common/order/btn_order.png">
</div>

<!-- 三天 -->
<?php if(is_array($dayList)): $i = 0; $__LIST__ = $dayList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$day): $mod = ($i % 2 );++$i; $left = 945+($i-1)*48; ?>
    <div id="div_day_<?php echo ($i); ?>" style="position: absolute;width:43px;height:40px;left:<?php echo ($left); ?>px;top:65px;">
        <img id="day_<?php echo ($i); ?>" src="<?php echo ($day['linkImage']); ?>" width="43" height="40" />
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 星期 -->
<div class="weekinfo"></div>

<!-- 一周课程 -->
<div id="div_btn_week" title="<?php echo U('SectionList/week');?>" style="position: absolute;width:98px;height:40px;left:1095px;top:65px;">
	<img id="btn_week" src="/static/v1/hd/images/sectionList/preschool/btn_week.png" width="98" height="40" />
</div>

<!-- 视频列表 -->
<?php if(is_array($videoList)): $i = 0; $__LIST__ = $videoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): $mod = ($i % 2 );++$i; $top = 180; $left = 85 + ($i-1)*225; ?>
    <div id="div_video_<?php echo ($i); ?>" style="position:absolute;width:220px;height:280px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="video_<?php echo ($i); ?>" src="<?php echo ($video['imgUrl']); ?>" width="210" height="270">
    </div>
    <div id="div_video_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:290px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="video_<?php echo ($i); ?>_focus" src="" width="220" height="280">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 专题列表 -->
<?php if(is_array($specialList)): $i = 0; $__LIST__ = $specialList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$special): $mod = ($i % 2 );++$i; $top = 465; $left = 85 + ($i-1)*375; ?>
    <div id="div_special_<?php echo ($i); ?>" style="position:absolute;width:370px;height:160px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="special_<?php echo ($i); ?>" src="<?php echo ($special['imgUrl']); ?>" width="360" height="150">
    </div>
    <div id="div_special_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:380px;height:170px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="special_<?php echo ($i); ?>_focus" src="" width="370" height="160">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 投影 -->
<div class="shadow"></div>



</body>
</html>