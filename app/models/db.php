<?php
include_once 'log.php';
class db{
	private $host;//服务器地址
	private $root;//用户名
	private $password;//密码
	private $database;//数据库名

	//通过构造函数初始化类
	function __construct(){
		$dbinfo = params::$db;
	    $this->host = $dbinfo['server'];
	    $this->root = $dbinfo['username'];
	    $this->password = $dbinfo['password'];
	    $this->database = $dbinfo['database'];
	    $this->connect();
	}
	//创建连接数据库及关闭数据库方法
	function connect(){
	    $this->conn = @mysql_connect($this->host,$this->root,$this->password);
	    if (!$this->conn){	die('Could not connect: ' . mysql_error()); }
	    mysql_select_db($this->database,$this->conn);
	    mysql_query("set names utf8");
	}
	        
	function dbClose(){
	    mysql_close($this->conn);
	}

	function query($sql){
		$re = mysql_query($sql);
		if(!$re){
			log::write('error !!!!'.date("Y-m-d H:i:s" ,time())."       ".$sql);
		}else{
			//log::write(date("Y-m-d H:i:s" ,time())."       ".$sql);
		}
	    return $re;
	}
	       
	function myArray($result){
		$data=array();
		if($result){
			while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
				$data[]=$row;
			}
		}		
	    return $data;
	}
	function getfirst($result){
		if(!$result){ return array();}
		return  mysql_fetch_array($result,MYSQL_ASSOC);
	}
	function rows($result){
	    return mysql_num_rows($result);
	}
	//自定义查询数据方法
	function select($tableName,$condition){
	    return $this->query("SELECT * FROM $tableName where $condition");
	}
	//自定义插入数据方法
	function insert($tableName,$fields,$value){
	    return $this->query("INSERT INTO $tableName ($fields) VALUES ($value)");
	}
	//自定义修改数据方法
	function update($tableName,$change,$condition){
	   return  $this->query("UPDATE $tableName SET $change where $condition");
	}
	//自定义删除数据方法
	function delete($tableName,$condition){
	   return  $this->query("DELETE FROM $tableName where $condition");
	}
}
?>