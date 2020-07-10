<?php
// 创建服务器
$host = '0.0.0.0';#需要监听的IP
$port = 9501;
#$mode = 'SWOOLE_PROCESSS';#SWOOLE_PROCESSS 多进程
#$sock_type = 'SWOOLE_SOCK_TCP';# SWOOLE_SOCK_TCP 
$server = new swoole_server($host,$port);


/**
 * $swoole_server->on(string $event,mixed $callbak);
 * $event :connect,receive,close
 * $callbak :回调函数
 */

/**
 * connect 建立连接时
 * server 服务端信息
 * fd 客户端信息
 */
$server->on('connect',function($server,$fd){
	#var_dump($server);
	#var_dump($fd);
	echo "建立连接";
});

/**
 * receive 接收到数据
 * from_id 客户端ID
 * data 数据
 */
$server->on('receive',function($server,$fd,$from_id,$data){
	var_dump($data);
	echo "接收到数据";
});

/**
 * close 关闭连接
 */
$server->on('close',function($server,$fd){
	echo "连接关闭";
});

$server->start();//启动服务器
