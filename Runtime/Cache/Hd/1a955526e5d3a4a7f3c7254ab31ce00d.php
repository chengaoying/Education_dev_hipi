<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="page-view-size" content="1280*720">
        <title></title>
        <!--<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>-->
        <script type="text/javascript" src="/static/v1/common/js/play/play<?php echo ($areacode); ?>.js?20140208173232"></script>
        <style type="text/css">
            body{ 
                background-image:url(/static/v1/hd/images/test/video/bj.jpg); 
            }

            #div_left{
                position:absolute;
                width:185px;
                height:720px;
                top:0px;
                left:0px;
                visibility:visible;
                background-image: url(/static/v1/hd/images/play/left_bg.png);
            }

            #div_top{
                position:absolute;
                width:1280px;
                height:150px;
                top:0px;
                left:0px;
                visibility:visible;
            }

        </style>

        <script type="text/javascript">
            var buttons =
                    [
                        /*左边按钮*/
                        {id: 'btn_pre', name: '', action: 'prevPlay()', linkImage: '/static/v1/hd/images/play/btn_pre.png', focusImage: '/static/v1/hd/images/play/btn_pre_over.png', selectBox: '', left: '', right: ['btn_preview', 'btn_lesson', 'btn_exercise'], up: 'btn_preview', down: 'btn_current'},
                        {id: 'btn_current', name: '', action: '', linkImage: '/static/v1/hd/images/play/btn_current.png', focusImage: '/static/v1/hd/images/play/btn_current_over.png', selectBox: '', left: '', right: ['btn_preview', 'btn_lesson', 'btn_exercise'], up: 'btn_pre', down: 'btn_next'},
                        {id: 'btn_next', name: '', action: 'nextPlay()', linkImage: '/static/v1/hd/images/play/btn_next.png', focusImage: '/static/v1/hd/images/play/btn_next_over.png', selectBox: '', left: '', right: ['btn_preview', 'btn_lesson', 'btn_exercise'], up: 'btn_current', down: ''},
                        /*上边按钮*/
                        {id: 'btn_preview', name: '', action: '', linkImage: '/static/v1/hd/images/play/btn_preview.png', focusImage: '/static/v1/hd/images/play/btn_preview_over.png', selectBox: '', left: ['btn_pre', 'btn_current', 'btn_next'], right: 'btn_lesson', up: '', down: ''},
                        {id: 'btn_lesson', name: '', action: '', linkImage: '/static/v1/hd/images/play/btn_lesson.png', focusImage: '/static/v1/hd/images/play/btn_lesson_over.png', selectBox: '', left: ['btn_preview', 'btn_pre', 'btn_current', 'btn_next'], right: 'btn_exercise', up: '', down: ''},
                        {id: 'btn_exercise', name: '', action: '', linkImage: '/static/v1/hd/images/play/btn_exercise.png', focusImage: '/static/v1/hd/images/play/btn_exercise_over.png', selectBox: '', left: ['btn_lesson', 'btn_preview', 'btn_pre', 'btn_current', 'btn_next'], right: '', up: '', down: ''},
                    ];

            //视频销毁
            function destory() {
                destoryMP();
            }

            /**
             * 左侧菜单滚动效果
             */
            function scrollMenu()
            {
                var curId = Epg.btn.current.id;
                if (curId != 'btn_pre' && curId != 'btn_current' && curId != 'btn_next')
                {
                    var divLeft = G('div_left');
                    var left = divLeft.style.left.replace("px", "")
                    if (left > -185)
                        left -= 20;
                    divLeft.style.left = left + "px";
                    //H('div_left');

                    /* var divTop = G('div_top');
                     divTop.style.top = "0px"; */
                }
                else
                {
                    var divLeft = G('div_left');
                    divLeft.style.left = "0px";
                    //S('div_left');

                    /* var divTop = G('div_top');
                     var top = divTop.style.top.replace("px", "") 
                     if(top > -150)
                     top -= 20;
                     divTop.style.top = top + "px"; */
                }
            }

            setInterval('scrollMenu()', 100);
            var videoContent = '<?php echo ($playData[content]); ?>';
            var prevUrl = '<?php echo ($playData[prevUrl]); ?>';
            var nextUrl = '<?php echo ($playData[nextUrl]); ?>';
            var backUrl = "<?php echo get_back_url('Index/recommend',1);?>";
            var initPlay = function() {
                play(videoContent, 1280, 720, 0, 0);
            }

            //自动播放
            var autoPlay = function() {
                //var curPlayTime = getCurrentTime();//获取当前播放时间
                //var totalPlayTime = getTotalTime();
                if ((curPlayTime >= totalPlayTime) && (curPlayTime != 0) && (totalPlayTime != 0)) {
                    if (nextUrl) {
                        window.location = nextUrl;
                    } else {
                        destory();
                        window.location = backUrl;
                    }
                }
            }

            //var timeAutoPlay;
            //timeAutoPlay = setInterval("autoPlay()",1000);


            window.onload = function() {
                initPlay();
                Epg.btn.init('btn_current', buttons, true);

            }

            window.onUnload = function() {
                //destoryMP();
            }

            /*
             //按键监控
             document.onkeypress = function(keyEvent){
             keyEvent = keyEvent ? keyEvent : window.event;
             var keyval = keyEvent.which ? keyEvent.which : keyEvent.keyCode;
             if ( keyval == 8 || keyval == -31){  //返回
             window.location = backUrl;
             } 	
             else if(keyval == 0x000D){
             mplay();
             }
             else if(keyval == 263 || keyval == 13){ //播放/暂停
             mplay();
             }
             else if(keyval == 270){ //停止
             pause();
             }
             else if(keyval == 260){ //音量-
             volDown();
             }
             else if(keyval == 259){ //音量+
             volUp();
             }
             else if(keyval == 264 || keyval == 39){ //快进
             fastForward(); 	 	 
             }
             else if(keyval == 265 || keyval == 37){ //快退
             fastRewind();
             }else{			 
             //window.location = backUrl;
             }
             }*/


        </script>    
    </head>
    <body onUnload="javascript:destory()" onLoad="javascript:initPlay()">
        <a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

        <!-- 页面左侧 -->
        <div id="div_left">
            <!-- 上一集 -->
            <div id="div_btn_pre" title="<?php echo ($playData['prevUrl']); ?>" style="position:absolute;width:135px;height:60px;left:35px;top:240px;">
                <img id="btn_pre" src="/static/v1/hd/images/play/btn_pre.png" width="125" height="50">
            </div>
            <!-- 正在学习 -->
            <div id="div_btn_current" style="position:absolute;width:135px;height:60px;left:35px;top:320px;">
                <img id="btn_current" src="/static/v1/hd/images/play/btn_current.png" width="125" height="50">
            </div>
            <!-- 下一集 -->
            <div id="div_btn_next" title="<?php echo ($playData['nextUrl']); ?>" style="position:absolute;width:135px;height:60px;left:35px;top:400px;">
                <img id="btn_next" src="/static/v1/hd/images/play/btn_next.png" width="125" height="50">
            </div>
        </div>

        <!-- 页面上方 -->
        <div id="div_top">
            <!-- 预习-->
            <div id="div_btn_preview" style="position:absolute;width:160px;height:60px;left:720px;top:50px;">
                <img id="btn_preview" src="/static/v1/hd/images/play/btn_preview.png" width="150" height="50">
            </div>
            <!-- 同步课堂-->
            <div id="div_btn_lesson" style="position:absolute;width:160px;height:60px;left:890px;top:50px;">
                <img id="btn_lesson" src="/static/v1/hd/images/play/btn_lesson.png" width="150" height="50">
            </div>
            <!-- 练习-->
            <?php if($section['libId'] != ''): ?><div id="div_btn_exercise" style="position:absolute;width:160px;height:60px;left:1060px;top:50px;">
                    <img id="btn_exercise" title="<?php echo U('Library/detail?sectionId='.$section['id'].'&topicId='.$section['topicId']);?>" src="/static/v1/hd/images/play/btn_exercise.png" width="150" height="50">
                </div><?php endif; ?>
        </div>
    </body>
</html>