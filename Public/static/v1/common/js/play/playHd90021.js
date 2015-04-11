var mp = new MediaPlayer();
var vas_small_player_id = mp.getNativePlayerInstanceID();

//播放暂停标记
var playStat = 'play';
//静音标记
var muteFlag = 0;
var muteValue = 0;

function playVideo(videoUrl,width,height,left,top) {
	  if (videoUrl == "") {
	        return;
	  }
	  var jsonstr = '[{mediaUrl:"' + videoUrl + '",';
	  jsonstr +=  'mediaCode: "jsoncode1",';//字符串媒体的唯一标示-武
	  jsonstr +=  'mediaType:2,';
	  jsonstr +=  'audioType:1,';
	  jsonstr +=  'videoType:1,';
	  jsonstr +=  'streamType:1,';
	  jsonstr +=  'drmType:1,';
	  jsonstr +=  'fingerPrint:0,';
	  jsonstr +=  'copyProtection:1,';
	  jsonstr +=  'allowTrickmode:1,';
	  jsonstr +=  'startTime:0,';
	  jsonstr +=  'endTime:20000.3,';
	  jsonstr +=  'entryID:"jsonentry1"}]';//可能出问题-武-只有在加入播放列表时媒体的唯一标示
	  speed = 1;
	  playStat = "play";
	  initMediaPlay(width,height,left,top);
	  mp.setSingleMedia(jsonstr);
	  mp.setNativeUIFlag(0);
	  mp.setMuteUIFlag(1);//xjadd
	  mp.setAllowTrickmodeFlag(0);//允许快进快退操作
	  mp.playFromStart();
	  mp.setVideoDisplayMode(1); 
	  mp.refreshVideoDisplay();
}

//初始化播放实例
function initMediaPlay(width,height,left,top){
    var playListFlag = 0;
    var videoDisplayMode = 0;
    var muteFlag = 0;
    var subtitleFlag = 0;
    var videoAlpha = 0;
    var cycleFlag = 1;//循环播放
    var randomFlag = 0;
    var autoDelFlag = 0;
    var useNativeUIFlag = 1;
    var instanceId = 2;
   //初始化数据
    mp.initMediaPlayer(vas_small_player_id, playListFlag, videoDisplayMode, height, width, left, top, muteFlag, useNativeUIFlag, subtitleFlag, videoAlpha, cycleFlag, randomFlag, autoDelFlag);
}

//暂停or播放
function resumeOrPause(){
  if(playStat=='play'){
	playStat='pause';
    mp.pause();
  }else{
	playStat='play';
    mp.resume();
  }
}

//获取视频总长
function getTotalTime(){
  return parseInt(mp.getMediaDuration()) ; 
}
//获取当前时间
function getCurTime(){
  return parseInt(mp.getCurrentPlayTime()); 
}
//快进
function videoFast(){
  var nowTime = getCurTime();
  var total = getVidDur(); 
  var jumpTime;
  
  if(nowTime+20>=total){
	  jumpTime=total-1;
  }else{
	  jumpTime = nowTime+20;
  }
  mp.playByTime(1,jumpTime);
}
//快退
function videoBackward(){
  var nowTime = getCurTime();
  var jumpTime;
  if(nowTime-20<=0){
      jumpTime=0;
  }else{
    jumpTime = nowTime-20;
  }
  mp.playByTime(1,jumpTime);
}

//静音
function volMuted(){
  if(muteFlag==0){
    muteValue = mp.getVolume();
    mp.setVolume(0);
    muteFlag=1;
  }else{
    mp.setVolume(muteValue);
    muteFlag=0;
  }
}
//音量加
function volUp(){
  var soundValue = mp.getVolume();
  if(soundValue<100){
    mp.setVolume(soundValue+10);
  }
}
//音量减
function volDown(){
  var soundValue = mp.getVolume();
  if(soundValue>9){
    mp.setVolume(soundValue-10);
  }
}

//销毁播放实例
function destoryMP() {
  if (mp) {
        mp.stop();
  if(vas_small_player_id>=0){
    mp.releaseMediaPlayer(vas_small_player_id);
    vas_small_player_id = -1;
  }
}

//时间格式化  
function timeFormat(time){
  var minute =parseInt( time/60);
  var second = time%60;
  if(minute<10){
	minute = "0"+minute;
  }
  if(second<10){
    second = "0"+second;
  }
  return minute+":"+second;
}  