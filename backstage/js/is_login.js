$.ajax({
	type:"post",
	url: host + "controller_b/is_login.php",
	async:true,
	success: function(data){
		var res=JSON.parse(data);
		if (res.status == false) {
			console.log("index");
			alert("用户登录已过期，请重新登录！");
			window.location.href = "login.html";
			return;
		}
	},
    error : function () {
      	document.write("error");
    }
});