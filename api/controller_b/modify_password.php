<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$modify_service = new ModifyService();
	$data = array(
		"id"=>getSessionUserName(),
		"oldPassword" => @$_POST["oldPassword"], 
		"password" => @$_POST["password"]
	);
	json_encode($data);
	$result = $modify_service -> modifyUserPassword($data);
	if ($result) {
		succeed("密码修改成功");
	} else {
		error("密码修改失败");
	}
} else {
	error("用户未登录");
}
/*
 * 修改用户密码
 * 接口状态：完成
 * 类型：Post
 * 参数：oldPassword
 * 参数：password
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "密码修改成功",
    "code": 200
}
 * 
 * */
?>