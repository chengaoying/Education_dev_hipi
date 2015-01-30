<?php

/**
 * 控制器：免费专区
 * @author WZH
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class FreeZoneController extends CommonController {
	
	/**
	 * 显示段龄学习评价
	 */
	public function IndexAct()
	{
		$page = I('page',1);
		$pageSize = 14;
		
		$data = D('Section','Logic')->querySectionByPrivilege('0',$page,$pageSize);
		//分页
		$pageCount = get_page_count($data['total'], $pageSize);
		$pageHtml = get_page_html($page, $pageCount);
		
		//角色信息
		$role = unserialize(Session('role'));
		$proConfig = get_pro_config_content('proConfig');
		$key = array_search('最新',$proConfig['keys']);
		
		if($role['stageId'] == 99)
		{
			$c = D('Course','Logic')->queryCourseListByKeys(null,array($key));
		}
		else 
		{
			$c = D('Course','Logic')->queryCourseListByKeys($role['stageId'],array($key));
		}
		
		$key = getRandNumber(0,$c['total']-1);
		$c = $c['rows'];
		foreach($key as $k => $v)
		{
			if($c[$k]['imgUrl']){
				$imgs = explode(getDelimiterInStr($c[$k]['imgUrl']), $c[$k]['imgUrl']);
				$c[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
			}
		}
		
		/* 获得焦点 */
		$focus = I('preFocus','option_1');
		if($focus == 'option_1')
		{
			$focus = I('focus','option_1');
		}
		
		$this->assign(array(
					'pageHtml' => $pageHtml,
					'datas' => $data['rows'],
					'count' => count($data['rows']),
					'page'	=> $page,
					'pageCount'=>$pageCount,
					'img_recommend1' => $c[0]['imgUrl'],
					'img_recommend2' => $c[1]['imgUrl'],
					'url_recommend1' => $c[0]['id'],
					'url_recommend2' => $c[1]['id'],
					'focus' => $focus,
				));
		$this->display();
	}
	
}