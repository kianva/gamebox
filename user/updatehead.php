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

/*	$x1 = 72;
	$x2 = 212;
	$y1 = 0;
	$y2 = 140;*/

	$height = $y2- $y1;
	$width = $x2 - $x1;

	/*$conn = mysql_connect("localhost",'root','root');
	if( $conn )
	{
		mysql_select_db('test');
		$sql = "insert into temp(x1,x2,y1,y2) values('".$x1."','".$x2."','".$y1."','".$y2."')";
		mysql_query($sql);
	}*/

	$dir = "d:/wamp/www/boxroot"; //网站根目录

	//$imgUrl = $_SESSION[$_COOKIE['name']] ; //session保存的是 /user/newhead/图片名.jpg
	$s_ck_name = "s".$_COOKIE['name'] ;
	$imgUrl = $_SESSION[$s_ck_name] ;

	$suffix_str = strrchr($imgUrl,'.');
	$suffix_arr = explode('.',$suffix_str);
	$suffix = $suffix_arr[1] ;

	$uploadImgPath = $dir.$imgUrl ;

	include_once('../conn.php');
	$sql = "select id from users where username = '".$_COOKIE['name']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$id = $row['id'] ;

	$savePath = "/user/cutpic/";
	$saveCutImgPath = $dir.$savePath.$_COOKIE['name'].".".$suffix ;
	include_once('image.class.php');
	//$image=new image($uploadImgPath,2, "$x1,$y1", "$x2,$y2", $saveCutImgPath); //使用图片裁剪功能
	$image=new image($uploadImgPath,2, "$x1,$y1", "$width,$height", $saveCutImgPath); //使用图片裁剪功能
	//$image=new image($uploadImgPath, 2, "0,0", "150,150", $saveCutImgPath); //使用图片裁剪功能
	$image->outimage();
	//裁剪完 缩放 180*180 60*60

	//$path180 = "d:/wamp/www/boxroot/user/cutpic/180/".$id;
	//$path60 = "d:/wamp/www/boxroot/user/cutpic/60/".$id;
	$path180 = "d:/wamp/www/boxroot/user/cutpic/".$id."/180/";
	$path60  = "d:/wamp/www/boxroot/user/cutpic/".$id."/60/";
	if( !file_exists($path180))
	{
		mkdir($path180,0777,true);
	}
	if( !file_exists($path60))
	{
		mkdir($path60,0777,true);
	}

	$imgPath180 = $path180.$_COOKIE['name'].".".$suffix;
	$imgPath60 = $path60.$_COOKIE['name'].".".$suffix;

	if( file_exists($imgPath180) )
	{
		unlink($imgPath180);
		$rand = rand(1,10000);
		$new_imgPath180 = $path180.$_COOKIE['name']."_".$rand.".".$suffix;

		$picurl180 = "/user/cutpic/".$id."/180/".$_COOKIE['name']."_".$rand.".".$suffix;
		$pic_name180 = $_COOKIE['name']."_".$rand.".".$suffix;
		$image180 = new image($saveCutImgPath,1,"180","180",$new_imgPath180);
		$image180->outimage();
	}
	else{
		$picurl180 = "/user/cutpic/".$id."/180/".$_COOKIE['name'].".".$suffix;
		$pic_name180 = $_COOKIE['name'].".".$suffix;
		$image180 = new image($saveCutImgPath,1,"180","180",$imgPath180);
		$image180->outimage();
	}

	if( file_exists($imgPath60) )
	{
		unlink($imgPath60);
		$rand = rand(1,10000);
		$new_imgPath60 = $path60.$_COOKIE['name']."_".$rand.".".$suffix;

		$picurl60 = "/user/cutpic/".$id."/60/".$_COOKIE['name']."_".$rand.".".$suffix;
		$pic_name60 = $_COOKIE['name']."_".$rand.".".$suffix;
		$image60 = new image($saveCutImgPath,1,"60","60",$new_imgPath60);
		$image60->outimage();
	}
	else{
		$picurl60 = "/user/cutpic/".$id."/60/".$_COOKIE['name'].".".$suffix;
		$pic_name60 = $_COOKIE['name'].".".$suffix;
		$image60 = new image($saveCutImgPath,1,"60","60",$imgPath60);
		$image60->outimage();
	}

	$fp = opendir($path60) ;
	while( ($file = readdir($fp)) != false )
	{
		if( $file != $pic_name60 && $file != '.' && $file != "..")
		{
			unlink($path60.$file);
		}
	}

	$fp2 = opendir($path180) ;
	while( ($file = readdir($fp2)) != false )
	{
		if( $file != $pic_name180 && $file != "." && $file != '..')
		{
			unlink($path180.$file);
		}
	}

/*	$image180 = new image($saveCutImgPath,1,"180","180",$path180.$_COOKIE['name'].".".$suffix);
	$image180->outimage();

	$image60 = new image($saveCutImgPath,1,"60","60",$path60.$_COOKIE['name'].".".$suffix);
	$image60->outimage();*/

	//$arr= array('message'=>'裁剪成功!');

	//$picurl = "/user/cutpic/60/".$_COOKIE['name'].".".$suffix;

	include_once("../conn.php");
	$sql = "update users set headpic = '".$picurl60."' where username = '".$_COOKIE['name']."'";
	$result = mysql_query($sql);
	if( mysql_affected_rows() > 0 )
	{
		$arr = array('mark'=>1,'picurl'=>$picurl60);
		echo json_encode($arr);	
	}
	else{
		$arr = array('mark'=>0,'picurl'=>'');
		echo json_encode($arr);
	}

}
