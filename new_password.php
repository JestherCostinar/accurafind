<?php
include_once "partial/header.php";
include('connection/config.php');

session_start();
$inputemail = $_SESSION['emailToPass'];

$date_today = date('Y-m-d');

if (isset($_POST['newPassword'])) {
    $inputPass = $_POST['pass'];
    $updatePassword = mysqli_query($conn, "UPDATE tblapplicant SET password = sha1('$inputPass') WHERE email = '$inputemail' AND IS_VERIFIED = 1");

    if ($updatePassword) {
        session_unset();
        header("Location: login.php?success=New password has been set");
    }
}

?>
<main>
    <!-- slider Area Start-->
    <div class="apply-process-area pt-200 pb-200">
        <div class="wrapper">

            <div id="formContent">
                
                <form class="form-signin" id="login" method="post" action="" name="login">
                    <input class="us" name="pass" type="password" minlength="8" placeholder="Enter New Password" required/>
                    <input name="newPassword" id="submit" type="submit" placeholder="sign in" />
                </form>
            </div>
        </div>
    </div>
</main>

<?php include_once "partial/footer.php"; ?>