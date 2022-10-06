<?php
include('connection/config.php');
session_start();

if (isset($_SESSION['applicantid'])) {
    $applicantid = $_SESSION['applicantid'];
} else {
    header('location: login.php');
}


$workId = $_GET['wordEdit'];

$getWorkExp = mysqli_query($conn, "SELECT * FROM tblapplicant_workexperience WHERE work_experience_id = '$workId'");
while ($workRow = mysqli_fetch_array($getWorkExp)) {
    $title = $workRow['WORK_TITLE'];
    $year = $workRow['WORK_YEAR'];
    $field = $workRow['FIELD'];
    $companyName = $workRow['COMPANY_NAME'];
    $desc = $workRow['WORK_DESCRIPTION'];
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
                                        <div class="col-xl-12 col-lg12">
                                            <!-- job single -->
                                            <!-- job single End -->

                                            <div class="job-post-details p-4" style="background: #fff; border: 1px solid #ededed;">
                                                <div class="post-details1 mb-50">
                                                    <!-- Small Section Tittle -->

                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4>
                                                                        Work Experience
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="main-form">
                                                                        <div class="form-row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="workTitle">Work title</label>
                                                                                <input type="text" class="form-control" name="workTitle" placeholder="Work title" value="<?php echo $title ?>" required />
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <label for="job_skill">Field of Work Experience</label>
                                                                                <input list="work_fields" name="work_field" id="work_field" class="form-control block" value="<?php echo $field ?>" placeholder="--Degree--" />
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
                                                                            <input type="text" class="form-control" name="companyName" placeholder="Company name" value="<?php echo $companyName ?>" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="companyDescription">Description</label>
                                                                            <textarea class="form-control" name="workDescription" rows="3"><?php echo $desc ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="workexpId" value="<?php echo $_GET['wordEdit']; ?>">
                                                        <button type="submit" class="btn btn-success" placeholder="Update" name="submitWork" id="submit">Submit</button>
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
        </div>
    </section>
</main>
<?php

include_once "partial/footer.php";

function remove_sp_chr($str)
{
    $result = str_replace(array("#", "'", ";"), '', $str);
    return $result;
}

if (isset($_POST['submitWork'])) {
    $w_id = $_POST['workexpId'];
    $w_title = $_POST['workTitle'];
    $w_field = $_POST['work_field'];
    $w_title = remove_sp_chr($w_title);
    $w_name = $_POST['companyName'];
    $w_name = remove_sp_chr($w_name);
    $w_desc = $_POST['workDescription'];
    $w_desc = remove_sp_chr($w_desc);
    $updateExp = mysqli_query($conn, "UPDATE tblapplicant_workexperience SET work_title = '$w_title', company_name = '$w_name', field = '$w_field', work_description = '$w_desc' WHERE work_experience_id = '$workId'");
    if ($updateExp) {
        echo ("<script>alert('Record has been successfully update')</script>");
        echo ("<script>window.location = 'applicant_profile.php';</script>");
    }
}

?>