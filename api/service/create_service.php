<?php
include_once "./../dao/user_dao.php";
include_once "./../dao/column_dao.php";
include_once "./../handler/handler.php";
class CreateService{
	private $userDao=null;
	private $columnDao=null;
	function __construct(){
		$this->userDao=new UserDao();
		$this->columnDao=new ColumnDao();
	}
	//创建管理员
	public function createAdmin($data){
		if(isset($data["username"])&&isset($data["password"])&&isset($data["name"])){
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
	public function createColumn($data){
		if(isset($data["title"])){
			$result=$this->columnDao->findColumnByTitle($data["title"]);
			if(!(count($result)>0)){
				$data["creation_time"]=time();
				$data["modify_time"]=time();
				$result=$this->columnDao->createColumn($data);
				if($result>0){
					return true;
				}else{
					error("创建栏目失败");
				}
			}else{
				error("创建栏目失败：已有此栏目");
			}
		}else{
			error("缺少必要信息");
		}
	}
}
?>