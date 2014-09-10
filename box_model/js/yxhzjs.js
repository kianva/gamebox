$(document).ready(function(){
	var hei=$(".czzn dd").css("height");
	$(window).scroll(function(){
		$(".czzn dt a").html("+");
		$(".czzn dd").animate({height:"0px"},500);
	})
	$(".czzn dt a").click(function(){
		$(".czzn dd").animate({height:hei},500);
	})
})
