<?php
	if( isset($_GET['title']) )
	{
		$keyword = $_GET['title'] ;
		include_once("conn.php");
		$table = "`4399`";
		$page_size = 36;
		$page = isset($_GET['page'])?$_GET['page']:1;
		$offset = $page_size * ($page-1);
		$sql = "select * from ".$table." where name like '%".$keyword."%' and flash != '' limit ".$offset.",".$page_size."";
		$result = mysql_query($sql);

		$sql_count = "select count(id) as count from ".$table." where name like '%".$keyword."%' and flash != ''";
		$result_count = mysql_query($sql_count);
		$row_count = mysql_fetch_array($result_count);
		$little_count = $row_count['count'] ; //搜索出来的小游戏总条数

		$table2 = "page_game";
		$sql2 = "select count(id) as count from ".$table2." where name like '%".$keyword."%'";
		$result_count2 = mysql_query($sql2);
		$row_count2 = mysql_fetch_array($result_count2);
		$page_count = $row_count2['count']; // 页游搜索条数
		
		$total_page = ceil( $little_count / $page_size );

	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>小游戏搜索--<?php if( isset($keyword) ) echo $keyword; ?></title>
<meta name="keywords" content="小游戏搜索--<?php if( isset($keyword) ) echo $keyword; ?>">
<meta name="description" content="小游戏搜索--<?php if( isset($keyword) ) echo $keyword; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style/yueact.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js" type="text/javascript"></script>
</head>
<body style="background:#FFFFFF;">
<div class="sealeft">
	<dl class="xxss">
		<dt><h2>搜索筛选</h2></dt>
		<dd>
			<ul>
				<li><a href="">全部 <?php if(isset($little_count) && isset($page_count)) echo $page_count+$little_count; ?> 款</a></li>
				<li><a href="search.php?title=<?php if( isset($keyword) ) echo $keyword; ?>">网页 <?php if( isset($page_count) ) echo $page_count; ?> 款</a></li>
				<li class="on"><a href="">小游戏 <?php if( isset($little_count) ) echo $little_count; ?> 款</a></li>
			</ul>
		</dd>
	</dl><!--xxss end-->
	<dl class="xgss">
		<dt><h2>相关搜索</h2></dt>
		<dd>
			<ul>
				<li><a href="searchx.php?title=三国魂">三国魂</a></li>
				<li><a href="searchx.php?title=风云无双">风云无双</a></li>
				<li><a href="searchx.php?title=侠盗猎车手">侠盗猎车手</a></li>
				<li><a href="searchx.php?title=三国">三国</a></li>
				<li><a href="searchx.php?title=龙武">龙武</a></li>
			</ul>
		</dd>
	</dl><!--xgss end-->
</div><!--sealeft end-->
<div class="searig">
	<div class="seaok">根据 “<span><?php if( isset($keyword) ) echo $keyword; ?></span>” 搜索到 <em><?php if(isset($little_count)) echo $little_count; ?></em> 款游戏</div>
	<ul class="xyxsea">
		<?php
			if( isset($keyword) ) 
			{
				while( $row = mysql_fetch_array($result) )
				{
		?>
					<li>
						<a href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" class="img" target="_blank"><img src="/gamebox/head_pic/<?php echo $row['leixing']."/".$row['id']; ?>.jpg"><em><?php echo $row['name']; ?></em></a>
					</li>
		<?php
				}
			}
		?>
		<!--
		<li>
			<a href="" class="img"><img src="pic/5.jpg"><em>游戏名称</em></a>
		</li>
		-->
	</ul>
	<div class="pages">
		<a href="/gamebox/box_model/searchx.php?title=<?php if(isset($keyword)) echo $keyword; ?>">首页</a>
		<?php if( isset($keyword) ){ if( $page != 1 ) { ?><a href="/gamebox/box_model/searchx.php?title=<?php echo $keyword; ?>&&page=<?php echo $page-1; ?>">上一页</a><?php } } ?>
		<?php if(isset($keyword)) { if($page<$total_page)  { ?><a href="/gamebox/box_model/searchx.php?title=<?php if(isset($keyword)) echo $keyword; ?>&&page=<?php if(isset($keyword)) echo $page+1; ?>">下一页</a><?php } }?>
		<?php if($total_page>1) { ?><a href="/gamebox/box_model/searchx.php?title=<?php if(isset($keyword)) echo $keyword; ?>&&page=<?php if( isset($keyword) ) echo $total_page; ?>">末页</a><?php } ?>
	</div>
</div><!--searig end-->
</body>
</html>