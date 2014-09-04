<?php
	if( isset( $_GET['str'] ) )
	{
		include_once("conn.php");
		$table = "users";
		$sql = "select username from ".$table." where security_code = '".$_GET['str']."'";
		$result = mysql_query( $sql );
		$row = mysql_fetch_array($result);
		$Name = $row['username'] ;
		mysql_close();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>用户密码重新设置-游戏盒子</title>
<meta name="keywords" content="新用户注册-游戏盒子">
<meta name="description" content="新用户注册-游戏盒子" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style/yueact.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/md5.js" type="text/javascript"></script>
<script language="javascript">
$(document).ready(function(){
	
	//点击更新

	$("#update").click(function(){
		/*
		if($("#username").val()=='')
		{
			$(".error").html('您还没有输入账号');
			$("#username").focus();
			return false;
		}
		if( $("#username").val().length < 6 )
		{
			$(".error").html("用户名长度不能小于6位");
			$("#username").focus();
			return false;
		}
		*/
		if($("#password").val()=='')
		{
			$(".error").html('您还没有输入密码');
			$("#password").focus();
			return false;
		}

		if( $("#password").val().length < 6 )
		{
			$(".error").html("密码长度不能小于6位");
			$("#password").focus();
			return false;
		}

		if($("#password2").val()=='')
		{
			$(".error").html('确认密码有误');
			$("#password2").focus();
			return false;
		}

		if( $("#password2").val().length < 6 )
		{
			$(".error").html("确认密码长度不能小于6位");
			$("#password2").focus();
			return false;
		}

		var username = "<?php if( isset($Name) ) echo $Name; ?>";
		var password = $("#password").val();
		var password2 = $("#password2").val();


		if( username != '' )
		{
			password = hex_md5(password);
			password2 = hex_md5(password2);
			$.post('check.php',{"ch_username":username,"ch_password":password,"ch_password2":password2},function(result){
				result = JSON.parse(result);
				var message = result.message ;
				$(".error").html(message);
			});
		}
		else{
			var message = "非法修改,请通过一封新邮件链接来此页面";
			$(".error").html(message);
		}
	})
})
</script>
</head>
<body>
<dl class="login">
	<dt><a href="#"><img src="images/bg.jpg" width="40" height="34" border="0"></a></dt>
	<dd style="height:334px;">
	<form id="login" name="login" method="post" action="chklogin.asp">
		<div class="error"></div>
	    <table width="300" height="170" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="70" height="42" align="right">账号：</td>
            <td width="230"><a href="#">
              <!--<input name="username" type="text" id="username" value="<?php if(isset($Name)) echo $Name; ?>" class="username" placeholder="输入用户名">-->
			  <?php if(isset($Name)) echo $Name; ?>
            </a></td>
          </tr>
          <tr>
            <td height="42" align="right">密码：</td>
            <td><a href="#">
              <input placeholder="请输入新密码" name="password" type="password" id="password" class="password">
            </a></td>
          </tr>
          <tr>
            <td height="42" align="right">确认密码：			</td>
            <td><input placeholder="请确认新密码" name="password2" type="password" id="password2" class="password" value=""></td>
          </tr>
          <tr>
            <td height="44" colspan="2" align="center"><table width="302" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="152"><input id="update" type="button" class="submit" name="Submit" value=" 更 新 "></td>
                <td width="150" align="right"><a href="login.html" class="fhdr">返回登录</a></td>
              </tr>
            </table></td>
          </tr>
      </table>
      </form>
	</dd>
</dl>
<!--login end-->
</body>
</html>
<?php
	}
?>