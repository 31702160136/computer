<?php
include_once "./../dao/user_dao.php";
include_once "./../handler/handler.php";
include_once "./../dao/column_dao.php";
include_once "./../dao/news_dao.php";
include_once "./../config/path.php";
class DeleteService {
	private $userDao = null;
	private $columnDao = null;
	private $newsDao = null;
	function __construct() {
		$this -> userDao = new UserDao();
		$this -> columnDao = new ColumnDao();
		$this -> newsDao = new NewsDao();
	}
	/*
	 * 通过用户id删除用户
	 * */
	function delUserById($data) {
		if (isset($data)&&is_array($data)) {
			$result = $this -> userDao -> deleteUserById($data);
			//判断是否删除成功
			if ($result > 0) {
				return true;
			} else {
				return false;
			}
		}else{
			error("缺少参数:delUserById");
		}
	}
	/*
	 * 通过栏目id删除栏目
	 * */
	function delColumnById($data) {
		if (isset($data)&&is_array($data)) {
			$result = $this -> columnDao ->deleteColumnById($data);
			//判断是否删除成功
			if ($result > 0) {
				return true;
			} else {
				return false;
			}
		}else{
			error("缺少参数：delColumnById");
		}
	}
	/*
	 * 通过新闻id删除新闻
	 * */
	function delNewsById($data) {
		if (isset($data)&&is_array($data)) {
			$result = $this -> newsDao ->deleteNewsById($data);
			//判断是否删除成功
			if ($result > 0) {
				return true;
			} else {
				return false;
			}
		}else{
			error("缺少参数：delNewsById");
		}
	}

}
?>