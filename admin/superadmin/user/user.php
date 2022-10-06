<?php
require_once "../../../connection/config.php";

session_start();

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

include_once "partial/user_header.php";

?>



<main>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
        </ol>
    </nav>
    <?php if (isset($_GET['msg'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET['msg']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pr-3">
                    <h3 class="mb-0">List of Users</h3>
                    <a class="btn btn-primary" href="add_user.php">Add User</a>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th width="10%" align="center">ACTION</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM tblusers ");
                            $c = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $c++; ?></td>
                                    <td><?php echo $row['NAME']; ?></td>
                                    <td><?php echo $row['USERNAME']; ?></td>
                                    <td><?php echo $row['EMAIL']; ?></td>
                                    <td><?php echo $row['ROLE']; ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="btn-group">
                                                <a href="edit_user.php?edit=<?php echo $row['USERID']; ?>" class="btn btn-success">
                                                    <span class="ti-pencil"></span>
                                                </a>
                                                <a href="delete_user.php?del=<?php echo $row['USERID']; ?>" class="btn btn-danger">
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