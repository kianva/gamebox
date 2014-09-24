<?php
/*
if( $_FILES['newHeadPic']['error'] > 0  )
{
	echo "Error:".$_FILES['newHeadPic']['error']."<br/>";
}
else{
	echo "Upload:".$_FILES['newHeadPic']['name']."<br/>";
	echo "Type:".$_FILES['newHeadPic']['type']."<br/>";
	echo "Size:".$_FILES['newHeadPic']['size']."kb<br/>";
	echo "Stored in ".$_FILES['newHeadPic']['tmp_name']."<br/>";

	$dir = "d:/wamp/www/boxroot/newhead/";
	if( !file_exists($dir) )
	{
		mkdir($dir,0777,true);
	}
	if( file_exists($dir.$_FILES['newHeadPic']['name']) )
	{
		echo $_FILES['newHeadPic']['name']."already exists";
		$returnPicUrl = "/newhead/".$_FILES['newHeadPic']['name'];
	}
	else{
		move_uploaded_file($_FILES['newHeadPic']['tmp_name'], $dir.$_FILES['newHeadPic']['name']);
		$returnPicUrl = "/newhead/".$_FILES['newHeadPic']['name'];
		echo "Stored in ".$dir.$_FILES['newHeadPic']['name'];
		//echo "<script>alert('成功');</script>";
	}

}
*/


if( $_COOKIE['name'] != '')
{
	session_start();
	$x1 = isset($_POST['x1'])?$_POST['x1']:'';
	$y1 = isset($_POST['y1'])?$_POST['y1']:'';
	$x2 = isset($_POST['x2'])?$_POST['x2']:'';
	$y2 = isset($_POST['y2'])?$_POST['y2']:'';

	$height = $y2- $y1;
	$width = $x2 - $x1;

	$conn = mysql_connect("localhost",'root','root');
	if( $conn )
	{
		mysql_select_db('test');
		$sql = "insert into temp(x1,x2,y1,y2) values('".$x1."','".$x2."','".$y1."','".$y2."')";
		mysql_query($sql);
	}

	//include_once("../conn.php");


	$dir = "d:/wamp/www/boxroot"; //网站根目录

	//$imgUrl = $_SESSION[$_COOKIE['name']] ; //session保存的是 /user/newhead/图片名.jpg
	$s_ck_name = "s".$_COOKIE['name'] ;
	$imgUrl = $_SESSION[$s_ck_name] ;

	$suffix_str = strrchr($imgUrl,'.');
	$suffix_arr = explode('.',$suffix_str);
	$suffix = $suffix_arr[1] ;

	$uploadImgPath = $dir.$imgUrl ;

	$savePath = "/user/cutpic/";
	$saveCutImgPath = $dir.$savePath.$_COOKIE['name'].".".$suffix ;
	include_once('image.class.php');
	//$image=new image($uploadImgPath,2, "$x1,$y1", "$x2,$y2", $saveCutImgPath); //使用图片裁剪功能
	$image=new image($uploadImgPath,2, "$x1,$y1", "$width,$height", $saveCutImgPath); //使用图片裁剪功能
	//$image=new image($uploadImgPath, 2, "0,0", "150,150", $saveCutImgPath); //使用图片裁剪功能
	$image->outimage();
	//裁剪完 缩放 180*180 60*60

	$path180 = "d:/wamp/www/boxroot/user/cutpic/180/";
	$path60 = "d:/wamp/www/boxroot/user/cutpic/60/";
	/*if( !file_exists($path180))
	{
		mkdir($path180,0777,true)
	}
	if( !file_exists($path60))
	{
		mkdir($path60,0777,true);
	}*/

	$image180 = new image($saveCutImgPath,1,"180","180",$path180.$_COOKIE['name'].".".$suffix);
	$image180->outimage();

	$image60 = new image($saveCutImgPath,1,"60","60",$path60.$_COOKIE['name'].".".$suffix);
	$image60->outimage();

	//$arr= array('message'=>'裁剪成功!');
	$picurl = "/user/cutpic/60/".$_COOKIE['name'].".".$suffix;
	$arr = array('mark'=>1,'picurl'=>$picurl);
	echo json_encode($arr);
}
