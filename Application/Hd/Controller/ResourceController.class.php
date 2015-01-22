<?php

/**
 * 控制器：单一资源
 *
 */

namespace Hd\Controller;

use Common\Controller\CommonController;

class ResourceController extends CommonController {

	private $award=array(3);
	
    public function playAct() {
        if (C('IS_ENV')) {
            $areacode = C('AREA_CODE');
        } else {
            $areacode = '';
        }
        $playUrl = C('RTSP_VIDEO_URL'); //流媒体ip地址
        $courseId = I('courseId', '');
        $sectionId = I('sectionId', '');
        $preSection = I('preSection','');
        $nextSection = I('nextSection','');
        $section = D('Section', 'Logic')->querySectionById($sectionId);
        //print_r($section);exit;
        $playList = array();
        if ($section['previewList']) {
            $playList = explode(',', $section['previewList']);
        }
        $lessonList = explode(',', $section['lessonList']);
        $playList = array_merge($playList, $lessonList); //将预习与课堂进行组合
        $playList = array_filter($playList); //去除数组中空值
        //print_r($playList);
        $playResourceData = D('Resource', 'Logic')->queryResourceList($playList, 'id,content,keyList');
//         print_r($playResourceData);
        $playResource = array();
        foreach ($playList as $value) {
            $playResource[] = array('id' => $value, 'content' => get_array_keyval($playResourceData, $value, 'id', 'content'));
        }
        //print_r($playResource);
        $videoId = I('videoId', '');
        if (!$videoId) {  //如果没有选择第一个视频
            $videoId = $playList[0];
        }
        //获取各地区播放预地址
        $areaPlayCode = 'getPlayCode' . $areacode;
        $playData = $this->getPlayList($areacode, $playUrl, $playResource, $videoId, $courseId, $sectionId, $section['topicId'], $section['libId'], $preSection, $nextSection);
        $playData['awardInfo'] =null;
		//if($playData['nextSection']==1){
			$awardNum = D('Award','Logic')->getResourceAward($this->award);
			if($awardNum){
				$awardInfo = D('Award','Logic')->getAwardInfo($awardNum);
				if($awardInfo['status']==1){
					$playData['awardInfo'] = json_encode($awardInfo['data']);
				}
			}
		//}
//         print_r($areaPlayCode);
        //将课时资源进行json格式化
        
        //添加浏览记录
        $browser['roleId'] = $this->role['id'];
        $browser['title'] = $section['name'];
        $browser['courseId'] = $courseId;
        $browser['topicId']  = $section['topicId'];
        $browser['sectionId']= $section['id'];
        $browser['keys'] = $playResourceData[0]['keyList'];
        $browser['type'] = 1;
        $res = D('BrowseRecord','Logic')->saveBrowseRecord($browser);

        $template = 'play' . $areacode;
        $this->assign(array(
            'areacode' => $areacode,
            'sectionId' => $sectionId,
            'section' => $section,
            'playData' => $playData,
        	'awardInfo'=>$awardInfo['data'],
        ));
        $this->display($template);
    }
    
    public function getAndJumpAct(){
		$user = unserialize(Session('user'));
		$userId = $user['id'];
    	$roleId = $this->role['id'];
    	$itemId = I('awardId','');
    	$returnUrl = I('returnUrl','');
    	dump($returnUrl);
    	$num = 1;
    	$info = "观看视频获取！";
    	$data = D('Award','Logic')->sendItem($userId,$roleId,$itemId,$num,$info);
    	header('location:'.$returnUrl);
    	exit;
    }

    /*
     * 获取各地区的播放资源列表以及当前播放哪个视频
     */

    protected function getPlayList($areacode, $playUrl, $playResource, $videoId, $courseId, $sectionId, $topicId, $libId, $preSection, $nextSection) {
    	
    	if (empty($playUrl) || !$playResource)
            return;
        $areaCodeFun = 'getPlayCode' . $areacode;
        $playData = array();
        $playData['content'] = $this->$areaCodeFun($playUrl, $playResource, $videoId);
        foreach ($playResource as $key => $value) { //通过以下循环获取上一集地址和下一集地址
            if ($value['id'] == $videoId) {
                if ($key > 0) {
                    $playData['prevUrl'] = U('Resource/play', array('courseId'=>$courseId, 'sectionId' => $sectionId, 'videoId' => $playResource[$key - 1]['id']));
                } else {
                    if ($preSection) {
                        $playData['prevUrl'] = U('Section/index', array('courseId'=>$courseId,'sectionId' => $preSection));
                    } else {
                        $playData['prevUrl'] = '';
                    }
                }
                if ($key < (count($playResource) - 1)) {
                    $playData['nextUrl'] = U('Resource/play', array('courseId'=>$courseId,'sectionId' => $sectionId, 'videoId' => $playResource[$key + 1]['id']));
                } else {
                    $playData['nextSection'] = 1;
                    if ($libId) {//判断是否有预习题目
                        $playData['libUrl'] = U('Library/detail', array('courseId'=>$courseId,'sectionId' => $sectionId, 'topicId' => $topicId));
                    }
                    if ($nextSection) {
                        $playData['nextUrl'] = U('Section/index', array('courseId'=>$courseId,'sectionId' => $nextSection));
                    } else {
                        $playData['nextUrl'] = '';
                    }
                }
            }
        }
        return $playData;
    }

    /*
     * 本地测试
     * @param string $playUrl rstp流媒体地址
     * @param array $playResource 该课时所有的视频资源列表
     * @param int $videoId 当前视频ID
     */

    protected function getPlayCode($playUrl, $playResource, $videoId) {
        $content = '';
        foreach ($playResource as $value) {
            if ($value['id'] == $videoId) {
                $content = $playUrl . '/' . $value['content'] . '.ts';
                break;
            }
        }
        return $content;
    }

    /*
     * 天津地区(80027)
     */

    protected function getPlayCode80027($playUrl, $playUrl, $playResource, $videoId) {
        $content = '';
        foreach ($playResource as $value) {
            if ($value['id'] == $videoId) {
                $content = $playUrl . '/' . $value['content'] . '^^^?&startTime=&endTime=&productId=&sessionId=0&urlEndTime=20130328T105323Z&sessionSign=093f8041fc755864fccab72ed2cd949c&displayName=&provider=coship';
                break;
            }
        }
        return $content;
    }

}
