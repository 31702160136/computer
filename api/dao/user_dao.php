<?php
	include_once "./../db/sql.php";
class UserDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	//查询所有用户信息
	public function findAllUser(){
		$sql="select * from user";
		$result=$this->sql->query($sql);
		return $result;
	}
	//查询一条用户信息
	function findOneUser($id){
		$sql="select * from user where id=".$id;
		$result=$this->sql->query($sql);
		return $result;
	}
	//查询一条用户信息
	function findUserPassWord($username){
		$sql="select * from user where username=".$username;
		$result=$this->sql->query($sql);
		return $result;
	}
	//创建用户
	function createUser($array){
//		模拟数据
//		$array=array(
//			"table"=>"user",
//			"data"=>array(
//				"username"=>"555",
//				"password"=>"111",
//				"role"=>"admin",
//				"creation_time"=>time(),
//				"modify_time"=>time()
//			)
//		);
		$result=$this->sql->insert($array);
		return $result;
	}
	//修改用户
	function modifyUser($array){
		$result=$this->sql->modify($array);
		return $result;
	}
	//删除用户
	function deleteUser($array){
		$result=$this->sql->delete($array);
		return $result;
	}
}
?>