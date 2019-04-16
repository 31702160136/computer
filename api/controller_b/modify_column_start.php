<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
include_once "./../service/select_service.php";
if (sessionIsLogin()) {
	$modify_service = new ModifyService();
	$data = array(
		"id"=>@$_POST["id"]
	);
	$result = $modify_service ->modifyColumnStart($data);
	if ($result) {
		succeed("栏目状态修改成功");
	} else {
		error("栏目状态修改失败");
	}
} else {
	error("用户未登录");
}
?>