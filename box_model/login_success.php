<?php 
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>登录成功-游戏盒子</title>
<meta name="keywords" content="用户登录-游戏盒子">
<meta name="description" content="用户登录-游戏盒子" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style/yueact.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js" type="text/javascript"></script>
</head>
<body>
<dl class="login">
	<dt><a href="#"><img src="images/bg.jpg" width="40" height="34" border="0"></a></dt>
	<dd style="height:150px; line-height:150px; text-align:center;">
		欢迎回到游戏盒子:<?php echo $_SESSION['username']; ?>
	</dd>
</dl>
<!--login end-->
</body>
</html>