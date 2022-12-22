<!-- BEGIN: Head-->
<?php 
$pname = "Set New Password";
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			header("location: home.php");
			exit;
        }
include 'inc/head.php';?>
<!-- END: Head-->
<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once '../phpmailer/Exception.php';
 require_once '../phpmailer/PHPMailer.php';
 require_once '../phpmailer/SMTP.php';

if ($_SESSION["veremails"] == ""){
	header("location: index.php");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$password = $_POST['password'];
$cnfPassword = $_POST['cnfPassword'];
	if($password == ""){
        $take_error = "Please enter password to continue.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    } else {
		if($cnfPassword == ""){
        $take_error = "Please enter confirm password to continue.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    } else {
		if ($password == $cnfPassword) {
			if(!empty($_POST["password"]) && isset( $_POST['cnfPassword'] )) {
    $password = $_POST["password"];
    $cpassword = $_POST["cnfPassword"];
    if (mb_strlen($_POST["password"]) <= 7) {
        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
		$take_error = $passwordErr;
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
		$take_error = $passwordErr;
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
		$take_error = $passwordErr;
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
		$take_error = $passwordErr;
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
    }
    elseif(!preg_match("#[\W]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Special Character!";
		$take_error = $passwordErr;
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
    } 
    elseif (strcmp($password, $cpassword) !== 0) {
        $passwordErr = "Passwords must match!";
		$take_error = $passwordErr;
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
    }
} else {
    $passwordErr = "Please enter password   ";
			$take_error = $passwordErr;
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
}
		} else {
			$take_error = "Password and Confirm password does not matched.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
		}
	}
	}
	


if(empty($take_error)){
	$newpassword = md5($_POST['password']);
 $email = $_SESSION["veremails"];
 
 //-----------------------------------------
 
					

 
 $stmt = $conn->prepare("SELECT id, auth FROM users WHERE email = ?");
 $stmt->bind_param("s",$email);
 
 $stmt->execute();
 
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 
 $stmt->bind_result($id, $auth);
 $stmt->fetch();
 
            $Sql_Query = "UPDATE users SET pssword = '$newpassword', auth = '$getauth' WHERE id = $id";

             if(mysqli_query($conn,$Sql_Query))
            {
             $response['error'] = false; 
             
             
			 $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        
		$message = file_get_contents('../email_temp/password_changed.html'); 
		
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
		$take_succ = 'Your password has been changed successfully.';
		$_SESSION["veremail"] = ""; 
		$_SESSION["veremails"] = ""; 
		$_SESSION['sweet_status'] = $take_succ;
		$_SESSION['status_code'] = "success";
		$_SESSION['link'] = "index.php";
        //exit();
    } catch (Exception $e) {
        $response['error'] = true; 
        $response['message'] = $mail->ErrorInfo; 
    }
			  
            }
            else
            {
			  $take_error = "Something went wrong..";
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
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/pages/reset-password-v2.svg" alt="Register V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Reset password-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Reset Password 🔒</h2>
                                <p class="card-text mb-2">Your new password must be different from previously used passwords</p>
                                <form class="auth-reset-password-form mt-2" method="POST" action="<?php echo htmlspecialchars($_SERVER[‘PHP_SELF’]); ?>">
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="reset-password-new">New Password</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="reset-password-new" type="password" name="password" placeholder="············" aria-describedby="reset-password-new" autofocus="" tabindex="1" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="reset-password-confirm">Confirm Password</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="reset-password-confirm" type="password" name="cnfPassword" placeholder="············" aria-describedby="reset-password-confirm" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="3">Set New Password</button>
                                </form>
                                <p class="text-center mt-2"><a href="index.php"><i data-feather="chevron-left"></i> Back to login</a></p>
                            </div>
                        </div>
                        <!-- /Reset password-->
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
    <script src="app-assets/js/scripts/pages/auth-reset-password.js"></script>
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