-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 08:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladdadmin`
--

CREATE TABLE `tbladdadmin` (
  `Id` int(11) NOT NULL,
  `First_Name` text NOT NULL,
  `Last_Name` text NOT NULL,
  `User_Name` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  `Phone_Number` text NOT NULL,
  `Address` text NOT NULL,
  `Date_Of_Birth` date DEFAULT NULL,
  `Gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladdadmin`
--

INSERT INTO `tbladdadmin` (`Id`, `First_Name`, `Last_Name`, `User_Name`, `Password`, `Email`, `Phone_Number`, `Address`, `Date_Of_Birth`, `Gender`) VALUES
(29, 'Abhishek', 'Vishwakarma', 'hello@gmail.com', '12345', 'rashgulla200.1@gmail.com', '8238812482', '200,kailash nagar 2', '2024-08-15', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `tbladdattendance`
--

CREATE TABLE `tbladdattendance` (
  `Id` int(10) NOT NULL,
  `Emp_Id` int(11) NOT NULL,
  `First_Name` text NOT NULL,
  `Last_Name` text NOT NULL,
  `In_Time` varchar(20) NOT NULL,
  `Out_Time` varchar(20) NOT NULL,
  `Created_On` date NOT NULL,
  `Is_Present` text NOT NULL,
  `Work_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladdattendance`
--

INSERT INTO `tbladdattendance` (`Id`, `Emp_Id`, `First_Name`, `Last_Name`, `In_Time`, `Out_Time`, `Created_On`, `Is_Present`, `Work_Time`) VALUES
(1, 0, 'Abhishek', 'Vishwakarma', '10:30:', '07:30:00.256000', '2024-08-01', 'Yes', '05:27:00'),
(2, 101, 'Abhishek', 'Vishwakarma', '22:01', '01:01', '2024-08-09', 'present', '00:00:00'),
(3, 101, 'Abhishek', 'Vishwakarma', '22:01', '01:01', '2024-08-09', 'present', '00:00:00'),
(4, 102, 'Vishal', 'Dubey', '14:28', '01:28', '2024-08-01', 'present', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbladdemployee`
--

CREATE TABLE `tbladdemployee` (
  `Emp_Id` int(11) NOT NULL,
  `First_Name` text NOT NULL,
  `Last_Name` text NOT NULL,
  `Image` varchar(128) NOT NULL,
  `Email` text NOT NULL,
  `Department` text NOT NULL,
  `Shift` text NOT NULL,
  `Pnumber` varchar(11) NOT NULL,
  `Address` text NOT NULL,
  `Date_Of_Birth` date DEFAULT NULL,
  `Date_Of_Joining` date DEFAULT NULL,
  `Gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladdemployee`
--

INSERT INTO `tbladdemployee` (`Emp_Id`, `First_Name`, `Last_Name`, `Image`, `Email`, `Department`, `Shift`, `Pnumber`, `Address`, `Date_Of_Birth`, `Date_Of_Joining`, `Gender`) VALUES
(19, 'Vishal', 'Dubey', '1723833107', 'dubey@gmail.com', 'ACD', '1', '1234568569', 'Pandesara housing Board', '2024-08-16', '2024-08-10', 'on'),
(20, 'Jyoti', 'Dwivedi', '1723833205', 'dubey@gmail.com', 'ACD', '1', '1234568569', 'Pandesara housing Board', '2024-08-16', '2024-08-10', 'on'),
(21, 'Abhishek', 'Vishwakarma', '1723872789', 'rashgulla200.1@gmail.com', 'ADM', '1', '8238812482', '200,kailash nagar 2', '2024-08-02', '2024-08-02', 'on'),
(22, 'Rahul', 'Sharma', '1723989532', 'rashgulla200.1@gmail.com', 'ADM', '2', '8238812482', '200,kailash nagar 2', '2024-08-02', '2024-08-10', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `First_Name` text NOT NULL,
  `Last_Name` text NOT NULL,
  `Email` text NOT NULL,
  `Contact_Number` text NOT NULL,
  `Text_Area` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`First_Name`, `Last_Name`, `Email`, `Contact_Number`, `Text_Area`) VALUES
('Abhishek', 'Vishwakarma', 'hello@gmail.com', '8238812482', 'shdfhsdgfjdhjfhdjfhsdhfsjdjsdhffkdhkjdhfksdhfkjsdhfkjsdhfksdjhfskjdhfksdjhfkjsdvjcxbbvjfdjfjsdhfkjsdhfkjshgkjsdfkjhdfkjshkfjhsdkjfhsdkjfh'),
('Abhishek', 'Vishwakarma', 'hello@gmail.com', '8238812482', 'shdfhsdgfjdhjfhdjfhsdhfsjdjsdhffkdhkjdhfksdhfkjsdhfkjsdhfksdjhfskjdhfksdjhfkjsdvjcxbbvjfdjfjsdhfkjsdhfkjshgkjsdfkjhdfkjshkfjhsdkjfhsdkjfh'),
('Amit', 'Sharma', 'hello1@gmail.com', '1234567890', 'hello friends ky haalhai'),
('Nihal ', 'Nair', 'nihalnair5@gmail.com', '9712854792', 'Respected my salary is been due since 2 years of my service, requesting to please look upon this in order to resolve the issue, Thankyou.'),
('Abhishek', 'Vishwakarma', 'hello1@gmail.com', '8238812482', 'ddddd'),
('Abhishek', 'Vishwakarma', 'hello1@gmail.com', '8238812482', 'ddddd'),
('Abhishek', 'Vishwakarma', 'hello1@gmail.com', '8238812482', 'ddddd'),
('Abhishek', 'Vishwakarma', 'Dubey@gmail.com', '8238812482', 'i have issue with connectivity please resolve it.\r\nthank you :)'),
('Abhishek', 'Vishwakarma', 'hello1@gmail.com', '8238812482', 'whfgiejriewrisakjdfkldsjfksjdalkjfi');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `Id` varchar(3) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`Id`, `Name`) VALUES
('ACD', 'Accounting Department'),
('ADM', 'Admin Department'),
('PCD', 'Production Controller Department'),
('PLD', 'Planner Department'),
('QCD', 'Quality Control Department'),
('SCD', 'Security Department'),
('STD', 'Store Department');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE `tbllogin` (
  `User_Name` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`User_Name`, `Password`) VALUES
('hello@gmail.com', '1234'),
('abhi@gmail.com', '123456'),
('hello@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tblocation`
--

CREATE TABLE `tblocation` (
  `Id` int(11) NOT NULL,
  `Location_Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblocation`
--

INSERT INTO `tblocation` (`Id`, `Location_Name`) VALUES
(1, 'Home'),
(2, 'Office'),
(3, 'Site'),
(4, 'Store'),
(5, 'Field'),
(6, 'Store'),
(7, 'Store'),
(8, 'Store'),
(9, 'Store'),
(10, 'Store'),
(11, 'Store'),
(12, 'Store'),
(13, 'Store'),
(14, 'Store');

-- --------------------------------------------------------

--
-- Table structure for table `tblregistration`
--

CREATE TABLE `tblregistration` (
  `Id_Number` int(10) NOT NULL,
  `First_Name` text NOT NULL,
  `Last_Name` text NOT NULL,
  `User_Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblregistration`
--

INSERT INTO `tblregistration` (`Id_Number`, `First_Name`, `Last_Name`, `User_Name`, `Email`, `Password`) VALUES
(1, 'Abhishek', 'Vishwakarma', 'hello@gmail.com', 'hello1@gmail.com', '1234'),
(2, 'Amit', 'Sharma', 'amit@gmail.com', 'amit1@gmail.com', '1234'),
(3, 'Nihal ', 'Nair', 'hello@gmail.com', 'hello1@gmail.com', '1234'),
(4, 'Vishal', 'Dubey', 'dubey@gmail.com', 'joshi@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tblshift`
--

CREATE TABLE `tblshift` (
  `Id` int(11) NOT NULL,
  `Shift_Name` text NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblshift`
--

INSERT INTO `tblshift` (`Id`, `Shift_Name`, `Start_Time`, `End_Time`) VALUES
(1, 'ShiftOne', '08:30:00', '17:30:00'),
(2, 'ShiftTwo', '14:30:00', '22:30:00'),
(3, 'ShiftThree', '17:30:00', '02:30:00'),
(4, 'ShiftThree', '17:00:00', '10:30:00'),
(5, 'ShiftThree', '17:00:00', '10:30:00'),
(6, 'ShiftFour', '20:30:00', '09:30:00'),
(7, 'ShiftFour', '20:30:00', '09:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblusername`
--

CREATE TABLE `tblusername` (
  `User_Name` char(30) NOT NULL,
  `Password` text NOT NULL,
  `Employee_Id` int(10) NOT NULL,
  `Role_Id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusername`
--

INSERT INTO `tblusername` (`User_Name`, `Password`, `Employee_Id`, `Role_Id`) VALUES
('admin@123', '12345', 1, 1),
('rahul@123', '12345', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladdadmin`
--
ALTER TABLE `tbladdadmin`
  ADD PRIMARY KEY (`Id`) USING BTREE,
  ADD UNIQUE KEY `User_Name` (`User_Name`) USING HASH,
  ADD UNIQUE KEY `Email` (`Email`) USING HASH;

--
-- Indexes for table `tbladdattendance`
--
ALTER TABLE `tbladdattendance`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbladdemployee`
--
ALTER TABLE `tbladdemployee`
  ADD PRIMARY KEY (`Emp_Id`),
  ADD UNIQUE KEY `Emp_Id` (`Emp_Id`);

--
-- Indexes for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblocation`
--
ALTER TABLE `tblocation`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `tblshift`
--
ALTER TABLE `tblshift`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `tblusername`
--
ALTER TABLE `tblusername`
  ADD PRIMARY KEY (`User_Name`),
  ADD UNIQUE KEY `User_Name` (`User_Name`),
  ADD UNIQUE KEY `User_Name_2` (`User_Name`),
  ADD UNIQUE KEY `Employee_Id` (`Employee_Id`),
  ADD UNIQUE KEY `Role_Id` (`Role_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladdadmin`
--
ALTER TABLE `tbladdadmin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbladdattendance`
--
ALTER TABLE `tbladdattendance`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbladdemployee`
--
ALTER TABLE `tbladdemployee`
  MODIFY `Emp_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblocation`
--
ALTER TABLE `tblocation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblshift`
--
ALTER TABLE `tblshift`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
