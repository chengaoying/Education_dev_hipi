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


<style>
    body{ background-image:url(/static/v1/hd/images/timer/bg.jpg); }
</style>

<script type="text/javascript">

//栏目object(json格式数据)
//var channel = <?php echo ($json_channel); ?>;
//var ad = <?php echo ($json_ad); ?>;

var buttons=
	[
	 	/* 左边  */
		{id:'plan',name:'',action:'',linkImage:'/static/v1/hd/images/timer/addplan1.png',focusImage:'/static/v1/hd/images/timer/addplan2.png',selectBox:'',right:'see',down:'order'},
		{id:'order',name:'',action:'',linkImage:'/static/v1/hd/images/timer/order1.png',focusImage:'/static/v1/hd/images/timer/order2.png',selectBox:'',left:'',right:'see',down:'',up:'plan'},
		
		/* 上边 */
		{id:'see',name:'',action:'',linkImage:'/static/v1/hd/images/timer/seeing1.png',focusImage:'/static/v1/hd/images/timer/seeing2.png',selectBox:'',right:'left',left:'plan',up:'',down:''},
		
		/* 页码 */
		{id:'left',name:'',action:'',linkImage:'/static/v1/hd/images/timer/left1.png',focusImage:'/static/v1/hd/images/timer/left2.png',selectBox:'',right:'right',left:'see',up:'',down:''},
		{id:'right',name:'',action:'',linkImage:'/static/v1/hd/images/timer/right1.png',focusImage:'/static/v1/hd/images/timer/right2.png',selectBox:'',left:'left',up:'',down:''},
		
		/* 下边 */
		{id:'course_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'t_right_ad',right:'tuijian_2',up:'ch_3',down:'tuijian_4'},
		{id:'course_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_1',right:'tuijian_3',up:'ch_3',down:'tuijian_5'},
		{id:'course_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_2',right:'',up:'ch_3',down:'tuijian_6'},
		{id:'course_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'t_right_ad',right:'tuijian_5',up:'tuijian_1',down:''},
		{id:'course_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_4',right:'tuijian_6',up:'tuijian_2',down:''},
		{id:'course_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_5',right:'',up:'tuijian_3',down:''},
		{id:'course_7',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_4',right:'tuijian_6',up:'tuijian_2',down:''},
		{id:'course_8',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_5',right:'',up:'tuijian_3',down:''},
		{id:'course_9',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_4',right:'tuijian_6',up:'tuijian_2',down:''},
		{id:'course_10',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_5',right:'',up:'tuijian_3',down:''},
	];

/* 初始化按钮 属性   */
var initButtons = function(){}

window.onload=function()
{
	initButtons();
	Epg.btn.init('plan',buttons,true);	
};
</script>
<!-- 图书头像 -->
<div id="div_book" style="position:absolute;left:90px;top:80px;">
	<img id='book' title="ddd" src="/static/v1/hd/images/timer/china.jpg" width="216" height="216">
</div>
<div style="position:absolute;left:90px;top:325px;">
	共100课时<br>
	已有1000人在学习该课程
</div>
<!-- 学习计划 -->
<div id="div_plan" style="position:absolute;left:100px;top:400px;">
	<img id='plan' title="ddd" src="/static/v1/hd/images/timer/addplan1.png" width="191" height="57">
</div>	

<!-- 订购课程 -->
<div id="div_order" style="position:absolute;left:100px;top:470px;">
	<img id='order' title="ddd" src="/static/v1/hd/images/timer/order1.png" width="191" height="57">
</div>

<!-- 图书标题 -->
<div style="position:absolute;width:740px;height:45px;left:425px;top:75px;text-align:left;">
	<font size="5"><b>苏教版二年级语文上册</b></font>
</div>

<!-- 图书简介 -->
<div style="position:absolute;width:740px;height:85px;left:425px;top:130px;text-align:left;">
	苏教版二年级语文上册
</div>

<!-- 翻页左 -->
<div id="div_left" style="position:absolute;width:40px;height:35px;left:1008px;top:277px;text-align:center;">
	<img id='left' title="ddd" src="/static/v1/hd/images/timer/left1.png" width="34" height="34">
</div>

<!-- 页码 -->
<div style="position:absolute;width:70px;height:30px;left:1055px;top:282px;text-align:center;">
	4/8
</div>

<!-- 翻页右 -->
<div id="div_right" style="position:absolute;width:40px;height:35px;left:1130px;top:277px;text-align:center;">
	<img id='right' title="ddd" src="/static/v1/hd/images/timer/right1.png" width="34" height="34">
</div>

<!-- 观看记录 -->
<div style="position:absolute;width:130px;height:35px;left:510px;top:230px;text-align:center;">
	无观看记录
</div>

<!-- 继续观看 -->
<div id="div_see" style="position:absolute;width:135px;height:42px;left:680px;top:220px;text-align:center;">
	<img id="see"  src="/static/v1/hd/images/timer/seeing1.png" width="135" height="42">
</div>

<?php if(is_array($videoList)): $i = 0; $__LIST__ = $videoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$videoLists): $mod = ($i % 2 );++$i; if($i<=5){ $left = 440; $top = ($i-1)*60+340; }else{ $left = 820; $top = ($i-6)*60+340; } ?>
	<div id="div_tuijian_<?php echo ($i); ?>" style="position:absolute;width:360px;height:50px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-indent:20px; text-align:left;line-height:50px;">
		<?php echo ($videoLists['name']); ?>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


</body>
</html>