<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="page-view-size" content="1280*720">
        <title></title>
        <script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
        <script type="text/javascript" src="/static/v1/common/js/play/play<?php echo ($areacode); ?>.js?20140208173232"></script>
        <style type="text/css">
            body{
                background:transparent;
                background-color: white;            	
            }
            #div_control{
                position:absolute;
                width:332px;
                height:85px;
                top:550px;
                left:474px;
                visibility:hidden;
                background-image: url(/static/v1/hd/images/play/handle_bg.png);
            }
            #div_img_lianxi{
                position:absolute;
                width:100px;
                height:65px;
                top:60px;
                left:100px;
                visibility:visible;
                background-image: url(/static/v1/hd/images/play/exercise_bg.png);            
            }
            #div_back{
                position:absolute;
                width:434px;
                height:287px;
                top:216px;
                left:423px;
                display:none;
                background-image: url(/static/v1/hd/images/play/back_bg.png);            	
            }
            #div_gift{
                position:absolute;
                width:669px;
                height:424px;
                top:148px;
                left:305px;
                display:none;
                background-image: url(/static/v1/hd/images/play/gift_bg.png);            	
            }
            #back_transparent_bg{
                position:absolute;
                width:1280px;
                height:720px;
                top:0px;
                left:0px;
                display:none;
            }
        </style>

        <script type="text/javascript">
        	var preFocus = '<?php echo ($preFocus); ?>';
            var buttons =
                    [
                        /*左边按钮*/
                        {id: 'btn_pre', name: '', action: 'prevPlay()', linkImage: '/static/v1/hd/images/play/btn_pre.png', focusImage: '/static/v1/hd/images/play/btn_pre_over.png', selectBox: '', left: '', right: 'btn_current', up: 'btn_exercise', down: ''},
                        {id: 'btn_current', name: '', action: '', linkImage: '/static/v1/hd/images/play/btn_current.png', focusImage: '/static/v1/hd/images/play/btn_current_over.png', selectBox: '', left: 'btn_pre', right: 'btn_next', up: 'btn_exercise', down: ''},
                        {id: 'btn_next', name: '', action: 'nextPlay()', linkImage: '/static/v1/hd/images/play/btn_next.png', focusImage: '/static/v1/hd/images/play/btn_next_over.png', selectBox: '', left: 'btn_current', right: '', up: 'btn_exercise', down: ''},
                        /*游戏练习*/
                        {id: 'btn_exercise', name: '', action: '', linkImage: '/static/v1/hd/images/play/btn_exercise.png', focusImage: '/static/v1/hd/images/play/btn_exercise_over.png', selectBox: '', left: '', right: '', up: '', down: 'btn_current'},
                    	/*返回弹窗上的按钮*/
                        {id: 'btn_see', name: '', action: 'closeBackDiv()', linkImage: '/static/v1/hd/images/play/btn_see.png', focusImage: '/static/v1/hd/images/play/btn_see_over.png', selectBox: '', left: '', right: '', up: '', down: 'btn_no_see'},
                        {id: 'btn_no_see', name: '', action: 'backUpPage()', linkImage: '/static/v1/hd/images/play/btn_no_see.png', focusImage: '/static/v1/hd/images/play/btn_no_see_over.png', selectBox: '', left: '', right: '', up: 'btn_see', down: ''},
                        /*收入囊中*/
                        {id: 'btn_get', name: '', action: 'getAndJump()', linkImage: '/static/v1/hd/images/play/btn_get.png', focusImage: '/static/v1/hd/images/play/btn_get_over.png', selectBox: '', left: '', right: '', up: '', down: ''},
                    ];
            
            //返回上一页
            function backUpPage(){
            	
            	back_url = "<?php echo get_back_url('Index/recommend',1);?>";
            	
            	if( back_url.indexOf("FreeZone") != -1 )//跳转到免费专区，并加preFocus参数
            	{
            		back_url = "<?php echo U('FreeZone/index');?>"+'?preFocus=' + preFocus;
            		window.location = back_url;
            	}
            	else if(back_url.indexOf("RecentlyWatch") != -1)
            	{
            		back_url = "<?php echo U('RecentlyWatch/index');?>"+'?preFocus=' + preFocus;
            		window.location = back_url;
            	}
            	else
            	{
            		window.location = "<?php echo get_back_url('Index/recommend',1);?>";
            	}
            	
            }

            /**
             * 显示播放控件
             */
            function showMenu(show)
            {
            	if(show){
            		G('div_control').style.visibility = 'visible';
                    Epg.Button.set('btn_current');
            	}else{
            		G('div_control').style.visibility = 'hidden';
                    Epg.Button.set('btn_exercise');
            	}
            }
            
            var award = <?php echo ($playData["awardInfo"]); ?>;
            var nextSection = '<?php echo ($playData["nextSection"]); ?>';
            
            var videoContent = 'rtsp://192.168.0.5:8554/videos/prog00000002a9417711000008654004.ts';//'<?php echo ($playData[content]); ?>';
            var prevUrl = '<?php echo ($playData[prevUrl]); ?>';
            var nextUrl = '<?php echo ($playData[nextUrl]); ?>';
            var libUrl = '<?php echo ($playData[libUrl]); ?>';
            var backUrl = "<?php echo get_back_url('Index/recommend',1);?>";
            var libId =	"<?php echo ($section['libId']); ?>";
            var timer = '';
            var curPlayTime;
            var totalPlayTime;
            var returnUrl = '';
            var haveWindow = false;
            
            window.onload = function() {
                Epg.btn.init('btn_exercise', buttons, true);
            }

            Epg.key.set({KEY_PLAY_PAUSE:"playOrStop()"});
            Epg.key.set({KEY_VOL_UP:"volUp()"});
            Epg.key.set({KEY_VOL_DOWN:"volDown()"});
            Epg.key.set({KEY_FAST_FORWARD:"fastForward()"});
            Epg.key.set({KEY_FAST_REWIND:"fastRewind()"});
            Epg.key.set({KEY_DINGWEI:"showDingwei()"});
            
            function fastForward1(){
            	if(G('div_back').style.display == 'block')return ;
            	//fastForward();
            }
            function fastRewind1(){
            	if(G('div_back').style.display == 'block')return ;
            	//fastRewind();
            }
            function closeBackDiv(){
            	G('div_back').style.display = 'none';
                Epg.Button.set('btn_exercise');
            }
            Epg.Button.defBack = function(){
            	if(haveWindow) return;
            	if(G('div_back').style.display == 'block'){
            		//resume();
            		G('btn_current').src="/static/v1/hd/images/play/btn_current_over.png";
            		buttons[1]['linkImage'] = '/static/v1/hd/images/play/btn_current.png';
            		buttons[1]['focusImage'] = '/static/v1/hd/images/play/btn_current_over.png';
                	G('div_back').style.display = 'none';
                    Epg.Button.set('btn_exercise');
            	}else{
                    //pause();
            		G('btn_current').src="/static/v1/hd/images/play/btn_current_stop_over.png";
            		buttons[1]['linkImage'] = '/static/v1/hd/images/play/btn_current_stop.png';
            		buttons[1]['focusImage'] = '/static/v1/hd/images/play/btn_current_stop_over.png';         		
            		G('div_back').style.display = 'block';
                    Epg.Button.set('btn_see');
            	}
            }
            
            Epg.Button.defAction = function(){
            	if(dingweistatus==1){
            		dingweistatus = 0;
                	G('div_diwei').style.display="none";
        			if((document.getElementById("dingweitime").value != '')){
        				var dingweitime = document.getElementById("dingweitime").value;
        				if(parseInt(dingweitime*60) <= alltime){
        					//playByTime(parseInt(dingweitime*60));
        				}
        			}
            	}else{
            		var url = G(Epg.btn.current.id).title;
            		if(url==''||url==null){
                		if(playStat=='play'){
                        	//pause();
                			if(timer!=''){
                				clearTimeout(timer);
                			}
                			G('btn_current').src="/static/v1/hd/images/play/btn_current_stop_over.png";
                			buttons[1]['linkImage'] = '/static/v1/hd/images/play/btn_current_stop.png';
                			buttons[1]['focusImage'] = '/static/v1/hd/images/play/btn_current_stop_over.png';
                		}else{
                			//resume();
                			if(timer!=''){
                				clearTimeout(timer);
                			}
                			timer = setTimeout("showMenu()", 3000);
                			G('btn_current').src="/static/v1/hd/images/play/btn_current_over.png";
                			buttons[1]['linkImage'] = '/static/v1/hd/images/play/btn_current.png';
                			buttons[1]['focusImage'] = '/static/v1/hd/images/play/btn_current_over.png';
                		}
            		}else{
            			Epg.jump(url);
            		}
            	}
            };
            
            function playOrStop(){
            	if(G('div_back').style.display == 'block')return ;
        		showMenu(true);
            	if(playStat=='play'){
                    //pause();
            		if(timer!=''){
            			clearTimeout(timer);
            		}
                    Epg.Button.set('btn_current');
            		G('btn_current').src="/static/v1/hd/images/play/btn_current_stop_over.png";
            		buttons[1]['linkImage'] = '/static/v1/hd/images/play/btn_current_stop.png';
            		buttons[1]['focusImage'] = '/static/v1/hd/images/play/btn_current_stop_over.png';
            	}else{
            		//resume();
            		if(timer!=''){
            			clearTimeout(timer);
            		}
            		timer = setTimeout("showMenu()", 3000);
            		G('btn_current').src="/static/v1/hd/images/play/btn_current_over.png";
            		buttons[1]['linkImage'] = '/static/v1/hd/images/play/btn_current.png';
            		buttons[1]['focusImage'] = '/static/v1/hd/images/play/btn_current_over.png';
            	}
            }
			
            var alltime = 0;
            var curtime = 0;
            var proCurTime = 0;
            var progress = 1;
            var dingweistatus = 0;
            var hidetime = 10;
            var width = 560;

            function timefunction(){
            	//alltime = getTotalTime();
            	alltime = 20;
            	document.getElementById("showAllTime").innerHTML = formatTime(alltime);
            	//curtime = getCurrentTime();
            	//if((curtime >= alltime) && (curtime != 0) && (alltime != 0)){
            		//destoryMP();
            	//    window.location =  next_url;
            	//}
            	document.getElementById("showCurTime").innerHTML = formatTime(curtime);
            	var fudu = width/alltime;
            	document.getElementById("dingweiimg").style.width = parseInt(curtime*fudu)+"px";
            	document.getElementById("dingweitip").style.left = (125 + parseInt(curtime*fudu))+"px";
            	proCurTime++;
            	if(progress == 1 && proCurTime>=hidetime){
            		hidetime = 10;
            		progress = 0;
            		proCurTime = 0;
            		dingweistatus = 0;
            		document.getElementById("dingweitime").blur();
                	G('div_diwei').style.display="none";
            	}
            }

            var timeFunctions;
            timeFunctions = setInterval("timefunction()",1000);
            
            function showDingwei(){
            	if(G('div_back').style.display == 'block')return ;
        		hidetime = 10;
        		dingweistatus = 1;
        		progress = 1;
        		proCurTime = 0;
            	G('div_diwei').style.display="block";
        		document.getElementById("dingweitime").focus();
            }
            
            function getAndJump(){
            	 window.location = "<?php echo U('Resource/getAndJump');?>?awardId="+award['id']+"&returnUrl="+returnUrl;
            }
            
        </script>    
    </head>
    <body>
        <a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>
        <!-- 页面左侧 -->
        <div id="div_control">
            <!-- 上一集 -->
            <div id="div_btn_pre" title="<?php echo ($playData['prevUrl']); ?>" style="position:absolute;width:28px;height:31px;left:50px;top:25px;z-index: 1000;">
                <img id="btn_pre" src="/static/v1/hd/images/play/btn_pre.png" width="28" height="31">
            </div>
            <!-- 播放暂停 -->
            <div id="div_btn_current" style="position:absolute;width:48px;height:49px;left:138px;top:14px;">
                <img id="btn_current" src="/static/v1/hd/images/play/btn_current.png" width="48" height="49">
            </div>
            <!-- 下一集 -->
            <div id="div_btn_next" title="<?php echo ($playData['nextUrl']); ?>" style="position:absolute;width:28px;height:31px;left:254px;top:25px;">
                <img id="btn_next" src="/static/v1/hd/images/play/btn_next.png" width="31" height="28">
            </div>
        </div>
        
		<div id="ppp" style="top: 100px;left: 100px;width: 100px;height: 100px;"></div>
		
        <?php if($section['libId'] != ''): ?><!-- 联系，课堂 -->
			<div id="div_img_lianxi"></div>
			<div id="div_btn_exercise" style="position:absolute;width:100px;height:65px;left:200px;top:60px;">
			    <img id="btn_exercise" title="" src="/static/v1/hd/images/play/btn_exercise.png" width="100" height="65">
			</div><?php endif; ?>
        
        <!-- 定位 -->
		<div id="div_diwei" style="display:none; position:absolute;top:630px;left:130px;z-index:1000;width: 1020px;height: 40px;">
			<img id="showprogress" style="position:absolute;top:0px;left:0px;z-index:-100;" src="/static/v1/hd/images/play/video_progress_bg.png" width="1020" height="40" />
			<div id="showCurTime" style="position:absolute;top:10px;left:10px; width:110px;height:20px;text-align:center;z-index:1000;font-size: 20px;color:#ffffff;"></div>
			<img id="dingweiimg" style="position:absolute;top:15px;left:140px;z-index:1000;" src="/static/v1/hd/images/play/video_progress.png" width="560" height="10"/>
			<img id="dingweitip"  style="position:absolute;top:8px;left:125px;z-index:1000;" src="/static/v1/hd/images/play/video_tip.png" width="24" height="24" />
			<div id="showAllTime" style="position:absolute;top:10px;left:710px; width:110px;height:20px;text-align:center;z-index:1000;font-size: 20px;color:#ffffff;"></div>
			<input type="text" id="dingweitime" style="position:absolute;top:3px;left:930px;width:60px;height:32px;line-height:32px;background-color:transparent;border:none;color:#784600;text-align:center;font-size:32px;z-index:1000;" value="23"/>
		</div>   
		
		<div id="back_transparent_bg"></div>
		
		<!-- 返回弹窗 -->
		<div id="div_back">
            <div id="div_btn_see" style="position:absolute;width:146px;height:56px;left:60px;top:55px;">
                <img id="btn_see" src="/static/v1/hd/images/play/btn_see.png" width="146" height="56">
            </div>
            <div id="div_btn_no_see" style="position:absolute;width:146px;height:56px;left:60px;top:130px;">
                <img id="btn_no_see" src="/static/v1/hd/images/play/btn_no_see.png" width="146" height="56">
            </div>
		</div>   
        
        <!-- 礼物弹窗 -->
        <div id="div_gift">
        	<img width="190" height="190" src="<?php echo get_upfile_url($awardInfo['imgUrl']);?>" style="position:absolute;top: 58px;left: 87px;"/>
        	<div id="div_btn_get" title="" style="position:absolute;width:166px;height:56px;left:335px;top:185px;">
            	<img id="btn_get" src="/static/v1/hd/images/play/btn_get.png" width="166" height="56">
        	</div>
        </div>
    </body>
</html>