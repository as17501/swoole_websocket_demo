<?php
require_once 'baseController.php';
class systemController extends baseController{
	
	//1、系统接口---重启
	function reloadAction(){
		if($this->ws->reload()){
			echo "system reload succes!\n";
			return ('system reload succes!');
		}else{
			echo "system reload error!\n";
			return ('system reload succes!');
		}
		
	}
	//2、系统接口---关闭
	function shutdownAction(){
		if($this->ws->shutdown()){
			echo "system shutdown succes!\n";
		}else{
			echo "system shutdown error!\n";
		}
	
	}
	//3主动断开连接
	function closeAction(){
		$this->ws->close($this->fd);exit();
	}
	
}
?>
