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

#div_popup{
	position:absolute;
	visibility:hidden;
	width:560px;
	height:357px;
	top:180px;
	left:360px;
	background-image: url(/static/v1/hd/images/common/popup/info_bg.png);
}

</style>
</head>
<body>


<style>

	body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
/* 用户信息背景底框 */
#bottom{
	position: absolute;
	display: block;
	width: 1110px;
	height: 435px;
	top: 180px;
	left: 85px;
	background-image: url(/static/v1/hd/images/usercenter/bottom.png);
}
/* 文字介绍 */
#word{
	position: absolute;
	display: block;
	width: 439px;
	height: 24px;
	top: 75px;
	left: 80px;
	background-image: url(/static/v1/hd/images/usercenter/glory/word.png);
}

</style>

<script type="text/javascript">
	var nowpage = <?php echo ($page['nowPage']); ?>;
	var totalpage = <?php echo ($page['totalPages']); ?>;
	var buttons = [

	          	{id:'page_prev',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:''},
	        	{id:'page_next',name:'',action:'',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:''},
	 
				];

	window.onload = function() {
		if(nowpage == totalpage)
		{
			Epg.btn.init('page_prev', buttons, true);
		}
		else
		{
			Epg.btn.init('page_next', buttons, true);
		}
		
	};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Glory/index',1);?>" ></a>

<!-- 静态图片 -->
<div id="bottom"></div>
<div id="word"></div>

<?php if(is_array($page['data'])): $i = 0; $__LIST__ = $page['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; $left = 110 + (($i-1)%5)*220; $top = 200 + (ceil($i/5)-1)*200; ?>
		<div style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img src="/static/v1/hd/images/usercenter/glory/gift<?php echo ($data); ?>.jpg" width="190" height="190">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 分页 -->
<div style="position:absolute; left:920px; top:105px;">
	<?php echo ($page['pageHtml']); ?>
</div>






<!-- 弹窗 -->
<div id="div_popup">
</div>
</body>
</html>