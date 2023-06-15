-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 14, 2023 at 06:03 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nfc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(33) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_name` varchar(33) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass_word` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` varchar(33) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(33) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`u_id`, `user_id`, `user_name`, `full_name`, `pass_word`, `user_type`, `status`, `update_date`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin', 'super_admin', 'ENABLE', '2024-10-15 00:00:00'),
(133, '533186', '880196840292', 'Rsm Monaem', '710503', 'institute_admin', 'ENABLE', '0000-00-00 00:00:00'),
(134, '410047', '88888888', 'Charity Castillo', '975620', 'institute_admin', 'ENABLE', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `birth_chack`
--

DROP TABLE IF EXISTS `birth_chack`;
CREATE TABLE IF NOT EXISTS `birth_chack` (
  `birth_chack_id` int NOT NULL AUTO_INCREMENT,
  `birth_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`birth_chack_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birth_chack`
--

INSERT INTO `birth_chack` (`birth_chack_id`, `birth_id`) VALUES
(1, '12345678'),
(2, '5555');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `com_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `com_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `com_phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `com_email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `com_web` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `opening` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `twitter` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `google` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `skype` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pinterest` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) NOT NULL,
  `dept_code` varchar(255) NOT NULL,
  `dept_image` text NOT NULL,
  `dept_info` text NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `dept_code`, `dept_image`, `dept_info`) VALUES
(9, 'Markating', 'M-01', 'EINibfFkU1.jpg', 'Debitis maxime ipsum'),
(10, 'Web Development ', 'Web-01', 'z962tN0JME.jpg', 'Web Development ');

-- --------------------------------------------------------

--
-- Table structure for table `measure`
--

DROP TABLE IF EXISTS `measure`;
CREATE TABLE IF NOT EXISTS `measure` (
  `msr_id` int NOT NULL AUTO_INCREMENT,
  `measure_name` varchar(33) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `measure_code` varchar(33) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `procat_id` int DEFAULT NULL,
  `pro_cat_name` varchar(33) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`msr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measure`
--

INSERT INTO `measure` (`msr_id`, `measure_name`, `measure_code`, `procat_id`, `pro_cat_name`) VALUES
(7, 'Packet', 'MSR-475', NULL, NULL),
(8, 'Gram', 'MSR-993', NULL, NULL),
(9, 'KG', 'MSR-376', NULL, NULL),
(10, 'Piece', 'MSR-109', NULL, NULL),
(11, 'ML', 'MSR-815', NULL, NULL),
(13, 'Litter', 'MSR-489', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `news_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `news_sub_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `news_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `news_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_category`, `news_sub_category`, `news_description`, `news_image`) VALUES
(14, 'Cupiditate eum dolor', '2', '3', '', 'MdHN0msZ5g.jpg'),
(5, 'Officia ipsum perfer', '1', '1', 'Voluptas eaque conse', 'CI0f8DLxJl.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `nid_test`
--

DROP TABLE IF EXISTS `nid_test`;
CREATE TABLE IF NOT EXISTS `nid_test` (
  `nid_id` int NOT NULL AUTO_INCREMENT,
  `nid_name` varchar(255) NOT NULL,
  `nid_number` varchar(255) NOT NULL,
  `nid_dob` varchar(255) NOT NULL,
  PRIMARY KEY (`nid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `not_id` int NOT NULL AUTO_INCREMENT,
  `not_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `not_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `not_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `not_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`not_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`not_id`, `not_title`, `not_category`, `not_description`, `not_thumbnail`) VALUES
(4, 'Sunt dolor recusand', 'Voluptatum doloremqu', 'hlw', 'O6xW7wlpJH.jpg'),
(3, 'Sed esse corrupti fdsdsddd', 'Reprehenderit porro', 'hi', 'asnPCr4KcM.jpg'),
(5, 'Sed perferendis aut ', 'Debitis expedita con', '                                                                        Commodo ea ea quam e                                                                ', 'QcrokDT1EW.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `objections`
--

DROP TABLE IF EXISTS `objections`;
CREATE TABLE IF NOT EXISTS `objections` (
  `obj_id` int NOT NULL AUTO_INCREMENT,
  `obj_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `obj_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `obj_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `obj_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`obj_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `objections`
--

INSERT INTO `objections` (`obj_id`, `obj_title`, `obj_category`, `obj_description`, `obj_image`) VALUES
(3, 'Dignissimos aliquid ', 'Pariatur Maiores no444', 'Amet voluptatem hic', 'srEog2Rb3f.jpg'),
(2, 'Dignissimos aliquid ', 'Pariatur Maiores no', 'Amet voluptatem hic', 'Juw1WCEHnN.jpg'),
(4, 'Optio sunt ipsa it', 'Rerum architecto imp444', 'Nostrud velit ea cup', 'Js4kgVIpv3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `slider_id` int NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(255) NOT NULL,
  `slider_image` text NOT NULL,
  `slider_description` longtext NOT NULL,
  `slider_category` varchar(255) NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_image`, `slider_description`, `slider_category`) VALUES
(2, 'Nostrud tempor at to update', 'OsaroVlxIN.jpg', 'Perspiciatis verita', 'In excepteur tempore'),
(3, 'Quos illo impedit p update', 'gtqCWyl4pT.jpg', 'In ut nisi sint aut hello', 'Explicabo Enim aut ');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `st_id` int NOT NULL AUTO_INCREMENT,
  `st_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_date_of_birth` date NOT NULL,
  `st_gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_bg_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_religion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_nid_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_birth_certificate_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_health_condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_inst_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_present_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `st_permanent_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `st_name`, `st_date_of_birth`, `st_gender`, `st_bg_group`, `st_religion`, `st_phone`, `st_nid_no`, `st_birth_certificate_id`, `st_health_condition`, `st_photo`, `st_inst_name`, `st_present_address`, `st_permanent_address`) VALUES
(9, 'Jane Finch', '2006-06-28', 'Female', 'A-', 'Buddha', '+1 (606) 945-8267', 'Do enim facere offic', 'Accusamus rerum eaqu', 'Murphy Oconnor', 'jD06VUb2ul.jpg', 'Kaitlin Bryan', 'Pariatur Voluptates', 'Exercitation excepte'),
(10, 'Charlotte Wyatttt', '1976-05-27', '', '', '', '+1 (127) 151-9324', 'Ab aliquid ipsa iru', 'Aliquip temporibus d', 'Kirk Woodard', 'ljczr571Fs.jpg', 'Medge Estesss', 'Sit corporis vel au', 'Et fugiat ipsam ill'),
(11, 'Kalia Bryan', '1982-09-16', 'Male', 'O+', 'Islam', '+1 (822) 894-8441', 'Sit mollitia mollit ', 'A facilis laborum V', 'Shaine Edwards', 'E4dvAOlCcu.jpg', 'Dana Calhoun', 'Enim perspiciatis c', 'Ab voluptatem ad co'),
(12, 'Cheryl Castaneda', '1980-07-19', 'Female', 'O-', 'Buddha', '+1 (257) 613-2372', 'Iure repudiandae lau', 'Est explicabo Et p', 'Uriah Rosario', 'default.png', 'Dana Calhoun', 'Enim corrupti offic', 'Deserunt eos placea');

-- --------------------------------------------------------

--
-- Table structure for table `trainee`
--

DROP TABLE IF EXISTS `trainee`;
CREATE TABLE IF NOT EXISTS `trainee` (
  `trainee_id` int NOT NULL AUTO_INCREMENT,
  `trainee_name` varchar(255) NOT NULL,
  `trainee_username` varchar(255) NOT NULL,
  `trainee_password` varchar(255) NOT NULL,
  `trainee_name_eng` varchar(255) NOT NULL,
  `trainee_father_name` varchar(255) NOT NULL,
  `trainee_father_name_eng` varchar(255) NOT NULL,
  `trainee_mother_name` varchar(255) NOT NULL,
  `trainee_mother_name_eng` varchar(255) NOT NULL,
  `trainee_dob` varchar(255) NOT NULL,
  `trainee_current_age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `trainee_nid` varchar(255) NOT NULL,
  `trainee_present_address` text NOT NULL,
  `trainee_permanent_address` text NOT NULL,
  `trainee_education` text NOT NULL,
  `trainee_religion` varchar(255) NOT NULL,
  `trainee_gender` varchar(255) NOT NULL,
  `trainee_phone` varchar(255) NOT NULL,
  `trainee_alternate_phone` varchar(255) NOT NULL,
  `trainee_past_training` varchar(255) NOT NULL,
  `trainee_youth_member` varchar(255) NOT NULL,
  `trainee_training_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `trainee_image` text NOT NULL,
  `trainee_history` int NOT NULL,
  `trainee_status` varchar(255) NOT NULL,
  `trainee_course` varchar(255) NOT NULL,
  PRIMARY KEY (`trainee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trainee`
--

INSERT INTO `trainee` (`trainee_id`, `trainee_name`, `trainee_username`, `trainee_password`, `trainee_name_eng`, `trainee_father_name`, `trainee_father_name_eng`, `trainee_mother_name`, `trainee_mother_name_eng`, `trainee_dob`, `trainee_current_age`, `trainee_nid`, `trainee_present_address`, `trainee_permanent_address`, `trainee_education`, `trainee_religion`, `trainee_gender`, `trainee_phone`, `trainee_alternate_phone`, `trainee_past_training`, `trainee_youth_member`, `trainee_training_reason`, `trainee_image`, `trainee_history`, `trainee_status`, `trainee_course`) VALUES
(27, 'Anjolie Klein', '924987', '817549', 'Hedy Padilla', 'Dexter Sykes', 'Bethany Dominguez', 'Leila Haney', 'Quin Dixon', '1981-12-04', 'Martina Mccarthy', '123', 'Commodi quo sed mole', 'Sint maxime laborios', 'Santiago and Heath Associates', 'Buddha', 'Female', '327', '353', 'Tanner Allison Plc', 'Wilkerson and Beasley LLC', 'Nam ut dolorem qui v', 'gZsCOqdSPw.jpg', 0, 'Active', 'Doyle and Aguilar Co'),
(25, 'Anjolie Klein', '924987', '817549', 'Hedy Padilla', 'Dexter Sykes', 'Bethany Dominguez', 'Leila Haney', 'Quin Dixon', '1981-12-04', 'Martina Mccarthy', '123', 'Ullamco mollit nesci', 'Sint maxime laborios', 'Morrison Wilkins Co', 'Islam', 'Male', '327', '353', 'Whitaker and Hines LLC', 'Drake Moss LLC', 'Sint adipisci est ', 'gZsCOqdSPw.jpg', 0, 'Active', 'trainee_course'),
(26, 'Anjolie Klein', '924987', '817549', 'Hedy Padilla', 'Dexter Sykes', 'Bethany Dominguez', 'Leila Haney', 'Quin Dixon', '1981-12-04', 'Martina Mccarthy', '123', 'Esse numquam modi ob', 'Sint maxime laborios', 'Huber and Vaughan Traders', 'Buddha', 'Female', '327', '353', 'Lowe and Lang Co', 'Moore Solis Traders', 'Ipsum dolor quia vol', 'gZsCOqdSPw.jpg', 0, 'Pending', 'Dillard and Goff Traders');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `inst_id` int NOT NULL AUTO_INCREMENT,
  `inst_user_id` int NOT NULL,
  `inst_eiin` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `inst_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `inst_founded` date NOT NULL,
  `inst_board` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `inst_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `inst_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `map_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `github` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `facebook_page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `education` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`inst_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`inst_id`, `inst_user_id`, `inst_eiin`, `inst_name`, `inst_founded`, `inst_board`, `inst_logo`, `cover`, `inst_contact`, `email`, `map_address`, `facebook`, `instagram`, `linkedin`, `github`, `facebook_page`, `whatsapp`, `bio`, `education`) VALUES
(46, 533186, '', 'Rsm Monaem', '0000-00-00', '', 'Knz8pobxh7.jpg', '', '880196840292', 'vrk55@gmail.com', 'Dhaka , Bangladesh', 'https://www.facebook.com/rsmmonaemid', 'https://www.facebook.com/rsmmonaemid', 'https://www.facebook.com/rsmmonaemid', 'https://www.facebook.com/rsmmonaemid', 'https://www.facebook.com/rsmmonaemid', '+8801968402925', 'https://www.facebook.com/rsmmonaemid', 'https://www.facebook.com/rsmmonaemid'),
(47, 410047, '', 'Charity Castillo', '0000-00-00', '', 'ndMNhVY7B8.jpg', '', '88888888', 'dugaqu@mailinator.com', 'Aut nisi doloribus i', 'Magna est nostrud q', 'Consectetur molesti', 'Est vero quibusdam q', 'Veniam vel quod qui', 'Tenetur aut qui dict', '+1 (151) 798-8073', 'Iure quia fugit des', 'A accusantium offici');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
