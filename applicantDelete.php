<?php
include('connection/config.php');
$work = $_GET['workDelete'] ?? null;
$educ = $_GET['educDelete'] ?? null;
$certificate = $_GET['certificate'] ?? null;
$reference = $_GET['reference'] ?? null;
$requirement = $_GET['reqDelete'] ?? null;

if ($educ) {
    $query = mysqli_query($conn, "DELETE FROM tblapplicant_education WHERE EDUCATION_ID = '$educ'");
} elseif ($work) {
    $query = mysqli_query($conn, "DELETE FROM tblapplicant_workexperience WHERE WORK_EXPERIENCE_ID ='$work'");
} elseif ($certificate) {
    $query = mysqli_query($conn, "DELETE FROM tblcertificate WHERE CERTIFICATE_ID ='$certificate'");
} elseif ($reference) {
    $query = mysqli_query($conn, "DELETE FROM tblcharacter_reference WHERE REFERENCE_ID ='$reference'");
} elseif ($requirement) {
    $query = mysqli_query($conn, "DELETE FROM tbljob_requirements WHERE REQUIREMENTS_ID ='$requirement'");
}

if ($query) {
    header("Location: applicant_profile.php");
} else {
    echo "<script>alert('error')</script>";
}
