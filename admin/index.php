<?php
session_start();
date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo/accurafind_logo.png" />
    <script src="assets/js/slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/login.css" />
    <title>Accurafind | login</title>
</head>

<body>
    <div class="wrapper">
        <div id="formContent">
            <img src="assets/img/accurafind_logo.png" id="icon" alt="Accurafind logo" />
            <?php if (isset($_GET['error'])) { ?>
                <div style="margin: 2rem;" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_GET['error']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <form class="form-signin" method="post" action="">

                <input type="email" id="email" name="email" placeholder="Enter your email here" />
                <input type="password" id="pass" name="pass" placeholder="Enter your password here" />
                <input name="submit" id="submit" type="submit" placeholder="sign in" />
            </form>

            <div id="formFooter">
                <!-- <a class="underlineHover" href="#">Forgot Password?</a> -->
            </div>
        </div>
    </div>
</body>

</html>

<?php
require_once "../connection/config.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $dec_pass = sha1($pass);

    $query = mysqli_query($conn, "SELECT * FROM tblusers WHERE email = '$email' AND password ='$dec_pass'");
    $row = mysqli_fetch_assoc($query);
    $today = date("Y-m-d H:i:s");

    if (is_array($row)) {
        $role = $row['ROLE'];
        $_SESSION['ROLE'] = $row['ROLE'];
        $_SESSION['HRNAME'] = $row['NAME'];
        $_SESSION['HREMAIL'] = $row['EMAIL'];
        $_SESSION['USERID'] = $row['USERID'];
        $_SESSION['COMPANYID'] = $row['COMPANYID'];
        $selectCompany = mysqli_query($conn, "SELECT tblcompany.COMPANY_NAME, tblusers.NAME FROM tblcompany INNER JOIN tblusers ON tblcompany.COMPANYID = '{$_SESSION['COMPANYID']}' AND tblusers.USERID = '{$_SESSION['USERID']}'");
        while ($getCompanyCount = mysqli_fetch_array($selectCompany)) {
            $_SESSION['COMPANY_NAME'] = $getCompanyCount['COMPANY_NAME'];
            $_SESSION['USER_NAME'] = $getCompanyCount['NAME'];
            $logname = $getCompanyCount['NAME'];
        }
        $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('$logname', '$today', '$role', 'Login')");
    } else {
        header("Location: index.php?error=Incorrect email or password");
        exit();
    }
    if (isset($_SESSION['COMPANYID'])) {
        if ($role == "Super Admin") {
            header("Location: superadmin/dashboard.php");
        } elseif ($role == "Company Admin") {
            header("Location: company/dashboard.php");
        }
    }
}

?>