<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$db_server = "localhost";
$db_name = "tim";
$db_user = "s10144101";
$db_passwd = "s10144101";

$mysqli = new mysqli($db_server, $db_user, $db_passwd, $db_name);
mysqli_query($mysqli,"SET CHARACTER SET UTF8");
mysqli_set_charset($mysqli,'utf8');
if (mysqli_connect_errno()) 
{
    printf("<p>抱歉，連線失敗", mysqli_connect_error());
    $this->mysqli = FALSE;
    exit();
}

?> 
