-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2016 at 10:48 AM
-- Server version: 5.7.12-0ubuntu1
-- PHP Version: 7.0.4-7ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `alloted_functions`
--

CREATE TABLE `alloted_functions` (
  `alloted_function_id` int(11) NOT NULL,
  `function_ids` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alloted_functions`
--

INSERT INTO `alloted_functions` (`alloted_function_id`, `function_ids`, `user_id`) VALUES
(1, '19,20', 3),
(2, '4,7,18,19', 7),
(4, '22', 2),
(5, '4,7,22', 5);

-- --------------------------------------------------------

--
-- Table structure for table `field_types`
--

CREATE TABLE `field_types` (
  `field_type_id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_types`
--

INSERT INTO `field_types` (`field_type_id`, `field_name`, `status`) VALUES
(1, 'textbox', '1'),
(2, 'textarea', '1'),
(5, 'radio', '1'),
(6, 'checkbox', '1'),
(7, 'dropdown', '1'),
(8, 'image', '1'),
(9, 'video', '1'),
(10, 'multiselect', '1'),
(11, 'file', '1');

-- --------------------------------------------------------

--
-- Table structure for table `field_values`
--

CREATE TABLE `field_values` (
  `field_value_id` int(11) NOT NULL,
  `function_field_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `function_allot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_values`
--

INSERT INTO `field_values` (`field_value_id`, `function_field_id`, `value`, `function_allot_id`) VALUES
(63, 68, '8888', 4),
(64, 69, '5555', 4),
(65, 72, '999999', 4),
(104, 68, '1212', 5),
(105, 69, '1212', 5),
(106, 72, '6666666', 5),
(107, 73, 'asas', 5),
(108, 74, '4552', 5),
(109, 75, '78\';\';\';', 5),
(110, 81, '1gbBe_Screenshot from 2016-06-22 12-57-11.png', 5),
(111, 76, 'AOZn7_Screenshot from 2016-06-22 12-57-11.png', 5),
(112, 80, '789', 5),
(113, 82, 'vvnnd_oneteam_2016-06-27 13-37-34.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE `functions` (
  `function_id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `functions`
--

INSERT INTO `functions` (`function_id`, `function_name`, `description`, `status`) VALUES
(4, 'rtrt', '', '1'),
(7, 'rtrttt11', '', '1'),
(18, 'ffgfg', '', '1'),
(20, 'ere', '', '1'),
(22, 'asasa', 'qwwwwwwwwwwww\r\nq\r\nq\r\n111111111111', '0'),
(23, 'sdsd', 'sdsdsd', '1');

-- --------------------------------------------------------

--
-- Table structure for table `functions_allot`
--

CREATE TABLE `functions_allot` (
  `function_allot_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `functions_allot`
--

INSERT INTO `functions_allot` (`function_allot_id`, `function_id`, `user_id`, `title`, `image`, `status`) VALUES
(1, 22, 0, 'qwqw', 'bKIf5.png', '1'),
(2, 0, 0, 'qwwqw', 'Nnw1s_mariediggs_ 2016-06-27 13-28-51.png.png', '1'),
(3, 0, 0, 'wqqw', 'Qkt1F_new_scan_2016-06-27 17-29-23.png', '0'),
(4, 22, 2, 'qwqwq', 'knHED_new_scan_2016-06-27 17-29-23.png', '0'),
(5, 22, 2, 'employ', 'EozYu_Screenshot from 2016-06-22 12-57-11.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `function_fields`
--

CREATE TABLE `function_fields` (
  `function_field_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `field_type_id` int(11) NOT NULL,
  `field_order` int(11) NOT NULL,
  `required` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `options` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `function_fields`
--

INSERT INTO `function_fields` (`function_field_id`, `name`, `field_type_id`, `field_order`, `required`, `function_id`, `status`, `options`) VALUES
(76, 'file', 11, 3, 0, 22, '1', ''),
(80, 'wewe', 1, 3, 0, 22, '1', ''),
(81, 'file2', 11, 1, 0, 22, '1', ''),
(82, 'file3', 11, 8, 0, 22, '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `approve` enum('0','1') NOT NULL DEFAULT '0',
  `user_type` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `name`, `address`, `email`, `approve`, `user_type`, `phone`, `hospital_id`) VALUES
(1, 'admin', '123', '1212', 'abcaf', 'ajiks5656@gmail.com', '1', 1, '1212525252', 0),
(2, 'user', '123', 'Abccd rf', 'asdfg', 'swdw@gmaail.com', '1', 2, '1234567890', 0),
(3, 'hospital', '123', 'MAKQ', 'XAefdxcd', 'qqqq@gmail.com', '1', 2, '1234567890', 0),
(5, 'val', '123', 'valsala', 'asdfg', 'dd@gmail.com', '1', 3, '', 0),
(6, 'Sasikumar', '123', 'Sasikumar', 'asdfgh', 'ddw', '1', 3, '5635', 0),
(7, 'vikram', '123', 'vikram', 'asdfghjkl', 'hbth', '1', 3, '434525', 3),
(10, 'ambily', '123', 'ambily', 'kklm', 'ad', '1', 3, '1234', 0),
(13, 'aji', '123', 'Aji', 'ewewrw rw rwr', 'ajiksuku@gmail.com', '1', 3, '1234567890', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alloted_functions`
--
ALTER TABLE `alloted_functions`
  ADD PRIMARY KEY (`alloted_function_id`);

--
-- Indexes for table `field_types`
--
ALTER TABLE `field_types`
  ADD PRIMARY KEY (`field_type_id`);

--
-- Indexes for table `field_values`
--
ALTER TABLE `field_values`
  ADD PRIMARY KEY (`field_value_id`);

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`function_id`);

--
-- Indexes for table `functions_allot`
--
ALTER TABLE `functions_allot`
  ADD PRIMARY KEY (`function_allot_id`);

--
-- Indexes for table `function_fields`
--
ALTER TABLE `function_fields`
  ADD PRIMARY KEY (`function_field_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alloted_functions`
--
ALTER TABLE `alloted_functions`
  MODIFY `alloted_function_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `field_types`
--
ALTER TABLE `field_types`
  MODIFY `field_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `field_values`
--
ALTER TABLE `field_values`
  MODIFY `field_value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `functions`
--
ALTER TABLE `functions`
  MODIFY `function_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `functions_allot`
--
ALTER TABLE `functions_allot`
  MODIFY `function_allot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `function_fields`
--
ALTER TABLE `function_fields`
  MODIFY `function_field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
