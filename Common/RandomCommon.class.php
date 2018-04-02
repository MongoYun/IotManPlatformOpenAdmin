<?php
/**
 * Created by PhpStorm.
 * User: 懒猫
 * Date: 2017/12/26
 * Time: 16:49
 */

class RandomCommon
{
    /**
     * 生成随机数
     * @param $code_type 随机数类型
     * 1:全部数字  2:全部英文 33:数字加英文
     * @param $code_length 生成字符串数量
     * @return 返回生成的字符串
     */
    public function CreateRandomVerifyCode($code_type = 2, $code_length = 4)
    {
        if ($code_type == 1) {
            $chars = join("", range(0, 9));
        } elseif ($code_type == 2) {
            $chars = join("", array_merge(range('a', 'z'), range('A', 'Z')));
        } else {
            $chars = join("", array_merge(range(0, 9), range('a', 'z'), range('A', 'Z')));
        }
        if (strlen($chars) < $code_length) {
            exit("Error in VerifyImage(class): 字符串长度不够，CreateRandomVerifyCode Failed");
        }
        $chars = str_shuffle($chars);
        return substr($chars, 0, $code_length);
    }

    /**
     * 生成json数据格式
     * @param array $data 数据
     * return 返回的json
     */
    public function returnJson($json_data = array())
    {
        return json_encode($json_data);
    }

    /**
     * 判断电话号码是否合法
     * @return boolean
     */
    public function isPhone($phonenumber)
    {
        if (preg_match("/^1[34578]{1}\d{9}$/", $phonenumber)) {
            return true;
        } else {
            return false;
        }
    }

}
