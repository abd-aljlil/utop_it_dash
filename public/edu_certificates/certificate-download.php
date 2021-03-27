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

?>
<?php if($level ==1)
    $level='A1';
    
    if($level ==2)
      $level='A2';
    
    if($level ==3)
      $level='A2-B1';
    
    if($level ==4)
      $level='B1';
    
    if($level ==5)
     $level='B2';
   
   if($level  ==6)
     $level='C1';
  $html = '<div style="background:url(img/certificate-bg.jpg)");
  background-repeat:no-repeat;height:600px;width:600px;">
  <h1>test print</h1></div>';
  $img = 'img/certificate-bg.jpg';             
  $html = '<html>
  <head>
  <style>
  .img{margin-top:-40px;margin-left:-40px}
  .container{position:absolute;top:0;left:0}
  .sub-container{padding-top:100px;text-align:center}
  .text-up{text-transform:uppercase;}
  .text-blue{color:#014260}
  .text-normal{font-weight:normal}
  body {
    margin: 0;
    font-family: Cabin;
  }
  .img-bg {
    position: fixed;
    padding: -50 px;
    width: 1125 px;
    height: 800 px;
    background: url(img/certificate-bg.png) no-repeat;
    background-size: cover;
  }
  .letter-spacing {
    letter-spacing: 2px;
  }
  .bold {
    font-weight: 900;
  }
  hr.hr {
  width: 50%;
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}
  </style>
  </head>
  <body>
  <img class="img-bg" src="img/certificate-bg.png" /> <br/>
  <div class="container">
  <div class="sub-container letter-spacing">
  <h1 style="font-size: 38px;" class="bold text-blue">CERTIFICATE OF COMPLETION</h1> <br>
  <h1 class="text-blue bold text-normal text-up">this certificate is awarded to</h1>
  <h2 style="font-size: 30px;" class="bold text-up">'.$user_info.'</h2>
  <hr class="hr">
  <h2 class="text-blue bold text-normal text-up">for successfully completing <span style=" color: #1b88c9 "> Level
  '.$level.'
  </span> </h2>
  <h2 class="bold text-blue text-normal text-up">
  at utopians on '.$end_date.' 
  </h2>
  <h2 class="text-blue bold text-normal text-up">
  with a score of: <span style:"color: #000a56"> '.$total.' </span>
  </h2> <br> <br>
  
  <div class="text-blue bold text-up" style="padding-top: 0px; padding-left: -65px; line-height:10px;">
  <p> DATE: '.$end_date.' </p>
  <p> the '.$course_name.' </p>
  <p> utopians </p>
  </div>
  <div style="padding-top: -120px">
  <h5 style="font-size:18px;text-align:left;color:#014260;font-weight:normal">
  <img align="left" src="'.$PNG_WEB_DIR.basename($filename).'" /><br/>
  </h5></div></div></div></body>
  </html>';              
  $options = new \Dompdf\Options();
  $options->setIsPhpEnabled(true);
  $dompdf = new Dompdf($options);

  $dompdf->setPaper('A4', 'landscape');
  $dompdf->loadHtml($html);$dompdf->render();ob_end_clean();
$f;
$l;
if(headers_sent($f,$l))
{
    echo $f,'<br/>',$l,'<br/>';
    die('now detect line');
}
$dompdf->stream();
  ?>
</body>
</html>