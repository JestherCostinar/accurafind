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

$not_qualified_query = mysqli_query($conn, "SELECT COUNT(*) as not_qualified_count FROM tbldecision, tbljobregistration, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbldecision.PERCENTAGE < 50 AND tbldecision.companyid = '$companyid' AND tbljobregistration.STATUS = 'Pending'");
while ($row = mysqli_fetch_array($not_qualified_query)) {
    $not_qualified_applicant_count = $row['not_qualified_count'];
}


$count_review = mysqli_query($conn, "SELECT  COUNT(*) as applicant_under_review_count FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' AND tbljobregistration.STATUS = 'Reviewing'");
while ($row_review = mysqli_fetch_array($count_review)) {
    $count_for_review = $row_review['applicant_under_review_count'];
}

$all_applicant_count = mysqli_query($conn, "SELECT COUNT(*) as allapplicant FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.REGISTRATION_DATE = '$date'");
while ($all_applicant_row = mysqli_fetch_array($all_applicant_count)) {
    $count_for_allapplicant = $all_applicant_row['allapplicant'];
}


$count_for_forInterview = 0;
$count_for_acceptedApplicant = 0;
$count_for_rejectedApplicant = 0;
$count_for_pendingApplicant = 0;
if (isset($_POST['date_choose'])) {
    $datepass = $_POST['monthly'];
    if ($datepass == "Weekly") {
        $count_forInterview = mysqli_query($conn, "SELECT COUNT(*) as forInterviewCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' AND (tbljobregistration.STATUS = 'First Interview' OR tbljobregistration.STATUS = 'Selection Stage'  OR tbljobregistration.STATUS = 'Screening Stage') AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 WEEK)");
        while ($forInterviewRow = mysqli_fetch_array($count_forInterview)) {
            $count_for_forInterview = $forInterviewRow['forInterviewCount'];
        }

        $count_accepted = mysqli_query($conn, "SELECT COUNT(*) as acceptedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Accepted' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 WEEK)");
        while ($forAccepted = mysqli_fetch_array($count_accepted)) {
            $count_for_acceptedApplicant = $forAccepted['acceptedCount'];
        }

        $count_rejected = mysqli_query($conn, "SELECT COUNT(*) as rejectedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Rejected' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 WEEK)");
        while ($forRejected = mysqli_fetch_array($count_rejected)) {
            $count_for_rejectedApplicant = $forRejected['rejectedCount'];
        }

        $count_pending = mysqli_query($conn, "SELECT COUNT(*) as pendingCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Pending' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 WEEK)");
        while ($forPending = mysqli_fetch_array($count_pending)) {
            $count_for_pendingApplicant = $forPending['pendingCount'];
        }
    } elseif ($datepass == "Monthly") {
        $count_forInterview = mysqli_query($conn, "SELECT COUNT(*) as forInterviewCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' AND (tbljobregistration.STATUS = 'First Interview' OR tbljobregistration.STATUS = 'Selection Stage'  OR tbljobregistration.STATUS = 'Screening Stage') AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 MONTH)");
        while ($forInterviewRow = mysqli_fetch_array($count_forInterview)) {
            $count_for_forInterview = $forInterviewRow['forInterviewCount'];
        }

        $count_accepted = mysqli_query($conn, "SELECT COUNT(*) as acceptedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Accepted' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 MONTH)");
        while ($forAccepted = mysqli_fetch_array($count_accepted)) {
            $count_for_acceptedApplicant = $forAccepted['acceptedCount'];
        }

        $count_rejected = mysqli_query($conn, "SELECT COUNT(*) as rejectedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Rejected' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 MONTH)");
        while ($forRejected = mysqli_fetch_array($count_rejected)) {
            $count_for_rejectedApplicant = $forRejected['rejectedCount'];
        }

        $count_pending = mysqli_query($conn, "SELECT COUNT(*) as pendingCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Pending' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 MONTH)");
        while ($forPending = mysqli_fetch_array($count_pending)) {
            $count_for_pendingApplicant = $forPending['pendingCount'];
        }
    } elseif ($datepass == "Yearly") {
        $count_forInterview = mysqli_query($conn, "SELECT COUNT(*) as forInterviewCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' AND (tbljobregistration.STATUS = 'First Interview' OR tbljobregistration.STATUS = 'Selection Stage'  OR tbljobregistration.STATUS = 'Screening Stage') AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 12 MONTH)");
        while ($forInterviewRow = mysqli_fetch_array($count_forInterview)) {
            $count_for_forInterview = $forInterviewRow['forInterviewCount'];
        }

        $count_accepted = mysqli_query($conn, "SELECT COUNT(*) as acceptedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Accepted' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 12 MONTH)");
        while ($forAccepted = mysqli_fetch_array($count_accepted)) {
            $count_for_acceptedApplicant = $forAccepted['acceptedCount'];
        }

        $count_rejected = mysqli_query($conn, "SELECT COUNT(*) as rejectedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Rejected' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 12 MONTH)");
        while ($forRejected = mysqli_fetch_array($count_rejected)) {
            $count_for_rejectedApplicant = $forRejected['rejectedCount'];
        }

        $count_pending = mysqli_query($conn, "SELECT COUNT(*) as pendingCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Pending' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 12 MONTH)");
        while ($forPending = mysqli_fetch_array($count_pending)) {
            $count_for_pendingApplicant = $forPending['pendingCount'];
        }
    }
} else {
    $count_forInterview = mysqli_query($conn, "SELECT COUNT(*) as forInterviewCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' AND (tbljobregistration.STATUS = 'First Interview' OR tbljobregistration.STATUS = 'Selection Stage'  OR tbljobregistration.STATUS = 'Screening Stage') AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 MONTH)");
    while ($forInterviewRow = mysqli_fetch_array($count_forInterview)) {
        $count_for_forInterview = $forInterviewRow['forInterviewCount'];
    }

    $count_accepted = mysqli_query($conn, "SELECT COUNT(*) as acceptedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Accepted' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 MONTH)");
    while ($forAccepted = mysqli_fetch_array($count_accepted)) {
        $count_for_acceptedApplicant = $forAccepted['acceptedCount'];
    }

    $count_rejected = mysqli_query($conn, "SELECT COUNT(*) as rejectedCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Rejected' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 MONTH)");
    while ($forRejected = mysqli_fetch_array($count_rejected)) {
        $count_for_rejectedApplicant = $forRejected['rejectedCount'];
    }

    $count_pending = mysqli_query($conn, "SELECT COUNT(*) as pendingCount FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Pending' AND tbljobregistration.REGISTRATION_DATE > DATE_SUB(now(), INTERVAL 1 MONTH)");
    while ($forPending = mysqli_fetch_array($count_pending)) {
        $count_for_pendingApplicant = $forPending['pendingCount'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <title>Accurafind | dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/logo/accurafind_logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/company.style.css" />
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
                    <a href="dashboard.php">
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="job/job.php">
                        <span class="ti-briefcase"></span>
                        <span>Job Posting</span>
                    </a>
                </li>
                <li>
                    <a href="employee/employee.php">
                        <span class="ti-id-badge"></span>
                        <span>Hired Applicant</span>
                    </a>
                </li>
                <li>
                    <a href="applicant/applicant.php">
                        <span class="ti-id-badge"></span>
                        <span>Qualified applicant</span>
                    </a>
                </li>

                <li>
                    <a href="applicant/not_qualified.php">
                        <span class="ti-id-badge"></span>
                        <span>Not qualified applicant</span>
                    </a>
                </li>
                <li>
                    <a href="applicant/archieved.php">
                        <span class="ti-id-badge"></span>
                        <span>Archived applicant</span>
                    </a>
                </li>
                <li>
                    <a href="applicant/applicant_under_interview.php">
                        <span class="ti-id-badge"></span>
                        <span>Applicant for Interview</span>
                    </a>
                </li>
                <li>
                    <a href="applicant/applicant_screening.php">
                        <span class="ti-id-badge"></span>
                        <span>Screening Stage</span>
                    </a>
                </li>
                <li>
                    <a href="applicant/applicant_selection.php">
                        <span class="ti-id-badge"></span>
                        <span>Selection Stage</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php">
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
                <span><mark class="rounded" style="padding: 0 20px; background: #68d4d9;">Welcome, <?php echo $_SESSION['USER_NAME']; ?>! </mark></span>

                <!-- <input type="search" placeholder="Search" /> -->
            </div>

            <div class="social-icons">
                <h1 class="company-name"><?php echo $_SESSION['COMPANY_NAME']; ?></h1>
            </div>
        </header>

        <main>
            <h2 class="dash-title">Dashboard</h2>
            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body" style="background: #377A98 ;">
                        <span class="ti-briefcase" style="color: #fff;"></span>
                        <div>
                            <h5 style="color: #fff;">Number of Job posting/offer</h5>
                            <?php
                            $query = mysqli_query($conn, "SELECT count(*) as job_count FROM tbljob WHERE companyid = '$companyid'");
                            while ($row = mysqli_fetch_array($query)) {
                                $job_count = $row['job_count'];
                            }
                            ?>
                            <h4 style="color: #fff;"><?php echo $job_count; ?></h4>
                        </div>
                    </div>
                    <div class="card-footer" style="background: #3c6e81;">
                        <a href="job/job.php" style="color:#fff;">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body" style="background: #57b18b;">
                        <span class="ti-id-badge" style="color: #fff;"></span>
                        <div>
                            <h5 style="color: #fff;">Number of Hired Applicant</h5>
                            <?php
                            $query = mysqli_query($conn, "SELECT count(*) as employee_count FROM tblemployee WHERE companyid = '$companyid'");
                            while ($row = mysqli_fetch_array($query)) {
                                $company_count = $row['employee_count'];
                            }
                            ?>

                            <h4 style="color: #fff;"><?php echo $company_count ?></h4>
                        </div>
                    </div>
                    <div class="card-footer" style="background: #4b9367; color: #fff">
                        <a href="employee/employee.php" style="color: #fff;">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body" style="background: #4EADAF;">
                        <span class="ti-id-badge" style="color: #fff;"></span>
                        <div>
                            <h5 style="color: #fff;">Number of Qualified Applicant</h5>
                            <?php

                            $query = mysqli_query($conn, "SELECT COUNT(*) as qualified_count FROM tbldecision, tbljobregistration, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbldecision.PERCENTAGE >= 50 AND tbldecision.companyid = '$companyid' AND tbljobregistration.STATUS = 'Pending'");
                            while ($row = mysqli_fetch_array($query)) {
                                $qualified_applicant_count = $row['qualified_count'];
                            }
                            ?>
                            <h4 style="color: #fff;"><?php echo $qualified_applicant_count ?></h4>
                        </div>
                    </div>
                    <div class="card-footer" style="background: #2d9da9;">
                        <a href="applicant/applicant.php" style="color: #fff;">View all</a>
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
                                <h6 class="m-0 font-weight-bold text-primary">Applicant Status Overview</h6>
                                <form action="" method="POST"">
                        
                        <div id=" filter" style="display: flex; justify-content: flex-end;">

                                    <select class="form-control ml-2" id="jobtitle" name="monthly">
                                        <option selected disabled value="">Select</option>
                                        <option value="Weekly">Weekly</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>

                                    <input name="date_choose" id="submit" type="submit" class="submit btn btn-primary ml-1" value="Display">
                            </div>
                            </form>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area" style="height: 438px; width: 100%">
                                <canvas id="myBarChart"></canvas>
                            </div>
                        </div>
                        <div class="card-footer" style="text-decoration: underline;">
                            <ul class="nav justify-content-around">
                                <li class="nav-item">
                                    <a class="nav-link" href="accepted.php">Accepted</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="rejected.php">Rejected</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="interview.php">Interview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pending.php">Pending</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Applicant Chart</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body mb-5 mt-4">
                            <div class="chart-pie pt-4 pb-2" style="height: 435px; width: 100%">
                                <canvas id="myPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <section class="recent">
                <div class="activity-grid">

                    <div class="activity-card mb-3">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pr-3">
                            <h3>Qualified applicant</h3>
                            <a name="submit" id="submit" type="submit" class="submit btn btn-proceed ml-2 px-4" href="applicant/applicant.php">View all</a>
                        </div>

                        <hr class="mt-0">
                        <div class="table-responsive" style="padding: 10px;">
                            <table id="tableDisplay10row" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Job Apply</th>
                                        <th>Applicant </th>
                                        <th>Registration date</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT tbljobregistration.*, tbljobregistration.REGISTRATIONID as regid, tbljobregistration.APPLICANTID as appid, DATE_FORMAT(tbljobregistration.REGISTRATION_DATE, '%M %e, %Y') AS date, tbljobregistration.STATUS as jobstat, tbldecision.*, tbljob.* FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbldecision.PERCENTAGE >= 50 AND tbljobregistration.companyid = '$companyid' AND tbljobregistration.STATUS = 'Pending' ORDER BY tbldecision.EXPERIENCE_SCORE, tbldecision.EDUCATIONAL_SCORE, tbldecision.SKILLS_SCORE DESC");
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['OCCUPATION_TITLE']; ?></td>
                                            <td><?php echo $row['APPLICANT']; ?></td>
                                            <td><?php echo $row['date']; ?></td>

                                            <td>
                                                <?php
                                                if ($row['jobstat'] == "Pending") {
                                                    echo "<span class=\"badge badge-primary\">Pending</span";
                                                } elseif ($row['jobstat'] == "Reviewing") {
                                                    echo "<span class=\"badge badge-info\">Reviewing</span";
                                                } elseif ($row['jobstat'] == "Accepted") {
                                                    echo "<span class=\"badge badge-success\">Accepted</span";
                                                } elseif ($row['jobstat'] == "Rejected") {
                                                    echo "<span class=\"badge badge-danger\">Rejected</span";
                                                } else {
                                                    echo "<span class=\"badge warning\">Error</span";
                                                }
                                                echo "</td>"
                                                ?>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="summary">
                        <div class="summary-card">
                            <div class="summary-single">
                                <div class="card">
                                    <div class="card-header" style="background: #027581; color: #fff">
                                        DAILY ACTIVITY
                                    </div>
                                    <div class="card-body" style="display: inline-block; margin-right: 250px">
                                        <h5 class="card-title" style="">Today's Applicant</h5>

                                        <p class="card-text mt-3"><?php echo $count_for_allapplicant; ?> Applicant apply today.</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </section>

            <section class=" recent mb-4 mr-4" style="margin-top: 0;">
                <div class="dashboard">

                    <div class="activity-card">
                        <div class="grid-1x1">
                            <div class="activity-card">

                                <h3 class="mb-0" style="background: #027581; color: #fff;">Recent Job Posted</h3>
                                <div class="table-responsive p-2">
                                    <table id="tableDisplay5row" class="table table-bordered">
                                        <thead style="text-align: left;">
                                            <tr>
                                                <th>Occupation title</th>
                                                <th>Job Located</th>
                                                <th>Date Posted</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, DATE_FORMAT(DATEPOSTED, '%M %e, %Y') AS date FROM tbljob,  tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.COMPANYID = '$companyid'");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr style="text-align: left;">
                                                    <td><?php echo $row['OCCUPATION_TITLE']; ?></td>
                                                    <td><?php echo $row['LOCATION']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['REMARKS'] == "On going") {
                                                            echo "<span class=\"badge badge-info\">On going</span";
                                                        } elseif ($row['REMARKS'] == "Occupied") {
                                                            echo "<span class=\"badge badge-success\">Occupied</span";
                                                        } else {
                                                            echo "<span class=\"badge warning\">Error</span";
                                                        }
                                                        echo "</td>"
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>


                            </div>


                        </div>
                    </div>

                    <div class="activity-card">
                        <div class="grid-1x1 ">
                            <div class="activity-card">
                                <h3 class="mb-0" style="background: #027581; color: #fff;">Status of applicant</h3>
                                <div class="table-responsive p-2">
                                    <table id="tableDisplay5row1" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Apply</th>
                                                <th>Applicant </th>
                                                <th>Registration date</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            $query = mysqli_query($conn, "SELECT tbljobregistration.*, tbljobregistration.REGISTRATIONID as regid, tbljobregistration.APPLICANTID as appid, DATE_FORMAT(tbljobregistration.REGISTRATION_DATE, '%M %e, %Y') AS date, tbljobregistration.STATUS as jobstat, tbldecision.*, tbljob.* FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID  AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS != 'Accepted' ORDER BY tbldecision.EXPERIENCE_SCORE, tbldecision.EDUCATIONAL_SCORE, tbldecision.SKILLS_SCORE DESC");

                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['OCCUPATION_TITLE']; ?></td>
                                                    <td><?php echo $row['APPLICANT']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>

                                                    <td>
                                                        <?php
                                                        if ($row['jobstat'] == "Pending") {
                                                            echo "<span class=\"badge badge-primary\">Pending</span";
                                                        } elseif (($row['jobstat'] == "First Interview") || ($row['jobstat'] == "Selection Stage") || ($row['jobstat'] == "Screening Stage")) {
                                                            echo "<span class=\"badge badge-info\">Reviewing</span";
                                                        } elseif ($row['jobstat'] == "First Interview") {
                                                            echo "<span class=\"badge badge-info\">Interview</span";
                                                        } elseif ($row['jobstat'] == "Accepted") {
                                                            echo "<span class=\"badge badge-success\">Accepted</span";
                                                        } elseif ($row['jobstat'] == "Rejected") {
                                                            echo "<span class=\"badge badge-danger\">Rejected</span";
                                                        } else {
                                                            echo "<span class=\"badge warning\">Error</span";
                                                        }
                                                        echo "</td>"
                                                        ?>
                                                    </td>


                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </section>

            <section class=" recent mb-4 mr-4" style="margin-top: 0;">
                <div class="dashboard">

                    <div class="summary">
                        <div class="grid-1x1">
                            <div class="activity-card">

                                <h3 class="mb-0" style="background: #027581; color: #fff;">List of Applicants</h3>
                                <div class="table-responsive p-2">
                                    <table id="tableDisplay5row2" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Ranking</th>
                                                <th>Job Apply</th>
                                                <th>Applicant </th>
                                                <th>Registration date</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = mysqli_query($conn, "SELECT tbljobregistration.*, tbljobregistration.REGISTRATIONID as regid, tbljobregistration.APPLICANTID as appid, DATE_FORMAT(tbljobregistration.REGISTRATION_DATE, '%M %e, %Y') AS date, tbljobregistration.STATUS as jobstat, tbldecision.*, tbljob.* FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS != 'Accepted' ORDER BY tbldecision.EXPERIENCE_SCORE, tbldecision.EDUCATIONAL_SCORE, tbldecision.SKILLS_SCORE DESC");
                                            $no = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $row['OCCUPATION_TITLE']; ?></td>
                                                    <td><?php echo $row['APPLICANT']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>

                                                    <td>
                                                        <?php
                                                        if ($row['jobstat'] == "Pending") {
                                                            echo "<span class=\"badge badge-primary\">Pending</span";
                                                        } elseif ($row['jobstat'] == "Reviewing") {
                                                            echo "<span class=\"badge badge-info\">Reviewing</span";
                                                        } elseif (($row['jobstat'] == "First Interview") || ($row['jobstat'] == "Selection Stage") || ($row['jobstat'] == "Screening Stage")) {
                                                            echo "<span class=\"badge badge-info\">Interview</span";
                                                        } elseif ($row['jobstat'] == "Accepted") {
                                                            echo "<span class=\"badge badge-success\">Accepted</span";
                                                        } elseif ($row['jobstat'] == "Rejected") {
                                                            echo "<span class=\"badge badge-danger\">Rejected</span";
                                                        } else {
                                                            echo "<span class=\"badge warning\">Error</span";
                                                        }
                                                        echo "</td>"
                                                        ?>
                                                    </td>


                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>


                        </div>
                    </div>

                    <div class="activity-card">
                        <div class="grid-1x1">
                            <div class="activity-card">
                                <h3 class="mb-0" style="background: #027581; color: #fff;">List of Employees</h3>

                                <div class="table-responsive p-2">
                                    <table id="tableDisplay5row3" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>EMPLOYEES NAME</th>
                                                <th>CONTACT NUMBER</th>
                                                <th>EMAIL</th>
                                                <th>POSITION</th>
                                                <th>DATEHIRED</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            $fetch_employee = mysqli_query($conn, "SELECT tblemployee.*, tblcompany.*,  CONCAT(LNAME, ', ', FNAME, ' ', MNAME, '.') AS fullname, DATE_FORMAT(tblemployee.DATEHIRED, '%M %e, %Y') AS date FROM tblemployee, tblcompany WHERE tblcompany.companyid = tblemployee.companyid AND tblcompany.companyid = '$companyid'");

                                            while ($row = mysqli_fetch_array($fetch_employee)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['fullname']; ?></td>
                                                    <td><?php echo $row['CONTACTNO']; ?></td>
                                                    <td><?php echo $row['EMAIL']; ?></td>
                                                    <td><?php echo $row['POSITION']; ?></td>
                                                    <td><?php echo $row['DATEHIRED']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
        var ctxP = document.getElementById("labelChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            plugins: [ChartDataLabels],
            type: 'pie',
            data: {
                labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
                datasets: [{
                    data: [210, 130, 120, 160, 120],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                    labels: {
                        padding: 20,
                        boxWidth: 10
                    }
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return percentage;
                        },
                        color: 'white',
                        labels: {
                            title: {
                                font: {
                                    size: '16'
                                }
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {

                labels: ["Accepted", "Rejected", "For interview", "Pending"],
                datasets: [{
                    label: "Total: ",
                    backgroundColor: ["#016FC4", "#1891C3", "#3AC0DA", "3DC6C3"],
                    hoverBackgroundColor: ["#0f7dd3", "#269acb", "#3cb4cb", "#3dafac"],
                    borderColor: "#4e73df",
                    data: [<?php echo $count_for_acceptedApplicant ?>, <?php echo $count_for_rejectedApplicant ?>, <?php echo $count_for_forInterview ?>, <?php echo $count_for_pendingApplicant ?>],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: true,
                            drawBorder: true
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 400,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 30,
                            maxTicksLimit: 10,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: true,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },

                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#fff',
                    titleFontSize: 30,
                    backgroundColor: "#8390a2",
                    bodyFontColor: "#ff",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);

                        }
                    }
                },

            }
        });
    </script>
    <!-- <script>
        $(document).ready(function() {

            google.charts.load("current", {
                packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Qualified Applicant', <?php echo $qualified_applicant_count; ?>],
                    ['Not qualified applicant', <?php echo $not_qualified_applicant_count; ?>],

                ]);

                var options = {
                    title: 'Applicant Qualification',
                    pieHole: 0,
                    colors: ['#3dc6c3', '#50e3c2'],
                    plugins: {
                        datalabels: {
                            display: true,
                            align: 'bottom',
                            backgroundColor: '#ccc',
                            borderRadius: 3,
                            font: {
                                size: 18,
                            }
                        },
                    }
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }

        });
    </script> -->
    <script>
        $(document).ready(function() {
            $('#tableDisplay10row').DataTable({
                searching: true,
                bFilter: false,
                bInfo: false,
                bJQueryUI: true,
                bLengthChange: false,
                "iDisplayLength": 10

            });
        });

        $(document).ready(function() {
            $('#tableDisplay5row').DataTable({
                searching: true,
                bFilter: false,
                bJQueryUI: true,
                bLengthChange: false,
                "iDisplayLength": 5

            });
        });
        $(document).ready(function() {
            $('#tableDisplay5row1').DataTable({
                searching: true,
                bFilter: false,
                bInfo: false,
                bJQueryUI: true,
                bLengthChange: false,
                "iDisplayLength": 5

            });
        });
        $(document).ready(function() {
            $('#tableDisplay5row2').DataTable({
                searching: true,
                bFilter: false,
                bInfo: false,
                bJQueryUI: true,
                bLengthChange: false,
                "iDisplayLength": 5

            });
        });
        $(document).ready(function() {
            $('#tableDisplay5row3').DataTable({
                searching: true,
                bFilter: false,
                bInfo: false,
                bJQueryUI: true,
                bLengthChange: false,
                "iDisplayLength": 5

            });
        });
        $(document).ready(function() {
            $('#tableDisplay5row4').DataTable({
                searching: true,
                bFilter: false,
                bInfo: false,
                bJQueryUI: true,
                bLengthChange: false,
                "iDisplayLength": 5

            });
        });
    </script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Qualified", "Not qualified"],
                datasets: [{
                    data: [<?php echo $qualified_applicant_count; ?>, <?php echo $not_qualified_applicant_count; ?>],
                    backgroundColor: ['#3dc6c3', '#50e3c2'],
                    hoverBackgroundColor: ['#3dc6c3', '#50e3c2'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",

                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    labels: {
                        
                    }
                },
                // scales: {
                //     yAxes: [{
                //         ticks: {
                //             fontColor: "green",
                //             fontSize: 18,
                //             stepSize: 1,
                //             beginAtZero: true
                //         }
                //     }],
                //     xAxes: [{
                //         ticks: {
                //             fontColor: "purple",
                //             fontSize: 14,
                //             stepSize: 1,
                //             beginAtZero: true
                //         }
                //     }]
                // },
                cutoutPercentage: 0,
            },
        });
    </script>
</body>

</html>