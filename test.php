<?php 
 $now = time(); // or your date as well
 $your_date = strtotime("29-12-2022");
 $datediff =  $your_date - $now;
 
 echo round($datediff / (60 * 60 * 24));