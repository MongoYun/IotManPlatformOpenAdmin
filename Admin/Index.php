<?php
/**
 * Created by PhpStorm.
 * User: xiaohui
 * Date: 2018/1/7
 * Time: 18:53
 */
//界面处理的php
class ViewController{
    function Index($ControllerName,$ViewName){
        if($ViewName==""){
			//默认页面
            //include "Head1.html";
            include $Config['DefaultView'].".html";
            //include "Foot.html";
        }else{
            include "Head.html";
            include $ViewName.".html";
            include "Foot.html";
        }

    }
    function Login(){
        include "Login.html";
    }
    function Admin(){
        //include "Head1.html";
        include "Admin.html";
        //include "Foot.html";
    }
	function Home(){
        include "Home.html";
    }
	function Test(){
        include "Test.html";
    }
	function Main(){
        include "Main.html";
    }
}

?>