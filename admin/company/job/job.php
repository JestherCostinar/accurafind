<?php
session_start();
if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}
date_default_timezone_set('Asia/Manila');

include_once "partial/job_header.php";

?>

<main>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Job</li>
        </ol>
    </nav>

    <?php if (isset($_GET['jobMessage'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET['jobMessage']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pr-3">
                    <h3 class="mb-0">List of Job Vacancy</h3>
                    <div>
                        <a class="btn btn-primary" href="add_job.php">Add Vacancy</a>
                    </div>
                </div>
                <hr>
                <div class="table-responsive" style="padding: 10px;">
                    <table id="examplee" class="table">
                        <thead>
                            <tr>
                                <th>COMPANY NAME</th>
                                <th>OCCUPATION TITLE</th>
                                <th>Job Field</th>
                                <th>LOCATION</th>
                                <th>STATUS</th>
                                <th>SALARIES</th>
                                <th>WORK EXPERIENCE</th>
                                <th>AGE</th>
                                <th>SKILLS SET</th>
                                <th>HIGHEST DEGREE ATTAINMENT</th>
                                <th>JOB DESCRIPTION</th>
                                <th>PREFERED SEX</th>
                                <th>REMARKS</th>
                                <th width="15%" align="center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            require_once "../../../connection/config.php";

                            $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range FROM tbljob, tblcompany WHERE tblcompany.COMPANYID = tbljob.COMPANYID AND tbljob.companyid = '$companyid'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['COMPANY_NAME']; ?></td>
                                    <td><?php echo $row['OCCUPATION_TITLE']; ?></td>
                                    <td><?php echo $row['JOB_FIELD']; ?></td>
                                    <td><?php echo $row['LOCATION']; ?></td>
                                    <td><?php echo $row['STATUS']; ?></td>
                                    <td><?php echo $row['salaries']; ?></td>
                                    <td><?php echo $row['WORK_EXPERIENCE']; ?></td>
                                    <td width="10%" align="center"><?php echo $row['age_range']; ?></td>
                                    <td><?php echo $row['SKILLS_LIST']; ?></td>
                                    <td><?php echo $row['EDUCATIONAL']; ?></td>
                                    <td><?php echo $row['DESCRIPTION']; ?></td>
                                    <td><?php echo $row['PREFERED_SEX']; ?></td>
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
                                    <td width="8%" align="center">
                                        <div class="row">
                                            <div class="btn-group">
                                                <a href="edit_job.php?edit=<?php echo $row['JOBID']; ?>" class="btn btn-success">
                                                    <span class="ti-pencil"></span>
                                                </a>
                                                <a href="delete_job.php?del=<?php echo $row['JOBID']; ?>" class="btn btn-danger">
                                                    <span class="ti-trash"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
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
            searching: true,
            bFilter: false,
            bJQueryUI: true,
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