<!-- BEGIN: Head-->
<?php 
$pname = "Login";
include 'inc/head.php';
$_SESSION["veremail"] = ""; 
$_SESSION["veremails"] = ""; 
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			header("location: home.php");
			exit;
        }
?>
<!-- END: Head-->

<?php 
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
 // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $take_error = "Please enter email.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    } else{
        $email = $_POST['email'];
		// Check if password is empty
    if(empty(trim($_POST["pssword"]))){
        $take_error = "Please enter your password.";
        $_SESSION['sweet_status'] = $take_error;
		$_SESSION['status_code'] = "error";
    } else{
        $password = md5($_POST['pssword']);
    }
    }
	
	 $email = $_POST['email'];
	 $password = md5($_POST['pssword']);
    
    
	
	if(empty($take_error)){
		$stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE email = ? AND pssword = ?");
 $stmt->bind_param("ss",$email, $password);
 
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
 
 $take_succ = "Login Successful. ";
 $_SESSION['sweet_status'] = $take_succ;
 $_SESSION['status_code'] = "success";
 $_SESSION['link'] = "home.php";
 
 }else{ 
 $take_error = "Invalid username or password";
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
                        <!-- Brand logo--><a class="brand-logo" href="#">
                            
                            <h2 class="brand-text text-primary ms-1">XJW Mobile Massage</h2>
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Welcome to XjW Mobile Massage! 馃憢</h2>
                                <p class="card-text mb-2">Please sign-in to your account.
                                </p>
                                <form class="auth-login-form mt-2" method="POST" action="<?php echo htmlspecialchars($_SERVER[‘PHP_SELF’]); ?>">
                                    <div class="mb-1">
                                        <label class="form-label" for="login-email">Email</label>
                                        <input class="form-control" id="login-email" type="text" name="email" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" />
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password">Password</label><a href="fogot_password.php"><small>Forgot Password?</small></a>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password" type="password" name="pssword" placeholder="路路路路路路路路路路路路" aria-describedby="login-password" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                            <label class="form-check-label" for="remember-me"> Remember Me</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                                </form>
                                <p class="text-center mt-2"><span>New on our platform?</span><a href="register.php"><span>&nbsp;Create an account</span></a></p>
                            </div>
                        </div>
                        <!-- /Login-->
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
    <script src="app-assets/js/scripts/pages/auth-login.js"></script>
    <!-- END: Page JS-->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
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