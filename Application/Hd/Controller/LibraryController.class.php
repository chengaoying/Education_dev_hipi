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
    
    /*
     * 错选集
     */
    public function wrongAnthologyAct() {
        $selectLib = I('lib_id',1);
        $libList = array();
        $libList = array(
            array(
                'id' => 1,
                'name' => '第1课'
            ),
            array(
                'id' => 2,
                'name' => '第2课'
            ),
            array(
                'id' => 3,
                'name' => '第3课'
            ),
            array(
                'id' => 4,
                'name' => '第4课'
            ),
            array(
                'id' => 5,
                'name' => '第5课'
            ),
            array(
                'id' => 6,
                'name' => '第6课'
            ),
            array(
                'id' => 7,
                'name' => '第7课'
            ),
        );
        $questionList = array();
        $questionList = array(
            array(
                'id' => 1,
                'name' => '练习题目：下面小于5的是？',
                'correct'=>1,
                'myself'=>2
            ),
            array(
                'id' => 1,
                'name' => '练习题目：下面小于5的是？',
                'correct'=>1,
                'myself'=>2
            ),
            array(
                'id' => 1,
                'name' => '练习题目：下面小于5的是？',
                'correct'=>1,
                'myself'=>2
            ),
            array(
                'id' => 1,
                'name' => '练习题目：下面小于5的是？',
                'correct'=>1,
                'myself'=>2
            ),
            array(
                'id' => 1,
                'name' => '练习题目：下面小于5的是？',
                'correct'=>1,
                'myself'=>2
            ),
            array(
                'id' => 1,
                'name' => '练习题目：下面小于5的是？',
                'correct'=>1,
                'myself'=>2
            ),
        );
        $this->assign(array(
            'selectLib' => $selectLib,
            'libList' => $libList,
            'questionList' => $questionList
        ));
        $this->display();
    }
    
}