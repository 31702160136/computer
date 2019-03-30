<?php
include_once "./../utils/session_status.php";
include_once "./../handler/handler.php";
$result=sessionOutLogin();
if($result){
	succeed("注销成功");
}else{
	error("注销失败");
}
?>