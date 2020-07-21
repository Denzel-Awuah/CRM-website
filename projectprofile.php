<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';


$id = $office = $research = $projectTitle = $projectNumber = $projectDescription = $DepartmentalCode = $deptID = "";
$dateProposed = $dateReceived = $approved = $signedRPA = $WEPA = $dateWithdrawn = $dateCompleted = $HostOrganizationName = $hostOrganizationID = $courseReq = $notes = $BFUser = "";
$BFActivity = $facultySupervisorID = $BFDateOfNote = $dateProjectMatched = $callNumber = $staffID = $staffCode = $PClink = $departmentCode = $institutionID = $status_percentage = "";


$office_err = $research_err = $projectTitle_err = $projectNumber_err = $projectDescription_err = $DepartmentalCode_err = $deptID_err = $dateProposed_err = $dateReceived_err = "";
$approved_err = $signedRPA_err = $WEPA_err = $dateWithdrawn_err = $dateCompleted_err = $HostOrganizationName_err = $hostOrganizationID_err = $courseReq_err = $notes_err = $BFUser_err = "";
$BFActivity_err = $facultySupervisorID_err = $BFDateOfNote_err = $dateProjectMatched_err = $callNumber_err = $staffID_err = $staffCode_err = $PClink_err = $departmentCode_err = $institutionID_err = $status_percentage_err = "";

$checkyes = $checkno = "";

$projectArray = array();
$counter = 0; //keep track of number of linked students
$tableStudent = "";  // for retrieving student info from student table
$tableStudentProject = ""; //for retrieving info from studentProject table

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



$sql = "SELECT * FROM studentProject WHERE projectID = ".$_SESSION["id"];

  if($tableStudentProject = mysqli_query($link,$sql)){
    //success
  } else {
    echo "Error at execution";
  }


$linkedStudent = "";

  if(is_a($tableStudentProject,"mysqli_result")){
  while( $row = mysqli_fetch_assoc($tableStudentProject)){

   $linkedStudent = $row["studentID"];

   $sql = "SELECT * FROM student WHERE id = ".$linkedStudent;

     if($tableStudent = mysqli_query($link,$sql)){
       //success
       if ($row = mysqli_fetch_assoc($tableStudent)) {
         $projectArray[$counter] =  array($row["id"], $row["firstName"], $row["lastName"], $row["studentNum"], $row["email"]);
       }

     } else {
       echo "Error at execution";
     }

  $counter++;
  }
}







//if user submits the form
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(null ==(trim($_POST['office']))){
    $office_err = "Please enter the office";
  } else {
    $office = trim($_POST["office"]);
  }

  if(null ==(trim($_POST['research']))){
    $research_err = "Please enter the research";
  } else {
    $research = trim($_POST["research"]);
  }

  if(null ==(trim($_POST['projectTitle']))){
    $projectTitle_err = "Please enter the ProjectTitle";
  } else {
    $projectTitle = trim($_POST["projectTitle"]);
  }

  if(null ==(trim($_POST['projectNumber']))){
    $projectNumber_err = "Please enter the ProjectNumber";
  } else {
    $projectNumber = trim($_POST["projectNumber"]);
  }

  if(null ==(trim($_POST['projectDescription']))){
    $projectDescription_err = "Please enter the ProjectDescription";
  } else {
    $projectDescription = trim($_POST["projectDescription"]);
  }

  if(null ==(trim($_POST['DepartmentCode']))){
    $DepartmentalCode_err = "Please enter the DepartmentCode";
  } else {
    $DepartmentalCode = trim($_POST["DepartmentCode"]);
  }

  if(null ==(trim($_POST['deptID']))){
    $deptID_err = "Please enter the deptID";
  } else {
    $deptID = trim($_POST["deptID"]);
  }

  if(null ==(trim($_POST['dateProposed']))){
    $dateProposed_err = "Please enter the dateProposed";
  } else {
    $dateProposed = trim($_POST["dateProposed"]);
  }

  if(null ==(trim($_POST['dateRecieved']))){
    $dateReceived_err = "Please enter the dateReceived";
  } else {
    $dateReceived = trim($_POST["dateRecieved"]);
  }

  if(null ==(trim($_POST['approved']))){
    $approved_err = "Please enter the approved";
  } else {
    $approved = trim($_POST["approved"]);
  }

  if(null ==(trim($_POST['signedRPA']))){
    $signedRPA_err = "Please enter the signedRPA";
  } else {
    $signedRPA = trim($_POST["signedRPA"]);
  }

  if(null ==(trim($_POST['WEPA']))){
    $WEPA_err = "Please enter the WEPA";
  } else {
    $WEPA = trim($_POST["WEPA"]);
  }


  if(null ==(trim($_POST['dateWithdrawn']))){
    $dateWithdrawn_err = "Please enter the dateWithdrawn";
  } else {
    $dateWithdrawn = trim($_POST["dateWithdrawn"]);
  }

  if(null ==(trim($_POST['dateCompleted']))){
    $dateCompleted_err = "Please enter the dateCompleted";
  } else {
    $dateCompleted = trim($_POST["dateCompleted"]);
  }

  if(null ==(trim($_POST['HostOrganizationName']))){
    $HostOrganizationName_err = "Please enter the HostOrganizationName";
  } else {
    $HostOrganizationName = trim($_POST["HostOrganizationName"]);
  }

  if(null ==(trim($_POST['hostOrganizationID']))){
    $hostOrganizationID_err = "Please enter the hostOrganizationID";
  } else {
    $hostOrganizationID = trim($_POST["hostOrganizationID"]);
  }

  if(null ==(trim($_POST['courseReq']))){
    $courseReq_err = "Please enter the courseReq";
  } else {
    $courseReq = trim($_POST["courseReq"]);
  }

  if(null ==(trim($_POST['notes']))){
    $notes_err = "Please enter the notes";
  } else {
    $notes = trim($_POST["notes"]);
  }

  if(null ==(trim($_POST['BFUser']))){
    $BFUser_err = "Please enter the BFUser";
  } else {
    $BFUser = trim($_POST["BFUser"]);
  }

  if(null ==(trim($_POST['BFActivity']))){
    $BFActivity_err = "Please enter the BFActivity";
  } else {
    $BFActivity = trim($_POST["BFActivity"]);
  }

  if(null ==(trim($_POST['facultySupervisorID']))){
    $facultySupervisorID_err = "Please enter the facultySupervisorID";
  } else {
    $facultySupervisorID = trim($_POST["facultySupervisorID"]);
  }

  if(null ==(trim($_POST['BFDateOfNote']))){
    $BFDateOfNote_err = "Please enter the BFDateOfNote";
  } else {
    $BFDateOfNote = trim($_POST["BFDateOfNote"]);
  }


  if(null ==(trim($_POST['dateProjectMatched']))){
    $dateProjectMatched_err = "Please enter the dateProjectMatched";
  } else {
    $dateProjectMatched = trim($_POST["dateProjectMatched"]);
  }

  if(null ==(trim($_POST['callNumber']))){
    $callNumber_err = "Please enter the callNumber";
  } else {
    $callNumber = trim($_POST["callNumber"]);
  }

  if(null ==(trim($_POST['staffID']))){
    $staffID_err= "Please enter the staffID";
  } else {
    $staffID = trim($_POST["staffID"]);
  }


  if(null ==(trim($_POST['staffCode']))){
    $staffCode_err = "Please enter the staf";
  } else {
    $staffCode = trim($_POST["callNumber"]);
  }


  if(null ==(trim($_POST['PClink']))){
    $PClink_err = "Please enter the callNumber";
  } else {
    $PClink = trim($_POST["PClink"]);
  }



  if(null ==(trim($_POST['departmentCode']))){
    $departmentCode_err = "Please enter the callNumber";
  } else {
    $departmentCode = trim($_POST["departmentCode"]);
  }


  if(null ==(trim($_POST['institutionID']))){
    $institutionID_err = "Please enter the callNumber";
  } else {
    $institutionID = trim($_POST["institutionID"]);
  }

  if(null ==(trim($_POST['hostOrganizationID']))){
    $hostOrganizationID_err = "Please enter the callNumber";
  } else {
    $hostOrganizationID = trim($_POST["hostOrganizationID"]);
  }






  if(null ==(trim($_POST['status_percentage']))){
    $status_percentage_err = "Please enter the status_percentage";
  } else {
    $status_percentage = trim($_POST["status_percentage"]);
  }

  $requestedID = $_SESSION["id"];


  if(empty($office_err)
   && empty ($research_err)
   && empty ($projectTitle_err)
   && empty ($projectNumber_err)
   && empty ($projectDescription_err)
   && empty ($DepartmentalCode_err)
   && empty ($deptID_err)
   && empty ($dateProposed_err)
   && empty ($dateReceived_err)
   && empty ($approved_err)
   && empty ($signedRPA_err)
   && empty ($WEPA_err)
   && empty ($dateWithdrawn_err)
   && empty ($dateCompleted_err)
   && empty ($HostOrganizationName_err)
   && empty ($hostOrganizationID_err)
   && empty ($courseReq_err)
   && empty ($notes_err)
   && empty ($BFUser_err)
   && empty ($BFActivity_err)
   && empty ($facultySupervisorID_err)
   && empty ($BFDateOfNote_err)
   && empty ($dateProjectMatched_err)
   && empty ($callNumber_err)
   && empty ($staffCode_err)
   && empty ($PClink_err)
   && empty ($departmentCode_err)
   && empty ($institutionID_err)
   && empty ($status_percentage_err))
   {

if ($approved == "1") {
  $newStatus = "in_progress";
}else {
  $newStatus = " submitted";
}

     $sql = "UPDATE project SET office = ?, research = ?, projectTitle = ?, projectNumber = ?, projectDescription = ?, DepartmentalCode = ?, deptID = ?, dateProposed = ?, dateReceived = ?, approved = ?,
      signedRPA = ?, WEPA = ?, dateWithdrawn = ?, dateCompleted = ?, HostOrganizationName = ?, hostOrganizationID = ?, courseReq = ?, notes = ?, BFUser = ?, BFActivity = ?, facultySupervisorID = ?, BFDateOfNote = ?,
       dateProjectMatched = ?, callNumber = ?, staffID = ?, staffCode = ?, PClink = ?, departmentCode = ?, institutionID = ?, status = ?, status_percentage = ? WHERE id = ?";

     if($stmt = mysqli_prepare($link,$sql)){
       mysqli_stmt_bind_param($stmt,"ssssssssssssssssssssssssssssssss",$office,$research,$projectTitle,$projectNumber,$projectDescription,$DepartmentalCode,$deptID,$dateProposed,$dateReceived,$approved,
       $signedRPA,$WEPA,$dateWithdrawn,$dateCompleted,$HostOrganizationName,$hostOrganizationID,$courseReq,$notes,$BFUser,$BFActivity,$facultySupervisorID,$BFDateOfNote,
       $dateProjectMatched,$callNumber,$staffID,$staffCode,$PClink,$departmentCode,$institutionID,$newStatus, $status_percentage,$requestedID);

       if(mysqli_stmt_execute($stmt)){
         header("location: projectprofile.php?id=".$requestedID);
       } else {
         //if there are problems, display error
         echo "ERROR at execution. Check database connection";
       }
     }
   }

}

if(isset($requestedID)){
  $query = "SELECT * FROM project WHERE id = ?";
  if($stmt = mysqli_prepare($link,$query)){
    mysqli_stmt_bind_param($stmt, "s", $requestedID);
    $stmt -> execute();

  $result = $stmt -> get_result();
    while($row = $result -> fetch_assoc()){
        $id = $row['id'];
        $office = $row['office'];
        $research = $row['research'];
        $projectTitle = $row['projectTitle'];
        $projectNumber = $row['projectNumber'];
        $projectDescription = $row['projectDescription'];
        $DepartmentalCode = $row['DepartmentalCode'];
        $deptID = $row['deptID'];
        $dateProposed = $row['dateProposed'];
        $dateReceived = $row['dateReceived'];
        $approved = $row['approved'];
        $signedRPA = $row['signedRPA'];
        $WEPA = $row['WEPA'];
        $dateWithdrawn = $row['dateWithdrawn'];
        $dateCompleted = $row['dateCompleted'];
        $HostOrganizationName = $row['HostOrganizationName'];
        $hostOrganizationID = $row['hostOrganizationID'];
        $courseReq = $row['courseReq'];
        $notes = $row['notes'];
        $BFUser = $row['BFUser'];
        $BFActivity = $row['BFActivity'];
        $facultySupervisorID = $row['facultySupervisorID'];
        $BFDateOfNote = $row['BFDateOfNote'];
        $dateProjectMatched = $row['dateProjectMatched'];
        $callNumber = $row['callNumber'];
        $staffID = $row['staffID'];
        $staffCode = $row['staffCode'];
        $PClink = $row['PClink'];
        $departmentCode = $row['departmentCode'];
        $institutionID = $row['institutionID'];
        $status_percentage = $row['status_percentage'];
      }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Projects </title>
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
            <h1><?php echo $projectTitle ?></h1>
            <h5 style="color:red;">Field's with a '*' are required for submission!</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="project-main.php">DataTables</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


      <div class="row">
        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($office_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group office">
          <h3 style="color:red; display:inline">*</h3>  <p style="display:inline">Office:</p>
            <input type="text" name="office" class="form-control" value="<?php echo $office; ?>">
          </div>
          <span class="help-block"><?php echo $office_err; ?></span>
        </div>
        </div>


        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($research_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group research">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Research:</p>
            <input type="text" name="research" class="form-control" value="<?php echo $research; ?>">
          </div>
          <span class="help-block"><?php echo $research_err; ?></span>
        </div>
        </div>
      </div>



        <br>
        <br>



        <div class="row">
        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($projectTitle_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group projectTitle">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Project Title:</p>
            <input type="text" name="projectTitle" class="form-control" value="<?php echo $projectTitle; ?>">
          </div>
          <span class="help-block"><?php echo $projectTitle_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($projectNumber_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group projectNumber">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Project Number:</p>
            <input type="text" name="projectNumber" class="form-control" value="<?php echo $projectNumber; ?>">
          </div>
          <span class="help-block"><?php echo $projectNumber_err; ?></span>
        </div>
      </div>
      </div>



        <br>
        <br>


        <div class="row">
          <div id="student" class="col-6">
          <div class="form group <?php echo (!empty($deptID_err)) ? 'has-error' : ''; ?>">
            <span class "label inbox-info"></span>
            <div class = "group deptID">
              <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Department ID:</p>
              <input type="text" name="deptID" class="form-control" value="<?php echo $deptID; ?>">
            </div>
            <span class="help-block"><?php echo $deptID_err; ?></span>
          </div>
          </div>


        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($DepartmentalCode_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group DepartmentalCode">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Departmental Code:</p>
            <input type="text" name="DepartmentCode" class="form-control" value="<?php echo $DepartmentalCode; ?>">
          </div>
          <span class="help-block"><?php echo $DepartmentalCode_err; ?></span>
        </div>
        </div>
      </div>

        <br>
        <br>




      <div class="form group <?php echo (!empty($projectDescription_err)) ? 'has-error' : ''; ?>">
        <span class "label inbox-info"></span>
        <div class = "group projectDescription">
          <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Project Description:</p>
          <input type="text" name="projectDescription" class="form-control" value="<?php echo $projectDescription; ?>">
        </div>
        <span class="help-block"><?php echo $projectDescription_err; ?></span>
      </div>



        <br>
        <br>






        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($dateProposed_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group dateProposed">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Date Proposed:</p>
            <input type="text" name="dateProposed" class="form-control" value="<?php echo $dateProposed; ?>">
          </div>
          <span class="help-block"><?php echo $dateProposed_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($dateReceived_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group dateRecieved">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Date Recieved:</p>
            <input type="text" name="dateRecieved" class="form-control" value="<?php echo $dateReceived; ?>">
          </div>
          <span class="help-block"><?php echo $dateReceived_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>
        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($approved_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group approved">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Approved: (When a project gets approved, its status will change from "submitted" to "in_progress")</p> <br>
            <?php if ($approved == 1) {
              $checkyes = "checked";
            }else {
              $checkno = "checked";
            }?>
            <input type="radio" id="yes" name="approved" value="1"   <?php echo $checkyes?>>
                <label for="yes">Yes</label><br>
                <input type="radio" id="no" name="approved" value="0" <?php echo $checkno?>>
                <label for="no">No</label><br>
          </div>
          <span class="help-block"><?php echo $approved_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($signedRPA_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group signedRPA">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Signed RPA:</p>
            <input type="text" name="signedRPA" class="form-control" value="<?php echo $signedRPA; ?>">
          </div>
          <span class="help-block"><?php echo $signedRPA_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>
        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($WEPA_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group WEPA">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">WEPA:</p>
            <input type="text" name="WEPA" class="form-control" value="<?php echo $WEPA; ?>">
          </div>
          <span class="help-block"><?php echo $WEPA_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($dateWithdrawn_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group dateWithdrawn">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Date Withdrawn:</p>
            <input type="text" name="dateWithdrawn" class="form-control" value="<?php echo $dateWithdrawn; ?>">
          </div>
          <span class="help-block"><?php echo $dateWithdrawn_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>
        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($dateCompleted_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group dateCompleted">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Date Completed:</p>
            <input type="text" name="dateCompleted" class="form-control" value="<?php echo $dateCompleted; ?>">
          </div>
          <span class="help-block"><?php echo $dateCompleted_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($HostOrganizationName_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group HostOrganizationName">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Host Organization Name:</p>
            <input type="text" name="HostOrganizationName" class="form-control" value="<?php echo $HostOrganizationName; ?>">
          </div>
          <span class="help-block"><?php echo $HostOrganizationName_err; ?></span>
        </div>
      </div>
      </div>

      <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($courseReq_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group courseReq">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Course Requirement:</p>
            <input type="text" name="courseReq" class="form-control" value="<?php echo $courseReq; ?>">
          </div>
          <span class="help-block"><?php echo $courseReq_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($notes_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group notes">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Notes:</p>
            <textarea rows="4" cols="50" name="notes" class="form-control">
            <?php echo $notes; ?>  </textarea>
          </div>
          <span class="help-block"><?php echo $notes_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>

        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($BFUser_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group BFUser">
            <h3 style="color:red; display:inline">*</h3> <p style="display:inline">BF User:</p>
            <input type="text" name="BFUser" class="form-control" value="<?php echo $BFUser; ?>">
          </div>
          <span class="help-block"><?php echo $BFUser_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($BFActivity_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group BFActivity">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">BF Activity:</p>
            <input type="text" name="BFActivity" class="form-control" value="<?php echo $BFActivity; ?>">
          </div>
          <span class="help-block"><?php echo $BFActivity_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>

        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($facultySupervisorID_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group facultySupervisorID">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Faculty Supervisor ID:</p>
            <input type="text" name="facultySupervisorID" class="form-control" value="<?php echo $facultySupervisorID; ?>">
          </div>
          <span class="help-block"><?php echo $facultySupervisorID_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($BFDateOfNote_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group BFDateOfNote">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">BF Date Of Note:</p>
            <input type="text" name="BFDateOfNote" class="form-control" value="<?php echo $BFDateOfNote; ?>">
          </div>
          <span class="help-block"><?php echo $BFDateOfNote_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>

        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($dateProjectMatched_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group dateProjectMatched">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Date Project Matched:</p>
            <input type="text" name="dateProjectMatched" class="form-control" value="<?php echo $dateProjectMatched; ?>">
          </div>
          <span class="help-block"><?php echo $dateProjectMatched_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($callNumber_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group callNumber">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Call Number:</p>
            <input type="text" name="callNumber" class="form-control" value="<?php echo $callNumber; ?>">
          </div>
          <span class="help-block"><?php echo $callNumber_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>

        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($staffID_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group staffID">
            <p>Staff ID:</p>
            <input type="text" name="staffID" class="form-control" value="<?php echo $staffID; ?>">
          </div>
          <span class="help-block"><?php echo $staffID_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($staffCode_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group staffCode">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Staff Code:</p>
            <input type="text" name="staffCode" class="form-control" value="<?php echo $staffCode; ?>">
          </div>
          <span class="help-block"><?php echo $staffCode_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>
        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($PClink_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group PClink">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">PClink:</p>
            <input type="text" name="PClink" class="form-control" value="<?php echo $PClink; ?>">
          </div>
          <span class="help-block"><?php echo $PClink_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($departmentCode_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group departmentCode">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Department Code:</p>
            <input type="text" name="departmentCode" class="form-control" value="<?php echo $departmentCode; ?>">
          </div>
          <span class="help-block"><?php echo $departmentCode_err; ?></span>
        </div>
      </div>
      </div>


        <br>
        <br>

        <div class="row">
          <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($institutionID_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group institutionID">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Institution ID:</p>
            <input type="text" name="institutionID" class="form-control" value="<?php echo $institutionID; ?>">
          </div>
          <span class="help-block"><?php echo $institutionID_err; ?></span>
        </div>
        </div>

        <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($status_percentage_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group status_percentage">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Status Percentage:</p>
            <input type="text" name="status_percentage" class="form-control" value="<?php echo $status_percentage; ?>">
          </div>
          <span class="help-block"><?php echo $status_percentage_err; ?></span>
        </div>
      </div>
      </div>

        <br>
        <br>

    <div class="row">
      <div id="student" class="col-6">
        <div class="form group <?php echo (!empty($hostOrganizationID_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group hostOrganizationID">
        <h3 style="color:red; display:inline">*</h3>     <p style="display:inline">Host Organization ID:</p>
            <input type="text" name="hostOrganizationID" class="form-control" value="<?php echo $hostOrganizationID; ?>">
          </div>
          <span class="help-block"><?php echo $hostOrganizationID_err; ?></span>
        </div>
      </div>
    </div>


        <div id="project" class="col-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Linked Students(<?php if(is_a($tableStudent,"mysqli_result")) echo $counter?> results)</h3>
            </div>
          </div>
          <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Student ID</th>
                <th>email</th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < $counter; $i++) {
                // code...
                echo "<tr>";
                  echo "<td><a href='studentprofile.php?id={$projectArray[$i]['0']}' style='color:red'>{$projectArray[$i]['0']}</a></td>";
                  echo "<td>{$projectArray[$i]['1']}</td>";
                  echo "<td>{$projectArray[$i]['2']}</td>";
                  echo "<td>{$projectArray[$i]['3']}</td>";
                  echo "<td>{$projectArray[$i]['4']}</td>";
                  echo "</tr>";
               }?>
            </tbody>
          </table>
        </div>
      </div>




          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-default" value="Reset">

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
