<?php
include_once "./../dao/user_dao.php";
include_once "./../dao/column_dao.php";
include_once "./../handler/handler.php";
include_once "./../dao/news_dao.php";
include_once "./../utils/session_status.php";
class ModifyService {
	private $userDao = null;
	private $columnDao = null;
	function __construct() {
		$this -> userDao = new UserDao();
		$this -> columnDao = new ColumnDao();
		$this -> newsDao = new NewsDao();
	}

	/*
	 * 修改管理员密码
	 * */
	public function modifyUserPassword($data) {
		//判断信息是否为空
		if (isset($data["id"]) && isset($data["password"]) && isset($data["oldPassword"])) {
			//取出新密码与旧密码
			$password = $data["password"];
			$oldPassword = $data["oldPassword"];
			//查询管理员信息
			$result = $this -> userDao -> findUserByUserName($data["id"]);
			//对比旧密码是否一致
			if ($result[0]["password"] == $oldPassword) {
				//对比新密码与旧密码是否一致
				if ($result[0]["password"] != $password) {
					//重新打包数据
					$data = array("password" => $password, "modify_time" => time());
					//修改密码
					$result = $this -> userDao -> modifyUser($data, $result[0]["id"]);
					//判断是否修改成功
					if ($result > 0) {
						return true;
					} else {
						return false;
					}
				} else {
					error("新密码与旧密码一致，请重新修改密码");
				}
			} else {
				error("旧密码错误");
			}
		} else {
			error("缺少必要信息：modifyUserPassword");
		}
	}

	/*
	 * 修改栏目
	 * */
	public function modifyColumn($data) {
		if (isset($data["id"])) {
			$id = $data["id"];
			unset($data["id"]);
			$data["modify_time"] = time();
			$result = $this -> columnDao -> modifyColumn($data, $id);
			if ($result > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			error("缺少必要信息：modifyColumn");
		}
	}

	/*
	 * 修改栏目状态
	 * */
	public function modifyColumnStatus($data) {
		if (isset($data["id"])) {
			$id = $data["id"];
			$result = $this -> columnDao -> findColumnById($id);
			if (count($result) > 0) {
				unset($data["id"]);
				$data["is_status"] = $result[0]["is_status"] == 0 ? 1 : 0;
				$data["modify_time"] = time();
				$result = $this -> columnDao -> modifyColumn($data, $id);
				if ($result > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				error("没有此栏目");
			}
		} else {
			error("缺少必要信息");
		}
	}
	/*
	 * 用户栏目状态
	 * */
	public function modifyUserStatus($data) {
		if (isset($data["id"])) {
			$id = $data["id"];
			$result = $this -> userDao -> findUser($id);
			if (count($result) > 0) {
				unset($data["id"]);
				$data["is_status"] = $result[0]["is_status"] == 0 ? 1 : 0;
				$data["modify_time"] = time();
				$result = $this -> userDao -> modifyUser($data, $id);
				if ($result > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				error("没有此用户");
			}
		} else {
			error("缺少必要信息");
		}
	}
	/*
	 * 修改新闻状态
	 * state可修改状态为：is_hot，is_top，is_status
	 * */
	public function modifyNewsState($data) {
		if (isset($data["id"])&&isset($data["state"])) {
			$id = $data["id"];
			$result = $this -> newsDao -> findNewsById($id);
			if (count($result) > 0) {
				unset($data["id"]);
				$state=$data["state"];
				unset($data["state"]);
				$data[$state]=$result[0][$state] == 0 ? 1 : 0;
				$data["modify_time"] = time();
				$result = $this -> newsDao ->modifyNews($data, $id);
				if ($result > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				error("没有此新闻");
			}
		} else {
			error("缺少必要信息：modifyNewsState");
		}
	}

}
?>