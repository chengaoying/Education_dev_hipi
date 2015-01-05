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

<style type="text/css">
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
    
    /* 栏目logo */
    .ch_logo{
        position: absolute;
        display: block;
        top:90px;
        left:85px;
        width: 128px;
        height: 34px;
        background: url(/static/v1/hd/images/sectionList/preschool/week/title_week.png) no-repeat;
    }
    
    /*课程列表背景*/
    .weekbg{
        position: absolute;
        display: block;
        top:180px;
        left:75px;
        width: 1130px;
        height: 440px;
        background: url(/static/v1/hd/images/sectionList/preschool/week/bg.png) no-repeat;
    }
    
    .week_shadow{
        position: absolute;
        display: block;
        top:620px;
        left:75px;
        width: 1130px;
        height: 49px;
        background: url(/static/v1/hd/images/common/shadow_3.png) no-repeat;
    }
</style>

<script type="text/javascript">


var buttons=
	[
	 	
        /*课时列表*/
	 	{id:'section_1_1',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',left:'',right:'section_2_1',up:'btn_order',down:'section_1_2'},
        {id:'section_1_2',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',left:'',right:'section_2_2',up:'section_1_1',down:'section_1_3'},
        {id:'section_1_3',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',left:'',right:'section_2_3',up:'section_1_2',down:'section_1_4'},
        {id:'section_1_4',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',left:'',right:'section_2_4',up:'section_1_3',down:'section_1_5'},
        {id:'section_1_5',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',left:'',right:'section_2_5',up:'section_1_4',down:''},
        {id:'section_2_1',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',left:'section_1_1',right:'section_3_1',up:'btn_order',down:'section_2_2'},
        {id:'section_2_2',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',left:'section_1_2',right:'section_3_2',up:'section_2_1',down:'section_2_3'},
        {id:'section_2_3',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',left:'section_1_3',right:'section_3_3',up:'section_2_2',down:'section_2_4'},
        {id:'section_2_4',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',left:'section_1_4',right:'section_3_4',up:'section_2_3',down:'section_2_5'},
        {id:'section_2_5',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',left:'section_1_5',right:'section_3_5',up:'section_2_4',down:''},
        {id:'section_3_1',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',left:'section_2_1',right:'section_4_1',up:'btn_order',down:'section_3_2'},
        {id:'section_3_2',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',left:'section_2_2',right:'section_4_2',up:'section_3_1',down:'section_3_3'},
        {id:'section_3_3',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',left:'section_2_3',right:'section_4_3',up:'section_3_2',down:'section_3_4'},
        {id:'section_3_4',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',left:'section_2_4',right:'section_4_4',up:'section_3_3',down:'section_3_5'},
        {id:'section_3_5',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',left:'section_2_5',right:'section_4_5',up:'section_3_4',down:''},
        {id:'section_4_1',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',left:'section_3_1',right:'section_5_1',up:'btn_order',down:'section_4_2'},
        {id:'section_4_2',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',left:'section_3_2',right:'section_5_2',up:'section_4_1',down:'section_4_3'},
        {id:'section_4_3',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',left:'section_3_3',right:'section_5_3',up:'section_4_2',down:'section_4_4'},
        {id:'section_4_4',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',left:'section_3_4',right:'section_5_4',up:'section_4_3',down:'section_4_5'},
        {id:'section_4_5',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',left:'section_3_5',right:'section_5_5',up:'section_4_4',down:''},
        {id:'section_5_1',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',left:'section_4_1',right:'section_6_1',up:'btn_order',down:'section_5_2'},
        {id:'section_5_2',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',left:'section_4_2',right:'section_6_1',up:'section_5_1',down:'section_5_3'},
        {id:'section_5_3',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',left:'section_4_3',right:'section_6_2',up:'section_5_2',down:'section_5_4'},
        {id:'section_5_4',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',left:'section_4_4',right:'section_6_2',up:'section_5_3',down:'section_5_5'},
        {id:'section_5_5',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',left:'section_4_5',right:'section_6_3',up:'section_5_4',down:''},
        {id:'section_6_1',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_6.png',left:'section_5_2',right:'section_7_1',up:'btn_order',down:'section_6_2'},
        {id:'section_6_2',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_6.png',left:'section_5_3',right:'section_7_2',up:'section_6_1',down:'section_6_3'},
        {id:'section_6_3',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_6.png',left:'section_5_5',right:'section_7_3',up:'section_6_2',down:'section_6_4'},
        {id:'section_7_1',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_7.png',left:'section_6_1',right:'',up:'btn_order',down:'section_7_2'},
        {id:'section_7_2',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_7.png',left:'section_6_2',right:'',up:'section_7_1',down:'section_7_3'},
        {id:'section_7_3',name:'',action:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_7.png',left:'section_6_3',right:'',up:'section_7_2',down:'section_7_4'},
        
	 	/* 订购按钮 */	
	 	{id:'btn_order',name:'订购',action:'',linkImage:'/static/v1/hd/images/common/order/btn_order.png',focusImage:'/static/v1/hd/images/common/order/btn_order_over.png',left:'',right:'',up:'',down:'section_7_1'},
	];

/* 初始化按钮 属性   */
var initButtons = function(){
	//栏目
	for(var i=0; i<31; i++)
	{
		buttons[i].linkImage = '/static/v1/hd/images/common/transparent.png';
	}
	
}

window.onload=function()
{
	initButtons();
	popup();
	Epg.btn.init('btn_order',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 左上角的栏目LOGO -->
<div class="ch_logo"></div>

<!-- 订购 -->
<div id="div_btn_order" style="position:absolute;width:90px;height:34px;top:90px;left:1100px;">
	<img id="btn_order" title="<?php echo U('Order/index?courseId='.$courseId);?>" src="/static/v1/hd/images/common/order/btn_order.png">
</div>

<!-- 背景  -->
<div class="weekbg"></div>

<!-- 一周课时列表 -->
<?php if(is_array($sections)): $i = 0; $__LIST__ = $sections;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$week): $mod = ($i % 2 );++$i; if(is_array($week)): $j = 0; $__LIST__ = $week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($j % 2 );++$j; $left = 85+($i-1)*160; if(($i == 6) || ($i==7)){ $height = 99; $top = 309+($j-1)*101; }else{ $height = 68; $top = 261+($j-1)*70; } ?>
        <div id="div_section_<?php echo ($i); ?>_<?php echo ($j); ?>" style="position:absolute;width:150px;height:<?php echo ($height); ?>px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;line-height: <?php echo ($height); ?>px;text-align:center;">
             <img id="section_<?php echo ($i); ?>_<?php echo ($j); ?>" title="<?php echo U('Resource/play?id='.$section['id']);?>" src="/static/v1/hd/images/common/transparent.png" width="150" height="<?php echo ($height); ?>">
        </div>
        <div id="div_section_<?php echo ($i); ?>_<?php echo ($j); ?>" style="position:absolute;width:150px;height:<?php echo ($height); ?>px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:left;vertical-align: middle;">
            <span style="color:#666;font-size:16px;"><?php echo ($section['name']); ?></span>
        </div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

<!-- 底部投影  -->
<div class="week_shadow"></div>


<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>