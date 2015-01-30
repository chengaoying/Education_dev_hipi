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
    
/* 通用logo */
.ch_logo_common{
    position: absolute;
    display: block;
    top:90px;
    left:90px;
    width: 118px;
    height: 41px;
    background: url(/static/v1/hd/images/courseList/title/title_<?php echo ($chKey); ?>.png) no-repeat;
}

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

<script type="text/javascript">


var buttons=
	[
        /*龄段*/
	 	{id:'stage_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',left:'',right:'stage_2',up:'',down:'course_1'},
        {id:'stage_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',left:'stage_1',right:'stage_3',up:'',down:['course_2','course_1']},
        {id:'stage_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',left:'stage_2',right:['stage_4','stage_5','stage_6','page_prev','page_next'],up:'',down:['course_2','course_1']},
        {id:'stage_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',left:'stage_3',right:['stage_5','stage_6','page_prev','page_next'],up:'',down:['course_2','course_1']},
        {id:'stage_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',left:'stage_4',right:['stage_6','page_prev','page_next'],up:'',down:['course_3','course_2','course_1']},
        {id:'stage_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',left:'stage_5',right:['page_prev','page_next'],up:'',down:['course_3','course_2','course_1']},
        
        {id:'page_prev',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',left:['stage_6','stage_5','stage_4','stage_3','stage_2','stage_1'],right:'page_next',down:['course_5','course_4','course_3','course_2','course_1']},
    	{id:'page_next',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:['page_prev','stage_6','stage_5','stage_4','stage_3','stage_2','stage_1'],down:['course_5','course_4','course_3','course_2','course_1']},
        
        /* 课程列表 */
        {id:'course_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'pageUp()',right:'course_2',up:['stage_1'],down:'course_6'},
		{id:'course_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_1',right:'course_3',up:'stage_2',down:['course_7','course_6']},
		{id:'course_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_2',right:'course_4',up:['stage_4','stage_3'],down:['course_8','course_7','course_6']},
		{id:'course_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_3',right:'course_5',up:['stage_6','stage_3'],down:['course_9','course_8','course_7','course_6']},
		{id:'course_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_4',right:'pageDown()',up:['stage_6','stage_3'],down:['course_10','course_9','course_8','course_7','course_6']},
		{id:'course_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'pageUp()',right:'course_7',up:'course_1',down:''},
        {id:'course_7',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_6',right:'course_8',up:'course_2',down:''},
		{id:'course_8',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_7',right:'course_9',up:'course_3',down:''},
		{id:'course_9',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_8',right:'course_10',up:'course_4',down:''},
		{id:'course_10',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_9',right:'pageDown()',up:'course_5',down:''},
	];

var stagelist = <?php echo ($json_stage); ?>;

var cur_stage = "";      //页面当前龄段(默认为页面中的第一个龄段)
var curr_stage_title_img = "";	//当前龄段的titleImage

/* 初始化按钮 属性   */
var initButtons = function(){
	//龄段
	for(var i=0; i<stagelist.length; i++)
	{
		buttons[i].name = stagelist[i].name;
		buttons[i].linkImage = stagelist[i].linkImage;
		buttons[i].focusImage = stagelist[i].focusImage;
		buttons[i].titleImage = stagelist[i].titleImage;
		
		//判断当前栏目
		if(stagelist[i].id == "<?php echo ($stageId); ?>"){
			cur_stage = buttons[i].id;
			curr_stage_title_img = buttons[i].titleImage;
		}
	}
	
}

var url = "<?php echo U('CourseList/index').'?chId='.$chId.'&stageId='.$stageId;?>";

//上一页
function pageUp()
{
	url += "&focus="+Epg.btn.current.id+"&page=";
	Epg.page(url,<?php echo ($page); ?>-1,<?php echo ($pageCount); ?>);
}

//下一页
function pageDown()
{
	url += "&focus="+Epg.btn.current.id+"&page=";
	Epg.page(url,<?php echo ($page); ?>+1,<?php echo ($pageCount); ?>);
}

var defaultId = "<?php echo ($preFocus); ?>";

window.onload=function()
{
    initButtons();
    
    //处理页面跳转时的焦点定位:
	defaultId = Epg.isEmpty(defaultId) ? "<?php echo ($focus); ?>" : defaultId;
    if(defaultId.indexOf('class_') != -1 || Epg.isEmpty(defaultId)){
    	defaultId = cur_stage;
    }else{
    	if(Epg.isEmpty(G(defaultId))) 
    		defaultId = "course_1";
    	if(!Epg.isEmpty(G(cur_stage))) 
    		G(cur_stage).src = curr_stage_title_img;
    }
   
	Epg.btn.init([defaultId,'course_1'],buttons,true);
	
	//设置翻页键翻页事件
	Epg.key.set(
	{
		KEY_PAGE_UP:'pageUp()',
		KEY_PAGE_DOWN:'pageDown()',
	});

};

</script>

<a id="a_back" style="display:none;" href="<?php echo ($backUrl); ?>" ></a>

<!-- 左上角的栏目LOGO -->
<div class="ch_logo_common"></div>

<!-- 龄段列表 -->
<?php if(is_array($stageList)): $i = 0; $__LIST__ = $stageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$stage): $mod = ($i % 2 );++$i; $left = 230+($i-1)*110; ?>
    <div id="div_stage_<?php echo ($i); ?>" title="<?php echo U('CourseList/index?chId='.$stage['chId'].'&stageId='.$stage['id']);?>" style="position:absolute;width:90px;height:37px;left:<?php echo ($left); ?>px;top:95px;text-align:center;">
        <img id="stage_<?php echo ($i); ?>" src="<?php echo ($stage['linkImage']); ?>" width="90" height="37">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 课程背景图片 -->
<?php $__FOR_START_24186__=1;$__FOR_END_24186__=11;for($j=$__FOR_START_24186__;$j < $__FOR_END_24186__;$j+=1){ if($j > 5){ $t = 405; $l = 80 + ($j-6)*225; }else{ $t = 180; $l = 80 + ($j-1)*225; } ?>

	<div id="div_empty_png_<?php echo ($j); ?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($l); ?>px;top:<?php echo ($t); ?>px;text-align:center;">
	    <img id="empty_png_<?php echo ($j); ?>" src="/static/v1/hd/images/index/myCourse/empty_bg.png" width="210" height="210">
	</div><?php } ?>

<!-- 静态图片-底部投影效果 -->
<?php $__FOR_START_5675__=1;$__FOR_END_5675__=6;for($i=$__FOR_START_5675__;$i < $__FOR_END_5675__;$i+=1){ $lt = 85 + ($i-1)*225; ?>
	<div class="shadow" style="left:<?php echo ($lt); ?>px;"></div><?php } ?>

<!-- 课程列表 -->
<?php if(is_array($courses)): $i = 0; $__LIST__ = $courses;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$course): $mod = ($i % 2 );++$i; if($i > 5){ $top = 405; $left = 80 + ($i-6)*225; }else{ $top = 180; $left = 80 + ($i-1)*225; } ?>
    <div id="div_course_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?courseId='.$course['id'].'&chId='.$chId.'&preFocus=course_'.$i);?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="course_<?php echo ($i); ?>" src="<?php echo get_upfile_url($course['imgUrl']);?>" width="210" height="210">
    </div>
    <div id="div_course_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:230px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="course_<?php echo ($i); ?>_focus" src="" width="220" height="220">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

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
	if(Epg.btn.current.id != "stage_1" && Epg.btn.current.id != "stage_2"
	   && Epg.btn.current.id != "stage_3" && Epg.btn.current.id != "stage_4"
	   && Epg.btn.current.id != "stage_5" && Epg.btn.current.id != "stage_6"){
			G(Epg.btn.previous.id).src = Epg.btn.previous.titleImage;
	}
}

//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	if(Epg.btn.current.id != cur_stage){
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