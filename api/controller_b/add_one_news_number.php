<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
include_once "./../service/select_service.php";
if (sessionIsLogin()) {
	$modify_service = new ModifyService();
	$data = array(
		"id"=>@$_POST["id"]
	);
	$result = $modify_service ->addOneNewsNumBer($data);
	if ($result) {
		succeed("增加新闻访问次数成功");
	} else {
		error("增加新闻访问次数失败");
	}
} else {
	error("用户未登录");
}
/*
 * 增加新闻访问次数接口
 * 接口状态：完成
 * 类型：Post
 * 参数：id		//新闻id
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "增加新闻访问次数成功",
    "code": 200
}
 * 
 * */
?>