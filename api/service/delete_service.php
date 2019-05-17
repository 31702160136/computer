<?php
include_once "./../dao/user_dao.php";
include_once "./../handler/handler.php";
include_once "./../dao/column_dao.php";
include_once "./../dao/news_dao.php";
include_once "./../dao/slideshow_dao.php";
include_once "./../dao/recycle_bin_dao.php";
include_once "./../config/path.php";
class DeleteService {
	private $userDao = null;
	private $columnDao = null;
	private $newsDao = null;
	private $slideshowDao = null;
	private $recycleBinDao = null;
	function __construct() {
		$this -> userDao = new UserDao();
		$this -> columnDao = new ColumnDao();
		$this -> newsDao = new NewsDao();
		$this -> slideshowDao = new SlideshowDao();
		$this -> recycleBinDao = new RecycleBinDao();
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
			for($i=0;$i<count($data);$i++){
				//查询需要删除的新闻
				$result_news = $this -> newsDao->findNewsById($data[$i]);
				if(count($result_news)>0){
					$result_news[0]["recycle_time"]=time();
					unset($result_news[0]["id"]);
					//把需要删除的新闻写入回收站
					$result_recycle=$this -> recycleBinDao->createRecycleBin($result_news[0]);
				}
			}
			//删除新闻
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
	/*
	 * 通过新闻id删除轮播新闻
	 * */
	function delSlideshowById($data) {
		if (isset($data)&&is_array($data)) {
			$result = $this -> slideshowDao ->deleteSlideshowById($data);
			//判断是否删除成功
			if ($result > 0) {
				return true;
			} else {
				return false;
			}
		}else{
			error("缺少参数：delSlideshowById");
		}
	}
	/*
	 * 通过回收新闻id删除回收新闻
	 * */
	function delRecycleBinById($data) {
		if (isset($data)&&is_array($data)) {
			$result = $this -> recycleBinDao ->deleteRecycleBinById($data);
			//判断是否删除成功
			if ($result > 0) {
				return true;
			} else {
				return false;
			}
		}else{
			error("缺少参数：delRecycleBinById");
		}
	}

}
?>