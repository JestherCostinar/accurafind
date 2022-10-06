<?php
include_once "partial/header.php";
include('connection/config.php');
session_start();

$email_pass = $_SESSION['verifyemail'];
$date_today = date('Y-m-d');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $code = $_POST['code'];

    $getVerification = mysqli_query($conn, "SELECT * FROM tbl_verificationcode WHERE email = '$email' AND code ='$code' AND verification_date = '$date_today'");
    $verificationRow = mysqli_fetch_assoc($getVerification);

    if (is_array($verificationRow)) {
        $updateProfile = mysqli_query($conn, "UPDATE tblapplicant set IS_VERIFIED = '1', VERIFY_LEVEL = 'Basic Level' WHERE EMAIL = '$email'");
        session_unset();
        header("Location: login.php?success=Email has been verified");
    } else {
        header("Location: verify.php?error=Invalid verification code");
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
                <form class="form-signin" id="login" method="post" action="verify.php" name="login">
                    <input type="hidden" name="email" value="<?php echo $email_pass ?>" required>
                    <input class="us" name="code" placeholder="Enter your verification here" />
                    <input name="submit" id="submit" type="submit" placeholder="sign in" />
                </form>


            </div>
        </div>
    </div>
</main>

<?php include_once "partial/footer.php"; ?>