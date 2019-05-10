<?php
function sessionIsLogin() {
	@session_start();
	if (@$_SESSION['username'] != null) {
		return true;
	} else {
		return false;
	}
}

function sessionLogin($data) {
	@session_start();
	$_SESSION['id'] = $data["id"];
	$_SESSION['username'] = $data["username"];
	$_SESSION['role'] = $data["role"];
}

function getSessionUserName() {
	@session_start();
	return $_SESSION['username'];
}
function getSessionId() {
	@session_start();
	return $_SESSION['id'];
}
function getSessionRole() {
	@session_start();
	return $_SESSION['role'];
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