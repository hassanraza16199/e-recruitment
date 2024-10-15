-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 08:48 AM
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
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_title` varchar(250) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `cnic` varchar(160) NOT NULL,
  `contact_number` int(15) NOT NULL,
  `date_birth` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `candidate_education` varchar(1100) NOT NULL,
  `candidate_skill` varchar(1100) NOT NULL,
  `candidate_experience` varchar(100) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `candidate_id`, `recruiter_id`, `job_id`, `job_title`, `firstname`, `lastname`, `email_address`, `cnic`, `contact_number`, `date_birth`, `city`, `candidate_education`, `candidate_skill`, `candidate_experience`, `resume`, `status`, `date`) VALUES
(58, 18, 21, 85, '', 'kiran', '12', 'kiran@gmail.com', '', 0, '', '', 'BSCS', 'Front end', '1', '1727452614HussnainUmer-CV.pdf', '', '2024-09-27'),
(59, 18, 21, 85, '', 'kiran', '12', 'ali@gmail.com', '', 0, '', 'Pakistan', 'Inter', 'Back end', '1', '1727533898HussnainUmer-CV.pdf', 'Pending', '2024-09-28'),
(62, 18, 21, 87, '', 'kiran', '12', 'eye@gmail.com', '23233232322323', 111111111, '2000-11-02', 'Pakistan', 'Mphil', 'dfhgd', '1', '1728119250HussnainUmer-CV.pdf', '', '2024-10-05'),
(63, 18, 21, 87, '', 'kiran', '12', 'eye@gmail.com', '23233232322323', 1111111111, '', '', 'dhg', 'dfhgd', '1', '1728279530HussnainUmer-CV.pdf', '', '2024-10-07'),
(64, 18, 21, 87, '', 'kiran', '12', 'eye@gmail.com', '23233232322323', 1111111111, '', '', 'dhg', 'dfhgd', 'dsfgh', '1728279571HussnainUmer-CV.pdf', '', '2024-10-07'),
(65, 18, 21, 87, '', 'kiran', '12', 'eye@gmail.com', '', 1111111111, '', '', '', '', '', '1728279589HussnainUmer-CV.pdf', 'Pending', '2024-10-07'),
(66, 18, 21, 87, 'Sign1', 'kiran', '12', 'eye@gmail.com', '', 1111111111, '', '', '', '', '', '1728279859HussnainUmer-CV.pdf', 'Shortlist', '2024-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `user_name` varchar(111) NOT NULL,
  `sender_email` varchar(111) NOT NULL,
  `subject` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `message`, `user_name`, `sender_email`, `subject`) VALUES
(2, 'fhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftg', 'Ali', 'ality342@gmail.com', 'send'),
(4, 'fhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftghdffhgjdftg', 'Ali', 'ality342@gmail.com', 'send'),
(5, 'Hello', 'Ali', 'ality342@gmail.com', 'send'),
(6, 'Hello', 'Ali', 'ality342@gmail.com', 'send'),
(7, 'Hello', 'Ali', 'ality342@gmail.com', 'send'),
(9, 'Hiii', 'hussnain', 'hussnain@gmail.com', 'reciver'),
(10, 'dfgd', 'hussnain', 'ality34@gmail.com', 'send'),
(11, 'dfgd', 'hussnain', 'ality34@gmail.com', 'send'),
(12, 'bhdfg', 'Ali', 'ality342@gmail.com', 'send'),
(13, 'bhdfg', 'Ali', 'ality342@gmail.com', 'send'),
(14, 'hg', 'Ali', 'ality342@gmail.com', 'send'),
(15, 'hg', 'Ali', 'ality342@gmail.com', 'send'),
(16, 'fgjh', 'Ali', 'ality342@gmail.com', 'send'),
(17, 'fhf', 'hussnain', 'ality342@gmail.com', 'reciver'),
(18, 'hbj', 'Ali', 'ality342@gmail.com', 'send'),
(19, 'df', 'Ali', 'ality342@gmail.com', 'send'),
(20, 'df', 'Ali', 'ality342@gmail.com', 'send'),
(21, 'df', 'Ali', 'ality342@gmail.com', 'send');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `rating` varchar(250) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `user_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `recruiter_id`, `job_id`, `user_name`, `rating`, `comment`, `user_type`) VALUES
(20, 21, 0, 0, 'Andleeb', 'amazing', 'Amazing', 'Recruiter'),
(25, 18, 0, 0, 'Kiran', 'okay', '', 'Candidate'),
(26, 18, 0, 0, 'Kiran', 'okay', '', ''),
(27, 18, 0, 0, 'Kiran', 'good', '', ''),
(28, 21, 0, 0, 'Andleeb', 'good', 'Good', ''),
(29, 21, 0, 0, 'Andleeb', 'amazing', 'Amazing', ''),
(30, 21, 0, 0, 'Andleeb', 'okay', 'okay', 'Recruiter'),
(31, 21, 0, 0, 'Andleeb', 'okay', 'okay', ''),
(32, 21, 0, 0, 'Andleeb', 'amazing', '', ''),
(33, 18, 0, 0, 'Kiran', 'okay', 'okay', ''),
(34, 18, 0, 0, 'Kiran', 'okay', 'okay', ''),
(35, 18, 0, 0, 'Kiran', 'good', 'good', ''),
(36, 18, 0, 0, 'Kiran', 'good', '', ''),
(37, 18, 0, 0, 'Kiran', 'okay', '', ''),
(49, 18, 0, 0, 'Kiran', 'okay', '', ''),
(50, 21, 0, 0, 'Andleeb', 'good', '', ''),
(51, 21, 0, 0, 'Andleeb', 'good', '', ''),
(52, 21, 0, 0, 'Andleeb', 'good', '', ''),
(53, 21, 0, 0, 'Andleeb', 'good', '', ''),
(54, 18, 0, 0, 'Kiran', 'good', '', 'Candidate'),
(56, 21, 0, 0, 'Andleeb', 'good', '', 'Recruiter'),
(57, 21, 0, 0, 'Andleeb', 'terrible', 'ttt', 'Recruiter'),
(58, 18, 21, 84, 'Kiran', 'amazing', 'Amazing Website', 'Candidate'),
(59, 21, 0, 0, 'Andleeb', 'okay', 'Waoooo', 'Recruiter'),
(60, 18, 21, 86, 'Kiran', 'bad', 'Bad', ''),
(61, 21, 0, 0, 'Andleeb', 'okay', 'Okay', 'Recruiter'),
(62, 18, 21, 87, 'Kiran', 'good', '', ''),
(63, 18, 21, 87, 'Kiran', 'okay', '', ''),
(64, 18, 21, 87, 'Kiran', 'good', '', ''),
(65, 21, 0, 0, 'Andleeb', 'good', '', 'Recruiter'),
(66, 21, 0, 0, 'Andleeb', 'okay', '', 'Recruiter'),
(67, 21, 0, 0, 'Andleeb', 'good', '', 'Recruiter');

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE `job_post` (
  `job_id` int(11) NOT NULL,
  `recruiter_id` int(99) NOT NULL,
  `job_title` varchar(111) NOT NULL,
  `recruiter_name` varchar(100) NOT NULL,
  `company_logo` varchar(250) NOT NULL,
  `company_name` text NOT NULL,
  `requirements` text NOT NULL,
  `company_location` text NOT NULL,
  `company_web` varchar(250) NOT NULL,
  `company_email` varchar(110) NOT NULL,
  `salary` varchar(150) NOT NULL,
  `timing` text NOT NULL,
  `date` date NOT NULL,
  `categories` varchar(250) NOT NULL,
  `discription` varchar(1100) NOT NULL,
  `experience` varchar(244) NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `vacancy` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`job_id`, `recruiter_id`, `job_title`, `recruiter_name`, `company_logo`, `company_name`, `requirements`, `company_location`, `company_web`, `company_email`, `salary`, `timing`, `date`, `categories`, `discription`, `experience`, `due_date`, `vacancy`, `status`, `created_at`) VALUES
(85, 21, 'Dip', 'Andleeb', '1727415327Capture.PNG', 'Dip', 'Backend', 'Lahore', 'drop.com', 'drop@gmail.com', '20000', 'Full Time', '2024-09-27', 'Design & Development', 'lenders and partners can develop an accurate impression of who you are.1 A good company description should succinctly outline key details while co', 'Bscs\r\n1 year', '2024-11-11', '2', 'active', '2024-09-27 05:35:27'),
(87, 21, 'Sign1', 'Andleeb', '1727618737project3.PNG', 'Drop', 'dfghsdfhgf\r\ndf', 'Lahore', 'drop.com', 'drop@gmail.com', '10000', 'Remote', '2024-09-29', 'Sales & Marketing', '1', 'ghjjh\r\nghjk', '2024-11-17', '7', 'active', '2024-09-29 14:05:37'),
(88, 21, 'New0', 'Andleeb', '1727792826external.png', 'New1', 'New', 'Karachi', 'new.com', 'new@gmail.com', '10000', 'Remote', '2024-10-01', 'Other', 'New2', 'New\r\n3', '2024-11-11', '5', 'active', '2024-10-01 14:27:06'),
(98, 21, 'New0', 'Andleeb', '1727792826external.png', 'New1', 'New', 'Karachi', 'new.com', 'new@gmail.com', '10000', 'Remote', '2024-10-01', 'Other', 'New2', 'New\r\n3', '2024-11-11', '5', 'active', '2024-10-10 14:27:06'),
(99, 21, 'Dip', 'Andleeb', '1727415327Capture.PNG', 'Dip', 'Backend', 'Lahore', 'drop.com', 'drop@gmail.com', '20000', 'Full Time', '2024-09-27', 'Design & Development', 'lenders and partners can develop an accurate impression of who you are.1 A good company description should succinctly outline key details while co', 'Bscs\r\n1 year', '2024-11-11', '2', 'active', '2024-10-10 05:35:27'),
(100, 21, 'Sign1', 'Andleeb', '1727618737project3.PNG', 'Drop', 'dfghsdfhgf\r\ndf', 'Lahore', 'drop.com', 'drop@gmail.com', '10000', 'Remote', '2024-09-29', 'Sales & Marketing', '1', 'ghjjh\r\nghjk', '2024-11-17', '7', 'active', '2024-10-10 14:05:37'),
(101, 21, 'Sign1', 'Andleeb', '1727618737project3.PNG', 'Drop', 'dfghsdfhgf\r\ndf', 'Lahore', 'drop.com', 'drop@gmail.com', '10000', 'Remote', '2024-09-29', 'Sales & Marketing', '1', 'ghjjh\r\nghjk', '2024-11-17', '7', 'active', '2024-10-10 14:05:37'),
(102, 21, 'Dip', 'Andleeb', '1727415327Capture.PNG', 'Dip', 'Backend', 'Lahore', 'drop.com', 'drop@gmail.com', '20000', 'Full Time', '2024-09-27', 'Design & Development', 'lenders and partners can develop an accurate impression of who you are.1 A good company description should succinctly outline key details while co', 'Bscs\r\n1 year', '2024-11-11', '2', 'active', '2024-10-10 05:35:27'),
(103, 21, 'New0', 'Andleeb', '1727792826external.png', 'New1', 'New', 'Karachi', 'new.com', 'new@gmail.com', '10000', 'Remote', '2024-10-01', 'Other', 'New2', 'New\r\n3', '2024-11-11', '5', 'active', '2024-10-10 14:27:06'),
(104, 21, 'Front End', 'Andleeb', '1728655790e-recruitment-system-high-resolution-logo-removebg.png', 'KT', 'fghsdfg', 'Islamabad', 'om.com', 'new@gmail.com', '1000', 'Full Time', '2024-10-11', 'Design & Development', 'The company description of your business plan describ', 'dfghdfg', '2024-11-11', '10', 'active', '2024-10-11 14:09:50'),
(105, 21, 'Sign', 'Andleeb', '1728707194Capt.PNG', 'Drop', 'asdf', 'Lahore', 'drop.com', 'drop@gmail.com', '20000', 'Part Time', '2024-10-12', 'Sales & Marketing', 'The company description of your business plan describes the vision and direction of the company so potential lenders and partners can develop an accurate impression of who you are.1 A good company description should succinctly outline key details while conveying your passion for the mission.', 'dfasd', '2024-11-11', '2', 'active', '2024-10-12 04:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `mail_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `mail_type` varchar(250) NOT NULL,
  `to_email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(1100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `job_or_status_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `notification_title` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `read_as` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `job_or_status_id`, `recruiter_id`, `candidate_id`, `notification_title`, `message`, `read_as`, `created_at`) VALUES
(1, 104, 21, 0, 'Job', 'Andleeb posted a new job Front End', '1', '2024-10-10 19:00:00'),
(2, 65, 21, 18, 'Status', ' Your job application against  has been approved by tha ', '1', '2024-10-11 00:34:45'),
(3, 65, 21, 19, 'Status', ' Your job application against  has been approved by tha ', '', '2024-10-11 00:36:05'),
(4, 65, 21, 19, 'Status', ' Your job application against  has been approved by tha Andleeb', '', '2024-10-11 02:14:00'),
(5, 105, 21, 0, 'Job', 'Andleeb posted a new job Sign', '1', '2024-10-12 01:26:34'),
(6, 105, 21, 0, 'Job', 'Andleeb posted a new job Sign', '1', '2024-10-12 01:26:34'),
(7, 104, 21, 0, 'Job', 'Andleeb posted a new job Front End', '1', '2024-10-10 19:00:00'),
(8, 104, 21, 0, 'Job', 'Andleeb posted a new job Front End', '1', '2024-10-10 19:00:00'),
(9, 104, 21, 0, 'Job', 'Andleeb posted a new job Front End', '1', '2024-10-10 19:00:00'),
(10, 65, 21, 19, 'Status', ' Your job application against  has been approved by tha ', '', '2024-10-11 00:36:05'),
(11, 104, 21, 0, 'Job', 'Andleeb posted a new job Front End', '1', '2024-10-10 19:00:00'),
(12, 104, 21, 0, 'Job', 'Andleeb posted a new job Front End', '1', '2024-10-10 19:00:00'),
(13, 104, 21, 0, 'Job', 'Andleeb posted a new job Front End', '1', '2024-10-10 19:00:00'),
(14, 104, 21, 0, 'Job', 'Andleeb posted a new job Front End', '1', '2024-10-10 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(150) NOT NULL,
  `birthdate` varchar(250) NOT NULL,
  `city` varchar(110) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `user_type` varchar(250) NOT NULL,
  `time` datetime NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `birthdate`, `city`, `phone`, `user_type`, `time`, `status`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345', '2001-12-10', 'Pakistan', '03490445362', 'admin', '0000-00-00 00:00:00', 'active'),
(18, 'Kiran', 'kiran@gmail.com', '12345', '2000-11-11', '11111111111', '11111111111', 'Candidate', '2024-08-08 08:13:52', 'active'),
(21, 'Andleeb', 'andleeb@gmail.com', '12345', '1990-12-12', 'Pakistan', '03110765697', 'Recruiter', '2024-08-31 08:16:23', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `applications_ibfk_1` (`candidate_id`),
  ADD KEY `applications_ibfk_2` (`job_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `feedback_ibfk_1` (`user_id`);

--
-- Indexes for table `job_post`
--
ALTER TABLE `job_post`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `job_post_ibfk_1` (`recruiter_id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_post` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_post`
--
ALTER TABLE `job_post`
  ADD CONSTRAINT `job_post_ibfk_1` FOREIGN KEY (`recruiter_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
