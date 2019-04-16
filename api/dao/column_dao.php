<?php
include_once "./../db/sql.php";
class ColumnDao {
	private $sql = null;
	function __construct() {
		$this -> sql = new Sql();
	}

	public function findColumns($page,$size) {
		if(isset($page)&&isset($size)){
			$sql = "select * from `column` limit ".$page.",".$size;
		}else{
			$sql = "select * from `column`";
		}
		$result = $this -> sql -> query($sql);
		return $result;
	}

	function findColumnById($ids) {
		$id = null;
		for ($i = 0; $i < count($ids); $i++) {
			if ($i < count($ids) - 1) {
				$id = $id . "`id`=" . "'" . $ids[$i] . "' or ";
			} else {
				$id = $id . "`id`=" . "'" . $ids[$i] . "'";
			}
		}
		$sql = "select * from `column` where " . $id;
		$result = $this -> sql -> query($sql);
		return $result;
	}

	function findColumnByTitle($title) {
		$sql = "select * from `column` where title='" . $title . "'";
		$result = $this -> sql -> query($sql);
		return $result;
	}

	function createColumn($data) {
		$array = array("table" => "column", "data" => $data);
		$result = $this -> sql -> insert($array);
		return $result;
	}

	//修改栏目
	function modifyColumn($data, $id) {
		$array = array("id" => $id, "table" => "column", "data" => $data);
		$result = $this -> sql -> modify($array);
		return $result;
	}
	//删除栏目
	function deleteColumnById($data){
		$array=array(
			"table"=>"column",
			"fields"=>"id",
			"data"=>$data
		);
		$result=$this->sql->delete($array);
		return $result;
	}

}
?>