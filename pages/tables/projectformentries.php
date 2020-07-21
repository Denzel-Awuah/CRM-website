<?php
// Initialize the session
session_start();

$projectArray = array();
$counter = 0;

require_once "../../config.php";
//Retrieve the list of currently approved but not yet begun projects
$sql = "SELECT * FROM projectForm";

//Retrieve and store as a variable
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    $projectArray[$counter] = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],
    $row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],
  $row[22],$row[23],$row[24],$row[25],$row[26],$row[27],$row[28]);
    $counter++;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Project Forms</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index1.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!-- lockscreen  -->
    <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" accesskey="l" class="nav-link">
        <i class="nav-icon fas fa-lock"></i>
        </a>
      </li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Bogdan Dawabsheh
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Denzel Awuah
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user6-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nikhil Pai Ganesh
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index1.php" class="brand-link">
     <center> <img src="../../images/TrentCommResCentre.jpg" alt="TCRC"
           style="opacity: .8" width = "90%" height = "70%"> </center>
      <!-- <span class="brand-text font-weight-light">TCRC</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block"> Logged in as <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
          <a href="logout.php" class="d-block" style= "color: red"> Log Out </a>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../../index1.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Projects
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Students
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Faculty
                <!-- <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Applications
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-pen nav-icon"></i>
                  <p>Student Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-pen nav-icon"></i>
                  <p>Project Form</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="../../pages/tables/main.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <!-- <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
          </li>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Widgets
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
      </li>
          <li class="nav-header">ADDITIONAL FEATURES </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                User Operations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Log Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Forgot Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recover Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://docs.google.com/document/d/1qh_c8LGp0_c3caKWR8ytAoitVXK7_XQUbmm1oNc94Gg/edit?usp=sharing" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
        </ul>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Project Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index1.php">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Edit Project Form</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th> </th>
                  <th>id</th>
                  <th>Organization Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Website</th>
                  <th>Logo Consent</th>
                  <th>Organization Purpose</th>
                  <th>Organization Year</th>
                  <th>Organization Employee</th>
                  <th>Approved</th>
                  <th>Theme</th>
                  <th>Project Scale</th>
                  <th>Project Title</th>
                  <th>Project Description</th>
                  <th>Project Task</th>
                  <th>Project Start Date</th>
                  <th>Project End Date</th>
                  <th>Research Ethics 1</th>
                  <th>Research Ethics 2</th>
                  <th>Research Ethics 3</th>
                  <th>Project Implementation</th>
                  <th>Screening Requirements 1</th>
                  <th>Screening Requirements 2</th>
                  <th>Additional Skills</th>
                  <th>Resources Needed</th>
                  <th>Funding Needed</th>
                  <th>Additional Notes</th>
                  <th>Photo Link</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $_SESSION["theId"] =1;
                  for($i = 0; $i < $counter; $i++){
                  ?>
                  <tr>
                  <?php
                    echo "<td><a href='../../editprojectform.php'>Edit</a></td>";
                    echo "<td>{$projectArray[$i]['0']}</td>";
                    echo "<td>{$projectArray[$i]['1']}</td>";
                    echo "<td>{$projectArray[$i]['2']}</td>";
                    echo "<td>{$projectArray[$i]['3']}</td>";
                    echo "<td>{$projectArray[$i]['4']}</td>";
                    echo "<td>{$projectArray[$i]['5']}</td>";
                    echo "<td>{$projectArray[$i]['6']}</td>";
                    echo "<td>{$projectArray[$i]['7']}</td>";
                    echo "<td>{$projectArray[$i]['8']}</td>";
                    echo "<td>{$projectArray[$i]['9']}</td>";
                    echo "<td>{$projectArray[$i]['10']}</td>";
                    echo "<td>{$projectArray[$i]['11']}</td>";
                    echo "<td>{$projectArray[$i]['12']}</td>";
                    echo "<td>{$projectArray[$i]['13']}</td>";
                    echo "<td>{$projectArray[$i]['14']}</td>";
                    echo "<td>{$projectArray[$i]['15']}</td>";
                    echo "<td>{$projectArray[$i]['16']}</td>";
                    echo "<td>{$projectArray[$i]['17']}</td>";
                    echo "<td>{$projectArray[$i]['18']}</td>";
                    echo "<td>{$projectArray[$i]['19']}</td>";
                    echo "<td>{$projectArray[$i]['20']}</td>";
                    echo "<td>{$projectArray[$i]['21']}</td>";
                    echo "<td>{$projectArray[$i]['22']}</td>";
                    echo "<td>{$projectArray[$i]['23']}</td>";
                    echo "<td>{$projectArray[$i]['24']}</td>";
                    echo "<td>{$projectArray[$i]['25']}</td>";
                    echo "<td>{$projectArray[$i]['26']}</td>";
                    echo "<td>{$projectArray[$i]['27']}</td>";
                    echo "<td>{$projectArray[$i]['28']}</td>";
                  //  echo "<td>{$projectArray[$i]['29']}</td>";
                    ?>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th> </th>
                  <th>id</th>
                  <th>Organization Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Website</th>
                  <th>Logo Consent</th>
                  <th>Organization Purpose</th>
                  <th>Organization Year</th>
                  <th>Organization Employee</th>
                  <th>Approved</th>
                  <th>Theme</th>
                  <th>Project Scale</th>
                  <th>Project Title</th>
                  <th>Project Description</th>
                  <th>Project Task</th>
                  <th>Project Start Date</th>
                  <th>Project End Date</th>
                  <th>Research Ethics 1</th>
                  <th>Research Ethics 2</th>
                  <th>Research Ethics 3</th>
                  <th>Project Implementation</th>
                  <th>Screening Requirements 1</th>
                  <th>Screening Requirements 2</th>
                  <th>Additional Skills</th>
                  <th>Resources Needed</th>
                  <th>Funding Needed</th>
                  <th>Additional Notes</th>
                  <th>Photo Link</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- Export as CSV  -->
            <center>
            <form method="post" action="../../export.php">
               <input type="submit" name="export" value="CSV Export"/>
                </form>
                </center>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "scrollX": true
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
