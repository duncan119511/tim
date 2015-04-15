
<?php session_start(); error_reporting(0); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="form" method="post" action="search.php">

<?php
include("mysql_connect.inc.php");
$id = $_SESSION['id'];
echo $id;
echo ，你好;
echo '<br>';
echo '<a href="logout.php">登出</a>  <br><br>';
echo '<a href="user.php">修改資料</a>  <br><br>';
echo '<a href="test.php">進入考試</a>  <br>';
echo '<a href="test_7000.php">7000考試</a>  <br>';
echo '<a href="test_600.php">托福考試</a>  <br><br>';

?>
<br>請輸入欲查詢之單字
<br>
<input type="text" name="word" /> <br>
<input type="submit" name="button" value="查詢" />
</form>
<?php
$word = $_POST['word'];
if($word!= null)
{
$sql="select * from pydict where english = '$word'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
$main="<table border=2>";
if($data=$result -> fetch_row()){
$main.="<tr>
<td>英文</td>
<td>解釋</td>
<tr>
<td>{$data['1']}</td>
<td>{$data['2']}</td>
</tr>";
$main.="</table>";

echo $main;
echo "本單字歷史查詢次數:";
$mid=$data['0'];
$eng=$data['1'];
$chi=$data['2'];
$sql="SELECT COUNT(*) AS C1 FROM `search_$id` WHERE `english`= '$word'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
$row=$result -> fetch_row();
echo $row[0];
$sql="INSERT INTO `tim`.`search_$id` (`master_id`,`english`, `chinese`, `time`) VALUES ( '".$mid."','".$eng."', '".$chi."',now() );";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
echo '<br>';
}
}
?>
<div style="text-align:right;">

<?php

echo 查詢歷史紀錄;
echo '<br>';

echo'	<form action="" name="sort1" method="get">
選擇排列方式:
 <Select name="ord" onchange="javascript:submit()">
 <Option Value=""></Option>
 <Option Value="eng">字首字母</Option>
 <Option Value="time">查詢時間</Option>
 <Option Value="count">查詢次數</Option>

 </Select>
 </form>';

if($_GET['ord']=="eng")
{

 $sql="SELECT `english` AS 英文,MAX(`time`) AS 最後查詢時間,COUNT(`english`) AS 總查詢次數 FROM `search_$id` GROUP BY `english` ORDER BY english ASC limit 0, 10";
 $res = $mysqli->query($sql);
 echo "<table border=1 align='right'><tr>";
 while($field=$res->fetch_field())
 {
   echo "<th>{$field->name}</th>";
 }
 echo "</tr>";
 while($row=$res->fetch_row()){
  echo "<tr>";
  foreach($row as $value){
   echo "<td>$value</td>";
  }
  echo "</tr>";
 }
 echo "</table>";

 $res->free();
}
else if($_GET['ord']=="count")
{

 $sql="SELECT `english` AS 英文,MAX(`time`) AS 最後查詢時間,COUNT(`english`) AS 總查詢次數 FROM `search_$id` GROUP BY `english` ORDER BY COUNT(`english`) DESC limit 0, 10";
 $res = $mysqli->query($sql);
 echo "<table border=1 align='right'><tr>";
 while($field=$res->fetch_field())
 {
   echo "<th>{$field->name}</th>";
 }
 echo "</tr>";
 while($row=$res->fetch_row()){
  echo "<tr>";
  foreach($row as $value){
   echo "<td>$value</td>";
  }
  echo "</tr>";
 }
 echo "</table>";

 $res->free();
}
else
{

 $sql="SELECT `english` AS 英文,MAX(`time`) AS 最後查詢時間,COUNT(`english`) AS 總查詢次數 FROM `search_$id` GROUP BY `english` ORDER BY MAX(`time`) DESC limit 0, 10";
 $res = $mysqli->query($sql);
 echo "<table border=1 align='right'><tr>";
 while($field=$res->fetch_field())
 {
   echo "<th>{$field->name}</th>";
 }
 echo "</tr>";
 while($row=$res->fetch_row()){
  echo "<tr>";
  foreach($row as $value){
   echo "<td>$value</td>";
  }
  echo "</tr>";
 }
 echo "</table>"; 

 $res->free();
}

?>
</div>