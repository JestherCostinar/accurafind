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

$getApplicant = mysqli_query($conn, "SELECT * FROM tblapplicant WHERE applicantid = '$applicantid'");
while ($applicantRow = mysqli_fetch_array($getApplicant)) {
    $applicantFname = $applicantRow['FNAME'];
    $applicantLname = $applicantRow['LNAME'];
    $applicantMname = $applicantRow['MNAME'];
    $applicantAddress = $applicantRow['ADDRESS'];
    $applicantCity = $applicantRow['CITY'];
    $applicantState = $applicantRow['STATE'];
    $applicantZip = $applicantRow['ZIP'];
    $applicantContact = $applicantRow['CONTACTNO'];
    $applicantUsername = $applicantRow['USERNAME'];
    $applicantEmail = $applicantRow['EMAIL'];
    $applicantObjective = $applicantRow['OBJECTIVES'];
    $applicantFilename = $applicantRow['FILE_NAME'];
}

if (isset($_POST['updateProfile'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $contactno = $_POST['contactno'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $objective = $_POST['objective'];
    $objective = remove_sp_chr($objective);

    $filename = $_FILES['myfile']['name'];



    // Select file type
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png");
    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], 'upload/' . $filename)) {
            $updateProfileQuery = mysqli_query($conn, "UPDATE tblapplicant SET fname = '$fname', lname = '$lname', mname = '$mname', address = '$address', city = '$city',
            state = '$state', zip = '$zip', contactno = '$contactno', username = '$username', email = '$email', password = sha1('$password'), objectives = '$objective', file_name = '$filename' WHERE applicantid = '$applicantid'");
            if ($updateProfileQuery) {
                $today = date("Y-m-d H:i:s");
                $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['fullname']}', '$today', 'Applicant', 'Update Personal Information')");
                echo ("<script>alert('Record has been successfully updated!')</script>");
                echo ("<script>window.location = 'applicant_profile.php';</script>");
            } else {
                echo "<script>alert('some error. please try again later')</script>";
            }
        } else {
            echo "<script>alert('Failed to upload file.')</script>";
        }
    } else {
        echo "<script>alert('You file extension must be .jpg, .jpeg or .png')</script>";
    }
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
                                                        <h4>Personal Information</h4>
                                                    </div>
                                                    <hr>
                                                    <form action="" enctype='multipart/form-data' method="POST">
                                                        <div class="form-row">
                                                            <div class="col-md-5 mb-3">
                                                                <label for="fname">First name</label>
                                                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?php echo $applicantFname ?>">
                                                            </div>
                                                            <div class="col-md-5 mb-3">
                                                                <label for="lname">Last name</label>
                                                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?php echo $applicantLname ?>">
                                                            </div>
                                                            <div class="col-md-2 mb-3">
                                                                <label for="mname">M.I</label>
                                                                <input type="text" class="form-control" id="mname" name="mname" maxlength="1" placeholder="M.I" value="<?php echo $applicantMname ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo $applicantAddress ?>">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="city">City</label>
                                                                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $applicantCity ?>">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="region">Region</label>
                                                                <input type="text" class="form-control" id="region" name="state" placeholder="Region" value="<?php echo $applicantState ?>">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="zip">Zip</label>
                                                                <input type="number" class="form-control" id="zip" name="zip" placeholder="zip" value="<?php echo $applicantZip ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="contact">Contact Number</label>
                                                                <input type="number" class="form-control" id="contact" name="contactno" placeholder="Contact no#" value="<?php echo $applicantContact ?>">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="username">Username</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" aria-describedby="inputGroupPrepend2" value="<?php echo $applicantUsername ?>">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class=" form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $applicantEmail ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="password">Password</label>
                                                                <input type="password" class="form-control" id="password" minlength="8" placeholder="Password" name="password" value="<?php echo $_SESSION['password'] ?>">
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <div class=" small-section-tittle mt-4">
                                                            <h4>Resume Information</h4>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="objective">Objectives</label>
                                                            <textarea class="form-control" id="objective" name="objective" rows="3" required><?php echo $applicantObjective ?></textarea>
                                                        </div>


                                                        <div class="form-group">
                                                            Attach your decent picture here:
                                                            <br>
                                                            <input id="myfile" name="myfile" type="file" style="margin-top: 10px;" required>
                                                        </div>
                                                        <button name="updateProfile" id="submit" type="submit" class="btn btn-primary">Update Resume</button>

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
                                                    <div class="form-group">\
                                                        <label for="validationDefault04">Company namespace</label>\
                                                        <input type="text" class="form-control" id="validationDefault04" name="company_name[]" placeholder="Company name" required>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <label for="validationDefault03">Description</label>\
                                                        <textarea class="form-control" id="validationDefault03" name="work_description[]" rows="3" required></textarea>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <button class="remove-btn btn-dan btn-danger">remove</button>\
                                                    </div>\
                                                    <hr>\
                                                </div>');
        });

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
                                                    <div class="form-group">\
                                                        <label for="education_description">Description</label>\
                                                        <textarea class="form-control" id="education_description" name="educ_description[]" rows="3" placeholder="Write your degree/University name" required></textarea>\
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