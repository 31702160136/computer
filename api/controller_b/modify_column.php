<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
if (sessionIsLogin()) {
	$modify_service = new ModifyService();
	$data = array(
		"id"=>@$_POST["id"],
		"title" => @$_POST["title"], 
		"index" => isset($_POST["index"])? $_POST["index"]:null,
		"is_start"=> isset($_POST["is_start"])? $_POST["is_start"]:null
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