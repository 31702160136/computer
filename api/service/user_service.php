<?php
include_once "./../dao/user_dao.php";
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
					"message"=>true,
					"code"=>200
				);
				return $array;
			}else{
				$array=array(
					"message"=>false,
					"code"=>403
				);
				return $array;
			}
		}else{
			$array=array(
					"message"=>false,
					"code"=>403
			);
			return $array;
		}
	}
}
?>