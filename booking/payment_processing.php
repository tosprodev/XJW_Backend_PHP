<?php
$pname = "Payment Processing..";
include 'inc/head.php';
include "vendor/autoload.php";
include "Payment.php";

use Payment\Payment;
$payment = new Payment;

// ?>

<!DOCTYPE html>
<html lang="en">


<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Pay with PayPal</title>

   <!-- Latest compiled and minified CSS -->

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


   <!-- Optional theme -->

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

   <!-- Latest compiled and minified JavaScript -->

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>

   <div class="container">
       <div class="row">
           <div class="col-md-6">

               <form class="form-horizontal" method="POST" action="https://www.sandbox.PayPal.com/cgi-bin/webscr ">
                   <fieldset>

                       <!-- Form Name -->
                       <legend>Pay with PayPal</legend>
                       <!-- Text input-->

                       <div class="form-group">
                           <label class="col-md-4 control-label" for="amount">Payment Amount</label>
                           <div class="col-md-4">
                               <input id="amount" name="amount" type="text" value="<?php echo $_SESSION['finalamnt']; ?>" placeholder="$<?php echo $_SESSION['finalamnt']; ?>" class="form-control input-md" required="" >
                               <span class="help-block">XJW Mobile Massage</span>
                           </div>
                       </div>

                       <input type='hidden' name='business' value='sb-xb1bt19114795@business.example.com'>
                       <input type='hidden' name='item_name' value='<?php echo $_SESSION['service']; ?>'>
                       <input type='hidden' name='item_number' value='<?php echo $_SESSION['service']; ?>'>
                       <!--<input type='hidden' name='amount' value='10'>-->
                       <input type='hidden' name='no_shipping' value='1'>
                       <input type='hidden' name='currency_code' value='AUD'>
                       <input type='hidden' name='notify_url' value='<?php echo $payment->route("notify", "") ?>'>
                       <input type='hidden' name='cancel_return' value='<?php echo $payment->route($baseurl."/booking/cancel.php", "") ?>'>
                       <input type='hidden' name='return' value='<?php echo $payment->route("return", $baseurl."/booking/payment_success.php") ?>'>
                       <input type="hidden" name="cmd" value="_xclick">

                       <!-- Button -->

                       <div class="form-group">
                           <label class="col-md-4 control-label" for="submit"></label>
                           <div class="col-md-4">
                               <button id="submit" name="pay_now" class="btn btn-danger">Pay With PayPal</button>
                           </div>
                       </div>
                   </fieldset>
               </form>
           </div>
       </div>
   </div>
</body>


</html>