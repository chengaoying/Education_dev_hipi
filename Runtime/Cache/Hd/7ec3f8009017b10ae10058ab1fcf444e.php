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

<style type="text/css">
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
    
    #empty_course_bg{
        position:absolute;
        display: block;
        width:210px;
        height:210px;
        top:182px;
        left:90px;	
        background-image:url(/static/v1/hd/images/index/myCourse/empty_bg.png);
    }
    /* 底部投影背景图 */
    .shadow{
        position:absolute;
        display: block;
        width:210px;
        height:54px;
        top:620px;
        background-image:url(/static/v1/hd/images/common/shadow/shadow_210x60.png);
    }
</style>
<!--上面导航-->
<script type="text/javascript">

//栏目object(json格式数据)
var channel = <?php echo ($json_channel); ?>;

var buttons=
	[
	 	/* 栏目  */
		{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',resize:'-1',focusHandler:'focusHandler()',right:'ch_2',down:['course_1','empty_course']},
		{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',resize:'-1',blurHandler:'blurHandler()',left:'ch_1',right:'ch_3',down:['course_1','empty_course']},
		{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',resize:'-1',focusHandler:'focusHandler()',left:'ch_2',down:['course_1','empty_course']},
        
        /* 当课程列表不为空 */
        {id:'course_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'ch_1',right:'course_2',up:'ch_1',down:'course_6'},
		{id:'course_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_1',right:'course_3',up:'ch_3',down:['course_7','course_6']},
		{id:'course_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_2',right:'course_4',up:'ch_3',down:['course_8','course_7','course_6']},
		{id:'course_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_3',right:'course_5',up:'ch_3',down:['course_9','course_8','course_7','course_6']},
		{id:'course_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_4',right:'',up:'ch_3',down:['course_10','course_9','course_8','course_7','course_6']},
		{id:'course_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'',right:'course_7',up:'course_1',down:''},
        {id:'course_7',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_6',right:'course_8',up:'course_2',down:''},
		{id:'course_8',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_7',right:'course_9',up:'course_3',down:''},
		{id:'course_9',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_8',right:'course_10',up:'course_4',down:''},
		{id:'course_10',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_9',right:'',up:'course_5',down:''},
        
        /* 课程为空时选择课程 */
        {id:'empty_course',name:'',action:'',linkImage:'/static/v1/hd/images/index/myCourse/select_course.png',focusImage:'/static/v1/hd/images/index/myCourse/select_course_over.png',selectBox:'',up:'ch_1'},
	];

/* 初始化按钮 属性   */
var initButtons = function(){
	//栏目
	for(var i=0; i<channel.length; i++)
	{
		buttons[i].name = channel[i].name;
		buttons[i].linkImage = channel[i].linkImage;
		buttons[i].focusImage = channel[i].focusImage;
		buttons[i].titleImage = channel[i].titleImage;
	}
	
}

window.onload=function()
{
	initButtons();
	Epg.btn.init('ch_2',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',0);?>" ></a>

<!-- 顶部-栏目 -->
<?php if(is_array($topChannel)): $i = 0; $__LIST__ = $topChannel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i; $left = 100 + ($i-1)*150; $top = 95; ?>
	<div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility: visible;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($ch['linkUrl']); ?>" src="<?php echo ($ch['linkImage']); ?>" width="110" height="33">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 我的课程开始 -->
<?php if(count($myCourse) > 0): ?><!-- 课程列表 -->
    <?php if(is_array($myCourse)): $i = 0; $__LIST__ = $myCourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i; if($i > 5){ $top = 405; $left = 80 + ($i-6)*225; }else{ $top = 180; $left = 80 + ($i-1)*225; } ?>
        <div id="div_course_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?courseId='.$c['courseId']);?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
            <img id="course_<?php echo ($i); ?>" src="<?php echo ($c['courseImg']); ?>" width="210" height="210">
        </div>
        <div id="div_course_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:230px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
            <img id="course_<?php echo ($i); ?>_focus" src="" width="220" height="220">
        </div>
        
        <!-- 底部背景投影图 -->
        <?php if($i > 5): $left = 85 + ($i-6)*225; ?>
            <div class="shadow" style="left:<?php echo ($left); ?>px;"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
<?php else: ?> 
<!-- 当课程为空的时候提示去选择课程 -->
<div id="empty_course_bg"></div>
<div id="div_empty_course" title="<?php echo U('Index/allCourse');?>" style="position:absolute;width:98px;height:40px;left:145px;top:335px;text-align:center;">
	<img id="empty_course" src="/static/v1/hd/images/index/myCourse/select_course.png" width="98" height="40">
</div><?php endif; ?>
<!-- 我的课程结束 -->

<script type="text/javascript">

//失去时焦点处理（目前主要用于栏目按钮）
function blurHandler(){
	if(Epg.btn.current.id != "ch_1" && Epg.btn.current.id != "ch_3"){
		G(Epg.btn.previous.id).src = Epg.btn.previous.titleImage;
	}
}

//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	if(Epg.btn.current.id != "ch_2"){
		setTimeout("Epg.btn.click()",50)
	}
}

</script>


<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>