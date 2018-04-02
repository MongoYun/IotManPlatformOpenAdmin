<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 23:24
 */
function GetDb(){
    global $Config;
    return include $Config['DefaultDatabaseInitPhpFileName'];//初始化数据库连接
}
function GetDbByPdo(){
    global $Config;
    $servername = $Config['DbHost'];
    $username = $Config['DbUser'];
    $password = $Config['DbPwd'];
    $dbname = $Config['DbName'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    if($Config['DbDebug']){

    }else{
        // 设置 PDO 错误模式为异常
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $conn ;//初始化数据库连接
}