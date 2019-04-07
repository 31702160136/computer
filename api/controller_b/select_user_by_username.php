<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$select_service = new SelectService();
	$result = $select_service ->getUserInfoByUserName(@$_GET["username"]);
	$data=array(
		"id"=>$result["id"],
		"name"=>$result["name"],
		"username"=>$result["username"],
		"role"=>$result["role"],
		"phone"=>$result["phone"],
		"email"=>$result["email"],
		"creation_time"=>$result["creation_time"]
	);
	succeedOfInfo("获取用户信息成功", $data);
} else {
	error("用户未登录");
}
?>