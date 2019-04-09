<?php
include_once "./../db/sql.php";
class UserDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	//查询所有用户信息
	public function findUsers($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select * from `user` limit ".$page.",".$size;
		}else{
			$sql = "select * from `user`";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	//查询一条用户信息
	function findUser($id){
		$sql="select * from `user` where id='".$id."'";
		$result=$this->sql->query($sql);
		return $result;
	}
	//根据账号查询用户
	function findUserByUserName($username){
		$sql="select * from `user` where username='".$username."'";
		$result=$this->sql->query($sql);
		return $result;
	}
	//创建用户
	function createUser($data){
		$array=array(
			"table"=>"user",
			"data"=>$data
		);
		$result=$this->sql->insert($array);
		return $result;
	}
	//修改用户
	function modifyUser($data,$id){
		$array=array(
			"id"=>$id,
			"table"=>"user",
			"data"=>$data
		);
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