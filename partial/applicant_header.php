<?php
include('connection/config.php');
date_default_timezone_set('Asia/Manila');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Accurafind is also known as a career portal; it is a site that advertises a job, suggests proficient candidates that are suited for your company. It is an exclusive employment portal for companies that are partnered with the team that builds the system">
    <meta property="og:title" content="AccuraFind">
    <meta property="og:description" content="Accurafind is also known as a career portal; it is a site that advertises a job, suggests proficient candidates that are suited for your company. It is an exclusive employment portal for companies that are partnered with the team that builds the system">
    <meta property="og:image" content="http://">
    <meta property="og:url" content="https://accura-find.com">
    <title>Accurafind</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo/accurafind_logo.png" />
    <link rel="manifest" href="site.webmanifest" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/flaticon.css" />
    <link rel="stylesheet" href="assets/css/slicknav.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="assets/css/themify-icons.css" />
    <link rel="stylesheet" href="assets/css/slick.css" />
    <link rel="stylesheet" href="assets/css/nice-select.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        .one,
        .two,
        .three {
            position: absolute;
            margin-top: -10px;
            z-index: 1;
            height: 40px;
            width: 40px;
            border-radius: 25px;

        }

        .one p,
        .two p,
        .three p {
            position: absolute;
            text-align: center;
            border-radius: 25px;
            width: 200px;
            margin-left: -80px;
            margin-bottom: 40px;
        }

        .one {
            left: 25%;
        }

        .two {
            left: 50%;
        }

        .three {
            left: 75%;
        }

        .primary-color {
            background-color: #4989bd;
        }

        .success-color {
            background-color: #5cb85c;
        }

        .danger-color {
            background-color: #d9534f;
        }

        .warning-color {
            background-color: #f0ad4e;
        }

        .info-color {
            background-color: #5bc0de;
        }

        .no-color {
            background-color: inherit;
        }
    </style>
</head>

<body>
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparrent">
            <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="applicant_home.php"><img src="assets/img/logo/accurafind-logo.png" width="80" height="80px" alt="" />
                                    <h4 style="display: inline; line-height: 4;">Accurafind</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu" style="margin-left: 265px;">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="applicant_home.php">Home</a></li>
                                            <li><a href="applicant_joblist.php">Find a Job</a></li>
                                            <li><a href="applicant_company.php">Company</a></li>
                                            <li><a href="applicant_profile.php">Profile</a></li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php echo $_SESSION['username']; ?>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                    <a class="dropdown-item" href="logout.php" style="padding: 0; margin: 0 2rem">Logout</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>