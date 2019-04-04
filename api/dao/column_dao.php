<?php
include_once "./../db/sql.php";
class ColumnDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	
	public function findColumns(){
		$sql="select * from `column`";
		$result=$this->sql->query($sql);
		return $result;
	}
	function findColumnById($id){
		$sql="select * from `column` where id='".$id."'";
		$result=$this->sql->query($sql);
		return $result;
	}
	function findColumnByTitle($title){
		$sql="select * from `column` where title='".$title."'";
		$result=$this->sql->query($sql);
		return $result;
	}
	function createColumn($data){
		$array=array(
			"table"=>"column",
			"data"=>$data
		);
		$result=$this->sql->insert($array);
		return $result;
	}
	//修改栏目
	function modifyColumn($data,$id){
		$array=array(
			"id"=>$id,
			"table"=>"column",
			"data"=>$data
		);
		$result=$this->sql->modify($array);
		return $result;
	}
}
?>