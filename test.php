<?php 
require 'PhpOffice/autoload.php';
require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
$spreadsheet = new Spreadsheet(); 
$sheet = $spreadsheet->getActiveSheet(); 
//$uid = $_GET['uid'];
			$mtable = 'booking';
			$sql="SELECT sum(scharge), sum(tfee), sum(total), count(id) FROM ".$mtable;
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$total_fee = "$row[0]";
			$total_t_fee = "$row[1]";
			$get_total = "$row[2]";
			$get_total_booking = "$row[3]";

			//$frst = $temp_tc;
			//$snd = 2;
			//$tc = $frst + $snd;
			//echo $tc;
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
		
			echo json_encode($data_from_db);

			$tempb = array();
		    $tempb['service'] = ""; 
		    $tempb['practitioner'] = ""; 
		    $tempb['bdate'] = ""; 
		    $tempb['duration'] = ""; 
		    $tempb['timeslot'] = ""; 
		    $tempb['booking_for'] = ""; 
		    $tempb['recipient'] = "";
		    $tempb['address'] = "";
		    $tempb['note'] = "";
		    $tempb['scharge'] = "";
		    $tempb['tfee'] = "";
		    $tempb['total'] = "TOTAL -> "; 
		    $tempb['status'] = "----------"; 
		    $tempb['payment_status'] = "Booking : ".$get_total_booking;  
		    $tempb['invoice_id'] = "Service Charge : ".$total_fee;
		    $tempb['uid'] = "Transaction Charge : ".$total_t_fee;  
		    $tempb['cur_time'] = "Grand Total : ".$get_total;
			array_push($data_from_db, $tempb);

//$highestRow = $this->spreadsheet->getActiveSheet()->getHighestRow();
//$data_from_db[5]=array("id"=>"","service"=>"","practitioner"=>"","duration"=>"","timeslot"=>"","booking_for"=>"","recipient"=>"","address"=>"","note"=>"","scharge"=>"","tfee"=>"","total"=>"","payment_status"=>"","transaction_id"=>"","invoice_id"=>"","uid"=>"","cur_time"=>"This is Total");

//set column header
//set your own column header
$column_header=["Service","Practitioner","Booking Date","Duration","Timeslot","Booking For","Recipient","Address","Note","Service Charge","Transaction Fee","Total","Status","Payment Status","Booking Id","User's Name","Create At"];
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