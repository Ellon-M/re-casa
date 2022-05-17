<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$yourName = $_POST['name'];

$yourMail = $_POST['customer_mail'];

$yourSubject = $_POST['subject'];

$website = $_POST['website'];

$yourMessage = $_POST['comments'];

$to      = 'html.pixelgeeklab@gmail.com';
$subject = 'Contact from Form Submit';
// To send HTML mail, the Content-type header must be set
$headers = 'From: '.$yourMail . "\r\n" .
			'Reply-To:' .$yourMail. "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			
$message 	= 'Here is content from submit form'."\r\n";
$message   .= 'Your Name: '.$yourName."\r\n";
$message   .= 'Your Mail: '.$yourMail."\r\n";
$message   .= 'Subject: '.$yourSubject."\r\n";
if ($website !=''){
	$message   .= 'Website: '.$website."\r\n";
}
$message   .= 'Your message: '.$yourMessage."\r\n";
			  
try {
		mail($to, $subject, $message, $headers);
		header('Location: thank-you.html');
		exit;
	}catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
	
?>