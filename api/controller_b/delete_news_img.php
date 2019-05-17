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
	if(@$_POST["img"]=="cover"){
		$img="cover";
	}else if(@$_POST["img"]=="slideshow_cover"){
		$img="slideshow_cover";
	}else{
		error("请输入正确的封面参数");
	}
	$data=array(
		"id"=>@$_POST["id"],
		$img=>""
	);
	$result=$modify_service->modifyNews($data);
	if($result){
		succeed("删除封面成功");
	}else{
		error("删除封面失败");
	}
}else{
	error("用户未登录");
}
/*
 * 修改新闻
 * 接口状态：完成
 * 类型：Post
 * 参数：id						新闻id
 * 参数：img						选择需要删除的封面：cover/slideshow_cover
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