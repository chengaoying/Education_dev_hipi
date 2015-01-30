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
    body{ background-image:url(/static/v1/hd/images/usercenter/baseInfo/info_bg.jpg); }

/* 设置兴趣  */
#logo{
	position:absolute;
    display: block;
    width:<?php echo ($width_logo); ?>px;
    height:40px;
    top:100px;
    left:100px;	
    background-image:url(/static/v1/hd/images/usercenter/mulchoice/<?php echo ($type); ?>.png);
}
/* 提示文字  */
#select_tip{
	position:absolute;
    display: block;
    width:427px;
    height:22px;
    top:110px;
    left:320px;	
    background-image:url(/static/v1/hd/images/usercenter/baseInfo/select_tip_2.png);
}
</style>

<script type="text/javascript">
var count = <?php echo ($count_sub); ?>;
var subject_selected = <?php echo ($json_selected); ?>;
var subjects = <?php echo ($subjects_json); ?>;
var isEmpty = <?php echo ($isEmpty); ?>;
var n = 5;//一行五列
/* 页面可点击按钮  */
var buttons= new Array(count+1);
var initButtons = function()
{
	for(var i=1; i<buttons.length; i++)
	{
		obj = new Object();
		
		obj.id = 'subject_' + i;
		obj.action = 'select("'  + i + '")';
		obj.linkImage = "/static/v1/hd/images/usercenter/mulchoice/kuang_1.png";
		obj.focusImage = "/static/v1/hd/images/usercenter/mulchoice/kuang_2.png";
		obj.left = ((i-1)>0) ? 'subject_'+(i-1) : '' ;
		obj.right = ((i+1)<=count) ? 'subject_'+(i+1) : '' ;
		obj.up = (i-n>0) ? 'subject_'+(i-n) : '' ; 
		obj.down = (i+n)>count ? (Math.ceil(i/n)==Math.ceil(count/n) ? 'ok' : '') : 'subject_'+(i+n);
		
		buttons[i-1] = obj;
	}
	//ok up键值
	id = (Math.ceil(count/n)-1)*n+1;
	//第12个元素初始化为ok键
	buttons[count] = {id:'ok',action:'submit()',linkImage:'/static/v1/hd/images/usercenter/mulchoice/confirm_1.png',focusImage:'/static/v1/hd/images/usercenter/mulchoice/confirm_2.png',up:('subject_'+id),down:''};
}
//选中的显示对号
var init_subjects = function()
{
	for(var key in subject_selected)
	{
		G('form_'+key).value = subject_selected[key];
		G('div_'+key+'_selected').style.visibility = 'visible';
	}
}

window.onload=function()
{
	initButtons();
	init_subjects();
	if(isEmpty)
	{	
		Epg.btn.init('ok',buttons,true);	
	}
	else
	{
		Epg.btn.init('subject_1',buttons,true);	
	}
};

</script>

<a id="a_back" style="display:none;" href="<?php echo get_back_url('Role/userInfo',0);?>" ></a>

<!-- 静态图片 -->
<div id="logo"></div>
<div id="select_tip"></div>

<form id="form" action="<?php echo U(Role/setSex);?>" method="post" style="padding:10px">
	<?php if(is_array($subjects)): $i = 0; $__LIST__ = $subjects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subject): $mod = ($i % 2 );++$i;?><input type="hidden" id="form_subject_<?php echo ($i); ?>" name="form_<?php echo ($i); ?>" value=""/><?php endforeach; endif; else: echo "" ;endif; ?>
	<input type="hidden" name="type" value="<?php echo ($type); ?>"/>
</form>

<?php if(is_array($subjects)): $i = 0; $__LIST__ = $subjects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subject): $mod = ($i % 2 );++$i; $left = 100 + (($i-1)%5)*150; $top = 200 + (ceil($i/5)-1)*100; ?>
	
	<!-- 背景框，选中为青色，未选中为蓝色 -->
	<div id="div_subject_<?php echo ($i); ?>" style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img id="subject_<?php echo ($i); ?>" src="/static/v1/hd/images/usercenter/mulchoice/kuang_1.png" style="width:110px;height:50px;"/>
	</div>
	<!-- 科目文字 -->
	<div style="position:absolute;left:<?php echo ($left); ?>px;top:<?php echo ($top); ?>px;">
		<img   src="/static/v1/hd/images/usercenter/mulchoice/subject_<?php echo ($subject); ?>.png" style="width:110px;height:50px;"/>
	</div>
	<!-- 对勾，选中则显示√ -->
	<div id="div_subject_<?php echo ($i); ?>_selected" style="position:absolute;visibility:hidden;left:<?php echo ($left+78); ?>px;top:<?php echo ($top+15); ?>px;">
		<img id="subject_<?php echo ($i); ?>_selected" src="/static/v1/hd/images/usercenter/mulchoice/right.png" style="width:28px;height:22px;"/>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>


<!-- 确定按钮 -->
<div id="div_ok" style="position:absolute;left:100px;top:500px;">
    <img id="ok" title="" src="/static/v1/hd/images/usercenter/baseInfo/confirm_1.png" width="140" height="50">
</div>

<script type="text/javascript">

function submit(){
	G('form').submit();
}

var count_selected = <?php echo ($count_selected); ?>;
var selected_array = new Array(4);
var type = '<?php echo ($type); ?>';
/* 初始化selected_array */
var i=0;
for(var key in subject_selected)
{	
	selected_array[i++] = subject_selected[key];
}
function select(subject)
{
	if(G('div_subject_'+subject+'_selected').style.visibility == 'visible')
	{
		G('div_subject_'+subject+'_selected').style.visibility = 'hidden';
		G('form_subject_'+subject).value = '';
		if(type != 'interests')
		{
			if(count_selected>0) count_selected--;
		}
	}
	else
	{
		G('div_subject_'+subject+'_selected').style.visibility = 'visible'
		G('form_subject_'+subject).value = subjects['subject_'+subject];
		
		if(type != 'interests')
		{
			count_selected++;	
			if(count_selected>4)
			{
				G('div_subject_'+selected_array[0]+'_selected').style.visibility = 'hidden';
				G('form_subject_'+selected_array[0]).value = '';
				count_selected--;
				for(i=0;i<selected_array.length-1;i++)
				{
					selected_array[i] = selected_array[i+1];
				}
				selected_array[selected_array.length-1] = subject;
			}
			else
			{
				selected_array[count_selected-1] = subject;
			}
		}

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