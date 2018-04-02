<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 21:05
 */
//header("Content-type: text/html; charset=utf-8");
include dirname(dirname(__FILE__)) . '/Common/IPCommon.class.php';
class IpToPlaceController
{
    function Index($ControllerName, $MethodName, $GetParameter)
    {
        //echo "你调用的是" . $ControllerName . "的" . $MethodName . "方法 " . "GetParameter ";
        $IPClass=new IP();
        $IPClass->initIPDataBase();
        $IpPlace=$IPClass->find($_POST['Ip']);
        echo $IpPlace[0].$IpPlace[1].$IpPlace[2];
        $IPClass->closeIPDataBase();
        //var_dump($GetParameter);
    }
}