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

<style type="text/css">
    body{ background-image:url(/static/v1/hd/images/common/bg.jpg); }
    
    .course_title{
        position: absolute;
        display: block;
        top:82px;
        left:290px;
    	font-weight:bold;
        font-size: 30px;
    }
    
    .ch_logo{
        position: absolute;
        display: block;
        top:85px;
        left:95px;
        width: 187px;
        height: 38px;
        background: url(/static/v1/hd/images/library/wrong_anthology/ch_logo.png) no-repeat;
    }
    
    .lib_bg{
        position: absolute;
        display: block;
        top:170px;
        left:85px;
        width: 250px;
        height: 455px;
        background: url(/static/v1/hd/images/library/wrong_anthology/lib_bg.png) no-repeat;
    }
    .score_bg{
        position: absolute;
        display: block;
        top:180px;
        left:995px;
        width: 193px;
        height: 56px;
        background: url(/static/v1/hd/images/library/wrong_anthology/score.png) no-repeat;
    }
    .title_bg{
        position: absolute;
        display: block;
        top:258px;
        left:380px;
        width: 810px;
        height: 332px;
        background: url(/static/v1/hd/images/library/wrong_anthology/title_bg.png) no-repeat;
    }    
    .score{
        position: absolute;
        display: block;
        top:190px;
        left:550px;
        width: 80px;
        color:#ffff64;
        font-size: 28px;
        font-weight: 600;
    }
    #lianxi_score{
        position: absolute;
        display: block;
        top:180px;
        left:380px;
        width: 250px;
        height: 60px;
        background: url(/static/v1/hd/images/library/wrong_anthology/lianxi.png) no-repeat;    	   	
    }
    .now{
        width:100px;
        height:30px;
        line-height: 30px;
        font-size:24px;
        font-weight: 500;
        text-align:center;
        color: #000
    }  
	.page_prev{
		position:absolute;
		width:25px;
		height:32px;
		left:1040px;
		top:615px;
	}
	.text{
		position:absolute;
		width:80px;
		height:30px;
		line-height:30px;
		left:1060px;
		top:615px;
		text-align:center;
	}
	.page_next{
		position:absolute;
		width:25px;
		height:32px;
		left:1140px;
		top:615px;
	}
    
    
</style>

<script type="text/javascript">

var buttons=
	[
        /*课题列表*/
        {id:'lib_1',name:'',action:'',linkTextColor:'#ffff00',focusTextColor:'#503200',linkImage:'/static/v1/hd/images/common/transparent.png',titleImage:'/static/v1/hd/images/library/wrong_anthology/select_box_out.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',left:'',right:'re_answer',up:'pageUp()',down:'lib_2'},
        {id:'lib_2',name:'',action:'',linkTextColor:'#ffff00',focusTextColor:'#503200',linkImage:'/static/v1/hd/images/common/transparent.png',titleImage:'/static/v1/hd/images/library/wrong_anthology/select_box_out.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',left:'',right:'re_answer',up:'lib_1',down:'lib_3'},
        {id:'lib_3',name:'',action:'',linkTextColor:'#ffff00',focusTextColor:'#503200',linkImage:'/static/v1/hd/images/common/transparent.png',titleImage:'/static/v1/hd/images/library/wrong_anthology/select_box_out.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',left:'',right:'re_answer',up:'lib_2',down:'lib_4'},
        {id:'lib_4',name:'',action:'',linkTextColor:'#ffff00',focusTextColor:'#503200',linkImage:'/static/v1/hd/images/common/transparent.png',titleImage:'/static/v1/hd/images/library/wrong_anthology/select_box_out.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',left:'',right:'re_answer',up:'lib_3',down:'lib_5'},
        {id:'lib_5',name:'',action:'',linkTextColor:'#ffff00',focusTextColor:'#503200',linkImage:'/static/v1/hd/images/common/transparent.png',titleImage:'/static/v1/hd/images/library/wrong_anthology/select_box_out.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',left:'',right:'re_answer',up:'lib_4',down:'lib_6'},
        {id:'lib_6',name:'',action:'',linkTextColor:'#ffff00',focusTextColor:'#503200',linkImage:'/static/v1/hd/images/common/transparent.png',titleImage:'/static/v1/hd/images/library/wrong_anthology/select_box_out.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',left:'',right:'re_answer',up:'lib_5',down:'lib_7'},
        {id:'lib_7',name:'',action:'',linkTextColor:'#ffff00',focusTextColor:'#503200',linkImage:'/static/v1/hd/images/common/transparent.png',titleImage:'/static/v1/hd/images/library/wrong_anthology/select_box_out.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/select_box.png',selectBox:'',blurHandler:'blurHandler()',focusHandler:'focusHandler()',left:'',right:'re_answer',up:'lib_6',down:'pageDown()'},
        
        /* 页码 */
		{id:'page_prev',name:'',action:'pageLeft()',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',left:'re_answer',right:'page_next',up:'re_answer',down:''},
		{id:'page_next',name:'',action:'pageRight()',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:['page_prev','re_answer'],right:'',up:'re_answer',down:''},
        {id:'up',name:'',action:'',linkImage:'/static/v1/hd/images/library/wrong_anthology/up.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/up_over.png',selectBox:'',left:'',right:'',up:'',down:''},
		{id:'down',name:'',action:'',linkImage:'/static/v1/hd/images/library/wrong_anthology/down.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/down_over.png',selectBox:'',left:'',right:'',up:'',down:''},
        
	 	/*重新答题*/
        {id:'re_answer',name:'',action:'',linkImage:'/static/v1/hd/images/library/wrong_anthology/re_answer.png',focusImage:'/static/v1/hd/images/library/wrong_anthology/re_answer_over.png',selectBox:'',right:['page_prev','page_next'],left:'',up:'',down:''},
        
	];

var defaultId = "<?php echo ($focus); ?>";


window.onload=function()
{
	var index = <?php echo ($index); ?>;
	buttons[11].left = "lib_"+index;
	//翻页焦点定位
	if(defaultId == "page_next" && Epg.isEmpty(G(defaultId))){
		defaultId = "page_prev";
	}
	if(defaultId == "page_prev" && Epg.isEmpty(G(defaultId))){
		defaultId = "page_next";
	}
	if(!Epg.isEmpty(G(defaultId))){
		G("lib_"+index).src = "/static/v1/hd/images/library/wrong_anthology/select_box_out.png";
	}
	G("lib_"+index+"_focus").style.color = buttons[index-1].focusTextColor;
	Epg.btn.init([defaultId,'lib_'+index],buttons,true);
	
};
//       =3079&amp;sectionId=0&amp;index=1&amp;spage=2
var url = "<?php echo U('Library/wrongAnthology').'?courseId='.$courseId.'&index=';?>";
//上一页
function pageUp()
{
	url += 7+"&spage=";
	Epg.page(url,<?php echo ($s_page); ?>-1,<?php echo ($pageCount); ?>);
}

//下一页
function pageDown()
{
	url += 1+"&spage=";
	Epg.page(url,<?php echo ($s_page); ?>+1,<?php echo ($pageCount); ?>);
}

//上一页
function pageLeft()
{
	url += <?php echo ($index); ?>+"&focus="+Epg.btn.current.id+"&spage="+<?php echo ($s_page); ?>+"&lpage=";
	Epg.page(url,<?php echo ($l_page); ?>-1,<?php echo ($l_pageCount); ?>);
}

//下一页
function pageRight()
{
	url += <?php echo ($index); ?>+"&focus="+Epg.btn.current.id+"&spage="+<?php echo ($s_page); ?>+"&lpage=";
	Epg.page(url,<?php echo ($l_page); ?>+1,<?php echo ($l_pageCount); ?>);
}

//失去时焦点处理（目前主要用于栏目按钮）
function blurHandler(){
	if(Epg.btn.current.id == "re_answer"){
		G(Epg.btn.previous.id).src = Epg.btn.previous.titleImage;
	}
}
var timeHandlerVar;
//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	if(timeHandlerVar){
		clearTimeout(timeHandlerVar);
	}
	if(Epg.btn.current.id != "lib_"+<?php echo ($index); ?>){
		timeHandlerVar = setTimeout("Epg.btn.click()",500);
	}
}

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Learning/learningPreschool',1);?>" ></a>

<!-- 练习得分 -->
<div id="lianxi_score"></div>

<!-- 课程名称 -->
<div class="course_title"><?php echo ($courseName); ?></div>

<!-- 上面栏目 -->
<div class="ch_logo"></div>

<!-- 左边黑色背景 -->
<div class="lib_bg"></div>

<!-- 左边课程 -->
<?php if(is_array($libList)): $i = 0; $__LIST__ = $libList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lib): $mod = ($i % 2 );++$i; $top = 200 + ($i-1)*55; ?>
    <div id="div_lib_<?php echo ($i); ?>" title="<?php echo U('Library/wrongAnthology',array('courseId'=>$courseId,'sectionId'=>$libList[$i]['sectionId'],'index'=>$i,'spage'=>$s_page));?>" style="position:absolute;height:55px;left:85px;top:<?php echo ($top+6); ?>px;z-index: 100">
        <img id="lib_<?php echo ($i); ?>" src="/static/v1/hd/images/common/transparent.png" width="261" height="55" />
	</div>
    <div id="div_lib_<?php echo ($i); ?>_focus" style="position:absolute;left:90px;top:<?php echo ($top+5); ?>px;z-index: 1000;">
        <span id="lib_<?php echo ($i); ?>_focus" style="display: block;height: 55px;width:250px; line-height: 55px; font-size: 22px;text-align:center; z-index: 9999"><?php echo msubstr($lib['sectionName'],0,10);?></span>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 上下分页 -->

<?php echo ($s_html); ?>


<!-- 练习题分 -->
<div class="score_bg"></div>
<div class="score"><?php echo ($score); ?></div>

<!-- 重新答题 -->
<div id="div_re_answer" title="<?php echo U('Library/detail',array('courseId'=>$courseId,'sectionId'=>$sectionId));?>" style="position:absolute;width:110px;height:40px;left:670px;top:190px;text-align:center;">
	<img id="re_answer" src="/static/v1/hd/images/library/wrong_anthology/re_answer.png" width="110" height="40">
</div>

<!-- 题目背景 -->
<div class="title_bg"></div>

<!-- 题目列表 -->
<?php if(is_array($questionList)): $i = 0; $__LIST__ = $questionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$question): $mod = ($i % 2 );++$i; $top = 265 + ($i-1)*55; ?>
    <div id="div_question_<?php echo ($i); ?>" style="position:absolute;left:385px;top:<?php echo ($top-2); ?>px;z-index: 1000;">
        <span id="question_<?php echo ($i); ?>" style=" display: block;height: 48px;line-height: 48px; font-size: 20px;color:#fff;"><?php echo msubstr($question['title'],0,30);?></span>
	</div>
    
    <!-- 你的答案 -->
    <div id="div_myself_<?php echo ($i); ?>" style="position:absolute;left:1030px;top:<?php echo ($top+10); ?>px;z-index: 1000;">
        <img id="myself_<?php echo ($i); ?>" src="/static/v1/hd/images/library/wrong_anthology/<?php echo ($question['wrong']); ?>.png" width='35' height='35' />
	</div>
    
    <!-- 正确答案 -->
    <div id="div_correct_<?php echo ($i); ?>" style="position:absolute;left:1130px;top:<?php echo ($top+10); ?>px;z-index: 1000;">
        <img id="correct_<?php echo ($i); ?>" src="/static/v1/hd/images/library/wrong_anthology/<?php echo ($question['correct']); ?>.png" width='35' height='35' />
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 分页 -->

<?php echo ($l_html); ?>

<!-- 1.无背景图的文字提示 -->
<div id="popup_1"></div>

<!-- 2.有背景图的文字提示 -->
<div id="popup_2">
	<div id="popup_2_info_bg"></div>
	<div id="popup_2_info"></div>
</div>

</body>
</html>