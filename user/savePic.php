<?php
if( $_COOKIE['name'] != '')
{
	session_start();
	if( $_FILES['newHeadPic']['error'] > 0  )
	{
		echo "Error:".$_FILES['newHeadPic']['error']."<br/>";
	}
	else{
		echo "Upload:".$_FILES['newHeadPic']['name']."<br/>";
		echo "Type:".$_FILES['newHeadPic']['type']."<br/>";
		echo "Size:".$_FILES['newHeadPic']['size']."kb<br/>";
		echo "Stored in ".$_FILES['newHeadPic']['tmp_name']."<br/>";

		$dir = "d:/wamp/www/boxroot/user/newhead/";
		//$dir = "D:/up_qidong/0922/ajaxHead/pic/";
		if( !file_exists($dir) )
		{
			mkdir($dir,0777,true);
		}
		if( file_exists($dir.$_FILES['newHeadPic']['name']) )
		{
			echo $_FILES['newHeadPic']['name']."already exists";
			echo "<script>alert('图片已经存在');</script>";
		}
		else{

			include_once("../conn.php");
			$sql = "select id from users where username = '".$_COOKIE['name']."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$id = $row['id'] ;
			move_uploaded_file($_FILES['newHeadPic']['tmp_name'], $dir.$_FILES['newHeadPic']['name']);
			//此处需要即时缩放图片大小,否则裁剪效果与视图页所看到效果不一致。因为原图可能较大
			
			include_once('image.class.php');
			$uploadImgPath = "d:/wamp/www/boxroot/user/newhead/".$_FILES['newHeadPic']['name'];
			$saveResizePath = $uploadImgPath;
			$width = 280 ;
			$height = 280 ;
			$image=new image($uploadImgPath,1,"280","280", $saveResizePath); //使用图片裁剪功能
			$image->outimage();

			$picUrl = "/user/newhead/".$_FILES['newHeadPic']['name'];
			$s_ck_name = "s".$_COOKIE['name'] ;
			//$_SESSION[$_COOKIE['name']] = $picUrl ;
			$_SESSION[$s_ck_name] = $picUrl;

			echo "Stored in ".$dir.$_FILES['newHeadPic']['name'];
			
	?>
		<script src="js/jquery.js"></script>
		<script>
			var midPicUrl = "<?php echo $picUrl; ?>";
			
			$('#avatar1',window.parent.document).attr('src',midPicUrl);
			$('#avatar',window.parent.document).attr('src',midPicUrl);
			$('#avatar2',window.parent.document).attr('src',midPicUrl);
		</script>
	<?php
		}
	}
}
else{
	echo "<script>alert('你还没有登录');</script>";
}
