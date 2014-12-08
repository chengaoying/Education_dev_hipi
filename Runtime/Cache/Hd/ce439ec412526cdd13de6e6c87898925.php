<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/common.js?20140208173232"></script>
<script type="text/javascript">
	//初始化常用按键
	keyCodes[8]	= keyCodes[126] = keyCodes[48]= keyCodes[640] = keyCodes[340] = "window.location=$('#a_back').href"; 		//返回按键
	keyCodes[33] = "window.location=$('#a_page_prev').href"; //上一页
	keyCodes[34] = "window.location=$('#a_page_next').href"; //下一页
	
	//设置光标颜色及宽度
	iPanel.defaultalinkBgColor = "#225cbb";//设置文字链接焦点颜色
	iPanel.defaultFocusColor = "#225cbb";  //设置图片链接焦点颜色
	iPanel.focusWidth = "4";			   //焦点框宽度
</script>
<style type="text/css">
.page td	{ height:26px; text-align:center;color:#000;font-weight: 600; font-size:22px;}
.page .up	{ width:64px;}
.page .down	{ width:64px;}
.page .now	{ width:150px;}
body,#restdiv{background-color: transparent;}
</style>
</head>
<body>

<style>
body	{ background-image:url(/static/v1/hd/images/common/msg/bg.png); }
.buttons td { padding:5px 10px;}

</style>

<div style="position:absolute;top:255px;left:350px;">
<img src="/static/v1/hd/images/common/msg/icon_<?php echo ($icon); ?>.png"/>
</div>

<div style="position:absolute;top:295px;left:550px;">
<font style="font-size:24px;color:#999;"><?php echo ($message); ?></font>
</div>

<!-- <a id="a_back" style="none" href="<?php echo get_back_url('Index/index',1);?>"></a> -->
<!-- <table width="1280" height="720" cellspacing="0" cellpadding="0" border="0" style="text-align:center">
<tr><td height="226"></td></tr>
<tr><td height="195">
	<table width="1280" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td width="360"></td>
		<td width="104" align="left"><img src="/static/v1/hd/images/common/msg/icon_<?php echo ($icon); ?>.png"/></td>
        <td width="60"></td>
		<td align="left" style="font-size:24px;color:#999;"><?php echo ($message); ?></td>
		<td width="350"></td>
	</tr>
	</table>
</td></tr>
<tr><td height="75"></td></tr>
<tr><td align="center" >
	<table class="buttons" cellspacing="0" cellpadding="0">
	<tr>
	<?php if(is_array($buttons)): foreach($buttons as $key=>$button): ?><td>
		<?php if(empty($button["img1"])): ?><a href="<?php echo ($button["url"]); ?>"><?php echo ($button["text"]); ?></a>
		<?php else: ?>
			<a href="<?php echo ($button["url"]); ?>" title="<?php echo ($button["text"]); ?>"
				onmouseover="changeImage('#button_<?php echo ($key); ?>','/static/v1/hd/images/common/<?php echo ($button["img2"]); ?>')" 
				onmouseout="changeImage('#button_<?php echo ($key); ?>','/static/v1/hd/images/common/<?php echo ($button["img1"]); ?>')">
			<img id="button_<?php echo ($key); ?>" src="/static/v1/hd/images/common/<?php echo ($button["img1"]); ?>" />
			</a><?php endif; ?>
		</td><?php endforeach; endif; ?>
	</tr>
	</table>
</td></tr>
<tr><td height="40"></td></tr>
</table> -->
<div style="display:block;"><iframe id="connfreame" src="" style="width:0px; height:0px;" frameborder="0" ></iframe></div>
<script type="text/javascript">
  //初始化消息弹框及设置默认焦点
  setDefFocus();
  setConn("<?php echo U('Misc/showMessage');?>");
</script>
</body>
</html>