<?php
include_once "./../dao/user_dao.php";
include_once "./../dao/column_dao.php";
include_once "./../handler/handler.php";
include_once "./../utils/session_status.php";
class ModifyService{
	private $userDao=null;
	private $columnDao=null;
	function __construct(){
		$this->userDao=new UserDao();
		$this->columnDao=new ColumnDao();
	}
	/*
	 * 修改管理员密码
	 * */
	public function modifyUserPassword($data){
		//判断信息是否为空
		if(isset($data["password"])&&isset($data["oldPassword"])){
			//取出新密码与旧密码
			$password=$data["password"];
			$oldPassword=$data["oldPassword"];
			//查询管理员信息
			$result=$this->userDao->findUserByUserName(getSessionUserName());
			//对比旧密码是否一致
			if($result[0]["password"]==$oldPassword){
				//对比新密码与旧密码是否一致
				if($result[0]["password"]!=$password){
					//重新打包数据
					$data=array(
						"password"=>$password,
						"modify_time"=>time()
					);
					//修改密码
					$result=$this->userDao->modifyUser($data,$result[0]["id"]);
					//判断是否修改成功
					if($result>0){
						return true;
					}else{
						return false;
					}
				}else{
					error("新密码与原密码一致，请重新修改密码");
				}
			}else{
				error("原密码错误");
			}
		}else{
			error("缺少必要信息");
		}
	}
	public function modifyColumn($data){
		if(isset($data["id"])&&isset($data["title"])){
			$result=$this->columnDao->findColumnByTitle($data["title"]);
			if(!(count($result)>0)){
				$id=$data["id"];
				unset($data["id"]);
				$data["modify_time"]=time();
				$result=$this->columnDao->modifyColumn($data, $id);
				if($result>0){
					return true;
				}else{
					return false;
				}
			}else{
				error("修改栏目失败：已有此栏目");
			}
		}else{
			error("缺少必要信息");
		}
	}
}
?>