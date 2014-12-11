<?php

/**
 * 控制器：首页
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class IndexController extends CommonController {
	
	public function indexAct(){
		//欢迎页，如果有跳转至欢迎页
		
		//检查用户是否有角色帐号，没有则跳转至创建角色页面
		//有则使用用户最近使用的角色帐号进入产品
		$user = unserialize(Session('user'));
		$roleList = Session('roleList');
		if(count($roleList) < 1){
			header('location:'.U('Role/createRole'));
		}
		
		$this->assign(array(
			'role'		 =>	unserialize(Session('role')),	
			'topChannel' => $this->topChannel,	
		));
		$this->display();
	}
	
	/**
	 * 欢迎页
	 */
	public function wecomeAct(){}
	
}