<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 21:46
 */
// Include ezSQL core
include_once $Config['DefaultezSQLCoreFile'];
// Include ezSQL database specific component
include_once $Config['DefaultezSQLLibFile'];

$Db = new ezSQL_mysql($Config["DbUser"],$Config["DbPwd"],$Config["DbName"],$Config["DbHost"]);
//$Db->select($Config["DbName"]);
//$my_tables = $db->get_results("SHOW TABLES",ARRAY_N);
if($Config['DefaultDatabaseCacheDir']){
    $Db->cache_dir=$Config['DefaultDatabaseCacheDir'];
}
if ($Config['DbDebug']){
    $Db->debug_all = true;
}else{
    $Db->hide_errors();
}
return $Db;