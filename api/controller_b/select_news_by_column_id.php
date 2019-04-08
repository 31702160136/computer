<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$select_service = new SelectService();
	$data=array(
		"column_id"=>@$_GET["column_id"],
		"page"=>@$_GET["page"],
		"size"=>@$_GET["size"]
	);
	$result = $select_service ->getNewsByColumnId($data);
	succeedOfInfo("获取新闻信息成功", $result);
} else {
	error("用户未登录");
}
?>