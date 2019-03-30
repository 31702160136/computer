<?php
include_once "./../dao/user_dao.php";
include_once "./../handler/handler.php";
class SelectService{
	private $userDao=null;
	function __construct(){
		$this->userDao=new UserDao();
	}
	public function getUsers(){
		$result=$this->userDao->findAllUser();
		return $result;
	}
	//通过账号获取密码
	public function getPasswordByUserName($username){
		if(isset($username)){
			$result=$this->userDao->findUserByUserName($username);
			if(count($result)>0){
				return $result[0];
			}else{
				error("账号不存在");
			}
		}else{
			error("请输入账号");
		}
	}
}
?>