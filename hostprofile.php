<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

$id = $orgName = $orgType = $hostClass = $contactName = $notes = $NLA = $departmentID = $WSIB = "";
$address = $address_alt = $city = $province = $phone1 = $phone2 = $fax = $email1 = $email2 = $website = "";

$orgName_err = $orgType_err = $hostClass_err = $contactName_err = $notes_err = $NLA_err = $departmentID_err = $WSIB_err = "";
$address_err = $address_alt_err = $city_err = $province_err = $phone1_err = $phone2_err = $fax_err = $email1_err = $email2_err = $website_err = "";

$hostArray = array();
$counter = 0; //keep track of number of linked students
$tableHost = "";  // for retrieving student info from student table
$tableProject = ""; //for retrieving info from studentProject table

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



$sql = "SELECT * FROM projectHost WHERE hostID = ".$_SESSION["id"];

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







//if user submits the form
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(empty(trim($_POST['orgName']))){
    $orgName_err = "orgName";
  } else {
    $orgName = trim($_POST["orgName"]);
  }

  if(empty(trim($_POST['orgType']))){
    $orgType_err = "orgType";
  } else {
    $orgType = trim($_POST["orgType"]);
  }

  if(empty(trim($_POST['hostClass']))){
    $hostClass_err = "hostClass";
  } else {
    $hostClass = trim($_POST["hostClass"]);
  }

  if(empty(trim($_POST['contactName']))){
    $contactName_err = "contactName";
  } else {
    $contactName = trim($_POST["contactName"]);
  }

  if(empty(trim($_POST['notes']))){
    $notes_err = "$notes";
  } else {
    $notes = trim($_POST["notes"]);
  }

  if(empty(trim($_POST['NLA']))){
    $NLA_err = "NLA";
  } else {
    $NLA = trim($_POST["NLA"]);
  }

  if(empty(trim($_POST['departmentID']))){
    $departmentID_err = "departmentID";
  } else {
    $departmentID = trim($_POST["departmentID"]);
  }

  if(empty(trim($_POST['WSIB']))){
    $WSIB_err = "WSIB";
  } else {
    $WSIB = trim($_POST["WSIB"]);
  }

  if(empty(trim($_POST['address']))){
    $address_err = "address";
  } else {
    $address = trim($_POST["address"]);
  }

  if(empty(trim($_POST['address_alt']))){
    $address_alt_err = "address";
  } else {
    $address_alt = trim($_POST["address_alt"]);
  }

  if(empty(trim($_POST['city']))){
    $city_err = "city";
  } else {
    $city = trim($_POST["city"]);
  }

  if(empty(trim($_POST['province']))){
    $province_err = "province";
  } else {
    $province = trim($_POST["province"]);
  }


  if(empty(trim($_POST['phone1']))){
    $phone1_err = "phone1";
  } else {
    $phone1 = trim($_POST["phone1"]);
  }

  if(empty(trim($_POST['phone2']))){
    $phone2_err = "phone2";
  } else {
    $phone2 = trim($_POST["phone2"]);
  }

  if(empty(trim($_POST['fax']))){
    $fax_err = "fax";
  } else {
    $fax = trim($_POST["fax"]);
  }

  if(empty(trim($_POST['email1']))){
    $email1_err = "email1";
  } else {
    $email1 = trim($_POST["email1"]);
  }

  if(empty(trim($_POST['email2']))){
    $email2_err = "email2";
  } else {
    $email2 = trim($_POST["email2"]);
  }

  if(empty(trim($_POST['website']))){
    $website_err = "website";
  } else {
    $website = trim($_POST["website"]);
  }


  $requestedID = $_SESSION["id"];


  if(empty($orgName_err)
  && empty ($orgType_err)
  && empty ($hostClass_err)
  && empty ($contactName_err)
  && empty ($notes_err)
  && empty ($NLA_err)
  && empty ($departmentID_err)
  && empty ($WSIB_err)
  && empty ($address_err)
  && empty ($address_alt_err)
  && empty ($city_err)
  && empty ($province_err)
  && empty ($phone1_err)
  && empty ($phone2_err)
  && empty ($fax_err)
  && empty ($email1_err)
  && empty ($email2_err)
  && empty ($website_err))
  {
    echo "i get here";
    //TO DO
    $sql = "UPDATE hostOrganization SET orgName = ?, orgType = ?, hostClass = ?, contactName = ?, notes = ?, NLA = ?, departmentID = ?,
    WSIB = ? WHERE id = ?";

    if($stmt = mysqli_prepare($link,$sql)){
      mysqli_stmt_bind_param($stmt,"ssssssssi", $orgName , $orgType , $hostClass , $contactName , $notes ,
      $NLA ,  $departmentID, $WSIB , $requestedID);


      if(mysqli_stmt_execute($stmt)){
        $sql = "UPDATE hostAddress SET address = ?, addressALT = ?, city = ?, province = ?, phone1 = ?, phone2 = ?, fax = ?,
        email1 = ?, email2 = ?, website= ? WHERE organizationID = ?";

        if($stmt = mysqli_prepare($link,$sql)){
          mysqli_stmt_bind_param($stmt,"ssssssssssi", $address , $address_alt , $city , $province , $phone1 ,$phone2 ,  $fax, $email1 , $email2,
          $website, $organizationID);



          if(mysqli_stmt_execute($stmt)){
            header("location: hostprofile.php?id=".$requestedID);
          } else {
            //if there are problems, display error
            echo "ERROR at hostOrg update #2. Check database connection";
          }
        }
      } else {
        //if there are problems, display error
        echo "ERROR at hostOrg update #1. Check database connection";
      }
    }
  }
}

if(isset($requestedID)){
  $query = "SELECT * FROM hostOrganization LEFT OUTER JOIN hostAddress ON hostOrganization.id = hostAddress.organizationID WHERE hostOrganization.id = ".$requestedID;

  if($result = $link -> query($query)){

    //  $result = $stmt -> get_result();
    while($row = $result -> fetch_assoc()){
      $id = $row['id'];
      $orgName = $row['orgName'];
      $orgType = $row['orgType'];
      $hostClass = $row['hostClass'];
      $contactName = $row['contactName'];
      $notes = $row['notes'];
      $NLA = $row['NLA'];
      $departmentID =$row['departmentID'];
      $WSIB = $row['WSIB'];
      $address = $row['address'];
      $address_alt =$row['addressALT'];
      $city = $row['city'];
      $province = $row['province'];
      $phone1 = $row['phone1'];
      $phone2 = $row['phone2'];
      $fax = $row['fax'];
      $email1 = $row['email1'];
      $email2 = $row['email2'];
      $website = $row['website'];
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
              <h1><?php echo $orgName ?></h1>
              <h5 style="color:red;">Field's with a '*' are required for submission!</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="hostOrganization.php">DataTables</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <div class="card">
            <div class="card-header">
            <h3 class='card-title' ><strong> Host Information </strong> </h3>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($orgName_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group orgName">
                <h3 style="color:red; display:inline">*</h3>  <p style="display:inline">Organization Name:</p>
                  <input type="text" name="orgName" class="form-control" value="<?php echo $orgName; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $orgName_err; ?></span>
              </div>
            </div>


            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($orgType_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group orgType">
              <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Organization Type:</p>
                  <input type="text" name="orgType" class="form-control" value="<?php echo $orgType; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $orgType_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($hostClass_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group hostClass">
                  <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Host Class:</p>
                  <input type="text" name="hostClass" class="form-control" value="<?php echo $hostClass; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $hostClass_err; ?></span>
              </div>
            </div>


            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($contactName_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group contactName">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Contact Name:</p>
                  <input type="text" name="contactName" class="form-control" value="<?php echo $contactName; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $contactName_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row"  >
            <div class="col-12" >
              <div class="form group <?php echo (!empty($notes_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group notes">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Notes:</p>
                  <textarea  name="notes" class="form-control"  style="height: 5em;" ><?php echo $notes; ?> </textarea>
                </div>
                <span class="help-block" style="color:red;"><?php echo $notes_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($NLA_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group NLA">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">NLA:</p>
                  <input type="text" name="NLA" class="form-control" value="<?php echo $NLA; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $NLA_err; ?></span>
              </div>
            </div>


            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($departmentID_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group departmentID">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">departmentID:</p>
                  <input type="text" name="departmentID" class="form-control" value="<?php echo $departmentID; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $departmentID_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($WSIB_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group WSIB">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">WSIB:</p>
                  <input type="textarea" name="WSIB" class="form-control" value="<?php echo $WSIB; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $WSIB_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>
        </div>


          <div class="card">
            <div class="card-header">
            <h3 class='card-title' ><strong> Host Address Information <strong> </h3>
            </div>
          </div>

          <div class="card-body">



          <div class="row">
            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group address">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Address:</p>
                  <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $address_err; ?></span>
              </div>
            </div>

            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($address_alt_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group address_alt">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Alternative Address:</p>
                  <input type="text" name="address_alt" class="form-control" value="<?php echo $address_alt; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $address_alt_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group city">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">City:</p>
                  <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $city_err; ?></span>
              </div>
            </div>

            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group province">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Province:</p>
                  <input type="text" name="province" class="form-control" value="<?php echo $province; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $province_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>


          <div class="row">
            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($phone1_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group phone1">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Phone #1:</p>
                  <input type="text" name="phone1" class="form-control" value="<?php echo $phone1; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $phone1_err; ?></span>
              </div>
            </div>

            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($phone2_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group phone2">
                  <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Phone #2:</p>
                  <input type="text" name="phone2" class="form-control" value="<?php echo $phone2; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $phone2_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($fax_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group fax">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Fax:</p>
                  <input type="text" name="fax" class="form-control" value="<?php echo $fax; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $fax_err; ?></span>
              </div>
            </div>

            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($email1_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group email1">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Email #1:</p>
                  <input type="text" name="email1" class="form-control" value="<?php echo $email1; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $email1_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">

            <div id="host" class="col-6">
                        <div class="form group <?php echo (!empty($email2_err)) ? 'has-error' : ''; ?>">
                          <span class "label inbox-info"></span>
                          <div class = "group email1">
                          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Email #2:</p>
                            <input type="text" name="email2" class="form-control" value="<?php echo $email2; ?>">
                          </div>
                          <span class="help-block" style="color:red;"><?php echo $email2_err; ?></span>
                        </div>
                      </div>

            <div id="host" class="col-6">
              <div class="form group <?php echo (!empty($website_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group website">
                <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Website:</p>
                  <input type="text" name="website" class="form-control" value="<?php echo $website; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $website_err; ?></span>
              </div>
            </div>


          </div>

        </div>



        <?php include 'includes/linkedproject.php'; ?>




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
