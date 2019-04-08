<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../config/path.php";
if(sessionIsLogin()){
	$create_service = new CreateService();
	$select_service=new SelectService();
	$result_user=$select_service->getUserInfoByUserName(getSessionUserName());
	$cover=null;
	if(isset($_FILES["cover"])){
		$tmpimg=$_FILES["cover"]["tmp_name"];//获取临时文件路径
		$name=$_FILES["cover"]["name"];//文件名
		$result=move_uploaded_file($tmpimg, "../../images/".$name);
		if($result>0){
			$cover=getImagesPath().$name;
		}else{
			error("创建新文章失败:封面图片上传失败");
		}
	}
	$slideshow_cover=null;
	if(isset($_FILES["slideshow_cover"])){
		$tmpimg=$_FILES["slideshow_cover"]["tmp_name"];//获取临时文件路径
		$name=$_FILES["slideshow_cover"]["name"];//文件名
		$result=move_uploaded_file($tmpimg, "../../images/".$name);
		if($result>0){
			$slideshow_cover=getImagesPath().$name;
		}else{
			error("创建新文章失败:封面图片上传失败");
		}
	}
	$data=array(
		"title"=>@$_POST["title"],
		"describe"=>@$_POST["describe"],
		"content"=>isset($_POST["content"]) ? $_POST["content"]:null,
		"cover"=>$cover,
		"slideshow_cover"=>$slideshow_cover,
		"type"=>@$_POST["type"],
		"contributor"=>@$_POST["contributor"],
		"is_hot"=>isset($_POST["is_hot"]) ? $_POST["is_hot"]:null,
		"is_top"=>isset($_POST["is_top"]) ? $_POST["is_top"]:null,
		"is_start"=>isset($_POST["is_start"]) ? $_POST["is_start"]:null,
		"column_id"=>@$_POST["column_id"],
		"user_id"=>$result_user["id"]
	);
	$result=$create_service->createNews($data);
	if($result){
		succeed("创建新文章成功");
	}else{
		error("创建新文章失败");
	}
}else{
	error("用户未登录");
}
?>