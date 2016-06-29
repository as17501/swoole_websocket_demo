<?php
class params{
	//系统参数
	static  public $info = [
			'version' => '0.01',
			
	];
	
	//数据库信息
	static public $db = [
		'server'=>'localhost',
		'username'=>'root',
		'password'=>'123456',
		'database'=>'test'
	];
	static public $ws_info = array(
		'reactor_num' => 2, //reactor thread num
		'worker_num' => 3,    //worker process num
		'max_request' => 50,
		'dispatch_mode' => 2,
		//'max_conn' =>3,
// 		'heartbeat_idle_time' => 300,//心跳检测，60秒检测一次，300秒内无反应的自动断开
// 		'heartbeat_check_interval' => 60,
	);
	
	static public function decode($value='')
	{
		//jiemi
		return json_decode($value,true);
	}
	static public function encode($value='')
	{
		//jiami
		return json_encode($value,JSON_UNESCAPED_UNICODE);
	}
	//自动加载类
	static public function autoload($controller_name){
		$controller_file = SITE_PATH.'/app/controllers/'.$controller_name.'.php';//获取控制器文件
		if(file_exists($controller_file)){
			require_once($controller_file);
		}else{
			throw new Exception("can't fand controller $controller_name !");
			//$ws->push($frame->fd, json_encode("can\'t fand controller $controller !"));
		}
	}
	
}
