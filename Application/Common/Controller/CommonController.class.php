<?php
/**
 * 控制器基类
 * @author CGY
 *
 */
namespace Common\Controller;
class CommonController extends \Think\Controller{
	
	
	
	//消息页面图片及按钮常量
	const ICON_ERROR	= 1; //错误消息
	const ICON_SUCCESS	= 2; //成功消息
	const ICON_INFO		= 3; //提示消息
	const ICON_QUESTION = 4; //询问消息
	const ICON_WARNING	= 5; //警告消息
	
	public $user = '';	//当前用户
	public $role = '';	//当前角色
	
	protected $name 	= '';	//控制器名
	public $topChannel 	= '';	//一级栏目
	
	public function _initialize(){
		//控制器名
		$className = explode('\\', get_class($this));
		$className = $className[count($className)-1];
		$this->name = substr($className,0,-10);
		
		//初始化用户信息
		$this->_initUser();
		//初始化一级栏目
	    $this->_initTopChannel();
	    header("Content-Type: text/html;charset=utf-8");
	}
	
	
	/**
	 * 空操作
	 * 第一次默认调用父类分组相应操作，如果也不存在，则报错
	 */
	public function _empty(){
		if(PARENT_MODULE == MODULE_NAME){ //直接访问父类分组
			if(C('AREA_VER') == 1){
                $this->showMessage('页面不存在或本操作不可用！',self::ICON_ERROR,'');
            }else{
                $this->showMessage('页面不存在或本操作不可用！',self::ICON_ERROR,'','Public:404');
            }
		}else{
			if(defined('EMPTY_ACTION')) return;
			define('EMPTY_ACTION',true);
			//调用父类
			if(R(C('PARENT_MODULE').'/'.CONTROLLER_NAME.'/'.ACTION_NAME)===false){
				if(C('AREA_VER') == 1){
                    $this->showMessage('页面不存在或本操作不可用！',self::ICON_ERROR,'');
                }else{
                    $this->showMessage('页面不存在或本操作不可用！',self::ICON_ERROR,'','Public:404');
                }
			}
		}
	}
	
	
	/**
	 * 初始化用户信息
	 */
	private function _initUser(){
		$r = D('User','Logic')->LoginChecking();
		if($r['status']){
			$this->user = unserialize(Session('user'));
			$this->role = unserialize(Session('role'));
		}else{
			//初始化用户信息异常
			$this->showMessage($r['info'],self::ICON_ERROR);
		}
	}
	
	/**
	 * 初始化一级栏目
	 */
	private function _initTopChannel(){
		$channel = S('Channel');
		$this->topChannel = get_array_for_fieldval($channel,'level',0);
		$this->topChannel = get_array_for_fieldval($this->topChannel,'isShow','1');
		
		//把栏目的图片数组拆开
		foreach ($this->topChannel as $k=>$v){
			if($v['imgUrl']){
				$char = getDelimiterInStr($v['imgUrl']);
				$imgs = explode($char, $v['imgUrl']);
				$this->topChannel[$k]['linkImage']  = get_upfile_url(trim($imgs[0]));
				$this->topChannel[$k]['focusImage'] = get_upfile_url(trim($imgs[1]));
				$this->topChannel[$k]['titleImage'] = get_upfile_url(trim($imgs[2]));
			}
		}
		
		//把栏目key值初始为从0开始的递增的值，前端按钮调用统一
		$this->topChannel = array_slice($this->topChannel,0,count($this->topChannel));
	}
	
	/**
	 * 获取龄段顶级分类(顶级栏目-全部课程下的二级栏目)
	 * 先获取顶级栏目-全部课程，然后再获取全部课程下的二级栏目(顶级分类)
	 */
	public function getClass(){
		$channel = S('Channel');
		$topChannel = get_array_for_fieldval($channel, 'chKey','allcourse');
		$topChannel = array_slice($topChannel,0,count($topChannel));
		$id = $topChannel[0]['id'];
		$class = get_array_for_fieldval($channel, 'pId',$id);//二级栏目(顶级分类)
		
		//把class的图片地址加上绝对路径
		foreach ($class as $k => $v){
			$class[$k]['imgUrl'] = get_upfile_url($v['imgUrl']);
		}
		
		return $class;
	}
	
	/**
	 * 获取角色对应的龄段信息
	 * @param obj $role
	 */
	public function getStage($stageId){
		$stages = S('Stage');
		return $stages[$stageId];
	}
	
	/**
	 * 根据角色龄段id获取角色对应的年级(顶级分类或二级分类)
	 * @param unknown_type $roleStage
	 */
	public function getGrade($chId){
		$class = $this->getClass();
		return $class[$chId];
	}
	
	/**
	 * 获取龄段的默认月龄
	 * @param $stageId 龄段id
	 */
	public function getDefMonth($stageId){
		$stage = $this->getStage($stageId);
		if($stage['sKey'] == 'three') 
			return 25;
		elseif($stage['sKey'] == 'two')
			return 13;
		else
			return 1;
	}
	
	public function isValidMonth($role,$month){
		if(empty($role)) $role = $this->role;
		
		$stage = $this->getStage($role['stageId']);
		if($stage['sKey'] == 'three')
			if($month <= 36 && $month >24)
				return true;
		elseif($stage['sKey'] == 'two')
			if($month <= 24 && $month >12)
				return true;
		else
			if($month <= 12 && $month >0)
				return true;
		
		return false;
	}
	
	/**
	 * 根据广告位的key获取该广告位下的广告
	 * @param string $asKey
	 */
	public function getAdByasKey($asKey){
		$adSpace = get_adSpace($asKey);
		$asId = $adSpace[0]['id'];
		$ad = get_ad($asId);
		
		//如果广告有图片则把图片的绝对路径加上(还没找到好方法在前端处理，如果有请提出来...)
		foreach ($ad as $k => $v){
			if(!empty($v['content']))
				$ad[$k]['content'] = get_upfile_url($v['content']);
		}
		
		//如果只有一个广告，则把二维数组改成一维数组
		if(count($ad) == 1){
			$ad = $ad[0];
		}
		return $ad;
	}
	
	/**
	 * 获取角色的月龄
	 * @param unknown_type $role
	 */
	public function getMonthOfRole($role){
		if(empty($role)) $role = $this->role;
		$m = monthNum($role['birthday']);
		$roleMonthNum = $m['status'] ? $m['data']['monthNum'] : $this->getDefMonth($role['stageId']);
		return $roleMonthNum;
	}
	
	/**
	 * 添加浮动消息
	 * @param string $message
	 */
	public function addFloatMessage($message,$url=''){
		add_float_message($message,$url);		
	}	
    
	/**
	 * 显示消息页面
	 * @param string $message 消息内容
	 * @param int $icon 消息类型
	 * @param string $template 模板
	 */
	public function showMessage($message,$icon=self::ICON_INFO,$url,$template=''){
		$this->assign(array(
			'message' 	=> $message,
			'icon'		=> $icon,
			'url'		=> $url,
		));
		if(empty($template)) $template = 'Public:message';
		$this->display($template);
		exit;
	}
}