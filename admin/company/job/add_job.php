<?php
require_once "../../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}

function remove_sp_chr($str)
{
    $result = str_replace(array("#", "'", ";"), '', $str);
    return $result;
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

$id_job = 0;
if (isset($_POST['submit'])) {
    $companyid = $_POST['id'];
    $occupation_title = $_POST['occupation_title'];
    $job_field = $_POST['field'];
    $location = $_POST['location'];
    $job_nature = $_POST['job_nature'];
    $salary_from = $_POST['salary_from'];
    $salary_to = $_POST['salary_to'];
    $work_experience = $_POST['work_experience'];
    $age_from = $_POST['age_from'];
    $age_to = $_POST['age_to'];
    $job_sk = $_POST['job_skill'];
    $highest = $_POST['highest'];
    $job_description = $_POST['job_description'];
    $job_description = remove_sp_chr($job_description);
    $prefered_sex = $_POST['prefered_sex'];
    $remarks = "On going";
    $date = date('Y-m-d');
    $today = date("Y-m-d H:i:s");

    $query = mysqli_query($conn, "INSERT INTO tbljob(DESCRIPTION, COMPANYID, OCCUPATION_TITLE, JOB_FIELD, LOCATION, STATUS, SALARY_FROM, SALARY_TO, WORK_EXPERIENCE, AGE_FROM, AGE_TO, PREFERED_SEX, EDUCATIONAL, REMARKS, DATEPOSTED) VALUES ('$job_description', '$companyid', '$occupation_title', '$job_field', '$location', '$job_nature', '$salary_from', '$salary_to', '$work_experience', '$age_from', '$age_to', '$prefered_sex', '$highest', '$remarks', '$date')");

    if ($query) {
        $select_tbljobid =  mysqli_query($conn, "SELECT * FROM tbljob WHERE SKILLS_LIST = ''");
        $row = mysqli_fetch_assoc($select_tbljobid);
        $id_job = $row['JOBID'];
        if ($select_tbljobid) {
            foreach ($job_sk as $index => $skil) {
                $s_skills = $skil;
                $insert_skills = mysqli_query($conn, "INSERT INTO tblskills(SKILLS, SKILLS_ID) VALUES ('$s_skills', '$id_job')");
            }
            $get_skills = mysqli_query($conn, "SELECT GROUP_CONCAT(skills) as sk FROM tblskills WHERE tblskills.SKILLS_ID = '$id_job'");
            $row1 = mysqli_fetch_assoc($get_skills);
            $skill_list = $row1['sk'];
            $update_query = mysqli_query($conn, "UPDATE tbljob SET SKILLS_LIST='$skill_list' WHERE jobid = '$id_job'");
            $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Add job')");
            header("Location: job.php?jobMessage=Job has been successfully added");
        }
    } else {
        echo "<script>alert('Try again')</script>";
    }
}
include_once "partial/job_header.php";

?>
<main>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="job.php">Job</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Job</li>
        </ol>
    </nav>

    <h2 class="dash-title">Add Job Vacancy</h2>

    <section class="recent" style="margin-top: 0;">
        <div>
            <div class="activity-card" style="background: #f2f4f4; border: 1px solid #ccc;">
                <div>
                    <form action="add_job.php" style="margin: 1%; padding: 1%;" name="job_form" id="job_form" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $companyid ?>">
                        <div class="form-group">
                            <label for="occupation_title">Occupation Title: </label>
                            <input type="text" name="occupation_title" id="occupation_title" class="form-control" placeholder="Enter Occupation Title" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select fields of Job : </label>
                            <select class="form-control input-sm" name="field" required>
                                <option selected value="">--Select--</option>
                                <?php
                                foreach ($fieldOfExperience as $key => $field) :
                                    echo '<option value="' . $field . '">' . $field . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Job location:</label>
                            <input list="job_location" name="location" id="location" class="form-control block" placeholder="Enter Job Location" required />
                            <datalist id="job_location">
                                <option value="Taguig City">
                                <option value="Pasig City">
                                <option value="Mandaluyong City">
                                <option value="Manila City">
                                <option value="Makati City">
                                <option value="San Juan City">
                                <option value="Quezon City">
                                <option value="Caloocan City">
                                <option value="Las Piñas City">
                                <option value="Malabon City">
                                <option value="Marikina City">
                                <option value="Muntinlupa City">
                                <option value="Parañaque City">
                                <option value="Pasay City">
                                <option value="Navotas City">
                                <option value="Valenzuela City">
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="job_nature">Select type of Employment : </label>
                            <select class="form-control input-sm" id="job_nature" name="job_nature" required>
                                <option value="None">Select Job Type</option>
                                <option>Full Time</option>
                                <option>Part Time</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="salary_from">Salary Range: </label>
                                <input type="number" name="salary_from" id="salary_from" class="form-control" placeholder="Enter Salay Starting from">
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <label for="salary_to"></label>
                                <input type="number" name="salary_to" id="salary_to" class="form-control" placeholder="Enter Salay Starting to">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Age Requirement: </label>
                                <input type="number" name="age_from" id="age_from" class="form-control" placeholder="Starting Age" min="18" max="65" required>
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <label for="inputPassword4"></label>
                                <input type="number" name="age_to" id="age_to" class="form-control" placeholder="Enter Age limit" min="18" max="65" required>
                            </div>
                        </div>
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <h4>Skills Set:
                                    <a href="javascript:void(0)" class="add-more-form float-right btn btn-primary">Add more</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="main-form mt-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="form-group">
                                                <label for="job_skill">Enter Skills:</label>
                                                <input list="job_skills" name="job_skill[]" id="job_skill[]" class="form-control block" placeholder="Enter Skills" required />
                                                <datalist id="job_skills">
                                                    <!-- Technical Skills -->
                                                    <option value="Computer skills">
                                                    <option value="Microsoft Office skills">
                                                    <option value="Analytical skills">
                                                    <option value="Marketing skills">
                                                    <option value="Data Presentation skills">
                                                    <option value="Management skills">
                                                    <option value="Project management skills">
                                                    <option value="Writing skills">
                                                    <option value="Language skills">
                                                    <option value="Design skills ">
                                                    <option value="Certifications">
                                                        <!-- Soft Skills -->
                                                    <option value="Communicaton">
                                                    <option value="Flexibility">
                                                    <option value="Problem-solving">
                                                    <option value="Time management">
                                                    <option value="Critical thinking">
                                                    <option value="Decision-making">
                                                    <option value="Organizational">
                                                    <option value="Stress management">
                                                    <option value="Adaptability">
                                                    <option value="Conflict management">
                                                    <option value="Leadership">
                                                    <option value="Creativity">
                                                    <option value="Resourcefulness">
                                                    <option value="Persuasion">
                                                    <option value="Openness to criticism">
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paste-new-form"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="highest_degree_attainment">Higest Degree Attainment </label>
                            <select class="form-control input-sm" id="highest" name="highest" required>
                                <option value="None">Select</option>
                                <option>High School Degree</option>
                                <option>Bachelors Degree</option>
                                <option>Masters Degree</option>
                                <option>Doctoral Degree</option>
                                <option>Non Degree Courses</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="work_experience">Select Work Experience </label>
                            <select class="form-control input-sm" id="work_experience" name="work_experience" required>
                                <option value="None">Select</option>
                                <option value="Entry Level">Entry Level</option> <!-- positions at an organization that require minimal prior experience -->
                                <option value="Mid Level">Mid Level</option> <!-- (position that requires more experience than an entry-level job) -->
                                <option value="Senior Level">Senior Level</option>
                                <option value="Expert Level">Expert Level</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_description">Job Description: </label>
                            <textarea type="text" name="job_description" id="job_description" class="form-control" placeholder="Enter Job Description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="prefered_sex">Prefered Sex:</label>
                            <select class="form-control input-sm" id="prefered_sex" name="prefered_sex" required>
                                <option value="None">Select</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Rather not to say</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" placeholder="Save" name="submit" id="submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>


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
<script>
    $(document).ready(function() {
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.main-form').remove();
        });

        $(document).on('click', '.add-more-form', function() {
            $('.paste-new-form').append('<div class="main-form mt-3">\
                                            <div class="row">\
                                            <div class="col-md-8">\
                                                <div class="form-group">\
                                                <label for="job_skill">Skills:</label>\
                                    <input list="job_skills" name="job_skill[]" id="job_skill[]" class="form-control block" placeholder="Enter Skills" required />\
                                    <datalist id="job_skills">\
                                        <option value="Taguig City">\
                                        <option value="Pasig City">\
                                        <option value="Mandaluyong City">\
                                        <option value="Manila City">\
                                        <option value="Makati City">\
                                        <option value="San Juan City">\
                                    </datalist>\
                                                </div>\
                                            </div>\
                                            <div class="col-md-4">\
                                                <div class="form-group">\
                                                    <br>\
                                                    <button type="button" class="remove-btn btn btn-danger mt-2">Remove</button>\
                                                </div>\
                                            </div>\
                                            </div>\
                                        </div>');
        });
    });
</script>
</body>

</html>