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


<style>

	body{ background-image:url(/static/v1/hd/images/usercenter/bg.jpg); }
/* 用户信息背景底框 */
#bottom{
	position: absolute;
	display: block;
	width: 379px;
	height: 350px;
	top: 190px;
	left: 400px;
	background-image: url(/static/v1/hd/images/usercenter/baseInfo/bottom_baseInfo.png);
}
</style>

<script type="text/javascript">
	var faceNum = <?php echo ($face); ?>;
	var channel = <?php echo ($json_channel); ?>;
	var focus = '<?php echo ($focus); ?>';
	
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',blurHandler:'blurHandler()',up:'changeNum',down:'ch_2',right:'stage'}, 
	{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',focusHandler:'focusHandler()',up:'ch_1',down:'ch_3',right:'stage'}, 
	{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',focusHandler:'focusHandler()',up:'ch_2',right:'stage'},

	{id:'stage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_long_over.png',resize:'-1',left:'selectFace',right:'',up:'',down:'nickname'},
	{id:'nickname',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_long_over.png',resize:'-1',left:'changeNum',right:'advantage',up:'stage',down:'birthday'},
	{id:'birthday',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_long_over.png',resize:'-1',left:'ch_1',right:'disadvantage',up:'nickname',down:'sex'},
	{id:'sex',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_long_over.png',resize:'-1',left:'ch_2',right:'interests',up:'birthday',down:'phone'},
	{id:'phone',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_long_over.png',resize:'-1',left:'ch_3',up:'sex',down:''},

	{id:'version',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_long.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_long_over.png',resize:'-1',left:'nickname',up:'phone',down:'advantage'},
	{id:'advantage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_short.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_short_over.png',resize:'-1',left:'nickname',up:'',down:'disadvantage'},
	{id:'disadvantage',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_short.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_short_over.png',resize:'-1',left:'birthday',right:'',up:'advantage',down:'interests'},
	{id:'interests',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/kuang_short.png',selectBox:'/static/v1/hd/images/usercenter/baseInfo/kuang_short_over.png',resize:'-1',left:'sex',up:'disadvantage',down:''},

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
			buttons[i].titleImage = channel[i].titleImage;
		} 
	}
	
	var filterFocus = function()
	{
		if(focus !== 'ch_1') G('ch_1').src = buttons[0].titleImage;
	}
	
	window.onload = function() {
		initButtons();
		popup();
		filterFocus();
		Epg.btn.init(focus, buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="bottom"></div>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',0);?>" ></a>


<!-- 以下是导航栏 -->
<?php if(is_array($channels)): $i = 0; $__LIST__ = $channels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i; $left = 0; $top = 340 + ($i-1)*70; ?>
    <div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility:visible;left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($channel['linkUrl']); ?>"
			src="<?php echo ($channel['linkImage']); ?>" width="290" height="70">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 选择头像  -->
<div id="div_selectFace" style="position:absolute;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace" title="<?php echo U('Role/selectFace');?>" src="/static/v1/hd/images/usercenter/baseInfo/face_<?php echo ($face); ?>.png" width="130" height="170">
</div>
<div id="div_selectFace_focus" style="position:absolute;visibility:hidden;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace_focus" title="" src="" width="125" height="165">
</div>
<!-- 切换账号  -->
<div id="div_changeNum" style="position:absolute;left:95px;top:260px;text-align:center;">
	<img id="changeNum" title="<?php echo U('Role/changeNum');?>" src="/static/v1/hd/images/usercenter/leftNavigation/change_account.png" width="120" height="35">
</div>



<!-- 学号  -->
<div style="position:absolute;line-height:56px;width:91px;height:56px;left:800px;top:175px;text-align:center;border-style:none;color:black">
	<span style="color:white;text-align:center;"><?php echo ($roleId); ?></span>
</div>
<!-- 用户信息 -->
<?php if(is_array($userInfo)): $i = 0; $__LIST__ = $userInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i; if($i > 5){ $left = 800; $top = 255 + ($i-6)*80; }else{ $left = 480; $top = 175 + ($i-1)*80; } ?>
	
	<?php if(is_array($info['content'])): $j = 0; $__LIST__ = $info['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$content): $mod = ($j % 2 );++$j; if($info['name']=="advantage" || $info['name']=="disadvantage"){ $bottom = 'kuang_short.png'; $bottom_over = 'kuang_short_over.png'; $width = 96; $left_content = $left + (($j-1)%4)*100; $top_content = $top; } else if($info['name']=="interests") { $bottom = 'kuang_short.png'; $bottom_over = 'kuang_short_over.png'; $width = 96; $left_content = $left + (($j-1)%4)*100; $top_content = $top + floor(($j-1)/4)*60; } else { $bottom = 'kuang_long.png'; $bottom_over = 'kuang_long_over.png'; $width = 176; $left_content = $left; $top_content = $top; } ?>
		<div id="div_<?php echo ($info['name']); ?>" style="position:absolute;left:<?php echo ($left_content); ?>px;top:<?php echo ($top_content); ?>px;text-align:center;">
			<img id="<?php echo ($info['name']); ?>" title="<?php echo ($info['linkUrl']); ?>" src="/static/v1/hd/images/usercenter/baseInfo/<?php echo ($bottom); ?>" width=<?php echo ($width); ?> height="56">
		</div>
		<div id="div_<?php echo ($info['name']); ?>_focus" style="position:absolute;visibility:hidden;left:<?php echo ($left_content); ?>px;top:<?php echo ($top_content); ?>px;text-align:center;">
			<img id="<?php echo ($info['name']); ?>_focus" src="/static/v1/hd/images/usercenter/baseInfo/<?php echo ($bottom_over); ?>" width=<?php echo ($width); ?> height="56">
		</div>
		<div id="div_<?php echo ($info['name']); ?>_content" style="position:absolute;line-height:56px;width:<?php echo ($width-5); ?>px;height:56px;left:<?php echo ($left_content); ?>px;top:<?php echo ($top_content); ?>px;text-align:center;">
			<span style="color:black;text-align:center;"><?php echo ($content); ?></span>
		</div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

<script type="text/javascript">

//失去时焦点处理（目前主要用于栏目按钮）
function blurHandler(){
	if(Epg.btn.current.id != "ch_2" && Epg.btn.current.id != "ch_3"){
		G(Epg.btn.previous.id).src = Epg.btn.previous.titleImage;
	}
}

//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	if(Epg.btn.current.id != "ch_1"){
		setTimeout("Epg.btn.click()",50);
	}
}

</script>


<!-- 1.无背景图的文字提示 -->
<div id="popup_1"></div>

<!-- 2.有背景图的文字提示 -->
<div id="popup_2">
	<div id="popup_2_info_bg"></div>
	<div id="popup_2_info"></div>
</div>

</body>
</html>