<?php
require_once "../../../connection/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

$appid = $_GET['applicantid'];

$getApplicantInfo = mysqli_query($conn, "SELECT *, CONCAT(tblapplicant.LNAME, ', ', tblapplicant.FNAME, ' ', tblapplicant.MNAME) AS applicantname FROM tblapplicant WHERE APPLICANTID = '$appid' ");
while ($applicantRow = mysqli_fetch_array($getApplicantInfo)) {
    $level = $applicantRow['VERIFY_LEVEL'];
    $email = $applicantRow['EMAIL'];
    $fullname = $applicantRow['applicantname'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <title>Accurafind | Applicant</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/accurafind_logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.style.css" />
    <style>
        img {
            border: 3px solid #555;
            width: 500px;
            height: 500px;
        }

        .div-img {
            margin: auto;
            width: 50%;
            padding: 10px;
        }
    </style>
</head>

<body>
    <input type="checkbox" id="sidebar-toggle" />
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span>Accurafind</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>


        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="../dashboard.php">
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="../category/category.php">
                        <span class="ti-menu"></span>
                        <span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="../company/company.php">
                        <span class="ti-face-smile"></span>
                        <span>Company</span>
                    </a>
                </li>
                <li c>
                    <a href="../job/job.php">
                        <span class="ti-briefcase"></span>
                        <span>Job</span>
                    </a>
                </li>
                <li>
                    <a href="../user/user.php">
                        <span class="ti-user"></span>
                        <span>User</span>
                    </a>
                </li>
                <li class="active">
                    <a href="applicant.php">
                        <span class="ti-user"></span>
                        <span>Applicant to verify</span>
                    </a>
                </li>
                <li>
                    <a href="../../logout.php">
                        <span class="ti-shift-left"></span>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="search-wrapper">
                <!-- <span class="ti-search"></span>
                <input type="search" placeholder="Search" /> -->
            </div>

            <div class="social-icons">
                <div></div>
            </div>
        </header>
        <main>
            <p>
                <a href="applicant.php" class="btn btn-success mt-4">Go back to Applicant</a>
            </p>
            <section class="recent" style="margin-top: 0;">
                <div class="activity-card">
                    <!-- <button style="float: right;" class="btn btn-primary m-4 px-4" data-toggle="modal" data-target="#addModal" href="review_applicant.php?regisid=<?php echo $regisid; ?>&applicantid=<?php echo $applicantid; ?>">Review</button> -->

                    <div class="card mb-4">
                        <div class="card-header">
                            Applicant: <?php echo $fullname ?>
                        </div>
                        <div class="p-5">

                            <p><strong>Legends: </strong>( Applicant Work Experience, Education, and Certificate )</p>
                            <p><mark>Education</mark></p>
                            <?php
                            $get_education = mysqli_query($conn, "SELECT * FROM tblapplicant_education WHERE applicantid = '$appid'");
                            while ($educRow = mysqli_fetch_array($get_education)) {
                            ?>
                                <p> - <?php echo $educRow['EDUCATIONAL_DEGREE']; ?></p>
                            <?php } ?>
                            <p><mark>Work Experience</mark></p>
                            <?php
                            $getwork_experience = mysqli_query($conn, "SELECT * FROM tblapplicant_workexperience WHERE applicantid = '$appid'");
                            while ($expRow = mysqli_fetch_array($getwork_experience)) {
                            ?>
                                <p> - <?php echo $expRow['WORK_TITLE']; ?></p>
                            <?php } ?>
                            <p><mark>License & Certificate</mark></p>
                            <?php
                            $getCertificate = mysqli_query($conn, "SELECT * FROM tblcertificate WHERE applicantid = '$appid'");
                            while ($certificateRow = mysqli_fetch_array($getCertificate)) {
                            ?>
                                <p> - <?php echo $certificateRow['CERTIFICATE_NAME']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="activity-card">
                    <!-- <button style="float: right;" class="btn btn-primary m-4 px-4" data-toggle="modal" data-target="#addModal" href="review_applicant.php?regisid=<?php echo $regisid; ?>&applicantid=<?php echo $applicantid; ?>">Review</button> -->

                    <div class="card">
                        <div class="card-header">
                            Applicant Attachment
                        </div>
                        <?php

                        $query = mysqli_query($conn, "SELECT * FROM tblverification WHERE tblverification.APPLICANTID = '$appid'");
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <div class="div-img">
                                <p><?php echo $row['FILE_DESCRIPTION']; ?></p>
                                <img src="../../../verification-image/<?php echo $row['FILE_NAME']; ?>">
                            </div>
                            <hr>
                        <?php } ?>
                        <div class=" p-5">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label class="control-label">Verification Level:</label>
                                    <select class="form-control input-sm" name="verify">
                                        <option selected value="Basic Level"><?php echo $level; ?></option>
                                        <?php
                                        if ($level == "Basic Level") { ?>
                                            <option>Fully Verified</option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="app_score" class="col-form-label">Message for the applicant:</label>
                                    <textarea type="text" class="form-control" name="validationMessage" placeholder="Your account..."></textarea>
                                </div>

                                <div class="card-footer p-2 ">
                                    <input type="hidden" name="applicant_id" value="<?php echo $_GET['applicantid']; ?>">
                                    <button type="submit" class="btn btn-success float-right" name="submit_level">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>


        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('#examplee').DataTable({


                bJQueryUI: true,
                "aLengthMenu": [
                    [2, 5, 10, -1],
                    [2, 5, 10, "All"]
                ],
                "iDisplayLength": 2
            });
        });
    </script>
</body>

</html>

<?php
if (isset($_POST['submit_level'])) {
    $idOfApplicant = $_POST['applicant_id'];
    $verifyLevel = $_POST['verify'];
    $message = $_POST['validationMessage'];

    // if ($verifyLevel == "Basic Level") {
    // $remarkMessage = "We want to thank you for the time and effort that you have given to this application. However, the hiring department has decided that your submission did not meet our company requirements/qualifications. Nevertheless, we wish you good luck in your job hunting.";
    // $emailFormat = '<p>Hello, Mr/Ms. <b>' . $fullname . ',</b><br><br>' . 'We want to thank you for the time and effort that you have given to this application. 
    // However, the hiring department has decided that your submission did not meet our company\'s requirements/qualifications. Nevertheless, 
    // we wish you good luck in your job hunting. ' . '<br>' . 'Keep moving forward!' . '<br><br>' . 'Thank you,' . '<br>' . $hrname . '.</p>';
    // }

    // if ($verifyLevel == "Semi Verified") {
    // $remarkMessage = "Your application has already been approved, and you will now proceed to the interview. The instructions for the interview was sent to you via email please check your email for more details. Your interview schedule is set: $new_date. Requirements: $a_req";
    // $emailFormat = '<p>Hello, Mr/Ms. <b>' . $fullname . ',</b><br><br>' . 'Thank you for your interest in applying for the job position of ' . $position .
    //     ' at ' . $companyname . '. We have reviewed your application and would like to invite you to interview for this position. Interviews are being scheduled in ' . $new_date .
    //     '. Please contact ' . $hrname . ' at ' . $hremail . ' to discuss your availability.' . '<br><br>' . 'Thanks Again,' . '<br>' . $hrname . '.</p>';
    // }

    // if ($verifyLevel == "Fully Verified") {
    // $remarkMessage = "Your application has already been approved, and you will now proceed to the interview. The instructions for the interview was sent to you via email please check your email for more details. Your interview schedule is set: $new_date. Requirements: $a_req";
    // $emailFormat = '<p>Hello, Mr/Ms. <b>' . $fullname . ',</b><br><br>' . 'Thank you for your interest in applying for the job position of ' . $position .
    //     ' at ' . $companyname . '. We have reviewed your application and would like to invite you to interview for this position. Interviews are being scheduled in ' . $new_date .
    //     '. Please contact ' . $hrname . ' at ' . $hremail . ' to discuss your availability.' . '<br><br>' . 'Thanks Again,' . '<br>' . $hrname . '.</p>';
    // }

    $today = date('Y-m-d');
    if ($verifyLevel == 'Basic Level') {
         $query1 = mysqli_query($conn, "UPDATE tblapplicant SET VERIFY_LEVEL = 'Basic Level' WHERE APPLICANTID = '$idOfApplicant'");
    } else {
        $query1 = mysqli_query($conn, "UPDATE tblapplicant SET VERIFY_LEVEL = '$verifyLevel' WHERE APPLICANTID = '$idOfApplicant'");
    }
    
    $query2 = mysqli_query($conn, "UPDATE tblverification SET STATUS = 'Completed' WHERE APPLICANTID = '$idOfApplicant' and DATE_SUBMIT = '$today'");
    if ($query1) {

        $mail = new PHPMailer(true);

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
            $mail->addAddress($email, $fullname);

            //Set email format to HTML
            $mail->isHTML(true);

            $mail->Subject = 'Application Status';
            $mail->Body    = $message;


            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        echo ("<script>alert('Verify Level has been Set!')</script>");
        echo ("<script>window.location = 'applicant.php';</script>");
    } else {
        echo "<script>alert('Try again')</script>";
    }
}
?>