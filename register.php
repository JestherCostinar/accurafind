<?php
date_default_timezone_set('Asia/Manila');

include('connection/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$applicantid = 0;

$fieldOfExperience = array(
    'Architecture and engineering',
    'Arts, culture and entertainment',
    'Business, management and administration',
    'Communications',
    'Community and social services',
    'Education',
    'Science and technology',
    'Installation, repair and maintenance',
    'Farming, fishing and forestry',
    'Government',
    'Health and medicine',
    'Law and public policy',
    'Sales'
);

$degree = array(
    'GAS (General Academic Strand)',
    'STEM (Science, Technology, Engineering, and Mathematics)',
    'ABM (Accountancy, Business and Management) ',
    'HUMMS (Humanities and Social Sciences)',
    'Sports',
    'Arts and Design',
    'Technical Vocational - Information and Communication Technology (ICT)',
    'Technical Vocational - Industrial Arts',
    'Technical Vocational - Home economics',
    'Technical Vocational - Agri-Fishery Arts',
    'Bachelor of Elementary Education',
    'Bachelor of Secondary Education',
    'Bachelor of Technical Teacher Education',
    'BS in Industrial Education',
    'BS in Architecture',
    'BS in Civil Engineering',
    'BS in Marine Engineering',
    'BS in Electronics & Communication Engineering',
    'BS in Electrical Engineering',
    'BS in Mechanical Engineering',
    'BS in Computer Engineering',
    'BS in Industrial Engineering',
    'BS in Chemical Engineering',
    'BS in Aeronautical Engineering',
    'BS in Geodetic Engineering',
    'BS in Mining Engineering',
    'BS in Software Engineering',
    'BS in Office Administration',
    'BS in Customs Administration',
    'BS in Public Administration',
    'AB in Public Administration',
    'BS in Legal Management',
    'BS in Agriculture',
    'BS in Agricultural Engineering',
    'Bachelor of Agricultural Technology',
    'BS in Forestry',
    'BS in Fisheries and Aquatic Resources',
    'BS in Aircraft Maintenance Technology ',
    'BS in Aeronautical Engineering',
    'BS in Management Accounting',
    'Bachelor of Fine Arts ',
    'AB in Multimedia Arts',
    'BS in Interior Design',
    'BS in Business Administration',
    'BS in Accountancy',
    'BSBA in Marketing Management',
    'BSBA in Financial Management',
    'BSBA in Human Resource Development Management',
    'BSBA in Management',
    'BS in Accounting Technology',
    'BS in Entrepreneurship',
    'BSBA in Management Accounting',
    'BSBA in Operations Management',
    'BS in Entrepreneurial Management',
    'AB in Economics',
    'BSBA in Business Economics',
    'BSBA in Entrepreneurship',
    'BS in Economics',
    'BSBA in Banking and Finance',
    'AB in Communication',
    'AB in Mass Communication',
    'AB in Multimedia Arts',
    'AB in Journalism',
    'BS in Developmental Communication',
    'Bachelor of Library and Information Science',
    'AB in Philosophy',
    'AB in History',
    'AB in Literature',
    'BS in Information Technology',
    'BS in Computer Science',
    'BS in Computer Engineering',
    'BS in Information Systems',
    'BS in Information and Communication Technology',
    'BS in Software Engineering',
    'AB in English',
    'AB in Filipino',
    'BS in Marine Transportation',
    'BS in Marine Engineering',
    'BS in Nursing',
    'BS in Medical Technology',
    'BS in Pharmacy',
    'BS in Physical Therapy',
    'BS in Nutrition and Dietetics',
    'BS in Respiratory Therapy',
    'BS in Occupational Therapy',
    'BS in Midwifery',
    'Bachelor of Music in Music Education',
    'BS in Industrial Technology',
    'Bachelor of Technical Teacher Education',
    'BS in Aircraft Maintenance Technology',
    'BS in Food Technology',
    'BS in Computer Technology',
    'AB in Theology',
    'BS in Biology',
    'BS in Mathematics',
    'BS in Environmental Science',
    'BS in Geology',
    'BS in Applied Mathematics',
    'BS in Applied Physics',
    'BS in Physics',
    'BS in Marine Biology',
    'BS in Statistics',
    'BS in Zoology',
    'BS in Criminology',
    'BS in Psychology',
    'AB in Political Science',
    'BS in Social Work',
    'AB in Psychology',
    'AB in Sociology',
    'BS in Community Developmen',
    'AB in Social Science',
    'BS in Hotel and Restaurant Management',
    'BS in Tourism Management',
    'BS in Hospitality Management',
    'BS in Tourism',
    'BS in International Hospitality Management',
    'BS in Travel Management',
    'MA in Education',
    'MAEd in Educational Management',
    'MA in Educational Management',
    'Master in Educational Management',
    'MA in Guidance and Counseling',
    'MS in Guidance and Counseling',
    'Master of Education in Special Needs and Inclusive Education',
    'MS in Management Engineering',
    'Bachelor of Laws',
    'Master of Public Administration',
    'MBA',
    'Master of Management',
    'MS in Management Engineering',
    'MA in Economics',
    'MS in Accountancy',
    'MS in Economics',
    'MA in Communication',
    'Master in Library and Information Science',
    'MA in Philosophy',
    'MA in History',
    'MA in English nag Literature',
    'MS in Information Technology',
    'Master in Information Technology',
    'MA in English',
    'MA in Filipino',
    'MA in English and Literature',
    'MA in Nursing',
    'MS in Nursing',
    'MS in Chemistry',
    'MA in Mathematics',
    'MS in Physics',
    'MS in Environmental Science',
    'MS in Biology',
    'MS in Mathematics',
    'MS in Microbiology',
    'MA in Physics',
    'MA in Psychology',
    'MS in Psychology',
    'MA in Political Science',
    'MA in Sociology',
    'MS in Rural Development',
    'Masters of Business Administration (MBA)',
    'Business Administration (DBA)',
    'Doctor of Medicine',
    'Doctor of Dental Medicine',
    'Doctor of Veterinary Medicine',
    'Doctor of Education',
    'PhD in Educational Management',
    'PhD in Education',
    'Doctor of Public Administration',
    'Doctor in Business Administration',
    'Doctor of Psychology ',
    'PhD Education',
    'Doctor in Information Technology (DIT)',
    'Doctor of Technology or Doctor Technologiae (DTech)',
    'Doctor of Nursing Practice (DNP)',
    'Doctor of Philosophy (PhD)',
    'Ph. D. in Engineering and Technology',
    'Health Care Services NC II',
    'Medical Transcription NC II',
    'Tour Guiding Services NC II',
    'Front Office Services NC II',
    'Bread and Pastry Production NC II',
    'Commercial Cooking NC II',
    'Food And Beverage Services NC II',
    'Auto Servicing NC II',
    'Caregiving NC II',
    'Consumer Electronics Servicing NC II',
    'PC Operations NC II',
    'Computer Hardware Servicing NC II',
    'Bartending NC II',
    'Housekeeping NC II',
    'Programming NC II',
    'Associate in Computer Technology',
    'Associate in Computer Science',
    'Diploma in Agricultural Technology',
    'Associate in Hotel & Restaurant Management',
    'Diploma in Midwifery',
    'Certificate in Professional Education',
    'Computer Technician Course',
    'Diploma in Special Education',
    'Proficiency in Fast Rescue Boat',
    'Diploma in Professional Culinary & Pastry Arts Program',
    'Certificate in Commercial Pilot Flight Course',
);

function remove_sp_chr($str)
{
    $result = str_replace(array("#", "'", ";"), '', $str);
    return $result;
}

function validation($str)
{
    $result = str_replace(array("#", "'", ";"), '', $str);
    return $result;
}

$fname = '';
$lname = '';
$mname = '';
$address = '';
$city = '';
$state = '';
$zip = '';
$contactno = '';
$username = '';
$email = '';
$pass = '';
$objective = '';

$cities = array(
    'Makati City',
    'Quezon City',
    'Caloocan City',
    'Cavite City',
    'Las Piñas City',
    'Malabon City',
    'Mandaluyong City',
    'Marikina City',
    'Muntinlupa City',
    'Navotas City',
    'Parañaque City',
    'Pasay City',
    'Pasig City',
    'San Juan City',
    'Taguig City',
    'Valenzuela City'
);

$regions = array(
    'Ilocos Region',
    'Cagayan Valley', 'Central Luzon', 'Bicol Region',
    'Central Visayas', 'Eastern Visayas', 'Western Visayas',
    'the Zamboanga Peninsula', 'Northern Mindanao', 'Davao Region',
    'Calabarzon', 'Cordillera Administrative Region', 'National Capital Region (NCR)'
);
$errors = array();

if (isset($_POST['submit'])) {
    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $contactno = $_POST['contactno'];
    $formated_contactno = '0' . $contactno;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $objective = $_POST['objective'];
    $objective = remove_sp_chr($objective);
    $highest = $_POST['highest'];
    $status = 'Unemployed';
    $filename = $_FILES['myfile']['name'];
    $birthDate = $_POST['birthday'];
    $currentDate = date("d-m-Y");
    $age = date_diff(date_create($birthDate), date_create($currentDate));
    $total_year = 0;

    $isEmailExist = mysqli_query($conn, "SELECT email FROM tblapplicant WHERE tblapplicant.email = '$email' and tblapplicant.IS_VERIFIED = 1");

    $num_email = mysqli_num_rows($isEmailExist);
    if ($num_email > 0) {
        header("Location: register.php?errorpassword=Email is already exist.");
        exit;
    }

    if ($pass != $confirmpassword) {
        header("Location: register.php?errorpassword=Password does not match.");
        exit;
    }


    if (isset($_POST['hasWorkExp'])) {
    } else {
        foreach ($_POST['work_title'] as $key => $value) {
            $w_year = $_POST['work_year'][$key];
            $w_year_end = $_POST['work_year_end'][$key];
            $total_year += $w_year_end - $w_year;
        }
    }

    $work_exp = "";

    if ($total_year > 13) {
        $work_exp = "Expert Level";
    } elseif ($total_year > 10) {
        $work_exp = "Senior Level";
    } elseif ($total_year > 2) {
        $work_exp = "Mid Level";
    } elseif ($total_year >= 0) {
        $work_exp = "Entry Level";
    }

    $age_num = $age->format("%y");
    // echo "Current age is " . $age_num;
    // exit;
    // Select file type
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png");
    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], 'upload/' . $filename)) {
            // FNAME, LNAME, MNAME, ADDRESS, CITY, STATE, ZIP, CONTACTNO, USERNAME, EMAIL, PASSWORD, OBJECTIVES, STATUS
            // $fname', '$lname', '$mname','$address', '$city', '$state', '$zip', '$contactno', '$username', '$email', sha1('$pass'), '$objective', '$status'");
            $query = mysqli_query($conn, "INSERT INTO tblapplicant(FNAME, LNAME, MNAME, ADDRESS, CITY, STATE, ZIP, CONTACTNO, USERNAME, EMAIL, PASSWORD, OBJECTIVES, AGE, BIRTHDATE, HIGHEST_EDUC, WORK_EXP, FILE_NAME, STATUS, IS_VERIFIED) VALUES ('$fname', '$lname', '$mname', '$address', '$city', '$state', '$zip', '$formated_contactno', '$username', '$email', sha1('$pass'), '$objective', '$age_num', '$birthDate','$highest', '$work_exp' , '$filename', '$status', '0')");
            if ($query) {
                $get_applicantid = mysqli_query($conn, "SELECT APPLICANTID FROM tblapplicant WHERE APPLICANTID = (SELECT MAX(APPLICANTID) FROM tblapplicant)");
                $row = mysqli_fetch_assoc($get_applicantid);
                $applicantid = $row['APPLICANTID'];

                if (isset($_POST['hasWorkExp'])) {
                } else {
                    foreach ($_POST['work_title'] as $key => $value) {
                        $w_work_title = $value;
                        $w_year = $_POST['work_year'][$key];
                        $w_field = $_POST['work_field'][$key];
                        $w_year_end = $_POST['work_year_end'][$key];
                        if ((!empty($w_year)) && (!empty($w_year_end))) {
                            $work_year_range = $w_year . ' - ' . $w_year_end;
                            $total_year = $w_year_end - $w_year;
                            $w_company_name = $_POST['company_name'][$key];
                            $w_description = $_POST['work_description'][$key];
                            $w_description = remove_sp_chr($w_description);
                            $insert_work_experience = mysqli_query($conn, "INSERT INTO tblapplicant_workexperience(WORK_TITLE, FIELD, WORK_YEAR, YEAR_COUNT, COMPANY_NAME, WORK_DESCRIPTION, APPLICANTID) VALUES ('$w_work_title', '$w_field', '$work_year_range', '$total_year', '$w_company_name', '$w_description', '$applicantid')");
                        }
                    }
                }
                foreach ($_POST['educ_year'] as $key => $value) {
                    $e_year = $value;
                    $e_year_end = $_POST['educ_year_end'][$key];
                    $e_degree = $_POST['educ_degree'][$key];
                    $e_desciption = $_POST['educ_description'][$key];
                    $e_year_range = $e_year . ' - ' . $e_year_end;
                    $e_school_name = $_POST['school_name'][$key];
                    $e_desciption = remove_sp_chr($e_desciption);
                    $insert_education = mysqli_query($conn, "INSERT INTO tblapplicant_education(EDUC_YEAR, SCHOOL_NAME, EDUCATIONAL_DEGREE, EDUC_DESCRIPTION, APPLICANTID) VALUES ('$e_year_range', '$e_school_name', '$e_degree','$e_desciption', '$applicantid')");
                }

                foreach ($_POST['referenceName'] as $key => $value) {
                    $r_name = $value;
                    $r_contact = $_POST['referenceContact'][$key];
                    $r_contact = '0' . $r_contact;
                    $r_relationship = $_POST['relationship'][$key];
                    $r_relationship = remove_sp_chr($r_relationship);
                    $insert_work_certification = mysqli_query($conn, "INSERT INTO tblcharacter_reference(NAME, RELATIONSHIP, CONTACT, APPLICANTID) VALUES ('$r_name', '$r_relationship', '$r_contact', '$applicantid')");
                }

                $date_today = date('Y-m-d');
                $insert_verification  = mysqli_query($conn, "INSERT INTO tbl_verificationcode(code, email, verification_date) VALUES ('$verification_code', '$email', '$date_today')");

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

                    $mail->Subject = 'Email verification';
                    $mail->Body    = '<p>To Activate Account, enter verification code: <b style="font-size: 30px;">' . $verification_code . '</b>' . '. NEVER share this code with others under any circumstances.' . '</p>';

                    $mail->send();
                    // echo 'Message has been sent';
                    session_start();
                    $_SESSION['verifyemail'] = $email;
                    header("Location: verify.php?");
                    exit();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "<script>alert('some error. please try again later')</script>";
            }
        } else {
            echo "<script>alert('Failed to upload file.')</script>";
        }
    } else {
        echo "<script>alert('You file extension must be .jpg, .jpeg or .png')</script>";
    }
}
?>
<?php include_once "partial/header.php"; ?>

<main style="background: #f8f9fa;">
    <!-- slider Area Start-->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->
                    <!-- job single End -->
                    <?php if (isset($_GET['errorpassword'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_GET['errorpassword']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="job-post-details p-4" style="background: #fff; border: 1px solid #ededed;">
                        <div class="post-details1 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Personal Information</h4>
                            </div>
                            <hr>
                            <form action="register.php" name="applicant_form" id="applicant_form" enctype='multipart/form-data' method="POST">
                                <div class="form-row">
                                    <div class="col-md-5 mb-3">
                                        <label for="fname">First name <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <input type="text" class="form-control" pattern="^[a-zA-Z\s]+" title="It only accepting letter" id="fname" name="fname" placeholder="First name" required>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label for="lname">Last name <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <input type="text" class="form-control" pattern="^[a-zA-Z\s]+" title="It only accepting letter" id="lname" name="lname" placeholder="Last name" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>M.I</label>
                                        <input type="text" class="form-control" pattern="^[a-zA-Z\s]+" title="It only accepting letter" name="mname" maxlength="1" placeholder="M.I">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="House no. / Unit no. / Building name, Street name" required>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="address">City <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <input list="city" name="city" class="form-control block" placeholder="Select City" required />
                                        <datalist id="city">
                                            <?php
                                            foreach ($cities as $key => $city) :
                                                echo '<option value="' . $city . '"> </option>';
                                            endforeach;
                                            ?>

                                        </datalist>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="region">Region <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <input list="region" name="state" class="form-control block" placeholder="Region" required />
                                        <datalist id="region">
                                            <!-- Technical Skills -->
                                            <?php
                                            foreach ($regions as $key => $region) :
                                                echo '<option value="' . $region . '"> </option>';
                                            endforeach;
                                            ?>
                                        </datalist>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="zip">Zip <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <input type="number" class="form-control" id="zip" name="zip" placeholder="Zip" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Birthdate <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                    <input type="date" class="form-control" name="birthday" max="2002-11-25" required>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="contact">Contact Number <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend2">+63</span>
                                            </div>
                                            <input type="tel" class="form-control" id="contact" name="contactno" pattern="[9]{1}[0-9]{9}" title="First digits should only start in 9 and minimum of 10 digits" placeholder="9xx-xxx-xxxx" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="contact">Telephone <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend2">02</span>
                                            </div>
                                            <input type="tel" class="form-control" id="contact" name="contactno" pattern="[0-9]{8}" title="It only accepting 8 digits" placeholder="Telephone number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="username">Username <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                            </div>
                                            <input type="text" class="form-control" id="username" placeholder="Username" name="username" maxlength="10" aria-describedby="inputGroupPrepend2" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label for="email">Email <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <input type="email" class="form-control" id="email" pattern="[a-z0-9._%+-]+@[(gmail)(yahoo)(my\.jru]+\.[a-z]{2,4}$" title="It only accepting gmail, yahoo or jru domain" name="email" placeholder="Email" required>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Password <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <input type="password" class="form-control" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,40}$" title="Password should contains atleast 1 uppercase, 1 lowercase, 1 number and 1 symbols. minimun of 8 characters" minlength="8" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Confirm Password <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                        <input type="password" class="form-control" id="confirmpassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,40}$" title="Password should contains atleast 1 uppercase, 1 lowercase, 1 number and 1 symbols. minimun of 8 characters" minlength="8" name="confirmpassword" placeholder="Confirm Password" required>
                                        <span id='message'></span>
                                    </div>

                                </div>
                                <hr>

                                <div class="small-section-tittle mt-4">
                                    <h4>Resume Information</h4>

                                </div>
                                <div class="form-group">
                                    <label for="objective">Objectives <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                    <textarea class="form-control" id="objective" name="objective" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Work Experience
                                                <a href="javascript:void(0)" class="add-more-form float-right btn-pri btn-primary">Add more</a>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="main-form">
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="workTitle">Work title</label>
                                                        <input type="text" class="form-control" id="workTitle" name="work_title[]" placeholder="Work title">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="workYear">Year Start</label>
                                                        <input type="number" min="1900" max="2099" class="form-control" id="workYear" name="work_year[]" placeholder="2021">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="workYearEnd">Year End</label>
                                                        <input type="number" min="1900" max="2099" class="form-control" id="workYearEnd" name="work_year_end[]" placeholder="2021">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="job_skill">Field of Work Experience</label>
                                                        <input list="work_fields" name="work_field[]" id="work_field[]" class="form-control block" placeholder="--Degree--" />
                                                        <datalist id="work_fields">
                                                            <!-- Technical Skills -->
                                                            <?php
                                                            foreach ($fieldOfExperience as $key => $value) :
                                                                echo '<option value="' . $value . '"> </option>';
                                                            endforeach;
                                                            ?>

                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="companyName">Company name</label>
                                                    <input type="text" class="form-control" id="companyName" name="company_name[]" placeholder="Company name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="companyDescription">Description</label>
                                                    <textarea class="form-control" id="companyDescription" name="work_description[]" rows="3"></textarea>
                                                </div>

                                                <hr>
                                                <div class="paste-new-form"></div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-check ml-2">
                                                <input type="checkbox" class="form-check-input" name="hasWorkExp">
                                                <label class="form-check-label ml-2" style="color: #676868;">Check this if you don't have any work experience</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Highest Educational Attainment: </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="educ-main-form">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <select class="form-select" aria-label="Default select example" id="highest" name="highest" required>
                                                            <option selected value="">Select Education Attainment</option>
                                                            <option value="High School Degree">Junior/Senior High Degree</option>
                                                            <option value="Non Degree Courses">Non Degree Courses</option>
                                                            <option>Bachelors Degree</option>
                                                            <option>Masters Degree</option>
                                                            <option value="Doctoral Degree">Doctorate Degree</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Education
                                                <button href="javascript:void(0)" id="btnID" class="add-more-educ float-right btn-pri btn-primary" onClick="clickLimit();">Add more</button>
                                            </h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="educ-main-form">
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="EducYear">Year Start <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                                        <input type="number" min="1900" max="2099" class="form-control" id="EducYear" name="educ_year[]" placeholder="2021" required>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="EducYearEnd">Year End <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                                        <input type="number" min="1900" max="2099" class="form-control" id="EducYearEnd" name="educ_year_end[]" placeholder="2021" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="schoolName">University/School name <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                                    <input type="text" class="form-control" id="schoolName" name="school_name[]" placeholder="School name" required>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="job_skill">Degree</h6>
                                                            <h6 style="color: #676868; display: inline;"> (Senior High, College, Masteral, Doctorate)</h6>
                                                        </label>
                                                        <input list="job_skills" name="educ_degree[]" id="educ_degree[]" class="form-control block" placeholder="--Degree--" />
                                                        <datalist id="job_skills">
                                                            <!-- Technical Skills -->
                                                            <?php
                                                            foreach ($degree as $key => $value) :
                                                                echo '<option value="' . $value . '"> </option>';
                                                            endforeach;
                                                            ?>

                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="educDescription">Activities and societies</label>
                                                    <textarea class="form-control" id="educDescription" name="educ_description[]" rows="3" placeholder="Ex. Alpha Phi Omega, Marching Band, Volleybal;"></textarea>
                                                </div>

                                                <hr>
                                                <div class="paste-new-form-educ"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Character Reference
                                                <a href="javascript:void(0)" class="add-more-reference float-right btn-pri btn-primary">Add more</a>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="main-form">
                                                <div class="form-row">
                                                    <div class="col-md-8 mb-3">
                                                        <label for="workTitle">Name</label>
                                                        <input type="text" class="form-control" id="workTitle" name="referenceName[]" placeholder="Enter name.." required />
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label for="contact">Contact Number <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupPrepend2">+63</span>
                                                            </div>
                                                            <input type="tel" class="form-control" id="contact" name="referenceContact[]" pattern="[9]{1}[0-9]{9}" title="First digits should only start in 9 and 10 digits" placeholder="9-xxx-xxxx" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="companyDescription">Relationship</label>
                                                    <input type="text" class="form-control" id="workTitle" name="relationship[]" placeholder="Enter relationship.." required />
                                                </div>
                                                <hr />
                                                <div class="paste-new-form-reference"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    Attach your photo here <h6 style="color: #ff3939; display: inline;">*</h6>
                                    <br>
                                    <input id="myfile" name="myfile" type="file" style="margin-top: 10px;" required>
                                </div>
                                <button name="submit" id="submit" type="submit" class="btn btn-primary">Submit form</button>

                            </form>
                        </div>

                    </div>

                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3 mb-50" style="background: #fff;">
                        <img src="images/employee_image.jpg" width="100%" height="600px" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="text-muted text-center">
    <div class="footer-area footer-bg footer-padding" style="padding: 90px 0;">

        <div class="container ">
            <img src="assets/img/logo/accurafind-logo.png" width="80" height="80px" alt="" />
            <p> Accurafind choose the right path with accurafind</p>
            <p class="mb-0">Connect with accurafind:</p>
            <p style="color: #fff;">jobportal.accurafind@accura-find.com</p>
            <a href="partial/terms.php" target="_blank" style="color: #ababab;">Terms and Condition | </a>
            <a href="partial/privacy.php" target="_blank" style="color: #ababab;">Privacy Policy</a>
        </div>
    </div>
</footer>

<!-- JS here -->

<!-- All JS Custom Plugins Link Here here -->
<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<script src="./assets/js/price_rangs.js"></script>

<!-- One Page, Animated-HeadLin -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="./assets/js/jquery.scrollUp.min.js"></script>
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>

<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $('#password, #confirmpassword').on('keyup', function() {
        if ($('#password').val() == $('#confirmpassword').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.main-form').remove();
        });

        $(document).on('click', '.add-more-form', function() {
            $('.paste-new-form').append('<div class="main-form">\
                                                    <div class="form-row">\
                                                        <div class="col-md-6 mb-3">\
                                                            <label for="validationDefault03">Work title</label>\
                                                            <input type="text" class="form-control" id="validationDefault03" name="work_title[]" placeholder="Work title" >\
                                                        </div>\
                                                        <div class="col-md-3 mb-3">\
                                                            <label for="validationDefault03">Year Start</label>\
                                                            <input type="number" min="1900" max="2099" step="1" class="form-control" id="validationDefault03" name="work_year[]" placeholder="2021">\
                                                        </div>\
                                                        <div class="col-md-3 mb-3">\
                                                            <label for="validationDefault03">Year End</label>\
                                                            <input type="number" min="1900" max="2099" class="form-control" id="validationDefault03" name="work_year_end[]" placeholder="2021" >\
                                                        </div>\
                                                        </div>\
                                                        <div class="form-row">\
                                                    <div class="col-md-12 mb-3">\
                                                        <label for="job_skill">Field of Work Experience</label>\
                                                        <input list="work_fields" name="work_field[]" id="work_field[]" class="form-control block" placeholder="--Degree--" />\
                                                        <datalist id="work_fields">\
                                                        </datalist>\
                                                    </div>\
                                                </div>\
                                                    <div class="form-group">\
                                                        <label for="validationDefault04">Company name</label>\
                                                        <input type="text" class="form-control" id="validationDefault04" name="company_name[]" placeholder="Company name" >\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <label for="validationDefault03">Description</label>\
                                                        <textarea class="form-control" id="validationDefault03" name="work_description[]" rows="3"></textarea>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <button class="remove-btn btn-dan btn-danger">remove</button>\
                                                    </div>\
                                                    <hr>\
                                                    <div>\
                                                    </div>\
                                                </div>');
        });

        $(document).on('click', '.remove-educ-btn', function() {
            $(this).closest('.educ-main-form').remove();
        });


        $(document).on('click', '.add-more-educ', function() {
            $('.paste-new-form-educ').append('<div class="educ-main-form">\
                                                    <div class="form-row">\
                                                        <div class="col-md-4 mb-3">\
                                                            <label for="validationDefault04">Year Start <h6 style="color: #ff3939; display: inline;">*</h6></label>\
                                                            <input type="number" min="1900" max="2099" step="1" class="form-control" id="validationDefault04" name="educ_year[]" placeholder="2021" required>\
                                                        </div>\
                                                        <div class="col-md-4 mb-3">\
                                                            <label for="validationDefault03">Year End <h6 style="color: #ff3939; display: inline;">*</h6></label>\
                                                            <input type="number" min="1900" max="2099" step="1" class="form-control" id="validationDefault03" name="educ_year_end[]" placeholder="2021" required>\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <label for="validationDefault04">University/School name <h6 style="color: #ff3939; display: inline;">*</h6></label>\
                                                        <input type="text" class="form-control" id="validationDefault04" name="school_name[]" placeholder="School name" required>\
                                                    </div>\
                                                    <div class="form-row">\
                                                    <div class="col-md-12 mb-3">\
                                                        <label for="job_skill">Degree <h6 style="color: #676868; display: inline;"> (Senior High, College, Masteral Degree)</h6></label>\
                                                        <input list="job_skills" name="educ_degree[]" id="educ_degree[]" class="form-control block" placeholder="--Degree--" />\
                                                        <datalist id="job_skills">\
                                                        </datalist>\
                                                    </div>\
                                                </div>\
                                                    <div class="form-group">\
                                                    <label for="educDescription">Activities and societies</label>\
                                                    <textarea class="form-control" id="educDescription" name="educ_description[]" rows="3" placeholder="Ex. Alpha Phi Omega, Marching Band, Volleybal;"></textarea>\
                                                </div>\
                                                    <div class="form-group">\
                                                        <button class="remove-educ-btn btn-dan btn-danger" onClick="removeClickLimit();">remove</button>\
                                                    </div>\
                                                    <hr>\
                                                    <div>\
                                                </div>\
                                                </div>');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.remove-reference', function() {
            $(this).closest('.main-form').remove();
        });

        $(document).on('click', '.add-more-reference', function() {
            $('.paste-new-form-reference').append('<div class="main-form">\
                                            <div class="form-row">\
                                                <div class="col-md-8 mb-3">\
                                                    <label for="workTitle">Name</label>\
                                                        <input type="text" class="form-control" id="workTitle" name="referenceName[]" placeholder="Enter name.." required />\
                                                            </div>\
                                                        <div class="col-md-4 mb-3">\
                                                        <label for="contact">Contact Number <h6 style="color: #ff3939; display: inline;">*</h6></label>\
                                            <div class="input-group">\
                                                                <div class="input-group-prepend">\
                                                                <span class="input-group-text" id="inputGroupPrepend2">+63</span>\
                                                                    </div>\
                                                                    <input type="tel" class="form-control" id="contact" name="referenceContact[]" pattern="[9]{1}[0-9]{9}" title="First digits should only start in 9 and 10 digits" placeholder="9-xxx-xxxx" required>\
                                                            </div>\
                                                    </div>\
                                                </div>\
                                                        <div class="form-group">\
                                                            <label for="companyDescription">Relationship</label>\
                                                            <input type="text" class="form-control" id="workTitle" name="relationship[]" placeholder="Enter relationship.." required />\
                                                        </div>\
                                                        <div class="form-group">\
                                                        <button class="remove-reference btn-dan btn-danger">remove</button>\
                                                    </div>\
                                                    <hr>\
                                                </div>');
        });
    });
</script>
<script>
    function clickLimit() {

        document.getElementById("btnID").onclick = function() {
            //disable
            this.disabled = true;

            //do some validation stuff
        }
    }
</script>
</body>

</html>