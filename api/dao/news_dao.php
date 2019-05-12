<?php
include_once "./../db/sql.php";
class NewsDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	public function findNews($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.column_id=c.id limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.column_id=c.id";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsSum(){
		$sql = "select count(id) as sum from `news`";
		$result=$this->sql->query($sql);
		return $result;
	} 
	public function findNewsById($id){
		$sql = "select * from `news` where `id`=" . $id;
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsByColumnId($id,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and n.`column_id`='" . $id."' limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and n.`column_id`='" . $id."'";
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
	//修改新闻
	function modifyNews($data, $id) {
		$array = array("id" => $id, "table" => "news", "data" => $data);
		$result = $this -> sql -> modify($array);
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