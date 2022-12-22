<?php
include 'inc/head.php';
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
 require_once '../functions.php';
 require_once '../config.php';
 //require_once '../phpmailer/Exception.php';
 //require_once '../phpmailer/PHPMailer.php';
 //require_once '../phpmailer/SMTP.php';
 
  require_once '../firebase_notify_js.php';
 
 $nowdt = $cur_date_time;
 $getuid = generateRandomString($length = 10);
 $getauth = generateRandomNumber($length = 6);
 
	 
	 
	 
				  $hf = $_GET['hf'];
				  $fname = $_GET['fname'];
				  $email = $_GET['email'];
				  $dob = $_GET['dob'];
				  $service = $_GET['service'];
				  $practitioner = $_GET['prcttnamex'];
				  $bdate = $_GET['bdate'];
				  $duration = $_GET['duration'];
				  $timeslot = $_GET['timeslot'];
				  $booking_for = $_GET['booking_for'];
				  $recipient = $_GET['recipient'];
				  $address = $_GET['address'];
				  $note = $_GET['note'];
				  $scharge = $_GET['cprice'];
				  $tfee = $_GET['ttax'];
				  $total = $_GET['finalamnt'];
				  $status = $_GET['status'];
				  $payment_status = "1";
				  $transaction_id = "";
				  $invoice_id = "INV-".generateRandomString($length = 2).generateRandomNumber($length = 5);
				  $uid = $_GET['uid'];
				  $remail = "";
				  $uname = "";
				  
				  //echo $hf.$fname.$email.$service.$dob.$id.$healthfundname.$practgender.$prcttnamex.$bdate.$duration.$timeslot.$fname.$bemail.$cprice.$ttax.$finalamnt.$address.$booking_for.$recipient.$note.$status;
				  
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
						 $fcm_apiKey = $_GET['apiKey'];
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
					 $redirect_url = $baseurl."/booking/pay_succ.php";
					 
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
				
?>