<?php

/**
 * 控制器：免费专区
 * @author WZH
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class RecentlyWatchController extends CommonController {
	
	/**
	 * 显示段龄学习评价
	 */
	public function IndexAct()
	{
		//角色信息
		$role = unserialize(Session('role'));
		$data = D('BrowseRecord','Logic')->queryBrowseRecordList($role['id'],1,1);
		$total = $data['total'];
		$imgPath = '/static/v1/hd/images/common/page';
		$page = get_pageHtml2(1,14,array(),$imgPath);
		$data = D('BrowseRecord','Logic')->queryBrowseRecordList($role['id'],$page['nowPage'],14);
		//角色信息	
		$role = unserialize(Session('role'));
		$proConfig = get_pro_config_content('proConfig');
		$key = array_search('最新',$proConfig['keys']);
		$c = D('Course','Logic')->queryCourseListByKeys($role['stageId'],array($key),1,2);
		$c = $c['rows'];
		foreach ($c as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$c[$k]['imgUrl']  = get_upfile_url(trim($imgs[0]));
			}
			$course[$k]['imgUrl'] = $c[$k]['imgUrl'];
		}
		$this->assign(array(
					'pageHtml' => $page['html'],
					'datas' => $data['rows'],
					'count' => count($data['rows']),
					'img_recommend1' => $course[0]['imgUrl'],
					'img_recommend2' => $course[1]['imgUrl'],
					'url_recommend1' => $c['id'],
					'url_recommend2' => $c['id'],
				));
		$this->display();
	}
	
}