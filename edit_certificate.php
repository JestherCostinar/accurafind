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

$certId = $_GET['editCert'];

$getCertificate = mysqli_query($conn, "SELECT * FROM tblcertificate WHERE CERTIFICATE_ID = '$certId'");
while ($certRow = mysqli_fetch_array($getCertificate)) {
    $c_name = $certRow['CERTIFICATE_NAME'];
    $c_org = $certRow['ORGANIZATION'];
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
                                                                        Licenses & certifications
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="main-form">
                                                                        <div class="form-group">
                                                                            <label for="companyName">Certification Name</label>
                                                                            <input type="text" class="form-control" name="company_name" placeholder="Company name" value="<?php echo $c_name ?>" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="companyDescription">Organization</label>
                                                                            <textarea class="form-control" name="work_description" rows="3"><?php echo $c_org ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="certificateId" value="<?php echo $_GET['editCert'];?>">
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
    $c_id = $_POST['certificateId'];
    $c_name = $_POST['company_name'];
    $c_name = remove_sp_chr($c_name);
    $c_desc = $_POST['work_description'];
    $c_desc = remove_sp_chr($c_desc);
    $query1 = mysqli_query($conn, "UPDATE tblcertificate SET CERTIFICATE_NAME = '$c_name', ORGANIZATION = '$c_desc' WHERE CERTIFICATE_ID  = '$c_id'");
    if ($query1) {
        echo ("<script>alert('Record has been successfully update')</script>");
        echo ("<script>window.location = 'applicant_profile.php';</script>");
    }
    echo ("<script>alert('NO')</script>");
}
?>