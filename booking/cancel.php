<?php
include 'inc/head.php';
$uid = $_GET['id'];
$take_error = "Last transaction has been cancelled.";
					$_SESSION['sweet_status'] = $take_error;
					$_SESSION['status_code'] = "error";
					//$_SESSION['link'] = "home.php";
					$_SESSION['sec'] = "1";
					header("location: new_booking.php");
					
					/*$stmt = $conn->prepare("SELECT id, first_name, last_name, gender, email, c_code, phone, uid, ref_code, user_dp, pssword, doj, auth FROM users WHERE id = ?");
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
							
							$_SESSION['sec'] = "1";
							
							//header("Location: new_booking.php");
							echo 'Login success';
 }*/
?>
