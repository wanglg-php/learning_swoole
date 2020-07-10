<?php



$server = new Swoole\Websocket\Server("0.0.0.0", 9502);

$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
    $GLOBALS['fd'][$req->fd]['id'] = $req->fd;//设置用户id
    $GLOBALS['fd'][$req->fd]['name'] = '户名';
});

$server->on('message', function($server, $frame) {
    // echo "received message: {$frame->data}\n";
    // $server->push($frame->fd, json_encode(["hello", "world"]));

    $msg = $GLOBALS['fd'][$frame->fd]['name']."：".$frame->data."\n";//设置用户id
    if(strstr($frame->data,"#name#")){ //用户昵称设置
        $GLOBALS['fd'][$frame->fd]['name'] = str_replace('#name#',"",$frame->data);
    }else{ // 进行信息发送
        //发送每一个客户端
        foreach($GLOBALS['fd'] as $i){
            $server->push($i['id'],$msg);
        }
    }
});

$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
    unset($GLOBALS['fd'][$fd]);
});

$server->start();