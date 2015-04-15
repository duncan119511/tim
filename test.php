<?php session_start(); error_reporting(0);?>

<?php
include("mysql_connect.inc.php");
$id = $_SESSION['id'];
$cor = $_SESSION['cor'];
echo $id;
echo "，你好";
echo '<br>';
echo '<a href="logout.php">登出</a>  <br><br>';
echo '<a href="search.php">回到查詢</a>  <br><br>';

$Rand = Array();
for ($i = 1; $i <= 4; $i++) 
{
    $randval = mt_rand(1,177841); 
    if (in_array($randval, $Rand)) 
	{
        $i--;
    }
	else
	{
        $Rand[] = $randval;
    }
}
$a = $Rand[0];
$b = $Rand[1];
$c = $Rand[2];
$d = $Rand[3];

$sql="select * from pydict where master_id = '$a'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data= $result -> fetch_row())
{
$core = $data[1];
echo $core;
echo '<br>';
}
$_SESSION['cor'] = $a;

shuffle($Rand);
$a = $Rand[0];
$b = $Rand[1];
$c = $Rand[2];
$d = $Rand[3];
$sql="select * from pydict where master_id = '$a'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$ca = $data[2];
}

$sql="select * from pydict where master_id = '$b'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cb = $data[2];
}

$sql="select * from pydict where master_id = '$c'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cc = $data[2];
}

$sql="select * from pydict where master_id = '$d'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cd = $data[2];
}
?>

<br>
<br>
<form method="get"> 
<input type="button" value="<?php echo $ca; ?>" onClick="this.form.action='test.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $a; ?>" name="ans" >
</form>
<br>
<br>
<form method="get"> 
<input type="button" value="<?php echo $cb; ?>" onClick="this.form.action='test.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $b; ?>" name="ans" >
</form>
<br>
<br>
<form method="get"> 
<input type="button" value="<?php echo $cc; ?>" onClick="this.form.action='test.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $c; ?>" name="ans" >
</form>
<br>
<br>
<form method="get"> 
<input type="button" value="<?php echo $cd; ?>" onClick="this.form.action='test.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $d; ?>" name="ans" >
</form>
<?php
if($_GET[ans] != null)
{
if($_GET[ans] == $cor)
{
    echo '<br>';
	echo '<br>';
	echo "正確";
	echo '<br>';
	$sql="select * from pydict where master_id = '$cor'";
	$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	if($data=$result -> fetch_row())
	{
	$core = $data[1];
	}
	$sql = "insert into `test_$id` (master_id, english, correct, time ) values ( '".$cor."','".$core."', '1',now() )";
	$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	echo "此單字累計正確";
	$sql="SELECT COUNT(*) AS C1 FROM `test_$id` WHERE `master_id`=$cor AND `correct`= '1'";
	$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	$row=$result -> fetch_array();
	echo $row[0];
	echo "次，錯誤";
	$sql="SELECT COUNT(*) AS C2 FROM `test_$id` WHERE `master_id`=$cor AND `correct`= '0'";
	$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	$row=$result -> fetch_array();
	echo $row[0];
	echo "次。";
}
else if($_GET[ans] != $cor)
{
    echo '<br>';
	echo '<br>';
    echo "錯誤";
	echo '<br>';
	$sql="select * from pydict where master_id = '$cor'";
	$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	if($data=$result -> fetch_row())
	{
	$core = $data[1];
	}
	$sql = "insert into `test_$id` (master_id, english, correct, time ) values ( '".$cor."','".$core."', '0',now() )";
	$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	echo "此單字累計正確";
	$sql="SELECT COUNT(*) AS C1 FROM `test_$id` WHERE `master_id`=$cor AND `correct`= '1'";
	$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	$row=$result -> fetch_array();
	echo $row[0];
	echo "次，錯誤";
	$sql="SELECT COUNT(*) AS C2 FROM `test_$id` WHERE `master_id`=$cor AND `correct`= '0'";
	$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	$row=$result -> fetch_array();
	echo $row[0];
	echo "次。";
}
$sql="select * from pydict where master_id = '$cor'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
$main="<table border=2>";
if($data=$result -> fetch_row()){
$main.="<tr>
<td>英文</td>
<td>解釋</td>
<tr>
<td>{$data[1]}</td>
<td>{$data[2]}</td>
</tr>";
$main.="</table>";
echo $main;
}
}

?>