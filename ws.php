<?php

//创建websocket 服务器
$ws = new swoole_websocket_server('0.0.0.0',9503);

/**
 * open 建立连接
 * ws 服务器
 * request 客户端信息
 */
$ws->on('open',function($ws,$request){
    var_dump($request);
    $ws->push($request->fd,"welcome \n");
});

//message 接收信息
$ws->on('message',function($ws,$request){
    echo "Message:".$request->data;
    $ws->push($request->fd,"get it message \n");
});

//close 关闭连接
$ws->on('close',function($ws,$request){
    echo "close \n";
    
});

$ws->start();

