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

	function delUserByUserName($data) {
		if (isset($data)) {
			$result = $this -> userDao -> findUserByUserName(getSessionUserName());
			if ($result[0]["role"] == "superAdmin") {
				$result = $this -> userDao -> deleteUserByUserName($data);
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