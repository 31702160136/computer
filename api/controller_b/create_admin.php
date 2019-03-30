<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$create_service = new CreateService();
	$data = array(
		"name" => @$_POST["name"],
		"username" => @$_POST["username"],
		"password" => @$_POST["password"],
		"phone" => @$_POST["phone"],
		"email" => @$_POST["email"]
	);
	$result = $create_service -> createAdmin($data);
	if ($result) {
		succeed("注册成功");
	} else {
		error("注册失败");
	}
}else{
	error("用户未登录");
}
?>