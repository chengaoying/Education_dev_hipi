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
 * @param type 弹窗类型：1-无图片的提示信息，2-为有图片的提示信息，不设置则默认为1
 */
var popup = function(type){
	Epg.popup("<?php echo ($floatMsg); ?>",3,type);
}	

</script>

</head>
<body >

<style>
    body{ background-image:url(/static/v1/hd/images/usercenter/growthIndex/bg_growth.jpg); }

/* 宝宝  */
#baobao{
	position:absolute;
    display: block;
    width:258px;
    height:383px;
    top:205px;
    left:865px;	
    background-image:url(/static/v1/hd/images/usercenter/growthIndex/baobao.png);
}
</style>



<script type="text/javascript">

/* 页面可点击按钮  */
var buttons= new Array(6);

function initbuttons()
{
	for(var i=1; i<=buttons.length; i++)
	{
		obj = new Object();
		
		obj.id = 'option_' + i;
		obj.linkImage = "/static/v1/hd/images/usercenter/growthIndex/option_"+i+".png";
		obj.focusImage = "/static/v1/hd/images/usercenter/growthIndex/option_over_"+i+".png";
		obj.up = (i>1) ? 'option_'+(i-1) : '' ; 
		obj.down = (i<buttons.length) ? 'option_'+(i+1) : '';
		buttons[i-1] = obj;
	}
}

window.onload=function()
{
	//Epg.tip('');//显示info信息，3秒后自动隐藏，如果info为空将不会显示
	initbuttons();
	Epg.btn.init('option_1',buttons,true);	
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',0);?>" ></a>

<!-- 静态图片 -->
<div id="baobao"></div>


<?php $__FOR_START_24576__=1;$__FOR_END_24576__=7;for($i=$__FOR_START_24576__;$i < $__FOR_END_24576__;$i+=1){ $left = 650; $top = 195 + ($i - 1)*70; ?>
	<div id="div_option_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="option_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/growthIndex/option_<?php echo ($i); ?>.png" width="150" height="34">
	</div><?php } ?>

<div style="position:absolute;left:980px;top:300px;text-align:center;">
	<img src="/static/v1/hd/images/usercenter/growthIndex/mouth_<?php echo ($m); ?>/option_1.png" width="158" height="268">
</div>
<div style="position:absolute;left:160px;top:355px;text-align:center;">
	<img src="/static/v1/hd/images/usercenter/growthIndex/mouth_<?php echo ($m); ?>/option_0.png" width="351" height="166">
</div>



<script type="text/javascript">

function submit(){
	G('form').submit();
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