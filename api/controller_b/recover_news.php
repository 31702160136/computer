<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../utils/session_status.php";
if(sessionIsLogin()){
	$create_service = new CreateService();
	$data=@$_POST["ids"];
	$result=$create_service->recoverNews($data);
	if($result){
		succeed("恢复新闻成功");
	}else{
		error("恢复新闻失败");
	}
}else{
	error("用户未登录");
}
/*
 * 从回收站恢复新闻
 * 接口状态：完成
 * 类型：Post
 * 参数：ids					回收站新闻id,请以数组形式发送，ids:[1,2,3]
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "恢复新闻成功",
    "code": 200
}
 * 
 * */
?>