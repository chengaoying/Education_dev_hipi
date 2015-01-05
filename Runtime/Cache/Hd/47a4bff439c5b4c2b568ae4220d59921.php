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


<style>
    body{ background-image:url(/static/v1/hd/images/sectionList/primaryschool/bg.jpg); }
    
.page td	{ height:35px; text-align:center;color:#fff;font-weight: 300; font-size:20px;}
.page .up	{ width:32px;}
.page .down	{ width:32px;}
.page .now	{ width:88px;}    
</style>

<script type="text/javascript">

var buttons=
	[
	 	/* 左边  */
		{id:'btn_order',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/primaryschool/btn_order.png',focusImage:'/static/v1/hd/images/sectionList/primaryschool/btn_order_over.png',selectBox:'',right:['section_2','section_1'],up:'btn_record',down:'btn_favor'},
		{id:'btn_favor',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/primaryschool/btn_favor.png',focusImage:'/static/v1/hd/images/sectionList/primaryschool/btn_favor_over.png',selectBox:'',right:['section_3','section_2','section_1'],up:'btn_order',},
		
		/* 上边 */
		{id:'btn_record',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/primaryschool/btn_record.png',focusImage:'/static/v1/hd/images/sectionList/primaryschool/btn_record_over.png',selectBox:'',right:'page_prev',left:'btn_order',up:'',down:'section_1'},
		
		/* 分页按钮 */
		{id:'page_prev',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',left:'btn_record',right:'page_next',down:['section_6']},
    	{id:'page_next',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:['page_prev'],down:['section_6']},
        
		/* 下边 */
		{id:'section_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'btn_order',right:'section_6',up:'btn_record',down:'section_2'},
		{id:'section_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'btn_order',right:'section_7',up:'section_1',down:'section_3'},
		{id:'section_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'btn_favor',right:'section_8',up:'section_2',down:'section_4'},
		{id:'section_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'btn_favor',right:'section_9',up:'section_3',down:'section_5'},
		{id:'section_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'btn_favor',right:'section_10',up:'section_4',down:''},
		{id:'section_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'section_1',right:'',up:'page_prev',down:'section_7'},
		{id:'section_7',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'section_2',right:'',up:'section_6',down:'section_8'},
		{id:'section_8',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'section_3',right:'',up:'section_7',down:'section_9'},
		{id:'section_9',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'section_4',right:'',up:'section_8',down:'section_10'},
		{id:'section_10',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_390x60.png',left:'section_5',right:'',up:'section_9',down:''},
	];

/* 初始化按钮 属性   */
var initButtons = function(){}

window.onload=function()
{
	initButtons();
	popup();
	Epg.btn.init('btn_order',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 课程iconcourse_icon -->
<div id="div_course_icon" style="position:absolute;left:90px;top:80px;">
	<img src="<?php echo get_upfile_url($course['imgUrl']);?>" width="216" height="216">
</div>
<div style="position:absolute;left:90px;top:325px;">
	共<?php echo ($total); ?>课时<br>
	已有1000人在学习该课程
</div>
<!-- 学习计划 -->
<div id="div_'btn_favor'" style="position:absolute;left:100px;top:470px;">
	<img id='btn_favor' title="ddd" src="/static/v1/hd/images/sectionList/primaryschool/btn_favor.png" width="191" height="57">
</div>	

<!-- 订购课程 -->
<div id="div_btn_order" style="position:absolute;left:100px;top:400px;">
	<img id='btn_order' title="<?php echo U('Order/index?courseId='.$course['id']);?>" src="/static/v1/hd/images/sectionList/primaryschool/btn_order.png" width="191" height="57">
</div>

<!-- 课程标题 -->
<div style="position:absolute;width:740px;height:45px;left:425px;top:75px;text-align:left;">
	<font size="5"><b><?php echo ($course['name']); ?></b></font>
</div>

<!-- 课程简介 -->
<div style="position:absolute;width:740px;height:85px;left:425px;top:130px;text-align:left;">
	<?php echo ($course['description']); ?>
</div>

<!-- 分页 -->
<div style="position:absolute; left:1007px; top:275px;">
	<?php echo ($pageHtml['pageHtml']); ?>
</div>

<!-- 观看记录 -->
<div style="position:absolute;width:130px;height:35px;left:510px;top:230px;text-align:center;">
	无观看记录
</div>

<!-- 继续观看 -->
<div id="div_btn_record" style="position:absolute;width:135px;height:42px;left:680px;top:220px;text-align:center;">
	<img id="btn_record"  src="/static/v1/hd/images/sectionList/primaryschool/btn_record.png" width="135" height="42">
</div>

<?php if(is_array($sections)): $i = 0; $__LIST__ = $sections;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($i % 2 );++$i; if($i<=5){ $left = 440; $top = ($i-1)*60+340; }else{ $left = 820; $top = ($i-6)*60+340; } ?>
	<div id="div_section_<?php echo ($i); ?>" style="position:absolute;width:360px;height:50px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-indent:20px; text-align:left;line-height:50px;">
		<span id="section_<?php echo ($i); ?>" title="<?php echo U('Resource/play?id='.$section['id']);?>"><?php echo ($section['name']); ?></span>
	</div>
	<div id="div_section_<?php echo ($i); ?>_focus" style="position:absolute;visibility: hidden;width:370px;height:60px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
		<img id="section_<?php echo ($i); ?>_focus" src="" width="360" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>



<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>