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

	body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
/* 用户信息背景底框 */
#bottom{
	position: absolute;
	display: block;
	width: 1110px;
	height: 435px;
	top: 180px;
	left: 85px;
	background-image: url(/static/v1/hd/images/usercenter/bottom.png);
}
/* 用户中心 */
#usercenter{
	position: absolute;
	display: block;
	width: 134px;
	height: 34px;
	top: 85px;
	left: 90px;
	background-image: url(/static/v1/hd/images/usercenter/channel/usercenter.png);
}
/* 提示*/
#tip{
	position: absolute;
	display: block;
	width: 299px;
	height: 19px;
	top: 220px;
	left: 170px;
	background-image: url(/static/v1/hd/images/usercenter/baseInfo/userinfo_tip.png);
}
/* 头像*/
#photo{
	position: absolute;
	display: block;
	width: 130px;
	height: 170px;
	top: 290px;
	left: 170px;
	background-image: url(/static/v1/hd/images/usercenter/baseInfo/face_0.png);
}
</style>

<script type="text/javascript">
	var faceNum = <?php echo ($face); ?>;
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/glory_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/glory_2.png',onFocus:'1',resize:'-1',selectBox:'',right:'ch_2',down:'nickname'}, 
	{id:'ch_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/learning_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/learning_2.png',onFocus:'1',resize:'-1',selectBox:'',left:'ch_1',right:'ch_3',down:'nickname'}, 
	{id:'ch_3',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/channel/baseInfo_1.png',focusImage:'/static/v1/hd/images/usercenter/channel/baseInfo_2.png',onFocus:'1',resize:'-1',selectBox:'',left:'ch_2',down:'nickname'},

	{id:'nickname',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/nickname_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/nickname_2.png',selectBox:'',left:'selectFace',right:'version',up:'ch_3',down:'sex'},
	{id:'sex',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/sex_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/sex_2.png',selectBox:'',left:'selectFace',right:'advantage',up:'nickname',down:'birthday'},
	{id:'birthday',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/birthday_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/birthday_2.png',selectBox:'',left:'changeNum',right:'disadvantage',up:'sex',down:'stage'},
	{id:'stage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/stage_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/stage_2.png',selectBox:'',left:'changeNum',right:'interests',up:'birthday',down:''},

	{id:'phone',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/phone_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/phone_2.png',selectBox:'',left:'nickname',up:'ch_3',down:'version'},
	{id:'version',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/version_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/version_2.png',selectBox:'',left:'nickname',up:'phone',down:'advantage'},
	{id:'advantage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/advantage_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/advantage_2.png',selectBox:'',left:'sex',up:'version',down:'disadvantage'},
	{id:'disadvantage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/disadvantage_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/disadvantage_2.png',left:'birthday',right:'',up:'advantage',down:'interests'},
	{id:'interests',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/interests_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/interests_2.png',selectBox:'',left:'stage',up:'disadvantage',down:''},

	{id:'selectFace',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/face_kuang.png',right:'nickname',up:'ch_3',down:'changeNum'},
	{id:'changeNum',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/change_1.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/change_2.png',selectBox:'',right:'birthday',up:'selectFace',down:''},

	
	];

	window.onload = function() {
		Epg.btn.init('ch_3', buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="bottom"></div>
<div id="tip"></div>
<div id="usercenter"></div>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>


<!-- 以下是导航栏 -->
<!-- 荣誉成就 -->
<div id="div_ch_1" style="position:absolute;visibility:visible;left:300px;top:95px;">
	<img id='ch_1' title="/Hd/Glory/index"
		src="/static/v1/hd/images/usercenter/channel/glory_1.png" width="110" height="33">
</div>
<div id="div_ch_1_focus" style="position:absolute; visibility:hidden;left:300px;top:95px; text-align:center;">
	<img id="ch_1_focus" src="/static/v1/hd/images/usercenter/channel/glory_2.png" width="110" height="33">
</div>
<!-- 学习评估 -->
<div id="div_ch_2" style="position:absolute;visibility:visible;left:450px; top:95px;">
	<img id='ch_2' title="/Hd/Learning/<?php echo ($stageType); ?>"
		src="/static/v1/hd/images/usercenter/channel/learning_1.png" width="110" height="33">
</div>
<div id="div_ch_2_focus" style="position:absolute; visibility:hidden; left:450px; top:95px; text-align:center;">
	<img id="ch_2_focus" src="/static/v1/hd/images/usercenter/channel/learning_2.png" width="110" height="33">
</div>
<!-- 基本信息 -->
<div id="div_ch_3" style="position:absolute;visibility:visible;left:600px; top:95px;">
	<img id='ch_3' title="/Hd/Role/userInfo"
		src="/static/v1/hd/images/usercenter/channel/baseInfo_1.png" width="110" height="33">
</div>
<div id="div_ch_3_focus" style="position:absolute; visibility:hidden; left:600px; top:95px; text-align:center;">
	<img id="ch_3_focus" src="/static/v1/hd/images/usercenter/channel/baseInfo_2.png" width="110" height="33">
</div>

<?php if(is_array($userInfo)): $i = 0; $__LIST__ = $userInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i; if($i > 5){ $left = 670; $top = 300 + ($i-6)*50; }else{ $left = 370; $top = 300 + ($i-1)*50; } ?>
    <div id="div_<?php echo ($info['name']); ?>" style="position:absolute;width:92px;height:40px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="<?php echo ($info['name']); ?>" title="<?php echo ($info['linkUrl']); ?>" src="/static/v1/hd/images/usercenter/baseInfo/<?php echo ($info['name']); ?>_1.png" width="92" height="40">
	</div>
	
	<?php if(is_array($info['content'])): $j = 0; $__LIST__ = $info['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$content): $mod = ($j % 2 );++$j; if($info['name']=="advantage" || $info['name']=="disadvantage" || $info['name']=="interests"){ $bottom = 'bottom_short.png'; $width = 70; $left_content = $left + (($j-1)%4)*75; $top_content = $top; }else{ $bottom = 'bottom_long.png'; $width = 160; $left_content = $left; $top_content = $top; } ?>
		<div id="div_<?php echo ($info['name']); ?>_img" style="position:absolute;width:<?php echo ($width); ?>px;height:40px;left:<?php echo ($left_content+92); ?>px;top:<?php echo ($top_content); ?>px;text-align:center;">
			<img id="<?php echo ($info['name']); ?>_img" src="/static/v1/hd/images/usercenter/baseInfo/<?php echo ($bottom); ?>" width=<?php echo ($width); ?> height="40">
		</div>
		 <div id="div_<?php echo ($info['name']); ?>_content" style="position:absolute;line-height:37px;width:<?php echo ($width-4); ?>px;height:37px;left:<?php echo ($left_content+92); ?>px;top:<?php echo ($top_content); ?>px;text-align:center;">
			<span style="color:black;text-align:center;"><?php echo ($content); ?></span>
		</div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
<!-- 切换账号  -->
<div id="div_changeNum" style="position:absolute;left:174px;top:465px;text-align:center;">
	<img id="changeNum" title="<?php echo U('Role/changeNum');?>" src="/static/v1/hd/images/usercenter/baseInfo/change_1.png" width="130" height="40">
</div>
<!-- 选择头像  -->
<div id="div_selectFace" style="position:absolute;width:140px;height:180px;left:170px;top:290px;text-align:center;">
	<img id="selectFace" title="<?php echo U('Role/selectFace');?>" src="/static/v1/hd/images/usercenter/baseInfo/face_<?php echo ($face); ?>.png" width="130" height="170">
</div>
<div id="div_selectFace_focus" style="position:absolute;visibility:hidden;width:150px;height:190px;left:165px;top:290px;text-align:center;">
	<img id="selectFace_focus" title="" src="" width="127" height="166">
</div>


<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>