<?php
include_once "partial/header.php";
include('connection/config.php');
date_default_timezone_set('Asia/Manila');

session_start();
$inputemail = $_SESSION['emailToPass'];

$date_today = date('Y-m-d');

if (isset($_POST['submit_code'])) {
    $inputCode = $_POST['code'];
    $getVerification = mysqli_query($conn, "SELECT * FROM tbl_verificationcode WHERE email = '$inputemail' AND code ='$inputCode' AND verification_date = '$date_today'");

    $num_rows = mysqli_num_rows($getVerification);
    if ($num_rows == 0) {
        header("Location: formatpassword_code.php?error=Invalid Code, Try again");
        exit;
    } else {
        header("Location: new_password.php");
        exit;
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
                <?php } ?>
                <p>Enter you verification code here</p>
                <form class="form-signin" id="login" method="post" action="" name="login">
                    <input class="us" name="code" type="text" placeholder="Enter verification code" />
                    <input name="submit_code" id="submit" type="submit" placeholder="sign in" />
                </form>
            </div>
        </div>
    </div>
</main>

<?php include_once "partial/footer.php"; ?>