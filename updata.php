<?php 
$id=$_GET['id'];
$time=$_GET['time'];
$pdo= new PDO("mysql:host=localhost;dbname=think",'root','root');
$now=time();
if (($now-$time)>120) {
	echo "激活过期";
}else{
	$id=urldecode(base64_decode($id));
	echo "$id";
	$sql="update user1 set status=1 where id=$id";
	$res=$pdo->exec($sql);
	if ($res) {
		echo "激活成功";
	}else{
		echo "激活失败";
	}

}



 ?>