var countFlag = 0;
var seekTime = 0;
var count = 0;
var movies = [];
var playUrl = null;
var returnVideo_flag = false;
var lpos, tpos, wpos, hpos;
var playStatus = 1;
var next_url = '';
var speed = 1;//快进快退速度
//思华方填充RTSP地址
iPanel.eventFrame.initPage(window);
document.onsystemevent = grabEvent;
document.onkeypress = grabEvent;
document.onirkeypress = grabEvent;
function grabEvent(event)
{
    var keycode = event.which;  //消息的按键值
    //播放完成后，循环播放
    iPanel.debug("keycode==" + keycode);
    switch (keycode) {
        case 5210:
            media.AV.close();
			window.location = next_url;
            //setTimeout("playVOD()", 2000);
            return 0;
            break;
        case 5202:
            iPanel.debug("5202");
            media.AV.play();
            return 0;
            break;
        case 5205:
            var hVersion = hardware.STB.hVersion;
            if (hVersion == "0371666f" && VOD.server.name == "sihua_3rd" && serverModel == "IP") {//加入serverMdel这个条件后，满足两个条件后才能调用play 9-13//// VOD.server.name == "sihua_3rd" 表示第三方VOD201413
                media.AV.play();    //hm3000 ，后来发的5205 没有发play了
                return 0;
            } else {
                return 1;
            }
            break;
        case 339:
            iPanel.debug("returnVideo_flag==" + returnVideo_flag);
            if (returnVideo_flag) {
                returnVideo(lpos, tpos, wpos, hpos);
                return 0;
            }
            return 1;
            break;

    }
}
function playVOD() {
    playUrl = movies[countFlag];
    iPanel.debug("playUrl==" + playUrl);
    modeChange(playUrl);
    if (countFlag >= movies.length - 1) {
        countFlag = 0;
    } else {
        countFlag++;
    }
//	alert(2);
    media.AV.open(playUrl, 'VOD');
}
//---------------切换模式----------------------
var serverModel = "IP";
function modeChange(rtsp_url) {
    if (typeof (rtsp_url) != "undefined") {
        if (rtsp_url.indexOf("2014") != -1) {
            serverModel = "DVB";
        } else {
            serverModel = "IP";
        }
    }
    if (serverModel == "IP") {
        var __providerName = hardware.STB.provider;
        if (__providerName.indexOf("2014") != -1) {//第三方VOD的点播模式切换
            VOD.changeServer("sihua_3rd", "ip");
        } else {
            VOD.changeServer("isma_v2", "ip");
        }
    } else {
        VOD.changeServer("isma_v2", "dvb");
    }
}

//------------------------------------------------------
function initMedia(_num1, _num2, _num3, _num4) {
//	alert(1);
    lpos = _num1;
    tpos = _num2;
    wpos = _num3;
    hpos = _num4;
    playVOD();
    //iPanel.Media.setPosition(_num1,_num2,_num3,_num4);
    setTimeout("Video()", 1500)
}

function Video() {
    returnVideo(lpos, tpos, wpos, hpos);
}

function fullScreen() {
    returnVideo_flag = true;
    iPanel.Media.setPosition(0, 0, 1280, 720);
    for (var i = 0; i < document.getElementsByTagName("div").length; i++) {
        document.getElementsByTagName("div")[i].style.visibility = "hidden";
    }
}

function returnVideo(_num1, _num2, _num3, _num4) {
    iPanel.Media.setPosition(_num1, _num2, _num3, _num4);
    returnVideo_flag = false;
    for (var i = 0; i < document.getElementsByTagName("div").length; i++) {
        document.getElementsByTagName("div")[i].style.visibility = "visible";
    }
}

function fullScreen_ss(_) {
    returnVideo_flag = true;
    var seekTime = media.AV.elapsed;
    iPanel.debug("key_event.js-------moviesIdStr==" + moviesId[countFlag - 1]);
    window.location.href = "/templates/iptvtest/runtime/default/template/ss2012/vodPlay_movies.jsp?moviesId=" + moviesId[countFlag];
}

//获取媒体总长度（单位 秒）
function getVideoAllTime(){
    var alltime = media.AV.duration;
    return alltime;
}

//定点播放
//theTime 格式为 hh:mm:ss 如media.AV.seek("00:20:20")
function videoSeek(theTime){
    media.AV.seek(theTime);
}

//获取当前播放的时间点 （单位秒）
function getVideoTime(){
    var time = media.AV.elapsed;
    return time;
}

//获取当前速度
function getVideoSpeed(){
	var videoSpeed = media.AV.speed;
	return videoSpeed;
}

//暂停或是播放
function playOrStop(){
	if(playStatus == 1){
		media.AV.pause();
		playStatus = 0;
	}else{
		media.AV.play();
		playStatus = 1;
	}
}

//暂停
function pause(){
	media.AV.pause();
	playStatus = 0;
}

//播放
function play(){
	media.AV.play();
	playStatus = 1;
}

//销毁视频资源
function destory(){
	media.AV.close();
}


//快进
function fastForward(){
	media.AV.forward();
}

//根据特定速度进行快进
function fastTimeForward(speedTime){
	var curVideoTime = getVideoTime();
	var allVideoTime = getVideoAllTime();
	if(parseInt(curVideoTime+speedTime) >= allVideoTime){
		curVideoTime = allVideoTime;
	}else{
		curVideoTime = parseInt(curVideoTime + speedTime);
	}
	videoSeek(formatTime(curVideoTime));
}

//快退
function fastRewind(){
	media.AV.backward();
}

//根据特定速度进行快退
function fastTimeRewind(speedTime){
	var curVideoTime = getVideoTime();
	var allVideoTime = getVideoAllTime();
	if(curVideoTime<=speedTime){
		curVideoTime = 0;
	}else{
		curVideoTime = parseInt(curVideoTime-speedTime);
	}
	videoSeek(formatTime(curVideoTime));
}

//音量增加
function volUp(){
	E.changeVolume(1);
}

//音量减少
function volDown(){
	E.changeVolume(-1);
}

/**
 *	格式化时间 
 */
function formatTime(x){
	hour = Math.floor(x/3600);
	x = x%3600;
	minute = Math.floor(x/60);
	second = x%60;
	if(hour==0) hour="00";
	if(minute==0){
		minute="00";
	}else if(minute<10){
		minute = "0"+minute;
	}
	if(second==0){
		second="00";
	}	
	else if(second<10){
		second = "0"+second;
	}
	return hour+":"+minute+":"+second;
}