<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2017/12/26
 * Time: 20:24
 */
//开始框架初始化
//read platform config
//error_reporting(0);//禁用错误报告
error_reporting(E_ALL^E_NOTICE^E_WARNING);
header("Content-type: text/html; charset=utf-8");//设置字符
date_default_timezone_set('Asia/Shanghai');//设置时区
session_start();//开启seession缓存
$Config = include("Config/Config.php");
//set platform default timezone
date_default_timezone_set($Config['TimeZone']);
// Include ezSQL core
include $Config['DefaultezSQLCoreFile'];
// Include ezSQL database specific component
include $Config['DefaultezSQLLibFile'];

// Include Library File About Database
include $Config['DefaulteLibraryDir'] . "NewModel.Library.php";
include $Config['DefaulteLibraryDir'] . "GetDb.Library.php";
//框架初始化结束
//开始路由
//start analysize url realize route
$_DocumentPath = $_SERVER['DOCUMENT_ROOT'];
$_FilePath = __FILE__;
$_RequestUri = $_SERVER['REQUEST_URI'];
$_AppPath = str_replace($_DocumentPath, '', $_FilePath);    //==>\router\index.php
$_UrlPath = $_RequestUri;    //==>/router/hello/router/a/b/c/d/abc/index.html?id=3&url=http:
$_AppPathArr = explode(DIRECTORY_SEPARATOR, $_AppPath);
/**
 * http://192.168.0.33/router/hello/router/a/b/c/d/abc/index.html?id=3&url=http:
 *
 * /hello/router/a/b/c/d/abc/index.html?id=3&url=http:
 */
for ($i = 0; $i < count($_AppPathArr); $i++) {
    $p = $_AppPathArr[$i];
    if ($p) {
        $_UrlPath = preg_replace('/^\/' . $p . '\//', '/', $_UrlPath, 1);
    }
}
$_UrlPath = preg_replace('/^\//', '', $_UrlPath, 1);
$_AppPathArr = explode("/", $_UrlPath);
$_AppPathArr_Count = count($_AppPathArr);
$arr_url = array(
    'controller' => $Config['DefaultController'],
    'method' => $Config['DefaultMethod'],
    'parms' => array()
);
if ($_AppPathArr[0] != null) {
    $arr_url['controller'] = $_AppPathArr[0];
}
if ($_AppPathArr_Count > 1 && $_AppPathArr[1] != null) {//为空则默认方法
    $arr_url['method'] = $_AppPathArr[1];
}
if ($_AppPathArr_Count > 2 and $_AppPathArr_Count % 2 != 0) {
    die('参数错误');
} else {
    for ($i = 2; $i < $_AppPathArr_Count; $i += 2) {
        $arr_temp_hash = array($_AppPathArr[$i] => $_AppPathArr[$i + 1]);
        $arr_url['parms'] = array_merge($arr_url['parms'], $arr_temp_hash);
    }
}
$ControllerName = $arr_url['controller'] . 'Controller';
$ControllerFile = $Config['ControllerDir'] . $ControllerName . '.Class.php';
$MethodName = $arr_url['method'];
if (file_exists($ControllerFile)) {

    include $ControllerFile;
    $obj_module = new $ControllerName();
    if (!method_exists($obj_module, $MethodName)) {
        die("要调用的方法不存在");
    } else {
        if (is_callable(array($obj_module, $MethodName))) {
            $obj_module->$MethodName($ControllerName, $MethodName, $arr_url['parms']);
            //$obj_module->printResult();
        }
    }
} else {
	//不是控制器请求
    if ($arr_url['controller']==$Config['ViewDir']){//这是一个页面文件
        $ViewDirName = $arr_url['controller'];

        if ($_AppPathArr_Count > 1 && $_AppPathArr[1] != null) {//为空则默认页面
            $arr_url['method']=$_AppPathArr[1];
            $ViewName = $arr_url['method'] ;
        }else{
            $ViewName = $Config['DefaultView'];
        }
        $ViewFile = $ViewDirName."/".$ViewName. '.html';
        if (file_exists($ViewFile)) {
            //include $ViewFile;
            $ControllerFile=$Config['ViewDir']."/".$Config['ViewDefaultConTrollerFile'];
            $ControllerName=$Config['ViewDefaultControllerClass'];
            $MethodName=$ViewName;
            include $ControllerFile;
            $obj_module = new $ControllerName();
            if (!method_exists($obj_module, $MethodName)) {
                $TempMethodName = $Config['ViewDefaultControllerMethod'];
                if (method_exists($obj_module, $TempMethodName)) {
                    if (is_callable(array($obj_module, $TempMethodName))) {
                        $obj_module->$TempMethodName($ControllerName, $MethodName, $arr_url['parms']);
                        //$obj_module->printResult();
                    }
                }else{
                    die("要调用的页面方法不存在");
                }
            } else {
                if (is_callable(array($obj_module, $MethodName))) {
                    $obj_module->$MethodName($ControllerName, $MethodName, $arr_url['parms']);
                    //$obj_module->printResult();
                }
            }
        } else {
            //die("此页面不存在");
			//重定向浏览器
			header("Location:/".$Config['ViewDir']."/".$Config['DefaultView']);
			//确保重定向后，后续代码不会被执行
			exit;
        }
    }else{
        //die("定义的模块不存在");
		//重定向浏览器
		header("Location:/".$Config['ViewDir']."/".$Config['DefaultView']);
		//确保重定向后，后续代码不会被执行
		exit;
    }
}
//路由结束
