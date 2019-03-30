<?php
include_once "./../dao/user_dao.php";
include_once "./../handler/handler.php";
class CreateService{
	private $userDao=null;
	function __construct(){
		$this->userDao=new UserDao();
	}
	public function createAdmin($data){
		if(isset($data["username"])&&isset($data["password"])){
			$result=$this->userDao->findUserByUserName($data["username"]);
			if(!(count($result)>0)){
				$data["role"]="admin";
				$data["creation_time"]=time();
				$data["modify_time"]=time();
				$result=$this->userDao->createUser($data);
				if($result>0){
					return true;
				}else{
					error("创建管理员失败");
				}
			}else{
				error("该用户已存在");
			}
		}else{
			error("缺少必要信息");
		}
	}
}
?>