-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2019 at 03:33 AM
-- Server version: 5.7.28
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ddev60_ddcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `campaignName` varchar(255) NOT NULL,
  `totalBudget` int(11) NOT NULL,
  `advancePayment` varchar(55) NOT NULL,
  `deliveryDate` date NOT NULL,
  `platforms` varchar(255) NOT NULL,
  `deliverables` varchar(255) NOT NULL,
  `influencerList` varchar(55) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `company_id`, `client_id`, `campaignName`, `totalBudget`, `advancePayment`, `deliveryDate`, `platforms`, `deliverables`, `influencerList`, `created`, `modified`) VALUES
(1, 1, 4, 'Lokawas Campaign', 200000, 'yes', '1970-01-01', 'google,facebook,instagram,twitter', 'This is lokawas test content', '1', '2019-12-06 10:26:53', '2019-12-06 10:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `clientName` varchar(55) NOT NULL,
  `gstNumber` varchar(55) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contactNumber` varchar(55) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company_id`, `clientName`, `gstNumber`, `address`, `contactNumber`, `emailAddress`, `created`) VALUES
(3, 2, 'Jamess', 'GNX123456', 'c-133 mohali Gold', '985674588', 'avant@gmail.comm', '2019-12-06 00:00:00'),
(4, 1, 'Smith Jones', 'GHX-1234', 'Street 42, Dallas', '9658745896', 'deffo@gmail.com', '2019-12-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `description`, `address`, `created`) VALUES
(1, 'Deffodi Digital', 'Social Media Company', '#rr, rohini New delhi', '2019-11-25 17:10:21'),
(2, 'Avant Garde', 'Web Development', 'Mohali', '2019-11-25 17:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `influencer_list`
--

CREATE TABLE `influencer_list` (
  `id` int(11) NOT NULL,
  `listID` int(11) NOT NULL,
  `userName` varchar(200) NOT NULL,
  `igLink` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `influencer_list`
--

INSERT INTO `influencer_list` (`id`, `listID`, `userName`, `igLink`, `amount`, `created`) VALUES
(1, 1, 'mahesh', 'https://www.google.com/', '6000', '2019-12-05 00:00:00'),
(2, 1, 'suresh', 'https://www.google.com/', '5000', '2019-12-05 00:00:00'),
(3, 2, 'Rothi', '@rathi', '35000', '2019-12-05 00:00:00'),
(4, 2, 'mohal', '@mohal', '12000', '2019-12-05 00:00:00'),
(5, 2, 'Jag', '@jag', '25000', '2019-12-05 00:00:00'),
(6, 1, 'suresh', 'IGLink', '8974', '2019-12-06 00:00:00'),
(7, 1, 'mahesh', 'testLink', '8995', '2019-12-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `name`, `created`) VALUES
(1, 'Lokawas', '2019-12-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `budget` varchar(100) NOT NULL,
  `actual_spent` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `userName` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `invoiceNo` varchar(200) NOT NULL,
  `payment_status` int(11) DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `screenshot` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencer_list`
--
ALTER TABLE `influencer_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `influencer_list`
--
ALTER TABLE `influencer_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
