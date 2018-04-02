<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 21:29
 */
class UserSDeviceController{
//    function Index($ControllerName,$MethodName,$GetParameter){
//        echo "你调用的是".$ControllerName."的".$MethodName."方法 "."GetParameter ";var_dump($GetParameter);
//        $UserSDeviceModel=NewModel("UserSDevice");//new一个model的类
//        $Map["UserName"]=$_SESSION['UserName'];
//        $Map["DeviceId"]="DeviceId";
//        $Map["DeviceUserName"]="DeviceUserName";
//        $Map["DevicePasswd"]="DevicePasswd";
//        echo $UserSDeviceModel->AddUserSDevice($Map);
//        echo "</BR>";echo "</BR>";
//        var_dump($UserSDeviceModel->SelectUserSDevice($Map));
//        echo "</BR>";echo "</BR>";
//        $Map2["DevicePasswd"]="DevicePasswd2222222";
//        echo $UserSDeviceModel->UpdateUserSDevice($Map,$Map2);
//        echo $UserSDeviceModel->DeleteUserSDevice($Map2);
//    }
    function Add($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null){
            echo json_encode ($Resault);
            return;
        }
        $PostData=json_decode($_POST['PostData'],true);
        $Map["UserName"]=$_SESSION['UserName'];
        $Map["DeviceId"]=$PostData['DeviceId'];
        $Map["DeviceUserName"]=$PostData['DeviceUsername'];
        $Map["DevicePasswd"]=$PostData['DevicePassword'];
	if($Map["DeviceId"]!=null
            &&$Map["DeviceId"]!=null
            &&$Map["DevicePasswd"]!=null){
	    $UserSDeviceModel=NewModel("UserSDevice");//new一个model的类
	    $DeviceCertColModel=NewModel("DeviceCertCol");//new一个model的类 
	    $MapWhere["DeviceId"]=$PostData['DeviceId'];
	    $CertColMapWhere["ClientId"]=$PostData['DeviceId'];
            if($UserSDeviceModel->SelectUserSDevice($MapWhere)==null
               &&$DeviceCertColModel->SelectDeviceCertCol($CertColMapWhere)==null
		){//检查是否已存在
		$DevCertColMap["ClientId"]=$Map["DeviceId"];
		$DevCertColMap["UserName"]=$Map["DeviceUserName"];
		$DevCertColMap["UserPasswd"]=$Map["DevicePasswd"];
                if($UserSDeviceModel->AddUserSDevice($Map)!=null
		   && $DeviceCertColModel->AddDeviceCertCol($DevCertColMap)!=null
		){//添加
                    $Resault=array(
                        'status' => 0,
                        'status_information' => '添加设备成功'
                    );
                }else{
                    $Resault=array(
                        'status' => 2,
                        'status_information' => '添加设备出错'
                    );
                }
            }else{
                $Resault=array(
                    'status' => 2,
                    'status_information' => '此设备已存在'
                );
            }
        }else{
            $Resault=array(
                'status' => 3,
                'status_information' => '参数不完整'
            );
        }
        echo json_encode ($Resault);
    }
    function Select($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null){
            echo json_encode ($Resault);
            return;
        }
        $PostData=json_decode($_POST['PostData'],true);
        $Map["UserName"]=$_SESSION['UserName'];
        if($Map["UserName"]!=null){
            $UserSDeviceModel=NewModel("UserSDevice");//new一个model的类
            $TempList=$UserSDeviceModel->SelectUserSDevice($Map);
            if($TempList!=null){//检查是否已存在
                $TempResault=array(
                    'status' => 0,
                    'status_information' => '获取设备列表成功',
                    'data'=>$TempList
                );
                $Resault=json_encode($TempResault);//json的格式输出
            }else{
                $Resault=array(
                    'status' => 2,
                    'status_information' => '设备列表为空'
                );
            }
        }else{
            $Resault=array(
                'status' => 3,
                'status_information' => '参数不完整'
            );
        }
        echo json_encode ($Resault);
    }
    function Delete($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null){
            echo json_encode ($Resault);
            return;
        }
        $PostData=json_decode($_POST['PostData'],true);
        $Map["UserName"]=$_SESSION['UserName'];
        $Map["DeviceId"]=$PostData['DeviceId'];
        $Map["DeviceUserName"]=$PostData['DeviceUserName'];
        $Map["DevicePasswd"]=$PostData['DevicePasswd'];
        if($Map["DeviceId"]!=null
	    &&$Map["DeviceUserName"]!=null
            &&$Map["DevicePasswd"]!=null){
            $UserSDeviceModel=NewModel("UserSDevice");//new一个model的类
            $DeviceCertColModel=NewModel("DeviceCertCol");//new一个model的类 
            $MapWhere["DeviceId"]=$PostData['DeviceId'];
            $DevSelect=$UserSDeviceModel->SelectUserSDevice($Map);
	    $CertColMapWhere["ClientId"]=$PostData['DeviceId'];
	    $DevCertCol=$DeviceCertColModel->SelectDeviceCertCol($CertColMapWhere);
	    if($DevSelect!=null
	       &&$DevSelect[0]["UserName"]==$Map["UserName"]
               &&$DevCertCol!=null
		){//检查是否已存在
                $temp=$DeviceCertColModel->DeleteDeviceCertCol($CertColMapWhere);
		$tempp=$UserSDeviceModel->DeleteUserSDevice($MapWhere);
		if($tempp!=null
                &&$temp!=null
		){//删除
                    $Resault=array(
                        'status' => 0,
                        'status_information' => '删除设备成功'
                    );
                }else{
                    $Resault=array(
                        'status' => 2,
                        'status_information' => '删除设备出错'
                    );
                }
            }else{
                $Resault=array(
                    'status' => 3,
                    'status_information' => '此设备不存在'
                );
            }
        }else{
            $Resault=array(
                'status' => 5,
                'status_information' => '参数不完整'
            );
        }
        echo json_encode ($Resault);
    }
}
?>
