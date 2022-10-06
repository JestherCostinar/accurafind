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

if (isset($_POST['submitEduc'])) {
    foreach ($_POST['educ_year'] as $key => $value) {
        $e_year = $value;
        $e_year_end = $_POST['educ_year_end'][$key];
        $e_degree = $_POST['educ_degree'][$key];
        $e_desciption = $_POST['educ_description'][$key];
        $e_year_range = $e_year . ' - ' . $e_year_end;
        $e_school_name = $_POST['school_name'][$key];
        $e_desciption = remove_sp_chr($e_desciption);
        $insert_education = mysqli_query($conn, "INSERT INTO tblapplicant_education(EDUC_YEAR, SCHOOL_NAME, EDUCATIONAL_DEGREE, EDUC_DESCRIPTION, APPLICANTID) VALUES ('$e_year_range', '$e_school_name', '$e_degree','$e_desciption', '$applicantid')");
        $today = date("Y-m-d H:i:s");
        $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['fullname']}', '$today', 'Applicant', 'Inserting Education')");
    }
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
                                                    <div class="small-section-tittle">
                                                        <h4>Add education</h4>
                                                    </div>
                                                    <hr>
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4>
                                                                        Education
                                                                        <a href="javascript:void(0)" class="add-more-educ float-right btn-pri btn-primary">Add more</a>
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="educ-main-form">
                                                                        <div class="form-row">
                                                                            <div class="col-md-4 mb-3">
                                                                                <label for="EducYear">Year Start</label>
                                                                                <input type="number" min="1900" max="2099" step="1" class="form-control" id="EducYear" name="educ_year[]" placeholder="2021" required />
                                                                            </div>
                                                                            <div class="col-md-4 mb-3">
                                                                                <label for="EducYearEnd">Year End</label>
                                                                                <input type="number" min="1900" max="2099" step="1" class="form-control" id="EducYearEnd" name="educ_year_end[]" placeholder="2021" required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="schoolName">University/School name</label>
                                                                            <input type="text" class="form-control" id="schoolName" name="school_name[]" placeholder="School name" required />
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="job_skill">Degree <h6 style="color: #676868; display: inline;"> (Senior High, College, Masteral Degree)</h6></label>
                                                                                <input list="job_skills" name="educ_degree[]" id="educ_degree[]" class="form-control block" placeholder="--Degree--" />
                                                                                <datalist id="job_skills">
                                                                                </datalist>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="educDescription">Other</label>
                                                                            <textarea class="form-control" id="educDescription" name="educ_description[]" rows="3" placeholder=""></textarea>
                                                                        </div>

                                                                        <hr />
                                                                        <div class="paste-new-form-educ"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button name="submitEduc" id="submit" type="submit" class="btn btn-primary">Submit</button>

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
                                                    <div class="form-row">\
                                                        <div class="col-md-4 mb-3">\
                                                            <label for="validationDefault04">Year Start</label>\
                                                            <input type="number" min="1900" max="2099" step="1" class="form-control" id="validationDefault04" name="educ_year[]" placeholder="2021" required>\
                                                        </div>\
                                                        <div class="col-md-4 mb-3">\
                                                            <label for="validationDefault03">Year End</label>\
                                                            <input type="number" min="1900" max="2099" step="1" class="form-control" id="validationDefault03" name="educ_year_end[]" placeholder="2021" required>\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <label for="validationDefault04">University/School name</label>\
                                                        <input type="text" class="form-control" id="validationDefault04" name="school_name[]" placeholder="School name" required>\
                                                    </div>\
                                                    <div class="form-row">\
                                                    <div class="col-md-12 mb-3">\
                                                        <label for="job_skill">Degree <h6 style="color: #676868; display: inline;"> (Senior High, College, Masteral Degree)</h6></label>\
                                                        <input list="job_skills" name="educ_degree[]" id="educ_degree[]" class="form-control block" placeholder="--Degree--" />\
                                                        <datalist id="job_skills">\
                                                        </datalist>\
                                                    </div>\
                                                </div>\
                                                <div class="form-group">\
                                                    <label for="educDescription">Other</label>\
                                                    <textarea class="form-control" id="educDescription" name="educ_description[]" rows="3" placeholder=""></textarea>\
                                                </div>\
                                                    <div class="form-group">\
                                                        <button class="remove-educ-btn btn-dan btn-danger">remove</button>\
                                                    </div>\
                                                    <hr>\
                                                </div>\
                                                </div>');
        });
    });
</script>
</body>

</html>