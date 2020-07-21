<?php


session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if (isset($_POST["export-contact"]))
{
    $connect = mysqli_connect("loki.trentu.ca", "apollosoftware", "yon9Knyk", "apollosoftware");
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=contact.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'Title', 'First Name', 'Last Name', 'Work Email', 'Work Phone', 'Work Location', 'Institution ID', 'Contact Type', 'TCRC mailing approval', 'ULinks mailing Approval', 'CLinks mailing Approval', 'Show as fellow', 'Fellow Type'));
    $query = "SELECT * FROM contact";
    $result = mysqli_query($connect, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>