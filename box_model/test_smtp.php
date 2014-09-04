<?php
function send_mail ($title,$content,$from,$to,$charset='utf-8',$attachment ='') 
{ 
	include 'PHPMailer.class.php'; 
	header('Content-Type: text/html; charset='.$charset); 
	$mail = new PHPMailer(); 
	$mail->CharSet = $charset; //设置采用gb2312中文编码 
	$mail->IsSMTP(); //设置采用SMTP方式发送邮件 
	$mail->Host = "smtp.163.com"; //设置邮件服务器的地址 
	$mail->Port = 25; //设置邮件服务器的端口，默认为25 
	$mail->From = $from; //设置发件人的邮箱地址 
	$mail->FromName = "游戏盒子_MG-Gamebox"; //设置发件人的姓名 
	$mail->SMTPAuth = true; //设置SMTP是否需要密码验证，true表示需要 
	$mail->Username = $from; //设置发送邮件的邮箱 
	$mail->Password = "jhvohw"; //设置邮箱的密码 
	$mail->Subject = $title; //设置邮件的标题 
	$mail->AltBody = "text/html"; // optional, comment out and test 
	$mail->Body = $content; //设置邮件内容 
	$mail->IsHTML(true); //设置内容是否为html类型 
	$mail->WordWrap = 50; //设置每行的字符数 
	$mail->AddReplyTo("sixdus@163.com","sixdus"); //设置回复的收件人的地址 
	$mail->AddAddress($to,"星模实训"); //设置收件的地址 
	if ($attachment != '') //设置附件 
	{ 
	$mail->AddAttachment($attachment, $attachment); 
	} 
	if(!$mail->Send()) 
	{ 
		return false; 
	}
	else { 
		return true; 
	} 
} 
//$title = "test";
//$content = "this is content";
//$from = "sixdus@163.com";
//$to = "sognatore@qq.com";
//send_mail($title,$content,$from,$to,$charset='utf-8',$attachment='');
?>