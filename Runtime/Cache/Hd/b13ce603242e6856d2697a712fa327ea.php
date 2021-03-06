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
/* 用户信息背景底框 */
#bottom{
	position: absolute;
	display: block;
	width: 790px;
	height: 433px;
	top: 160px;
	left: 390px;
	background-image: url(/static/v1/hd/images/usercenter/learningEarly/bottom.png);
}

</style>

<script type="text/javascript">
	var faceNum = <?php echo ($face); ?>;
	var channel = <?php echo ($json_channel); ?>;
	var focus = "<?php echo ($focus); ?>";
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',focusHandler:'focusHandler()',up:'changeNum',down:'ch_2',right:'option_1'}, 
	{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',focusHandler:'focusHandler()',up:'ch_1',down:'ch_3',right:'option_1'}, 
	{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',blurHandler:'blurHandler()',up:'ch_2',right:'option_1'},

	{id:'selectFace',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',selectBox:'/static/v1/hd/images/usercenter/leftNavigation/title_kuang.png',right:'nickname',up:'ch_3',down:'changeNum'},
	{id:'changeNum',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account.png',focusImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account_over.png',selectBox:'',right:'sex',up:'selectFace',down:'ch_1'},

	{id:'option_1',name:'',focusHandler:'focusHandler()',action:'',linkImage:'/static/v1/hd/images/usercenter/learningEarly/month.png',focusImage:'/static/v1/hd/images/usercenter/learningEarly/month_over.png',selectBox:'',left:'ch_3',down:'option_2'},
	{id:'option_2',name:'',focusHandler:'focusHandler()',action:'',linkImage:'/static/v1/hd/images/usercenter/learningEarly/all.png',focusImage:'/static/v1/hd/images/usercenter/learningEarly/all_over.png',selectBox:'',left:'ch_3',up:'option_1'},

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
		
		G('ch_3').src = buttons[2].titleImage;
		Epg.btn.init(focus, buttons, true);
	};
</script>


<!-- 静态图片 -->
<div id="bottom"></div>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',0);?>" ></a>


<!-- 以下是导航栏 -->
<?php if(is_array($channels)): $i = 0; $__LIST__ = $channels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i; $left = 0; $top = 340 + ($i-1)*70; ?>
    <div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility:visible;left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($channel['linkUrl']); ?>"
			src="<?php echo ($channel['linkImage']); ?>" width="290" height="70">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- progress -->
<?php $__FOR_START_4726__=1;$__FOR_END_4726__=10;for($i=$__FOR_START_4726__;$i < $__FOR_END_4726__;$i+=1){ $left = 600 + ($i-1)*65; $top = 253; ?>
	
<!-- 	<div  style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img  src="/static/v1/hd/images/usercenter/learnEvaluation1/color_<?php echo ($i); ?>.png" width="45" height="300">
	</div> -->
	<div  style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img  src="/static/v1/hd/images/usercenter/learningEarly/progress.png" width="45" height="<?php echo ($curProgress[$i-1]); ?>">
	</div><?php } ?>

<!-- 选择按钮"本月 总体" -->
<div id="div_option_1" style="position:absolute; left:400px; top: 250px;">
	<img id='option_1' title="/Hd/Learning/learningEarly?arrange=month&focus=option_1"
		src="/static/v1/hd/images/usercenter/learningEarly/month.png" width="140" height="40">
</div>
<!-- 文字 -->
<div id="div_option_1" style="position:absolute; left:407px;top:250px;width:100px;height:35px;line-height:35px;text-align:center;">
	<span style=""><?php echo ($monthAge); ?></span>
</div>
<div id="div_option_2" style="position: absolute; left:400px; top:300px;">
	<img id='option_2' title="/Hd/Learning/learningEarly?arrange=all&focus=option_2"
		src="/static/v1/hd/images/usercenter/learningEarly/all.png" width="140" height="40">
</div>

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

<script type="text/javascript">

//失去时焦点处理（目前主要用于栏目按钮）
function blurHandler(){
	if(Epg.btn.current.id != "ch_2" && Epg.btn.current.id != "ch_1"){
		G(Epg.btn.previous.id).src = Epg.btn.previous.titleImage;
	}
}

//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	if(Epg.btn.current.id != "ch_3" && Epg.btn.current.id !=focus){
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