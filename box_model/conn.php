<?php
	$conn = mysql_connect("localhost",'root','root');
	if( $conn )
	{
		$db = "gamebox";
		mysql_select_db($db);
		
	}
	else{
		echo "mysql connect failed...<br/>";
	}
?>