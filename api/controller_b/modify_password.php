<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
if (sessionIsLogin()) {
	$modify_service = new ModifyService();
	$data = array(
		"oldPassword" => @$_POST["oldPassword"], 
		"password" => @$_POST["password"]
	);
	$result = $modify_service -> modifyUserPassword($data);
	if ($result) {
		succeed("密码修改成功");
	} else {
		error("密码修改失败");
	}
} else {
	error("用户未登录");
}
?>