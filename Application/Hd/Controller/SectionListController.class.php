<?php

/**
 * 控制器：课时列表
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class SectionListController extends CommonController {
	
	/**
	 * 课时列表统一入口
	 */
	public function indexAct(){
		$chId 	 = I('chId','');
		$stageId = I('stageId','');

		$chKey = get_array_keyval(S('Channel'),$chId,'id','chKey');
		
		if($chKey == 'early') //早教课时列表
		{
			$this->early($chId,$chKey,$stageId);
		}
		elseif($chKey == 'preschool') //幼教课时列表
		{
			$this->preschool($chId,$chKey,$stageId);
		}
		else  //其他通用课时列表
		{
			$this->common($chId,$chKey,$stageId);
		}
	}
	
	/**
	 *  早教--课时列表 
	 * @param unknown_type $chId  栏目id
	 * @param unknown_type $chKey 栏目key
	 * @param unknown_type $stageId 龄段id
	 */
	private function early($chId,$chKey,$stageId){
		$month = 13;//几个月的小孩
        $age = 2;
		if($month>=1 and $month<=12){
			$year = 1;
		}else if($month>12 and $month<=24){
			$year = 2;
		}else if($month>24 and $month<=36){
			$year = 3;
		}else{
			$this->showMessage('参数错误');
		}

		$this->assign(array(
			'month'  => $month,
			'chId' 	 => $chId,  
			'chList' => $this->getTopicList(),
			'json_ch' => json_encode($this->getTopicList()),
			'videoList' => $this->getVideoList(),
		));
		$this->display('detail_early');
	}
	
	/**
	 * 幼教--课时列表
	 * @param unknown_type $chId
	 * @param unknown_type $chKey
	 * @param unknown_type $stageId
	 */
	private function preschool($chId,$chKey,$stageId){
		$template = 'detail_preschool';
		$class = 'big'; //哪个班
	
		$dayList = $this->getDayList();
		$json_day = json_encode($dayList);
		$this->assign(array(
			'class' 		=> $class,
			'videoList' 	=> $this->getVideoList(5),
			'specialList'	=> $this->getSpecialList(3),
			'json_day'		=> $json_day,
			'dayList'		=> $dayList,
		));
		$this->display('detail_preschool');
	}
	
	/**
	 * 通用--课时列表
	 * @param unknown_type $chId
	 * @param unknown_type $chKey
	 * @param unknown_type $stageId
	 */
	private function common($chId,$chKey,$stageId){
		$this->assign(array(
			'videoList'=>$this->getVideoList(10),
		));
		$this->display('detail_primaryschool');
	}
	
	/**
	 * 一周课程--课时列表
	 */
	public function weekAct(){
		$class = 'big';
		$weekList = $this->getWeekList();
		$json_week = json_encode($weekList);
		$this->assign(array(
				'class'		=> $class,
				'videoList' => $this->getVideoList2(),
				'json_week' => $json_week,
				'weekList'	=> $weekList,
		));
		$this->display();
	}
	
	
	
	
	
	/* 测试使用 */
	private function getTopicList($count=6){
		$topics = array();
		for($i=0; $i<$count; $i++){
			$topics[$i]['id'] = $i;
			$topics[$i]['name'] = 'test';
			$topics[$i]['linkImage'] = get_upfile_url('__HD__/images/test/1month/chanfuhuli.png');
			$topics[$i]['focusImage'] = get_upfile_url('__HD__/images/test/1month/chanfuhuli_over.png');
		}
		return $topics;
	}
	
	/* 测试使用 */
	private function getVideoList($count=6){
		$videos = array();
		for($i=0; $i<$count; $i++){
			$videos[$i]['id'] = $i;
			$videos[$i]['name'] = 'test_'.$i;
			$videos[$i]['imgUrl'] = get_upfile_url('__HD__/images/test/video/a.jpg');
		}
		return $videos;
	}
	
	/* 测试使用 */
	private function getSpecialList($count=6){
		$specials = array();
		for($i=0; $i<$count; $i++){
			$specials[$i]['id'] = $i;
			$specials[$i]['name'] = 'test';
			$specials[$i]['imgUrl'] = get_upfile_url('__HD__/images/test/special/special_1.jpg');
		}
		return $specials;
	}
	
	/* 测试使用 */
	private function getDayList(){
		//显示哪三天
		$today = date("w",NOW_TIME);//周几
		$yesterday = date("w",  strtotime("-1 days", NOW_TIME));
		$dayBefore = date("w",  strtotime("-2 days", NOW_TIME));
		$dayList = array();
		$dayList = array(
				array(
						'id' => $dayBefore,
						'name' => $dayBefore,
						'linkImage' => get_upfile_url('__HD__/images/sectionList/preschool/day_'.$dayBefore.'.png'),
						'focusImage'=> get_upfile_url('__HD__/images/sectionList/preschool/day_'.$dayBefore.'_over.png'),
				),
				array(
						'id' => $yesterday,
						'name' => $yesterday,
						'linkImage' => get_upfile_url('__HD__/images/sectionList/preschool/day_'.$yesterday.'.png'),
						'focusImage'=> get_upfile_url('__HD__/images/sectionList/preschool/day_'.$yesterday.'_over.png'),
				),
				array(
						'id' => $today,
						'name' => $today,
						'linkImage' => get_upfile_url('__HD__/images/sectionList/preschool/day_'.$today.'.png'),
						'focusImage'=> get_upfile_url('__HD__/images/sectionList/preschool/day_'.$today.'_over.png'),
				),
		);
		return $dayList;
	}
	
	/* 测试使用 */
	private function getWeekList(){
		//显示哪三周
		$thisWeek = date("W",NOW_TIME);//第几周
		$lastWeek = date("W",  strtotime("-7 days", NOW_TIME));
		$beforeWeek = date("W",  strtotime("-14 days", NOW_TIME));
		$weekList = array();
		$weekList = array(
				array(
						'id' => $beforeWeek,
						'name' => $beforeWeek,
						'linkImage' => get_upfile_url('__HD__/images/sectionList/preschool/day_'.$beforeWeek.'.png'),
						'focusImage'=> get_upfile_url('__HD__/images/sectionList/preschool/day_'.$beforeWeek.'_over.png'),
				),
				array(
						'id' => $lastWeek,
						'name' => $lastWeek,
						'linkImage' => get_upfile_url('__HD__/images/sectionList/preschool/day_'.$lastWeek.'.png'),
						'focusImage'=> get_upfile_url('__HD__/images/sectionList/preschool/day_'.$lastWeek.'_over.png'),
				),
				array(
						'id' => $thisWeek,
						'name' => $thisWeek,
						'linkImage' => get_upfile_url('__HD__/images/sectionList/preschool/day_'.$thisWeek.'.png'),
						'focusImage'=> get_upfile_url('__HD__/images/sectionList/preschool/day_'.$thisWeek.'_over.png'),
				),
		);
		return $weekList;
	}
	
	/* 测试使用 */
	private function getVideoList2(){
		for($i=0;$i<5;$i++){
			for($j=0;$j<5;$j++){
				$videoList[$i][$j]['id'] = $i+$j;
				$videoList[$i][$j]['name'] = 'test'.$i+$j;
			}
		}
		for($m=5;$m<2;$m++){
			for($n=0;$n<4;$n++){
				$videoList[$m][$n]['id'] = $m+$n;
				$videoList[$m][$n]['name'] = 'test'.$m+$n;
				$videoList[$m][$n]['imgUrl'] = get_upfile_url('__HD__/images/test/xingquban.jpg');
			}
		}
		return $videoList;	
	}
}