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
   body{ background-image:url(/static/v1/hd/images/sectionList/preschool/weekend/bg<?php echo ($week); ?>.jpg); }
   
.shadow{
   position: absolute;
   width:360px;
   height:50px;
   top:617px;
   background-image: url(/static/v1/hd/images/common/shadow/shadow_360x60.png);
}

#week{
    position:absolute;
	width: 66px;
	height: 21px;
	top: 650px;
	left:855px;
	background-image: url(/static/v1/hd/images/sectionList/preschool/week_<?php echo ($week); ?>.png);
}
</style>

<script type="text/javascript">

var buttons=
	[
		/*课时列表*/
		{id:'section_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_240x330.png',left:'',right:'section_2',down:['btn_prev_day','btn_next_day']},
		{id:'section_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_240x330.png',left:'section_1',right:'section_3',down:['btn_prev_day','btn_next_day']},
		{id:'section_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_240x330.png',left:'section_2',right:'',down:['btn_prev_day','btn_next_day']},

		/* 前一天 /后一天 */
		{id:'btn_prev_day',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/preschool/weekend/page_prev.png',focusImage:'/static/v1/hd/images/sectionList/preschool/weekend/page_prev_over.png',selectBox:'',left:'btn_logo',right:'btn_next_day',up:'section_3'},
		{id:'btn_next_day',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/preschool/weekend/page_next.png',focusImage:'/static/v1/hd/images/sectionList/preschool/weekend/page_next_over.png',selectBox:'',left:'btn_prev_day',right:'btn_week',up:'section_3'},

		/*本周课程*/
        {id:'btn_week',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/preschool/weekend/btn_week.png',focusImage:'/static/v1/hd/images/sectionList/preschool/weekend/btn_week_over.png',selectBox:'',left:['btn_next_day','btn_prev_day'],right:'btn_order',up:'section_3',down:''},
		
        /* 订购按钮 */	
		{id:'btn_order',name:'订购',action:'',linkImage:'/static/v1/hd/images/sectionList/preschool/weekend/btn_order.png',focusImage:'/static/v1/hd/images/sectionList/preschool/weekend/btn_order_over.png',selectBox:'',left:'btn_week',up:'section_3',down:''},
        
    ];
    
/* 初始化按钮 属性   */
var initButtons = function(){
	
}

var defaultId = "<?php echo ($preFocus); ?>";

window.onload=function()
{
    initButtons();
    popup();
	Epg.btn.init('section_1',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo ($backUrl); ?>" ></a>

<!-- 星期 -->
<div id="week"></div>
<!-- 前一天 -->
<div id="div_btn_prev_day" style="position:absolute;width:22px;height:26px;left:820px;top:650px;text-align:center;">
    <img id="btn_prev_day" title="<?php echo U('SectionList/index').'?courseId='.$courseId.'&topicId='.$prevTopicId.'&chId='.$chId.'&preFocus='.$preFocus;?>" src="/static/v1/hd/images/sectionList/preschool/weekend/page_prev.png" width="22" height="26">
</div>
<!-- 后一天 -->
<div id="div_btn_next_day" style="position:absolute;width:22px;height:26px;left:935px;top:650px;text-align:center;">
    <img id="btn_next_day" title="<?php echo U('SectionList/index').'?courseId='.$courseId.'&topicId='.$nextTopicId.'&chId='.$chId.'&preFocus='.$preFocus;?>" src="/static/v1/hd/images/sectionList/preschool/weekend/page_next.png" width="22" height="26">
</div>

<!-- 订购 -->
<div id="div_btn_order" style="position:absolute;width:88px;height:30px;top:645px;left:1125px;">
	<img id="btn_order" title="<?php echo U('Order/index?courseId='.$courseId);?>" src="/static/v1/hd/images/sectionList/preschool/weekend/btn_order.png">
</div>

<!-- 本周课程 -->
<div id="div_btn_week" title="<?php echo U('SectionList/week?courseId='.$courseId.'&preFocus='.$preFocus);?>" style="position: absolute;width:142px;height:31px;left:970px;top:645px;">
	<img id="btn_week" src="/static/v1/hd/images/sectionList/preschool/weekend/btn_week.png" width="138" height="33" />
</div>

<!-- 课时列表 -->
<?php if(is_array($sections)): $i = 0; $__LIST__ = $sections;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($i % 2 );++$i; $top = 265; $left = 265 + ($i-1)*260; ?>
    <div id="div_section_<?php echo ($i); ?>" style="position:absolute;width:230px;height:320px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="section_<?php echo ($i); ?>" title="<?php echo U('Section/index?sectionId='.$section['id'].'&courseId='.$courseId.'&preFocus='.$preFocus);?>" src="<?php echo get_upfile_url($section['imgUrl']);?>" width="220" height="310">
    </div>
    <div id="div_section_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:240px;height:330px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="section_<?php echo ($i); ?>_focus" src="" width="235" height="325">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 1.无背景图的文字提示 -->
<div id="popup_1"></div>

<!-- 2.有背景图的文字提示 -->
<div id="popup_2">
	<div id="popup_2_info_bg"></div>
	<div id="popup_2_info"></div>
</div>

</body>
</html>