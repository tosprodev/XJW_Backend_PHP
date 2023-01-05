<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once 'functions.php';
 require_once 'config.php';
 require_once 'phpmailer/Exception.php';
 require_once 'phpmailer/PHPMailer.php';
 require_once 'phpmailer/SMTP.php';
 require_once 'firebase_notify_js.php';
 
 $nowdt = $cur_date_time;
 $getuid = generateRandomString($length = 10);
 $getauth = generateRandomNumber($length = 6);
 
 $fcm_url = 'https://fcm.googleapis.com/fcm/send';
 $fcm_apiKey_user = "AAAAmAd7JLc:APA91bFJ2IA1P7PKMcVUey6yXQHG845LiLQwaxrZh9Ef274hELYqxky3oNNnvzgl-oyfdclgrov1PqAVEmkuD7vtcmi-AZPTOTIRuLf_KJ8UaWVu8l-lLa4jEDWgVzxVJaZnIgG_h0V1";
					 
 $fcm_apiKey_pract = "AAAAPSPdCAk:APA91bEBTtuYESxsrvRgppUvljFmay4t1MoTNFQdWoMkIWARV2acTHozjgMpAasDOCzmfi6R6NZyTVsqKV80MVowp_roSpxg9pJPxNX6rHlvm6X9sXbiqZPIp1SWLVBj8LvcWc6Cv9aa";
 
 $response = array();
 
 if(isset($_GET['apicall'])){
 
 switch($_GET['apicall']){
 
 case 'signup':
 if(isTheseParametersAvailable(array('first_name','last_name','gender','c_code','phone','email', 'pssword'))){
     
     $first_name = $_POST['first_name']; 
     $last_name = $_POST['last_name']; 
     $gender = $_POST['gender']; 
     $c_code = $_POST['c_code']; 
     $phone = $_POST['phone']; 
     $email = $_POST['email']; 
     $pssword = md5($_POST['pssword']);
     $ref_code = $_POST['ref_code']; 
     
     
 
 
 $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ? OR email = ?");
 $stmt->bind_param("ss", $phone, $email);
 $stmt->execute();
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 $response['error'] = true;
 $response['message'] = 'User already registered with this email or phone';
 $stmt->close();
 }else{
     
   
 
 $sql = "INSERT INTO users (first_name, last_name, gender, c_code, phone, email, uid, ref_code, pssword, doj, auth) VALUES ('$first_name', '$last_name', '$gender', '$c_code', '$phone', '$email', '$uid', '$ref_code', '$pssword', '$nowdt', '$getauth')";

if (mysqli_query($conn, $sql)) {
    
    //fetching the user back 
 $stmt = $conn->prepare("SELECT id, id, id, first_name, last_name, gender, c_code, phone, email, uid, ref_code, pssword, doj, auth FROM users WHERE email = ?"); 
 $stmt->bind_param("s",$email);
 $stmt->execute();
 $stmt->bind_result($userid, $id, $first_name, $last_name, $gender, $c_code, $phone, $email, $uid, $ref_code, $pssword, $doj, $auth);
 $stmt->fetch();
 
 $user = array(
 'id'=>$id, 
 'id'=>$id, 
 'first_name'=>$first_name, 
 'last_name'=>$last_name, 
 'gender'=>$gender, 
 'c_code'=>$c_code, 
 'phone'=>$phone, 
 'email'=>$email, 
 'uid'=>$uid, 
 'ref_code'=>$ref_code, 
 'pssword'=>$pssword, 
 'doj'=>$doj, 
 'auth'=>$auth
 );
 
 $stmt->close();
 
 //adding the user data in response 
 $response['error'] = false; 
 $response['message'] = 'User registered successfully'; 
 $response['user'] = $user;
} else {
  $response['error'] = true; 
 $response['message'] = 'Something went wrong. Please try again'; 
}
 
 
 }
 
 }else{
 $response['error'] = true; 
 $response['message'] = 'required parameters are not available'; 
 }
 
 break; 
 
 /*------------------------------------------------------------------------------------------- practitioner Signup ------------------------------------------------------------------------------*/
 
 case 'practitioner_signup':
 if(isTheseParametersAvailable(array('firstname','lastname','gender','ccode','mobile','email', 'password'))){
     
     $firstname = $_POST['firstname']; 
     $lastname = $_POST['lastname']; 
     $email = $_POST['email']; 
     $ccode = $_POST['ccode']; 
     $mobile = $_POST['mobile']; 
     $gender = $_POST['gender']; 
     $service_type = $_POST['service_type']; 
     $professional_exp = $_POST['professional_exp']; 
     $reference = $_POST['reference']; 
     $udp = $_POST['udp']; 
     $auth = $_POST['auth']; 
     $status = "0"; 
     $password = md5($_POST['password']);
     $doj = $nowdt;
     

 
 $stmt = $conn->prepare("SELECT id FROM practitioner WHERE mobile = ? OR email = ?");
 $stmt->bind_param("ss", $mobile, $email);
 $stmt->execute();
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 $response['error'] = true;
 $response['message'] = 'Practitioner registered with this email or mobile';
 $stmt->close();
 }else{
 
 $sql = "INSERT INTO practitioner (firstname, lastname, email, ccode, mobile, gender, service_type, professional_exp, reference, udp, auth, status, password, doj) VALUES ('$firstname', '$lastname', '$email', '$ccode', '$mobile', '$gender', '$service_type', '$professional_exp', '$reference', '$udp', '$auth', '$status', '$password', '$doj')";

if (mysqli_query($conn, $sql)) {
    
    //fetching the user back 
 $stmt = $conn->prepare("SELECT id, id, id, firstname, lastname, email, ccode, mobile, gender, service_type, professional_exp, reference, udp, auth, status, password, doj FROM practitioner WHERE email = ?"); 
 $stmt->bind_param("s",$email);
 $stmt->execute();
 $stmt->bind_result($userid, $id, $firstname, $lastname, $email, $ccode, $mobile, $gender, $service_type, $professional_exp, $reference, $udp, $auth, $status, $password, $doj);
 $stmt->fetch();
 
 $user = array(
 'id'=>$id, 
 'id'=>$id, 
 'firstname'=>$firstname, 
 'lastname'=>$lastname, 
 'email'=>$email, 
 'ccode'=>$ccode, 
 'mobile'=>$mobile, 
 'gender'=>$gender, 
 'service_type'=>$service_type, 
 'professional_exp'=>$professional_exp, 
 'reference'=>$reference, 
 'udp'=>$udp, 
 'auth'=>$auth, 
 'status'=>$status, 
 'password'=>$password, 
 'doj'=>$doj
 );
 
 $stmt->close();
 
 //adding the user data in response 
 $response['error'] = false; 
 $response['message'] = 'Practitioner registered successfully'; 
 $response['user'] = $user;
} else {
  $response['error'] = true; 
 $response['message'] = 'Something went wrong. Please try again'; 
}
 
 
 }
 
 }else{
 $response['error'] = true; 
 $response['message'] = 'required parameters are not available'; 
 }
 
 break; 
 

 /*------------------------------------------------------------------------------------------- Signing ------------------------------------------------------------------------------*/
 case 'signin': 
 
 if(isTheseParametersAvailable(array('email', 'pssword'))){
 
 $email = $_POST['email'];
 $password = md5($_POST['pssword']);
 
 $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE email = ? AND pssword = ?");
 $stmt->bind_param("ss",$email, $password);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
 
 $user = array(
 'id'=>$id, 
 'first_name'=>$first_name, 
 'last_name'=>$last_name,
 'gender'=>$gender,
 'email'=>$email,
 'c_code'=>$c_code,
 'phone'=>$phone,
 'uid'=>$uid,
 'ref_code'=>$ref_code,
 'user_dp'=>$user_dp,
 'pssword'=>$pssword,
 'doj'=>$doj,
 'auth'=>$getauth
 );
 
 $response['error'] = false; 
 $response['message'] = 'Login successfull'; 
 $response['user'] = $user; 
 }else{
 $response['error'] = false; 
 $response['message'] = 'Invalid username or password';
 }
 }
 break; 
 
 /*------------------------------------------------------------------------------------------- Practitioner Signing ------------------------------------------------------------------------------*/
 case 'practitioner_signin': 
 
 if(isTheseParametersAvailable(array('email', 'password'))){
 
 $email = $_POST['email'];
 $password = md5($_POST['password']); 
 
 $stmt = $conn->prepare("SELECT id, firstname, lastname, email, ccode, mobile, gender, service_type, professional_exp, reference, udp, auth, status, password, doj FROM practitioner WHERE email = ? AND password = ?");
 $stmt->bind_param("ss",$email, $password);
 

 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $firstname, $lastname, $email, $ccode, $mobile, $gender, $service_type, $professional_exp, $reference, $udp, $auth, $status, $password, $doj);
 $stmt->fetch();
 
 $user = array(
 'id'=>$id, 
 'firstname'=>$firstname, 
 'lastname'=>$lastname, 
 'email'=>$email, 
 'ccode'=>$ccode, 
 'mobile'=>$mobile, 
 'gender'=>$gender, 
 'service_type'=>$service_type, 
 'professional_exp'=>$professional_exp, 
 'reference'=>$reference, 
 'udp'=>$udp, 
 'auth'=>$auth, 
 'status'=>$status, 
 'password'=>$password, 
 'doj'=>$doj
 );
 
 $response['error'] = false; 
 $response['message'] = 'Login successfull'; 
 $response['user'] = $user; 
 }else{
 $response['error'] = false; 
 $response['message'] = 'Invalid username or password';
 }
 }
 break; 
 
 /*------------------------------------------------------------------------------------------- Refreshing User Data with UID ------------------------------------------------------------------------------*/
 case 'refreshingUID': 
 
 if(isTheseParametersAvailable(array('id'))){
 
 $id = $_POST['id'];
 
 $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE id = ?");
 $stmt->bind_param("s",$id);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
 
 $user = array(
 'id'=>$id, 
 'first_name'=>$first_name, 
 'last_name'=>$last_name,
 'gender'=>$gender,
 'email'=>$email,
 'c_code'=>$c_code,
 'phone'=>$phone,
 'uid'=>$uid,
 'ref_code'=>$ref_code,
 'user_dp'=>$user_dp,
 'pssword'=>$pssword,
 'doj'=>$doj,
 'auth'=>$auth
 );
 
 $response['error'] = false; 
 $response['message'] = 'Login successfull'; 
 $response['user'] = $user; 
 }else{
 $response['error'] = false; 
 $response['message'] = 'Invalid username or password';
 }
 }
 break; 
 
 /*-------------------------------------------------------------------- Forget Password Request ---------------------------------------------------------------*/
 
 case 'forget_password_request': 
 
 if(isTheseParametersAvailable(array('email'))){
 
 $email = $_POST['email']; 
 
 $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
 
    //-----------------------------------------
	
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
		$message = file_get_contents('email_temp/otp.html'); 
		$message = str_replace('%name%', $first_name." ".$last_name, $message); 
		$message = str_replace('%auth%', $auth, $message); 
		
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $email_host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $email_username;                 // SMTP username
        $mail->Password = $email_password;                           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $email_port;  

        //Recipients
        $mail->setFrom($all_email_send_from, $app_name.'  | Rest Pasword OTP');
		//$mail->AddReplyTo($email, 'Reply to XJS Mobile Massage');
        $mail->addAddress($email);     // Add a recipient


        //Content
        $mail->isHTML(true);  
        $mail->Subject = 'Password Reset Request | '.$app_name;
        $mail->Body    = $message;
		

        $mail->send();
        $response['error'] = false; 
        $response['message'] = 'OTP has been sent'; 
		
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
    }
    
 }else{
 $response['error'] = false; 
 $response['message'] = 'You have entered an invalid email.';
 }
 }
 break; 
 
 /*-------------------------------------------------------------------- Forget Password Request Practitioner ---------------------------------------------------------------*/
 
 case 'forget_password_request_practitioner': 
 
 if(isTheseParametersAvailable(array('email'))){
 
 $email = $_POST['email']; 
 
 $stmt = $conn->prepare("SELECT id, firstname, lastname, email, ccode, mobile, gender, service_type, professional_exp, reference, udp, auth, status, doj FROM practitioner WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $firstname, $lastname, $email, $ccode, $mobile, $gender, $service_type, $professional_exp, $reference, $udp, $auth, $status, $doj);
 $stmt->fetch();
 
 $mgetauth = generateRandomNumber($length = 6);
 $Sql_Query = "UPDATE practitioner SET auth = '$mgetauth' WHERE email = '$email'";

            if(mysqli_query($conn,$Sql_Query)){
             $myauth = $mgetauth;
			 //-----------------------------------------
	
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
		$message = file_get_contents('email_temp/otp.html'); 
		$message = str_replace('%name%', $firstname." ".$lastname, $message); 
		$message = str_replace('%auth%', $myauth, $message); 
		
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $email_host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $email_username;                 // SMTP username
        $mail->Password = $email_password;                           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $email_port;  

        //Recipients
        $mail->setFrom($all_email_send_from, $app_name.'  | Rest Pasword OTP');
		//$mail->AddReplyTo($email, 'Reply to XJS Mobile Massage');
        $mail->addAddress($email);     // Add a recipient


        //Content
        $mail->isHTML(true);  
        $mail->Subject = 'Password Reset Request | '.$app_name;
        $mail->Body    = $message;
		

        $mail->send();
        $response['error'] = false; 
        $response['message'] = 'OTP has been sent'; 
		
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
    }
            } else {
             $err = 'Something went wrong';
			 $response['error'] = true; 
			 $response['message'] = $err;
             }
 
    
    
 }else{
 $response['error'] = false; 
 $response['message'] = 'You have entered an invalid email.';
 }
 }
 break; 
 
 /*-------------------------------------------------------------------- Verify OTP Practitioner---------------------------------------------------------------*/
 
 case 'otp_verification_practitioner': 
 
 if(isTheseParametersAvailable(array('email', 'otp'))){
 
 $otp = $_POST['otp']; 
 $email = $_POST['email']; 
 
 $stmt = $conn->prepare("SELECT id, firstname, lastname, email, ccode, mobile, gender, service_type, professional_exp, reference, udp, auth, status, doj FROM practitioner WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $firstname, $lastname, $email, $ccode, $mobile, $gender, $service_type, $professional_exp, $reference, $udp, $auth, $status, $doj);
 $stmt->fetch();
 
    if($otp == $auth) {
        $response['error'] = false; 
        $response['message'] = 'OTP Verified Successfully';
    } else {
        $response['error'] = true; 
        $response['message'] = 'you have entered an invalid or expired OTP.';
    }
    
 }else{
 $response['error'] = false; 
 $response['message'] = 'You have entered an invalid email.';
 }
 }
 break;
 
 /*-------------------------------------------------------------------- Verify OTP Practitioner---------------------------------------------------------------*/
 
 case 'otp_verification': 
 
 if(isTheseParametersAvailable(array('email', 'otp'))){
 
 $otp = $_POST['otp']; 
 $email = $_POST['email']; 
 
 $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
 
    if($otp == $auth) {
        $response['error'] = false; 
        $response['message'] = 'OTP Verified Successfully';
    } else {
        $response['error'] = true; 
        $response['message'] = 'you have entered an invalid or expired OTP.';
    }
    
 }else{
 $response['error'] = false; 
 $response['message'] = 'You have entered an invalid email.';
 }
 }
 break;
 
 /*-----------------------------------------------     Change Password Practitioner---------------------------------------------------------------*/
 
 case 'change_password_practitioner': 
 
   if(isTheseParametersAvailable(array('email', 'password'))){
 
 $psswordz = md5($_POST['password']); 
 $authh = $_POST['auth'];
 $email = $_POST['email'];
 
 //-----------------------------------------

 
 $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
 
            $Sql_Query = "UPDATE practitioner SET password = '$psswordz', auth = '$authh' WHERE email = '$email'";

             if(mysqli_query($conn,$Sql_Query))
            {
             //$response['error'] = false; 
             
             
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
 
 /*-----------------------------------------------     Change Password ---------------------------------------------------------------*/
 
 case 'xchange_password': 
 
   if(isTheseParametersAvailable(array('email', 'pssword'))){
 
 $psswordz = md5($_POST['pssword']); 
 $password = $_POST['pssword'];
 $email = $_POST['email'];
 
 //-----------------------------------------

 
 $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
 
            $Sql_Query = "UPDATE users SET pssword = '$psswordz', auth = '$getauth' WHERE id = $id";

             if(mysqli_query($conn,$Sql_Query))
            {
             $response['error'] = false; 
             
             
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
 
 break;
 
 /*-------------------------------------------------------------------- Update Profile ---------------------------------------------------------------*/
 
 case 'update_profile': 
 
 if(isTheseParametersAvailable(array('id'))){
			
			$id = $_POST['id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];

            $Sql_Query = "UPDATE users SET first_name= '$first_name', last_name = '$last_name', phone = '$phone' WHERE id = $id";

            if(mysqli_query($conn,$Sql_Query)){
             echo 'Profile Updated Successfully';
            } else {
             echo 'Something went wrong';
             }
 }else{
 $response['error'] = true; 
 $response['message'] = 'Required param are not available.';
 }
 break;
 
 /*----------------------------------------------------------- Add new Address ----------------------------------------------------*/
 
 case 'add_new_address': 
 
				if (isset($_POST['uid'])) {
				  $location_type = $_POST['location_type'];
                  $address = $_POST['address'];
                  $suburb = $_POST['suburb'];
                  $postcode = $_POST['postcode'];
                  $country = $_POST['country'];
                  $parking = $_POST['parking'];
                  $stairs = $_POST['stairs'];
                  $pets = $_POST['pets'];
                  $notes = $_POST['notes'];
                  $uid = $_POST['uid'];
				  
                  $Sql_Query = "insert into addresses (location_type,address,suburb,postcode,country,parking,stairs,pets,notes,uid,addon) values ('$location_type','$address','$suburb','$postcode','$country','$parking','$stairs','$pets','$notes','$uid','$nowdt')";
                    if(mysqli_query($conn,$Sql_Query)){
                    echo 'Address added Successfully';
 
                    }
                    else{
 
                    echo 'Something went wrong. Please try again';
 
                    }
				} else {
					echo 'Invalid statement';
				}
 
 break;
 
  /*----------------------------------------------------------- Delete Address ----------------------------------------------------*/
 case 'delete_address';
			
			$ID = $_POST['id'];
		
			$Sql_Query = "DELETE FROM addresses WHERE id = '$ID'";

			if(mysqli_query($conn,$Sql_Query))
				{
					echo 'Address Deleted Successfully';
				} else {
					echo 'Something went wrong';
				}
 break;
 
 /*----------------------------------------------------------- List Addresses ----------------------------------------------------*/
 
 case 'address_list';
			
			$uid = trim($_POST['uid']);
	        $userList_query = $conn->query("SELECT id, location_type, address, suburb , postcode, country, parking, stairs, pets, notes, uid, addon FROM addresses WHERE uid = $uid ");
	        	//var_dump($userList_query);
        	if ($userList_query->num_rows > 0)
        	{
    		$apps = array();
    		while ($rows = mysqli_fetch_array($userList_query))
    		{
			$temp['id'] = $rows['id']; //this is request id
			$temp['location_type'] = $rows['location_type'];
			$temp['address'] = $rows['address'];
			$temp['suburb'] = $rows['suburb'];
			$temp['postcode'] = $rows['postcode'];
			$temp['country'] = $rows['country'];
			$temp['parking'] = $rows['parking'];
			$temp['stairs'] = $rows['stairs'];
			$temp['pets'] = $rows['pets'];
			$temp['notes'] = $rows['notes']; 
			$temp['uid'] = $rows['uid'];
			$temp['addon'] = $rows['addon'];
			array_push($apps, $temp);
    		}

    		echo json_encode(array('type' => TRUE,'apps' => $apps) , JSON_PRETTY_PRINT);
        	}
	
	        
			break;
			
			/*------------------------------------------------------------ Add Recipients -------------------------------------------------*/
 case 'add_recipient': 
 
 if(isTheseParametersAvailable(array('firstname','lastname','email','ccode','phone','relation', 'gender', 'uid'))){
 
	 $firstname = $_POST['firstname']; 
     $lastname = $_POST['lastname']; 
     $email = $_POST['email']; 
     $ccode = $_POST['ccode']; 
     $phone = $_POST['phone']; 
     $relation = $_POST['relation']; 
     $gender = $_POST['gender'];
     $nftt = $_POST['nftt']; 
	 $uid = $_POST['uid'];
 
 
 $stmt = $conn->prepare("SELECT id FROM recipient WHERE phone = ? OR email = ?");
 $stmt->bind_param("ss", $phone, $email);
 $stmt->execute();
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 $response['error'] = true;
 $response['message'] = 'Recipient already registered with this email or phone';
 $stmt->close();
 }else{
     
   
 
 $sql = "INSERT INTO recipient (firstname, lastname, email, ccode, phone, relation, gender, nftt, uid) VALUES ('$firstname', '$lastname', '$email', '$ccode', '$phone', '$relation', '$gender', '$nftt', '$uid')";

if (mysqli_query($conn, $sql)) {
    
    //fetching the user back 
 $stmt = $conn->prepare("SELECT id, id, id, firstname, lastname, email, ccode, phone, relation, gender, nftt, uid FROM recipient WHERE email = ?"); 
 $stmt->bind_param("s",$email);
 $stmt->execute();
 $stmt->bind_result($userid, $id, $firstname, $lastname, $email, $ccode, $phone, $relation, $gender, $nftt, $uid);
 $stmt->fetch();
 
 $user = array(
 'id'=>$id, 
 'id'=>$id, 
 'firstname'=>$firstname, 
 'lastname'=>$lastname, 
 'email'=>$email, 
 'ccode'=>$ccode, 
 'phone'=>$phone, 
 'relation'=>$relation, 
 'gender'=>$gender, 
 'nftt'=>$nftt, 
 'uid'=>$uid
 );
 
 $stmt->close();
 
 //adding the user data in response 
 $response['error'] = false; 
 $response['message'] = 'User registered successfully'; 
 $response['user'] = $user;
} else {
  $response['error'] = true; 
 $response['message'] = 'Something went wrong. Please try again'; 
}
 
 
 }
 
 }else{
 $response['error'] = true; 
 $response['message'] = 'required parameters are not available'; 
 }
 break; 
 
 /*----------------------------------------------------------- List Recipients ----------------------------------------------------*/
 
 case 'recipient_list';
			
			$uid = trim($_POST['uid']);
	        $userList_query = $conn->query("SELECT id, firstname, lastname, email, ccode, phone, relation, gender, nftt, uid FROM recipient where uid = $uid ");
	        	//var_dump($userList_query);
        	if ($userList_query->num_rows > 0)
        	{
    		$apps = array();
    		while ($rows = mysqli_fetch_array($userList_query))
    		{
			$temp['id'] = $rows['id']; //this is request id
			$temp['firstname'] = $rows['firstname'];
			$temp['lastname'] = $rows['lastname'];
			$temp['email'] = $rows['email'];
			$temp['ccode'] = $rows['ccode'];
			$temp['phone'] = $rows['phone'];
			$temp['relation'] = $rows['relation'];
			$temp['gender'] = $rows['gender'];
			$temp['nftt'] = $rows['nftt'];
			$temp['uid'] = $rows['uid']; 
			array_push($apps, $temp);
    		}

    		echo json_encode(array('type' => TRUE,'apps' => $apps) , JSON_PRETTY_PRINT);
        	}
	
	        
			break;
			
			/*----------------------------------------------------------- Delete Address ----------------------------------------------------*/
 case 'delete_recipient';
			
			$ID = $_POST['id'];
		
			$Sql_Query = "DELETE FROM recipient WHERE id = '$ID'";

			if(mysqli_query($conn,$Sql_Query))
				{
					echo 'Recipient Deleted Successfully';
				} else {
					echo 'Something went wrong';
				}
 break;
 
 /*----------------------------------------------------------- Add new Service ----------------------------------------------------*/
 
 case 'add_service': 
 
				if (isset($_POST['sevice_name'])) {
				  $sevice_name = $_POST['sevice_name'];
				  $details = $_POST['details'];
				  
                  $Sql_Query = "insert into service (sevice_name,details) values ('$sevice_name','$details')";
                    if(mysqli_query($conn,$Sql_Query)){
                    echo 'Service added successfully';
 
                    }
                    else{
 
                    echo 'Something went wrong. Please try again';
 
                    }
				} else {
					echo 'Invalid statement';
				}
 
 break;

 
  /*----------------------------------------------------------- Delete Service ----------------------------------------------------*/
 
 /*case 'delete_service';
			
			$ID = $_POST['id'];

$Sql_Query = "DELETE FROM service WHERE id = '$ID'";

 if(mysqli_query($conn,$Sql_Query))
{
 echo 'Record Deleted Successfully';
}
else
{
 echo 'Something went wrong';
 }*/
 
 
 
 /*----------------------------------------------------------- Delete Duration ----------------------------------------------------*/
 
 case 'delete_duration';
			
			$ID = $_POST['id'];

$Sql_Query = "DELETE FROM duration WHERE id = '$ID'";

 if(mysqli_query($conn,$Sql_Query))
{
 echo 'Record Deleted Successfully';
}
else
{
 echo 'Something went wrong';
 }
 break;
 
  /*----------------------------------------------------------- Get List Service ----------------------------------------------------*/
 
case 'get_services_list';
			
			//creating a query
	$stmt = $conn->prepare("SELECT id, sevice_name FROM service;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $sevice_name);
	
	$service_items = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['sevice_name'] = $sevice_name; 
		array_push($service_items, $temp);
	}
	
	//displaying the result in json format 
    echo json_encode($service_items);
			
			break;
			
			/*----------------------------------------------------------- Get List Healthfund Admin ----------------------------------------------------*/
 
case 'get_healthf_list_admin';
			
			//creating a query
	$stmt = $conn->prepare("SELECT id, name, status FROM healt_provider;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $name, $status);
	
	$service_items = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['name'] = $name; 
		$temp['status'] = $status; 
		array_push($service_items, $temp);
	}
	
	//displaying the result in json format 
    echo json_encode($service_items);
			
			break;
			
/*----------------------------------------------------------- Delete Time Slot ----------------------------------------------------*/
 
 case 'delete_timeslot';
			
			$ID = $_POST['id'];

$Sql_Query = "DELETE FROM time_slot WHERE id = '$ID'";

 if(mysqli_query($conn,$Sql_Query))
{
 echo 'Record Deleted Successfully';
}
else
{
 echo 'Something went wrong';
 }
 
 break;
 
 /*----------------------------------------------------------- Update Time Slot Status ----------------------------------------------------*/
 
 case 'update_timeslot';
			
			$ID = $_POST['id'];
			$status = $_POST['status'];

//$Sql_Query = "DELETE FROM time_slot WHERE id = '$ID'";
$Sql_Query = "UPDATE time_slot SET status = '$status' WHERE id = $ID";

 if(mysqli_query($conn,$Sql_Query))
{
 echo 'Record Updated Successfully';
}
else
{
 echo 'Something went wrong';
 }
 
 break;
			
			/*----------------------------------------------------------- Get List Duration ----------------------------------------------------*/
 
case 'get_duration_list';

	$service = $_GET['sid'];
	
	$sql = "SELECT id FROM service WHERE sevice_name='$service'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$SID = $row['id'];
						
						}
					}
			
			//creating a query
	$stmt = $conn->prepare("SELECT id, duration, service_id, time_slot, price, practitioner_id FROM duration WHERE service_id='$SID'");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $duration, $service_id, $time_slot, $price, $practitioner_id);
	
	$service_items = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['duration'] = $duration; 
		$temp['service_id'] = $service_id; 
		$temp['time_slot'] = $time_slot; 
		$temp['price'] = $price; 
		$temp['practitioner_id'] = $practitioner_id; 
		array_push($service_items, $temp);
	}
	
	//displaying the result in json format 
    echo json_encode($service_items);
			
			break;
			
			/*----------------------------------------------------------- Get List Duration B----------------------------------------------------*/
 
case 'get_duration_listb';
			
			//creating a query
	$stmt = $conn->prepare("SELECT id, duration, service_id, time_slot, price, practitioner_id FROM duration");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $duration, $service_id, $time_slot, $price, $practitioner_id);
	
	$service_items = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['duration'] = $duration; 
		$temp['service_id'] = $service_id; 
		$temp['time_slot'] = $time_slot; 
		$temp['price'] = $price; 
		$temp['practitioner_id'] = $practitioner_id; 
		array_push($service_items, $temp);
	}
	
	//displaying the result in json format 
    echo json_encode($service_items);
			
			break;
			
			/*----------------------------------------------------------- Get List Practitioner ----------------------------------------------------*/
 
case 'get_practitioner_list';
			
			//creating a query
	$stmt = $conn->prepare("SELECT id, firstname, lastname, email, ccode, mobile, gender, service_type, professional_exp, reference, udp, auth, status, doj FROM practitioner;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $firstname, $lastname, $email, $ccode, $mobile, $gender, $service_type, $professional_exp, $reference, $udp, $auth, $status, $doj);
	
	$service_items = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['firstname'] = $firstname; 
		$temp['lastname'] = $lastname; 
		$temp['email'] = $email; 
		$temp['ccode'] = $ccode; 
		$temp['mobile'] = $mobile; 
		$temp['gender'] = $gender; 
		$temp['service_type'] = $service_type; 
		$temp['professional_exp'] = $professional_exp; 
		$temp['reference'] = $reference; 
		$temp['udp'] = $udp; 
		$temp['auth'] = $auth; 
		$temp['status'] = $status; 
		$temp['doj'] = $doj; 
		array_push($service_items, $temp);
	}
	
	//displaying the result in json format 
    echo json_encode($service_items);
			
			break;
			
			/*----------------------------------------------------------- Get List User Admin ----------------------------------------------------*/
 
case 'get_user_list_admin';
			
			//creating a query
	$stmt = $conn->prepare("SELECT id, first_name, last_name, gender, c_code, phone, email, uid, ref_code, user_dp, doj, auth FROM users");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $first_name, $last_name, $gender, $c_code, $phone, $email, $uid, $ref_code, $user_dp, $doj, $auth);
	
	$service_items = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['first_name'] = $first_name; 
		$temp['last_name'] = $last_name; 
		$temp['gender'] = $gender; 
		$temp['c_code'] = $c_code; 
		$temp['phone'] = $phone;  
		$temp['email'] = $email; 
		$temp['uid'] = $uid; 
		$temp['ref_code'] = $ref_code; 
		$temp['user_dp'] = $user_dp; 
		$temp['doj'] = $doj; 
		$temp['auth'] = $auth; 
		array_push($service_items, $temp);
	}
	
	//displaying the result in json format 
    echo json_encode($service_items);
			
			break;
			
			/*----------------------------------------------------------- Get List Timeslot ----------------------------------------------------*/
 
case 'get_timeslot_list';

	$sname = $_GET['sname'];
	$durationx = $_GET['durtion'];
	
	 $sql = "SELECT id FROM service WHERE sevice_name='$sname'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$snids= $row['id'];
						}
					}
					
					//$sql = "SELECT id FROM duration WHERE duration='$duration' AND service_id='$SNID'";
					$sql = "SELECT id FROM duration WHERE duration='$durationx' AND service_id='$snids'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$DID = $row['id'];
						}
					}
					
	
			//creating a query
	//$stmt = $conn->prepare("SELECT id, time_start, time_sm, time_end, time_em, status, extra_charge, durtion_id FROM time_slot;");
	$stmt = $conn->prepare("SELECT id, time_start, time_sm, time_end, time_em, status, extra_charge, durtion_id FROM time_slot WHERE durtion_id='$DID' AND NOT time_start='09:00'");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $time_start, $time_sm, $time_end, $time_em, $status, $extra_charge, $durtion_id);
	
	$service_items = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['time_start'] = $time_start; 
		$temp['time_sm'] = $time_sm; 
		$temp['time_end'] = $time_end; 
		$temp['time_em'] = $time_em; 
		$temp['status'] = $status; 
		$temp['extra_charge'] = $extra_charge; 
		$temp['durtion_id'] = $durtion_id; 
		array_push($service_items, $temp);
	}
	
	//displaying the result in json format 
    echo json_encode($service_items);
			
			break;
 
 
 /*----------------------------------------------------------- Add new Duration ----------------------------------------------------*/
 
 case 'add_duration': 
 
				if (isset($_POST['duration'])) {
				  $duration = $_POST['duration'];
				  $service_id = $_POST['service_id'];
				  $time_slot = $_POST['time_slot'];
				  $price = $_POST['price'];
				  $practitioner_id = $_POST['practitioner_id'];
				  
                  $Sql_Query = "insert into duration (duration,service_id,time_slot,price,practitioner_id) values ('$duration','$service_id','$time_slot','$price','$practitioner_id')";
                    if(mysqli_query($conn,$Sql_Query)){
                    echo 'Duration added successfully';
 
                    }
                    else{
 
                    echo 'Something went wrong. Please try again';
 
                    }
				} else {
					echo 'Invalid statement';
				}
 
 break;
 /*----------------------------------------------------------- Delete Heath fund Admin ----------------------------------------------------*/
 
 case 'delete_hf_admin';
			
			$ID = $_POST['id'];

$Sql_Query = "DELETE FROM healt_provider WHERE id = '$ID'";

 if(mysqli_query($conn,$Sql_Query))
{
 echo 'Record Deleted Successfully';
}
else
{
 echo 'Something went wrong';
 }
 break;
 
 /*----------------------------------------------------------- Delete Duration ----------------------------------------------------*/
 
 case 'delete_service';
			
			$ID = $_POST['id'];

$Sql_Query = "DELETE FROM service WHERE id = '$ID'";

 if(mysqli_query($conn,$Sql_Query))
{
 echo 'Record Deleted Successfully';
}
else
{
 echo 'Something went wrong';
 } 
 
 break;
 
 /*----------------------------------------------------------- Send Notification ----------------------------------------------------*/
 
 case 'send_notification';
			
if($_SERVER['REQUEST_METHOD']=='POST'){

 $fcm_apiKey = $_POST['apiKey'];
 $getTitle = $_POST['title'];
 $getBody = $_POST['body'];
 $getTopic = $_POST['topic'];
 $getDevice_token = $_POST['token'];
 $getImageUrl = $_POST['image_url'];
 $getAction = $_POST['action'];
 $getColor = $_POST['color'];
 $getIcon = $_POST['icon'];
 $getSound = $_POST['sound'];
 
 $fcm_url = 'https://fcm.googleapis.com/fcm/send';
 
 if ($getTopic == ""){
	 $getsend_type = "2";
 } else {
	 $getsend_type = "1";
 }
 sendFCM($fcm_url, $fcm_apiKey, $getTitle, $getBody, $getImageUrl, $getsend_type, $getTopic, $getDevice_token, $getIcon, $getSound, $getColor, $getAction);
}

function sendFCM(string $fcm_url, $fcm_apiKey, $getTitle, $getBody, $getImageUrl, $getsend_type, $getTopic, $getDevice_token, $getIcon, $getSound, $getColor, $getAction) {
  $url = $fcm_url;
  $apiKey = $fcm_apiKey;
  
  $title = $getTitle;
  $body = $getBody;
  $image = $getImageUrl;
  
  $send_type = $getsend_type;
  $topic = $getTopic;
  $device_token = $getDevice_token;
  $micon = $getIcon;
  $msound = $getSound;
  $mcolor = $getColor;
  $maction = $getAction;

  // Compile headers in one variable
  $headers = array (
    'Authorization:key=' . $apiKey,
    'Content-Type:application/json'
  );

  // Add notification content to a variable for easy reference
  $notifData = [
    'title' => $title,
    'body' => $body,
    'image' => $image,
	'icon' => $micon,
    'color' => $mcolor,
	'sound' => $msound,
    'click_action' => $maction //Action/Activity - Optional
	
  ];

  $dataPayload = ['to'=> 'My Name', 
  'points'=>80, 
  'other_data' => 'This is extra payload'
  ];

  if($send_type == "1") {
	  // Create the api body
  $apiBody = [
    'notification' => $notifData,
    'data' => $dataPayload,
    'time_to_live' => 600,
    'to' => '/topics/'.$topic
    //'registration_ids' = ID ARRAY
  ];
  } elseif($send_type == "2") {
  // Create the api body
  $apiBody = [
    'notification' => $notifData,
    'data' => $dataPayload,
    'time_to_live' => 600,
    //'registration_ids' = ID ARRAY
    'to' => $device_token
  ];
  }

  // Initialize curl with the prepared headers and body
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_POST, true);
  curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

  // Execute call and save result
  $result = curl_exec($ch);
  print($result);
  // Close curl after call
  curl_close($ch);

  return $result;
}


 
 break;
 
  /*----------------------------------------------------------- Get List Duration ----------------------------------------------------*/
 
case 'get_services_list';
			
			//creating a query
	$stmt = $conn->prepare("SELECT id, sevice_name FROM service;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $sevice_name);
	
	$service_items = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['sevice_name'] = $sevice_name; 
		array_push($service_items, $temp);
	}
	
	//displaying the result in json format 
    echo json_encode($service_items);
			
			break;
 
 
 
 /*----------------------------------------------------------- Add new TimeSlot ----------------------------------------------------*/
 
 case 'add_time_slot': 
 
				if (isset($_POST['time_start'])) {
				  $time_start = $_POST['time_start'];
				  $time_sm = $_POST['time_sm'];
				  $time_end = $_POST['time_end'];
				  $time_em = $_POST['time_em'];
				  $status = $_POST['status'];
				  $extra_charge = $_POST['extra_charge'];
				  $duration = $_POST['duration'];
				  $sname = $_POST['sname'];
				  
				  
					
					$sql = "SELECT id FROM service WHERE sevice_name='$sname'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$snids= $row['id'];
						}
					}
					
					//$sql = "SELECT id FROM duration WHERE duration='$duration' AND service_id='$SNID'";
					$sql = "SELECT id FROM duration WHERE duration='$duration' AND service_id='$snids'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$DID = $row['id'];
						}
					}
				  
                  $Sql_Query = "insert into time_slot (time_start,time_sm,time_end,time_em,status,extra_charge,durtion_id) values ('$time_start','$time_sm','$time_end','$time_em','$status','$extra_charge','$DID')";
                    if(mysqli_query($conn,$Sql_Query)){
                    echo 'Time slot added successfully';
 
                    }
                    else{
 
                    echo 'Something went wrong. Please try again';
 
                    }
				} else {
					echo 'Invalid statement';
				}
 
 break;
 
 /*----------------------------------------------------------- Add Health Provider - Admin ----------------------------------------------------*/
 
 case 'add_health_provider': 
 
				if (isset($_POST['name'])) {
				  $name = $_POST['name'];
				  $status = $_POST['status'];
				  
                  $Sql_Query = "insert into healt_provider (name,status) values ('$name','$status')";
                    if(mysqli_query($conn,$Sql_Query)){
                    echo 'Health Provider added successfully';
 
                    }
                    else{
 
                    echo 'Something went wrong. Please try again';
 
                    }
				} else {
					echo 'Invalid statement';
				}
 
 break;
 
 /*----------------------------------------------------------- Add new Booking ----------------------------------------------------*/
 
 case 'add_booking': 
 
				if (isset($_POST['service'])) {
				  $service = $_POST['service'];
				  $practitioner = $_POST['practitioner'];
				  $bdate = $_POST['bdate'];
				  $duration = $_POST['duration'];
				  $timeslot = $_POST['timeslot'];
				  $booking_for = $_POST['booking_for'];
				  $recipient = $_POST['recipient'];
				  $address = $_POST['address'];
				  $note = $_POST['note'];
				  $scharge = $_POST['scharge'];
				  $tfee = $_POST['tfee'];
				  $total = $_POST['total'];
				  $status = $_POST['status'];
				  $payment_status = $_POST['payment_status'];
				  $transaction_id = $_POST['transaction_id'];
				  $invoice_id = "INV-".generateRandomString($length = 2).generateRandomNumber($length = 5);
				  $uid = $_POST['uid'];
				  $remail = "";
				  $uname = "";
				  
				  $sql = "SELECT id, first_name, last_name, email FROM users WHERE id='$uid'";
					$result = $conn->query($sql);

					if (empty($recipient)){
					  $sql = "SELECT id, first_name, last_name, email FROM users WHERE id='$uid'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$uname = $row['first_name']." ".$row['last_name'];
						$remail = $row['email'];
						
						}
					}
				  } else {
					  $uname = $recipient;
					 $pieces = explode(" ", $recipient);
					$fname = $pieces[0];
					$lname = $pieces[1];
					//$uid = "22";
					$sql = "SELECT id, firstname, lastname, email, ccode, phone, relation, gender, nftt, uid FROM recipient WHERE firstname='$fname' && lastname='$lname' && uid='$uid'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$remail = $row['email'];
						}
					}
				  }
				  
                  $Sql_Query = "insert into booking (service,practitioner,bdate,duration,timeslot,booking_for,recipient,address,note,scharge,tfee,total,status,payment_status,transaction_id,invoice_id,uid,cur_time) values ('$service','$practitioner','$bdate','$duration','$timeslot','$booking_for','$recipient','$address','$note','$scharge','$tfee','$total','$status','$payment_status','$transaction_id','$invoice_id','$uid','$nowdt')";
                    if(mysqli_query($conn,$Sql_Query)){
					
					//----------------------------------------------------send invoice -----------------------------------
					/*$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        
		$message = file_get_contents('email_temp/invoice.html'); 
		$message = str_replace('%name%', $uname, $message); 
		$message = str_replace('%service%', $service, $message);  
		$message = str_replace('%invoice_id%', $invoice_id, $message);  
		$message = str_replace('%purchase_date%', $nowdt, $message);  
		$message = str_replace('%sprice%', "$".$scharge, $message);  
		$message = str_replace('%cname%', $uname, $message); 
		$message = str_replace('%address%', $address, $message); 
		$message = str_replace('%tfee%', "$".$tfee, $message); 
		$message = str_replace('%total%', "$".$total, $message); 
		
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
        $mail->setFrom($all_email_send_from, $app_name.' | Invoice - '.$invoice_id);
        $mail->addAddress($remail);     // Add a recipient


        //Content
        $mail->isHTML(true);  
        $mail->Subject = 'Invoice for your last purchase | '. $app_name;
        $mail->Body    = $message;
		

        $mail->send();
		
		//$fcm_apiKey = "";
					 $getTitle = "New booking for ". $service;
					 $getBody = "You have recieved new booking form ". $uname ." for ".$service.". Paid Amount = ".$total." for date : ". $bdate. ", and timeslot : ".$timeslot ;
					 $getTopic = "xjwpractitioner";
					 $getDevice_token = "";
					 $getImageUrl = "";
					 $getAction = "";
					 $getColor = "";
					 $getIcon = "";
					 $getSound = "";
					 
					 if ($getTopic == ""){
						 $getsend_type = "2";
						 $fcm_apiKey = $_POST['apiKey'];
					 } else {
						 $getsend_type = "1";
						 if ($getTopic == "xjwuser"){
						 $fcm_apiKey = "AAAAmAd7JLc:APA91bFJ2IA1P7PKMcVUey6yXQHG845LiLQwaxrZh9Ef274hELYqxky3oNNnvzgl-oyfdclgrov1PqAVEmkuD7vtcmi-AZPTOTIRuLf_KJ8UaWVu8l-lLa4jEDWgVzxVJaZnIgG_h0V1";
						 } else if ($getTopic == "xjwpractitioner"){
							$fcm_apiKey = "AAAAPSPdCAk:APA91bEBTtuYESxsrvRgppUvljFmay4t1MoTNFQdWoMkIWARV2acTHozjgMpAasDOCzmfi6R6NZyTVsqKV80MVowp_roSpxg9pJPxNX6rHlvm6X9sXbiqZPIp1SWLVBj8LvcWc6Cv9aa";
						 }
					 }
					
					sendFCM($fcm_url, $fcm_apiKey, $getTitle, $getBody, $getImageUrl, $getsend_type, $getTopic, $getDevice_token, $getIcon, $getSound, $getColor, $getAction);
        $response['error'] = false; 
        $response['message'] = 'Your booking created successfully'; 
		
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
    }*/
		//$response['error'] = false; 
        //$response['message'] = 'Your booking created successfully'; 
		
					$getTitle = "New booking for ". $service;
					 $getBody = "You have recieved new booking form ". $uname ."."."\n"."For ".$service."\n"."Paid Amount = $".$total."\n"."Date : ". $bdate. "\n"."Timeslot : ".$timeslot ;
					 $getTopic = "xjwpractitioner";
					 $getDevice_token = "";
					 //$getImageUrl = $baseurl."/assets/recv_book.jpg";
					 $getImageUrl = "";
					 $getAction = "";
					 $getColor = "";
					 $getIcon = "";
					 $getSound = "";
					 
					 $fcm_url = 'https://fcm.googleapis.com/fcm/send';
 
 if ($getTopic == ""){
	 $getsend_type = "2";
	 $fcm_apiKey = $_GET['apiKey'];
 } else {
	 $getsend_type = "1";
	 if ($getTopic == "xjwuser"){
     $fcm_apiKey = "AAAAmAd7JLc:APA91bFJ2IA1P7PKMcVUey6yXQHG845LiLQwaxrZh9Ef274hELYqxky3oNNnvzgl-oyfdclgrov1PqAVEmkuD7vtcmi-AZPTOTIRuLf_KJ8UaWVu8l-lLa4jEDWgVzxVJaZnIgG_h0V1";
     } else if ($getTopic == "xjwpractitioner"){
        $fcm_apiKey = "AAAAPSPdCAk:APA91bEBTtuYESxsrvRgppUvljFmay4t1MoTNFQdWoMkIWARV2acTHozjgMpAasDOCzmfi6R6NZyTVsqKV80MVowp_roSpxg9pJPxNX6rHlvm6X9sXbiqZPIp1SWLVBj8LvcWc6Cv9aa";
     }
 }
 
 sendFCM($fcm_url, $fcm_apiKey, $getTitle, $getBody, $getImageUrl, $getsend_type, $getTopic, $getDevice_token, $getIcon, $getSound, $getColor, $getAction, $redirect_url);
				
		
					//--------------------------------------------------End send invoice ---------------------------------
 
                    }
                    else{
 
                    echo 'Something went wrong. Please try again';
 
                    }
				} else {
					echo 'Invalid statement';
				}
 
 break;
 
 /*----------------------------------------------------------- Add new Booking with Health Fund----------------------------------------------------*/
 
 case 'add_booking_with_hf': 
 
				if (isset($_POST['service'])) {
				  $service = $_POST['service'];
				  $fullname = $_POST['fullname'];
				  $dob = $_POST['dob'];
				  $email = $_POST['email'];
				  $address = $_POST['address'];
				  $health_provider = $_POST['health_provider'];
				  $health_provider_no = generateRandomString($length = 2).generateRandomNumber($length = 4).generateRandomString($length = 1);
				  $practitioner_gender = $_POST['practitioner_gender'];
				  $practitioner = $_POST['practitioner'];
				  $BDate = $_POST['BDate'];
				  $duration = $_POST['duration'];
				  $time_slot = $_POST['time_slot'];
				  $add_req = $_POST['add_req'];
				  $scharge = $_POST['scharge'];
				  $tfee = $_POST['tfee'];
				  $total = $_POST['total'];
				  $status = $_POST['status'];
				  $payment_status = $_POST['payment_status'];
				  $transaction_id = $_POST['transaction_id'];
				  $invoice_id = "INV-".generateRandomString($length = 2).generateRandomNumber($length = 5);
				  $uid = $_POST['uid'];
				  
					
				  
                  $Sql_Query = "insert into health_fund_booking (service,fullname,dob,email,address,health_provider,health_provider_no,practitioner_gender,practitioner,BDate,duration,time_slot,add_req,scharge,tfee,total,status,payment_status,transaction_id,invoice_id,uid,cur_time) values ('$service','$fullname','$dob','$email','$address','$health_provider','$health_provider_no','$practitioner_gender','$practitioner','$BDate','$duration','$time_slot','$add_req','$scharge','$tfee','$total','$status','$payment_status','$transaction_id','$invoice_id','$uid','$nowdt')";
                    if(mysqli_query($conn,$Sql_Query)){
						
						//Get Practitioner's info
							$pieces = explode(" ", $practitioner);
							$fname = $pieces[0];
							$lname = $pieces[1];
							$sql = "SELECT id, firstname, lastname, email, ccode, mobile FROM practitioner WHERE firstname='$fname' && lastname='$lname'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
								$prct_email = $row['email'];
								}
							}
							
							//End Getting Practitioner's info
							
							//Paypal Percentage
	
						$sql = "SELECT id, percent FROM paypal_charge";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
								$paypalpercent = $row['percent'];
								}
							}
	
							//End Paypal Percentage
					
					//----------------------------------------------------send invoice -----------------------------------
					/*$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        
		$message = file_get_contents('email_temp/invoice_hf.html'); 
		$message = str_replace('%name%', $fullname, $message); 
		$message = str_replace('%bdate%', $BDate, $message);  
		$message = str_replace('%baseurl%', $baseurl, $message); 
		$message = str_replace('%invoice_no%', $invoice_id, $message);  
		$message = str_replace('%health_provider_no%', $health_provider_no, $message);  
		$message = str_replace('%address%', $address, $message);  
		$message = str_replace('%email%', $email, $message); 
		$message = str_replace('%practitioner%', $practitioner, $message); 
		$message = str_replace('%prct_email%', $prct_email, $message); 
		$message = str_replace('%cur_time%', $cur_time, $message); 
		$message = str_replace('%service%', $service, $message); 
		$message = str_replace('%duration%', $duration, $message); 
		$message = str_replace('%dob%', $dob, $message); 
		$message = str_replace('%scharge%', $scharge, $message); 
		$message = str_replace('%tfee%', $tfee, $message); 
		$message = str_replace('%time_slot%', $time_slot, $message); 
		$message = str_replace('%paypalpercent%', $paypalpercent, $message); 
		$message = str_replace('%total%', $total, $message); 
		
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
        $mail->setFrom($all_email_send_from, $app_name.' | Invoice - '.$invoice_id);
        $mail->addAddress($email);     // Add a recipient


        //Content
        $mail->isHTML(true);  
        $mail->Subject = 'Invoice for your last purchase | '. $app_name;
        $mail->Body    = $message;
		

        $mail->send();
        $response['error'] = false; 
        $response['message'] = 'Your booking created successfully'; 
		
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
    }*/
	//echo "Your booking created successfully";
		//$response['error'] = false; 
        //$response['message'] = 'Your booking created successfully'; 
		$getTitle = "New booking for ". $service;
					 $getBody = "You have recieved new booking form ". $fullname ."."."\n"."For ".$service."\n"."Paid Amount = $".$total."\n"."Date : ". $BDate. "\n"."Timeslot : ".$time_slot ;
					 $getTopic = "xjwpractitioner";
					 $getDevice_token = "";
					 //$getImageUrl = $baseurl."/assets/recv_book.jpg";
					 $getImageUrl = "";
					 $getAction = "";
					 $getColor = "";
					 $getIcon = "";
					 $getSound = "";
					 
					 $fcm_url = 'https://fcm.googleapis.com/fcm/send';
 
 if ($getTopic == ""){
	 $getsend_type = "2";
	 $fcm_apiKey = $_GET['apiKey'];
 } else {
	 $getsend_type = "1";
	 if ($getTopic == "xjwuser"){
     $fcm_apiKey = "AAAAmAd7JLc:APA91bFJ2IA1P7PKMcVUey6yXQHG845LiLQwaxrZh9Ef274hELYqxky3oNNnvzgl-oyfdclgrov1PqAVEmkuD7vtcmi-AZPTOTIRuLf_KJ8UaWVu8l-lLa4jEDWgVzxVJaZnIgG_h0V1";
     } else if ($getTopic == "xjwpractitioner"){
        $fcm_apiKey = "AAAAPSPdCAk:APA91bEBTtuYESxsrvRgppUvljFmay4t1MoTNFQdWoMkIWARV2acTHozjgMpAasDOCzmfi6R6NZyTVsqKV80MVowp_roSpxg9pJPxNX6rHlvm6X9sXbiqZPIp1SWLVBj8LvcWc6Cv9aa";
     }
 }
 
 sendFCM($fcm_url, $fcm_apiKey, $getTitle, $getBody, $getImageUrl, $getsend_type, $getTopic, $getDevice_token, $getIcon, $getSound, $getColor, $getAction, $redirect_url);
					//--------------------------------------------------End send invoice ---------------------------------
 
                    }
                    else{
 
                    echo 'Something went wrong. Please try again';
 
                    }
				} else {
					echo 'Invalid statement';
				}
 
 break;
 
 /*----------------------------------------------------------- Add list spinner Health Provider ----------------------------------------------------*/
 
 case 'spinner_list_health_provider';
			
			$sql = "SELECT * FROM healt_provider";
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;
/*----------------------------------------------------------- Add list spinner practitioner ----------------------------------------------------*/
 
 /*----------------------------------------------------------- Add list spinner Services ----------------------------------------------------*/
 
 case 'spinner_list_service';
			
			$sql = "SELECT * FROM service";
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;


/*----------------------------------------------------------- Add list spinner Duration ----------------------------------------------------*/
 
 case 'spinner_list_duration_admin';
			$sname = $_GET['sname'];
			
			$sql = "SELECT id, sevice_name FROM service WHERE sevice_name='$sname'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$sid = $row['id'];
						}
					}
			
			$sql = "SELECT * FROM duration WHERE service_id=".$sid;
			//$sql = "SELECT * from duration INNER JOIN service on service.id=duration.service_id";
			
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;

/*----------------------------------------------------------- Add list spinner practitioner ----------------------------------------------------*/
 
 case 'spinner_list_practitioner';
			
			$sql = "SELECT * FROM practitioner";
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;

/*----------------------------------------------------------- Add list spinner practitioner by gender ----------------------------------------------------*/
 
 case 'spinner_list_practitioner_by_gender';
 
			$gender = $_GET['gender'];
			
			$sql = "SELECT * FROM practitioner WHERE gender='$gender'";
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;

/*----------------------------------------------------------- Add list spinner Duration ----------------------------------------------------*/
 
 case 'spinner_list_duration';
			$pid = $_GET['pid'];
			$sname = $_GET['sid'];
			$sql = "SELECT id, sevice_name FROM service WHERE sevice_name='".$sname."'";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
							$sid = $row["id"];}}
			$sql = "SELECT * FROM duration WHERE service_id='$sid' ORDER BY id ASC";
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
				//while($row = $result->fetch_assoc()) {
				
				//if ()
					//echo "This PID = "."practitioner_id";
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;

/*----------------------------------------------------------- Add list spinner Time Slot ----------------------------------------------------*/
 
 case 'spinner_list_time_slot';
			
			$did = $_GET['did'];
			//$did = "4";
			$sql = "SELECT * FROM time_slot WHERE durtion_id=$did";
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;

/*----------------------------------------------------------- Add list spinner Recipient ----------------------------------------------------*/
 
 case 'spinner_list_recipient';
			
			$sql = "SELECT * FROM recipient";
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;

/*----------------------------------------------------------- Add list spinner Adresses ----------------------------------------------------*/
 
 case 'spinner_list_address';
			
			$sql = "SELECT * FROM addresses";
			$result = $conn->query($sql);

			if ($result->num_rows >0) {
			while($row[] = $result->fetch_assoc()) {
					$tem = $row;
					$json = json_encode($tem);
				}
 
				} else {
					echo "No Results Found.";
				}
				echo $json;
				
				
break;
/*----------------------------------------------------------- Get Prices ----------------------------------------------------*/
case 'get_prices';
			
 $response = array();
 if($_POST['duration']){
     $durationx = $_POST['duration'];
     $service = $_POST['service'];
	 $sql = "SELECT id, sevice_name FROM service WHERE sevice_name='$service'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
								$sid = $row['id'];
								}
							}
     $stmt = $conn->prepare("SELECT id,duration,price FROM duration WHERE duration = ? AND service_id = ?");
     $stmt->bind_param("ss",$durationx, $sid);
     $result = $stmt->execute();
   if($result == TRUE){
         $response['error'] = false;
         $response['message'] = "Retrieval Successful!";
         $stmt->store_result();
         $stmt->bind_result($id,$duration,$price);
         $stmt->fetch();
		 $response['id'] = $id;
         $response['duration'] = $duration;
         $response['price'] = $price;
     } else{
         $response['error'] = true;
         $response['message'] = "Incorrect id";
     }
 } else{
      $response['error'] = true;
      $response['message'] = "Insufficient Parameters";
 }
 echo json_encode($response);
 
			break;
			
			/*----------------------------------------------------------- Get My Bookings ----------------------------------------------------*/
			
			case 'get_mybooking_list';
			//creating a query
			$uid = $_GET['uid'];
	        $stmt = $conn->prepare("SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking WHERE uid=$uid ORDER BY id DESC");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $practitioner, $bdate, $duration, $timeslot, $booking_for, $recipient, $address, $note, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	        $mybooking = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['service'] = $service; 
		    $temp['practitioner'] = $practitioner; 
		    $temp['bdate'] = $bdate; 
		    $temp['duration'] = $duration; 
		    $temp['timeslot'] = $timeslot; 
		    $temp['booking_for'] = $booking_for; 
		    $temp['recipient'] = $recipient; 
		    $temp['address'] = $address; 
		    $temp['note'] = $note; 
		    $temp['scharge'] = $scharge; 
		    $temp['tfee'] = $tfee; 
		    $temp['total'] = $total; 
		    $temp['status'] = $status; 
		    $temp['payment_status'] = $payment_status; 
		    $temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $invoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($mybooking, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($mybooking);
			break; 

			/*----------------------------------------------------------- Get My Bookings with pagination ----------------------------------------------------*/
			
			case 'get_mybooking_list_pagination';
				$uid = $_GET['uid'];
				$page = $_GET['page']; 
				$start = 0; 
				$limit = 5; 
				$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM booking WHERE uid = '$uid'"));
				$page_limit = ceil ($total/$limit); 
				if($page<=$page_limit){
				$start = ($page - 1) * $limit; 
				$sql = "SELECT * FROM booking WHERE uid = '$uid' limit $start, $limit";
				$result = mysqli_query($conn,$sql); 
				$res = array(); 
				while($row = mysqli_fetch_array($result)){
				array_push($res, array(
				"id"=>$row['id'],
				"service"=>$row['service'],
				"practitioner"=>$row['practitioner'],
				"bdate"=>$row['bdate'],
				"duration"=>$row['duration'],
				"timeslot"=>$row['timeslot'],
				"booking_for"=>$row['booking_for'],
				"recipient"=>$row['recipient'],
				"address"=>$row['address'],
				"note"=>$row['note'],
				"scharge"=>$row['scharge'],
				"tfee"=>$row['tfee'],
				"total"=>$row['total'],
				"status"=>$row['status'],
				"payment_status"=>$row['payment_status'],
				"transaction_id"=>$row['transaction_id'],
				"invoice_id"=>$row['invoice_id'],
				"uid"=>$row['uid'],
				"cur_time"=>$row['cur_time'])
				);
				}
				echo json_encode($res);
				}else{
						echo "over";
				}
			break; 
			 
			/*----------------------------------------------------------- Get My Bookings With Health Fund----------------------------------------------------*/
			
			case 'get_mybooking_list_hf';
			//creating a query
			$uid = $_GET['uid'];
	        $stmt = $conn->prepare("SELECT id, service, fullname, dob, email, address, health_provider, health_provider_no, practitioner_gender, practitioner, BDate, duration, time_slot, add_req, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM health_fund_booking WHERE uid=$uid ORDER BY id DESC");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $fullname, $dob, $email, $address, $health_provider, $health_provider_no, $practitioner_gender, $practitioner, $BDate, $duration, $time_slot, $add_req, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	        $mybooking = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['service'] = $service; 
		    $temp['fullname'] = $fullname; 
		    $temp['dob'] = $dob; 
		    $temp['email'] = $email; 
		    $temp['address'] = $address; 
		    $temp['health_provider'] = $health_provider; 
		    $temp['health_provider_no'] = $health_provider_no; 
		    $temp['practitioner_gender'] = $practitioner_gender; 
		    $temp['practitioner'] = $practitioner; 
		    $temp['BDate'] = $BDate; 
		    $temp['duration'] = $duration; 
		    $temp['time_slot'] = $time_slot; 
		    $temp['add_req'] = $add_req; 
		    $temp['scharge'] = $scharge; 
		    $temp['tfee'] = $tfee; 
		    $temp['total'] = $total; 
		    $temp['status'] = $status; 
		    $temp['payment_status'] = $payment_status; 
		    $temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $invoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($mybooking, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($mybooking);
			break;

			/*----------------------------------------------------------- Get My Bookings Health fund with pagination ----------------------------------------------------*/
			
			case 'get_mybooking_list_hf_pagination';
				$uid = $_GET['uid'];
				$page = $_GET['page']; 
				$start = 1; 
				$limit = 5; 
				$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM health_fund_booking WHERE uid = '$uid'"));
				$page_limit = ceil ($total/$limit); 
				if($page<=$page_limit){
				$start = ($page - 1) * $limit; 
				$sql = "SELECT * FROM health_fund_booking WHERE uid = '$uid' limit $start, $limit";
				$result = mysqli_query($conn,$sql); 
				$res = array(); 
				while($row = mysqli_fetch_array($result)){
				
				array_push($res, array(
				"id"=>$row['id'],
				"service"=>$row['service'],
				"fullname"=>$row['fullname'],
				"dob"=>$row['dob'],
				"email"=>$row['email'],
				"address"=>$row['address'],
				"health_provider"=>$row['health_provider'],
				"health_provider_no"=>$row['health_provider_no'],
				"practitioner_gender"=>$row['practitioner_gender'],
				"practitioner"=>$row['practitioner'],
				"BDate"=>$row['BDate'],
				"duration"=>$row['duration'],
				"time_slot"=>$row['time_slot'],
				"add_req"=>$row['add_req'],
				"scharge"=>$row['scharge'],
				"tfee"=>$row['tfee'],
				"total"=>$row['total'],
				"status"=>$row['status'],
				"payment_status"=>$row['payment_status'],
				"transaction_id"=>$row['transaction_id'],
				"invoice_id"=>$row['invoice_id'],
				"uid"=>$row['uid'],
				"cur_time"=>$row['cur_time'])
				);
				}
				echo json_encode($res);
				}else{
						echo "over";
				}
			break; 
			
			/*-------------------------------------------------------------------- Cancel Booking Status HF by User ---------------------------------------------------------------*/
 
 case 'update_booking_status_hf_by_user': 
 
 if(isTheseParametersAvailable(array('id'))){ 
			
			$id = $_POST['id'];
            $status = $_POST['status'];

            $Sql_Query = "UPDATE health_fund_booking SET status = '$status' WHERE id = $id";

            if(mysqli_query($conn,$Sql_Query)){
             echo 'Booking Cancelled Successfully.';
            } else {
             echo 'Something went wrong';
             }
 }else{
 $response['error'] = true; 
 $response['message'] = 'Required param are not available.';
 }
 break;
 
 /*-------------------------------------------------------------------- Update Practitioner Status Admin ---------------------------------------------------------------*/
 
 case 'update_pract_status_admin': 
 
 if(isTheseParametersAvailable(array('id'))){ 
			
			$id = $_POST['id'];
            $status = $_POST['status'];

            $Sql_Query = "UPDATE practitioner SET status = '$status' WHERE id = $id";

            if(mysqli_query($conn,$Sql_Query)){
             echo 'Account status updated Successfully.';
            } else {
             echo 'Something went wrong';
             }
 }else{
 $response['error'] = true; 
 $response['message'] = 'Required param are not available.';
 }
 break;
 
 
 /*-------------------------------------------------------------------- Practitioner Status Update ---------------------------------------------------------------*/
 
 case 'update_status_pract': 
 
 if(isTheseParametersAvailable(array('id'))){ 
			
			$id = $_POST['id'];
            $status = $_POST['status'];

            $Sql_Query = "UPDATE practitioner SET status = '$status' WHERE id = $id";

            if(mysqli_query($conn,$Sql_Query)){
             echo 'Status Updated Successfully.';
            } else {
             echo 'Something went wrong';
             }
 }else{
 $response['error'] = true; 
 $response['message'] = 'Required param are not available.';
 }
 break;
 
 /*-------------------------------------------------------------------- Cancel Booking Status by User ---------------------------------------------------------------*/
 
 case 'update_booking_status_by_user': 
 
 if(isTheseParametersAvailable(array('id'))){
			
			$id = $_POST['id'];
            $status = $_POST['status'];
			
			$sql = "SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking WHERE id='$id'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$sid = $row['id'];
						$fullname = $row['fullname'];
						$service = $row['service'];
						$invoice_id = $row['invoice_id'];
						$total = $row['total'];
						$bdate = $row['bdate'];
						$uid = $row['uid'];
						$timeslot = $row['timeslot'];
						
						
						$bid = substr($invoice_id,4);
						
						}
					}
					
					$sql = "SELECT id, token FROM firebase_token WHERE uid='$uid'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$fid = $row['id'];
						$token = $row['token'];
						
						
						}
					}

            $Sql_Query = "UPDATE booking SET status = '$status' WHERE id = $id";

            if(mysqli_query($conn,$Sql_Query)){
				//------------------------------------notify----------------------------------------
				
				if ($status == "3") {
					$stats = "Cancelled";
				} else if ($status == "2"){
					$stats = "Completed";
				} else if ($status == "1"){
					$stats = "Approved";
				} else if ($status == "4"){
					$stats = "Completed";
				} else if ($status == "0"){
					$stats = "Booked";
				}
				
				$getTitle = "Status changed for your booking : ". $bid;
					 $getBody = "Your booking has been ". $stats . ".\nBooking id :" . $bid ."."."\n"."For ".$service."\n"."Paid Amount = $".$total."\n"."Date : ". $bdate. "\n"."Timeslot : ".$timeslot ;
					 $getTopic = "";
					 $getDevice_token = $token;
					 //$getImageUrl = $baseurl."/assets/recv_book.jpg";
					 $getImageUrl = "";
					 $getAction = "";
					 $getColor = "";
					 $getIcon = "";
					 $getSound = "";
 
					 $getsend_type = "2";
					 $fcm_apiKey = $fcm_apiKey_user;
					 
					 sendFCM($fcm_url, $fcm_apiKey, $getTitle, $getBody, $getImageUrl, $getsend_type, $getTopic, $getDevice_token, $getIcon, $getSound, $getColor, $getAction, $redirect_url);
				
				//----------------------------------end notify--------------------------------------
             echo 'Booking Cancelled Successfully.';
            } else {
             echo 'Something went wrong';
             }
 }else{
 $response['error'] = true; 
 $response['message'] = 'Required param are not available.';
 }
 break;


 case 'get_service_id':
$name = "sahil khan";
$pieces = explode(" ", $name);
$fname = $pieces[0];
$lname = $pieces[1];
 $uid = "22";
 $sql = "SELECT id, firstname, lastname, email, ccode, phone, relation, gender, nftt, uid FROM recipient WHERE firstname='$fname' && lastname='$lname' && uid='$uid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo $row['email'];
  }
} else {
  echo "0 results";
}
 
 break;
 
 /*----------------------------------------------------------- Get Pay Pal Percentage ----------------------------------------------------*/
case 'get_paypal_percent';
			
 $response = array();
 if($_POST['id']){
     $id = $_POST['id'];
     $stmt = $conn->prepare("SELECT id,percent FROM paypal_charge WHERE id = ?");
     $stmt->bind_param("s",$id);
     $result = $stmt->execute();
   if($result == TRUE){
         $response['error'] = false;
         $response['message'] = "Retrieval Successful!";
         $stmt->store_result();
         $stmt->bind_result($id,$percent);
         $stmt->fetch();
		 $response['id'] = $id;
         $response['percent'] = $percent;
     } else{
         $response['error'] = true;
         $response['message'] = "Incorrect id";
     }
 } else{
      $response['error'] = true;
      $response['message'] = "Insufficient Parameters";
 }
 echo json_encode($response);
 
			break;


 case 'get_service_id':
 $sname = "facial";
 $sql = "SELECT id, sevice_name FROM time_slot WHERE sevice_name='$sname'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["sevice_name"]. "<br>";
  }
} else {
  echo "0 results";
}
 
 break;
 
 //----------------------------------------------------------------------Admin --------------------------------------------------------
 case 'admin';
	        
	        //$con = mysqli_connect("localhost","numberla_tospro","Umar.95078","numberla_tosproduct");
			
			$email = trim($_POST['email']);
	        $password = trim($_POST['password']);
	

	        $db_email = "admin@gmail.com";
	        $db_pass = "123456";
	

	        if($email == $db_email  && $password == $db_pass){
		    $response["error"] = FALSE;
		    $response["msg"] = "Login succesfull";
		    echo json_encode($response);
	        }
	        else{
		
		    $response["error"] = TRUE;
		    $response["msg"] = "Email or password not matched";
		    echo json_encode($response);
	        }

	        
			
			break;
			
			
			/*----------------------------------------------------------- Add Paypal Percentage ----------------------------------------------------*/
 
 case 'update_paypal_percent': 
 
			$percent = $_POST['percent'];
 
			$Sql_Query = "UPDATE paypal_charge SET percent = '$percent'";

             if(mysqli_query($conn,$Sql_Query))
            {
				echo "Transaction fee updated successfully.";
			} else {
				echo "Something went wrong.";
			}
 
 break;
 
 //------------------------------------------------------------------- Get Paypal Percent current ----------------------------------------
 
 case 'get_currecnt_percent':
 
 $response = array();
 if($_POST['id']){
     $id = $_POST['id'];
     $stmt = $conn->prepare("SELECT percent FROM paypal_charge WHERE id = ?");
     $stmt->bind_param("s",$id);
     $result = $stmt->execute();
   if($result == TRUE){
         $response['error'] = false;
         $response['message'] = "Retrieval Successful!";
         $stmt->store_result();
         $stmt->bind_result($percent);
         $stmt->fetch();
         $response['percent'] = $percent;
     } else{
         $response['error'] = true;
         $response['message'] = "Incorrect id";
     }
 } else{
      $response['error'] = true;
      $response['message'] = "Insufficient Parameters";
 }
 echo json_encode($response);
 
 break;
 
 //------------------------------------------------------------------- Get Activation Status Practitioner ----------------------------------------
 
 case 'get_activation_status_pract':
 
 $response = array();
 if($_POST['id']){
     $id = $_POST['id'];
     $stmt = $conn->prepare("SELECT status FROM practitioner WHERE id = ?");
     $stmt->bind_param("s",$id);
     $result = $stmt->execute();
   if($result == TRUE){
         $response['error'] = false;
         $response['message'] = "Retrieval Successful!";
         $stmt->store_result();
         $stmt->bind_result($status);
         $stmt->fetch();
         $response['status'] = $status;
     } else{
         $response['error'] = true;
         $response['message'] = "Incorrect id";
     }
 } else{
      $response['error'] = true;
      $response['message'] = "Insufficient Parameters";
 }
 echo json_encode($response);
 
 break;
 
 /*----------------------------------------------------------- Get My Bookings With Health Fund Admin ----------------------------------------------------*/
			
			case 'get_mybooking_list_hf_admin';
			//creating a query
	        $stmt = $conn->prepare("SELECT id, service, fullname, dob, email, address, health_provider, health_provider_no, practitioner_gender, practitioner, BDate, duration, time_slot, add_req, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM health_fund_booking ORDER BY id DESC");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $fullname, $dob, $email, $address, $health_provider, $health_provider_no, $practitioner_gender, $practitioner, $BDate, $duration, $time_slot, $add_req, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	        $mybooking = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['service'] = $service; 
		    $temp['fullname'] = $fullname; 
		    $temp['dob'] = $dob; 
		    $temp['email'] = $email; 
		    $temp['address'] = $address; 
		    $temp['health_provider'] = $health_provider; 
		    $temp['health_provider_no'] = $health_provider_no; 
		    $temp['practitioner_gender'] = $practitioner_gender; 
		    $temp['practitioner'] = $practitioner; 
		    $temp['BDate'] = $BDate; 
		    $temp['duration'] = $duration; 
		    $temp['time_slot'] = $time_slot; 
		    $temp['add_req'] = $add_req; 
		    $temp['scharge'] = $scharge; 
		    $temp['tfee'] = $tfee; 
		    $temp['total'] = $total; 
		    $temp['status'] = $status; 
		    $temp['payment_status'] = $payment_status; 
		    $temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $invoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($mybooking, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($mybooking);
			break;
			
			/*----------------------------------------------------------- Get My Bookings Admin ----------------------------------------------------*/
			
			case 'get_mybooking_list_admin';
			//creating a query
	        $stmt = $conn->prepare("SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking ORDER BY id DESC");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $practitioner, $bdate, $duration, $timeslot, $booking_for, $recipient, $address, $note, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
			
			/*$sql = "SELECT id, first_name, last_name, email FROM users WHERE id='$uid'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$uname = $row['first_name']." ".$row['last_name'];
						
						}
					}*/
	
	        $mybooking = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['uname'] = $uname; 
		    $temp['service'] = $service; 
		    $temp['practitioner'] = $practitioner; 
		    $temp['bdate'] = $bdate; 
		    $temp['duration'] = $duration; 
		    $temp['timeslot'] = $timeslot; 
		    $temp['booking_for'] = $booking_for; 
		    $temp['recipient'] = $recipient; 
		    $temp['address'] = $address; 
		    $temp['note'] = $note; 
		    $temp['scharge'] = $scharge; 
		    $temp['tfee'] = $tfee; 
		    $temp['total'] = $total; 
		    $temp['status'] = $status; 
		    $temp['payment_status'] = $payment_status; 
		    $temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $invoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($mybooking, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($mybooking);
			break; 
			
			/*----------------------------------------------------------- Get My Bookings Practitioner ----------------------------------------------------*/
			
			case 'get_mybooking_list_pract';
			$pname = $_GET['pname'];
			//creating a query
	        $stmt = $conn->prepare("SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking WHERE practitioner='$pname' ORDER BY id DESC");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $practitioner, $bdate, $duration, $timeslot, $booking_for, $recipient, $address, $note, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
			
			$sql = "SELECT id, first_name, last_name, email FROM users WHERE id='$uid'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$uname = $row['first_name']." ".$row['last_name'];
						}
					}
	
	        $mybooking = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['uname'] = $uname; 
		    $temp['service'] = $service; 
		    $temp['practitioner'] = $practitioner; 
		    $temp['bdate'] = $bdate; 
		    $temp['duration'] = $duration; 
		    $temp['timeslot'] = $timeslot; 
		    $temp['booking_for'] = $booking_for; 
		    $temp['recipient'] = $recipient; 
		    $temp['address'] = $address; 
		    $temp['note'] = $note; 
		    $temp['scharge'] = $scharge; 
		    $temp['tfee'] = $tfee; 
		    $temp['total'] = $total; 
		    $temp['status'] = $status; 
		    $temp['payment_status'] = $payment_status; 
		    $temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $invoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($mybooking, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($mybooking);
			break; 
			
			/*----------------------------------------------------------- Text Get My Bookings Practitioner ----------------------------------------------------*/
			
			case 'get_mybooking_list_pract_test';
			$pname = $_GET['pname'];
			//creating a query

	        //$stmt = $conn->prepare("SELECT booking.id, booking.service, booking.practitioner, booking.bdate, booking.duration, booking.timeslot, booking.booking_for, booking.recipient, booking.address, booking.note, booking.scharge, booking.tfee, booking.total, booking.status, booking.payment_status, booking.transaction_id, booking.invoice_id, booking.uid, booking.cur_time, users.first_name, users.last_name FROM booking INNER JOIN users ON users.id=booking.uid WHERE practitioner='$pname'");
			
			//$stmt = $conn->prepare("SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking NATURAL JOIN users");
			
			$stmt = $conn->prepare("SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking, users WHERE booking.uid = users.id WHERE practitioner='$pname'");
			
			
			/*$sql = "SELECT  id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time 
					FROM booking
					INNER JOIN users ON booking.uid = users.id
					INNER JOIN notes ON people.id = _notes.peopleId_
					WHERE replied = 'y'";*/
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $practitioner, $bdate, $duration, $timeslot, $booking_for, $recipient, $address, $note, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
			
			/*$sql = "SELECT id, first_name, last_name, email FROM users WHERE id='$uid'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$uname = $row['first_name']." ".$row['last_name'];
						}
					}*/
	
	        $mybooking = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    //$temp['uname'] = $uname; 
		    $temp['service'] = $service; 
		    $temp['practitioner'] = $practitioner; 
		    $temp['bdate'] = $bdate; 
		    $temp['duration'] = $duration; 
		    $temp['timeslot'] = $timeslot; 
		    $temp['booking_for'] = $booking_for; 
		    $temp['recipient'] = $recipient; 
		    $temp['address'] = $address; 
		    $temp['note'] = $note; 
		    $temp['scharge'] = $scharge; 
		    $temp['tfee'] = $tfee; 
		    $temp['total'] = $total; 
		    $temp['status'] = $status; 
		    $temp['payment_status'] = $payment_status; 
		    $temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $invoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($mybooking, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($mybooking);
			break; 
			
			/*----------------------------------------------------------- Get My Bookings With Health Fund Practitioner ----------------------------------------------------*/
			
			case 'get_mybooking_list_hf_pract';
			$pname = $_GET['pname'];
			//creating a query
	        $stmt = $conn->prepare("SELECT id, service, fullname, dob, email, address, health_provider, health_provider_no, practitioner_gender, practitioner, BDate, duration, time_slot, add_req, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM health_fund_booking WHERE practitioner='$pname' ORDER BY id DESC");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $fullname, $dob, $email, $address, $health_provider, $health_provider_no, $practitioner_gender, $practitioner, $BDate, $duration, $time_slot, $add_req, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	        $mybooking = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['service'] = $service; 
		    $temp['fullname'] = $fullname; 
		    $temp['dob'] = $dob; 
		    $temp['email'] = $email; 
		    $temp['address'] = $address; 
		    $temp['health_provider'] = $health_provider; 
		    $temp['health_provider_no'] = $health_provider_no; 
		    $temp['practitioner_gender'] = $practitioner_gender; 
		    $temp['practitioner'] = $practitioner; 
		    $temp['BDate'] = $BDate; 
		    $temp['duration'] = $duration; 
		    $temp['time_slot'] = $time_slot; 
		    $temp['add_req'] = $add_req; 
		    $temp['scharge'] = $scharge; 
		    $temp['tfee'] = $tfee; 
		    $temp['total'] = $total; 
		    $temp['status'] = $status; 
		    $temp['payment_status'] = $payment_status; 
		    $temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $invoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($mybooking, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($mybooking);
			break;
			
			/*------------------------------------------------- Register Device Firebase ----------------------------------------------*/
			
			case 'register_device_firebase';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){

				$email = $_POST['email'];
				$device = $_POST['device'];
				$token = $_POST['token'];
				$uid = $_POST['uid'];
 
			//$query = mysqli_query($conn, "SELECT token, uid FROM `firebase_token` WHERE token='".$token."' AND uid='".$uid."'");
			$query = mysqli_query($conn, "SELECT token, uid FROM `firebase_token` WHERE uid='".$uid."'");

			if(mysqli_num_rows($query) > 0){
					//echo '3';
					$Sql_Query = "UPDATE firebase_token SET email = '$email', device = '$device', token = '$token' WHERE uid = $uid";

			 if(mysqli_query($conn,$Sql_Query)){
             echo "3";
            } else {
             echo 'Something went wrong';
             }
				}else{
					$Sql_Query = "insert into firebase_token (email,device,token,uid) values ('$email','$device','$token','$uid')";
				if(mysqli_query($conn,$Sql_Query)){
			
						echo 'Device token register succesfull.';
					}else{
						echo 'Something went wrong.';
					}
				}
			}
			
			break;
			
			/*------------------------------------------------- Register Device Firebase Practitioner ----------------------------------------------*/
			
			case 'register_device_firebase_pract';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){

				$email = $_POST['email'];
				$device = $_POST['device'];
				$token = $_POST['token'];
				$uid = $_POST['uid'];
 
			//$query = mysqli_query($conn, "SELECT token, uid FROM `firebase_token` WHERE token='".$token."' AND uid='".$uid."'");
			$query = mysqli_query($conn, "SELECT token, uid FROM `pract_fcm` WHERE uid='".$uid."'");

			if(mysqli_num_rows($query) > 0){
					//echo '3';
					$Sql_Query = "UPDATE pract_fcm SET email = '$email', device = '$device', token = '$token' WHERE uid = $uid";

			 if(mysqli_query($conn,$Sql_Query)){
             echo "3";
            } else {
             echo 'Something went wrong';
             }
				}else{
					$Sql_Query = "insert into pract_fcm (email,device,token,uid) values ('$email','$device','$token','$uid')";
				if(mysqli_query($conn,$Sql_Query)){
			
						echo 'Device token register succesfull.';
					}else{
						echo 'Something went wrong.';
					}
				}
			}
			
			break;
			
			/*------------------------------------------------- Register Device Firebase Admin ----------------------------------------------*/
			
			case 'register_device_firebase_admin';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){

				$device = $_POST['device'];
				$token = $_POST['token'];
 
			//$query = mysqli_query($conn, "SELECT token, uid FROM `firebase_token` WHERE token='".$token."' AND uid='".$uid."'");
			$query = mysqli_query($conn, "SELECT device, token FROM `admin_fcm` WHERE id='1'");

			if(mysqli_num_rows($query) > 0){
					//echo '3';
					$Sql_Query = "UPDATE admin_fcm SET device = '$device', token = '$token' WHERE uid = $uid";

			 if(mysqli_query($conn,$Sql_Query)){
             echo "3";
            } else {
             echo 'Something went wrong';
             }
				}else{
					$Sql_Query = "insert into admin_fcm (device,token) values ('$device','$token')";
				if(mysqli_query($conn,$Sql_Query)){
			
						echo 'Device token register succesfull.';
					}else{
						echo 'Something went wrong.';
					}
				}
			}
			
			break;
			
			/*------------------------------------------------- Add Duration by Practitioner ----------------------------------------------*/
			
			case 'add_duration_practitioner';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){

				$service_name = $_POST['service_name'];
				$duration = $_POST['duration'];
				$price = $_POST['price'];
				$practitioner_id = $_POST['practitioner_id'];
				
				
				$sql = "SELECT id, sevice_name FROM service WHERE sevice_name='$service_name'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$sid = $row['id'];
						$sname = $row['sevice_name'];
						
						}
					}
				
				$Sql_Query = "insert into duration (duration,service_id,price,practitioner_id) values ('$duration','$sid','$price','$practitioner_id')";
				if(mysqli_query($conn,$Sql_Query)){
			
						echo 'New Duration Added succesfully.';
					}else{
						echo 'Something went wrong.';
					}
 
			
			}
			
			break;
			
			/*------------------------------------------------- Update FCM API ----------------------------------------------*/
			
			case 'update_fcm_api';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){

				$fcm_api = $_POST['fcm_api'];
 
			$Sql_Query = "UPDATE fcm_api SET fcm_api = '$fcm_api' WHERE id = '1'";

			 if(mysqli_query($conn,$Sql_Query)){
             echo 'FCM APi Updated Successfully';
            } else {
             echo 'Something went wrong';
             }
			 
			}
			
			break;
			
			//------------------------------------------------------------------- Get FCM API ----------------------------------------
 
 case 'get_fcm_api_key':
 
 $response = array();
 if($_POST['id']){
     $id = $_POST['id'];
     $stmt = $conn->prepare("SELECT fcm_api FROM fcm_api WHERE id = ?");
     $stmt->bind_param("s",$id);
     $result = $stmt->execute();
   if($result == TRUE){
         $response['error'] = false;
         $response['message'] = "Retrieval Successful!";
         $stmt->store_result();
         $stmt->bind_result($fcm_api);
         $stmt->fetch();
         $response['fcm_api'] = $fcm_api;
     } else{
         $response['error'] = true;
         $response['message'] = "Incorrect id";
     }
 } else{
      $response['error'] = true;
      $response['message'] = "Insufficient Parameters";
 }
 echo json_encode($response);
 
 break;
 
 //--------------------********************************************************* HOME User APP *********************************************************---------------------------------
 
 /*----------------------------------------------------------- Get All Services ----------------------------------------------------*/
			
			case 'get_all_services_home';
			//creating a query
	        $stmt = $conn->prepare("SELECT id, sevice_name, details FROM service");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $sevice_name, $details);
	
	        $myservice = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['sevice_name'] = $sevice_name; 
		    $temp['details'] = $details; 
		    array_push($myservice, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($myservice);
			break; 

			/*----------------------------------------------------------- Get All Services with pagination ----------------------------------------------------*/
			
			case 'get_all_services_home_pagination';
				$page = $_GET['page']; 
				$start = 0; 
				$limit = 3; 
				$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM service WHERE NOT sevice_name = 'Choose Service'"));
				$page_limit = ceil ($total/$limit); 
				if($page<=$page_limit){
				$start = ($page - 1) * $limit; 
				$sql = "SELECT * from service WHERE NOT sevice_name = 'Choose Service' limit $start, $limit";
				$result = mysqli_query($conn,$sql); 
				$res = array(); 
				while($row = mysqli_fetch_array($result)){
				array_push($res, array(
				"id"=>$row['id'],
				"sevice_name"=>$row['sevice_name'],
				"details"=>$row['details'])
				);
				}
				echo json_encode($res);
				}else{
						echo "over";
				}
			break; 
			
			/*----------------------------------------------------------- Get Duration & Price ----------------------------------------------------*/
			
			case 'get_duration_price';
			$sid = $_GET['sid'];
			//creating a query
	        //$stmt = $conn->prepare("SELECT id, duration, service_id, price FROM duration WHERE service_id=".$sid);
	         $stmt = $conn->prepare("SELECT id, duration, service_id, price FROM duration WHERE service_id='$sid' ORDER BY id DESC");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $duration, $service_id, $price);
	
	        $myprice = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['duration'] = $duration; 
		    $temp['service_id'] = $service_id; 
		    $temp['price'] = $price; 
		    array_push($myprice, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($myprice);
			break; 
			
			/*----------------------------------------------------------- Get user Detail ----------------------------------------------------*/
            
            
            case 'get_user_detail_via_id':
 
                         $response = array();
                         if($_POST['id']){
                             $id = $_POST['id'];
                             $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone FROM users WHERE id = ?");
                             $stmt->bind_param("s",$id);
                             $result = $stmt->execute();
                           if($result == TRUE){
                                 $response['error'] = false;
                                 $response['message'] = "Retrieval Successful!";
                                 $stmt->store_result();
                                 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone);
                                 $stmt->fetch();
                                 $response['id'] = $id;
                                 $response['first_name'] = $first_name;
                                 $response['last_name'] = $last_name;
                                 $response['gender'] = $gender;
                                 $response['email'] = $email;
                                 $response['c_code'] = $c_code;
                                 $response['phone'] = $phone;
                             } else{
                                 $response['error'] = true;
                                 $response['message'] = "Incorrect id";
                             }
                         } else{
                              $response['error'] = true;
                              $response['message'] = "Insufficient Parameters";
                         }
                         echo json_encode($response);
                         
                         break;
 
 /*----------------------------------------------------------- add_block_timeslot ----------------------------------------------------*/
 case 'add_block_timeslot': 
 
				if (isset($_POST['service_name'])) {
				  $service_name = $_POST['service_name'];
				  $duration = $_POST['duration'];
				  $date = $_POST['date'];
				  $timeslot = $_POST['timeslot'];
				  $status = $_POST['status'];
				  $pid = $_POST['pid'];
				  
				   $response = array();
				  
				  $sql = "SELECT service_name, duration, date, timeslot, status, pid FROM block_timeslot WHERE (service_name = '$service_name' AND duration = '$duration' AND date = '$date' AND timeslot = '$timeslot' AND status = '$status' AND pid = '$pid')";

                    $result = $conn->query($sql);
                    
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $response['error'] = true;
                            $response['message'] = 'This timeslot is already blocked.';
                        } else {
                            $Sql_Query = "insert into block_timeslot (service_name,duration,date,timeslot,status,pid) values ('$service_name','$duration','$date','$timeslot','$status','$pid')";
                    if(mysqli_query($conn,$Sql_Query)){
                    
                    $response['error'] = false;
                    $response['message'] = 'Timeslot blocked successfully';
 
                    }
                    else{
 
                        $response['error'] = true;
                        $response['message'] = 'Something went wrong. Please try again';
 
                    }
				
                        }
                    } else {
                        $response['error'] = true;
                        $response['message'] = 'Error: ' . mysqli_error();
                    }
				  
 } else {
					$response['error'] = true;
                    $response['message'] = "Invalid statement";
				}
				
				echo json_encode($response);
 
 break;
			
			/*----------------------------------------------------------- Timeslot Block_list ----------------------------------------------------*/
			
			case 'timeslot_block_list';
			//creating a query
	        $stmt = $conn->prepare("SELECT id, service_name, duration, date, timeslot, status, pid FROM block_timeslot");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service_name, $duration, $date, $timeslot, $status, $pid);
	
	        $myservice = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['service_name'] = $service_name; 
		    $temp['duration'] = $duration; 
		    $temp['date'] = $date; 
		    $temp['timeslot'] = $timeslot; 
		    $temp['status'] = $status; 
		    $temp['pid'] = $pid; 
		    array_push($myservice, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($myservice);
			break; 
			
			 /*----------------------------------------------------------- Delete Block Time Slot ----------------------------------------------------*/
 
                 case 'delete_blocktimeslot';
                			
                			$ID = $_POST['id'];
                
                $Sql_Query = "DELETE FROM block_timeslot WHERE id = '$ID'";
                
                 if(mysqli_query($conn,$Sql_Query))
                {
                 echo 'Record Deleted Successfully';
                }
                else
                {
                 echo 'Something went wrong';
                 }
                 break;
                 
                 /*----------------------------------------------------------- Get service Detail in adapter ----------------------------------------------------*/
            
            
            case 'get_service_detail_in_admin_edit':
 
                         $response = array();
                         if($_POST['id']){
                             $id = $_POST['id'];
                             $stmt = $conn->prepare("SELECT id, sevice_name, details FROM service WHERE id = ?");
                             $stmt->bind_param("s",$id);
                             $result = $stmt->execute();
                           if($result == TRUE){
                                 $response['error'] = false;
                                 $response['message'] = "Retrieval Successful!";
                                 $stmt->store_result();
                                 $stmt->bind_result($id, $sevice_name, $details);
                                 $stmt->fetch();
                                 $response['id'] = $id;
                                 $response['sevice_name'] = $sevice_name;
                                 $response['details'] = $details;
                             } else{
                                 $response['error'] = true;
                                 $response['message'] = "Incorrect id";
                             }
                         } else{
                              $response['error'] = true;
                              $response['message'] = "Insufficient Parameters";
                         }
                         echo json_encode($response);
                         
                         break;
                         
                         /*-------------------------------------------------------------------- Update Services ---------------------------------------------------------------*/
 
            case 'update_service_admin': 
 
             if(isTheseParametersAvailable(array('id'))){
            			
            			$id = $_POST['id'];
                        $sevice_name = $_POST['sevice_name'];
                        $details = $_POST['details'];
            
                        $Sql_Query = "UPDATE service SET sevice_name= '$sevice_name', details = '$details' WHERE id = $id";
            
                        if(mysqli_query($conn,$Sql_Query)){
                         echo 'Service Updated Successfully';
                        } else {
                         echo 'Something went wrong';
                         }
             }else{
             $response['error'] = true; 
             $response['message'] = 'Required param are not available.';
             }
             break;
             
              /*----------------------------------------------------------- Get service name via id ----------------------------------------------------*/
            
            
            case 'get_service_name_via_id':
 
                         $response = array();
                         if($_POST['id']){
                             $id = $_POST['id'];
                             $stmt = $conn->prepare("SELECT id, sevice_name FROM service WHERE id = ?");
                             $stmt->bind_param("s",$id);
                             $result = $stmt->execute();
                           if($result == TRUE){
                                 $response['error'] = false;
                                 $response['message'] = "Retrieval Successful!";
                                 $stmt->store_result();
                                 $stmt->bind_result($id, $sevice_name);
                                 $stmt->fetch();
                                 $response['id'] = $id;
                                 $response['sevice_name'] = $sevice_name;
                             } else{
                                 $response['error'] = true;
                                 $response['message'] = "Incorrect id";
                             }
                         } else{
                              $response['error'] = true;
                              $response['message'] = "Insufficient Parameters";
                         }
                         echo json_encode($response);
                         
                         break;
                         
            /*----------------------------------------------------------- add_block_Dates ----------------------------------------------------*/
             case 'add_block_dates': 
             
            				if (isset($_POST['pid'])) {
            				  $start_date = $_POST['start_date'];
            				  $end_date = $_POST['end_date'];
            				  $status = $_POST['status'];
            				  $pid = $_POST['pid'];
            				  
            				   $response = array();
            				  
            				  $sql = "SELECT start_date, end_date, status, pid FROM block_dates WHERE (start_date = '$start_date' AND end_date = '$end_date' AND pid = '$pid' AND status = '$status')";
            
                                $result = $conn->query($sql);
                                
                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        $response['error'] = true;
                                        $response['message'] = 'This dates is already blocked.';
                                    } else {
                                        $Sql_Query = "insert into block_dates (start_date,end_date,status,pid) values ('$start_date','$end_date','$status','$pid')";
                                if(mysqli_query($conn,$Sql_Query)){
                                
                                $response['error'] = false;
                                $response['message'] = 'Dates blocked successfully';
             
                                }
                                else{
             
                                    $response['error'] = true;
                                    $response['message'] = 'Something went wrong. Please try again';
             
                                }
            				
                                    }
                                } else {
                                    $response['error'] = true;
                                    $response['message'] = 'Error: ' . mysqli_error();
                                }
            				  
             } else {
            					$response['error'] = true;
                                $response['message'] = "Invalid statement";
            				}
            				
            				echo json_encode($response);
             
             break;
             
             /*----------------------------------------------------------- Dates Block_list ----------------------------------------------------*/
			
			case 'dates_block_list':
			//creating a query
	        $stmt = $conn->prepare("SELECT id, start_date, end_date, status, pid FROM block_dates");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $start_date, $end_date, $status, $pid);
	
	        $myservice = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['start_date'] = $start_date; 
		    $temp['end_date'] = $end_date; 
		    $temp['status'] = $status; 
		    $temp['pid'] = $pid; 
		    array_push($myservice, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($myservice);
			break; 
			
			/*----------------------------------------------------------- Delete Block dates ----------------------------------------------------*/
 
                 case 'delete_blockdates':
                			
                			$ID = $_POST['id'];
                
                $Sql_Query = "DELETE FROM block_dates WHERE id = '$ID'";
                
                 if(mysqli_query($conn,$Sql_Query))
                {
                 echo 'Record Deleted Successfully';
                }
                else
                {
                 echo 'Something went wrong';
                 }
                 break;

				 /*----------------------------------------------------------- Add cancellation request ----------------------------------------------------*/
 
					case 'add_new_cancellation_request': 
					
						if (isset($_POST['uid'])) {
						$booking_type = $_POST['booking_type'];
						$booking_id = $_POST['booking_id'];
						$request_note = $_POST['request_note'];
						$uid = $_POST['uid'];
						$practitioner_id = $_POST['practitioner_id'];
						$status = $_POST['status'];
						$create_date = $nowdt;

						$stmt = $conn->prepare("SELECT * FROM cancel_request WHERE booking_type = ? AND booking_id = ?");
						$stmt->bind_param("ss",$booking_type, $booking_id);
						
						$stmt->execute();
						
						$stmt->store_result();
						
						if($stmt->num_rows > 0){
							echo "exist";
						} else {
							$Sql_Query = "insert into cancel_request (booking_type,booking_id,request_note,uid,practitioner_id,status,create_date) values ('$booking_type','$booking_id','$request_note','$uid','$practitioner_id','$status','$create_date')";
							if(mysqli_query($conn,$Sql_Query)){
							echo 'Request added Successfully';

							}
							else{

							echo 'Something went wrong. Please try again';

							}
						}
						} else {
							echo 'Invalid statement';
						}

					break;

					/*----------------------------------------------------------- Get Practitioner id via practitioner name ----------------------------------------------------*/
							case 'get_practitioner_id_vi_name':
										
							$response = array();
							if($_POST['fullname']){

								$fullname = $_POST['fullname'];
								$pieces = explode(" ", $fullname);
							    $fname = $pieces[0];
							    $lname = $pieces[1];
								$firstname = $fname;
								$lastname = $lname;
								$stmt = $conn->prepare("SELECT id FROM practitioner WHERE firstname = ? AND lastname = ?");
								$stmt->bind_param("ss",$firstname,$lastname);
								$result = $stmt->execute();
							if($result == TRUE){
									$response['error'] = false;
									$response['message'] = "Retrieval Successful!";
									$stmt->store_result();
									$stmt->bind_result($id);
									$stmt->fetch();
									$response['id'] = $id;
								} else{
									$response['error'] = true;
									$response['message'] = "Incorrect id";
								}
							} else{
								$response['error'] = true;
								$response['message'] = "Insufficient Parameters";
							}
							echo json_encode($response);

									break;

							/*----------------------------------------------------------- Get cancel status va booking id ----------------------------------------------------*/
							case 'get_cancel_status_via_bid':
												
							$response = array();
							if($_POST['booking_id']){
								$uid = $_POST['uid'];
								$booking_type = $_POST['booking_type'];
								$booking_id = $_POST['booking_id'];
								$stts = "0";
								$stmt = $conn->prepare("SELECT id, status FROM cancel_request WHERE booking_type = ? AND booking_id = ? AND uid = ? AND status = ?");
								$stmt->bind_param("ssss",$booking_type,$booking_id,$uid,$stts);
								$result = $stmt->execute();
							if($result == TRUE){
									$response['error'] = false;
									$response['message'] = "Retrieval Successful!";
									$stmt->store_result();
									$stmt->bind_result($id, $status);
									$stmt->fetch();
									$response['id'] = $id;
									$response['status'] = $status;
								} else{
									$response['error'] = true;
									$response['message'] = "Incorrect id";
								}
							} else{
								$response['error'] = true;
								$response['message'] = "Insufficient Parameters";
							}
							echo json_encode($response);

									break;

					//----------------------------------------- Upload Profile Image -------------------------------------------------------
					case 'update_user_picc':

						if($_SERVER['REQUEST_METHOD']=='POST'){
 
							$id = $_POST['id'];
							$image = $_POST['image'];
					
							$path = "assets/upload/$id.png";
							
							$actualpath = $baseurl."/".$path;
							
							$sql = "UPDATE users SET user_dp = '$actualpath' WHERE id = $id";
							
							if(mysqli_query($conn,$sql)){
							file_put_contents($path,base64_decode($image));
							echo "Successfully Uploaded";
							}
							
							mysqli_close($conn);
							}else{
							echo "Error";
							}

						break;

					/*----------------------------------------------------------- Add new status ----------------------------------------------------*/
 
					case 'add_new_status_u': 
						date_default_timezone_set('Australia/Victoria');
						$curdt = date("j-n-Y");
						$curtme = date('H:i:s');
						if (isset($_POST['title'])) {
						$title = $_POST['title'];
						$body = $_POST['body'];
						$img = $_POST['img'];
						$cat = $_POST['cat'];
						$action = $_POST['action'];
						$uid = $_POST['uid'];
						$sended = $_POST['sended'];
						//$date = $_POST['date'];
						$date = $curdt;
						//$time = $_POST['time'];
						$time = $curtme;
						$status = $_POST['status'];

						$Sql_Query = "insert into notification (title,body,img,cat,action,uid,sended,date,time,status) values ('$title','$body','$img','$cat','$action','$uid','$sended','$date','$time','$status')";
							if(mysqli_query($conn,$Sql_Query)){
							echo 'Notification added Successfully';

							}
							else{

							echo 'Something went wrong. Please try again';

							}
						} else {
							echo 'Invalid statement';
						}

					break;

					/*----------------------------------------------------------- Get All notification with pagination ----------------------------------------------------*/
			
					case 'get_status_via_pagination';
					$uid = $_GET['uid']; 
					$page = $_GET['page']; 
					$start = 0; 
					$limit = 8; 
					$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM notification WHERE uid = '$uid' AND status IN (0,1)"));
					$page_limit = ceil ($total/$limit); 
					if($page<=$page_limit){ 
					$start = ($page - 1) * $limit; 
					$sql = "SELECT * from notification WHERE uid = '$uid' AND status IN (0,1) limit $start, $limit";
					$result = mysqli_query($conn,$sql); 
					$res = array(); 
					while($row = mysqli_fetch_array($result)){
					array_push($res, array(
					"id"=>$row['id'],
					"title"=>$row['title'],
					"body"=>$row['body'],
					"img"=>$row['img'],
					"cat"=>$row['cat'],
					"action"=>$row['action'],
					"uid"=>$row['uid'],
					"sended"=>$row['sended'],
					"date"=>$row['date'],
					"time"=>$row['time'],
					"status"=>$row['status'])
					);
					}
					echo json_encode($res);
					}else{
							echo "over";
					}
				break; 

				/*----------------------------------------------------------- Get List Practitioner ----------------------------------------------------*/
 
				case 'get_practitioner_list_pagination';
					$page = $_GET['page']; 
					$start = 0; 
					$limit = 5; 
					$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM practitioner"));
					$page_limit = ceil ($total/$limit); 
					if($page<=$page_limit){ 
					$start = ($page - 1) * $limit; 
					$sql = "SELECT * from practitioner limit $start, $limit";
					$result = mysqli_query($conn,$sql); 
					$res = array(); 
					while($row = mysqli_fetch_array($result)){
					array_push($res, array(
					"id"=>$row['id'],
					"firstname"=>$row['firstname'],
					"lastname"=>$row['lastname'],
					"email"=>$row['email'],
					"ccode"=>$row['ccode'],
					"mobile"=>$row['mobile'],
					"gender"=>$row['gender'],
					"service_type"=>$row['service_type'],
					"professional_exp"=>$row['professional_exp'],
					"reference"=>$row['reference'],
					"udp"=>$row['udp'],
					"auth"=>$row['auth'],
					"status"=>$row['status'],
					"doj"=>$row['doj'])
					);
					}
					echo json_encode($res);
					}else{
							echo "over";
					}

					break;

				/*----------------------------------------------------------- Delete Notification ----------------------------------------------------*/
					case 'delete_notification';
								
					$ID = $_POST['id'];

					$Sql_Query = "DELETE FROM notification WHERE id = '$ID'";

					if(mysqli_query($conn,$Sql_Query))
						{
							echo 'Deleted Successfully';
						} else {
							echo 'Something went wrong';
						}
					break;

				//----------------------------------------- Notification Status Change -------------------------------------------------------
				case 'change_notification_status_user':

					if($_SERVER['REQUEST_METHOD']=='POST'){

						$id = $_POST['id'];
						$status = $_POST['status'];
						
						$sql = "UPDATE notification SET status = '$status' WHERE id = $id";
						
						if(mysqli_query($conn,$sql)){
						echo "Successfully Updated";
						}
						
						mysqli_close($conn);
						}else{
						echo "Error";
						}

					break;

					/*----------------------------------------------------------- Get Practitioner id via practitioner name ----------------------------------------------------*/
					case 'get_practitioner_id_and_upd_vi_name':
										
						$response = array();
						if($_POST['fullname']){

							$fullname = $_POST['fullname'];
							$pieces = explode(" ", $fullname);
							$fname = $pieces[0];
							$lname = $pieces[1];
							$firstname = $fname;
							$lastname = $lname;
							$stmt = $conn->prepare("SELECT id, email, ccode, mobile, gender, service_type, professional_exp, udp FROM practitioner WHERE firstname = ? AND lastname = ?");
							$stmt->bind_param("ss",$firstname,$lastname);
							$result = $stmt->execute();
						if($result == TRUE){
								$response['error'] = false;
								$response['message'] = "Retrieval Successful!";
								$stmt->store_result();
								$stmt->bind_result($id,$email,$ccode,$mobile,$gender,$service_type,$professional_exp,$udp);
								$stmt->fetch();
								$response['id'] = $id;
								$response['email'] = $email;
								$response['ccode'] = $ccode;
								$response['mobile'] = $mobile;
								$response['gender'] = $gender;
								$response['service_type'] = $service_type;
								$response['professional_exp'] = $professional_exp;
								$response['udp'] = $udp;
							} else{
								$response['error'] = true;
								$response['message'] = "Incorrect id";
							}
						} else{
							$response['error'] = true;
							$response['message'] = "Insufficient Parameters";
						}
						echo json_encode($response);

								break;

				 /*----------------------------------------------------------- Get Message List ----------------------------------------------------*/
 
				case 'get_msg_list';
				$cid = $_GET['cid'];
				$page = $_GET['page'];  
				$start = 0; 
				$limit = 15; 
				$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM msgs WHERE cid = '$cid'"));
				$page_limit = ceil ($total/$limit); 
				if($page<=$page_limit){ 
				$start = ($page - 1) * $limit; 
				$sql = "SELECT * from msgs WHERE cid = '$cid' limit $start, $limit";
				$result = mysqli_query($conn,$sql); 
				$res = array(); 
				while($row = mysqli_fetch_array($result)){
				array_push($res, array(
				"id"=>$row['id'],
				"cid"=>$row['cid'],
				"cat"=>$row['cat'],
				"msg"=>$row['msg'],
				"sid"=>$row['sid'],
				"date"=>$row['date'],
				"time"=>$row['time'],
				"status"=>$row['status'])
				);
				}
				echo json_encode($res);
				}else{
						echo "over";
				}
				break;

				/*----------------------------------------------------------- Get Chat List ----------------------------------------------------*/
 
				case 'get_chat_list';
				$uid = $_GET['uid'];
				$page = $_GET['page'];  
				$start = 0; 
				$limit = 15; 
				$total = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM chat WHERE uid = '$uid'"));
				$page_limit = ceil ($total/$limit); 
				if($page<=$page_limit){ 
				$start = ($page - 1) * $limit; 
				//$sql = "SELECT chat.id , chat.uid, chat.pid , users.user_dp FROM chat , users WHERE chat.uid=users.id limit $start, $limit";
				$sql = "SELECT chat.*, users.*, practitioner.* FROM chat INNER JOIN users ON chat.uid = users.id, INNER JOIN ON chat.pid = practitioner.id WHERE chat.uid = $uid limit $start, $limit";
				//$sql = "SELECT * from chat WHERE uid = '$uid' limit $start, $limit";
				//$sql = "SELECT * from chat WHERE uid = '$uid' limit $start, $limit";
				$result = mysqli_query($conn,$sql); 
				$res = array(); 
				while($row = mysqli_fetch_array($result)){
				array_push($res, array(
				"id"=>$row['id'],
				"uid"=>$row['uid'],
				"user_dp"=>$row['user_dp'],
				"upd"=>$row['upd'],
				"pid"=>$row['pid'])
				);
				}
				echo json_encode($res);
				}else{
						echo "over";
				}
				break;

				/*----------------------------------------------------------- Add Chat User ----------------------------------------------------*/

				case 'add_chat': 

					if (isset($_POST['uid'])) {
						$uid = $_POST['uid'];
						$pid = $_POST['pid'];
						$query = mysqli_query($conn, "SELECT id FROM `chat` WHERE uid='".$uid."' AND pid='".$pid."'");
							if(mysqli_num_rows($query) > 0){
									echo 'Chat Exist';
								}else{
									$Sql_Query = "insert into chat (uid,pid) values ('$uid','$pid')";
											if(mysqli_query($conn,$Sql_Query)){
											echo 'New chat added Successfully';
					
											}
											else{
					
											echo 'Something went wrong. Please try again';
					
											}
								}
						} else {
							echo 'Invalid statement';
						}

					break;

				/*----------------------------------------------------------- Add Messages ----------------------------------------------------*/

				case 'add_message': 
					date_default_timezone_set('Australia/Victoria');
					$curdt = date("j-n-Y");
					$curtme = date('H:i:s');

					if (isset($_POST['cid'])) {
						$cid = $_POST['cid'];
						$cat = $_POST['cat'];
						$msg = $_POST['msg'];
						$sid = $_POST['sid'];
						$date = $_POST['date'];
						$time = $_POST['time'];
						$status = $_POST['status'];
						$Sql_Query = "insert into msgs (cid,cat,msg,sid,date,time,status) values ('$cid','$cat','$msg','$sid','$date','$time','$status')";
											if(mysqli_query($conn,$Sql_Query)){
											echo 'New chat added Successfully';
					
											}
											else{
					
											echo 'Something went wrong. Please try again';
					
											}
						} else {
							echo 'Invalid statement';
						}

					break;
					
 
 default: 
 $response['error'] = true; 
 $response['message'] = 'Invalid Operation Called';
 }
 
 }else{
 $response['error'] = true; 
 $response['message'] = 'Invalid API Call';
 }
 
 echo json_encode($response);
 
 function isTheseParametersAvailable($params){
 
 foreach($params as $param){
 if(!isset($_POST[$param])){
 return false; 
 }
 }
 return true; 
 }