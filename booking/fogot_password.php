<!-- BEGIN: Head-->
<?php 
$pname = "Forgot Password";
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			header("location: home.php");
			exit;
        }
include 'inc/head.php';?>
<!-- END: Head-->
<?php 
$_SESSION['veremail'] = "";
$_SESSION["veremails"] = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once '../phpmailer/Exception.php';
 require_once '../phpmailer/PHPMailer.php';
 require_once '../phpmailer/SMTP.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty(trim($_POST["email"]))){
        $take_error = "Please enter email.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    } else{
		$email = $_POST['email'];
	}
	
		$email = $_POST['email']; 
		
	if(empty($take_error)){
 
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
		$message = file_get_contents('../email_temp/otp.html'); 
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
		$take_succ = 'OTP has been sended to your regsitered email.';
		$_SESSION["veremail"] = $email; 
		$_SESSION['sweet_status'] = $take_succ;
		$_SESSION['status_code'] = "success";
		$_SESSION['link'] = "otp_verification.php";
		
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
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
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/pages/forgot-password-v2.svg" alt="Forgot password V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Forgot password-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Forgot Password? 🔒</h2>
                                <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>
                                <form class="auth-forgot-password-form mt-2" method="POST" action="<?php echo htmlspecialchars($_SERVER[‘PHP_SELF’]); ?>">
                                    <div class="mb-1">
                                        <label class="form-label" for="forgot-password-email">Email</label>
                                        <input class="form-control" id="forgot-password-email" type="text" name="email" placeholder="john@example.com" aria-describedby="forgot-password-email" autofocus="" tabindex="1" />
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="2">Reset Password</button>
                                </form>
                                <p class="text-center mt-2"><a href="index.php"><i data-feather="chevron-left"></i> Back to login</a></p>
                            </div>
                        </div>
                        <!-- /Forgot password--> 
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
    <script src="app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/auth-forgot-password.js"></script>
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
</body>
<!-- END: Body-->

</html>