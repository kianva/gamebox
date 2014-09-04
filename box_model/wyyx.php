<?php
	include_once("conn.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>网页游戏大全</title>
<meta name="keywords" content="网页游戏大全">
<meta name="description" content="网页游戏大全" />
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
	<form id="seaform" name="seaform" method="get" action="search.php" target="_blank">
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
<div class="xyx_main">
	<div class="wyyx_left">
		<div class="wyyx_type">
			<ul>                        
				<li <?php if( !isset($_GET['type']) ) echo "class='on'"; ?>><a href="/gamebox/box_model/wyyx.php">全部游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 1 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=1">动作游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 2 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=2">休闲娱乐</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 3 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=3">角色扮演</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 4 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=4">模拟经营</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 5 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=5">策略游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 6 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=6">格斗游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 7 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=7">棋牌游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 8 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=8">射击游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 9 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=9">魔幻游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 10 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=10">棋牌游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 11 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx.php?type=11">仙侠游戏</a></li>
			</ul>
		</div><!--wyyx_type end-->
		<ul class="wyyx_box">
			<?php
				$table = "page_game";
				
				$page_size = 20;
				$page_num = isset( $_GET['page'] ) ? $_GET['page']:1 ;
				$offset = $page_size * ( $page_num - 1 );

				if( isset( $_GET['type'] ) )
				{
					$type = $_GET['type'] ;
					switch($type)
					{
						case 1:
							$type = "动作游戏";
							break;
						case 2:
							$type = "休闲娱乐";
							break;
						case 3:
							$type = "角色扮演";
							break;
						case 4:
							$type = "模拟经营";
							break;
						case 5:
							$type = "策略游戏";
							break;
						case 6:
							$type = "格斗游戏";
							break;
						case 7:
							$type = "棋牌游戏";
							break;
						case 8:
							$type = "射击游戏";
							break;
						case 9:
							$type = "魔幻游戏";
							break;
						case 10:
							$type = "棋牌游戏";
							break;
						case 11:
							$type = "仙侠游戏";
							break;
						default:
							break;
					}
					$sql = "select name,wide_pic,pic,id from ".$table." where leixing='".$type."' group by name limit ".$offset.",".$page_size;
					$sql_count = "select count(distinct name) as count from ".$table." where leixing = '".$type."'";
					$result_count = mysql_query( $sql_count );
					$row_count = mysql_fetch_array($result_count);
					$count = $row_count['count'];
					$count = ceil( $count / $page_size ) ;
				}
				else{
					$sql = "select name,wide_pic,id from ".$table." group by name limit ".$offset.",".$page_size."";
					$sql_count = "select count(distinct name) as count from ".$table."";
					$result_count = mysql_query( $sql_count );
					$row_count = mysql_fetch_array($result_count);
					$count = $row_count['count'];
					$count = ceil( $count / $page_size ) ;
				}

				$result = mysql_query($sql);
				while( $row = mysql_fetch_array($result) )
				{
			?>
					<li><a href="/gamebox/html/page_all_html/<?php echo $row['id']; ?>.html" class="img"><img src="<?php echo $row['wide_pic']; ?>"><em><?php echo $row['name']; ?></em></a></li>		
			<?php
				}
			?>
		</ul><!--wyyx_box end-->
		<ul class="pages">
		<?php  
			if( isset( $_GET['type'] ) )
			{
		?>
		<a href="/gamebox/box_model/wyyx.php?type=<?php echo $_GET['type']; ?>&page=1">首页</a>
		<?php if( $page_num != 1 ) { ?>
		<a href="/gamebox/box_model/wyyx.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $page_num-1; ?>">上一页</a>
		<?php } ?>
		<?php if( $page_num < $count ) { ?>
		<a href="/gamebox/box_model/wyyx.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $page_num+1; ?>">下一页</a>
		<?php } ?>
		<?php if( $count > 1 ) { ?>
		<a href="/gamebox/box_model/wyyx.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $count; ?>">尾页</a>
		<?php } ?>
		<?php 
			}
			else{
		?>
		<a href="/gamebox/box_model/wyyx.php?page=1">首页</a>
		<?php if( $page_num != 1 ) { ?>
		<a href="/gamebox/box_model/wyyx.php?page=<?php echo $page_num-1; ?>">上一页</a>
		<?php } ?>
		<?php if( $page_num < $count ) { ?>
		<a href="/gamebox/box_model/wyyx.php?page=<?php echo $page_num+1; ?>">下一页</a>
		<?php } ?>
		<?php if( $count > 1 ) { ?>
		<a href="/gamebox/box_model/wyyx.php?page=<?php echo $count; ?>">尾页</a>
		<?php } ?>
		<?php 
			}
		?>
		</ul>
		<?php
			mysql_close();
		?>
	</div><!--wyyx_left end-->	
</div><!--xyx_main end-->	
</body>
</html>