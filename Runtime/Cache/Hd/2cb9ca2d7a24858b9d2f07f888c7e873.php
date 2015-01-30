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
	{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',focusHandler:'focusHandler()',up:'changeNum',down:'ch_2',right:''}, 
	{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',blurHandler:'blurHandler()',up:'ch_1',down:'ch_3',right:''}, 
	{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',focusHandler:'focusHandler()',up:'ch_2',right:''},

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
			buttons[i].titleImage = channel[i].titleImage;
		} 
	}
	window.onload = function() {
		initButtons();
		Epg.btn.init('ch_2', buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="down"></div>
<div id="up"></div>
<div id="progressBottom"></div>
<!-- <div id="word"></div> -->

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',0);?>" ></a>


<!-- 以下是导航栏 -->
<?php if(is_array($channels)): $i = 0; $__LIST__ = $channels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i; $left = 0; $top = 340 + ($i-1)*70; ?>
    <div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility:visible;left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($channel['linkUrl']); ?>"
			src="<?php echo ($channel['linkImage']); ?>" width="290" height="70">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 选择头像  -->
<div id="div_selectFace" style="position:absolute;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace" title="<?php echo U('Role/selectFace');?>" src="/static/v1/hd/images/usercenter/baseInfo/face_<?php echo ($face); ?>.png" width="130" height="170">
</div>
<div id="div_selectFace_focus" style="position:absolute;visibility:hidden;width:130px;height:170px;left:90px;top:80px;text-align:center;">
	<img id="selectFace_focus" title="" src="" width="125" height="165">
</div>
<!-- 切换账号  -->
<div id="div_changeNum" style="position:absolute;left:95px;top:260px;text-align:center;">
	<img id="changeNum" title="<?php echo U('Role/changeNum');?>" src="/static/v1/hd/images/usercenter/leftNavigation/change_account.png" width="120" height="35">
</div>

<!-- 当前进度 -->
<div  style="position:absolute; left:490px; top:260px;">
	<img  src="/static/v1/hd/images/usercenter/glory/progress.png" width="<?php echo ($curProgress); ?>" height="14">
</div> 

<!-- 查看全部按钮 -->
<!-- <div id="div_wiewAll" style="position: absolute; left:1070px; top:265px;">
	<img id='viewAll' title="<?php echo U('Glory/view');?>"
		src="/static/v1/hd/images/usercenter/glory/view.png" width="100" height="36">
</div> -->
<!-- 全部礼物数值 -->
<div id="div_wiewAll" style="position: absolute; left:1097px; top:218px;width:40px;line-height:23px;height:23px;text-align:center;border-style:none;">
	<span><?php echo ($giftNum); ?></span>
</div>
<!-- 领取奖励 -->
<!-- <div id="div_reward" style="position: absolute; left:430px; top:520px;">
	<img id='reward' title=""
		src="/static/v1/hd/images/usercenter/glory/award.png" width="100" height="36">
</div> -->
<!-- 奖励图标 -->
<div style="position: absolute; left:940px; top:190px;">
	<img src="/static/v1/hd/images/usercenter/glory/gift_1.png" width="110" height="110">
</div>

<!-- 积分总数 -->
<div style="position: absolute; left:500px; top:160px;">
	<span style="font-size:37px"><?php echo ($totalCredit); ?></span>
</div>
<!-- 今日获得积分 -->
<div style="position:absolute;left:598px;top:170px;width:160px;line-height:27px;height:27px;text-align:center;border-style:none;color:white"">
	<span>今日获得<?php echo ($todayCredit); ?>枚</span>
</div>

<!-- 当前等级 -->
<div style="position:absolute;left:415px;top:250px;text-align:center;">
		<img title="" src="/static/v1/hd/images/usercenter/glory/class/LV<?php echo ($gloryClass); ?>.png" width="61" height="32">
</div>

<!-- 当前总积分/下等级上限 -->
<div style="position:absolute;left:700px;top:225px;width:160px;line-height:27px;height:27px;text-align:right;border-style:none;color:white"">
	<span><?php echo ($classValue[0]); ?>/<?php echo ($classValue[1]); ?></span>
</div>
<!-- 连续登陆 -->
<div style="position:absolute;left:688px;top:476px;width:40px;line-height:23px;height:23px;text-align:center;border-style:none;color:black"">
	<span><?php echo ($continueNum); ?></span>
</div>

<script type="text/javascript">

//失去时焦点处理（目前主要用于栏目按钮）
function blurHandler(){
	if(Epg.btn.current.id != "ch_1" && Epg.btn.current.id != "ch_3"){
		G(Epg.btn.previous.id).src = Epg.btn.previous.titleImage;
	}
}

//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	if(Epg.btn.current.id != "ch_2"){
		setTimeout("Epg.btn.click()",50);
	}
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