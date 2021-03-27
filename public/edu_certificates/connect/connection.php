<?php
$servername = "localhost";
$username = "utopians_utopians";
$password = "YzxvExlrqOy20@";
$db = "utopians_edu";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_errno) {
  die("Database Connection failed: " . $conn->connect_error);
}

$user_id = $_GET['id'];
$course_id=$_GET['course_id'];

$user_info= $conn->query('SELECT  english_name FROM users 
  WHERE id = '.$user_id.' and block = 0 limit 1')->fetch_object()->english_name;

if($user_info==null || $course_id<6){
  header("Location: \index.php?message=incorrect");
}
else{
  $qaverage = $conn->query('SELECT  sum(average) as average FROM group_timing_attendees 
    WHERE user_id = '.$user_id.' group by user_id');
  $qcomposition = $conn->query('SELECT  sum(composition_skills) as comskills FROM group_timing_attendees 
    WHERE user_id = '.$user_id.' group by user_id');
  $qavilable  = $conn->query('SELECT count(user_id) as available FROM 
    group_timing_attendees WHERE available =1 and user_id= '.$user_id.'');
  $qmarks = $conn->query('select user_id,level ,interview_average,midterm_test_mark,level,
   final_test_mark from user_course
   where 
   user_id ='.$user_id.' and course_id='.$course_id);
  $course_info = $conn->query('SELECT  start_date, end_date, name as course_name FROM course 
    WHERE id = '.$course_id);

 while($obj = $course_info->fetch_object()){
    $start_date=$obj->start_date;
$end_date=$obj->end_date;
$course_name=$obj->course_name;

  }

  $average= $qaverage->fetch_object()->average;

  $composition = $qcomposition->fetch_object()->comskills;


  $avilable = $qavilable->fetch_object()->available;
  while($obj = $qmarks->fetch_object()){
    $interview_average 	= $obj->interview_average;
    $midterm_test_mark 	= $obj->midterm_test_mark;
    $final_test_mark	= $obj->final_test_mark;
    $level				= $obj->level;

  }

  if($level == 1 || $level == 2 ){
   $participation1 = ($average)/max($avilable,12);
   $participation = round($participation1*2)/2;
   $conn->query("UPDATE user_course SET participation_average='".$participation."' WHERE course_id='".$course_id."'AND user_id='".$user_id."'");
 }	
 else if( $level == 3 || $level == 4){
   $participation1 = ($average + $composition)/max($avilable,12);
   $participation = round($participation1*2)/2;
   $conn->query("UPDATE user_course SET participation_average='".$participation."' WHERE course_id='".$course_id."'AND user_id='".$user_id."'");
 }	
 else{
   $participation1 = ($average + $composition)/max($avilable,8);
   $participation = round($participation1*2)/2;
   $conn->query("UPDATE user_course SET participation_average='".$participation."' WHERE course_id='".$course_id."'AND user_id='".$user_id."'");
 }
 $total= $participation+$midterm_test_mark+$final_test_mark+$interview_average;}

if($total >=67)
      $final_result="PASSED";
    else
      $final_result="FAILED";
 ?>