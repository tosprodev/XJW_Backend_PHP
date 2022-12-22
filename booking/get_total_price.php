<?php
	include 'inc/head.php';
	
	$value1a=$_POST['value1a'];
	$value2a=$_POST['value2a'];

	$sql = "SELECT id, duration, service_id, price, practitioner_id FROM duration where id='".$value2a."' AND service_id='".$value1a."'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$ppricee = $row["price"];
						
						}
					}
	
	$sql = "SELECT id, percent FROM paypal_charge where id=1";//passing in query
    $result = $conn -> query($sql);
	
	

    if($result->num_rows > 0){
         
        while($row=$result->fetch_assoc()){
			
				$tper = $row["percent"];
				$totper = $ppricee;
				
				$percentage = $tper;
				$totalWidth = $totper;

				$percent_total = ($percentage / 100) * $totalWidth;
				
				$x=$ppricee;  
				$y=$percent_total;  
				$z=$x+$y;  
				 
			
			
										   echo '<span class="fw-bold">$ '.$z.'</span>';
										   
										
										
        }
		?>
		
		<?php
        
    }
    else{
		
											echo '<span class="fw-bold">$ 00</span>';
					
    }

    //$conn ->close();



    ?>