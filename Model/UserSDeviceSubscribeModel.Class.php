<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2018/1/7
 * Time: 15:25
 */
class UserSDeviceSubscribeModel
{
    public function SelectUserSDeviceSubscribe($Map)
    {
        try {
            $conn = GetDbByPdo();
            $Frist = true;
            $SqlParams = "";
            foreach ($Map as $key => $value) {
                if (!$Frist) {
                    $SqlParams .= " AND ";
                }
                $SqlParams .= $key . " ";
                if (is_array($value)) {//如果这是个数组的话第一个元素就是method，第二个元素就是值。
                    //$Map['key']=arryarray('like','%'.$phone.'%');
                    //$Map['key']=arryarray('=','%'.$phone.'%');
                    $SqlParams .= $value[0] . " :";
                    $SqlParams .= "Where".$key;//$value[1])
                } else {
                    $SqlParams .= "= :";
                    $SqlParams .= "Where".$key;
                }
                $Frist = false;
            }
            $TableName = "SubcribeTopicCertificationControlList";
            $stmt = $conn->prepare("SELECT * FROM " . $TableName . " WHERE " . $SqlParams);// 预处理 SQL 并绑定参数
            foreach ($Map as $key => $value) {
                if (is_array($value)) {//如果这是个数组的话第一个元素就是method，第二个元素就是值。
                    //$Map['key']=arryarray('like','%'.$phone.'%');
                    //$Map['key']=arryarray('=','%'.$phone.'%');
                    $stmt->bindValue(":" . "Where".$key, $value[1]);//也可以用bindValue
                } else {
                    $stmt->bindValue(":" . "Where".$key, $value);
                }
            }
            $stmt->execute();
            //echo "查询成功";
            // 设置结果集为关联数组
            //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $allrows = $stmt->fetchAll(PDO::FETCH_ASSOC);       //以关联下标从结果集中获取所有数据
            //以PDO::FETCH_NUM形式获取索引并遍历
            /*
            foreach($allrows as $row){
                echo '<tr>';
                echo '<td>'.$row['uid'].'</td>';
            }
            */
            $result = $allrows;

        } catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            $result = null;
        }
        $conn = null;
        return $result;
    }

    public function AddUserSDeviceSubscribe($Map)
    {
        try {
            $conn = GetDbByPdo();
            $Frist = true;
            $SqlData = "";
            $SqlKey = "";
            foreach ($Map as $key => $value) {
                if (!$Frist) {
                    $SqlKey .= " , ";
                    $SqlData .= " , ";
                }
                $SqlKey .= $key;
                $SqlData .= ":" . "Insert".$key . "";
                $Frist = false;
            }
            $TableName = "SubcribeTopicCertificationControlList";
            $stmt = $conn->prepare("INSERT INTO " . $TableName . "(" . $SqlKey . ") VALUES (" . $SqlData . ")");// 预处理 SQL 并绑定参数
            foreach ($Map as $key => $value) {
                $stmt->bindValue(":" . "Insert".$key, $value);
            }
            $result = $stmt->execute();
            //echo "查询成功";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = null;
        }
        $conn = null;
        return $result;
    }

    public function UpdateUserSDeviceSubscribe($Where, $Map)
    {
        try {
            $conn = GetDbByPdo();
            $Frist = true;
            $SqlWhere = "";
            foreach ($Where as $key => $value) {
                if (!$Frist) {
                    $SqlWhere .= " AND ";
                }
                $SqlWhere .= $key . " ";
                if (is_array($value)) {//如果这是个数组的话第一个元素就是method，第二个元素就是值。
                    //$Map['key']=arryarray('like','%'.$phone.'%');
                    //$Map['key']=arryarray('=','%'.$phone.'%');
                    $SqlWhere .= $value[0] . " :";
                    $SqlWhere .="Where". $key;//$value[1])
                } else {
                    $SqlWhere .= "= :";
                    $SqlWhere .= "Where".$key;
                }
                $Frist = false;
            }
            $Frist = true;
            $SqlSet = "";
            foreach ($Map as $key => $value) {
                if (!$Frist) {
                    $SqlSet.= " , ";
                }
                $SqlSet .= $key;
                $SqlSet .= "=:Set" . $key . "";
                $Frist = false;
            }
            $TableName = "SubcribeTopicCertificationControlList";
            $stmt = $conn->prepare("UPDATE " . $TableName . " SET " . $SqlSet . " WHERE " . $SqlWhere . "");// 预处理 SQL 并绑定参数
            foreach ($Where as $key => $value) {
                if (is_array($value)) {//如果这是个数组的话第一个元素就是method，第二个元素就是值。
                    //$Map['key']=arryarray('like','%'.$phone.'%');
                    //$Map['key']=arryarray('=','%'.$phone.'%');
                    $stmt->bindValue(":" . "Where".$key, $value[1]);
                } else {
                    $stmt->bindValue(":" . "Where".$key, $value);
                }
            }
            foreach ($Map as $key => $value) {
                    $stmt->bindValue(":Set" . $key, $value);
            }
            $result = $stmt->execute();
            //echo "查询成功";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $result = null;
        }
        $conn = null;
        return $result;
    }
    public function DeleteUserSDeviceSubscribe($Map)
    {
        try {
            $conn = GetDbByPdo();
            $Frist = true;
            $SqlParams = "";
            foreach ($Map as $key => $value) {
                if (!$Frist) {
                    $SqlParams .= " AND ";
                }
                $SqlParams .= $key . " ";
                if (is_array($value)) {//如果这是个数组的话第一个元素就是method，第二个元素就是值。
                    //$Map['key']=arryarray('like','%'.$phone.'%');
                    //$Map['key']=arryarray('=','%'.$phone.'%');
                    $SqlParams .= $value[0] . " :";
                    $SqlParams .= "Where".$key;//$value[1])
                } else {
                    $SqlParams .= "= :";
                    $SqlParams .= "Where".$key;
                }
                $Frist = false;
            }
            $TableName = "SubcribeTopicCertificationControlList";
            $stmt = $conn->prepare("DELETE FROM " . $TableName . " WHERE " . $SqlParams);// 预处理 SQL 并绑定参数
            foreach ($Map as $key => $value) {
                if (is_array($value)) {//如果这是个数组的话第一个元素就是method，第二个元素就是值。
                    //$Map['key']=arryarray('like','%'.$phone.'%');
                    //$Map['key']=arryarray('=','%'.$phone.'%');
                    $stmt->bindValue(":" . "Where".$key, $value[1]);//也可以用bindValue
                } else {
                    $stmt->bindValue(":" . "Where".$key, $value);
                }
            }
            $result = $stmt->execute();
            //echo "查询成功";

        } catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            $result = null;
        }
        $conn = null;
        return $result;
    }
}
?>