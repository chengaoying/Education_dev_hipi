<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>视频播放页面--全屏模式</title>
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">
    .leftbg{
        position: absolute;
        display: block;
        top:0px;
        left:0px;
        width: 185px;
        height: 720px;
        background: url(/static/v1/hd/images/play/left_bg.png) no-repeat;
    }
</style>
<!--
<script type="text/javascript" src="/static/v1/common/js/play<?php echo ($areacode); ?>.js?20140208173232"></script>

<script type="text/javascript">

var width = 741;
var hidetime = 8;

var play_url = "<?php echo ($playUrl); ?>&userId="+Utility.getSystemInfo("UID")+"&areaCode="+Utility.getSystemInfo("ARC");

var next_url = "<?php echo ($nextUrl); ?>";
function init(){
	//播放
	initPlayer(play_url, 1280, 720, 0, 0);
}

function destory(){
	destoryMP();
}
var alltime = 0;
var curtime = 0;
var proCurTime = 0;
var progress = 1;
var dingweistatus = 0;


function timefunction(){
	alltime = getTotalTime();
	document.getElementById("showAllTime").innerHTML = formatTime(alltime);
	curtime = getCurrentTime();
	if((curtime >= alltime) && (curtime != 0) && (alltime != 0)){
		destoryMP();
	    window.location =  next_url;
	}
	document.getElementById("showCurTime").innerHTML = formatTime(curtime);
	var fudu = width/alltime;
	document.getElementById("dingweiimg").style.width = parseInt(curtime*fudu)+"px";
	document.getElementById("dingweitip").style.left = (205 + parseInt(curtime*fudu))+"px";
	proCurTime++;
	if(progress == 1 && proCurTime>=hidetime){
		hidetime = 8;
		progress = 0;
		proCurTime = 0;
		dingweistatus = 0;
		document.getElementById("dingweitime").blur();
		document.getElementById("showprogress").style.display = "none";
		document.getElementById("dingwei").style.display = "none";
		document.getElementById("showCurTime").style.display = "none";
		document.getElementById("dingweiimg").style.display = "none";
		document.getElementById("dingweitime").style.display = "none";
		document.getElementById("dingweitip").style.display = "none";
		document.getElementById("showAllTime").style.display = "none";
	}

}

var timeFunctions;
timeFunctions = setInterval("timefunction()",1000);

//按键监控
document.onkeypress = function(keyEvent){
	keyEvent = keyEvent ? keyEvent : window.event;
	var keyval = keyEvent.which ? keyEvent.which : keyEvent.keyCode;
	if((keyval != 37) && (keyval != 39) && (keyval != 640)){
		progress = 1;
		document.getElementById("showprogress").style.display = "block";
		document.getElementById("showCurTime").style.display = "block";
		document.getElementById("dingweiimg").style.display = "block";
		document.getElementById("dingweitip").style.display = "block";
		document.getElementById("showAllTime").style.display = "block";
	}
	//alert(keyval);
	if (keyval == 640){  //返回
	   	window.location =  next_url;
	}else if(keyval == 3864){ //播放/暂停
	   pauseOrPlay();
	   if(playStat == 'play'){
	   		document.getElementById("statusimg").src="/static/v1/hd/images/play/play.png";
	   }else{
	   		document.getElementById("statusimg").src="/static/v1/hd/images/play/pause.png";
	   }
	}else if(keyval == 3863){ //停止
	   destoryMP();
	   window.location =  next_url;
	}
	else if(keyval == 37){ //音量-
	     volDown();
	}
	else if(keyval == 39){ //音量+
	     volUp();
	}
	else if(keyval == 3874){ //快进
		document.getElementById("statusimg").src="/static/v1/hd/images/play/pause.png";
	     fastForward();
   		 	 	 
	}
	else if(keyval == 3873){ //快退
		document.getElementById("statusimg").src="/static/v1/hd/images/play/pause.png";
		fastRewind();
   		
	}
	else if(keyval == 3880){  //定位
		hidetime = 12;
		dingweistatus = 1;
		document.getElementById("dingwei").style.display = "block";
		document.getElementById("dingweitime").style.display = "block";
		document.getElementById("dingweitime").focus();
		
	}else if(keyval == 13){
			if((document.getElementById("dingweitime").value != '') && (dingweistatus == 1)){
				document.getElementById("dingwei").style.display = "none";
				document.getElementById("dingweitime").style.display = "none";
				var dingweitime = document.getElementById("dingweitime").value;
				if(parseInt(dingweitime*60) <= alltime){
					playByTime(parseInt(dingweitime*60));
				}
			}else{
				document.getElementById("dingwei").style.display = "none";
				document.getElementById("dingweitime").style.display = "none";
			}
			
	}
	
}


</script>-->

<script type="text/javascript">
    var buttons=
	[
        /*左边按钮*/
	 	{id:'prex_video',name:'',action:'',linkImage:'/static/v1/hd/images/play/prex_video.png',focusImage:'/static/v1/hd/images/play/prex_video_over.png',selectBox:'',left:'',right:'anime_preview',up:'anime_preview',down:'current_video'},
        {id:'current_video',name:'',action:'',linkImage:'/static/v1/hd/images/play/current_video.png',focusImage:'/static/v1/hd/images/play/current_video_over.png',selectBox:'',left:'',right:'',up:'prex_video',down:'next_video'},
        {id:'next_video',name:'',action:'',linkImage:'/static/v1/hd/images/play/prex_video.png',focusImage:'/static/v1/hd/images/play/next_video_over.png',selectBox:'',left:'',right:'',up:'current_video',down:''},
        /*上边按钮*/
        {id:'anime_preview',name:'',action:'',linkImage:'/static/v1/hd/images/play/anime_preview.png',focusImage:'/static/v1/hd/images/play/anime_preview_over.png',selectBox:'',left:'prex_video',right:'sync_class',up:'',down:'prex_video'},
        {id:'sync_class',name:'',action:'',linkImage:'/static/v1/hd/images/play/sync_class.png',focusImage:'/static/v1/hd/images/play/sync_class_over.png',selectBox:'',left:'anime_preview',right:'game_preview',up:'',down:'prex_video'},
        {id:'game_preview',name:'',action:'',linkImage:'/static/v1/hd/images/play/game_preview.png',focusImage:'/static/v1/hd/images/play/game_preview_over.png',selectBox:'',left:'sync_class',right:'',up:'',down:'prex_video'},
    ];
    window.onload=function()
    {
        Epg.btn.init('current_video',buttons,true);
    };
</script>    
</head>
<body bgcolor="transparent" onUnload="javascript:destory()" onLoad="javascript:init()">
 <!--其他控制-->   
 <!-- 左边背景 -->
 <div class="leftbg"></div>
 
 <!-- 上一集 -->
 <div id="div_prex_video" title="http://www.baidu.com" style=" position: absolute;left:30px;top:200px;z-index: 1000px;">
     <img id="prex_video" src="/static/v1/hd/images/play/prex_video.png" width="125" height="50" />
 </div>
 
 <!-- 正在学习 -->
 <div id="div_current_video" style=" position: absolute;left:30px;top:280px;z-index: 1000px;">
     <img id="current_video" src="/static/v1/hd/images/play/current_video.png" width="125" height="50" />
 </div>
 
  <!-- 下一集 -->
 <div id="div_next_video" style=" position: absolute;left:30px;top:360px;z-index: 1000px;">
     <img id="next_video" src="/static/v1/hd/images/play/prex_video.png" width="125" height="50" />
 </div>
 
 <!-- 动漫预习 -->
 <div id="div_anime_preview" style=" position: absolute;left:600px;top:60px;z-index: 1000px;">
     <img id="anime_preview" src="/static/v1/hd/images/play/anime_preview.png" width="125" height="50" />
 </div>
 
  <!-- 同步课堂 -->
 <div id="div_sync_class" style=" position: absolute;left:800px;top:60px;z-index: 1000px;">
     <img id="sync_class" src="/static/v1/hd/images/play/sync_class.png" width="125" height="50" />
 </div> 
  
   <!-- 游戏预习 -->
 <div id="div_game_preview" style=" position: absolute;left:1000px;top:60px;z-index: 1000px;">
     <img id="game_preview" src="/static/v1/hd/images/play/game_preview.png" width="125" height="50" />
 </div>
  
 <!--视频控制-->
<img id="statusimg" style="position:absolute;top:30;left:1150;" src="/static/v1/hd/images/play/play.png" width="54" height="54" />
<img id="dingwei" src="/static/v1/hd/images/play/video_dingwei.png" style="position:absolute;top:450;left:500;display:none;" />
<input type="text" id="dingweitime" style="position:absolute;top:470;left:608;width:95px;height:28px;line-height:28px;display:none;background-color:transparent;border:none;color:#ffffff;text-align:center;font-size:22px;z-index:1000;" />
<img id="showprogress" style="position:absolute;top:600px;left:76px;z-index:-100;" src="/static/v1/hd/images/play/video_progress_bg.png" width="1128" height="68" />
<div id="showCurTime" style="position:absolute;top:625;left:90; width:120px;height:68px;text-align:center;z-index:1000;"></div>
<img id="dingweiimg" style="position:absolute;top:628;left:228;z-index:1000;" src="/static/v1/hd/images/play/video_progress.png" width="0" height="11" />
<img id="dingweitip" style="position:absolute;top:616;left:212;z-index:1000;" src="/static/v1/hd/images/play/video_tip.png" width="35" height="35" />
<div id="showAllTime" style="position:absolute;top:625;left:990; width:120px;height:68px;text-align:center;z-index:1000;"></div>

</body>
</html>