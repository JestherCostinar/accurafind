<?php

include('connection/config.php');

$id = $_GET['details'];

$query = mysqli_query($conn, "SELECT tbljob.*, tblcompany.*, CONCAT('₱', FORMAT(salary_from, 'c'),' - ₱', FORMAT(salary_to, 'c')) AS salaries, CONCAT(age_from,' - ', age_to, ' years old') AS age_range, DATE_FORMAT(DATEPOSTED, '%M %e, %Y') AS date FROM tbljob, tblcompany WHERE JOBID = '$id'");
while ($row = mysqli_fetch_array($query)) {
    $jobid = $row['JOBID'];
    $companyid = $row['COMPANYID'];
    $companyname = $row['COMPANY_NAME'];
    $occupation_title = $row['OCCUPATION_TITLE'];
    $location = $row['LOCATION'];
    $job_status = $row['STATUS'];
    $salary_from = $row['SALARY_FROM'];
    $salary_to = $row['SALARY_TO'];
    $salaries = $row['salaries'];
    $work_experience = $row['WORK_EXPERIENCE'];
    $age_from = $row['AGE_FROM'];
    $age_to = $row['AGE_TO'];
    $age_range = $row['age_range'];
    $description = $row['DESCRIPTION'];
    $prefered_sex = $row['PREFERED_SEX'];
    $highest_educational_attainment = $row['EDUCATIONAL'];
    $remarks = $row['REMARKS'];
    $date = $row['date'];
}
?>

<?php include_once "partial/header.php"; ?>

<main>
    <!-- slider Area Start-->

    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->
                    <div class="single-job-items mb-50">
                        <div class="job-items">
                            <div class="company-img company-img-details">
                                <img src="images/icon-job.jpg" width="80px" height="80px" alt="">
                            </div>
                            <div class="job-tittle" style="margin-top: 10px;">
                                <a href="#">
                                    <h4><?php echo $occupation_title; ?></h4>
                                </a>
                                <ul>
                                    <li><?php echo $companyname; ?></li>
                                    <li><i class="fas fa-map-marker-alt"></i><?php echo $location; ?></li>
                                    <li><?php echo $salaries; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- job single End -->

                    <div class="job-post-details">
                        <div class="post-details1 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Description</h4>
                            </div>
                            <p><?php echo $description; ?></p>

                        </div>
                        <div class="post-details2  mb-30">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Education + Experience</h4>
                            </div>
                            <ul>
                                <li><?php echo $work_experience; ?> in Working at industry</li>
                                <li><?php echo $highest_educational_attainment; ?> Required</li>

                            </ul>
                        </div>
                        <div class="post-details2  mb-20">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Skills Required</h4>
                            </div>
                            <?php

                            $get_skill = mysqli_query($conn, "SELECT * FROM tblskills WHERE SKILLS_ID = '$id'");
                            while ($row1 = mysqli_fetch_array($get_skill)) {
                            ?>
                                <ul>

                                    <li><?php echo $row1['SKILLS']; ?></li>
                                </ul>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="post-details2  mb-20">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Skills Level Guideline</h4>
                            </div>
                            <ul>
                                <li>Expert - Fully capable and experienced, Needs no assistance to complete tasks and Demonstrated ability to lead and train others.</li>
                                <li>Proficient - Capable and experienced, Demonstrated Proficiency and Able to work independently with little help. </li>
                                <li>Demonstrating - Able to perform at a basic level, Has some direct experienced and Needs help from time to time.</li>
                                <li>Basic - Limited in ability or knowledge, Cannot perform for critical task and Needs significant help from others.</li>
                                <li>None / Low - -Unable to perform and Little to no experience</li>
                            </ul>

                        </div>
                    </div>

                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3  mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Job Overview</h4>
                        </div>
                        <ul>
                            <li>Posted date : <span><?php echo $date; ?></span></li>
                            <li>Location : <span><?php echo $location; ?></span></li>
                            <li>Job Type : <span><?php echo $job_status; ?></span></li>
                            <li>Job Status : <span><?php echo $remarks; ?></span></li>
                            <li>Salary : <span><?php echo $salaries; ?></span></li>
                            <li>Age required : <span><?php echo $age_range; ?></span></li>
                        </ul>
                        <div class="alert alert-info" role="alert">
                            You need to register or login first to apply.
                        </div>
                        <div class="apply-btn2">
                            <a href="register.php" class="btn">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->
    <!--Pagination Start  -->

</main>
<?php include_once "partial/footer.php"; ?>