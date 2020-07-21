<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$projectArray = array();
$counter = 0;

require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects
$sql = "SELECT * FROM contact";

//Retrieve and store as a variable
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    $projectArray[$counter] = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13]);
    $counter++;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Send Templated Emails</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
 h3{
    margin-left: 2em;
  }
  p{
    margin-left: 5em;
  }
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Nav bar import -->
  <?php include 'includes/nav.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact the Developers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
              <li class="breadcrumb-item"><a href="contactme.php">Contact</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="contact">
 <h3> Nikhil Pai Ganesh </h3>
 <p> email: <a href="mailto:nikhilpaiganesh@trentu.ca?Subject=TCRC%20Beta%20Test" target="_top">nikhilpaiganesh@trentu.ca</a>
 <br>
 <h3> Bogdan Dawabsheh </h3>
 <p> email: <a href="mailto:bogdandawabsheh@trentu.ca?Subject=TCRC%20Beta%20Test" target="_top">bogdandawabsheh@trentu.ca</a>
 <br>
 <h3> Denzel Awuah </h3>
 <p> email: <a href="mailto:denzelawuah@trentu.ca?Subject=TCRC%20Beta%20Test" target="_top">denzelawuah@trentu.ca</a>
 <br>
</div>
 <center> <h2> Contact us for any queries you might have. </br> We will get back to you as soon as possible </h2> </center>
 <br>
 <center>
 <h2> Send us a Feedback </h2>
 <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSc8JO6K7kTyYnuO82Erd5M8Lqa9UppB3gADspQ9TwP4QyeoHA/viewform?embedded=true" width="640" height="1344" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
 </h2>
  <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
</body>
</html>
