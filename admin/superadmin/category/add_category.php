<?php
require_once "../../../connection/config.php";
date_default_timezone_set('Asia/Manila');

session_start();

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../login.php');
}

if (isset($_POST['add_category'])) { // if save button on the form is clicked
    $category = $_POST['category'];

    $query = mysqli_query($conn, "INSERT INTO tblcategory(CATEGORY) VALUES ('$category')");
    if ($query) {
        header("Location: category.php?categoryMsg=Category has been recorded");
        exit();
    } else {
        echo "<script>alert('some error. please try again later')</script>";
    }
}
include_once "partial/category_header.php";

?>

<main>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="category.php">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
        </ol>
    </nav>

    <h2 class="dash-title">Add Category</h2>

    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <form action="" style="margin: 1%; padding: 1%;" method="post">
                        <div class="form-group">
                            <label for="category">Enter Category</label>
                            <input type="text" name="category" id="category" class="form-control" placeholder="Enter Category">
                        </div>
                        <input type="submit" class="btn btn-success btn-block" placeholder="Save" name="add_category">
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