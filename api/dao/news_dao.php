<?php
include_once "./../db/sql.php";
class NewsDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	public function findNews($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select * from `news` limit ".$page.",".$size;
		}else{
			$sql = "select * from `news`";
		}
		$result=$this->sql->query($sql);
		return $result;
	} 
	public function findNewsByColumnId($id,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select * from `news` where `column_id`=" . $id." limit ".$page.",".$size;
		}else{
			$sql = "select * from `news` where `column_id`=" . $id;
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function createNews($data){
		$array=array(
			"table"=>"news",
			"data"=>$data
		);
		$result=$this->sql->insert($array);
		return $result;
	}
	//删除用户
	function deleteNewsById($data){
		$array=array(
			"table"=>"news",
			"fields"=>"id",
			"data"=>$data
		);
		$result=$this->sql->delete($array);
		return $result;
	}
}
?>