<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
include_once "./../service/select_service.php";
if (sessionIsLogin()) {
	$modify_service = new ModifyService();
	$data = array(
		"id"=>@$_POST["id"],
		"state"=>"is_top"
	);
	$result = $modify_service ->modifyNewsState($data);
	if ($result) {
		succeed("新闻置顶状态设置成功");
	} else {
		error("新闻置顶状态设置失败");
	}
} else {
	error("用户未登录");
}
?>