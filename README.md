接收参数格式为json：
{"command":"poker_sit","params":{"a":"b"}}
说明：  控制器_方法，参数array

返回参数
 {"command":"poker_sit","params":{"a":"b"},"retrundata":{"a":"b"}}
说明：  发送者调用的控制器_方法，发送者调用的参数array,服务器返回的参数

数据库调用
$db = $this->db;

data文件夹存放的是数据库日志，只保存了出错的sql
