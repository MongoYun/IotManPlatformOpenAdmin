<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 21:05
 */
header("Content-type: text/html; charset=utf-8");

class TestController
{
    function Index($ControllerName, $MethodName, $GetParameter)
    {
        echo "你调用的是" . $ControllerName . "的" . $MethodName . "方法 " . "GetParameter ";
        var_dump($GetParameter);
        $DeviceCodeModel = NewModel("DeviceCode");//new一个model的类
        $Map["DeviceCodeKey"] = $GetParameter['DeviceCodeKey'];
        $DeviceCodeModel->AddDeviceCode($Map);
        $DeviceCodeModel->SelectDeviceCode($Map);
    }
}