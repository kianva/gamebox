<?php
	if( isset($_POST['username']) && isset( $_POST['password'] ) )
	{
		$username = $_POST['username'] ;
		$password = md5($_POST['password']) ;

		include_once("conn.php");
		$table = "users";
		$sql = "select count(id) as count from ".$table." where username = '".$username."' and password = '".$password."'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$count = $row['count'] ;

		if( $count == 1 )
		{
			//登录成功
			session_start();
			$_SESSION['username'] = $username ;
			header("location:login_success.php");
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>用户登录-游戏盒子</title>
<meta name="keywords" content="用户登录-游戏盒子">
<meta name="description" content="用户登录-游戏盒子" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style/yueact.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js" type="text/javascript"></script>
</head>
<body>
<dl class="login">
	<dt><a href="#"><img src="images/bg.jpg" width="40" height="34" border="0"></a></dt>
	<dd>
	<form id="login" name="login" method="post" action="login2.php">
		<div class="error"></div>
	    <table width="300" height="170" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="42" colspan="2"><input placeholder="输入用户名" name="username" type="text" id="username" class="username"></td>
            <td width="59"><a tabindex='-1' href="reg.html">申请账号</a></td>
          </tr>
          <tr>
            <td height="42" colspan="2"><input placeholder="输入密码" name="password" type="password" id="password" class="password" value=""></td>
            <td><a tabindex='-1' href="forget_password.html">忘记密码</a></td>
          </tr>
          <tr>
            <td width="89" height="42">
			<label><input type="checkbox" id="remember" name="checkbox[]" checked value="remember"> 
			记住密码</label>
			</td>
            <td width="152">
			<label><input type="checkbox" id="auto" name="checkbox[]" value="auto"> 
			自动登录</label>
			</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="44" colspan="3" align="center"><input id='log' type="submit" class="submit" name="Submit" value=" 登 录 "></td>
          </tr>
        </table>
      </form>
	</dd>
</dl>
<!--login end-->
</body>
</html>