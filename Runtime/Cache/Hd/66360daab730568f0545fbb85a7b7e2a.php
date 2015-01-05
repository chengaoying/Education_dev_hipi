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
    
/* 底部投影背景图 */
.shadow{
	position:absolute;
    display: block;
    width:210px;
    height:55px;
	top:615px;
    background-image:url(/static/v1/hd/images/common/shadow/shadow_210x60.png);
}
    
</style>

<script type="text/javascript">

//栏目object(json格式数据)
var channel = <?php echo ($json_channel); ?>;
var json_class = <?php echo ($json_class); ?>;

var buttons=
	[
	 	/* 栏目  */
		{id:'ch_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',onFocus:'1',right:'ch_2',down:'class_1'},
		{id:'ch_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',onFocus:'1',left:'ch_1',right:'ch_3',down:'class_1'},
		{id:'ch_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',onFocus:'1',left:'ch_2',right:'search',down:'class_2'},

		/* 检索按钮 */
		//{id:'search',name:'',action:'',linkImage:'/static/v1/hd/images/Index/allCourse/btn_search.png',focusImage:'/static/v1/hd/images/index/allCourse/btn_search_over.png',selectBox:'',left:'ch_3',down:'class_4'},
		
		/* 顶级分类（二级栏目） */
		{id:'class_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'',right:'class_2',up:'ch_1',down:'class_6'},
		{id:'class_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'class_1',right:'class_3',up:'ch_3',down:'class_7'},
		{id:'class_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'class_2',right:'class_4',up:'ch_3',down:'class_8'},
		{id:'class_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'class_3',right:'class_5',up:['search','ch_3'],down:'class_9'},
		{id:'class_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'class_4',right:'',up:['search','ch_3'],down:'class_10'},
		{id:'class_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'',right:'class_7',up:'class_1',down:''},
		{id:'class_7',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'class_6',right:'class_8',up:'class_2',down:''},
		{id:'class_8',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'class_7',right:'class_9',up:'class_3',down:''},
		{id:'class_9',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'class_8',right:'class_10',up:'class_4',down:''},
		{id:'class_10',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/selectBox/select_box_220x220.png',left:'class_9',right:'',up:'class_5',down:''},
	];

/* 初始化按钮 属性   */
var initButtons = function(){
	//栏目
	for(var i=0; i<channel.length; i++)
	{
		buttons[i].name = channel[i].name;
		buttons[i].linkImage = channel[i].linkImage;
		buttons[i].focusImage = channel[i].focusImage;
	}
	
	//顶级分类（二级栏目）
	for(var j=0; j<json_class.length; j++)
	{
		buttons[j+3].name = json_class[j].name;
		//buttons[j+3].linkImage = json_class[j].imgUrl;
	}
	
}


window.onload=function()
{
	initButtons();
	Epg.btn.init('ch_2',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',0);?>" ></a>

<!-- 顶部-栏目 -->
<?php if(is_array($topChannel)): $i = 0; $__LIST__ = $topChannel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i; $left = 100 + ($i-1)*150; $top = 95; ?>
	<div id="div_ch_<?php echo ($i); ?>" style="position:absolute;visibility: visible;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>' title="<?php echo ($ch['linkUrl']); ?>" src="<?php echo ($ch['linkImage']); ?>" width="110" height="33">
	</div>
	<div id="div_ch_<?php echo ($i); ?>_focus" style="position:absolute;visibility: hidden;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id='ch_<?php echo ($i); ?>_focus' src="<?php echo ($ch['focusImage']); ?>" width="110" height="33">
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 检索按钮 -->
<!-- <div id="div_search" style="position:absolute;width:130px;height:40px;left:1060px;top:60px;text-align:center;">
    <img id="search" title="" src="/static/v1/hd/images/Index/allCourse/btn_search.png" width="130" height="40">
</div> -->

<!-- 顶级分类（二级栏目） -->
<?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i; if($i > 5){ $top = 405; $left = 80 + ($i-6)*225; }else{ $top = 180; $left = 80 + ($i-1)*225; } ?>
    <div id="div_class_<?php echo ($i); ?>" style="position:absolute;width:220px;height:220px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="class_<?php echo ($i); ?>" title="<?php echo ($c['linkUrl']); ?>" src="<?php echo ($c['imgUrl']); ?>" width="210" height="210">
    </div>
    <div id="div_class_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:230px;left:<?php echo ($left-5); ?>px;top:<?php echo ($top-5); ?>px;text-align:center;">
        <img id="class_<?php echo ($i); ?>_focus" src="" width="220" height="220">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 静态图片-底部投影效果 -->
<?php $__FOR_START_777__=1;$__FOR_END_777__=6;for($i=$__FOR_START_777__;$i < $__FOR_END_777__;$i+=1){ $left = 85 + ($i-1)*225; ?>
	<div class="shadow" style="left:<?php echo ($left); ?>px;"></div><?php } ?>



<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>