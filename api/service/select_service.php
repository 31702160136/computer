<?php
include_once "./../dao/user_dao.php";
include_once "./../handler/handler.php";
include_once "./../dao/column_dao.php";
include_once "./../dao/news_dao.php";
class SelectService {
	private $userDao = null;
	private $columnDao = null;
	private $newsDao = null;
	function __construct() {
		$this -> userDao = new UserDao();
		$this -> columnDao = new ColumnDao();
		$this -> newsDao = new NewsDao();
	}

	public function getUsers() {
		$result = $this -> userDao -> findUsers();
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
		$result = $this -> columnDao -> findColumns();
		return $result;
	}

	public function getNews() {
		$result_news = $this -> newsDao -> findNews();
		return $result_news;
	}

	public function getNewsByColumnId($id) {
		if (isset($id)) {
			$result_news = $this -> newsDao -> findNewsByColumnId($id);
			return $result_news;
		}else{
			error("缺少信息");
		}
	}

}
?>