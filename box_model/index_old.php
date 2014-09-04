<?php
	include_once("conn.php");
	date_default_timezone_set("PRC");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>首页</title>
<meta name="keywords" content="首页">
<meta name="description" content="首页" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style/yueact.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/lunhuan.js" type="text/javascript"></script>
</head>
<body>
<div class="top">
	<a href="/gamebox/box_model/index.php" class="home">首页</a>
	<a href="/gamebox/box_model/xyx.php" class="xyx">小游戏</a>
	<a href="/gamebox/box_model/wyyx.php" class="wyyx">网页游戏</a>
	<form id="seaform" name="seaform" method="post" action="">
		<input name="title" type="text" id="title" class="text" value="" size="20" maxlength="30" />
	<input type="submit" name="Submit" value=" " class="button"/>
	</form>
	<script language="javascript">
	$(document).ready(function(){
		if($("#title").val()=='')
		{$("#title").val('请输入关键词!');}
		$("#title").focus(function(){
		if($("#title").val()=='请输入关键词!')
		{$("#title").val('')}
		})
		$("#title").blur(function(){
		if($("#title").val()=='')
		{$("#title").val('请输入关键词!')}
		})
		$("#seaform").submit(function(){
			if($("#title").val()=='' | $("#title").val()=='请输入关键词!')
			{
				alert('请输入关键词!');
				$("#title").focus();
				return false;
			}
		})
		
		//签到功能

		$(".mrqd").click(function(){
			
			var qdon = $(".mrqd").attr("class");
			if( qdon !== "mrqd qdon")
			{
				var name = "jianhua";
				$.post("check.php",{name:name,check:1},function(result){
					var days = result.days ;
					$(".mrqd .day").html(days+"<br/>Days");
					$(".mrqd").addClass("qdon");
				},'json');
			}
			else{
				//alert('你已经签到了!');
			}
		});
		
	})
	</script>
</div><!--top end-->
<div class="main">
	<div class="left">
		<div class="box">
			<div class="banner">
				<div id="focus">
					<ul>
						<li><a href="" target="_blank" title="banner"><img src="images/banner1.jpg" alt="banner" width="420" height="193" /></a></li>
						<li><a href="" target="_blank" title="banner"><img src="images/banner1.jpg" alt="banner" width="420" height="193" /></a></li>
						<li><a href="" target="_blank" title="banner"><img src="images/banner1.jpg" alt="banner" width="420" height="193" /></a></li>
					</ul>
				</div>
				<!--focus end-->	
			</div><!--banner end-->
			<div class="qdtype">
				<?php
					$week = array('日','一','二','三','四','五','六');
					$table = "users";
					$current_user = "jianhua";   //当前用户，以后用session 读取
					$sql = "select * from ".$table." where username='".$current_user."' limit 1";
					$result = mysql_query($sql);
					$row = mysql_fetch_array($result);
					$checked_days = $row['days'];
					$last_check = $row["last_check"];
					$today = date("Y-m-d");
				?>
				<a href="javascript:void();" <?php if( $today == $last_check ) { echo "class='mrqd qdon'"; } else{ echo "class='mrqd'"; } ?>><em class="xq"><?php echo "周".$week[date('w')]; ?><br><?php echo date("H:i"); ?></em><em class="day"><?php echo $checked_days; ?><br>Days</em></a>
				<ul class="type">
					<li class="ty1"><a href="">动作游戏</a></li>
					<li class="ty1"><a href="">休闲娱乐</a></li>
					<li class="ty2"><a href="">角色扮演</a></li>
					<li class="ty2"><a href="">模拟经营</a></li>
					<li class="ty3"><a href="">策略游戏</a></li>
					<li class="ty3"><a href="">格斗游戏</a></li>
					<li class="ty4"><a href="">棋牌游戏</a></li>
					<li class="ty4"><a href="">射击游戏</a></li>
					<li class="ty5"><a href="">魔幻游戏</a></li>
					<li class="ty5"><a href="">仙侠游戏</a></li>
				</ul>
			</div><!--qdtype end-->
		</div><!--box end-->
		<dl class="rmwyyx">
			<dt><h2>热门网页游戏</h2></dt>
			<dd>
				<ul>
					<?php
						$table = "page_game";
						$sql = "select id,name,pic,url from ".$table." limit 4";
						$result = mysql_query($sql);
						while( $row = mysql_fetch_array($result) )
						{
					?>
							<li>
								<a target="_blank" href="/gamebox/html/page_all_html/<?php echo $row['id'];?>.html" class="img"><img src="<?php echo $row['pic']; ?>"></a>
								<a target="_blank" href="/gamebox/html/page_all_html/<?php echo $row['id'];?>.html" class="title"><?php echo $row['name']; ?></a>
							</li>
					<?php
						}
					?>
					
				</ul>
			</dd>
		</dl><!--rmwyyx end-->	
		<dl class="rmxyx">
			<dt><h2>热门小游戏</h2></dt>
			<dd>
				<ul>
					<?php
						$table = "`4399`";
						$sql = "select name,pic,id from ".$table." where flash != '' and pic != '' limit 7";
						$result = mysql_query($sql);
						while( $row = mysql_fetch_array($result) )
						{
					?>
							<li>
								<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" class="img"><img src="<?php echo $row['pic']; ?>"><em></em></a>
								<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" class="title"><?php echo $row['name']; ?></a>
							</li>
					<?php
						}
						$conn = null;
						mysql_close();
					?>
				</ul>
			</dd>
		</dl><!--rmxyx end-->	
	</div><!--left end-->
</div><!--main end-->	
</body>
</html>