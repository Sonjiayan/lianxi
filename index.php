<?php 
$redis= new Redis;
$redis->connect('127.0.0.1',6379);
$city=$_GET['city'];
if ($redis->exists($city)) {
	$str=$redis->get($city);

	echo $str;
}else{
	$key='c523faef57c94aceb4f33ff0ea1149a1';
	$url="https://free-api.heweather.com/s6/weather/forecast?location=$city&key=$key";
	$str=file_get_contents($url);

	$data=json_decode($str,true);
	// echo "<pre>";
	// var_dump($data);
	$data=$data['HeWeather6'][0]['daily_forecast'];
	//  echo "<pre>";
	// var_dump($data);
	$pdo= new PDO("mysql:host=127.0.0.1;dbname=thinkphp",'root','root');
	//var_dump($pdo);
	foreach ($data as $key => $value) {
		$date=$value['date'];

		$maxtemp=$value['tmp_max'];
		$mintemp=$value['tmp_min'];
		$sql="insert into weather(city,date,maxtemp,mintemp) values ('$city','$date','$maxtemp','$mintemp')";
		//echo "$sql";die;
		$res=$pdo->exec($sql);
		//var_dump($res);
	}
	$str=json_encode($data);
	$redis->set($city,$str);
	echo $str;
	
}

 ?>