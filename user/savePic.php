<?php
if( $_COOKIE['name'] != '')
{
	session_start();
?>
	<script src="js/jquery.js"></script>
<?php
	
	if( $_FILES['newHeadPic']['error'] > 0  )
	{
		echo "Error:".$_FILES['newHeadPic']['error']."<br/>";
	}
	else{
		echo "Upload:".$_FILES['newHeadPic']['name']."<br/>";
		echo "Type:".$_FILES['newHeadPic']['type']."<br/>";
		echo "Size:".$_FILES['newHeadPic']['size']."kb<br/>";
		echo "Stored in ".$_FILES['newHeadPic']['tmp_name']."<br/>";

		//$dir = "d:/wamp/www/boxroot/user/newhead/";

		include_once('../conn.php');  //
		$sql = "select id from users where username = '".$_COOKIE['name']."' limit 1" ;
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$id = $row['id'] ; //当前登录用户ID
		mysql_close();

		$dir = "d:/wamp/www/boxroot/user/newhead/".$id."/";

		$suffix_str = strrchr($_FILES['newHeadPic']['name'],'.');
		$suffix_arr = explode('.',$suffix_str);
		$suffix = $suffix_arr[1] ;
		$old_name = $_FILES['newHeadPic']['name'] ;
		$rand = rand(1,10000);
		//$_FILES['newHeadPic']['name'] = $id."_".$rand.".".$suffix;
		$_FILES['newHeadPic']['name'] = $id.".".$suffix;

		if( !file_exists($dir) )
		{
			mkdir($dir,0777,true);
		}
		if( file_exists($dir.$_FILES['newHeadPic']['name']) )
		{
			//echo $_FILES['newHeadPic']['name']."already exists";
			//echo "<script>alert('图片已经存在');</script>";
			$old_id_name = $_FILES['newHeadPic']['name'] ;
			$rand = rand(1,10000);
			$_FILES['newHeadPic']['name'] = $id."_".$rand.".".$suffix;
			move_uploaded_file($_FILES['newHeadPic']['tmp_name'],$dir.$_FILES['newHeadPic']['name']);
			/*$suffix_str = strrchr($_FILES['newHeadPic']['name'],'.');
			$suffix_arr = explode('.',$suffix_str);
			$suffix = $suffix_arr[1] ;*/
			
			//rename($dir.$old_name,$dir.$_FILES['newHeadPic']['name']);
			include_once("image.class.php");
			
			$uploadImgPath = $dir.$_FILES['newHeadPic']['name'];
			$saveResizePath = $uploadImgPath;
			$width = 280 ;
			$height = 280 ;
			$image=new image($uploadImgPath,1,"280","280", $saveResizePath); //使用图片裁剪功能
			$image->outimage();

			$picUrl = "/user/newhead/".$id."/".$_FILES['newHeadPic']['name'];
			$s_ck_name = "s".$_COOKIE['name'] ;
			//$_SESSION[$_COOKIE['name']] = $picUrl ;
			$_SESSION[$s_ck_name] = $picUrl;
			//alert('hehe');
			unlink($dir.$old_id_name);
?>
			<script>
				var midPicUrl = "<?php echo $picUrl; ?>";
				
				$('#avatar1',window.parent.document).attr('src',midPicUrl);
				$('#avatar',window.parent.document).attr('src',midPicUrl);
				$('#avatar2',window.parent.document).attr('src',midPicUrl);
			</script>
<?php

		}
		else{

			/*include_once("../conn.php");
			$sql = "select id from users where username = '".$_COOKIE['name']."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$id = $row['id'] ;*/
			move_uploaded_file($_FILES['newHeadPic']['tmp_name'], $dir.$_FILES['newHeadPic']['name']);
			//此处需要即时缩放图片大小,否则裁剪效果与视图页所看到效果不一致。因为原图可能较大

			/* 09.25更新上传图片改名*/
			/*$old_name = $_FILES['newHeadPic']['name'];
			$suffix_str = strrchr($_FILES['newHeadPic']['name'],'.');
			$suffix_arr = explode('.',$suffix_str);
			$suffix = $suffix_arr[1] ;
			$_FILES['newHeadPic']['name'] = $id.".".$suffix;
			rename($dir.$old_name,$dir.$_FILES['newHeadPic']['name']);*/
			
			/*09.25更新上传图片改名*/


			include_once('image.class.php');
			$uploadImgPath = $dir.$_FILES['newHeadPic']['name'];
			$saveResizePath = $uploadImgPath;
			$width = 280 ;
			$height = 280 ;
			$image=new image($uploadImgPath,1,"280","280", $saveResizePath); //使用图片裁剪功能
			$image->outimage();

			$picUrl = "/user/newhead/".$id."/".$_FILES['newHeadPic']['name'];
			$s_ck_name = "s".$_COOKIE['name'] ;
			//$_SESSION[$_COOKIE['name']] = $picUrl ;
			$_SESSION[$s_ck_name] = $picUrl;

			/*遍历一下文件夹，删除ID_数字.jpg/png/.. 的图片 */
			$fp = opendir($dir);
			if( $fp )
			{
				while( ($file = readdir($fp) ) != false )
				{
					$file_arr = explode('_',$file);
					if( $file_arr[0] == $id )
					{
						unlink($dir.$file);
					}
				}
			}

			/*遍历一下文件夹，删除ID_数字.jpg/png/.. 的图片 */
			
			//echo "Stored in ".$dir.$_FILES['newHeadPic']['name'];
			
	?>
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