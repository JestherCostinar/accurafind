<?php

include('connection/config.php');
session_start();
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if (isset($_SESSION['applicantid'])) {
    $applicantid = $_SESSION['applicantid'];
    $applicantname = $_SESSION['fullname'];
    $status_of_applicant = $_SESSION['appstatus'];
    $applicantEmail =  $_SESSION['email'];
    $applicantAge = $_SESSION['age'];
    $applicantfullname = $_SESSION['fullname'];
    $verify_level = $_SESSION['verifylevel'];
    $age = $_SESSION['age'];
    $highest = $_SESSION['highest_educ'];
} else {
    header('location: login.php');
}

$work_exp = "";
$yearOfExpInField = 0;
$verify_score = 0;
if ($verify_level == 'Basic Level') {
    $verify_score = 1;
} elseif ($verify_level == 'Fully Verified') {
    $verify_score = 2;
}

$id = $_GET['details'];

$sumSkillCount = 0;
$skillCount = 0;
$getSkillCount = mysqli_query($conn, "SELECT COUNT(*) as total FROM tblskills WHERE tblskills.SKILLS_ID = '$id'");
while ($sumSkillRow = mysqli_fetch_array($getSkillCount)) {
    $sumSkillCount = ($sumSkillRow['total'] * 5) / 2;
    $skillCount = $sumSkillRow['total'];
}

$totalPointsSkills = $skillCount * 5;
$query = mysqli_query($conn, "SELECT tbljob.*, tblcompany.*, tbljob.COMPANYID as compid, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, DATE_FORMAT(DATEPOSTED, '%M %e, %Y') AS date FROM tbljob, tblcompany WHERE tbljob.COMPANYID = tblcompany.COMPANYID AND JOBID = '$id'");
while ($row = mysqli_fetch_array($query)) {
    $jobid = $row['JOBID'];
    $companyid = $row['compid'];
    $companyname = $row['COMPANY_NAME'];
    $occupation_title = $row['OCCUPATION_TITLE'];
    $fields = $row['JOB_FIELD'];
    $location = $row['LOCATION'];
    $job_status = $row['STATUS'];
    $salary_from = $row['SALARY_FROM'];
    $salary_to = $row['SALARY_TO'];
    $salaries = $row['salaries'];
    $work_experience = $row['WORK_EXPERIENCE'];
    $age_from = $row['AGE_FROM'];
    $age_to = $row['AGE_TO'];
    $age_range = $row['age_range'];
    $description = $row['DESCRIPTION'];
    $prefered_sex = $row['PREFERED_SEX'];
    $highest_educational_attainment = $row['EDUCATIONAL'];
    $job_remarks = $row['REMARKS'];
    $date = $row['date'];
}

$applicantField = "";
$workExpOfApplicant = mysqli_query($conn, "SELECT * FROM tblapplicant_workexperience WHERE applicantid = '$applicantid' AND field = '$fields'");
while ($workExpOfApplicantRow = mysqli_fetch_array($workExpOfApplicant)) {
    $countOfYear = $workExpOfApplicantRow['YEAR_COUNT'];
    $applicantField = $workExpOfApplicantRow['FIELD'];
    $yearOfExpInField += $countOfYear;
}

if ($yearOfExpInField > 13) {
    $work_exp = "Expert Level";
} elseif ($yearOfExpInField > 10) {
    $work_exp = "Senior Level";
} elseif ($yearOfExpInField > 2) {
    $work_exp = "Mid Level";
} elseif ($yearOfExpInField >= 1) {
    $work_exp = "Entry Level";
} elseif ($yearOfExpInField == 0) {
    $work_exp = "No work experience in this field";
}


$job_workexperience_score = 0;
$educ_degree_score = 0;

if ($work_experience == "Entry Level") {
    $job_workexperience_score = 1;
} elseif ($work_experience == "Mid Level") {
    $job_workexperience_score = 2;
} elseif ($work_experience == "Senior Level") {
    $job_workexperience_score = 3;
} elseif ($work_experience == "Expert Level") {
    $job_workexperience_score = 4;
}

if ($highest_educational_attainment == "Doctoral Degree") {
    $educ_degree_score = 5;
} elseif ($highest_educational_attainment == "Masters Degree") {
    $educ_degree_score = 4;
} elseif ($highest_educational_attainment == "Bachelors Degree") {
    $educ_degree_score = 3;
} elseif ($highest_educational_attainment == "High School Degree") {
    $educ_degree_score = 2;
} elseif ($highest_educational_attainment == "Non Degree Courses") {
    $educ_degree_score = 3;
}

if (isset($_POST['save'])) { // if save button on the form is clicked
    $skills = $_POST['skills'];
    $skill_score = 0;
    $age_score = 0;
    $workexp_score  = 0;
    $educational_score   = 0;
    $age_status = "";
    $work_exp_status = "";
    $skills_status = "";
    $educ_degree_status = "";
    $skills_set_score = 0;
    $application_remark = "";

    $is_applied = mysqli_query($conn, "SELECT * from tbljobregistration WHERE tbljobregistration.APPLICANTID = '$applicantid' and tbljobregistration.JOBID = '$id'");
    $row_applied = mysqli_fetch_assoc($is_applied);

    if (is_array($row_applied)) {
        header("Location: applicant_joblist.php?apply_job_message=You already applied to this job, you cannot apply in the same job");
        exit();
    }
    // if (empty($age)) {
    //     header("Location: applicant_jobdetail.php?apply_job_message=Fill up all required fields");
    // }
    // if (empty($work_exp)) {
    //     header("Location: applicant_jobdetail.php?apply_job_message=Fill up all required fields");
    // }
    // The applicant met the age requirement, S/he got ___ degree in education, S/he have ___ experience in working, and skills are great!”

    $application_remark .= "( " . "<mark><strong>" . $verify_level . "</strong></mark>" . " )";

    if (($age >= $age_from) && ($age <= $age_to)) {
        $age_score = 10;
        $age_status = "<strong><mark>Score: " . $age_score . "%</mark></strong><br><br> • <strong>Job age qualification: </strong>" . $age_from . " - " . $age_to . " years old<br>• <strong>Applicant age:</strong> " . $applicantAge . " years old.";
        $application_remark .= "The applicant met the age requirement." . '<br><br>';
    } else {
        $age_score = 5;
        $age_status = "<strong><mark>Score: " . $age_score . "%</mark></strong><br><br> • <strong>Job age qualification:</strong> " . $age_from . " - " . $age_to . " years old<br>• <strong>Applicant age:</strong> " . $applicantAge . " years old.";
        $application_remark .= "The applicant did not met the age requirement." . '<br><br>';
    }

    if ($work_exp == "Entry Level") {
        $workexp_score = 1;
    } elseif ($work_exp == "Mid Level") {
        $workexp_score = 2;
    } elseif ($work_exp == "Senior Level") {
        $workexp_score = 3;
    } elseif ($work_exp == "Expert Level") {
        $workexp_score = 4;
    }
    $work_score = 0;
    if ($job_workexperience_score == $workexp_score) {
        $work_score = 35;
        $work_exp_status = "<strong><mark>Score: " . $work_score . "%</mark></strong><br><br> • <strong>Work Experience qualification in field of $fields: </strong>" . $work_experience . "<br>• <strong>Applicant work experience in field of $fields: </strong>" . $work_exp;
        $application_remark .= "• S/he met the work experience required for the company. got $work_exp experience in working." . '<br><br>';
    } elseif ($job_workexperience_score < $workexp_score) {
        $work_score = 40;
        $work_exp_status = "<strong><mark>Score: " . $work_score . "%</mark></strong><br><br> •  <strong>Work Experience qualification in field of $fields: </strong>" . $work_experience . "<br>• <strong>Applicant work experience in field of $fields: </strong>" . $work_exp;
        $application_remark .= "•  S/he exceed in work experience requirements of the company, got $work_exp experience in working." . '<br><br>';
    } else {
        $work_score = 10;
        $work_exp_status = "<strong><mark>Score: " . $work_score . "%</mark></strong><br><br> •  <strong>Work Experience qualification in field of $fields: </strong>" . $work_experience . "<br>• <strong>Applicant work experience in field of $fields: </strong>" . $work_exp;
        $application_remark .= "•  S/he not met the work experience requirement, S/he only have $work_exp experience in working." . '<br><br>';
    }

    if ($highest == "Doctoral Degree") {
        $educational_score = 5;
    } elseif ($highest == "Masters Degree") {
        $educational_score = 4;
    } elseif ($highest == "Bachelors Degree") {
        $educational_score = 3;
    } elseif ($highest == "High School Degree") {
        $educational_score = 2;
    } elseif ($highest == "Non Degree Courses") {
        $educational_score = 3;
    }

    $educ_score = 0;
    if ($educational_score == $educ_degree_score) {
        $educ_score = 20;
        $educ_degree_status = "<strong><mark>Score: " . $educ_score . "%</mark></strong><br><br>• <strong>Job Education qualification: </strong>" . $highest_educational_attainment . "<br>• <strong>Applicant education: </strong>" . $highest;
        $application_remark .= "•  S/he also met the educational degree need for the company,  got $highest in education ";
    } elseif ($educational_score > $educ_degree_score) {
        $educ_score = 25;
        $educ_degree_status = "<strong><mark>Score: " . $educ_score . "%</mark></strong><br><br>• <strong>Job Education qualification: </strong>" . $highest_educational_attainment . "<br>• <strong>Applicant education: </strong>" . $highest;
        $application_remark .= "•  S/he also exceed in education requirements of the company, got $highest in education ";
    } else {
        $educ_score = 10;
        $educ_degree_status = "<strong><mark>Score: " . $educ_score . "%</mark></strong><br><br>• <strong>Job Education qualification: </strong>" . $highest_educational_attainment . "<br>• <strong>Applicant education: </strong>" . $highest;
        $application_remark .= "•  S/he not met the education requirement, S/he only have $highest degree in education, ";
    }

    $skillSet_remark = "<strong><br>Skills Requirement: <br></strong>";
    $skPerRow = "";

    $sk = mysqli_query($conn, "SELECT * FROM tblskills WHERE SKILLS_ID = '$id'");
    while ($skRow = mysqli_fetch_array($sk)) {
        $skillSet_remark .= $skRow['SKILLS'] . ", ";
    }

    $skillSet_remark .= "<br><br><strong>Applicant points per skill: </strong>";
    foreach ($skills as $index => $value_skill) {
        if ($value_skill == 5) {
            $skillSet_remark .=  "Expert(5points), ";
        } elseif ($value_skill == 4) {
            $skillSet_remark .= "Proficient(4points), ";
        } elseif ($value_skill == 3) {
            $skillSet_remark .= "Demonstrating(3points), ";
        } elseif ($value_skill == 2) {
            $skillSet_remark .= "Basic(2points), ";
        } elseif ($value_skill == 1) {
            $skillSet_remark .= "None / Low(1points), ";
        }
        $skill_score += $value_skill;
    }

    $skillPercentage = 0;

    $skillPercentage = (($skill_score / $totalPointsSkills) * .25) * 100;
    
    $sumSkillTotal = $sumSkillCount * 2;

    

    $skillSet_remark .= "<br><strong>Total: </strong> $skill_score out of $sumSkillTotal";

    // if ($skill_score >= $sumSkillCount) {
    //     $skillPercentage = 25;
    //     $application_remark .= "<br><br>• Applicant Skills is Greater than the half of Skills requirements. $skill_score out of $sumSkillTotal";
    // } elseif ($skill_score < $sumSkillCount) {
    //     $skillPercentage = 10;
    //     $application_remark .= "<br><br>• Applicant Skills is Less than the half of Skills requirements. $skill_score out of $sumSkillTotal";
    // }

    $certCount = 0;
    $certificateScore = 0;
    $getcertificate = mysqli_query($conn, "SELECT COUNT(*) as certCount FROM tblcertificate WHERE applicantid = '$applicantid'");
    while ($certRow = mysqli_fetch_array($getcertificate)) {
        $certCount = $certRow['certCount'];
    }
    if ($certCount > 0) {
        $certificateScore = 5;
        $application_remark .= "<br><br>• Applicant has certificate. additional " . $certificateScore;
    }

    $total_percentage = $age_score + $work_score + $educ_score + $skillPercentage + $certificateScore;
    $application_remark .= "<br><br><strong>Total Percentage Score: <mark> " . $total_percentage . "%</mark></strong>";
    $decision_query = mysqli_query($conn, "INSERT INTO tbldecision(JOBID, COMPANYID, APPLICANTID, AGE_SCORE, EXPERIENCE_SCORE, EDUCATIONAL_SCORE, SKILLS_SCORE, PERCENTAGE ,AGE_STATUS, EXPERIENCE_STATUS, EDUCATIONAL_STATUS, SKILLS_SET_STATUS, VERIFY_LEVEL, REMARK_STATUS) VALUES ('$id', '$companyid', '$applicantid', '$age_score', '$work_score', '$educ_score', '$skillPercentage', '$total_percentage', '$age_status', '$work_exp_status', '$educ_degree_status', '$skillSet_remark', '$verify_score', '$application_remark')");

    if ($decision_query) {
        $select_decision = mysqli_query($conn, "SELECT DECISIONID FROM tbldecision WHERE DECISIONID = ( SELECT MAX(DECISIONID) FROM tbldecision)");
        $row = mysqli_fetch_assoc($select_decision);
        $decision_id = $row['DECISIONID'];
        $date = date('Y-m-d');
        $status = 'Pending';
        $pendingRemarks = 'This is to acknowledge that your application has been recorded in the system and is currently waiting for the company HR to review it';
        $addreg = mysqli_query($conn, "INSERT INTO tbljobregistration(APPLICANT, REGISTRATION_DATE, STATUS, COMPANYID, JOBID, APPLICANTID, DECISIONID, REMARKS) VALUES ('$applicantname', '$date', '$status', '$companyid', '$id', '$applicantid', '$decision_id', '$pendingRemarks')");
        $today = date("Y-m-d H:i:s");
        $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['fullname']}', '$today', 'Applicant', 'Apply Job')");
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
            $mail->addAddress($applicantEmail, $applicantfullname);

            //Set email format to HTML
            $mail->isHTML(true);

            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Hello, Mr/Ms. <b>' . $applicantname . ',</b><br><br>' . '     Thank you for applying for the position of ' . $occupation_title .
                ' at ' . $companyname . '. We would like to inform you that your application for ' . $occupation_title . ' at ' . $companyname . ' has been processed in the 
            system and is currently reviewing all the applications.' . '<br><br>' . 'Thank you so much for being so patient!' . '<br>' . $companyname . '.</p>';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        echo "<script>alert('Job Registration is already submitted!')</script>";
        echo "<script>window.location = 'applicant_joblist.php';</script>";
    }
}

?>

<?php include_once "partial/applicant_header.php"; ?>
<main>
    <!-- slider Area Start-->

    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->
                    <div class="single-job-items mb-50">
                        <div class="job-items">
                            <div class="company-img company-img-details">
                                <img src="images/icon-job.jpg" width="80px" height="80px" alt="">
                            </div>
                            <div class="job-tittle" style="margin-top: 10px;">
                                <h4><?php echo $occupation_title; ?></h4>
                                <ul>
                                    <li><?php echo $companyname; ?></li>
                                    <li><i class="fas fa-map-marker-alt"></i><?php echo $location; ?></li>
                                    <li><?php echo $salaries; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- job single End -->

                    <div class="job-post-details">
                        <div class="post-details1 mb-20">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Description</h4>
                            </div>
                            <p><?php echo $description; ?></p>

                        </div>
                        <div class="post-details2  mb-20">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Educational Attainment and Experience Requirements</h4>
                            </div>
                            <ul>
                                <li><?php echo $work_experience; ?> in Working at industry</li>
                                <li><?php echo $highest_educational_attainment; ?> Required</li>

                            </ul>
                        </div>
                        <div class="post-details2  mb-20">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Skills Required</h4>
                            </div>
                            <?php

                            $get_skill = mysqli_query($conn, "SELECT * FROM tblskills WHERE SKILLS_ID = '$id'");
                            while ($row1 = mysqli_fetch_array($get_skill)) {
                            ?>
                                <ul>

                                    <li><?php echo $row1['SKILLS']; ?></li>
                                </ul>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="post-details2  mb-20">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Skills Level Guideline</h4>
                            </div>
                            <ul>
                                <li><strong>None / Low</strong><br>- Has minimal or textbook knowledge without connecting it to the practice.
                                    <br>- Needs close supervision or guidance.
                                    <br>- Has little or no idea of ​​how to deal with complexity.
                                    <br>- Tends to look at actions in isolation.
                                </li>
                                <li><strong>Basic </strong><br>- Has basic knowledge of key aspects of the practice.
                                    <br>- Straightforward tasks are likely to be done to an acceptable standard.
                                    <br>- Is able to achieve some steps using own judgment, but needs supervision for the overall task.
                                    <br>- Appreciates complex situations, but is only able to achieve partial resolution.
                                    <br>- Sees actions as a series of steps.
                                </li>
                                <li><strong>Demonstrating </strong><br>- Has good working and background knowledge of area of practice.
                                    <br>- Results can be achieved for open tasks, though may lack refinement.
                                    <br>- Is able to achieve most tasks using own judgement.
                                    <br>- Copes with complex situations through deliberate analysis and planning.
                                    <br>- Sees actions at least partly in terms of longer-term goals.
                                </li>
                                <li><strong>Proficient </strong><br>- Depth of understanding of discipline and area of practice.
                                    <br>- Fully acceptable standard achieved routinely, results are also achieved for open tasks.
                                    <br>- Able to take full responsibility for own work (and that of others where applicable)
                                    <br>- Deals with complex situations holistically, confident decision-making.
                                    <br>- Sees the overall picture and how individual actions fit within it.
                                </li>
                                <li><strong>Expert </strong><br>- Authoritative knowledge of discipline and deep tacit understanding across area of practice
                                    <br>- Excellence achieved with relative ease
                                    <br>- Able to take responsibility for going beyond existing standards and creating own interpretations.
                                    <br>- Holistic grasp of complex situations, moves between intuitive and analytical approaches with ease.
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3 ">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Job Overview</h4>
                        </div>
                        <ul>
                            <li>Posted date : <span><?php echo $date; ?></span></li>
                            <li>Location : <span><?php echo $location; ?></span></li>
                            <li>Job Type : <span><?php echo $job_status; ?></span></li>
                            <li>Job Status : <span><?php echo $job_remarks; ?></span></li>
                            <li>Salary : <span><?php echo $salaries; ?></span></li>
                            <li>Age required : <span><?php echo $age_range; ?></span></li>
                        </ul>
                        <hr>
                        <!-- onsubmit="return(validate()); -->
                        <form action="" enctype="multipart/form-data" method="post">
                            <div class="form-row">
                                <label for=" fname">Skills: <h6 style="color: #676868; display: inline;">(Required)</h6></label>
                                <?php

                                $get_skills = mysqli_query($conn, "SELECT * FROM tblskills WHERE SKILLS_ID = '$id'");
                                while ($row2 = mysqli_fetch_array($get_skills)) {

                                ?>

                                    <div class="col-md-12 mb-3">
                                        <label for="fname"><?php echo $row2['SKILLS']; ?><h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <select class="form-select" aria-label="Default select example" id="skills[]" name="skills[]" required>
                                            <option selected value="">Skill Experience</option>
                                            <option value="1">0 - 6 months</option>
                                            <option value="2">6 months - 1 year</option>
                                            <option value="3">1 - 2 years</option>
                                            <option value="4">2 - 4 years</option>
                                            <option value="5">4 years and above</option>
                                        </select>
                                    </div>
                                <?php } ?>


                            </div>

                            <!-- <div class="form-group">
                                    Attach your Resume here:

                                    <input id="myfile" name="myfile" type="file" style="margin-top: 10px;" require>
                                    <input name="MAX_FILE_SIZE" type="hidden" value="1000000">
                                </div> -->
                            <div class="form-group">
                                <button class="btn" name="save" type="submit">Apply now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->
    <!--Pagination Start  -->

</main>
<?php include_once "partial/footer.php"; ?>