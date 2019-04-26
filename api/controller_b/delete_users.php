<?php
include_once "./../handler/handler.php";
include_once "./../service/delete_service.php";
include_once "./../utils/session_status.php";
if(sessionIsLogin()){
	$delete_service=new DeleteService();
	$data=@$_POST["ids"];
	$result=$delete_service->delUserById($data);
	if($result){
		succeed("删除用户成功");
	}else{
		error("删除用户失败");
	}
}else{
	error("用户未登录");
}
?>