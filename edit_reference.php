<?php
include('connection/config.php');
session_start();

if (isset($_SESSION['applicantid'])) {
    $applicantid = $_SESSION['applicantid'];
} else {
    header('location: login.php');
}

function remove_sp_chr($str)
{
    $result = str_replace(array("#", "'", ";"), '', $str);
    return $result;
}

$refId = $_GET['editRef'];

$getRef = mysqli_query($conn, "SELECT * FROM tblcharacter_reference WHERE REFERENCE_ID = '$refId'");
while ($refRow = mysqli_fetch_array($getRef)) {
    $ref_name = $refRow['NAME'];
    $ref_relation = $refRow['RELATIONSHIP'];
    $ref_contact = $refRow['CONTACT'];
}

?>

<?php include_once "partial/applicant_header.php"; ?>

<main style="background: #e2e8f0;">
    <!-- slider Area Start-->

    <section class="featured-job-area feature-padding">
        <div class="container">
            <div class="row gutters">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">

                            <div class="row gutters" style="color: #1a202c; text-align: left; ">

                                <div class="container">
                                    <div class="">
                                        <a href="applicant_profile.php" class="btn btn-secondary rounded ml-3 mb-3" style="background: #6c757d;">Go back to Profile</a>
                                        <div class="col-xl-12 col-lg12">
                                            <!-- job single -->
                                            <!-- job single End -->

                                            <div class="job-post-details p-4" style="background: #fff; border: 1px solid #ededed;">
                                                <div class="post-details1 mb-50">
                                                    <!-- Small Section Tittle -->

                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4>
                                                                        Character Reference/s
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="main-form">
                                                                        <div class="form-row">
                                                                            <div class="col-md-8 mb-3">
                                                                                <label for="workTitle">Name</label>
                                                                                <input type="text" class="form-control" id="workTitle" name="name" value="<?php echo $ref_name ?>" placeholder="Enter name.." required />
                                                                            </div>

                                                                            <div class="col-md-4 mb-3">
                                                                                <label for="contact">Contact Number <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="inputGroupPrepend2">+</span>
                                                                                    </div>
                                                                                    <input type="tel" class="form-control" id="contact" value="<?php echo $ref_contact ?>" name="contactno" placeholder="9-xxx-xxxx" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="companyDescription">Relationship</label>
                                                                            <input type="text" class="form-control" id="workTitle" value="<?php echo $ref_relation ?>" name="relationship" placeholder="Enter relationship.." required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="referenceID" value="<?php echo $_GET['editRef']; ?>">
                                                        <button name="submitReference" type="submit" class="btn btn-primary">Submit</button>

                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

    </section>
</main>
<?php include_once "partial/footer.php";


if (isset($_POST['submitReference'])) {
    $r_id = $_POST['referenceID'];
    $r_name = $_POST['name'];
    $r_contact = '0' . $_POST['contactno'];
    $r_relation = $_POST['relationship'];
    $query1 = mysqli_query($conn, "UPDATE tblcharacter_reference SET relationship = '$r_relation', name = '$r_name', contact = '$r_contact' WHERE REFERENCE_ID  = '$r_id'");
    if ($query1) {
        echo ("<script>alert('Record has been successfully update')</script>");
        echo ("<script>window.location = 'applicant_profile.php';</script>");
    }
    echo ("<script>alert('NO')</script>");
}
?>