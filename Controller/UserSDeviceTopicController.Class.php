<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2018/1/9
 * Time: 10:17
 */
class UserSDeviceTopicController{
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

    function SelectTopicName($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null){
            echo json_encode ($Resault);
            return;
        }
        //$PostData=json_decode($_POST['PostData'],true);
        //$Map["TopicName"]=$PostData['TopicName'];
        $Map['UserName']=$_SESSION['UserName'];
        if($Map['UserName']!=null){
            $UserSTopicModel=NewModel("UserSTopic");//new一个model的类
            $TempList=$UserSTopicModel->SelectUserSTopic($Map);
            if($TempList!=null){//检查是否已存在
                //存在
                    $Resault=array(
                        'status' => 0,
                        'status_information' => '获取主题列表成功',
                        'data'=>$TempList
                    );
            }else{
                $Resault=array(
                    'status' => 1,
                    'status_information' => '当前用户没有主题'
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
    function AddTopicName($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null){
            echo json_encode ($Resault);
            return;
        }
        $PostData=json_decode($_POST['PostData'],true);
        $Map["TopicName"]=$PostData['TopicName'];
        if($Map["TopicName"]!=null){
            $UserSDevicePublishModel=NewModel("UserSDevicePublish");//new一个model的类
            $UserSDeviceSubscribeModel=NewModel("UserSDeviceSubscribe");//new一个model的类
            $UserSTopicModel=NewModel("UserSTopic");//new一个model的类
            $TempList=$UserSDevicePublishModel->SelectUserSDevicePublish($Map);
            if($TempList==null){//检查是否已存在
                if($UserSDeviceSubscribeModel->SelectUserSDeviceSubscribe($Map)==null){
                    $TopicMap["TopicName"]=$Map["TopicName"];
                    $TopicMap["UserName"]=$_SESSION["UserName"];
                    if($UserSTopicModel->AddUserSTopic($TopicMap)!=null){
                        $Resault=array(
                            'status' => 0,
                            'status_information' => '添加主题成功'
                        );
                    }else{
                        $Resault=array(
                            'status' => 1,
                            'status_information' => '添加主题失败'
                        );
                    }
                }else{
                    $Resault=array(
                        'status' => 1,
                        'status_information' => '当前主题已存在'
                    );
                }
            }else{
                $Resault=array(
                    'status' => 1,
                    'status_information' => '当前主题已存在'
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
    function SaveDeviceToPubTopicControl($ControllerName,$MethodName,$GetParameter){

        if($_SESSION['UserName']==null){
            $Resault=array(
                'status' => 5,
                'status_information' => '未登录'
            );
            echo json_encode ($Resault);
            return;
        }
        $PostData=json_decode($_POST['PostData'],true);
        $Map["TopicName"]=$PostData['TopicName'];
        $Map["ClientId"]=$PostData['DeviceId'];
        $Control=$PostData['Control'];
        //开始鉴权
        $UserSTopicModel=NewModel("UserSTopic");//new一个model的类
        $TopicMap["TopicName"]=$Map["TopicName"];
        $TopicMap["UserName"]=$_SESSION["UserName"];
        if($UserSTopicModel->SelectUserSTopic($TopicMap)==null){
            $Resault=array(
                'status' => 5,
                'status_information' => '无权限操作或者未添加主题'
            );
            echo json_encode ($Resault);
            return;
        }
        if($Map["TopicName"]!=null
            &&$Map["ClientId"]!=null
            &&$Control!=null){
            $UserSDevicePublishModel=NewModel("UserSDevicePublish");//new一个model的类
            $TempList=$UserSDevicePublishModel->SelectUserSDevicePublish($Map);
            if($TempList==null){//检查是否已存在
                if($Control=="1"){//使能
                    if($UserSDevicePublishModel->AddUserSDevicePublish($Map)!=null){
                        $Resault=array(
                            'status' => 0,
                            'status_information' => '添加成功',
                        );
                    }else{
                        $Resault=array(
                            'status' => 1,
                            'status_information' => '添加失败',
                        );
                    }
                }else{
                    $Resault=array(
                        'status' => 0,
                        'status_information' => '已删除',
                    );
                }
            }else{
                //主题已存在
                if($Control=="0"){//使能
                    if($UserSDevicePublishModel->DeleteUserSDevicePublish($Map)!=null){
                        $Resault=array(
                            'status' => 0,
                            'status_information' => '已删除',
                        );
                    }else{
                        $Resault=array(
                            'status' => 1,
                            'status_information' => '删除失败',
                        );
                    }
                }else{
                    $Resault=array(
                        'status' => 0,
                        'status_information' => '已删除',
                    );
                }
            }
        }else{
            $Resault=array(
                'status' => 3,
                'status_information' => '参数不完整'
            );
        }
        echo json_encode ($Resault);
    }
    function SaveDeviceToSubTopicControl($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null){
            echo json_encode ($Resault);
            return;
        }
        $PostData=json_decode($_POST['PostData'],true);
        $Map["TopicName"]=$PostData['TopicName'];
        $Map["ClientId"]=$PostData['DeviceId'];
        $Control=$PostData['Control'];
        //开始鉴权
        $UserSTopicModel=NewModel("UserSTopic");//new一个model的类
        $TopicMap["TopicName"]=$Map["TopicName"];
        $TopicMap["UserName"]=$_SESSION["UserName"];
        if($UserSTopicModel->SelectUserSTopic($TopicMap)==null){
            $Resault=array(
                'status' => 5,
                'status_information' => '无权限操作或者未添加主题'
            );
            echo json_encode ($Resault);
            return;
        }
        if($Map["TopicName"]!=null
            &&$Map["ClientId"]!=null
            &&$Control!=null){
            $UserSDeviceSubscribeModel=NewModel("UserSDeviceSubscribe");//new一个model的类
            $TempList=$UserSDeviceSubscribeModel->SelectUserSDeviceSubscribe($Map);
            if($TempList==null){//检查是否已存在
                if($Control=="1"){//使能
                    $Map["QoSLevel"]="2";
                    if($UserSDeviceSubscribeModel->AddUserSDeviceSubscribe($Map)!=null){
                        $Resault=array(
                            'status' => 0,
                            'status_information' => '添加成功，默认的Qos为2',
                        );
                    }else{
                        $Resault=array(
                            'status' => 1,
                            'status_information' => '添加失败',
                        );
                    }
                }else{
                    $Resault=array(
                        'status' => 0,
                        'status_information' => '已删除',
                    );
                }
            }else{
                //主题已存在
                if($Control=="0"){//使能
                    if($UserSDeviceSubscribeModel->DeleteUserSDeviceSubscribe($Map)!=null){
                        $Resault=array(
                            'status' => 0,
                            'status_information' => '已删除',
                        );
                    }else{
                        $Resault=array(
                            'status' => 1,
                            'status_information' => '删除失败',
                        );
                    }
                }else{
                    $Resault=array(
                        'status' => 0,
                        'status_information' => '已删除',
                    );
                }
            }
        }else{
            $Resault=array(
                'status' => 3,
                'status_information' => '参数不完整'
            );
        }
        echo json_encode ($Resault);
    }
    function SaveDeviceToSubTopicControlQosLevel($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null){
            echo json_encode ($Resault);
            return;
        }
        $PostData=json_decode($_POST['PostData'],true);
        $Map["TopicName"]=$PostData['TopicName'];
        $Map["ClientId"]=$PostData['DeviceId'];
        $Qos=$PostData['Qos'];
        //qos过滤
        if($Qos!="0"
            &&$Qos!="1"
            &&$Qos!="2"){
            $Resault=array(
                'status' => 0,
                'status_information' => 'qos参数错误',
            );
            echo json_encode ($Resault);
            return;
        }
        //开始鉴权
        $UserSTopicModel=NewModel("UserSTopic");//new一个model的类
        $TopicMap["TopicName"]=$Map["TopicName"];
        $TopicMap["UserName"]=$_SESSION["UserName"];
        if($UserSTopicModel->SelectUserSTopic($TopicMap)==null){
            $Resault=array(
                'status' => 5,
                'status_information' => '无权限操作或者未添加主题'
            );
            echo json_encode ($Resault);
            return;
        }
        if($Map["TopicName"]!=null
            &&$Map["ClientId"]!=null
            &&$Qos!=null){
            $UserSDeviceSubscribeModel=NewModel("UserSDeviceSubscribe");//new一个model的类
            $TempList=$UserSDeviceSubscribeModel->SelectUserSDeviceSubscribe($Map);
            if($TempList==null){//检查是否已存在
                //不存在
                $Resault=array(
                    'status' => 0,
                    'status_information' => '此主题不存在，请添加订阅权限',
                );
            }else{
                //主题已存在
                $Map['QoSLevel']=$Qos;
                if($UserSDeviceSubscribeModel->SelectUserSDeviceSubscribe($Map)!=null){
                    $Resault=array(
                        'status' => 0,
                        'status_information' => '修改成功',
                    );
                }else {
                    //修改qos
                    $Where["TopicName"]=$Map["TopicName"];
                    $Where["ClientId"]=$Map["ClientId"];
                    if($UserSDeviceSubscribeModel->UpdateUserSDeviceSubscribe($Where,$Map)!=null){
                        //修改成功
                        $Resault=array(
                            'status' => 0,
                            'status_information' => '修改成功',
                        );
                    }else{
                        $Resault=array(
                            'status' => 0,
                            'status_information' => '修改失败',
                        );
                    }
                }
            }
        }else{
            $Resault=array(
                'status' => 3,
                'status_information' => '参数不完整'
            );
        }
        echo json_encode ($Resault);
    }
    public function FindDevice($List,$DeviceId){
        foreach($List as $k=>$v){
            $key=array_search($DeviceId,$v);
            if($key!=null && $key="ClientId"){
                return $k;
            }
        }
        return -1;
    }
    function SelectDeviceFromTopicControl($ControllerName,$MethodName,$GetParameter){
        $Resault=array(
            'status' => 5,
            'status_information' => '未登录'
        );
        if($_SESSION['UserName']==null){
            echo json_encode ($Resault);
            return;
        }
        $PostData=json_decode($_POST['PostData'],true);
        $Map["TopicName"]=$PostData['TopicName'];
        //$Map['UserName']=$_SESSION['UserName'];
        //开始鉴权
        $UserSTopicModel=NewModel("UserSTopic");//new一个model的类
        $TopicMap["TopicName"]=$Map["TopicName"];
        $TopicMap["UserName"]=$_SESSION["UserName"];
        if($UserSTopicModel->SelectUserSTopic($TopicMap)==null){
            $Resault=array(
                'status' => 5,
                'status_information' => '无权限操作或者未添加主题'
            );
            echo json_encode ($Resault);
            return;
        }
        if($Map['TopicName']!=null){
            $UserSDevicePublishModel=NewModel("UserSDevicePublish");//new一个model的类
            $UserSDeviceSubscribeModel=NewModel("UserSDeviceSubscribe");//new一个model的类
            $TempPubDevList=$UserSDevicePublishModel->SelectUserSDevicePublish($Map);
            $TempSubDevList=$UserSDeviceSubscribeModel->SelectUserSDeviceSubscribe($Map);
            //$TempAllDevList=array_merge($TempPubDevList,$TempSubDevList);
            $TempDevList=array();
            foreach($TempPubDevList as $k=>$v){
                if($v['ClientId']!=null){
                    //这个id有推送权限
                   $Temp=array();
                    $Temp['ClientId']=$v['ClientId'];
                    //暂时不写客户名
                    $Temp['PubStatus']="1";
                    $Sub=$this->FindDevice($TempSubDevList,$v['ClientId']);//在订阅里寻找这个id
                    if($Sub!=-1){
                        //存在此设备
                        $Temp['SubStatus']="1";
                        $Temp['Qos']=$TempSubDevList[$Sub]['QoSLevel'];
                    }else{
                        //不存在此设备
                        $Temp['SubStatus']="0";
                    }
                    $TempDevList[]=$Temp;//添加到列表
                }
            }
            //添加sub里有但是pub里没有的设备
            foreach($TempSubDevList as $k=>$v){
                if($v['ClientId']!=null){
                    //这个id有推送权限
                    $Temp=array();
                    $Temp['ClientId']=$v['ClientId'];
                    $Temp['Qos']=$v['QoSLevel'];
                    //暂时不写客户名
                    $Temp['SubStatus']="1";
                    $Pub=$this->FindDevice($TempPubDevList,$v['ClientId']);//在发布里寻找这个id
                    if($Pub==-1){
                        //不存在此设备
                        $Temp['PubStatus']="0";
                        $TempDevList[]=$Temp;//添加到列表
                    }
                }
            }

            if($TempDevList!=null){//检查是否已存在
                //存在
                $Resault=array(
                    'status' => 0,
                    'status_information' => '获取设备列表成功',
                    'data'=>$TempDevList
                );
            }else{
                $Resault=array(
                    'status' => 1,
                    'status_information' => '当前主题没有设备'
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

}
?>