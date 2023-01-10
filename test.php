<?php 
require 'PhpOffice/autoload.php';
require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
$spreadsheet = new Spreadsheet(); 
$sheet = $spreadsheet->getActiveSheet(); 

//$uid = $_GET['uid'];
	        $stmt = $conn->prepare("SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking ORDER BY id DESC");
	
	        //executing the query 
	        $stmt->execute();
	
	        //binding results to the query 
	        $stmt->bind_result($id, $service, $practitioner, $bdate, $duration, $timeslot, $booking_for, $recipient, $address, $note, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	        $temp = array(); 
	
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
		    array_push($mybooking, $temp);
            /*$temp = array(
                'id'=>$id, 
                'service'=>$service, 
                'practitioner'=>$practitioner,
                'duration'=>$duration,
                'timeslot'=>$timeslot,
                'booking_for'=>$booking_for,
                'recipient'=>$recipient,
                'address'=>$address,
                'note'=>$note,
                'scharge'=>$scharge,
                'tfee'=>$tfee,
                'total'=>$total,
                'payment_status'=>$payment_status,
                'transaction_id'=>$transaction_id,
                'invoice_id'=>$invoice_id,
                'uid'=>$uid,
                'cur_time'=>$cur_time
                );
                array_push($booking, $temp);
	        }*/
	
	        //displaying the result in json format 
            echo json_encode($temps);

// sample data from db
// call the db get data function here
//delete line from 18 to 20 and call the db function
//$data_from_db=array();
//$data_from_db[0]=array("id"=>"$id","age"=>23,"age"=>23,"age"=>23,"age"=>23,"age"=>23,"age"=>23,"age"=>23,"age"=>23,"age"=>23,"age"=>23,"age"=>23,"age"=>23);
//$data_from_db[1]=array("name"=>"raja1","age"=>43);

//set column header
//set your own column header
/*$column_header=["Name","Age"];
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
$writer->save('demo.xlsx'); */
?>