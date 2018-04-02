<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 21:29
 */
class AllUserSDeviceStatusController{
//    function Index($ControllerName,$MethodName,$GetParameter){
//        echo "你调用的是".$ControllerName."的".$MethodName."方法 "."GetParameter ";var_dump($GetParameter);
//        $UserSDeviceStatusModel=NewModel("UserSDeviceStatus");//new一个model的类
//        $Map["ClientId"]="ClientId";
//        $Map["NowStatus"]="NowStatus";
//        $Map["KeepAliveTime"]="1";
//        $Map["OnlineTimeStamp"]="OnlineTimeStamp";
//        $Map["OfflineTimeStamp"]="1";
//        echo $UserSDeviceStatusModel->AddUserSDeviceStatus($Map);
//        echo "</BR>";echo "</BR>";
//        var_dump($UserSDeviceStatusModel->SelectUserSDeviceStatus($Map));
//        echo "</BR>";echo "</BR>";
//        $Map2["OfflineTimeStamp"]="2";
//        echo $UserSDeviceStatusModel->UpdateUserSDeviceStatus($Map,$Map2);
//        //echo $UserSDeviceSubcribeModel->DeleteUserSDeviceSubcribe($Map2);
//    }
    function Select($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null || $_SESSION['UserName']!="admin"){
            echo json_encode ($Resault);
            return;
        }
        $Map["1"]="1";
        //if($Map["UserName"]!=null){
            $UserSDeviceModel=NewModel("UserSDevice");//new一个model的类
            $TempList=$UserSDeviceModel->SelectUserSDevice($Map);
            $UserSDeviceStatusModel=NewModel("UserSDeviceStatus");//new一个model的类
            if($TempList!=null){//检查是否已存在
                $DeviceStatusList=array();
                foreach($TempList as $k=>$v){
                    $MapStatus["ClientId"]=$v['DeviceId'];
                    $TempSatus=$UserSDeviceStatusModel->SelectUserSDeviceStatus($MapStatus);
                    if($TempSatus!=null && $TempSatus[0]!=null){
                        $DeviceStatusList[]=$TempSatus[0];
                    }

                }
                $TempResault=array(
                    'status' => 0,
                    'status_information' => '获取设备状态列表成功',
                    'data'=>$DeviceStatusList
                );
                $Resault=json_encode($TempResault);//json的格式输出
            }else{
                $Resault=array(
                    'status' => 2,
                    'status_information' => '设备状态列表为空'
                );
            }
        /*}else{
            $Resault=array(
                'status' => 3,
                'status_information' => '参数不完整'
            );
        }
        */
        echo json_encode ($Resault);
    }
}
?>