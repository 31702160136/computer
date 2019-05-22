<?php
include_once "./../db/sql.php";
class TeacherDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	//查询计算机工程系教师信息
	public function findTeachers($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select * from `teacher` ORDER BY `creation_time` desc limit ".$page.", ".$size;
		}else{
			$sql = "select * from `teacher` ORDER BY `creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	//添加计算机工程系教师信息
	public function createTeacher($data){
		$array=array(
			"table"=>"teacher",
			"data"=>$data
		);
		$result=$this->sql->insert($array);
		return $result;
	}
	//删除用户
	function deleteTeacherById($data){
		$array=array(
			"table"=>"teacher",
			"fields"=>"id",
			"data"=>$data
		);
		$result=$this->sql->delete($array);
		return $result;
	}
}
?>