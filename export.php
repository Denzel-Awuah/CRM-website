<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


if (isset($_POST["export"]))
{
    $connect = mysqli_connect("loki.trentu.ca", "apollosoftware", "yon9Knyk", "apollosoftware");
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=projectForm.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'Organization Name', 'Contact', 'Address', 'Phone', 'Email', 'Website', 'Logo Consent', 'Organization Purpose', 'Organization Year', 'Organization Employee', 'Approved', 'Theme', 'Project Scale', 'Project Title', 'Project Description', 'Project Task', 'Project Start Date', 'Project End Date', 'Research Ethics 1', 'Research Ethics 2', 'Research Ethics 3', 'Project Implementation', 'Screening Requirements 1', 'Screening Requirements 2', 'Additional Skills', 'Resources Needed', 'Funding Needed', 'Additional Notes', 'Photo Link'));
    $query = "SELECT * FROM projectForm";
    $result = mysqli_query($connect, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>