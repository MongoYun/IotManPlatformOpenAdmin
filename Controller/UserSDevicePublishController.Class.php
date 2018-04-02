<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 21:29
 */
class UserSDevicePublishController{
    function Index($ControllerName,$MethodName,$GetParameter){
        echo "你调用的是".$ControllerName."的".$MethodName."方法 "."GetParameter ";var_dump($GetParameter);
        $UserSDevicePublishModel=NewModel("UserSDevicePublish");//new一个model的类
        $Map["TopicName"]="TopicName";
        $Map["ClientId"]="ClientId";
        echo $UserSDevicePublishModel->AddUserSDevicePublish($Map);
        echo "</BR>";echo "</BR>";
       var_dump($UserSDevicePublishModel->SelectUserSDevicePublish($Map));
        echo "</BR>";echo "</BR>";
        $Map2["ClientId"]="ClientId222222";
        echo $UserSDevicePublishModel->UpdateUserSDevicePublish($Map,$Map2);
        //echo $UserSDevicePublishModel->DeleteUserSDevicePublish($Map2);
    }
}
?>