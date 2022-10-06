<?php
require_once "../../../connection/config.php";

session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <title>Accurafind | Applicant</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/accurafind_logo.png" />
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
    <link rel="stylesheet" href="../../assets/css/admin.style.css" />
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
                    <a href="../category/category.php">
                        <span class="ti-menu"></span>
                        <span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="../company/company.php">
                        <span class="ti-face-smile"></span>
                        <span>Company</span>
                    </a>
                </li>
                <li>
                    <a href="../job/job.php">
                        <span class="ti-briefcase"></span>
                        <span>Job</span>
                    </a>
                </li>
                <li>
                    <a href="../user/user.php">
                        <span class="ti-user"></span>
                        <span>User</span>
                    </a>
                </li>
                <li class="active">
                    <a href="applicant.php">
                        <span class="ti-user"></span>
                        <span>Applicant to verify</span>
                    </a>
                </li>
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
                <div></div>
            </div>
        </header>

        <main>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Applicant</li>
                </ol>
            </nav>
            <section class="recent" style="margin-top: 0;">
                <div>
                    <div class="activity-card">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pr-3">
                            <h3 class="mb-0">List of Applicant need to verify</h3>
                            <form action="applicant.php" method="POST"">
                        
                            <div id=" filter" style="display: flex; justify-content: flex-end;">
                                <!-- <select class="form-control ml-2" name="verifylevel">
                                    <option value="Basic Level">Basic Level</option>
                                </select>

                                <input name="submit" id="submit" type="submit" class="submit btn btn-primary ml-1" value="filter"> -->

                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive" style="padding: 10px;">
                        <table id="examplee" class="table">
                            <thead>
                                <tr>
                                    <th>Applicant name</th>
                                    <th>Verification Level</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $today = date('Y-m-d');

                                $query = mysqli_query($conn, "SELECT DISTINCT tblverification.DATE_SUBMIT, tblapplicant.APPLICANTID as appid, CONCAT(tblapplicant.LNAME, ', ', tblapplicant.FNAME, ' ', tblapplicant.MNAME) AS applicantname, tblverification.STATUS, tblapplicant.VERIFY_LEVEL FROM tblverification, tblapplicant WHERE tblverification.STATUS = 'Processing' and tblverification.DATE_SUBMIT = '$today' and tblapplicant.VERIFY_LEVEL = 'Basic Level' and tblverification.APPLICANTID = tblapplicant.APPLICANTID");

                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['applicantname']; ?></td>
                                        <td><?php echo $row['VERIFY_LEVEL']; ?></td>
                                        <td width="3%"><a href="attached_img.php?applicantid=<?php echo $row['appid']; ?>" class="btn btn-sm btn-outline-success">
                                                <span class="ti-eye"></span>
                                            </a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
    </section>
    </main>
    </div>
    <script>
        $(document).ready(function() {
            $('#examplee').DataTable({
                "bPaginate": false,
                "bFilter": false,
                "bInfo": false,
                "searching": true,
                bJQueryUI: false,
                "aLengthMenu": [
                    [2, 5, 10, -1],
                    [2, 5, 10, "All"]
                ],
                "iDisplayLength": 2
            });
        });
    </script>
</body>

</html>