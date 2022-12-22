<?php
include 'inc/head.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once '../functions.php';
 require_once '../config.php';
 require_once '../phpmailer/Exception.php';
 require_once '../phpmailer/PHPMailer.php';
 require_once '../phpmailer/SMTP.php';
 //include "../firebase_notify.php";
 require_once '../firebase_notify_js.php';
 
 $nowdt = $cur_date_time;
 $getuid = generateRandomString($length = 10);
 $getauth = generateRandomNumber($length = 6);
 
	/*$serviceid = $_SESSION['service'];
	$hfyesnon = $_SESSION['hfyesnon'];
	$healthfundname = $_SESSION['healthfundname'];
	$practgender = $_SESSION['practgender'];
	$prcttnamex = $_SESSION['prcttnamex'];
	$bdate = $_SESSION['bdate'];
	$duration = $_SESSION['duration'];
	$timeslot = $_SESSION['timeslot'];
	$fname = $_SESSION['fname'];
	$bemail = $_SESSION['bemail'];
	$cprice = $_SESSION['cprice'];
	$ttax = $_SESSION['ttax'];
	$finalamnt = $_SESSION['finalamnt'];
	$address = $_SESSION['address'];*/
	
	$serviceid = $_GET['serviceid'];
	$hfyesnon = $_GET['hfyesnon'];
	$healthfundname = $_GET['healthfundname'];
	$practgender = $_GET['practgender'];
	$prcttnamex = $_GET['prcttnamex'];
	$bdate = $_GET['bdate'];
	$duration = $_GET['duration'];
	$timeslot = $_GET['timeslot'];
	$fname = $_GET['fname'];
	$bemail = $_GET['bemail'];
	$cprice = $_GET['cprice'];
	$ttax = $_GET['ttax'];
	$finalamnt = $_GET['finalamnt'];
	$address = $_GET['address'];
	$uid = $_GET['uid'];
	
	$stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE id = ?");
 $stmt->bind_param("s",$uid);
 $stmt->execute();
 $stmt->store_result();
 if($stmt->num_rows > 0){
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
							session_start();
							$_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["first_name"] = $first_name; 
                            $_SESSION["last_name"] = $last_name;
                            $_SESSION["gender"] = $gender;
                            $_SESSION["email"] = $email; 
                            $_SESSION["c_code"] = $c_code;
                            $_SESSION["phone"] = $phone;
                            $_SESSION["uid"] = $uid;
                            $_SESSION["ref_code"] = $ref_code;
                            $_SESSION["user_dp"] = $user_dp;
                            $_SESSION["pssword"] = $pssword;
                            $_SESSION["doj"] = $doj;
                            $_SESSION["auth"] = $auth;
                            $_SESSION["login_at"] = $nowdt;
							
 }
	
	/*echo $serviceid."<br>";
	echo $hfyesnon."<br>";
	echo $healthfundname."<br>";
	echo $practgender."<br>";
	echo $prcttnamex."<br>";
	echo $bdate."<br>";
	echo $duration."<br>";
	echo $timeslot."<br>";
	echo $fname."<br>";
	echo $bemail."<br>";
	echo $cprice."<br>";
	echo $ttax."<br>";
	echo $finalamnt."<br>";
	echo $address."<br>";*/
	
	
					$sql = "SELECT id, sevice_name FROM service where id=".$serviceid;
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$servicename = $row["sevice_name"];
						//echo $servicename;
						}
					}
					
					$sql = "SELECT id, firstname, lastname FROM practitioner where id=".$prcttnamex;
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$practitioner_name = $row["firstname"]."".$row["lastname"];
						//echo $practitioner_name;
						}
					}
					
					$sql = "SELECT id, duration FROM duration where id=".$duration;
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$myduration = $row["duration"];
						//echo $myduration;
						}
					}
					
					$sql = "SELECT id, time_start, time_sm, time_end, time_em FROM time_slot where id=".$timeslot;
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$mytimeslot = $row["time_start"]." ".$row["time_sm"]." - ".$row["time_end"]." ".$row["time_em"];
						//echo $mytimeslot;
						}
					}
					
					if (empty($hfyesnon)){
						$service = $servicename;
				  $practitioner = $practitioner_name;
				  $bdate = $bdate;
				  $duration = $myduration;
				  $timeslot = $mytimeslot;
				  $booking_for = "Recipient";
				  $recipient = $fname;
				  $address = $address;
				  $note = "";
				  $scharge = $cprice;
				  $tfee = $ttax;
				  $total = $finalamnt;
				  $status = "0";
				  $payment_status = "1";
				  $transaction_id = $PayerID;
				  $invoice_id = "INV-".generateRandomString($length = 2).generateRandomNumber($length = 5);
				  $uid = $_GET['uid'];
				  $remail = $bemail;
				  $uname = $fname;
				  
				  $Sql_Query = "insert into booking (service,practitioner,bdate,duration,timeslot,booking_for,recipient,address,note,scharge,tfee,total,status,payment_status,transaction_id,invoice_id,uid,cur_time) values ('$service','$practitioner','$bdate','$duration','$timeslot','$booking_for','$recipient','$address','$note','$scharge','$tfee','$total','$status','$payment_status','$transaction_id','$invoice_id','$uid','$nowdt')";
                    if(mysqli_query($conn,$Sql_Query)){
					
					//----------------------------------------------------send invoice -----------------------------------
					/*$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        
		$message = file_get_contents('../email_temp/invoice.html'); 
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
        $response['error'] = false; 
        $response['message'] = 'Your booking created successfully'; 
		$take_error = "Your booking created successfully.";
		$_SESSION['sec'] = "1";
		//echo $take_error;
		//echo $response;
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "success";
					$_SESSION['link'] = "home.php";
					//header("location: new_booking.php");
					
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
					 $redirect_url = "booking/new_booking.php";
					 
					 header("Location: ../firebase_notify.php?apiKey=&title=".$getTitle."&body=".$getBody."&topic=".$getTopic."&token=".$getDevice_token."&image_url=".$getImageUrl."&action=&color=&icon=&sound=&r_url=".$redirect_url);
					 
					 /*if ($getTopic == ""){
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
					
					sendFCM($fcm_url, $fcm_apiKey, $getTitle, $getBody, $getImageUrl, $getsend_type, $getTopic, $getDevice_token, $getIcon, $getSound, $getColor, $getAction);*/
				//header("location: new_booking.php");
        //exit();
    /*} catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
		$take_error = $mail->ErrorInfo;
		//echo $take_error;
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
    }*/
	
	//$fcm_apiKey = "";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "success";
					$_SESSION['link'] = "home.php";
					 $getTitle = "New booking for ". $service;
					 $getBody = "You have recieved new booking form ". $uname ."."."\n"."For ".$service."."."\n"."Paid Amount = $".$total."\n"."For date : ". $bdate. "\n". "Timeslot : ".$timeslot ;
					 
					 $getTopic = "xjwpractitioner";
					 $getDevice_token = "";
					 $getImageUrl = "";
					 $getAction = "";
					 $getColor = "";
					 $getIcon = "";
					 $getSound = "";
					 $redirect_url = "bookings.php";
					 
					 /*header("Location: ../firebase_notify.php?apiKey=&title=".$getTitle."&body=".$getBody."&topic=".$getTopic."&token=".$getDevice_token."&image_url=".$getImageUrl."&action=&color=&icon=&sound=&r_url=".$redirect_url);*/
					 
					 
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
					 
	 }else{
 
                    //echo 'Something went wrong. Please try again';
					$take_error = "Something went wrong. Please try again.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
					$_SESSION['link'] = "home.php";
					header("location: new_booking.php");
 
                    }
					} else {
						
				  $service = $servicename;
				  $fullname = $fname;
				  $dob = $bdate;
				  $email = $bemail;
				  $address = $address;
				  $health_provider = $healthfundname;
				  $health_provider_no = generateRandomString($length = 2).generateRandomNumber($length = 4).generateRandomString($length = 1);
				  $practitioner_gender = $practgender;
				  $practitioner = $practitioner_name;
				  $BDate = $bdate;
				  $duration = $myduration;
				  $time_slot = $mytimeslot;
				  $add_req = "";
				  $scharge = $cprice;
				  $tfee = $ttax;
				  $total = $finalamnt;
				  $status = "8";
				  $payment_status = "0";
				  $transaction_id = "";
				  $invoice_id = "INV-".generateRandomString($length = 2).generateRandomNumber($length = 5);
				  $uid = $_SESSION['id'];
				  
				  $pieces = explode(" ", $practitioner_name);
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
				  $Sql_Query = "insert into health_fund_booking (service,fullname,dob,email,address,health_provider,health_provider_no,practitioner_gender,practitioner,BDate,duration,time_slot,add_req,scharge,tfee,total,status,payment_status,transaction_id,invoice_id,uid,cur_time) values ('$service','$fullname','$dob','$email','$address','$health_provider','$health_provider_no','$practitioner_gender','$practitioner','$BDate','$duration','$time_slot','$add_req','$scharge','$tfee','$total','$status','$payment_status','$transaction_id','$invoice_id','$uid','$nowdt')";
                    if(mysqli_query($conn,$Sql_Query)){
						
				  /*$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        
		$message = file_get_contents('../email_temp/invoice_hf.html'); 
		$message = str_replace('%name%', $fullname, $message); 
		$message = str_replace('%bdate%', $BDate, $message);  
		$message = str_replace('%baseurl%', $baseurl, $message); 
		$message = str_replace('%invoice_no%', $invoice_id, $message);  
		$message = str_replace('%health_provider_no%', $health_provider_no, $message);  
		$message = str_replace('%address%', $address, $message);  
		$message = str_replace('%email%', $email, $message); 
		$message = str_replace('%practitioner%', $practitioner, $message); 
		$message = str_replace('%prct_email%', $prct_email, $message); 
		$message = str_replace('%cur_time%', $nowdt, $message); 
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
		$take_error = "Your booking created successfully.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "success";
					$_SESSION['link'] = "home.php";
					
					
					//$fcm_apiKey = "";
					 $getTitle = "New booking for ". $service;
					 $getBody = "You have recieved new booking form ".$fullname." for ".$service.". Paid Amount = ".$total." for date : ". $BDate. ", and timeslot : ".$time_slot ;
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
					
					header("location: new_booking.php");
					$_SESSION['sec'] = "1";
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
		$_SESSION['sweet_status'] = $mail->ErrorInfo;
					$_SESSION['status_code'] = "success";
    }*/
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "success";
					$_SESSION['link'] = "bookinghf.php";
					
					 $getTitle = "New booking for ". $service;
					 $getBody = "You have recieved new booking form ". $uname ."."."\n"."For ".$service."."."\n"."Paid Amount = $".$total."\n"."For date : ". $bdate. "\n". "Timeslot : ".$timeslot ;
					 $getTopic = "xjwpractitioner";
					 $getDevice_token = "";
					 $getImageUrl = "";
					 $getAction = "";
					 $getColor = "";
					 $getIcon = "";
					 $getSound = "";
					 
					 
					 $redirect_url = "new_booking.php";
					 
					 /*header("Location: ../firebase_notify.php?apiKey=&title=".$getTitle."&body=".$getBody."&topic=".$getTopic."&token=".$getDevice_token."&image_url=".$getImageUrl."&action=&color=&icon=&sound=&r_url=".$redirect_url);*/
					 
					 
					 
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
			}
                    else{
 
                    //echo 'Something went wrong. Please try again';
					$take_error = "Something went wrong. Please try again.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
					$_SESSION['link'] = "main.php";
					header("location: new_booking.php");
 
                    }		
						
					}
					
					
?>

