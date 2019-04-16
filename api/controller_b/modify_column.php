<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
if (sessionIsLogin()) {
	$modify_service = new ModifyService();
	$data = array(
		"id"=>@$_POST["id"],
		"title" => isset($_POST["title"])? $_POST["title"]:null, 
		"index" => isset($_POST["index"])? $_POST["index"]:null
	);
	$result = $modify_service ->modifyColumn($data);
	if ($result) {
		succeed("栏目修改成功");
	} else {
		error("栏目修改失败");
	}
} else {
	error("用户未登录");
}
?>