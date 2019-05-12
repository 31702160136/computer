<?php
include_once "./../handler/handler.php";
include_once "./../service/delete_service.php";
include_once "./../utils/session_status.php";
if(sessionIsLogin()){
	$delete_service=new DeleteService();
	$data=@$_POST["ids"];
	$result=$delete_service->delSlideshowById($data);
	if($result){
		succeed("删除轮播新闻成功");
	}else{
		error("删除轮播新闻失败");
	}
}else{
	error("用户未登录");
}
/*
 * 删除轮播新闻
 * 接口状态：完成
 * 类型：Post
 * 参数：ids					栏目id,请以数组形式发送，ids:[1,2,3]
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "删除轮播新闻成功",
    "code": 200
}
 * 
 * */
?>