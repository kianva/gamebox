<?php

$path1 = "d:/wamp/www/gamebox/head_pic/72/";

$path2 = "d:/wamp/www/gamebox/head_pic/138/";

$dir1 = opendir($path2);
$mark = 0;

$conn = mysql_connect("localhost",'root','root');
if( $conn )
{
	$db = "gamebox";
	mysql_select_db($db);
	$table = "page_game";
}
else{
	echo "mysql connection failed...<br/>";
}
while( ( $file = readdir($dir1) ) != false )
{
	$file = iconv("gb2312",'utf-8',$file);
	$mark++;
	if( $mark != 1 && $mark != 2)
	{
		//echo $mark."文件名:".$file."<br/>";
		
		$name = $file ;
		$arr_name = explode('.',$name);
		$name2 = $arr_name[0] ;
		$small_pic = "/gamebox/head_pic/72/".$name;
		$wide_pic = "/gamebox/head_pic/138/".$name;
		echo $name2."<br/>";
		//$sql = "update ".$table." set small_pic = '".$small_pic."' where name = '".$name2."'";
		$sql = "update ".$table." set wide_pic = '".$wide_pic."' where name = '".$name2."'";
		mysql_query($sql);
		if( mysql_affected_rows() > 0 )
		{
			echo $name2.":small_pic写入数据库成功<br/>";
		}
		else{
			echo $name2.":small_pic 写入数据库失败<br/>";
		}
				
	}
}
closedir($dir1);

?>