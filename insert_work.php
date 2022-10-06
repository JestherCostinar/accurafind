<?php
include('connection/config.php');
session_start();

if (isset($_SESSION['applicantid'])) {
    $applicantid = $_SESSION['applicantid'];
} else {
    header('location: login.php');
}
$fieldOfExperience = array(
    'Architecture and engineering',
    'Arts, culture and entertainment',
    'Business, management and administration',
    'Communications',
    'Community and social services',
    'Education',
    'Science and technology',
    'Installation, repair and maintenance',
    'Farming, fishing and forestry',
    'Government',
    'Health and medicine',
    'Law and public policy',
    'Sales'
);


function remove_sp_chr($str)
{
    $result = str_replace(array("#", "'", ";"), '', $str);
    return $result;
}

if (isset($_POST['submitWork'])) {
    foreach ($_POST['work_title'] as $key => $value) {
        $w_work_title = $value;
        $w_year = $_POST['work_year'][$key];
        $w_field = $_POST['work_field'][$key];
        $w_year_end = $_POST['work_year_end'][$key];
        $work_year_range = $w_year . ' - ' . $w_year_end;
        $total_year = $w_year_end - $w_year;
        $w_company_name = $_POST['company_name'][$key];
        $w_description = $_POST['work_description'][$key];
        $w_description = remove_sp_chr($w_description);
        $insert_work_experience = mysqli_query($conn, "INSERT INTO tblapplicant_workexperience(WORK_TITLE, FIELD, WORK_YEAR, YEAR_COUNT, COMPANY_NAME, WORK_DESCRIPTION, APPLICANTID) VALUES ('$w_work_title', '$w_field', '$work_year_range', '$total_year', '$w_company_name', '$w_description', '$applicantid')");
    }
    // $work_update = mysqli_query($conn, "SELECT SUM(YEAR_COUNT) as year_count FROM tblapplicant_workexperience WHERE tblapplicant_workexperience.APPLICANTID = $applicantid");
    // $work_row = mysqli_fetch_assoc($work_update);
    // $total_workexp = $work_row['year_count'];
    // if ($total_workexp > 13) {
    //     $updated_work_exp = "Expert Level";
    // } elseif ($total_workexp > 10) {
    //     $updated_work_exp = "Senior Level";
    // } elseif ($total_workexp > 2) {
    //     $updated_work_exp = "Mid Level";
    // } elseif ($total_workexp >= 0) {
    //     $updated_work_exp = "Entry Level";
    // }
    $update_profile_exp = mysqli_query($conn, "UPDATE tblapplicant SET WORK_EXP = '$updated_work_exp' WHERE applicantid = '$applicantid'");
    $today = date("Y-m-d H:i:s");
    $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['fullname']}', '$today', 'Applicant', 'Adding Work Experience')");
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
                                                        <h4>Add Work Experience</h4>
                                                    </div>
                                                    <hr>
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4>
                                                                        Work Experience
                                                                        <a href="javascript:void(0)" class="add-more-form float-right btn-pri btn-primary">Add more</a>
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="main-form">
                                                                        <div class="form-row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="workTitle">Work title</label>
                                                                                <input type="text" class="form-control" id="workTitle" name="work_title[]" placeholder="Work title" required />
                                                                            </div>
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="workYear">Year Start</label>
                                                                                <input type="number" min="1900" max="2099" step="1" class="form-control" id="workYear" name="work_year[]" placeholder="2021" required />
                                                                            </div>
                                                                            <div class="col-md-3 mb-3">
                                                                                <label for="workYearEnd">Year End</label>
                                                                                <input type="number" min="1900" max="2099" step="1" class="form-control" id="workYearEnd" name="work_year_end[]" placeholder="2021" required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="job_skill">Field of Work Experience</label>
                                                                                <input list="work_fields" name="work_field[]" id="work_field[]" class="form-control block" placeholder="--Degree--" />
                                                                                <datalist id="work_fields">
                                                                                    <!-- Technical Skills -->
                                                                                    <?php
                                                                                    foreach ($fieldOfExperience as $key => $value) :
                                                                                        echo '<option value="' . $value . '"> </option>';
                                                                                    endforeach;
                                                                                    ?>

                                                                                </datalist>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="companyName">Company name</label>
                                                                            <input type="text" class="form-control" id="companyName" name="company_name[]" placeholder="Company name" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="companyDescription">Description</label>
                                                                            <textarea class="form-control" id="companyDescription" name="work_description[]" rows="3"></textarea>
                                                                        </div>

                                                                        <hr />
                                                                        <div class="paste-new-form"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button name="submitWork" id="submit" type="submit" class="btn btn-primary">Submit</button>

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
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.main-form').remove();
        });

        $(document).on('click', '.add-more-form', function() {
            $('.paste-new-form').append('<div class="main-form">\
                                                    <div class="form-row">\
                                                        <div class="col-md-6 mb-3">\
                                                            <label for="validationDefault03">Work title</label>\
                                                            <input type="text" class="form-control" id="validationDefault03" name="work_title[]" placeholder="Work title" required>\
                                                        </div>\
                                                        <div class="col-md-3 mb-3">\
                                                            <label for="validationDefault03">Year Start</label>\
                                                            <input type="number" min="1900" max="2099" step="1" class="form-control" id="validationDefault03" name="work_year[]" placeholder="2021" required>\
                                                        </div>\
                                                        <div class="col-md-3 mb-3">\
                                                            <label for="validationDefault03">Year End</label>\
                                                            <input type="number" min="1900" max="2099" step="1" class="form-control" id="validationDefault03" name="work_year_end[]" placeholder="2021" required>\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-row">\
                                                    <div class="col-md-12 mb-3">\
                                                        <label for="job_skill">Field of Work Experience</label>\
                                                        <input list="work_fields" name="work_field[]" id="work_field[]" class="form-control block" placeholder="--Degree--" />\
                                                        <datalist id="work_fields">\
                                                        </datalist>\
                                                    </div>\
                                                </div>\
                                                    <div class="form-group">\
                                                        <label for="validationDefault04">Company namespace</label>\
                                                        <input type="text" class="form-control" id="validationDefault04" name="company_name[]" placeholder="Company name" required>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <label for="validationDefault03">Description</label>\
                                                        <textarea class="form-control" id="validationDefault03" name="work_description[]" rows="3"></textarea>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <button class="remove-btn btn-dan btn-danger">remove</button>\
                                                    </div>\
                                                    <hr>\
                                                </div>');
        });
    });
</script>
</body>

</html>