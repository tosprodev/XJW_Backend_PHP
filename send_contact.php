<?php
use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

	require_once 'phpmailer/Exception.php';
	require_once 'phpmailer/PHPMailer.php';
	require_once 'phpmailer/SMTP.php';
	//$take_error = "";
if ( ($_POST['name']!="") && ($_POST['email']!="")){
 
 
    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $comments = $_POST['message']; // required
	
 
 
    //-----------------------------------------
	
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
		$message = file_get_contents('send_mail/contact_email_temp.php'); 
		$message = str_replace('%name%', $name, $message); 
		$message = str_replace('%email%', $email, $message); 
		$message = str_replace('%comments%', $comments, $message);
		
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.hostinger.in';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'contact@tosprodev.com';                 // SMTP username
        $mail->Password = 'Umar.95078';                           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('contact@tosprodev.com', 'TOS Pro Dev | Contact Message');
		$mail->AddReplyTo($email, 'Reply to '.$name);
        $mail->addAddress('tosprodevorg@gmail.com');     // Add a recipient


        //Content
        $mail->isHTML(true);  
        $mail->Subject = 'New contact message recieeved';
        $mail->Body    = $message;
		

        $mail->send();
		
		$mail->ClearAllRecipients();
		
		$message2 = file_get_contents('send_mail/contact_email_user.php'); 
		$message2 = str_replace('%name%', $name, $message2); 
		
        $mail->Subject = 'Your contact message sended.';
		$mail->Body     = $message2;
		$mail->AddReplyTo('info@tosprodev.com', 'Reply to TOS Pro Dev');
		$mail->AddAddress($email);
		$mail->Send();
		echo 'Contact message is sent successfully';
        exit();
    } catch (Exception $e) {
        //$take_error = 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>