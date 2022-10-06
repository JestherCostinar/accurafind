<?php
require_once "../../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

$id = $_GET['edit'];

$query = mysqli_query($conn, "SELECT tblcompany.*, tblcategory.CATEGORY as categ FROM tblcompany INNER JOIN tblcategory on tblcompany.CATEGORYID = tblcategory.CATEGORYID WHERE companyid = '$id' ");
while ($row = mysqli_fetch_array($query)) {
    $user_name = $row['COMPANY_NAME'];
    $email = $row['EMAIL'];
    $category = $row['categ'];
    $categoryid = $row['CATEGORYID'];
    $link_name = $row['LINK_NAME'];
    $link = $row['LINK'];
    $company_image = $row['COMPANY_IMAGE'];
}
include_once "partial/company_header.php";

?>

<main>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="company.php">Company</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Company</li>
        </ol>
    </nav>

    <h2 class="dash-title">Edit Company</h2>

    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <div id="msg"></div>
                    <form action="" method="POST" style="margin: 1%; padding: 1%;" name="company_form" id="company_form" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label class="control-label" for="category">Select Category: </label>
                            <select class="form-control input-sm" id="category" name="category">
                                <option value="<?php echo $categoryid; ?>"><?php echo $category; ?></option>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM tblcategory");
                                while ($row = mysqli_fetch_array($query)) {
                                    echo "<option value='" . $row['CATEGORYID'] . "'>" . $row['CATEGORY'] . "</option>";  // displaying data in option menu
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">Enter Company Name: </label>
                            <input type="text" name="username" id="username" value="<?php echo $user_name; ?>" class="form-control" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Enter Email: </label>
                            <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Useful link: </label>
                                <input type="text" name="display_name" class="form-control" placeholder="Link name display" value="<?php echo $link_name; ?>" required>
                            </div>
                            <div class="form-group col-md-9 mt-2">
                                <label></label>
                                <input type="text" name="link_name" class="form-control" placeholder="Link" value="<?php echo $link; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            Attach your company picture here:
                            <br>
                            <input id="myfile" name="myfile" type="file" style="margin-top: 10px;" required>
                        </div>
                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['edit']; ?>">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" placeholder="Update" name="submit" id="submit">
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

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $display_name = $_POST['display_name'];
    $link_name = $_POST['link_name'];
    $filename = $_FILES['myfile']['name'];

    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $extensions_arr = array("jpg", "jpeg", "png");

    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], 'company_image/' . $filename)) {
            $query1 = mysqli_query($conn, "UPDATE tblcompany SET company_name='$username', email = '$email', categoryid = '$category', link_name = '$display_name', link = '$link_name', company_image = '$filename' WHERE companyid = '$id'");
            if ($query1) {
                echo ("<script>alert('Record has been successfully update')</script>");
                echo ("<script>window.location = 'company.php';</script>");
            } else {
                echo "<script>alert('Try again')</script>";
            }
        } else {
            echo "<script>alert('Failed to upload file.')</script>";
        }
    } else {
        echo "<script>alert('You file extension must be .jpg, .jpeg or .png')</script>";
    }

// $query1 = mysqli_query($conn, "UPDATE tblcompany SET company_name='$username', email = '$email', categoryid = '$category', link_name = '$display_name', link = '$link', company_image = '$company_image' WHERE companyid = '$id'");

    
}
?>