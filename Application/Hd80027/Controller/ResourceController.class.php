<?php

namespace Hd80027\Controller;
use Common\Controller\CommonController;

/**
 * 视频播放控制器：视频播放在各地区分组中实现，易维护。
 * @author CGY
 *
 */
class ResourceController extends  CommonController{
	
	/**
	 * 视频播放
	 */
	public function playAct(){
		
		//播放返回地址
		if(strstr(HTTP_REFERER,'SectionList/')){
			session('video_back_url',HTTP_REFERER);
			$backUrl = get_back_url('Index/recommend',1);
		}else{
			$backUrl = session('video_back_url');
		}
		
		$courseId = I('courseId', '');
		$sectionId = I('sectionId', '');
		$section = D('Section', 'Logic')->querySectionById($sectionId);
		
		//请求上下文，用于各函数及页面之间数据传递
		$_CONTEXT = array();
		$_CONTEXT['returnUrl'] = $backUrl;
		
		//课时处理：
		$this->sectionProcessing($section,$courseId,$_CONTEXT);
		
        if(C('DEBUG_MODE')){ //调试模式
        	$playUrl = C('RTSP_VIDEO_URL');
        	$this->assign($_CONTEXT);
        	$this->display();
        }else{
        	//数据统计
        	//$this->dataStat($section, $courseId, $resource);
        } 
	}
	
	/*
	 * 播放前的课时处理：
	 *    1.读取课时的预习和正文视频列表并按顺序合并(先预习后正文)，没有视频则进入做练习页
	 *    2.视频播放完则进入做练习题页面
	 *    3.如果没有练习题，则进入下一个课时流程
	 */
	private function sectionProcessing($section,$courseId,&$_CONTEXT){
		$playList = array();
		if ($section['previewList']) {
			$playList = explode(',', $section['previewList']);
		}
		$lessonList = explode(',', $section['lessonList']);
		$playList = array_merge($playList, $lessonList); //将预习与课堂进行组合
		$playList = array_filter($playList); //去除数组中空值
		if(empty($playList)){
			if(empty($section['libId'])){
				$this->addFloatMessage('视频和题库都不存在！',get_back_url('Index/recommend',1));
			}
			$isExistVideo = 'false';
			$jumpUrl = 'Library/detail?courseId='.$courseId.'&sectionId='.$section['id'].'&isExistVideo='.$isExistVideo;
			header('location:'.U($jumpUrl));
		}
		$resources = D('Resource', 'Logic')->queryResourceList($playList, 'id,title,content,keyList');
		
		$_CONTEXT['resources'] = json_encode($resources); //资源列表
		$_CONTEXT['prevSeciton'] = $section['id'] - 1;	  //上一个课时id
		$_CONTEXT['nextSeciton'] = $section['id'] + 1;	  //下一个课时id
		
		dump($_CONTEXT);exit;
	}
	
	
	/*
	 * 视频播放相关的统计
	 */
	private function dataStat($section,$courseId,$resource){
		//添加浏览记录
		$browser['roleId'] = $this->role['id'];
		$browser['title'] = $section['name'];
		$browser['courseId'] = $courseId;
		$browser['topicId']  = $section['topicId'];
		$browser['sectionId']= $section['id'];
		$browser['keys'] = $resource['keyList'];
		$browser['type'] = 1;
		$res = D('BrowseRecord','Logic')->saveBrowseRecord($browser);
		
		//赠送积分
		D('Credit','Logic')->ruleIncOrDec($this->user['id'],$this->role['id'],'play','视频播放送2个积分');
		
		//收费资源pv
		if($section['privilege'] == 1){
			$data['c_class'] = 'res';
			$data['res_providers'] = $resource['rpId'];
			$data['content_id'] = $resource['id'];
			D('Pv','Logic')->savePv($data);
		}
	}
	
	
	
	
}