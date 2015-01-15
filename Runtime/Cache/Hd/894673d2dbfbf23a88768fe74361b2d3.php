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
	width: 774px;
	height: 410px;
	top: 165px;
	left: 100px;
	background-image: url(/static/v1/hd/images/freeZone/bottom.png);
}
/* logo */
#logo{
	position: absolute;
	display: block;
	width: 219px;
	height: 56px;
	top: 85px;
	left: 100px;
	background-image: url(/static/v1/hd/images/freeZone/logo.png);
}
/* 推荐 */
#recommend{
	position: absolute;
	display: block;
	width: 116px;
	height: 25px;
	top: 110px;
	left: 965px;
	background-image: url(/static/v1/hd/images/freeZone/recommend.png);
}

</style>

<script type="text/javascript">
	var img1 = '<?php echo ($img_recommend1); ?>';
	var img2 = '<?php echo ($img_recommend2); ?>';
	var count = <?php echo ($count); ?>;
	var buttons = new Array(count+4);
	var colnum = 2;
	
	function initbuttons()
	{
		for(var i=1; i<=buttons.length-4; i++)
		{
			obj = new Object();
			
			obj.id = 'option_' + i;
			obj.selectBox = "/static/v1/hd/images/freeZone/kuang_small.png";
			obj.resize = -1;
			obj.right = (i<buttons.length-4) ? 'option_'+(i+1) : '' ; 
			obj.left = (i>1) ? 'option_'+(i-1) : '' ; 
			obj.down = (i+colnum<=buttons.length-4) ? 'option_'+(i+colnum) : '';
			obj.up = (i-colnum>0) ? 'option_'+(i-colnum) : '' ; 
			
			if(i%colnum==0&&i<=8) obj.right = 'optionRecmd_1';
			if(i%colnum==0&&i>8) obj.right = 'optionRecmd_2';
			if(i==buttons.length-4&&i<=8) obj.right = 'optionRecmd_1';
			if(i==buttons.length-4&&i>8) obj.right = 'optionRecmd_2';
			
			buttons[i-1] = obj;
		}
		if(count>=1) buttons[buttons.length-4-1]['down'] = 'page_prev';	
		if(count>=2) buttons[buttons.length-4-2]['down'] = 'page_prev';
		
		buttons[buttons.length-4] = {id:'optionRecmd_1',linkImage:img1,selectBox:'/static/v1/hd/images/freeZone/kuang_big.png',resize:'-1',left:['option_4','option_2','option_1'],down:'optionRecmd_2'};		
		buttons[buttons.length-3] = {id:'optionRecmd_2',linkImage:img2,selectBox:'/static/v1/hd/images/freeZone/kuang_big.png',resize:'-1',left:['option_12','option_10','option_8','option_4','option_2','option_1'],up:'optionRecmd_1'};		
		
		buttons[buttons.length-2] = {id:'page_prev',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:'',up:buttons[buttons.length-4-1]['id']};
		buttons[buttons.length-1] = {id:'page_next',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:'',up:buttons[buttons.length-4-1]['id']};

	}
	window.onload = function() {
		initbuttons();
		Epg.btn.init('option_1', buttons, true);
	};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 静态图片 -->
<div id="bottom"></div>
<div id="logo"></div>
<div id="recommend"></div>

<?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; $left = 95 + (($i-1)%2)*414; $top = 160 + (ceil($i/2)-1)*60; ?>
	
	<div id="div_option_<?php echo ($i); ?>" style="position:absolute;visibility:hidden;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="option_<?php echo ($i); ?>" title="<?php echo U('Resource/play?sectionId='.$data['id']);?>" src="" width="370" height="60">
	</div>
	<div id="div_option_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
		<img id="option_<?php echo ($i); ?>_focus" title="" src="" width="370" height="60">
	</div>
	<!-- 文字 -->
	<div style="position:absolute;width:330px;height:30px;left:<?php echo ($left+20); ?>px;top:<?php echo ($top+10); ?>px;line-height:30px;text-align:center;">
		<span ><?php echo ($data['name']); ?></span>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

	<div id="div_optionRecmd_1" style="position:absolute;left:965px;top:165px;text-align:center;">
		<img id="optionRecmd_1" title="<?php echo U('SectionList/index?courseId='.$url_recommend1);?>" src="<?php echo ($img_recommend1); ?>" width="210" height="210">
	</div>
	<div id="div_optionRecmd_1_focus" style="position:absolute;visibility:hidden;left:960px;top:160px;text-align:center;">
		<img id="optionRecmd_1_focus" src="/static/v1/hd/images/freeZone/kuang_big.png" width="220" height="220">
	</div>
	<div id="div_optionRecmd_2" style="position:absolute;left:965px;top:395px;text-align:center;">
		<img id="optionRecmd_2" title="<?php echo U('SectionList/index?courseId='.$url_recommend2);?>" src="<?php echo ($img_recommend2); ?>" width="210" height="210">
	</div>
	<div id="div_optionRecmd_2_focus" style="position:absolute;visibility:hidden;left:960px;top:390px;text-align:center;">
		<img id="optionRecmd_2_focus" src="/static/v1/hd/images/freeZone/kuang_big.png" width="220" height="220">
	</div>

<!-- 分页 -->
<div style="position:absolute; left:765px; top:600px;">
	<?php echo ($pageHtml); ?>
</div>


<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>