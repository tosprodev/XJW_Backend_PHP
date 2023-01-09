<?php 
require 'PhpOffice/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
  
// Creates New Spreadsheet 
$spreadsheet = new Spreadsheet(); 
  
// Retrieve the current active worksheet 
$sheet = $spreadsheet->getActiveSheet(); 

// sample data from db
// call the db get data function here
//delete line from 18 to 20 and call the db function
$data_from_db=array();
$data_from_db[0]=array("name"=>"raja","age"=>23);
$data_from_db[1]=array("name"=>"raja1","age"=>43);

//set column header
//set your own column header
$column_header=["Name","Age"];
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
$writer->save('files/demo.xlsx'); 
?>