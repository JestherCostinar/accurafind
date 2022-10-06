<?php
require_once "../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../index.php');
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
                <!-- <span class="ti-search"></span>
                <input type="search" placeholder="Search" /> -->
            </div>

            <div class="social-icons">
                <h1 class="company-name"><?php echo $_SESSION['COMPANY_NAME']; ?></h1>
            </div>
        </header>
        <main>
            <p>
                <a href="dashboard.php" class="btn btn-success mt-4">Go back to Dashboard</a>
            </p>
            <section class="recent" style="margin-top: 0;">
                <div class="activity-card">
                    <!-- <button style="float: right;" class="btn btn-primary m-4 px-4" data-toggle="modal" data-target="#addModal" href="review_applicant.php?regisid=<?php echo $regisid; ?>&applicantid=<?php echo $applicantid; ?>">Review</button> -->

                    <div class="card">
                        <div class="card-header">
                            Rejected Applicants
                        </div>
                        <div class="">
                            <div class="table-responsive" style="padding: 10px;">
                                <table id="examplee" class="table">
                                    <thead>
                                        <tr>
                                            <th>Applicant </th>

                                            <th>Date Apply</th>
                                            <th>Job Apply</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT tbljobregistration.*, tbljobregistration.REGISTRATIONID as regid, tbljobregistration.APPLICANTID as appid, DATE_FORMAT(tbljobregistration.REGISTRATION_DATE, '%M %e, %Y') AS date, tbljobregistration.STATUS as jobstat, tbldecision.*, tbljob.* FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' and tbljobregistration.STATUS = 'Rejected'");

                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['APPLICANT']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['OCCUPATION_TITLE']; ?></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>

</html>