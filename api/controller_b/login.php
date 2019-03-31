<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
$username = @$_POST["username"];
$password = @$_POST["password"];
$selectService = new SelectService();
$result = $selectService -> getUserInfoByUserName($username);
if ($result["password"] == $password) {
	sessionLogin($username);
	$data = array("name" => $result["name"]);
	succeedOfInfo("登陆成功", $data);
} else {
	sessionOutLogin();
	error("密码错误");
}
?>