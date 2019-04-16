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

	function delUserById($data) {
		if (isset($data)) {
			$result = $this -> userDao -> findUserByUserName(getSessionUserName());
			if ($result[0]["role"] == "superAdmin") {
				$result = $this -> userDao -> deleteUserById($data);
				//判断是否修改成功
				if ($result > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				error("权限不足");
			}
		}else{
			error("缺少参数");
		}
	}
	
	function delColumnById($data) {
		if (isset($data)) {
			$result = $this -> userDao -> findUserByUserName(getSessionUserName());
			if ($result[0]["role"] == "admin" || $result[0]["role"] == "superAdmin") {
				$result = $this -> columnDao ->deleteColumnById($data);
				//判断是否修改成功
				if ($result > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				error("权限不足");
			}
		}else{
			error("缺少参数");
		}
	}
	
	function delNewsById($data) {
		if (isset($data)) {
			$result = $this -> userDao -> findUserByUserName(getSessionUserName());
			if ($result[0]["role"] == "admin" || $result[0]["role"] == "superAdmin") {
				$result = $this -> newsDao ->deleteNewsById($data);
				//判断是否修改成功
				if ($result > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				error("权限不足");
			}
		}else{
			error("缺少参数");
		}
	}

}
?>