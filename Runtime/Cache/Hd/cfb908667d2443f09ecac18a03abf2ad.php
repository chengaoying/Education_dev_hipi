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
    
/* 最近观看背景图 */
#recently_saw_bg{
	position:absolute;
    display: block;
    width:210px;
    height:120px;
    top:495px;
    left:85px;	
    background-image:url(/static/v1/hd/images/index/recommend/recorder_bg.png);
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

</style>

<script type="text/javascript">

//栏目object(json格式数据)
var channel = <?php echo ($json_channel); ?>;

var buttons=
	[
	 	/* 栏目  */
		{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',right:'ch_2',down:['t_left_ad','role_info']},
		{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'ch_1',right:'ch_3',down:'t_left_ad'},
		{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'ch_2',down:'t_right_ad'},
		
		/* 广告 */
		{id:'t_left_ad',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',right:'t_right_ad',up:'ch_1',down:'role_info'},
		{id:'t_right_ad',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x320.gif',left:'t_left_ad',right:'tuijian_1',up:'ch_3',down:'t_bottom_ad'},
		{id:'t_bottom_ad',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x100.gif',left:'record_1',right:'tuijian_4',up:'t_right_ad',down:''},
		
		/* 推荐课程 */
		{id:'tuijian_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'t_right_ad',right:'tuijian_2',up:'ch_3',down:'tuijian_4'},
		{id:'tuijian_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'tuijian_1',right:'tuijian_3',up:'ch_3',down:'tuijian_5'},
		{id:'tuijian_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'tuijian_2',right:'',up:'ch_3',down:'tuijian_6'},
		{id:'tuijian_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'t_right_ad',right:'tuijian_5',up:'tuijian_1',down:''},
		{id:'tuijian_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'tuijian_4',right:'tuijian_6',up:'tuijian_2',down:''},
		{id:'tuijian_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'tuijian_5',right:'',up:'tuijian_3',down:''},
		
		/* 角色信息   */
		{id:'role_info',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'/static/v1/hd/images/common/selectBox/select_box_210x210.gif',left:'',right:'t_right_ad',up:'t_left_ad',down:'record_1'},
		
		/* 最近观看记录 */		
		{id:'record_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_370x60.gif',left:'',right:'t_bottom_ad',up:'role_info',down:'record_2'},
		{id:'record_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_370x60.gif',left:'',right:'t_bottom_ad',up:'record_1',down:'record_3'},
		{id:'record_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_370x60.gif',left:'',right:'t_bottom_ad',up:'record_2',down:''},
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

<!-- 静态图片 -->
<div id="user_info_bg"></div>
<div id="recently_saw_bg"></div>
<?php $__FOR_START_8846__=1;$__FOR_END_8846__=6;for($i=$__FOR_START_8846__;$i < $__FOR_END_8846__;$i+=1){ $left = 85 + ($i-1)*225; ?>
	<div class="shadow" style="left:<?php echo ($left); ?>px;"></div><?php } ?>


<!-- 顶部-栏目 -->
<?php if(is_array($topChannel)): $i = 0; $__LIST__ = $topChannel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i; $left = 100 + ($i-1)*150; $top = 95; ?>
	<div id="div_ch_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($ch['linkUrl']); ?>" src="<?php echo ($ch['linkImage']); ?>" width="120" height="38">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 页面左侧 -->
	<!-- 广告 -->
<div id="div_t_left_ad" style="position:absolute;width:220px;height:184px;left:80px;top:180px;text-align:center;">
	<img id="t_left_ad"  src="<?php echo ($left_ad['content']); ?>" width="210" height="174">
</div>
<div id="div_t_left_ad_focus" style="position:absolute;visibility: hidden;width:230px;height:194px;left:75px;top:175px;text-align:center;">
	<img id="t_left_ad_focus" src="" width="220" height="184">
</div>

<!-- 角色信息按钮 -->
<div id="div_role_info" style="position:absolute;width:220px;height:135px;left:85px;top:370px;">
	<img id="role_info"  title="<?php echo U('Role/userInfo');?>" src="/static/v1/hd/images/index/recommend/user_info_bg.jpg" width="210" height="125">
</div>
<div id="div_role_info_focus" style="position:absolute;visibility: hidden;width:220px;height:135px;left:79px;top:367px;text-align:center;">
	<img id="role_info_focus" src="" width="218" height="130">
</div>



<!-- 最近观看记录 -->
<?php if(is_array($record)): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i; $left = 130; $top = 510 + ($i-1)*30; ?>
	<div id="div_record_<?php echo ($i); ?>" style="position:absolute;width:160px;height:30px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;vertical-align: middle;">
		<span id="record_<?php echo ($i); ?>" title=""><?php echo ($r['name']); ?></span>
	</div>	
	<div id="div_record_<?php echo ($i); ?>_focus" style="position:absolute;visibility: hidden;width:165px;height:30px;left:<?php echo ($left-10); ?>px;top:<?php echo ($top-2); ?>px;text-align:center;">
		<img id="record_<?php echo ($i); ?>_focus" src="" width="165" height="24">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 页面中间-课程 -->
<div id="div_t_right_ad" style="position:absolute;width:220px;height:330px;left:305px;top:180px;text-align:center;">
	<img id="t_right_ad" title="<?php echo U('SectionList/index?chId='.$courses1[0]['chId'].'&stageId='.$courses1[0]['stageIds'].'&courseId='.$courses1[0]['id']);?>"  src="<?php echo get_upfile_url($courses1[0]['imgUrl']);?>" width="210" height="320">
</div>
<div id="div_t_right_ad_focus" style="position:absolute;visibility: hidden;width:230px;height:340px;left:300px;top:175px;text-align:center;">
	<img id="t_right_ad_focus" src="" width="220" height="330">
</div>
<div id="div_t_bottom_ad" style="position:absolute;width:220px;height:110px;left:305px;top:515px;text-align:center;">
	<img id="t_bottom_ad" title="<?php echo U('SectionList/index?chId='.$courses1[1]['chId'].'&stageId='.$courses1[1]['stageIds'].'&courseId='.$courses1[1]['id']);?>" src="<?php echo get_upfile_url($courses1[1]['imgUrl']);?>" width="210" height="100">
</div>
<div id="div_t_bottom_ad_focus" style="position:absolute;visibility: hidden;width:230px;height:120px;left:300px;top:510px;text-align:center;">
	<img id="t_bottom_ad_focus" src="" width="220" height="110">
</div>


<!-- 页面右侧-推荐课程 -->
<?php if(is_array($courses2)): $i = 0; $__LIST__ = $courses2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$course): $mod = ($i % 2 );++$i; if($i > 3){ $top = 405; $left = 530 + ($i-4)*225; }else{ $top = 180; $left = 530 + ($i-1)*225; } ?>
	<div id="div_tuijian_<?php echo ($i); ?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="tuijian_<?php echo ($i); ?>" title="<?php echo U('SectionList/index?chId='.$course['chId'].'&stageId='.$course['stageIds'].'&courseId='.$course['id']);?>" src="<?php echo get_upfile_url($course['imgUrl']);?>" width="210" height="210">
	</div>
	<div id="div_tuijian_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:230px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
		<img id="tuijian_<?php echo ($i); ?>_focus" src="" width="220" height="220">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


</body>
</html>