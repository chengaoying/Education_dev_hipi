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

/* 设置兴趣  */
#logo{
	position:absolute;
    display: block;
    width:206px;
    height:40px;
    top:100px;
    left:100px;	
    background-image:url(/static/v1/hd/images/usercenter/mulchoice/<?php echo ($type); ?>.png);
}
/* 提示文字  */
#select_tip{
	position:absolute;
    display: block;
    width:427px;
    height:22px;
    top:110px;
    left:320px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/select_tip_2.png);
}
</style>

<script type="text/javascript">
var count = <?php echo ($count_sub); ?>;
var subject_selected = <?php echo ($json_selected); ?>;
var subjects = <?php echo ($subjects_json); ?>;
var n = 5;//一行五列
/* 页面可点击按钮  */
var buttons= new Array(count+1);
var initButtons = function()
{
	for(var i=1; i<buttons.length; i++)
	{
		obj = new Object();
		
		obj.id = 'subject_' + i;
		obj.action = 'select("'  + i + '")';
		obj.linkImage = "/static/v1/hd/images/usercenter/mulchoice/kuang_1.png";
		obj.focusImage = "/static/v1/hd/images/usercenter/mulchoice/kuang_2.png";
		obj.left = ((i-1)>0) ? 'subject_'+(i-1) : '' ;
		obj.right = ((i+1)<=count) ? 'subject_'+(i+1) : '' ;
		obj.up = (i-n>0) ? 'subject_'+(i-n) : '' ; 
		obj.down = (i+n)>count ? (Math.ceil(i/n)==Math.ceil(count/n) ? 'ok' : '') : 'subject_'+(i+n);
		
		buttons[i-1] = obj;
	}
	//ok up键值
	id = (Math.ceil(count/n)-1)*n+1;
	//第12个元素初始化为ok键
	buttons[count] = {id:'ok',action:'submit()',linkImage:'/static/v1/hd/images/usercenter/mulchoice/confirm_1.png',focusImage:'/static/v1/hd/images/usercenter/mulchoice/confirm_2.png',up:('subject_'+id),down:''};
}

var init_interests = function()
{
	for(var key in subject_selected)
	{
		G('form_'+key).value = subject_selected[key];
		G('div_'+key+'_selected').style.visibility = 'visible';
	}
}

window.onload=function()
{
	initButtons();
	init_interests();
	Epg.btn.init('subject_1',buttons,true);	
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',1);?>" ></a>

<!-- 静态图片 -->
<div id="logo"></div>
<div id="select_tip"></div>

<form id="form" action="<?php echo U(Role/setSex);?>" method="post" style="padding:10px">
	<?php if(is_array($subjects)): $i = 0; $__LIST__ = $subjects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subject): $mod = ($i % 2 );++$i;?><input type="hidden" id="form_subject_<?php echo ($i); ?>" name="form_<?php echo ($i); ?>" value=""/><?php endforeach; endif; else: echo "" ;endif; ?>
	<input type="hidden" name="type" value="<?php echo ($type); ?>"/>
</form>

<?php if(is_array($subjects)): $i = 0; $__LIST__ = $subjects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subject): $mod = ($i % 2 );++$i; $left = 100 + (($i-1)%5)*150; $top = 200 + (ceil($i/5)-1)*100; ?>
	
	<!-- 背景框，选中为青色，未选中为蓝色 -->
	<div id="div_subject_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id="subject_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/mulchoice/kuang_1.png" style="width:110px;height:50px;"/>
	</div>
	<!-- 科目文字 -->
	<div style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img   src="/static/v1/hd/images/usercenter/mulchoice/subject_<?php echo ($subject); ?>.png" style="width:110px;height:50px;"/>
	</div>
	<!-- 对勾，选中则显示√ -->
	<div id="div_subject_<?php echo ($i); ?>_selected" style="position:absolute;visibility:hidden;left:<?php echo ($left+78); ?>px;top:<?php echo ($top+15); ?>px;">
		<img id="subject_<?php echo ($i); ?>_selected" src="/static/v1/hd/images/usercenter/mulchoice/right.png" style="width:28px;height:22px;"/>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 确定按钮 -->
<div id="div_ok" style="position:absolute;left:100px;top:500px;">
    <img id="ok" title="" src="/static/v1/hd/images/usercenter/baseInfo/confirm_1.png" width="140" height="50">
</div>

<script type="text/javascript">

function submit(){
	G('form').submit();
}

function select(subject)
{
	if(G('div_subject_'+subject+'_selected').style.visibility == 'visible')
	{
		G('div_subject_'+subject+'_selected').style.visibility = 'hidden';
		G('form_subject_'+subject).value = '';
	}
	else
	{
		G('div_subject_'+subject+'_selected').style.visibility = 'visible'
		G('form_subject_'+subject).value = subjects['subject_'+subject];
	}

}

</script>










<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>