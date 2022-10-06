<?php
include('connection/config.php');
session_start();

if (isset($_SESSION['applicantid'])) {
    $applicantid = $_SESSION['applicantid'];
} else {
    header('location: login.php');
}
?>

<?php include_once "partial/applicant_header.php"; ?>

<main>
    <!-- slider Area Start-->
    <div class="slider-area">
        <!-- Mobile Menu -->
        <div class="slider-active">
            <div class="single-slider slider-height d-flex align-items-center" data-background="images/background.jpg" style="width: 100%;">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-9 col-md-10">
                            <div class="hero__caption">
                                <h1>Choose the right path with accurafind</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Search Box -->
                    <div class="row">
                        <div class="col-xl-8">
                            <!-- form -->
                            <form action="applicant_joblist.php" class="search-box" method="post">
                                <div class="input-form">
                                    <input type="text" placeholder="Job Tittle or keyword" name="jobtitle" />
                                </div>

                                <div class="select-form">
                                    <div class="select-itms">
                                        <select name="category" id="select1">
                                            <option value="">Select Category</option>
                                            <option value="Services">Services</option>
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Merchandising">Merchandising</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="search-form">
                                    <button name="submit" id="submit" type="submit" class="submit-form" placeholder="sign in">Find job</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="featured-job-area feature-padding">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
            <div class="support-company-area fix section-padding2 pt-0">
                <div class="row align-items-center" data-aos="fade-up-right">
                    <div class="col-xl-6 col-lg-6">
                        <div class="right-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle2">
                                <h2>Accurafind</h2>
                            </div>
                            <div class="support-caption">
                                <p>Accurafind is also known as a career portal; it is a site that advertises a job, suggests proficient candidates that are suited for your company. It is an exclusive employment portal for companies that are partnered with the team that builds the system</p>
                                <p>We match the suggested candidates to the needs of an organization wherein we obtain the appropriate talent that fits the qualification. The expertise of each candidate pertains to their professional skills.</p>
                                <a href="applicant_joblist.php" class="btn post-btn">Start finding a job</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6" data-aos="fade-up-left">
                        <div class="support-location-img">
                            <img src="assets/img/hero/about.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once "partial/footer.php"; ?>