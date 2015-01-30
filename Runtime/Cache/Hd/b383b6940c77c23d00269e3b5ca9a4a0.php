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

/* 文字 */
#word{
	position: absolute;
	display: block;
	width: 790px;
	height: 70px;
	top:130px;
	left:390px;
	background-image: url(/static/v1/hd/images/usercenter/learningPreschool/word.png);
}
/* girl */
#girl{
	position: absolute;
	display: block;
	width: 182px;
	height: 112px;
	top:95px;
	left:960px;
	background-image: url(/static/v1/hd/images/usercenter/learningPreschool/girl_comeon.png);
}

/* 分页 */
.page_prev{
	position:absolute;
	width:25px;
	height:32px;
	left:1065px;
	top:600px;
}
.text{
	position:absolute;
	width:80px;
	height:30px;
	line-height:30px;
	left:1085px;
	top:600px;
	text-align:center;
}
.page_next{
	position:absolute;
	width:25px;
	height:32px;
	left:1165px;
	top:600px;
}

</style>

<script type="text/javascript">
	var faceNum = <?php echo ($face); ?>;
	var channel = <?php echo ($json_channel); ?>;
	var focus = '<?php echo ($focus); ?>';
	var buttons = [
	/* 栏目  */
	{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',focusHandler:'focusHandler()',up:'changeNum',down:'ch_2',right:'detail_1'}, 
	{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',focusHandler:'focusHandler()',up:'ch_1',down:'ch_3',right:'detail_1'}, 
	{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',resize:'-1',selectBox:'',blurHandler:'blurHandler()',up:'ch_2',right:'detail_1'},

	{id:'selectFace',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',focusImage:'/static/v1/hd/images/usercenter/baseInfo/face_'+faceNum+'.png',selectBox:'/static/v1/hd/images/usercenter/leftNavigation/title_kuang.png',right:'nickname',up:'ch_3',down:'changeNum'},
	{id:'changeNum',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account.png',focusImage:'/static/v1/hd/images/usercenter/leftNavigation/change_account_over.png',selectBox:'',right:'sex',up:'selectFace',down:'ch_1'},

	{id:'detail_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learningPreschool/detail.png',focusImage:'/static/v1/hd/images/usercenter/learningPreschool/detail_over.png',selectBox:'',down:'wrong_1',up:'',left:'ch_3'},
	{id:'detail_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learningPreschool/detail.png',focusImage:'/static/v1/hd/images/usercenter/learningPreschool/detail_over.png',selectBox:'',down:'wrong_2',up:'wrong_1',left:'ch_3'},
	{id:'detail_3',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learningPreschool/detail.png',focusImage:'/static/v1/hd/images/usercenter/learningPreschool/detail_over.png',selectBox:'',down:'wrong_3',up:'wrong_2',left:'ch_3'},
	{id:'wrong_1',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learningPreschool/wrong.png',focusImage:'/static/v1/hd/images/usercenter/learningPreschool/wrong_over.png',selectBox:'',down:['detail_2',G('page_next') ? 'page_next' : 'page_prev'],up:'detail_1',left:'ch_3'},
	{id:'wrong_2',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learningPreschool/wrong.png',focusImage:'/static/v1/hd/images/usercenter/learningPreschool/wrong_over.png',selectBox:'',down:['detail_3',G('page_next') ? 'page_next' : 'page_prev'],up:'detail_2',left:'ch_3'},
	{id:'wrong_3',name:'',action:'',linkImage:'/static/v1/hd/images/usercenter/learningPreschool/wrong.png',focusImage:'/static/v1/hd/images/usercenter/learningPreschool/wrong_over.png',selectBox:'',down:'page_next',up:'detail_3',left:'ch_3'},

	{id:'page_prev',name:'',action:'pageUp()',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',right:'page_next',down:'',up:['wrong_3','wrong_2','wrong_1'],left:'ch_2'},
	{id:'page_next',name:'',action:'pageDown()',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:'page_prev',down:'',up:['wrong_3','wrong_2','wrong_1']},

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
 		if(focus !== 'ch_3') G('ch_3').src = buttons[2].titleImage;
	}
	
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
		initButtons();
		popup();
		focus = handleFocus(focus);
		Epg.btn.init(focus, buttons, true);
		
		//设置翻页键翻页事件
		Epg.key.set(
		{
			KEY_PAGE_UP:'pageUp()',
			KEY_PAGE_DOWN:'pageDown()',
		});
	};
	
	var url = "<?php echo U('Learning/learningPreschool');?>";
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
<!-- <div id="bottom"></div> -->
<div id="word"></div>
<div id="girl"></div>

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

<!-- 总分 -->
<div style="position:absolute;left:490px;top:150px;width:100px;height:30px;line-height:30px;text-align:left;border-style:none;">
	<span style="color:#ffff64"><?php echo ($roleScore); ?></span>
</div>
<!-- rank -->
<div style="position:absolute;left:755px;top:150px;width:100px;height:30px;line-height:30px;text-align:left;border-style:none;">
	<span style="color:#ffff64"><?php echo ($rank); ?>%</span>
</div>

<?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; $left = 390; $top = 230 + ($i-1)*115; ?>
	<div style="position:absolute; left:<?php echo ($left); ?>px; top:<?php echo ($top); ?>px;">
		<img src="/static/v1/hd/images/usercenter/learningPreschool/bottom.png" width="790" height="100">
	</div>
	<!-- title -->
	<div style="position:absolute;left:<?php echo ($left+20); ?>px;top:<?php echo ($top+25); ?>px;width:220px;height:37px;line-height:37px;text-align:center;border-style:none">
		<span><?php echo ($data['name']); ?></span>
	</div>
	<!-- 总分 -->
	<div style="position:absolute;left:<?php echo ($left+340); ?>px;top:<?php echo ($top); ?>px;width:100px;height:37px;line-height:37px;text-align:left;border-style:none;">
		<span style="color:black"><?php echo ($data['sumScore']); ?></span>
	</div>
	<!-- progress bar -->
	<div style="position:absolute; left:<?php echo ($left+440); ?>px; top:<?php echo ($top+60); ?>px;">
		<img src="/static/v1/hd/images/usercenter/learningPreschool/progress.png" width="<?php echo ($data['length']); ?>" height="10">
	</div>
	<!-- detail -->
	<div id="div_detail_<?php echo ($i); ?>" style="position:absolute; left:<?php echo ($left+700); ?>px; top:<?php echo ($top+10); ?>px;">
		<img id="detail_<?php echo ($i); ?>" title="<?php echo U('Learning/detail?courseId='.$data['id'].'&courseName='.$data['name'].'&preFocus=detail_'.$i);?>" 
		src="/static/v1/hd/images/usercenter/learningPreschool/detail.png" width="75" height="32">
	</div>
	<!-- 错题集 -->
	<div id="div_wrong_<?php echo ($i); ?>" style="position:absolute; left:<?php echo ($left+700); ?>px; top:<?php echo ($top+50); ?>px;">
		<img id="wrong_<?php echo ($i); ?>" title="<?php echo U('Library/wrongAnthology?courseId='.$data['id'].'&preFocus=wrong_'.$i);?>" 
		src="/static/v1/hd/images/usercenter/learningPreschool/wrong.png" width="75" height="32">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 分页 -->
<!-- <div style="position:absolute; left:1050px; top:600px;">
	<?php echo ($pageHtml); ?>
</div> -->
<?php echo ($pageHtml); ?>


<script type="text/javascript">

//失去时焦点处理（目前主要用于栏目按钮）
function blurHandler(){
	if(Epg.btn.current.id != "ch_2" && Epg.btn.current.id != "ch_1"){
		G(Epg.btn.previous.id).src = Epg.btn.previous.titleImage;
	}
}

//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	if(Epg.btn.current.id != "ch_3"){
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