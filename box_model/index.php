<?php
	include_once("conn.php");
	date_default_timezone_set("PRC");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>游戏盒子-首页</title>
<meta name="keywords" content="游戏盒子-首页">
<meta name="description" content="游戏盒子-首页" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/gamebox/box_model/style/yueact.css" rel="stylesheet" type="text/css">
<script src="/gamebox/box_model/js/jquery.js" type="text/javascript"></script>
<script src="/gamebox/box_model/js/lunhuan.js" type="text/javascript"></script>
<script language="javascript">
$(document).ready(function(){
		
		//页面加载自动提交请求，读取签到信息
		
		var day1 = new Date();
		var y = day1.getFullYear();
		var m = day1.getMonth();
		if( (m+1) < 10 )
		{
			m = m+1;
			m = '0'+m;
		}
		var d = day1.getUTCDate();
		if( d < 10 )
		{
			d = "0"+d ;
		}
		var current_date = y+"-"+m+"-"+d;

		//首先读取 当前登录用户

		$.post('check.php',{"who":1},function(result){
			result = JSON.parse(result);
			var current_name = result.name ;

			if( current_name != '') //有人登录的操作
			{
				//获得当前登录用户之后，请求当前用户的签到信息

				$.post('/gamebox/box_model/check.php',{"current_name":current_name},function(result2){
					var result2 = JSON.parse(result2);
					var load_days = result2.days ;  //已经签到天数
					var last_check = result2.last_check;// 最后签到日期
					if( last_check != current_date )
					{
						//什么也不做，因为本来显示的就是没签到的样式
					}
					else{
						//服务器证明已经签到了,页面显示签到后的版面
						$(".mrqd .day").html(load_days+"<br/>Days");
						$(".mrqd").addClass("qdon");
					}

				});
				
				//签到功能

				$(".mrqd").click(function(){
					
					var qdon = $(".mrqd").attr("class");
					if( qdon !== "mrqd qdon")
					{
						var name = current_name ;
						$.post("check.php",{"name":name,"check":1},function(result3){
							var days = result3.days ;
							$(".mrqd .day").html(days+"<br/>Days");
							$(".mrqd").addClass("qdon");
						},'json');
					}
					else{
						//alert('你已经签到了!');
					}
				});
			}
			else{
				$(".mrqd").click(function(){
					alert('请先登录');
				});
			}

		});
		
})
</script>
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
				<script>
					var day = new Date();
					var weekday = new Array(7);
					var hours = day.getHours();
					if( hours < 10 ) hours = "0"+hours;
					var mins = day.getMinutes();
					if( mins < 10 ) mins = "0"+mins;
					var time = hours+":"+mins;
					weekday[0] = '周天';
					weekday[1] = '周一';
					weekday[2] = '周二';
					weekday[3] = '周三';
					weekday[4] = '周四';
					weekday[5] = '周五';
					weekday[6] = '周六';
				</script>
				<a href="javascript:void();" class='mrqd'><em class="xq"><script>document.write(weekday[day.getDay()]);</script><br><script>document.write(time);</script></em><em class="day">0<br>Days</em></a>
				<ul class="type">
					<li class="ty1"><a href="javascript:void();">动作游戏</a></li>
					<li class="ty1"><a href="javascript:void();">休闲娱乐</a></li>
					<li class="ty2"><a href="javascript:void();">角色扮演</a></li>
					<li class="ty2"><a href="javascript:void();">模拟经营</a></li>
					<li class="ty3"><a href="javascript:void();">策略游戏</a></li>
					<li class="ty3"><a href="javascript:void();">格斗游戏</a></li>
					<li class="ty4"><a href="javascript:void();">棋牌游戏</a></li>
					<li class="ty4"><a href="javascript:void();">射击游戏</a></li>
					<li class="ty5"><a href="javascript:void();">魔幻游戏</a></li>
					<li class="ty5"><a href="javascript:void();">仙侠游戏</a></li>
				</ul>
			</div><!--qdtype end-->
		</div><!--box end-->
		<dl class="rmwyyx">
			<dt><h2>热门网页游戏</h2></dt>
			<dd>
				<ul>
					<?php
						$table = "page_game";
						$sql = "select id,name,wide_pic,id from ".$table." limit 4";
						$result = mysql_query($sql);
						while( $row = mysql_fetch_array($result) )
						{
					?>
							<li>
								<a target="_blank" href="/gamebox/html/page_all_html/<?php echo $row['id'];?>.html" class="img"><img src="<?php echo $row['wide_pic']; ?>"></a>
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
						$sql = "select name,id,leixing from ".$table." where flash != '' and pic != '' limit 7";
						$result = mysql_query($sql);
						while( $row = mysql_fetch_array($result) )
						{
					?>
							<li>
								<a target="_blank" href="/gamebox/html/little_game/<?php echo $row['id']; ?>.html" class="img"><img src="/gamebox/head_pic/<?php echo $row['leixing']."/".$row['id']; ?>.jpg"><em></em></a>
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
