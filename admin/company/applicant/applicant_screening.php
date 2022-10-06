<?php
require_once "../../../connection/config.php";

session_start();

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}
date_default_timezone_set('Asia/Manila');

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
                <li class="active">
                    <a href="applicant_screening.php">
                        <span class="ti-id-badge"></span>
                        <span>Screening Stage</span>
                    </a>
                </li>
                <li>
                    <a href="applicant_selection.php">
                        <span class="ti-id-badge"></span>
                        <span>Selection Stage</span>
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
                    <li class="breadcrumb-item active" aria-current="page">Applicant</li>
                </ol>
            </nav>

            <?php if (isset($_GET['forInterview'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_GET['forInterview']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <section class="recent" style="margin-top: 0;">
                <div>
                    <div class="activity-card">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pr-3">
                            <h3 class="mb-0">List of Applicant Scheduled for Screening</h3>


                            <form action="" method="POST"">
                                <div id=" filter" style="display: flex; justify-content: flex-end;">

                                <select class="form-control input-sm ml-2" id="jobtitle" name="jobtitle">
                                    <option value="all">All Job</option>
                                    <?php
                                    $queryy = mysqli_query($conn, "SELECT tbljob.* FROM tbljob WHERE tbljob.companyid = '$companyid'");
                                    while ($roww = mysqli_fetch_array($queryy)) {
                                    ?>
                                        <option value="<?php echo $roww['OCCUPATION_TITLE']; ?>"><?php echo $roww['OCCUPATION_TITLE']; ?></option>

                                    <?php } ?>
                                </select>
                                <input name="submit" id="submit" type="submit" class="submit btn btn-primary ml-2" value="filter">
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive" style="padding: 10px;">
                        <table id="examplee" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ranking</th>
                                    <th>Job Apply</th>
                                    <th>Applicant </th>
                                    <th>Application Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (isset($_POST['submit'])) {
                                    $jobtitle = $_POST['jobtitle'];
                                    // $query = mysqli_query($conn, "SELECT tbljobregistration.*, DATE_FORMAT(tbljobregistration.REGISTRATION_DATE, '%M %e, %Y') AS date, tbljobregistration.STATUS as jobstat, tbldecision.*, tbljob.* FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljob.OCCUPATION_TITLE = '$jobtitle' AND tbldecision.AGE_STATUS = 'Qualified' AND tbldecision.EXPERIENCE_STATUS = 'Qualified' AND  tbldecision.EDUCATIONAL_STATUS = 'Qualified' AND tbljobregistration.companyid = '$companyid' ORDER BY tbldecision.EDUCATIONAL_SCORE DESC");

                                    if ($jobtitle == "all") {
                                        echo ("<script>window.location = 'applicant_under_interview.php';</script>");
                                    } else {
                                        $query = mysqli_query($conn, "SELECT tbljobregistration.*, tbljobregistration.REGISTRATIONID as regid, tbljobregistration.APPLICANTID as appid, DATE_FORMAT(tbljobregistration.REGISTRATION_DATE, '%M %e, %Y') AS date, tbljobregistration.STATUS as jobstat, tbldecision.*, tbljob.* FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljob.OCCUPATION_TITLE = '$jobtitle' AND tbljobregistration.companyid = '$companyid' AND tbljobregistration.STATUS = 'Screening Stage' ORDER BY tbljobregistration.INTERVIEW_SCORE DESC");
                                    }
                                } else {
                                    $query = mysqli_query($conn, "SELECT tbljobregistration.*, tbljobregistration.REGISTRATIONID as regid, tbljobregistration.APPLICANTID as appid, DATE_FORMAT(tbljobregistration.REGISTRATION_DATE, '%M %e, %Y') AS date, tbljobregistration.STATUS as jobstat, tbldecision.*, tbljob.* FROM tbljobregistration, tbldecision, tbljob WHERE tbldecision.DECISIONID = tbljobregistration.DECISIONID AND tbljobregistration.JOBID = tbljob.JOBID AND tbljobregistration.companyid = '$companyid' AND tbljobregistration.STATUS = 'Screening Stage' ORDER BY tbljobregistration.INTERVIEW_SCORE DESC");
                                }
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
                                            } elseif ($row['jobstat'] == "First Interview") {
                                                echo "<span class=\"badge badge-info\">First Interview</span";
                                            } elseif ($row['jobstat'] == "Screening Stage") {
                                                echo "<span class=\"badge badge-info\">Screening Stage</span";
                                            } elseif ($row['jobstat'] == "Selection Stage") {
                                                echo "<span class=\"badge badge-info\">Selection Stage</span";
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
                                        <td align="center" width="5%">                    
                                            
                                            <a href="applicant_selection_action.php?regisid=<?php echo $row['regid']; ?>&applicantid=<?php echo $row['appid']; ?>&position=<?php echo $row['OCCUPATION_TITLE']; ?>&jobStatus=<?php echo $row['jobstat']; ?>" class="btn btn-success btn-sm">
                                                <span class="ti-pencil-alt"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>


        </main>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#examplee').DataTable({
                searching: false,
                bFilter: false,
                bJQueryUI: true,
                bLengthChange: false,
                "iDisplayLength": 10
            });
        });

        $(document).ready(function() {
            $("#jobtitle").on('change', function() {
                var value = $(this).val();
                // alert(value);

                $.ajax({
                    url: "fetch.php",
                    type: "POST",
                    data: 'request=' + value,
                    beforeSend: function() {
                        $(".container").html("<span>Working...</span>");
                    },
                    success: function(data) {
                        $(".container").html * (data);
                    }
                });
            });
        });
    </script>
</body>

</html>