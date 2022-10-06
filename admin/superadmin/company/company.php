<?php
require_once "../../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

include_once "partial/company_header.php";

?>


<main>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Company</li>
        </ol>
    </nav>
    <?php if (isset($_GET['companyMsg'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET['companyMsg']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pr-3">
                    <h3 class="mb-0">List of Company</h3>
                    <a class="btn btn-primary" href="company_add.php">Add Company</a>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>COMPANY NAME</th>
                                <th>EMAIL</th>
                                <th>CATEGORY</th>
                                <th width="10%" align="center">ACTION</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT tblcompany.*, tblcategory.CATEGORY as bb FROM tblcompany INNER JOIN tblcategory on tblcompany.CATEGORYID = tblcategory.CATEGORYID WHERE company_name != 'The Codies'");
                            $c = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $c++; ?></td>
                                    <td><?php echo $row['COMPANY_NAME']; ?></td>
                                    <td><?php echo $row['EMAIL']; ?></td>
                                    <td><?php echo $row['bb']; ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="btn-group">
                                                <a href="company_edit.php?edit=<?php echo $row['COMPANYID']; ?>" class="btn btn-success">
                                                    <span class="ti-pencil"></span>
                                                </a>
                                                <a href="company_delete.php?del=<?php echo $row['COMPANYID']; ?>" class="btn btn-danger">
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
</body>

</html>