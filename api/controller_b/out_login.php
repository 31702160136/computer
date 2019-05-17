<?php
include_once "./../utils/session_status.php";
include_once "./../handler/handler.php";
$result=sessionOutLogin();
if($result){
	succeed("注销成功");
}else{
	error("注销失败");
}
/*
 * 退出登陆
 * 接口状态：完成
 * 类型：Get
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "注销成功",
    "code": 200
}
 * 
 * */
?>