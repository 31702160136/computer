<?php
include_once "./../dao/user_dao.php";
include_once "./../handler/handler.php";
include_once "./../dao/column_dao.php";
include_once "./../dao/news_dao.php";
include_once "./../config/path.php";
class SelectService {
	private $userDao = null;
	private $columnDao = null;
	private $newsDao = null;
	function __construct() {
		$this -> userDao = new UserDao();
		$this -> columnDao = new ColumnDao();
		$this -> newsDao = new NewsDao();
	}
	/*
	 * 获取用户信息
	 * 返回数量：多条
	 * */
	public function getUsers($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if ($data["page"] <= 0) {
				$data["page"] = 1;
			}
			$page = ($data["page"] - 1) * $data["size"];
			$size = $data["size"];
			$result = $this -> userDao -> findUsers($page,$size);
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
			if ($data["page"] <= 0) {
				$data["page"] = 1;
			}
			$page = ($data["page"] - 1) * $data["size"];
			$size = $data["size"];
			$result = $this -> columnDao -> findColumns($page,$size);
		}else{
			$result = $this -> columnDao -> findColumns(0,10);
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
			if ($data["page"] <= 0) {
				$data["page"] = 1;
			}
			$page = ($data["page"] - 1) * $data["size"];
			$size = $data["size"];
			$result_news = $this -> newsDao -> findNews($page,$size);
		}else{
			$result_news = $this -> newsDao -> findNews(0,10);
		}
		//当前http链接拼接到图片路径
		for ($i = 0; $i < count($result_news); $i++) {
			if($result_news[$i]["cover"]!=""){
				$result_news[$i]["cover"] = getLink() . $result_news[$i]["cover"];
			}
			if($result_news[$i]["slideshow_cover"]!=""){
				$result_news[$i]["slideshow_cover"] = getLink() . $result_news[$i]["slideshow_cover"];
			}
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
				if ($data["page"] <= 0) {
					$data["page"] = 1;
				}
				$page = ($data["page"] - 1) * $data["size"];
				$size = $data["size"];
				$result_news = $this -> newsDao -> findNewsByColumnId($data["column_id"], $page, $size);
			}else{
				$result_news = $this -> newsDao -> findNewsByColumnId($data["column_id"], 0, 10);
			}
			
			//当前http链接拼接到图片路径
			for ($i = 0; $i < count($result_news); $i++) {
				$result_news[$i]["cover"] = getLink() . $result_news[$i]["cover"];
				$result_news[$i]["slideshow_cover"] = getLink() . $result_news[$i]["slideshow_cover"];
			}
			return $result_news;
		} else {
			error("缺少信息");
		}
	}

}
?>