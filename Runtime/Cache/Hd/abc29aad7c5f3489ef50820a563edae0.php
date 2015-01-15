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

	body{ background-image:url(/static/v1/hd/images/usercenter/bg.jpg); }
/* 用户信息背景底框 */
#bottom{
	position: absolute;
	display: block;
	width: 351px;
	height: 285px;
	top: 225px;
	left: 410px;
	background-image: url(/static/v1/hd/images/usercenter/baseinfo1/bottom.png);
}
</style>

<script type="text/javascript">
	var faceNum = <?php echo ($face); ?>;
	var channel = <?php echo ($json_channel); ?>;
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'changeNum',down:'ch_2',right:'nickname'}, 
	{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'ch_1',down:'ch_3',right:'nickname'}, 
	{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'ch_2',right:'nickname'},

	{id:'nickname',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long_over.png',resize:'-1',left:'selectFace',right:'version',down:'sex'},
	{id:'sex',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long_over.png',resize:'-1',left:'changeNum',right:'advantage',up:'nickname',down:'birthday'},
	{id:'birthday',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long_over.png',resize:'-1',left:'changeNum',right:'disadvantage',up:'sex',down:'stage'},
	{id:'stage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long_over.png',resize:'-1',left:'ch_3',right:'interests',up:'birthday',down:''},

	{id:'phone',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long_over.png',resize:'-1',left:'nickname',up:'ch_3',down:'version'},
	{id:'version',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_long_over.png',resize:'-1',left:'nickname',up:'phone',down:'advantage'},
	{id:'advantage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_short.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_short_over.png',resize:'-1',left:'sex',up:'version',down:'disadvantage'},
	{id:'disadvantage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_short.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_short_over.png',resize:'-1',left:'birthday',right:'',up:'advantage',down:'interests'},
	{id:'interests',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo1/kuang_short.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo1/kuang_short_over.png',resize:'-1',left:'stage',up:'disadvantage',down:''},

	{id:'selectFace',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',selectBox:'/static/v1/hd/images/usercenter/leftNavigation/title_kuang.png',right:'nickname',up:'ch_3',down:'changeNum'},
	{id:'changeNum',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account.png',focusImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account_over.png',selectBox:'',right:'sex',up:'selectFace',down:'ch_1'},

	];
	
	var initButtons = function()
	{
 		for(var i=0; i<channel.length; i++)
		{
			buttons[i].name = channel[i].name;
			buttons[i].linkImage = channel[i].linkImage;
			buttons[i].focusImage = channel[i].focusImage;
		} 
	}
	window.onload = function() {
		initButtons();
		Epg.btn.init('ch_3', buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="bottom"></div>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>


<!-- 以下是导航栏 -->
<?php if(is_array($channels)): $i = 0; $__LIST__ = $channels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i; $left = 120; $top = 430 + ($i-1)*60; ?>
    <div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility:visible;left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($channel['linkUrl']); ?>"
			src="<?php echo ($channel['linkImage']); ?>" width="170" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
<!-- 选择头像  -->
<div id="div_selectFace" style="position:absolute;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace" title="<?php echo U('Role/selectFace');?>" src="/static/v1/hd/images/usercenter/baseInfo/face_<?php echo ($face); ?>.png" width="130" height="170">
</div>
<div id="div_selectFace_focus" style="position:absolute;visibility:hidden;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace_focus" title="" src="" width="125" height="165">
</div>
<!-- 切换账号  -->
<div id="div_changeNum" style="position:absolute;left:95px;top:322px;text-align:center;">
	<img id="changeNum" title="<?php echo U('Role/changeNum');?>" src="/static/v1/hd/images/usercenter/leftNavigation/change_account.png" width="110" height="25">
</div>



<!-- 学号  -->
<div style="position:absolute;line-height:46px;width:156px;height:46px;left:480px;top:217px;text-align:center;border-style:none;color:black">
	<span style="color:black;text-align:center;"><?php echo ($roleId); ?></span>
</div>
<!-- 用户信息 -->
<?php if(is_array($userInfo)): $i = 0; $__LIST__ = $userInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i; if($i > 4){ $left = 780; $top = 213 + ($i-5)*65; }else{ $left = 480; $top = 282 + ($i-1)*65; } ?>
	
	<?php if(is_array($info['content'])): $j = 0; $__LIST__ = $info['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$content): $mod = ($j % 2 );++$j; if($info['name']=="advantage" || $info['name']=="disadvantage" || $info['name']=="interests"){ $bottom = 'kuang_short.png'; $bottom_over = 'kuang_short_over.png'; $width = 76; $left_content = $left + (($j-1)%4)*80; $top_content = $top; }else{ $bottom = 'kuang_long.png'; $bottom_over = 'kuang_long_over.png'; $width = 156; $left_content = $left; $top_content = $top; } ?>
		<div id="div_<?php echo ($info['name']); ?>" style="position:absolute;left:<?php echo ($left_content); ?>px;top:<?php echo ($top_content); ?>px;text-align:center;">
			<img id="<?php echo ($info['name']); ?>" title="<?php echo ($info['linkUrl']); ?>" src="/static/v1/hd/images/usercenter/baseInfo1/<?php echo ($bottom); ?>" width=<?php echo ($width); ?> height="46">
		</div>
		<div id="div_<?php echo ($info['name']); ?>_focus" style="position:absolute;visibility:hidden;left:<?php echo ($left_content); ?>px;top:<?php echo ($top_content); ?>px;text-align:center;">
			<img id="<?php echo ($info['name']); ?>_focus" src="/static/v1/hd/images/usercenter/baseInfo1/<?php echo ($bottom_over); ?>" width=<?php echo ($width); ?> height="46">
		</div>
		<div id="div_<?php echo ($info['name']); ?>_content" style="position:absolute;line-height:46px;width:<?php echo ($width-5); ?>px;height:46px;left:<?php echo ($left_content); ?>px;top:<?php echo ($top_content); ?>px;text-align:center;border-style:none;color:black">
			<span style="color:black;text-align:center;"><?php echo ($content); ?></span>
		</div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>



<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>