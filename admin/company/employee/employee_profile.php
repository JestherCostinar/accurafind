<?php
require_once "../../../connection/config.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['COMPANYID'])) {
    $companyid = $_SESSION['COMPANYID'];
} else {
    header('location: ../../index.php');
}


$employeeId = $_GET['profileId'];

$selectEmployee = mysqli_query($conn, "SELECT *, CONCAT(LNAME, ', ', FNAME, ' ', MNAME) AS fullname FROM tblemployee WHERE employeeid  = '$employeeId'");
while ($employeeRow = mysqli_fetch_array($selectEmployee)) {
    $fname = $employeeRow['FNAME'];
    $lname = $employeeRow['LNAME'];
    $mname = $employeeRow['MNAME'];
    $fullname = $employeeRow['fullname'];
    $address = $employeeRow['ADDRESS'];
    $city = $employeeRow['CITY'];
    $state = $employeeRow['STATE'];
    $zip = $employeeRow['ZIP'];
    $contact = $employeeRow['CONTACTNO'];
    $email = $employeeRow['EMAIL'];
    $position = $employeeRow['POSITION'];
    $objective = $employeeRow['OBJECTIVE'];
    $status = $employeeRow['DATEHIRED'];
    $applicantid = $employeeRow['APPLICANTID'];
}

if (isset($_POST['submit_rating'])) {
    $applicantRating = $_POST['rating'];

    $insertRating = mysqli_query($conn, "INSERT INTO tblrating (RATING, APPLICANTID) VALUES ('$applicantRating', '$applicantid')");
    $today = date("Y-m-d H:i:s");
    $logs = mysqli_query($conn, "INSERT INTO tbl_log (NAME, LOG_TIME, ROLE, ACTIVITY) VALUE ('{$_SESSION['USER_NAME']}', '$today', '{$_SESSION['ROLE']}', 'Rate Employee')");
    if ($insertRating) {
        header("Location: employee.php?ratingMessage=Rating Submit");
    }
}
include_once "partial/employee_header.php";

?>



<main>
    <p>
        <a href="employee.php" class="btn btn-success mt-4">Go back to Employee</a>
    </p>
    <section class=" recent mb-4 mr-4" style="margin-top: 0;">
        <div class="grid-1x2">
            <div class="summary">
                <div class="summary-card">
                    <div class="summary-single">
                        <div>
                            <small>APPLICANT NAME:</small>
                            <h5><?php echo $fullname ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>Address:</small>
                            <h5><?php echo $address ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>City, State and Zip:</small>
                            <h5><?php echo $city . ', ' . $state . ', ' . $zip ?></h5>
                        </div>
                    </div>

                    <div class="summary-single">
                        <div>
                            <small>Phone number:</small>
                            <h5><?php echo $contact ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>Status:</small>
                            <h5><?php echo $status ?></h5>
                        </div>
                    </div>
                    <div class="summary-single">
                        <div>
                            <small>Email Address:</small>
                            <h5><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></h5>
                        </div>
                    </div>

                </div>
                <div class="summary-card">
                    <div class="card m-4">
                        <div class="card-header">
                            Rate the employee
                        </div>
                        <div class="p-3">

                            <form method="POST" action="">

                                <div class="form-group">
                                    <label>Rating</label>
                                    <select class="form-control input-sm" name="rating">
                                        <option value="none">--Select--</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>


                                <input type="hidden" name="reg_id" id="reg_id" value="<?php echo $_GET['regisid']; ?>">
                                <input type="submit" class="btn btn-primary float-right" name="submit_rating" value="submit">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="card m-4">
                        <div class="card-header">
                            Employee Uploaded Requirements
                        </div>
                        <div class="p-3">
                            <tbody>
                                <?php
                                $getRequirement = mysqli_query($conn, "SELECT * FROM tbljob_requirements WHERE applicantid = '$applicantid'");
                                while ($requirementRow = mysqli_fetch_array($getRequirement)) {

                                ?>
                                    <tr>
                                        <td><?php echo $requirementRow['FILE_DESCRIPTION']; ?>:</td>
                                        <br>
                                        <td>
                                            <a style="color: blue; text-decoration: underline;" href="../../../requirements-folder/<?php echo $requirementRow['FILE_NAME']; ?>" download>
                                                <?php echo $requirementRow['FILE_NAME']; ?>
                                            </a>
                                        </td>
<hr>
                                    </tr>
                                    <br>
                                <?php } ?>
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>
            <div class="activity-card">
                <!-- <button style="float: right;" class="btn btn-primary m-4 px-4" data-toggle="modal" data-target="#addModal" href="review_applicant.php?regisid=<?php echo $regisid; ?>&applicantid=<?php echo $applicantid; ?>">Review</button> -->

                <h3 class="mt-2">Resume</h3>

                <hr>
                <div class="card m-4">
                    <div class="card-header">
                        Objectives
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p><?php echo $objective; ?></p>
                        </blockquote>
                    </div>
                </div>
                <div class="card m-4">
                    <div class="card-header">
                        Education
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <?php
                            $geteducation = mysqli_query($conn, "SELECT * FROM tblapplicant_education WHERE applicantid = '$applicantid'");
                            while ($row2 = mysqli_fetch_array($geteducation)) {
                            ?>
                                <p><?php echo $row2['SCHOOL_NAME']; ?> (<?php echo $row2['EDUC_YEAR']; ?>)</p>
                                <footer class="blockquote-footer mb-2"><?php echo $row2['EDUCATIONAL_DEGREE']; ?></footer>
                                <P style="font-size: 1rem;">Description: <?php echo $row2['EDUC_DESCRIPTION']; ?></P>
                            <?php } ?>
                        </blockquote>
                    </div>
                </div>
                <div class="card m-4">
                    <div class="card-header">
                        Work Experience
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <?php
                            $getwork_experience = mysqli_query($conn, "SELECT * FROM tblapplicant_workexperience WHERE applicantid = '$applicantid'");
                            while ($row3 = mysqli_fetch_array($getwork_experience)) {
                            ?>
                                <p class="mb-2" style="font-weight: 350;"><?php echo $row3['WORK_TITLE']; ?> (<?php echo $row3['WORK_YEAR']; ?>)</p>
                                <footer class="blockquote-footer mb-2 "><?php echo $row3['WORK_DESCRIPTION']; ?></footer>
                            <?php } ?>
                        </blockquote>

                    </div>
                </div>
            </div>

        </div>


    </section>


</main>
</div>
</body>

</html>