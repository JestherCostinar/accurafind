<?php
require_once "../../../connection/config.php";

$del = $_GET['del'];

$query = mysqli_query($conn, "DELETE FROM tblusers WHERE userid='$del'");
if ($query) {
    header("Location: user.php?msg=User has been deleted");
} else {
    echo "<script>alert('error')</script>";
    exit;
}
