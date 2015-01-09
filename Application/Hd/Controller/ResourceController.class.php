<?php

/**
 * 控制器：单一资源
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class ResourceController extends CommonController {
	
    public function playAct() {
        if(C('IS_ENV')){
            $areacode = C('AREA_CODE');
        }else{
            $areacode = '';
        }
        $playUrl = C('RTSP_VIDEO_URL');//流媒体ip地址
        
        
    	$sectionId = I('sectionId','');
    	
    	$library = D('Library','Logic')->queryLibraryInfo($sectionId);
    	$section = D('Section','Logic')->querySectionById($sectionId);
//         print_r($library);exit;
        $playList = array();
        if($section['previewList']){
            $playList = explode(',', $section['previewList']);
        }
        $lessonList = explode(',', $section['lessonList']);
        $playList = array_merge($playList,$lessonList); //将预习与课堂进行组合
        $playList = array_filter($playList); //去除数组中空值
//         print_r($playList);
        $playResource = D('Resource','Logic')->queryResourceList($playList,'id,content');
//         print_r($playResource);
        
        $videoId = I('videoId','');
        if(!$videoId){  //如果没有选择第一个视频
            $videoId = $playList[0];
        }
        //获取各地区播放预地址
        $areaPlayCode = 'getPlayCode'.$areacode;
        $playData = $this->getPlayList($areacode,$playUrl,$playResource,$videoId,$sectionId,$section['topicId'],$section['libId'],$preSection,$nextSection);
        
//         print_r($areaPlayCode);
        //将课时资源进行json格式化
        
    	$template = 'play'.$areacode;
        $this->assign(array(
            'areacode' 	=> $areacode,
        	'sectionId'	=> $sectionId,
            'section' => $section,
            'playData' => $playData,
        	'library' => $library,
        ));
        $this->display($template);
    }
    
    /*
     * 获取各地区的播放资源列表以及当前播放哪个视频
     */
    protected function getPlayList($areacode,$playUrl,$playResource,$videoId,$sectionId,$topicId,$libId,$preSection,$nextSection){
        if(empty($playUrl) || !$playResource) return;
        $areaCodeFun = 'getPlayCode'.$areacode;
        $playData = array();
        $playData['content'] = $this->$areaCodeFun($playUrl,$playResource,$videoId);
        foreach ($playResource as $key => $value) { //通过以下循环获取上一集地址和下一集地址
            if($value['id'] == $videoId){
                if($key > 0){
                    $playData['prevUrl'] = U('Resource/play',array('sectionId'=>$sectionId,'videoId'=>$playResource[$key-1]['id']));
                    if($key < (count($playResource)-1)){
                        $playData['nextUrl'] = U('Resource/play',array('sectionId'=>$sectionId,'videoId'=>$playResource[$key+1]['id']));
                    }else{
                        if($libId){//判断是否有预习题目
                            $playData['nextUrl'] = U('Library/detail',array('sectionId'=>$sectionId,'topicId'=>$topicId));
                        }else{
                            if($nextSection){
                                $playData['nextUrl'] = U('Resource/play',array('sectionId'=>$nextSection));
                            }else{
                                $playData['nextUrl'] = '';
                            }
                        }
                    }
                }else{
                    if($preSection){
                        $playData['prevUrl'] = U('Resource/play',array('sectionId'=>$preSection));
                    }else{
                        $playData['prevUrl'] = '';
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
    protected function getPlayCode($playUrl,$playResource,$videoId) {
        $content = '';
        foreach ($playResource as $value) {
            if($value['id'] == $videoId){
                $content = $playUrl.'/'.$value['content'].'.ts';
                break;
            }
        }
        return $content;
    }
    
    /*
     * 天津地区(80027)
     */
    protected function getPlayCode80027($playUrl,$playUrl,$playResource,$videoId) {
        $content = '';
        foreach ($playResource as $value) {
            if($value['id'] == $videoId){
                $content = $playUrl.'/'.$value['content'].'^^^?&startTime=&endTime=&productId=&sessionId=0&urlEndTime=20130328T105323Z&sessionSign=093f8041fc755864fccab72ed2cd949c&displayName=&provider=coship';
                break;
            }
        }
        return $content;
    }
    
}