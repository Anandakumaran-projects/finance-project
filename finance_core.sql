-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 03:55 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accid` int(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `accountid` varchar(100) NOT NULL,
  `aadhar` varchar(100) NOT NULL,
  `pancard` varchar(100) NOT NULL,
  `accountcreationdate` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `accounttype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accid`, `customerid`, `customername`, `phonenumber`, `accountid`, `aadhar`, `pancard`, `accountcreationdate`, `accounttype`) VALUES
(1, 'Cus-2', 'Ananda Kumaran ', '9894820383', 'ACC-2', '123456789009', 'ABCDE1234F', '2024-12-14 15:13:14.756690', 'Savings');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customerid`, `customername`, `email`, `phonenumber`, `address1`, `address2`, `city`, `state`, `pincode`) VALUES
(1, 'Cus-2', 'Ananda Kumaran ', 'anand02111998@gmail.com', '9894820383', 'Kamaraj nagar', 'mappillaiyurani', 'thoothukudi', 'Tamilnadu', 628002);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `aadhar` varchar(100) NOT NULL,
  `loanno` varchar(100) NOT NULL,
  `loanamount` decimal(65,0) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `tenure` varchar(100) NOT NULL,
  `issuedate` date NOT NULL,
  `payableamount` decimal(65,0) NOT NULL,
  `totalpayable` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `customerid`, `customername`, `phonenumber`, `aadhar`, `loanno`, `loanamount`, `interest`, `tenure`, `issuedate`, `payableamount`, `totalpayable`) VALUES
(1, 'Cus-2', 'Ananda Kumaran ', '9894820383', '123456789009', 'SRI-3', '100000', '12', '12', '2024-12-14', '8885', '106619');

-- --------------------------------------------------------

--
-- Table structure for table `mainbalance`
--

CREATE TABLE `mainbalance` (
  `id` int(100) NOT NULL,
  `mainbalance` decimal(65,0) NOT NULL,
  `loanamount` decimal(65,0) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `paidamount` decimal(65,0) NOT NULL,
  `expamount` decimal(65,0) NOT NULL,
  `newbalance` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainbalance`
--

INSERT INTO `mainbalance` (`id`, `mainbalance`, `loanamount`, `customername`, `paidamount`, `expamount`, `newbalance`) VALUES
(1, '10000000', '0', '', '0', '0', '10000000'),
(2, '9900000', '100000', 'Ananda Kumaran ', '0', '0', '9900000'),
(3, '9910000', '0', '0', '10000', '0', '9910000');

-- --------------------------------------------------------

--
-- Table structure for table `repayment`
--

CREATE TABLE `repayment` (
  `id` int(11) NOT NULL,
  `loanno` varchar(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `loanamount` varchar(100) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `tenure` varchar(100) NOT NULL,
  `payableamount` decimal(65,0) NOT NULL,
  `paidamount` decimal(65,0) NOT NULL,
  `totalpayable` decimal(65,0) NOT NULL,
  `balancepayable` decimal(65,0) NOT NULL,
  `paiddate` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `closedloan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repayment`
--

INSERT INTO `repayment` (`id`, `loanno`, `customerid`, `customername`, `loanamount`, `interest`, `tenure`, `payableamount`, `paidamount`, `totalpayable`, `balancepayable`, `paiddate`, `closedloan`) VALUES
(1, 'SRI-3', 'Cus-2', 'Ananda Kumaran', '100000', '12', '12', '8885', '20000', '106619', '86619', '2024-12-14 00:00:00.000000', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mainbalance`
--
ALTER TABLE `mainbalance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repayment`
--
ALTER TABLE `repayment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mainbalance`
--
ALTER TABLE `mainbalance`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `repayment`
--
ALTER TABLE `repayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
