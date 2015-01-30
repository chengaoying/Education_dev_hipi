<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">
</style>
<script type="text/javascript">

<?php $floatMsg = Session('floatMessage'); Session('floatMessage',null); ?>

/**
 * 页面弹窗，弹窗类型：
 * @param type 弹窗类型：1-小图提示信息，2-大图提示信息，不设置则默认为1
 */
var popup = function(type){
	Epg.popup("<?php echo ($floatMsg); ?>",3,type);
}	

</script>

</head>
<body >

<style type="text/css">
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
    
/* 底部投影背景图 */
.shadow{
	position:absolute;
    display: block;
    width:210px;
    height:55px;
	top:615px;
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
		{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',focusHandler:'focusHandler()',right:'ch_2',down:['course_1','empty_course']},
		{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',blurHandler:'blurHandler()',left:'ch_1',right:'ch_3',down:['course_1','empty_course']},
		{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',focusHandler:'focusHandler()',left:'ch_2',down:['course_1','empty_course']},
        
        /* 当课程列表不为空 */
        {id:'course_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'pageUp()',right:'course_2',up:'ch_1',down:'course_6'},
		{id:'course_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_1',right:'course_3',up:'ch_3',down:['course_7','course_6']},
		{id:'course_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_2',right:'course_4',up:'ch_3',down:['course_8','course_7','course_6']},
		{id:'course_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_3',right:'course_5',up:'ch_3',down:['course_9','course_8','course_7','course_6']},
		{id:'course_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_4',right:'pageDown()',up:'ch_3',down:['course_10','course_9','course_8','course_7','course_6']},
		{id:'course_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'pageUp()',right:'course_7',up:'course_1',down:''},
        {id:'course_7',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_6',right:'course_8',up:'course_2',down:''},
		{id:'course_8',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_7',right:'course_9',up:'course_3',down:''},
		{id:'course_9',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_8',right:'course_10',up:'course_4',down:''},
		{id:'course_10',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_9',right:'pageDown()',up:'course_5',down:''},
        
        /* 课程为空时选择课程 */
        {id:'empty_course',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',up:'ch_1'},
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

var url = "<?php echo U('Index/myCourse').'?page=';?>";

//上一页
function pageUp()
{
	Epg.page(url,<?php echo ($page); ?>-1,<?php echo ($pageCount); ?>);
}

//下一页
function pageDown()
{
	Epg.page(url,<?php echo ($page); ?>+1,<?php echo ($pageCount); ?>);
}

var defaultId = "<?php echo ($preFocus); ?>";

window.onload=function()
{
	initButtons();
	
	//处理页面跳转时的焦点定位:
	defaultId = Epg.isEmpty(defaultId) ? "<?php echo ($focus); ?>" : defaultId;
	if(Epg.isEmpty(G(defaultId))) 
		defaultId = "course_1";
	G('ch_2').src = buttons[1].titleImage;
	Epg.btn.init([defaultId,'ch_2'],buttons,true);
	
	
	//设置翻页键事件
	Epg.key.set(
	{
		KEY_PAGE_UP:'pageUp()',
		KEY_PAGE_DOWN:'pageDown()',
	});
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',0);?>" ></a>

<!-- 顶部-栏目 -->
<?php if(is_array($topChannel)): $i = 0; $__LIST__ = $topChannel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i; $left = 100 + ($i-1)*180; $top = 95; ?>
	<div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility: visible;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($ch['linkUrl']); ?>" src="<?php echo ($ch['linkImage']); ?>" width="130" height="44">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 课程背景图片 -->
<?php $__FOR_START_2063__=1;$__FOR_END_2063__=11;for($j=$__FOR_START_2063__;$j < $__FOR_END_2063__;$j+=1){ if($j > 5){ $t = 405; $l = 80 + ($j-6)*225; }else{ $t = 180; $l = 80 + ($j-1)*225; } ?>

	<div id="div_empty_png_<?php echo ($j); ?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($l); ?>px;top:<?php echo ($t); ?>px;text-align:center;">
	    <img id="empty_png_<?php echo ($j); ?>" src="/static/v1/hd/images/index/myCourse/empty_bg.png" width="210" height="210">
	</div><?php } ?>

<!-- 静态图片-底部投影效果 -->
<?php $__FOR_START_12444__=1;$__FOR_END_12444__=6;for($i=$__FOR_START_12444__;$i < $__FOR_END_12444__;$i+=1){ $lt = 85 + ($i-1)*225; ?>
	<div class="shadow" style="left:<?php echo ($lt); ?>px;"></div><?php } ?>

<!-- 我的课程开始 -->
<?php if(count($myCourse) > 0): ?><!-- 课程列表 -->
    <?php if(is_array($myCourse)): $i = 0; $__LIST__ = $myCourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i; if($i > 5){ $top = 405; $left = 80 + ($i-6)*225; }else{ $top = 180; $left = 80 + ($i-1)*225; } ?>
        <div id="div_course_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?courseId='.$c['courseId'].'&preFocus=course_'.$i);?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
            <img id="course_<?php echo ($i); ?>" src="<?php echo ($c['courseImg']); ?>" width="210" height="210">
        </div>
        <div id="div_course_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:230px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
            <img id="course_<?php echo ($i); ?>_focus" src="" width="220" height="220">
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
<?php else: ?> 
	<!-- 当课程为空的时候提示去选择课程 -->
	<div id="div_empty_course" title="<?php echo U('Index/allCourse');?>" style="position:absolute;width:220px;height:220px;left:80px;top:180px;text-align:center;">
        <img id="empty_course" src="/static/v1/hd/images/index/myCourse/select_course.png" width="210" height="210">
    </div>
    <div id="div_empty_course_focus" style="position:absolute;visibility:hidden;width:230px;height:230px;left:75px;top:175px;text-align:center;">
        <img id="empty_course_focus" src="" width="220" height="220">
    </div><?php endif; ?>
<!-- 我的课程结束 -->

<!-- 上一页/下一页 -->
<?php if($page > 1): ?><div id="div_btn_prev" style="position:absolute;width:25px;height:44px;left:45px;top:380px;">
	    <img id="btn_prev" src="/static/v1/hd/images/common/page/btn_prev.png" width="25" height="44">
	</div><?php endif; ?>
<?php if($page < $pageCount): ?><div id="div_btn_next" style="position:absolute;width:25px;height:44px;left:1210px;top:380px;">
	    <img id="btn_next" src="/static/v1/hd/images/common/page/btn_next.png" width="25" height="44">
	</div><?php endif; ?>


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
		setTimeout("Epg.btn.click()",500)
	}
}

</script>


<!-- 1.无背景图的文字提示 -->
<div id="popup_1"></div>

<!-- 2.有背景图的文字提示 -->
<div id="popup_2">
	<div id="popup_2_info_bg"></div>
	<div id="popup_2_info"></div>
</div>

</body>
</html>