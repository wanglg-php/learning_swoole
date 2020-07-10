<?php
//创建TCP 服务器
$server = new swoole_server('0.0.0.0',9505);

//设置异步 进程工作数
$server->set(['task_worker_num'=>4]);

//投递异步任务
$server->on('receive',function($server,$fd,$from_id,$data){
   $task_id = $server->task($data);
   echo "执行 异步任务ID: $task_id \n";
});

//处理异步任务
$server->on('task',function($server,$task_id,$from_id,$data){
    echo "执行 异步任务ID: $task_id";
    $server->finish("$data -> OK");
});

$server->on('finish',function($server,$task_id,$data){
    echo "执行成功";
});
$server->start();