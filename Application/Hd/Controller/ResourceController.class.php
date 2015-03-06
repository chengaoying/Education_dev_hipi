<?php

namespace Hd\Controller;

class ResourceController extends  BaseMediaController{
	
	/**
	 * 视频播放
	 */
	public function playAct(){
		
		//播放返回地址
		if(strstr(HTTP_REFERER,'Hd/SectionList')){
			session('video_back_url',HTTP_REFERER);
			$backUrl = get_back_url('Index/recommend',1);
		}else{
			$backUrl = session('video_back_url');
		}
		
		$courseId = I('courseId', '');
		$sectionId = I('sectionId', '');
		$section = D('Section', 'Logic')->querySectionById($sectionId);
		
		//课时处理：获取预习和正文视频
		$this->play_prev();
        
		//请求上下文，用于各函数之间数据传递
		$_CONTEXT = array();
		$_CONTEXT['resource'] = $resource;
		$_CONTEXT['user'] = $this->user;
		$_CONTEXT['returnUrl'] = $backUrl;
		
        if(C('DEBUG_MODE')){ //调试模式
        	$playUrl = C('RTSP_VIDEO_URL');
        	
        }else{
        	//获取视频播放代码
        	$this->getPlayCode($_CONTEXT);
        	if($_CONTEXT['status'])
        	{
        		//数据统计
        		$this->dataStat($section, $courseId, $resource);
        		//跳转至播放页面
        		$this->goPlayPage($_CONTEXT);
        	}
        	else
        	{
        		//获取视频播放代码异常，返回上一个页面
        		$this->addFloatMessage($_CONTEXT['errorInfo'],HTTP_REFERER);
        	}
        } 
		
			/* $returnurl = U('Resource/play?id='.$videoId);
			$returnurl = urlencode($returnurl);
			$returnurl2 = U('Index/index');
			$returnurl2 = urlencode($returnurl2);
            $time = date('Y:m:d:H:i:s',NOW_TIME);
            save_log('videoToPay',array('time'=>$time,'payUrl'=>' 订阅地址：'.U('Index/pay?jumpUrl='.$returnurl2.'&returnUrl='.$returnurl)),1);
			//进入订阅
			header("location:".U('Index/pay').'?returnUrl='.$returnurl.'&jumpUrl='.$returnurl2);
			exit; */
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
			$data['res_providers'] = 'res';
			$data['content_id'] = 'res';
			D('Pv','Logic')->savePv($data);
		}
	}
	
	
	
	
}