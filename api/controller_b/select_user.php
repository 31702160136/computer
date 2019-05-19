<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
if (sessionIsLogin()) {
	$data=array(
		"name"=>getSessionName(),
		"username"=>getSessionUserName(),
		"role"=>getSessionRole()
	);
	if($data["role"]=="superAdmin"){
		$data["role"]="超级管理员";
	}else if($data["role"]=="admin"){
		$data["role"]="普通管理员";
	}
	succeedOfInfo("获取当前用户信息成功", $data);
} else {
	error("用户未登录");
}
/*
 * 获取当前用户信息
 * 接口状态：完成
 * 类型：Get
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取用户信息成功",
    "code": 200,
    "data": {
        "name": "杨鸿燊",
        "username": "admin",
        "role": "superAdmin"
    }
}
 * 
 * */
?>