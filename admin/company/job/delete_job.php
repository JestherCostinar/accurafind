<?php
require_once "../../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

$del = $_GET['del'];

$query = mysqli_query($conn, "DELETE FROM tbljob WHERE JOBID='$del'");
$today = date("Y-m-d H:i:s");
$logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Delete job')");

if ($query) {
    header("Location: job.php?jobMessage=Job has been successfully delete");
} else {
    echo "<script>alert('error')</script>";
}
