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
        width: 150px;
        height: 42px;
        background-image: url(/static/v1/hd/images/course/early/ch_logo.png);
    }
    
    /* 哪个年龄段 */
    .age{
        position: absolute;
        display: block;
        top:70px;
        left:245px;
        width: 71px;
        height: 29px;
        background: url(/static/v1/hd/images/course/early/age_<?php echo ($age); ?>_title.png) no-repeat;
    }
    
    /* 课程目标 */
    .aim{
        position: absolute;
        display: block;
        top:180px;
        left:60px;
        width: 286px;
        height: 382px;
        background-image: url(/static/v1/hd/images/course/early/month_aim/<?php echo ($month); ?>.png);
    }
    
    /*月份*/
    <?php if($month>=1 and $month<=12){ $monthbg = '/static/v1/hd/images/course/early/month/1_12_month.png'; }else if($month>=13 and $month<=24){ $monthbg = '/static/v1/hd/images/course/early/month/13_24_month.png'; }else{ $monthbg = '/static/v1/hd/images/course/early/month/25_36_month.png'; } if(in_array($month,array(12,24,36))){ $probgwidth = 1110; $proleft = 1085; }else{ $probgwidth = ($month%12)*86; $proleft = ($month%12)*86+62; } ?>
    
    .monthbg{
        position: absolute;
        width:1110px;
        height:50px;
        top:580px;
        left:85px;
        background: url(<?php echo ($monthbg); ?>) no-repeat;
    }
    
    .shadow{
        position: absolute;
        width:1110px;
        height:50px;
        top:630px;
        left:85px;
        background: url(/static/v1/hd/images/course/early/month/shadow.png) no-repeat;
    }
    
    .progress{
        position: absolute;
        width:46px;
        height:30px;
        top:593px;
        left:<?php echo ($proleft); ?>px;
        background: url(/static/v1/hd/images/course/early/month/<?php echo ($month); ?>.png) no-repeat;
    }
    
    .probg{
        position: absolute;
        width:<?php echo ($probgwidth); ?>px;
        height:5px;
        top:625px;
        left:85px;
        background: url(/static/v1/hd/images/course/early/month/pro_bg.png) no-repeat;
    }
</style>
<script type="text/javascript">


var buttons=
	[
        /*左边栏目*/
	 	{id:'aim_ch_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_1',up:'',down:'aim_ch_2'},
        {id:'aim_ch_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_1',up:'aim_ch_1',down:'aim_ch_3'},
        {id:'aim_ch_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_1',up:'aim_ch_2',down:'aim_ch_4'},
        {id:'aim_ch_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_4',up:'aim_ch_3',down:'aim_ch_5'},
        {id:'aim_ch_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_4',up:'aim_ch_4',down:'aim_ch_6'},
        {id:'aim_ch_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'',left:'',right:'video_4',up:'aim_ch_5',down:'aim_ch_7'},
        
        /* 右边视频列表 */
        {id:'video_1',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'aim_ch_1',right:'video_2',up:'',down:'video_4'},
		{id:'video_2',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_1',right:'video_3',up:'',down:['video_5','video_4']},
		{id:'video_3',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_2',right:'video_4',up:'',down:['video_6','video_5','video_4']},
		{id:'video_4',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_3',right:'video_5',up:'video_1',down:''},
		{id:'video_5',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_4',right:'video_6',up:'video_2',down:''},
		{id:'video_6',name:'',action:'',linkImage:'',focusImage:'',selectBox:'/static/v1/hd/images/common/select_box_1.png',left:'video_5',right:'',up:'video_3',down:''},
	];

var chlist = <?php echo ($json_ch); ?>;
/* 初始化按钮 属性   */
var initButtons = function(){
	//栏目
	for(var i=0; i<chlist.length; i++)
	{
		buttons[i].name = chlist[i].name;
		buttons[i].linkImage = chlist[i].linkImage;
		buttons[i].focusImage = chlist[i].focusImage;
	}
	
}

window.onload=function()
{
    initButtons();
	Epg.btn.init('aim_ch_1',buttons,true);	
};
</script>

<!-- 左上角的栏目LOGO -->
<div class="ch_logo"></div>

<!-- 某个年龄 -->
<div class="age"></div>

<!-- 课程目标 -->
<div class="aim"></div>

<!-- 课程目标栏目 -->

<?php if(is_array($chList)): $i = 0; $__LIST__ = $chList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i; $top = 180+($i-1)*65; ?>
    <div id="div_aim_ch_<?php echo ($i); ?>" style="position: absolute;height:54px;left:345px;top:<?php echo ($top); ?>px;">
        <img id="aim_ch_<?php echo ($i); ?>" src="<?php echo ($ch['linkImage']); ?>" height="54" />
    </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 右边视频列表 -->
<?php if(is_array($videoList)): $i = 0; $__LIST__ = $videoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): $mod = ($i % 2 );++$i; if($i > 3){ $top = 375; $left = 530 + ($i-4)*225; }else{ $top = 180; $left = 530 + ($i-1)*225; } ?>
    <div id="div_video_<?php echo ($i); ?>" style="position:absolute;width:230px;height:210px;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;text-align:center;">
        <img id="video_<?php echo ($i); ?>" src="<?php echo ($video['content']); ?>" width="210" height="180">
    </div>
    <div id="div_video_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden;width:230px;height:216px;left:<?php echo ($left); ?>px;top:<?php echo ($top-3); ?>px;text-align:center;">
        <img id="video_<?php echo ($i); ?>_focus" src="" width="216" height="186">
    </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 月份条 -->
<div class="monthbg"></div>
<!-- 进度条 -->
<div class="progress"></div>
<!-- 进度条背景 -->
<div class="probg"></div>
<!-- 月份条投影 -->
<div class="shadow"></div>

</body>
</html>