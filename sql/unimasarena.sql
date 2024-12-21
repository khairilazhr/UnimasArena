-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 03:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unimasarena`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_period` varchar(50) NOT NULL,
  `court` int(11) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `matric_number` int(6) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `user_email` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `booking_date`, `booking_period`, `court`, `contact_number`, `created_at`, `matric_number`, `name`, `user_id`, `status`, `user_email`) VALUES
(31, '2024-01-26', '12:00pm - 1:00pm', 4, '01110517869', '2024-01-20 10:10:40', 79769, 'Shalin Shahizam', 3, 'Approved', '79769@siswa.unimas.my'),
(32, '2024-01-17', '1:00pm - 2:00pm', 4, '01110517869', '2024-01-20 10:12:42', 79769, 'Khairil Azhar', 0, 'Approved', 'khxiril.azhr@gmail.com'),
(34, '2024-01-25', '1:00pm - 2:00pm', 4, '01110517869', '2024-01-20 18:10:42', 79769, 'Shalin Shahizam', 3, 'Approved', '79769@siswa.unimas.my'),
(35, '2024-01-23', '12:00pm - 1:00pm', 3, '01110517869', '2024-01-20 19:02:50', 79769, 'Shalin Shahizam', 3, 'Approved', '79769@siswa.unimas.my'),
(37, '2024-01-25', '2:00pm - 3:00pm', 5, '', '2024-01-21 08:35:03', 79769, 'Khairil Azhar', 3, 'Approved', '79769@siswa.unimas.my'),
(38, '2024-01-26', '1:00pm - 2:00pm', 1, '01110517869', '2024-01-21 08:35:12', 79769, 'Khairil Azhar', 3, 'Approved', '79769@siswa.unimas.my');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `fb1` text DEFAULT NULL,
  `fb2` text DEFAULT NULL,
  `fb3` text DEFAULT NULL,
  `fb4` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `fb1`, `fb2`, `fb3`, `fb4`) VALUES
(5, 'gooof', 'quizz', 'goood', 'goood');

-- --------------------------------------------------------

--
-- Table structure for table `rejectbooking`
--

CREATE TABLE `rejectbooking` (
  `rej_id` int(11) NOT NULL,
  `rej_booking_date` date NOT NULL,
  `rej_booking_period` varchar(50) NOT NULL,
  `rej_court` int(11) NOT NULL,
  `rej_contact_number` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rej_matric_number` int(6) DEFAULT NULL,
  `rej_name` varchar(250) DEFAULT NULL,
  `rej_status` varchar(25) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rejectbooking`
--

INSERT INTO `rejectbooking` (`rej_id`, `rej_booking_date`, `rej_booking_period`, `rej_court`, `rej_contact_number`, `created_at`, `rej_matric_number`, `rej_name`, `rej_status`, `user_email`, `remark`) VALUES
(33, '2024-01-23', '10:00am - 11:00am', 4, '01110517869', '2024-01-20 10:14:17', 79769, 'Shalin Shahizam', 'Rejected', '79769@siswa.unimas.my', 'GOOOD BOY'),
(36, '2024-01-23', '3:00pm - 4:00pm', 4, '01110517869', '2024-01-21 08:43:06', 79769, 'Khairil Azhar', 'Rejected', '79769@siswa.unimas.my', 'You already booked');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `user_email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `matric_number` int(10) DEFAULT NULL,
  `profilepic` tinyblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `user_email`, `password`, `matric_number`, `profilepic`) VALUES
(3, 'Khairil', 'Azhar', '79769@siswa.unimas.my', 'Khairil06', 79769, ''),
(77, 'Admin', 'Arena', 'Admin@Arena', 'Admin556677', NULL, NULL),
(80, 'KHAIRIL', 'AZHAR BIN KUSHAIRI', 'khairilazhr@gmail.com', 'Khairil06', NULL, NULL),
(81, 'KHAIRIL', 'AZHAR BIN KUSHAIRI', 'khxiril.azhr@gmail.com', 'Khairil067', NULL, NULL),
(82, 'Khairil', 'Azhar', 'khxiril.azhr@gmail.com', 'Khausdhiasd', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_date` (`booking_date`,`booking_period`,`court`),
  ADD UNIQUE KEY `unique_slot` (`booking_date`,`booking_period`,`court`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_email_idx` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
