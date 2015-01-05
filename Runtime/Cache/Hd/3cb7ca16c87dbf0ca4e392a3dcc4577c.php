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
    
    /*月份*/
    <?php $month = $courseId - 1000; if($month>=1 and $month<=12){ $monthbg = '/static/v1/hd/images/sectionList/early/month/1_12_month.png'; }else if($month>=13 and $month<=24){ $monthbg = '/static/v1/hd/images/sectionList/early/month/13_24_month.png'; }else{ $monthbg = '/static/v1/hd/images/sectionList/early/month/25_36_month.png'; } if(in_array($month,array(12,24,36))){ $probgwidth = 1110; $proleft = 1085; }else{ $probgwidth = ($month%12)*86; $proleft = ($month%12)*86+62; } ?>
    
    .monthbg{
        position: absolute;
        width:1110px;
        height:50px;
        top:580px;
        left:85px;
        background: url(<?php echo ($monthbg); ?>) no-repeat;
    }
    .progress{
        position: absolute;
        width:46px;
        height:30px;
        top:593px;
        left:<?php echo ($proleft); ?>px;
        background: url(/static/v1/hd/images/sectionList/early/month/<?php echo ($courseId); ?>.png) no-repeat;
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
	 	{id:'topic_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'section_1',up:'btn_logo',down:'topic_2'},
        {id:'topic_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'section_1',up:'topic_1',down:'topic_3'},
        {id:'topic_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'section_1',up:'topic_2',down:'topic_4'},
        {id:'topic_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:['section_4','section_1'],up:'topic_3',down:'topic_5'},
        {id:'topic_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:['section_4','section_1'],up:'topic_4',down:'topic_6'},
        {id:'topic_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:['section_4','section_1'],up:'topic_5',down:'topic_7'},
        
        /* 右边视频列表 */
        {id:'section_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'topic_1',right:'section_2',up:'btn_order',down:'section_4'},
		{id:'section_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'section_1',right:'section_3',up:'btn_order',down:['section_5','section_4']},
		{id:'section_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'section_2',right:'',up:'btn_order',down:['section_6','section_5','section_4']},
		{id:'section_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:['topic_5','topic_4'],right:'section_5',up:'section_1',down:''},
		{id:'section_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'section_4',right:'section_6',up:'section_2',down:''},
		{id:'section_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'section_5',right:'',up:'section_3',down:''},
	];

//知识点
var topics = <?php echo ($json_topic); ?>;
/* 初始化按钮 属性   */
var initButtons = function(){
	//知识点
	for(var i=0; i<topics.length; i++)
	{
		buttons[i+2].name = topics[i].name;
		buttons[i+2].linkImage = topics[i].linkImage;
		buttons[i+2].focusImage = topics[i].focusImage;
	}
	
}

window.onload=function()
{
    initButtons();
    popup();
	Epg.btn.init('btn_order',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 栏目LOGO -->
<div id="div_btn_logo" style="position:absolute;width:225px;height:91px;top:45px;left:85px;">
	<img id="btn_logo" src="/static/v1/hd/images/sectionList/title_early.png">
</div>

<!-- 课程横幅图 -->
<div style="position: absolute;top:180px;left:60px;width: 286px;height:382px;
        background-image: url(/static/v1/hd/images/sectionList/early/month_aim/<?php echo ($courseId); ?>.png);">
</div>

<!-- 订购 -->
<div id="div_btn_order" style="position:absolute;width:90px;height:34px;top:85px;left:1100px;">
	<img id="btn_order" title="<?php echo U('Order/index?courseId='.$courseId);?>" src="/static/v1/hd/images/common/order/btn_order.png">
</div>

<!-- 知识点列表 -->
<?php if(is_array($topics)): $i = 0; $__LIST__ = $topics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i; $top = 180+($i-1)*65; ?>
    <div id="div_topic_<?php echo ($i); ?>" style="position: absolute;height:54px;left:345px;top:<?php echo ($top); ?>px;">
        <!-- <img id="topic_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?chId='.$chId.'&stageId='.$stageId.'&courseId='.$courseId.'&courseType='.$courseType.'&topicId='.$t['id']);?>" src="<?php echo ($t['linkImage']); ?>" height="54" /> --> 
        <img id="topic_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?courseId='.$courseId.'&topicId='.$t['id']);?>" src="<?php echo ($t['linkImage']); ?>" height="54" />
   </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 课时列表 -->
<?php if(is_array($sections)): $i = 0; $__LIST__ = $sections;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($i % 2 );++$i; if($i > 3){ $top = 375; $left = 530 + ($i-4)*225; }else{ $top = 180; $left = 530 + ($i-1)*225; } ?>
    <div id="div_section_<?php echo ($i); ?>" style="position:absolute;width:220px;height:190px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="section_<?php echo ($i); ?>" title="<?php echo U('Section/index?sectionId='.$section['id'].'&courseId='.$courseId);?>" src="<?php echo get_upfile_url($section['imgUrl']);?>" width="210" height="180">
    </div>
    <div id="div_section_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:200px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="section_<?php echo ($i); ?>_focus" src="" width="220" height="190">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 月份条 -->
<div class="monthbg"></div>
<!-- 进度条 -->
<div class="progress"></div>
<!-- 进度条背景 -->
<div class="probg"></div>

<!-- 底部投影 -->
<div style="position: absolute;width:1110px;height:45px;top:630px;left:85px;
        background-image: url(/static/v1/hd/images/common/shadow/shadow_1110x45.png);">
</div>


<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>