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
		$data = D('Section','Logic')->querySectionByPrivilege('0',1,14);
		$total = $data['total'];
		$imgPath = '/static/v1/hd/images/common/page';
		$page = get_pageHtml2($total,14,array(),$imgPath);
		$data = D('Section','Logic')->querySectionByPrivilege('0',$page['firstRow'],14);
		
		//角色信息
		$role = unserialize(Session('role'));
		$proConfig = get_pro_config_content('proConfig');
		$key = array_search('最新',$proConfig['keys']);
		$c = D('Course','Logic')->queryCourseListByKeys($role['stageId'],array($key),1,5);
		$c = $c['rows'];
		foreach ($c as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$c[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
			}
//			$course[$k]['imgUrl'] = $c[$k]['imgUrl'];
		}
		
		$this->assign(array(
					'pageHtml' => $page['html'],
					'datas' => $data['rows'],
					'count' => count($data['rows']),
					'img_recommend1' => $c[0]['imgUrl'],
					'img_recommend2' => $c[1]['imgUrl'],
					'url_recommend1' => $c[0]['id'],
					'url_recommend2' => $c[1]['id'],
				));
		$this->display();
	}
	
}