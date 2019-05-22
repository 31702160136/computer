<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
include_once "./../config/path.php";
if(sessionIsLogin()){
	$create_service = new CreateService();
	//上传封面并获取图片路径
	$cover=uploadImage("head_img");
	if(!isset($cover)){
		error("添加老师失败：上传头像失败");
	}
	//上传轮播图并获取图片路径
	$slideshow_cover=uploadImage("cover");
	if(!isset($slideshow_cover)){
		error("添加老师失败：上传封面失败");
	}
	$data=array(
		"name"=>@$_POST["name"],
		"title"=>@$_POST["title"],
		"sex"=>@$_POST["sex"],
		"school"=>@$_POST["school"],
		"content"=>@$_POST["content"],
		"cover"=>$cover,
		"head_img"=>$slideshow_cover
	);
	$result=$create_service->createTeacher($data);
	if($result){
		succeed("添加老师成功");
	}else{
		error("添加老师失败");
	}
}else{
	error("用户未登录");
}
/*
 * 添加教师
 * 接口状态：完成
 * 类型：Post
 * 参数：name					教师姓名
 * 参数：title				教师称谓
 * 参数：sex					教师性别
 * 参数：school				教师毕业学院
 * 参数：content				教师经历
 * 参数：cover				教师封面(选填)
 * 参数：head_img				教师头像(选填)
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "添加老师成功",
    "code": 200
}
 * 
 * */
?>