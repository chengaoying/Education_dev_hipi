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
    body{ background-image:url(/static/v1/hd/images/usercenter/baseInfo/info_bg.jpg); }
/* 设置头像  */
#selectFace_set{
	position:absolute;
    display: block;
    width:142px;
    height:42px;
    top:90px;
    left:150px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/selectFace_set.png);
}
/* 提示 */
#tip{
	position:absolute;
    display: block;
    width:339px;
    height:22px;
    top:100px;
    left:350px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/select_tip_1.png);
}
/* bottom */
#bottom{
	position:absolute;
    display: block;
    width:1106px;
    height:456px;
    top:160px;
    left:90px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/face_bottom.png);
}


</style>

<script type="text/javascript">

/* 页面可点击按钮  */
var buttons=
	[
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
		{id:'',name:'',action:'',linkImage:'',focusImage:'',left:'',right:'',up:'',down:''},
	];

/* 初始化按钮 属性   */
var initButtons = function(){
	
	for(var i=0; i<13; i++)
	{
		buttons[i].id = 'face_' + i;
		buttons[i].action = 'select(' + '\"' + i + '\"' + ')';
		buttons[i].linkImage = "/static/v1/hd/images/usercenter/baseInfo/face_"+ i +".png";
		buttons[i].focusImage = "/static/v1/hd/images/usercenter/baseInfo/face_"+ i +".png";
		buttons[i].selectBox = '/static/v1/hd/images/usercenter/baseInfo/face_kuang.png';
		buttons[i].left = 'face_' + (i-1);
		buttons[i].right = 'face_' + (i+1);
		
		if(i==0)
		{
			buttons[i].left = '';
			buttons[i].right = 'face_' + (i+1);
			buttons[i].up = '';
			buttons[i].down = 'face_' + (i+6);
		}
		else if(i==12)
		{
			buttons[i].left = 'face_' + (i-1);
			buttons[i].right = '';
			buttons[i].up = 'face_' + (i-6);
			buttons[i].down = '';
		}
		else 
		{
			if(i<=6)
			{
				buttons[i].up = '';
				buttons[i].down = 'face_' + (i+6);
			}
			else
			{
				buttons[i].up = 'face_' + (i-6);
				buttons[i].down = '';
			}
		}
	}
}
window.onload=function()
{
	initButtons();
	Epg.btn.init('face_'+<?php echo ($face); ?>,buttons,true);	
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',0);?>" ></a>

<!-- 静态图片 -->
<div id="selectFace_set"></div>
<div id="tip"></div>
<div id="bottom"></div>


<form id="form" action="<?php echo U(Role/selectFace);?>" method="post" style="padding:10px">
	<?php $__FOR_START_1123__=0;$__FOR_END_1123__=13;for($i=$__FOR_START_1123__;$i < $__FOR_END_1123__;$i+=1){ ?><input type="hidden" id="face_<?php echo ($i); ?>ID" name="face_<?php echo ($i); ?>" value=""/><?php } ?>
</form>

<!-- 默认  -->
<div id="div_face_0" style="position:absolute;left:140px;top:210px;text-align:center;">
	<img id="face_0" src="/static/v1/hd/images/usercenter/baseInfo/face_0.png" width="130" height="170">
</div>
<div id="div_face_0_focus" style="position:absolute;visibility:hidden;left:140px;top:210px;text-align:center;">
	<img id="face_0_focus" src="" width="125" height="165">
</div>
<?php $__FOR_START_14432__=1;$__FOR_END_14432__=13;for($i=$__FOR_START_14432__;$i < $__FOR_END_14432__;$i+=1){ if($i > 6){ $top = 400; $left = 320 + ($i-7)*140; }else{ $top = 210; $left = 320 + ($i-1)*140; } ?>
	<div id="div_face_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="face_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/baseInfo/face_<?php echo ($i); ?>.png" width="130" height="170">
	</div>
	<div id="div_face_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="face_<?php echo ($i); ?>_focus" src="" width="125" height="165">
	</div><?php } ?>

<script type="text/javascript">

function select(face){
	G('face_'+face+'ID').value = face;
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