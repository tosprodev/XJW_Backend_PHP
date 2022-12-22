<?php
	include 'inc/head.php';
    $value=$_POST['value'];//getting value sent from ajax
    $sql = "SELECT id, firstname, lastname, status FROM practitioner where gender='".$value."'";//passing in query
    $result = $conn -> query($sql);

    if($result->num_rows > 0){
		?>
		
											<?php
         
        while($row=$result->fetch_assoc()){
			if ($row["firstname"] == "Choose"){
				
			} else {
				if ($row["status"] == "1"){
				echo '<option value="'. $row["id"].'">'. $row["firstname"]." ".$row["lastname"].'</option>';
			} else {
				
                                            
										
        }}}
		?>
		<?php
        
    }
    else{
        
											echo '<option value="">Female practitioner not found!</option>';
											
	
    }

    $conn ->close();



    ?>