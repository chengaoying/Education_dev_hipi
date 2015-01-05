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

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',1);?>" ></a>

<!-- 静态图片 -->
<div id="selectFace_set"></div>
<div id="tip"></div>
<div id="bottom"></div>


<form id="form" action="<?php echo U(Role/selectFace);?>" method="post" style="padding:10px">
	<?php $__FOR_START_15653__=0;$__FOR_END_15653__=13;for($i=$__FOR_START_15653__;$i < $__FOR_END_15653__;$i+=1){ ?><input type="hidden" id="face_<?php echo ($i); ?>ID" name="face_<?php echo ($i); ?>" value=""/><?php } ?>
</form>

<!-- 默认  -->
<div id="div_face_0" style="position:absolute;left:140px;top:210px;text-align:center;">
	<img id="face_0" src="/static/v1/hd/images/usercenter/baseInfo/face_0.png" width="130" height="170">
</div>
<div id="div_face_0_focus" style="position:absolute;visibility:hidden;left:140px;top:210px;text-align:center;">
	<img id="face_0_focus" src="" width="125" height="165">
</div>
<?php $__FOR_START_32506__=1;$__FOR_END_32506__=13;for($i=$__FOR_START_32506__;$i < $__FOR_END_32506__;$i+=1){ if($i > 6){ $top = 400; $left = 320 + ($i-7)*140; }else{ $top = 210; $left = 320 + ($i-1)*140; } ?>
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




<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>