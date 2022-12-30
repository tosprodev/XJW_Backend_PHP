<?php 
 $now = time(); // or your date as well
 $your_date = strtotime("30-12-2022");
 $datediff = $now - $your_date;
 
 echo round($datediff / (60 * 60 * 24));