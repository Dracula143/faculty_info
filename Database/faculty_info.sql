-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 10:53 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `auid` text NOT NULL,
  `apwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`auid`, `apwd`) VALUES
('CRRIT01', 'Sql@123');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `cuid` text NOT NULL,
  `cname` text NOT NULL,
  `ctype` text NOT NULL,
  `cyear` text NOT NULL,
  `cstart` text NOT NULL,
  `cend` text NOT NULL,
  `cdur` text NOT NULL,
  `cfile` text NOT NULL,
  `cjournal` text NOT NULL,
  `cvol` text NOT NULL,
  `cindex` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`cuid`, `cname`, `ctype`, `cyear`, `cstart`, `cend`, `cdur`, `cfile`, `cjournal`, `cvol`, `cindex`) VALUES
('CRRIT01', 'Java Programming', 'Workshop', '2018', '2018-10-02', '2018-10-15', '0 Year 0 Months 14 Days', 'CRRIT01-A5 final ppt.pdf', '', '', ''),
('CRRIT01', 'Machine Learning', 'Paper Publication', '2018', '', '', '', 'CRRIT01-FIA Prpject.pdf', 'JNTUK', 'Volume 10', 'SCOPUS'),
('CRRIT01', 'Python Programming', 'Seminar', '2018', '2018-10-02', '2018-10-02', '0 Year 0 Months 1 Days', 'CRRIT01-Haribabu cert.pdf', '', '', ''),
('CRRIT01', 'Machine Learning', 'Conference', '2018', '', '', '', 'CRRIT01-fee recipt LE2020.pdf', 'CRRR', 'Volume 10', 'SCOPUS'),
('CRRIT01', 'Python Programming', 'Course', '2018', '2018-10-02', '2018-10-20', '0 Year 0 Months 19 Days', 'CRRIT01-LE202 fee reciept.pdf', '', '', ''),
('CRRIT01', 'Python Programmin', 'Workshop', '2015', '2015-10-02', '2016-01-15', '0 Year 3 Months 14 Days', 'CRRIT01-fee reciept LE203.pdf', '', '', ''),
('CRRIT01', 'Data Science', 'Course', '2019', '2019-01-15', '2019-06-30', '0 Year 5 Months 16 Days', 'CRRIT01-A11 AAS PROJECT1.pdf', '', '', ''),
('CRRIT01', 'Staring with R ', 'Seminar', '2020', '2020-01-12', '2020-01-12', '0 Year 0 Months 1 Days', 'CRRIT01-College Id.pdf', '', '', ''),
('CRRIT01', 'Machine Learning Part 2', 'Conference', '2020', '', '', '', 'CRRIT01-Sai_Resume.pdf', 'IRS', 'Volume 3', 'SCI'),
('CRRIT01', 'skjnsk', 'Paper Publication', '2020', '', '', '', 'CRRIT01-Adhar_Poorna.pdf', 'oinefowo', 'volume 12', 'UGC');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `edname` text NOT NULL,
  `edboard` text NOT NULL,
  `edprogram` text NOT NULL,
  `edbranch` text NOT NULL,
  `edpyear` text NOT NULL,
  `edpcntg` text NOT NULL,
  `euid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `ename` text NOT NULL,
  `edes` text NOT NULL,
  `ejyear` text NOT NULL,
  `eeyear` text NOT NULL,
  `expid` text NOT NULL,
  `etime` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_details`
--

CREATE TABLE `faculty_details` (
  `fuid` text NOT NULL,
  `fname` text NOT NULL,
  `fdob` text NOT NULL,
  `fgen` text NOT NULL,
  `fdes` text NOT NULL,
  `fphn` text NOT NULL,
  `femail` text NOT NULL,
  `fpwd` text NOT NULL,
  `fage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_details`
--

INSERT INTO `faculty_details` (`fuid`, `fname`, `fdob`, `fgen`, `fdes`, `fphn`, `femail`, `fpwd`, `fage`) VALUES
('CRRIT03', 'S Thanuz', '2001-12-10', 'Female', 'Professor', '9164892156', 'tanuz@gmail.com', 'CRRIT03', ''),
('CRRIT01', 'Karumanchi Poorna Sai', '2000-08-04', 'Male', 'Associate Professor', '9440065209', 'karumanchi.poornasai50@gmail.com', 'CRRIT01', '21 Years');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `luid` text NOT NULL,
  `ltime` text NOT NULL,
  `lstart` text NOT NULL,
  `lend` text NOT NULL,
  `lremain` text NOT NULL,
  `lrason` text NOT NULL,
  `lyear` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`luid`, `ltime`, `lstart`, `lend`, `lremain`, `lrason`, `lyear`) VALUES
('CRRIT01', '2', '2021-10-02', '2021-10-03', '12', 'SICK', '2021-22');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `suid` text NOT NULL,
  `sname` text NOT NULL,
  `sclass` text NOT NULL,
  `ssem` text NOT NULL,
  `ssec` text NOT NULL,
  `syear` text NOT NULL,
  `sstrength` text NOT NULL,
  `spass` text NOT NULL,
  `spassp` text NOT NULL,
  `sfeed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`suid`, `sname`, `sclass`, `ssem`, `ssec`, `syear`, `sstrength`, `spass`, `spassp`, `sfeed`) VALUES
('CRRIT01', 'Java Programming', '3', '1', 'A', '2021-22', '160', '60', '38', '50');

-- --------------------------------------------------------

--
-- Table structure for table `workload`
--

CREATE TABLE `workload` (
  `wuid` text NOT NULL,
  `wyear` text NOT NULL,
  `wsem` text NOT NULL,
  `wsub` text NOT NULL,
  `wtheory` text NOT NULL,
  `wlab` text NOT NULL,
  `wtotal` text NOT NULL,
  `wfrac` text NOT NULL,
  `wfile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workload`
--

INSERT INTO `workload` (`wuid`, `wyear`, `wsem`, `wsub`, `wtheory`, `wlab`, `wtotal`, `wfrac`, `wfile`) VALUES
('CRRIT01', '2021-22', '1', '2', '16', '4', '20', '1.67', 'CRRIT01-A5 final ppt.pdf');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
