<?php 
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
 require_once 'functions.php';
 require_once 'config.php';
 //require_once 'phpmailer/Exception.php';
 //require_once 'phpmailer/PHPMailer.php';
 //require_once 'phpmailer/SMTP.php';
 
 /*service
 id
 sevice_name
 
 duration
 duration
 service_id
 price*/
			
/*	$query = "SELECT service.*, duration.* 
          FROM id 
          INNER JOIN duration ON service.id = duration.service_id 
          WHERE service.id = 5";
          
          $query = "SELECT tbl1.*, tbl2.* 
          FROM tbl1 
          INNER JOIN tbl2 ON tbl1.id = tbl2.id 
          WHERE tbl1.column = value "*/
          
          //$query = "SELECT duration.id, duration.duration, duration.service_id, duration.price, service.id, service.sevice_name 
          //FROM duration, service WHERE duration.service_id = service.id"; 
          //INNER JOIN service ON duration.service_id = service.id";
          
          
          //SELECT * FROM brand INNER JOIN product ON brand.brand_id = product.brand_id
          
         //creating a query
			//$uid = $_GET['uid'];
	        //$stmt = $conn->prepare("SELECT * FROM service INNER JOIN duration ON service.id = duration.service_id");
	        
	        $sql = "SELECT * FROM service INNER JOIN duration ON service.id = duration.service_id";  
 $result = mysqli_query($conn, $sql);  
 
 if(mysqli_num_rows($result) > 0)  
                          {  
                              $mybooking = array();
                               while($row = mysqli_fetch_array($result))  
                               {  
                          
 
	    	$temp = array();
	    	//$temp['id'] = $id; 
		    $temp['sevice_name'] = $row["sevice_name"]; 
		    $temp['price'] = $row["price"]; 
		    array_push($mybooking, $temp);
	        
	
	        //displaying the result in json format 
            echo json_encode($mybooking);

}}
 
	        
	        
	
	        //executing the query 
	       /* $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($sevice_name);
	
	        $mybooking = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	//$temp['id'] = $id; 
		    $temp['sevice_name'] = $sevice_name; 
		    array_push($mybooking, $temp);
	        }
	
	        //displaying the result in json format 
            echo json_encode($mybooking);*/