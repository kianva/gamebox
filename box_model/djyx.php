<?php
	include_once("conn.php");
	set_time_limit(0);
	ini_set('memory_limit', '256M'); 
	$dir = "d:/wamp/www/gamebox/html/little_game/";
	if( !file_exists($dir) )
	{
		mkdir($dir,0777,true);
	}
	$table = "`4399`";
	$sql = "select * from ".$table." where flash != '' and id='67757' ";
	$result = mysql_query($sql);
	
	while( $row = mysql_fetch_array($result) )
	{
		ob_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $row['name'] ; ?>--小游戏</title>
<meta name="keywords" content="<?php echo $row['name']; ?>--小游戏">
<meta name="description" content="<?php echo $row['name']; ?>--小游戏" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/gamebox/box_model/style/yueact.css" rel="stylesheet" type="text/css">
<script src="/gamebox/box_model/js/jquery.js" type="text/javascript"></script>
<script src="/gamebox/box_model/js/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#refresh").click(function(){
			var type = "动作";
			$.post("/gamebox/box_model/like.php",{type:type},function(result){
				//alert('hi');
				$(".cnxh dd ul li").remove();
				var obj = eval("("+result+")"); //have to ,have to transfer the date type,and it's weird that index.php which I didn't use it,but it still worked.
				//alert(obj);
				var length = obj.length;
				var dir = "/gamebox/html/little_game/";
				var game_id = "";
				var game_type = "";
				for(var i =0;i<length;i++)
				{
					var strs = new Array();
					//alert(obj[i]);
					strs = obj[i].split(",");
					game_id = strs[2];
					game_type = strs[3];
					 li = "<li><a href=\""+dir+""+strs[2]+".html\" class=\"img\"><img src=\"/gamebox/head_pic/"+game_type+"/"+game_id+".jpg\"></a><p><a href=\""+dir+""+strs[2]+".html\" class=\"title\">"+strs[0]+"</a><span class=\"xj\"><em></em></span>"+strs[3]+"游戏</p></li>";
					//   /little_game/html/id.html 是地址
					$(".cnxh dd ul").append(li);
						
				}
			});
		});
	})
</script>
<!--[if lte IE 6]>
<style type="text/css">
html {
    /*这个可以让IE6下滚动时无抖动*/
    background: url(about:black) no-repeat fixed
}
.tck {
    position: absolute;
}
 
/*下面三组规则用于IE6下top计算*/
.tck {
    top: expression(offsetParent.scrollTop + offsetParent.clientHeight-offsetHeight);
}
</style>
<![endif]-->


</head>
<body style="width:1012px; height:600px;">
<div class="djyx">
	<div class="xyxbox">
		<!--
		<img src="pic/4.jpg">
		-->
		<div id="flash">flash加载中..</div>
		<script type="text/javascript">
		var so = new SWFObject("<?php echo $row['flash']; ?>", "mymovie", "818", "600", "7", "#ffffff");
		so.addParam("quality", "high");
		so.addParam("wmode", "transparent");
		so.addParam("menu", "false");
		so.write("flash");
		</script>
	</div><!--xyxbox end-->

	<div class="rig">
		<dl class="cnxh">
			<dt><h2>猜你喜欢</h2> <a id="refresh" href="javascript:void();"><img src="/gamebox/box_model/images/gx.jpg"></a></dt>
			<dd>
				<ul>
					<?php
						$table = "`4399`";
						$sql = "select leixing,id,name,pic from ".$table." where flash != '' limit 13";
						$result2 = mysql_query($sql);
						$dir2 = "/gamebox/html/little_game/";
						$pic_dir = "/gamebox/head_pic/";
						while( $row2 = mysql_fetch_array($result2) )
						{
					?>
							<li>
								<a href="<?php echo $dir2.$row2['id']; ?>.html" class="img"><img src="<?php echo $pic_dir.$row2['leixing']."/".$row2['id']; ?>.jpg"></a>
								<p>
									<a href="<?php echo $dir2.$row2['id']; ?>.html" class="title"><?php echo $row2['name']; ?></a>
									<span class="xj"><em></em></span>
									<?php echo $row2['leixing']; ?>游戏
								</p>
							</li>
					<?php
						}
					?>
				</ul>
			</dd>
		</dl><!--rmxyx end-->	
		<dl class="czzn">
			<dt><h2>操作指南</h2></dt>
			  <dd>
				<span>游戏目标：</span><br>
				<?php 
					if( isset( $row['mubiao']) )
					echo $row['mubiao'] ;
				?>
				<!--根据提示完成可爱宝贝的要求，
				获得高分。-->
				<br>
				<span>如何开始：</span><br>
				<?php
					if( isset( $row['kaishi'] ) )
					echo $row['kaishi'] ;
				?>
				<!--游戏加载完毕点击Play - 接着
				点击Start开始游戏-->
				<br>
				<span>操作方法：</span><br>
				<?php
					if( isset( $row['jieshao'] ) )
					echo $row['jieshao'] ;
				?>
				<!--
				根据可爱宝贝的要求，点击/拖
				动<img src="/gamebox/box_model/images/sb.jpg" align="absmiddle">进行游戏。
				-->
			</dd>
		</dl><!--czzn end-->
	</div><!--rig end-->
</div><!--djyx end-->
</body>
</html>
<?php
		$contents = ob_get_contents();
		ob_clean();
		$id = $row['id'] ;
		$file = $dir.$id.".html";
		if(file_put_contents($file,$contents))
		{
			echo $id.":创建html成功<br/>";
		}
		else{
			echo $id."失败!!<br/>";
		}
		
	} //while的后半花括号
	mysql_close();
?>