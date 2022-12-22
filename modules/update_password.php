<?php
			
 if(isTheseParametersAvailable(array('email', 'pssword'))){
 
 $psswordz = md5($_POST['pssword']); 
 $email = $_POST['email']; 
 
 //-----------------------------------------

$email = 'diginamicwebhost@gmail.com';
	
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        
		$message = file_get_contents('email_temp/password_changed.html'); 
		
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $email_host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $email_username;                 // SMTP username
        $mail->Password = $email_password;                           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $email_port;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($all_email_send_from, $app_name.' | Your password has been changed');
        $mail->addAddress($email);     // Add a recipient


        //Content
        $mail->isHTML(true);  
        $mail->Subject = 'Your password has been changed | '. $app_name;
        $mail->Body    = $message;
		

        $mail->send();
        $response['error'] = false; 
        $response['message'] = 'Your password has been changed successfully.'; 
		
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
    }
 
 $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
 
            $Sql_Query = "UPDATE users SET pssword = '$psswordz' WHERE id = $id";

             if(mysqli_query($conn,$Sql_Query))
            {
             $response['error'] = false; 
             $response['message'] = 'Your password has been successfully changed.';
             
             
    
            }
            else
            {
             $response['error'] = true; 
             $response['message'] = 'Something went wrong..';
             }
    
 }else{
 $response['error'] = true; 
 $response['message'] = 'You have entered an invalid email.';
 }
 }
			
?>