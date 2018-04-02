<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 21:29
 */
class TestDeviceCodeModelController{
    function Index($ControllerName,$MethodName,$GetParameter){
        echo "你调用的是".$ControllerName."的".$MethodName."方法 "."GetParameter ";var_dump($GetParameter);
        $DeviceCodeModel=NewModel("DeviceCode");//new一个model的类
        $Map["DeviceCodeKey"]=$GetParameter['DeviceCodeKey'];
        echo $DeviceCodeModel->AddDeviceCode($Map);
        var_dump($DeviceCodeModel->SelectDeviceCode($Map));
    }
}