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

$educId = $_GET['educEdit'];

$getEduc = mysqli_query($conn, "SELECT * FROM tblapplicant_education WHERE EDUCATION_ID = '$educId'");
while ($workRow = mysqli_fetch_array($getEduc)) {
    $school_name = $workRow['SCHOOL_NAME'];
    $school_degree = $workRow['EDUCATIONAL_DEGREE'];
    $school_desc = $workRow['EDUC_DESCRIPTION'];
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
                                                                        Education
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="main-form">
                                                                        <div class="form-row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="workTitle">University/School name</label>
                                                                                <input type="text" class="form-control" name="schoolName" placeholder="Work title" value="<?php echo $school_name ?>" required />
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="companyName">Degree (Senior High, College, Masteral Degree)</label>
                                                                            <input type="text" class="form-control" name="schoolDegree" placeholder="Company name" value="<?php echo $school_degree ?>" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="companyDescription">Activities and societies</label>
                                                                            <textarea class="form-control" name="schoolDescription" rows="3"><?php echo $school_desc ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="educationID" value="<?php echo $_GET['educEdit']; ?>">
                                                        <button name="submitEduc" type="submit" class="btn btn-primary">Submit</button>

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


if (isset($_POST['submitEduc'])) {
    $s_id = $_POST['educationID'];
    $s_name = $_POST['schoolName'];
    $s_name = remove_sp_chr($s_name);
    $s_degree = $_POST['schoolDegree'];
    $s_degree = remove_sp_chr($s_degree);
    $s_desc = $_POST['schoolDescription'];
    $s_desc = remove_sp_chr($s_desc);
    $query1 = mysqli_query($conn, "UPDATE tblapplicant_education SET school_name = '$s_name', educational_degree = '$s_degree', educ_description = '$s_desc' WHERE EDUCATION_ID = '$s_id'");
    if ($query1) {
        echo ("<script>alert('Record has been successfully update')</script>");
        echo ("<script>window.location = 'applicant_profile.php';</script>");
    }
    echo ("<script>alert('NO')</script>");
}
?>