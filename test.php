<?php 
require 'PhpOffice/autoload.php';
require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
$spreadsheet = new Spreadsheet(); 
$sheet = $spreadsheet->getActiveSheet(); 
//$uid = $_GET['uid'];
			$mtable = 'booking';
			//echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `booking`");
			$sql="select count('id') from '$mtable'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$temp_tc = "$row[0]";

			$frst = $temp_tc;
			$snd = 1;
			$tc = $frst + $snd;
			echo $tc;
			/*$ssql = "SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM $mtable ORDER BY id DESC";
	        $stmt = $conn->prepare($ssql);
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $practitioner, $bdate, $duration, $timeslot, $booking_for, $recipient, $address, $note, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	        $data_from_db = array(); 
	
	        //traversing through all the result 
	        while($stmt->fetch()){
	    	$temp = array();
	    	$temp['id'] = $id; 
		    $temp['service'] = $service; 
		    $temp['practitioner'] = $practitioner; 
		    $temp['bdate'] = $bdate; 
		    $temp['duration'] = $duration; 
		    $temp['timeslot'] = $timeslot; 
		    $temp['booking_for'] = $booking_for; 
		    $temp['recipient'] = $recipient; 
		    $temp['address'] = $address; 
		    $temp['note'] = $note; 
		    $temp['scharge'] = $scharge; 
		    $temp['tfee'] = $tfee; 
		    $temp['total'] = $total; 
		    $temp['status'] = $status; 
		    $temp['payment_status'] = $payment_status; 
		    $temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $invoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($data_from_db, $temp);
	        }
//$highestRow = $this->spreadsheet->getActiveSheet()->getHighestRow();
//$data_from_db[$tc]=array("id"=>"","service"=>"","practitioner"=>"","duration"=>"","timeslot"=>"","booking_for"=>"","recipient"=>"","address"=>"","note"=>"","scharge"=>"","tfee"=>"","total"=>"","payment_status"=>"","transaction_id"=>"","invoice_id"=>"","uid"=>"","cur_time"=>"This is Total");

//set column header
//set your own column header
$column_header=["id","Service","Practitioner","Booking Date","Duration","Timeslot","Booking For","Recipient","Address","Note","Service Charge","Status","Transaction Fee","Total","Payment Status","Transaction Id","Invoice Id","User Id","Create At"];
$j=1;
foreach($column_header as $x_value) {
		$sheet->setCellValueByColumnAndRow($j,1,$x_value);
  		$j=$j+1;
  		
	}

//set value row
for($i=0;$i<count($data_from_db);$i++)
{

//set value for indi cell
$row=$data_from_db[$i];

$j=1;

	foreach($row as $x => $x_value) {
		$sheet->setCellValueByColumnAndRow($j,$i+2,$x_value);
  		$j=$j+1;
	}

}

// Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the files directory 
$writer->save('demo.xlsx');
header("location : demo.xlsx") ;*/

?>