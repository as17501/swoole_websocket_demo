<?php
class baseController{
	public $ws;
	public $fd;
	public $db;
	function __construct($ws,$fd){
		$this->ws = $ws;
		$this->fd = $fd;
		$this->db = new db();

		
 	}
 	//参数出错
 	static function param_error(){
 		$this->ws->push($this->fd, json_encode('params error!!!'));
 		exit();
 	}
 	function __destruct(){
 		$this->db->dbClose();
 	}
}



?>
