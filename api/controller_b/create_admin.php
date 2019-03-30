<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
$create_service = new CreateService();
$data=array(
	"name"=>@$_POST["name"],
	"username"=>@$_POST["username"],
	"password"=>@$_POST["password"]
);
$result=$create_service->createAdmin($data);
if($result){
	succeed("注册成功");
}else{
	error("注册失败");
}
?>