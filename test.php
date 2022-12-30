<?php 
 $now = time(); // or your date as well
 $your_date = strtotime("31-12-2022");
 $datediff =  $your_date - $now;
 $getdays = round($datediff / (60 * 60 * 24));
 
 if ($getdays == -0) {
    echo "Last Date";
 } else if (strpos($getdays, "-") !== false){
    echo "Expired";
 } else {
    echo $getdays;
 }
 //echo $getdays;