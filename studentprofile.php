<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';

$id = $firstName = $lastName = $studentNum = $email = $street = $city =  $province = "";
$pcode = $phone = $notes = $leftTrent = $major = $credAchieved = $cummuAchieved = $exempt = "";
$altAddress = $altEmail = $altPhone = $yearCreated = $institutionID = $foreignStatus = $showAsFellow = $fellowType = "";

$firstName_err = $lastName_err = $studentNum_err = $email_err = $street_err = $city_err = $province_err = "";
$pcode_err = $phone_err = $notes_err = $leftTrent_err = $major_err = $credAchieved_err = $cummuAchieved_err = $exempt_err = "";
$altAddress_err = $altEmail_err = $altPhone_err = $yearCreated_err = $institutionID_err = $foreignStatus_err = $showAsFellow_err = $fellowType_err = "";


$counter = 0;
$projectArray = array();
$tableStudentProject = "";
$tableProject = "";



require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects

//CHECK GET
if(isset($_GET["id"])){
  $requestedID = filter_var($_GET["id"],FILTER_SANITIZE_STRING);
  $_SESSION["id"] = $requestedID;
}
elseif (isset($_SESSION["id"])){
  $requestedID = $_SESSION["id"];
} else {
  $message = "No GET/POST found. Ensure you are accessing correctly.";
  echo "<script type='text/javascript'>alert('$message');</script>";
  header("location: index.php");
}



$sql = "SELECT * FROM studentProject WHERE studentID = ".$_SESSION["id"];

  if($tableStudentProject = mysqli_query($link,$sql)){
    //success
  } else {
    echo "Error at execution";
  }


$linkedProject = "";

  if(is_a($tableStudentProject,"mysqli_result")){
  while( $row = mysqli_fetch_assoc($tableStudentProject)){

   $linkedProject = $row["projectID"];

   $sql = "SELECT * FROM project WHERE id = ".$linkedProject;

     if($tableProject = mysqli_query($link,$sql)){
       //success
       if ($row = mysqli_fetch_assoc($tableProject)) {
         $projectArray[$counter] =  array($row["id"], $row["projectTitle"], $row["projectNumber"], $row["staffCode"], $row["status"]);
       }

     } else {
       echo "Error at execution";
     }

  $counter++;
  }
}





//if user submits form
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(null ==(trim($_POST['first_name']))){
    $firstName_err = "Please enter the first name";
  } else {
    $firstName = trim($_POST["first_name"]);
  }

  if(null ==(trim($_POST['last_name']))){
    $lastName_err = "Please enter the last name";
  } else {
    $lastName = trim($_POST["last_name"]);
  }

  if(null ==(trim($_POST['studentNum']))){
    $studentNum_err = "Please enter your student number";
  } else {
    $studentNum = trim($_POST["studentNum"]);
  }

  if(null ==(trim($_POST['email']))){
    $email_err = "Please enter the email";
  } else {
    $email = trim($_POST["email"]);
  }

  if(null ==(trim($_POST['street']))){
     $street_err = "Please enter street";
  } else {
     $street = trim($_POST["street"]);
  }

  if(null ==(trim($_POST['city']))){
  $city_err   = "Please enter the city";
  } else {
    $city = trim($_POST["city"]);
  }

  if(null ==(trim($_POST['province']))){
    $province_err = "No province enterred";
  } else {
    $province = trim($_POST["province"]);
  }

  if(null ==(trim($_POST['pcode']))){
    $pcode_err = "Please enter the postal code";
  } else {
    $pcode = trim($_POST["pcode"]);
  }

  if(null ==(trim($_POST['phone']))){
    $phone_err = "Please enter your phone";
  } else {
    $phone = trim($_POST["phone"]);
  }

  if(null ==(trim($_POST['notes']))){
    $notes_err = "Please enter the notes";
  } else {
    $notes = trim($_POST["notes"]);
  }

  if(null ==(trim($_POST['leftTrent']))){
    $leftTrent_err = "Please select whether the student has leftTrent";
  } else {
    $leftTrent = trim($_POST["leftTrent"]);
  }

  if(null ==(trim($_POST['major']))){
    $major_err = "Please enter major";
  } else {
    $major = trim($_POST["major"]);
  }

  if(null ==(trim($_POST['credAchieved']))){
    $credAchieved_err = "Selection required";
  } else {
    $credAchieved = trim($_POST["credAchieved"]);
  }

  if(null ==(trim($_POST['cummuAchieved']))){
    $cummuAchieved_err = "Selection required";
  } else {
    $cummuAchieved = trim($_POST["cummuAchieved"]);
  }

  if(null ==(trim($_POST['exempt']))){
    $exempt_err = "Selection required";
  } else {
    $exempt = trim($_POST["exempt"]);
  }

  if(null ==(trim($_POST['altAddress']))){
    $altAddress_err = "select alternative address";
  } else {
    $altAddress = trim($_POST["altAddress"]);
  }

  if(null ==(trim($_POST['altEmail']))){
    $altEmail_err = "Enter alternative email";
  } else {
    $altEmail = trim($_POST["altEmail"]);
  }

  if(null ==(trim($_POST['altPhone']))){
    $altPhone_err = "Enter Alternative Phone";
  } else {
    $altPhone = trim($_POST["altPhone"]);
  }

  if(null ==(trim($_POST['yearCreated']))){
    $yearCreated_err = "Year added not selected";
  } else {
    $yearCreated= trim($_POST["yearCreated"]);
  }

  if(null ==(trim($_POST['institutionID']))){
    $institutionID_err = "Enter institutionID";
  } else {
    $institutionID = trim($_POST["institutionID"]);
  }

  if(null ==(trim($_POST['foreignStatus']))){
    $foreignStatus_err = "Enter student status";
  } else {
    $foreignStatus = trim($_POST["foreignStatus"]);
  }

  if(null ==(trim($_POST['showAsFellow']))){
    $showAsFellow_err = "Select show as fellow?";
  } else {
    $showAsFellow = trim($_POST["showAsFellow"]);
  }

  if(null ==(trim($_POST['fellowType']))){
    $fellowType_err = "Fellow type not inserted";
  } else {
    $fellowType = trim($_POST["fellowType"]);
  }

  if(empty($firstName_err)
   && empty ($lastName_err)
   && empty ($studentNum_err)
   && empty ($email_err)
   && empty ($street_err)
   && empty ($city_err)
   && empty ($province_err)
   && empty ($pcode_err)
   && empty ($phone_err)
   && empty ($notes_err)
   && empty ($leftTrent_err)
   && empty ($major_err)
   && empty ($credAchieved_err)
   && empty ($cummuAchieved_err)
   && empty ($exempt_err)
   && empty ($altAddress_err)
   && empty ($altEmail_err)
   && empty ($altPhone_err)
   && empty ($yearCreated_err)
   && empty ($institutionID_err)
   && empty ($foreignStatus_err)
   && empty ($showAsFellow_err)
   && empty ($fellowType_err))
   {

     //TO DO
     $sql = "UPDATE student SET firstName = ?, lastName = ?, studentNum = ?, email = ?, street = ?, city = ?, province = ?,
     pcode = ?, phone = ?, notes = ?, leftTrent = ?, major = ?, credAchieved = ?, cumAchieved = ?, exempt = ?, altAddress = ?, altEmail = ?, altPhone = ?,
     yearCreated = ?, institutionID = ?, foreignStatus = ?, showAsFellow = ?, fellowType = ? WHERE id = ?";

     if($stmt = mysqli_prepare($link,$sql)){
       mysqli_stmt_bind_param($stmt,"ssisssssssisiiissssisisi",$firstName , $lastName , $studentNum , $email , $street ,
       $city ,  $province, $pcode , $phone , $notes , $leftTrent , $major , $credAchieved , $cummuAchieved , $exempt ,
       $altAddress , $altEmail , $altPhone , $yearCreated , $institutionID , $foreignStatus , $showAsFellow , $fellowType, $requestedID);

       if(mysqli_stmt_execute($stmt)){
         header("location: studentprofile.php?id=".$requestedID);
       } else {
         //if there are problems, display error
         echo "ERROR at execution. Check database connection";
       }
     }
   }
}

if(isset($requestedID)){
  $query = "SELECT * FROM student WHERE id = ?";
  if($stmt = mysqli_prepare($link,$query)){
    mysqli_stmt_bind_param($stmt, "s", $requestedID);
    $stmt -> execute();

    $result = $stmt -> get_result();
    while($row = $result -> fetch_assoc()){
        $id = $row['id'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $studentNum = $row['studentNum'];
        $email = $row['email'];
        $street = $row['street'];
        $city =  $row['city'];
        $province = $row['province'];
        $pcode = $row['pcode'];
        $phone = $row['phone'];
        $notes = $row['notes'];
        $leftTrent = $row['leftTrent'];
        $major = $row['major'];
        $credAchieved = $row['credAchieved'];
        $cummuAchieved = $row['cumAchieved'];
        $exempt = $row['exempt'];
        $altAddress = $row['altAddress'];
        $altEmail = $row['altEmail'];
        $altPhone = $row['altPhone'];
        $yearCreated = $row['yearCreated'];
        $institutionID = $row['institutionID'];
        $foreignStatus = $row['foreignStatus'];
        $showAsFellow = $row['showAsFellow'];
        $fellowType = $row['fellowType'];
}
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Students </title>
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
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Nav bar import -->
  <?php include 'includes/nav.php'; ?>
  <!-- Test -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $firstName ?> <?php echo $lastName ?></h1>
              <h5 style="color:red;">Field's with a '*' are required for submission!</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


      <?php include 'includes/studentprofile.php'; ?>

      <?php include 'includes/linkedproject.php'; ?>











        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-default" value="Reset">
        </div>
      </form>

    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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

</body>
</html>
