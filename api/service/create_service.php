<?php
include_once "./../handler/handler.php";
include_once "./../dao/user_dao.php";
include_once "./../dao/column_dao.php";
include_once "./../dao/news_dao.php";
class CreateService{
	private $userDao=null;
	private $columnDao=null;
	private $newsDao=null;
	function __construct(){
		$this->userDao=new UserDao();
		$this->columnDao=new ColumnDao();
		$this->newsDao=new NewsDao();
	}
	//创建管理员
	public function createAdmin($data){
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
				error("该用户已存在");
			}
		}else{
			error("缺少必要信息");
		}
	}
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
			error("缺少必要信息");
		}
	}
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
			if((count($result_column)>0)){
				$data["creation_time"]=time();
				$data["modify_time"]=time();
				$result=$this->newsDao->createNews($data);
				if($result>0){
					return true;
				}else{
					error("创建新文章失败");
				}
			}else{
				error("请输入正确的管理员或栏目的id");
			}
		}else{
			error("缺少必要信息");
		}
	}
}
?>