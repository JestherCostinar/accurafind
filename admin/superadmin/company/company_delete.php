<?php
require_once "../../../connection/config.php";
$del = $_GET['del'];

$query = mysqli_query($conn, "DELETE FROM tblcompany WHERE companyid='$del'");
if ($query) {
    header("Location: company.php?companyMsg=Company record has been deleted");
    exit();
} else {
    echo "<script>alert('error')</script>";
}
