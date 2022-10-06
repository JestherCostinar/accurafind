<?php
include('connection/config.php');
session_start();

if (isset($_SESSION['applicantid'])) {
    $applicantid = $_SESSION['applicantid'];
} else {
    header('location: login.php');
}
?>

<?php include_once "partial/applicant_header.php"; ?>

<main>
    <!-- slider Area Start-->

    <div class="apply-process-area apply-bg pt-120 pb-150">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <h2>Company</h2>
                    </div>
                </div>
            </div>
            <!-- Apply Process Caption -->
            <div class="row">
                <?php
                include('connection/config.php');

                $query = mysqli_query($conn, "SELECT * FROM tblcompany WHERE company_name != 'The Codies'");
                while ($row = mysqli_fetch_array($query)) {
                ?>


                    <div class="col-lg-4 col-md-6" data-aos="flip-left">
                        <div class="card mb-4" style="width: 21rem; ">
                            <div class="card-header" style="background: #2b929d">
                                <img class="card-img-top my-2" src="admin/superadmin/company/company_image/<?php echo $row['COMPANY_IMAGE']; ?>" height="100px" alt="Card image cap" style="padding: 0 1rem; border-radius: 30px;">
                            </div>
                            <div class="card-body text-center my-4">
                                <h5 class="card-title"><?php echo $row['COMPANY_NAME']; ?></h5>
                                <a href="<?php echo $row['LINK']; ?>" target="_blank" class="text-decoration-none" style="color: #007bff; text-decoration: underline"><?php echo $row['LINK_NAME']; ?></a>
                            </div>
                            <div class="card-footer text-center"></div>
                        </div>

                        <!-- <div class="single-process text-center mb-30" style="background: #115e66fd; border-radius: 30px;">
                            <div class="process-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="process-cap">
                                <h5><?php echo $row['COMPANY_NAME']; ?></h5>

                            </div>
                        </div> -->

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<?php include_once "partial/footer.php"; ?>