<?php
include_once "./../dao/user_dao.php";
include_once "./../handler/handler.php";
include_once "./../dao/column_dao.php";
include_once "./../dao/news_dao.php";
include_once "./../dao/slideshow_dao.php";
include_once "./../dao/recycle_bin_dao.php";
include_once "./../dao/teacher_dao.php";
include_once "./../config/path.php";
class SelectService {
	private $userDao = null;
	private $columnDao = null;
	private $newsDao = null;
	private $slideshowDao = null;
	private $recycleBinDao = null;
	private $teacherDao = null;
	function __construct() {
		$this -> userDao = new UserDao();
		$this -> columnDao = new ColumnDao();
		$this -> newsDao = new NewsDao();
		$this -> slideshowDao = new SlideshowDao();
		$this -> recycleBinDao = new RecycleBinDao();
		$this -> teacherDao = new TeacherDao();
	}
	/*
	 * 获取用户信息
	 * 返回数量：多条
	 * */
	public function getUsers($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if($data["page"]==0&&$data["size"]==0){
				$result = $this -> userDao -> findUsers(null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result = $this -> userDao -> findUsers($page,$size);
			}
		}else{
			$result = $this -> userDao -> findUsers(0,10);
		}
		return $result;
	}

	/*
	 * 通过账号获取用户信息
	 * 返回数量：单条
	 * */
	public function getUserInfoByUserName($data) {
		if (isset($data["username"])) {
			$result = $this -> userDao -> findUserByUserName($data["username"]);
			if (count($result) > 0) {
				return $result[0];
			} else {
				error("账号不存在");
			}
		} else {
			error("请输入账号");
		}
	}
	/*
	 * 获取栏目信息
	 * 返回数量：多条
	 * */
	public function getColumns($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if($data["page"]==0&&$data["size"]==0){
				$result = $this -> columnDao -> findColumns(null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result = $this -> columnDao -> findColumns($page,$size);
			}
		}else{
			$result = $this -> columnDao -> findColumns(0,10);
		}
		return $result;
	}
	/*
	 * 统计栏目访问数量
	 * 返回数量：多条
	 * */
	public function statisticsColumns($data) {
		$result = $this -> columnDao -> statisticsColumns();
		if(count($result)>0){
			return $result;
		}else{
			error("无统计数据");
		}
	}
	/*
	 * 获取已启用的栏目信息
	 * 返回数量：多条
	 * */
	public function getColumnsStatusTrue($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if($data["page"]==0&&$data["size"]==0){
				$result = $this -> columnDao -> findColumnsStatusTrue(null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result = $this -> columnDao -> findColumnsStatusTrue($page,$size);
			}
		}else{
			$result = $this -> columnDao -> findColumnsStatusTrue(0,10);
		}
		return $result;
	}
	/*
	 * 获取新闻信息
	 * 返回数量：多条
	 * */
	public function getNews($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if(@$data["page"]==0&&@$data["size"]==0){
				$result_news = $this -> newsDao -> findNews(null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> findNews($page,$size);
			}
		}else{
			$result_news = $this -> newsDao -> findNews(0,10);
		}
		return $result_news;
	}
	/*
	 * 通过新闻id获取新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsById($data) {
		if (isset($data["id"])) {
			$result_news = $this -> newsDao -> findNewsById($data["id"]);
			return $result_news[0];
		}else{
			error("缺少必要参数：getNewsById");
		}
	}
	/*
	 * 获取已发布的新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsStatusTrue($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if(@$data["page"]==0&&@$data["size"]==0){
				$result_news = $this -> newsDao -> findNewsStatusTrue(null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> findNewsStatusTrue($page,$size);
			}
		}else{
			$result_news = $this -> newsDao -> findNewsStatusTrue(0,10);
		}
		return $result_news;
	}
	/*
	 * 根据标题获取已发布的新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsStatusTrueByColumnTitle($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"]) && isset($data["column_title"])) {
			if(@$data["page"]==0&&@$data["size"]==0){
				$result_news = $this -> newsDao -> findNewsByColumnTitleStatusTrue($data["column_title"],null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> findNewsByColumnTitleStatusTrue($data["column_title"],$page,$size);
			}
		}else{
			$result_news = $this -> newsDao -> findNewsByColumnTitleStatusTrue($data["column_title"],0,10);
		}
		return $result_news;
	}
	/*
	 * 获取火热新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsStatusTrueOfHotByColumnId($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"]) && isset($data["column_id"])) {
			if(@$data["page"]==0&&@$data["size"]==0){
				$result_news = $this -> newsDao -> findNewsStatusTrueOfHotByColumnId($data["column_id"],null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> findNewsStatusTrueOfHotByColumnId($data["column_id"],$page,$size);
			}
		}else{
			$result_news = $this -> newsDao -> findNewsStatusTrueOfHotByColumnId($data["column_id"],0,10);
		}
		return $result_news;
	}
	/*
	 * 根据标题获取已发布并且有封面图片的新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsStatusTrueByColumnTitleOfCover($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"]) && isset($data["column_title"])) {
			if(@$data["page"]==0&&@$data["size"]==0){
				$result_news = $this -> newsDao -> findNewsByColumnTitleStatusTrueOfCover($data["column_title"],null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> findNewsByColumnTitleStatusTrueOfCover($data["column_title"],$page,$size);
			}
		}else{
			$result_news = $this -> newsDao -> findNewsByColumnTitleStatusTrueOfCover($data["column_title"],0,10);
		}
		return $result_news;
	}
/*
	 * 获取已发布带有封面图片的新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsStatusTrueOfCover($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"]) && isset($data["column_title"])) {
			if(@$data["page"]==0&&@$data["size"]==0){
				$result_news = $this -> newsDao -> findNewsStatusTrueOfCover(null,null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> findNewsStatusTrueOfCover($page,$size);
			}
		}else{
			$result_news = $this -> newsDao -> findNewsStatusTrueOfCover(0,10);
		}
		return $result_news;
	}
	/*
	 * 通过新闻标题搜索新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsByTitle($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if(@$data["page"]==0&&@$data["size"]==0){
				$result_news = $this -> newsDao -> searchNewsByTitle($data["title"], null, null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> searchNewsByTitle($data["title"], $page, $size);
			}
		}else{
			$result_news = $this -> newsDao -> searchNewsByTitle($data["title"], 0, 10);
		}
		return $result_news;
	}
	/*
	 * 通过栏目标题搜索新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsByColumnTitle($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if(@$data["page"]==0&&@$data["size"]==0){
				$result_news = $this -> newsDao -> searchNewsByColumnTitle($data["column_title"], null, null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> searchNewsByColumnTitle($data["column_title"], $page, $size);
			}
		}else{
			$result_news = $this -> newsDao -> searchNewsByColumnTitle($data["column_title"], 0, 10);
		}
		return $result_news;
	}
	/*
	 * 通过栏目id获取新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsByColumnId($data) {
		if (isset($data["column_id"])) {
			$page = null;
			$size = null;
			if (isset($data["page"]) && isset($data["size"])) {
				if($data["page"]==0&&$data["size"]==0){
					$result_news = $this -> newsDao -> findNewsByColumnId($data["column_id"], null, null);
				}else{
					if ($data["page"] <= 0) {
						$data["page"] = 1;
					}
					$page = ($data["page"] - 1) * $data["size"];
					$size = $data["size"];
					$result_news = $this -> newsDao -> findNewsByColumnId($data["column_id"], $page, $size);
				}
			}else{
				$result_news = $this -> newsDao -> findNewsByColumnId($data["column_id"], 0, 10);
			}
			return $result_news;
		} else {
			error("缺少信息");
		}
	}
	/*
	 * 通过栏目id获取已启动的新闻信息
	 * 返回数量：多条
	 * */
	public function getNewsByColumnIdStatusTrue($data) {
		if (isset($data["column_id"])) {
			$page = null;
			$size = null;
			if (isset($data["page"]) && isset($data["size"])) {
				if($data["page"]==0&&$data["size"]==0){
					$result_news = $this -> newsDao -> findNewsByColumnIdStatusTrue($data["column_id"], null, null);
				}else{
					if ($data["page"] <= 0) {
						$data["page"] = 1;
					}
					$page = ($data["page"] - 1) * $data["size"];
					$size = $data["size"];
					$result_news = $this -> newsDao -> findNewsByColumnIdStatusTrue($data["column_id"], $page, $size);
				}
			}else{
				$result_news = $this -> newsDao -> findNewsByColumnIdStatusTrue($data["column_id"], 0, 10);
			}
			return $result_news;
		} else {
			error("缺少信息");
		}
	}
	/*
	 * 获取轮播新闻信息
	 * 返回数量：多条
	 * */
	public function getSlideshows($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if($data["page"]==0&&$data["size"]==0){
				$result = $this -> slideshowDao ->findSlideshow(null, null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result = $this -> slideshowDao ->findSlideshow($page, $size);
			}
		}else{
			$result = $this -> slideshowDao ->findSlideshow(0, 10);
		}
		return $result;
	}
	/*
	 * 获取轮播新闻信息
	 * 返回数量：多条
	 * */
	public function getSlideshowsStatusTrue($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if($data["page"]==0&&$data["size"]==0){
				$result = $this -> slideshowDao ->findSlideshowStatusTrue(null, null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result = $this -> slideshowDao ->findSlideshowStatusTrue($page, $size);
			}
		}else{
			$result = $this -> slideshowDao ->findSlideshowStatusTrue(0, 10);
		}
		return $result;
	}
	/*
	 * 获取回收站信息
	 * 返回数量：多条
	 * */
	public function getRecycleBins($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if($data["page"]==0&&$data["size"]==0){
				$result = $this -> recycleBinDao ->findRecycleBin(null, null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result = $this -> recycleBinDao ->findRecycleBin($page, $size);
			}
		}else{
			$result = $this -> recycleBinDao ->findRecycleBin(0, 10);
		}
		return $result;
	}
	/*
	 * 通过标题搜索回收站信息
	 * 返回数量：多条
	 * */
	public function searchRecycleBinsByTitle($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if($data["page"]==0&&$data["size"]==0){
				$result = $this -> recycleBinDao ->searchRecycleBinByTitle($data["title"], null, null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result = $this -> recycleBinDao ->searchRecycleBinByTitle($data["title"], $page, $size);
			}
		}else{
			$result = $this -> recycleBinDao ->searchRecycleBinByTitle($data["title"], 0, 10);
		}
		return $result;
	}
	/*
	 * 获取计算机工程系教师信息
	 * 返回数量：多条
	 * */
	public function getTeachers($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if($data["page"]==0&&$data["size"]==0){
				$result = $this -> teacherDao ->findTeachers(null, null);
			}else{
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result = $this -> teacherDao ->findTeachers($page, $size);
			}
		}else{
			$result = $this -> teacherDao ->findTeachers(0, 10);
		}
		return $result;
	}
	/*
	 * 根据id获取教师信息
	 * 返回数量：多条
	 * */
	public function getTeacherById($data) {
		if (isset($data["id"])) {
			$result_tea = $this -> teacherDao -> findTeacherById($data["id"]);
			return $result_tea[0];
		}else{
			error("缺少必要参数：getTeacherById");
		}
	}
}
?>