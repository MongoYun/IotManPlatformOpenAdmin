<?php
return array(
    //'配置项'=>'配置值'
    //目录设置
    'ModelDir' => 'Model/',
    'ControllerDir' => 'Controller/',
    'CommonDir' => 'Common/',
    'TimeZone' => 'Asia/Shanghai',
    'DefaultController' => 'Admin',//因为以页面为主所以使用一个假的控制器，实现默认跳转
    'DefaultMethod' => 'Login',
    'DefaulteLibraryDir' => 'Library/',
    'ViewDir'=>'Admin',
    'DefaultView'=>'Login',
    'ViewDefaultConTrollerFile'=>'Index.php',
    'ViewDefaultControllerClass'=>'ViewController',
    'ViewDefaultControllerMethod'=>'Index',
    //数据库配置信息
    'DefaultezSQLCoreFile' => 'Common/ezSQL/shared/ez_sql_core.php',
    'DefaultezSQLLibFile' => 'Common/ezSQL/mysql/ez_sql_mysql.php',
    'DefaultDatabaseInitPhpFileName' => 'DatabaseInitLink.Library.php',
    'DefaultDatabaseCacheDir' => '../RunTime/Cache/Database',
    'DbHost' => '', // 服务器地址
    'DbName' => '', // 数据库名
    'DbUser' => '', // 用户名
    'DbPwd' => '', // 密码
    'DbPort' => , // 端口
    'DbParams' => array(), // 数据库连接参数
    'DbChaerset' => 'utf8', // 字符集
    'DbDebug' => false, // 数据库调试模式 开启后可以记录SQL日志
    //短信验证配置信息
    'ACCOUNT_SID' => '',
    'AUTH_TOKEN' => '',
    'REST_URL' => 'http://api.miaodiyun.com/20150822/industrySMS/sendSMS'
);

?>
