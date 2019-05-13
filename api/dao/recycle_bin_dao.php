<?php
include_once "./../db/sql.php";
class RecycleBinDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	public function findRecycleBin($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select * from recycle_bin limit ".$page.",".$size;
		}else{
			$sql = "select * from recycle_bin";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function searchRecycleBinByTitle($title,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select * from recycle_bin where `title` like '%".$title."%' limit ".$page.",".$size;
		}else{
			$sql = "select * from recycle_bin where `title` like '%".$title."%'";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function createRecycleBin($data){
		$array=array(
			"table"=>"recycle_bin",
			"data"=>$data
		);
		$result=$this->sql->insert($array);
		return $result;
	}
	//删除回收新闻
	function deleteRecycleBinById($data){
		$array=array(
			"table"=>"recycle_bin",
			"fields"=>"id",
			"data"=>$data
		);
		$result=$this->sql->delete($array);
		return $result;
	}
}
?>