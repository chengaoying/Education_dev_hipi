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

	body{ background-image:url(/static/v1/hd/images/usercenter/bg.jpg); }
/* 用户积分规则 */
#down{
	position: absolute;
	display: block;
	width: 800px;
	height: 260px;
	top: 340px;
	left: 390px;
	background-image: url(/static/v1/hd/images/usercenter/glory/down.png);
}
/* 用户等级 */
#up{
	position: absolute;
	display: block;
	width: 800px;
	height: 190px;
	top: 130px;
	left: 390px;
	background-image: url(/static/v1/hd/images/usercenter/glory/up.png);
}
/* 底部进度条 */
#progressBottom{
	position: absolute;
	display: block;
	width: 390px;
	height: 14px;
	top: 260px;
	left: 490px;
	background-image: url(/static/v1/hd/images/usercenter/glory/progress_bottom.png);
}


</style>

<script type="text/javascript">
	var faceNum = <?php echo ($face); ?>;
	var channel = <?php echo ($json_channel); ?>;
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'changeNum',down:'ch_2',right:'reward'}, 
	{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'ch_1',down:'ch_3',right:'reward'}, 
	{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',up:'ch_2',right:'reward'},

	{id:'selectFace',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',selectBox:'/static/v1/hd/images/usercenter/leftNavigation/title_kuang.png',right:'nickname',up:'ch_3',down:'changeNum'},
	{id:'changeNum',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account.png',focusImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account_over.png',selectBox:'',right:'sex',up:'selectFace',down:'ch_1'},

	{id:'viewAll',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/glory/view.png',focusImage:'/static/v1/hd/images/usercenter/glory/view_over.png',selectBox:'',left:'reward',up:'ch_1'},
	{id:'reward',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/glory/award.png',focusImage:'/static/v1/hd/images/usercenter/glory/award_over.png',selectBox:'',left:'ch_2',right:'viewAll',up:'ch_1'},
	
	];
	
	var initButtons = function()
	{
 		for(var i=0; i<channel.length; i++)
		{
			buttons[i].name = channel[i].name;
			buttons[i].linkImage = channel[i].linkImage;
			buttons[i].focusImage = channel[i].focusImage;
		} 
	}
	window.onload = function() {
		initButtons();
		Epg.btn.init('ch_1', buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="down"></div>
<div id="up"></div>
<div id="progressBottom"></div>
<!-- <div id="word"></div> -->

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>


<!-- 以下是导航栏 -->
<?php if(is_array($channels)): $i = 0; $__LIST__ = $channels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i; $left = 120; $top = 430 + ($i-1)*60; ?>
    <div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility:visible;left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($channel['linkUrl']); ?>"
			src="<?php echo ($channel['linkImage']); ?>" width="170" height="50">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 选择头像  -->
<div id="div_selectFace" style="position:absolute;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace" title="<?php echo U('Role/selectFace');?>" src="/static/v1/hd/images/usercenter/baseInfo/face_<?php echo ($face); ?>.png" width="130" height="170">
</div>
<div id="div_selectFace_focus" style="position:absolute;visibility:hidden;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace_focus" title="" src="" width="125" height="165">
</div>
<!-- 切换账号  -->
<div id="div_changeNum" style="position:absolute;left:95px;top:322px;text-align:center;">
	<img id="changeNum" title="<?php echo U('Role/changeNum');?>" src="/static/v1/hd/images/usercenter/leftNavigation/change_account.png" width="110" height="25">
</div>

<!-- 当前进度 -->
<div  style="position: absolute; left: 490px; top: 260px;">
	<img  src="/static/v1/hd/images/usercenter/glory/progress.png" width="<?php echo ($curProgress); ?>" height="14">
</div> 

<!-- 查看全部按钮 -->
<div id="div_wiewAll" style="position: absolute; left:1070px; top:265px;">
	<img id='viewAll' title="<?php echo U('Glory/view');?>"
		src="/static/v1/hd/images/usercenter/glory/view.png" width="100" height="36">
</div>
<!-- 领取奖励 -->
<div id="div_reward" style="position: absolute; left:430px; top:520px;">
	<img id='reward' title=""
		src="/static/v1/hd/images/usercenter/glory/award.png" width="100" height="36">
</div>
<!-- 奖励图标 -->
<div style="position: absolute; left:940px; top:190px;">
	<img src="/static/v1/hd/images/usercenter/glory/gift_1.png" width="110" height="110">
</div>





<!-- 弹窗 -->
<div id="div_popup"></div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>