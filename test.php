<?php 
require 'PhpOffice/autoload.php';
require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
$spreadsheet = new Spreadsheet(); 
$sheet = $spreadsheet->getActiveSheet(); 
//$uid = $_GET['uid'];
$j=1;

			$mtable = 'booking';
			$ssql = "SELECT booking.*, users.* FROM booking INNER JOIN users ON booking.uid = users.id";
			$result = mysqli_query($conn,$ssql); 
			
	        $data_from_db = array(); 
			while($row = mysqli_fetch_array($result)){

			if ($row['status'] == "0") {
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
			
			if ($row['payment_status'] == "0") {
				$tpayment_status = "Pending";
			} else if ($payment_status = "1") {
				$tpayment_status = "Paid";
			} else if ($payment_status = "2") {
				$tpayment_status = "Cancelled";
			}

			$str = $row['invoice_id']; 
			$tinvoice_id = substr($str, 4);

			array_push($data_from_db, array(
				"Sno"=>$j;
				"service"=>$row['service'],
				"practitioner"=>$row['practitioner'],
				"bdate"=>$row['bdate'],
				"duration"=>$row['duration'],
				"timeslot"=>$row['timeslot'],
				"booking_for"=>$row['booking_for'],
				"recipient"=>$row['recipient'],
				"address"=>$row['address'],
				"note"=>$row['note'],
				"scharge"=>$row['scharge'],
				"tfee"=>$row['tfee'],
				"total"=>$row['total'],
				"status"=>$tstatus,
				"payment_status"=>$tpayment_status,
				"invoice_id"=>$tinvoice_id,
				"uid"=>$row['first_name']." ".$row['last_name'],
				"cur_time"=>$row['cur_time'])
				);
	        }

			$tempb = array();
			"Sno"=>$j;
		    $tempb['service'] = ""; 
		    $tempb['practitioner'] = ""; 
		    $tempb['bdate'] = ""; 
		    $tempb['duration'] = ""; 
		    $tempb['timeslot'] = ""; 
		    $tempb['booking_for'] = "TOTAL "; 
		    $tempb['recipient'] = "---------"; 
		    $tempb['address'] = "Booking"; 
		    $tempb['note'] = " Booking : "; 
		    $tempb['scharge'] = "";
		    $tempb['tfee'] = ""; 
		    $tempb['total'] = ""; 
		    $tempb['status'] = ""; 
		    $tempb['payment_status'] = ""; 
		    $tempb['invoice_id'] = ""; 
		    $tempb['uid'] = ""; 
		    $tempb['cur_time'] = "";
			array_push($data_from_db, $tempb);

			$tempc = array();
			"Sno"=>$j;
		    $tempc['service'] = ""; 
		    $tempc['practitioner'] = ""; 
		    $tempc['bdate'] = ""; 
		    $tempc['duration'] = ""; 
		    $tempc['timeslot'] = ""; 
		    $tempc['booking_for'] = ""; 
		    $tempc['recipient'] = ""; 
		    $tempc['address'] = ""; 
		    $tempc['note'] = ""; 
		    $tempc['scharge'] = $total_fee;
		    $tempc['tfee'] = $total_t_fee; 
		    $tempc['total'] = $get_total; 
		    $tempc['status'] = ""; 
		    $tempc['payment_status'] = ""; 
		    $tempc['invoice_id'] = ""; 
		    $tempc['uid'] = ""; 
		    $tempc['cur_time'] = "";
			array_push($data_from_db, $tempc);

//$highestRow = $this->spreadsheet->getActiveSheet()->getHighestRow();
//$data_from_db[5]=array("id"=>"","service"=>"","practitioner"=>"","duration"=>"","timeslot"=>"","booking_for"=>"","recipient"=>"","address"=>"","note"=>"","scharge"=>"","tfee"=>"","total"=>"","payment_status"=>"","transaction_id"=>"","invoice_id"=>"","uid"=>"","cur_time"=>"This is Total");

//set column header
//set your own column header
$column_header=["S No.","Service","Practitioner","Booking Date","Duration","Timeslot","Booking For","Recipient","Address","Note","Service Charge","Transaction Fee","Total","Status","Payment Status","Booking Id","User's Name","Create At"];

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