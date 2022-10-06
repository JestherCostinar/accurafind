<?php
require_once "../../../connection/config.php";

session_start();

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

$id = $_GET['edit'];

$getUser = mysqli_query($conn, "SELECT * FROM tblusers WHERE USERID = '$id'");
while ($getUserRow = mysqli_fetch_array($getUser)) {
    $name = $getUserRow['NAME'];
    $username = $getUserRow['USERNAME'];
    $email = $getUserRow['EMAIL'];
    $password = $getUserRow['PASSWORD'];
    $role = $getUserRow['ROLE'];
}

if (isset($_POST['submit'])) { // if save button on the form is clicked
    $name = $_POST['name'];
    $username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_role = $_POST['role'];

    $updateUserInfo = mysqli_query($conn, "UPDATE tblusers SET name = '$name', username = '$username', email = '$user_email', role = '$user_role' WHERE userid='$id'");
    if ($updateUserInfo) {
        header("Location: user.php?msg=User record has been update");
        exit();
    } else {
        echo "<script>alert('some error. please try again later')</script>";
        echo ("<script>window.location = 'user.php';</script>");
    }
}

if (isset($_POST['updatePassword'])) { // if save button on the form is clicked
    $oldpassword = $_POST['oldpassword'];
    $hasholdpassword = sha1($oldpassword);
    $newpassword = $_POST['newpassword'];
    $renewpassword = $_POST['renewpassword'];

    if ($hasholdpassword != $password) {
        header("Location: user.php?msg=Old password does not match. Please try again");
        exit;
    }
    if ($newpassword != $renewpassword) {
        header("Location: user.php?msg=New Password does not match. Please try again");
        exit;
    }

    $updateUserInfo = mysqli_query($conn, "UPDATE tblusers SET password = sha1('$renewpassword') WHERE userid='$id'");
    if ($updateUserInfo) {
        header("Location: user.php?msg=User record has been update");
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
            <li class="breadcrumb-item"><a href="user.php">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Users</li>
        </ol>
    </nav>

    <h2 class="dash-title">Edit Users</h2>

    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <form action="" method="POST" style="margin: 1%; padding: 1%;">
                        <div class="form-group">
                            <label>Enter Name: </label>
                            <input type="text" name="name" value="<?php echo $name; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Enter Username: </label>
                            <input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Enter Email: </label>
                            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Select Category: </label>
                            <select class="form-control input-sm" name="role">
                                <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                                <option value="Company Admin">Company Admin</option>
                                <option value="Super Admin">Super Admin</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['edit']; ?>">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="submit">
                        </div>
                    </form>
                </div>
            </div>

            <div class="activity-card mt-4" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <form action="" method="POST" style="margin: 1%; padding: 1%;">
                        <div class="form-group">
                            <label>Enter old password: </label>
                            <input type="password" name="oldpassword" class="form-control" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label>Enter new password: </label>
                            <input type="password" name="newpassword" class="form-control" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label>Re enter new password: </label>
                            <input type="password" name="renewpassword" class="form-control" minlength="8" required>
                        </div>

                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['edit']; ?>">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success " name="updatePassword">
                        </div>
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