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
<link href="/gamebox/box_model/style/yueact.css" rel="stylesheet" type="text/css">
<script src="/gamebox/box_model/js/jquery.js" type="text/javascript"></script>
<script src="/gamebox/box_model/js/lunhuan.js" type="text/javascript"></script>
</head>
<body>
<div class="top big">
	<a href="/gamebox/box_model/index.php" class="home"><em>首页</em></a>
	<a href="/gamebox/box_model/xyx.php" class="xyx"><em>小游戏</em></a>
	<a href="/gamebox/box_model/wyyx.php" class="wyyx"><em>网页游戏</em></a>
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
	})
	</script>
</div><!--top end-->
<div class="xyx_main" style="width:975px;">
	<div class="wyyx_left">
		<div class="wyyx_type">
			<ul>                        
				<li <?php if( !isset($_GET['type']) ) echo "class='on'"; ?>><a href="/gamebox/box_model/wyyx2.php">全部游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 1 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=1">动作游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 2 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=2">体育竞技</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 3 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=3">角色扮演</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 4 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=4">休闲娱乐</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 5 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=5">射击游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 6 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=6">敏捷游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 7 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=7">策略游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 8 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=8">冒险游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 9 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=9">益智游戏</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 10 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=10">棋牌天地</a></li>
				<li <?php if( isset($_GET['type']) ){ if( $_GET['type'] == 11 ) echo "class='on'"; }?>><a href="/gamebox/box_model/wyyx2.php?type=11">儿童教育</a></li>
			</ul>
		</div><!--wyyx_type end-->
		<ul class="wyyx_box">
			<?php
				if( isset( $_GET['type'] ) )
				{
					$type = $_GET['type'] ;
					switch($type)
					{
						case 1:
							$type = "动作游戏";
							break;
						case 2:
							$type = "体育竞技";
							break;
						case 3:
							$type = "角色扮演";
							break;
						case 4:
							$type = "休闲竞技";
							break;
						case 5:
							$type = "射击游戏";
							break;
						case 6:
							$type = "敏捷游戏";
							break;
						case 7:
							$type = "战争策略";
							break;
						case 8:
							$type = "冒险游戏";
							break;
						case 9:
							$type = "益智游戏";
							break;
						case 10:
							$type = "棋牌天地";
							break;
						case 11:
							$type = "儿童教育";
							break;
						default:
							break;
					}
				}
				else{
					$type = "";
				}
				//mysql_select_db("gamebox");
				$table = "page_game";
				
				$page_size = 28;
				$page_num = isset( $_GET['page'] ) ? $_GET['page'] : 1 ;
				$offset = $page_size * ( $page_num - 1 ) ;

				if( $type == "")
				{
					$sql = "select name,id,wide_pic from ".$table." group by name limit ".$offset.",".$page_size;
					$sql_count = "select count(distinct name) as count from ".$table."";
					$result_count = mysql_query( $sql_count );
					$row_count = mysql_fetch_array($result_count);
					$count = $row_count['count'];
					$count = ceil( $count / $page_size ) ;
				}
				else{
					$sql = "select name,url,wide_pic,id from ".$table." where leixing='".$type."' group by name limit ".$offset.",".$page_size;
					$sql_count = "select count(distinct name) as count from ".$table." where leixing = '".$type."'";
					$result_count = mysql_query( $sql_count );
					$row_count = mysql_fetch_array($result_count);
					$count = $row_count['count'];
					$count = ceil( $count / $page_size ) ;
				}
				$result = mysql_query($sql);
				while( $row = mysql_fetch_array($result) )
				{
			?>
					<li><a href="/gamebox/html/page_all_html/<?php echo $row['id']; ?>.html" class="img"><img src="<?php echo $row['wide_pic'];?>"><em><?php echo $row['name']; ?></em></a></li>
			<?php
				}
			?>
		</ul><!--wyyx_box end-->
		<ul class="pages">
		<?php  
			if( isset( $_GET['type'] ) )
			{
		?>
		<a href="/gamebox/box_model/wyyx2.php?type=<?php echo $_GET['type']; ?>&page=1">首页</a>
		<?php if( $page_num != 1 ) { ?>
		<a href="/gamebox/box_model/wyyx2.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $page_num-1; ?>">上一页</a>
		<?php } ?>
		<?php if( $page_num < $count ) { ?>
		<a href="/gamebox/box_model/wyyx2.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $page_num+1; ?>">下一页</a>
		<?php } ?>
		<?php if( $count > 1 ) { ?>
		<a href="/gamebox/box_model/wyyx2.php?type=<?php echo $_GET['type']; ?>&page=<?php echo $count; ?>">尾页</a>
		<?php } ?>
		<?php 
			}
			else{
		?>
		<a href="/gamebox/box_model/wyyx2.php?page=1">首页</a>
		<?php if( $page_num != 1 ) { ?>
		<a href="/gamebox/box_model/wyyx2.php?page=<?php echo $page_num-1; ?>">上一页</a>
		<?php } ?>
		<?php if( $page_num < $count ) { ?>
		<a href="/gamebox/box_model/wyyx2.php?page=<?php echo $page_num+1; ?>">下一页</a>
		<?php } ?>
		<?php if( $count > 1 ) { ?>
		<a href="/gamebox/box_model/wyyx2.php?page=<?php echo $count; ?>">尾页</a>
		<?php } ?>
		<?php 
			}
		?>
		</ul>
	</div><!--wyyx_left end-->
	<div class="wyyx_rig">
		<dl class="zjyy">
			<dt><h2>本周最佳页游</h2></dt>
			<dd>
				<ul>
					<?php
						$table = "page_game";
						$sql = "select id,name,wide_pic from ".$table." limit 4";
						$result = mysql_query($sql);
						while( $row = mysql_fetch_array($result) )
						{
					?>
							<li>
								<a href="/gamebox/html/page_all_html/<?php echo $row['id']; ?>.html" class="img"><img src="<?php echo $row['wide_pic']; ?>"></a>
								<a href="/gamebox/html/page_all_html/<?php echo $row['id']; ?>.html" class="title"><?php echo $row['name']; ?></a>
							</li>
					<?php
						}
					?>
				</ul>
			</dd>
		</dl><!--zjyy end-->
		<dl class="bzzjyy">
			<dt><h2>本周最佳页游</h2></dt>
			<dd>
				<ul>
					<?php
						mysql_select_db("gamebox");
						$table = "page_game";
						$sql = "select name,id,wide_pic from ".$table." limit 4";
						$result = mysql_query($sql);
						while( $row = mysql_fetch_array($result) )
						{
					?>
							<li><a href="/gamebox/html/page_all_html/<?php echo $row['id']; ?>.html" class="img"><img src="<?php echo $row['wide_pic']; ?>"><em></em><span><?php echo $row['name']; ?></span></a></li>
					<?php
						}
					?>
				</ul>
			</dd>
		</dl><!--zjyy end-->
	</div><!--wyyx_rig end-->	
</div><!--xyx_main end-->	
</body>
</html>