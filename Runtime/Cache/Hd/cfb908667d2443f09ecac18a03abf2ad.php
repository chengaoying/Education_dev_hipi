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

#div_popup{
	position:absolute;
	visibility:hidden;
	width:560px;
	height:357px;
	top:180px;
	left:360px;
	background-image: url(/static/v1/hd/images/common/popup/info_bg.png);
}

</style>
</head>
<body>


<style>
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
    
/* 底部投影背景图 */
.shadow{
	position:absolute;
    display: block;
    height:60px;
	top:615px;
}

</style>

<script type="text/javascript">

//栏目object(json格式数据)
var channel = <?php echo ($json_channel); ?>;

var buttons=
	[
	 	/* 栏目  */
		{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',onFocus:'1',right:'ch_2',down:'user_center'},
		{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',onFocus:'1',left:'ch_1',right:'ch_3',down:'banner_center'},
		{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',onFocus:'1',left:'ch_2',down:'banner_center'},
		
		/* 左侧导航 */
		{id:'user_center',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_160x145.png',right:'banner_center',up:'ch_1',down:'free'},
		{id:'free',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_160x145.png',left:'t_left_ad',right:'banner_center',up:'user_center',down:'record'},
		{id:'record',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_160x145.png',left:'record_1',right:'banner_center',up:'free',down:''},
		
		/* 中间横幅 */
		{id:'banner_center',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_280x445.png',left:'user_center',right:'special_1',up:'ch_2',down:''},
		
		/* 右侧上方-专题*/
		{id:'special_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_445x220.png',left:'banner_center',right:'special_2',up:'ch_3',down:'course_1'},
		{id:'special_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'special_1',right:'',up:'ch_3',down:['course_3','course_2','course_1']},
		
		/* 右侧下方-推荐课程 */
		{id:'course_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'banner_center',right:'course_2',up:'special_1',down:''},
		{id:'course_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_1',right:'course_3',up:'special_1',down:''},
		{id:'course_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'course_2',right:'',up:'special_2',down:''},
		
	];

/* 初始化按钮 属性   */
var initButtons = function(){
	//栏目
	for(var i=0; i<channel.length; i++)
	{
		buttons[i].name = channel[i].name;
		buttons[i].linkImage = channel[i].linkImage;
		buttons[i].focusImage = channel[i].focusImage;
	}
	
}

window.onload=function()
{
	initButtons();
	Epg.btn.init('ch_1',buttons,true);	
};

</script>

<!-- 顶部-栏目 -->
<?php if(is_array($topChannel)): $i = 0; $__LIST__ = $topChannel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i; $left = 100 + ($i-1)*150; $top = 95; ?>
	<div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility: visible;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($ch['linkUrl']); ?>" src="<?php echo ($ch['linkImage']); ?>" width="110" height="33">
	</div>
	<div id="div_ch_<?php echo ($i); ?>_focus" style="position:absolute;visibility: hidden;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>_focus' src="<?php echo ($ch['titleImage']); ?>" width="110" height="33">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 页面左侧 -开始-->
	<!-- 用户中心 -->
<div id="div_user_center" style="position:absolute;width:160px;height:145px;left:80px;top:180px;text-align:center;">
	<img id="user_center" title="<?php echo U('Role/userInfo');?>"  src="/static/v1/hd/images/index/recommend/btn_user_center.png" width="150" height="135">
</div>
<div id="div_user_center_focus" style="position:absolute;visibility: hidden;width:170px;height:155px;left:75px;top:175px;text-align:center;">
	<img id="user_center_focus" src="" width="160" height="145">
</div>
	<!-- 免费专区 -->
<div id="div_free" style="position:absolute;width:160px;height:145px;left:80px;top:330px;text-align:center;">
	<img id="free"  src="/static/v1/hd/images/index/recommend/btn_free.png" width="150" height="135">
</div>
<div id="div_free_focus" style="position:absolute;visibility: hidden;width:170px;height:155px;left:75px;top:325px;text-align:center;">
	<img id="free_focus" src="" width="160" height="145">
</div>
	<!-- 最近观看 -->
<div id="div_record" style="position:absolute;width:160px;height:145px;left:80px;top:480px;text-align:center;">
	<img id="record"  src="/static/v1/hd/images/index/recommend/btn_record.png" width="150" height="135">
</div>
<div id="div_record_focus" style="position:absolute;visibility: hidden;width:170px;height:155px;left:75px;top:475px;text-align:center;">
	<img id="record_focus" src="" width="160" height="145">
</div>
<!-- 页面左侧-结束 -->




<!-- 页面中间-开始 -->
<div id="div_banner_center" style="position:absolute;width:280px;height:445px;left:245px;top:180px;text-align:center;">
	<img id="banner_center" title="<?php echo U('SectionList/index?chId='.$c1['chId'].'&stageId='.$c1['stageIds'].'&courseId='.$c1['id'].'&courseType='.$c1['typeId']);?>" src="<?php echo ($c1['banner']); ?>" width="270" height="435">
</div>
<div id="div_banner_center_focus" style="position:absolute;visibility: hidden;width:290px;height:455px;left:240px;top:175px;text-align:center;">
	<img id="banner_center_focus" src="" width="280" height="445">
</div>
<!-- 页面中间-结束-->



<!-- 页面右侧-开始  -->
	<!-- 右侧上方--专题 -->
	<div id="div_special_1_center" style="position:absolute;width:445px;height:220px;left:530px;top:180px;text-align:center;">
		<img id="special_1" title="<?php echo U('SectionList/index?chId='.$c2['chId'].'&stageId='.$c2['stageIds'].'&courseId='.$c2['id'].'&courseType='.$c2['typeId']);?>" src="<?php echo ($c2['banner']); ?>" width="435" height="210">
	</div>
	<div id="div_special_1_focus" style="position:absolute;visibility: hidden;width:455px;height:230px;left:525px;top:175px;text-align:center;">
		<img id="special_1_focus" src="" width="445" height="220">
	</div>
	<!-- 小学以上是课程，小学以下是成长指标 -->
	<?php if($isEarly == true): ?><div id="div_special_2_center" style="position:absolute;width:220px;height:220px;left:980px;top:180px;text-align:center;">
			<img id="special_2" title="<?php echo ($target['linkUrl']); ?>" src="/static/v1/hd/images/index/recommend/target_<?php echo ($target['stageKey']); ?>.png" width="210" height="210">
		</div>
	<?php else: ?>
		<div id="div_special_2_center" style="position:absolute;width:220px;height:220px;left:980px;top:180px;text-align:center;">
			<img id="special_2" title="<?php echo U('SectionList/index?chId='.$target['chId'].'&stageId='.$target['stageIds'].'&courseId='.$target['id'].'&courseType='.$target['typeId']);?>" src="<?php echo get_upfile_url($target['imgUrl']);?>" width="210" height="210">
		</div><?php endif; ?>
	<div id="div_special_2_focus" style="position:absolute;visibility: hidden;width:230px;height:230px;left:975px;top:175px;text-align:center;">
		<img id="special_2_focus" src="" width="220" height="220">
	</div>

	<!-- 右侧下方-推荐课程 -->
	<?php if(is_array($courses)): $i = 0; $__LIST__ = $courses;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i; $top = 405; $left = 530 + ($i-1)*225; ?>
		<div id="div_course_<?php echo ($i); ?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
			<img id="course_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?chId='.$c['chId'].'&stageId='.$c['stageIds'].'&courseId='.$c['id'].'&courseType='.$c['typeId']);?>" src="<?php echo get_upfile_url($c['imgUrl']);?>" width="210" height="210">
		</div>
		<div id="div_course_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:230px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
			<img id="course_<?php echo ($i); ?>_focus" src="" width="220" height="220">
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
<!-- 页面右侧-结束 -->	
	
	
	
<!-- 静态图片-->
<div style="position:absolute;width:74px;height:74px;left:120px;top:200px;text-align:center;">
	<img id="user_face" src="/static/v1/hd/images/usercenter/face/face_<?php echo ($role['face']); ?>.png" width="64" height="64">
</div>

<div class="shadow" style="left:85px;width:150px;background-image:url(/static/v1/hd/images/common/shadow/shadow_150x60.png);"></div>
<div class="shadow" style="left:250px;width:270px;background-image:url(/static/v1/hd/images/common/shadow/shadow_270x60.png);"></div>
<?php $__FOR_START_5057__=1;$__FOR_END_5057__=4;for($i=$__FOR_START_5057__;$i < $__FOR_END_5057__;$i+=1){ $left = 535 + ($i-1)*225; ?>
	<div class="shadow" style="left:<?php echo ($left); ?>px;width:210px;background-image:url(/static/v1/hd/images/common/shadow/shadow_210x60.png);"></div><?php } ?>


<script type="text/javascript">

/* function pop(){
	Epg.popup('div_popup')
}

function disPop(){
	Epg.disPopup(buttons,'div_popup')
} */

//setTimeout("pop()",1000);
//setTimeout("disPop()",5000);
</script>



<!-- 弹窗 -->
<div id="div_popup">
</div>
</body>
</html>