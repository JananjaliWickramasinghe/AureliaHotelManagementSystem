-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2021 at 02:27 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aurelia_hotel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `no_ofNights` int(11) NOT NULL,
  `no_ofAdults` int(11) DEFAULT NULL,
  `no_ofChildren` int(11) DEFAULT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `checkin_time` time DEFAULT NULL,
  `checkout_time` time DEFAULT NULL,
  `requests` varchar(150) DEFAULT NULL,
  `sourceType` varchar(8) NOT NULL,
  `book_status` varchar(10) NOT NULL,
  `checkedIn` varchar(13) DEFAULT NULL,
  `checkedOut` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `guest_id`, `room_id`, `no_ofNights`, `no_ofAdults`, `no_ofChildren`, `checkin`, `checkout`, `checkin_time`, `checkout_time`, `requests`, `sourceType`, `book_status`, `checkedIn`, `checkedOut`) VALUES
(1, 1, 2, 2, 2, 0, '2021-08-05', '2021-08-07', '01:30:00', '04:23:00', 'bed & breakfast', 'walk-in', 'hold', NULL, NULL),
(2, 2, 3, 2, 2, 0, '2021-08-05', '2021-08-09', '01:30:00', '08:40:00', 'bed & breakfast', 'walk-in', 'confirmed', NULL, NULL),
(3, 1, 3, 2, 2, 0, '2021-08-05', '2021-08-09', '01:30:00', '14:23:00', 'bed & breakfast', 'by-call', 'cancelled', 'Checked In', 'checked Out'),
(4, 2, 1, 1, 1, 0, '2021-08-05', '2021-08-11', '01:30:00', '18:15:00', 'bed & breakfast', 'website', 'confirmed', 'Checked In', NULL),
(10, 4, 2, 0, 1, 1, '2021-08-26', '2021-08-26', '01:00:00', '01:00:00', 'bed and breakfast', 'by-call', 'hold', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employeem`
--

CREATE TABLE `employeem` (
  `id` int(11) NOT NULL,
  `e_id` varchar(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `role` varchar(20) NOT NULL,
  `basicsalary` varchar(10) NOT NULL,
  `workhrs` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeem`
--

INSERT INTO `employeem` (`id`, `e_id`, `fname`, `lname`, `address`, `phone`, `role`, `basicsalary`, `workhrs`) VALUES
(1, 'E001', 'Ravindu', 'Tharaka', 'Matara', '0703903487', 'Cleaner', '30000', '220'),
(7, 'E003', 'Hasitha', 'Pathum', 'Galle', '0714563215', 'Chef', '30000', '250');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `section` varchar(20) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `section`, `amount`) VALUES
(2, '2021-09-10', 'Current Bill', 2000),
(3, '2021-09-09', 'Current Bill', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `foodmenus`
--

CREATE TABLE `foodmenus` (
  `menuId` varchar(150) NOT NULL COMMENT 'M0001',
  `name` varchar(150) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `addedby` int(50) NOT NULL COMMENT 'uid',
  `addeddate` date NOT NULL,
  `shortdescription` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodmenus`
--

INSERT INTO `foodmenus` (`menuId`, `name`, `category`, `description`, `price`, `addedby`, `addeddate`, `shortdescription`) VALUES
('M340', 'Aurelia Chickens bucket', 'breakfast', ' Chicken wings, nuggets, crispy wings or even 1 or 1/2 chicken. You can put them all in our useful chicken bucket. The buckets are packed, together with lids, in a box and have a popular pattern that you often see in famous American movies and series.', 32500, 0, '2021-10-01', 'Chicken wings, nuggets, crispy wings or even 1 or 1/2 chicken. You can put them all in our useful chicken bucket.                        '),
('M854', 'Crispy chicken burger', 'dinner', 'This burger consists of a super crispy & flakey chicken patty made out of the special blend of Knorr Coating Mix top with Hellmann\'s Classic Mayonnaise brings it all together.', 2600, 0, '2021-10-01', 'This burger consists of a super crispy & flakey chicken patty ');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guest_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address_line_1` varchar(100) NOT NULL,
  `address_line_2` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` char(10) NOT NULL,
  `phone` char(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `first_name`, `last_name`, `address_line_1`, `address_line_2`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `reg_date`) VALUES
(1, 'Kamal', ' Perera', 'No 100/6/8', 'temple road', 'Kandy', 'central', 'Sri Lanka', '   89842', '0713301823', 'kamal@gmail.com', '2021-08-09'),
(2, 'Hasitha', 'Goonathileka', '34-7-B', 'Divine City Tower', 'Colombo', 'Western', 'Sri Lanka', '76784', '0718266767', 'hasitha@gmail.com', '2021-08-12'),
(3, 'Louis', 'Tomlinson', '34B Kings Court', 'Boullavard ', 'New Hampshire', 'New Hampshire', 'England', '66727', '3479874598', 'ltwilliam@gmail.com', '2021-08-18'),
(4, 'Ayesha', 'Herath', '78 ', 'Samagi road', 'Kirulapona', 'Western', 'Sr Lanka', '20645', '713242188', 'ayesha@gmail.com', '2021-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `section` varchar(20) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `date`, `section`, `amount`) VALUES
(2, '2021-09-09', 'Reservation', 1000),
(3, '2021-09-10', 'Reservation', 20000),
(6, '2021-10-19', 'Resturent', 1000),
(7, '2021-10-18', 'Resturent', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `infrastructure`
--

CREATE TABLE `infrastructure` (
  `id` int(11) NOT NULL,
  `i_id` varchar(10) NOT NULL,
  `description` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infrastructure`
--

INSERT INTO `infrastructure` (`id`, `i_id`, `description`, `image`) VALUES
(14, 'I001', 'xxxx xx xxx x xxxxxxx xxxxxx xxxxxx xxxxxx xxxxx', 'inground-pool.png'),
(15, 'I002', ' zzz zz zzzzzz zz zzzzz zzz zzzz z zzzzz', 'pexels-photo-3225531.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menuimg`
--

CREATE TABLE `menuimg` (
  `imgid` int(11) NOT NULL,
  `menuid` varchar(150) NOT NULL,
  `image_name` text NOT NULL,
  `image_createtime` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuimg`
--

INSERT INTO `menuimg` (`imgid`, `menuid`, `image_name`, `image_createtime`) VALUES
(1, 'M241', 'M241.jpg', 2021),
(5, 'M438', 'chicken-noodles-stir-fry-peppers-celery-47806935.jpg', 2021),
(6, 'M854', '123.jpg', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `review` varchar(500) NOT NULL,
  `email` varchar(150) NOT NULL,
  `addeddate` date NOT NULL,
  `menuId` varchar(150) NOT NULL,
  `addedtime` int(50) NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '0' COMMENT '0 - not approved 1 /  approved'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rid`, `name`, `review`, `email`, `addeddate`, `menuId`, `addedtime`, `approval`) VALUES
(13, 'Menuli Rathnayake', 'Awesome food. It was really delicious.', 'menuli@gmail.com', '2021-08-21', 'M241', 0, 1),
(14, 'Danushka Dissanayake', 'Recommended!!!!', 'danu@gmail.com', '2021-08-26', 'M241', 0, 1),
(15, 'Jananjali Dissanayake', 'Yummy food. Do not miss the cuisines', 'jana@gmail.com', '2021-08-26', 'M241', 0, 0),
(16, 'Vishwa Kodikara', 'Excellent food. Menu is extensive and seasonal to a particularly high standard. Definitely fine dining. It can be expensive but worth it and they do different deals on different nights so it’s worth checking them out before you book. Highly recommended.', 'vishwa@gmail.com', '2021-08-26', 'M241', 0, 1),
(17, 'Kasun Withana', 'I have to say, I enjoyed every single bite of the meal in Auralia. I had a 3 course meal, with a couple of beers. Considering the quality, the price is reasonable. Ideal for those who want a romantic night out. There was also plenty of room for bigger groups.', 'kasun@gmail.com', '2021-08-26', 'M241', 0, 1),
(18, 'Vishwa Kodikara', 'Excellent food. Menu is extensive and seasonal to a particularly high standard. Definitely fine dining. It can be expensive but worth it and they do different deals on different nights so it’s worth checking them out before you book. Highly recommended.', 'vish@gmail.com', '2021-08-26', 'M438', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `price_perNight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `description`, `price_perNight`) VALUES
(1, 'Standard', 'standard', 7500),
(2, 'Delux', 'delux', 10500),
(3, 'Suite', 'suite', 25500);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `r_id` varchar(10) NOT NULL,
  `ac_nac` varchar(3) NOT NULL,
  `description` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `r_id`, `ac_nac`, `description`, `image`) VALUES
(1, 'R001', 'Ac', 'xxxxxxx xxxxxxxx xxxxxxx xxxxxxx xxxxxx xxxxx', 'offers-room-berjaya-times-square-hotel-kuala-lumpur.jpg'),
(2, 'R002', 'NAc', 'yyyyyy yyyyyy yyyyyyy yyyyyy yyyyyy yyyyy yyyyyyy', 'istockphoto-627892060-612x612.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking`
--

CREATE TABLE `room_booking` (
  `r_id` int(11) NOT NULL,
  `room_type` int(11) DEFAULT NULL,
  `c_in` date DEFAULT NULL,
  `c_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_booking`
--

INSERT INTO `room_booking` (`r_id`, `room_type`, `c_in`, `c_out`) VALUES
(1, 1, '2021-08-05', '2021-08-07'),
(2, 1, '2021-08-05', '2021-08-07'),
(3, 1, '2021-08-05', '2021-08-30'),
(4, 2, '2021-08-05', '2021-08-10'),
(5, 1, '2021-08-05', '2021-08-10'),
(6, 2, '2021-08-05', '2021-08-07'),
(7, 1, '2021-08-05', '2021-08-07'),
(8, 2, NULL, NULL),
(9, 1, NULL, NULL),
(10, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `e_id` varchar(10) NOT NULL,
  `basicsalary` float NOT NULL,
  `othrs` int(11) NOT NULL,
  `otrate` float NOT NULL,
  `numOfworkDays` int(11) NOT NULL,
  `numOfHalfDays` int(11) NOT NULL,
  `numOfLeaveDays` int(11) NOT NULL,
  `date` date NOT NULL,
  `totsalary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `EmployeeNo` varchar(50) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(200) NOT NULL,
  `addeddate` date NOT NULL,
  `department` varchar(15) NOT NULL COMMENT 'technical / functional / technofunctional',
  `designation` varchar(100) NOT NULL,
  `Adminaccess` int(1) NOT NULL DEFAULT '0' COMMENT '0- No / 1 - yes',
  `email` varchar(50) NOT NULL COMMENT 'Thakral one email',
  `mobile1` varchar(10) DEFAULT NULL COMMENT 'mobile office',
  `mobile2` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `EmployeeNo`, `firstname`, `lastname`, `username`, `password`, `addeddate`, `department`, `designation`, `Adminaccess`, `email`, `mobile1`, `mobile2`) VALUES
(1, 'EMP0001', 'Jananjali', 'Wickramasinghe', 'Jananjali', '202cb962ac59075b964b07152d234b70', '2021-05-24', 'admin', 'Administrator', 1, 'jananjali@auralia.com', '0771112221', '0112225552'),
(3, 'EMP533', 'Madava', 'Wejesinghe', 'Madawa', '202cb962ac59075b964b07152d234b70', '2021-08-26', 'restaurant', 'Restaurant Manager', 0, 'madawa@gmail.com', '0776006416', '0772121123'),
(6, 'EMP0002', 'Maduka', 'Wickramasinghe', 'Maduka', '202cb962ac59075b964b07152d234b70', '2021-05-24', 'restaurant', 'Restaurant Manager', 0, 'maduka@auralia.com', '0771112221', '0112225552');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeem`
--
ALTER TABLE `employeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodmenus`
--
ALTER TABLE `foodmenus`
  ADD PRIMARY KEY (`menuId`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infrastructure`
--
ALTER TABLE `infrastructure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menuimg`
--
ALTER TABLE `menuimg`
  ADD PRIMARY KEY (`imgid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_booking`
--
ALTER TABLE `room_booking`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `FK_roomType` (`room_type`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employeem`
--
ALTER TABLE `employeem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `infrastructure`
--
ALTER TABLE `infrastructure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `menuimg`
--
ALTER TABLE `menuimg`
  MODIFY `imgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_booking`
--
ALTER TABLE `room_booking`
  ADD CONSTRAINT `FK_roomType` FOREIGN KEY (`room_type`) REFERENCES `room` (`room_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
