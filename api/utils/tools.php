<?php
include_once "./../handler/handler.php";
$data=array("j"=>1);
function getTime(){
	echo time();
}
function getPage($data,$size_){
	if(is_array($data)){
		$sum=count($data);
		//每页的信息数量
		$size=$size_;
		//用新闻数量转换页数
		if(is_float($sum/$size)){
			$page=intval(($sum/$size))+1;
		}else{
			$page=intval(($sum/$size));
		}
		return $page;
	}else{
		return 1;
	}
}
function uploadImage($name){
	if(isset($_FILES[$name])){
		$tmpimg=$_FILES[$name]["tmp_name"];//获取临时文件路径
		$tp=array("image/gif","image/png","image/jpeg","image/jpg","image/ioc","image/pjpeg");
		if(!in_array($_FILES[$name]["type"],$tp)){
			error("图片格式错误");
		}
		$index=stripos($_FILES[$name]["type"],"/")+1;
		$type=substr($_FILES[$name]["type"],$index);
		$img_name=getRandomCode().".".$type;//文件名
		$result=move_uploaded_file($tmpimg, "../../images/".$img_name);
		if($result>0){
			return getImagesPath().$img_name;
		}else{
			return null;
		}
	}
	return "";
}
function getRandomCode(){
	$letter="a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z";
	$letter=explode(",",$letter);
	$numbers = range (0,25); 
	//shuffle 将数组顺序随即打乱 
	shuffle ($numbers); 
	//array_slice 取该数组中的某一段 
	$result = array_slice($numbers,0,26);
	$sum="";
	for($i=0;$i<26;$i++){
		$sum.=$letter[$result[$i]];
	}
	return $sum.time();
}
?>