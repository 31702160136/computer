<?php
include_once "./../handler/handler.php";
include_once "./../dao/user_dao.php";
include_once "./../dao/column_dao.php";
include_once "./../dao/news_dao.php";
include_once "./../dao/slideshow_dao.php";
include_once "./../dao/recycle_bin_dao.php";
include_once "./../config/path.php";
class CreateService{
	private $userDao=null;
	private $columnDao=null;
	private $newsDao=null;
	private $slideshowDao=null;
	private $recycleBinDao = null;
	function __construct(){
		$this->userDao=new UserDao();
		$this->columnDao=new ColumnDao();
		$this->newsDao=new NewsDao();
		$this->slideshowDao=new SlideshowDao();
		$this -> recycleBinDao = new RecycleBinDao();
	}
	/*
	 * 创建管理员
	 * */
	public function createAdmin($data){
		if($data["role"]!="admin"&&$data["role"]!="superAdmin"){
			error("请输入正确的角色");
		}
		if(isset($data["username"])&&isset($data["password"])&&isset($data["name"])){
			$result=$this->userDao->findUserByUserName($data["username"]);
			if(!(count($result)>0)){
				$data["creation_time"]=time();
				$data["modify_time"]=time();
				$result=$this->userDao->createUser($data);
				if($result>0){
					return true;
				}else{
					error("创建管理员失败");
				}
			}else{
				error("创建管理员失败：该用户已存在");
			}
		}else{
			error("缺少必要信息：createAdmin");
		}
	}
	/*
	 * 创建栏目
	 * */
	public function createColumn($data){
		if(isset($data["title"])){
			$result=$this->columnDao->findColumnByTitle($data["title"]);
			//检测栏目标题是否重复，如果不重复就创建
			if(!(count($result)>0)){
				$data["creation_time"]=time();
				$data["modify_time"]=time();
				$result=$this->columnDao->createColumn($data);
				if($result>0){
					return true;
				}else{
					error("创建栏目失败");
				}
			}else{
				error("创建栏目失败：已有此栏目");
			}
		}else{
			error("缺少必要信息：createColumn");
		}
	}
	/*
	 * 创建新闻
	 * */
	public function createNews($data){
		if(isset($data["title"])
			&&isset($data["describe"])
			&&isset($data["type"])
			&&isset($data["describe"])
			&&isset($data["contributor"])
			&&isset($data["column_id"])
			&&isset($data["user_id"])){
			$result_column=$this->columnDao->findColumnById($data["column_id"]);
			//检测栏目的id是否存在，如果存在就创建
			//
			if((count($result_column)>0)){
				$data["count"]=0;
				$data["creation_time"]=time();
				$data["modify_time"]=time();
				$result=$this->newsDao->createNews($data);
				if($result>0){
					return true;
				}else{
					error("创建新文章失败");
				}
			}else{
				error("创建新文章：没有此栏目");
			}
		}else{
			error("缺少必要信息：createNews");
		}
	}
	public function createSlideshow($data){
		if(isset($data["news_id"])){
			$result_findSl=$this->slideshowDao->findSlideshowByNewsId($data["news_id"]);
			if(count($result_findSl)>0){
				error("设置轮播新闻失败：此轮播新闻已存在");
			}
			$data["index"]=isset($data["index"])? $data["index"]:0;
			$data["is_status"]=isset($data["is_status"])? $data["is_status"]:0;
			$data["creation_time"]=time();
			$data["modify_time"]=time();
			$result=$this->slideshowDao->createSlideshow($data);
			if($result>0){
				return true;
			}else{
				error("创建轮播新闻失败");
			}
		}else{
			error("缺少必要信息：createSlideshow");
		}
	}
	public function recoverNews($ids){
		if(isset($ids)&&is_array($ids)){
			$result_recycle=$this->recycleBinDao->findRecycleBinByIds($ids, null, null);
			if(count($result_recycle)<=0){
				error("新闻恢复失败");
			}
			for($i=0;$i<count($result_recycle);$i++){
				$res_column=$this->columnDao->findColumnByTitle($result_recycle[$i]["column"]);
				if(!(count($res_column)>0)){
					$column_data=array(
						"title"=>$result_recycle[$i]["column"],
						"creation_time"=>time(),
						"modify_time"=>time()
					);
					$res_column2=$this->columnDao->createColumn($column_data);
					if($res_column2>0){
						$res_column3=$this->columnDao->findColumnByTitle($result_recycle[$i]["column"]);
						$result_recycle[$i]["column_id"]=$res_column3[0]["id"];
					}
				}
				unset($result_recycle[$i]["column"]);
				unset($result_recycle[$i]["id"]);
				unset($result_recycle[$i]["recycle_time"]);
			}
			$result=$this->newsDao->createNewss($result_recycle);
			if($result>0){
				$result_recycle_del=$this->recycleBinDao->deleteRecycleBinById($ids);
				return true;
			}else{
				error("新闻恢复失败");
			}
		}else{
			error("缺少必要信息：recoverNews");
		}
	}
	

}
?>