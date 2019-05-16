<?php
include_once "./../db/sql.php";
class SlideshowDao{
	private $sql=null;
	function __construct(){
		$this->sql=new Sql();
	}
	public function findSlideshow($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select s.*,n.`title`,n.`describe`,n.`slideshow_cover`,c.`title` as `column` 
						from `slideshow` s,`news` n,`column` c 
							where s.`news_id`=n.`id` and n.`column_id`=c.`id` ORDER BY s.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select s.*,n.`title`,n.`describe`,n.`slideshow_cover`,c.`title` as `column` 
						from `slideshow` s,`news` n,`column` c 
							where s.`news_id`=n.`id` and n.`column_id`=c.`id` ORDER BY s.`creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findSlideshowStatusTrue($page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select s.*,n.`title`,n.`describe`,n.`slideshow_cover`,c.`title` as `column` 
						from `slideshow` s,`news` n,`column` c 
							where s.`news_id`=n.`id` and n.`column_id`=c.`id` and s.`is_status`='1' ORDER BY s.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select s.*,n.`title`,n.`describe`,n.`slideshow_cover`,c.`title` as `column` 
						from `slideshow` s,`news` n,`column` c 
							where s.`news_id`=n.`id` and n.`column_id`=c.`id` and s.`is_status`='1' ORDER BY s.`creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function searchSlideshowByTitle($title,$page,$size){
		if(isset($page)&&isset($size)){
			$sql = "select s.*,n.`title`,n.`describe`,n.`slideshow_cover`,c.`title` as `column` 
						from `slideshow` s,`news` n,`column` c 
							where s.`news_id`=n.`id` and n.`column_id`=c.`id` and n.title 
								like '%".$title."%' ORDER BY s.`creation_time` desc limit ".$page.",".$size;
		}else{
			$sql = "select s.*,n.`title`,n.`describe`,n.`slideshow_cover`,c.`title` as `column` 
						from `slideshow` s,`news` n,`column` c 
							where s.`news_id`=n.`id` and n.`column_id`=c.`id` and n.title 
								like '%".$title."%' ORDER BY s.`creation_time` desc";
		}
		$result=$this->sql->query($sql);
		return $result;
	}
	public function findSlideshowByNewsId($newsId){
		$sql = "select s.*,n.`title`,n.`describe`,n.`slideshow_cover`,c.`title` as `column` 
						from `slideshow` s,`news` n,`column` c 
							where s.`news_id`=n.`id` and n.`column_id`=c.`id` and 
							s.`news_id`='".$newsId."'";
		$result=$this->sql->query($sql);
		return $result;
	}
	public function createSlideshow($data){
		$array=array(
			"table"=>"slideshow",
			"data"=>$data
		);
		$result=$this->sql->insert($array);
		return $result;
	}
	//修改轮播图信息
	function modifySlideshow($data, $id) {
		$array = array("id" => $id, "table" => "slideshow", "data" => $data);
		$result = $this -> sql -> modify($array);
		return $result;
	}
	//删除用户
	function deleteSlideshowById($data){
		$array=array(
			"table"=>"slideshow",
			"fields"=>"id",
			"data"=>$data
		);
		$result=$this->sql->delete($array);
		return $result;
	}
}
?>