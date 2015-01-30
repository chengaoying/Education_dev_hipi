<?php

/**
 * 控制器：学习评价
 * @author WZH
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class LearningController extends CommonController {
	
	/**
	 * 显示早教学习评价
	 */
	public function learningEarlyAct()
	{
		$role = unserialize(Session('role'));
		$channel = $this->initUserCenterChannel();
		$json_encode = json_encode($channel);
		
		$proConf = get_pro_config_content('proConfig');//获得配置文件
		$tags = array_keys($proConf['tags']);//获得能力标签并从0编号
		$resource = D('Resource','Logic') -> queryResourceListByKeyList($tags,null,null,'keyList');//查出keyList中包含能力标签中的项
		$total = $this -> getCount($resource['rows'],'keyList');
		$dataGet = I('Get.');
		$arrange = $dataGet['arrange'];
		$dateArrange = $this->getDateArray();//得到要查询的时间范围
		$dateArrange = ($arrange == 'month') ? $dateArrange : null;
		//查出t_role_browse表中中包含能力标签的项 1-视频
		$BrowseRecord = D('BrowseRecord','Logic') -> queryBrowseRecordListByKeys($role['id'], 1, null, $dateArrange);
		$finish = $this -> getCount($BrowseRecord['rows'],'keys');
		$length = $this -> getProgressOfEarly($total, $finish);
		$length = array_values($length);
		//获得段龄
		$monthAge = $this->getMonthAge();
		if($monthAge==-1)
		{
			$monthAge = '本月';
		}
		else 
		{
			$monthAge = ($monthAge-1).'月龄';
		}
		
		$focus = $dataGet['focus'];
		
		$this->assign(array(
					'curProgress' => $length,
					'face' => $role['face'],
					'name' => empty($role['nickName']) ? $role['id'] : $role['nickName'],
					'channels' => $channel,
					'json_channel' => $json_encode,
					'monthAge' => $monthAge,
					'focus' => $focus,
				));
		$this->display();
	}
	
	/**
	 * 显示小学学习评价
	 */
	public function learningPreschoolAct()
	{
		$page = I('page',1);
		$pageSize = 3;
		
		$role = unserialize(Session('role'));
		
		$channel = $this->initUserCenterChannel();
		$json_encode = json_encode($channel);
		$data_get = I('get.');
	
		//分页查找数据,$role['stageId']得到段龄,第二个参数typeid没有用到，值0，查询时忽略该字段
		$course = D('Course','Logic') -> queryCourseListByType($role['stageId'], 1, $page, $pageSize);
		$pageCount = get_page_count($course['total'], $pageSize);
		$pageHtml = get_page_html($page, $pageCount);
		
		if(!empty($course[rows]))
		{
			foreach($course['rows'] as $key => $value)
			{
				$courseIds[] = $value['id'];
			}
			
			//统计进度
			$progressPreschool = D('Learning', 'Logic')->statisticsDataPreschool($courseIds,$this->role['id'],230);
			$progressPreschool = $progressPreschool['data'];
			Session('progressPreschool',$progressPreschool);
			
			$score = D('Learning', 'Logic')->statisticsScore($role['stageId'],$this->role['id'],1);
			//p($score);exit;
			$score = $score['data'];
			Session('score',$score);
			
			$focus = $this->getFocus();
			foreach($course['rows'] as $key => $value)
			{
				$progress = $this -> countCourseProgress($progressPreschool[$value['id']]);
				$data[$key]['name'] = $value['name'];
				$data[$key]['id'] = $value['id'];
				$data[$key]['length'] = empty($progress) ? 0 : round($progress*230,0);//得到进度长度，四舍五入取整数
				$data[$key]['sumScore'] = empty($score['courseScore'][$value['id']]) ? 0 : $score['courseScore'][$value['id']]['sum'];
			}
		}
		
		$focus = getFocus("ch_3","preFocus");
		if(!$focus['status']) $this->showMessage($focus['info']);
		if($focus == 'ch_3')
		{
			$focus = I('focus','ch_3');
		}
		$this->assign(array(
				'pageHtml' => ($role['stageId']==99) ? null : $pageHtml,//$page['html'],
				'datas' => $data,
				'channels' => $channel,
				'json_channel' => $json_encode,
				'face' => $role['face'],
				'page' => $page,
				'pageCount' => $pageCount,
				'focus' => $focus,
				'roleScore' => isset($score['roleScore']) ? $score['roleScore'] : 0,
				'rank' => isset($score['rank']) ? $score['rank'] : 0,
		));
		$this->display();
	}
	
	/*
	 * 详情页面
	*/
	public function detailAct()
	{
		$page = I('page',1);
		$pageSize = 12;
		
		$role = unserialize(Session('role'));
	
		$data_get = I('get.');
	
		//分页查找
		$topic = D('Topic','Logic') -> queryTopicList($data_get['courseId'],$page,$pageSize);
		//$total = $topic['total'];
		$pageCount = get_page_count($topic['total'], $pageSize);
		$pageHtml = get_page_html($page, $pageCount);
		//$page = get_pageHtml2($total,12,array(),'/static/v1/hd/images/common/page');
//		$data = $this -> getData($data_get['courseId'], $page/* $page['nowPage'] */, $pageSize);
//		dump($this->progressPreschool);exit;
		
		$progressPreschool = Session('progressPreschool');
		$topic = $topic['rows'];
		foreach($topic as $key => $value)
		{
			$data[$key]['name'] = $value['name'];
			$data[$key]['length'] = empty($progressPreschool[$value['courseId']][$value['id']]) ? 0 : $progressPreschool[$value['courseId']][$value['id']]*300;
		}
		$score = Session('score');
		$totalScore = empty($score['courseScore'][$data_get['courseId']]['sum']) ? 0 : $score['courseScore'][$data_get['courseId']]['sum'];
		
		$focus = I('focus','ch_3');//分页焦点
		$this->assign(array(
				'pageHtml' => $pageHtml,//$page['html'],
				'datas' => $data,
				'courseName' => $data_get['courseName'],
				'page'	=> $page,
				'pageCount' => $pageCount,
				'roleScore' => $totalScore,
				'focus' => $focus,
		));
		$this->display();
	}
	
	/*
	 * 计算课程所有知识点的进度
	 * 
	 */
	private function countCourseProgress($topicsProgress)
	{
		$temp = 0;
		foreach($topicsProgress as $k => $v)
		{
			$temp += $v;
		}
		return $temp/count($topicsProgress);
	}
	
	/*
	 * 得到本月其实日期和结束日期时间点
	 * @return array $date 包含开始日期和结束日期时间点
	 */
	private function getMonthDate()
	{
		date_default_timezone_set('Etc/GMT-8');     //这里设置了时区
		
		$startDate = date('Y-m').'-01 00:00:00';
		$endDate = date('Y-m-d H:i:s');//get now time
		return array($startDate, $endDate);
	}
	
	/*
	 * 得到月龄时间范围
	 */
	private function getDateArray()
	{
		date_default_timezone_set('Etc/GMT-8');     //这里设置了时区
		
		$birthday = $this->role['birthday'];
		if(empty($birthday) || strtotime($birthday)===false)//没有生日或者生日输入错误则获得本月1日到当前时间范围
		{
			return $this->getMonthDate();
		}
		else 
		{
			$day_birthday = date('d', strtotime($birthday));
			$day_now = date('d');
			if($day_now >= $day_birthday)
			{
				$startDate = date('Y-m-').$day_birthday.' 00:00:00';
				$endDate = date('Y-m-d H:i:s');//now time
				return array($startDate, $endDate);
			}
			else 
			{
				$lastmonthEndDays = date('t', strtotime(date('Y-m-01').' -1 month'));
				if($day_birthday <= $lastmonthEndDays)
				{
					$startDate = date('Y-m-',strtotime(date('Y-m-01')." -1 month")).$day_birthday.' 00:00:00';
					$endDate = date('Y-m-d H:i:s');//now time
					return array($startDate, $endDate);
				}
				else 
				{
					$startDate = date('Y-m-01 00:00:00');
					$endDate = date('Y-m-d H:i:s');//now time
					return array($startDate, $endDate);
				}
			}
			
		}
	}
	
	/*根据用户中心生日得到月龄
	 *@return  
	 */
	private function getMonthAge()
	{
		$birthday=$this->role['birthday'];
		$data = monthNum($birthday);//根据生日计算出生月数
		
		if($data['status'])
		{
			$m = $data['data']['monthNum'];
		}
		else
		{
			$m = -1;
		}
		return $m;
	}

	
	/*
	 * 得到早教各项能力进度
	 */
	private function getProgressOfEarly($total, $finish)
	{
		$length = array();
		foreach ($total as $key => $value)
		{
			if($finish[$key]>$total[$key]) $finish[$key] = $total[$key];
			if($total[$key]==0)
			{
				$length[$key] = 300;
			}
			else 
			{
				$length[$key] = ($total[$key]-$finish[$key])*300/$total[$key];
			}
		}
		return $length;
	}
	

	
	/*
	 * 统计t_resource中各项能力的总数目
	 */
	public function getCount($data,$key)
	{
		for($i=0;$i<9;$i++)
		{
			$count[$i+1] = 0;
		}
		foreach($data as $keys => $value)
		{
			$temp_array = explode(getDelimiterInStr($value[$key]),$value[$key]);
			foreach ($temp_array as $key1 => $value)
			{
				if($value>=1 && $value<=9)
				{
					$count[$value]++;
				}
			}
		}	
		return $count;
	}
	

	

	
	/**
	 * 初始化用户中心导航栏
	 */
	private function initUserCenterChannel(){
		$channel = S('Channel');
		$topChannel = get_array_for_fieldval($channel, 'chKey','usercenter');
		$topChannel = array_slice($topChannel,0,count($topChannel));
		$id = $topChannel[0]['id'];
		$channel = get_array_for_fieldval($channel, 'pId',$id);
		$channel = get_array_for_fieldval($channel,'isShow','1');
	
		//角色信息，根据角色不同龄段推荐不同的课程
		$stage = $this->getStage($this->role['stageId']);
		$grade = $this->getGrade($stage['chId']);
		//因为学习评价有两种，所以此处匹配
		foreach($channel as $key => $value)
		{
			if($value['chKey'] == 'learning')
			{
				if($grade['chKey']=='early' || $grade['chKey']=='preschool')
				{
					$channel[$key]['linkUrl'] = '/Hd/Learning/learningEarly?arrange=month';
				}
				else
				{
					$channel[$key]['linkUrl'] = '/Hd/Learning/learningPreschool';
				}
			}
		}
		//把栏目的图片数组拆开
		foreach ($channel as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$channel[$k]['linkImage']  = get_upfile_url(trim($imgs[0]));
				$channel[$k]['focusImage'] = get_upfile_url(trim($imgs[1]));
				$channel[$k]['titleImage'] = get_upfile_url(trim($imgs[2]));
			}
		}
	
		//把栏目key值初始为从0开始的递增的值，前端按钮调用统一
		$channel = array_slice($channel,0,count($channel));
		$channel = get_array_fieldkey($channel,array('id','name','linkImage','focusImage','titleImage','linkUrl'));
		return $channel;
	}
	
	/*获取上个页面焦点
	 *@param default 没查到focus时的默认焦点
	*/
	private function getFocus($default)
	{
		$url = HTTP_REFERER;//上页面索引，根据focus值得到默认焦点
		//得到开始坐标
		$startPos = strpos($url,'focus');
		
		if($startPos===false) return $default;
		$startPos += 6;
		//得到结束坐标
		$endPos1 = strpos($url, '&', $startPos);
		$endPos2 = strpos($url, '/', $startPos);
		$endPos3 = strpos($url, '.html', $startPos);
		($endPos = $endPos1) || ($endPos = $endPos2) || ($endPos = $endPos3);
		
		$endPos = $endPos===false ? strlen($url) : $endPos;
		//得到长度
		$len = $endPos - $startPos;
		//得到focus
		$act = substr($url,$startPos,$len);
		if($act === false) return $default;
		return $act;
	}
}