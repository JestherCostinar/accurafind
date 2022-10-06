<?php
require_once "../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../index.php');
}

$date = date('Y-m-d');

$not_qualified_query = mysqli_query($conn, "SELECT COUNT(*) as not_qualified_count FROM tbldecision, tbljobregistration, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND (NOT tbldecision.AGE_STATUS = 'Qualified' OR NOT tbldecision.EXPERIENCE_STATUS = 'Qualified' OR NOT tbldecision.EDUCATIONAL_STATUS = 'Qualified') AND tbljobregistration.STATUS = 'Pending'");
while ($row = mysqli_fetch_array($not_qualified_query)) {
    $not_qualified_applicant_count = $row['not_qualified_count'];
}


$count_review = mysqli_query($conn, "SELECT  COUNT(*) as applicant_under_review_count FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.STATUS = 'Reviewing'");
while ($row_review = mysqli_fetch_array($count_review)) {
    $count_for_review = $row_review['applicant_under_review_count'];
}

$all_applicant_count = mysqli_query($conn, "SELECT COUNT(*) as allapplicant FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID and tbljobregistration.REGISTRATION_DATE = '$date'");
while ($all_applicant_row = mysqli_fetch_array($all_applicant_count)) {
    $count_for_allapplicant = $all_applicant_row['allapplicant'];
}

$count_forInterview = mysqli_query($conn, "SELECT COUNT(*) as forInterviewCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID  AND tbljobregistration.STATUS = 'Under Interview' ORDER BY tbldecision.EXPERIENCE_SCORE, tbldecision.EDUCATIONAL_SCORE, tbldecision.SKILLS_SCORE DESC");
while ($forInterviewRow = mysqli_fetch_array($count_forInterview)) {
    $count_for_forInterview = $forInterviewRow['forInterviewCount'];
}

$count_accepted = mysqli_query($conn, "SELECT COUNT(*) as acceptedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID  and tbljobregistration.STATUS = 'Accepted'");
while ($forAccepted = mysqli_fetch_array($count_accepted)) {
    $count_for_acceptedApplicant = $forAccepted['acceptedCount'];
}

$count_rejected = mysqli_query($conn, "SELECT COUNT(*) as rejectedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID  and tbljobregistration.STATUS = 'Rejected'");
while ($forRejected = mysqli_fetch_array($count_rejected)) {
    $count_for_rejectedApplicant = $forRejected['rejectedCount'];
}

$count_pending = mysqli_query($conn, "SELECT COUNT(*) as pendingCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID  and tbljobregistration.STATUS = 'Pending'");
while ($forPending = mysqli_fetch_array($count_pending)) {
    $count_for_pendingApplicant = $forPending['pendingCount'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <title>Accurafind | dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/accurafind_logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/admin.style.css" />
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
                <li class="active">
                    <a href="dashboard.php" >
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="category/category.php">
                        <span class="ti-menu"></span>
                        <span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="company/company.php">
                        <span class="ti-face-smile"></span>
                        <span>Company</span>
                    </a>
                </li>            
                <li>
                    <a href="job/job.php">
                        <span class="ti-briefcase"></span>
                        <span>Job</span>
                    </a>
                </li>
                <li>
                    <a href="user/user.php">
                        <span class="ti-user"></span>
                        <span>User</span>
                    </a>
                </li>
                <li>
                    <a href="applicant/applicant.php">
                        <span class="ti-user"></span>
                        <span>Applicant to verify</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php" >
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
            <h2 class="dash-title">Dashboard</h2>
            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body" style="background: #377A98 ;">
                        <span style="color: #fff;" class="ti-briefcase"></span>
                        <div>
                            <h5 style="color: #fff;">Number of Job posting/offer</h5>
                            <?php

                            $query = mysqli_query($conn, "SELECT count(*) as job_count FROM tbljob");
                            while ($row = mysqli_fetch_array($query)) {
                                $job_count = $row['job_count'];
                            }
                            ?>
                            <h4 style="color: #fff;"><?php echo $job_count; ?></h4>
                        </div>
                    </div>
                    <div class="card-footer" style="background: #3c6e81;">
                        <a href="job/job.php" style="color: #fff;">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body" style="background: #57b18b ;">
                        <span style="color: #fff;" class="ti-id-badge"></span>
                        <div>
                            <h5 style="color: #fff;">Number of Registered Company</h5>
                            <?php

                            $getCompanyCount = mysqli_query($conn, "SELECT count(*) as company_count FROM tblcompany WHERE company_name != 'The Codies'");
                            while ($getCompanyRow = mysqli_fetch_array($getCompanyCount)) {
                                $company_count = $getCompanyRow['company_count'];
                            }
                            ?>

                            <h4 style="color: #fff;"><?php echo $company_count ?></h4>
                        </div>
                    </div>
                    <div class="card-footer" style="background: #4b9367;">
                        <a style="color: #fff;" href="company/company.php">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body" style="background: #4EADAF ;">
                        <span style="color: #fff;" class="ti-id-badge"></span>
                        <div>
                            <h5 style="color: #fff;">Number of Users</h5>
                            <?php
                            $getUserCount = mysqli_query($conn, "SELECT count(*) as user_count FROM tblusers");
                            while ($getUserRow = mysqli_fetch_array($getUserCount)) {
                                $user_count = $getUserRow['user_count'];
                            }
                            ?>

                            <h4 style="color: #fff;"><?php echo $user_count ?></h4>
                        </div>
                    </div>
                    <div class="card-footer" style="background: #2d9da9;">
                        <a style="color: #fff;" href="user/user.php">View all</a>
                    </div>
                </div>
            </div>

            <section class="recent">

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Audit Trail</h6>
                                <form action="" method="post">
                                    <div id=" filter" style="display: flex; justify-content: flex-end;">
                                        <div class="form-group my-0">
                                            <input type="date" class="form-control" name="filter_date" required>
                                        </div>
                                        <input name="date_filter" type="submit" class="submit btn btn-primary ml-1" value="filter">
                                    </div>
                                </form>

                            </div>
                            <!-- Card Body -->
                            <div class="card-body">


                                <hr class="mt-0">
                                <div class="table-responsive" style="padding: 10px;">
                                    <table id="page" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Date and Time</th>
                                                <th>Activity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $today = date('Y-m-d');
                                            $tomorrow = date('Y-m-d', strtotime($today . ' +1 day'));
                                            if (isset($_POST['date_filter'])) {
                                                $datepass = $_POST['filter_date'];
                                                $datepass_tomorrow = date('Y-m-d', strtotime($datepass . ' +1 day'));
                                                $query = mysqli_query($conn, "SELECT *, DATE_FORMAT(LOG_TIME, '%M %e, %Y - %H:%i:%s') AS date FROM tbl_log WHERE LOG_TIME >= '$datepass' and LOG_TIME < '$datepass_tomorrow' ORDER BY LOG_TIME DESC");
                                            } else {
                                                $query = mysqli_query($conn, "SELECT *, DATE_FORMAT(LOG_TIME, '%M %e, %Y - %H:%i:%s') AS date FROM tbl_log WHERE LOG_TIME >= '$today' and LOG_TIME < '$tomorrow' ORDER BY LOG_TIME DESC");
                                            }
                                            while ($row = mysqli_fetch_array($query)) {
                                                $dateFormat = date("F j, Y, g:i a");
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['NAME']; ?></td>
                                                    <td><?php echo $row['ROLE']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><?php echo $row['ACTIVITY']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="summary">
                            <div class="card mb-3">
                                <div class="card-header">
                                    Rating Overall Average
                                </div>
                                <div class="summary-single">
                                    <span class="ti-id-badge"></span>
                                    <?php
                                    $merchandisingCount = mysqli_query($conn, "SELECT COUNT(*) AS merchandisingCount FROM tblcategory INNER JOIN tblcompany ON tblcategory.CATEGORYID = tblcompany.CATEGORYID WHERE tblcategory.CATEGORY = 'Merchandising'");
                                    while ($getMercRow = mysqli_fetch_array($merchandisingCount)) {
                                        $merchNo = $getMercRow['merchandisingCount'];
                                    }
                                    ?>
                                    <div>
                                        <h5><?php echo $merchNo ?></h5>
                                        <small>Mechandising</small>
                                    </div>
                                </div>
                                <div class="summary-single">
                                    <span class="ti-id-badge"></span>
                                    <?php
                                    $servicesCount = mysqli_query($conn, "SELECT COUNT(*) AS serviceCount FROM tblcategory INNER JOIN tblcompany ON tblcategory.CATEGORYID = tblcompany.CATEGORYID WHERE tblcategory.CATEGORY = 'Services' AND tblcompany.COMPANY_NAME != 'The Codies'");
                                    while ($getServiceRow = mysqli_fetch_array($servicesCount)) {
                                        $serviceNo = $getServiceRow['serviceCount'];
                                    }
                                    ?>
                                    <div>
                                        <h5><?php echo $serviceNo ?></h5>
                                        <small>Services</small>
                                    </div>
                                </div>
                                <div class="summary-single">
                                    <span class="ti-id-badge"></span>
                                    <?php
                                    $manufacturingCount = mysqli_query($conn, "SELECT COUNT(*) AS manufacturingCount FROM tblcategory INNER JOIN tblcompany ON tblcategory.CATEGORYID = tblcompany.CATEGORYID WHERE tblcategory.CATEGORY = 'Manufacturing'");
                                    while ($getManufacturingRow = mysqli_fetch_array($manufacturingCount)) {
                                        $manufacturingNo = $getManufacturingRow['manufacturingCount'];
                                    }
                                    ?>
                                    <div>
                                        <h5><?php echo $manufacturingNo ?></h5>
                                        <small>Manufacturing</small>
                                    </div>
                                </div>
                            </div>


                            <div class="card mb-3">
                                <div class="card-header">
                                    <span class="ti-calendar">
                                        Calendar
                                    </span>

                                </div>
                                <div class="card-body" style="margin: auto;">
                                    <?php
                                    $month = date('F');
                                    $day = date('j');
                                    $year = date('Y');
                                    ?>
                                    <div class="summary-single">
                                        <div>
                                            <h5>Month</h5>
                                            <small><?php echo $month ?></small>
                                        </div>
                                    </div>
                                    <div class="summary-single">
                                        <div>
                                            <h5>Day</h5>
                                            <small><?php echo $day ?></small>
                                        </div>
                                    </div>
                                    <div class="summary-single">
                                        <div>
                                            <h5>Year</h5>
                                            <small><?php echo $year ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="../assets/js/Chart.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#page').DataTable({
                "scrollY": "350px",
                "scrollCollapse": true,
                "paging": false,
                "bInfo": false,
                "ordering": false


            });
        });
    </script>
</body>

</html>