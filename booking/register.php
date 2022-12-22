<!-- BEGIN: Head-->
<?php 
$pname = "Create a new account";
include 'inc/head.php';?>
<!-- END: Head-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$ccode = "61";
	$phone = $_POST['phone'];
	$gender = $_POST['gender'];
	$referral = $_POST['referral'];
	$password = $_POST['password'];
	$cb = $_POST['cb'];
	
	 $first_name = $firstname;
     $last_name = $lastname;
     $gender = $gender; 
     $c_code = $ccode;
     $pssword = md5($_POST['password']);
     $ref_code = $referral; 
	
	if($firstname == ""){
        $take_error = "Please enter first name to continue.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    } else {
		if($lastname == ""){
        $take_error = "Please enter last name to continue.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    } else {
		if($email == ""){
        $take_error = "Please enter email to continue.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
		} else {
			if($phone == ""){
			$take_error = "Please enter phone number to continue.";
			$_SESSION['sweet_status'] = $take_error;
			$_SESSION['status_code'] = "error";
			} else {
				if($password == ""){
				$take_error = "Please enter password to continue.";
				$_SESSION['sweet_status'] = $take_error;
				$_SESSION['status_code'] = "error";
				}else {
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
     else {
		if($cb == ""){
					$take_error = "Please accept terms and conditions.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
					}
	}
					
				}
			}
		}
	}
	}
	
	if(empty($take_error)){

 
 $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ? OR email = ?");
 $stmt->bind_param("ss", $phone, $email);
 $stmt->execute();
 $stmt->store_result();
 
 if($stmt->num_rows > 0){
 $response['error'] = true;
 $response['message'] = 'User already registered with this email or phone';
 $stmt->close();
 }else{
     
   
 
 $sql = "INSERT INTO users (first_name, last_name, gender, c_code, phone, email, uid, ref_code, pssword, doj, auth) VALUES ('$first_name', '$last_name', '$gender', '$c_code', '$phone', '$email', '$uid', '$ref_code', '$pssword', '$nowdt', '$getauth')";

if (mysqli_query($conn, $sql)) {
    
    //fetching the user back 
 $stmt = $conn->prepare("SELECT id, id, id, first_name, last_name, gender, c_code, phone, email, uid, ref_code, pssword, doj, auth FROM users WHERE email = ?"); 
 $stmt->bind_param("s",$email);
 $stmt->execute();
 $stmt->bind_result($userid, $id, $first_name, $last_name, $gender, $c_code, $phone, $email, $uid, $ref_code, $pssword, $doj, $auth);
 $stmt->fetch();
 
 
 
 $stmt->close();
 
 //adding the user data in response 
		$take_succ = 'User registered successfully.';
		$_SESSION["veremail"] = ""; 
		$_SESSION["veremails"] = ""; 
		$_SESSION['sweet_status'] = $take_succ;
		$_SESSION['status_code'] = "success";
		$_SESSION['link'] = "index.php";
} else {
 $take_error = "Something went wrong. Please try again";
 $_SESSION['sweet_status'] = $take_error;
 $_SESSION['status_code'] = "error";
}
 
 
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
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/pages/register-v2.svg" alt="Register V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Register-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Adventure starts here 🚀</h2>
                                <p class="card-text mb-2">Create a new account.</p>
                                <form class="auth-register-form mt-2"  method="POST" action="<?php echo htmlspecialchars($_SERVER[‘PHP_SELF’]); ?>">
									<div class="mb-1">
                                        <label class="form-label" for="firstname">First Name</label>
                                        <input type="text" name="firstname" class="form-control" placeholder="John" aria-describedby="register-username" autofocus="" tabindex="1"/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="lastname">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" placeholder="Doe" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" type="text" name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2" />
                                    </div>
									 <div class="mb-1">
                                            <label class="form-label" for="phone">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">AU (+61)</span>
                                                <input type="text" class="form-control phone-number-mask" name="phone" placeholder="1 234 567 8900" >
                                            </div>
									</div>	
									<div class="mb-1>
									<label class="form-label" for="gender">Choose Gender</label>
									<div class="mb-1" style="margin-top: 10px;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineRadio1" name="gender" value="male" checked="">
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineRadio2" name="gender" value="female">
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="" name="gender" value="other">
                                            <label class="form-check-label" for="inlineRadio2">Other</label>
                                        </div>
                                    </div>
									</div>
									<div class="mb-1">
                                        <label class="form-label" for="referral">Referral Code</label>
                                        <input type="text" class="form-control block-mask" placeholder="UXXX XXX XXX" name="referral" id="blocks">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="register-password" type="password" name="password" placeholder="············" aria-describedby="register-password" tabindex="3" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="register-privacy-policy" type="checkbox" name="cb" value="cb" tabindex="4" />
                                            <label class="form-check-label" for="register-privacy-policy">I agree to<a href="#">&nbsp;privacy policy & terms</a></label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="5">Sign up</button>
                                </form>
                                <p class="text-center mt-2"><span>Already have an account?</span><a href="index.php"><span>&nbsp;Sign in instead</span></a></p>
                            </div>
                        </div>
                        <!-- /Register-->
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
    <!-- END: Page Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
	
    <!-- END: Page JS-->
	<script src="app-assets/js/scripts/forms/form-input-mask.js"></script>
	
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