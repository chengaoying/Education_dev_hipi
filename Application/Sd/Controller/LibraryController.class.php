<?php

/**
 * 控制器：练习题库
 * @author CGY
 *
 */

namespace Sd\Controller;
use Common\Controller\CommonController;

class LibraryController extends CommonController {
	
    /*
     * 单一题目
     */
	public function detailAct() {
    	//get_back_url('Index/recommend',1);
        $courseId = I('courseId',0);
        $sectionId = I('sectionId',0);
        
        //根据是否有视频播放，生成答题页面的退出地址
        $isExistVideo = I('isExistVideo','true');
        //dump($isExistVideo);
        if($isExistVideo == 'true')
        {
        	$exit_url = get_back_url('Index/recommend',1,0,1);
        }
        else 
        {
        	$exit_url = get_back_url('Index/recommend',1,0,0);
        }
        if(!$courseId || !$sectionId){
            $this->showMessage('参数错误');
        }
        $section = D('Section', 'Logic')->querySectionById($sectionId);
        $roleId = $this->role['id'];
        //读题库，将题库excel中内容读到内存中，存放在$answerList变量中
        $answerList = D('Library','Logic')->queryLib($sectionId);
        if($answerList['status']==0){
			$this->addFloatMessage('题库不存在！',get_back_url('Index/recommend',1));
        }
        
        //过滤$answerList中字符
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
        	'isExistVideo'=>$isExistVideo,
        	'exit_url'=>$exit_url,	
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
        $l_index = I('l_index',1);
        if(!$courseId){
            $this->showMessage('参数错误');
        }
        $s_page = (int)I('spage',1); //课时页数
        $s_pageSize = 7;
        
        $l_page = (int)I('lpage',1);//题目页数
        $l_pageSize = 6;
        
        $wrongLib = D('Library','Logic')->queryRoleWrongLibs($roleId,$courseId,$sectionId,$s_page,$index,$s_pageSize,$l_page,$l_pageSize);
		//p($wrongLib);exit;
		if($wrongLib==null){
			$this->addFloatMessage('该课程暂时还没有错题集！',get_back_url('Index/recommend',1));
		}
		
		foreach ($wrongLib['rows'] as $key=>$value){
        	$wrongLib['rows'][$key]['title'] = str_replace(array('|','Ω'),array('。',''),$value['title']);
		}
		
        $libList = $wrongLib['sectionList']['rows'];
        if(empty($sectionId)){
        	$sectionId = $libList[0]['sectionId'];
        }
        $imgPath = C('TMPL_PARSE_STRING.__' . strtoupper(C('PARENT_MODULE') . '__')) . '/images';
        $config = array(
            'p' => 'spage',
            'preId'=>'up',
            'nextId' => 'down',
            'preTop' => 125,
            'preLeft' => 90,
            'nextTop' => 450,
            'nextLeft' => 85,
            'preImg' => $imgPath .'/library/wrong_anthology/up.png',
            'nextImg' => $imgPath .'/library/wrong_anthology/down.png',
            'nowIsShow' => 0,
        );
        $s_html = get_pageHtml($wrongLib['sectionList']['total'], $s_pageSize, $config,array('courseId'=>$courseId,'sectionId'=>$sectionId,'index'=>$index));
//         print_r($s_html);
        $pageCount = ceil($wrongLib['sectionList']['total']/$s_pageSize);
        $questionList = $wrongLib['rows'];
        
        $l_pageCount = ceil($wrongLib['total']/$l_pageSize);
        $l_html = get_page_html($l_page, $l_pageCount);
        $course = D('Course','Logic')->queryCourseById($courseId);
        $this->assign(array(
        	'courseName' =>$course['name'],
            'courseId' => $courseId,
            'sectionId' => $sectionId,
            'libList' => $libList,
            'questionList' => $questionList,
            'score' => $wrongLib['score'],
            's_html' => $s_html['html'],
            'l_html' => $l_html,
        	'index'=>$index,
        	's_page'=>$s_page,
        	'pageCount'=>$pageCount,
        	'l_pageCount'=>$l_pageCount,
        	'l_page'=>$l_page,
        	'focus'		=> I('focus',''),
        	'preFocus'  => I('preFocus','wrong_1'),
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
                //$this->addFloatMessage('保存成功！',$exit_url);
            }else{
                $this->showMessage('保存失败！');
            }
            
        }
        
    }
}