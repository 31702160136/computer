<?php
include_once "./../utils/session_status.php";
include_once "./../handler/handler.php";
if(sessionIsLogin()){
	succeed("用户已登录");
}else{
	error("用户未登录");
}
/*
 * 是否登陆
 * 接口状态：完成
 * 类型：Get/Post
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "用户已登录",
    "code": 200
}
 * 
 * */
?>