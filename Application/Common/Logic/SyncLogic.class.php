<?php

/**
 * 逻辑处理类：与平台同步
 */
namespace Common\Logic;
class SyncLogic{
	
	/**
	 * 获取平台同步数据
	 */
	public function syncData(){		
		$param = $_POST['param'];
		$sign  = $_POST['sign'];		
		if($sign != md5($param.C('CHECK_CODE'))){
			return result_data(0,'数据签名错误！');
		}else{
			$param = json_decode($param,true);
			switch ($param['action']){
			case "test": //通信测试
				return result_data(1,'通信测试成功！');
			case "data": //数据通知
				if(empty($param['name'])){	//全部
					foreach($param['data'] as $key=>$data){
						$this->saveData($key,$data);
					}					
				}else{
					$this->saveData($param['name'],$param['data']);
				}
				return result_data(1,'数据同步成功！');
			default:	//异常操作
				return 	result_data(0,'异常操作，操作类型：'.$param['action']);
			}
		}		
	}
		
	/**
	 * 保存数据
	 * @param str $key
	 * @param arr $data
	 */
	private function saveData($key,$data){
		S($key,$data);
		save_log('sync_test',array($key));
	}
	
}