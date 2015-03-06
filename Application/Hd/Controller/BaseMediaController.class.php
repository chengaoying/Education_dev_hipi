<?php


/**
 * 分区媒体播放具体实现类
 * @author CGY
 *
 */
namespace Hd\Controller;

use Common\Controller\CommonController;
class BaseMediaController extends CommonController{
	
	/**
	 * 获取各分区播放代码
	 * @param arr $_CONTEXT	请求上下文
	 */
	public function getPlayCode(&$_CONTEXT)
	{
		$area_code = C('AREA_CODE');
		switch ($area_code)
		{
			case '80027':	//天津广电 
				$this->getPlayCode_80027($_CONTEXT);
				break;
            case '80029':	//新疆广电 
				$this->getPlayCode_80029($_CONTEXT);
				break;
			default:
				$_CONTEXT['status'] = 0;
				$_CONTEXT['errorInfo'] = '没有找到编号为：'.$area_code.'的地区';
				break;	
		}
	}
	
	
	private function getPlayCode_80027(&$_CONTEXT)
	{
		$_CONTEXT['status'] = 1;
	}
    private function getPlayCode_80029(&$_CONTEXT)
	{
		$_CONTEXT['status'] = 1;
	}
	
	/**
	 * 跳转至播放页面
	 * @param arr $_CONTEXT
	 */
	public function goPlayPage(&$_CONTEXT)
	{
		$area_code = C('AREA_CODE');
		switch ($area_code)
		{
			case '80027':	//天津广电
				$this->goPlayPage_80027($_CONTEXT);
				break;
            case '80029':	//新疆广电
				$this->goPlayPage_80029($_CONTEXT);
				break;
		}
	}
	
	
	private function goPlayPage_80027(&$_CONTEXT)
	{
		$video = $_CONTEXT['video'];
		$vs = explode(PHP_EOL, $video['content']);
		$this->assign(array(
			'videoStream'	=> $video['content'],
			'returnUrl'		=> urlencode($_CONTEXT['returnUrl'])
		));
		$this->display();
	}
    
    private function goPlayPage_80029(&$_CONTEXT)
	{
		$video = $_CONTEXT['video'];
		$vs = explode(PHP_EOL, $video['content']);
		$this->assign(array(
			'videoStream'	=> $video['content'],
			'returnUrl'		=> urlencode($_CONTEXT['returnUrl'])
		));
		$this->display();
	}
	
	
	
}