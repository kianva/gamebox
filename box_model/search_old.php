<?php
	include_once("conn.php");
	if( isset($_GET['title']) )
	{
		$keyword = $_GET['title'];
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>搜索小游戏-<?php if( isset($_GET['title']) ) echo $_GET['title'] ; ?></title>
<meta name="keywords" content="小游戏_不带侧边栏">
<meta name="description" content="小游戏_不带侧边栏" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style/yueact.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/lunhuan.js" type="text/javascript"></script>
</head>
<body>
<div class="top">
	<a href="/gamebox/box_model/index.php" class="home"><em>首页</em></a>
	<a href="/gamebox/box_model/xyx.php" class="xyx"><em>小游戏</em></a>
	<a href="/gamebox/box_model/wyyx.php" class="wyyx"><em>网页游戏</em></a>
	<form id="seaform" name="seaform" method="get" action="search.php">
		<input name="title" type="text" id="title" class="text" value="<?php if( isset($_GET['title']) ) echo $_GET['title'] ; ?>" size="20" maxlength="30" />
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
	})
	</script>
</div><!--top end-->
<div class="xyx_main">
	<div class="xyx_left">
		<div class="type">
			<ul>
				<li>
					<span>专辑</span> 
					<?php 
						$table = "`4399`";
						$sql = "select name,id,leixing from ".$table." where leixing = '体育' and flash != '' limit 5";
						$result = mysql_query($sql);
						$mark = 0;
						while( $row = mysql_fetch_array($result) )
						{
							$mark++;
					?>
							<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" <?php if($mark ==5 ) echo 'class="red"'; ?> ><?php echo $row['name']; ?></a>
					<?php
						}
					?>
					<!-- <a href="">爸爸去哪儿</a> <a href="" class="red">游戏精选</a> <a href="">最新游戏</a> <a href="">双人小游戏</a> <a href="">儿歌</a> <a href="">经营</a> <a href="">无敌版</a> <a href="">学习</a> <a href="" class="red">迪士尼</a> -->
					<a target="_blank" href="" class="more">更多</a>
				</li>
				<li>
					<span>动作</span>
					<?php 
						$sql = "select name,id,leixing from ".$table." where flash != '' and leixing='动作' limit 4";
						$result = mysql_query($sql);
						$mark = 0;
						while( $row = mysql_fetch_array($result) )
						{
							$mark++;
					?>
							<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" <?php if($mark == 1) echo 'class="red"'; ?> ><?php echo $row['name']; ?></a>
					<?php
						}
					?>
					<!--
					<a href="">爸爸去哪儿</a> <a href="">游戏精选</a> <a href="" class="red">最新游戏</a> <a href="">双人小游戏</a> <a href="">儿歌</a> <a href="">经营</a> <a href="">无敌版</a> <a href="">学习</a> <a href="">迪士尼</a> 
					-->
					<a target="_blank" href="" class="more">更多</a>
				</li>
				<li>
					<span>益智</span>
						<?php 
						$sql = "select name,id,leixing from ".$table." where flash != '' and leixing='益智' limit 5";
						$result = mysql_query($sql);
						$mark = 0;
						while( $row = mysql_fetch_array($result) )
						{
							$mark++;
					?>
							<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" <?php if( $mark ==3) echo 'class="red"'; ?>><?php echo $row['name']; ?></a>
					<?php
						}
					?>
					<a target="_blank" href="" class="more">更多</a>
				</li>
				<li>
					<span>策略</span>
					<?php 
						$sql = "select name,id,leixing from ".$table." where flash != '' and  leixing='策略' limit 7";
						$result = mysql_query($sql);
						$mark = 0;
						while( $row = mysql_fetch_array($result) )
						{
							$mark++;
					?>
							<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" <?php if( $mark == 3) echo 'class="red"';?>><?php echo $row['name']; ?></a>
					<?php
						}
					?>
					<a target="_blank" href="" class="more">更多</a>
				</li>
				<li>
					<span>女生</span>
					<?php 
						$sql = "select name,id,leixing from ".$table." where flash != '' and leixing='装扮' limit 6";
						$result = mysql_query($sql);
						$mark = 0;
						while( $row = mysql_fetch_array($result) )
						{
							$mark++;
					?>
							<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" <?php if($mark == 2 ) echo 'class="red"';?>><?php echo $row['name']; ?></a>
					<?php
						}
					?>
					<a target="_blank" href="" class="more">更多</a>
				</li>
				<li>
					<span>合辑</span>
					<?php 
						$sql = "select name,id,leixing from ".$table." where flash != '' and leixing='搞笑' limit 6";
						$result = mysql_query($sql);
						$mark = 0;
						while( $row = mysql_fetch_array($result) )
						{
							$mark++;
					?>
							<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" <?php if($mark == 4) echo 'class="red"';?>><?php echo $row['name']; ?></a>
					<?php
						}
					?>
					<a target="_blank" href="" class="more">更多</a>
				</li>
			</ul>
		</div><!--type end-->
		<ul class="xyxlist">
			<?php
				if( isset( $_GET['title'] ) )
				{
					$keyword = $_GET['title'] ;
					$table = "`4399`";
					$page_size = 42;
					
					$page = intval( isset( $_GET['page'] )?$_GET['page']:1 );
					$offset = $page_size * ($page-1) ;

					$sql = "select name,id,leixing from ".$table." where name like '%".$keyword."%' and flash != '' limit ".$offset.",".$page_size."";
					$result = mysql_query($sql);
					$sql2 = "select count(id) as count from ".$table." where flash != '' and name like '%".$keyword."%'";
					$result2 = mysql_query($sql2);
					$row_result2 = mysql_fetch_array($result2);
					$total = $row_result2['count'] ;
					$total_page = intval($total/$page_size);

					while( $row = mysql_fetch_array($result) )
					{
			?>
						<li>
							<a href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" class="img"><img src="/gamebox/head_pic/<?php echo $row['leixing']."/".$row['id']; ?>.jpg"></a>
							<a href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" class="title"><?php echo $row['name']; ?></a>
						</li>
			<?php
					}
				}
				
			?>
		</ul>
		<div class="pages">
			<?php
				if( isset($keyword) )
				{
			?>
			<a href="/gamebox/box_model/search.php?title=<?php echo $keyword; ?>">首页</a>
			<?php if($page !== 1) { ?><a href="/gamebox/box_model/search.php?title=<?php echo $keyword; ?>&&page=<?php echo $page-1; ?>">上一页</a><?php } ?>
			<a href="javascript:void();" class="on"><?php echo $page; ?></a></li>
			<a href="/gamebox/box_model/search.php?title=<?php echo $keyword; ?>&&page=<?php echo $page+1; ?>">下一页</a>
			<a href="/gamebox/box_model/search.php?title=<?php echo $keyword; ?>&&page=<?php echo $total_page; ?>">末页</a>
			<?php
				}
			?>
		</div>

	</div><!--xyx_left end-->	
</div><!--xyx_main end-->	
</body>
</html>