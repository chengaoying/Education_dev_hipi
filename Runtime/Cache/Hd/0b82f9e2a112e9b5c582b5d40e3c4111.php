<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="page-view-size" content="1280*720">
<title><?php echo ($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/static/v1/hd/css/common.css?20140208173232">
<script type="text/javascript" src="/static/v1/common/js/base.js?20140208173232"></script>
<style type="text/css">
.page td	{ height:26px; text-align:center;color:#fff;font-weight: 300; font-size:20px;}
.page .up	{ width:25px;}
.page .down	{ width:25px;}
.page .now	{ width:60px;}
body {background-color: transparent;}

#default_tip{
	position: absolute;
	top: 310px;
	left: 490px;
	width: 300px;
	height: 60px;
	color:#F8E391;
	text-align: center;
	line-height:30px;
	background-color:saddlebrown;
	visibility:hidden;
	z-index:99;
}

</style>
<script type="text/javascript">

<?php $floatMsg = Session('floatMessage'); Session('floatMessage',null); ?>

/* 弹窗信息  */
var popup = function(){
	var msg = "<?php echo ($floatMsg); ?>";
	Epg.tip(msg);
}

</script>

</head>
<body>

<style type="text/css">
    body{ background-image:url(/static/v1/hd/images/library/bg.jpg); }

    .title{
        position: absolute;
        top:120px;
        left:170px;
        width: 750px;
        height: 100px;
        color:#000;
        font-size: 22px;
        line-height: 45px;
        font-weight: 590;
    }
    /*弹窗*/

    .pop_bg{
        position:absolute;
        display: block;
        width:560px;
        height:357px;
        top:185px;
        left:350px;
        background-image:url(/static/v1/hd/images/library/pop_bg.png?);
        z-index: 1000;
    }
    /*获取多少分*/
    .countscore{
        position:absolute;
        display: block;
        width:100px;
        height:40px;
        line-height: 40px;
        top:270px;
        left:630px;
        color:#f65074;
        text-align: center;
        font-weight: 700;
        font-size: 34px;
        z-index: 1000;
    }

    /*答对多少题*/
    .correctnum{
        position:absolute;
        display: block;
        width:50px;
        height:20px;
        line-height: 20px;
        top:372px;
        left:450px;
        color:#f65074;
        text-align: center;
        font-weight: 600;
        font-size: 22px;
        z-index: 1000;
    }
    /*答错多少题*/
    .wrongnum{
        position:absolute;
        display: block;
        width:50px;
        height:20px;
        line-height: 20px;
        top:372px;
        left:595px;
        color:#f65074;
        text-align: center;
        font-weight: 600;
        font-size: 22px;
        z-index: 1000;
    }
    /*多少小红花*/
    .rednum{
        position:absolute;
        display: block;
        width:50px;
        height:20px;
        line-height: 20px;
        top:372px;
        left:745px;
        color:#f65074;
        text-align: center;
        font-weight: 600;
        font-size: 22px;
        z-index: 1000;
    }
</style>

<script type="text/javascript">

    var buttons =
            [
                /*文字答题选项*/
                {id: 'answer_1', name: '', action: 'answer(1)', linkImage: '/static/v1/hd/images/library/word_1.png', focusImage: '/static/v1/hd/images/library/word_1_over.png', selectBox: '', left: '', right: '', up: '', down:['answer_2','next']},
                {id: 'answer_2', name: '', action: 'answer(2)', linkImage: '/static/v1/hd/images/library/word_2.png', focusImage: '/static/v1/hd/images/library/word_5_over.png', selectBox: '', left: '', right: '', up: 'answer_1', down:['answer_3','next']},
                {id: 'answer_3', name: '', action: 'answer(3)', linkImage: '/static/v1/hd/images/library/word_3.png', focusImage: '/static/v1/hd/images/library/word_3_over.png', selectBox: '', left: '', right: '', up: 'answer_2', down:['answer_4','next']},
                {id: 'answer_4', name: '', action: 'answer(4)', linkImage: '/static/v1/hd/images/library/word_3.png', focusImage: '/static/v1/hd/images/library/word_4_over.png', selectBox: '', left: '', right: '', up: 'answer_3', down: 'next'},
                /*答题选项*/
                {id: 'answer2_1', name: '', action: 'answer(1)', linkImage: '', focusImage: '', selectBox: '/static/v1/hd/images/library/pic_item_bg_over.png', resize:'-1', left: '', right: 'answer2_2', up: '', down: 'next'},
                {id: 'answer2_2', name: '', action: 'answer(2)', linkImage: '', focusImage: '', selectBox: '/static/v1/hd/images/library/pic_item_bg_over.png', resize:'-1', left: 'answer2_1', right: ['answer2_3', 'next'], up: '', down: 'next'},
                {id: 'answer2_3', name: '', action: 'answer(3)', linkImage: '', focusImage: '', selectBox: '/static/v1/hd/images/library/pic_item_bg_over.png', resize:'-1', left: 'answer2_2', right: 'next', up: '', down: 'back'},
                /* 页码 */
                {id: 'pre', name: '', action: 'preAnswer()', linkImage: '/static/v1/hd/images/library/pre.png', focusImage: '/static/v1/hd/images/library/pre_over.png', selectBox: '', left: '', right: 'next', up: '', down: ''},
                {id: 'next', name: '', action: 'nextAnswer()', linkImage: '/static/v1/hd/images/library/next.png', focusImage: '/static/v1/hd/images/library/next_over.png', selectBox: '', left: 'pre', right: 'back', up: '', down: ''},
                /*返回*/
                {id: 'back', name: '', action: 'showdiv()', linkImage: '/static/v1/hd/images/library/back.png', focusImage: '/static/v1/hd/images/library/back_over.png', selectBox: '', right: '', left: 'next', up: '', down: ''},
                /*重新答题*/
                {id: 're_answer', name: '', action: 'reanswer()', linkImage: '/static/v1/hd/images/library/re_answer.png', focusImage: '/static/v1/hd/images/library/re_answer_over.png', selectBox: '', right: 'back_learn', left: '', up: '', down: ''},
                /*返回学习*/
                {id: 'back_learn', name: '', action: 'backlearn()', linkImage: '/static/v1/hd/images/library/back_learn.png', focusImage: '/static/v1/hd/images/library/back_learn_over.png', selectBox: '', right: '', left: 're_answer', up: '', down: ''},
            ];

    var postdata = [];
    var roleid = <?php echo ($roleId); ?>; //知识点ID
    var topicid = <?php echo ($topicId); ?>; //知识点ID
    var sectionid = <?php echo ($sectionId); ?>; //课时ID
    var answerlist = <?php echo ($answerList); ?>;
    var itemid; //题目ID
    var countscore = 0;//获取总分数
    var kind; //该题类型
    var score;//当前这道题的分数
    var correct;//定义当前这道题的正确答案
    var wrong;//定义用户选择的错误答案
    var theAnswer; //第几道题目
    var initButton; //题目类型
    var html;//显示的HTML
    var correctnum = 0;
    var wrongnum = 0;
    var rednum = 0;
    var status;
    var countlib = answerlist.length;

    function answer(i) {
        var data = {};
        
        if (i == correct) {
            wrong = 0;
            correct = i;
            correctnum += 1;
            countscore += score;
            status = true;
            if (kind == 'word') {
                G('div_error_' + i).style.display = "none";
                G('div_correct_' + i).style.display = "block";
            } else {
                G('div_error2_' + i).style.display = "none";
                G('div_correct2_' + i).style.display = "block";
            }

        } else {
            wrong = i;
            wrongnum += 1;
            status = false;
            if (kind == 'word') {
                G('div_correct_' + i).style.display = "none";
                G('div_error_' + i).style.display = "block";
            } else {
                G('div_correct2_' + i).style.display = "none";
                G('div_error2_' + i).style.display = "block";
            }
        }
        data = {'roleId': roleid, 'topicId': topicid, 'sectionId': sectionid, 'itemId': itemid, 'correct': correct, 'wrong': wrong, 'status': status};
        postdata.push(data);
        setTimeout("nextAnswer()", 1500);
    }
    //item是第几道题目
    function initAnswer(item) {
        theAnswer = item;
        G('now_page').innerHTML = theAnswer+'/'+countlib;
        html = '';
        var n = item - 1;

        //初始化标题
        G('title').innerHTML = answerlist[n]['title'];
        //初始化该道题答案
        correct = answerlist[n]['correct'];
        //初始化该题的分数
        score = answerlist[n]['score'];
        //初始化题目ID
        itemid = answerlist[n]['id'];

        var itemlist = answerlist[n]['itemList'];
        //该题是文字类型还是图片类型
        kind = answerlist[n]['kind'];
        if (kind == 'word') {
            //显示文字
            G('word').style.display = "block";
            G('pic').style.display = "none";
            //修改上下页和返回键的up值
            buttons[7]['up'] = ['answer_4', 'answer_3', 'answer_2', 'answer_1'];
            buttons[8]['up'] = ['answer_4', 'answer_3', 'answer_2', 'answer_1'];
            buttons[9]['up'] = ['answer_4', 'answer_3', 'answer_2', 'answer_1'];
            //初始化按钮
            initButton = 'answer_1';
            //alert(itemlist.length);
            //初始化各选项
            for (var i = 0; i < itemlist.length; i++) {
                var top = parseInt(280 + i * 70);
                var num = i + 1;
                html += '<div id="div_answer_' + num + '" title="" style="position:absolute;width:763px;height:50px;left:160px;top:' + top + 'px;text-align:center;">';
                html += '<img id="answer_' + num + '" src="/static/v1/hd/images/library/word_' + num + '.png" width="763" height="50">';
                html += '</div>';
                html += '<div id="div_answer_' + num + '_focus" title="" style="position:absolute;width:683px;height:50px;left:240px;top:' + top + 'px;z-index:999">';
                html += '<span id="answer_' + num + '_focus" style="display: block;height:50px;line-height: 50px;color:#000;font-size:22px;font-weight: 590;">' + itemlist[i] + '</span>';
                html += '</div>';
                html += '<div id="div_correct_' + num + '" style="display:none;position:absolute;width:41px;height:37px;left:870px;top:' + parseInt(top + 8) + 'px;z-index:999">';
                html += '<img id="correct_' + num + '" src="/static/v1/hd/images/library/success_1.png" width="41" height="37" />';
                html += '</div>';
                html += '<div id="div_error_' + num + '" style="display:none;position:absolute;width:41px;height:37px;left:870px;top:' + parseInt(top + 8) + 'px;z-index:999">';
                html += '<img id="error_' + num + '" src="/static/v1/hd/images/library/error_1.png"  width="41" height="37" />';
                html += '</div>';
            }

            G('word').innerHTML = html;
        } else {
            //显示图片

            G('pic').style.display = "block";
            G('word').style.display = "none";
            buttons[7]['up'] = 'answer2_1';
            buttons[8]['up'] = ['answer2_2', 'answer2_1'];
            buttons[9]['up'] = ['answer2_3', 'answer2_2', 'answer2_1'];
            //初始化按钮
            initButton = 'answer2_1';
            //初始化各选项
            for (var j = 0; j < itemlist.length; j++) {
                var left = parseInt(120 + j * 300);
                var num2 = j + 1;
                html += '<div id="div_answer2_' + num2 + '" title="" style="position:absolute;width:270px;height:283px;left:' + left + 'px;top:270px;text-align:center;z-index:999">';
                html += '<img id="answer2_' + num2 + '" src="' + itemlist[j] + '" width="270" height="283" />';
                html += '</div>';
                html += '<div id="div_answer2_' + num2 + '_focus" title="" style="position:absolute;width:270px;height:283px;left:' + left + 'px;top:270px;z-index:999">';
                html += '<img id="answer2_' + num2 + '_focus" src="/static/v1/hd/images/library/pic_item_bg.png" />';
                html += '</div>';
                html += '<div id="div_correct2_' + num2 + '" style="display:none;position:absolute;width:120px;height:109px;left:' + parseInt(left + 180) + 'px;top:450px;z-index:999">';
                html += '<img id="correct2_' + num2 + '" src="/static/v1/hd/images/library/success_2.png" width="120" height="109" />';
                html += '</div>';
                html += '<div id="div_error2_' + num2 + '" style="display:none;position:absolute;width:120px;height:109px;left:' + parseInt(left + 180) + 'px;top:450px;z-index:999">';
                html += '<img id="error2_' + num2 + '" src="/static/v1/hd/images/library/error_2.png"  width="120" height="109" />';
                html += '</div>';
            }
            //alert(html);
            G('pic').innerHTML = html;
        }
    }

    //上一题
    function preAnswer() {
        if (theAnswer > 1) {
            var item = theAnswer - 1;
            initAnswer(item);
            Epg.btn.set(initButton);
        }
    }

    //下一题
    function nextAnswer() {
        if (theAnswer == countlib) {
            showdiv();
        } else if (theAnswer < countlib) {
            var item = theAnswer + 1;
            initAnswer(item);
            Epg.btn.set(initButton);
        }
    }

//弹窗
    function showdiv() {
        G('pop_div').style.display = "block";
        G('countscore').innerHTML = countscore;
        G('correctnum').innerHTML = correctnum;
        G('wrongnum').innerHTML = wrongnum;
        rednum = parseInt(countscore/10);
        G('rednum').innerHTML = rednum;
        Epg.btn.set('re_answer')
    }

//重新答题
    function reanswer() {
        window.location.reload();
    }

//返回
    function backlearn() {
        var jsonText = JSON.stringify(postdata);
        G('post_data').value = jsonText;
        G('count_score').value = countscore;
        G('red_flower').value = rednum;
        G('postlib').submit();
    }
    window.onload = function()
    {
        initAnswer(1);
        Epg.btn.init(initButton, buttons, true);
    }
</script>

<!--返回-->
<a id="a_back" style="display:none;" href="<?php echo get_back_url('Index/recommend',1);?>" ></a>

<!-- 标题 -->
<div class="title" id="title"><?php echo ($title); ?></div>

<!-- 答题选项答案 -->
<div id="word" style="display:none"></div>

<div id="pic" style="display:none"></div>

<!-- 分页 -->

<!-- 上一页 -->
<div id="div_pre" style="position:absolute;width:63px;height:67px;left:430px;top:585px;text-align:center;">
    <img id="pre" src="/static/v1/hd/images/library/pre.png" width="63" height="67">
</div>

<!-- 页码 -->
<div id="now_page" style="position:absolute;width:100px;height:67px;line-height: 67px;left:500px;top:585px;font-size:30px;font-weight: 500;text-align:center;">
    
</div>

<!-- 下一页-->
<div id="div_next" style="position:absolute;width:63px;height:67px;left:610px;top:585px;text-align:center;">
    <img id="next" src="/static/v1/hd/images/library/next.png" width="63" height="67">
</div>

<!-- 返回按钮 -->
<div id="div_back" style="position:absolute;width:63px;height:67px;left:790px;top:585px;text-align:center;">
    <img id="back" src="/static/v1/hd/images/library/back.png" width="63" height="67">
</div>

<div id="pop_div" class="pop_div" style="display:none;">
    <!-- 背景 -->
    <div class="pop_bg"></div>
    <!-- 获取多少分 -->
    <div id="countscore" class="countscore">0</div>
    <!-- 答对多少题 -->
    <div id="correctnum" class="correctnum">0</div>
    <!-- 答错多少题 -->
    <div id="wrongnum" class="wrongnum">0</div>
    <!-- 获取多少小红花 -->
    <div id="rednum" class="rednum">0</div>
    <!-- 重新答题 -->
    <div id="div_re_answer" style="position:absolute;width:140px;height:50px;left:450px;top:460px;text-align:center;z-index: 1000;">
        <img id="re_answer" src="/static/v1/hd/images/library/re_answer.png" width="140" height="50">
    </div>
    <!-- 返回学习 -->
    <div id="div_back_learn" style="position:absolute;width:140px;height:50px;left:680px;top:460px;text-align:center;z-index: 1000;">
        <img id="back_learn" src="/static/v1/hd/images/library/back_learn.png" width="140" height="50">
    </div>
</div>
<form id="postlib" action="<?php echo U('Library/saveLib');?>" method="post">
    <input type="hidden" name="postdata" id="post_data" />
    <input type="hidden" name="topicid" id="topic_id" value="<?php echo ($topicId); ?>" />
    <input type="hidden" name="sectionid" id="section_id" value="<?php echo ($sectionId); ?>" />
    <input type="hidden" name="countscore" id="count_score" />
    <input type="hidden" name="redflower" id="red_flower" />
</form>    

<!-- 弹窗 -->
<div id="div_popup">
</div>

<!-- 默认的提示 -->
<div id="default_tip" class="default_tip">
</div>
</body>
</html>