<?php


//创建进程
//进程对应的执行函数

function doProcess(swoole_process $process){
    echo "PID",$process->pid,"\n";
    sleep(10);
}

function doProcess1(swoole_process $process){
    echo "PID",$process->pid,"\n";
    var_dump($process);
    sleep(8);
}
function doProcess2(swoole_process $process){
  
    echo "doProcess2PID",$process->pid,"\n";
    sleep(12);
 }

//创建进程
$pro = new swoole_process("doProcess");
$pid = $pro->start();

//创建进程
$pro = new swoole_process("doProcess1");
$pid = $pro->start();

//创建进程
$pro = new swoole_process("doProcess2");
$pid = $pro->start();

swoole_process::wait();