-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2019 at 10:54 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thousandplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `decorations_budget`
--

CREATE TABLE `decorations_budget` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(5) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `decorations_budget`
--

INSERT INTO `decorations_budget` (`id`, `dept_id`, `amount`, `type`, `added_by`, `description`, `date`) VALUES
(7, 22, '34234.00', 'inc', 'chamath123', 'Sponsorship from Maliban', '2019-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `decorations_department`
--

CREATE TABLE `decorations_department` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `budget` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `decorations_department`
--

INSERT INTO `decorations_department` (`id`, `event`, `budget`) VALUES
(22, 20, ''),
(37, 19, ''),
(39, 25, ''),
(40, 27, ''),
(42, 22, '');

-- --------------------------------------------------------

--
-- Table structure for table `decorations_notifications`
--

CREATE TABLE `decorations_notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `task_id` int(25) NOT NULL,
  `dismiss` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `decorations_tasks`
--

CREATE TABLE `decorations_tasks` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `task_name` varchar(500) NOT NULL,
  `completion` int(11) NOT NULL,
  `completed_by` varchar(50) DEFAULT NULL,
  `assigned_to` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `decorations_tasks`
--

INSERT INTO `decorations_tasks` (`id`, `dept_id`, `task_name`, `completion`, `completed_by`, `assigned_to`) VALUES
(4, 22, 'Send proposal to RedBull', 1, 'chamath123', 'chamath123'),
(5, 22, 'confirm slt', 1, 'Omal12345', 'Omal12345'),
(6, 22, 'Find sponsorship from KFC', 1, 'Omal12345', NULL),
(7, 22, 'ddddd', 1, 'Omal12345', 'chamath123'),
(8, 22, 'Send proposal to RedBull', 0, NULL, 'Omal12345');

-- --------------------------------------------------------

--
-- Table structure for table `decorations_users`
--

CREATE TABLE `decorations_users` (
  `dept_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `decorations_users`
--

INSERT INTO `decorations_users` (`dept_id`, `username`) VALUES
(22, 'chamath123'),
(22, 'omal12345'),
(37, 'omal12345');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` varchar(1000) NOT NULL,
  `venue` varchar(500) DEFAULT NULL,
  `pic` varchar(50) NOT NULL,
  `owner` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `type`, `date`, `time`, `description`, `venue`, `pic`, `owner`) VALUES
(19, 'IEEEXtreme \'19', 'Hackathon', '2019-07-18', '15:00:00', 'IEEEXtreme is an annual worldwide hackathon organized by the IEEE organization. Over 7000 participants from more than 192 countries participate for the ultimate coding championship.', NULL, 'images/events/19.png', 'chamath123'),
(20, 'Summit \'19', 'Get Together', '2018-12-31', '08:00:00', 'Summit \'18 is the annual get together of the leaders of school Model UN societies.  ', NULL, 'images/events/20.jpg', 'chamath123'),
(22, 'IEEE Congress', 'Get Together', '2019-01-09', '10:00:00', 'ISGT will feature plenary sessions, panel sessions, technical papers, and tutorials by experts representing the electric utilities, regulators, technology providers, academia, the national laboratories, and both federal and state governments.', NULL, 'images/events/IEEE_Congress.jpg', 'chamath123'),
(25, 'Mage wedima', 'Wedding', '2019-03-19', '12:00:00', 'Man bandinawo', NULL, 'images/events/Mage_wedima.jpg', 'chamath123'),
(26, 'Umbrella', 'Wedding', '2019-01-31', '08:00:00', 'One of a Kind Wedding', NULL, 'images/events/26.jpg', 'seniya123'),
(27, 'Chamath\'s Big Girl Party', 'Birthday', '2019-02-14', '06:43:00', 'ksjhfudhsj lfl hf hsjfh kjshf lf', NULL, 'images/events/default.jpg', 'chamath123');

-- --------------------------------------------------------

--
-- Table structure for table `event_depts`
--

CREATE TABLE `event_depts` (
  `event` int(11) NOT NULL,
  `finance` varchar(5) DEFAULT NULL,
  `logistics` varchar(5) DEFAULT NULL,
  `decoration` varchar(5) DEFAULT NULL,
  `marketing` varchar(5) DEFAULT NULL,
  `registration` varchar(5) DEFAULT NULL,
  `sales` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_depts`
--

INSERT INTO `event_depts` (`event`, `finance`, `logistics`, `decoration`, `marketing`, `registration`, `sales`) VALUES
(19, 'on', 'on', 'on', 'on', 'on', 'on'),
(20, 'on', 'on', 'on', 'on', 'on', 'on'),
(22, 'on', 'on', 'on', 'on', 'on', 'on'),
(25, 'on', 'on', 'on', 'on', 'on', 'on'),
(27, 'on', 'on', 'on', 'on', 'on', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `event_reminders`
--

CREATE TABLE `event_reminders` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `reminder` varchar(512) NOT NULL,
  `username` varchar(50) NOT NULL,
  `event_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_reminders`
--

INSERT INTO `event_reminders` (`id`, `event_id`, `reminder`, `username`, `event_name`) VALUES
(3, 19, 'Yasara', 'chamath123', 'IEEEXtreme \'19');

-- --------------------------------------------------------

--
-- Table structure for table `finance_budget`
--

CREATE TABLE `finance_budget` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(5) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_budget`
--

INSERT INTO `finance_budget` (`id`, `dept_id`, `amount`, `type`, `added_by`, `description`, `date`) VALUES
(24, 44, '1000.00', 'inc', 'chamath123', 'Paid for Hall', '2019-01-02'),
(25, 39, '20000.00', 'inc', 'chamath123', 'Sponsorship from Maliban', '2019-01-02'),
(27, 39, '20000.00', 'exp', 'chamath123', 'Given to the Decorations Dept.', '2019-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `finance_company`
--

CREATE TABLE `finance_company` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `c_name` varchar(256) NOT NULL,
  `c_address` varchar(500) DEFAULT NULL,
  `c_telephone` varchar(15) DEFAULT NULL,
  `c_email` varchar(50) DEFAULT NULL,
  `c_website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_company`
--

INSERT INTO `finance_company` (`id`, `dept_id`, `c_name`, `c_address`, `c_telephone`, `c_email`, `c_website`) VALUES
(4, 44, 'Thisura Seniya Rathnayake', '', '710416841', 'seniyaratnayake@gmail.com', 'seniyaratnayake@gmail.com'),
(5, 39, 'Cargills Bank', 'Kegalle', '0710416841', 'help@cargills.com', 'www.cargills.com'),
(6, 46, 'Thisura Seniya Rathnayake', '', '710416841', 'seniyaratnayake@gmail.com', 'seniyaratnayake@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `finance_department`
--

CREATE TABLE `finance_department` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `budget` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_department`
--

INSERT INTO `finance_department` (`id`, `event`, `budget`) VALUES
(39, 20, ''),
(44, 19, ''),
(46, 25, ''),
(47, 27, ''),
(48, 22, '');

-- --------------------------------------------------------

--
-- Table structure for table `finance_notifications`
--

CREATE TABLE `finance_notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `task_id` int(25) NOT NULL,
  `dismiss` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_notifications`
--

INSERT INTO `finance_notifications` (`id`, `username`, `task_id`, `dismiss`) VALUES
(1, 'chamath123', 12, 0),
(2, 'thisura123', 20, 0),
(3, 'thisura123', 24, 0),
(5, 'Omal12345', 26, 0),
(6, 'Omal12345', 27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `finance_tasks`
--

CREATE TABLE `finance_tasks` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `task_name` varchar(500) NOT NULL,
  `completion` int(11) NOT NULL,
  `completed_by` varchar(50) DEFAULT NULL,
  `assigned_to` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_tasks`
--

INSERT INTO `finance_tasks` (`id`, `dept_id`, `task_name`, `completion`, `completed_by`, `assigned_to`) VALUES
(12, 39, 'Send proposal to RedBull', 1, 'chamath123', 'chamath123'),
(15, 39, 'Find sponsorship from KFC', 1, 'Omal12345', 'Omal12345'),
(20, 39, 'Confirm sponsorship from SLT', 1, 'chamath123', 'thisura123'),
(24, 44, 'Send proposal to RedBull', 0, NULL, 'thisura123'),
(26, 46, 'Ududxy', 0, NULL, 'Omal12345'),
(27, 47, 'Find Money', 0, NULL, 'Omal12345');

-- --------------------------------------------------------

--
-- Table structure for table `finance_users`
--

CREATE TABLE `finance_users` (
  `dept_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_users`
--

INSERT INTO `finance_users` (`dept_id`, `username`) VALUES
(39, 'chamath123'),
(39, 'omal12345'),
(39, 'thisura123'),
(44, 'omal12345'),
(44, 'thisura123'),
(46, 'Omal12345'),
(47, 'omal12345'),
(47, 'thisura123');

-- --------------------------------------------------------

--
-- Table structure for table `logistics_budget`
--

CREATE TABLE `logistics_budget` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(5) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logistics_budget`
--

INSERT INTO `logistics_budget` (`id`, `dept_id`, `amount`, `type`, `added_by`, `description`, `date`) VALUES
(1, 33, '23.00', 'inc', 'chamath123', 'Sponsorship from Maliban', '2019-01-02'),
(4, 33, '232342.00', 'exp', 'Omal12345', 'Paid for Hall', '2019-01-03'),
(5, 39, '244450.00', 'inc', 'chamath123', 'Given to the Decorations Dept.', '2019-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `logistics_department`
--

CREATE TABLE `logistics_department` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `budget` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logistics_department`
--

INSERT INTO `logistics_department` (`id`, `event`, `budget`) VALUES
(33, 20, ''),
(37, 19, ''),
(39, 25, ''),
(40, 27, ''),
(42, 22, '');

-- --------------------------------------------------------

--
-- Table structure for table `logistics_notifications`
--

CREATE TABLE `logistics_notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `task_id` int(25) NOT NULL,
  `dismiss` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logistics_notifications`
--

INSERT INTO `logistics_notifications` (`id`, `username`, `task_id`, `dismiss`) VALUES
(1, 'Omal12345', 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logistics_tasks`
--

CREATE TABLE `logistics_tasks` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `task_name` varchar(500) NOT NULL,
  `completion` int(11) NOT NULL,
  `completed_by` varchar(50) DEFAULT NULL,
  `assigned_to` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logistics_tasks`
--

INSERT INTO `logistics_tasks` (`id`, `dept_id`, `task_name`, `completion`, `completed_by`, `assigned_to`) VALUES
(7, 33, 'Send proposal to RedBull', 1, 'chamath123', 'Omal12345'),
(8, 33, 'confirm slt', 1, 'chamath123', 'chamath123'),
(9, 33, 'Find sponsorship from KFC', 1, 'chamath123', 'chamath123'),
(10, 33, 'ddddd', 1, 'chamath123', 'chamath123'),
(12, 39, 'asdasd', 1, 'chamath123', 'Omal12345');

-- --------------------------------------------------------

--
-- Table structure for table `logistics_users`
--

CREATE TABLE `logistics_users` (
  `dept_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logistics_users`
--

INSERT INTO `logistics_users` (`dept_id`, `username`) VALUES
(33, 'chamath123'),
(33, 'omal12345'),
(39, 'omal12345');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_budget`
--

CREATE TABLE `marketing_budget` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(5) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_department`
--

CREATE TABLE `marketing_department` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `budget` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketing_department`
--

INSERT INTO `marketing_department` (`id`, `event`, `budget`) VALUES
(29, 19, ''),
(39, 20, ''),
(41, 25, ''),
(42, 27, ''),
(44, 22, '');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_notifications`
--

CREATE TABLE `marketing_notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `task_id` int(25) NOT NULL,
  `dismiss` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_tasks`
--

CREATE TABLE `marketing_tasks` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `task_name` varchar(500) NOT NULL,
  `completion` int(11) NOT NULL,
  `completed_by` varchar(50) DEFAULT NULL,
  `assigned_to` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketing_tasks`
--

INSERT INTO `marketing_tasks` (`id`, `dept_id`, `task_name`, `completion`, `completed_by`, `assigned_to`) VALUES
(3, 39, 'Send proposal to RedBull', 1, 'chamath123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marketing_users`
--

CREATE TABLE `marketing_users` (
  `dept_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `msg_read` int(11) NOT NULL,
  `seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_from`, `user_to`, `message`, `date`, `time`, `msg_read`, `seen`) VALUES
(1, 'chamath123', 'thisura123', '1', '2019-01-18', '01:00:00', 0, 0),
(2, 'Omal12345', 'chamath123', '1', '2019-01-18', '02:00:00', 0, 0),
(3, 'chamath123', 'thisura123', '2', '2019-01-18', '20:57:17', 0, 0),
(4, 'chamath123', 'Omal12345', '2', '2019-01-18', '20:57:50', 0, 0),
(5, 'chamath123', 'Omal12345', '3', '2019-01-18', '21:01:23', 0, 0),
(6, 'chamath123', 'thisura123', '3', '2019-01-18', '21:01:35', 0, 0),
(7, 'chamath123', 'thisura123', '4', '2019-01-18', '21:01:58', 0, 0),
(8, 'chamath123', 'thisura123', '5', '2019-01-18', '21:01:59', 0, 0),
(9, 'chamath123', 'thisura123', '6', '2019-01-18', '21:02:00', 0, 0),
(10, 'chamath123', 'thisura123', '7', '2019-01-18', '21:02:01', 0, 0),
(11, 'chamath123', 'thisura123', '8', '2019-01-18', '21:02:01', 0, 0),
(13, 'chamath123', 'Omal12345', '4', '2019-01-18', '21:03:04', 0, 0),
(14, 'chamath123', 'Omal12345', '5', '2019-01-18', '21:03:05', 0, 0),
(15, 'chamath123', 'Omal12345', '6', '2019-01-18', '21:03:06', 0, 0),
(16, 'chamath123', 'Omal12345', '7', '2019-01-18', '21:03:08', 0, 0),
(17, 'chamath123', 'Omal12345', '8', '2019-01-18', '21:03:09', 0, 0),
(18, 'chamath123', 'Omal12345', '9', '2019-01-18', '21:03:10', 0, 0),
(19, 'chamath123', 'thisura123', 'bhjbjbh', '2019-01-18', '21:21:09', 0, 0),
(20, 'chamath123', 'thisura123', 'h', '2019-01-18', '21:59:19', 0, 0),
(21, 'chamath123', 'thisura123', 'hello', '2019-01-18', '21:59:27', 0, 0),
(22, 'thisura123', 'chamath123', 'hi', '2019-01-18', '22:00:33', 0, 0),
(23, 'thisura123', 'chamath123', 'how are you?', '2019-01-18', '22:00:39', 0, 0),
(24, 'thisura123', 'chamath123', 'hi', '2019-01-18', '22:00:49', 0, 0),
(25, 'chamath123', 'thisura123', 'h', '2019-01-18', '22:01:55', 0, 0),
(26, 'chamath123', 'thisura123', 'q', '2019-01-18', '22:02:04', 0, 0),
(27, 'thisura123', 'chamath123', 'jj', '2019-01-18', '22:03:24', 0, 0),
(28, 'chamath123', 'thisura123', 'u', '2019-01-18', '22:03:43', 0, 0),
(29, 'thisura123', 'chamath123', 'final', '2019-01-18', '22:05:26', 0, 0),
(30, 'thisura123', 'chamath123', 'f', '2019-01-18', '22:05:54', 0, 0),
(31, 'thisura123', 'chamath123', 'sd', '2019-01-18', '22:06:05', 0, 0),
(32, 'thisura123', 'chamath123', 'iiii', '2019-01-18', '22:06:33', 0, 0),
(33, 'thisura123', 'chamath123', 'o', '2019-01-18', '22:06:45', 0, 0),
(34, 'chamath123', 'Omal12345', 'sd', '2019-01-18', '22:09:20', 0, 0),
(35, 'thisura123', 'chamath123', 'dfsdf', '2019-01-18', '22:10:09', 0, 0),
(36, 'thisura123', 'chamath123', 'hello', '2019-01-18', '22:10:14', 0, 0),
(37, 'thisura123', 'chamath123', 'seniya', '2019-01-18', '22:10:53', 0, 0),
(38, 'thisura123', 'chamath123', 'how are you?', '2019-01-18', '22:10:57', 0, 0),
(39, 'chamath123', 'thisura123', 'I am fine', '2019-01-18', '22:11:02', 0, 0),
(40, 'chamath123', 'thisura123', 'obe leda duk kese da?', '2019-01-18', '22:11:10', 0, 0),
(41, 'chamath123', 'thisura123', 'buhahahaha', '2019-01-18', '22:11:17', 0, 0),
(42, 'thisura123', 'chamath123', 'nikan indapiya', '2019-01-18', '22:11:24', 0, 0),
(43, 'chamath123', 'thisura123', 'anee', '2019-01-18', '22:11:26', 0, 0),
(44, 'thisura123', 'chamath123', 'ai ohoma', '2019-01-18', '22:11:33', 0, 0),
(45, 'chamath123', 'thisura123', 'yana thanaka', '2019-01-18', '22:11:55', 0, 0),
(46, 'chamath123', 'thisura123', 'inna saama da', '2019-01-18', '22:11:58', 0, 0),
(47, 'chamath123', 'thisura123', 'sathutin oya', '2019-01-18', '22:12:02', 0, 0),
(48, 'thisura123', 'chamath123', 'buhahahahahaha', '2019-01-18', '22:12:12', 0, 0),
(49, 'chamath123', 'Omal12345', 'hello', '2019-01-20', '00:52:52', 0, 0),
(50, 'chamath123', 'thisura123', 'yaka', '2019-01-20', '01:00:17', 0, 0),
(51, 'chamath123', 'thisura123', 'hooooo', '2019-01-20', '01:03:52', 0, 0),
(52, 'chamath123', 'thisura123', 'yo yo', '2019-01-20', '01:04:49', 0, 0),
(53, 'chamath123', 'Omal12345', 's', '2019-01-20', '01:17:11', 0, 0),
(54, 'chamath123', 'Omal12345', 'dd', '2019-01-20', '01:17:17', 0, 0),
(55, 'chamath123', 'thisura123', 's', '2019-01-20', '01:17:42', 0, 0),
(56, 'chamath123', 'Omal12345', 'ss', '2019-01-20', '01:17:58', 0, 0),
(57, 'thisura123', 'chamath123', 'nigga', '2019-06-02', '18:02:11', 0, 0),
(58, 'chamath123', 'thisura123', 'hi', '2019-06-02', '18:02:18', 0, 0),
(59, 'chamath123', 'thisura123', 'kohomada', '2019-06-02', '18:02:26', 0, 0),
(60, 'thisura123', 'chamath123', 'hodin innawa bn', '2019-06-02', '18:02:37', 0, 0),
(61, 'chamath123', 'thisura123', 'ada gedarada', '2019-06-02', '18:02:49', 0, 0),
(62, 'chamath123', 'thisura123', 'van tika heduwada', '2019-06-02', '18:02:57', 0, 0),
(63, 'chamath123', 'thisura123', 'ithin ithin', '2019-06-02', '18:03:35', 0, 0),
(64, 'chamath123', 'thisura123', 'iiir', '2019-06-02', '18:03:37', 0, 0),
(65, 'chamath123', 'thisura123', 'dgf', '2019-06-02', '18:03:40', 0, 0),
(66, 'chamath123', 'thisura123', 'sd', '2019-06-02', '18:03:41', 0, 0),
(67, 'chamath123', 'thisura123', 'dfg', '2019-06-02', '18:03:45', 0, 0),
(68, 'chamath123', 'thisura123', 'fff', '2019-06-02', '18:03:47', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `registrations_department`
--

CREATE TABLE `registrations_department` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `budget` varchar(10) NOT NULL,
  `target` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrations_department`
--

INSERT INTO `registrations_department` (`id`, `event`, `budget`, `target`) VALUES
(23, 19, '', NULL),
(29, 20, '', 20),
(33, 25, '', NULL),
(34, 27, '', NULL),
(36, 22, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrations_notifications`
--

CREATE TABLE `registrations_notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `task_id` int(25) NOT NULL,
  `dismiss` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registrations_rsvp`
--

CREATE TABLE `registrations_rsvp` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `confirmed` int(11) NOT NULL,
  `attended` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrations_rsvp`
--

INSERT INTO `registrations_rsvp` (`id`, `dept_id`, `name`, `email`, `telephone`, `address`, `confirmed`, `attended`) VALUES
(8, 29, 'Thisura Seniya Rathnayake', 'seniyaratnayake@gmail.com', '0710416841', '351/5\r\nMunamalgahawaththe Road, Dalugama,', 1, 0),
(9, 29, 'Damith de Silva', 'damith@gmail.com', '710416841', '351/5\r\nMunamalgahawaththe Road, Dalugama,', 1, 1),
(10, 29, 'Vinuri Gayanthika', 'vinurigayanthika@gmail.com', '0711881681', 'Kurunegala', 1, 0),
(11, 29, 'Yasara Magamage', 'yasara@gmail.com', '0715164876', '351/5\r\nMunamalgahawaththe Road, Dalugama,', 1, NULL),
(12, 29, 'Gaweshi', 'gawesi@gmail.com', '07182674846', 'asdasdd', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registrations_tasks`
--

CREATE TABLE `registrations_tasks` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `task_name` varchar(500) NOT NULL,
  `completion` int(11) NOT NULL,
  `completed_by` varchar(50) DEFAULT NULL,
  `assigned_to` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrations_tasks`
--

INSERT INTO `registrations_tasks` (`id`, `dept_id`, `task_name`, `completion`, `completed_by`, `assigned_to`) VALUES
(6, 29, 'Send proposal to RedBull', 1, 'chamath123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrations_users`
--

CREATE TABLE `registrations_users` (
  `dept_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrations_users`
--

INSERT INTO `registrations_users` (`dept_id`, `username`) VALUES
(29, 'chamath123'),
(29, 'omal12345');

-- --------------------------------------------------------

--
-- Table structure for table `sales_budget`
--

CREATE TABLE `sales_budget` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(5) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_budget`
--

INSERT INTO `sales_budget` (`id`, `dept_id`, `amount`, `type`, `added_by`, `description`, `date`) VALUES
(3, 31, '2323.00', 'inc', 'chamath123', 'Sponsorship from Maliban', '2019-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `sales_department`
--

CREATE TABLE `sales_department` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `budget` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_department`
--

INSERT INTO `sales_department` (`id`, `event`, `budget`) VALUES
(25, 19, ''),
(31, 20, ''),
(34, 25, ''),
(35, 27, ''),
(37, 22, '');

-- --------------------------------------------------------

--
-- Table structure for table `sales_notifications`
--

CREATE TABLE `sales_notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `task_id` int(25) NOT NULL,
  `dismiss` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_tasks`
--

CREATE TABLE `sales_tasks` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `task_name` varchar(500) NOT NULL,
  `completion` int(11) NOT NULL,
  `completed_by` varchar(50) DEFAULT NULL,
  `assigned_to` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_tasks`
--

INSERT INTO `sales_tasks` (`id`, `dept_id`, `task_name`, `completion`, `completed_by`, `assigned_to`) VALUES
(3, 31, 'Send proposal to RedBull', 1, 'Omal12345', 'Omal12345'),
(4, 31, 'confirm slt', 1, 'chamath123', 'chamath123'),
(6, 31, 'Confirm Munchee', 1, 'chamath123', 'Omal12345');

-- --------------------------------------------------------

--
-- Table structure for table `sales_users`
--

CREATE TABLE `sales_users` (
  `dept_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_users`
--

INSERT INTO `sales_users` (`dept_id`, `username`) VALUES
(31, 'chamath123'),
(31, 'omal12345');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `ida` int(11) NOT NULL,
  `data` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`ida`, `data`) VALUES
(1, ''),
(2, '1'),
(3, 'chamath123'),
(4, '20'),
(5, '29'),
(6, '29'),
(7, '20'),
(8, '4'),
(9, ''),
(10, ''),
(11, ''),
(12, ''),
(13, ''),
(14, ''),
(15, 'asdasda sdasd aa sd'),
(16, ''),
(17, 's'),
(18, 'ss'),
(19, ''),
(20, 'w'),
(21, 'ww'),
(22, '20'),
(23, '29'),
(24, '20'),
(25, '29'),
(26, '29'),
(27, '20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `type`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 0),
('chamath123', '25d55ad283aa400af464c76d713c07ad', 1),
('Omal12345', '25d55ad283aa400af464c76d713c07ad', 1),
('seniya123', '25d55ad283aa400af464c76d713c07ad', 1),
('thisura123', '25d55ad283aa400af464c76d713c07ad', 1),
('yasara123', '25d55ad283aa400af464c76d713c07ad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `reminders` int(11) DEFAULT NULL,
  `validated` int(11) NOT NULL,
  `validate_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `username`, `fname`, `lname`, `gender`, `email`, `nic`, `pic`, `telephone`, `reminders`, `validated`, `validate_code`) VALUES
(14, 'chamath123', 'Chamath', 'Rathnayake', 'Male', 'chamatherandikaucsc@gmail.com', '954561238v', 'images/propic/chamath1237.jpg', '0774546454', 1, 1, NULL),
(17, 'Omal12345', 'Omal ', 'Wijegunawardena', 'Male', 'omal@live.com', '952401300v', 'images/propic/Omal12345.jpg', '0771564568', 1, 1, NULL),
(18, 'thisura123', 'Thisura', 'Rathnayake', 'Male', 'seniyaratnayake@gmail.com', '962971393v', 'images/propic/thisura123.jpg', '0710416841', 1, 1, NULL),
(25, 'yasara123', 'Yasara', 'Magamage', 'Male', 'yasara@gmail.com', '9658923154v', 'images/propic/yasara1231.jpg', '0718615464', 1, 1, 576754),
(26, 'seniya123', 'Thisura', 'Rathnayake', 'Male', 'thousandplusevents@gmail.com', '962971393v', 'images/propic/seniya123.jpg', '710416841', 1, 1, 466493);

-- --------------------------------------------------------

--
-- Table structure for table `user_temp_pass`
--

CREATE TABLE `user_temp_pass` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `temp_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `category` varchar(50) NOT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `lon` decimal(20,15) DEFAULT NULL,
  `lat` decimal(20,15) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `owner`, `name`, `telephone`, `address`, `category`, `open`, `close`, `lon`, `lat`, `pic`) VALUES
(3, 'chamath123', 'Umbrella Photography', '0710416841', '351/5, \r\nMunamalgahawatte Road, \r\nDalugama,\r\nKelaniya,\r\nSri Lanka.\r\n11600', 'Photography', '08:00:00', '06:00:00', '79.920504625476950', '6.965307044317930', 'images/types/Photography.jpg'),
(4, 'chamath123', 'Arpico Super Store', '0118489649', '123, Kandy Rd., Dalugama\r\nKelaniya 11600\r\nSri Lanka', 'Supermarket', '09:00:00', '06:30:00', '79.925338625907900', '6.975997151529040', 'images/types/Supermarket.jpg'),
(5, 'chamath123', 'ghghg', '344343334', '351/5\r\nMunamalgahawaththe Road, Dalugama,', 'Photography', '11:12:00', '17:12:00', '80.254508741357430', '7.799137085110825', 'images/types/Photography.jpg'),
(6, 'yasara123', 'Hilton Colombo', '07156459', '2 Sir Chittampalam A Gardiner Mawatha\r\nColombo 00200\r\nSri Lanka', 'Caterer', '00:00:00', '00:00:00', '79.845285415649410', '6.932183426159984', 'images/types/Caterer.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `decorations_budget`
--
ALTER TABLE `decorations_budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dept_budget` (`dept_id`);

--
-- Indexes for table `decorations_department`
--
ALTER TABLE `decorations_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event` (`event`),
  ADD KEY `FK_event_finance` (`event`);

--
-- Indexes for table `decorations_notifications`
--
ALTER TABLE `decorations_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_notification_user` (`username`),
  ADD KEY `d_notification_task` (`task_id`);

--
-- Indexes for table `decorations_tasks`
--
ALTER TABLE `decorations_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completed_by` (`completed_by`),
  ADD KEY `FK_tasks_finance` (`dept_id`);

--
-- Indexes for table `decorations_users`
--
ALTER TABLE `decorations_users`
  ADD PRIMARY KEY (`dept_id`,`username`),
  ADD KEY `fk_user_finance` (`username`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_event` (`owner`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `event_depts`
--
ALTER TABLE `event_depts`
  ADD PRIMARY KEY (`event`);

--
-- Indexes for table `event_reminders`
--
ALTER TABLE `event_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_event_reminders_e_id` (`event_id`),
  ADD KEY `fk_reminders_event_name` (`event_name`),
  ADD KEY `fk_username_reminder` (`username`);

--
-- Indexes for table `finance_budget`
--
ALTER TABLE `finance_budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finance_dept_fk` (`dept_id`);

--
-- Indexes for table `finance_company`
--
ALTER TABLE `finance_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dept_fin_comp` (`dept_id`);

--
-- Indexes for table `finance_department`
--
ALTER TABLE `finance_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event` (`event`),
  ADD KEY `FK_event_finance` (`event`);

--
-- Indexes for table `finance_notifications`
--
ALTER TABLE `finance_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_notification_user` (`username`),
  ADD KEY `f_notification_task` (`task_id`);

--
-- Indexes for table `finance_tasks`
--
ALTER TABLE `finance_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completed_by` (`completed_by`),
  ADD KEY `FK_tasks_finance` (`dept_id`);

--
-- Indexes for table `finance_users`
--
ALTER TABLE `finance_users`
  ADD PRIMARY KEY (`dept_id`,`username`),
  ADD KEY `fk_user_finance` (`username`);

--
-- Indexes for table `logistics_budget`
--
ALTER TABLE `logistics_budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dept_budget` (`dept_id`);

--
-- Indexes for table `logistics_department`
--
ALTER TABLE `logistics_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event` (`event`),
  ADD KEY `FK_event_finance` (`event`);

--
-- Indexes for table `logistics_notifications`
--
ALTER TABLE `logistics_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `l_notification_user` (`username`),
  ADD KEY `l_notification_task` (`task_id`);

--
-- Indexes for table `logistics_tasks`
--
ALTER TABLE `logistics_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completed_by` (`completed_by`),
  ADD KEY `FK_tasks_finance` (`dept_id`);

--
-- Indexes for table `logistics_users`
--
ALTER TABLE `logistics_users`
  ADD PRIMARY KEY (`dept_id`,`username`),
  ADD KEY `fk_user_finance` (`username`);

--
-- Indexes for table `marketing_budget`
--
ALTER TABLE `marketing_budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dept_budget` (`dept_id`);

--
-- Indexes for table `marketing_department`
--
ALTER TABLE `marketing_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event` (`event`),
  ADD KEY `FK_event_finance` (`event`);

--
-- Indexes for table `marketing_notifications`
--
ALTER TABLE `marketing_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_notification_user` (`username`),
  ADD KEY `m_notification_task` (`task_id`);

--
-- Indexes for table `marketing_tasks`
--
ALTER TABLE `marketing_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completed_by` (`completed_by`),
  ADD KEY `FK_tasks_finance` (`dept_id`);

--
-- Indexes for table `marketing_users`
--
ALTER TABLE `marketing_users`
  ADD PRIMARY KEY (`dept_id`,`username`),
  ADD KEY `fk_user_finance` (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_from` (`user_from`),
  ADD KEY `user_to` (`user_to`);

--
-- Indexes for table `registrations_department`
--
ALTER TABLE `registrations_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event` (`event`),
  ADD KEY `FK_event_finance` (`event`);

--
-- Indexes for table `registrations_notifications`
--
ALTER TABLE `registrations_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_notification_user` (`username`),
  ADD KEY `r_notification_task` (`task_id`);

--
-- Indexes for table `registrations_rsvp`
--
ALTER TABLE `registrations_rsvp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rsvp_fk` (`dept_id`);

--
-- Indexes for table `registrations_tasks`
--
ALTER TABLE `registrations_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completed_by` (`completed_by`),
  ADD KEY `FK_tasks_finance` (`dept_id`);

--
-- Indexes for table `registrations_users`
--
ALTER TABLE `registrations_users`
  ADD PRIMARY KEY (`dept_id`,`username`),
  ADD KEY `fk_user_finance` (`username`);

--
-- Indexes for table `sales_budget`
--
ALTER TABLE `sales_budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dept_budget` (`dept_id`);

--
-- Indexes for table `sales_department`
--
ALTER TABLE `sales_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event` (`event`),
  ADD KEY `FK_event_finance` (`event`);

--
-- Indexes for table `sales_notifications`
--
ALTER TABLE `sales_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_notification_user` (`username`),
  ADD KEY `s_notification_task` (`task_id`);

--
-- Indexes for table `sales_tasks`
--
ALTER TABLE `sales_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completed_by` (`completed_by`),
  ADD KEY `FK_tasks_finance` (`dept_id`);

--
-- Indexes for table `sales_users`
--
ALTER TABLE `sales_users`
  ADD PRIMARY KEY (`dept_id`,`username`),
  ADD KEY `fk_user_finance` (`username`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`ida`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_users` (`username`);

--
-- Indexes for table `user_temp_pass`
--
ALTER TABLE `user_temp_pass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendors_username` (`owner`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `decorations_budget`
--
ALTER TABLE `decorations_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `decorations_department`
--
ALTER TABLE `decorations_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `decorations_notifications`
--
ALTER TABLE `decorations_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `decorations_tasks`
--
ALTER TABLE `decorations_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `event_reminders`
--
ALTER TABLE `event_reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `finance_budget`
--
ALTER TABLE `finance_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `finance_company`
--
ALTER TABLE `finance_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `finance_department`
--
ALTER TABLE `finance_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `finance_notifications`
--
ALTER TABLE `finance_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `finance_tasks`
--
ALTER TABLE `finance_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `logistics_budget`
--
ALTER TABLE `logistics_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logistics_department`
--
ALTER TABLE `logistics_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `logistics_notifications`
--
ALTER TABLE `logistics_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logistics_tasks`
--
ALTER TABLE `logistics_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `marketing_budget`
--
ALTER TABLE `marketing_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing_department`
--
ALTER TABLE `marketing_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `marketing_notifications`
--
ALTER TABLE `marketing_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing_tasks`
--
ALTER TABLE `marketing_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `registrations_department`
--
ALTER TABLE `registrations_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `registrations_notifications`
--
ALTER TABLE `registrations_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrations_rsvp`
--
ALTER TABLE `registrations_rsvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `registrations_tasks`
--
ALTER TABLE `registrations_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_budget`
--
ALTER TABLE `sales_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_department`
--
ALTER TABLE `sales_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sales_notifications`
--
ALTER TABLE `sales_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_tasks`
--
ALTER TABLE `sales_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_temp_pass`
--
ALTER TABLE `user_temp_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `decorations_budget`
--
ALTER TABLE `decorations_budget`
  ADD CONSTRAINT `decorations_budget_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `decorations_department` (`id`);

--
-- Constraints for table `decorations_department`
--
ALTER TABLE `decorations_department`
  ADD CONSTRAINT `fk_event_deco` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `decorations_notifications`
--
ALTER TABLE `decorations_notifications`
  ADD CONSTRAINT `d_notification_task` FOREIGN KEY (`task_id`) REFERENCES `decorations_tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `d_notification_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `decorations_tasks`
--
ALTER TABLE `decorations_tasks`
  ADD CONSTRAINT `fk_task_deco` FOREIGN KEY (`dept_id`) REFERENCES `decorations_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_task_deco_user` FOREIGN KEY (`completed_by`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `decorations_users`
--
ALTER TABLE `decorations_users`
  ADD CONSTRAINT `fk_user_deco` FOREIGN KEY (`dept_id`) REFERENCES `decorations_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_deco` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_user_event` FOREIGN KEY (`owner`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `event_depts`
--
ALTER TABLE `event_depts`
  ADD CONSTRAINT `event_depts_event_id` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_reminders`
--
ALTER TABLE `event_reminders`
  ADD CONSTRAINT `fk_event_reminders_e_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reminders_event_name` FOREIGN KEY (`event_name`) REFERENCES `events` (`name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_username_reminder` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `finance_budget`
--
ALTER TABLE `finance_budget`
  ADD CONSTRAINT `finance_dept_fk` FOREIGN KEY (`dept_id`) REFERENCES `finance_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_dept_budget` FOREIGN KEY (`dept_id`) REFERENCES `finance_department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `finance_company`
--
ALTER TABLE `finance_company`
  ADD CONSTRAINT `fk_dept_fin_comp` FOREIGN KEY (`dept_id`) REFERENCES `finance_department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `finance_department`
--
ALTER TABLE `finance_department`
  ADD CONSTRAINT `FK_event_finance` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `finance_notifications`
--
ALTER TABLE `finance_notifications`
  ADD CONSTRAINT `f_notification_task` FOREIGN KEY (`task_id`) REFERENCES `finance_tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f_notification_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `finance_tasks`
--
ALTER TABLE `finance_tasks`
  ADD CONSTRAINT `FK_tasks_finance` FOREIGN KEY (`dept_id`) REFERENCES `finance_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `finance_tasks_ibfk_1` FOREIGN KEY (`completed_by`) REFERENCES `users` (`username`);

--
-- Constraints for table `finance_users`
--
ALTER TABLE `finance_users`
  ADD CONSTRAINT `FK_users_finance` FOREIGN KEY (`dept_id`) REFERENCES `finance_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_finance` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `logistics_budget`
--
ALTER TABLE `logistics_budget`
  ADD CONSTRAINT `logistics_budget_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `logistics_department` (`id`);

--
-- Constraints for table `logistics_department`
--
ALTER TABLE `logistics_department`
  ADD CONSTRAINT `fk_event_logi` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logistics_notifications`
--
ALTER TABLE `logistics_notifications`
  ADD CONSTRAINT `l_notification_task` FOREIGN KEY (`task_id`) REFERENCES `logistics_tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `l_notification_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `logistics_tasks`
--
ALTER TABLE `logistics_tasks`
  ADD CONSTRAINT `fk_task_logi` FOREIGN KEY (`dept_id`) REFERENCES `logistics_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_task_logi_user` FOREIGN KEY (`completed_by`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `logistics_users`
--
ALTER TABLE `logistics_users`
  ADD CONSTRAINT `fk_user_logi` FOREIGN KEY (`dept_id`) REFERENCES `logistics_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_logi` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `marketing_budget`
--
ALTER TABLE `marketing_budget`
  ADD CONSTRAINT `market_dept_fk` FOREIGN KEY (`dept_id`) REFERENCES `marketing_department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marketing_department`
--
ALTER TABLE `marketing_department`
  ADD CONSTRAINT `fk_event_market` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marketing_notifications`
--
ALTER TABLE `marketing_notifications`
  ADD CONSTRAINT `m_notification_task` FOREIGN KEY (`task_id`) REFERENCES `marketing_tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `m_notification_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `marketing_tasks`
--
ALTER TABLE `marketing_tasks`
  ADD CONSTRAINT `fk_task_market` FOREIGN KEY (`dept_id`) REFERENCES `marketing_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_task_market_user` FOREIGN KEY (`completed_by`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `marketing_users`
--
ALTER TABLE `marketing_users`
  ADD CONSTRAINT `fk_user_market` FOREIGN KEY (`dept_id`) REFERENCES `marketing_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_market` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `registrations_department`
--
ALTER TABLE `registrations_department`
  ADD CONSTRAINT `fk_event_registrations` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations_notifications`
--
ALTER TABLE `registrations_notifications`
  ADD CONSTRAINT `r_notification_task` FOREIGN KEY (`task_id`) REFERENCES `registrations_tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `r_notification_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `registrations_rsvp`
--
ALTER TABLE `registrations_rsvp`
  ADD CONSTRAINT `fk_dept_rsvp` FOREIGN KEY (`dept_id`) REFERENCES `registrations_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rsvp_fk` FOREIGN KEY (`dept_id`) REFERENCES `registrations_department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations_tasks`
--
ALTER TABLE `registrations_tasks`
  ADD CONSTRAINT `fk_task_registrations` FOREIGN KEY (`dept_id`) REFERENCES `registrations_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_task_registrations_user` FOREIGN KEY (`completed_by`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `registrations_users`
--
ALTER TABLE `registrations_users`
  ADD CONSTRAINT `fk_user_registrations` FOREIGN KEY (`dept_id`) REFERENCES `registrations_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_registrations` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `sales_budget`
--
ALTER TABLE `sales_budget`
  ADD CONSTRAINT `sale_dept_fk` FOREIGN KEY (`dept_id`) REFERENCES `sales_department` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_department`
--
ALTER TABLE `sales_department`
  ADD CONSTRAINT `fk_event_sales` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_notifications`
--
ALTER TABLE `sales_notifications`
  ADD CONSTRAINT `s_notification_task` FOREIGN KEY (`task_id`) REFERENCES `sales_tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `s_notification_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `sales_tasks`
--
ALTER TABLE `sales_tasks`
  ADD CONSTRAINT `fk_task_sales` FOREIGN KEY (`dept_id`) REFERENCES `sales_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_task_sales_user` FOREIGN KEY (`completed_by`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `sales_users`
--
ALTER TABLE `sales_users`
  ADD CONSTRAINT `fk_user_sales` FOREIGN KEY (`dept_id`) REFERENCES `sales_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_sales` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `FK_users` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_username` FOREIGN KEY (`owner`) REFERENCES `users` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
