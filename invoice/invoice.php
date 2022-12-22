<!DOCTYPE html>
<html class="no-js" lang="en">



<?php
require_once '../config.php';

if(isset($_GET['invoice_id'])) {
	
	$inv_no = $_GET['invoice_id'];
	
	$comefm = "";
	
	//Paypal Percentage
	
						$sql = "SELECT id, percent FROM paypal_charge";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
								$paypalpercent = $row['percent'];
								}
							}
	
	//End Paypal Percentage
	
	$sql = "SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking WHERE invoice_id='$inv_no'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$comefm = "1";
		$service = $row['service'];
		$practitioner = $row['practitioner'];
		$BDate = $row['bdate'];
		$duration = $row['duration'];
		$time_slot = $row['timeslot'];
		$booking_for = $row['booking_for'];
		$recipient = $row['recipient'];
		$address = $row['address'];
		$note = $row['note'];
		$scharge = $row['scharge'];
		$tfee = $row['tfee'];
		$total = $row['total'];
		$status = $row['status'];
		$payment_status = $row['payment_status'];
		$transaction_id = $row['transaction_id'];
		$invoice_id = $row['invoice_id'];
		$uid = $row['uid'];
		$cur_time = $row['cur_time'];
		
		
					//Get Name
				  
				  $sql = "SELECT id, first_name, last_name, email FROM users WHERE id='$uid'";
					$result = $conn->query($sql);

					if (empty($recipient)){
					  $sql = "SELECT id, first_name, last_name, email FROM users WHERE id='$uid'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$name = $row['first_name']." ".$row['last_name'];
						$email = $row['email'];
						}
					}
				  } else {
					 $pieces = explode(" ", $recipient);
					$fname = $pieces[0];
					$lname = $pieces[1];
					$uid = "22";
					$sql = "SELECT id, firstname, lastname, email, ccode, phone, relation, gender, nftt, uid FROM recipient WHERE firstname='$fname' && lastname='$lname' && uid='$uid'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$name = $row['firstname']." ".$row['lastname'];
						$email = $row['email'];
						}
					}
				  }
					//End Get Name
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
						
			}
				} else {
					
					// Checking record in health fund booking
					$sql = "SELECT id, service, fullname, dob, email, address, health_provider, health_provider_no, practitioner_gender, practitioner, BDate, duration, time_slot, add_req, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM health_fund_booking WHERE invoice_id='$inv_no'";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$comefm = "2";
						$bid = $row['id'];
						$service = $row['service'];
						$name = $row['fullname'];
						$dob = $row['dob'];
						$email = $row['email'];
						$address = $row['address'];
						$health_provider = $row['health_provider'];
						$health_provider_no = $row['health_provider_no'];
						$practitioner_gender = $row['practitioner_gender'];
						$practitioner = $row['practitioner'];
						$BDate = $row['BDate'];
						$duration = $row['duration'];
						$time_slot = $row['time_slot'];
						$add_req = $row['add_req'];
						$scharge = $row['scharge'];
						$tfee = $row['tfee'];
						$total = $row['total'];
						$payment_status = $row['payment_status'];
						$transaction_id = $row['transaction_id'];
						$uid = $row['uid'];
						$cur_time = $row['cur_time'];
						
						
							//Get Practitioner's info
							$pieces = explode(" ", $practitioner);
							$fname = $pieces[0];
							$lname = $pieces[1];
							//$uid = "22";
							$sql = "SELECT id, firstname, lastname, email, ccode, mobile FROM practitioner WHERE firstname='$fname' && lastname='$lname'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
								$prct_email = $row['email'];
								}
							}
							
							//End Getting Practitioner's info
						
							}
								} else {
									echo "No Record Found.";
									exit;
							}
				}
    
} else {
    echo '<h2>Invalid Call. Nothing is here for you please go back</h2>';
	exit;
}

?>
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title><?php echo $inv_no;?> |XJW Mobile Massage Invoice</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="../assets/logo.png" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f50 tm_text_uppercase tm_white_color">Invoice</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
          </div>
          <div class="tm_invoice_info tm_mb25">
            <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Payment Method: </b>PayPal</div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0">Invoice No: <b><?php echo $inv_no;?></b></p>
              <p class="tm_invoice_date tm_m0">Date: <b><?php echo $BDate;?></b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg"></div>
          </div>
		  <?php 
		  if ($comefm == "2") {?>
		  <div class="tm_invoice_head tm_m10" >
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">ABN No.:</b></p>
              <p>
			  51661006159
              </p>
            </div>
            <!--<div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">Provider No:</b></p>
              <p>
				<?php echo //$health_provider_no;?><br>
              </p>
            </div>-->
          </div>
		  <?php }?>
		  
		  <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Invoice To:</b></p>
              <p>
			  <?php echo $name;?><br>
			  <?php if ($comefm == "2") {?>
			  DOB : <?php echo $dob;?><br><?php }?>
				<?php echo $address;?><br>
			    <?php echo $email;?> <br>
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">Pay To:</b></p>
              <p>
				<?php echo $practitioner;?><br>
				U2 5 FIRTH STREET, <?php if ($comefm == "2") {?><br><?php }?>DONCASTER, VIC. 3108<br>
                <?php echo $prct_email;?> <br>
              </p>
            </div>
          </div>
		  
		  <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">DATE OF TREATMENT:</b></p>
              <p>
			  <?php echo $BDate;?><br>
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">BOOKING AT:</b></p>
              <p>
				<?php echo $cur_time;?><br>
              </p>
            </div>
          </div>
          <div class="tm_table tm_style1">
            <div class="">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr class="tm_accent_bg">
                      <th class="tm_width_3 tm_semi_bold tm_white_color">Item</th>
                      <th class="tm_width_4 tm_semi_bold tm_white_color">Duration</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color">Price</th>
                      <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="tm_width_3"><?php echo $service;?></td>
                      <td class="tm_width_4"><?php echo $duration;?></td>
                      <td class="tm_width_2">$<?php echo $scharge;?></td>
                      <td class="tm_width_1">1</td>
                      <td class="tm_width_2 tm_text_right">$<?php echo $scharge;?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer">
                <p class="tm_mb2"><b class="tm_primary_color">Booked Timeslot:</b></p>
                <p class="tm_m0"><?php echo $time_slot;?> </p>
              </div>
              <div class="tm_right_footer">
                <table class="tm_mb15">
                  <tbody>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Subtoal</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">$<?php echo $scharge;?></td>
                    </tr>
                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_primary_color">Tax <span class="tm_ternary_color">(<?php echo $paypalpercent;?>%)</span></td>
                      <td class="tm_width_3 tm_primary_color tm_text_right">$<?php echo $tfee;?></td>
                    </tr>
                    <tr class="tm_accent_bg">
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total	</td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">$<?php echo $total;?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_type1">
              <div class="tm_left_footer"></div>
              <div class="tm_right_footer">
                <div class="tm_sign tm_text_center">
                  <img src="../assets/signature.png" alt="Sign">
                  <p class="tm_m0 tm_ternary_color"><?php echo $practitioner;?></p>
                  <p class="tm_m0 tm_f16 tm_primary_color">Practitioner</p>
                </div>
              </div>
            </div>
          </div>
          <!--<div class="tm_note tm_text_center tm_font_style_normal">
            <hr class="tm_mb15">
            <p class="tm_mb2"><b class="tm_primary_color">Terms & Conditions:</b></p>
            <p class="tm_m0">All claims relating to quantity or shipping errors shall be waived by Buyer unless made in writing to <br>Seller within thirty (30) days after delivery of goods to the address stated.</p>
          </div><!-- .tm_note -->
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/jspdf.min.js"></script>
  <script src="js/html2canvas.min.js"></script>
  <!--<script src="js/main.js"></script>-->
  <script>
   /* *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** ***
  /////////////////   Down Load Button Function   /////////////////
  *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** */
 
(function ($) {
  'use strict';

  $('#tm_download_btn').on('click', function () {
    var downloadSection = $('#tm_download_section');
    var cWidth = downloadSection.width();
    var cHeight = downloadSection.height();
    var topLeftMargin = 0;
    var pdfWidth = cWidth + topLeftMargin * 2;
    var pdfHeight = pdfWidth * 1.5 + topLeftMargin * 2;
    var canvasImageWidth = cWidth;
    var canvasImageHeight = cHeight;
    var totalPDFPages = Math.ceil(cHeight / pdfHeight) - 1;

    html2canvas(downloadSection[0], { allowTaint: true }).then(function (
      canvas
    ) {
      canvas.getContext('2d');
      var imgData = canvas.toDataURL('image/png', 1.0);
      var pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
      pdf.addImage(
        imgData,
        'PNG',
        topLeftMargin,
        topLeftMargin,
        canvasImageWidth,
        canvasImageHeight
      );
      for (var i = 1; i <= totalPDFPages; i++) {
        pdf.addPage(pdfWidth, pdfHeight);
        pdf.addImage(
          imgData,
          'PNG',
          topLeftMargin,
          -(pdfHeight * i) + topLeftMargin * 0,
          canvasImageWidth,
          canvasImageHeight
        );
      }
      pdf.save('<?php echo $inv_no;?>.pdf');
    });
  });

})(jQuery);
  </script>
</body>
</html>

<? php 



?>