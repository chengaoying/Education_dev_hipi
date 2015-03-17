
/**
 * 天津专区按键
 */
var KEY_PLAY_PAUSE = 13;//播放或是暂停
var KEY_VOL_UP = 4;//音量加大
var KEY_VOL_DOWN = 3; //音量减少
var KEY_FAST_FORWARD = 373; //快进
var KEY_FAST_REWIND = 372; //快退



var mp; 
var instanceId;
try {
	mp = new MediaPlayer(); //新建一个mediaplayer对象
    instanceId = mp.getNativePlayerInstanceID(); //读取本地的媒体播放实例的标识
} catch (e) {
}

var speed = 1;
var playStat = "play";

/**
*初始话mediaPlay对象
*/
function initPlayer(playUrl, width, height, left, top) {

    mp.setAllowTrickmodeFlag(0); 						//设置是否允许trick操作。 0:允许 1：不允许
    mp.setMuteFlag(0);
	mp.setSingleMedia(playUrl); 						//设置媒体播放器播放媒体内容
	mp.setCurrentAudioChannel("Stereo");
	mp.setVideoDisplayArea(left, top, width, height);
	mp.setVideoDisplayMode(0);
    mp.refreshVideoDisplay();
	mp.playFromStart();
}

/**
 * 视频播放
 */
function play(playUrl, width, height, left, top){
	initPlayer(playUrl, width, height, left, top);
}

/**
 * 停止播放
 */
function destoryMP() {
    mp.stop();
}

function track(){
	mp.switchAudioTrack();
}

function pauseOrPlay() {
	if(playStat == "play"){
		pause();
	}
	else{
		resume();
	}
}
	
function pause(){
	speed = 1;
	playStat = "pause";
	mp.pause();
}


function resume(){
	speed = 1;
	playStat = "play";
	mp.resume();
}

function mplay(){ //播放/暂停
	if(mp.getPlaybackMode().indexOf("Pause")>0){
		resume();
		mp.play();
	}else{
		mp.pause();	
	}
	speed = 2;
}

/** 总时长 */
function getTotalTime(){
	return 1900;
	//return mp.getMediaDuration();
}

/** 当前时长 */
function getCurrentTime(){
	return 1600;
	//return mp.getCurrentPlayTime();
}

function playByTime(bytime){
	return mp.playByTime(1,bytime,0);
}

var astate = 1;
function volUp(){ //音量+
   clearTimeout(astate);
	var vol =mp.getVolume();
	if(vol <=95){
		vol = vol+5;
		mp.setVolume(vol);
	}
}
function volDown(){ //音量-
    clearTimeout(astate);	 
    var vol =mp.getVolume();
	if(vol >=5){
		vol = vol-5;
		mp.setVolume(vol);
	}
}

/**
 * 跳至视频片尾
 */
function end(){
	mp.gotoEnd();
}

/**
 * 跳至视频片头
 */
function start(){
	mp.gotoStart()
}

/**
 *	异常处理 
 */
function goUtility(url){
    eval("eventJson = " + Utility.getEvent());
    var typeStr = eventJson.type;
    switch(typeStr){	
        case "EVENT_MEDIA_ERROR":
            mediaError(eventJson);
            return false;
	    case "EVENT_MEDIA_END":
	    	window.location = url;
            return false;
        default :
            break;
    }
    return true;
}

/**
 * 快进
 */
function fastForward(){  
	if(playStat!="kj") speed=1;
	speed = speed * 2;
	if(speed > 32) speed = 2;
	playStat = "kj";
	mp.fastForward(speed);
	
}

/**
 * 快退
 */
function fastRewind(){  
	if(playStat!="kt") speed=1;
 	speed = speed * 2;
	if(speed > 32) speed = 2;
	playStat = "kt";
	mp.fastRewind(-speed);
	
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



