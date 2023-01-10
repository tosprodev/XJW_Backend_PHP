<?php 
require 'PhpOffice/autoload.php';
require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
$spreadsheet = new Spreadsheet(); 
$sheet = $spreadsheet->getActiveSheet(); 
//$uid = $_GET['uid'];
			$mtable = 'booking';
			$sql="SELECT sum(scharge), sum(tfee), sum(total)  FROM ".$mtable;
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$total_fee = "$row[0]";
			$total_t_fee = "$row[1]";
			$get_total = "$row[2]";

			//$frst = $temp_tc;
			//$snd = 2;
			//$tc = $frst + $snd;
			//echo $tc;
			$ssql = "SELECT booking.*, users.* FROM booking INNER JOIN users ON booking.uid = users.id";
			//$ssql = "SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM $mtable ORDER BY id DESC";
			//$ssql = "SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM $mtable ORDER BY id DESC";
	        //$stmt = $conn->prepare($ssql);
	
	        //executing the query 
	        //$stmt->execute();
	
	        //binding results to the query 
	        //$stmt->bind_result($id, $service, $practitioner, $bdate, $duration, $timeslot, $booking_for, $recipient, $address, $note, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
			$result = mysqli_query($conn,$ssql); 
			
	        //$data_from_db = array(); 
			while($row = mysqli_fetch_array($result)){

				/*$id = $row['id'];
				$service = $row['service']; 
				$practitioner = $row['practitioner'];  
				$bdate = $row['bdate'];  
				$duration = $row['duration'];  
				$timeslot = $row['timeslot'];  
				$booking_for = $row['booking_for'];   
				$recipient = $row['recipient'];  
				$address = $row['address']; 
				$note = $row['note']; , 
				$scharge = $row['scharge'];  
				$tfee = $row['tfee']; , 
				$total = $row['total'];  
				$status = $row['status'];  
				$payment_status = $row['payment_status']; , 
				$transaction_id = $row['transaction_id']; , 
				$invoice_id = $row['invoice_id']; , 
				$uid = $row['uid']; , 
				$cur_time = $row['cur_time'];
	        //traversing through all the result 
	        //while($stmt->fetch()){
	    	$temp = array();
	    	//$temp['id'] = $id; 
			if ($status == "0") {
				$tstatus = "Booked";
			} else if ($status == "1") {
				$tstatus = "Approved";
			} else if ($status == "1") {
				$tstatus = "Approved";
			} else if ($status == "2") {
				$tstatus = "Completed";
			} else if ($status == "3") {
				$tstatus = "Cancelled";
			}  else if ($status == "4") {
				$tstatus = "Completed";
			} 
			
			if ($payment_status == "0") {
				$tpayment_status = "Pending";
			} else if ($payment_status == "1") {
				$tpayment_status = "Paid";
			} else if ($payment_status == "2") {
				$tpayment_status = "Cancelled";
			}

			$str = $invoice_id; 
			$tinvoice_id = substr($str, 4);

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
		    $temp['status'] = $tstatus; 
		    $temp['payment_status'] = $tpayment_status; 
		    //$temp['transaction_id'] = $transaction_id; 
		    $temp['invoice_id'] = $tinvoice_id; 
		    $temp['uid'] = $uid; 
		    $temp['cur_time'] = $cur_time; 
		    array_push($data_from_db, $temp);*/

			array_push($data_from_db, array(
				"service"=>$row['service'],
				"practitioner"=>$row['practitioner'],
				"bdate"=>$row['bdate'],
				"duration"=>$row['duration'],
				"timeslot"=>$row['timeslot'],
				"booking_for"=>$row['booking_for'],
				"address"=>$row['address'],
				"note"=>$row['note'],
				"scharge"=>$row['scharge'],
				"tfee"=>$row['tfee'],
				"total"=>$row['total'],
				"status"=>$row['status'],
				"payment_status"=>$row['payment_status'],
				"invoice_id"=>$row['invoice_id'],
				"uid"=>$row['uid'],
				"cur_time"=>$row['cur_time'])
				);
	        }
		
			echo json_encode($data_from_db);

			/*$tempb = array();
	    	//$tempb['id'] = "TOTAL :"; 
		    $tempb['service'] = ""; 
		    $tempb['practitioner'] = ""; 
		    $tempb['bdate'] = ""; 
		    $tempb['duration'] = ""; 
		    $tempb['timeslot'] = ""; 
		    $tempb['booking_for'] = ""; 
		    $tempb['recipient'] = ""; 
		    $tempb['address'] = ""; 
		    $tempb['note'] = ""; 
		    $tempb['scharge'] = $total_fee;
		    $tempb['tfee'] = $total_t_fee; 
		    $tempb['total'] = $get_total; 
		    $tempb['status'] = ""; 
		    $tempb['payment_status'] = ""; 
		    //$tempb['transaction_id'] = ""; 
		    $tempb['invoice_id'] = ""; 
		    $tempb['uid'] = ""; 
		    $tempb['cur_time'] = "";
			array_push($data_from_db, $tempb); */

//$highestRow = $this->spreadsheet->getActiveSheet()->getHighestRow();
//$data_from_db[5]=array("id"=>"","service"=>"","practitioner"=>"","duration"=>"","timeslot"=>"","booking_for"=>"","recipient"=>"","address"=>"","note"=>"","scharge"=>"","tfee"=>"","total"=>"","payment_status"=>"","transaction_id"=>"","invoice_id"=>"","uid"=>"","cur_time"=>"This is Total");

//set column header
//set your own column header
$column_header=["Service","Practitioner","Booking Date","Duration","Timeslot","Booking For","Recipient","Address","Note","Service Charge","Transaction Fee","Total","Status","Payment Status","Booking Id","User Id","Create At"];
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
header("location : demo.xlsx") ;

?>