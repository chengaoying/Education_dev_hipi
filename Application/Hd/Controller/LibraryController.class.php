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
    	get_back_url('Index/recommend',1);
        $courseId = I('courseId',0);
        $sectionId = I('sectionId',0);
        if(!$courseId || !$sectionId){
            $this->showMessage('参数错误');
        }
        $section = D('Section', 'Logic')->querySectionById($sectionId);
        $roleId = $this->role['id'];
        $answerList = D('Library','Logic')->queryLib($sectionId);
        
        if($answerList['status']==0){
             $this->showMessage('题库不存在！',self::ICON_ERROR,'','Public:message');
        }
        foreach($answerList['content'] as $key=>$value){
        	$value['title'] = str_replace(array('|','Ω'),array('<br>','<br>'),$value['title']);
        	$answerList['content'][$key]['title'] = $value['title'];
        	foreach ($value['itemList'] as $key1=>$value1){
        		$itemList[] = str_replace(array('~','^'),array('<u>','</u>'),$value1);
        	}
        	$answerList['content'][$key]['itemList'] = $itemList;
        	unset($itemList);
        }
        //题库类型 1为文字 2为图片
        
        $this->assign(array(
            'roleId' => $roleId,
            'courseId' => $courseId,
            'sectionId' => $sectionId,
        	'sectionName'=>$section['name'],
            'answerList' => json_encode($answerList['content']),
        ));
        $this->display();
    }
    
    /*
     * 错选集
     */
    public function wrongAnthologyAct() {
        $roleId = $this->role['id'];;
        $courseId = I('courseId',0);
        $sectionId = I('sectionId',0);  
        $index = I('index',1);
        if(!$courseId){
            $this->showMessage('参数错误');
        }
        $s_page = (int)I('spage',1); //课时页数
        $s_pageSize = 7;
        
        $l_page = (int)I('lpage',1);//题目页数
        $l_pageSize = 6;
        
        $wrongLib = D('Library','Logic')->queryRoleWrongLibs($roleId,$courseId,$sectionId,$s_page,$index,$s_pageSize,$l_page,$l_pageSize);
        
		if($wrongLib==null){
             $this->showMessage('题库不存在！',self::ICON_ERROR,'','Public:message');
		}
		
		foreach ($wrongLib['rows'] as $key=>$value){
        	$wrongLib['rows'][$key]['title'] = str_replace(array('|','Ω'),array('。',''),$value['title']);
		}
		
        $libList = $wrongLib['sectionList']['rows'];
        
        $imgPath = C('TMPL_PARSE_STRING.__' . strtoupper(C('PARENT_MODULE') . '__')) . '/images';
        $config = array(
            'p' => 'spage',
            'preId'=>'up',
            'nextId' => 'down',
            'preTop' => 575,
            'preLeft' => 100,
            'nextTop' => 575,
            'nextLeft' => 170,
            'preImg' => $imgPath .'/library/wrong_anthology/up.png',
            'nextImg' => $imgPath .'/library/wrong_anthology/down.png',
            'nowIsShow' => 0,
        );
        $s_html = get_pageHtml($wrongLib['sectionList']['total'], $s_pageSize, $config,array('courseId'=>$courseId,'sectionId'=>$sectionId,'index'=>1));
//         print_r($s_html);
        
        $questionList = $wrongLib['rows'];
        $config2 = array(
            'p' => 'lpage',
            'preId'=>'pre',
            'nextId' => 'next',
            'preTop' => 570,
            'preLeft' => 1020,
            'nowTop' => 566,
            'nowLeft' => 1030,
            'nextTop' => 570,
            'nextLeft' => 1115,
            'preImg' => $imgPath .'/common/page/page_prev.png',
            'nextImg' => $imgPath .'/common/page/page_next.png',
            'nowIsShow' => 1,
        );
        $l_html = get_pageHtml($wrongLib['total'], $l_pageSize, $config2,array('courseId'=>$courseId,'sectionId'=>$sectionId,'index'=>$index,'spage'=>$s_page));
        //print_r($libList);
        $this->assign(array(
            'courseId' => $courseId,
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
            //$postData = html_entity_decode($postData);
            $courseId = I('courseid',0);
            $sectionId = I('sectionid',0);
            $countScore = I('countscore',0);
            $redFlower = I('redflower',0);
            //$libData = json_decode($postData, true);
            
            $temp = explode('@',$postData);
            foreach ($temp as $key=>$value){
            	$temp1 = explode('|',$value);
            	$libData[$key][$temp1[0]] = $temp1[1];
            	$libData[$key][$temp1[2]] = $temp1[3];
            	$libData[$key][$temp1[4]] = $temp1[5];
            	$libData[$key][$temp1[6]] = $temp1[7];
            	$libData[$key]['roleId'] = $this->role['id'];
            	$libData[$key]['courseId'] = $courseId;
            	$libData[$key]['sectionId'] = $sectionId;
            }
            $data['courseId'] = $courseId;
            $data['sectionId'] = $sectionId;
            $data['score'] = $countScore;
            $data['redFlower'] = $redFlower;
            $data['lib'] = $libData;
            $result = D('Library','Logic')->saveRoleLib($this->role['id'],$data);
            if($result['status'] == 1){
            	$this->role['point'] = (int)$this->role['point']+(int)$data['redFlower'];
            	Session('role',serialize($this->role));
                $this->addFloatMessage('保存成功！',get_back_url('Index/recommend',1,0,1));
            }else{
                $this->showMessage('保存失败！');
            }
            
        }
        
    }
}