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
		$total = $this -> getCount1($resource['rows'],'keyList');
		$dataGet = I('Get.');
		$arrange = $dataGet['arrange'];
		$dateArrange = $this->getDateArray();//得到要查询的时间范围
		$dateArrange = ($arrange == 'month') ? $dateArrange : null;
		//查出t_role_browse表中中包含能力标签的项 1-视频
		$BrowseRecord = D('BrowseRecord','Logic') -> queryBrowseRecordListByKeys($role['id'], 1, null, $dateArrange);
		$finish = $this -> getCount1($BrowseRecord['rows'],'keys');
		$length = $this -> getProgressOfEarly1($total, $finish);
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
		//$total = $course['total'];
		$pageCount = get_page_count($course['total'], $pageSize);
		$pageHtml = get_page_html($page, $pageCount);
		//$page = get_pageHtml2($total,3,array(),'/static/v1/hd/images/common/page');
		//$course = D('Course','Logic') -> queryCourseListByType($role['stageId'], 1, $page['nowPage'], 3);
		foreach($course['rows'] as $key => $value)
		{
			$data[$key]['name'] = $value['name'];
			$data[$key]['id'] = $value['id'];
			$d = $this -> getData($value['id']);
			$data[$key]['length'] = $this -> getProgressCounrse($d,270);
		}
		
		$this->assign(array(
				'pageHtml' => $pageHtml,//$page['html'],
				'datas' => $data,
				'channels' => $channel,
				'json_channel' => $json_encode,
				'face' => $role['face'],
				'page' => $page,
				'pageCount' => $pageCount,
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
		$topic = D('Topic','Logic') -> queryTopicList($data_get['courseId']);
		//$total = $topic['total'];
		$pageCount = get_page_count($topic['total'], $pageSize);
		$pageHtml = get_page_html($page, $pageCount);
		//$page = get_pageHtml2($total,12,array(),'/static/v1/hd/images/common/page');
		$data = $this -> getData($data_get['courseId'], $page/* $page['nowPage'] */, $pageSize);
		
		$this->assign(array(
				'pageHtml' => $pageHtml,//$page['html'],
				'datas' => $data,
				'courseName' => $data_get['courseName'],
				'page'	=> $page,
				'pageCount' => $pageCount,
		));
		$this->display();
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
	private function getProgressOfEarly($total, $finish, $tags)
	{
		$length = array();
		foreach($tags as $key => $value)
		{
			if(in_array($value, array_keys($total)))
			{
				if($total[$value] == 0) $length[$value] = 300;
				if($finish[$value] > $total[$value]) $finish[$value] = $total[$value]; 
				$finish[$value] = empty($finish[$value]) ? 0 : $finish[$value];
				$length[$value] = ($total[$value]-$finish[$value])*300/$total[$value];
			}
			else 
			{
				$length[$value] = 300;
			}
		}
		return $length;
	}
	/*
	 * 得到早教各项能力进度
	 */
	private function getProgressOfEarly1($total, $finish)
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
		$count = array();
		foreach($data as $keys => $value)
		{
			if(strpos($value[$key], '健康') !== false)
			{
				$count['健康'] ++;
			}
			if(strpos($value[$key], '语言') !== false)
			{
				$count['语言'] ++;
			}
			if(strpos($value[$key], '科学') !== false)
			{
				$count['科学'] ++;
			}
			if(strpos($value[$key], '数学') !== false)
			{
				$count['数学'] ++;
			}
			if(strpos($value[$key], '社会') !== false)
			{
				$count['社会'] ++;
			}
			if(strpos($value[$key], '习惯') !== false)
			{
				$count['习惯'] ++;
			}
			if(strpos($value[$key], '美术') !== false)
			{
				$count['美术'] ++;
			}
			if(strpos($value[$key], '音乐') !== false)
			{
				$count['音乐'] ++;
			}
			if(strpos($value[$key], '综合') !== false)
			{
				$count['综合'] ++;
			}
		}
		
		return $count;
	}
	/*
	 * 统计t_resource中各项能力的总数目
	 */
	public function getCount1($data,$key)
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
	

	
	//得到知识点总进度
	private function getProgressCounrse($course,$length)
	{
		foreach ($course as $key => $value)
		{
			$total += $value['total'];
			$finish += (($value['finish']>$value['total'])?$value['total']:$value['finish']);
		}
		if($finish>$total) $finish = $total;
		if(empty($total))
		{
			return 0;
		}
		else 
		{
			return $finish*$length/$total;
		}
	}
	
	/*
	 * 得到$str中以逗号分隔的字段个数
	 * @param $str	要处理字符串
	 * @return $count	字段个数
	 */
	private function getCountOfStr($str)
	{
		$count = 0;
		$total = explode(getDelimiterInStr($str),$str);
		foreach($total as $key => $value)
		{
			if(!empty($value))
			{
				$count++;
			}
		}
		return $count;
	}
	/*
	 *获得题知识点中统计视频数
	 *@param $topic知识点 
	 *@return $count视频总个数
	 */
	private function getTotal($topic)
	{
		//视频总个数
		$count = 0;
		$proConf = get_pro_config_content('proConfig');
		if($proConf['sectionVideo'] == 1)//此时一个课时对应一个视频，可根据t_topic中lessonList字段中课时id个数判断视频总个数
		{	
			$sectionIds = $topic['sectionIds'];
			$count = $this -> getCountOfStr($sectionIds);
		}
		else //此时一个课时对应多个视频，只能通过在t_section(课时表)根据topicId查数据库方式判断视频总个数。速度较慢
		{
			$topicId = $topic['id'];
			$section = D('Section','Logic') -> querySectionList($topicId);
			foreach($section[rows] as $key => $value)
			{
				$count += $this -> getCountOfStr($value['lessonList']);
			}
		}

		return $count;
	}
	
	/*
	 *获得知识点中完成视频数
	*/
	private function getFinishNum($roleId, $topicId)
	{
		$browseRecord = D('BrowseRecord','Logic') -> queryBrowseRecordList($roleId, $topicId);
		return $browseRecord['total'];
	}
	
	/*
	 * 根据$courseId获得课程中各知识点进度等信息.进度=已看视频个数/视频总额数得到
	 * @param $courseId 知识点id
	 * @param $pageSize 页内个数
	 * @param $pageNo 	页码
	 * @return $data	
	 */
 	private function getData($courseId,$pageNo='',$pageSize='')
	{
		$topic = D('Topic','Logic') -> queryTopicList($courseId,$pageNo, $pageSize);
		foreach($topic[rows] as $key => $value)
		{
			$data[$key]['name'] = $value['name'];
			$data[$key]['total'] = $this -> getTotal($value);//知识点中包含视频总个数
			$data[$key]['finish'] = $this->getFinishNum($this->role['id'],$value['id']);//已观看改知识点的视频个数
			$data[$key]['length'] = $this -> getProgressTopic($data[$key]['total'],$data[$key]['finish'],300);
		}
		return $data;
	} 
	
	//得到各个知识点进度
	private function getProgressTopic($total,$finish,$length)
	{
		if($finish>$total) $finish = $total;
		if(empty($total))
		{
			return 0;
		}
		else 
		{
			return $finish*$length/$total;
		}
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
	 *
	*/
	private function getFocus()
	{
		$baseInfo = 'ch_3';//在http_refferr中没有focuse参数时的默认焦点
		$url = HTTP_REFERER;//上页面索引，根据focus值得到默认焦点
		//得到开始坐标
		$startPos = strpos($url,'focus');
		if($startPos===false) return $baseInfo;
		$startPos += 6;
		//得到结束坐标
		$endPos1 = strpos($url, '&', $startPos);
		$endPos2 = strpos($url, '/', $startPos);
		$endPos = $endPos1 || $endPos2;
		$endPos = $endPos===false ? strlen($url) : $endPos;
		//得到长度
		$len = $endPos - $startPos;
		//得到focus
		$act = substr($url,$startPos,$len);
		if($act === false) return $baseInfo;
		return $act;
	}
}