<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$select_service = new SelectService();
	$result = $select_service ->getNewsByColumnId(@$_GET["column_id"]);
	succeedOfInfo("获取新闻信息成功", $result);
} else {
	error("用户未登录");
}
?>