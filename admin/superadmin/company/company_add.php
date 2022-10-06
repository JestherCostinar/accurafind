<?php
require_once "../../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');


if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

if (isset($_POST['submit'])) { // if save button on the form is clicked
    $category = $_POST['category'];
    $companyName = $_POST['companyName'];
    $companyEmail = $_POST['companyEmail'];
    $display_name = $_POST['display_name'];
    $link_name = $_POST['link_name'];
    $filename = $_FILES['myfile']['name'];

    // Select file type
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png");
    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], 'company_image/' . $filename)) {
            $insertCompany = mysqli_query($conn, "INSERT INTO tblcompany(COMPANY_NAME, EMAIL, LINK_NAME, LINK, COMPANY_IMAGE, CATEGORYID) VALUES ('$companyName', '$companyEmail', '$display_name', '$link_name', '$filename', '$category')");
            if ($insertCompany) {
                header("Location: company.php?companyMsg=Company has been recorded");
                exit();
            } else {
                echo "<script>alert('some error. please try again later')</script>";
                echo ("<script>window.location = 'company.php';</script>");
            }
        } else {
            echo "<script>alert('Failed to upload file.')</script>";
        }
    } else {
        echo "<script>alert('You file extension must be .jpg, .jpeg or .png')</script>";
    }
}
include_once "partial/company_header.php";

?>

<main>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="company.php">Company</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>

    <h2 class="dash-title">Add Company</h2>

    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <form action="" style="margin: 1%; padding: 1%;" method="post" enctype='multipart/form-data'>
                        <h5>Company information</h5>
                        <div class="form-group">
                            <label class="control-label" for="category">Select Category: </label>
                            <select class="form-control input-sm" name="category" required>
                                <option value="None">Select</option>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM tblcategory");
                                while ($row = mysqli_fetch_array($query)) {
                                    echo "<option value='" . $row['CATEGORYID'] . "'>" . $row['CATEGORY'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Enter Company Name: </label>
                            <input type="text" name="companyName" class="form-control" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group">
                            <label>Enter Email: </label>
                            <input type="email" name="companyEmail" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Useful link: </label>
                                <input type="text" name="display_name" class="form-control" placeholder="Link name display" required>
                            </div>
                            <div class="form-group col-md-9 mt-2">
                                <label></label>
                                <input type="text" name="link_name" class="form-control" placeholder="Link" required>
                            </div>
                        </div>
                        <div class="form-group">
                            Attach your company picture here:
                            <br>
                            <input id="myfile" name="myfile" type="file" style="margin-top: 10px;" required>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" placeholder="Save" name="submit" id="submit">
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