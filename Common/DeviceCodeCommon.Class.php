<?php

/**

* Created by PhpStorm.

* User: xiaohui

* Date: 2017/12/22

* Time: 17:30

*/
class DeviceCodeCommon extends RandomCommon
{
        public function GetAddDeviceCode()
        {
                $NowUsTimeStamp = mircotime();
                $RandomNmuber = CreateRandomVerifyCode();
                return sha1(sha1($NowUsTimeStamp . $RandomNmuber));
        }
}