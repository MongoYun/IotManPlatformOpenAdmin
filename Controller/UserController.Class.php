<?php
include dirname(dirname(__FILE__)) . '/Common/CaptchaCommon.class.php';

/**
 * Created by PhpStorm.
 * User: lanmao
 * Date: 2017/12/23
 * Time: 1:24
 */
class UserController extends RandomCommon
{
    public function Login()
    {
        //登录接口位置
        if (isset($_POST['Username']) === true//用户名
            && isset($_POST['Password']) === true//密码
            && isset($_POST['Captcha']) === true//验证码
            && isset($_SESSION['Captcha_character']) === true//验证码
        ) {
            //判断传递的参数是否完整
            if (
                strcasecmp(
                    $_POST['Captcha'],
                    $_SESSION['Captcha_character']
                ) == 0
            ) {
                //执行查询数据库是否有该账号
                $DeviceCodeModel = NewModel("User");//new一个model的类
                $TempList['Username'] = $_POST['Username'];
                $TempList['Password'] = $_POST['Password'];
                $data = $DeviceCodeModel->SelectUser($TempList);
                //判断是否有数据
                if ($data != null) {
                    $_SESSION['UserName'] = $data[0]['Username'];
                    echo $this->returnJson(
                        array(
                            'status' => 0,
                            'status_information' => '登录成功',
                            'Username' => $data[0]['Username']
                        )
                    );
                } else {
                    echo $this->returnJson(
                        array(
                            'status' => 3,
                            'status_information' => '账号或密码错误'
                        )
                    );
                }

            } else {
                //返回验证码不正确
                echo $this->returnJson(
                    array(
                        'status' => 2,
                        'status_information' => '验证码不正确'
                    )
                );
            }
        } else {
            //返回参数不完整
            echo $this->returnJson(
                array(
                    'status' => 1,
                    'status_information' => '参数不完整'
                )
            );
        }
    }

    function Logout()
    {

        unset($_SESSION['UserName']);
        session_destroy();
        echo $this->returnJson(
            array(
                'status' => 0,
                'status_information' => '注销成功'
            )
        );
    }

    public function LoginAuthCode()
    {
        //验证码接口 获取图形验证码
        $yzm = new CaptchaCommon();
        $yz = $yzm->Captcha(108, 34);
        $_SESSION['Captcha_character'] = $yz;
    }
    public function zc()
    {

        //注册接口位置


        echo '注册接口';
    }

    public function dl_yzm()
    {
        //验证码接口 获取图形验证码
        $yzm = new CaptchaCommon();
        $yz = $yzm->Captcha(108, 34);
        $_SESSION['Captcha_character'] = $yz;
    }

    //获取登录状态返回当前是否登录,如果已经登录返回登录用户名类信息
    public function Login_status()
    {
        if (isset($_SESSION['UserName']) === true) {
            //执行查询 数据库返回用户名用户填写qq
            $DeviceCodeModel = NewModel("User");//new一个model的类
            $data = $DeviceCodeModel->status_information($_SESSION['UserName']);
            if ($data['status'] == 0) {
                echo $this->returnJson(
                    array(
                        'status' => 0,
                        'status_information' => 'ok',
                        'Username' => $data['array'][0]->Username,
                        'qq' => $data['array'][0]->qq
                    )

                );
            } else {
                echo $this->returnJson(
                    array(
                        'status' => 2,
                        'status_information' => '出错'
                    )
                );
            }
        } else {
            //没有登录返回
            echo $this->returnJson(
                array(
                    'status' => 1,
                    'status_information' => '用户没有登录,请登录后重新查看'
                )
            );
        }
    }

    //判断是否登录如果已经登录直接跳转到控制页面
    public function Login_tojudge()
    {
        if ($_SESSION['UserName'] == true) {
            echo $this->returnJson(
                array(
                    'status' => 0,
                    'status_information' => '用户已经登录,自动为您跳转到页面',
                    'UserName' => $_SESSION['UserName']
                )
            );
        } else {
            echo $this->returnJson(
                array(
                    'status' => 1,
                    'status_information' => '用户没有登录,请登录'
                )
            );
        }
    }

    public function zc_yzm()
    {
        //验证码接口 获取图形验证码
        $yzm = new CaptchaCommon();
        $yz = $yzm->Captcha(108, 34);
        $_SESSION['Registration_yzm'] = $yz;
    }

    //注册传递验证码手机号判断验证码是否正确如果正确调用验证码接口发送验证码
    public function Login_verification_code()
    {
        if (
            isset($_POST['phone_number']) === true &&
            isset($_POST['Captcha']) === true
        ) {
            //判断验证码是否正确
            if (
                strcasecmp(
                    $_POST['Captcha'],
                    $_SESSION['Registration_yzm']
                ) == 0
            ) {
                //执行判断手机号是否合法
                if ($this->isPhone($_POST['phone_number']) === true){

                }else{
                    //手机号不完整
                    echo $this->returnJson(
                        array(
                            'status' => 2,
                            'status_information' => '手机号不完整'
                        )
                    );
                }
            } else {
                //验证码不正确
//                echo $_SESSION['Registration_yzm'];
                echo $this->returnJson(
                    array(
                        'status' => 2,
                        'status_information' => '验证码不正确'
                    )
                );
            }
        } else {
            //返回参数不完整
            echo $this->returnJson(
                array(
                    'status' => 1,
                    'status_information' => '参数不完整'
                )
            );
        }
    }

}