<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];

$sql = "SELECT * FROM user where id = '$id'";
$result = $mysqli -> query($sql);
$row = $result -> fetch_row();

if($row[4] == 0)
{
        echo '該帳號需要經過認證後方可登入!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
else if($id != null && $pw != null && $row[1] == $id && $row[2] == $pw && $row[4] == 1)
{

        $_SESSION['id'] = $id;
        echo '登入成功!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=search.php>';
}
else
{
        echo '登入失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}

?>