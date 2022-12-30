<?php 
 //$now = time(); // or your date as well
 //$your_date = strtotime("29-12-2022");
// $datediff =  $your_date - $now;
// $getdays = round($datediff / (60 * 60 * 24));
/*if (str_contains($getdays, '-')) {
    echo "Expired";
 } else if ($getdays == "0"){
    echo "Last Date";
 } else {
    echo "Expired";
 }*/
 $string = 'The lazy fox jumped over the fence';

if (str_contains($string, 'lazy')) {
    echo "The string 'lazy' was found in the string\n";
}
 //echo $getdays;