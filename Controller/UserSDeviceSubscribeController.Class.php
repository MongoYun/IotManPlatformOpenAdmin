<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 21:29
 */
class UserSDeviceSubscribeController{
    function Index($ControllerName,$MethodName,$GetParameter){
        echo "你调用的是".$ControllerName."的".$MethodName."方法 "."GetParameter ";var_dump($GetParameter);
        $UserSDeviceSubscribeModel=NewModel("UserSDeviceSubscribe");//new一个model的类
        $Map["TopicName"]="TopicName";
        $Map["ClientId"]="ClientId";
        $Map["QoSLevel"]="1";
        echo $UserSDeviceSubscribeModel->AddUserSDeviceSubscribe($Map);
        echo "</BR>";echo "</BR>";
        var_dump($UserSDeviceSubscribeModel->SelectUserSDeviceSubscribe($Map));
        echo "</BR>";echo "</BR>";
        $Map2["QoSLevel"]="2";
        echo $UserSDeviceSubscribeModel->UpdateUserSDeviceSubscribe($Map,$Map2);
        //echo $UserSDeviceSubcribeModel->DeleteUserSDeviceSubscribe($Map2);
    }
}
?>