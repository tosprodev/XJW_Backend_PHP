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
			$ssql = "SELECT $mtable.*, users.* FROM $mtable INNER JOIN users ON $mtable.uid = users.id";
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
				"address"=>$row['address'],
				"scharge"=>"$".$row['scharge'],
				"tfee"=>"$".$row['tfee'],
				"total"=>"$".$row['total'],
				"status"=>$tstatus,
				"payment_status"=>$tpayment_status,
				"invoice_id"=>$tinvoice_id,
				"uid"=>$row['first_name']." ".$row['last_name'],
				"cur_time"=>$row['cur_time'])
				);
	        }
			$tempb = array();
		    $tempb['service'] = ""; 
		    $tempb['practitioner'] = ""; 
		    $tempb['bdate'] = ""; 
		    $tempb['duration'] = ""; 
		    $tempb['timeslot'] = ""; 
		    $tempb['address'] = "";
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
		    $tempc['service'] = ""; 
		    $tempc['practitioner'] = ""; 
		    $tempc['bdate'] = ""; 
		    $tempc['duration'] = ""; 
		    $tempc['timeslot'] = ""; 
		    $tempc['address'] = "";
		    $tempc['scharge'] = "";
		    $tempc['tfee'] = "";
		    $tempc['total'] = "TOTAL -> "; 
		    $tempc['status'] = "----------"; 
		    $tempc['payment_status'] = "Booking : ".$get_total_booking;  
		    $tempc['invoice_id'] = "Service Charge $: ".$total_fee;
		    $tempc['uid'] = "Transaction Charge : $".$total_t_fee;  
		    $tempc['cur_time'] = "Grand Total : $".$get_total;
			array_push($data_from_db, $tempc);
$column_header=["Service","Practitioner","Booking Date","Duration","Timeslot","Address","Service Charge","Transaction Fee","Total","Status","Payment Status","Booking Id","User's Name","Create At"];
$j=1;
foreach($column_header as $x_value) {
		$sheet->setCellValueByColumnAndRow($j,1,$x_value);
  		$j=$j+1;
  		
	}
for($i=0;$i<count($data_from_db);$i++){
$row=$data_from_db[$i];
$j=1;
	foreach($row as $x => $x_value) {
		$sheet->setCellValueByColumnAndRow($j,$i+2,$x_value);
  		$j=$j+1;
	}
}
$writer = new Xlsx($spreadsheet); 
$writer->save('demo.xlsx');
//header("location : demo.xlsx") ;
$url = 'demo.xlsx';
clearstatcache();
if(file_exists($url)) {
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($url).'"');
header('Content-Length: ' . filesize($url));
header('Pragma: public');
flush();
readfile($url,true);
die();
}else{
echo "File path does not exist.";
}

?>