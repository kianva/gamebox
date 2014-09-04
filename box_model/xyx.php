<?php
	/*
	include_once("conn.php");
	
	set_time_limit(0);
	$dir = "d:/wamp/www/gamebox/html/fenye_little_game/";
	if( !file_exists($dir) )
	{
		mkdir($dir,0777,true);
	}

	for( $start =1 ;$start<=2312;$start++)
	{
		ob_start();
		$_GET['page'] = $start ;
	*/
?>
<!DOCTYPE HTML>
<html>
<head>
<title>小游戏_不带侧边栏</title>
<meta name="keywords" content="小游戏_不带侧边栏">
<meta name="description" content="小游戏_不带侧边栏" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/gamebox/box_model/style/yueact.css" rel="stylesheet" type="text/css">
<script src="/gamebox/box_model/js/jquery.js" type="text/javascript"></script>
<script src="/gamebox/box_model/js/lunhuan.js" type="text/javascript"></script>
</head>
<body>
<div class="top">
	<a href="/gamebox/box_model/index.php" class="home"><em>首页</em></a>
	<!--<a href="/gamebox/box_model/xyx.php" class="xyx"><em>小游戏</em></a>-->
	<a href="/gamebox/html/fenye_little_game/xyx_page1.html" class="xyx"><em>小游戏</em></a>
	<a href="/gamebox/box_model/wyyx.php" class="wyyx"><em>网页游戏</em></a>
	<form id="seaform" name="seaform" method="get" action="/gamebox/box_model/search.php" target="_blank">
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
	})
	</script>
</div><!--top end-->
<?php
$conn = mysql_connect('localhost','root','root');
	mysql_select_db('gamebox');
	$table = '`4399`';
?>
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
				</li>
			</ul>
		</div><!--type end-->
		<ul class="xyxlist">
			<?php
				//分页
				$page_size = "42"; //每页显示容量

				if( isset( $_GET['page'] ) )
				{
					$page = intval($_GET['page']); //当前页码
				}
				else{
					$page = 1 ;
				}

				$offset = $page_size*($page-1);

				$sql_count = "select count(id) as count from ".$table." where flash != '' and pic != ''";
				$result_count = mysql_query($sql_count);
				$row_count = mysql_fetch_array($result_count);
				$total_page = intval($row_count['count']/$page_size) ;

				$table = "`4399`";
				$sql = "select name,id,leixing from ".$table." where flash != '' and pic != '' limit ".$offset.",".$page_size."";
				$result = mysql_query($sql);
				while( $row = mysql_fetch_array($result) )
				{
			?>
					<li>
						<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" class="img"><img src="/gamebox/head_pic/<?php echo $row['leixing']."/".$row['id']; ?>.jpg"></a>
						<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" class="title"><?php echo $row['name']; ?></a>
					</li>
			<?php
				}
			?>
		</ul>
		<div class="pages">
			<!-- 以下是普通PHP页面的实现代码

			<a href="/gamebox/box_model/xyx2.php">首页</a>
			<?php if($page !== 1) { ?><a href="/gamebox/box_model/xyx2.php?page=<?php echo $page-1; ?>">上一页</a><?php } ?>
			<?php if($page >4)  { ?>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page-3; ?>"><?php echo $page-3; ?></a>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page-2; ?>"><?php echo $page-2; ?></a>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page-1; ?>"><?php echo $page-1; ?></a>
			<?php } ?>
				<a href="javascript:void();" class="on"><?php echo $page; ?></a></li>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page+1; ?>"><?php echo $page+1; ?></a>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page+2; ?>"><?php echo $page+2; ?></a>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page+3; ?>"><?php echo $page+3; ?></a>
			<?php
				if( $page == 1 )
				{
			?>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page+4; ?>"><?php echo $page+4; ?></a>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page+5; ?>"><?php echo $page+5; ?></a>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page+6; ?>"><?php echo $page+6; ?></a>
			<?php
				}
				mysql_close();
			?>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $page+1; ?>">下一页</a>
				<a href="/gamebox/box_model/xyx2.php?page=<?php echo $total_page; ?>">末页</a>
			-->
			<a href="/gamebox/html/fenye_little_game/xyx_page1.html">首页</a>
			<?php if($page !== 1) { ?><a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-1; ?>.html">上一页</a><?php } ?>
			<?php if($page == 2 ) { ?>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-1; ?>.html"><?php echo $page-1; ?></a>
			<?php } ?>
			<?php if( $page == 3 ) { ?>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-2; ?>.html"><?php echo $page-2; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-1; ?>.html"><?php echo $page-1; ?></a>
			<?php } ?>
			<?php if( $page == $total_page ) { ?>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-6; ?>.html"><?php echo $page-6; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-5; ?>.html"><?php echo $page-5; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-4; ?>.html"><?php echo $page-4; ?></a>
			<?php } ?>
			<?php if($page >3)  { ?>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-3; ?>.html"><?php echo $page-3; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-2; ?>.html"><?php echo $page-2; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page-1; ?>.html"><?php echo $page-1; ?></a>
			<?php } ?>
			<?php if( ( $page < $total_page-2 ) && ( $page != $total_page ) ) { ?>
				<a href="javascript:void();" class="on"><?php echo $page; ?></a></li>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page+1; ?>.html"><?php echo $page+1; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page+2; ?>.html"><?php echo $page+2; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page+3; ?>.html"><?php echo $page+3; ?></a>
			<?php } ?>
			<?php
				if( $page == 1 )
				{
			?>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page+4; ?>.html"><?php echo $page+4; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page+5; ?>.html"><?php echo $page+5; ?></a>
				<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page+6; ?>.html"><?php echo $page+6; ?></a>
			<?php
				}
				//mysql_close();
			?>
			<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $page+1; ?>.html">下一页</a>
			<a href="/gamebox/html/fenye_little_game/xyx_page<?php echo $total_page; ?>.html">末页</a>
		</div>
	</div><!--xyx_left end-->	
</div><!--xyx_main end-->	
</body>
</html>
<?php
	/*
	$contents = ob_get_contents();
	ob_end_clean();
	
	$file = $dir."xyx_page".$page.".html";
	if( file_put_contents($file,$contents) )
	{
		echo "make file ".$file." succeed!<br/>";
	}
	else{
		echo "failed...".$file."<br/>";
	}
	mysql_close();
	}
	*/
?>