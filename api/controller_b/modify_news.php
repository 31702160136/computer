<?php
include_once "./../handler/handler.php";
include_once "./../service/modify_service.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
include_once "./../config/path.php";
if(sessionIsLogin()){
	$modify_service = new ModifyService();
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
		"id"=>@$_POST["id"],
		"title"=>isset($_POST["title"]) ? $_POST["title"]:null,
		"describe"=>isset($_POST["describe"]) ? $_POST["describe"]:null,
		"content"=>isset($_POST["content"]) ? $_POST["content"]:null,
		"cover"=>$cover!="" ? $cover:null,
		"slideshow_cover"=>$slideshow_cover!="" ? $slideshow_cover:null,
		"type"=>isset($_POST["type"]) ? $_POST["type"]:null,
		"contributor"=>isset($_POST["contributor"]) ? $_POST["contributor"]:null,
		"is_hot"=>isset($_POST["is_hot"]) ? $_POST["is_hot"]:null,
		"is_top"=>isset($_POST["is_top"]) ? $_POST["is_top"]:null,
		"is_status"=>isset($_POST["is_status"]) ? $_POST["is_status"]:null,
		"column_id"=>isset($_POST["column_id"]) ? $_POST["column_id"]:null
	);
	$result=$modify_service->modifyNews($data);
	if($result){
		succeed("修改新闻成功");
	}else{
		error("修改新闻失败");
	}
}else{
	error("用户未登录");
}
/*
 * 修改新闻
 * 接口状态：完成
 * 类型：Post
 * 参数：id						新闻id
 * 参数：title					新闻标题(选填)
 * 参数：describe					新闻描述(选填)
 * 参数：content					新闻内容(选填)
 * 参数：cover					新闻封面：图片(选填)
 * 参数：slideshow_cover			新闻轮播：图片(选填)
 * 参数：type						新闻类型(选填)
 * 参数：contributor				新闻投稿者即作者(选填)
 * 参数：is_hot					火热状态(选填)
 * 参数：is_top					顶置状态(选填)
 * 参数：is_start					启动状态(选填)
 * 参数：column_id				栏目id(选填)
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "修改新闻成功",
    "code": 200
}
 * 
 * */
?>