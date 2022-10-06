<?php
require_once "../../../connection/config.php";

session_start();

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}


if (isset($_POST['add_user'])) { // if save button on the form is clicked
    $name = $_POST['name'];
    $username = $_POST['username'];
    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];
    $user_role = $_POST['role'];
    $company_id = $_POST['company'];

    $insertUser = mysqli_query($conn, "INSERT INTO tblusers(NAME, USERNAME, EMAIL, PASSWORD, ROLE, COMPANYID) VALUES ('$name', '$username', '$user_email', sha1('$user_password'), '$user_role', '$company_id')");
    $userRow = mysqli_fetch_assoc($insertUser);
    if ($insertUser) {
        header("Location: user.php?msg=User has been recorded");
        exit();
    } else {
        echo "<script>alert('some error. please try again later')</script>";
        echo ("<script>window.location = 'user.php';</script>");
    }
}
include_once "partial/user_header.php";

?>


<main>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="user.php">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>

    <h2 class="dash-title">Add User</h2>

    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <form action="" style="margin: 1%; padding: 1%;" method="post">
                        <div class="form-group">
                            <label class="control-label">Select Company: </label>
                            <select class="form-control input-sm" name="company">
                                <option value="None">--Select--</option>
                                <?php
                                include('../../../connection/config.php');
                                $query = mysqli_query($conn, "SELECT * FROM tblcompany");
                                while ($row = mysqli_fetch_array($query)) {
                                    echo "<option value='" . $row['COMPANYID'] . "'>" . $row['COMPANY_NAME'] . "</option>";  // displaying data in option menu
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Enter Name: </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label>Enter Username: </label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Enter Email: </label>
                            <input type="email" name="userEmail" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Enter Password: </label>
                            <input type="password" name="userPassword" class="form-control" minlength="8" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="category">Select Category: </label>
                            <select class="form-control input-sm" name="role">
                                <option value="Company Admin">Company Admin</option>
                                <option value="Super Admin">Super Admin</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" placeholder="Save" name="add_user">
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</body>

</html>