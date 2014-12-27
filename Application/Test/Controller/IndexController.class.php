<?php

/**
 * 测试
 * @author CGY
 *
 */

namespace Test\Controller;

class IndexController extends \Think\Controller {
	
	public function indexAct(){
		//$this->testLibAct();
		
        $this->assign(array(
            'HTTP_HOST' => $_SERVER['HTTP_HOST']
        ));
		$this->display();
	}
	
	public function phpRPCAct(){
		Vendor('phpRPC.phprpc_client');
		$client = new \PHPRPC_Client('http://localhost:8500/Api/RpcTest');
		$result = $client->test();
		dump($result);
	}
	
	public function hproseAct(){
		vendor('Hprose.HproseHttpClient');
		$client = new \HproseHttpClient('http://localhost:8500/Api/UserApi');
		$result = $client->add(array('id'=>1));
		dump($result);
	}
	
	public function jsonRPCAct(){
		vendor('jsonRPC.jsonRPCClient');
		$client = new \jsonRPCClient('http://localhost:8500/Api/JsonRPCTest');
		$result = $client->test();
		var_dump($result); // 结果：
	}
	
	public function testLibAct(){
		vendor('Hprose.HproseHttpClient');
		$client = new \HproseHttpClient('http://192.168.0.154:8500/Api/LibraryApi');
		$result = $client->queryLib(6);
		dump($result);
	}
	
}