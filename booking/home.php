<!-- BEGIN: Head-->
<?php 
$pname = "Dashboard";
include 'inc/head.php';
include "vendor/autoload.php";
include "Payment.php";
//include "../firebase_notify.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once '../functions.php';
 require_once '../config.php';
 require_once '../phpmailer/Exception.php';
 require_once '../phpmailer/PHPMailer.php';
 require_once '../phpmailer/SMTP.php';
 
 $nowdt = $cur_date_time;
 $getuid = generateRandomString($length = 10);
 $getauth = generateRandomNumber($length = 6);
 

use Payment\Payment;
$payment = new Payment;
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			
        } else {
			header("location: index.php");
			exit;
		}
		
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			
        } else {
			header("location: index.php");
			exit;
		}
							/*$_SESSION['sec'] = "1";
							$_SESSION['service'] = "";
							$_SESSION['hfyesnon'] = "";
							$_SESSION['healthfundname'] = "";
							$_SESSION['practgender'] = "";
							$_SESSION['prcttnamex'] = "";
							$_SESSION['bdate'] = "";
							$_SESSION['duration'] = "";
							$_SESSION['timeslot'] = "";
							$_SESSION['fname'] = "";
							$_SESSION['bemail'] = "";
							$_SESSION['cprice'] = "";
							$_SESSION['ttax'] = "";
							$_SESSION['finalamnt'] = "";
							$_SESSION['address'] = "";*/
		
		
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$_SESSION['sec'] = "1";
		$service = $_POST['service'];
		$hfyesnon = $_POST['hfyesnon'];
		$healthfundname = $_POST['healthfundname'];
		$practgender = $_POST['practgender'];
		$prcttnamex = $_POST['prcttnamex'];
		$bdate = $_POST['bdate'];
		$duration = $_POST['duration'];
		$timeslot = $_POST['timeslot'];
		$fname = $_POST['fname'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		
		$checknww = $_POST['hfyesnon'];
		
		if(empty($service) OR $service == "Choose Service"){
        $take_error = "Please choose service to continue.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
		//} else if ($service == "9") {
			/*if(empty($hfyesnon) OR $hfyesnon == "Choose"){
			$take_error = "Please choose you have health fund or not to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
			}
			
			if ($hfyesnon == "Yes") {
				if(empty($healthfundname) OR $healthfundname == "Choose Health Provider"){
					$take_error = "Please choose health fund provider to continue.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
				}
			}*/
		} else if (empty($practgender) OR $practgender == "Choose Practitioner Gender"){
			$take_error = "Please choose practitioner gender to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		} else if (empty($prcttnamex) OR $prcttnamex == "Choose Practitioner"){
			$take_error = "Please choose practitioner to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		}else if (empty($bdate)){
			$take_error = "Please choose booking date to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		} else if (empty($duration) OR $duration == "Choose Duration"){
			$take_error = "Please choose duration to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		}else if (empty($timeslot) OR $timeslot == "Choose Timeslot"){
			$take_error = "Please choose timeslot to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		}else if (empty($fname)){
			$take_error = "Please enter fullname to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		}else if (empty($email)){
			$take_error = "Please enter email to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		}else if (empty($address)){
			$take_error = "Please enter address to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		} else {
			
					$sql = "SELECT id, duration, service_id, price, practitioner_id FROM duration where id='".$duration."' AND service_id='".$service."'";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
							$ppricee = $row["price"];}}
					$sql = "SELECT id, percent FROM paypal_charge where id=1";//passing in query
						$result = $conn -> query($sql);
						if($result->num_rows > 0){
							while($row=$result->fetch_assoc()){
								$tper = $row["percent"];
								$totper = $ppricee;
								$percentage = $tper;
								$totalWidth = $totper;
								$percent_total = ($percentage / 100) * $totalWidth;
								$x=$ppricee;  
								$y=$percent_total;  
								$total_amount_to_pay=$x+$y;  
								echo $total_amount_to_pay;}}
								
							session_start();
							$_SESSION['service'] = $service;
							$_SESSION['hfyesnon'] = $hfyesnon;
							$_SESSION['healthfundname'] = $healthfundname;
							$_SESSION['practgender'] = $practgender;
							$_SESSION['prcttnamex'] = $prcttnamex;
							$_SESSION['bdate'] = $bdate;
							$_SESSION['duration'] = $duration;
							$_SESSION['timeslot'] = $timeslot;
							$_SESSION['fname'] = $fname;
							$_SESSION['bemail'] = $email;
							$_SESSION['cprice'] = $ppricee;
							$_SESSION['ttax'] = $percent_total;
							$_SESSION['finalamnt'] = $total_amount_to_pay;
							$_SESSION['address'] = $address;
							$_SESSION['sec'] = "2";
						//header("location : payment_processing.php");
						
						$serviceid = $service;
	$bemail = $email;
	$cprice = $ppricee;
	$ttax = $percent_total;
	$finalamnt = $total_amount_to_pay;
	$address = $_SESSION['address'];
	//$_SESSION['sec'] = "1";
	
	
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
					
					if (empty($hfyesnon)){/*
						//$booktype = "add_booking_with_hf";
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
				  $status = "8";
				  $payment_status = "0";
				  $transaction_id = $PayerID;
				  $invoice_id = "INV-".generateRandomString($length = 2).generateRandomNumber($length = 5);
				  $uid = $_SESSION['id'];
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
		//echo $response;
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "success";
					//$_SESSION['link'] = "index.php";
					//header("location: new_booking.php");
		
        //exit();
    } catch (Exception $e) {
					$response['error'] = true; 
					$response['message'] = $mail->ErrorInfo; 
					$take_error = $mail->ErrorInfo;
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
    }*/
					//--------------------------------------------------End send invoice ---------------------------------
					
                    /*}else{
 
                    //echo 'Something went wrong. Please try again';
					$take_error = "Something went wrong. Please try again.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
					//$_SESSION['link'] = "index.php";
					//header("location: new_booking.php");
 
                    }*/
					} else {
						/*
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
				  $transaction_id = $PayerID;
				  $invoice_id = "INV-".generateRandomString($length = 2).generateRandomNumber($length = 5);
				  $uid = $_SESSION['id'];
				  
				  
					
				  
                  $Sql_Query = "insert into health_fund_booking (service,fullname,dob,email,address,health_provider,health_provider_no,practitioner_gender,practitioner,BDate,duration,time_slot,add_req,scharge,tfee,total,status,payment_status,transaction_id,invoice_id,uid,cur_time) values ('$service','$fullname','$dob','$email','$address','$health_provider','$health_provider_no','$practitioner_gender','$practitioner','$BDate','$duration','$time_slot','$add_req','$scharge','$tfee','$total','$status','$payment_status','$transaction_id','$invoice_id','$uid','$nowdt')";
                    if(mysqli_query($conn,$Sql_Query)){
						
						//Get Practitioner's info
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
							
							$response['message'] = 'Your booking created successfully'; 
		$take_error = "Your booking created successfully.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "success";
	
							//End Paypal Percentage
					
					//----------------------------------------------------send invoice -----------------------------------
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
		$take_error = "Your booking created successfully.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "success";
					//$_SESSION['link'] = "index.php";
					//header("location: new_booking.php");
		
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
		$_SESSION['sweet_status'] = $mail->ErrorInfo;
					$_SESSION['status_code'] = "success";
    }*/
	//echo "Your booking created successfully";
					//--------------------------------------------------End send invoice ---------------------------------
 
                    /*}
                    else{
 
                    //echo 'Something went wrong. Please try again';
					$take_error = "Something went wrong. Please try again.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
					//$_SESSION['link'] = "index.php";
					//header("location: new_booking.php");
 
                    }*/
					}
				
				
	
	}
	}
?>
?>
<style>
.xdcontainer {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
}

.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}
</style>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="" >

<!-- BEGIN: Header-->
    <?php 
	include 'inc/header.php';
	?>
    <!-- END: Header-->
	
    <!-- BEGIN: Main Menu-->
    <?php 
	include 'inc/menu.php';
	?>
    <!-- END: Main Menu-->
	
	
	<!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Bookings</h4>
                            </div>
							<div class="card-body">
                                <a href="booking.php">
								<button type="button" class="btn btn-relief-primary">View All</button>
								</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                            <th>Timeslot</th>
                                            <th>Invoice ID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
									<?php 
	
					/*$sql = "SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking WHERE id='$uid'";
					
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$uname = $row['first_name']." ".$row['last_name'];
						$remail = $row['email'];
						
						}
					}*/
					
					$uid = $_SESSION['id'];
	        $stmta = $conn->prepare("SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking WHERE uid=$uid && status='0' OR status='1' ORDER BY id DESC LIMIT 10");
	
	        //executing the query 
	        $stmta->execute();
	
	        //binding results to the query 
	        $stmta->bind_result($id, $service, $practitioner, $bdate, $duration, $timeslot, $booking_for, $recipient, $address, $note, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	
	        //traversing through all the result 
	        while($stmta->fetch()){
			
			
			if($status == "0") {
				$barcolor = "badge badge-glow bg-primary";
				$bstatus = "Booked";
			} else if($status == "1"){
				$barcolor = "badge badge-glow bg-info";
				$bstatus = "Approved";
			} else if($status == "2"){
				$barcolor = "badge badge-glow bg-success";
				$bstatus = "Completed";
			} else if($status == "3"){
				$barcolor = "badge badge-glow bg-danger";
				$bstatus = "Cancelled";
			} else if($status == "4"){
				$barcolor = "badge badge-glow bg-success";
				$bstatus = "Completed";
			}
			$vid = "";
			$firstname = "";
			$lastname = "";
			$xemail = "";
			$xgender = "";
			$ccode = "";
			$phone = "";
			$doj = "";
			
			
	
	?>
                                    <tbody>
                                        <tr>
                                            <td>
											<i data-feather='user'></i>
	<?php
	if ($booking_for == "Myself"){
				$client_name = $_SESSION['first_name']." ".$_SESSION['last_name'];
				$vid = $_SESSION['id'];
				$firstname = $_SESSION['first_name'];
				$lastname = $_SESSION['last_name'];
				$xemail = $_SESSION['email'];
				$xgender = $_SESSION['gender'];
				$ccode = $_SESSION['c_code'];
				$phone = $_SESSION['phone'];
				$doj = $_SESSION['doj'];
				?>
				
				<?php include 'inc/user_model.php';?>
				
				<?php
			} else {
					$client_name = $recipient;
					echo $client_name;
					/*$uid = $_SESSION['id']; 
					$pieces = explode(" ", $recipient);
					$fname = $pieces[0];
					$lname = $pieces[1];
					 $sqlx = "SELECT id, firstname, lastname, email, ccode, phone, relation, gender, nftt, uid FROM recipient WHERE firstname='$fname' && lastname='$lname' && uid='$uid'.";
					
					$result = $conn->query($sqlx);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						
							$vid = $row['id'];
							$firstname = $row['firstname'];
							$lastname = $row['lastname'];
							$xemail = $row['email'];
							$xgender = $row['gender'];
							$ccode = $row['ccode'];
							$phone = $row['phone'];
							$doj = "";
							?>
				
							<?php include 'inc/user_model.php';?>
				
							<?php
							
						}
					} else {
						echo 'Not fetched';
					}*/
			}
	?>
                                                
                                            </td>
                                            <td><?php echo $service;?></td>
											<td><?php echo $bdate;?></td>
                                            <td><?php echo $duration;?></td>
                                            <td><?php echo $timeslot;?></td>
                                            <td>
											<div class="modal-size-lg d-inline-block">
											<button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#<?php echo $invoice_id;?>">
                                                <i data-feather='paperclip'></i> <?php echo $invoice_id;?>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade text-start" id="<?php echo $invoice_id;?>" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Invoice - <?php echo $invoice_id;?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="xdcontainer"> 
																<iframe class="responsive-iframe" src="..//invoice/invoice.php?invoice_id=<?php echo $invoice_id;?>"></iframe>
															</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
											</td>
											<td>
												<span class="<?php echo $barcolor;?>"><?php echo $bstatus;?></span>
											</td>
                                            <td>
											<?php 
											if ($bstatus == "Completed") {
												
											} else if ($bstatus == "Cancelled"){
													
												} else {
													
												?>
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="inc/php_actions/cancel_booking.php?id=<?php echo $id;?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                            <span>Cancel</span>
                                                        </a>
                                                    </div>
													<?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
									<?php }?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
				
				<!-- Completed Status -->
				
				<div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Bookings with health fund</h4>
                            </div>
							<div class="card-body">
                                <a href="bookinghf.php">
								<button type="button" class="btn btn-relief-primary">View All</button>
								</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                            <th>Timeslot</th>
                                            <th>Invoice ID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
									<?php 
	
					/*$sql = "SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking WHERE id='$uid'";
					
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$uname = $row['first_name']." ".$row['last_name'];
						$remail = $row['email'];
						
						}
					}*/
					
					$uidx = $_SESSION['id'];
	        $stmta = $conn->prepare("SELECT id, service, fullname, dob, email, address, health_provider, health_provider_no, practitioner_gender, practitioner, BDate, duration, time_slot, add_req, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM health_fund_booking WHERE uid=$uidx && status='0' OR status='1' ORDER BY id DESC LIMIT 10");
	
	        //executing the query 
	        $stmta->execute();
	
	        //binding results to the query 
	        $stmta->bind_result($id, $service, $fullname, $dob, $email, $address, $health_provider, $health_provider_no, $practitioner_gender, $practitioner, $BDate, $duration, $time_slot, $add_req, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	
	        //traversing through all the result 
	        while($stmta->fetch()){
			
			
			if($status == "0") {
				$barcolor = "badge badge-glow bg-primary";
				$bstatus = "Booked";
			} else if($status == "1"){
				$barcolor = "badge badge-glow bg-info";
				$bstatus = "Approved";
			} else if($status == "2"){
				$barcolor = "badge badge-glow bg-success";
				$bstatus = "Completed";
			} else if($status == "3"){
				$barcolor = "badge badge-glow bg-danger";
				$bstatus = "Cancelled";
			} else if($status == "4"){
				$barcolor = "badge badge-glow bg-success";
				$bstatus = "Completed";
			}
			$client_name = $fullname;
			
			
	
	?>
                                    <tbody>
                                        <tr>
                                            <td>
											<i data-feather='user'></i>
												<?php echo $client_name;?>
                                            </td>
                                            <td><?php echo $service;?></td>
											<td><?php echo $BDate;?></td>
                                            <td><?php echo $duration;?></td>
                                            <td><?php echo $time_slot;?></td>
                                            <td>
											<div class="modal-size-lg d-inline-block">
											<button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#<?php echo $invoice_id;?>">
                                                <i data-feather='paperclip'></i> <?php echo $invoice_id;?>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade text-start" id="<?php echo $invoice_id;?>" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Invoice - <?php echo $invoice_id;?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="xdcontainer"> 
																<iframe class="responsive-iframe" src="..//invoice/invoice.php?invoice_id=<?php echo $invoice_id;?>"></iframe>
															</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
											</td>
											<td>
												<span class="<?php echo $barcolor;?>"><?php echo $bstatus;?></span>
											</td>
                                            <td>
											<?php 
											if ($bstatus == "Completed") {
												
											} else if ($bstatus == "Cancelled"){
													
												} else {
													
												?>
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="inc/php_actions/cancel_booking_hf.php?id=<?php echo $id;?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                            <span>Cancel</span>
                                                        </a>
                                                    </div>
													<?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
									<?php }?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
				
				<!-- Completed Status -->

            </div>
        </div>
    </div>
    
    <!-- add new card modal  -->
<div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-sm-5 mx-50 pb-5">
        <h1 class="text-center mb-1" id="addNewCardTitle">Create New Booking.</h1>
            <form class="form form-vertical" id="form1" method="POST" action="<?php echo htmlspecialchars($_SERVER[‘PHP_SELF’]); ?>">
                                        <div class="row">
										<div class="col-12">
										<div class="mb-1">
                                        <label class="form-label" for="modalEditUserStatus">Choose Service</label>
                                        <select id="service_name" name="service" id="services" class="form-select" aria-label="Default select example" aria-invalid="false">
                                            <option selected="">Choose Service</option>
											<?php 
												$uid = $_SESSION['id'];
	        $stmta = $conn->prepare("SELECT id, sevice_name FROM service ORDER BY id DESC");
	
	        //executing the query 
	        $stmta->execute();
	
	        //binding results to the query 
	        $stmta->bind_result($id, $sevice_name);
	
	
	        //traversing through all the result 
	        while($stmta->fetch()){
				
			if ($sevice_name == "Choose Service") {
				
			} else {
											?>
                                            <option value="<?php echo $id;?>"><?php echo $sevice_name;?></option>
                                        
			<?php }}?>
										</select>
										</div>
										</div>
										
										<div class="col-12" id="dyhhf">
										<div class="mb-1">
                                        <label class="form-label" for="modalEditUserStatus">Do you have health fund?</label>
                                        <select id="hfyesno" name="hfyesnon" class="form-select" aria-label="Default select example" aria-invalid="false">
                                            <option value="" selected="">Choose</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
										</select>
										</div>
										</div>
										
										<?php
										//if () {?>
											
											<div class="col-12" id="hfname">
										<div class="mb-1">
                                        <label class="form-label" for="modalEditUserStatus">Choose Health Provider</label>
                                        <select id="hpname" name="healthfundname" class="form-select" aria-label="Default select example" aria-invalid="false">
                                            <option value="" selected="">Choose Health Provider</option>
											<?php 
	        $stmta = $conn->prepare("SELECT id, name, status FROM healt_provider ORDER BY id DESC");
	
	        //executing the query 
	        $stmta->execute();
	
	        //binding results to the query 
	        $stmta->bind_result($id, $name, $status);
	
	
	        //traversing through all the result 
	        while($stmta->fetch()){
				
			if ($name == "Choose Health Provider") {
				
			} else if ($status == "1"){
											?>
                                            <option value="<?php echo $name;?>"><?php echo $name;?></option>
                                        
			<?php }}?>
										</select>
										</div>
										</div>
										
										<?php// }
										?>
										
										<div class="col-12" id="pgender">
										<div class="mb-1">
                                        <label class="form-label" for="modalEditUserStatus">Choose Practitioner Gender</label>
                                        <select id="prgender" name="practgender" class="form-select" aria-label="Default select example" aria-invalid="false">
                                            <option selected="">Choose Practitioner Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
										</select>
										</div>
										</div>
										
										<div class="col-12" id="prctnmebx">
										<div class="mb-1">
                                        <label class="form-label" for="modalEditUserStatus">Choose Practitioner</label>
										<select id="prcttname" name="prcttnamex" class="form-select" aria-label="Default select example" aria-invalid="false">
                                            <option selected="">Choose Practitioner</option>
											<optgroup id="showprct" label="Practitioner List">
											</select>
										</div>
										</div>
										
										<div class="col-12" id="bdatebx">
										<div class="mb-1">
                                    <label class="form-label" for="fp-default">Choose Booking Date</label>
                                    <input type="text" id="fp-default" name="bdate" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
									</div>
                                </div>
								
								<div class="col-12" id="durationbx">
										<div class="mb-1">
                                        <label class="form-label" for="modalEditUserStatus">Choose Duration</label>
										<select id="selduration" name="duration" class="form-select" aria-label="Default select example" aria-invalid="false">
                                            <option selected="">Choose Duration</option>
											<optgroup id="showdurat" label="Duration List">
											</select>
                                        
										</div>
										</div>
								
								<div class="col-12" id="timesltbx">
										<div class="mb-1">
                                        <label class="form-label" for="modalEditUserStatus">Choose Timeslot</label>
                                        <select id="timeslotbx" name="timeslot" class="form-select" aria-label="Default select example" aria-invalid="false">
                                            <option selected="">Choose Timeslot</option>
											<optgroup id="showtimeslot" label="Timeslot List">
											</select>
										</div>
										</div>
								
                                            <div class="col-12">
                                                <div class="mb-1" id="firstnamebx">
                                                    <label class="form-label" for="first-name-vertical">Full Name</label>
                                                    <input type="text" id="firstname" class="form-control" name="fname" value="<?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?>" placeholder="<?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?>" />
                                                </div>
                                            </div>
                                            <div class="col-12" id="emailbx">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email-id-vertical">Email</label>
                                                    <input type="email" id="email" class="form-control" name="email" value="<?php echo $_SESSION['email'];?>" placeholder="Email" />
                                                </div>
                                            </div>
                                            <div class="col-12" id="phonebx">
                                                <div class="mb-1">
                                                    <label class="form-label" for="contact-info-vertical">Mobile</label>
                                                    <input type="number" id="phone" class="form-control" name="phone" value="<?php echo "+ ".$_SESSION['c_code']." ".$_SESSION['phone'];?>" placeholder="<?php echo "+ ".$_SESSION['c_code']." ".$_SESSION['phone'];?>" />
                                                </div>
                                            </div>
											<div class="col-12" id="addressbx">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-vertical">Full Address</label>
                                                    <input type="text" id="address" class="form-control" name="address" placeholder="Full Address" />
                                                </div>
                                            </div>
											<div class="col-12" id="pricebx">
                                                    <div class="card-body invoice-padding pt-0">
                                    <div class="row invoice-spacing">
                                        <div class="col-xl-8 p-0">
                                            <h6 class="mb-2"></h6>
                                            
                                        </div>
                                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                            <h6 class="mb-2">Payment Details:</h6>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="pe-1">Price:</td>
                                                        <td id="pricetxt"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pe-1">Tax:</td>
                                                        <td id="taxtx"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pe-1">Total:</td>
                                                        <td id="totalprc"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                            </div>
                                            <div class="col-12">
												<button class="btn btn-primary w-100" tabindex="3">Book Now</button>
                                            </div>
                                        </div>
                                    </form>
										<!--<form class="form-horizontal" id="form2" method="POST" action="https://www.sandbox.PayPal.com/cgi-bin/webscr ">-->
										<form class="form-horizontal" id="form2" method="POST" action="https://www.paypal.com/cgi-bin/webscr">
										   <fieldset>

											   <!-- Form Name -->
											   <legend>Pay with PayPal</legend>
											   <!-- Text input-->

											   <div class="form-group">
												   <label class="col-md-6 control-label" for="amount"><strong>Amount to pay : $ <?php echo $_SESSION['finalamnt']; ?></strong></label>
												   <div class="col-md-6">
													   <input id="amount" type="hidden" name="amount" type="text" value="<?php echo $_SESSION['finalamnt']; ?>" placeholder="$<?php echo $_SESSION['finalamnt']; ?>" class="form-control input-md" required="">
													   <!--<span class="help-block">XJW Mobile Massage</span>-->
												   </div>
											   </div>


											   <input type='hidden' name='business' value='peterwang65131@gmail.com'>
											   <!--<input type='hidden' name='business' value='sb-xb1bt19114795@business.example.com'>-->
											   <input type='hidden' name='item_name' value='<?php echo $_SESSION['service']; ?>'>
											   <input type='hidden' name='item_number' value='<?php echo $_SESSION['service']; ?>'>
											   <!--<input type='hidden' name='amount' value='10'>-->
											   <!--<input type='hidden' name='no_shipping' value='1'>-->
											   <input type='hidden' name='currency_code' value='AUD'>
											   <input type="hidden" name="lc" value="AU">
											   <input type="hidden" name="rm" value="2">
											   <input type="hidden" name="cbt" value="Return to The Store">
											   <input type="hidden" name="cancel_return" value="<?php echo $baseurl ?>/booking/cancel.php?uid=<?php echo $_SESSION['id'];?>">
											   <input type="hidden" name="return" value="<?php echo $baseurl ?>/booking/payment_success.php?serviceid=<?php echo $_SESSION['service'];?>&hfyesnon=<?php echo $_SESSION['hfyesnon'];?>&healthfundname=<?php echo $_SESSION['healthfundname'];?>&practgender=<?php echo $_SESSION['practgender'];?>&prcttnamex=<?php echo $_SESSION['prcttnamex'];?>&bdate=<?php echo $_SESSION['bdate'];?>&duration=<?php echo $_SESSION['duration'];?>&timeslot=<?php echo $_SESSION['timeslot'];?>&fname=<?php echo $_SESSION['fname'];?>&bemail=<?php echo $_SESSION['bemail'];?>&cprice=<?php echo $_SESSION['cprice'];?>&ttax=<?php echo $_SESSION['ttax'];?>&finalamnt=<?php echo $_SESSION['finalamnt'];?>&address=<?php echo $_SESSION['address'];?>&uid=<?php echo $_SESSION['id'];?>" >
											   
												
											   <input type="hidden" name="cmd" value="_xclick">

											   <!-- Button -->

											   <div class="form-group">
												   <label class="col-md-6 control-label" for="submit"></label>
												   <div class="col-md-6">
													   <button id="submit" name="pay_now" class="btn btn-danger">Pay Now</button>
												   </div>
											   </div>
										   </fieldset>
										</form>
      </div>
    </div>
  </div>
</div>
<!--/ add new card modal  -->
										
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <!--<div class="drag-target"></div>-->

    <!-- BEGIN: Footer-->
    <?php include 'inc/footer.php';?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <script src="app-assets/js/scripts/pages/app-invoice-list.js"></script>
    <!-- END: Page JS-->
	
	<!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/components/components-modals.js"></script>
    <!-- END: Page JS-->
	
	<!-- Sweetalert2 JS -->
	<script src="app-assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="app-assets/js/scripts/pages/modal-edit-user.js"></script>
	
	<script type="module">
  import Swal from 'app-assets/js/plugins/sweetalert2/sweetalert2.min.js'
</script>

<?php
		if(isset($_SESSION['sweet_status']) && $_SESSION['sweet_status'] !='')
		{
			?>
			
			<script>
				Swal.fire({
  title: "<?php echo $_SESSION['sweet_status']; ?>",
  icon: "<?php echo $_SESSION['status_code'];?>",
  confirmButtonText: `Ok`,
  allowOutsideClick: false,
}).then((result) => {
  if (result.isConfirmed) {
    <?php
					if(empty($_SESSION['link'])){
						
					} else {?>
						window.location = "<?php echo $_SESSION['link'];?>";
						<?php
					}
					
					?>
  }
})
			</script>
			<?php
			unset($_SESSION['sweet_status']);
            unset($_SESSION['link']);
            unset($_SESSION['status_code']);
		}
		?>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

<!-- BEGIN: Page Vendor JS-->
	<script src="app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
    <!-- END: Page Vendor JS-->
    
    
    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <script src="app-assets/js/scripts/pages/app-invoice-list.js"></script>
    <!-- END: Page JS-->
	
	<!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/components/components-modals.js"></script>
    <!-- END: Page JS-->
	
	<!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->
	
	<!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/forms/form-select2.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.min.js"></script>
    <script src="app-assets/js/core/app.min.js"></script>
    <script src="app-assets/js/scripts/customizer.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/modal-add-new-cc.min.js"></script>
    <script src="app-assets/js/scripts/pages/page-pricing.min.js"></script>
    <script src="app-assets/js/scripts/pages/modal-add-new-address.min.js"></script>
    <script src="app-assets/js/scripts/pages/modal-create-app.min.js"></script>
    <script src="app-assets/js/scripts/pages/modal-two-factor-auth.min.js"></script>
    <script src="app-assets/js/scripts/pages/modal-edit-user.min.js"></script>
    <script src="app-assets/js/scripts/pages/modal-share-project.min.js"></script>
    <!-- END: Page JS-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $(window).on('load', function() {
        $('#addNewCard').modal('show');
    });
</script>

	<script>
jQuery(document).ready(function($){
	$('#dyhhf').hide();
	$('#hfname').hide();
	$('#pgender').hide();
	$('#prctnmebx').hide();
	$('#bdatebx').hide();
	$('#durationbx').hide();
	$('#timesltbx').hide();
	$('#firstnamebx').hide();
	$('#emailbx').hide();
	$('#phonebx').hide();
	$('#addressbx').hide();
	$('#pricebx').hide();
	$('#form2').hide();
	
	<?php
		if ($_SESSION['sec'] == "2") {
			?>
			$('#form2').show();
			$('#form1').hide();
			<?php
		} else {
			?>
			$('#form2').hide();
			$('#form1').show();
			<?php
		}
	?>
	
    $('#service_name').on('change', function(e){
        
        if($(this).val() != 'Choose Service') {
			
             
          if($(this).val() != '9'){
				$('#dyhhf').hide();
				if($(this).val() != 'Choose Service') {
				$('#pgender').show();
				} else {
					$('#pgender').hide();
					$('#prctnmebx').hide();
					$('#bdatebx').hide();
					$('#durationbx').hide();
					$('#timesltbx').hide();
					$('#firstnamebx').hide();
					$('#emailbx').hide();
					$('#phonebx').hide();
					$('#addressbx').hide();
				}
			} else {
				$('#dyhhf').show(); 
				$('#pgender').hide();
			}
        } else {
            if($(this).val() != 'Remedial Massage'){
				$('#dyhhf').hide();
				if($(this).val() != 'Choose Service') {
				$('#pgender').show();
				} else {
					$('#pgender').hide();
					$('#prctnmebx').hide();
					$('#bdatebx').hide();
					$('#durationbx').hide();
					$('#timesltbx').hide();
					$('#firstnamebx').hide();
					$('#emailbx').hide();
					$('#phonebx').hide();
					$('#addressbx').hide();
				}
			} else {
				$('#dyhhf').show();
				$('#pgender').hide();
			}
          
        }
				

    });
	
	
	$('#hpname').on('change', function(e){
		if($(this).val() != 'Choose Health Provider') {
			$('#pgender').show();
			
		} else {
			$('#pgender').hide();
		}
	});
	
	$('#prgender').on('change', function(e){
		if($(this).val() != 'Choose Practitioner Gender') {
			$('#prctnmebx').show();
			
			$(document).ready(function () {
     //$(".btn").click(function () {
            //var value= $(this).val();//getting value of select box with class="select"
			var value = document.getElementById('prgender').value;
            $.ajax({
                url: 'get_pract.php',
                method: 'POST',
                data: {value : value},//sending value to yourphppage
                     success:function(data){

                $("#showprct").html(data);//here response from server will be display
                }
              });
            //});
         });
		 
		} else {
			$('#prctnmebx').hide();
		}
	});
	
	$('#hfyesno').on('change', function(e){
		if($(this).val() != 'Choose Practitioner') {
			$('#hfname').show();
			
		} else {
			$('#hfname').hide();
		}
	});
	
	$('#prcttname').on('change', function(e){
		if($(this).val() != 'Choose Practitioner') {
			$('#bdatebx').show();
			
		} else {
			$('#bdatebx').hide();
		}
	});
	
	$('#fp-default').on('change', function(e){
		if($(this).val() != '') {
			$('#durationbx').show();
			var value1 = document.getElementById('service_name').value;
			var value2 = document.getElementById('prcttname').value;
            $.ajax({
                url: 'get_duration.php',
                method: 'POST',
                data: {value1 : value1, value2 : value2},//sending value to yourphppage
                     success:function(data){

                $("#showdurat").html(data);//here response from server will be display
				/*var value = document.getElementById('selduration').value;
			
            $.ajax({
                url: 'get_timeslot.php',
                method: 'POST',
                data: {value : value},//sending value to yourphppage
                     success:function(data){

                $("#showtimeslot").html(data);//here response from server will be display
				$('#timesltbx').show();
                }
              });*/
				
			
                }
              });
			
		} else {
			$('#durationbx').hide();
		}
	});
	
	$('#selduration').on('change', function(e){
		
		if($(this).val() != 'Choose Duration') {
			$('#timesltbx').show();
			var value = document.getElementById('selduration').value;
            $.ajax({
                url: 'get_timeslot.php',
                method: 'POST',
                data: {value : value},//sending value to yourphppage
                     success:function(data){

                $("#showtimeslot").html(data);//here response from server will be display
				
                }
              });
			  

			
		} else {
			$('#timesltbx').hide();
		}
	});
	
	$('#timeslotbx').on('change', function(e){
		if($(this).val() != 'Choose Timeslot') {
				$('#firstnamebx').show();
				$('#emailbx').show();
				$('#phonebx').show();
				$('#addressbx').show();
				$('#pricebx').show();
				

				var value1x = document.getElementById('service_name').value;
				var value2x = document.getElementById('selduration').value;
            $.ajax({
                url: 'get_price.php',
                method: 'POST',
                data: {value1x : value1x, value2x : value2x},//sending value to yourphppage
                     success:function(data){

                $("#pricetxt").html(data);//here response from server will be display
				
                }
              });
				
				var value1e = document.getElementById('service_name').value;
				var value2e = document.getElementById('selduration').value;
            $.ajax({
                url: 'get_tax.php',
                method: 'POST',
                data: {value1e : value1e, value2e : value2e},//sending value to yourphppage
                     success:function(data){

                $("#taxtx").html(data);//here response from server will be display
				
                }
              });
			  
			  
			  var value1a = document.getElementById('service_name').value;
				var value2a = document.getElementById('selduration').value;
            $.ajax({
                url: 'get_total_price.php',
                method: 'POST',
                data: {value1a : value1a, value2a : value2a},//sending value to yourphppage
                     success:function(data){

                $("#totalprc").html(data);//here response from server will be display
				
                }
              });
			
		} else {
			$('#firstnamebx').hide();
				$('#emailbx').hide();
				$('#phonebx').hide();
				$('#addressbx').hide();
				$('#pricebx').hide();
		}
	});
	
});
</script>

</html>