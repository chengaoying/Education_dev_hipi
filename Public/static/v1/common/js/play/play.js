
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
    var mediaStr = '[{mediaUrl:"' + playUrl + '",';
    mediaStr += 'mediaCode: "jsoncode1",';
    mediaStr += 'mediaType:2,';
    mediaStr += 'audioType:1,';
    mediaStr += 'videoType:1,';
    mediaStr += 'streamType:1,';
    mediaStr += 'drmType:1,';
    mediaStr += 'fingerPrint:0,';
    mediaStr += 'copyProtection:1,';
    mediaStr += 'allowTrickmode:1,';
    mediaStr += 'startTime:0,';
    mediaStr += 'endTime:20000.3,';
    mediaStr += 'entryID:"jsonentry1"}]';


    var playListFlag = 0; 			//Media Player 的播放模式。 0：单媒体的播放模式 (默认值)，1: 播放列表的播放模式
    var videoDisplayMode = 1; 		//MediaPlayer 对象对应的视频窗口的显示模式. 1: 全屏显示2: 按宽度显示，3: 按高度显示
    var muteFlag = 0; 				//0: 设置为有声 (默认值) 1: 设置为静音
    var subtitleFlag = 0; 			//字幕显示
    var videoAlpha = 0;				//视频的透明度
    var cycleFlag = 1;				//设置是否循环播放节目。0: 设置为循环播放（默认值）1：设置为单次播放
    var randomFlag = 0;				//否随机播放。0: 设置为随机播放（默认值）1：设置为随机播放
    var autoDelFlag = 0;
    var useNativeUIFlag = 1;
    //初始话mediaplayer对象
    mp.initMediaPlayer(
		instanceId,playListFlag,videoDisplayMode,
		height,width,left,top,muteFlag,useNativeUIFlag, 
		subtitleFlag,videoAlpha,cycleFlag,randomFlag,autoDelFlag
    );
    mp.setSingleMedia(mediaStr); 						//设置媒体播放器播放媒体内容
    mp.setVideoDisplayMode(1);
    mp.refreshVideoDisplay();
    mp.playFromStart();
}

/**
 * 视频播放
 */
function play(playUrl, width, height, left, top){
	initPlayer(playUrl, width, height, left, top);
	mp.play();	
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
	if(mp.getPlaybackMode().indexOf("pause")>0){
		resume();
		mp.play();
	}else{
		mp.pause();	
	}
	speed = 2;
}

/** 总时长 */
function getTotalTime(){
	return mp.getMediaDuration();
}

/** 当前时长 */
function getCurrentTime(){
	return mp.getCurrentPlayTime();
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
	mp.fastForward(speed);
	playStat = "kj"
}

/**
 * 快退
 */
function fastRewind(){  
	if(playStat!="kt") speed=1;
 	speed = speed * 2;
	if(speed > 32) speed = 2;
	mp.fastRewind(-speed);
	playStat = "kt"
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



