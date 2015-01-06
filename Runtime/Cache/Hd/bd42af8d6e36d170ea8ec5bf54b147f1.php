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
    body{ background-image:url(/static/v1/hd/images/library/wrong_anthology/bg.jpg); }
    
    .course_title{
        position: absolute;
        display: block;
        top:65px;
        left:65px;
        font-size: 22px;
    }
    
    .ch_logo{
        position: absolute;
        display: block;
        top:55px;
        left:305px;
        width: 116px;
        height: 43px;
        background: url(/static/v1/hd/images/library/wrong_anthology/ch_logo.png) no-repeat;
    }
    
    .lib_big_bg{
        position: absolute;
        display: block;
        top:160px;
        left:76px;
        width: 1110px;
        height: 435px;
        background: url(/static/v1/hd/images/library/wrong_anthology/lib_big_bg.png) no-repeat;
        z-index: 0;
    }
    
    .lib_bg{
        position: absolute;
        display: block;
        top:178px;
        left:85px;
        width: 140px;
        height: 350px;
        background: url(/static/v1/hd/images/library/wrong_anthology/lib_bg.png) no-repeat;
        z-index: 2;
    }
    .score_bg{
        position: absolute;
        display: block;
        top:178px;
        left:280px;
        width: 104px;
        height: 23px;
        background: url(/static/v1/hd/images/library/wrong_anthology/score.png) no-repeat;
    }
    
    .score{
        position: absolute;
        display: block;
        top:175px;
        left:400px;
        width: 80px;
        color:#f65074;
        font-size: 24px;
        font-weight: 600;
    }
    .answer_bg{
        position: absolute;
        display: block;
        top:178px;
        left:980px;
        width: 183px;
        height: 19px;
        background: url(/static/v1/hd/images/library/wrong_anthology/answer_bg.png) no-repeat;
    }
    .now{
        width:100px;
        height:30px;
        line-height: 30px;
        font-size:26px;
        font-weight: 500;
        text-align:center;
        color: #000
    }
</style>

<script type="text/javascript">

var buttons=
	[
        /*课题列表*/
        {id:'lib_1',name:'',action:'',linkImage:'/static/v1/hd/images/common/transparent.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',left:'',right:'re_answer',up:'',down:['lib_2','up','down']},
        {id:'lib_2',name:'',action:'',linkImage:'/static/v1/hd/images/common/transparent.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',left:'',right:'re_answer',up:'lib_1',down:['lib_3','up','down']},
        {id:'lib_3',name:'',action:'',linkImage:'/static/v1/hd/images/common/transparent.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',left:'',right:'re_answer',up:'lib_2',down:['lib_4','up','down']},
        {id:'lib_4',name:'',action:'',linkImage:'/static/v1/hd/images/common/transparent.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',left:'',right:'re_answer',up:'lib_3',down:['lib_5','up','down']},
        {id:'lib_5',name:'',action:'',linkImage:'/static/v1/hd/images/common/transparent.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',left:'',right:'re_answer',up:'lib_4',down:['lib_6','up','down']},
        {id:'lib_6',name:'',action:'',linkImage:'/static/v1/hd/images/common/transparent.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',left:'',right:'re_answer',up:'lib_5',down:['lib_7','up','down']},
        {id:'lib_7',name:'',action:'',linkImage:'/static/v1/hd/images/common/transparent.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',left:'',right:'re_answer',up:'lib_6',down:['up','down']},
        
        /* 页码 */
		{id:'pre',name:'',action:'',linkImage:'/static/v1/hd/images/library/wrong_anthology/pre.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/pre_over.png',selectBox:'',left:'re_answer',right:'next',up:'re_answer',down:''},
		{id:'next',name:'',action:'',linkImage:'/static/v1/hd/images/library/wrong_anthology/next.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/next_over.png',selectBox:'',left:'pre',right:'',up:'re_answer',down:''},
        {id:'up',name:'',action:'',linkImage:'/static/v1/hd/images/library/wrong_anthology/up.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/up_over.png',selectBox:'',left:'',right:'down',up:['lib_7','lib_6','lib_5','lib_4','lib_3','lib_2','lib_1'],down:''},
		{id:'down',name:'',action:'',linkImage:'/static/v1/hd/images/library/wrong_anthology/down.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/down_over.png',selectBox:'',left:'up',right:'re_answer',up:['lib_7','lib_6','lib_5','lib_4','lib_3','lib_2','lib_1'],down:''},
        
	 	/*重新答题*/
        {id:'re_answer',name:'',action:'',linkImage:'/static/v1/hd/images/library/wrong_anthology/re_answer.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/re_answer_over.png',selectBox:'',right:['pre','next'],left:'lib_1',up:'',down:''},
        
	];

window.onload=function()
{
	Epg.btn.init('lib_1',buttons,true);
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Learning/learningEvaluation2',1);?>" ></a>

<!-- 课程名称 -->
<div class="course_title">小学一年级语文（上）</div>

<!-- 上面栏目 -->
<div class="ch_logo"></div>

<!-- 中间白色背景 -->
<div class="lib_big_bg"></div>

<!-- 左边黑色背景 -->
<div class="lib_bg"></div>

<!-- 左边课程 -->
<?php if(is_array($libList)): $i = 0; $__LIST__ = $libList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lib): $mod = ($i % 2 );++$i; $top = 178 + ($i-1)*50; ?>
    <div id="div_lib_<?php echo ($i); ?>" style="position:absolute;height:50px;left:85px;top:<?php echo ($top); ?>px;z-index: 100">
        <img id="lib_<?php echo ($i); ?>" src="" width="140" height="50" />
	</div>
    <div id="div_lib_<?php echo ($i); ?>_focus" style="position:absolute;left:115px;top:<?php echo ($top-2); ?>px;z-index: 1000;">
        <span id="lib_<?php echo ($i); ?>_focus" style=" display: block;height: 48px;line-height: 48px; font-size: 22px;color:#f65074;z-index: 9999"><?php echo msubstr($lib['sectionName'],0,3);?></span>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 上下分页 -->

<?php echo ($s_html); ?>


<!-- 练习题分 -->
<div class="score_bg"></div>
<div class="score"><?php echo ($score); ?></div>

<!-- 重新答题 -->
<div id="div_re_answer" title="<?php echo U('Library/detail',array('topicId'=>$topicId,'sectionId'=>$sectionId));?>" style="position:absolute;width:100px;height:36px;left:480px;top:175px;text-align:center;">
	<img id="re_answer" src="/static/v1/hd/images/library/wrong_anthology/re_answer.png" width="100" height="36">
</div>
<!-- 答案背景 -->
<div class='answer_bg'></div>

<!-- 题目列表 -->
<?php if(is_array($questionList)): $i = 0; $__LIST__ = $questionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$question): $mod = ($i % 2 );++$i; $top = 228 + ($i-1)*50; ?>
    <div id="div_question_<?php echo ($i); ?>" style="position:absolute;left:280px;top:<?php echo ($top-2); ?>px;z-index: 1000;">
        <span id="question_<?php echo ($i); ?>" style=" display: block;height: 48px;line-height: 48px; font-size: 20px;color:#333;"><?php echo ($question['title']); ?></span>
	</div>
    
    <!-- 你的答案 -->
    <div id="div_myself_<?php echo ($i); ?>" style="position:absolute;left:1020px;top:<?php echo ($top+10); ?>px;z-index: 1000;">
        <img id="myself_<?php echo ($i); ?>" src="/static/v1/hd/images/library/wrong_anthology/<?php echo ($question['wrong']); ?>_over.png" width='13' height='18' />
	</div>
    
    <!-- 正确答案 -->
    <div id="div_correct_<?php echo ($i); ?>" style="position:absolute;left:1120px;top:<?php echo ($top+10); ?>px;z-index: 1000;">
        <img id="correct_<?php echo ($i); ?>" src="/static/v1/hd/images/library/wrong_anthology/<?php echo ($question['correct']); ?>.png" width='13' height='18' />
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 分页 -->

<?php echo ($l_html); ?>

<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>