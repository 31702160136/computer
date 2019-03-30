<?php
function sessionIsLogin() {
	@session_start();
	if (@$_SESSION['username'] != null) {
		return true;
	} else {
		return false;
	}
}

function sessionLogin($username) {
	@session_start();
	$_SESSION['username'] = $username;
}

function getSessionUserName() {
	@session_start();
	return $_SESSION['username'];
}

function sessionOutLogin() {
	@session_start();
	@session_unset();
	@session_destroy();

	if (empty($_SESSION)) {
		return true;
	} else {
		return false;
	}
}
?>