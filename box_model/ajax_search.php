<?php
	//$_POST['keyword'] = '三国';
	if(isset($_POST['keyword']))
	{
		$queue_name = array();

		$keyword = $_POST['keyword'] ;

		include_once("conn.php");

		$table = "`4399`";
		$page_size = 10;
		$offset = 0 ;
		$sql = "select name,id,leixing from ".$table." where name like '%".$keyword."%' and flash != '' limit ".$offset.",".$page_size."";
		$result = mysql_query($sql);
		while( $row = mysql_fetch_array($result) )
		{
			$name = $row['name'] ;
			$id = $row['id'] ;
			$leixing = $row['leixing'] ;
			
			array_push($queue_name,$name."::".$id."::".$leixing);
		}

		echo json_encode($queue_name);

	}

?>