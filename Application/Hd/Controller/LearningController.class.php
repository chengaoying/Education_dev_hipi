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
	public function learningEvaluation1Act()
	{
		$role = unserialize(Session('role'));
		//顶级分类(二级栏目)
		$class = $this->getClass();
		//龄段
		$stage = S('Stage');
		$chId = $stage[$role['stageId']]['chId'];
		//得到段龄类型，既早教，幼教，小学等的种类
		$stageType = $class[$chId]['chKey'];
		if($stageType == 'early' || $stageType == 'preschool')
		{
			$stageType = 'learningEvaluation1';
		}
		else 
		{
			$stageType = 'learningEvaluation2';
		}
		
		$proConf = get_pro_config_content('proConfig');//获得配置文件
		$tags = array_values($proConf['tags']);//获得能力标签并从0编号
		
		$resource = D('Resource','Logic') -> queryResourceListByKeyList($tags,null,null,'keyList');//查出keyList中包含能力标签中的项
		$total = $this -> getCount($resource['rows'],'keyList');
		
		//查出keyList中包含能力标签中的项
		$BrowseRecord = D('BrowseRecord','Logic') -> queryBrowseRecordListByKeys(1, $tags);
		$finish = $this -> getCount($BrowseRecord['rows'],'keys');
		
		$length = $this -> getProgressOfEarly($total, $finish, $tags);
		$length = array_values($length);
		$this->assign(array(
					'stageType' => $stageType,	//用于导航栏中学习评价
					'curProgress' => $length,
					'face' => $role['face'],
					'name' => empty($role['nickName']) ? $role['id'] : $role['nickName'],
				));
		$this->display();
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
				if($total[$value] == 0) $length[$value] = 302;
				$finish[$value] = empty($finish[$value]) ? 0 : $finish[$value];
				$length[$value] = ($total[$value]-$finish[$value])*302/$total[$value];
			}
			else 
			{
				$length[$value] = 302;
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
	/**
	 * 显示小学学习评价
	 */
	public function learningEvaluation2Act()
	{
		$page = I('page',1);
		$pageSize = 5;
		$role = unserialize(Session('role'));
		//顶级分类(二级栏目)
		$class = $this->getClass();
		//龄段
		$stage = S('Stage');
		$chId = $stage[$role['stageId']]['chId'];
		//得到段龄类型，既早教，幼教，小学等的种类
		$stageType = $class[$chId]['chKey'];
		if($stageType == 'early' || $stageType == 'preschool')
		{
			$stageType = 'learningEvaluation1';
		}
		else 
		{
			$stageType = 'learningEvaluation2';
		}
		$data_get = I('get.');
		
		//分页查找数据
		$course = D('Course','Logic') -> queryCourseListByType($role['stageId'], 0, 1, 14);
		$total = $course['total'];
		$page = get_pageHtml2($total,3,array(),'/static/v1/hd/images/common/page');
		$course = D('Course','Logic') -> queryCourseListByType($role['stageId'], 0, $page['nowPage'], 3);
		foreach($course['rows'] as $key => $value)
		{
			$data[$key]['name'] = $value['name'];
			$data[$key]['id'] = $value['id'];
			$d = $this -> getData($value['id']);
			$data[$key]['length'] = $this -> getProgressCounrse($d,390);
		}
		$this->assign(array(
					'pageHtml' => $page['html'],
					'datas' => $data,
					'stageType' => $stageType,//用于导航栏中学习评价
					'preId' => $data_get['preId'],
				));
		$this->display();
	}
	
	//得到知识点总进度
	private function getProgressCounrse($course,$length)
	{
		foreach ($course as $key => $value)
		{
			$total += $value['total'];
			$finish += $value['finish'];
		}
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
	 * 详情页面
	 */
	public function detailAct()
	{
		$role = unserialize(Session('role'));
		//顶级分类(二级栏目)
		$class = $this->getClass();
		//龄段
		$stage = S('Stage');
		$chId = $stage[$role['stageId']]['chId'];
		//得到段龄类型，既早教，幼教，小学等的种类
		$stageType = $class[$chId]['chKey'];
		if($stageType == 'early' || $stageType == 'preschool')
		{
			$stageType = 'learningEvaluation1';
		}
		else
		{
			$stageType = 'learningEvaluation2';
		}
		
		$data_get = I('get.');
		
		//分页查找
		$topic = D('Topic','Logic') -> queryTopicList($data_get['courseId']);
		$total = $topic['total'];
 		$page = get_pageHtml2($total,12,array(),'/static/v1/hd/images/common/page');
		$data = $this -> getData($data_get['courseId'], $page['nowPage'], 12);

		$this->assign(array(
					'pageHtml' => $page['html'],
					'datas' => $data,
					'courseName' => $data_get['courseName'],
				
					'stageType' => $stageType,//用于导航栏中学习评价
		));
		$this->display();
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
	private function getFinishNum($topicId)
	{
		$browseRecord = D('BrowseRecord','Logic') -> queryBrowseRecordList($topicId);
		return $browseRecord['total'];
	}
	
	/*
	 * 根据$courseId获得课程中各知识点进度等信息.进度=已看视频个数/视频总额数得到
	 * @param $courseId 知识点id
	 * @param $pageSize 页内个数
	 * @param $pageNo 	页码
	 * @return $data	
	 */
 	private function getData($courseId,$pageNo=null,$pageSize=null)
	{
		$topic = D('Topic','Logic') -> queryTopicList($courseId,$pageNo, $pageSize);
		foreach($topic[rows] as $key => $value)
		{
			$data[$key]['name'] = $value['name'];
			$data[$key]['total'] = $this -> getTotal($value);//知识点中包含视频总个数
			$data[$key]['finish'] = $this->getFinishNum($value['id']);//已观看改知识点的视频个数
			$data[$key]['length'] = $this -> getProgressTopic($data[$key]['total'],$data[$key]['finish'],293);
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
}