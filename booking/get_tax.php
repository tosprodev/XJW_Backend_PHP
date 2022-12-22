<?php
	include 'inc/head.php';
	
	$value1e=$_POST['value1e'];
	$value2e=$_POST['value2e'];

	$sql = "SELECT id, duration, service_id, price, practitioner_id FROM duration where id='".$value2e."' AND service_id='".$value1e."'";
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

				$new_width = ($percentage / 100) * $totalWidth;
			
			
										   echo '<span class="fw-bold">$ '.$new_width.' ('.$tper.' %)</span>';
										   
										
										
        }
		?>
		
		<?php
        
    }
    else{
		
											echo '<span class="fw-bold">$ 00</span>';
					
    }

    //$conn ->close();



    ?>