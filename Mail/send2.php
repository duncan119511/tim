<?php session_start(); ?>

<?php


require_once "Mail.php";

$from = '<s10144101040709@gmail.com>';
$to = '<duncan119511@gmail.com>';
$subject = 'Hi!';
$body = "Hi,\n\nHow are you?";

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

if (PEAR::isError($mail)) 
{
    echo('<p>' . $mail->getMessage() . '</p>');
}
else
{
    echo('<p>' 成功 '</p>');
	echo '已發送認證信至帳號信箱!';
}   

?>