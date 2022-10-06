<?php
include('connection/config.php');
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['applicantid'])) {
    $applicantid = $_SESSION['applicantid'];
    $applicant_level = $_SESSION['verifylevel'];
} else {
    header('location: login.php');
}

$getApplicant = mysqli_query($conn, "SELECT * FROM tblapplicant WHERE applicantid = '$applicantid'");
while ($applicantRow = mysqli_fetch_array($getApplicant)) {
    $applicantFname = $applicantRow['FNAME'];
    $applicantLname = $applicantRow['LNAME'];
    $applicantMname = $applicantRow['MNAME'];
    $applicantAddress = $applicantRow['ADDRESS'];
    $applicantCity = $applicantRow['CITY'];
    $applicantState = $applicantRow['STATE'];
    $applicantZip = $applicantRow['ZIP'];
    $applicantContact = $applicantRow['CONTACTNO'];
    $applicantUsername = $applicantRow['USERNAME'];
    $applicantEmail = $applicantRow['EMAIL'];
    $applicantAge = $applicantRow['AGE'];
    $applicantObjective = $applicantRow['OBJECTIVES'];
    $applicantFilename = $applicantRow['FILE_NAME'];
}

if (isset($_POST['submitRequirement'])) {
    foreach ($_POST['myfile'] as $key => $value) {
        $attachFile = $_FILES['myfile']['name'][$key];

        $imageFileType = strtolower(pathinfo($attachFile, PATHINFO_EXTENSION));

        $extensions_arr = array("jpg", "jpeg", "png", "docs", "pdf");
        // Check extension
        if (in_array($imageFileType, $extensions_arr)) {
            if (move_uploaded_file($_FILES["myfile"]["tmp_name"][$key], 'requirements-folder/' . $attachFile)) {
                $insertVerification = mysqli_query($conn, "INSERT INTO tblverification(FILE_DESCRIPTION , FILE_NAME, DATE_SUBMIT, STATUS, APPLICANTID) VALUES ('$fileDesc', '$attachFile', '$date_today', 'Processing', '$applicantid')");
            } else {
                echo "<script>alert('Failed to upload file.')</script>";
            }
        } else {
            echo "<script>alert('You file extension must be .jpg, .jpeg or .png')</script>";
        }
    }
}
?>

<?php include_once "partial/applicant_header.php"; ?>
<style>
    .a-side-nav:hover {
        color: #007bff;
    }
</style>
<main style="background: #e2e8f0;">
    <!-- slider Area Start-->

    <section class="featured-job-area feature-padding">
        <div class="container">
            <div class="row gutters">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <?php if (isset($_GET['validateMsg'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_GET['validateMsg']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="card h-100">

                        <div class="card-body">

                            <div class="row gutters" style="color: #1a202c; text-align: left; ">
                                <div class="container">

                                    <div class="row gutters-sm">
                                        <div class="col-md-4 d-none d-md-block">
                                            <div class="card">
                                                <div class="card-body">
                                                    <nav class="nav flex-column nav-pills nav-gap-y-1">

                                                        <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active a-side-nav">
                                                            Profile Information
                                                        </a>
                                                        <a href="#resumeinfo" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded  a-side-nav">
                                                            Resume Information
                                                        </a>
                                                        <a href="#resume" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded a-side-nav">
                                                            Resume
                                                        </a>
                                                        <?php
                                                        $notif_count = mysqli_query($conn, "SELECT COUNT(*) as notif_count FROM tblcompany, tbljob, tbljobregistration WHERE tbljobregistration.APPLICANTID = '$applicantid' and tbljobregistration.COMPANYID = tblcompany.COMPANYID and tbljobregistration.JOBID = tbljob.JOBID and tbljobregistration.STATUS = 'Accepted'");
                                                        while ($notifRow = mysqli_fetch_array($notif_count)) {
                                                            $notification_count = $notifRow['notif_count'];
                                                        }
                                                        ?>
                                                        <a href="#notification" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded a-side-nav">
                                                            Notification
                                                            <?php if ($notification_count > 0) {
                                                            ?>
                                                                <span class="badge badge-danger float-right"><?php echo $notification_count ?></span>
                                                            <?php } ?>
                                                        </a>
                                                        <a href="#tracker" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded a-side-nav ">
                                                            Application tracker
                                                        </a>
                                                        <a href="#requirement" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded  a-side-nav">
                                                            Requirements
                                                        </a>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header border-bottom mb-3 d-flex d-md-none">
                                                    <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                                                        <li class="nav-item">
                                                            <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#resumeinfo" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#resume" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield">
                                                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                                                </svg></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#notification" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                                                </svg></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#tracker" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                                                </svg></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#requirement" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-body tab-content">
                                                    <div class="tab-pane active" id="profile">
                                                        <h6>YOUR PROFILE INFORMATION</h6>
                                                        <hr>
                                                        <form>
                                                            <div class="form-row">

                                                                <div class="col-md-5 mb-3">
                                                                    <label for="fname">First name</label>
                                                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?php echo $applicantFname ?>" readonly>
                                                                </div>
                                                                <div class="col-md-5 mb-3">
                                                                    <label for="lname">Last name</label>
                                                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?php echo $applicantLname ?>" readonly>
                                                                </div>
                                                                <div class="col-md-2 mb-3">
                                                                    <label for="mname">M.I</label>
                                                                    <input type="text" class="form-control" id="mname" name="mname" maxlength="1" placeholder="M.I" value="<?php echo $applicantMname ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo $applicantAddress ?>" readonly>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="city">City</label>
                                                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $applicantCity ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <label for="region">Region</label>
                                                                    <input type="text" class="form-control" id="region" name="state" placeholder="Region" value="<?php echo $applicantState ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <label for="zip">Zip</label>
                                                                    <input type="number" class="form-control" id="zip" name="zip" placeholder="zip" value="<?php echo $applicantZip ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="contact">Contact Number</label>
                                                                    <input type="number" class="form-control" id="contact" name="contactno" placeholder="Contact no#" value="<?php echo $applicantContact ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="username">Username</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $applicantUsername ?>" readonly>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $applicantEmail ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <a href="updateProfile.php" type="button" class="btn-pri btn-primary">Edit Profile</a>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="resumeinfo">
                                                        <h6>RESUME INFORMATION </h6>
                                                        <hr>
                                                        <form>

                                                            <div class="form-group">
                                                                <label for="username">Objective</label>
                                                                <textarea class="form-control" id="objective" name="objective" rows="3" readonly><?php echo $applicantObjective ?></textarea>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label class="d-block">Work Experience
                                                                    <a href="insert_work.php" class="add-more-form float-right btn-pri btn-primary">Add more</a>

                                                                </label>
                                                                <div class="table-responsive" style="padding: 10px;">
                                                                    <table id="examplee" class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Job name</th>
                                                                                <th>Year</th>
                                                                                <th>Field</th>
                                                                                <th>Company name</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php
                                                                            include('connection/config.php');
                                                                            $query = mysqli_query($conn, "SELECT * FROM tblapplicant_workexperience WHERE applicantid = '$applicantid'");
                                                                            while ($row = mysqli_fetch_array($query)) {

                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $row['WORK_TITLE']; ?></td>
                                                                                    <td><?php echo $row['WORK_YEAR']; ?></td>
                                                                                    <td><?php echo $row['FIELD']; ?></td>
                                                                                    <td><?php echo $row['COMPANY_NAME']; ?></td>
                                                                                    <td width="14%">
                                                                                        <a href="edit_workexp.php?wordEdit=<?php echo $row['WORK_EXPERIENCE_ID']; ?>" class="btn-suc btn-success btn-sm p-2">
                                                                                            <span class="ti-pencil"></span>
                                                                                        </a>
                                                                                        <a href="applicantDelete.php?workDelete=<?php echo $row['WORK_EXPERIENCE_ID']; ?>" class="btn-dan btn-danger btn-sm p-2">
                                                                                            <span class="ti-trash"></span>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label class="d-block">Education
                                                                    <a href="insert_education.php" class="add-more-form float-right btn-pri btn-primary">Add more</a>

                                                                </label>
                                                                <div class="table-responsive" style="padding: 10px;">
                                                                    <table id="examplee" class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Education Year</th>
                                                                                <th>School/University Name</th>
                                                                                <th>Degree</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php
                                                                            include('connection/config.php');
                                                                            $query = mysqli_query($conn, "SELECT * FROM tblapplicant_education WHERE applicantid = '$applicantid'");
                                                                            while ($row = mysqli_fetch_array($query)) {

                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $row['EDUC_YEAR']; ?></td>
                                                                                    <td><?php echo $row['SCHOOL_NAME']; ?></td>
                                                                                    <td><?php echo $row['EDUCATIONAL_DEGREE']; ?></td>
                                                                                    <td width="14%">
                                                                                        <a href="edit_educ.php?educEdit=<?php echo $row['EDUCATION_ID']; ?>" class="btn-suc btn-success btn-sm p-2">
                                                                                            <span class="ti-pencil"></span>
                                                                                        </a>
                                                                                        <a href="applicantDelete.php?educDelete=<?php echo $row['EDUCATION_ID']; ?>" class="btn-dan btn-danger p-2">
                                                                                            <span class="ti-trash"></span>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>

                                                            <hr>
                                                            <div class="form-group">
                                                                <label class="d-block">Licenses & certifications
                                                                    <a href="insert_certificate.php" class="add-more-form float-right btn-pri btn-primary">Add More</a>

                                                                </label>
                                                                <div class="table-responsive" style="padding: 10px;">
                                                                    <table id="examplee" class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Certification Name</th>
                                                                                <th width="20%">Issue Date</th>
                                                                                <th>Organization</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php
                                                                            include('connection/config.php');
                                                                            $query = mysqli_query($conn, "SELECT * FROM tblcertificate WHERE applicantid = '$applicantid'");
                                                                            while ($row = mysqli_fetch_array($query)) {

                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $row['CERTIFICATE_NAME']; ?></td>
                                                                                    <td width="20%"><?php echo $row['ISSUE_DATE']; ?></td>
                                                                                    <td><?php echo $row['ORGANIZATION']; ?></td>
                                                                                    <td width="14%">
                                                                                        <a href="edit_certificate.php?editCert=<?php echo $row['CERTIFICATE_ID']; ?>" class="btn-suc btn-success btn-sm p-2">
                                                                                            <span class="ti-pencil"></span>
                                                                                        </a>
                                                                                        <a href="applicantDelete.php?certificate=<?php echo $row['CERTIFICATE_ID']; ?>" class="btn-dan btn-danger p-2">
                                                                                            <span class="ti-trash"></span>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label class="d-block">Character Reference/s
                                                                    <a href="insert_reference.php" class="add-more-form float-right btn-pri btn-primary">Add More</a>

                                                                </label>
                                                                <div class="table-responsive" style="padding: 10px;">
                                                                    <table id="examplee" class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Position / Relationship</th>
                                                                                <th>Contact</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php
                                                                            include('connection/config.php');
                                                                            $query = mysqli_query($conn, "SELECT * FROM tblcharacter_reference WHERE applicantid = '$applicantid'");
                                                                            while ($row = mysqli_fetch_array($query)) {

                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $row['NAME']; ?></td>
                                                                                    <td><?php echo $row['RELATIONSHIP']; ?></td>
                                                                                    <td><?php echo $row['CONTACT']; ?></td>
                                                                                    <td width="14%">
                                                                                        <a href="edit_reference.php?editRef=<?php echo $row['REFERENCE_ID']; ?>" class="btn-suc btn-success btn-sm p-2">
                                                                                            <span class="ti-pencil"></span>
                                                                                        </a>
                                                                                        <a href="applicantDelete.php?reference=<?php echo $row['REFERENCE_ID']; ?>" class="btn-dan btn-danger p-2">
                                                                                            <span class="ti-trash"></span>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="resume">
                                                        <h6 style="display: inline-flex;" class="mb-4">RESUME
                                                            <a href="verify_account.php" style="color: blue; text-decoration: underline;">
                                                                <?php
                                                                // echo $applicant_level;
                                                                if ($applicant_level != "Fully Verified") {
                                                                    echo "( Verify account )";
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>

                                                            </a>
                                                        </h6>
                                                        <h3>
                                                            <?php
                                                            // echo $applicant_level;
                                                            $applicant_percent = 0;
                                                            if ($applicant_level == "Basic Level") {
                                                                $applicant_percent = 25;
                                                            } elseif ($applicant_level == "Fully Verified") {
                                                                $applicant_percent = 100;
                                                            }
                                                            ?>
                                                            <div class="container">
                                                                <div class="row"><br />
                                                                    <div class="col-md-12">
                                                                        <div class="progress">
                                                                            <div class="one primary-color"><br><br><br>
                                                                                <p>User level</p>
                                                                            </div>
                                                                            <div class="three primary-color"><br><br><br>
                                                                                <p>Fully Verified</p>
                                                                            </div>
                                                                            <div class="progress-bar" style="width: <?php echo $applicant_percent; ?>%;"></div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <p><?php echo $applicant_level; ?><i class="fas fa-check m-1"></i></p> -->
                                                        </h3>


                                                        <hr class="mt-8">
                                                        <form>
                                                            <ul class="list-group list-group-sm">
                                                                <li class="list-group-item has-icon">
                                                                    <div class="float-right">
                                                                        <img src="upload/<?php echo $applicantFilename; ?>" width="100" height="100">
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0">Name</h6>
                                                                        <small class="text-muted"><?php echo $applicantLname . ', ' ?><?php echo $applicantFname . ' ' ?><?php echo $applicantMname . '.' ?></small>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0">Age</h6>
                                                                        <small class="text-muted"><?php echo $applicantAge ?></small>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0">Address</h6>
                                                                        <small class="text-muted"><?php echo $applicantAddress . ', ' ?><?php echo $applicantCity . ', ' ?><?php echo $applicantState . ', ' ?><?php echo $applicantZip ?></small>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0">Contact Number</h6>
                                                                        <small class="text-muted"><?php echo $applicantContact ?></small>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0">Email address</h6>
                                                                        <small class="text-muted"><?php echo $applicantEmail ?></small>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="card list-group mt-3">
                                                                <div class="card-header">
                                                                    Objectives
                                                                </div>
                                                                <div class="card-body">
                                                                    <blockquote class="blockquote mb-0">
                                                                        <p><?php echo $_SESSION['objective'] ?></p>
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                            <div class="card list-group mt-3">
                                                                <div class="card-header">
                                                                    Work Experience
                                                                </div>
                                                                <div class="card-body">
                                                                    <blockquote class="blockquote mb-0">
                                                                        <?php
                                                                        $getwork_experience1 = mysqli_query($conn, "SELECT * FROM tblapplicant_workexperience WHERE applicantid = '$applicantid'");
                                                                        while ($row4 = mysqli_fetch_array($getwork_experience1)) {
                                                                        ?>
                                                                            <p class="mb-0" style="font-weight: 350;"><?php echo $row4['WORK_TITLE']; ?>(<?php echo $row4['FIELD']; ?>)</p>
                                                                            <footer class="blockquote-footer mb-2 "><?php echo $row4['COMPANY_NAME'] . $row4['WORK_YEAR']; ?></footer>
                                                                            <h6 style="font-weight: 350;"><?php echo $row4['WORK_DESCRIPTION']; ?></h6>
                                                                            <hr>
                                                                        <?php } ?>
                                                                    </blockquote>

                                                                </div>
                                                            </div>
                                                            <div class="card list-group mt-3">
                                                                <div class="card-header">
                                                                    Education
                                                                </div>
                                                                <div class="card-body">
                                                                    <blockquote class="blockquote mb-0">
                                                                        <?php
                                                                        $geteducation1 = mysqli_query($conn, "SELECT * FROM tblapplicant_education WHERE applicantid = '$applicantid'");
                                                                        while ($row5 = mysqli_fetch_array($geteducation1)) {
                                                                        ?>

                                                                            <p class="mb-0" style="font-weight: 350;"><?php echo $row5['SCHOOL_NAME']; ?></p>
                                                                            <footer class="blockquote-footer mb-2 "><?php echo $row5['EDUC_YEAR']; ?></footer>
                                                                            <h6 style="font-weight: 350;"><?php echo $row5['EDUC_DESCRIPTION']; ?></h6>
                                                                            <hr>
                                                                        <?php } ?>
                                                                    </blockquote>

                                                                </div>
                                                            </div>
                                                            <div class="card list-group mt-3">
                                                                <div class="card-header">
                                                                    Licenses and Certificates
                                                                </div>
                                                                <div class="card-body">
                                                                    <blockquote class="blockquote mb-0">
                                                                        <?php
                                                                        $getcertificate = mysqli_query($conn, "SELECT * FROM tblcertificate WHERE applicantid = '$applicantid'");
                                                                        while ($certRow = mysqli_fetch_array($getcertificate)) {
                                                                        ?>
                                                                            <p class="mb-2" style="font-weight: 350;"><?php echo $certRow['CERTIFICATE_NAME']; ?> (<?php echo $certRow['ISSUE_DATE']; ?>)</p>
                                                                            <footer class="blockquote mb-2 " style="font-size: 1rem;">Organization: <?php echo $certRow['ORGANIZATION']; ?></footer>
                                                                            <hr>
                                                                        <?php } ?>
                                                                    </blockquote>

                                                                </div>
                                                            </div>
                                                            <div class="card list-group mt-3">
                                                                <div class="card-header">
                                                                    Character References
                                                                </div>
                                                                <div class="card-body">
                                                                    <blockquote class="blockquote mb-0">
                                                                        <?php
                                                                        $getreference = mysqli_query($conn, "SELECT * FROM tblcharacter_reference WHERE applicantid = '$applicantid'");
                                                                        while ($referenceRow = mysqli_fetch_array($getreference)) {
                                                                        ?>
                                                                            <p class="mb-2" style="font-weight: 350;"><?php echo $referenceRow['NAME']; ?> (<?php echo $referenceRow['RELATIONSHIP']; ?>)</p>
                                                                            <footer class="blockquote mb-2 " style="font-size: 1rem;">Contact no#: <?php echo $referenceRow['CONTACT']; ?></footer>
                                                                            <hr>
                                                                        <?php } ?>
                                                                    </blockquote>

                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                    <div class="tab-pane" id="notification">
                                                        <h6>NOTIFICATION SETTINGS</h6>
                                                        <hr>
                                                        <form action="" method="POST" enctype='multipart/form-data'>
                                                            <div class="form-group mb-0">
                                                                <ul class="list-group list-group-sm">
                                                                    <li class="list-group-item has-icon">
                                                                        <?php
                                                                        include('connection/config.php');
                                                                        $getAccepted = mysqli_query($conn, "SELECT tblcompany.COMPANYID, tblcompany.COMPANY_NAME, tbljob.OCCUPATION_TITLE, tbljobregistration.STATUS, tbljobregistration.REMARKS FROM tblcompany, tbljob, tbljobregistration WHERE tbljobregistration.APPLICANTID = '$applicantid' and tbljobregistration.COMPANYID = tblcompany.COMPANYID and tbljobregistration.JOBID = tbljob.JOBID and tbljobregistration.STATUS = 'Accepted'");
                                                                        while ($getAcceptedRow = mysqli_fetch_array($getAccepted)) {
                                                                            $company_id_accepted = $getAcceptedRow['COMPANYID'];
                                                                        ?>
                                                                            <div>
                                                                                <h6 class="mb-0"><?php echo $getAcceptedRow['COMPANY_NAME']; ?> <span class="badge badge-success blinking"><?php echo $getAcceptedRow['STATUS']; ?></span></h6>
                                                                                <h6 class="text-muted mt-2"><?php echo $getAcceptedRow['OCCUPATION_TITLE']; ?></h6><br>
                                                                                <small class="text-muted"><?php echo $getAcceptedRow['REMARKS']; ?></small>
                                                                            </div>

                                                                        <?php } ?>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="tracker">
                                                        <h6>JOB APPLICATION TRACKER</h6>
                                                        <hr>
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <!-- <th scope="col">#</th> -->
                                                                        <th scope="col">Company name</th>
                                                                        <th scope="col">Position</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Message</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    include('connection/config.php');
                                                                    $query = mysqli_query($conn, "SELECT tblcompany.COMPANY_NAME, tbljob.OCCUPATION_TITLE, tbljobregistration.STATUS, tbljobregistration.REMARKS FROM tblcompany, tbljob, tbljobregistration WHERE tbljobregistration.APPLICANTID = '$applicantid' and tbljobregistration.COMPANYID = tblcompany.COMPANYID and tbljobregistration.JOBID = tbljob.JOBID and tbljobregistration.STATUS != 'Accepted'");
                                                                    while ($row = mysqli_fetch_array($query)) {
                                                                    ?>
                                                                        <tr>
                                                                            <!-- <td><?php echo $row['APPLICANTID']; ?></td> -->
                                                                            <td><?php echo $row['COMPANY_NAME']; ?></td>
                                                                            <td><?php echo $row['OCCUPATION_TITLE']; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                // if ($row['STATUS'] == "On going") {
                                                                                //     echo "<span class=\"badge badge-info\">On going</span";
                                                                                // } elseif ($row['STATUS'] == "Occupied") {
                                                                                //     echo "<span class=\"badge badge-success\">Occupied</span";
                                                                                // } else {
                                                                                //     echo "<span class=\"badge warning\">Error</span";
                                                                                // }

                                                                                if ($row['STATUS'] == "Pending") {
                                                                                    echo "<span class=\"badge badge-primary\">Pending</span>";
                                                                                } elseif ($row['STATUS'] == "First Interview") {
                                                                                    echo "<span class=\"badge badge-info\">First Interview</span>";
                                                                                } elseif ($row['STATUS'] == "Screening Stage") {
                                                                                    echo "<span class=\"badge badge-info\">Screening Stage</span>";
                                                                                } elseif ($row['STATUS'] == "Selection Stage") {
                                                                                    echo "<span class=\"badge badge-info\">Selection Stage</span>";
                                                                                } elseif ($row['STATUS'] == "Rejected") {
                                                                                    echo "<span class=\"badge badge-danger\">Rejected</span>";
                                                                                } else {
                                                                                    echo "<span class=\"badge warning\">Error</span>";
                                                                                }
                                                                                echo "</td>"
                                                                                ?>
                                                                            </td>
                                                                            <td><?php echo $row['REMARKS']; ?></td>

                                                                        <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="requirement">
                                                        <h6>REQUIREMENT </h6>
                                                        <hr>
                                                        <form>


                                                            <div class="form-group">
                                                                <label class="d-block">Job Requirements
                                                                    <a href="insert_requirement.php" class="add-more-form float-right btn-pri btn-primary">Upload requirements</a>

                                                                </label>
                                                                <div class="table-responsive" style="padding: 10px;">
                                                                    <table id="examplee" class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>File Description</th>
                                                                                <th>File</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php
                                                                            include('connection/config.php');
                                                                            $getRequirement = mysqli_query($conn, "SELECT * FROM tbljob_requirements WHERE applicantid = '$applicantid'");
                                                                            while ($requirementRow = mysqli_fetch_array($getRequirement)) {

                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $requirementRow['FILE_DESCRIPTION']; ?></td>
                                                                                    <td>
                                                                                        <a style="color: blue; text-decoration: underline;" href="requirements-folder/<?php echo $requirementRow['FILE_NAME']; ?>" download>
                                                                                            <?php echo $requirementRow['FILE_NAME']; ?>
                                                                                        </a>
                                                                                    </td>
                                                                                    <td width="6">

                                                                                        <a href="applicantDelete.php?reqDelete=<?php echo $requirementRow['REQUIREMENTS_ID']; ?>" class="btn-dan btn-danger btn-sm p-2">
                                                                                            <span class="ti-trash"></span>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- 
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">

                                        <button type="button" id="submit" name="submit" class="btn">
                                            </button>
                                        <button type="button" id="submit" name="submit" class="btn">Update</button>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="row gutters">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card mt-5">

                        <h5 class="card-header">Accurafind Message</h5>
                        <div class="card-body">
                            <h5 class="card-title">Job Posted Message</h5>
                            <?php
                            include('connection/config.php');
                            $date = date('Y-m-d');
                            $count_job = mysqli_query($conn, "SELECT count(*) as job_count FROM tbljob WHERE DATEPOSTED = '$date'");
                            while ($row = mysqli_fetch_array($count_job)) {
                                $job_count = $row['job_count'];
                            }
                            ?>

                            <p class="card-text">There is <strong><?php echo $job_count; ?></strong> job posted today. check this out!</p>
                            <a href="applicant_joblist.php" class="btn-primary p-2 rounded">View Job Posted</a>
                        </div>

                    </div>

                </div>
            </div> -->
    </section>
</main>
<?php include_once "partial/footer.php"; ?>