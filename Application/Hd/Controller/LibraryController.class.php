<?php

/**
 * 控制器：练习题库
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class LibraryController extends CommonController {
	
    /*
     * 单一题目
     */
	public function detailAct() {
        $libId = I('id',0);
        if(!$libId){
            //$this->showMessage('参数错误');
        }
        $title = '实得分上的阿萨德飞的身份是的范德萨的所发生的实得分上的阿萨德飞的身份是的范德萨的所发生的实得分上的阿萨德飞的';
        //题库类型 1为文字 2为图片
        $libType = 2; //题型
        $correct = 1; //正确答案
        switch ($libType) {
            case 1: //文字类型
                $template = 'lib_word';
                $answerList = array(
                    array(
                        'id' => 1,
                        'title' => '实得分上的范德萨发是',
                    ),
                    array(
                        'id' => 2,
                        'title' => '实得分上的范德萨发是',
                    ),
                    array(
                        'id' => 3,
                        'title' => '实得分上的范德萨发是',
                    ),
                    array(
                        'id' => 4,
                        'title' => '实得分上的范德萨发是',
                    ),
                );
                break;
            case 2: //图片类型
                $template = 'lib_pic';
                $answerList = array(
                    array(
                        'id' => 1,
                        'title' => '实得分上的范德萨发是',
                        'linkImage' => get_upfile_url('__HD__/images/library/pic_1.png')
                    ),
                    array(
                        'id' => 1,
                        'title' => '实得分上的范德萨发是',
                        'linkImage' => get_upfile_url('__HD__/images/library/pic_2.png')
                    ),
                    array(
                        'id' => 1,
                        'title' => '实得分上的范德萨发是',
                        'linkImage' => get_upfile_url('__HD__/images/library/pic_3.png')
                    ),
                );
                break;
            default:
                break;
        }
        $this->assign(array(
            'title' => $title,
            'answerList' => $answerList,
            'correct' => $correct
        ));
        $this->display($template);
    }
    
}