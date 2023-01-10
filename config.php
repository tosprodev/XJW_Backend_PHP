<?
 require_once 'functions.php';
//these are the server details
//the username is root by default in case of xampp
//password is nothing by default
//and lastly we have the database named android. if your database name is different you have to change it 
//Change develoment or live

$BackendMode = "development";

if ( $BackendMode == "development" ) {
    $servername = "localhost";
    $username = "u150691108_test_app";
    $password = "rm#HHE9s9S?";
    $database = "u150691108_test_app";
} else if ( $BackendMode == "live" ) {
    $servername = "localhost";
    $username = "u150691108_app";
    $password = "rm#HHE9s9S?";
    $database = "u150691108_app";

}

//Email Setup
$email_host = 'smtp.hostinger.in';
$email_username = 'app@xjwmobilemassage.com.au';
$email_password = 'Webzone@$5485';
$email_port = 587;

$all_email_send_from = 'app@xjwmobilemassage.com.au';

$app_name = 'XJW Mobile Massage';
$short_app_name = 'XJW';

$baseurl = "https://www.xjwmobilemassage.com.au/app";


 
//creating a new connection object using mysqli 
$conn = new mysqli($servername, $username, $password, $database);
 
//if there is some error connecting to the database
//with die we will stop the further execution by displaying a message causing the error 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo 'Database connected successfully';
}