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

/* 分页 */
.page_prev{
	position:absolute;
	width:25px;
	height:32px;
	left:745px;
	top:600px;
}
.text{
	position:absolute;
	width:80px;
	height:30px;
	line-height:30px;
	left:765px;
	top:600px;
	text-align:center;
}
.page_next{
	position:absolute;
	width:25px;
	height:32px;
	left:845px;
	top:600px;
}

</style>

<script type="text/javascript">
	var img1 = '<?php echo ($img_recommend1); ?>';
	var img2 = '<?php echo ($img_recommend2); ?>';
	var count = <?php echo ($count); ?>;//免费课程按钮数目
	var buttons = new Array(count+4);//4为最新推荐按钮数（2）+分页按钮数（2）
	var colnum = 2;
	
	function initbuttons()
	{
		/*  给免费课程按钮加事件处理*/
		for(var i=1; i<=count; i++)
		{
			obj = new Object();
			
			obj.id = 'option_' + i;
			obj.selectBox = "/static/v1/hd/images/freeZone/kuang_small.png";
			obj.resize = -1;
			obj.right = (i<count) ? 'option_'+(i+1) : '' ; 
			obj.left = (i>1) ? 'option_'+(i-1) : '' ; 
			obj.down = (i+colnum<=count) ? 'option_'+(i+colnum) : '';
			obj.up = (i-colnum>0) ? 'option_'+(i-colnum) : '' ; 
			obj.focusHandler='focusHandler()';
			obj.blurHandler='blurHandler()';
			
			if(i%colnum==0&&i<=8) obj.right = 'optionRecmd_1';
			if(i%colnum==0&&i>8) obj.right = 'optionRecmd_2';
			if(i==count&&i<=8) obj.right = 'optionRecmd_1';
			if(i==count&&i>8) obj.right = 'optionRecmd_2';
			
			buttons[i-1] = obj;
		}
		/* 最后两项按down时，焦点移到分页选项上 */
		if(count>=1) 
		{
			buttons[count-1]['down'] = 'page_next';	
		}
		if(count>=2)
		{
			buttons[count-2]['down'] = 'page_next';
		}
		/* 最右边推荐按钮 */
		buttons[buttons.length-4] = {id:'optionRecmd_1',linkImage:img1,selectBox:'/static/v1/hd/images/freeZone/kuang_big.png',resize:'-1',left:['option_4','option_2','option_1'],down:'optionRecmd_2'};		
		buttons[buttons.length-3] = {id:'optionRecmd_2',linkImage:img2,selectBox:'/static/v1/hd/images/freeZone/kuang_big.png',resize:'-1',left:['option_12','option_10','option_8','option_4','option_2','option_1'],up:'optionRecmd_1'};		
		/* 分页按钮 */
		buttons[buttons.length-2] = {id:'page_prev',name:'',action:'pageUp()',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:'',up:buttons[buttons.length-4-1]['id']};
		buttons[buttons.length-1] = {id:'page_next',name:'',action:'pageDown()',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:'',up:buttons[buttons.length-4-1]['id']};
	}
	
	window.onload = function() {
		initbuttons();
		if(buttons.length==4)
		{
			Epg.btn.init('optionRecmd_1', buttons, true);
		}
		else
		{
			Epg.btn.init('option_1', buttons, true);
		}
		//设置翻页键翻页事件
		Epg.key.set(
		{
			KEY_PAGE_UP:'pageUp()',
			KEY_PAGE_DOWN:'pageDown()',
		});
	};
	
	
	var url = "<?php echo U('FreeZone/index').'?page=';?>";
	//上一页
	function pageUp()
	{
		Epg.page(url,<?php echo ($page); ?>-1,<?php echo ($pageCount); ?>);
	}

	//下一页
	function pageDown()
	{
		Epg.page(url,<?php echo ($page); ?>+1,<?php echo ($pageCount); ?>);
	}
	
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',0);?>" ></a>

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
	<!-- 免费专区文字 -->
	<div id="option_<?php echo ($i); ?>_text" style="position:absolute;width:350px;height:37px;left:<?php echo ($left+10); ?>px;top:<?php echo ($top+10); ?>px;line-height:37px;text-align:left;border-style:none">
		<?php echo ($data['name']); ?>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
	<!-- 最新推荐 -->
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
<?php echo ($pageHtml); ?>

<script type="text/javascript">


//失去时焦点处理（目前主要用于栏目按钮）
function blurHandler(){
	//Epg.marquee.stop();
}

//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	var id = Epg.btn.current.id + '_text';
	//Epg.marquee.start(16,id);
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