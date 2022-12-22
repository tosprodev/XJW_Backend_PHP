<?php
session_start();
require_once '../../../functions.php';
 require_once '../../../config.php';
			$id = $_GET['id'];
            $status = "3";
echo $id;
            $Sql_Query = "UPDATE booking SET status = '$status' WHERE id = $id";

            if(mysqli_query($conn,$Sql_Query)){
			 $take_succ = "Booking Cancelled Successfully. ";
			 $_SESSION['sweet_status'] = $take_succ;
			 $_SESSION['status_code'] = "success";
			 $_SESSION['link'] = "home.php";
			 header("Location: ../../");
            } else {
			 $take_error = "Something went wrong";
			 $_SESSION['sweet_status'] = $take_error;
			 $_SESSION['status_code'] = "error";
			 header("Location: ../../");
             }

?>