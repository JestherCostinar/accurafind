<?php
require_once "../../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

$regsId = $_GET['regisid'];

$query = mysqli_query($conn, "DELETE FROM tbljobregistration WHERE REGISTRATIONID ='$regsId'");
$today = date("Y-m-d H:i:s");
$logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Remove Achieve Applicant')");
if ($query) {
    header('location:archieved.php');
    echo "<script>alert('Record has been successfully deleted')</script>";
} else {
    echo "<script>alert('error')</script>";
}
