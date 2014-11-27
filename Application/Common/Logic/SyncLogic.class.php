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
		
		/* $productKeys = array('Product','Config','Notice','Channel','SpecialType','Credit');//产品缓存：产品信息、产品配制、公告、栏目,专题分类配制、积分 
		$adKeys = array('AdSpace','Ad');//广告位、广告
		$groupKeys = array('Class','Special');  //多分组，以$KEY_二级ID为索引
		
		if(in_array($key,$productKeys)){ 
			$product = S('Product');
			$product[$key] = $data;
			S('Product',$product);
		}elseif(in_array($key,$adKeys)){ 
			$ad = S('Ad');
			$ad[$key] = $data;
			S('Ad',$ad);
		}elseif(in_array($key,$groupKeys)){ //分类(按栏目分组）
			foreach($data as $k=>$v){
				S($key.'_'.$k,$v);
			}
		}else{ //其它单个
			S($key,$data);
		}		 */
	}
	
}