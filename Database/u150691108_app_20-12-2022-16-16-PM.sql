-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2022 at 10:46 AM
-- Server version: 10.5.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u150691108_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `location_type` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `suburb` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parking` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stairs` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pets` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addon` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `location_type`, `address`, `suburb`, `postcode`, `country`, `parking`, `stairs`, `pets`, `notes`, `uid`, `addon`) VALUES
(1, 'Choose Address', '', '', '', '', '', '', '', '', '', ''),
(29, 'Home', '3 Yileen Court', 'Donvale', '3111', 'Australia', 'Street parking (free)', 'No Stairs', 'Dog(s)', '', '29', '22-08-2022 02:07:30'),
(30, 'Home', '17', 'wavrley', '3695', 'Australia ', 'Street parking (free)', 'No Stairs', 'No pets', '', '28', '22-08-2022 02:41:12'),
(31, 'Office', 'eco station', 'sector v', '7184004', 'india', 'Street parking (free)', 'No Stairs', 'Dog(s)', '', '23', '26-08-2022 04:49:03'),
(33, 'Home', 'kolhapur', 'nigadewadi', '416005', 'india', 'Street parking (free)', 'Half Stairs', 'No pets', 'vishalchougule798@gmail.com', '33', '28-10-2022 11:46:58'),
(34, 'Home', 'echo station', 'india', '70091', 'india', 'Street parking (free)', 'No Stairs', 'No pets', '', '37', '23-11-2022 10:14:03'),
(35, 'Home', 'test', 'test', '123456', 'test', 'Park in our driveway / garage', 'No Stairs', 'Dog(s)', '', '38', '25-11-2022 05:32:31'),
(40, 'Home', '35 milne rd', 'park orchards', '3114', 'Australia ', 'Park in our driveway / garage', 'No Stairs', 'No pets', '', '36', '13-12-2022 01:11:30'),
(41, 'Home', 'Australia', 'hello', '48848', ' zvvgs', 'Park in our driveway / garage', '1 flight', 'Dog(s)', 'no', '22', '13-12-2022 02:04:56'),
(42, 'Home', 'AC 3012', 'Australia', '4000', 'india', 'No parking available', '1 flight', 'Cat(s)', '', '22', '13-12-2022 02:37:00'),
(43, 'Serviced appartment', 'Austria', 'Western', '4001', 'india', 'Aged or Home care (incl NDIS)', 'More than 2 flights', 'Both Dog(s) and Cat(s)', '', '22', '13-12-2022 02:37:44'),
(44, 'Home', '137', 'victoria', '2405', 'australia', 'No parking available', 'No Stairs', 'No pets', '', '44', '16-12-2022 01:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `admin_fcm`
--

CREATE TABLE `admin_fcm` (
  `id` int(11) NOT NULL,
  `device` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_fcm`
--

INSERT INTO `admin_fcm` (`id`, `device`, `token`) VALUES
(1, 'V2111', 'cniNCIhGRnStCs9s-uns2n:APA91bFUT18ad_d2YoNA0bj35D-BDu8DI9jXe_qNfCkU1QC6TmTqLIjiBEywVFaGk43HjG_dymE0x62uT607sQnlLt4wUvs4FEDLi8tekLc6g1zIGspf7g87gYUIQ1GdCQn49qa3a71R');

-- --------------------------------------------------------

--
-- Table structure for table `block_dates`
--

CREATE TABLE `block_dates` (
  `id` int(11) NOT NULL,
  `start_date` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `block_dates`
--

INSERT INTO `block_dates` (`id`, `start_date`, `end_date`, `status`, `pid`) VALUES
(1, '20-12-2022', '22-12-2022', '1', '5'),
(2, '22-12-2022', '24-12-2022', '1', '5');

-- --------------------------------------------------------

--
-- Table structure for table `block_timeslot`
--

CREATE TABLE `block_timeslot` (
  `id` int(11) NOT NULL,
  `service_name` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeslot` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `service` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practitioner` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bdate` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeslot` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_for` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scharge` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tfee` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cur_time` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE `duration` (
  `id` int(11) NOT NULL,
  `duration` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_slot` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practitioner_id` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `duration`
--

INSERT INTO `duration` (`id`, `duration`, `service_id`, `time_slot`, `price`, `practitioner_id`) VALUES
(25, '60 Min', '5', '', '120', ''),
(26, '90 Min', '5', '', '180', ''),
(27, '120 Min', '5', '', '240', ''),
(28, '60 Min', '6', '', '240', ''),
(29, '90 Min', '6', '', '360', ''),
(30, '120 Min', '6', '', '480', ''),
(31, '60 Min', '7', '', '120', ''),
(32, '90 Min', '7', '', '180', ''),
(33, '120 Min', '7', '', '240', ''),
(34, '60 Min', '8', '', '120', ''),
(35, '90 Min', '8', '', '180', ''),
(36, '120 Min', '8', '', '240', ''),
(37, '60 Min', '9', '', '120', ''),
(38, '90 Min', '9', '', '180', ''),
(39, '120 Min', '9', '', '240', ''),
(40, '60 Min', '11', '', '120', ''),
(41, '90 Min', '11', '', '180', ''),
(42, '120 Min', '11', '', '240', ''),
(43, '60 Min', '18', '', '120', ''),
(44, '90 Min', '18', '', '180', ''),
(45, '120 Min', '18', '', '240', ''),
(55, '60 Min', '21', '', '120', ''),
(56, '90 Min', '21', '', '180', ''),
(57, '120 Min', '21', '', '240', '');

-- --------------------------------------------------------

--
-- Table structure for table `fcm_api`
--

CREATE TABLE `fcm_api` (
  `id` int(11) NOT NULL,
  `fcm_api` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fcm_api`
--

INSERT INTO `fcm_api` (`id`, `fcm_api`) VALUES
(1, '1812E1CWL40201I5I26222156FMQ');

-- --------------------------------------------------------

--
-- Table structure for table `firebase_token`
--

CREATE TABLE `firebase_token` (
  `id` int(11) NOT NULL,
  `email` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `firebase_token`
--

INSERT INTO `firebase_token` (`id`, `email`, `device`, `token`, `uid`) VALUES
(8, 'diginamicwebhost@gmail.com', 'V2111', 'cKFh9_HLR0qfFKbPVpqkb_:APA91bGQvxWF6434grQwZGCiWcNqPCf_pDtHjTjY697PReUNjohorGTHXinOQM5e8nlzu9fKLm9oq0nJDLHLftRUtpWaxQlt_uM-6uiczoRdOmsYUGeDoVlSpOOPweZ-QUgtof7VXQXv', '22'),
(10, 'peterwang65131@gmail.com', 'b0q', 'fovlsafxSf6E1_uFm-gYKr:APA91bH8ZmllapfrsHo_cKjv6pCvofrSJ_JpiuUoh7ERj5OoLNxaE0gdZ7dpreohJ4uQTGYEM76fcheT9dWpDPPLSDXiQoTnrCR4sNKe8W28QtxpYQrN3yELCAOXRWSUE_6DxJrY8xGY', '29'),
(11, 'shaunwebzoneexperts@gmail.com', 'F11 Pro', 'd8WN5JQkTTO7GvWA5Gi7ra:APA91bFfjEanVC1ZPyoJHAlDdIa8NtWBpWoTtCjevhFG-CIAMK6zC_Igw2TjPlHFlxxja6WFmNogTIwKq6y14LVy56xlSbRxmVL_XYaIhzGeCzmEKyrRYMRLb0l7i9RHX9CZzZuVcaUB', '28'),
(12, 'anandmathur091@gmail.com', 'Redmi Note 9 Pro', 'dXiTAhHYT0-jrr-lvHexlg:APA91bFuoQHUFofJIK8kdOmU0yt7ABb6k-LBXYgUU0hytxr1h4hCsnSw0q-Phix_I1B3hfsLGAa5RD3TPf1SYSKuhxxjrPS3TwjT2YEbtUNU2Qz-KqICy7KL4u7RjBwUdyWkon7QMyEz', '23'),
(13, 'vishalchougule798@gmail.com', 'V2033', 'fMmjD-hWStKiAC6x9cipb1:APA91bF9_x5ZmybYX80rvy5zd6YBmOm2zuAuSQtfmzHBGENE1hBhzNbbhcxeUs9iXsjoFtCTK06A3jNF_MrkGxKLTyim2Tk5_gUF1M0fj83vhr4NpEVnjij4k1nKYiBHlcaVvbnKaxW4', '33'),
(14, 'pzhu500@hotmail.com', 'CPH2251', 'c0i0_ZRtRNWIE1kPW6fBYN:APA91bHZpRLY3VsFZfwCuWWHj2D5S493hZrcVeF2JfcRlc8lUYSYaeP9McI7KVZgQ39RIiVl0FcFerLMEfT-Bsq0UZJouvbVr9ge6ZKCF99ly7OpQiRU_cSN7MNzV6d7ht5v-25IHtg8', '36'),
(15, 'aryanhela9@gmail.com', 'vivo 1919', 'c8bUqhqDQhaKwcSskAFKx5:APA91bH6c9GrYQhodXVCDf6rXxSsNQ-WKtai011GnEPKVXwn1AfDgatAo3vYms3HuJKSErhOkyHM7nm7zSm9FmuXbFSA9vsEgl3SE-9dWHrara8ImWYXVgy7uHMvqHA_wLJc77zd8sEP', '37'),
(16, 'r32884735@gmail.com', 'POCO F1', 'd066M6NGSHGAZ60mC81TnG:APA91bEkAROitLCCXcRm6EHMScy81vNA1u65ckYRB2oHzy1HhpZEm-0Am1yN7LzKafsuBTVPcnNRTNvqjjQYl9ICNB5kY3kaNT88OdJz4UJRiM5hYWFbGKyJfG-S6eX-mJfkqoF9ItwQ', '38'),
(18, 'test@xjwmobilemassage.com.au', 'A21S', 'fel2U3tiRK27UouZWd2j5o:APA91bEJTwiOOtGtEujaXBsP62-IipQEX14R2O_CJNvhKTTCB_9DbQn4w91wI_DvVWdHjJA_cgI1gf0wLXhFAnCeoKWlHr8lP0iQ7vmlJxExkEpuvFr1CPYWzKnE0F6QCJGPSCJ-H2Su', '41'),
(19, 'hellotestuser@gmail.com', 'V2111', 'eWyOagf8Qe-oiULhYhvM1E:APA91bHMXLDwMfZFPbIRCCjO8OfWtbl_Q6HX0m3BqC1kr9ikDOTSbJJj19CECBFdyUlTEDVrz9vOWOBnpbk8SCHH-Db_6o5kpab_rRzHQNllT9fvIsqg22EsAZrFNdaFX9BnWcCIzZKf', '43'),
(20, 'ponnuthurai.pridelandscape@gmail.com', 'F11 Pro', 'd8WN5JQkTTO7GvWA5Gi7ra:APA91bFfjEanVC1ZPyoJHAlDdIa8NtWBpWoTtCjevhFG-CIAMK6zC_Igw2TjPlHFlxxja6WFmNogTIwKq6y14LVy56xlSbRxmVL_XYaIhzGeCzmEKyrRYMRLb0l7i9RHX9CZzZuVcaUB', '44');

-- --------------------------------------------------------

--
-- Table structure for table `health_fund_booking`
--

CREATE TABLE `health_fund_booking` (
  `id` int(11) NOT NULL,
  `service` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(666) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_provider` varchar(666) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_provider_no` varchar(666) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practitioner_gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practitioner` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BDate` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_slot` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_req` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `scharge` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tfee` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(34) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cur_time` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_fund_booking`
--

INSERT INTO `health_fund_booking` (`id`, `service`, `fullname`, `dob`, `email`, `address`, `health_provider`, `health_provider_no`, `practitioner_gender`, `practitioner`, `BDate`, `duration`, `time_slot`, `add_req`, `scharge`, `tfee`, `total`, `status`, `payment_status`, `transaction_id`, `invoice_id`, `uid`, `cur_time`) VALUES
(33, 'Remedial Massage', 'Ying Zhu', '19-11-2022', 'pzhu500@hotmail.com', '14 Panteg Rd, Sassafras VIC 3787, Australia', 'AHM', 'F63407G', 'Female', 'Practitioner not available.', '21-11-2022', '60 Min', '10:00AM 11:00AM', '', '100', '2.9', '102.9', '3', '', '', 'INV-IP74988', '36', '19-11-2022 08:52:08'),
(34, 'Remedial Massage', 'Ying Zhu', '19-11-2022', 'pzhu500@hotmail.com', '14 Panteg Rd, Sassafras VIC 3787, Australia', 'AHM', '964184N', 'Female', 'Practitioner not available.', '21-11-2022', '60 Min', '10:00AM 11:00AM', '', '100', '2.9', '102.9', '0', '', '', 'INV-M899083', '36', '19-11-2022 08:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `healt_provider`
--

CREATE TABLE `healt_provider` (
  `id` int(11) NOT NULL,
  `name` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `healt_provider`
--

INSERT INTO `healt_provider` (`id`, `name`, `status`) VALUES
(1, 'Choose Health Provider', ''),
(2, 'AHM', '1'),
(3, 'Australian Unity', '1'),
(4, 'BUPA', '1'),
(5, 'CBHS', '1'),
(6, 'Medibank', '1'),
(7, 'NIB/Grand United', '1'),
(8, 'ACA', '1'),
(9, 'CDHBF', '1'),
(10, 'CUA', '1'),
(11, 'DH', '1'),
(12, 'GMHBA', '1'),
(13, 'HBF', '1'),
(14, 'HCI', '1'),
(15, 'HIF', '1'),
(16, 'HP', '1'),
(17, 'HCA', '1'),
(18, 'LHS', '1'),
(19, 'MDHF', '1'),
(20, 'Nh', '1'),
(21, 'NMH', '1'),
(22, 'OMF', '1'),
(23, 'LP', '1'),
(24, 'PH', '1'),
(25, 'PHF', '1'),
(26, 'GCH', '1'),
(27, 'RTH', '1'),
(28, 'RBHS', '1'),
(29, 'STLH', '1'),
(30, 'TFH', '1'),
(31, 'TUH', '1'),
(32, 'TH', '1'),
(33, 'WF', '1');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_charge`
--

CREATE TABLE `paypal_charge` (
  `id` int(11) NOT NULL,
  `percent` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypal_charge`
--

INSERT INTO `paypal_charge` (`id`, `percent`) VALUES
(1, '2.9');

-- --------------------------------------------------------

--
-- Table structure for table `practitioner`
--

CREATE TABLE `practitioner` (
  `id` int(14) NOT NULL,
  `firstname` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ccode` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_type` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `professional_exp` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `udp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doj` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practitioner`
--

INSERT INTO `practitioner` (`id`, `firstname`, `lastname`, `email`, `ccode`, `mobile`, `gender`, `service_type`, `professional_exp`, `reference`, `udp`, `auth`, `status`, `password`, `doj`) VALUES
(3, 'Choose', 'Practitioner', '', '', '', 'male', '', '', '', '', '', '', '', '12-08-2022 06:43:57'),
(5, 'Peter', 'Wang', 'info@xjwmobilemassage.com.au', '61', '0416 432 388', 'male', 'All', '10 years', 'App Admin', '', '194027', '1', '25d55ad283aa400af464c76d713c07ad', '16-08-2022 02:31:06'),
(9, 'Xiao Jiang ', 'Wang', 'peterwang65131@gmail.com', '61', '0416432388', 'male', 'Remedial Massage', 'more than three years', '', '', '', '0', '25d55ad283aa400af464c76d713c07ad', '15-09-2022 07:04:15'),
(12, 'Ying', 'Zhu', 'pzhu500@hotmail.com', '61', '411660983', 'female', 'Remedial Massage', '10 years', '', '', '843778', '1', '777c4dec9f9291f49fda970548426207', '14-12-2022 03:02:41'),
(13, 'Jason', 'Zhu', 'wangxiaojjang28@gmail.com', '61', '459722653', 'male', 'Remedial Massage', '10 years', '', '', '', '1', '272dcc1dd85d4b9c6ba049af50725412', '14-12-2022 03:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `pract_fcm`
--

CREATE TABLE `pract_fcm` (
  `id` int(11) NOT NULL,
  `email` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pract_fcm`
--

INSERT INTO `pract_fcm` (`id`, `email`, `device`, `token`, `uid`) VALUES
(1, 'tosprodev@gmail.com', 'V2111', 'ciaB4jt-RGi4nJdUdfG2X9:APA91bHdr-OPUGqfpGFQeklyzxP9EW2QYGON9BfRN87J8MzzVgSLZQwlzDT0StNe9Zu9sY2jZYW_x31OqCaN6x0buFGiGEjQSD7_6qUTsuEIFzCT8PfbwxXVOMDlTOXLCZyvHjRxrKgw', '8'),
(2, 'info@xjwmobilemassage.com.au', 'V2111', 'e8fsarXnQBemw1qf1nUcK6:APA91bEXcjPuttPB0uYy8fCUdKg0ebboNv5O2qRRQlJuR6GSp3Px83oIoh-BW3zLwWhw0EmDRYnJ4QLzlLkkizLZDE6X3iN54pxa-mhtNp9n336TDYv8U5OSp6lv8_k2EEHWLcrf2X3k', '5'),
(3, 'peterwang65131@gmail.com', 'b0q', 'ca6Jl2Y5RKmEvG_AVpsqvG:APA91bESXJ_Dco4LcHGxsD4qnu9UmlAsD5oOWuntyWWdubtRqKD7b8MPF0B_eF0YSFgT_QqRrKxYSHBFkZ3QlZ59joyAnFeJdbIe9Ycx9g6IBiKAPcvfJ71GwLLAywBblvpeQNNHMR0e', '9'),
(4, 'demo@user.com', 'Pixel 4a', 'fiszBHO2RJCgasUFMJ-yz4:APA91bEqYlDN6iRuGs3E4zDYzeaHDyPBNq1yuPbzIaYeBHp6TMHyVdZHJgubfTDCmqSCN5jELfNc0FHvxwkrKITDzPtYotTUx5kd4pxbVNJYKG9pVhUxTxMaVi08EyRTlxytPpo0A5kq', '10');

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `id` int(11) NOT NULL,
  `firstname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ccode` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relation` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nftt` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipient`
--

INSERT INTO `recipient` (`id`, `firstname`, `lastname`, `email`, `ccode`, `phone`, `relation`, `gender`, `nftt`, `uid`) VALUES
(2, 'Choose', 'Recipient', '', '', '', '', '', '', ''),
(16, 'sahil', 'khan', 'sahilsamar@gmail.com', '91', '8757336637', 'Client / Guest', 'male', '', '22');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `sevice_name` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `sevice_name`, `details`) VALUES
(3, 'Choose Service', ''),
(5, 'Corporate Massage', 'When you introduce corporate massage into your workplace, you are selecting the ideal provider of one of the most cost-efficient and popular health and well being awards for your greatest asset, your employees. Simultaneously, you will be enhancing motivation and productiveness, boosting the morale in the office, lessening tension and muscle pain, awarding and de-stressing your employees- all without anyone having to leave the office.\r\n\r\nI have an online appointment scheduling system which permits your team to just click on a button and schedule their appointments for all our services.  If you need to your team to schedule the sessions, our booking system manages their payments also! No matter wherever you are located in Melbourne and whether you have a team of 6 or 6000 employees, I can meet your requirements.'),
(6, 'Couple Massage', 'Indulge in something you care the most with my couple massage treatment, provide them the best quality time, we will make sure you and your dear one having the most unwinding experience together. You and your partner can select one of our massages to suit your requirements, as we do know every person is unique. Our couples room designed to make you feel close together and you might create stronger bond although you are having your own relaxing time.\r\n\r\nYou can also gift our couple massage making them the ideal gift for wedding days, birthdays, engagements or simply because you want to spoil a special someone in your life.'),
(7, 'In Room Hotel Massage', 'I have been getting many calls from guests staying at hotels in Melbourne. The guests call me after checking in because they want to unwind with an in room hotel massage.\r\n\r\nThe therapist will travel to the hotel and the beautiful staff at the hotel reception gives a pass to access the elevator and make the way to the guest’s room. It is simple and comfortable for the guests. The therapist also caters services during the evening or early in the morning, when it might not be possible to visit a massage salon. If you are staying in the hotel and considering an in room hotel massage service, feel free to give me a call.'),
(8, 'Pregnancy Massage', 'Pregnancy massage has a vital role to play as part of your pregnancy support plan. Pregnant women frequently suffer from hip, back, shoulder, neck and foot pain due to hormonal changes and the growing physical load.\r\n\r\nPregnancy massage assists to facilitate pain and tension, relieves leg cramps, headaches, insomnia, fluid retention, fatigue and stress.\r\n\r\nI use specifically designed massage tables which enable you to lie safely and conveniently on your back and belly.\r\n\r\nYou can stay confident that the experienced, professional and caring massage therapist sees pregnant women as part of the daily routine.\r\n\r\nAre you ready to treat yourself to an unwinding pregnancy massage with extra health advantages? Contact me today for more information or book your pregnancy massage in Melbourne online.'),
(9, 'Remedial Massage', 'Our remedial massage therapist use the best clinical practices to know your musculoskeletal injury or presentation, carry out a comprehensive consultation  and assessment of the causative factors that have led to your symptoms, injury, or movement abnormalities. Through a wide range of treatment methods, I can assist to facilitate symptoms and rectify imbalances in soft tissue and muscle tension.\r\n\r\nXJW Mobile Massage is driven to accomplish the highest standard of clinical care and quality patient results. What makes me different is the value I put on the gold standards of psychological and physical restoration. I understand that remedial massage has an invaluable role to play in enhancing the way you move. Regardless of the issue, I am always here to assist.'),
(11, 'Swedish Relaxation Massage', 'What exactly is a Swedish relaxation massage? Most of us marvel what exactly us a Swedish relaxation massage when we notice it on the service list in one of our favorite massage salon. Swedish relaxation massage is one type of massage that has been popular for decades. Speaking of relaxing the mind, this will be the ideal massage for you to release tension. It offers a gentle and soothing massage usually emphasizing on a specific problem area. This massage will particularly target the neck, head and shoulders to assist in releasing stress and simplify tight muscles, at any time during the treatment. I ensure you exceptional care. For the best experience, consider a XJW Mobile Massage Swedish relaxation massage in Melbourne today!'),
(18, 'Sports Massage', 'Looking for a place to get an excellent sports massage? Are you feeling achy, tight and sore before playing sport or exercising? Always requiring stretching? Are you eager to get the same treatment that several AFL players get before their game-day?\r\n\r\nNo matter it is a flush pre/post game, recovery from a muscle strain, or a deep full body treatment, XJW Mobile Massage is where you want to go for your sports massage. This treatment is frequently a delivery of my signature release methods. This type of treatment was developed to meet the high expectations of the AFL footballers that regularly visit XJW Mobile Massage for a comprehensive flush and full body treatment. This treatment will still boast the same pace of pressure and depth nonetheless will be a wider approach.'),
(21, 'Deep Tissue Massage', 'Do you have a habit of leaving a massage wishing your practitioner has provided a deeper treatment? Is your present deep tissue massage treatment not getting you desired results? Do you want someone can just pin your pain with deep pressure for extended periods of time?\r\n\r\nIn chronic cases, pain can be deeply engrained in the body. When left untreated, these areas of solid tension can become quite stubborn. These are the situations where my deep tissue massage methods are proven to be highly efficient. The massage is delivered with such strength, accuracy, and depth, which enable us to access to these deep limitations. At XJW Mobile Massage, the therapist is highly trained and proficient to pin these areas with such substantial depth for long periods of time. Occasionally, these areas will be up to 20 minutes on constant sustained deep pressure until they are released. ');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` int(11) NOT NULL,
  `time_start` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_sm` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_em` varchar(333) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_charge` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `durtion_id` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`id`, `time_start`, `time_sm`, `time_end`, `time_em`, `status`, `extra_charge`, `durtion_id`) VALUES
(1, 'Choose', 'Timeslot', '', '', '0', '', ''),
(3, '01:30', 'PM', '03:00', 'PM', '1', '0', '4'),
(6, '12:00', 'AM', '02:00', 'AM', '1', '0', '6'),
(7, '02:00', 'AM', '04:00', 'AM', '1', '0', '6'),
(8, '04:00', 'AM', '06:00', 'AM', '1', '0', '6'),
(9, '06:00', 'AM', '08:00', 'AM', '1', '0', '6'),
(10, '08:00', 'AM', '10:00', 'AM', '1', '0', '6'),
(11, '10:00', 'AM', '12:00', 'PM', '1', '0', '6'),
(12, '12:00', 'PM', '02:00', 'PM', '1', '0', '6'),
(13, '02:00', 'PM', '04:00', 'PM', '1', '0', '6'),
(14, '04:00', 'PM', '06:00', 'PM', '1', '0', '6'),
(15, '06:00', 'PM', '08:00', 'PM', '1', '0', '6'),
(16, '08:00', 'PM', '10:00', 'PM', '1', '0', '6'),
(17, '06:00', 'AM', '07:30', 'AM', '1', '0', '7'),
(18, '07:30', 'AM', '09:00', 'AM', '1', '0', '7'),
(19, '09:00', 'AM', '10:30', 'AM', '1', '0', '7'),
(20, '10:30', 'AM', '12:00', 'PM', '1', '0', '7'),
(21, '12:00', 'PM', '01:30', 'PM', '1', '0', '7'),
(22, '01:30', 'PM', '03:00', 'PM', '1', '0', '7'),
(23, '03:00', 'PM', '04:30', 'PM', '1', '0', '7'),
(24, '04:30', 'PM', '06:00', 'PM', '1', '0', '7'),
(25, '06:00', 'PM', '07:30', 'PM', '1', '0', '7'),
(26, '07:30', 'PM', '09:00', 'PM', '1', '0', '7'),
(27, '09:00', 'PM', '10:30', 'PM', '1', '0', '7'),
(28, '10:30', 'PM', '11:30', 'PM', '1', '0', '8'),
(29, '11:30', 'AM', '12:30', 'PM', '1', '0', '8'),
(32, '12:30', 'AM', '01:30', 'PM', '1', '0', '8'),
(34, '09:30', 'AM', '10:30', 'AM', '1', '0', '8'),
(35, '12:20', 'AM', '01:20', 'AM', '1', '0', '20'),
(36, '01:30', 'AM', '02:30', 'AM', '1', '0', '21'),
(52, '07:00', 'AM', '08:00', 'AM', '1', '0', '48'),
(53, '08:00', 'AM', '09:00', 'AM', '1', '0', '48'),
(54, '09:00', 'AM', '10:00', 'AM', '1', '0', '48'),
(55, '11:00', 'AM', '12:00', 'AM', '1', '0', '48'),
(56, '01:00', 'PM', '02:00', 'AM', '1', '0', '48'),
(57, '02:00', 'PM', '03:00', 'AM', '1', '0', '48'),
(58, '03:00', 'PM', '04:00', 'AM', '1', '0', '48'),
(59, '04:00', 'PM', '05:00', 'AM', '1', '0', '48'),
(60, '05:00', 'PM', '06:00', 'AM', '1', '0', '48'),
(61, '06:00', 'PM', '07:00', 'AM', '1', '0', '48'),
(62, '07:00', 'PM', '08:00', 'PM', '1', '0', '48'),
(63, '09:00', 'PM', '10:00', 'PM', '1', '0', '48'),
(64, '10:00', 'PM', '11:00', 'PM', '1', '0', '48'),
(65, '11:00', 'PM', '12:00', 'PM', '1', '0', '48'),
(68, '09:00', 'AM', '10:00', 'AM', '1', '0', '25'),
(69, '10:00', 'AM', '11:00', 'AM', '1', '0', '25'),
(70, '11:00', 'AM', '12:00', 'PM', '1', '0', '25'),
(71, '12:00', 'PM', '01:00', 'PM', '1', '0', '25'),
(72, '01:00', 'PM', '02:00', 'PM', '1', '0', '25'),
(74, '02:00', 'PM', '03:00', 'PM', '1', '0', '25'),
(75, '03:00', 'PM', '04:00', 'PM', '1', '0', '25'),
(76, '04:00', 'PM', '05:00', 'PM', '1', '0', '25'),
(77, '05:00', 'PM', '06:00', 'PM', '1', '0', '25'),
(78, '06:00', 'PM', '07:00', 'PM', '1', '0', '25'),
(79, '07:00', 'PM', '08:00', 'PM', '1', '0', '25'),
(80, '08:00', 'PM', '09:00', 'PM', '1', '0', '25'),
(81, '09:00', 'PM', '10:00', 'PM', '1', '0', '25'),
(82, '10:00', 'PM', '11:00', 'PM', '1', '0', '25'),
(94, '09:00', 'AM', '10:30', 'AM', '1', '0', '26'),
(95, '10:30', 'AM', '12:00', 'PM', '1', '0', '26'),
(96, '12:00', 'PM', '01:30', 'PM', '1', '0', '26'),
(97, '03:00', 'PM', '04:30', 'PM', '1', '0', '26'),
(98, '04:30', 'PM', '06:00', 'PM', '1', '0', '26'),
(99, '06:00', 'PM', '07:30', 'PM', '1', '0', '26'),
(101, '07:30', 'PM', '09:00', 'PM', '1', '0', '26'),
(102, '09:00', 'PM', '10:30', 'PM', '1', '0', '26'),
(103, '10:30', 'PM', '12:00', 'AM', '1', '0', '26'),
(104, '12:00', 'AM', '01:30', 'AM', '2', '0', '26'),
(105, '01:30', 'AM', '03:00', 'AM', '2', '0', '26'),
(106, '03:00', 'AM', '04:30', 'AM', '2', '0', '26'),
(107, '04:30', 'AM', '06:00', 'AM', '2', '0', '26'),
(108, '06:00', 'AM', '07:30', 'AM', '2', '0', '26'),
(109, '07:30', 'AM', '09:00', 'AM', '2', '0', '26'),
(113, '09:00', 'AM', '11:00', 'AM', '1', '0', '27'),
(114, '11:00', 'AM', '01:00', 'PM', '1', '0', '27'),
(115, '01:00', 'PM', '03:00', 'PM', '1', '0', '27'),
(116, '03:00', 'PM', '05:00', 'PM', '1', '0', '27'),
(117, '05:00', 'PM', '07:00', 'PM', '1', '0', '27'),
(118, '07:00', 'PM', '09:00', 'PM', '1', '0', '27'),
(119, '09:00', 'PM', '12:00', 'AM', '1', '0', '27'),
(120, '12:00', 'AM', '02:00', 'AM', '2', '0', '27'),
(121, '02:00', 'AM', '04:00', 'AM', '2', '0', '27'),
(122, '04:00', 'AM', '06:00', 'AM', '2', '0', '27'),
(123, '06:00', 'AM', '08:00', 'AM', '2', '0', '27'),
(124, '09:00', 'AM', '10:00', 'AM', '1', '0', '28'),
(125, '9:00', 'AM', '10:00', 'AM', '1', '0', '37'),
(128, '10:00', 'AM', '11:00', 'AM', '1', '0', '28'),
(129, '11:00', 'AM', '12:00', 'PM', '1', '0', '28'),
(130, '12:00', 'PM', '01:00', 'PM', '1', '0', '28'),
(131, '01:00', 'PM', '02:00', 'PM', '1', '0', '28'),
(132, '09:00', 'AM', '10:00', 'AM', '1', '0', '43'),
(133, '10:00', 'AM', '11:00', 'AM', '1', '0', '43'),
(134, '11:00', 'AM', '12:00', 'PM', '1', '0', '43'),
(135, '12:00', 'PM', '01:00', 'PM', '1', '0', '43'),
(136, '01:00', 'PM', '02:00', 'PM', '1', '0', '43'),
(137, '02:00', 'PM', '03:00', 'PM', '1', '0', '43'),
(138, '03:00', 'PM', '04:00', 'PM', '1', '0', '43'),
(139, '04:00', 'PM', '05:00', 'PM', '1', '0', '43'),
(140, '05:00', 'PM', '06:00', 'PM', '1', '0', '43'),
(141, '06:00', 'PM', '07:00', 'PM', '1', '0', '43'),
(142, '07:00', 'PM', '08:00', 'PM', '1', '0', '43'),
(143, '08:00', 'PM', '09:00', 'PM', '1', '0', '43'),
(144, '09:00', 'PM', '10:00', 'PM', '1', '0', '43'),
(145, '10:00', 'PM', '11:00', 'PM', '1', '0', '43'),
(146, '11:00', 'PM', '12:00', 'AM', '2', '0', '43'),
(147, '09:00', 'AM', '10:30', 'AM', '1', '0', '44'),
(148, '10:30', 'AM', '12:00', 'PM', '1', '0', '44'),
(149, '12:00', 'PM', '01:30', 'PM', '1', '0', '44'),
(150, '01:30', 'PM', '03:00', 'PM', '1', '0', '44'),
(151, '03:00', 'PM', '04:30', 'PM', '1', '0', '44'),
(152, '04:30', 'PM', '06:00', 'PM', '1', '0', '44'),
(153, '06:00', 'PM', '07:30', 'PM', '1', '0', '44'),
(154, '07:30', 'PM', '09:00', 'PM', '1', '0', '44'),
(155, '09:00', 'PM', '10:30', 'PM', '1', '0', '44'),
(156, '10:30', 'PM', '12:00', 'AM', '1', '0', '44'),
(157, '09:00', 'AM', '11:00', 'AM', '1', '0', '45'),
(158, '11:00', 'AM', '01:00', 'PM', '1', '0', '45'),
(159, '01:00', 'PM', '03:00', 'PM', '1', '0', '45'),
(160, '03:00', 'PM', '05:00', 'PM', '1', '0', '45'),
(161, '05:00', 'PM', '07:00', 'PM', '1', '0', '45'),
(162, '07:00', 'PM', '09:00', 'PM', '1', '0', '45'),
(163, '09:00', 'PM', '11:00', 'PM', '1', '0', '45'),
(164, '09:00', 'AM', '10:00', 'AM', '1', '0', '40'),
(166, '10:00', 'AM', '11:00', 'AM', '1', '0', '40'),
(168, '11:00', 'AM', '12:00', 'PM', '1', '0', '40'),
(169, '12:00', 'PM', '01:00', 'PM', '1', '0', '40'),
(170, '01:00', 'PM', '02:00', 'PM', '1', '0', '40'),
(171, '02:00', 'PM', '03:00', 'PM', '1', '0', '40'),
(172, '03:00', 'PM', '04:00', 'PM', '1', '0', '40'),
(173, '04:00', 'PM', '05:00', 'PM', '1', '0', '40'),
(174, '05:00', 'PM', '06:00', 'PM', '1', '0', '40'),
(175, '06:00', 'PM', '07:00', 'PM', '1', '0', '40'),
(176, '07:00', 'PM', '08:00', 'PM', '1', '0', '40'),
(177, '08:00', 'PM', '09:00', 'PM', '1', '0', '40'),
(178, '09:00', 'PM', '10:00', 'PM', '1', '0', '40'),
(179, '10:00', 'PM', '11:00', 'PM', '1', '0', '40'),
(180, '11:00', 'PM', '12:00', 'AM', '2', '0', '40'),
(182, '09:00', 'AM', '10:30', 'AM', '1', '0', '41'),
(183, '10:30', 'AM', '12:00', 'PM', '1', '0', '41'),
(184, '12:00', 'PM', '01:30', 'PM', '1', '0', '41'),
(185, '01:30', 'PM', '03:00', 'PM', '1', '0', '41'),
(186, '03:00', 'PM', '04:30', 'PM', '1', '0', '41'),
(187, '04:30', 'PM', '06:00', 'PM', '1', '0', '41'),
(188, '06:00', 'PM', '07:30', 'PM', '1', '0', '41'),
(189, '07:30', 'PM', '09:00', 'PM', '1', '0', '41'),
(190, '09:00', 'PM', '10:30', 'PM', '1', '0', '41'),
(191, '10:30', 'PM', '12:00', 'AM', '1', '0', '41'),
(194, '09:00', 'AM', '11:00', 'AM', '1', '0', '42'),
(195, '11:00', 'AM', '01:00', 'PM', '1', '0', '42'),
(196, '01:00', 'PM', '03:00', 'PM', '1', '0', '42'),
(197, '03:00', 'PM', '05:00', 'PM', '1', '0', '42'),
(198, '05:00', 'PM', '07:00', 'PM', '1', '0', '42'),
(199, '07:00', 'PM', '09:00', 'PM', '1', '0', '42'),
(200, '09:00', 'PM', '11:00', 'PM', '1', '0', '42'),
(201, '11:00', 'PM', '01:00', 'AM', '2', '0', '42'),
(202, '10:00', 'AM', '11:00', 'AM', '1', '0', '37'),
(203, '11:00', 'AM', '12:00', 'PM', '1', '0', '37'),
(204, '12:00', 'PM', '01:00', 'PM', '1', '0', '37'),
(205, '01:00', 'PM', '02:00', 'PM', '1', '0', '37'),
(206, '02:00', 'PM', '03:00', 'PM', '1', '0', '37'),
(207, '03:00', 'PM', '04:00', 'PM', '1', '0', '37'),
(208, '04:00', 'PM', '05:00', 'PM', '1', '0', '37'),
(209, '05:00', 'PM', '06:00', 'PM', '1', '0', '37'),
(210, '06:00', 'PM', '07:00', 'PM', '1', '0', '37'),
(211, '07:00', 'PM', '08:00', 'PM', '1', '0', '37'),
(212, '08:00', 'PM', '09:00', 'PM', '1', '0', '37'),
(213, '09:00', 'PM', '10:00', 'PM', '1', '0', '37'),
(214, '10:00', 'PM', '11:00', 'PM', '1', '0', '37'),
(215, '11:00', 'PM', '12:00', 'AM', '1', '0', '37'),
(216, '09:00', 'AM', '10:30', 'AM', '1', '0', '38'),
(217, '10:30', 'AM', '12:00', 'PM', '1', '0', '38'),
(218, '12:00', 'PM', '01:30', 'PM', '1', '0', '38'),
(219, '01:30', 'PM', '03:00', 'PM', '1', '0', '38'),
(220, '03:00', 'PM', '04:30', 'PM', '1', '0', '38'),
(221, '04:30', 'PM', '06:00', 'PM', '1', '0', '38'),
(222, '06:00', 'PM', '07:30', 'PM', '1', '0', '38'),
(223, '07:30', 'PM', '09:00', 'PM', '1', '0', '38'),
(224, '09:00', 'PM', '10:30', 'PM', '1', '0', '38'),
(225, '10:30', 'PM', '12:00', 'AM', '2', '0', '38'),
(226, '09:00', 'AM', '11:00', 'AM', '1', '0', '39'),
(227, '11:00', 'AM', '01:00', 'PM', '1', '0', '39'),
(228, '01:00', 'PM', '03:00', 'PM', '1', '0', '39'),
(229, '03:00', 'PM', '05:00', 'PM', '1', '0', '39'),
(230, '05:00', 'PM', '07:00', 'PM', '1', '0', '39'),
(231, '07:00', 'PM', '09:00', 'PM', '1', '0', '39'),
(232, '09:00', 'PM', '11:00', 'PM', '1', '0', '39'),
(233, '11:00', 'PM', '01:00', 'AM', '2', '0', '39'),
(234, '09:00', 'AM', '10:00', 'AM', '1', '0', '34'),
(235, '10:00', 'AM', '11:00', 'AM', '1', '0', '34'),
(236, '11:00', 'AM', '12:00', 'PM', '1', '0', '34'),
(237, '12:00', 'PM', '01:00', 'PM', '1', '0', '34'),
(238, '01:00', 'PM', '02:00', 'PM', '1', '0', '34'),
(239, '02:00', 'PM', '03:00', 'PM', '1', '0', '34'),
(240, '03:00', 'PM', '04:00', 'PM', '1', '0', '34'),
(241, '04:00', 'PM', '05:00', 'PM', '1', '0', '34'),
(242, '05:00', 'PM', '06:00', 'PM', '1', '0', '34'),
(243, '06:00', 'PM', '07:00', 'PM', '1', '0', '34'),
(244, '07:00', 'PM', '08:00', 'PM', '1', '0', '34'),
(245, '08:00', 'PM', '09:00', 'PM', '1', '0', '34'),
(246, '09:00', 'PM', '10:00', 'PM', '1', '0', '34'),
(247, '10:00', 'PM', '11:00', 'PM', '1', '0', '34'),
(248, '11:00', 'PM', '12:00', 'AM', '2', '0', '34'),
(249, '09:00', 'AM', '10:30', 'AM', '1', '0', '35'),
(250, '10:30', 'AM', '12:00', 'PM', '1', '0', '35'),
(251, '12:00', 'PM', '01:30', 'PM', '1', '0', '35'),
(252, '01:30', 'PM', '03:00', 'PM', '1', '0', '35'),
(253, '03:00', 'PM', '04:30', 'PM', '1', '0', '35'),
(254, '04:30', 'PM', '06:00', 'PM', '1', '0', '35'),
(255, '06:00', 'PM', '07:30', 'PM', '1', '0', '35'),
(256, '07:30', 'PM', '09:00', 'PM', '1', '0', '35'),
(257, '09:00', 'PM', '10:30', 'PM', '1', '0', '35'),
(258, '09:00', 'AM', '11:00', 'AM', '1', '0', '36'),
(259, '11:00', 'AM', '01:00', 'PM', '1', '0', '36'),
(260, '01:00', 'PM', '03:00', 'PM', '1', '0', '36'),
(261, '03:00', 'PM', '05:00', 'PM', '1', '0', '36'),
(262, '05:00', 'PM', '07:00', 'PM', '1', '0', '36'),
(263, '07:00', 'PM', '09:00', 'PM', '1', '0', '36'),
(264, '09:00', 'PM', '11:00', 'PM', '1', '0', '36'),
(265, '09:00', 'AM', '10:00', 'AM', '1', '0', '31'),
(266, '10:00', 'AM', '11:00', 'AM', '1', '0', '31'),
(267, '11:00', 'AM', '12:00', 'PM', '1', '0', '31'),
(268, '12:00', 'PM', '01:00', 'PM', '1', '0', '31'),
(269, '01:00', 'PM', '02:00', 'PM', '1', '0', '31'),
(270, '02:00', 'PM', '03:00', 'PM', '1', '0', '31'),
(271, '03:00', 'PM', '04:00', 'PM', '1', '0', '31'),
(272, '04:00', 'PM', '05:00', 'PM', '1', '0', '31'),
(273, '05:00', 'PM', '06:00', 'PM', '1', '0', '31'),
(274, '06:00', 'PM', '07:00', 'PM', '1', '0', '31'),
(276, '07:00', 'PM', '08:00', 'PM', '1', '0', '31'),
(277, '08:00', 'PM', '09:00', 'PM', '1', '0', '31'),
(278, '09:00', 'PM', '10:00', 'PM', '1', '0', '31'),
(279, '10:00', 'PM', '11:00', 'PM', '1', '0', '31'),
(280, '11:00', 'PM', '12:00', 'AM', '1', '0', '31'),
(281, '09:00', 'AM', '10:30', 'AM', '1', '0', '32'),
(282, '10:30', 'AM', '12:00', 'PM', '1', '0', '32'),
(283, '12:00', 'PM', '01:30', 'PM', '1', '0', '32'),
(284, '01:30', 'PM', '03:00', 'PM', '1', '0', '32'),
(285, '03:00', 'PM', '04:30', 'PM', '1', '0', '32'),
(286, '04:30', 'PM', '06:00', 'PM', '1', '0', '32'),
(287, '06:00', 'PM', '07:30', 'PM', '1', '0', '32'),
(288, '07:30', 'PM', '09:00', 'PM', '1', '0', '32'),
(289, '09:00', 'PM', '10:30', 'PM', '1', '0', '32'),
(290, '10:30', 'PM', '12:00', 'AM', '1', '0', '32'),
(291, '09:00', 'AM', '11:00', 'AM', '1', '0', '33'),
(292, '11:00', 'AM', '01:00', 'PM', '1', '0', '33'),
(293, '01:00', 'PM', '03:00', 'PM', '1', '0', '33'),
(294, '03:00', 'PM', '05:00', 'PM', '1', '0', '33'),
(295, '05:00', 'PM', '07:00', 'PM', '1', '0', '33'),
(296, '07:00', 'PM', '09:00', 'PM', '1', '0', '33'),
(297, '09:00', 'PM', '11:00', 'PM', '1', '0', '33'),
(298, '02:00', 'PM', '03:00', 'PM', '1', '0', '28'),
(299, '03:00', 'PM', '04:00', 'PM', '1', '0', '28'),
(300, '04:00', 'PM', '05:00', 'PM', '1', '0', '28'),
(301, '05:00', 'PM', '06:00', 'PM', '1', '0', '28'),
(302, '06:00', 'PM', '07:00', 'PM', '1', '0', '28'),
(303, '07:00', 'PM', '08:00', 'PM', '1', '0', '28'),
(304, '08:00', 'PM', '09:00', 'PM', '1', '0', '28'),
(305, '09:00', 'PM', '10:00', 'PM', '1', '0', '28'),
(306, '10:00', 'PM', '11:00', 'PM', '1', '0', '28'),
(307, '11:00', 'PM', '12:00', 'AM', '2', '0', '28'),
(309, '09:00', 'AM', '10:30', 'AM', '1', '0', '29'),
(310, '10:30', 'AM', '12:00', 'PM', '1', '0', '29'),
(312, '12:00', 'PM', '01:30', 'PM', '1', '0', '29'),
(313, '01:30', 'PM', '03:00', 'PM', '1', '0', '29'),
(314, '03:00', 'PM', '04:30', 'PM', '1', '0', '29'),
(315, '04:30', 'PM', '06:00', 'PM', '1', '0', '29'),
(316, '06:00', 'PM', '07:30', 'PM', '1', '0', '29'),
(317, '07:30', 'PM', '09:00', 'PM', '1', '0', '29'),
(318, '09:00', 'PM', '10:30', 'PM', '1', '0', '29'),
(319, '09:00', 'AM', '11:00', 'AM', '1', '0', '30'),
(320, '11:00', 'AM', '01:00', 'PM', '1', '0', '30'),
(321, '01:00', 'PM', '03:00', 'PM', '1', '0', '30'),
(322, '03:00', 'PM', '05:00', 'PM', '1', '0', '30'),
(323, '05:00', 'PM', '07:00', 'PM', '1', '0', '30'),
(324, '07:00', 'PM', '09:00', 'PM', '1', '0', '30'),
(325, '09:00', 'PM', '11:00', 'PM', '1', '0', '30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_dp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pssword` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doj` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `c_code`, `phone`, `uid`, `ref_code`, `user_dp`, `pssword`, `doj`, `auth`) VALUES
(22, 'Diginamic', 'Webhost', 'male', 'diginamicwebhost@gmail.com', '43', '8457845754', '', '453453536', '', '576568026a5b8e441263b5e97bfb5f13', '2011-12-24 23:00:00', '693111'),
(23, 'anand', 'mathur', 'male', 'anandmathur091@gmail.com', '91', '9875533084', '', '', '', 'd1301fe55cf8eff31a0b8ba7d98cdb84', '2011-12-24 23:00:00', '741768'),
(24, 'rajan', 'raj', 'male', 'rajanraj9178@gmail.com', '61', '9178642028', '', '', '', 'e019d4e08e8dbcdd9009815f73346d37', '2011-12-24 23:00:00', '215897'),
(25, 'Md', 'Kaif', 'male', 'mehnajkaif@gmail.com', '61', '916003690840', '', '', '', '25d55ad283aa400af464c76d713c07ad', '17-08-2022 11:47:06', '688795'),
(28, 'shaun', 'william', 'male', 'shaunwebzoneexperts@gmail.com', '61', '280099938', '', '', '', '9981885bf32f8f0201426215888ee096', '22-08-2022 02:03:08', '112903'),
(29, 'Peter', 'Wang', 'male', 'peterwang65131@gmail.com', '61', '0416432388', '', '', '', '25d55ad283aa400af464c76d713c07ad', '22-08-2022 02:03:35', '683204'),
(31, 'TechnoSol', '360', 'male', 'itstechnosol360@gmail.com', '61', '600 369 0843', '', 'YSG7 687 677', '', '576568026a5b8e441263b5e97bfb5f13', '30-08-2022 08:47:57', '999338'),
(32, 'Stephen', 'Andrew Green', 'male', 'shaun@webzoneexperts.com.au', '61', '256 897 54', '', '', '', '657f100839546a4fa65329f287641eca', '26-10-2022 01:29:35', '027682'),
(33, 'vc', 'cg', 'male', 'vishalchougule798@gmail.com', '91', '7620721530', '', '', '', '3c2cdcc2becabf462e953cbab2cefc6c', '28-10-2022 11:32:05', '940086'),
(34, 'Jacob', 'Samuel', 'male', 'jacob.samuel59@gmail.com', '61', '413 748 870', '', '', '', 'e39a93b997ef7031080b575d53d10308', '31-10-2022 12:09:42', '049799'),
(35, 'miley', 'shaw', 'female', 'mileywebzonexperts@gmail.com', '61', '412 578 541', '', '', '', 'f651ac487d8a51016f4b945781511593', '03-11-2022 03:28:25', '799340'),
(36, 'ying', 'zhu', 'female', 'pzhu500@hotmail.com', '61', '411660983', '', '', '', 'bad28b6c4281a5245eabaefd22f6a49e', '19-11-2022 08:43:42', '972911'),
(37, 'Rohit', 'Sahu', 'male', 'aryanhela9@gmail.com', '91', '8910201037', '', '', '', 'b0a251a793d1bdc8dc13719cc1fc5f0b', '23-11-2022 10:09:12', '116459'),
(38, 'Mark', 'Macculum', 'male', 'r32884735@gmail.com', '61', '04512100421', '', '', '', '576568026a5b8e441263b5e97bfb5f13', '24-11-2022 02:17:49', '632761'),
(39, 'Sahil', 'khan', 'male', 'itsmesahil@gmail.com', '91', '600369036', '', 'test', '', '576568026a5b8e441263b5e97bfb5f13', '27-11-2022 10:48:32', '724495'),
(40, 'my', 'test', 'male', 'mytest@emial.com', '61', '6366363', '', '', '', 'c496809ec1371255f88df35599dbfbf1', '27-11-2022 10:58:05', '742732'),
(41, 'Test', 'User', 'male', 'test@xjwmobilemassage.com.au', '61', '403737373', '', '', '', '25d55ad283aa400af464c76d713c07ad', '01-12-2022 01:33:04', '142380'),
(42, 'jack', 'willson', 'male', 'unis116@gmail.com', '61', '280 013 572', '', '', '', 'cf3a4d6f6fc70f62fec817441b95ad0a', '04-12-2022 05:42:13', '198910'),
(43, 'test', 'user', 'male', 'hellotestuser@gmail.com', '61', '8757336635', '', '', '', '576568026a5b8e441263b5e97bfb5f13', '14-12-2022 12:50:24', '145079'),
(44, 'eric', 'william', 'male', 'ponnuthurai.pridelandscape@gmail.com', '61', '4136758765', '', '', '', 'f6c5940617d024d23acb759f8f56f717', '14-12-2022 12:53:06', '701364'),
(45, 'Miley ', 'Shaw', 'female', 'mileywebzoneexperts@gmail.com', '61', '280069938', '', '', '', '2dcd3071808d767aa0327a0150822254', '20-12-2022 02:25:21', '507903');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_fcm`
--
ALTER TABLE `admin_fcm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block_dates`
--
ALTER TABLE `block_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block_timeslot`
--
ALTER TABLE `block_timeslot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duration`
--
ALTER TABLE `duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fcm_api`
--
ALTER TABLE `fcm_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firebase_token`
--
ALTER TABLE `firebase_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_fund_booking`
--
ALTER TABLE `health_fund_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `healt_provider`
--
ALTER TABLE `healt_provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_charge`
--
ALTER TABLE `paypal_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practitioner`
--
ALTER TABLE `practitioner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pract_fcm`
--
ALTER TABLE `pract_fcm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `admin_fcm`
--
ALTER TABLE `admin_fcm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `block_dates`
--
ALTER TABLE `block_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `block_timeslot`
--
ALTER TABLE `block_timeslot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `duration`
--
ALTER TABLE `duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `fcm_api`
--
ALTER TABLE `fcm_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `firebase_token`
--
ALTER TABLE `firebase_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `health_fund_booking`
--
ALTER TABLE `health_fund_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `healt_provider`
--
ALTER TABLE `healt_provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `paypal_charge`
--
ALTER TABLE `paypal_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `practitioner`
--
ALTER TABLE `practitioner`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pract_fcm`
--
ALTER TABLE `pract_fcm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
