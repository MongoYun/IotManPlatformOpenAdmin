<?php
/**
 * Created by PhpStorm.
 * User: 懒猫
 * Date: 2017/12/26
 * Time: 16:41
 */
include 'RandomCommon.class.php';
include 'HttpCommon.class.php';

class CaptchaCommon extends RandomCommon
{
    /**
     * 短信验证码
     * @access public
     * @param $phone_number 要发送验证码的手机号
     * @param $Verification_code 发送的验证码
     * @param $minute 短信有效期
     * @return 返回状态码 000000为发送成功
     *
     */
    public function SMS_Captcha($phone_number = 0, $minute = 6)
    {
        $timestamp = date("YmdHis");//当前时间
        $Verification_code = $this->CreateRandomVerifyCode(1);
        $data = array(
            'accountSid' => $parameter['ACCOUNT_SID'],//开发者id
            'templateid' => '124373553',//短信模板
            'param' => $Verification_code . "," . $minute,//短信变量
            'to' => $phone_number,//手机号
            'timestamp' => $timestamp,//当前时间
            'sig' => MD5($parameter['ACCOUNT_SID'] . $parameter['AUTH_TOKEN'] . $timestamp),
            'respDataType' => 'JSON'
        );
        $http = new HttpCommon();
        $return = $http->getHttpContent($parameter['REST_URL'], 'POST', $data);
        $return = json_decode($return);
        if ($return->respCode == 00000) {
            //发送成功
            return array('respCode' => $return->respCode, 'respDesc' => $return->respDesc, 'smsId' => $return->smsId, $Verification_code => $Verification_code);
        } else {
            //发送失败
            return array('respCode' => $return->respCode, 'respDesc' => $return->respDesc);
        }

    }

    /**
     * 生成随机验证码
     * @param $Width 图片长度
     * @param $height 图片宽度
     * @param $Types 验证码显示数字类型
     * @param $length 验证码长度
     * @return 返回验证码字符串
     */
    public function Captcha($Width = 100, $height = 40, $Types = 2, $length = 4)
    {
        $image = imagecreatetruecolor($Width, $height);//新建一个图形
        $bgcolor = imagecolorallocate($image, 255, 255, 255);//设置图形背景颜色
        imagefill($image, 0, 0, $bgcolor);//填充背景

        $captch_code = $this->CreateRandomVerifyCode($Types, $length);
        $captch_code = str_split($captch_code);
        for ($i = 0; $i < count($captch_code); $i++) {
            $fontsize = 6;
            $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
            $x = ($i * $Width / $length) + rand(5, 10);
            $y = rand(5, 10);
            imagestring($image, $fontsize, $x, $y, $captch_code[$i], $fontcolor);
        }
        //增加点干扰元素
        for ($i = 0; $i < $Width * 2; $i++) {
            $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
            imagesetpixel($image, rand(1, $Width), rand(1, $height), $pointcolor);
        }
//      增加线干扰元素
        for ($i = 0; $i < 3; $i++) {
            $linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
            imageline($image, rand(1, $Width), rand(1, $height), rand(1, $Width), rand(1, $height), $linecolor);
        }
        header('content-type:image/png');
        imagepng($image);
        imagedestroy($image);
        return implode('', $captch_code);
    }
}