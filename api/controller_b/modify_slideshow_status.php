<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
include_once "./../service/select_service.php";
if (sessionIsLogin()) {
	$modify_service = new ModifyService();
	$data = array(
		"id"=>@$_POST["id"]
	);
	$result = $modify_service ->modifySlideshowStatus($data);
	if ($result) {
		succeed("轮播状态设置成功");
	} else {
		error("轮播状态设置失败");
	}
} else {
	error("用户未登录");
}
/*
 * 切换用户状态
 * 接口状态：完成
 * 类型：Post
 * 参数：id
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "轮播状态设置成功",
    "code": 200
}
 * 
 * */
?>