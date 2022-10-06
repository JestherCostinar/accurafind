<?php
include('connection/config.php');
date_default_timezone_set('Asia/Manila');
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

if (isset($_POST['submitValidation'])) {
    foreach ($_POST['file_desc'] as $key => $value) {
        $date_today = date('Y-m-d');
        $fileDesc = $_POST['file_desc'][$key];
        $attachFile = $_FILES['myfile']['name'][$key];

        $imageFileType = strtolower(pathinfo($attachFile, PATHINFO_EXTENSION));

        $extensions_arr = array("jpg", "jpeg", "png");
        // Check extension
        if (in_array($imageFileType, $extensions_arr)) {
            if (move_uploaded_file($_FILES["myfile"]["tmp_name"][$key], 'verification-image/' . $attachFile)) {
                $insertVerification = mysqli_query($conn, "INSERT INTO tblverification(FILE_DESCRIPTION , FILE_NAME, DATE_SUBMIT, STATUS, APPLICANTID) VALUES ('$fileDesc', '$attachFile', '$date_today', 'Processing', '$applicantid')");
            } else {
                echo "<script>alert('Failed to upload file.')</script>";
            }
        } else {
            echo "<script>alert('You file extension must be .jpg, .jpeg or .png')</script>";
        }
    }
    if ($insertVerification) {
        header("Location: applicant_profile.php?validateMsg=Attachment has been recorded, and ready to review. Initial feedback will take within 24 hours.");
        exit();
    } else {
        echo "<script>alert('some error. please try again later')</script>";
        echo ("<script>window.location = 'company.php';</script>");
    }
    $today = date("Y-m-d H:i:s");
    $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['fullname']}', '$today', 'Applicant', 'Attached Verification file')");
    echo ("<script>window.location = 'applicant_profile.php';</script>");
}
?>

<?php include_once "partial/applicant_header.php"; ?>
<style>
    .a-side-nav:hover {
        color: #007bff;
    }
</style>
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
                                                    <form action="" method="POST" enctype='multipart/form-data'>
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4>
                                                                        Verification
                                                                        <a href="javascript:void(0)" class="add-more-educ float-right btn-pri btn-primary">Add more</a>
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="educ-main-form">
                                                                        <div class="form-group">
                                                                            <label for="schoolName">Description of the file <h6 style="color: #6c757d; display: inline;">(PRC ID, Valid ID, etc..)</h6></label>
                                                                            <input type="text" class="form-control" id="schoolName" name="file_desc[]" placeholder="Description of the file" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            Attach the information to validate here <h6 style="color: #6c757d; display: inline;">(diploma, work experience, certificate)</h6>
                                                                            <br>
                                                                            <input id="myfile" name="myfile[]" type="file" style="margin-top: 10px;" required>
                                                                        </div>
                                                                        <hr />
                                                                        <div class="paste-new-form-educ"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button name="submitValidation" id="submit" type="submit" class="btn btn-primary">Submit</button>

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
<footer class="text-muted text-center">
    <div class="footer-area footer-bg footer-padding" style="padding: 90px 0;">

        <div class="container ">
            <img src="assets/img/logo/accurafind-logo.png" width="80" height="80px" alt="" />
            <p> Accurafind choose the right path with accurafind</p>
            <p class="mb-0">Connect with accurafind:</p>
            <p style="color: #fff;">jobportal.accurafind@accura-find.com</p>
            <a href="partial/terms.php" target="_blank" style="color: #ababab;">Terms and Condition | </a>
            <a href="partial/privacy.php" target="_blank" style="color: #ababab;">Privacy Policy</a>
        </div>
    </div>
</footer>

<!-- JS here -->

<!-- All JS Custom Plugins Link Here here -->
<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<script src="./assets/js/price_rangs.js"></script>

<!-- One Page, Animated-HeadLin -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="./assets/js/jquery.scrollUp.min.js"></script>
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>

<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.remove-educ-btn', function() {
            $(this).closest('.educ-main-form').remove();
        });


        $(document).on('click', '.add-more-educ', function() {
            $('.paste-new-form-educ').append('<div class="educ-main-form">\
                                                <div class="form-group">\
                                                <label for="schoolName">Description of the file <h6 style="color: #6c757d; display: inline;">(PRC ID, Valid ID, etc..)</h6></label>\
                                                    <input type="text" class="form-control" id="schoolName" name="file_desc[]" placeholder="Description of the file" required />\
                                                </div>\
                                                <div class="form-group">\
                                                    Attach the information to validate here <h6 style="color: #6c757d; display: inline;">(diploma, work experience, certificate)</h6>\
                                                    <br>\
                                                    <input id="myfile" name="myfile[]" type="file" style="margin-top: 10px;" required>\
                                                </div>\
                                                <div class="form-group">\
                                                        <button class="remove-educ-btn btn-dan btn-danger">remove</button>\
                                                    </div>\
                                                <hr />\
                                            </div>');
        });
    });
</script>
</body>

</html>