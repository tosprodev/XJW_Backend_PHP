<!-- BEGIN: Head-->
<?php 
$pname = "OTP Verification";
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			header("location: home.php");
			exit;
        }
include 'inc/head.php';?>
<!-- END: Head-->
<?php 

if ($_SESSION['veremail'] == ""){
	header("location: index.php");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$fst = $_POST['first'];
$snd = $_POST['second'];
$trd = $_POST['third'];
$frth = $_POST['fourth'];
$fvth = $_POST['fifth'];
$sxth = $_POST['sixth'];
$myotp = $fst.$snd.$trd.$frth.$fvth.$sxth;
	if($fst == ""){
        $take_error = "Please enter valid OTP.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    }
	
	if($snd == ""){
        $take_error = "Please enter valid OTP.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    }
	
	if($trd == ""){
        $take_error = "Please enter valid OTP.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    }
	
	if($frth == ""){
        $take_error = "Please enter valid OTP.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    }
	
	if($fvth == ""){
        $take_error = "Please enter valid OTP.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    }
	
	if($sxth == ""){
        $take_error = "Please enter valid OTP.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    }
	
	if(empty($take_error)){
		$email = $_SESSION['veremail']; 
 
 $stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $first_name, $last_name, $gender, $email, $c_code, $phone, $uid, $ref_code, $user_dp, $pssword, $doj, $auth);
 $stmt->fetch();
 
    if($myotp == $auth) {
		$take_succ = 'OTP Verified Successfully. Click ok to change password.';
		$_SESSION["veremail"] = ""; 
		$_SESSION["veremails"] = $email; 
		$_SESSION['sweet_status'] = $take_succ;
		$_SESSION['status_code'] = "success";
		$_SESSION['link'] = "change_password.php";
    } else {
		$take_error = "You have entered an invalid or expired OTP.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    }
    
 }else{
		$take_error = "You have entered an invalid email.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
 }
	}
}

?>

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo--><a class="brand-logo" href="index.php">
                            
                            <h2 class="brand-text text-primary ms-1"><?php echo $app_name;?></h2>
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/illustration/two-steps-verification-illustration.svg" alt="two steps verification" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- two steps verification v2-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bolder mb-1">Two Step Verification &#x1F4AC;</h2>
                                <p class="card-text mb-75">We sent a verification code to your email. Enter the code from the email in the field below.</p>
                                <p class="card-text fw-bolder mb-2"><?php echo $_SESSION['veremail']; ?></p>
                                <form class="mt-2" method="POST" action="<?php echo htmlspecialchars($_SERVER[‘PHP_SELF’]); ?>">
                                    <h6>Type your 6 digit security code</h6>
                                    <div class="auth-input-wrapper d-flex align-items-center justify-content-between">
                                        <input class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" type="text" name="first" maxlength="1" autofocus="" />
                                        <input class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" type="text" name="second" maxlength="1" />
                                        <input class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" type="text" name="third" maxlength="1" />
                                        <input class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" type="text" name="fourth" maxlength="1" />
                                        <input class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" type="text" name="fifth" maxlength="1" />
                                        <input class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" type="text" name="sixth" maxlength="1" />
                                    </div>
                                    <button class="btn btn-primary w-100" type="submit" tabindex="4">Verify OTP</button>
                                </form>
                                <p class="text-center mt-2"><span>Didn&rsquo;t get the code?</span><a href="fogot_password.php"><span>&nbsp;Resend</span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/auth-two-steps.js"></script>
    <!-- END: Page JS-->
	
	<!-- Sweetalert2 JS -->
	<script src="app-assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>
	
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
	
	<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "User created!",
            text: "Suceess message sent!!",
            icon: "success",
            button: "Ok",
            timer: 2000
        });
    });
</script>

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

</html>