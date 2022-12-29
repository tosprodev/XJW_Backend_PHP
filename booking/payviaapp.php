<?php 
$pname = "Payment";
include 'inc/head.php';
include "vendor/autoload.php";
include "Payment.php";
//include "../firebase_notify.php";

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
 require_once '../functions.php';
 require_once '../config.php';
 //require_once '../phpmailer/Exception.php';
 //require_once '../phpmailer/PHPMailer.php';
// require_once '../phpmailer/SMTP.php';
 
 $nowdt = $cur_date_time;
 $getuid = generateRandomString($length = 10);
 $getauth = generateRandomNumber($length = 6);
 

use Payment\Payment;
$payment = new Payment;

$hf = $_GET['hf'];
$email = $_GET['email'];
$dob = $_GET['dob'];
$service = $_GET['service'];
$id = $_GET['id'];
$healthfundnamex = $_GET['healthfundname'];
$hfyesnon = $_GET['hfyesnon'];
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

$booking_for = $_GET['booking_for'];
$recipient = $_GET['recipient'];
$note = $_GET['note'];
$status = $_GET['status'];
$filenm = $_GET['filenm'];

//echo $healthfundnamex.$practgender;
//echo $hf.$fname.$email.$service.$dob.$id.$healthfundname.$practgender.$prcttnamex.$bdate.$duration.$timeslot.$fname.$bemail.$cprice.$ttax.$finalamnt.$address.$booking_for.$recipient.$note.$status;
?>


<html>

<style>
    body {
        background: white;
		padding-right: 5em;
		}
    section {
		background: #F8E4E4;
        color: black;
        border-radius: 1em;
        padding: 2em;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%) }
  </style>
  
<style>

h5 {
    position: relative;
    color: rgba(66, 114, 245, .3);
    font-size: 2em
}
h5:before {
    content: attr(data-text);
    position: absolute;
    overflow: hidden;
    max-width: 2em;
    white-space: nowrap;
    color: #4272f5;
    animation: loading 8s linear;
}
@keyframes loading {
    0% {
        max-width: 0;
    }
}
</style>
<section>
										<form class="form-horizontal" id="form2" method="POST" action="https://www.sandbox.PayPal.com/cgi-bin/webscr ">
										<!--<form class="form-horizontal" id="form2" method="POST" action="https://www.paypal.com/cgi-bin/webscr">-->
										   <fieldset>

											   <!-- Form Name -->
											   <legend>Pay with PayPal</legend>
											   <!-- Text input-->

											   <div class="form-group">
												   <label class="col-md-6 control-label" for="amount"><strong>Amount to pay : $ <?php echo $finalamnt; ?></strong></label>
												   <div class="col-md-6">
													   <input id="amount" type="hidden" name="amount" type="text" value="<?php echo $finalamnt; ?>" placeholder="$<?php echo $finalamnt; ?>" class="form-control input-md" required="">
													   <!--<span class="help-block">XJW Mobile Massage</span>-->
												   </div>
											   </div>
												<input type='hidden' name='business' value='sb-xb1bt19114795@business.example.com'>
											   <!--<input type='hidden' name='business' value='peterwang65131@gmail.com'>-->
											   <input type='hidden' name='item_name' value='<?php echo $service; ?>'>
											   <input type='hidden' name='item_number' value='<?php echo $service; ?>'>
											   <!--<input type='hidden' name='amount' value='10'>
											   <input type='hidden' name='no_shipping' value='1'>-->
											   <input type='hidden' name='currency_code' value='AUD'>
											   <input type="hidden" name="lc" value="AU">
											   <input type="hidden" name="rm" value="2">
											   <input type="hidden" name="cbt" value="Return to The Store">
											   <input type="hidden" name="cancel_return" value="<?php echo $baseurl ?>/booking/payment_failed.php">
											   <input type="hidden" name="return" value="<?php echo $baseurl ?>/booking/<?php echo $filenm;?>?hf=<?php echo $hf;?>&service=<?php echo $service;?>&hfyesnon=<?php echo $hfyesnon;?>&healthfundnamex=<?php echo $healthfundnamex;?>&practgender=<?php echo $practgender;?>&prcttnamex=<?php echo $prcttnamex;?>&bdate=<?php echo $bdate;?>&duration=<?php echo $duration;?>&timeslot=<?php echo $timeslot;?>&fname=<?php echo $fname;?>&bemail=<?php echo $bemail;?>&cprice=<?php echo $cprice;?>&ttax=<?php echo $ttax;?>&finalamnt=<?php echo $finalamnt;?>&address=<?php echo $address;?>&uid=<?php echo $id;?>&booking_for=<?php echo $booking_for;?>&recipient=<?php echo $recipient;?>&note=<?php echo $note;?>&status=<?php echo $status;?>&fname=<?php echo $fname;?>&email=<?php echo $email;?>&dob=<?php echo $dob;?>" >
											   
												
											   <input type="hidden" name="cmd" value="_xclick">
											   
											   <!-- Button -->
											   
											   <h5 data-text="Redirecting to Paypal...">Redirecting to Paypal...</h5>
											   <p>If not redirect autometically to paypal within 5 second then click on Pay Now button below.</p>

											   <div class="form-group">
												   <label class="col-md-6 control-label" for="submit"></label>
												   <div class="col-md-6">
													   <button id="submit" name="pay_now" class="btn btn-success">Pay Now</button>
												   </div>
											   </div>
										   </fieldset>
										</form>
										</section>
										<script>
										window.onload = function(){
  document.getElementById('submit').click();
  
var scriptTag = document.createElement("script");
scriptTag.src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js";
document.getElementsByTagName("head")[0].appendChild(scriptTag);
}
										</script>
</html>