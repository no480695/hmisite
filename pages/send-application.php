<?
$info = $_POST;


$to      = 'no480695@gmail.com';
$subject = 'HMI Membership Application';

$headers = 'From: webmaster@hmisite.com' . "\r\n" .
    'Reply-To: webmaster@hmisite.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
$message = "";
foreach( $info as $item ){
	$message .= $item." \r\n";
	
}

mail($to, $subject, $message, $headers);
?>