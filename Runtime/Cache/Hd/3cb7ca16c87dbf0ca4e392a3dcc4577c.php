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


<?php  $month = $courseId - 1000; if(in_array($month,array(12,24,36))){ $probgwidth = 1110; }else{ $probgwidth = ($month%12)*86; } ?>

<style type="text/css">
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
    
    .monthbg{
        position: absolute;
        width:1110px;
        height:50px;
        top:580px;
        left:85px;
        background: url(/static/v1/hd/images/sectionList/early/month/bg.png) no-repeat;
    }
    
    .probg{
        position: absolute;
        width:<?php echo ($probgwidth); ?>px;
        height:5px;
        top:625px;
        left:85px;
        background: url(/static/v1/hd/images/sectionList/early/month/pro_bg.png) no-repeat;
    }
</style>
<script type="text/javascript">


var buttons=
	[
	 	/* logo */	
	 	{id:'btn_logo',name:'logo',action:'',linkImage:'/static/v1/hd/images/sectionList/title_early.png',focusImage:'/static/v1/hd/images/sectionList/title_early_over.png',selectBox:'',left:'',right:'btn_order',down:'topic_1'},
	 	
	 	/* 订购按钮 */	
	 	{id:'btn_order',name:'订购',action:'',linkImage:'/static/v1/hd/images/common/order/btn_order.png',focusImage:'/static/v1/hd/images/common/order/btn_order_over.png',selectBox:'',left:'btn_logo',right:'',up:'',down:['section_3','section_2','section_1']},
	 
        /*左侧知识点列表*/
	 	{id:'topic_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'section_1',up:'btn_logo',down:['topic_2','month_4']},
        {id:'topic_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'section_1',up:'topic_1',down:['topic_3','month_4']},
        {id:'topic_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'section_1',up:'topic_2',down:['topic_4','month_4']},
        {id:'topic_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:['section_4','section_1'],up:'topic_3',down:['topic_5','month_4']},
        {id:'topic_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:['section_4','section_1'],up:'topic_4',down:['topic_6','month_4']},
        {id:'topic_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:['section_4','section_1'],up:'topic_5',down:'month_4'},
        
        /* 右边视频列表 */
        {id:'section_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'topic_1',right:'section_2',up:'btn_order',down:['section_4','month_6']},
		{id:'section_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'section_1',right:'section_3',up:'btn_order',down:['section_5','month_9','section_4']},
		{id:'section_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'section_2',right:'',up:'btn_order',down:['section_6','section_5','month_12','section_4']},
		{id:'section_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:['topic_5','topic_4'],right:'section_5',up:'section_1',down:'month_6'},
		{id:'section_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'section_4',right:'section_6',up:'section_2',down:'month_9'},
		{id:'section_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'section_5',right:'',up:'section_3',down:'month_12'},
		
		/* 月份按钮 */
		{id:'month_1',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'month_2',up:['topic_6','topic_5','topic_4','topic_3','topic_2','topic_1']},
		{id:'month_2',name:'',action:'',linkImage:'',focusImage:'',left:'month_1',right:'month_3',up:['topic_6','topic_5','topic_4','topic_3','topic_2','topic_1']},
		{id:'month_3',name:'',action:'',linkImage:'',focusImage:'',left:'month_2',right:'month_4',up:['topic_6','topic_5','topic_4','topic_3','topic_2','topic_1']},
		{id:'month_4',name:'',action:'',linkImage:'',focusImage:'',left:'month_3',right:'month_5',up:['topic_6','topic_5','topic_4','topic_3','topic_2','topic_1']},
		{id:'month_5',name:'',action:'',linkImage:'',focusImage:'',left:'month_4',right:'month_6',up:['topic_6','topic_5','topic_4','topic_3','topic_2','topic_1']},
		{id:'month_6',name:'',action:'',linkImage:'',focusImage:'',left:'month_5',right:'month_7',up:['section_4','section_1']},
		{id:'month_7',name:'',action:'',linkImage:'',focusImage:'',left:'month_6',right:'month_8',up:['section_4','section_1']},
		{id:'month_8',name:'',action:'',linkImage:'',focusImage:'',left:'month_7',right:'month_9',up:['section_5','section_2']},
		{id:'month_9',name:'',action:'',linkImage:'',focusImage:'',left:'month_8',right:'month_10',up:['section_5','section_2']},
		{id:'month_10',name:'',action:'',linkImage:'',focusImage:'',left:'month_9',right:'month_11',up:['section_5','section_2']},
		{id:'month_11',name:'',action:'',linkImage:'',focusImage:'',left:'month_10',right:'month_12',up:['section_6','section_3']},
		{id:'month_12',name:'',action:'',linkImage:'',focusImage:'',left:'month_11',right:'',up:['section_6','section_3']},
	];

//知识点
var topics = <?php echo ($json_topic); ?>;
//月份
var months = <?php echo ($json_months); ?>;

//当前选中的知识点id
var cur_topic = "topic_1";
var cur_topic_title_img = '';

//当前课程/月份
var cur_course = "";
var cur_course_title_img = "";

/* 初始化按钮 属性   */
var initButtons = function(){
	//知识点
	for(var i=0; i<topics.length; i++)
	{
		buttons[i+2].name = topics[i].name;
		buttons[i+2].linkImage = topics[i].linkImage;
		buttons[i+2].focusImage = topics[i].focusImage;
		
		buttons[i+2].focusHandler = "focusHandler()";
		buttons[i+2].blurHandler = "blurHandler()";
		
		if("<?php echo ($topicId); ?>" == topics[i].id){
			cur_topic = buttons[i+2].id;
			cur_topic_title_img = buttons[i+2].focusImage;
		}
	}
	
	//月龄
	for(var i=0; i<months.length; i++)
	{
		buttons[i+14].linkImage = months[i].linkImage;
		buttons[i+14].focusImage = months[i].focusImage;
		
		buttons[i+14].focusHandler = "focusHandler2()";
		buttons[i+14].blurHandler = "blurHandler2()";
		
		if("<?php echo ($courseId); ?>" == months[i].courseId){
			cur_course = buttons[i+14].id;
			cur_course_title_img = buttons[i+14].focusImage;
		}
	}
	
}

var defaultId = "<?php echo ($focus); ?>";

window.onload=function()
{
    initButtons();
    popup();
    
  	//处理页面跳转时的焦点定位:
	defaultId = Epg.isEmpty(defaultId) ? "<?php echo ($preFocus); ?>" : defaultId;
	if(Epg.isEmpty(defaultId)){
    	defaultId = cur_topic;
    }else{
    	if(Epg.isEmpty(G(defaultId))) 
    		defaultId = cur_topic;
    	if(!Epg.isEmpty(G(cur_topic))) 
    		G(cur_topic).src = cur_topic_title_img;
    }
	
	if(!Epg.isEmpty(G(cur_course)))
		G(cur_course).src = cur_course_title_img;
	
	Epg.btn.init([defaultId,'section_1'],buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo ($backUrl); ?>" ></a>

<!-- 栏目LOGO -->
<div id="div_btn_logo" style="position:absolute;width:225px;height:91px;top:45px;left:85px;">
	<img id="btn_logo" title="<?php echo U('CourseList/courseDesc').'?chKey='.$chKey;?>" src="/static/v1/hd/images/sectionList/title_early.png">
</div>

<!-- 课程横幅图 -->
<div style="position: absolute;top:180px;left:60px;width: 286px;height:382px;
        background-image: url(/static/v1/hd/images/sectionList/early/month_aim/<?php echo ($courseId); ?>.png);">
</div>

<!-- 订购 -->
<div id="div_btn_order" style="position:absolute;width:90px;height:34px;top:85px;left:1100px;">
	<img id="btn_order" title="<?php echo U('Order/index?courseId='.$courseId.'&preFocus='.$preFocus);?>" src="/static/v1/hd/images/common/order/btn_order.png">
</div>

<!-- 知识点列表 -->
<?php if(is_array($topics)): $i = 0; $__LIST__ = $topics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i; $top = 180+($i-1)*65; ?>
    <div id="div_topic_<?php echo ($i); ?>" style="position: absolute;height:54px;left:345px;top:<?php echo ($top); ?>px;">
        <img id="topic_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?courseId='.$courseId.'&topicId='.$t['id'].'&chId='.$chId.'&preFocus='.$preFocus);?>" src="<?php echo ($t['linkImage']); ?>" height="54" />
   </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 课时列表 -->
<?php if(is_array($sections)): $i = 0; $__LIST__ = $sections;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($i % 2 );++$i; if($i > 3){ $top = 375; $left = 530 + ($i-4)*225; }else{ $top = 180; $left = 530 + ($i-1)*225; } ?>
    <div id="div_section_<?php echo ($i); ?>" style="position:absolute;width:220px;height:190px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="section_<?php echo ($i); ?>" title="<?php echo U('Section/index?sectionId='.$section['id'].'&courseId='.$courseId.'&preFocus='.$preFocus);?>" src="<?php echo get_upfile_url($section['imgUrl']);?>" width="210" height="180">
    </div>
    <div id="div_section_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:200px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="section_<?php echo ($i); ?>_focus" src="" width="220" height="190">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 月份条 -->
<div class="monthbg"></div>
<!-- 进度条背景 -->
<div class="probg"></div>

<!-- 月份 -->
<?php if(is_array($months)): $i = 0; $__LIST__ = $months;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i; $left = $i*86+57; ?>
	<div id="div_month_<?php echo ($i); ?>" class="progress" style="position:absolute;width:46px;height:30px;top:593px;left:<?php echo ($left); ?>px;">
		<img id="month_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?courseId='.$m['courseId'].'&focus=month_'.$i.'&preFocus='.$preFocus);?>" src="<?php echo ($m['linkImage']); ?>">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 底部投影 -->
<div style="position: absolute;width:1110px;height:45px;top:630px;left:85px;
        background-image: url(/static/v1/hd/images/common/shadow/shadow_1110x45.png);">
</div>

<script type="text/javascript">

//失去时焦点处理（知识点列表）
function blurHandler(){
	if(Epg.btn.current.id != "topic_1" && Epg.btn.current.id != "topic_2"
	   && Epg.btn.current.id != "topic_3" && Epg.btn.current.id != "topic_4"
	   && Epg.btn.current.id != "topic_5" && Epg.btn.current.id != "topic_6"){
			G(Epg.btn.previous.id).src = Epg.btn.previous.focusImage;
	}
}

//获取焦点时处理（知识点列表）
function focusHandler(){
	if(Epg.btn.current.id != cur_topic){
		setTimeout("Epg.btn.click()",500)
	}
}

//失去时焦点处理（月份列表）
function blurHandler2(){
	/* if(Epg.btn.current.id != "topic_1" && Epg.btn.current.id != "topic_2"
	   && Epg.btn.current.id != "topic_3" && Epg.btn.current.id != "topic_4"
	   && Epg.btn.current.id != "topic_5" && Epg.btn.current.id != "topic_6"){
			G(Epg.btn.previous.id).src = Epg.btn.previous.focusImage;
	} */
}

//获取焦点时处理（月份列表）
function focusHandler2(){
	if(Epg.btn.current.id != cur_course){
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