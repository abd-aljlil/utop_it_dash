<?php

     
include_once "../connect/connection.php"; 

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
              <td><?php echo $participation;?></td> 
            </tr>
            <tr>
              <td>Interview</td>
              <td>10</td>
              <td><?php echo $interview_average;?></td> 
            </tr>
            <tr>
              <td>Midterm exam</td>
              <td>25</td>
              <td><?php echo $midterm_test_mark;?></td> 
            </tr> 
            <tr>
              <td>Final exam</td>
              <td>25</td>
              <td><?php echo $final_test_mark;?></td> 
            </tr> 
            <tr>
              <td>Overall score </td>
              <td>100</td>
              <td><?php echo $total;?></td> 
            </tr>

          </tbody>            
        </table>
	  <div class="text-blue">
		<p> <span class="text-blue bold"> Result: PASSED </span> <br>
		For further inquiries, please contact: sa@utopians-edu.org <br>
		</p>
		<p class="utop-signture">
		Best Regards, <br>
		UTOPIANS Team
		</p>
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
    <div class="bgimg">
	  <body>
	  <div class="container">
		  <div class="sub-container letter-spacing">
			  <h1 class="certificate bold text-blue">CERTIFICATE OF COMPLETION</h1> <br>
			  <h1 class="certificate2 text-blue bold text-normal text-up">this certificate is awarded to</h1> <br>
			  <h2 class="name bold text-up"><?php echo $user_info;?></h2>
			  <hr class="hr">
			  <h2 class="level text-blue bold text-normal text-up">for successfully completing <span style= " color: #0462b3 "> Level
			   <?php echo $level;?>
			  </span> </h2>
			  <h2 class="date bold text-blue text-normal text-up"> at utopians on
			  <?php echo $end_date;?> 
			  </h2>
			  <h2 class="score text-blue bold text-normal text-up">
			  with a score of: <span style= "color: #0462b3"> <?php echo $total;?>  </span>
			  </h2> <br class="xs"> <br>
			  
			  <div class="signture text-blue bold text-up">
				  <p> DATE: <?php echo $end_date;?> </p>
				  <p> the <?php echo $course_name;?> </p>
				  <p> utopians </p>
			  </div>
		  
			  
	  </div>
	  </body>
    </div>
  
</body>
</html>