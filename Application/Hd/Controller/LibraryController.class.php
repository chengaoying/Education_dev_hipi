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
        $topicId = I('topicId',0);
        $sectionId = I('sectionId',0);
        if(!$topicId || !$sectionId){
            $this->showMessage('参数错误');
        }
        $roleId = $this->role['id'];
        $answerList = D('Library','Logic')->queryLib($sectionId);
        if($answerList==null){
             $this->showMessage('题库不存在！',self::ICON_ERROR,'','Public:message');
        }
        //题库类型 1为文字 2为图片
        
        $this->assign(array(
            'roleId' => $roleId,
            'topicId' => $topicId,
            'sectionId' => $sectionId,
            'answerList' => json_encode($answerList['content']),
        ));
        $this->display();
    }
    
    /*
     * 错选集
     */
    public function wrongAnthologyAct() {
        $roleId = $this->role['id'];;
        $topicId = I('topicId',0);
        $sectionId = I('sectionId',0);  
        $index = I('index',1);
        if(!$topicId || !$sectionId){
            $this->showMessage('参数错误');
        }
        $s_page = (int)I('spage',1); //课时页数
        $s_pageSize = 7;
        
        $l_page = (int)I('lpage',1);//题目页数
        $l_pageSize = 6;
        
        $wrongLib = D('Library','Logic')->queryRoleWrongLib($roleId,$topicId,$sectionId,$s_page,$index,$s_pageSize,$l_page,$l_pageSize);
//         print_r($wrongLib);exit;
		if($wrongLib==null){
             $this->showMessage('题库不存在！',self::ICON_ERROR,'','Public:message');
		}
        $libList = $wrongLib['sectionList']['rows'];
        
        $imgPath = C('TMPL_PARSE_STRING.__' . strtoupper(C('PARENT_MODULE') . '__')) . '/images';
        $config = array(
            'p' => 'spage',
            'preId'=>'up',
            'nextId' => 'down',
            'preTop' => 550,
            'preLeft' => 100,
            'nextTop' => 550,
            'nextLeft' => 170,
            'preImg' => $imgPath .'/library/wrong_anthology/up.png',
            'nextImg' => $imgPath .'/library/wrong_anthology/down.png',
            'nowIsShow' => 0,
        );
        $s_html = get_pageHtml($wrongLib['sectionList']['total'], $s_pageSize, $config,array('topicId'=>$topicId,'sectionId'=>$sectionId,'index'=>1));
//         print_r($s_html);
        
        $questionList = $wrongLib['rows'];
        $config2 = array(
            'p' => 'lpage',
            'preId'=>'pre',
            'nextId' => 'next',
            'preTop' => 550,
            'preLeft' => 1000,
            'nowTop' => 550,
            'nowLeft' => 1030,
            'nextTop' => 550,
            'nextLeft' => 1130,
            'preImg' => $imgPath .'/library/wrong_anthology/pre.png',
            'nextImg' => $imgPath .'/library/wrong_anthology/next.png',
            'nowIsShow' => 1,
        );
        $l_html = get_pageHtml($wrongLib['total'], $l_pageSize, $config2,array('topicId'=>$topicId,'sectionId'=>$sectionId,'index'=>$index,'spage'=>$s_page));
        //print_r($libList);
        $this->assign(array(
            'topicId' => $topicId,
            'sectionId' => $sectionId,
            'libList' => $libList,
            'questionList' => $questionList,
            'score' => $wrongLib['score'],
            's_html' => $s_html['html'],
            'l_html' => $l_html['html'],
        	'index'=>$index,
        	's_page'=>$s_page,
        ));
        $this->display();
    }
    
    /*
     * 保存数据
     */
    public function saveLibAct() {
        if(IS_POST){
            $postData = I('postdata','');
            $postData = html_entity_decode($postData);
            $topicId = I('topicid',0);
            $sectionId = I('sectionid',0);
            $countScore = I('countscore',0);
            $redFlower = I('redflower',0);
            
            //echo $countscore;
            //echo $redgrown;
            $libData = json_decode($postData, true);
            $data['topicId'] = $topicId;
            $data['sectionId'] = $sectionId;
            $data['score'] = $countScore;
            $data['redFlower'] = $redFlower;
            $data['lib'] = $libData;
            $result = D('Library','Logic')->saveRoleLib($this->role['id'],$data);
            if($result['status'] == 1){
                $this->addFloatMessage('保存成功！',get_back_url('Index/recommend',1,0,1));
            }else{
                $this->showMessage('保存失败！');
            }
            
        }
        
    }
}