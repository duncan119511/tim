<?php session_start(); error_reporting(0);?>

<?php
	include("mysql_connect.inc.php");
	echo $_GET[able];
	$sql ="update user SET  `able` = 1 where id = '$_GET[able]' ";
	$result = $mysqli -> query($sql) ;
	echo 已認證成功，三秒後將轉入登入介面;
	echo '<br>';
	echo '<meta http-equiv=REFRESH CONTENT=3;url=index.php>';
?>