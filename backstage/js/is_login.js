$.ajax({
	type:"post",
	url: host + "controller_b/is_login.php",
	async:true,
	success: function(data){
		var res=JSON.parse(data);
		if (res.status == false) {
			console.log("index");
			alert(res.message);
			window.location.href = "login.php";
			return;
		}
	},
    error : function () {
      	document.write("error");
    }
});