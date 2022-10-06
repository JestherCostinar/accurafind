
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "job_portal";

// Connect to server and select databse.
$conn = mysqli_connect("$host", "$username", "$password") or die("Unable to select database");

mysqli_select_db($conn, "$database") or die("cannot select database");

?>