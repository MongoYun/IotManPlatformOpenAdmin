<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 22:32
 */

function NewModel($ModelName){
    global $Config;
    $ModelName.="Model";
    include $Config['ModelDir'].$ModelName.".Class.php";
    return new $ModelName();
}
