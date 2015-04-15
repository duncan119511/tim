<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
$id = $_SESSION['id'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
echo $id;
if($id != null && $pw != null && $pw2 != null && $pw == $pw2)
{
       	$sql = "update user SET  `password` = '".$pw."',`email` = '".$email."',`phone` = '".$phone."' where id = '$id' ";
        if(mysql_query($sql))
        {
                echo '更新成功!請重新登入!';
				unset($_SESSION['id']);
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '更新失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=user.php>';
        }
}

else if($pw == null )
{
        echo '請輸入密碼';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
}
else if($email == null )
{
        echo '請輸入電子信箱';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
}
else if($phone == null )
{
        echo '請輸入手機號碼';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
}
else if($id != null && $pw != null && $pw2 != null && $pw != $pw2)
{
        echo '兩次密碼不同，請重新輸入';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
}

else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>