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
/*
 * 修改栏目信息
 * 接口状态：完成
 * 类型：Post
 * 参数：id					栏目id
 * 参数：title				标题
 * 参数：index				排序权重
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "栏目修改成功",
    "code": 200
}
 * 
 * */
?>