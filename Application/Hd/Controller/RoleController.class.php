<?php

/**
 * 控制器：角色
 * @author CGY
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class RoleController extends CommonController {
	
	/**
	 * 创建角色
	 */
	public function createRoleAct(){
		$id = I('id','');
		$user = unserialize(Session('user'));
		if(empty($id)){
			//顶级分类(二级栏目)
			$class = $this->getClass();	
			//龄段
			$stage = S('Stage');
			foreach ($stage['Stage'] as $k=>$v){
				$data[$class[$v['chId']]['chKey']][$v['id']] = $v;
			}
			$this->assign(array('stage' => $data));
		}else{
			$role = array('stageId'=>$id,'userId'=>$user['id'],'status'=>1);
			$r = D('Role','Logic')->save($role);
			if($r['status']){ //创建成功跳转至首页
				D('Role','Logic')->initUserRoleInfo();//重新加载角色信息
				header('location:'.U('Index/index'));
			}else{
				$this->showMessage('角色创建失败：'.$r['info']);
			}
		}
		$this->display();
	}
}