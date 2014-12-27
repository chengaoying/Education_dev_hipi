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
    body{ background-image:url(/static/v1/hd/images/usercenter/baseInfo/info_bg.jpg); }
/* 选择账号  */
#selectFace_set{
	position:absolute;
    display: block;
    width:142px;
    height:42px;
    top:90px;
    left:150px;	
    background-image:url(/static/v1/hd/images/usercenter/changeNum/changeNum_set.png);
}
/* 提示 */
#tip{
	position:absolute;
    display: block;
    width:348px;
    height:22px;
    top:100px;
    left:350px;	
    background-image:url(/static/v1/hd/images/usercenter/changeNum/changeNum_tip.png);
}


</style>

<script type="text/javascript">

var countButton = <?php echo ($count); ?>+2;
var isLeft = <?php echo ($leftDir); ?>;
var isRight = <?php echo ($rightDir); ?>;

/* 页面可点击按钮  */
var buttons= new Array(countButton);

/* 初始化按钮 属性   */
var initButtons = function(){
	
	for(var i=0; i<buttons.length; i++)
	{
		obj = new Object();
		
		obj.id = 'option_' + i;
		obj.action = 'select(' + '\"' + i + '\"' + ')';
		obj.linkImage = "/static/v1/hd/images/usercenter/changeNum/right_1.png";
		obj.focusImage = "/static/v1/hd/images/usercenter/changeNum/right_2.png";
		obj.selectBox = '/static/v1/hd/images/usercenter/changeNum/kuang.png';
		obj.left = 'option_' + (i-1);
		obj.right = 'option_' + (i+1);
		
		buttons[i] = obj;
	}
	if(!isLeft)
	{
		buttons[1].left = '';
	}
	else
	{
		buttons[0].left = '';
		buttons[0].linkImage = "/static/v1/hd/images/usercenter/changeNum/left_1.png";
		buttons[0].focusImage = "/static/v1/hd/images/usercenter/changeNum/left_2.png";
		buttons[0].selectBox = '';
	}
	if(!isRight)
	{
		buttons[countButton-2].right = '';
	}
	else
	{
		buttons[countButton-1].right = '';
		buttons[countButton-1].linkImage = "/static/v1/hd/images/usercenter/changeNum/right_1.png";
		buttons[countButton-1].focusImage = "/static/v1/hd/images/usercenter/changeNum/right_2.png";
		buttons[countButton-1].selectBox = '';
	}
}
window.onload=function()
{
	initButtons();
	Epg.btn.init('option_1',buttons,true);	
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',1);?>" ></a>

<!-- 静态图片 -->
<div id="selectFace_set"></div>
<div id="tip"></div>


<form id="form" action="<?php echo U('Role/changeNum');?>" method="post" style="padding:10px">
	<?php $__FOR_START_9718__=1;$__FOR_END_9718__=$count+1;for($i=$__FOR_START_9718__;$i < $__FOR_END_9718__;$i+=1){ ?><input type="hidden" id="option_<?php echo ($i); ?>ID" name="option_<?php echo ($i); ?>" value=""/><?php } ?>
</form>


<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; $top = 220; $left = 180 + ($i-1)*240; $count = count($lists); ?>
	
	
	<div id="div_option_<?php echo ($i); ?>" style="position:absolute;visibility:hidden;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="option_<?php echo ($i); ?>" src="" >
	</div>
	<div id="div_bottom_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="bottom_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/changeNum/changeNum_bottom.png" width="200" height="290">
	</div>
 	<div id="div_face_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left+10); ?>px;top:<?php echo ($top+10); ?>px;text-align:center;">
		<img id="face_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/changeNum/face_<?php echo ($list['face']); ?>.png" width="180" height="200">
	</div>
	<?php if($list['name'] != ''): ?><!-- 最后一个不显示以下两项  -->
		<div id="div_name_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left+10); ?>px;top:<?php echo ($top+210); ?>px;text-align:center;line-height:37px;width:170px;height:37px;">
			<span style="color:blue;" > <?php echo ($list['name']); ?> </span>
		</div>
		 <div id="div_stage_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left+60); ?>px;top:<?php echo ($top+245); ?>px;text-align:center;">
			<img id="stage_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/changeNum/s_<?php echo ($list['stage']); ?>.png" width="66" height="21">
		</div><?php endif; ?>
	<div id="div_option_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;left:<?php echo ($left-1); ?>px;top:<?php echo ($top-2); ?>px;text-align:center;">
		<img id="option_<?php echo ($i); ?>_focus" src="" width="197" height="289">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 左分页符号 -->
<?php if($leftDir): ?><div id="div_option_0" style="position:absolute;left:50px;top:345px;text-align:center;">
		<img id="option_0" src="/static/v1/hd/images/usercenter/changeNum/left_1.png" width="25" height="30">
	</div><?php endif; ?>
<!-- 右分页符号 -->
<?php if($rightDir): ?><div id="div_option_<?php echo ($count+1); ?>" style="position:absolute;left:1200px;top:345px;text-align:center;">
		<img id="option_<?php echo ($count+1); ?>" title="<?php echo U(Role/changeNum);?>" src="/static/v1/hd/images/usercenter/changeNum/right_1.png" width="25" height="30">
	</div><?php endif; ?>

<script type="text/javascript">

function select(option){
/* 	G('face_'+face+'ID').value = face;
	G('form').submit(); */
	var lists = <?php echo ($json_lists); ?>;
	if(option == countButton-1)
	{
		window.location.href = "/Hd/Role/changeNum?page="+<?php echo ($page+1); ?>;
	}
	else if(option == 0)
	{
		window.location.href = "/Hd/Role/changeNum?page="+<?php echo ($page-1); ?>;
	}
	else if((option == countButton-2) && option<=lists.length && lists[option-1]['face']=='add')
	{
		window.location.href = "/Hd/Role/createRole";
	}
	else
	{
		G('option_'+option+'ID').value = lists[option-1]['id'];
		G('form').submit();
	}
}

</script>



</body>
</html>