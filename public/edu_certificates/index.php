<!DOCTYPE html>
<html lang="en">
<head>
  <title>Utopians Certificate</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="logo.ico" type="image/x-icon">
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<style>
img{margin:auto;}
.row{margin:15px;}
h4{text-align:center;margin: auto;}
form{margin:auto;}
</style>
</head>
<body>
<p></p>
<div class="container">
  <div class="row"><img align="left" src="img/logo.png" height="150" /><p></p></div>
<div class="row">
    <?php if($_GET['message']=='incorrect'){echo"<div class='alert alert-warning' style='margin:auto;'>
    <strong>Warning!</strong> Incorrect values!
  </div>";} ?>
</div>
<div class="row">
  <h4>Find Utopians student certificate</h4></div>

  <form action="certificate.php" class="was-validated" method="get">
    <div class="form-group">
      <label for="id">Student ID</label>
      <input type="number" class="form-control" id="id" name="id" required>
      
      
    </div>
    <div class="form-group">
      <label for="course_id">Course ID:</label>
      <input type="number" class="form-control" id="course_id" placeholder="6" name="course_id" required>
      
      
    </div>
    <button type="submit" class="btn btn-primary">Display</button>
  </form>
<p></p><p></p>
</div>
</body>
</html>
