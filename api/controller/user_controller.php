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
	public function get_users(){
		return $this->userService->findUser();
	}
	public function login(){
		$data=array(
			"username"=>@$_GET["username"],
			"password"=>@$_GET["password"]
		);
		$result=$this->userService->Login($data);
		if($result["code"]==200){
			sessionLogin($data["username"]);
		}
		return $result;
	}
	//退出登陆
	public function out_login(){
		$result=sessionOutLogin();
		return $result;
	}
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