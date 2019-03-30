<?php
function sessionIsLogin() {
	session_start();
	if (@$_SESSION['username'] != null) {
		$data = array("status" => true, "message" => "用户已登录", "code" => 200);
	} else {
		$data = array("status" => false, "message" => "用户未登录", "code" => 403);
	}
	return $data;
}

function sessionLogin($username) {
	session_start();
	$_SESSION['username'] = $username;
	
}

function sessionOutLogin() {
	session_start();
	session_unset();
	session_destroy();

	if (empty($_SESSION)) {
		$data = array("status" => true, "message" => "注销成功", "code" => 200);
	} else {
		$data = array("status" => false, "message" => "注销失败", "code" => 403);
	}
	return $data;
}
?>