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
body{ background-image:url(/static/v1/hd/images/sectionList/primaryschool/bg.jpg); }

.page_prev{
	position:absolute;
	width:25px;
	height:32px;
	left:1077px;
	top:275px;
}
.text{
	position:absolute;
	width:80px;
	height:30px;
	line-height:30px;
	left:1097px;
	top:275px;
	text-align:center;
}
.page_next{
	position:absolute;
	width:25px;
	height:32px;
	left:1177px;
	top:275px;
}
    
    
</style>

<script type="text/javascript">

var buttons=
	[
		/* 上边 */
		{id:'btn_record',name:'',action:'',linkImage:'/static/v1/hd/images/sectionList/primaryschool/btn_record.png',focusImage:'/static/v1/hd/images/sectionList/primaryschool/btn_record_over.png',selectBox:'',right:'btn_plan',down:'section_1'},
		{id:'btn_plan',name:'',action:'addPlan()',linkImage:'/static/v1/hd/images/sectionList/primaryschool/btn_plan.png',focusImage:'/static/v1/hd/images/sectionList/primaryschool/btn_plan_over.png',selectBox:'',right:'btn_order',left:'btn_record' ,down:'section_1',},
		{id:'btn_order',name:'',action:'order()',linkImage:'/static/v1/hd/images/sectionList/primaryschool/btn_order.png',focusImage:'/static/v1/hd/images/sectionList/primaryschool/btn_order_over.png',selectBox:'',right:['page_prev','page_next'],left:'btn_plan',down:['page_prev','page_next']},
		
		/* 分页按钮 */
		{id:'page_prev',name:'',action:'pageUp()',linkImage:'/static/v1/hd/images/common/page/page_prev.png',focusImage:'/static/v1/hd/images/common/page/page_prev_over.png',selectBox:'',left:'btn_order',right:'page_next',down:['section_6','section_1'],up:'btn_order'},
    	{id:'page_next',name:'',action:'pageDown()',linkImage:'/static/v1/hd/images/common/page/page_next.png',focusImage:'/static/v1/hd/images/common/page/page_next_over.png',selectBox:'',left:['page_prev','btn_order'],down:['section_6','section_1'],up:'btn_order'},
        
		/* 下边 */
		{id:'section_1',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',right:'section_6',up:'btn_record',down:'section_2'},
		{id:'section_2',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',right:'section_7',up:'section_1',down:'section_3'},
		{id:'section_3',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',right:'section_8',up:'section_2',down:'section_4'},
		{id:'section_4',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',right:'section_9',up:'section_3',down:'section_5'},
		{id:'section_5',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',right:'section_10',up:'section_4'},
		{id:'section_6',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',left:'section_1',up:['page_prev','page_next'],down:'section_7'},
		{id:'section_7',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',left:'section_2',up:'section_6',down:'section_8'},
		{id:'section_8',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',left:'section_3',up:'section_7',down:'section_9'},
		{id:'section_9',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',left:'section_4',up:'section_8',down:'section_10'},
		{id:'section_10',name:'',action:'',linkImage:'',focusImage:'',focusHandler:'focusHandler()',blurHandler:'blurHandler()',selectBox:'/static/v1/hd/images/common/selectBox/select_box_396x55.png',left:'section_5',up:'section_9'}
	];

/* 初始化按钮 属性   */
var initButtons = function(){}

var url = "<?php echo U('SectionList/index').'?courseId='.$course['id'].'&preFocus='.$preFocus;?>";

//上一页
function pageUp()
{
	url += "&focus="+Epg.btn.current.id+"&page=";
	Epg.page(url,<?php echo ($page); ?>-1,<?php echo ($pageCount); ?>);
}

//下一页
function pageDown()
{
	url += "&focus="+Epg.btn.current.id+"&page=";
	Epg.page(url,<?php echo ($page); ?>+1,<?php echo ($pageCount); ?>);
}

var defaultId = "<?php echo ($focus); ?>";

window.onload=function()
{
	initButtons();
	popup();
	
	//翻页焦点定位
	if(defaultId == "page_next" && Epg.isEmpty(G(defaultId))){
		defaultId = "page_prev";
	}
	if(defaultId == "page_prev" && Epg.isEmpty(G(defaultId))){
		defaultId = "page_next";
	}
	
	Epg.btn.init([defaultId,'btn_record'],buttons,true);	
	
	//设置翻页键翻页事件
	Epg.key.set(
	{
		KEY_PAGE_UP:'pageUp()',
		KEY_PAGE_DOWN:'pageDown()',
	});
};
</script>

<a id="a_back" style="display:none;" href="<?php echo ($backUrl); ?>" ></a>

<!-- 课程iconcourse_icon -->
<div id="div_course_icon" style="position:absolute;left:90px;top:80px;">
	<img src="<?php echo get_upfile_url($course['imgUrl']);?>" width="216" height="216">
</div>
<div style="position:absolute;left:90px;top:325px;">
	共<?php echo ($total); ?>课时<br>
	800人正在学习该课程
</div>

<!-- 继续观看 -->
<div id="div_btn_record" style="position:absolute;width:139px;height:35px;left:420px;top:250px;text-align:center;">
	<img id="btn_record"  src="/static/v1/hd/images/sectionList/primaryschool/btn_record.png" width="139" height="35">
</div>

<!-- 加入学习计划 -->
<div id="div_btn_plan" style="position:absolute;width:183px;height:35px; left:580px;top:250px;">
	<img id="btn_plan" src="/static/v1/hd/images/sectionList/primaryschool/btn_plan.png" width="183" height="35">
</div>	

<!-- 订购该课程 -->
<div id="div_btn_order" style="position:absolute;width:162px;height:35px; left:790px;top:250px;">
	<img id="btn_order" src="/static/v1/hd/images/sectionList/primaryschool/btn_order.png" width="162" height="35">
</div>

<!-- 观看记录 -->
<div style="position:absolute;width:380px;height:35px;left:420px;top:300px;text-align:left;">
	上次看到：无观看记录
</div>

<!-- 课程标题 -->
<div style="position:absolute;width:740px;height:45px;left:425px;top:75px;text-align:left;">
	<span style="font-size:30px;font-weight:bold;"><?php echo ($course['name']); ?></span>
</div>

<!-- 课程简介 -->
<div style="position:absolute;width:740px;height:130px;left:425px;top:120px;text-align:left;line-height:30px;">
	<?php echo msubstr($course['description'],0,80);?>
</div>

<!-- 上一页/下一页 -->
<?php echo ($pageHtml); ?>

<?php if(is_array($sections)): $i = 0; $__LIST__ = $sections;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($i % 2 );++$i; if($i<=5){ $left = 397; $top = ($i-1)*55+383; }else{ $left = 805; $top = ($i-6)*55+383; } ?>
	<div id="div_section_<?php echo ($i); ?>" title="<?php echo U('Section/index?courseId='.$course['id'].'&sectionId='.$section['id']);?>" 
		 style="position:absolute;width:380px;height:50px;left:<?php echo ($left+10); ?>px;top:<?php echo ($top-2); ?>px;line-height:50px;">
			<span id="section_<?php echo ($i); ?>"><?php echo ($section['name']); ?></span>
	</div>
	<div id="div_section_<?php echo ($i); ?>_focus" style="position:absolute;visibility:hidden; width:396px;height:55px;left:<?php echo ($left+1); ?>px;top:<?php echo ($top-3); ?>px;">
		<img id="section_<?php echo ($i); ?>_focus" src="" width='391' height='50'>
	</div>
	<?php if($section['privilege'] == 0): ?><div id="div_section_<?php echo ($i); ?>_free" style="position:absolute;width:46px;height:24px;left:<?php echo ($left+320); ?>px;top:<?php echo ($top); ?>px;">
			<img id="section_<?php echo ($i); ?>_free" src="/static/v1/hd/images/sectionList/primaryschool/free.png" width='46' height='24'>
		</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>

<script type="text/javascript">


//失去时焦点处理（目前主要用于栏目按钮）
function blurHandler(){
	//Epg.marquee.stop();
}

//获取焦点时处理（目前主要用于栏目按钮）
function focusHandler(){
	//Epg.marquee.start();
}

function addPlan(){
	var url = "<?php echo U('Role/addCourse').'?courseId='.$course['id'].'&courseName='.urlencode($course['name']).'&courseImg='.$course['imgUrl'].'&preFocus='.$preFocus;?>";
	Epg.jump(url,'btn_plan');
}

function order(){
	var url = "<?php echo U('Order/index?courseId='.$course['id'].'&preFocus='.$preFocus);?>";
	Epg.jump(url,'btn_order');
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