<?php
require_once "../../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

$del = $_GET['deleteId'];
$appid = $_GET['applicantid'];

$count_query = mysqli_query($conn, "SELECT COUNT(*) as applicant_count FROM tblemployee WHERE tblemployee.APPLICANTID = '$appid'");
$applicant_row = mysqli_fetch_assoc($count_query);
$count = $applicant_row['applicant_count'];
$status_remark = 'Unemployed';

if ($count == 1) {
    $update_status = mysqli_query($conn, "UPDATE tblapplicant SET tblapplicant.status = '$status_remark' WHERE tblapplicant.APPLICANTID = '$appid'");
}

$query = mysqli_query($conn, "DELETE FROM tblemployee WHERE EMPLOYEEID='$del'");
$today = date("Y-m-d H:i:s");
$logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Remove Employee')");
if ($query) {
    header('location:employee.php');
    echo "<script>alert('Record has been successfully deleted')</script>";
} else {
    echo "<script>alert('error')</script>";
}
