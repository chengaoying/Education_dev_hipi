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
	top: 100px;
	left:385px;
	background-image: url(/static/v1/hd/images/sectionList/preschool/week_<?php echo ($week); ?>.png);
}
</style>

<script type="text/javascript">

var buttons=
	[
		/* logo */	
		{id:'btn_logo',name:'logo',action:'',linkImage:'/static/v1/hd/images/sectionList/title_preschool.png',focusImage:'/static/v1/hd/images/sectionList/title_preschool_over.png',selectBox:'',right:'btn_prev_day',down:'section_1'},
			
		/* 前一天 /后一天 */
		{id:'btn_prev_day',name:'',action:'pageUp()',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',left:'btn_logo',right:'btn_next_day',down:'section_2'},
		{id:'btn_next_day',name:'',action:'pageDown()',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'btn_prev_day',right:'btn_week',down:'section_2'},
	
        /*本周课程*/
        {id:'btn_week',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/preschool/btn_week.png',focusImage:'/static/v1/hd/images/sectionList/preschool/btn_week_over.png',selectBox:'',left:'btn_next_day',right:'btn_order',up:'',down:['section_5','section_4','section_3','section_2','section_1']},
		
        /* 订购按钮 */	
		{id:'btn_order',name:'订购',action:'',linkImage:'/static/v1/hd/images/common/order/btn_order.png',focusImage:'/static/v1/hd/images/common/order/btn_order_over.png',selectBox:'',left:'btn_week',down:['section_5','section_4','section_3','section_2','section_1']},
        
        /*课时列表*/
	 	{id:'section_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x300.png',left:'',right:'section_2',up:'btn_logo',down:'special_1'},
        {id:'section_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x300.png',left:'section_1',right:'section_3',up:'btn_prev_day',down:'special_1'},
        {id:'section_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x300.png',left:'section_2',right:'section_4',up:'btn_next_day',down:['special_2','special_1']},
        {id:'section_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x300.png',left:'section_3',right:'section_5',up:'btn_week',down:['special_3','special_2','special_1']},
        {id:'section_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x300.png',left:'section_4',right:'',up:'btn_order',down:['special_3','special_2','special_1']},
        
        /* 专题列表 */
        {id:'special_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_370x125.png',left:'',right:'special_2',up:'section_1',down:''},
		{id:'special_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_370x125.png',left:'special_1',right:'special_3',up:['section_3','section_2','section_1'],down:''},
		{id:'special_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_370x125.png',left:'special_2',right:'',up:['section_5','section_4','section_3','section_2','section_1'],down:''},
	];
    
/* 初始化按钮 属性   */
var initButtons = function(){
}

var url = "<?php echo U('SectionList/index').'?courseId='.$courseId.'&chId='.$chId.'&preFocus='.$preFocus;?>";

//上一页
function pageUp()
{
	url += "&focus="+Epg.btn.current.id+"&topicId=<?php echo ($prevTopicId); ?>";
	Epg.jump(url);
}

//下一页
function pageDown()
{
	url += "&focus="+Epg.btn.current.id+"&topicId=<?php echo ($nextTopicId); ?>";
	Epg.jump(url);
}

var defaultId = "<?php echo ($focus); ?>";

window.onload=function()
{
    initButtons();
    popup();
    
  	//翻页焦点定位
	if(defaultId == "btn_prev_day" && Epg.isEmpty(G(defaultId))){
		defaultId = "btn_next_day";
	}
	if(defaultId == "btn_next_day" && Epg.isEmpty(G(defaultId))){
		defaultId = "btn_prev_day";
	}
    
	Epg.btn.init([defaultId,'section_1'],buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo ($backUrl); ?>" ></a>

<!-- 栏目LOGO -->
<div id="div_btn_logo" style="position:absolute;width:225px;height:91px;top:45px;left:85px;">
	<img id="btn_logo" title="<?php echo U('CourseList/courseDesc').'?chKey='.$chKey.'&preFocus='.$preFocus;?>" src="/static/v1/hd/images/sectionList/title_preschool.png">
</div>

<!-- 星期 -->
<div id="week"></div>
<!-- 前一天 -->
<?php if($week > 1): ?><div id="div_btn_prev_day" style="position:absolute;width:20px;height:26px;left:350px;top:100px;text-align:center;">
	    <img id="btn_prev_day" src="/static/v1/hd/images/common/page/page_prev.png" width="20" height="26">
	</div>
<?php else: ?>
	<div id="div_btn_prev_day" style="position:absolute;width:20px;height:26px;left:350px;top:100px;text-align:center;">
  	  <img src="/static/v1/hd/images/common/page/page_prev_none.png" width="20" height="26">
	</div><?php endif; ?>
<!-- 后一天 -->
<?php if($week < 6): ?><div id="div_btn_next_day" style="position:absolute;width:20px;height:26px;left:465px;top:100px;text-align:center;">
	    <img id="btn_next_day" src="/static/v1/hd/images/common/page/page_next.png" width="20" height="26">
	</div>
<?php else: ?>
	<div id="div_btn_next_day" style="position:absolute;width:20px;height:26px;left:465px;top:100px;text-align:center;">
	    <img src="/static/v1/hd/images/common/page/page_next_none.png" width="20" height="26">
	</div><?php endif; ?>

<!-- 订购 -->
<div id="div_btn_order" style="position:absolute;width:90px;height:34px;top:100px;left:1105px;">
	<img id="btn_order" title="<?php echo U('Order/index?courseId='.$courseId.'&preFocus='.$preFocus);?>" src="/static/v1/hd/images/common/order/btn_order.png">
</div>

<!-- 本周课程 -->
<div id="div_btn_week" title="<?php echo U('SectionList/week?courseId='.$courseId.'&preFocus='.$preFocus);?>" style="position: absolute;width:138px;height:33px;left:950px;top:100px;">
	<img id="btn_week" src="/static/v1/hd/images/sectionList/preschool/btn_week.png" width="138" height="33" />
</div>

<!-- 课时列表 -->
<?php if(is_array($sections)): $i = 0; $__LIST__ = $sections;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($i % 2 );++$i; $top = 180; $left = 85 + ($i-1)*225; ?>
    <div id="div_section_<?php echo ($i); ?>" style="position:absolute;width:220px;height:310px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="section_<?php echo ($i); ?>" title="<?php echo U('Section/index?sectionId='.$section['id'].'&courseId='.$courseId.'&preFocus='.$preFocus);?>" src="<?php echo get_upfile_url($section['imgUrl']);?>" width="210" height="300">
    </div>
    <div id="div_section_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:320px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="section_<?php echo ($i); ?>_focus" src="" width="220" height="310">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 底部投影 -->
<?php $__FOR_START_7170__=1;$__FOR_END_7170__=4;for($i=$__FOR_START_7170__;$i < $__FOR_END_7170__;$i+=1){ $left = 90 + ($i-1)*375; ?>
	<div class="shadow" style="left:<?php echo ($left); ?>px;"></div><?php } ?>

<!-- 专题列表 -->
<?php if(is_array($specialList)): $i = 0; $__LIST__ = $specialList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$special): $mod = ($i % 2 );++$i; $top = 500; $left = 85 + ($i-1)*375; ?>
    <div id="div_special_<?php echo ($i); ?>" style="position:absolute;width:370px;height:125px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="special_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?courseId='.$special['id'].'&preFocus='.$preFocus);?>" src="<?php echo get_upfile_url($special['imgUrl']);?>" width="360" height="115">
    </div>
    <div id="div_special_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:380px;height:135px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="special_<?php echo ($i); ?>_focus" src="" width="370" height="125">
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