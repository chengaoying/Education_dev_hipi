<?php

/**
 * 控制器：荣誉成就
 * @author WZH
 *
 */

namespace Sd\Controller;
use Common\Controller\CommonController;

class GloryController extends CommonController {
	
	/**
	 * 显示荣誉成就
	 */
	public function indexAct()
	{
		$role = unserialize(Session('role'));
		$channel = $this->initUserCenterChannel();
		$json_encode = json_encode($channel);
		$todayCredit = D('Credit','Logic') -> queryTodayCredit($this->user['id'], $this->role['id']);
		$todayCredit = empty($todayCredit) ? 0 : $todayCredit;
		$totalCredit = $this->user['point'] + $this->role['point'];
		
		$gloryClass = $this->getGloryClass($totalCredit);
		$classValue = array($gloryClass[2],$gloryClass[3]);//总积分/当前等级上限值
		
		$creditRuleLog = D('Credit','Logic') -> queryContinueLogin($this->user['id'], $this->role['id']);
		$continueNum = $creditRuleLog['num'];
		$giftNum = 0;
		$this->assign(array(
					'curProgress' => $gloryClass[1],
					'channels' => $channel,
					'face' => $role['face'],
					'json_channel' => $json_encode,
					'todayCredit' => $todayCredit,
					'totalCredit' => $totalCredit,
					'gloryClass' => $gloryClass[0],
					'classValue' => $classValue,
					'continueNum' => $continueNum,
					'giftNum' => $giftNum,
				));
		$this->display();
	}
	/**
	 * 显示全部奖励
	 */
	public function viewAct()
	{
		$imgPath = '/static/v1/hd/images/common/page';
		$data = array('1','1','1','1','1','1','1','1','1');
		$this->assign(array(
					'datas' => $data,
				));
		$this->display();
	}
	
	/*得到总积分
	 *@param array array[0] 等级值;array[1] 进度;array[2]/array[3] 当前总积分/当前等级上限
	 */
	public function getGloryClass($totalCredit)
	{
		$proConf = get_pro_config_content('proConfig');
		foreach($proConf['gloryClass'] as $key => $value)
		{
			$credit_array = explode('-',$value);
			if(count($credit_array) == 2)
			{
				$credit1 = intval($credit_array[0]);
				$credit2 = intval($credit_array[1]);
				if($totalCredit>=$credit1 && $totalCredit<=$credit2)
				{
					$class = $key - 1;
					$classProgress = ($totalCredit-$credit1)*204/($credit2-$credit1);
					return array($class, $classProgress, $totalCredit, $credit2);
				}
			}
			else if(count($credit_array) == 1)
			{
				$credit1 = intval($credit_array[0]);
				if($totalCredit>=$credit1)
				{
					return array($key-1, 204, $totalCredit, $totalCredit);
				}
			}
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
					$channel[$key]['linkUrl'] = 'Learning/learningEarly?arrange=month&focus=ch_3';
				}
				else
				{
					$channel[$key]['linkUrl'] = 'Learning/learningPreschool?focus=ch_3';
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
	
	
}