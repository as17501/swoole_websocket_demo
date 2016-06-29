<?php
require_once 'baseController.php';

class pokerController extends baseController{
	function sitAction($data){
		//注释为主动推送模式
		//$this->ws 为swoole类， $this->fd为当前连接号
		//$this->ws->push($this->fd, json_encode($data));

		//下面返回值会直接推送回客户端
		return $data;
	}
}
?>
