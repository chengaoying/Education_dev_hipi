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
		//最近观看代码
		$data = D('BrowseRecord','Logic')->queryBrowseRecordListRecentlyWatch($role['id'],1,14);
/* 		$total = $data['total'];
		$imgPath = '/static/v1/hd/images/common/page';
		$page = get_pageHtml2(1,14,array(),$imgPath);
		$data = D('BrowseRecord','Logic')->queryBrowseRecordList($role['id'],$page['nowPage'],14); */
		//以下是大家都在看的代码	
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
		
		$this->assign(array(
					'datas' => $data['rows'],
					'count' => count($data['rows']),
					'img_recommend1' => $c[0]['imgUrl'],
					'img_recommend2' => $c[1]['imgUrl'],
					'id_recommend1' => $c[0]['id'],
					'id_recommend2' => $c[1]['id'],
				));
		$this->display();
	}
	
}