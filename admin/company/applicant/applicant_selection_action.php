<?php
require_once "../../../connection/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

session_start();

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}
date_default_timezone_set('Asia/Manila');

$regisid = $_GET['regisid'];
$applicantid = $_GET['applicantid'];
$position = $_GET['position'];
$query = mysqli_query($conn, "SELECT *, CONCAT(LNAME, ', ', FNAME, ' ', MNAME, '.') AS fullname, CONTACTNO as res_contact FROM tblapplicant WHERE applicantid = '$applicantid'");
while ($row = mysqli_fetch_array($query)) {

    $fname = $row['FNAME'];
    $lname = $row['LNAME'];
    $mname = $row['MNAME'];
    $fullname = $row['fullname'];
    $address = $row['ADDRESS'];
    $city = $row['CITY'];
    $state = $row['STATE'];
    $zip = $row['ZIP'];
    $contact = $row['CONTACTNO'];
    $emp_contact = $row['res_contact'];
    $email = $row['EMAIL'];
    $objective = $row['OBJECTIVES'];
    $filename = $row['FILE_NAME'];
    $status = $row['STATUS'];
}

$query1 = mysqli_query($conn, "SELECT * FROM tbljobregistration WHERE registrationid = '$regisid'");
while ($row1 = mysqli_fetch_array($query1)) {
    $id = $row1['REGISTRATIONID'];
    $t_status = $row1['STATUS'];
    $t_remarks = $row1['REMARKS'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <title>Accurafind | Applicant</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../assets/img/logo/accurafind_logo.png" />
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
    <link rel="stylesheet" href="../../assets/css/company.style.css" />
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
                    <a href="../job/job.php">
                        <span class="ti-briefcase"></span>
                        <span>Job Posting</span>
                    </a>
                </li>
                <li>
                    <a href="../employee/employee.php">
                        <span class="ti-id-badge"></span>
                        <span>Hired Applicant</span>
                    </a>
                </li>
                <li>
                    <a href="applicant.php">
                        <span class="ti-id-badge"></span>
                        <span>Qualified applicant</span>
                    </a>
                </li>
                <li>
                    <a href="not_qualified.php">
                        <span class="ti-id-badge"></span>
                        <span>Not qualified applicant</span>
                    </a>
                </li>
                <li>
                    <a href="archieved.php">
                        <span class="ti-id-badge"></span>
                        <span>Archived applicant</span>
                    </a>
                </li>
                <li>
                    <a href="applicant_under_interview.php">
                        <span class="ti-id-badge"></span>
                        <span>Applicant For Interview</span>
                    </a>
                </li>
                <li  class="active">
                    <a href="applicant_screening.php">
                        <span class="ti-id-badge"></span>
                        <span>Screening Stage</span>
                    </a>
                </li>
                <li>
                    <a href="applicant_selection.php">
                        <span class="ti-id-badge"></span>
                        <span>Applicant in Selection Stage</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="#">
                        <span class="ti-settings"></span>
                        <span>Manage Account</span>
                    </a>
                </li> -->
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
                <h1 class="company-name"><?php echo $_SESSION['COMPANY_NAME']; ?></h1>
            </div>
        </header>
        <main>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="applicant_screening.php">Applicant in Screening Stage</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Score</li>
                </ol>
            </nav>

            <section class="recent" style="margin-top: 0;">
                <div class="activity-card">
                    <!-- <button style="float: right;" class="btn btn-primary m-4 px-4" data-toggle="modal" data-target="#addModal" href="review_applicant.php?regisid=<?php echo $regisid; ?>&applicantid=<?php echo $applicantid; ?>">Review</button> -->

                    <div class="card">
                        <div class="card-header">
                            Interview Score and Status
                        </div>
                        <div class="p-5">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label class="control-label" for="stats">Status:</label>
                                    <select class="form-control input-sm" id="stats" name="app_status" required>
                                        <option selected disabled value=""><?php echo $t_status; ?></option>
                                        <option>Selection Stage</option>
                                        <option>Rejected</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>                             

                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>Selection Stage Schedule <mark style="color: #ff3939; background: #fff"> (Only for accepting applicants)</mark></label>
                                        <input type="date" class="form-control" name="dateFrom" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="app_score" class="col-form-label mt-3">Additional Message:</label>
                                    <textarea type="text" class="form-control" name="otherRequirements"></textarea>
                                </div>

                                <div class="card-footer p-2 ">
                                    <input type="hidden" name="reg_id" id="reg_id" value="<?php echo $_GET['regisid']; ?>">
                                    <button type="submit" class="btn btn-success float-right" name="submit_score">Submit</button>
                                </div>
                            </form>
                        </div>

            </section>
        </main>
    </div>

</body>

</html>

<?php

$date = date('Y-m-d');

if (isset($_POST['submit_score'])) {
    $new_date = date('F j, Y', strtotime($_POST['dateFrom']));
    $other_req = $_POST['otherRequirements'];
    $employment = $_POST['employment'];
    $reg_id = $_POST['reg_id'];
    $a_status = $_POST['app_status'];
    $remarkMessage = "";
    $emailFormat = "";
    $concat = "";
    $name = $_POST['requirement'];
    foreach ($name as $color) {
        $concat .= $color . ', ';
    }
    if ($a_status == "Selection Stage") {
        $remarkMessage = "We want to inform you that you are qualified for Screening Stage of interview. $other_req. You screening interview schedule is: $new_date. Goodluck!";
        $emailFormat = '<p>Hello, Mr/Ms. <b>' . $fullname . ',</b><br><br>' . 'We want to inform you that you are qualified for Screening Stage of interview. The date for your screening is: $new_date. Goodluck!' . $other_req;
    }

    if ($a_status == "Rejected") {
        $remarkMessage = "We want to thank you for the time and effort that you have given to this application. However, the hiring department has decided that your submission did not meet our company requirements/qualifications. Nevertheless, we wish you good luck in your job hunting.";
        $emailFormat = '<p>Hello, Mr/Ms. <b>' . $fullname . ',</b><br><br>' . 'We want to thank you for the time and effort that you have given to this application. 
        However, the hiring department has decided that your submission did not meet our company\'s requirements/qualifications. Nevertheless, 
        we wish you good luck in your job hunting. ' . '<br>' . 'Keep moving forward!' . '<br><br>' . 'Thank you,' . '<br>' . $hrname . '.</p>';
    }

    $remarks_query = mysqli_query($conn, "UPDATE tbljobregistration SET remarks = '$remarkMessage', status = '$a_status' WHERE registrationid = '$reg_id'");

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
        $mail->addAddress($email, $name);

        //Set email format to HTML
        $mail->isHTML(true);

        $mail->Subject = 'Application Status';
        $mail->Body    = $emailFormat;;

        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    $today = date("Y-m-d H:i:s");
    $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Modify Application Status')");
    if ($remarkMessage) {
        echo ("<script>alert('Remarks saved')</script>");
        echo ("<script>window.location = 'applicant_under_interview.php';</script>");
    } else {
        echo "<script>alert('some error. please try again later')</script>";
        echo ("<script>window.location = 'applicant.php';</script>");
    }
}
?>