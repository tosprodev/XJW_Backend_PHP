<?php 
 $now = time(); // or your date as well
 $your_date = strtotime("31-12-2023");
 $datediff =  $your_date - $now;
 
 echo round($datediff / (60 * 60 * 24));