<body>
	<form action="login.php" method="post">
		<input name="username" />
		<br />
		<input name="password" />
		<br />
		<input type="submit" name="ok" value="提交"/>
	</form>
</body>
<?php
if (@$_POST["ok"]) {
	$post_data = array("username" => $_POST["username"], "password" => $_POST["password"]);
	$result = send_post("http://localhost/computer/api/controller_b/login.php", $post_data);
}
function send_post($url, $post_data) {

		$postdata = http_build_query($post_data);
		$options = array('http' => array('method' => 'POST', 'header' => 'Content-type:application/x-www-form-urlencoded', 'content' => $postdata, 'timeout' => 15 * 60 // 超时时间（单位:s）
		));
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		return $result;
	}
?>