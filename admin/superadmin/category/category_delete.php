<?php
require_once "../../../connection/config.php";
$del = $_GET['del'];

$query = mysqli_query($conn, "DELETE FROM tblcategory WHERE categoryid = '$del'");
if ($query) {
    header("Location: category.php?categoryMsg=Category has been deleted");
    exit();
} else {
    echo "<script>alert('error')</script>";
}
