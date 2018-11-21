<?php 
//$id=$_GET['id'];
$name=$_GET['name'];
$password=$_GET['password'];
$email=$_GET['email'];
echo "$email";
$pdo= new PDO("mysql:host=localhost;dbname=think",'root','root');
$sql="insert into user1 (name,password,email) value('$name','$password','$email')";
$pdo->exec($sql);
$id=$pdo->lastInsertId();
$id=base64_encode(urlencode($id));
$time=time();
$title='激活邮件';
$url="http://www.email.com/lianxi/updata.php?id=$id&time=$time";
$connect="您好,请点击链接激活:$url";


      $option = array (
	 	'host' => 'smtp.qq.com',
	 	'port'     => 465,
	 	'username' => '1993856784@qq.com',
	 	'password' => 'wpxexjyievjldibe',
	 	'from'=>'1993856784@qq.com',
	 	'fromname'=>'songjiayan',
	 	'reply'=>'1993856784@qq.com',
	 	'secure'=>'ssl'
	  );
	  include 'phpmailerExt.php';
	  $phpmailer= new phpmailerExt;
	  $phpmailer->setSmtpConfig($option);
	  if ($phpmailer->sendMail($email,$title,$connect)) {
	  	echo "邮件发送成功";
	  }else{
	  	echo "邮件发送失败".$phpmailer->ErrorInfo;

	  }


 ?>