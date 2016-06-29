<?php


//用户内存
//$user->set('连接id', array('id' => 用户id, 'name' => '用户名');
$user = new swoole_table(2048);
$user->column('id', swoole_table::TYPE_INT,8);
$user->column('username', swoole_table::TYPE_STRING,32);

$user->create();

?>
