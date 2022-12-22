<?php
	include 'inc/head.php';
    $value=$_POST['value'];//getting value sent from ajax
	//$value = "7";
    $sql = "SELECT id, time_start, time_sm, time_end, time_em, status, durtion_id FROM time_slot where durtion_id='".$value."'";//passing in query
    $result = $conn -> query($sql);

    if($result->num_rows > 0){
		?>
		
											<?php
         
        while($row=$result->fetch_assoc()){
			
			if ($row["status"] == "1") {
			
                                          echo '<option value="'.$row["id"].'">'.$row["time_start"]. " ". $row["time_sm"]." - ".$row["time_end"]. " ". $row["time_em"].'</option>';
										
        }}
		?>
		<?php
        
    }
    else{
											echo '<option value="">Timeslot not found!</option>';
			
    }

    $conn ->close();



    ?>