<?php
include_once "partial/header.php";
// $job_name = $_GET['job_name'] ?? null;
$job_category = $_GET['job_category'] ?? null;
$job_location = $_GET['job_location'] ?? null;
$job_type = $_GET['job_location'] ?? null;

?>

<main>
    <!-- slider Area Start-->

    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <?php if (isset($_GET['apply_job_message'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_GET['apply_job_message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="row">
                <!-- Left content -->

                <div class="col-xl-3 col-lg-3 col-md-4">

                    <div class="row">
                        <div class="col-12">
                            <div class="small-section-tittle2 mb-45">
                                <div class="ion"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="12px">
                                        <path fill-rule="evenodd" fill="rgb(27, 207, 107)" d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z" />
                                    </svg>
                                </div>
                                <h4>Filter Jobs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job Category Listing start -->
                    <form action="job.php" method="get">
                        <div class="job-category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                                <!-- <div class="small-section-tittle2 ">
                                    <h4>JOB TITLE</h4>
                                </div>
                                <div class="select-job-items2 mb-50">
                                    <input type="text" class="form-control" name="job_name" value="<?php echo $job_name ?>" placeholder="Type Job here..">
                                </div> -->

                                <div class="small-section-tittle2">
                                    <h4>JOB LOCATION</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="job_location">
                                        <option value="<?php echo $job_location ?>">
                                            <?php if ($job_location) {
                                                echo $job_location;
                                                echo '<option value="">--Select--</option>';
                                            } else {
                                                echo 'Select';
                                            } ?>
                                        </option>
                                        <option value="Taguig City">Taguig City</option>
                                        <option value="Pasig City">Pasig City</option>
                                        <option value="Mandaluyong City">Mandaluyong City</option>
                                        <option value="Manila City">Manila City</option>
                                        <option value="Makati City">Makati City</option>
                                        <option value="San Juan City">San Juan City</option>
                                        <option value="Quezon City">Quezon City</option>
                                        <option value="Caloocan City">Caloocan City</option>
                                        <option value="Las Piñas City">Las Piñas City</option>
                                        <option value="Malabon City">Malabon City</option>
                                        <option value="Marikina City">Marikina City</option>
                                        <option value="Muntinlupa City">Muntinlupa City</option>
                                        <option value="Parañaque City">Parañaque City</option>
                                        <option value="Pasay City">Pasay City</option>
                                        <option value="Navotas City">Navotas City</option>
                                        <option value="Valenzuela City">Valenzuela City</option>
                                    </select>
                                </div>


                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                <div class="select-Categories pt-80 pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Type of Employment</h4>
                                    </div>
                                    <input type="radio" name="job_type" value="Full Time" id="fulltime">
                                    <label for="fulltime">Full Time</label><br>
                                    <input type="radio" name="job_type" value="Part Time" id="parttime">
                                    <label for="parttime">Part Time</label><br>
                                </div>

                                <div class="small-section-tittle2">
                                    <h4>JOB WORK EXPERIENCE</h4>
                                </div>
                                <div class="select-job-items2 ">
                                    <select name="job_category">
                                        <option value="<?php echo $job_category ?>">
                                            <?php if ($job_category) {
                                                echo $job_category;
                                                echo '<option value="">--Select--</option>';
                                            } else {
                                                echo 'Select';
                                            } ?>
                                        </option>
                                        <option value="Entry Level">Entry Level</option> <!-- positions at an organization that require minimal prior experience -->
                                        <option value="Mid Level">Mid Level</option> <!-- (position that requires more experience than an entry-level job) -->
                                        <option value="Senior Level">Senior Level</option>
                                        <option value="Expert Level">Expert Level</option>
                                    </select>
                                </div>


                                <!-- select-Categories End -->
                            </div>

                            <div class="single-listing">
                                <!-- select-Categories start -->
                                <div class="form-group">
                                    <button class="btn btn-block mt-4" name="filter" type="submit">Filter</button>
                                </div>
                                <!-- select-Categories End -->
                            </div>

                        </div>
                    </form>
                    <!-- Job Category Listing End -->
                </div>
                <!-- Right content -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- Count of Job list Start -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="count-job mb-35">
                                        <?php
                                        // $query1 = mysqli_query($conn, "SELECT count(*) as job_count FROM tbljob");
                                        // while ($row1 = mysqli_fetch_array($query1)) {
                                        //     $job_count = $row1['job_count'];
                                        // }
                                        ?>

                                        <span></span>
                                        <!-- Select job items start -->
                                        <form action="">
                                            <div class="select-job-items">
                                                <button class="btn btn-primary py-3 px-4 rounded" name="reset" type="submit">Reset</button>
                                            </div>
                                        </form>
                                        <!--  Select job items End-->
                                    </div>
                                </div>
                            </div>
                            <!-- Count of Job list End -->
                            <!-- single-job-content -->
                            <?php
                            if (!empty($_POST['jobtitle']) and !empty($_POST['category'])) {
                                $jobtitle = $_POST['jobtitle'];
                                $category = $_POST['category'];
                                $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.OCCUPATION_TITLE = '$jobtitle'");
                            } else {
                                $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going'");
                            }

                            if (isset($_GET['filter'])) {
                                // $job_name = $_GET['job_name'] ?? null;
                                $job_category = $_GET['job_category'] ?? null;
                                $job_location = $_GET['job_location'] ?? null;
                                $job_type = $_GET['job_type'] ?? null;

                                // if ((!empty($job_type)) && (!empty($job_category)) && (!empty($job_location)) && (!empty($job_name))) {
                                //     $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location' AND tbljob.STATUS = '$job_type' AND tbljob.WORK_EXPERIENCE = '$job_category' AND tbljob.OCCUPATION_TITLE = '$job_name'");
                                // }
                                if ((empty($job_type)) && (empty($job_category)) && (empty($job_location))) {
                                    $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going'");
                                }
                                if ((!empty($job_type)) && (!empty($job_category)) && (!empty($job_location))) {
                                    $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location' AND tbljob.STATUS = '$job_type' AND tbljob.WORK_EXPERIENCE = '$job_category' AND tbljob.OCCUPATION_TITLE = '$job_name'");
                                } else {
                                    // if (empty($job_type) && (!empty($job_location)) && (!empty($job_category)) && (!empty($job_name))) {
                                    //     echo "1";
                                    //     $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location' AND tbljob.WORK_EXPERIENCE = '$job_category' AND tbljob.OCCUPATION_TITLE = '$job_name'");
                                    // } elseif (!empty($job_type) && (empty($job_location)) && (!empty($job_category)) && (!empty($job_name))) {
                                    //     echo "2";
                                    //     $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.STATUS = '$job_type' AND tbljob.WORK_EXPERIENCE = '$job_category' AND tbljob.OCCUPATION_TITLE = '$job_name'");
                                    // } elseif (!empty($job_type) && (!empty($job_location)) && (empty($job_category)) && (!empty($job_name))) {
                                    //     echo "3";
                                    //     $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location' AND tbljob.STATUS = '$job_type' AND tbljob.OCCUPATION_TITLE = '$job_name'");
                                    // } elseif(!empty($job_type) && (!empty($job_location)) && (!empty($job_category)) && (empty($job_name))) {
                                    //     echo "4";
                                    //     $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location' AND tbljob.STATUS = '$job_type' AND tbljob.WORK_EXPERIENCE = '$job_category'");
                                    // } elseif (!empty($job_type) && (!empty($job_location)) && (empty($job_category)) && (!empty($job_name))) {
                                    //     echo "1";
                                    //     $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location' AND tbljob.WORK_EXPERIENCE = '$job_category' AND tbljob.OCCUPATION_TITLE = '$job_name'");
                                    // }

                                    if (!empty($job_type) && (!empty($job_location)) && (empty($job_category))) {
                                        $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location' AND tbljob.STATUS = '$job_type'");
                                    } elseif (!empty($job_type) && (empty($job_location)) && (!empty($job_category))) {
                                        $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.STATUS = '$job_type' AND tbljob.WORK_EXPERIENCE = '$job_category'");
                                    } elseif (empty($job_type) && (!empty($job_location)) && (!empty($job_category))) {
                                        $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location' AND tbljob.WORK_EXPERIENCE = '$job_category'");
                                    } elseif (!empty($job_name)) {
                                        $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.OCCUPATION_TITLE = '$job_name'");
                                    } elseif (!empty($job_type)) {
                                        $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.STATUS = '$job_type'");
                                    } elseif (!empty($job_category)) {
                                        $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.WORK_EXPERIENCE = '$job_category'");
                                    } elseif (!empty($job_location)) {
                                        $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going' AND tbljob.lOCATION = '$job_location'");
                                    }
                                }
                            }

                            if (isset($_POST['reset'])) {
                                $query = mysqli_query($conn, "SELECT tblcompany.*, tbljob.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, CONCAT(work_experience, ' years of experience') AS work_exp FROM tbljob, tblcompany WHERE tbljob.COMPANYID=tblcompany.COMPANYID AND tbljob.REMARKS = 'On going'");
                            }

                            $num_rows = mysqli_num_rows($query);
                            if ($num_rows == 0) {
                                echo '<div class="alert alert-info alert-dismissible fade show" role="alert" data-aos="fade-up">
                                No result found
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                            }
                            while ($row = mysqli_fetch_array($query)) {

                            ?>

                                <div class="single-job-items mb-30" style="max-width: 1000px;" data-aos="fade-up">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <img src="images/icon-job.jpg" width="80px" height="80px" alt="" style="margin-top: 10px;" />
                                        </div>
                                        <div class="job-tittle">
                                            <p href="job_details.html">
                                            <h4><?php echo $row['OCCUPATION_TITLE']; ?></h4>
                                            </p>
                                            <ul>
                                                <li><?php echo $row['COMPANY_NAME']; ?></li>
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i><?php echo $row['LOCATION']; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <a href="job_details.php?details=<?php echo $row['JOBID']; ?>">Apply</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->
    <!--Pagination Start  -->

</main>
<?php include_once "partial/footer.php"; ?>