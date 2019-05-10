<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../utils/session_status.php";
if(sessionIsLogin()){
	$create_service = new CreateService();
	$data=array(
		"title"=>@$_POST["title"],
		"is_status"=>isset($_POST["is_status"]) ? $_POST["is_status"]:null,
		"index"=>isset($_POST["index"]) ? $_POST["index"]:null
	);
	$result=$create_service->createColumn($data);
	if($result){
		succeed("创建栏目成功");
	}else{
		error("创建栏目失败");
	}
}else{
	error("用户未登录");
}
/*
 * 创建栏目
 * 接口状态：完成
 * 类型：Post
 * 参数：title					栏目标题
 * 参数：is_status				栏目状态(选填)
 * 参数：index					排序权重(选填)
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "创建栏目成功",
    "code": 200
}
 * 
 * */
?>