<?php
	if( isset($_POST['username']) && isset( $_POST['password'] ) && isset( $_POST['password2'] ) )
	{
		$username = $_POST['username'] ;
		$password1 = $_POST['password'] ;
		$password2 = $_POST['password2'] ;

		include_once("/gamebox/box_model/conn.php");
		$table = "users";

		if( $password1 == $password2 )
		{

			$sql = "select count(username) as count from ".$table." where username = '".$username."'";
			$result = mysql_query($sql);
			$row_count = mysql_fetch_array($result);
			$exist = $row_count['count'] ;

			if( $exist > 0 )
			{
				$arr = array('message'=>'已经存在用户');
				echo json_encode($arr);
			}
			else{
				//尚未存在同名用户
				//检查密码

				
			}

		}
		else{
			//两次密码不相等。
		}
	}
?>