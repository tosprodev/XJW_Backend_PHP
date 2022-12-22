<?php 

/*$testx = new DateTimeZone('Australia/Victoria');
$gmt = new DateTimeZone('AEST');
$date = new DateTime('2011-12-25 00:00:00', $testx);
$date->setTimezone($gmt);
$cur_date_time = $date->format('Y-m-d H:i:s');*/
date_default_timezone_set('Australia/Victoria');
$cur_date_time = date('d-m-Y h:i:s');

function baseUrl($file=__FILE__){
    $currentFile = array_reverse(explode(DIRECTORY_SEPARATOR,$file))[0];
    if(!empty($_SERVER['QUERY_STRING'])){
        $currentFile.='?'.$_SERVER['QUERY_STRING'];
    }
    $protocol = $_SERVER['PROTOCOL'] == isset($_SERVER['HTTPS']) &&     
                              !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    $url = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = str_replace($currentFile, '', $url);

    return $url;
}

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomNumber($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>