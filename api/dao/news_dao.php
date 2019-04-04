<?php
include_once "./../db/sql.php";
class NewsDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
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