<?php
include_once "partial/header.php";
include('connection/config.php');
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$date_today = date('Y-m-d');

if (isset($_POST['submit_email'])) {
    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 8);
    $email = $_POST['email_pass'];


    $isEmailValid = mysqli_query($conn, "SELECT email FROM tblapplicant WHERE tblapplicant.email = '$email' and tblapplicant.IS_VERIFIED = 1");

    $num_rows = mysqli_num_rows($isEmailValid);
    if ($num_rows == 0) {
        header("Location: insert_email.php?checkEmail=Email is not registered");
        exit;
    }


    $mail = new PHPMailer(true);

    $insert_verification  = mysqli_query($conn, "INSERT INTO tbl_verificationcode(code, email, verification_date) VALUES ('$verification_code', '$email', '$date_today')");

    try {
        //Enable verbose debug output
        $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;

        //Send using SMTP
        $mail->isSMTP();

        //Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';

        //Enable SMTP authentication
        $mail->SMTPAuth = true;


        //SMTP username
        $mail->Username = 'accura.find1@gmail.com';

        //SMTP password
        $mail->Password = 'emviozyeetqehyyb';

        //Enable TLS encryption;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('accura.find1@gmail.com', 'Accurafind');

        //Add a recipient
        $mail->addAddress($email, 'Accurafind forgot password');

        //Set email format to HTML
        $mail->isHTML(true);

        $mail->Subject = 'Email verification';
        $mail->Body    = '<p>For this email, enter this verification code the have new password: <b style="font-size: 30px;">' . $verification_code . '</b>' . '. NEVER share this code with others under any circumstances.' . '</p>';

        $mail->send();
        // echo 'Message has been sent';
        session_start();
        $_SESSION['emailToPass'] = $email;
        header("Location: formatpassword_code.php");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
<main>
    <!-- slider Area Start-->
    <div class="apply-process-area pt-200 pb-200">

        <div class="wrapper">

            <div id="formContent">
                <?php if (isset($_GET['checkEmail'])) { ?>
                    <div style="margin: 2rem;" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_GET['checkEmail']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

                <p>Enter your email for code verification</p>
                <form class="form-signin" id="login" method="post" action="" name="login">
                    <input class="us" name="email_pass" type="email" placeholder="Enter your email here" />
                    <input name="submit_email" id="submit" type="submit" placeholder="sign in" />
                </form>
            </div>
        </div>
    </div>
</main>

<?php include_once "partial/footer.php"; ?>