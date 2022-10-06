<?php
include_once "partial/header.php";
include('connection/config.php');

$pass = '';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $dec_pass = sha1($pass);

    $query = mysqli_query($conn, "SELECT *, CONCAT(LNAME, ', ', FNAME, ' ', MNAME, '.') AS fullname FROM tblapplicant WHERE EMAIL = '$email' AND PASSWORD ='$dec_pass' AND IS_VERIFIED = '1'");
    $row = mysqli_fetch_assoc($query);
    $today = date("Y-m-d H:i:s");

    if (is_array($row)) {
        $_SESSION['applicantid'] = $row['APPLICANTID'];
    } else {
        header("Location: login.php?error=Incorrect email or password");
    }
    if (isset($_SESSION['applicantid'])) {
        session_start();
        $_SESSION['fname'] = $row['FNAME'];
        $_SESSION['lname'] = $row['LNAME'];
        $_SESSION['mname'] = $row['MNAME'];
        $_SESSION['address'] = $row['ADDRESS'];
        $_SESSION['city'] = $row['CITY'];
        $_SESSION['state'] = $row['STATE'];
        $_SESSION['zip'] = $row['ZIP'];
        $_SESSION['contactno'] = $row['CONTACTNO'];
        $_SESSION['username'] = $row['USERNAME'];
        $_SESSION['email'] = $row['EMAIL'];
        $_SESSION['password'] = $pass;
        $_SESSION['applicantid'] = $row['APPLICANTID'];
        $_SESSION['objective'] = $row['OBJECTIVES'];
        $_SESSION['appstatus'] = $row['STATUS'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['age'] = $row['AGE'];
        $_SESSION['birthday'] = $row['BIRTHDATE'];
        $_SESSION['highest_educ'] = $row['HIGHEST_EDUC'];
        $_SESSION['work_exp'] = $row['WORK_EXP'];
        $_SESSION['picture'] = $row['FILE_NAME'];
        $_SESSION['verifylevel'] = $row['VERIFY_LEVEL'];
        $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['fullname']}', '$today', 'Applicant', 'Login')");
        header("Location: applicant_joblist.php");
    }
}
?>
<main>
    <!-- slider Area Start-->
    <div class="apply-process-area pt-200 pb-200">

        <div class="wrapper">
            <div id="formContent">

                <?php if (isset($_GET['error'])) { ?>
                    <div style="margin: 2rem;" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_GET['error']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } elseif (isset($_GET['success'])) { ?>
                    <div style="margin: 2rem;" class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_GET['success']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

                <form class="form-signin" id="login" method="post" action="login.php" name="login">

                    <input class="us" type="email" id="email" name="email" placeholder="Enter your email here" />
                    <input class="pw" type="password" id="pass" name="pass" placeholder="Enter your password here" />

                    <input class="mb-1" name="submit" id="submit" type="submit" placeholder="sign in" />
                    <small id="passwordHelpBlock" class="form-text text-muted mb-4">
                        <a href="insert_email.php" style="color: #007bff; text-decoration:underline">forgot password</a>
                    </small>
                </form>

                <div id="formFooter">
                    
                    <p class="mb-0">Don't have account? <a href="register.php" style="color:cornflowerblue; text-decoration: underline;">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once "partial/footer.php"; ?>