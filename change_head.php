$path = "c:/wamp/www/boxroot/head_pic/138/";
$dir = opendir($path);
while( ($file = readdir($dir)) != false )
{
	if( $file !='.' && $file != '..' )
	{
		$arr = explode('.',$file);
		$filename = $arr[0];
		$pre = $arr[1] ;

		$conn = mysqli_connect("192.168.1.101:3306",'root','123456');
		if( $conn )
		{
			mysqli_query($conn,'set names gbk');
			mysqli_query($conn,'use gamebox');
			$sql = "select id from page_game where name = '".$filename."'";
			$result = mysqli_query($conn,$sql);
			$mark = 0;
			while($row = mysqli_fetch_array($result))
			{
				if( $mark != 1)
				{
					$id = $row['id'] ;
					//echo $id.$pre."<br/>";
					rename($file,$id.".".$pre);
					$sql2 = "update page_game set wide_pic = '/head_pic/138/".$id.".".$pre."' where name='".$filename."'";
					mysqli_query($conn,$sql2);
					if(mysqli_affected_rows()>0)
					{
						echo "更新$filename大小图数据库地址成功<br/>";
					}

					$mark = 1;
				}
			}
		}
		else{
			echo "mysql connection failed...<br/>";
		}
	}
}
