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
	width: 1100px;
	height: 332px;
	top: 260px;
	left: 90px;
	background-image: url(/static/v1/hd/images/usercenter/detail/bottom.png);
}

/* 文字 */
#word{
	position: absolute;
	display: block;
	width: 227px;
	height: 38px;
	top:85px;
	left:95px;
	background-image: url(/static/v1/hd/images/usercenter/detail/word.png);
}
/* 分数*/
#score{
	position: absolute;
	display: block;
	width: 790px;
	height: 60px;
	top:170px;
	left:400px;
	background-image: url(/static/v1/hd/images/usercenter/detail/score.png);
}

/* 分页 */
.page_prev{
	position:absolute;
	width:25px;
	height:32px;
	left:1065px;
	top:620px;
}
.text{
	position:absolute;
	width:80px;
	height:30px;
	line-height:30px;
	left:1085px;
	top:620px;
	text-align:center;
}
.page_next{
	position:absolute;
	width:25px;
	height:32px;
	left:1165px;
	top:620px;
}

</style>

<script type="text/javascript">

	var focus = '<?php echo ($focus); ?>';
	var buttons = [
	/* 栏目  */
	{id:'page_prev',name:'',action:'pageUp()',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:'',up:['wrong_3','wrong_2','wrong_1'],left:'ch_2'},
	{id:'page_next',name:'',action:'pageDown()',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:'',up:['wrong_3','wrong_2','wrong_1']},

	];
	
 	function handleFocus(focus)//焦点判断
	{
		if(focus == 'page_next' || focus == 'page_prev')
		{
			focus = ( ( focus=='page_prev'&& G(focus) ) ? focus : 'page_next' ); 
			focus = ( ( focus=='page_next'&& G(focus) ) ? focus : 'page_prev' ); 
		}
		return focus;
	} 
 	
	window.onload = function() {
		focus = handleFocus(focus);
		Epg.btn.init(focus, buttons, true);
		
		//设置翻页键翻页事件
		Epg.key.set(
		{
			KEY_PAGE_UP:'pageUp()',
			KEY_PAGE_DOWN:'pageDown()',
		});
	};
	
	var url = "<?php echo U('Learning/detail');?>";
	//上一页
	function pageUp()
	{
		url += '?focus='+ Epg.btn.current.id +'&page=';
		Epg.page(url,<?php echo ($page); ?>-1,<?php echo ($pageCount); ?>);
	}

	//下一页
	function pageDown()
	{
		url += '?focus='+ Epg.btn.current.id +'&page=';
		Epg.page(url,<?php echo ($page); ?>+1,<?php echo ($pageCount); ?>);
	}
</script>


<!-- 静态图片 -->
<div id="bottom"></div>
<div id="word"></div>
<div id="score"></div>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('learning/learningPreschool',1);?>" ></a>


<!-- 课程名字 -->
<div style="position:absolute;left:330px;top:83px;width:250px;height:37px;line-height:37px;text-align:left;border-style:none">
	<span><?php echo ($courseName); ?></span>
</div>
<!-- 总分 -->
<div style="position:absolute;left:540px;top:185px;width:100px;height:30px;line-height:30px;text-align:left;border-style:none;">
	<span style="color:#ffff64"><?php echo ($roleScore); ?></span>
</div>
<?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($i%2==0) { $left = 650; $top= 270 + ($i/2-1)*55; } else { $left = 100; $top= 270 + (($i+1)/2-1)*55; } ?>
	<div style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;width:180px;height:37px;line-height:37px;text-align:right;border-style:none">
		<span><?php echo ($data['name']); ?></span>
	</div>
	<div style="position:absolute; left:<?php echo ($left+210); ?>px; top:<?php echo ($top+15); ?>px;">
		<img src="/static/v1/hd/images/usercenter/detail/progressBottom.png" width="300" height="15">
	</div>
	<div style="position:absolute; left:<?php echo ($left+210); ?>px; top:<?php echo ($top+15); ?>px;">
		<img src="/static/v1/hd/images/usercenter/detail/progress.png" width="<?php echo ($data['length']); ?>" height="15">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 分页 -->
<!-- <div style="position:absolute; left:1030px; top:620px;">
	<?php echo ($pageHtml); ?>
</div> -->
<?php echo ($pageHtml); ?>


<!-- 1.无背景图的文字提示 -->
<div id="popup_1"></div>

<!-- 2.有背景图的文字提示 -->
<div id="popup_2">
	<div id="popup_2_info_bg"></div>
	<div id="popup_2_info"></div>
</div>

</body>
</html>