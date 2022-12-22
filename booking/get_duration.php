<?php
	include 'inc/head.php';
    $value1=$_POST['value1'];//getting value sent from ajax
	$value2=$_POST['value2'];
	$value3=$_POST['value3'];
    //$sql = "SELECT id, duration, service_id, price, practitioner_id FROM duration where service_id='".$value1."' AND practitioner_id='".$value2."'";
	$sql = "SELECT id, duration, service_id, price, practitioner_id FROM duration where service_id='".$value1."'";//passing in query
    $result = $conn -> query($sql);

    if($result->num_rows > 0){
		?>
		
											<?php
         
        while($row=$result->fetch_assoc()){
			
				
			
			
                                           echo '<option value="'. $row["id"].'">' .$row["duration"].'</option>';
										
										
        }
		?>
		
		<?php
        
    }
    else{
		
											echo '<option value="">Duation not found!</option>';
					
    }

    $conn ->close();



    ?>