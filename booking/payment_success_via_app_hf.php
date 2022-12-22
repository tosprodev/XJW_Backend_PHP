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
 
 //--------------------------------------------------- Booking with health Fund -------------------------------
					
					
					$hf = $_GET['hf'];
				  $fname = $_GET['fname'];
				  $email = $_GET['email'];
				  $dob = $_GET['dob'];
				  $service = $_GET['service'];
				  $practitioner_gender = $_GET['practgender'];
				  $practitioner = $_GET['prcttnamex'];
				  $BDate = $_GET['bdate'];
				  $healthfundname = $_GET['healthfundnamex'];
				  $health_provider_no = generateRandomString($length = 2).generateRandomNumber($length = 4).generateRandomString($length = 1);
				  $duration = $_GET['duration'];
				  $time_slot = $_GET['timeslot'];
				  $booking_for = $_GET['booking_for'];
				  $recipient = $_GET['recipient'];
				  $address = $_GET['address'];
				  $add_req = $_GET['note'];
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
				  
				  
					
				  
                  $Sql_Query = "insert into health_fund_booking (service,fullname,dob,email,address,health_provider,health_provider_no,practitioner_gender,practitioner,BDate,duration,time_slot,add_req,scharge,tfee,total,status,payment_status,transaction_id,invoice_id,uid,cur_time) values ('$service','$fname','$dob','$email','$address','$healthfundname','$health_provider_no','$practitioner_gender','$practitioner','$BDate','$duration','$time_slot','$add_req','$scharge','$tfee','$total','$status','$payment_status','$transaction_id','$invoice_id','$uid','$nowdt')";
                    if(mysqli_query($conn,$Sql_Query)){
						
						//Get Practitioner's info
							/*$pieces = explode(" ", $practitioner);
							$fname = $pieces[0];
							$lname = $pieces[1];
							$sql = "SELECT id, firstname, lastname, email, ccode, mobile FROM practitioner WHERE firstname='$fname' && lastname='$lname'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
								$prct_email = $row['email'];
								}
							}*/
							
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
					 $getBody = "You have recieved new booking form ". $fname ."."."\n"."For ".$service."\n"."Paid Amount = $".$total."\n"."Date : ". $BDate. "\n"."Timeslot : ".$time_slot ;
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