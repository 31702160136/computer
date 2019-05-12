<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../config/path.php";
if(sessionIsLogin()){
	$create_service = new CreateService();
	$select_service=new SelectService();
	$data=array(
		"news_id"=>@$_POST["news_id"],
		"index"=>isset($_POST["index"])? $_POST["index"]:null,
		"is_status"=>isset($_POST["is_status"])? $_POST["is_status"]:null
	);
	$result=$create_service->createSlideshow($data);
	if($result){
		succeed("添加轮播新闻成功");
	}else{
		error("添加轮播新闻失败");
	}
}else{
	error("用户未登录");
}
/*
 * 添加轮播新闻
 * 接口状态：完成
 * 类型：Post
 * 参数：news_id					新闻id
 * 参数：index					排序权重(选填)
 * 参数：is_status				轮播新闻状态(选填)
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "添加轮播新闻成功",
    "code": 200
}
 * 
 * */
?>