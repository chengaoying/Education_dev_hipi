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
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }

/* 用户信息背景图  */
#user_info_bg{
	position:absolute;
    display: block;
    width:210px;
    height:125px;
    top:370px;
    left:90px;	
    background-image:url(/static/v1/hd/images/recommend/user_info_bg.jpg);
}  

/* 最近观看背景图 */
#recently_saw_bg{
	position:absolute;
    display: block;
    width:210px;
    height:120px;
    top:495px;
    left:90px;	
    background-image:url(/static/v1/hd/images/recommend/recently_saw_bg.png);
} 

/* 底部投影背景图 */
.shadow{
	position:absolute;
    display: block;
    width:210px;
    height:54px;
	top:615px;
    background-image:url(/static/v1/hd/images/common/shadow_1.png);
}

#div_left_ad{
	
}

</style>

<script type="text/javascript">

//栏目object(json格式数据)
var channel = <?php echo ($json_channel); ?>;
var ad = <?php echo ($json_ad); ?>;

var buttons=
	[
	 	/* 栏目  */
		{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',right:'ch_2',down:''},
		{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'ch_1',right:'ch_3',down:'t_right_ad'},
		{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'ch_2',down:'t_right_ad'},
		
		/* 广告 */
		//{id:'t_left_ad',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',right:'t_right_ad',up:'ch_1',down:''},
		{id:'t_right_ad',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_2.png',left:'',right:'tuijian_1',up:'ch_3',down:'t_bottom_ad'},
		{id:'t_bottom_ad',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'tuijian_4',up:'t_right_ad',down:''},
		
		/* 推荐课程 */
		{id:'tuijian_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'t_right_ad',right:'tuijian_2',up:'ch_3',down:'tuijian_4'},
		{id:'tuijian_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_1',right:'tuijian_3',up:'ch_3',down:'tuijian_5'},
		{id:'tuijian_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_2',right:'',up:'ch_3',down:'tuijian_6'},
		{id:'tuijian_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'t_right_ad',right:'tuijian_5',up:'tuijian_1',down:''},
		{id:'tuijian_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_4',right:'tuijian_6',up:'tuijian_2',down:''},
		{id:'tuijian_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'tuijian_5',right:'',up:'tuijian_3',down:''},
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
	
	//广告
	for(var j=0; j<ad.length; j++)
	{
		buttons[j+3].name = ad[j].title;
		//buttons[j+3].linkImage = ad[j].content;
		//buttons[j+3].focusImage = ad[j].content;
	}
	
}

window.onload=function()
{
	initButtons();
	Epg.btn.init('ch_1',buttons,true);	
};
</script>

<!-- 静态图片 -->
<div id="user_info_bg"></div>
<div id="recently_saw_bg"></div>
<?php $__FOR_START_3801__=1;$__FOR_END_3801__=6;for($i=$__FOR_START_3801__;$i < $__FOR_END_3801__;$i+=1){ $left = 90 + ($i-1)*225; ?>
	<div class="shadow" style="left:<?php echo ($left); ?>px;"></div><?php } ?>


<!-- 顶部-栏目 -->
<?php if(is_array($topChannel)): $i = 0; $__LIST__ = $topChannel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i; $left = 90 + ($i-1)*150; $top = 75; ?>
	<div id="div_ch_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($ch['linkUrl']); ?>" src="<?php echo ($ch['linkImage']); ?>" width="95" height="26">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 页面左侧 -->
	<!-- 广告 -->
<div id="div_t_left_ad_1" style="position:absolute;width:230px;height:174px;left:80px;top:180px;text-align:center;">
	<img id="t_left_ad"  src="<?php echo ($left_ad['content']); ?>" width="210" height="174">
</div>



<!-- 页面中间 -->
	<!-- 广告 -->
<div id="div_t_right_ad" style="position:absolute;width:230px;height:320px;left:305px;top:180px;text-align:center;">
	<img id="t_right_ad" title="123"  src="<?php echo ($right_ad['content']); ?>" width="210" height="320">
</div>
<div id="div_t_right_ad_focus" style="position:absolute;visibility: hidden;width:230px;height:326px;left:305px;top:177px;text-align:center;">
	<img id="t_right_ad_focus" src="" width="216" height="326">
</div>

	<!-- 成长指标/推荐课程 -->
<div id="div_t_bottom_ad" style="position:absolute;width:230px;height:100px;left:305px;top:515px;text-align:center;">
	<img id="t_bottom_ad" src="<?php echo ($bottom_ad['content']); ?>" width="210" height="100">
</div>


<!-- 页面右侧 -->
	<!-- 推荐的课程 -->
<?php $__FOR_START_8350__=1;$__FOR_END_8350__=7;for($i=$__FOR_START_8350__;$i < $__FOR_END_8350__;$i+=1){ if($i > 3){ $top = 405; $left = 530 + ($i-4)*225; }else{ $top = 180; $left = 530 + ($i-1)*225; } ?>
	<div id="div_tuijian_<?php echo ($i); ?>" style="position:absolute;width:230px;height:210px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="tuijian_<?php echo ($i); ?>" src="/static/v1/hd/images/test/<?php echo ($i); ?>.jpg" width="210" height="210">
	</div>
	<div id="div_tuijian_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:216px;left:<?php echo ($left); ?>px;top:<?php echo ($top-3); ?>px;text-align:center;">
		<img id="tuijian_<?php echo ($i); ?>_focus" src="" width="216" height="216">
	</div><?php } ?>


</body>
</html>