<?php
include_once "./../service/user_service.php";
$fun=@$_GET["function"];
$con=new UserController();
if(isset($fun)){
	if(filtration($fun)){	
		echo json_encode($con->$fun());
	}else{
		echo "信息不合法";
	}
}
class UserController{
	private $userService=null;
	function __construct(){
		$this->userService=new UserService();
	}
	/*
	 * 获取所有用户信息
	 * */
	public function get_users(){
		$result=sessionIsLogin();
		if(!$result["status"]){
			return $result;
		}
		return $this->userService->findUser();
	}
	/*
	 * 登陆接口
	 * */
	public function login(){
		$data=array(
			"username"=>@$_POST["username"],
			"password"=>@$_POST["password"]
		);
		$result=$this->userService->Login($data);
		if($result["code"]==200){
			sessionLogin($data["username"]);
		}
		return $result;
	}
	/*
	 * 退出登陆接口
	 * */
	public function out_login(){
		$result=sessionOutLogin();
		return $result;
	}
	/*
	 * 是否登陆接口
	 * */
	public function is_login(){
		$result=sessionIsLogin();
		return $result;
	}
}
function filtration($fun){
	$arr=array(
		"get_users",
		"login",
		"out_login",
		"is_login"
	);
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]==$fun){
			return true;
		}
	}
	return false;
}
?>