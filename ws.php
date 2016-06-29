<?php
//this code use for phpwebsocket
define('SITE_PATH',str_replace('','/',dirname(__FILE__)));//定义系统目录
include_once 'app/info.php';

//启动服务器，并绑定table
$ws = new swoole_websocket_server("0.0.0.0", 9001);
$ws->user = $user;

$ws->set(params::$ws_info);
//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
	//var_dump($request->fd, $request->server);
	echo "some one join us , id = ".$request->fd."\n";
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
	
	$data = params::decode($frame->data);
	if($data && is_array($data) && $data['command']){	
		$re['command'] = $data['command'];
		$re['params'] = $data['params'];	
		$c = explode('_', $data['command']);
		$controller = (!empty($c[0]))?$c[0]:'index';//获取控制器,默认index
		$action = (!empty($c[1]))?$c[1]:'index';//方法名称，默认index
		$controller_name = $controller.'Controller';
		try {
			$controller_obj = new $controller_name($ws,$frame->fd);
			if (method_exists($controller_obj,$action.'Action')){
				$re['retrundata'] = $controller_obj->{$action.'Action'}($data['params']);
				
				//$ws->push($frame->fd,str_replace("\/", "/",params::encode($re)));
			}else{
				$re['retrundata']['code'] = 0;
				$re['retrundata']['message'] = "can't fand action $controller/$action!";
				//echo ("can\'t fand action $controller/$action!\n");
				//$ws->push($frame->fd, json_encode("can\'t fand action $controller/$action !"));
			}
		}catch (Exception $e){
			$re['retrundata']['code'] = 0;
			$re['retrundata']['message'] = $e->getMessage();
			//$ws->push($frame->fd, json_encode($re));
		}
		$ws->push($frame->fd,params::encode($re));
		
	}
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
	echo "client-".$fd." is closed\n";
});


//自动注册类
spl_autoload_register(array('params', 'autoload'));
$ws->start();
