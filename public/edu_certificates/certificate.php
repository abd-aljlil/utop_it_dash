<?php

    //set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

    //html PNG location prefix
$PNG_WEB_DIR = 'temp/';

include "qrlib.php";    
include_once "connect/connection.php"; 
// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 

// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
    //ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
  mkdir($PNG_TEMP_DIR);

$_REQUEST['data']='http://certificates.utopians-edu.org/certificate.php?id='.$_GET["id"].'&course_id='.$_GET["course_id"];
$errorCorrectionLevel='L';
$matrixPointSize=4;
$filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
QRcode::png($_REQUEST['data'], $filename, 'L', 4, 2); 
if($level	==1)
    $level='A1';
    
    if($level	==2)
      $level='A2';
    
    if($level	==3)
      $level='A2-B1';
    
    if($level	==4)
      $level='B1';
    
    if($level	==5)
     $level='B2';
   
   if($level	==6)
     $level='C1';
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="logo.ico" type="image/x-icon">
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="media.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
<style>
.FAILED{
display:none;
}
.table td, .table th
{padding: 0.2rem;!important}
</style>
</head>
<body>
  <div class="container marks">
    <div class="row justify-content-md-center ">
      <div class="table-responsive col-xs-8 col-md-12" style="margin-top: 265px;">
        <p class="text-blue">
          Dear student, <br>
			Please find below a breakdown of your final grade in the <?php echo $course_name;?> at Utopians during the period from <?php echo $start_date." to ".$end_date;?> <br> 
			
			<div class='text-blue'>
				<div class="col-md-3">Student’s Name: </div> <?php echo "<div class='text-up col-md-9 bold'>".$user_info."</div>"; ?>
			</div>
			<div class='text-blue'>
				<div class="col-md-3">Level: </div> <?php echo "<div class='text-up col-md-9 bold'>".$level."</div>"; ?>
			</div>
        </p>
        <table class="table">
          <thead class="thead-blue">
            <tr>
              <th></th>
              <th>Max. Mark  </th>
              <th>Received Mark</th>  
            </tr>
          </thead>
          <tbody class="text-blue">
            <tr>
              <td>Participation</td>
              <td>40</td>
              <td><?php echo floatval($participation);?></td> 
            </tr>
            <tr>
              <td>Interview</td>
              <td>10</td>
              <td><?php echo floatval($interview_average);?></td> 
            </tr>
            <tr>
              <td>Midterm exam</td>
              <td>25</td>
              <td><?php echo floatval($midterm_test_mark);?></td> 
            </tr> 
            <tr>
              <td>Final exam</td>
              <td>25</td>
              <td><?php echo floatval($final_test_mark);?></td> 
            </tr> 
            <tr>
              <td>Overall score </td>
              <td>100</td>
              <td><?php echo $total;?></td> 
            </tr>

          </tbody>            
        </table>
	  <div class="text-blue">
		<p> <span class="text-blue bold"> Result: <?php echo $final_result;?> </span> <br>
		For further inquiries, please contact: sa@utopians-edu.org <br>
		</p>
		<p class="utop-signture">
		Best Regards, <br>
		UTOPIANS Team
		</p>
	  </div>
  <div class=" <?php echo $final_result;?>" >
				  <?php 
					
					$user_id = $_GET['id'];
					$course_id=$_GET['course_id'];
				  echo
					'
					<html><p align="right">Click to download the certificate</p>
						<a align="right" href="certificate-download.php?id='.$user_id.'&course_id='.$course_id.' " >
							<img align="right" alt="Click to download your certificate" src=" '.$PNG_WEB_DIR.basename($filename).' ">
						</a>
					</html>
					'
				  ?>
			  </div>
      </div>
    </div>
  </div>
  
  <?php if($level	==1)
    $level='A1';
    
    if($level	==2)
      $level='A2';
    
    if($level	==3)
      $level='A2-B1';
    
    if($level	==4)
      $level='B1';
    
    if($level	==5)
     $level='B2';
   
   if($level	==6)
     $level='C1';
   ?>
  
  
</body>
</html>