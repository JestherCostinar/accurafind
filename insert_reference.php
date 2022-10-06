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

if (isset($_POST['submitReference'])) {
    foreach ($_POST['name'] as $key => $value) {
        $r_name = $value;
        $r_contact = $_POST['contactno'][$key];
        $r_contact = '0' . $r_contact;
        $r_relationship = $_POST['relationship'][$key];
        $r_relationship = remove_sp_chr($r_relationship);
        $insert_work_certification = mysqli_query($conn, "INSERT INTO tblcharacter_reference(NAME, RELATIONSHIP, CONTACT, APPLICANTID) VALUES ('$r_name', '$r_relationship', '$r_contact', '$applicantid')");
    }

    $today = date("Y-m-d H:i:s");
    $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['fullname']}', '$today', 'Applicant', 'Adding Character Reference/s')");
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
                                                        <h4>Add Character Reference/s</h4>
                                                    </div>
                                                    <hr>
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4>
                                                                        Character Reference
                                                                        <a href="javascript:void(0)" class="add-more-form float-right btn-pri btn-primary">Add more</a>
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="main-form">
                                                                        <div class="form-row">
                                                                            <div class="col-md-8 mb-3">
                                                                                <label for="workTitle">Name</label>
                                                                                <input type="text" class="form-control" id="workTitle" name="name[]" placeholder="Enter name.." required />
                                                                            </div>

                                                                            <div class="col-md-4 mb-3">
                                                                                <label for="contact">Contact Number <h6 style="color: #ff3939; display: inline;">*</h6></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="inputGroupPrepend2">+63</span>
                                                                                    </div>
                                                                                    <input type="tel" class="form-control" id="contact" name="contactno[]" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="9-xxx-xxxx" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="companyDescription">Relationship</label>
                                                                            <input type="text" class="form-control" id="workTitle" name="relationship[]" placeholder="Enter relationship.." required />
                                                                        </div>
                                                                        <hr />
                                                                        <div class="paste-new-form"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button name="submitReference" id="submit" type="submit" class="btn btn-primary">Submit</button>

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
                                                <div class="col-md-8 mb-3">\
                                                    <label for="workTitle">Name</label>\
                                                        <input type="text" class="form-control" id="workTitle" name="name[]" placeholder="Enter name.." required />\
                                                            </div>\
                                                        <div class="col-md-4 mb-3">\
                                                        <label for="contact">Contact Number <h6 style="color: #ff3939; display: inline;">*</h6></label>\
                                            <div class="input-group">\
                                                                <div class="input-group-prepend">\
                                                                <span class="input-group-text" id="inputGroupPrepend2">+63</span>\
                                                                    </div>\
                                                                    <input type="tel" class="form-control" id="contact" name="contactno[]" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="9-xxx-xxxx" required>\
                                                            </div>\
                                                    </div>\
                                                </div>\
                                                        <div class="form-group">\
                                                            <label for="companyDescription">Relationship</label>\
                                                            <input type="text" class="form-control" id="workTitle" name="relationship[]" placeholder="Enter relationship.." required />\
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