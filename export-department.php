<?php


session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


if (isset($_POST["export-department"]))
{
    $connect = mysqli_connect("loki.trentu.ca", "apollosoftware", "yon9Knyk", "apollosoftware");
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=department.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'departmentName', 'institutionName', 'NLA'));
    $query = "SELECT * FROM department";
    $result = mysqli_query($connect, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>