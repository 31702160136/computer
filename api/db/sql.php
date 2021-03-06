<?php
include_once "./../config/source.php";
//		$data=array("jj"=>"jj","j3j"=>"jj1");
class Sql{
	private $link=null;
	function __construct(){
		$source=new Source();
		$this->link=$source->getSource();
	}
	function query($sql){
		$result = mysqli_query($this->link, $sql); //查询
		$array=array();
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result))
			{
				array_push($array,$row);
			}
		}
		return $array;
	}
	function insert($array){
		$data=$array["data"];
		$str1=null;
		$str2=null;
		$count=count($data);
		foreach($data as $key=>$value){
			if($data[$key]==null){
				unset($data[$key]);
				$count--;
				continue;
			}
			if($count>1){
				$str1=$str1."`".$key."`, ";
				$str2=$str2."'".$value."', ";
			}else{
				$str1=$str1."`".$key."`";
				$str2=$str2."'".$value."'";
			}
			$count--;
		}
		$sql="insert into `".$array['table']."` (".$str1.") values (".$str2.")";
		$result = mysqli_query($this->link, $sql);
		mysqli_commit($this->link);
		return $result;
	}
	function inserts($array){
		$data=$array["data"];
		$str1=null;
		$str2=null;
		$count=count($data);
		for($i=0;$i<$count;$i++){
			$str2.="(";
			foreach($data[$i] as $key=>$value){
				if($data[$i][$key]==null){
					$data[$i][$key]="";
				}
				if($i==0){
					$str1.="`".$key."`,";
				}
				$str2=$str2."'".$value."',";
			}
			$str2=substr($str2,0,strlen($str2)-1);
			$str2.="),";
		}
		$key=substr($str1,0,strlen($str1)-1);
		$value=substr($str2,0,strlen($str2)-1);
		$sql="insert into `".$array['table']."` (".$key.") values ".$value;
		$result = mysqli_query($this->link, $sql);
		mysqli_commit($this->link);
		return $result;
	}
	function modify($array){
		$data=$array["data"];
		$str=null;
		$count=count($data);
		foreach($data as $key=>$value){
			if(is_null($data[$key])){
				unset($data[$key]);
				$count--;
				continue;
			}
			if($count>1){
				$str=$str."`".$key."` = '".$value."', ";
			}else{
				$str=$str."`".$key."` = '".$value."' ";
			}
			$count--;
		}
		$sql="update `".$array['table']."` set ".$str." where id=".$array['id'];
		$result = mysqli_query($this->link, $sql);
		mysqli_commit($this->link);
		return $result;
	}
	function delete($array){
		$str=null;
		for($i=0;$i<count($array['data']);$i++){
			if(($i+1)>=count($array['data'])){
				$str=$str."'".$array['data'][$i]."'";
			}else{
				$str=$str."'".$array['data'][$i]."',";
			}
		}
		$sql="delete from `".$array['table']."` where `".$array['fields']."` in (".$str.")";
		$result = mysqli_query($this->link, $sql);
		mysqli_commit($this->link);
		return $result;
	}
}
?>