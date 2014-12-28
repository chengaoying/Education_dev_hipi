<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">
.page td	{ height:26px; text-align:center;color:#000;font-weight: 600; font-size:22px;}
.page .up	{ width:64px;}
.page .down	{ width:64px;}
.page .now	{ width:150px;}
body {background-color: transparent;}
</style>
</head>
<body>

<style type="text/css">
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
    
    /* 左上角栏目logo */
    .ch_logo{
        position: absolute;
        display: block;
        top:60px;
        left:85px;
        width: 185px;
        height: 42px;
        background: url(/static/v1/hd/images/sectionList/title_preschool.png) no-repeat;
    }
    
    /* 龄段 */
    .class{
        position: absolute;
        display: block;
        top:70px;
        left:290px;
        width: 54px;
        height: 29px;
        background: url(/static/v1/hd/images/courseList/title/preschool/middle_title.png) no-repeat;
    }
    
    /*一周背景*/
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
	 	
        /*视频列表*/
	 	{id:'video_1_1',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',selectBox:'',left:'',right:'video_2_1',up:'btn_order',down:'video_1_2'},
        {id:'video_1_2',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',selectBox:'',left:'',right:'video_2_2',up:'video_1_1',down:'video_1_3'},
        {id:'video_1_3',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',selectBox:'',left:'',right:'video_2_3',up:'video_1_2',down:'video_1_4'},
        {id:'video_1_4',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',selectBox:'',left:'',right:'video_2_4',up:'video_1_3',down:'video_1_5'},
        {id:'video_1_5',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_1.png',selectBox:'',left:'',right:'video_2_5',up:'video_1_4',down:''},
        {id:'video_2_1',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',selectBox:'',left:'video_1_1',right:'video_3_1',up:'btn_order',down:'video_2_2'},
        {id:'video_2_2',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',selectBox:'',left:'video_1_2',right:'video_3_2',up:'video_2_1',down:'video_2_3'},
        {id:'video_2_3',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',selectBox:'',left:'video_1_3',right:'video_3_3',up:'video_2_2',down:'video_2_4'},
        {id:'video_2_4',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',selectBox:'',left:'video_1_4',right:'video_3_4',up:'video_2_3',down:'video_2_5'},
        {id:'video_2_5',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_2.png',selectBox:'',left:'video_1_5',right:'video_3_5',up:'video_2_4',down:''},
        {id:'video_3_1',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',selectBox:'',left:'video_2_1',right:'video_4_1',up:'btn_order',down:'video_3_2'},
        {id:'video_3_2',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',selectBox:'',left:'video_2_2',right:'video_4_2',up:'video_3_1',down:'video_3_3'},
        {id:'video_3_3',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',selectBox:'',left:'video_2_3',right:'video_4_3',up:'video_3_2',down:'video_3_4'},
        {id:'video_3_4',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',selectBox:'',left:'video_2_4',right:'video_4_4',up:'video_3_3',down:'video_3_5'},
        {id:'video_3_5',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_3.png',selectBox:'',left:'video_2_5',right:'video_4_5',up:'video_3_4',down:''},
        {id:'video_4_1',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',selectBox:'',left:'video_3_1',right:'video_5_1',up:'btn_order',down:'video_4_2'},
        {id:'video_4_2',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',selectBox:'',left:'video_3_2',right:'video_5_2',up:'video_4_1',down:'video_4_3'},
        {id:'video_4_3',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',selectBox:'',left:'video_3_3',right:'video_5_3',up:'video_4_2',down:'video_4_4'},
        {id:'video_4_4',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',selectBox:'',left:'video_3_4',right:'video_5_4',up:'video_4_3',down:'video_4_5'},
        {id:'video_4_5',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_4.png',selectBox:'',left:'video_3_5',right:'video_5_5',up:'video_4_4',down:''},
        {id:'video_5_1',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',selectBox:'',left:'video_4_1',right:'video_6_1',up:'btn_order',down:'video_5_2'},
        {id:'video_5_2',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',selectBox:'',left:'video_4_2',right:'video_6_2',up:'video_5_1',down:'video_5_3'},
        {id:'video_5_3',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',selectBox:'',left:'video_4_3',right:'video_6_3',up:'video_5_2',down:'video_5_4'},
        {id:'video_5_4',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',selectBox:'',left:'video_4_4',right:'video_6_4',up:'video_5_3',down:'video_5_5'},
        {id:'video_5_5',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_5.png',selectBox:'',left:'video_4_5',right:'video_6_4',up:'video_5_4',down:''},
        {id:'video_6_1',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_6.png',selectBox:'',left:'video_5_1',right:'video_7_1',up:'btn_order',down:'video_6_2'},
        {id:'video_6_2',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_6.png',selectBox:'',left:'video_5_2',right:'video_7_2',up:'video_6_1',down:'video_6_3'},
        {id:'video_6_3',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_6.png',selectBox:'',left:'video_5_3',right:'video_7_3',up:'video_6_2',down:'video_6_4'},
        {id:'video_6_4',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_6.png',selectBox:'',left:'video_5_4',right:'video_7_4',up:'video_6_3',down:''},
        {id:'video_7_1',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_7.png',selectBox:'',left:'video_6_1',right:'',up:'btn_order',down:'video_7_2'},
        {id:'video_7_2',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_7.png',selectBox:'',left:'video_6_2',right:'',up:'video_7_1',down:'video_7_3'},
        {id:'video_7_3',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_7.png',selectBox:'',left:'video_6_3',right:'',up:'video_7_2',down:'video_7_4'},
        {id:'video_7_4',name:'',action:'',linkImage:'',focusImage:'/static/v1/hd/images/sectionList/preschool/week/select_box_7.png',selectBox:'',left:'video_6_4',right:'',up:'video_7_3',down:''},
        
        /* 前三周 */
	 	{id:'week_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_2_1',up:'',down:'video_1_2'},
	 	{id:'week_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_2_1',up:'',down:'video_1_2'},
	 	{id:'week_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_2_1',up:'',down:'video_1_2'},
	 	 
	 	/* 订购按钮 */	
	 	{id:'btn_order',name:'订购',action:'',linkImage:'/static/v1/hd/images/common/order/btn_order.png',focusImage:'/static/v1/hd/images/common/order/btn_order_over.png',selectBox:'',left:'video_1_1',right:'video_1',up:'',down:'video_3_1'},
	];

/* 初始化按钮 属性   */
var initButtons = function(){
	//栏目
	for(var i=0; i<33; i++)
	{
		buttons[i].linkImage = '/static/v1/hd/images/common/transparent.png';
		//buttons[i].focusImage = '/static/v1/hd/images/sectionList/preschool/week/select_box_1.png';
	}
	
}

window.onload=function()
{
	initButtons();
	Epg.btn.init('btn_order',buttons,true);	
};
</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 左上角的栏目LOGO -->
<div class="ch_logo"></div>

<!-- 龄段 -->
<div class="class"></div>

<!-- 订购 -->
<div id="div_btn_order" style="position:absolute;width:100px;height:40px;top:65px;left:370px;">
	<img id="btn_order" src="/static/v1/hd/images/common/order/btn_order.png">
</div>

<!-- 一周背景  -->
<div class="weekbg"></div>

<!-- 一周视频列表 -->
<?php if(is_array($videoList)): $i = 0; $__LIST__ = $videoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$week): $mod = ($i % 2 );++$i; if(is_array($week)): $j = 0; $__LIST__ = $week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): $mod = ($j % 2 );++$j; $left = 85+($i-1)*160; $top = 261+($j-1)*70; if(($i == 6 && $j == 4) || ($i==7 && $j == 4)){ $height = 139; }else{ $height = 68; } ?>
        <div id="div_video_<?php echo ($i); ?>_<?php echo ($j); ?>" style="position:absolute;width:150px;height:<?php echo ($height); ?>px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;line-height: <?php echo ($height); ?>px;text-align:center;">
             <img id="video_<?php echo ($i); ?>_<?php echo ($j); ?>" title="<?php echo U('Resource/play?id='.$video['id']);?>" src="/static/v1/hd/images/common/transparent.png" width="150" height="<?php echo ($height); ?>">
        </div>
        <div id="div_video_<?php echo ($i); ?>_<?php echo ($j); ?>" style="position:absolute;width:150px;height:<?php echo ($height); ?>px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;line-height: <?php echo ($height); ?>px;text-align:center;color:#666;">
            <?php if(($i == 6 and $j == 4) or ($i == 7 and $j == 4)): ?><img src="<?php echo ($video['imgUrl']); ?>" width="150" height="<?php echo ($height); ?>">
            <?php else: ?>
            <span><?php echo ($video['name']); ?></span><?php endif; ?>
        </div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

<!-- 一周投影  -->
<div class="week_shadow"></div>

</body>
</html>