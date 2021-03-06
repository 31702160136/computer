<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
include_once "./../config/path.php";
if(sessionIsLogin()){
	$create_service = new CreateService();
	$select_service=new SelectService();
	//上传封面并获取图片路径
	$cover=uploadImage("cover");
	if(!isset($cover)){
		error("文章保存失败：上传封面图片失败");
	}
	//上传轮播图并获取图片路径
	$slideshow_cover=uploadImage("slideshow_cover");
	if(!isset($slideshow_cover)){
		error("文章保存失败：上传封面轮播图失败");
	}
	$data=array(
		"title"=>@$_POST["title"],
		"describe"=>isset($_POST["describe"]) ? $_POST["describe"]:@$_POST["title"],
		"content"=>isset($_POST["content"]) ? $_POST["content"]:null,
		"cover"=>$cover,
		"slideshow_cover"=>$slideshow_cover,
		"type"=>isset($_POST["type"]) ? $_POST["type"]:1,
		"contributor"=>@$_POST["contributor"],
		"is_hot"=>isset($_POST["is_hot"]) ? $_POST["is_hot"]:null,
		"is_top"=>isset($_POST["is_top"]) ? $_POST["is_top"]:null,
		"is_status"=>isset($_POST["is_status"]) ? $_POST["is_status"]:null,
		"column_id"=>@$_POST["column_id"],
		"user_id"=>getSessionId()
	);
	$result=$create_service->createNews($data);
	if($result){
		succeed("创建新闻成功");
	}else{
		error("创建新闻失败");
	}
}else{
	error("用户未登录");
}
/*
 * 创建新闻
 * 接口状态：完成
 * 类型：Post
 * 参数：title					新闻标题
 * 参数：describe					新闻描述
 * 参数：content					新闻内容
 * 参数：cover					新闻封面：图片(选填)
 * 参数：slideshow_cover			新闻轮播：图片(选填)
 * 参数：type						新闻类型
 * 参数：contributor				新闻投稿者即作者
 * 参数：is_hot					火热状态(选填)
 * 参数：is_top					顶置状态(选填)
 * 参数：is_start					启动状态(选填)
 * 参数：column_id				栏目id
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "创建新闻成功",
    "code": 200
}
 * 
 * */
?>