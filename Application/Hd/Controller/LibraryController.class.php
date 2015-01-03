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
        $libId = 1;
        $answerList = D('Library','Logic')->queryLib(1,1);
        dump($answerList);exit;
        //题库类型 1为文字 2为图片

        $this->assign(array(
            'sectionId' => $libId,
            'answerList' => json_encode($answerList['content']),
        ));
        $this->display();
    }
    
    /*
     * 错选集
     */
    public function wrongAnthologyAct() {
        $topicId = I('topicId',1);
        $page = I('page',1);
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
            'topicId' => $topicId,
            'libList' => $libList,
            'questionList' => $questionList
        ));
        $this->display();
    }
    
    /*
     * 保存数据
     */
    public function saveLibAct() {
        if(IS_POST){
            $postData = I('postdata','');
            $countscore = I('countscore',0);
            $redgrown = I('redgrown',0);
            echo $postData;
            echo $countscore;
            echo $redgrown;
            //header("location:".U('SectionList/index'));
        }
        
    }
}