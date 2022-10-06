<?php
session_start();
if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}
date_default_timezone_set('Asia/Manila');

$jobtitle = '';
include_once "partial/employee_header.php";

?>

<main>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee</li>
        </ol>
    </nav>

    <?php if (isset($_GET['ratingMessage'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET['ratingMessage']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <section class="recent" style="margin-top: 0;">

        <div>
            <div class="activity-card">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pr-3">
                    <h3 class="mb-0">Company employees</h3>
                    <form action="employee.php" method="POST"">
                        
                        <div id=" filter" style="display: flex; justify-content: flex-end;">
                        <div class="form-group my-0">
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <hr width="40px" style="margin-left: 5px; margin-right: 5px">
                        <hr>
                        <div class="form-group my-0">
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                        <select class="form-control ml-2" id="jobtitle" name="jobtitle">
                            <option value="all">All Job</option>
                            <?php
                            include('../../../connection/config.php');

                            $select_jobtitle = mysqli_query($conn, "SELECT tbljob.* FROM tbljob WHERE tbljob.companyid = '$companyid'");
                            while ($roww = mysqli_fetch_array($select_jobtitle)) {
                            ?>
                                <option value="<?php echo $roww['OCCUPATION_TITLE']; ?>"><?php echo $roww['OCCUPATION_TITLE']; ?></option>

                            <?php } ?>
                        </select>

                        <input name="submit" id="submit" type="submit" class="submit btn btn-primary ml-1" value="filter">

                    </form>

                </div>
            </div>
            <hr>
            <div class="table-responsive" style="padding: 10px;">
                <table id="examplee" class="table">
                    <thead>
                        <tr>
                            <th>EMPLOYEES NAME</th>
                            <th>CONTACT NUMBER</th>
                            <th>EMAIL</th>
                            <th>POSITION</th>
                            <th>EMPLOYMENT</th>
                            <th>DATEHIRED</th>
                            <th align="center">ACTION</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        require_once "../../../connection/config.php";
                        $job = "";
                        $jobtitle = "";
                        if (isset($_POST['submit'])) {
                            $jobtitle = $_POST['jobtitle'];
                            $dateFrom = $_POST['start_date'];
                            $dateTo = $_POST['end_date'];
                            if ($jobtitle != "all") {
                                $fetch_employee = mysqli_query($conn, "SELECT tblemployee.*, tblemployee.EMAIL as emp_email, tblcompany.*,  CONCAT(LNAME, ', ', FNAME, ' ', MNAME, '.') AS fullname, DATE_FORMAT(DATEHIRED, '%M %e, %Y') AS date FROM tblemployee, tblcompany WHERE DATEHIRED >= '$dateFrom' and DATEHIRED < '$dateTo' AND tblcompany.companyid = tblemployee.companyid AND tblemployee.POSITION = '$jobtitle' AND tblcompany.companyid = '$companyid'");
                            } else {
                                $fetch_employee = mysqli_query($conn, "SELECT tblemployee.*, tblemployee.EMAIL as emp_email, tblcompany.*,  CONCAT(LNAME, ', ', FNAME, ' ', MNAME, '.') AS fullname, DATE_FORMAT(DATEHIRED, '%M %e, %Y') AS date FROM tblemployee, tblcompany WHERE DATEHIRED >= '$dateFrom' and DATEHIRED < '$dateTo' AND tblcompany.companyid = tblemployee.companyid AND tblcompany.companyid = '$companyid'");
                            }
                        } else {
                            $fetch_employee = mysqli_query($conn, "SELECT tblemployee.*, tblemployee.EMAIL as emp_email, tblcompany.*,  CONCAT(LNAME, ', ', FNAME, ' ', MNAME, '.') AS fullname, DATE_FORMAT(DATEHIRED, '%M %e, %Y') AS date FROM tblemployee, tblcompany WHERE tblcompany.companyid = tblemployee.companyid AND tblcompany.companyid = '$companyid'");
                        }
                        while ($row = mysqli_fetch_array($fetch_employee)) {
                        ?>
                            <tr>
                                <td><?php echo $row['fullname']; ?></td>
                                <td><?php echo $row['CONTACTNO']; ?></td>
                                <td><?php echo $row['emp_email']; ?></td>
                                <td><?php echo $row['POSITION']; ?></td>
                                <td><?php echo $row['EMPLOYMENT']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><a href="employee_profile.php?profileId=<?php echo $row['EMPLOYEEID']; ?>" class="btn btn-sm btn-outline-success">
                                        <span class="ti-eye"></span>
                                    </a>
                                    <a href="employee_delete.php?deleteId=<?php echo $row['EMPLOYEEID']; ?>&applicantid=<?php echo $row['APPLICANTID']; ?>" class="btn btn-sm btn-outline-danger">
                                        <span class="ti-trash"></span>
                                    </a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>

        </div>
        <a type="submit" name="print_emp" class="btn btn-primary mt-4 float-right" href="print_pdf.php?jobname=<?php echo $jobtitle ?>&start=<?php echo $dateFrom ?>&end=<?php echo $dateTo?>" target="_blank"><span class="ti-printer"> Generate Exportable Report</a>

    </section>
</main>
</div>
<script>
    $(document).ready(function() {
        $('#examplee').DataTable({
            searching: true,
            bFilter: false,
            bJQueryUI: true,
            "bLengthChange": false,
            "aLengthMenu": [
                [5, 20, 50, -1],
                [5, 20, 50, "All"]
            ],
            "iDisplayLength": 10
        });
    });
</script>
</body>

</html>