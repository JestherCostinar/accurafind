-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2022 at 06:04 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblapplicant`
--

CREATE TABLE `tblapplicant` (
  `APPLICANTID` int(11) NOT NULL,
  `FNAME` varchar(90) NOT NULL,
  `LNAME` varchar(90) NOT NULL,
  `MNAME` varchar(90) NOT NULL,
  `ADDRESS` varchar(200) NOT NULL,
  `CITY` varchar(90) NOT NULL,
  `STATE` varchar(90) NOT NULL,
  `ZIP` varchar(50) NOT NULL,
  `CONTACTNO` varchar(90) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `EMAIL` varchar(250) NOT NULL,
  `PASSWORD` varchar(250) NOT NULL,
  `OBJECTIVES` varchar(2048) NOT NULL,
  `AGE` int(20) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `HIGHEST_EDUC` varchar(250) NOT NULL,
  `WORK_EXP` varchar(250) NOT NULL,
  `FILE_NAME` varchar(2048) NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `IS_VERIFIED` int(11) NOT NULL,
  `VERIFY_LEVEL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblapplicant`
--

INSERT INTO `tblapplicant` (`APPLICANTID`, `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `CITY`, `STATE`, `ZIP`, `CONTACTNO`, `USERNAME`, `EMAIL`, `PASSWORD`, `OBJECTIVES`, `AGE`, `BIRTHDATE`, `HIGHEST_EDUC`, `WORK_EXP`, `FILE_NAME`, `STATUS`, `IS_VERIFIED`, `VERIFY_LEVEL`) VALUES
(63, 'Jesther', 'Costinar', 'M', 'Blk 1 Lot 3 Lontoc St, Sanga Extension, Calzada', ' Taguig City', 'Metro Manila', '1630', '09218989341', 'kasmir', 'jesther.costinar@my.jru.edu', '5aca54b2c353b43e17a67f6f09c74c7ba7edb9e9', 'To secure a challenging position in a reputable organization to expand my learnings, knowledge, and skills.\r\nSecure a responsible career opportunity to fully utilize my training and skills, while making a significant contribution to the success of the company.', 40, '2000-02-09', 'Bachelors Degree', '', 'AKO.jpg', 'Employed', 1, 'Fully Verified'),
(64, 'Jonnel', 'Ayson', 'V', '#35 East Rembo', 'Makati City', 'National Capital Region (NCR)', '1240', '09214124241', 'jatayson', 'jonnel.ayson@gmail.com', '13df2c8da6fd67f964cde21de24cdd7116666c55', 'aysonayson', 22, '0000-00-00', 'Bachelors Degree', 'Entry Level', 'wonuts_donuts_logo.jpg', 'Unemployed', 1, 'Basic Level'),
(65, 'Alyssa', 'Mariano', 'A', 'Blk 1 Lot 3 Lontoc St, Sanga Extension, Calzada', 'Pasig City', 'National Capital Region (NCR)', '1730', '09218989341', 'aly', 'alyssa.mariano@my.jru.edu', '78c915dd1403d412363e7b04e5160ef76823ea72', 'marianomariano', 22, '0000-00-00', 'Bachelors Degree', 'Mid Level', 'aly.jpg', 'Employed', 1, 'Basic Level'),
(66, 'Camille', 'Ebuenga', 'F', '#43 Dasma', 'Cavite City', 'National Capital Region (NCR)', '1720', '09218989341', 'Evan', 'camille@gmail.com', '882517809f5f341bbbf582de1303f6abbd0d7afb', 'camillecamillecamille', 22, '0000-00-00', 'Masters Degree', 'Senior Level', 'camms.jpg', 'Unemployed', 1, 'Basic Level'),
(83, 'sample', 'sample', 'M', 'Blk 1 Lot 3 Lontoc St, Sanga Extension, Calzada, Taguig City', 'sample', 'sample', '9023', '012345678', 'sample', 'sample@gmail.com', '5aca54b2c353b43e17a67f6f09c74c7ba7edb9e9', 'Aaaaaaaaaa1', 18, '2002-12-11', 'Bachelors Degree', 'Senior Level', 'AKO.jpg', 'Unemployed', 1, 'Basic Level');

-- --------------------------------------------------------

--
-- Table structure for table `tblapplicant_education`
--

CREATE TABLE `tblapplicant_education` (
  `EDUCATION_ID` int(11) NOT NULL,
  `EDUC_YEAR` varchar(90) NOT NULL,
  `SCHOOL_NAME` varchar(250) NOT NULL,
  `EDUCATIONAL_DEGREE` varchar(250) NOT NULL,
  `EDUC_DESCRIPTION` varchar(512) NOT NULL,
  `APPLICANTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblapplicant_education`
--

INSERT INTO `tblapplicant_education` (`EDUCATION_ID`, `EDUC_YEAR`, `SCHOOL_NAME`, `EDUCATIONAL_DEGREE`, `EDUC_DESCRIPTION`, `APPLICANTID`) VALUES
(65, '2018 - 2022', 'Jose Rizal University', 'BS in Information Technology', '', 63),
(66, '2018 - 2022', 'Jose Rizal University', 'BS in Information Technology', '', 64),
(74, '2019 - 2021', 'sample3sample3', 'STEM (Science, Technology, Engineering, and Mathematics)', '', 83);

-- --------------------------------------------------------

--
-- Table structure for table `tblapplicant_workexperience`
--

CREATE TABLE `tblapplicant_workexperience` (
  `WORK_EXPERIENCE_ID` int(11) NOT NULL,
  `WORK_TITLE` varchar(90) NOT NULL,
  `FIELD` varchar(300) NOT NULL,
  `WORK_YEAR` varchar(90) NOT NULL,
  `YEAR_COUNT` int(11) NOT NULL,
  `COMPANY_NAME` varchar(250) NOT NULL,
  `WORK_DESCRIPTION` varchar(512) NOT NULL,
  `APPLICANTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblapplicant_workexperience`
--

INSERT INTO `tblapplicant_workexperience` (`WORK_EXPERIENCE_ID`, `WORK_TITLE`, `FIELD`, `WORK_YEAR`, `YEAR_COUNT`, `COMPANY_NAME`, `WORK_DESCRIPTION`, `APPLICANTID`) VALUES
(33, 'Internship', 'Business, management and administration', '2017 - 2017', 0, 'STI College Global City', '', 63),
(34, 'Internship', 'Science and technology', '2016 - 2017', 1, 'STI College Global City', '', 64),
(48, 'Web developer', 'Science and technology', '2019 - 2021', 2, 'sample1', '', 83),
(49, 'Internship', 'Science and technology', '2010 - 2021', 11, 'sample', '', 83),
(50, 'Internship', 'Business, management and administration', '2019 - 2021', 2, 'JonnelJonnel', 'ASDASD', 63);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CATEGORYID` int(11) NOT NULL,
  `CATEGORY` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`CATEGORYID`, `CATEGORY`) VALUES
(1, 'Services'),
(2, 'Merchandising'),
(3, 'Manufacturing'),
(7, 'Manufacturingss');

-- --------------------------------------------------------

--
-- Table structure for table `tblcertificate`
--

CREATE TABLE `tblcertificate` (
  `CERTIFICATE_ID` int(11) NOT NULL,
  `CERTIFICATE_NAME` varchar(500) NOT NULL,
  `ORGANIZATION` varchar(250) NOT NULL,
  `ISSUE_DATE` varchar(90) NOT NULL,
  `APPLICANTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcertificate`
--

INSERT INTO `tblcertificate` (`CERTIFICATE_ID`, `CERTIFICATE_NAME`, `ORGANIZATION`, `ISSUE_DATE`, `APPLICANTID`) VALUES
(5, 'Microsoft certified network associate security', 'asd', '2019 - 2021', 63);

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacter_reference`
--

CREATE TABLE `tblcharacter_reference` (
  `REFERENCE_ID` int(11) NOT NULL,
  `NAME` varchar(90) NOT NULL,
  `RELATIONSHIP` varchar(250) NOT NULL,
  `CONTACT` varchar(90) NOT NULL,
  `APPLICANTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcharacter_reference`
--

INSERT INTO `tblcharacter_reference` (`REFERENCE_ID`, `NAME`, `RELATIONSHIP`, `CONTACT`, `APPLICANTID`) VALUES
(8, 'Jesther M Costinar', 'cositnar', '09218989341', 67),
(9, 'John Kenneth Maghanoy Costinar', 'John Kenneth Maghanoy Costinar', '09218989341', 67),
(10, 'sample M sample', 'asdasd', '09123456789', 68),
(11, 'sample M sample', 'sample', '09218989341', 80),
(12, 'kasmir Maghanoy kasmir', 'AAAAaaaaaaaaa1', '09218989341', 81),
(13, 'sample M sample', 'AAAAaaaaaaaaa1', '09218989341', 82),
(14, 'sample M sample', 'Teacher', '09218989341', 83),
(15, 'Java MTA', 'sample', '09218989341', 63);

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `COMPANYID` int(50) NOT NULL,
  `COMPANY_NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `COMPANY_IMAGE` varchar(2048) NOT NULL,
  `LINK_NAME` varchar(250) NOT NULL,
  `LINK` varchar(1000) NOT NULL,
  `CATEGORYID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`COMPANYID`, `COMPANY_NAME`, `EMAIL`, `COMPANY_IMAGE`, `LINK_NAME`, `LINK`, `CATEGORYID`) VALUES
(8, 'Chambee Tea Shop', 'chambee.teashop@gmail.com', 'chambee_logo.png', 'Chambee Tea Shop', 'https://chambee.com/', 2),
(9, 'Wonuts Donut', 'WonutsDonut@gmail.com', 'wonuts_donuts_logo.jpg', 'Wonuts Donuts', 'https://www.facebook.com/WonutsDonutsOfficialPage', 3),
(10, '7101 Films and Events', 'filmsandevents@gmail.com', 'fandevents_logo.png', 'Film and events', 'https://www.facebook.com/jeestheeer', 1),
(12, 'The Codies', 'accura.find1@gmail.com', 'accurafind_logo.png', 'accurafind', 'https://accura-find.com/', 1),
(13, 'ICO Family Enterprise Inc.', 'ico_family87@yahoo.com', 'ICO.jpg', 'ICO Family Enterprise', 'https://www.facebook.com/ICOFamilyEnterprisesInc', 2),
(14, 'MV’Works (Motorcycle Parts)', 'MVWorks@gmail.com', 'MVWorks.jpg', 'MV’Works', 'https://www.facebook.com/AutoDriveMVworks', 1),
(15, 'EMSON PLASTIC CORP.', 'EMSON.PLASTIC@gmail.com', 'epson.png', 'EMSON ARWIN', 'http://emsonarwin.ph/', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbldecision`
--

CREATE TABLE `tbldecision` (
  `DECISIONID` int(11) NOT NULL,
  `JOBID` int(11) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL,
  `AGE_SCORE` int(11) NOT NULL,
  `PERCENTAGE` int(100) NOT NULL,
  `EXPERIENCE_SCORE` int(11) NOT NULL,
  `EDUCATIONAL_SCORE` int(11) NOT NULL,
  `SKILLS_SCORE` int(11) NOT NULL,
  `AGE_STATUS` varchar(500) NOT NULL,
  `EXPERIENCE_STATUS` varchar(500) NOT NULL,
  `EDUCATIONAL_STATUS` varchar(500) NOT NULL,
  `SKILLS_SET_STATUS` varchar(500) NOT NULL,
  `VERIFY_LEVEL` int(11) NOT NULL,
  `REMARK_STATUS` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbldecision`
--

INSERT INTO `tbldecision` (`DECISIONID`, `JOBID`, `COMPANYID`, `APPLICANTID`, `AGE_SCORE`, `PERCENTAGE`, `EXPERIENCE_SCORE`, `EDUCATIONAL_SCORE`, `SKILLS_SCORE`, `AGE_STATUS`, `EXPERIENCE_STATUS`, `EDUCATIONAL_STATUS`, `SKILLS_SET_STATUS`, `VERIFY_LEVEL`, `REMARK_STATUS`) VALUES
(116, 7, 8, 63, 5, 60, 10, 20, 20, '<strong><mark>Score: 5%</mark></strong><br><br> • <strong>Job age qualification:</strong> 18 - 30 years old<br>• <strong>Applicant age:</strong> 40 years old.', '<strong><mark>Score: 10%</mark></strong><br><br> •  <strong>Work Experience qualification in field of Science and technology: </strong>Entry Level<br>• <strong>Applicant work experience in field of Science and technology: </strong>No work experience in this field', '<strong><mark>Score: 20%</mark></strong><br><br>• <strong>Job Education qualification: </strong>Bachelors Degree<br>• <strong>Applicant education: </strong>Bachelors Degree', '<strong><br>Skills Requirement: <br></strong>Microsoft Office skills, Project management skills, <br><br><strong>Applicant points per skill: </strong>Expert(5points), Demonstrating(3points), <br><strong>Total: </strong> 8 out of 10', 2, '( <mark><strong>Fully Verified</strong></mark> )The applicant did not met the age requirement.<br><br>•  S/he not met the work experience requirement, S/he only have No work experience in this field experience in working.<br><br>•  S/he also met the educational degree need for the company,  got Bachelors Degree in education <br><br>• Applicant has certificate. additional 5<br><br><strong>Total Percentage Score: <mark> 60%</mark></strong>');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `EMPLOYEEID` int(11) NOT NULL,
  `FNAME` varchar(90) NOT NULL,
  `LNAME` varchar(90) NOT NULL,
  `MNAME` varchar(90) NOT NULL,
  `ADDRESS` varchar(500) NOT NULL,
  `CITY` varchar(90) NOT NULL,
  `STATE` varchar(90) NOT NULL,
  `ZIP` int(90) NOT NULL,
  `CONTACTNO` varchar(90) NOT NULL,
  `EMAIL` varchar(90) NOT NULL,
  `POSITION` varchar(90) NOT NULL,
  `EMPLOYMENT` varchar(250) NOT NULL,
  `OBJECTIVE` varchar(1000) NOT NULL,
  `DATEHIRED` date NOT NULL,
  `COMPANYID` int(90) NOT NULL,
  `APPLICANTID` int(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`EMPLOYEEID`, `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `CITY`, `STATE`, `ZIP`, `CONTACTNO`, `EMAIL`, `POSITION`, `EMPLOYMENT`, `OBJECTIVE`, `DATEHIRED`, `COMPANYID`, `APPLICANTID`) VALUES
(22, 'Alyssa', 'Mariano', 'A', 'Blk 1 Lot 3 Lontoc St, Sanga Extension, Calzada', 'Pasig City', 'National Capital Region (NCR)', 1730, '09218989341', 'alyssa.mariano@my.jru.edu', 'Waiter', 'Probationary Employment', 'marianomariano', '2021-11-21', 8, 65),
(24, 'Jesther', 'Costinar', 'M', 'Blk 1 Lot 3 Lontoc St, Sanga Extension, Calzada', ' Taguig City', 'Metro Manila', 1630, '09218989341', 'jesther.costinar@my.jru.edu', 'Waiter', 'Probationary Employment', 'To secure a challenging position in a reputable organization to expand my learnings, knowledge, and skills.\r\nSecure a responsible career opportunity to fully utilize my training and skills, while making a significant contribution to the success of the company.', '2021-11-25', 8, 63);

-- --------------------------------------------------------

--
-- Table structure for table `tbljob`
--

CREATE TABLE `tbljob` (
  `JOBID` int(11) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `OCCUPATION_TITLE` varchar(250) NOT NULL,
  `JOB_FIELD` varchar(300) NOT NULL,
  `LOCATION` varchar(250) NOT NULL,
  `STATUS` varchar(90) NOT NULL,
  `SALARY_FROM` double NOT NULL,
  `SALARY_TO` double NOT NULL,
  `WORK_EXPERIENCE` varchar(250) NOT NULL,
  `AGE_FROM` int(11) NOT NULL,
  `AGE_TO` int(11) NOT NULL,
  `SKILLS_LIST` varchar(512) NOT NULL,
  `DESCRIPTION` varchar(1048) NOT NULL,
  `PREFERED_SEX` varchar(30) NOT NULL,
  `EDUCATIONAL` varchar(90) NOT NULL,
  `REMARKS` varchar(90) NOT NULL,
  `DATEPOSTED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbljob`
--

INSERT INTO `tbljob` (`JOBID`, `COMPANYID`, `OCCUPATION_TITLE`, `JOB_FIELD`, `LOCATION`, `STATUS`, `SALARY_FROM`, `SALARY_TO`, `WORK_EXPERIENCE`, `AGE_FROM`, `AGE_TO`, `SKILLS_LIST`, `DESCRIPTION`, `PREFERED_SEX`, `EDUCATIONAL`, `REMARKS`, `DATEPOSTED`) VALUES
(7, 8, 'Waiter', 'Science and technology', 'Taguig City', 'Part Time', 18000, 30000, 'Entry Level', 18, 30, 'Microsoft Office skills,Project management skills', 'responsibilities include greeting and serving customers, providing detailed information on menus, multi-tasking various front-of-the-house duties and collecting the bill.', 'Female', 'Bachelors Degree', 'On going', '2021-11-10'),
(8, 8, 'sample', 'Architecture and engineering', 'Taguig City', 'Part Time', 123123, 12312, 'Mid Level', 18, 21, 'Computer skills', 'asd', 'Male', 'High School Degree', 'On going', '2021-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobregistration`
--

CREATE TABLE `tbljobregistration` (
  `REGISTRATIONID` int(11) NOT NULL,
  `APPLICANT` varchar(90) NOT NULL,
  `REGISTRATION_DATE` date NOT NULL,
  `INTERVIEW_SCORE` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `JOBID` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL,
  `DECISIONID` int(11) NOT NULL,
  `REMARKS` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbljobregistration`
--

INSERT INTO `tbljobregistration` (`REGISTRATIONID`, `APPLICANT`, `REGISTRATION_DATE`, `INTERVIEW_SCORE`, `STATUS`, `COMPANYID`, `JOBID`, `APPLICANTID`, `DECISIONID`, `REMARKS`) VALUES
(116, 'Costinar, Jesther M.', '2021-11-04', 10, 'Pending', 8, 7, 63, 116, 'Congratulations! You have been hired; please see below for additional company requirements that you need to accomplish: NBI Clearance,  . You can start in November 25, 2021. We are excited to work with you, and Welcome to the company!');

-- --------------------------------------------------------

--
-- Table structure for table `tbljob_requirements`
--

CREATE TABLE `tbljob_requirements` (
  `REQUIREMENTS_ID` int(90) NOT NULL,
  `FILE_DESCRIPTION` varchar(250) NOT NULL,
  `FILE_NAME` varchar(2048) NOT NULL,
  `APPLICANTID` int(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblrating`
--

CREATE TABLE `tblrating` (
  `RATINGID` int(11) NOT NULL,
  `RATING` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblskills`
--

CREATE TABLE `tblskills` (
  `ID` int(11) NOT NULL,
  `SKILLS` varchar(350) NOT NULL,
  `SKILLS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblskills`
--

INSERT INTO `tblskills` (`ID`, `SKILLS`, `SKILLS_ID`) VALUES
(13, 'Microsoft Office skills', 7),
(14, 'Project management skills', 7),
(15, 'Computer skills', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `USERID` int(11) NOT NULL,
  `NAME` varchar(90) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `COMPANYID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `NAME`, `USERNAME`, `EMAIL`, `PASSWORD`, `ROLE`, `COMPANYID`) VALUES
(4, 'Char Angel Gonzales', 'Reyn', 'chambeeteashop493@gmail.com', '1c1b9c43985f26043c67b7bf4be43cced72630a8', 'Company Admin', 8),
(5, 'Accurafind Administrator', 'Accurafind', 'accura.find1@gmail.com', '90eded0a7bec91de7a5107ed7c7c8fa2790bd0a3', 'Super Admin', 12),
(6, 'Ghen Jopson', 'Ghen', 'fandevents7101@gmail.com', 'ce9bb0511a00cf68ac3e251e1bda156e0a60ef1f', 'Company Admin', 10),
(8, 'Alyssa Denise Mariano', 'Alyssa', 'alyssa.mariano@my.jru.edu', '3e24a153df31a6f3a85a46a91b241d90e0681edc', 'Company Admin', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblverification`
--

CREATE TABLE `tblverification` (
  `VERIFICATION_ID` int(11) NOT NULL,
  `FILE_DESCRIPTION` varchar(500) NOT NULL,
  `FILE_NAME` varchar(2048) NOT NULL,
  `DATE_SUBMIT` date NOT NULL,
  `STATUS` varchar(90) NOT NULL,
  `APPLICANTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblverification`
--

INSERT INTO `tblverification` (`VERIFICATION_ID`, `FILE_DESCRIPTION`, `FILE_NAME`, `DATE_SUBMIT`, `STATUS`, `APPLICANTID`) VALUES
(26, 'Costinar PRC ID', 'AKO.jpg', '2021-11-17', 'Completed', 63);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `LOG_ID` int(11) NOT NULL,
  `NAME` varchar(90) NOT NULL,
  `LOG_TIME` datetime NOT NULL,
  `ACTIVITY` varchar(200) NOT NULL,
  `ROLE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`LOG_ID`, `NAME`, `LOG_TIME`, `ACTIVITY`, `ROLE`) VALUES
(50, 'Accurafind Administrator', '2021-11-04 14:00:59', 'login', 'Super Admin'),
(51, 'Char Angel Gonzales', '2021-11-04 14:08:00', 'login', 'Company Admin'),
(52, 'Char Angel Gonzales', '2021-11-04 14:09:15', 'Add job', 'Company Admin'),
(53, 'Char Angel Gonzales', '2021-11-04 14:10:34', 'Edit job', 'Company Admin'),
(54, 'Char Angel Gonzales', '2021-11-04 14:12:54', 'Add job', 'Company Admin'),
(55, 'Accurafind Administrator', '2021-11-04 14:13:34', 'login', 'Super Admin'),
(56, 'Char Angel Gonzales', '2021-11-04 14:16:09', 'login', 'Company Admin'),
(57, 'Accurafind Administrator', '2021-11-04 14:17:17', 'login', 'Super Admin'),
(58, 'Char Angel Gonzales', '2021-11-04 14:26:10', 'login', 'Company Admin'),
(59, 'Char Angel Gonzales', '2021-11-04 14:29:42', 'Rate Employee', 'Company Admin'),
(60, 'Char Angel Gonzales', '2021-11-04 14:30:06', 'Remomve Employee', 'Company Admin'),
(61, 'Costinar, Jesther M.', '2021-11-04 14:34:47', '', 'Applicant'),
(62, 'Char Angel Gonzales', '2021-11-04 14:35:26', 'login', 'Company Admin'),
(63, 'Char Angel Gonzales', '2021-11-04 14:36:49', 'Modify Applicantion Status', 'Company Admin'),
(64, 'Char Angel Gonzales', '2021-11-04 14:37:48', 'Set Interview Score for the applicant', 'Company Admin'),
(65, 'Char Angel Gonzales', '2021-11-04 14:39:50', 'Modify Application Status', 'Company Admin'),
(66, 'Costinar, Jesther M.', '2021-11-04 14:42:13', 'applicant login', 'Applicant'),
(67, 'Costinar, Jesther M.', '2021-11-04 15:14:46', 'applicant login', 'Applicant'),
(68, 'Costinar, Jesther M.', '2021-11-04 15:15:23', 'applicant profile update', 'Applicant'),
(69, 'Accurafind Administrator', '2021-11-04 15:15:48', 'login', 'Super Admin'),
(70, 'Accurafind Administrator', '2021-11-05 04:39:44', 'login', 'Super Admin'),
(71, 'sample, sample .', '2021-11-05 09:19:03', 'applicant login', 'Applicant'),
(72, 'sample, sample .', '2021-11-05 09:47:38', 'Applicant inserting work experience', 'Applicant'),
(73, 'Accurafind Administrator', '2021-11-05 10:03:09', 'login', 'Super Admin'),
(74, 'Char Angel Gonzales', '2021-11-05 11:01:21', 'login', 'Company Admin'),
(75, 'Accurafind Administrator', '2021-11-05 11:02:01', 'login', 'Super Admin'),
(76, 'Char Angel Gonzales', '2021-11-05 11:20:12', 'login', 'Company Admin'),
(77, 'Char Angel Gonzales', '2021-11-05 11:37:52', 'Edit job', 'Company Admin'),
(78, 'Costinar, Jestherrr M.', '2021-11-06 04:53:41', 'applicant login', 'Applicant'),
(79, 'Char Angel Gonzales', '2021-11-06 13:03:04', 'login', 'Company Admin'),
(80, 'Accurafind Administrator', '2021-11-06 13:44:18', 'login', 'Super Admin'),
(81, 'Char Angel Gonzales', '2021-11-06 14:10:16', 'Login', 'Company Admin'),
(82, 'Accurafind Administrator', '2021-11-06 14:11:05', 'Login', 'Super Admin'),
(83, 'Char Angel Gonzales', '2021-11-06 14:15:00', 'Login', 'Company Admin'),
(84, 'Accurafind Administrator', '2021-11-06 14:20:33', 'Login', 'Super Admin'),
(85, 'Accurafind Administrator', '2021-11-06 14:20:54', 'Login', 'Super Admin'),
(86, 'Ghen Jopson', '2021-11-06 14:22:51', 'Login', 'Company Admin'),
(87, 'Ghen Jopson', '2021-11-06 14:24:55', 'Add job', 'Company Admin'),
(88, 'Costinar, Jestherrr M.', '2021-11-06 14:25:04', 'Login', 'Applicant'),
(89, 'Char Angel Gonzales', '2021-11-06 14:34:30', 'Login', 'Company Admin'),
(90, 'Char Angel Gonzales', '2021-11-06 14:34:36', 'Edit job', 'Company Admin'),
(91, 'Costinar, Jestherrr M.', '2021-11-06 14:39:29', 'Login', 'Applicant'),
(92, 'Costinar, Jestherrr M.', '2021-11-06 14:40:52', 'Apply Job', 'Applicant'),
(93, 'Ghen Jopson', '2021-11-06 14:41:23', 'Login', 'Company Admin'),
(94, 'Ghen Jopson', '2021-11-06 14:41:44', 'Modify Application Status', 'Company Admin'),
(95, 'Ghen Jopson', '2021-11-06 14:41:51', 'Set Interview Score', 'Company Admin'),
(96, 'Ghen Jopson', '2021-11-06 14:43:05', 'Modify Application Status', 'Company Admin'),
(97, 'Ghen Jopson', '2021-11-06 14:50:49', 'Remove Employee', 'Company Admin'),
(98, 'Char Angel Gonzales', '2021-11-06 14:50:56', 'Login', 'Company Admin'),
(99, 'Char Angel Gonzales', '2021-11-06 14:50:59', 'Remove Employee', 'Company Admin'),
(100, 'Costinar, Jestherrr M.', '2021-11-06 14:53:02', 'Login', 'Applicant'),
(101, 'Costinar, Jestherrr M.', '2021-11-06 14:53:41', 'Apply Job', 'Applicant'),
(102, 'Costinar, Jestherrr M.', '2021-11-06 14:53:47', 'Apply Job', 'Applicant'),
(103, 'Char Angel Gonzales', '2021-11-06 14:54:13', 'Modify Application Status', 'Company Admin'),
(104, 'Char Angel Gonzales', '2021-11-06 14:54:22', 'Modify Application Status', 'Company Admin'),
(105, 'Char Angel Gonzales', '2021-11-06 14:54:32', 'Remove Employee', 'Company Admin'),
(106, 'Costinar, Jestherrr M.', '2021-11-06 14:58:08', 'Apply Job', 'Applicant'),
(107, 'Char Angel Gonzales', '2021-11-06 14:58:18', 'Modify Application Status', 'Company Admin'),
(108, 'Char Angel Gonzales', '2021-11-06 14:58:23', 'Modify Application Status', 'Company Admin'),
(109, 'Char Angel Gonzales', '2021-11-06 14:58:46', 'Remove Employee', 'Company Admin'),
(110, 'Costinar, Jestherrr M.', '2021-11-06 15:01:50', 'Apply Job', 'Applicant'),
(111, 'Char Angel Gonzales', '2021-11-06 15:02:08', 'Modify Application Status', 'Company Admin'),
(112, 'Char Angel Gonzales', '2021-11-06 15:02:14', 'Modify Application Status', 'Company Admin'),
(113, 'Char Angel Gonzales', '2021-11-06 15:02:26', 'Remove Employee', 'Company Admin'),
(114, 'Costinar, Jestherrr M.', '2021-11-06 15:07:02', 'Apply Job', 'Applicant'),
(115, 'Char Angel Gonzales', '2021-11-06 15:07:10', 'Modify Application Status', 'Company Admin'),
(116, 'Char Angel Gonzales', '2021-11-06 15:07:21', 'Modify Application Status', 'Company Admin'),
(117, 'Char Angel Gonzales', '2021-11-06 15:09:49', 'Remove Employee', 'Company Admin'),
(118, 'Costinar, Jestherrr M.', '2021-11-06 15:10:22', 'Apply Job', 'Applicant'),
(119, 'Costinar, Jestherrr M.', '2021-11-06 15:10:28', 'Apply Job', 'Applicant'),
(120, 'Char Angel Gonzales', '2021-11-06 15:11:04', 'Modify Application Status', 'Company Admin'),
(121, 'Char Angel Gonzales', '2021-11-06 15:11:11', 'Modify Application Status', 'Company Admin'),
(122, 'Ghen Jopson', '2021-11-06 15:11:44', 'Login', 'Company Admin'),
(123, 'Ghen Jopson', '2021-11-06 15:11:52', 'Modify Application Status', 'Company Admin'),
(124, 'Ghen Jopson', '2021-11-06 15:11:56', 'Modify Application Status', 'Company Admin'),
(125, 'Ghen Jopson', '2021-11-06 15:14:24', 'Remove Employee', 'Company Admin'),
(126, 'Costinar, Jestherrr M.', '2021-11-06 15:16:08', 'Login', 'Applicant'),
(127, 'Ghen Jopson', '2021-11-06 15:17:03', 'Add job', 'Company Admin'),
(128, 'Costinar, Jestherrr M.', '2021-11-06 15:17:16', 'Apply Job', 'Applicant'),
(129, 'Ghen Jopson', '2021-11-06 15:17:24', 'Modify Application Status', 'Company Admin'),
(130, 'Ghen Jopson', '2021-11-06 15:17:29', 'Modify Application Status', 'Company Admin'),
(131, 'Ghen Jopson', '2021-11-06 15:18:38', 'Remove Employee', 'Company Admin'),
(132, 'Char Angel Gonzales', '2021-11-06 15:18:58', 'Login', 'Company Admin'),
(133, 'Char Angel Gonzales', '2021-11-06 15:19:01', 'Remove Employee', 'Company Admin'),
(134, 'Costinar, Jestherrr M.', '2021-11-06 15:19:38', 'Login', 'Applicant'),
(135, 'Costinar, Jestherrr M.', '2021-11-06 15:19:51', 'Apply Job', 'Applicant'),
(136, 'Costinar, Jestherrr M.', '2021-11-06 15:20:00', 'Apply Job', 'Applicant'),
(137, 'Char Angel Gonzales', '2021-11-06 15:20:26', 'Modify Application Status', 'Company Admin'),
(138, 'Char Angel Gonzales', '2021-11-06 15:20:33', 'Modify Application Status', 'Company Admin'),
(139, 'Ghen Jopson', '2021-11-06 15:20:43', 'Login', 'Company Admin'),
(140, 'Ghen Jopson', '2021-11-06 15:20:51', 'Modify Application Status', 'Company Admin'),
(141, 'Costinar, Jestherrr M.', '2021-11-06 15:21:42', 'Login', 'Applicant'),
(142, 'Ghen Jopson', '2021-11-06 15:22:14', 'Modify Application Status', 'Company Admin'),
(143, 'Ghen Jopson', '2021-11-06 15:22:34', 'Remove Employee', 'Company Admin'),
(144, 'Char Angel Gonzales', '2021-11-06 15:22:44', 'Login', 'Company Admin'),
(145, 'Char Angel Gonzales', '2021-11-06 15:22:48', 'Remove Employee', 'Company Admin'),
(146, 'Accurafind Administrator', '2021-11-07 03:37:08', 'Login', 'Super Admin'),
(147, 'Accurafind Administrator', '2021-11-08 03:59:04', 'Login', 'Super Admin'),
(148, 'Accurafind Administrator', '2021-11-08 11:15:35', 'Login', 'Super Admin'),
(149, 'Char Angel Gonzales', '2021-11-08 17:05:33', 'Login', 'Company Admin'),
(150, 'Costinar, Jestherrr M.', '2021-11-08 14:52:15', 'Login', 'Applicant'),
(151, 'Costinar, Jestherrr M.', '2021-11-08 15:05:02', 'Login', 'Applicant'),
(152, 'Costinar, Jestherrr M.', '2021-11-08 15:13:19', 'Login', 'Applicant'),
(153, 'Costinar, Jestherrr M.', '2021-11-08 16:00:20', 'Adding Certificate', 'Applicant'),
(154, 'Costinar, Jestherrr M.', '2021-11-08 16:01:41', 'Adding Certificate', 'Applicant'),
(155, 'Costinar, Jestherrr M.', '2021-11-08 16:02:51', 'Adding Certificate', 'Applicant'),
(156, 'Costinar, Jestherrr M.', '2021-11-08 16:06:18', 'Adding Certificate', 'Applicant'),
(157, 'Char Angel Gonzales', '2021-11-08 23:06:39', 'Login', 'Company Admin'),
(158, 'Costinar, Jestherrr M.', '2021-11-08 16:07:22', 'Apply Job', 'Applicant'),
(159, 'Costinar, Jestherrr M.', '2021-11-08 16:11:55', 'Adding Certificate', 'Applicant'),
(160, 'sample, sample M.', '2021-11-09 14:31:29', 'Login', 'Applicant'),
(161, 'sample, sample M.', '2021-11-09 15:05:37', 'Login', 'Applicant'),
(162, 'sample, sample M.', '2021-11-09 15:07:02', 'Login', 'Applicant'),
(163, 'sample, sample M.', '2021-11-09 15:07:47', 'Apply Job', 'Applicant'),
(164, 'sample, sample M.', '2021-11-09 15:08:11', 'Apply Job', 'Applicant'),
(165, 'sample, sample M.', '2021-11-09 15:08:51', 'Apply Job', 'Applicant'),
(166, 'sample, sample M.', '2021-11-09 15:11:39', 'Login', 'Applicant'),
(167, 'sample, sample M.', '2021-11-09 15:17:41', 'Login', 'Applicant'),
(168, 'sample, sample M.', '2021-11-09 15:42:38', 'Login', 'Applicant'),
(169, 'Char Angel Gonzales', '2021-11-09 22:43:54', 'Login', 'Company Admin'),
(170, 'Char Angel Gonzales', '2021-11-09 16:14:59', 'Modify Application Status', 'Company Admin'),
(171, 'Char Angel Gonzales', '2021-11-09 16:18:50', 'Modify Application Status', 'Company Admin'),
(172, 'Char Angel Gonzales', '2021-11-09 16:19:54', 'Set Interview Score', 'Company Admin'),
(173, 'Char Angel Gonzales', '2021-11-09 16:20:13', 'Modify Application Status', 'Company Admin'),
(174, 'Accurafind Administrator', '2021-11-09 23:28:00', 'Login', 'Super Admin'),
(175, 'Char Angel Gonzales', '2021-11-09 23:31:16', 'Login', 'Company Admin'),
(176, 'sample, sample M.', '2021-11-09 16:32:33', 'Login', 'Applicant'),
(177, 'sample, sample M.', '2021-11-09 16:36:53', 'Login', 'Applicant'),
(178, 'sample, sample M.', '2021-11-09 16:36:58', 'Apply Job', 'Applicant'),
(179, 'Char Angel Gonzales', '2021-11-09 23:37:06', 'Login', 'Company Admin'),
(180, 'Char Angel Gonzales', '2021-11-10 00:07:24', 'Login', 'Company Admin'),
(181, 'Accurafind Administrator', '2021-11-10 00:19:39', 'Login', 'Super Admin'),
(182, 'Costinar, Jesther M.', '2021-11-10 04:35:04', 'Login', 'Applicant'),
(183, 'Costinar, Jesther M.', '2021-11-10 05:01:10', 'Login', 'Applicant'),
(184, 'Costinar, Jesther M.', '2021-11-10 05:01:31', 'Apply Job', 'Applicant'),
(185, 'Char Angel Gonzales', '2021-11-10 12:01:58', 'Login', 'Company Admin'),
(186, 'Char Angel Gonzales', '2021-11-10 05:02:52', 'Modify Application Status', 'Company Admin'),
(187, 'Char Angel Gonzales', '2021-11-10 05:05:36', 'Modify Application Status', 'Company Admin'),
(188, 'Char Angel Gonzales', '2021-11-10 05:06:15', 'Modify Application Status', 'Company Admin'),
(189, 'Costinar, Jesther M.', '2021-11-10 05:32:30', 'Login', 'Applicant'),
(190, 'Char Angel Gonzales', '2021-11-10 17:32:49', 'Login', 'Company Admin'),
(191, 'Costinar, Jesther M.', '2021-11-10 10:51:34', 'Login', 'Applicant'),
(192, 'Costinar, Jesther M.', '2021-11-10 10:51:41', 'Apply Job', 'Applicant'),
(193, 'Costinar, Jesther M.', '2021-11-10 10:53:33', 'Apply Job', 'Applicant'),
(194, 'Costinar, Jesther M.', '2021-11-10 10:57:24', 'Apply Job', 'Applicant'),
(195, 'Costinar, Jesther M.', '2021-11-10 11:01:49', 'Apply Job', 'Applicant'),
(196, 'Costinar, Jesther M.', '2021-11-10 11:03:18', 'Apply Job', 'Applicant'),
(197, 'Costinar, Jesther M.', '2021-11-10 11:03:43', 'Apply Job', 'Applicant'),
(198, 'Char Angel Gonzales', '2021-11-10 18:20:20', 'Login', 'Company Admin'),
(199, 'Char Angel Gonzales', '2021-11-10 11:20:37', 'Modify Application Status', 'Company Admin'),
(200, 'Char Angel Gonzales', '2021-11-10 11:28:18', 'Modify Application Status', 'Company Admin'),
(201, 'Char Angel Gonzales', '2021-11-10 11:28:45', 'Modify Application Status', 'Company Admin'),
(202, 'Costinar, Jesther M.', '2021-11-10 11:45:04', 'Login', 'Applicant'),
(203, 'Char Angel Gonzales', '2021-11-10 11:45:34', 'Modify Application Status', 'Company Admin'),
(204, 'Char Angel Gonzales', '2021-11-10 11:46:52', 'Set Interview Score', 'Company Admin'),
(205, 'Char Angel Gonzales', '2021-11-10 11:47:30', 'Modify Application Status', 'Company Admin'),
(206, 'Char Angel Gonzales', '2021-11-10 11:49:36', 'Modify Application Status', 'Company Admin'),
(207, 'Accurafind Administrator', '2021-11-10 18:58:00', 'Login', 'Super Admin'),
(208, 'Char Angel Gonzales', '2021-11-10 19:02:15', 'Login', 'Company Admin'),
(209, 'Costinar 2, Jesther M.', '2021-11-10 12:20:30', 'Login', 'Applicant'),
(210, 'Costinar 2, Jesther M.', '2021-11-10 12:20:37', 'Apply Job', 'Applicant'),
(211, 'Char Angel Gonzales', '2021-11-10 19:20:50', 'Login', 'Company Admin'),
(212, 'Costinar, Jesther M.', '2021-11-10 14:00:46', 'Login', 'Applicant'),
(213, 'Accurafind Administrator', '2021-11-10 21:05:15', 'Login', 'Super Admin'),
(214, 'Accurafind Administrator', '2021-11-10 21:15:11', 'Login', 'Super Admin'),
(215, 'Alyssa Denise Mariano', '2021-11-10 21:18:06', 'Login', 'Company Admin'),
(216, 'Alyssa Denise Mariano', '2021-11-10 14:19:06', 'Add job', 'Company Admin'),
(217, 'Salvador, Evan R.', '2021-11-10 14:21:49', 'Login', 'Applicant'),
(218, 'Salvador, Evan R.', '2021-11-10 14:22:01', 'Apply Job', 'Applicant'),
(219, 'Alyssa Denise Mariano', '2021-11-10 21:22:54', 'Login', 'Company Admin'),
(220, 'Alyssa Denise Mariano', '2021-11-10 14:23:16', 'Modify Application Status', 'Company Admin'),
(221, 'Alyssa Denise Mariano', '2021-11-10 14:24:10', 'Set Interview Score', 'Company Admin'),
(222, 'Alyssa Denise Mariano', '2021-11-10 14:24:27', 'Modify Application Status', 'Company Admin'),
(223, 'Alyssa Denise Mariano', '2021-11-10 14:27:32', 'Modify Application Status', 'Company Admin'),
(224, 'Char Angel Gonzales', '2021-11-10 23:18:19', 'Login', 'Company Admin'),
(225, 'Costinar, Jesther M.', '2021-11-10 16:27:14', 'Login', 'Applicant'),
(226, 'Costinar, Jesther M.', '2021-11-10 16:27:31', 'Adding Certificate', 'Applicant'),
(227, 'Costinar, Jesther M.', '2021-11-10 18:23:47', 'Login', 'Applicant'),
(228, 'Costinar, Jesther M.', '2021-11-10 18:25:16', 'Login', 'Applicant'),
(229, 'Costinar, Jesther M.', '2021-11-10 19:06:25', 'Attached Verification file', 'Applicant'),
(230, 'Costinar, Jesther M.', '2021-11-10 19:06:40', 'Attached Verification file', 'Applicant'),
(231, 'Costinar, Jesther M.', '2021-11-10 19:07:51', 'Attached Verification file', 'Applicant'),
(232, 'Accurafind Administrator', '2021-11-11 02:19:05', 'Login', 'Super Admin'),
(233, 'Costinar, Jesther M.', '2021-11-10 20:39:19', 'Login', 'Applicant'),
(234, 'Costinar, Jesther M.', '2021-11-10 20:39:24', 'Login', 'Applicant'),
(235, 'Accurafind Administrator', '2021-11-11 03:40:03', 'Login', 'Super Admin'),
(236, 'Costinar, Jesther M.', '2021-11-10 20:40:24', 'Login', 'Applicant'),
(237, 'Accurafind Administrator', '2021-11-11 03:44:29', 'Login', 'Super Admin'),
(238, 'Costinar, Jesther M.', '2021-11-10 22:05:25', 'Login', 'Applicant'),
(239, 'Accurafind Administrator', '2021-11-11 10:07:03', 'Login', 'Super Admin'),
(240, 'Accurafind Administrator', '2021-11-11 10:09:20', 'Login', 'Super Admin'),
(241, 'Costinar, Jesther M.', '2021-11-11 03:15:27', 'Login', 'Applicant'),
(242, 'Accurafind Administrator', '2021-11-11 10:24:15', 'Login', 'Super Admin'),
(243, 'Costinar, Jesther M.', '2021-11-11 11:45:09', 'Login', 'Applicant'),
(244, 'Char Angel Gonzales', '2021-11-11 19:00:05', 'Login', 'Company Admin'),
(245, 'Accurafind Administrator', '2021-11-11 19:01:26', 'Login', 'Super Admin'),
(246, 'Costinar, Jesther M.', '2021-11-11 12:10:11', 'Login', 'Applicant'),
(247, 'Costinar, Jesther M.', '2021-11-11 12:10:31', 'Login', 'Applicant'),
(248, 'Costinar, Jesther M.', '2021-11-11 12:13:02', 'Login', 'Applicant'),
(249, 'Accurafind Administrator', '2021-11-11 19:15:57', 'Login', 'Super Admin'),
(250, 'Accurafind Administrator', '2021-11-11 19:22:54', 'Login', 'Super Admin'),
(251, 'Costinar, Jesther M.', '2021-11-11 12:39:03', 'Login', 'Applicant'),
(252, 'Costinar, Jesther M.', '2021-11-11 12:39:41', 'Inserting Education', 'Applicant'),
(253, 'Costinar, Jesther M.', '2021-11-11 12:40:00', 'Adding Work Experience', 'Applicant'),
(254, 'Accurafind Administrator', '2021-11-11 19:40:27', 'Login', 'Super Admin'),
(255, 'Costinar, Jesther M.', '2021-11-11 13:09:43', 'Apply Job', 'Applicant'),
(256, 'Char Angel Gonzales', '2021-11-11 20:09:57', 'Login', 'Company Admin'),
(257, 'Ayson, Jonnel V.', '2021-11-11 13:21:14', 'Login', 'Applicant'),
(258, 'Accurafind Administrator', '2021-11-11 20:23:11', 'Login', 'Super Admin'),
(259, 'Costinar, Jesther M.', '2021-11-11 14:23:39', 'Login', 'Applicant'),
(260, 'Costinar, Jesther M.', '2021-11-11 14:26:57', 'Login', 'Applicant'),
(261, 'Costinar, Jesther M.', '2021-11-11 14:29:25', 'Apply Job', 'Applicant'),
(262, 'Costinar, Jesther M.', '2021-11-11 14:29:33', 'Login', 'Applicant'),
(263, 'Costinar, Jesther M.', '2021-11-11 14:29:52', 'Apply Job', 'Applicant'),
(264, 'Ayson, Jonnel V.', '2021-11-11 14:30:07', 'Login', 'Applicant'),
(265, 'Ayson, Jonnel V.', '2021-11-11 14:30:11', 'Apply Job', 'Applicant'),
(266, 'Accurafind Administrator', '2021-11-11 21:31:13', 'Login', 'Super Admin'),
(267, 'Costinar, Jesther M.', '2021-11-11 14:32:42', 'Login', 'Applicant'),
(268, 'Costinar, Jesther M.', '2021-11-11 14:32:47', 'Apply Job', 'Applicant'),
(269, 'Ayson, Jonnel V.', '2021-11-11 14:33:15', 'Login', 'Applicant'),
(270, 'Ayson, Jonnel V.', '2021-11-11 14:33:20', 'Apply Job', 'Applicant'),
(271, 'Char Angel Gonzales', '2021-11-11 21:33:38', 'Login', 'Company Admin'),
(272, 'Accurafind Administrator', '2021-11-11 21:44:02', 'Login', 'Super Admin'),
(273, 'Accurafind Administrator', '2021-11-11 21:48:14', 'Login', 'Super Admin'),
(274, 'Accurafind Administrator', '2021-11-11 21:49:45', 'Login', 'Super Admin'),
(275, 'Char Angel Gonzales', '2021-11-11 21:51:31', 'Login', 'Company Admin'),
(276, 'Costinar, Jesther M.', '2021-11-11 14:58:42', 'Login', 'Applicant'),
(277, 'Accurafind Administrator', '2021-11-11 22:01:07', 'Login', 'Super Admin'),
(278, 'Costinar, Jesther M.', '2021-11-11 15:10:09', 'Login', 'Applicant'),
(279, 'Costinar, Jesther M.', '2021-11-11 15:13:03', 'Login', 'Applicant'),
(280, 'Costinar, Jesther M.', '2021-11-11 15:14:21', 'Login', 'Applicant'),
(281, 'Costinar, Jesther M.', '2021-11-11 15:15:32', 'Login', 'Applicant'),
(282, 'Costinar, Jesther M.', '2021-11-11 15:17:07', 'Login', 'Applicant'),
(283, 'Costinar, Jesther M.', '2021-11-11 15:20:32', 'Apply Job', 'Applicant'),
(284, 'Costinar, Jesther M.', '2021-11-11 15:20:56', 'Apply Job', 'Applicant'),
(285, 'Char Angel Gonzales', '2021-11-12 16:58:59', 'Login', 'Company Admin'),
(286, 'Ayson, Jonnel V.', '2021-11-12 10:01:03', 'Login', 'Applicant'),
(287, 'Ayson, Jonnel V.', '2021-11-12 10:01:12', 'Apply Job', 'Applicant'),
(288, 'Ayson, Jonnel V.', '2021-11-12 10:03:31', 'Apply Job', 'Applicant'),
(289, 'Ayson, Jonnel V.', '2021-11-12 10:05:57', 'Apply Job', 'Applicant'),
(290, 'Ayson, Jonnel V.', '2021-11-12 10:07:06', 'Apply Job', 'Applicant'),
(291, 'Char Angel Gonzales', '2021-11-12 17:08:17', 'Login', 'Company Admin'),
(292, 'Costinar, Jesther M.', '2021-11-12 10:08:25', 'Login', 'Applicant'),
(293, 'Costinar, Jesther M.', '2021-11-12 10:08:30', 'Apply Job', 'Applicant'),
(294, 'Mariano, Alyssa A.', '2021-11-12 10:26:49', 'Login', 'Applicant'),
(295, 'Mariano, Alyssa A.', '2021-11-12 10:26:56', 'Apply Job', 'Applicant'),
(296, 'Char Angel Gonzales', '2021-11-12 17:27:09', 'Login', 'Company Admin'),
(297, 'Salvador, Evan R.', '2021-11-12 10:41:39', 'Login', 'Applicant'),
(298, 'Salvador, Evan R.', '2021-11-12 10:41:58', 'Apply Job', 'Applicant'),
(299, 'Char Angel Gonzales', '2021-11-12 17:42:09', 'Login', 'Company Admin'),
(300, 'Accurafind Administrator', '2021-11-12 17:43:13', 'Login', 'Super Admin'),
(301, 'Salvador, Evan R.', '2021-11-12 10:43:34', 'Login', 'Applicant'),
(302, 'Char Angel Gonzales', '2021-11-12 17:45:49', 'Login', 'Company Admin'),
(303, 'Salvador, Evan R.', '2021-11-12 10:46:27', 'Login', 'Applicant'),
(304, 'Salvador, Evan R.', '2021-11-12 10:46:39', 'Apply Job', 'Applicant'),
(305, 'Char Angel Gonzales', '2021-11-12 18:01:58', 'Login', 'Company Admin'),
(306, 'Char Angel Gonzales', '2021-11-12 18:05:22', 'Login', 'Company Admin'),
(307, 'Accurafind Administrator', '2021-11-12 18:32:25', 'Login', 'Super Admin'),
(308, 'Char Angel Gonzales', '2021-11-12 18:40:04', 'Login', 'Company Admin'),
(309, 'Accurafind Administrator', '2021-11-12 18:41:16', 'Login', 'Super Admin'),
(310, 'Char Angel Gonzales', '2021-11-12 18:43:31', 'Login', 'Company Admin'),
(311, 'Costinar, Jesther M.', '2021-11-12 11:53:51', 'Login', 'Applicant'),
(312, 'Costinar, Jesther M.', '2021-11-12 12:03:45', 'Login', 'Applicant'),
(313, 'Salvador, Evan R.', '2021-11-12 12:07:56', 'Login', 'Applicant'),
(314, 'Mariano, Alyssa A.', '2021-11-12 12:08:04', 'Login', 'Applicant'),
(315, 'Costinar, Jesther M.', '2021-11-12 12:11:42', 'Login', 'Applicant'),
(316, 'Mariano, Alyssa A.', '2021-11-12 12:12:53', 'Login', 'Applicant'),
(317, 'Mariano, Alyssa A.', '2021-11-12 12:13:12', 'Update Personal Information', 'Applicant'),
(318, 'Mariano, Alyssa A.', '2021-11-12 12:13:33', 'Login', 'Applicant'),
(319, 'Char Angel Gonzales', '2021-11-12 19:43:53', 'Login', 'Company Admin'),
(320, 'Costinar, Jesther M.', '2021-11-12 12:55:39', 'Login', 'Applicant'),
(321, 'Costinar, Jesther M.', '2021-11-12 12:58:43', 'Login', 'Applicant'),
(322, 'Costinar, Jesther M.', '2021-11-12 13:00:45', 'Login', 'Applicant'),
(323, 'Char Angel Gonzales', '2021-11-12 20:02:22', 'Login', 'Company Admin'),
(324, 'Char Angel Gonzales', '2021-11-12 20:03:54', 'Login', 'Company Admin'),
(325, 'Costinar, Jesther M.', '2021-11-12 14:47:17', 'Login', 'Applicant'),
(326, 'Costinar, Jesther M.', '2021-11-12 14:56:05', 'Login', 'Applicant'),
(327, 'Char Angel Gonzales', '2021-11-12 21:57:40', 'Login', 'Company Admin'),
(328, 'Char Angel Gonzales', '2021-11-12 22:02:51', 'Login', 'Company Admin'),
(329, 'Accurafind Administrator', '2021-11-12 22:26:59', 'Login', 'Super Admin'),
(330, 'Costinar, Jesther M.', '2021-11-12 17:01:45', 'Login', 'Applicant'),
(331, 'Costinar, Jesther M.', '2021-11-12 17:04:12', 'Login', 'Applicant'),
(332, 'Costinar, Jesther M.', '2021-11-12 17:06:48', 'Login', 'Applicant'),
(333, 'Accurafind Administrator', '2021-11-13 00:22:41', 'Login', 'Super Admin'),
(334, 'Accurafind Administrator', '2021-11-13 00:28:22', 'Login', 'Super Admin'),
(335, 'Costinar, Jesther M.', '2021-11-13 00:42:30', 'Login', 'Applicant'),
(336, 'Costinar, Jesther M.', '2021-11-13 00:44:17', 'Login', 'Applicant'),
(337, 'Costinar, Jesther M.', '2021-11-13 00:58:00', 'Login', 'Applicant'),
(338, 'Costinar, Jesther M.', '2021-11-13 01:31:29', 'Login', 'Applicant'),
(339, 'Costinar, Jesther M.', '2021-11-13 01:38:55', 'Login', 'Applicant'),
(340, 'Costinar, Jesther M.', '2021-11-13 01:45:13', 'Login', 'Applicant'),
(341, 'Costinar, Jesther M.', '2021-11-13 03:17:59', 'Login', 'Applicant'),
(342, 'Costinar, Jesther M.', '2021-11-13 17:58:27', 'Login', 'Applicant'),
(343, 'Costinar, Jesther M.', '2021-11-13 18:16:41', 'Login', 'Applicant'),
(344, 'Costinar, Jesther M.', '2021-11-13 18:17:03', 'Login', 'Applicant'),
(345, 'Costinar, Jesther M.', '2021-11-13 18:20:24', 'Login', 'Applicant'),
(346, 'Costinar, Jesther M.', '2021-11-13 18:21:25', 'Login', 'Applicant'),
(347, 'Costinar, Jesther M.', '2021-11-13 18:24:58', 'Login', 'Applicant'),
(348, 'Accurafind Administrator', '2021-11-13 18:30:48', 'Login', 'Super Admin'),
(349, 'Costinar, Jesther M.', '2021-11-13 18:33:42', 'Login', 'Applicant'),
(350, 'Costinar, Jesther M.', '2021-11-13 18:52:17', 'Login', 'Applicant'),
(351, 'Ebuenga, Camille F.', '2021-11-13 18:54:53', 'Login', 'Applicant'),
(352, 'Ebuenga, Camille F.', '2021-11-13 18:56:21', 'Login', 'Applicant'),
(353, 'Accurafind Administrator', '2021-11-13 18:56:34', 'Login', 'Super Admin'),
(354, 'Ebuenga, Camille F.', '2021-11-13 18:56:46', 'Login', 'Applicant'),
(355, 'Ebuenga, Camille F.', '2021-11-13 18:57:31', 'Login', 'Applicant'),
(356, 'Accurafind Administrator', '2021-11-13 18:57:59', 'Login', 'Super Admin'),
(357, 'Accurafind Administrator', '2021-11-13 18:58:46', 'Login', 'Super Admin'),
(358, 'Costinar, Jesther M.', '2021-11-13 19:17:41', 'Login', 'Applicant'),
(359, 'Costinar, Jesther M.', '2021-11-13 19:18:35', 'Login', 'Applicant'),
(360, 'Costinar, Jesther M.', '2021-11-13 19:30:07', 'Login', 'Applicant'),
(361, 'Char Angel Gonzales', '2021-11-16 19:52:03', 'Login', 'Company Admin'),
(362, 'Char Angel Gonzales', '2021-11-16 20:22:19', 'Login', 'Company Admin'),
(363, 'Char Angel Gonzales', '2021-11-16 22:16:32', 'Login', 'Company Admin'),
(364, 'Costinar, Jesther M.', '2021-11-16 22:22:00', 'Login', 'Applicant'),
(365, 'Costinar, Jesther M.', '2021-11-16 15:55:36', 'Adding Character Reference/s', 'Applicant'),
(366, 'Costinar, Jesther M.', '2021-11-16 15:58:03', 'Adding Character Reference/s', 'Applicant'),
(367, 'Costinar, Jesther M.', '2021-11-16 15:59:47', 'Adding Character Reference/s', 'Applicant'),
(368, 'Costinar, Jesther M.', '2021-11-16 16:00:35', 'Adding Character Reference/s', 'Applicant'),
(369, 'Costinar, Jesther M.', '2021-11-16 16:01:53', 'Adding Character Reference/s', 'Applicant'),
(370, 'Costinar, Jesther M.', '2021-11-16 23:20:49', 'Apply Job', 'Applicant'),
(371, 'Char Angel Gonzales', '2021-11-16 23:21:30', 'Login', 'Company Admin'),
(372, 'Costinar, Jesther M.', '2021-11-16 16:22:51', 'Adding Character Reference/s', 'Applicant'),
(373, 'Costinar, Jesther M.', '2021-11-16 23:25:10', 'Login', 'Applicant'),
(374, 'Char Angel Gonzales', '2021-11-16 23:26:37', 'Login', 'Company Admin'),
(375, 'Char Angel Gonzales', '2021-11-16 23:26:50', 'Modify Application Status', 'Company Admin'),
(376, 'Char Angel Gonzales', '2021-11-16 23:27:01', 'Modify Application Status', 'Company Admin'),
(377, 'Accurafind Administrator', '2021-11-17 00:49:04', 'Login', 'Super Admin'),
(378, 'Costinar, Jesther M.', '2021-11-17 00:50:57', 'Login', 'Applicant'),
(379, 'Costinar, Jesther M.', '2021-11-17 01:13:00', 'Login', 'Applicant'),
(380, 'Costinar, Jesther M.', '2021-11-17 01:15:10', 'Login', 'Applicant'),
(381, 'Char Angel Gonzales', '2021-11-17 01:16:10', 'Login', 'Company Admin'),
(382, 'Costinar, Jesther M.', '2021-11-17 01:16:27', 'Apply Job', 'Applicant'),
(383, 'Costinar, Jesther M.', '2021-11-17 01:19:30', 'Apply Job', 'Applicant'),
(384, 'Char Angel Gonzales', '2021-11-17 01:20:23', 'Modify Application Status', 'Company Admin'),
(385, 'Costinar, Jesther M.', '2021-11-17 01:23:01', 'Apply Job', 'Applicant'),
(386, 'Char Angel Gonzales', '2021-11-17 01:23:27', 'Modify Application Status', 'Company Admin'),
(387, 'Char Angel Gonzales', '2021-11-17 01:24:28', 'Modify Application Status', 'Company Admin'),
(388, 'Costinar, Jesther M.', '2021-11-17 12:19:17', 'Login', 'Applicant'),
(389, 'Char Angel Gonzales', '2021-11-17 12:48:15', 'Login', 'Company Admin'),
(390, 'Char Angel Gonzales', '2021-11-17 18:01:53', 'Login', 'Company Admin'),
(391, 'Costinar, Jesther M.', '2021-11-17 18:53:20', 'Login', 'Applicant'),
(392, 'Costinar, Jesther M.', '2021-11-17 18:54:35', 'Insert job requirements', 'Applicant'),
(393, 'Costinar, Jesther M.', '2021-11-17 18:56:00', 'Login', 'Applicant'),
(394, 'Accurafind Administrator', '2021-11-17 19:16:20', 'Login', 'Super Admin'),
(395, 'Costinar, Jesther M.', '2021-11-17 19:58:45', 'Login', 'Applicant'),
(396, 'Accurafind Administrator', '2021-11-17 20:08:25', 'Login', 'Super Admin'),
(397, 'Costinar, Jesther M.', '2021-11-17 20:14:11', 'Login', 'Applicant'),
(398, 'Costinar, Jesther M.', '2021-11-17 20:17:45', 'Apply Job', 'Applicant'),
(399, 'Char Angel Gonzales', '2021-11-17 20:18:01', 'Login', 'Company Admin'),
(400, 'Ayson, Jonnel V.', '2021-11-17 20:33:01', 'Login', 'Applicant'),
(401, 'Ayson, Jonnel V.', '2021-11-17 20:33:06', 'Apply Job', 'Applicant'),
(402, 'Char Angel Gonzales', '2021-11-17 20:33:18', 'Login', 'Company Admin'),
(403, 'Mariano, Alyssa A.', '2021-11-17 20:38:06', 'Login', 'Applicant'),
(404, 'Mariano, Alyssa A.', '2021-11-17 20:38:27', 'Apply Job', 'Applicant'),
(405, 'Char Angel Gonzales', '2021-11-17 20:38:38', 'Login', 'Company Admin'),
(406, 'Ebuenga, Camille F.', '2021-11-17 20:45:20', 'Login', 'Applicant'),
(407, 'Ebuenga, Camille F.', '2021-11-17 20:46:31', 'Apply Job', 'Applicant'),
(408, 'Char Angel Gonzales', '2021-11-17 20:46:43', 'Login', 'Company Admin'),
(409, 'Accurafind Administrator', '2021-11-17 21:50:18', 'Login', 'Super Admin'),
(410, 'Char Angel Gonzales', '2021-11-17 23:22:40', 'Login', 'Company Admin'),
(411, 'Char Angel Gonzales', '2021-11-17 23:23:27', 'Login', 'Company Admin'),
(412, 'Char Angel Gonzales', '2021-11-17 23:25:33', 'Login', 'Company Admin'),
(413, 'Accurafind Administrator', '2021-11-17 23:26:30', 'Login', 'Super Admin'),
(414, 'Char Angel Gonzales', '2021-11-17 23:32:30', 'Login', 'Company Admin'),
(415, 'Accurafind Administrator', '2021-11-17 23:34:25', 'Login', 'Super Admin'),
(416, 'Accurafind Administrator', '2021-11-18 00:24:05', 'Login', 'Super Admin'),
(417, 'Accurafind Administrator', '2021-11-18 08:05:13', 'Login', 'Super Admin'),
(418, 'Ghen Jopson', '2021-11-18 08:29:46', 'Login', 'Company Admin'),
(419, 'Accurafind Administrator', '2021-11-21 18:15:22', 'Login', 'Super Admin'),
(420, 'Char Angel Gonzales', '2021-11-21 18:15:32', 'Login', 'Company Admin'),
(421, 'Char Angel Gonzales', '2021-11-21 18:56:43', 'Login', 'Company Admin'),
(422, 'Char Angel Gonzales', '2021-11-21 20:42:31', 'Modify Application Status', 'Company Admin'),
(423, 'Char Angel Gonzales', '2021-11-21 20:42:48', 'Modify Application Status', 'Company Admin'),
(424, 'Char Angel Gonzales', '2021-11-21 21:12:43', 'Generate Report', 'Company Admin'),
(425, 'Char Angel Gonzales', '2021-11-21 21:13:37', 'Generate Report', 'Company Admin'),
(426, 'Char Angel Gonzales', '2021-11-21 21:13:38', 'Generate Report', 'Company Admin'),
(427, 'Char Angel Gonzales', '2021-11-21 21:14:07', 'Generate Report', 'Company Admin'),
(428, 'Char Angel Gonzales', '2021-11-21 21:14:07', 'Generate Report', 'Company Admin'),
(429, 'Char Angel Gonzales', '2021-11-21 21:14:08', 'Generate Report', 'Company Admin'),
(430, 'Char Angel Gonzales', '2021-11-21 21:14:08', 'Generate Report', 'Company Admin'),
(431, 'Char Angel Gonzales', '2021-11-21 21:14:08', 'Generate Report', 'Company Admin'),
(432, 'Char Angel Gonzales', '2021-11-21 23:12:41', 'Login', 'Company Admin'),
(433, 'Char Angel Gonzales', '2021-11-21 23:49:28', 'Modify Application Status', 'Company Admin'),
(434, 'Char Angel Gonzales', '2021-11-22 18:20:02', 'Login', 'Company Admin'),
(435, 'Char Angel Gonzales', '2021-11-22 19:36:17', 'Remove Achieve Applicant', 'Company Admin'),
(436, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(437, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(438, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(439, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(440, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(441, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(442, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(443, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(444, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(445, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(446, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(447, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(448, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(449, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(450, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(451, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(452, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(453, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(454, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(455, 'Char Angel Gonzales', '2021-11-22 19:41:09', 'Remove Achieve Applicant', 'Company Admin'),
(456, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(457, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(458, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(459, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(460, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(461, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(462, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(463, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(464, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(465, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(466, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(467, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(468, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(469, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(470, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(471, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(472, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(473, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(474, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(475, 'Char Angel Gonzales', '2021-11-22 19:41:10', 'Remove Achieve Applicant', 'Company Admin'),
(476, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(477, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(478, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(479, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(480, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(481, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(482, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(483, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(484, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(485, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(486, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(487, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(488, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(489, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(490, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(491, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(492, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(493, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(494, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(495, 'Char Angel Gonzales', '2021-11-22 19:41:15', 'Remove Achieve Applicant', 'Company Admin'),
(496, 'Char Angel Gonzales', '2021-11-22 19:52:16', 'Login', 'Company Admin'),
(497, 'Char Angel Gonzales', '2021-11-22 19:58:31', 'Add job', 'Company Admin'),
(498, 'Char Angel Gonzales', '2021-11-22 20:03:09', 'Edit job', 'Company Admin'),
(499, 'Char Angel Gonzales', '2021-11-22 20:03:16', 'Edit job', 'Company Admin'),
(500, 'Costinar, Jesther M.', '2021-11-22 21:20:00', 'Login', 'Applicant'),
(501, 'Costinar, Jesther M.', '2021-11-22 21:21:09', 'Login', 'Applicant'),
(502, 'Costinar, Jesther M.', '2021-11-22 21:41:09', 'Login', 'Applicant'),
(503, 'Costinar, Jesther M.', '2021-11-22 21:43:16', 'Login', 'Applicant'),
(504, 'sample, sample M.', '2021-11-22 21:47:10', 'Login', 'Applicant'),
(505, 'sample, sample M.', '2021-11-22 21:47:22', 'Login', 'Applicant'),
(506, 'Costinar, Jesther M.', '2021-11-22 21:47:28', 'Login', 'Applicant'),
(507, 'Costinar, Jesther M.', '2021-11-22 21:50:08', 'Login', 'Applicant'),
(508, 'Char Angel Gonzales', '2021-11-22 22:27:41', 'Login', 'Company Admin'),
(509, 'sample, sample M.', '2021-11-22 22:28:09', 'Login', 'Applicant'),
(510, 'Char Angel Gonzales', '2021-11-22 22:38:03', 'Login', 'Company Admin'),
(511, 'sample, sample M.', '2021-11-22 22:54:52', 'Apply Job', 'Applicant'),
(512, 'sample, sample M.', '2021-11-22 22:59:28', 'Apply Job', 'Applicant'),
(513, 'sample, sample M.', '2021-11-22 23:03:46', 'Apply Job', 'Applicant'),
(514, 'sample, sample M.', '2021-11-22 23:08:36', 'Apply Job', 'Applicant'),
(515, 'sample, sample M.', '2021-11-22 23:18:50', 'Apply Job', 'Applicant'),
(516, 'sample, sample M.', '2021-11-22 23:26:41', 'Apply Job', 'Applicant'),
(517, 'sample, sample M.', '2021-11-22 23:31:27', 'Apply Job', 'Applicant'),
(518, 'sample, sample M.', '2021-11-23 00:46:00', 'Apply Job', 'Applicant'),
(519, 'sample, sample M.', '2021-11-23 00:50:28', 'Apply Job', 'Applicant'),
(520, 'sample, sample M.', '2021-11-23 00:51:09', 'Apply Job', 'Applicant'),
(521, 'sample, sample M.', '2021-11-23 00:52:24', 'Apply Job', 'Applicant'),
(522, 'sample, sample M.', '2021-11-23 00:53:50', 'Apply Job', 'Applicant'),
(523, 'sample, sample M.', '2021-11-23 01:01:16', 'Apply Job', 'Applicant'),
(524, 'sample, sample M.', '2021-11-23 01:03:05', 'Apply Job', 'Applicant'),
(525, 'sample, sample M.', '2021-11-23 01:05:40', 'Apply Job', 'Applicant'),
(526, 'sample, sample M.', '2021-11-23 01:06:34', 'Apply Job', 'Applicant'),
(527, 'sample, sample M.', '2021-11-23 01:07:43', 'Apply Job', 'Applicant'),
(528, 'sample, sample M.', '2021-11-23 01:09:05', 'Apply Job', 'Applicant'),
(529, 'sample, sample M.', '2021-11-23 01:31:39', 'Apply Job', 'Applicant'),
(530, 'sample, sample M.', '2021-11-23 01:33:31', 'Apply Job', 'Applicant'),
(531, 'sample, sample M.', '2021-11-23 01:34:39', 'Apply Job', 'Applicant'),
(532, 'sample, sample M.', '2021-11-23 01:37:33', 'Apply Job', 'Applicant'),
(533, 'sample, sample M.', '2021-11-23 01:49:29', 'Apply Job', 'Applicant'),
(534, 'sample, sample M.', '2021-11-23 02:13:56', 'Apply Job', 'Applicant'),
(535, 'sample, sample M.', '2021-11-23 02:25:25', 'Apply Job', 'Applicant'),
(536, 'sample, sample M.', '2021-11-23 02:28:31', 'Apply Job', 'Applicant'),
(537, 'sample, sample M.', '2021-11-23 02:29:30', 'Apply Job', 'Applicant'),
(538, 'sample, sample M.', '2021-11-23 02:59:15', 'Apply Job', 'Applicant'),
(539, 'Char Angel Gonzales', '2021-11-23 03:26:32', 'Remove Achieve Applicant', 'Company Admin'),
(540, 'Char Angel Gonzales', '2021-11-23 03:27:06', 'Remove Achieve Applicant', 'Company Admin'),
(541, 'Costinar, Jesther M.', '2021-11-23 03:27:25', 'Login', 'Applicant'),
(542, 'Costinar, Jesther M.', '2021-11-23 03:30:38', 'Apply Job', 'Applicant'),
(543, 'Char Angel Gonzales', '2021-11-23 03:30:51', 'Login', 'Company Admin'),
(544, 'Costinar, Jesther M.', '2021-11-23 03:33:40', 'Apply Job', 'Applicant'),
(545, 'Costinar, Jesther M.', '2021-11-23 03:37:21', 'Apply Job', 'Applicant'),
(546, 'Costinar, Jesther M.', '2021-11-23 03:39:04', 'Apply Job', 'Applicant'),
(547, 'Costinar, Jesther M.', '2021-11-23 03:46:08', 'Apply Job', 'Applicant'),
(548, 'Costinar, Jesther M.', '2021-11-23 03:46:58', 'Apply Job', 'Applicant'),
(549, 'Costinar, Jesther M.', '2021-11-23 03:47:53', 'Login', 'Applicant'),
(550, 'Costinar, Jesther M.', '2021-11-23 03:47:59', 'Apply Job', 'Applicant'),
(551, 'Char Angel Gonzales', '2021-11-23 03:48:08', 'Login', 'Company Admin'),
(552, 'Char Angel Gonzales', '2021-11-23 18:52:19', 'Login', 'Company Admin'),
(553, 'Costinar, Jesther M.', '2021-11-23 18:54:18', 'Login', 'Applicant'),
(554, 'Costinar, Jesther M.', '2021-11-23 19:07:28', 'Apply Job', 'Applicant'),
(555, 'Costinar, Jesther M.', '2021-11-23 19:08:56', 'Apply Job', 'Applicant'),
(556, 'Costinar, Jesther M.', '2021-11-23 19:53:44', 'Login', 'Applicant'),
(557, 'Costinar, Jesther M.', '2021-11-23 12:56:45', 'Adding Character Reference/s', 'Applicant'),
(558, 'Costinar, Jesther M.', '2021-11-23 19:57:02', 'Login', 'Applicant'),
(559, 'Costinar, Jesther M.', '2021-11-23 13:01:38', 'Adding Certificate', 'Applicant'),
(560, 'Char Angel Gonzales', '2021-11-23 20:03:20', 'Login', 'Company Admin'),
(561, 'Costinar, Jesther M.', '2021-11-23 20:06:54', 'Apply Job', 'Applicant'),
(562, 'Char Angel Gonzales', '2021-11-23 20:47:18', 'Remove Achieve Applicant', 'Company Admin'),
(563, 'Costinar, Jesther M.', '2021-11-23 21:07:14', 'Apply Job', 'Applicant'),
(564, 'Costinar, Jesther M.', '2021-11-23 21:29:12', 'Apply Job', 'Applicant'),
(565, 'Costinar, Jesther M.', '2021-11-23 21:31:23', 'Apply Job', 'Applicant'),
(566, 'Costinar, Jesther M.', '2021-11-23 21:34:02', 'Apply Job', 'Applicant'),
(567, 'Costinar, Jesther M.', '2021-11-23 21:34:56', 'Apply Job', 'Applicant'),
(568, 'Costinar, Jesther M.', '2021-11-23 21:38:38', 'Apply Job', 'Applicant'),
(569, 'Costinar, Jesther M.', '2021-11-23 21:51:08', 'Apply Job', 'Applicant'),
(570, 'Costinar, Jesther M.', '2021-11-23 21:52:04', 'Apply Job', 'Applicant'),
(571, 'Costinar, Jesther M.', '2021-11-23 21:55:21', 'Apply Job', 'Applicant'),
(572, 'Costinar, Jesther M.', '2021-11-23 21:56:11', 'Apply Job', 'Applicant'),
(573, 'Costinar, Jesther M.', '2021-11-23 22:41:11', 'Apply Job', 'Applicant'),
(574, 'Costinar, Jesther M.', '2021-11-23 23:06:27', 'Apply Job', 'Applicant'),
(575, 'Costinar, Jesther M.', '2021-11-23 23:07:12', 'Apply Job', 'Applicant'),
(576, 'Char Angel Gonzales', '2021-11-23 23:25:45', 'Modify Application Status', 'Company Admin'),
(577, 'Costinar, Jesther M.', '2021-11-23 23:44:46', 'Apply Job', 'Applicant'),
(578, 'Costinar, Jesther M.', '2021-11-23 23:53:57', 'Apply Job', 'Applicant'),
(579, 'Costinar, Jesther M.', '2021-11-23 23:56:01', 'Apply Job', 'Applicant'),
(580, 'Char Angel Gonzales', '2021-11-23 23:58:17', 'Modify Application Status', 'Company Admin'),
(581, 'Char Angel Gonzales', '2021-11-24 00:39:51', 'Set Interview Score', 'Company Admin'),
(582, 'Char Angel Gonzales', '2021-11-24 00:57:47', 'Modify Application Status', 'Company Admin'),
(583, 'Char Angel Gonzales', '2021-11-24 01:13:45', 'Modify Application Status', 'Company Admin'),
(584, 'Char Angel Gonzales', '2021-11-24 01:14:36', 'Modify Application Status', 'Company Admin'),
(585, 'Char Angel Gonzales', '2021-11-24 01:19:00', 'Modify Application Status', 'Company Admin'),
(586, 'Char Angel Gonzales', '2021-11-24 01:19:51', 'Modify Application Status', 'Company Admin'),
(587, 'Char Angel Gonzales', '2021-11-24 01:26:53', 'Modify Application Status', 'Company Admin'),
(588, 'Costinar, Jesther M.', '2021-11-24 01:35:13', 'Apply Job', 'Applicant'),
(589, 'Char Angel Gonzales', '2021-11-24 01:35:38', 'Modify Application Status', 'Company Admin'),
(590, 'Char Angel Gonzales', '2021-11-24 01:55:56', 'Modify Application Status', 'Company Admin'),
(591, 'Char Angel Gonzales', '2021-11-24 01:56:06', 'Set Interview Score', 'Company Admin'),
(592, 'Char Angel Gonzales', '2021-11-24 01:56:21', 'Modify Application Status', 'Company Admin'),
(593, 'Char Angel Gonzales', '2021-11-24 01:56:53', 'Modify Application Status', 'Company Admin'),
(594, 'Char Angel Gonzales', '2021-11-24 17:16:39', 'Login', 'Company Admin'),
(595, 'Char Angel Gonzales', '2021-11-24 22:40:26', 'Login', 'Company Admin'),
(596, 'Char Angel Gonzales', '2021-11-25 00:09:22', 'Modify Application Status', 'Company Admin'),
(597, 'Char Angel Gonzales', '2021-11-25 00:10:11', 'Modify Application Status', 'Company Admin'),
(598, 'Char Angel Gonzales', '2021-11-25 00:10:49', 'Modify Application Status', 'Company Admin'),
(599, 'Char Angel Gonzales', '2021-11-25 04:16:58', 'Login', 'Company Admin'),
(600, 'Costinar, Jesther M.', '2021-11-25 05:25:58', 'Login', 'Applicant'),
(601, 'Costinar, Jesther M.', '2021-11-24 22:32:58', 'Adding Work Experience', 'Applicant'),
(602, 'Costinar, Jesther M.', '2021-11-25 06:58:16', 'Login', 'Applicant');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_verificationcode`
--

CREATE TABLE `tbl_verificationcode` (
  `id` int(11) NOT NULL,
  `code` int(8) NOT NULL,
  `email` varchar(250) NOT NULL,
  `verification_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_verificationcode`
--

INSERT INTO `tbl_verificationcode` (`id`, `code`, `email`, `verification_date`) VALUES
(50, 296638, 'jesther.costinar@my.jru.edu', '2021-11-17'),
(51, 341004, 'jonnel.ayson@gmail.com', '2021-11-17'),
(52, 272319, 'alyssa.mariano@my.jru.edu', '2021-11-17'),
(53, 324725, 'camille@gmail.com', '2021-11-17'),
(54, 344802, 'jesther.jc15@gmail.com', '2021-11-20'),
(55, 215172, 'sadasd@gmail.com', '2021-11-22'),
(56, 214974, 'sample@gmail.com', '2021-11-22'),
(57, 322720, 'kasmir@gmail.com', '2021-11-22'),
(58, 156676, 'sample@gmail.com', '2021-11-22'),
(59, 127022, 'sample@gmail.com', '2021-11-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblapplicant`
--
ALTER TABLE `tblapplicant`
  ADD PRIMARY KEY (`APPLICANTID`);

--
-- Indexes for table `tblapplicant_education`
--
ALTER TABLE `tblapplicant_education`
  ADD PRIMARY KEY (`EDUCATION_ID`);

--
-- Indexes for table `tblapplicant_workexperience`
--
ALTER TABLE `tblapplicant_workexperience`
  ADD PRIMARY KEY (`WORK_EXPERIENCE_ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`CATEGORYID`);

--
-- Indexes for table `tblcertificate`
--
ALTER TABLE `tblcertificate`
  ADD PRIMARY KEY (`CERTIFICATE_ID`);

--
-- Indexes for table `tblcharacter_reference`
--
ALTER TABLE `tblcharacter_reference`
  ADD PRIMARY KEY (`REFERENCE_ID`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`COMPANYID`);

--
-- Indexes for table `tbldecision`
--
ALTER TABLE `tbldecision`
  ADD PRIMARY KEY (`DECISIONID`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`EMPLOYEEID`);

--
-- Indexes for table `tbljob`
--
ALTER TABLE `tbljob`
  ADD PRIMARY KEY (`JOBID`);

--
-- Indexes for table `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  ADD PRIMARY KEY (`REGISTRATIONID`);

--
-- Indexes for table `tbljob_requirements`
--
ALTER TABLE `tbljob_requirements`
  ADD PRIMARY KEY (`REQUIREMENTS_ID`);

--
-- Indexes for table `tblrating`
--
ALTER TABLE `tblrating`
  ADD PRIMARY KEY (`RATINGID`);

--
-- Indexes for table `tblskills`
--
ALTER TABLE `tblskills`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `tblverification`
--
ALTER TABLE `tblverification`
  ADD PRIMARY KEY (`VERIFICATION_ID`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`LOG_ID`);

--
-- Indexes for table `tbl_verificationcode`
--
ALTER TABLE `tbl_verificationcode`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblapplicant`
--
ALTER TABLE `tblapplicant`
  MODIFY `APPLICANTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tblapplicant_education`
--
ALTER TABLE `tblapplicant_education`
  MODIFY `EDUCATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tblapplicant_workexperience`
--
ALTER TABLE `tblapplicant_workexperience`
  MODIFY `WORK_EXPERIENCE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CATEGORYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcertificate`
--
ALTER TABLE `tblcertificate`
  MODIFY `CERTIFICATE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcharacter_reference`
--
ALTER TABLE `tblcharacter_reference`
  MODIFY `REFERENCE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `COMPANYID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbldecision`
--
ALTER TABLE `tbldecision`
  MODIFY `DECISIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `EMPLOYEEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbljob`
--
ALTER TABLE `tbljob`
  MODIFY `JOBID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  MODIFY `REGISTRATIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbljob_requirements`
--
ALTER TABLE `tbljob_requirements`
  MODIFY `REQUIREMENTS_ID` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblrating`
--
ALTER TABLE `tblrating`
  MODIFY `RATINGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblskills`
--
ALTER TABLE `tblskills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblverification`
--
ALTER TABLE `tblverification`
  MODIFY `VERIFICATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `LOG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=603;

--
-- AUTO_INCREMENT for table `tbl_verificationcode`
--
ALTER TABLE `tbl_verificationcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblapplicant_education`
--
ALTER TABLE `tblapplicant_education`
  ADD CONSTRAINT `tblapplicant_education_ibfk_1` FOREIGN KEY (`APPLICANTID`) REFERENCES `tblapplicant` (`APPLICANTID`);

--
-- Constraints for table `tblapplicant_workexperience`
--
ALTER TABLE `tblapplicant_workexperience`
  ADD CONSTRAINT `tblapplicant_workexperience_ibfk_1` FOREIGN KEY (`APPLICANTID`) REFERENCES `tblapplicant` (`APPLICANTID`);

--
-- Constraints for table `tblcertificate`
--
ALTER TABLE `tblcertificate`
  ADD CONSTRAINT `tblcertificate_ibfk_1` FOREIGN KEY (`APPLICANTID`) REFERENCES `tblapplicant` (`APPLICANTID`);

--
-- Constraints for table `tblcharacter_reference`
--
ALTER TABLE `tblcharacter_reference`
  ADD CONSTRAINT `tblcharacter_reference_ibfk_1` FOREIGN KEY (`APPLICANTID`) REFERENCES `tblapplicant` (`APPLICANTID`);

--
-- Constraints for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD CONSTRAINT `tblcompany_ibfk_1` FOREIGN KEY (`CATEGORYID`) REFERENCES `tblcategory` (`CATEGORYID`);

--
-- Constraints for table `tbldecision`
--
ALTER TABLE `tbldecision`
  ADD CONSTRAINT `tbldecision_ibfk_1` FOREIGN KEY (`APPLICANTID`) REFERENCES `tblapplicant` (`APPLICANTID`),
  ADD CONSTRAINT `tbldecision_ibfk_2` FOREIGN KEY (`COMPANYID`) REFERENCES `tblcompany` (`COMPANYID`),
  ADD CONSTRAINT `tbldecision_ibfk_3` FOREIGN KEY (`JOBID`) REFERENCES `tbljob` (`JOBID`);

--
-- Constraints for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD CONSTRAINT `tblemployee_ibfk_1` FOREIGN KEY (`COMPANYID`) REFERENCES `tblcompany` (`COMPANYID`),
  ADD CONSTRAINT `tblemployee_ibfk_2` FOREIGN KEY (`APPLICANTID`) REFERENCES `tblapplicant` (`APPLICANTID`);

--
-- Constraints for table `tbljob`
--
ALTER TABLE `tbljob`
  ADD CONSTRAINT `tbljob_ibfk_1` FOREIGN KEY (`COMPANYID`) REFERENCES `tblcompany` (`COMPANYID`);

--
-- Constraints for table `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  ADD CONSTRAINT `tbljobregistration_ibfk_1` FOREIGN KEY (`JOBID`) REFERENCES `tbljob` (`JOBID`),
  ADD CONSTRAINT `tbljobregistration_ibfk_2` FOREIGN KEY (`APPLICANTID`) REFERENCES `tblapplicant` (`APPLICANTID`),
  ADD CONSTRAINT `tbljobregistration_ibfk_3` FOREIGN KEY (`COMPANYID`) REFERENCES `tblcompany` (`COMPANYID`),
  ADD CONSTRAINT `tbljobregistration_ibfk_4` FOREIGN KEY (`DECISIONID`) REFERENCES `tbldecision` (`DECISIONID`);

--
-- Constraints for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD CONSTRAINT `tblusers_ibfk_1` FOREIGN KEY (`COMPANYID`) REFERENCES `tblcompany` (`COMPANYID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
