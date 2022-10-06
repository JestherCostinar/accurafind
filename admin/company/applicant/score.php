<?php
require_once "../../../connection/config.php";

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
                <li >
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
                <li class="active">
                    <a href="applicant_under_interview.php">
                        <span class="ti-id-badge"></span>
                        <span>Applicant For Interview</span>
                    </a>
                </li>
                <li>
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
                    <li class="breadcrumb-item"><a href="applicant_under_interview.php">Applicant Under interview</a></li>
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
                                <p><strong>Legends: </strong> candidates answers should be scored as follows:</p>
                                <p><mark>0</mark> No answer given or answer completely irrelevant. No examples given. </p>
                                <p><mark>1</mark> A few good points but main issues missing. No examples/irrelevant examples given.</p>
                                <p><mark>2</mark> Some points covered, not all relevant. Some examples given. </p>
                                <p><mark>3</mark> Some points covered. Relevant information given. Some examples given.</p>
                                <p><mark>4</mark> Good answer. Relevant information. All or most points covered. Good examples. </p>
                                <p><mark>5</mark> Perfect answer. All points addressed. All points relevant. Good examples.</p>
                                <a href="PERSONALITY-TEST.pdf" download="" style="text-decoration: underline;">Click to download Guide Interview Question</a>
                                <div class="form-group">
                                    <label for="app_score" class="col-form-label">Interview Score: <h6 style="color: #ff3939; display: inline;"> (Personality Test)</h6></label>
                                    <input type="number" class="form-control" id="app_score" min="0" max="5" name="app_score">
                                </div>
                                <div class="form-group">
                                    <label for="app_score1" class="col-form-label">Interview Score: <h6 style="color: #ff3939; display: inline;"> (Psychometric Test)</h6></label>
                                    <input type="number" class="form-control" id="app_score1" min="0" max="5" name="app_score1">
                                </div>
                                <div class="card-footer p-2 ">
                                    <input type="hidden" name="reg_id" id="reg_id" value="<?php echo $_GET['regisid']; ?>">
                                    <button type="submit" class="btn btn-success float-right" name="submit_score">Submit</button>
                                </div>
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

if (isset($_POST['submit_score'])) {
    $reg_id = $_POST['reg_id'];
    $a_score = $_POST['app_score'];
    $b_score = $_POST['app_score1'];
    $total_score = $a_score + $b_score;
    $remarks_query = mysqli_query($conn, "UPDATE tbljobregistration SET INTERVIEW_SCORE = '$total_score' WHERE registrationid = '$reg_id'");
    $today = date("Y-m-d H:i:s");
    $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Set Interview Score')");
    if ($remarks_query) {
        header("Location: applicant_under_interview.php?forInterview=Interview score set");
        echo ("<script>window.location = 'applicant_under_interview.php';</script>");
    } else {
        echo "<script>alert('some error. please try again later')</script>";
        echo ("<script>window.location = 'applicant_under_interview.php';</script>");
    }
}
?>