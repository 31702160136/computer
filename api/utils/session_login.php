<?php
function sessionIsLogin() {
	session_start();
	if (@$_SESSION['username'] != null) {
		succeed("用户已登录");
	} else {
		error("用户未登录");
	}
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
		return true;
	} else {
		return false;
	}
}
?>