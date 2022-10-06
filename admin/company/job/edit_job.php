<?php
session_start();
if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}
date_default_timezone_set('Asia/Manila');

require_once "../../../connection/config.php";

$id = $_GET['edit'];

$query = mysqli_query($conn, "SELECT * FROM tbljob WHERE JOBID = '$id'");
while ($row = mysqli_fetch_array($query)) {
    $jobid = $row['JOBID'];
    $companyid = $row['COMPANYID'];
    $occupation_title = $row['OCCUPATION_TITLE'];
    $fields = $row['JOB_FIELD'];
    $location = $row['LOCATION'];
    $job_nature = $row['STATUS'];
    $salary_from = $row['SALARY_FROM'];
    $salary_to = $row['SALARY_TO'];
    $work_experience = $row['WORK_EXPERIENCE'];
    $age_from = $row['AGE_FROM'];
    $age_to = $row['AGE_TO'];
    $remarks = $row['REMARKS'];
    $description = $row['DESCRIPTION'];
    $prefered_sex = $row['PREFERED_SEX'];
    $highest_educational_attainment = $row['EDUCATIONAL'];
    $status = $row['STATUS'];
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

<?php include_once "partial/job_header.php"; ?>
<main>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="job.php">Job List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Job Vacancy</li>
        </ol>
    </nav>

    <h2 class="dash-title">Edit Job Vacancy</h2>

    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <div id="msg"></div>
                    <form action="" method="POST" style="margin: 1%; padding: 1%;" name="job_form" id="job_form">
                        <div class="form-group">
                            <label for="occupational_title">Occupation Title: </label>
                            <input type="text" name="occupation_title" id="occupation_title" value="<?php echo $occupation_title; ?>" class="form-control" placeholder="Enter Occupation Title">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Field of Job: </label>
                            <select class="form-control input-sm" name="field" required>
                            <option value="<?php echo $fields; ?>"><?php echo $fields; ?></option>
                                <?php
                                foreach ($fieldOfExperience as $key => $field) :
                                    echo '<option value="' . $field . '">' . $field . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Job location:</label>
                            <input list="job_location" name="location" id="location" value="<?php echo $location; ?>" class="form-control block" placeholder="Enter Job Location" />
                            <datalist id="job_location" placeholder="Enter Job Location">
                                <option value="Taguig City">
                                <option value="Pasig City">
                                <option value="Mandaluyong City">
                                <option value="Manila City">
                                <option value="Makati City">
                                <option value="San Juan City">
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="job_nature">Select type of Employment : </label>
                            <select class="form-control input-sm" id="job_nature" name="job_nature">
                                <option value="<?php echo $job_nature; ?>"><?php echo $job_nature; ?></option>
                                <option>Full Time</option>
                                <option>Part Time</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="salary_from">Salary Range: </label>
                                <input type="number" name="salary_from" id="salary_from" value="<?php echo $salary_from; ?>" class="form-control" placeholder="Enter Salay Starting from">
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <label for="salary_to"></label>
                                <input type="number" name="salary_to" id="salary_to" value="<?php echo $salary_to; ?>" class="form-control" placeholder="Enter Salay Starting to">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="age_from">Age Requirement: </label>
                                <input type="number" name="age_from" id="age_from" value="<?php echo $age_from; ?>" class="form-control" min="10" max="65" placeholder="Enter Starting Age">
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <label for="age_to"></label>
                                <input type="number" name="age_to" id="age_to" value="<?php echo $age_to; ?>" class="form-control" min="10" max="65" placeholder="Enter Age limit">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="work_experience">Work Experience </label>
                            <select class="form-control input-sm" id="work_experience" name="work_experience">
                                <option value="<?php echo $work_experience; ?>"><?php echo $work_experience; ?></option>
                                <option value="Entry Level">Entry Level</option> <!-- positions at an organization that require minimal prior experience -->
                                <option value="Mid Level">Mid Level</option> <!-- (position that requires more experience than an entry-level job) -->
                                <option value="Senior Level">Senior Level</option>
                                <option value="Expert Level">Expert Level</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="highest_degree_attainment">Higest Degree Attainment </label>
                            <select class="form-control input-sm" id="highest_educational_attainment" name="highest_educational_attainment">
                                <option value="<?php echo $highest_educational_attainment; ?>"><?php echo $highest_educational_attainment; ?></option>
                                <option>High School Graduate</option>
                                <option>Bachelors Degree</option>
                                <option>Masters Degree</option>
                                <option>Doctoral Degree</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_description">Job Description: </label>
                            <input type="text" name="job_description" id="job_description" value="<?php echo $description; ?>" class="form-control" placeholder="Enter Job Description">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="prefered_sex">Prefered Sex:</label>
                            <select class="form-control input-sm" id="prefered_sex" name="prefered_sex">
                                <option value="<?php echo $prefered_sex; ?>"><?php echo $prefered_sex; ?></option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Rather not to say</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="status">Status:</label>
                            <select class="form-control input-sm" id="status" name="status">
                                <option value="<?php echo $remarks; ?>"><?php echo $remarks; ?></option>
                                <option>On going</option>
                                <option>Occupied</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['edit']; ?>">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" placeholder="Update" name="submit" id="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
</body>

</html>

<?php
require_once "../../../connection/config.php";

function remove_sp_chr($str)
{
    $result = str_replace(array("#", "'", ";"), '', $str);
    return $result;
}

if (isset($_POST['submit'])) {
    $skillid = $_POST['skills_id'];
    $jobid = $_POST['id'];
    $occupation_title = $_POST['occupation_title'];
    $job_fields = $_POST['field'];
    $location = $_POST['location'];
    $job_naturee = $_POST['job_nature'];
    $salary_from = $_POST['salary_from'];
    $salary_to = $_POST['salary_to'];
    $work_experience = $_POST['work_experience'];
    $age_from = $_POST['age_from'];
    $age_to = $_POST['age_to'];
    $highest_educational_attainment = $_POST['highest_educational_attainment'];
    $job_description = $_POST['job_description'];
    $job_description = remove_sp_chr($job_description);
    $prefered_sex = $_POST['prefered_sex'];
    $status = $_POST['status'];

    $query1 = mysqli_query($conn, "UPDATE tbljob SET occupation_title='$occupation_title', job_field = '$job_fields', location = '$location', STATUS = '$job_naturee', salary_from = '$salary_from', salary_to = '$salary_to',
    work_experience = '$work_experience', age_from = '$age_from', age_to = '$age_to', educational = '$highest_educational_attainment', 
    description = '$job_description', prefered_sex = '$prefered_sex', REMARKS = '$status' WHERE jobid = '$jobid'");
    $today = date("Y-m-d H:i:s");

    $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Edit job')");
    if ($query1) {
        header("Location: job.php?jobMessage=Job has been successfully update");
        echo ("<script>window.location = 'job.php';</script>");
    } else {
        echo "<script>alert('Try again')</script>";
    }
}
?>