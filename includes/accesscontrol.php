<?php
// Initialize the session


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


if (!isset($_SESSION["flag"])) {
  header("location: login.php");
}
else if ($_SESSION["flag"] == "C") {
  header("location: studentIndex.php?id=". $_SESSION["id"]);
}



?>
