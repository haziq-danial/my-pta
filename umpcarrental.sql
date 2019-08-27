-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2019 at 06:46 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umpcarrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_car`
--

CREATE TABLE `all_car` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `matric_no` varchar(9) NOT NULL,
  `plate_no` varchar(255) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `engine_litre` varchar(255) NOT NULL,
  `transmission` varchar(255) NOT NULL,
  `car_seat` varchar(20) NOT NULL,
  `charge_rate` varchar(25) NOT NULL,
  `rating` float NOT NULL,
  `car_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_car`
--

INSERT INTO `all_car` (`id`, `owner_name`, `matric_no`, `plate_no`, `car_name`, `engine_litre`, `transmission`, `car_seat`, `charge_rate`, `rating`, `car_status`) VALUES
(1, 'Nazhiff Mustafa', 'CC16261', 'WRX123', 'Proton Waja', '1.2', 'Automatic', '5', '12', 4, 'not used'),
(2, 'Ahmad Zubair', 'CC17234', 'WWW246', 'Proton Saga', '2.3', 'Manual', '5', '5', 4, 'not used'),
(3, 'Nurul Zainab', 'CA16234', 'PK123', 'Honda Jazz', '2.1', 'Automatic', '5', '18', 0, 'not used'),
(6, 'Amir Hakim', 'CC14567', 'WWW123', 'Honda CRV', '1.2', 'Automatic', '5', '12', 0, 'in use'),
(7, 'Mohd Salah', 'CC17890', 'WWW567', 'Proton Iriz', '1.3', 'Automatic', '4', '5', 0, 'not used'),
(8, 'Aliff Aiman', 'CA14321', 'WRX123', 'Ferrari', '3.4', 'Automatic', '2', '100', 0, 'not used');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `std_matric` varchar(9) NOT NULL,
  `owner_matric` varchar(9) NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `delivery_options` varchar(255) NOT NULL,
  `charge_rate` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `booking_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `std_matric`, `owner_matric`, `start_time`, `end_time`, `duration`, `delivery_options`, `charge_rate`, `price`, `booking_status`) VALUES
(48, 'CC16243', 'CC16261', '3:00PM', '9:00PM', '6 hrs and 0 minutes', 'Delivered', '12', '72', 'completed'),
(49, 'CC16243', 'CC17234', '3:00PM', '6:00PM', '3 hrs and 0 minutes', 'Delivered', '5', '15', 'completed'),
(50, 'CC16243', 'CC16261', '3:00PM', '8:00PM', '5 hrs and 0 minutes', 'Delivered', '12', '60', 'completed'),
(51, 'CC16243', 'CC16261', '3:00PM', '6:00PM', '3 hrs and 0 minutes', 'Delivered', '12', '36', 'completed'),
(52, 'CC16243', 'CC16261', '3:00PM', '6:00PM', '3 hrs and 0 minutes', 'Delivered', '12', '36', 'completed'),
(53, 'CC16243', 'CC16261', '3:00PM', '7:00PM', '4 hrs and 0 minutes', 'Delivered', '12', '48', 'completed'),
(55, 'CC16243', 'CC17234', '3:00PM', '9:00PM', '6 hrs and 0 minutes', 'Delivered', '5', '30', 'completed'),
(56, 'CC16243', 'CA14321', '3:00PM', '8:00PM', '5 hrs and 0 minutes', 'Delivered', '100', '500', 'completed'),
(60, 'CC16243', 'CC14567', '12:00PM', '8:00PM', '8 hrs and 0 minutes', 'Delivered', '12', '96', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `booking_complete`
--

CREATE TABLE `booking_complete` (
  `id` int(11) NOT NULL,
  `booking_id` int(100) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `std_matric` varchar(9) NOT NULL,
  `owner_matric` varchar(9) NOT NULL,
  `time_used` varchar(255) NOT NULL,
  `book_date` varchar(255) NOT NULL,
  `book_day` varchar(255) NOT NULL,
  `paid_status` varchar(255) NOT NULL,
  `overcharge` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `final_price` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_complete`
--

INSERT INTO `booking_complete` (`id`, `booking_id`, `owner_name`, `std_name`, `std_matric`, `owner_matric`, `time_used`, `book_date`, `book_day`, `paid_status`, `overcharge`, `price`, `final_price`, `rating`) VALUES
(30, 48, 'Nazhiff Mustafa', 'Haziq Danial', 'CC16243', 'CC16261', '3:00PM-9:00PM', '8-May-2019', 'Wednesday', 'Yes', 'false', '72', '72', 'not given'),
(31, 49, 'Ahmad Zubair', 'Haziq Danial', 'CC16243', 'CC17234', '3:00PM-6:00PM', '8-May-2019', 'Wednesday', 'Yes', 'false', '15', '15', 'not given'),
(32, 50, 'Nazhiff Mustafa', 'Haziq Danial', 'CC16243', 'CC16261', '3:00PM-8:00PM', '8-May-2019', 'Wednesday', 'Yes', 'false', '60', '60', 'not given'),
(33, 51, 'Nazhiff Mustafa', 'Haziq Danial', 'CC16243', 'CC16261', '3:00PM-6:00PM', '8-May-2019', 'Wednesday', 'Yes', 'false', '36', '36', 'not given'),
(34, 52, 'Nazhiff Mustafa', 'Haziq Danial', 'CC16243', 'CC16261', '3:00PM-6:00PM', '8-May-2019', 'Wednesday', 'Yes', 'false', '36', '36', '4'),
(35, 53, 'Nazhiff Mustafa', 'Haziq Danial', 'CC16243', 'CC16261', '3:00PM-7:00PM', '8-May-2019', 'Wednesday', 'Yes', 'false', '48', '48', '4'),
(36, 55, 'Ahmad Zubair', 'Haziq Danial', 'CC16243', 'CC17234', '3:00PM-9:00PM', '8-May-2019', 'Wednesday', 'Yes', 'true', '30', '40', '4'),
(37, 56, 'Aliff Aiman', 'Haziq Danial', 'CC16243', 'CA14321', '3:00PM-8:00PM', '8-May-2019', 'Wednesday', 'Yes', 'false', '500', '500', 'not given');

-- --------------------------------------------------------

--
-- Table structure for table `car_images`
--

CREATE TABLE `car_images` (
  `id` int(11) NOT NULL,
  `matric_owner` varchar(9) NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_images`
--

INSERT INTO `car_images` (`id`, `matric_owner`, `img_name`) VALUES
(6, 'CC16261', 'waja-1.jpg'),
(7, 'CC16261', 'waja-2.jpg'),
(8, 'CC16261', 'waja-3.jpg'),
(9, 'CC17234', 'saga-1.jpg'),
(10, 'CC17234', 'saga-2.jpg'),
(11, 'CC17234', 'saga-3.jpg'),
(12, 'CA16234', 'jazz-1.jpg'),
(13, 'CA16234', 'jazz-2.jpg'),
(14, 'CA16234', 'jazz-3.jpg'),
(15, 'CC14567', 'crv-1.jpg'),
(16, 'CC14567', 'crv-2.jpg'),
(17, 'CC14567', 'crv-3.jpg'),
(18, 'CC17890', 'Proton-Iriz-2017-40-630x420.jpg'),
(19, 'CC17890', 'Carsifu-2017-Proton-Iriz-refined-Premium-11.jpg'),
(20, 'CC17890', 'Carsifu-2017-Proton-Iriz-refined-Premium-3.jpg'),
(21, 'CA14321', 'images (1).jpg'),
(22, 'CA14321', 'images (2).jpg'),
(23, 'CA14321', 'images.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `car_owner`
--

CREATE TABLE `car_owner` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `matric_no` varchar(9) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `acc_pwd` varchar(255) NOT NULL,
  `student_country` varchar(255) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `license_type` varchar(255) NOT NULL,
  `license_expired` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_owner`
--

INSERT INTO `car_owner` (`id`, `firstname`, `lastname`, `date_of_birth`, `matric_no`, `phone_no`, `email`, `acc_pwd`, `student_country`, `id_no`, `license_type`, `license_expired`) VALUES
(1, 'Nazhiff', 'Mustafa', '1998-11-28', 'CC16261', '012-2347658', 'nazhiff@gmail.com', '123', 'Malaysia', '981128-11-8765', 'Vocational Driving Licence', '2019-08-29'),
(2, 'Ahmad', 'Zubair', '1967-06-30', 'CC17234', '019-2112256', 'zubair@gmail.com', '123', 'International', '123456789', 'Auto Only', '2019-08-24'),
(3, 'Nurul', 'Zainab', '1991-09-19', 'CA16234', '018-2134567', 'zainab@gmail.com', '123', 'Malaysia', '910919-12-6723', 'Vocational Driving Licence', '2019-08-28'),
(4, 'Amir', 'Hakim', '1992-08-29', 'CC14567', '019-567890', 'amirhakim@gmail.com', '123', 'Malaysia', '920829-10-4567', 'Competent Driving License', '2019-08-23'),
(5, 'Mohd', 'Salah', '1999-12-24', 'CC17890', '12345', 'lfc@gmail.com', '123', 'International', '123456789', 'Both Auto & Manual', '2019-07-26'),
(6, 'Ahmad', 'Alif', '1990-06-21', 'CC18234', '018-2135678', 'ahmadalif@gmail.com', '123', 'Malaysia', '900621-10-1289', 'Vocational Driving Licence', '2019-09-27'),
(7, 'Aliff', 'Aiman', '1999-12-24', 'CA14321', '012-3214567', 'alif@gmail.com', '123', 'Malaysia', '991224-10-5678', 'Vocational Driving Licence', '2019-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `image_header`
--

CREATE TABLE `image_header` (
  `id` int(11) NOT NULL,
  `matric_owner` varchar(9) NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_header`
--

INSERT INTO `image_header` (`id`, `matric_owner`, `img_name`) VALUES
(3, 'CC16261', 'proton-waja.png'),
(4, 'CC17234', 'saga.png'),
(5, 'CA16234', 'honda-jazz.png'),
(6, 'CC14567', 'honda-crv.jpg'),
(7, 'CC17890', 'Carsifu-2017-Proton-Iriz-refined-Premium-7.jpg'),
(8, 'CA14321', 'ferrari_100693719_h.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `overcharge`
--

CREATE TABLE `overcharge` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `add_duration` varchar(255) NOT NULL,
  `add_price` varchar(255) NOT NULL,
  `new_price` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overcharge`
--

INSERT INTO `overcharge` (`id`, `booking_id`, `add_duration`, `add_price`, `new_price`, `end_time`) VALUES
(2, '55', '2', '10', '40', '11:00PM');

-- --------------------------------------------------------

--
-- Table structure for table `owner_profit`
--

CREATE TABLE `owner_profit` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(9) NOT NULL,
  `current_profit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner_profit`
--

INSERT INTO `owner_profit` (`id`, `matric_no`, `current_profit`) VALUES
(1, 'CC16261', '84'),
(2, 'CC17234', 'NaN'),
(3, 'CA16234', '0'),
(4, 'CC14567', '0'),
(5, 'CC17890', '0'),
(6, 'CC18234', '0'),
(7, 'CA14321', '500');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `matric_no` varchar(9) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `acc_pwd` varchar(255) NOT NULL,
  `student_country` varchar(255) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `license_type` varchar(255) NOT NULL,
  `license_expired` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `date_of_birth`, `matric_no`, `phone_no`, `email`, `acc_pwd`, `student_country`, `id_no`, `license_type`, `license_expired`) VALUES
(1, 'Haziq', 'Danial', '2016-11-30', 'CC16243', '0-1234567', 'ajiq@gmail.com', '123', 'Malaysia', '980517-23-4567', 'Vocational Driving Licence', '2019-08-30'),
(2, 'Ahmad', 'Najmi', '1998-03-27', 'CC16254', '018-1235678', 'najmi@gmail.com', '123', 'Malaysia', '980327-10-4567', 'Vocational Driving Licence', '2019-12-28'),
(3, 'Alif', 'Akmal', '1994-03-26', 'CC17567', '018-2349876', 'alif@gmail.com', '123', 'Malaysia', '940326-12-3456', 'Vocational Driving Licence', '2019-06-27'),
(4, 'Ahmad', 'Alif', '1993-12-31', 'CC12345', '012-234567', 'alip@gmail.com', '123', 'Malaysia', '931231-10-3456', 'Vocational Driving Licence', '2019-07-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_car`
--
ALTER TABLE `all_car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_complete`
--
ALTER TABLE `booking_complete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_images`
--
ALTER TABLE `car_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_owner`
--
ALTER TABLE `car_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_header`
--
ALTER TABLE `image_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overcharge`
--
ALTER TABLE `overcharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner_profit`
--
ALTER TABLE `owner_profit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_car`
--
ALTER TABLE `all_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `booking_complete`
--
ALTER TABLE `booking_complete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `car_images`
--
ALTER TABLE `car_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `car_owner`
--
ALTER TABLE `car_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image_header`
--
ALTER TABLE `image_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `overcharge`
--
ALTER TABLE `overcharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `owner_profit`
--
ALTER TABLE `owner_profit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
