<?php
	$_POST['type'] = '动作';
	if( isset($_POST['type']) )
	{
		$type = $_POST['type'] ;
		$game_name = array();

		include_once("conn.php");
		mysql_select_db("little_game");
		$table = "`4399`";
		//$sql = "select * from ".$table." where leixing='".$type."' order by rand() limit 13";
		$sql = "select * from ".$table." where flash != '' order by rand() limit 13";
		$result = mysql_query($sql);
		while( $row = mysql_fetch_array($result) )
		{
			$id = $row['id'] ;
			$name = $row['name'] ;
			$pic = $row['pic'] ;
			//$url = $row['url'] ;
			//$flash = $row['flash'] ;
			$leixing = $row['leixing'] ;
			//echo $name;
			
			$all = $name.",".$pic.",".$id.",".$leixing ;
			//echo $all."<br/>";
			array_push($game_name,$all);
		}
		
		echo json_encode($game_name);
	}
?>