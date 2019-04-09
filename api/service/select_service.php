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

	public function getUsers($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if ($data["page"] <= 0) {
				$data["page"] = 1;
			}
			$page = ($data["page"] - 1) * $data["size"];
			$size = $data["size"];
		}
		$result = $this -> userDao -> findUsers($page,$size);
		return $result;
	}

	//通过账号获取用户信息
	public function getUserInfoByUserName($username) {
		if (isset($username)) {
			$result = $this -> userDao -> findUserByUserName($username);
			if (count($result) > 0) {
				return $result[0];
			} else {
				error("账号不存在");
			}
		} else {
			error("请输入账号");
		}
	}

	public function getColumns() {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if ($data["page"] <= 0) {
				$data["page"] = 1;
			}
			$page = ($data["page"] - 1) * $data["size"];
			$size = $data["size"];
		}
		$result = $this -> columnDao -> findColumns($page,$size);
		return $result;
	}

	public function getNews($data) {
		$page = null;
		$size = null;
		if (isset($data["page"]) && isset($data["size"])) {
			if ($data["page"] <= 0) {
				$data["page"] = 1;
			}
			$page = ($data["page"] - 1) * $data["size"];
			$size = $data["size"];
		}
		$result_news = $this -> newsDao -> findNews($page,$size);
		for ($i = 0; $i < count($result_news); $i++) {
			$result_news[$i]["cover"] = getLink() . $result_news[$i]["cover"];
			$result_news[$i]["slideshow_cover"] = getLink() . $result_news[$i]["slideshow_cover"];
		}
		return $result_news;
	}

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
			}
			$result_news = $this -> newsDao -> findNewsByColumnId($data["column_id"], $page, $size);
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