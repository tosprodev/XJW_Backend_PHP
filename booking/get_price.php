<?php
	include 'inc/head.php';
    $value1x=$_POST['value1x'];
	$value2x=$_POST['value2x'];
	$sql = "SELECT id, duration, service_id, price, practitioner_id FROM duration where id='".$value2x."' AND service_id='".$value1x."'";//passing in query
    $result = $conn -> query($sql);

    if($result->num_rows > 0){
		?>
		
											<?php
         
        while($row=$result->fetch_assoc()){
			
				
			
			
										   echo '<span class="fw-bold">$ '.$row["price"].'</span>';
										   
										
										
        }
		?>
		
		<?php
        
    }
    else{
		
											echo '<span class="fw-bold">$ 00</span>';
					
    }

    $conn ->close();



    ?>