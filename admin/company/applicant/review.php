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
    $companyname = $_SESSION['COMPANY_NAME'];
    $hrname = $_SESSION['HRNAME'];
    $hremail = $_SESSION['HREMAIL'];
} else {
    header('location: ../../index.php');
}

date_default_timezone_set('Asia/Manila');

$regisid = $_GET['regisid'];
$applicantid = $_GET['applicantid'];
$position = $_GET['position'];
$jobStatus = $_GET['jobStatus'];
$query = mysqli_query($conn, "SELECT *, DATE_FORMAT(BIRTHDATE, '%M %e, %Y') AS date, CONCAT(LNAME, ', ', FNAME, ' ', MNAME, '.') AS fullname, CONTACTNO as res_contact FROM tblapplicant WHERE applicantid = '$applicantid'");
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
    $birthdate = $row['date'];
    $age = $row['AGE'];
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
include_once "partial/applicant_header.php";

?>

<main>
    <p>
        <a href="applicant.php" class="btn btn-success mt-4">Go back to Applicant</a>
    </p>
    <section class=" recent mb-4 mr-4" style="margin-top: 0;">
        <div class="grid-1x2">
            <div class="summary">
                <div class="summary-card">
                    <div class="text-center">
                        <img src="../../../upload/<?php echo $filename; ?>" width="100" height="100">
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>APPLICANT NAME:</small>
                            <h5><?php echo $fullname ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>Birthdate:</small>
                            <h5><?php echo $birthdate ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>Age:</small>
                            <h5><?php echo $age ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>Address:</small>
                            <h5><?php echo $address ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>City, State and Zip:</small>
                            <h5><?php echo $city . ', ' . $state . ', ' . $zip ?></h5>
                        </div>
                    </div>

                    <div class="summary-single">
                        <div>
                            <small>Phone number:</small>
                            <h5><?php echo $contact ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>Status:</small>
                            <h5><?php echo $status ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>Email Address:</small>
                            <h5><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></h5>
                        </div>
                    </div>

                </div>
                <div class="summary-card">
                    <div class="card m-4">
                        <div class="card-header">
                            Rating Overall Average
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <?php
                                $getRating = mysqli_query($conn, "SELECT AVG(rating) as rate FROM tblrating WHERE applicantid = $applicantid");
                                while ($ratingRow = mysqli_fetch_array($getRating)) {
                                    $rating = $ratingRow['rate'];
                                }
                                ?>
                                <h5><?php echo $fullname ?> -
                                    <mark class="rounded" style="background: #28a745; color: #fff"><?php echo $rating ?> / 5 </mark>
                                </h5>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <div class="activity-card">
                <!-- <button style="float: right;" class="btn btn-primary m-4 px-4" data-toggle="modal" data-target="#addModal" href="review_applicant.php?regisid=<?php echo $regisid; ?>&applicantid=<?php echo $applicantid; ?>">Review</button> -->

                <h3 class="mt-2">Resume ( <?php echo $status; ?>)</h3>

                <hr>
                <div class="card m-4">
                    <div class="card-header">
                        Objectives
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p><?php echo $objective; ?></p>
                        </blockquote>
                    </div>
                </div>
                <div class="card m-4">
                    <div class="card-header">
                        Education
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <?php
                            $geteducation = mysqli_query($conn, "SELECT * FROM tblapplicant_education WHERE applicantid = '$applicantid'");
                            while ($row2 = mysqli_fetch_array($geteducation)) {
                            ?>
                                <p><?php echo $row2['SCHOOL_NAME']; ?> (<?php echo $row2['EDUC_YEAR']; ?>)</p>
                                <footer class="blockquote-footer mb-2"><?php echo $row2['EDUCATIONAL_DEGREE']; ?></footer>
                                <P style="font-size: 1rem;">Description: <?php echo $row2['EDUC_DESCRIPTION']; ?></P>
                            <?php } ?>
                        </blockquote>
                    </div>
                </div>
                <div class="card m-4">
                    <div class="card-header">
                        Work Experience
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <?php
                            $getwork_experience = mysqli_query($conn, "SELECT * FROM tblapplicant_workexperience WHERE applicantid = '$applicantid'");
                            while ($row3 = mysqli_fetch_array($getwork_experience)) {
                            ?>
                                <p class="mb-2" style="font-weight: 350;"><?php echo $row3['WORK_TITLE']; ?> (<?php echo $row3['WORK_YEAR']; ?>)</p>
                                <footer class="blockquote mb-2 "><?php echo $row3['WORK_DESCRIPTION']; ?></footer>
                            <?php } ?>
                        </blockquote>

                    </div>
                </div>
                <div class="card m-4">
                    <div class="card-header">
                        Licenses and Certificates
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <?php
                            $getwork_experience = mysqli_query($conn, "SELECT * FROM tblcertificate WHERE applicantid = '$applicantid'");
                            while ($row3 = mysqli_fetch_array($getwork_experience)) {
                            ?>
                                <p class="mb-2" style="font-weight: 350;"><?php echo $row3['CERTIFICATE_NAME']; ?> (<?php echo $row3['ISSUE_DATE']; ?>)</p>
                                <footer class="blockquote mb-2 ">Organization: <?php echo $row3['ORGANIZATION']; ?></footer>
                                <hr>
                            <?php } ?>
                        </blockquote>

                    </div>
                </div>
                <div class="card m-4">
                    <div class="card-header">
                        Character References
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <?php
                            $getwork_experience = mysqli_query($conn, "SELECT * FROM tblcharacter_reference WHERE applicantid = '$applicantid'");
                            while ($row3 = mysqli_fetch_array($getwork_experience)) {
                            ?>
                                <p class="mb-2" style="font-weight: 350;"><?php echo $row3['NAME']; ?> (<?php echo $row3['RELATIONSHIP']; ?>)</p>
                                <footer class="blockquote mb-2 " style="font-size: 1rem;">Contact no#: <?php echo $row3['CONTACT']; ?></footer>
                                <hr>
                            <?php } ?>
                        </blockquote>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class=" recent mb-4 mr-4" style="margin-top: 0;">
        <div class="grid-1x2">
            <div class="summary">
            </div>
            <div class="activity-card">
                <h3 class="mt-2">Review for the applicants</h3>
                <hr>
                <div class="card m-4">
                    <div class="card-header">
                        Objectives

                    </div>
                    <form class="m-4" action="" method="POST">

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Application Status</label>
                            <select class="form-control input-sm" id="status" name="app_status" required>
                                <option selected disabled value=""><?php echo $t_status; ?></option>
                                <?php
                                if ($jobStatus == "Pending") { ?>
                                    <option value="First Interview">For Interview</option>
                                    <option>Rejected</option>
                                <?php } elseif ($jobStatus == "For Interview") { ?>
                                    <option>Accepted</option>
                                    <option>Rejected</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Interview Schedule <mark style="color: #676868; background: #fff"> (Only for applicants for interview)</mark></label>
                                <input type="date" class="form-control" name="dateFrom" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="app_score" class="col-form-label">Other Requirements:</label>
                            <textarea type="text" class="form-control" name="otherRequirements"></textarea>
                        </div>

                        <!-- <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Remarks</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Message for applicant" name="app_remark"></textarea>
                                    </div> -->
                        <input type="hidden" name="reg_id" id="reg_id" value="<?php echo $_GET['regisid']; ?>">
                        <input type="submit" class="btn btn-primary float-right" name="submit_review" value="submit">
                    </form>
                </div>
            </div>

        </div>
    </section>
</main>
</div>
</body>

</html>

<?php
$date = date('Y-m-d');

if (isset($_POST['submit_review'])) {
    $new_date = date('F j, Y', strtotime($_POST['dateFrom']));
    $reg_id = $_POST['reg_id'];
    $a_status = $_POST['app_status'];
    $a_req = $_POST['otherRequirements'] ?? 'No requirements need';
    $emailFormat = "";
    // $a_remarks = $_POST['app_remark'];
    $remarkMessage = "";

    if ($a_status == "Rejected") {
        $remarkMessage = "We want to thank you for the time and effort that you have given to this application. However, the hiring department has decided that your submission did not meet our company requirements/qualifications. Nevertheless, we wish you good luck in your job hunting.";
        $emailFormat = '<p>Hello, Mr/Ms. <b>' . $fullname . ',</b><br><br>' . 'We want to thank you for the time and effort that you have given to this application. 
        However, the hiring department has decided that your submission did not meet our company\'s requirements/qualifications. Nevertheless, 
        we wish you good luck in your job hunting. ' . '<br>' . 'Keep moving forward!' . '<br><br>' . 'Thank you,' . '<br>' . $hrname . '.</p>';
    }

    if ($a_status == "First Interview") {
        $remarkMessage = "Your application has already been approved, and you will now proceed to the interview. The instructions for the interview was sent to you via email please check your email for more details. Your interview schedule is set: $new_date. Requirements: $a_req";
        $emailFormat = '<p>Hello, Mr/Ms. <b>' . $fullname . ',</b><br><br>' . 'Thank you for your interest in applying for the job position of ' . $position .
            ' at ' . $companyname . '. We have reviewed your application and would like to invite you to interview for this position. Interviews are being scheduled in ' . $new_date .
            '. Please contact ' . $hrname . ' at ' . $hremail . ' to discuss your availability.' . '<br><br>' . $a_req . '<br><br>' . 'Thanks Again,' . '<br>' . $hrname . '.</p>';
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
        $mail->addAddress($email, $fullname);

        //Set email format to HTML
        $mail->isHTML(true);

        $mail->Subject = 'Application Status';
        $mail->Body    = $emailFormat;


        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    $today = date("Y-m-d H:i:s");
    $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Modify Application Status')");
    if ($remarks_query) {
        echo ("<script>alert('Remarks saved')</script>");
        echo ("<script>window.location = 'applicant.php';</script>");
    } else {
        echo "<script>alert('some error. please try again later')</script>";
        echo ("<script>window.location = 'applicant.php';</script>");
    }
}
?>