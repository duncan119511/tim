<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

$id = $_POST['id'];
$phone = $_POST['phone'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];

if($id != null && $pw != null && $pw2 != null && $pw == $pw2 && $_POST['imgCode']==$_SESSION['seccode'] && preg_match('/^([.0-9a-z]+)@([0-9a-z]+).([.0-9a-z]+)$/i',$id) == true)
{
		$sql = "CREATE TABLE `search_$id` (searchnumber int(7)AUTO_INCREMENT UNIQUE ,master_id int(7),english varchar(80),chinese varchar(250),time timestamp, PRIMARY KEY (searchnumber))DEFAULT CHARACTER set utf8 COLLATE utf8_unicode_ci";
		$result = $mysqli -> query($sql);
		$sql = "CREATE TABLE `test_$id` (testnumber int(7)AUTO_INCREMENT UNIQUE ,master_id int(7),english varchar(80),Correct tinyint(1),time timestamp, PRIMARY KEY (testnumber))DEFAULT CHARACTER set utf8 COLLATE utf8_unicode_ci";
		$result = $mysqli -> query($sql) ;
		$sql = "insert into user (id, password, phone, able ) values ('$id', '$pw', '$phone','0')";
        if($mysqli -> query($sql))
        {
                require_once "Mail.php";

				$from = '<s10144101040709@gmail.com>';
				$to = '<$id>';
				$subject = '認證!';
				$body = "Hi,\n\n 認證";

				$headers = array(
				'From' => $from,
				'To' => $to,
				'Subject' => $subject
				);

				$smtp = Mail::factory('smtp', array(
				'host' => 'ssl://smtp.gmail.com',
				'port' => '465',
				'auth' => true,
				'username' => 's10144101040709@gmail.com',
				'password' => 'poloissohandsome'
				));

				$mail = $smtp->send($to, $headers, $body);
				
				echo '已發送認證信至帳號信箱!';
                echo '<meta http-equiv=REFRESH CONTENT=3;url=index.php>';
				
        }
        else
        {
                echo '新增失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=3;url=index.php>';
        }
}
else if($id == null )
{
        echo '請輸入帳號';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=register.php>';
}
else if (preg_match('/^([.0-9a-z]+)@([0-9a-z]+).([.0-9a-z]+)$/i',$id) != true) 
{
        echo '請輸入正確電子信箱格式';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=register.php>';
}
else if($pw == null )
{
        echo '請輸入密碼';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=register.php>';
}
else if($email == null )
{
        echo '請輸入電子信箱';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=register.php>';
}
else if($phone == null )
{
        echo '請輸入手機號碼';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=register.php>';
}
else if($id != null && $pw != null && $pw2 != null && $pw != $pw2)
{
        echo '兩次密碼不同，請重新輸入';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=register.php>';
}
else if($_POST['imgCode']!=$_SESSION['seccode'])
{
        echo '驗證碼錯誤，請重新輸入';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=register.php>';
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=index.php>';
}
?>