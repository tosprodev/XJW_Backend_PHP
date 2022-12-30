<?php 
 $now = time(); // or your date as well
 $your_date = strtotime("31-12-2023");
 $datediff = $now - $your_date;
 
 echo round($datediff / (60 * 60 * 24));