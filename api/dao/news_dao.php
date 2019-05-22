<?php
include_once "./../db/sql.php";
class NewsDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	public function findNews($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` ORDER BY n.`creation_time` DESC limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` ORDER BY n.`creation_time` DESC";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	
	public function findNewsStatusTrue($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsStatusTrueOfHotByColumnId($id,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` and n.`column_id`='".$id."' 
							and n.`is_status`='1' and n.`is_hot`='1' ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` and n.`column_id`='".$id."' 
							and n.`is_status`='1' and n.`is_hot`='1' ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	
	public function findNewsStatusTrueOfCover($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' and n.`cover` != '' ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' and n.`cover` != '' ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	
	public function searchNewsByColumnTitle($columnTitle,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and c.`title` like '%".$columnTitle."%' ORDER BY n.`creation_time` DESC limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and c.`title` like '%".$columnTitle."%' ORDER BY n.`creation_time` DESC";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function searchNewsByTitle($title,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and n.`title` like '%".$title."%' ORDER BY n.`creation_time` DESC limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and n.`title` like '%".$title."%' ORDER BY n.`creation_time` DESC";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsById($id){
		$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and n.`id`=" . $id;
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsByColumnId($id,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and n.`column_id`='" . $id."' ORDER BY n.`creation_time` DESC limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from `news` n,`column` c where n.`column_id`=c.`id` and n.`column_id`='" . $id."' ORDER BY n.`creation_time` DESC";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsByColumnIdStatusTrue($id,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' and n.`column_id`='" . $id."' 
								ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from
						 `news` n,`column` c where n.`column_id`=c.`id` 
						 	and n.`is_status`='1' and n.`column_id`='" . $id."' 
						 		ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsByColumnTitleStatusTrue($title,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' and c.`title`='" . $title."' 
								ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' and c.`title`='" . $title."' 
								ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findNewsByColumnTitleStatusTrueOfCover($title,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' and n.`cover` !='' and c.`title`='" . $title."' 
								ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select n.*,c.title as `column` from 
						`news` n,`column` c where n.`column_id`=c.`id` 
							and n.`is_status`='1' and n.`cover` !='' and c.`title`='" . $title."' 
								ORDER BY n.`is_top` desc, n.`is_hot` desc, n.`creation_time` desc";
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
	public function createNewss($datas){
		$array=array(
			"table"=>"news",
			"data"=>$datas
		);
		$result=$this->sql->inserts($array);
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