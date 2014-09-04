<?php
	date_default_timezone_set("PRC");
	//$_POST['name'] = 'jianhua' ;
	
	//签到动作
	if( isset( $_POST['name'] ) )
	{
		$user_name = $_POST['name'] ;	//$check = $_POST['check'] ;
		$conn = mysql_connect("localhost",'root','root');
		if( $conn )
		{
			$db = "gamebox";
			mysql_select_db($db);
			$table = "users"; //用户表

			$today = date("Y-m-d");

			$read_sql = "select last_check from ".$table." where username='".$user_name."' limit 1";
			$result_read = mysql_query($read_sql);
			$row_read = mysql_fetch_array($result_read);
			$last_check = $row_read['last_check'] ;

			//if( $today !== $last_check ) // 最后签到时间 不是今天 则执行签到（即更新操作）
			//{
				$sql = "update ".$table." set days = days+1,last_check='".$today."' where username = '".$user_name."'";

				mysql_query($sql);
				if( mysql_affected_rows() > 0 )
				{
					//更新成功
					$sql2 = "select days from ".$table." where username='".$user_name."'";
					$result2 = mysql_query($sql2);
					$row2 = mysql_fetch_array($result2);
					$arr = array('check'=>1,'days'=>$row2['days']);
					
				}
				else{
					mysql_error();
					$arr = array('check'=>0);
				}
			//}
			/*
			else{
				//
			}*/
		}
		else{
			$arr = array('check'=>4); //mysql failed...
		}

		echo json_encode($arr);
	}

	//接受首页请求，返回当前登录用户
	//$_POST['who'] = 1;
	if( isset($_POST['who']) )
	{
		$cookie_login = isset( $_COOKIE['login'] )? $_COOKIE['login']:null;
		if( $cookie_login )
		{
			if( isset($_COOKIE['name']) )
			{
				$name = $_COOKIE['name'] ;
				$arr = array('name'=>$name);
			}
			else{
				$name = '';
				$arr = array('name'=>$name);
			}
			echo json_encode($arr);
		}
		else{
			$name = '';
			$arr = array('name'=>$name);
			echo json_encode($arr);
		}
	}

	//首页读取签到信息
	if( isset($_POST['current_name']) )
	{
		$current_name = $_POST['current_name'] ;

		include_once("conn.php");
		$table = "users";
		$sql = "select * from ".$table." where username = '".$current_name."' limit 1";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$checked_days = $row['days'] ;

		$last_check = $row['last_check'] ;

		$arr = array('days'=>$checked_days,'last_check'=>$last_check);
		echo json_encode($arr);
	}


	//新用户注册操作

	if( isset($_POST['username']) && isset( $_POST['password'] ) && isset( $_POST['password2'] ) )
	{
		$username = $_POST['username'] ;
		$password1 = $_POST['password'] ;
		$password2 = $_POST['password2'] ;

		include_once("conn.php");
		$table = "users";

		if( $password1 == $password2 )
		{

			$sql = "select count(username) as count from ".$table." where username = '".$username."'";
			$result = mysql_query($sql);
			$row_count = mysql_fetch_array($result);
			$exist = $row_count['count'] ;

			if( $exist > 0 )
			{
				$arr = array('message'=>'已经存在用户'.$username.'','mark'=>2);
				echo json_encode($arr);
			}
			else{
				//尚未存在同名用户
				$sql = "insert into ".$table."(username,password) values('".$username."','".$password1."')";
				mysql_query($sql);
				if( mysql_affected_rows() > 0 )
				{
					$arr = array('message'=>'注册新用户'.$username.'成功!',"mark"=>1);
					setcookie('name',$username,time()+3600*24);
					echo json_encode($arr);
				}
				else{
					$arr = array('message'=>'新用户写入数据库失败..');
					echo json_encode($arr);
				}

				
			}

		}
		else{
			//两次密码不相等。
			//echo "<script>alert('请确认两次密码输入相同');</script>";
			$arr = array('message'=>'两次输入密码不相同,请重新确认','mark'=>3);
			echo json_encode($arr);
		}
	}

	//用户登录操作
	
	//$_POST['log_user'] = 'jianhua' ;
	//$_POST['log_pass'] = md5('sognatore') ;
	//$_POST['auto'] = 1 ;
	//$_POST['remember'] = 0 ;
	if( isset($_POST['log_user']) && isset($_POST['log_pass']) )
	{
		$username = $_POST['log_user'] ;
		$password = $_POST['log_pass'] ;
		
		include_once("conn.php");

		$table = "users";

		$sql = "select count(id) as count from ".$table." where username = '".$username."' and password = '".$password."' limit 1";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$count = $row['count'] ;

		if( $count == 1 )
		{
			$arr = array('message'=>'登录成功,'.$username.'欢迎你回来!','mark'=>1);
			//登录成功，设置cookie

			if( $_POST['auto'] == 1 ) //自动登录勾上，则默认记住密码!
			{
				$_POST['remember'] = 1 ;
				
				setcookie("name",$username,time()+3600*24*7);
				setcookie("password",$password,time()+3600*24*7);
				setcookie("auto",1,time()+3600*24*7);
				setcookie("login",1,time()+3600*24*7);
				setcookie("remember",1,time()+3600*24*7);
			}
			else{  //没有自动登录
				if( $_POST['remember'] == 1 ) //记住密码
				{
					setcookie("name",$username,time()+3600*24*7);
					setcookie("password",$password,time()+3600*24*7);
					setcookie("remember",1,time()+3600*24*7);
					setcookie("login",1);
					setcookie("auto");
				}
				else{  //没有记住密码,不加过期时间，则为浏览器打开期间生效
					setcookie("name",$username);
					setcookie("password",$password);
					setcookie("login",1);
					setcookie("auto");
					setcookie('remember'); //再次登录顶掉之前的 记住密码状态
				}
			}


		}
		else{
			$arr = array('message'=>"登录失败,请确认用户名和密码",'mark'=>2);
		}

		echo json_encode($arr);

	}
	
	//md5(yanzhengma.md5(password).time).time

	//登录页 接受cookie请求

	if( isset($_POST['cookie']) )
	{
		if( $_POST['cookie'] == 1 ) //证明提交成功
		{
			//$cookie = isset( $_COOKIE['auto'] )?$_COOKIE['auto']:'' ;		//此 $_COOKIE['remember'] 的值根据 用户登录操作 设置的cookie决定
			//$arr = array("cookie"=>$cookie);

			$cookie_name = isset( $_COOKIE['name'] ) ? $_COOKIE['name']: '';
			$arr = array('cookie_name'=>$cookie_name);
		}

		echo json_encode($arr);
	}

	//注销登录用户
	//$_POST['logout'] = true;
	if( isset($_POST['logout']) )
	{
		$return_name = $_COOKIE['name'] ;
		$return_password = $_COOKIE['password'] ;
		$return_remember = isset( $_COOKIE['remember'] ) ? $_COOKIE['remember'] : '' ;

		setcookie("login");
		if( $_COOKIE['remember'] != 1 )
		{
		setcookie('name'); //删除 $_COOKIE['name']; 设置cookie无法立即生效，必须刷新后才能生效
		setcookie('password');
		}
		if( isset($_COOKIE['auto']) ) setcookie("auto");
		//if( isset($_COOKIE['remember']) ) setcookie("remember");

		$arr = array('cookie'=>0,'return_name'=>$return_name,'return_password'=>$return_password,'return_remember'=>$return_remember);
		echo json_encode($arr);
	}
	
	//找回用户密码，接收邮箱，用户名
	//$_POST['lost_email'] = 'sognatore@qq.com';
	//$_POST['lost_name'] = 'jianhua' ;

	if( isset( $_POST['lost_email'] ) && isset( $_POST['lost_name'] ) ) 
	{
		$username = $_POST['lost_name'] ;
		$email = $_POST['lost_email'] ;

		include_once("conn.php");
		$table = 'users';
		$sql = "select count(id) as count from ".$table." where username='".$username."' && email = '".$email."' ";
		$result = mysql_query($sql);
		$row_count = mysql_fetch_array($result);
		$count = $row_count['count'] ;

		if( $count == 1 ) //存在
		{
			include_once("test_smtp.php");
			$title = "MG游戏盒子GameBox-找回密码通知邮件";
			
			$chars = "0123456789abcdefghijklmnoprstuvwxyz";
			$len = strlen( $chars ) - 1 ;
			$str = '';
			for( $i = 0;$i<$len;$i++)
			{
				$str .= $chars[rand(0,$len)];
			}
			
			//$chk_username = "chk_".$username;
			
			//session_start();
			//$_SESSION[$chk_username] = $str ; //传递验证码 用于reset.php 接收

			//setcookie('change_name',$username);
			
			$content = "这是来自MG游戏盒子的用户密码找回信<br/>请点击此链接更新你的密码:<a href='http://localhost/gamebox/box_model/reset.php?str=".$str."'>点我</a>";
			$from = "sixdus@163.com";
			$to = $email ;
			$result = send_mail($title,$content,$from,$to,$charset='utf-8',$attachment='');

			if( $result == true )
			{
				$arr = array('message'=>'发送找回邮件成功!');
				
				//发邮件成功，把验证码保存到数据库
				$sql_save = "update users set security_code = '".$str."' where username = '".$username."'";
				mysql_query($sql_save);
				if( mysql_affected_rows() > 0 )
				{
					echo json_encode($arr);					
				}
				else{
					$arr = array('message'=>'服务器端验证码保存失败');
					echo json_encode($arr);
				}
				


			}
			else{
				$arr = array('message'=>'内部错误,发送找回邮件失败');
				echo json_encode($arr);
			}
		}
		else{
			$arr = array('message'=>'找不到用户或者邮箱...');
			echo json_encode($arr);
		}
	}

	//通过验证邮件，前往更新帐号密码
	//$_POST['ch_password'] = '111111';
	//$_POST['ch_username'] = 'jianhua';
	//$_POST['ch_password2'] = '111111';
	

	if( isset($_POST['ch_password']) && isset($_POST['ch_password2']) && $_POST['ch_username'] )
	{
		$username = $_POST['ch_username'] ;
		$password = $_POST['ch_password'] ;
		$password2 = $_POST['ch_password2'] ;

		if( $password == $password2 )
		{
			include_once("conn.php");
			$chk_username = "chk_".$username ;
			$table = "users";
			
			$sql = "select count(id) as count from ".$table." where username = '".$username."' and password = '".$password."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$count = $row['count'];

			if( $count != 1 )
			{
				$sql = "update ".$table." set password = '".$password."' where username ='".$username."'";
				mysql_query($sql);
				if( mysql_affected_rows() > 0 )
				{
					$arr = array('message'=>'更新密码成功');
					
					//更新成功之后，删除mysql保存的security_code
					$sql2 = "update users set security_code = '' where username = '".$username."'";
					mysql_query($sql2);

				}
				else{
					//echo "";
				}
			}
			else{ // $count == 1 ; 说明连续点了更新密码，或者新密码与原来一致
				$arr = array('message'=>'新密码须与原来密码不同');
			}
		}
		else{
			$arr = array('message'=>'前后密码不一致,更新失败');
		}

		echo json_encode($arr);
	}

?>




