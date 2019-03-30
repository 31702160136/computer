<?php
include_once "./../dao/user_dao.php";
include_once "./../utils/session_login.php";
//测试数据
//$use=new UserService();
//$data=array(
//	"username"=>"123",
//	"password"=>"123"
//);
//echo json_encode($use->Login($data));

class UserService{
	private $userDao=null;
	function __construct(){
		$this->userDao=new UserDao();
	}
	public function findUser(){
		$result=$this->userDao->findAllUser();
		return $result;
	}
	public function Login($data){
		if(isset($data["username"])){
			$result=$this->userDao->findUserPassWord($data["username"]);
			if($result[0]["password"]==$data["password"]){
				$array=array(
					"name"=>$result[0]["name"],
					"status"=>true,
					"message"=>"登陆成功",
					"code"=>200
				);
				return $array;
			}else{
				$array=array(
					"status"=>false,
					"message"=>"登陆失败",
					"code"=>403
				);
				return $array;
			}
		}else{
			$array=array(
					"status"=>false,
					"message"=>"请写入完整的信息",
					"code"=>403
			);
			return $array;
		}
	}
}
?>