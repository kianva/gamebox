<?php
	//ob_start();

	set_time_limit(0);
	include_once("conn.php");
	$table = "page_game";
	$sql = "select * from page_game"; //筛选出不重复名字的游戏
	$result = mysql_query($sql);

	while( $row = mysql_fetch_array($result) )
	{
		ob_start();
	
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $row['name']; ?></title>
<meta name="keywords" content="<?php echo $row['name']; ?>">
<meta name="description" content="<?php echo $row['name']; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/gamebox/box_model/style/yueact.css" rel="stylesheet" type="text/css">
<script src="/gamebox/box_model/js/jquery.js" type="text/javascript"></script>
<script src="/gamebox/box_model/js/lunhuan.js" type="text/javascript"></script>
</head>
<body>
<div class="wyyxread">
	<div class="left">
		<div class="yxbox">
			<div class="ganmeimg">
				<img src="<?php echo $row['small_pic'];?>">
				<?php echo $row['name']; ?>
			</div><!--ganmeimg end-->
			<ul class="ganmejs">
				<li><span>类型：</span><?php echo $row['leixing']; ?></li>
				<li><span>题材：</span><?php echo $row['ticai']; ?></li>
				<li><span>画面：</span><?php echo $row['huamian']; ?></li>
				<li class="ysjj"><span>游戏简介：</span><?php echo $row['description']; ?></li>
			</ul><!--ganmejs end-->
		</div><!--yxbox end-->
		<dl class="yxrk">
			<dt><h2>游戏平台入口</h2><a href=""><img src="/gamebox/box_model/images/rjrk.jpg"></a></dt>
			<dd>
				<?php
					mysql_select_db("gamebox");
					$sql2 = "select url,pic,name,developer from page_game where name = '".$row['name']."'";
					$result2 = mysql_query($sql2);
					while( $row2 = mysql_fetch_array($result2) )
					{
				?>	
						<span><a target="_blank"  href="<?php echo $row2['url'];?>" onclick="window.navigate('app:history$<?php echo $row2["url"]; ?>$<?php echo $row["pic"]; ?>$<?php echo $row["name"]; ?>')"><?php echo $row2['developer']; ?></a></span>
				<?php
					}
				?>
			</dd>
		</dl><!--yxrk end-->
	</div><!--left end-->
	<div class="rigbox">
		<dl class="zjyy">
			<dt><h2>本周最佳页游</h2></dt>
			<dd>
				<ul>
					<?php
						mysql_connect("localhost",'root','root');
						mysql_select_db("gamebox");
						$sql3 = "select name,id,wide_pic from page_game order by rand() limit 4";
						$result3 = mysql_query($sql3);
						while( $row3 = mysql_fetch_array($result3) )
						{
					?>
							<li>
								<a target="_blank" href="/gamebox/html/page_all_html/<?php echo $row3['id']; ?>.html" class="img"><img src="<?php echo $row3['wide_pic']; ?>"><em></em></a>
								<a target="_blank" href="/gamebox/html/page_all_html/<?php echo $row3['id']; ?>.html" class="title"><?php echo $row3['name']; ?></a>
							</li>
					<?php
						}

					?>
				</ul>
			</dd>
		</dl><!--zjyy end-->
		
		<dl class="zx">
			<dt><h2>新闻资讯</h2></dt>
			<dd>
				<ul>
					<?php
						$conn2 = mysql_connect("192.168.1.101:3306",'root','123456');
						if( $conn2 )
						{
							$db2 = "wanjizhijia";
							mysql_select_db($db2);
							$table2 = "dg_ecms_article";
							$sql_news = "select title,titleurl from ".$table2." where classid=33 limit 4";
							$result_news = mysql_query($sql_news);
							while( $row_news = mysql_fetch_array($result_news) )
							{
					?>
								<li><a target="_blank" href="<?php echo $row_news['titleurl']; ?>"><?php echo $row_news['title']; ?></a></li>
					<?php
							}
						}
						else{
					?>
								<li><a href="javascript:void();">连接数据库失败,请检查！</a></li>
					<?php
						}
					?>
				</ul>
			</dd>
		</dl><!--zx end-->	
	</div><!--rigbox end-->	
</div><!--main end-->	
</body>
</html>
<?php
	
			$contents = ob_get_contents();
			ob_clean();
			$dir = "d:/wamp/www/gamebox/html/page_all_html/";
			if( !file_exists($dir) )
			{
				mkdir($dir,0777,true);
			}
			$file = $dir.$row['id'].".html";
			if( file_put_contents($file,$contents) )
		{
				echo "make ".$file." succeed!<br/>";
		}
		else{
				echo "failed...".file."<br/>";
		}

	} //第一个while 的括号
		mysql_close();

	
?>