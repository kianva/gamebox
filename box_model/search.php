<?php
	include_once("conn.php");
	if( isset( $_GET['title'] ) )
	{
		$keyword = $_GET['title'] ;
		$table = "page_game";

		$page_size = 10;

		$page = isset($_GET['page'])?$_GET['page']:1;

		$offset = $page_size*( $page - 1 );

		$sql = "select name,id,leixing,description,pic from ".$table." where name like '%".$keyword."%' group by name limit ".$offset.",".$page_size."";
		$result = mysql_query($sql);
		$sql_count1 = "select count(distinct name) as count from ".$table." where name like '%".$keyword."%'";
		$result_count1 = mysql_query($sql_count1);

		$row_count = mysql_fetch_array($result_count1);
		$page_count = $row_count['count']; 
		$total_page = ceil($page_count/$page_size) ;

		$table2 = "`4399`"; 
		//$sql2 = "select name,id,leixing,jieshao from ".$table2." where name like '%".$keyword."%' and flash != '' limit ".$offset.",".$page_size."";
		//$result2 = mysql_query($sql2);
		$sql_count2 = "select count(id) as count from ".$table2." where name like '%".$keyword."%' and flash != ''";
		$result_count2 = mysql_query($sql_count2);
		$row_count2 = mysql_fetch_array($result_count2);
		$little_count = $row_count2['count'] ;

	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>游戏搜索结果<?php if( isset($keyword) ) echo $keyword;  ?></title>
<meta name="keywords" content="游戏搜索结果<?php if( isset($keyword) ) echo $keyword;  ?>">
<meta name="description" content="游戏搜索结果<?php if( isset($keyword) ) echo $keyword;  ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/gamebox/box_model/style/yueact.css" rel="stylesheet" type="text/css">
<script src="/gamebox/box_model/js/jquery.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$(".little_game").click(function(){
		$(".xxss dd ul li").removeClass('on');
		$(this).parent('li').addClass('on');

		//var keyword = "<?php if(isset($keyword)) echo $keyword; ?>";
		/*
		$.post('ajax_search.php',{keyword:keyword},function(result){
			$(".searig ul li").remove();
			$(".pages").remove();
			
			var data = eval("("+result+")")
			var li = '';

			for(var i = 0;i<data.length;i++)
			{
				var strs = new Array();
				strs = data[i].split("::");
				game_name = strs[0];
				game_id = strs[1];
				game_leixing = strs[2];

				li = "<li><a href=\"/gamebox/html/little_game/"+game_id+".html\" class=\"img\"><img src=\"/gamebox/head_pic/"+game_leixing+"/"+game_id+".jpg\"><\/a><p><a href=\"/gamebox/html/little_game/"+game_id+".html\" class=\"title\">"+game_name+"<\/a> <span>小游戏<\/span><br><\/p><\/li>";

				$(".searig ul").append(li);
			}
			var pages = '<div class="pages"><a href="search.php?title='+keyword+'&&lpage=1">首页</a><a href="">下一页</a><a href="">末页</a></div>';
			$(".searig ul").after(pages);
		});
		*/
		
	});
});
</script>
</head>
<body style="background:#FFFFFF;">
<div class="sealeft">
	<dl class="xxss">
		<dt><h2>搜索筛选</h2></dt>
		<dd>
			<ul>
				<li><a href="">全部 <?php if( isset($little_count) && isset($page_count) ) echo $little_count+$page_count; ?> 款</a></li>
				<li class="on"><a href="/gamebox/box_model/search.php?title=<?php if(isset($keyword)) echo $keyword; ?>">网页 <?php if( isset($little_count) ) echo $page_count; ?> 款</a></li>
				<li><a class="little_game" href="/gamebox/box_model/searchx.php?title=<?php if(isset($keyword) ) echo $keyword; ?>">小游戏 <?php if( isset($little_count) ) echo $little_count; ?> 款</a></li>
			</ul>
		</dd>
	</dl><!--xxss end-->
	<dl class="xgss">
		<dt><h2>相关搜索</h2></dt>
		<dd>
			<ul>
				<li><a href="/gamebox/box_model/search.php?title=三国魂">三国魂</a></li>
				<li><a href="/gamebox/box_model/search.php?title=风云无双">风云无双</a></li>
				<li><a href="/gamebox/box_model/search.php?title=侠盗猎车手">侠盗猎车手</a></li>
				<li><a href="/gamebox/box_model/search.php?title=三国">三国</a></li>
				<li><a href="/gamebox/box_model/search.php?title=龙武">龙武</a></li>
			</ul>
		</dd>
	</dl><!--xgss end-->
</div><!--sealeft end-->
<div class="searig">
	<div class="seaok">根据 “<span><?php if( isset($keyword) ) echo $keyword; ?></span>” 搜索到 <em><?php if( isset($page_count) ) echo $page_count; ?></em> 款游戏</div>
	<ul>
		<?php
			if( isset($result) )
			{
				while( $row = mysql_fetch_array($result) )
				{
		?>
					<li class="page_game">
						<a href="/gamebox/html/page_all_html/<?php echo $row['id'] ; ?>.html" class="img"><img src="<?php echo $row['pic'] ; ?>"></a>
						<p>
						<a href="/gamebox/html/page_all_html/<?php echo $row['id'] ; ?>.html" class="title"><?php echo $row['name'] ; ?></a> <span>页游</span><br>
			<?php echo $row['description'] ; ?>...
						</p>
					</li>
		<?php
				}
			}
			
		?>
		<!--
		<li>
			<a href="" class="img"><img src="pic/10.jpg"></a>
			<p>
			<a href="" class="title">乱舞江山</a> <span>页游</span><br>
快玩《乱舞江山》是年度首款走萌路线的三国题材角色扮演游戏。以穿越到兵荒马乱的年代为背景，以还原真实历史为使命，展开了一幅乱世争...
			</p>
		</li>
		-->
	</ul>
	<div class="pages">
		<a href="/gamebox/box_model/search.php?title=<?php if(isset($keyword)) echo $keyword; ?>">首页</a>
		<?php if( isset($keyword) ){ if( $page != 1 ) { ?><a href="/gamebox/box_model/search.php?title=<?php echo $keyword; ?>&&page=<?php echo $page-1; ?>">上一页</a><?php } } ?>
		<?php if(isset($keyword)) { if($page<$total_page)  { ?><a href="/gamebox/box_model/search.php?title=<?php if(isset($keyword)) echo $keyword; ?>&&page=<?php if(isset($keyword)) echo $page+1; ?>">下一页</a><?php } }?>
		<?php if( isset($keyword) ){ if($total_page>1) { ?><a href="/gamebox/box_model/search.php?title=<?php if(isset($keyword)) echo $keyword; ?>&&page=<?php if( isset($total_page) ) echo $total_page; ?>">末页</a><?php } } ?>
	</div>
</div><!--searig end-->
</body>
</html>