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

$query = mysqli_query($conn, "SELECT * FROM tblcategory WHERE categoryid = '$id'");
while ($row = mysqli_fetch_array($query)) {
    $category = $row['CATEGORY'];
}
include_once "partial/category_header.php";

?>


<main>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="category.php">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>
    </nav>

    <h2 class="dash-title">Add Category</h2>

    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <div id="msg"></div>
                    <form action="" method="POST" style="margin: 1%; padding: 1%;" name="category_form" id="category_form">
                        <div class="form-group">
                            <label for="category">Enter Category</label>
                            <input type="text" name="category" id="category" value="<?php echo $category; ?>" class="form-control" placeholder="Enter Category">
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
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];

    $query1 = mysqli_query($conn, "UPDATE tblcategory SET category='$category' WHERE categoryid = '$id'");
    if ($query1) {
        echo ("<script>alert('Record has been successfully update')</script>");
        echo ("<script>window.location = 'category.php';</script>");
    } else {
        echo "<script>alert('Try again')</script>";
    }
}
?>