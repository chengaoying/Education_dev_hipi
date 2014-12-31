<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">

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
/* 界面 */
#gloryinfo{
	position: absolute;
	display: block;
	width: 1110px;
	height: 435px;
	top: 180px;
	left: 85px;
	background-image: url(/static/v1/hd/images/usercenter/glory/ui.png);
}

</style>

<script type="text/javascript">
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/glory_1.png',focusImage:'/static/v1/hd/images/usercenter/glory_2.png',selectBox:'',right:'ch_2',down:''}, 
	{id:'ch_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learning_1.png',focusImage:'/static/v1/hd/images/usercenter/learning_2.png',selectBox:'',left:'ch_1',right:'ch_3',down:''}, 
	{id:'ch_3',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseinfo_1.png',focusImage:'/static/v1/hd/images/usercenter/baseinfo_2.png',selectBox:'',left:'ch_2',down:'nickname'},

	
	];

	window.onload = function() {
		Epg.btn.init('ch_1', buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="bottom"></div>
<div id="gloryinfo"></div>



<!-- 以下是导航栏 -->
<!-- 荣誉成就 -->
<div id="div_ch_1" style="position: absolute; left: 100px; top: 75px;">
	<img id='ch_1' title="/Hd/Glory/index"
		src="/static/v1/hd/images/usercenter/glory_1.png" width="92" height="26">
</div>
<!-- 学习评估 -->
<div id="div_ch_2" style="position: absolute; left: 250px; top: 75px;">
	<img id='ch_2' title="/Hd/Learning/<?php echo ($stageType); ?>"
		src="/static/v1/hd/images/usercenter/learning_1.png" width="92" height="26">
</div>
<!-- 基本信息 -->
<div id="div_ch_3" style="position: absolute; left: 400px; top: 75px;">
	<img id='ch_3' title="/Hd/Role/userInfo"
		src="/static/v1/hd/images/usercenter/baseinfo_1.png" width="92" height="26">
</div>

<!-- 进度条 -->
<!-- 底部进度条 -->
<div  style="position: absolute; left: 110px; top: 330px;">
	<img  src="/static/v1/hd/images/glory/usercenter/progress_1.png" width="361" height="10">
</div>
<!-- 当前进度 -->
<div  style="position: absolute; left: 110px; top: 330px;">
	<img  src="/static/v1/hd/images/glory/usercenter/progress_2.png" width="<?php echo ($curProgress); ?>" height="10">
</div>


<!-- 弹窗 -->
<div id="div_popup">
</div>
</body>
</html>