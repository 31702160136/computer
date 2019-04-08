<?php
include_once "./../db/sql.php";
class NewsDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	public function findNews(){
		$sql="select * from `news`";
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsByColumnId($id){
		$sql = "select * from `news` where `column_id`=" . $id;
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
}
?>