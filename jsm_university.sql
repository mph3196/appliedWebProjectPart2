-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 05:26 AM
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
-- Database: `jsm_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `contribution`
--

CREATE TABLE `contribution` (
  `ContributionID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contribution`
--

INSERT INTO `contribution` (`ContributionID`, `TaskID`, `MemberID`) VALUES
(1, 1, 105118283),
(2, 5, 105118283),
(3, 6, 105118283),
(4, 14, 105118283),
(5, 7, 105118283),
(6, 8, 105118283),
(7, 11, 105118283),
(8, 1, 105920789),
(9, 2, 105920789),
(10, 6, 105920789),
(11, 14, 105920789),
(12, 12, 105920789),
(13, 15, 105920789),
(14, 16, 105920789),
(15, 1, 106188591),
(16, 6, 106188591),
(17, 4, 106188591),
(18, 14, 106188591),
(19, 9, 106188591),
(20, 13, 106188591);

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOIno` int(11) NOT NULL,
  `RefNo` varchar(5) NOT NULL,
  `ID` int(11) NOT NULL,
  `ApplyDate` date NOT NULL DEFAULT curdate(),
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` enum('Male','Female','Other','Prefer not to say') NOT NULL,
  `Address` varchar(40) NOT NULL,
  `Suburb` varchar(40) NOT NULL,
  `Postcode` int(11) NOT NULL,
  `State` enum('VIC','NSW','QLD','WA','SA','TAS','NT','ACT') NOT NULL,
  `Email` varchar(40) NOT NULL,
  `PhoneNo` varchar(12) NOT NULL,
  `Skills` varchar(128) DEFAULT NULL,
  `OtherSkills` varchar(1024) DEFAULT NULL,
  `Status` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOIno`, `RefNo`, `ID`, `ApplyDate`, `FirstName`, `LastName`, `DOB`, `Gender`, `Address`, `Suburb`, `Postcode`, `State`, `Email`, `PhoneNo`, `Skills`, `OtherSkills`, `Status`) VALUES
(4, 'G03C3', 9, '2025-10-26', 'George', 'Gorilla', '2000-01-01', 'Male', '12 Banana Street', 'Monkeyville', 3123, 'NSW', 'curious@george.com', '0412262627', 'communication, leadership, other', 'Monkey Business', 'New'),
(5, 'G03A1', 11, '2025-10-26', 'Trevor', 'Revver', '1970-01-01', 'Male', '1 Old Street', 'Oldtown', 3000, 'TAS', 'old@man.com', '0400000001', 'leadership, other', 'Stunt driving', 'New'),
(6, 'G03B2', 12, '2025-10-26', 'Amanda', 'Bolts', '2001-01-01', 'Female', '1 Beach Road', 'Beaumaris', 3193, 'VIC', 'amanda@amanda.com', '0412987654', 'problemSolving, other', 'Living, laughing, loving', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `hobby`
--

CREATE TABLE `hobby` (
  `HobbyID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Description` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hobby`
--

INSERT INTO `hobby` (`HobbyID`, `MemberID`, `Description`) VALUES
(1, 105118283, 'Muay Thai'),
(2, 105118283, 'Hiking'),
(3, 105118283, 'Gaming'),
(4, 105118283, 'Watching MMA'),
(5, 105920789, 'Gaming'),
(6, 105920789, 'Reading'),
(7, 105920789, 'Football/Soccer'),
(8, 105920789, 'Playing Sport'),
(9, 106188591, 'Gaming'),
(10, 106188591, 'Cycling'),
(11, 106188591, 'Drinking'),
(12, 106188591, 'Dancing to Techno');

-- --------------------------------------------------------

--
-- Table structure for table `jobessential`
--

CREATE TABLE `jobessential` (
  `EssentialID` int(11) NOT NULL,
  `RefNo` varchar(5) NOT NULL,
  `Description` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobessential`
--

INSERT INTO `jobessential` (`EssentialID`, `RefNo`, `Description`) VALUES
(1, 'G03A1', 'Bachelor degree in Information Technology or related field.'),
(2, 'G03A1', 'Experience supporting digital learning or research systems.'),
(3, 'G03A1', 'Strong communication and problem-solving skills.'),
(4, 'G03C3', 'Bachelor Degree in Data Science, Statistics, or IT.'),
(5, 'G03C3', 'Experience with R, Python, or SPSS.'),
(6, 'G03B2', 'Bachelor in Education Technology, IT, or similar.'),
(7, 'G03B2', 'Experience with LMS platforms (e.g., Canvas, Blackboard).'),
(8, 'G03D4', 'Bachelor Degree in Information Systems or Computer Science.'),
(9, 'G03D4', 'Experience with Linux/Windows server administration.');

-- --------------------------------------------------------

--
-- Table structure for table `jobpreferable`
--

CREATE TABLE `jobpreferable` (
  `PreferableID` int(11) NOT NULL,
  `RefNo` varchar(5) NOT NULL,
  `Description` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobpreferable`
--

INSERT INTO `jobpreferable` (`PreferableID`, `RefNo`, `Description`) VALUES
(1, 'G03A1', 'Knowledge of accessibility standards in digital education.'),
(2, 'G03A1', 'Experience with cloud-based platforms (e.g., Microsoft Azure, AWS).'),
(3, 'G03A1', 'Familiarity with research data management practices.'),
(4, 'G03C3', 'Knowledge of big data tools (Hadoop, Spark).'),
(5, 'G03C3', 'Experience in higher education research projects.'),
(6, 'G03B2', 'Knowledge of instructional design frameworks.'),
(7, 'G03B2', 'Familiarity with accessibility standards (WCAG).'),
(8, 'G03D4', 'Knowledge of Cybersecurity frameworks.'),
(9, 'G03D4', 'Cloud certification (Azure, AWS, or GCP).');

-- --------------------------------------------------------

--
-- Table structure for table `jobresponsibility`
--

CREATE TABLE `jobresponsibility` (
  `RespID` int(11) NOT NULL,
  `RefNo` varchar(5) NOT NULL,
  `Description` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobresponsibility`
--

INSERT INTO `jobresponsibility` (`RespID`, `RefNo`, `Description`) VALUES
(1, 'G03A1', 'Provide technical support for digital learning platforms (LMS, collaboration tools).'),
(2, 'G03A1', 'Assist researchers with software, data storage, and secure computing resources.'),
(3, 'G03A1', 'Maintain system documentation and user guides.'),
(4, 'G03A1', 'Ensure accessibility and compliance with IT security policies.'),
(5, 'G03C3', 'Support researchers with secure data storage solutions.'),
(6, 'G03C3', 'Assist in statistical analysis and visualization.'),
(7, 'G03C3', 'Ensure compliance with data security and ethics requirements.'),
(8, 'G03B2', 'Train staff in effective use of the Learning Management System (LMS).'),
(9, 'G03B2', 'Collaborate on course design to ensure accessibility and engagement.'),
(10, 'G03B2', 'Evaluate and recommend new learning technologies.'),
(11, 'G03D4', 'Manage servers, networks, and cloud environments.'),
(12, 'G03D4', 'Ensure uptime and security of digital platforms.'),
(13, 'G03D4', 'Implement system updates, patches, and backups.');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `RefNo` varchar(5) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Salary` varchar(50) NOT NULL,
  `ReportsTo` varchar(100) NOT NULL,
  `ShortDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `RefNo`, `Title`, `Salary`, `ReportsTo`, `ShortDescription`) VALUES
(1, 'G03A1', 'IT Support Officer', '$78,000 – $85,000 per annum', 'Manager, Digital Learning & Research Support', 'Join our IT department to provide frontline support for digital learning platforms and research technologies that enhance teaching, learning, and innovation.'),
(2, 'G03C3', 'Research Data Analyst', '$88,000 – $95,000 per annum', 'Senior Research IT Coordinator', 'Provide data management, analytics, and visualization support for academic research projects.'),
(3, 'G03B2', 'Learning Technology Specialist', '$82,000 – $90,000 per annum', 'Manager, Digital Learning & Research Support', 'Support academics in designing and delivering online and blended learning experiences using the university digital platforms.'),
(4, 'G03D4', 'Systems Administrator', '$92,000 – $105,000 per annum', 'Head of IT Infrastructure', 'Maintain and secure the IT infrastructure supporting digital learning and research systems.');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FullName` varchar(20) DEFAULT NULL,
  `Bio` varchar(2048) DEFAULT NULL,
  `FavLanguage` varchar(20) DEFAULT NULL,
  `FavQuote` varchar(256) DEFAULT NULL,
  `DreamJob` varchar(128) DEFAULT NULL,
  `CodingSnack` varchar(30) DEFAULT NULL,
  `HomeTown` varchar(30) DEFAULT NULL,
  `ProgLang` varchar(12) DEFAULT NULL,
  `FunFact` varchar(256) DEFAULT NULL,
  `LangCode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `UserID`, `FullName`, `Bio`, `FavLanguage`, `FavQuote`, `DreamJob`, `CodingSnack`, `HomeTown`, `ProgLang`, `FunFact`, `LangCode`) VALUES
(105118283, 1, 'Jonathon Taylor', 'Jonathon is a 21 year old male and second year student from Melbourne Australia, \r\n    he is currently pursuing a Bachelors Degree in Computer Science, majoring in Cyber Security', 'Dutch', 'Streef niet naar succes als dat is wat je wilt; \r\n    gewoon doen waar je van houdt en in gelooft en de rest komt vanzelf.', 'Security Engineer', 'Coffee', 'Bairnsdale, Australia', 'C#', 'Train the combat sport of Muay Thai in Thailand', 'nl'),
(105920789, 2, 'Shaun Vambe', 'Shaun is a 19 year old male first year student from Melbourne Australia, \r\n    he is currently pursuing a Bachelors Degree in Data Science', 'Portuguese', 'A melhor vingança é ser diferente daquele que causou o dano.', 'Data scientist at a leading finance firm', 'Coffee', 'Melbourne, Australia', 'HTML', 'His favourite Batman comic is Dark Victory.', 'pt-BR'),
(106188591, 3, 'Morgan Hopkins', 'Morgan is a 36 year old male first year student from Melbourne, Australia. He is currently pursuing a Bachelors Degree in Data Science', 'Mandarin', '天下萬物都處於徹底的混亂之中;情況非常好', 'Cybernetic Systems Engineer', 'Whisky', 'Chelsea Heights', 'Python', 'Cycled solo across England, Wales and Ireland', 'zh-TW');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Description` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `MemberID`, `Description`) VALUES
(1, 105118283, 'Team Leader – keeping team on track to meet all set targets and deadlines'),
(2, 105118283, 'Lead Designer – maintaining a consistent, uniform and professional style across all pages of the site'),
(3, 105920789, 'Communications Manager – organising communication between team members, setting times for meetings, convening with teacher (Atie)'),
(4, 106188591, 'Lead Developer – ensuring functional html, CSS etc., markup validity and proper documentation and commenting for all pages of the site');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `TaskID` int(11) NOT NULL,
  `Description` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`TaskID`, `Description`) VALUES
(1, 'index.html'),
(2, 'apply.html'),
(3, 'about.html'),
(4, 'apply.html'),
(5, 'jobs.html'),
(6, 'styles.css'),
(7, 'Task 1 - Reuse common UI with PHP includes'),
(8, 'Task 2 - Database settings'),
(9, 'Task 3 - Create Expression of Interest table and name it eoi'),
(10, 'Task 4 - Add validated records (process_eoi.php)'),
(11, 'Task 5 - Jobs table and jobs.php'),
(12, 'Task 6 - HR manager queries (manage.php)'),
(13, 'Task 7 - Create about table and update about.php '),
(14, 'Jira Board'),
(15, 'dashboard.php'),
(16, 'register.php');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `name`) VALUES
(1, 'jtaylor', '$2y$10$kW77vmuDacOofRxIMK9SxeLF/1ePo3JjFUbdw4yBAkYzCDICKbm9G', 'Jonathon'),
(2, 'svambe', '$2y$10$0zacz.ShUcNZ1UN5JSfjSuyXI/2FMc0qaiZXUi7y3hcImysK43Trm', 'Shaun'),
(3, 'mhopkins', '$2y$10$j8kxqiEo0iQZT5QcwgIY0eRef.D7j29OorAcwewX4hCQufcLr/06m', 'Morgan'),
(5, 'Admin', '$2y$10$veJddWdhghRjSOkaEVZ7quqHxV4kq8UcI5NVNsVB1DS91Xe23m0xG', 'Administrator'),
(9, 'curious_george', '$2y$10$FMvFj049y53xCzomGf/pBODcQv5PFEdCPYcwlGDd1Sp.eH4W4C.Dy', 'George'),
(11, 'trev', '$2y$10$CUA0esb.SVWP7/KD6e4ea.h74cGCQmuYcFV3GLXvISir.2MCbmeh.', 'Trevor'),
(12, 'xx_mandy_xx', '$2y$10$YuGRgunc4jP6SevlCzrtt.HXPbat1y4b9ibK0twsRidPZGWa7qyJ.', 'Amanda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contribution`
--
ALTER TABLE `contribution`
  ADD PRIMARY KEY (`ContributionID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOIno`),
  ADD KEY `RefNo` (`RefNo`),
  ADD KEY `eoi_ibfk_2` (`ID`);

--
-- Indexes for table `hobby`
--
ALTER TABLE `hobby`
  ADD PRIMARY KEY (`HobbyID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `jobessential`
--
ALTER TABLE `jobessential`
  ADD PRIMARY KEY (`EssentialID`),
  ADD KEY `RefNo` (`RefNo`);

--
-- Indexes for table `jobpreferable`
--
ALTER TABLE `jobpreferable`
  ADD PRIMARY KEY (`PreferableID`),
  ADD KEY `RefNo` (`RefNo`);

--
-- Indexes for table `jobresponsibility`
--
ALTER TABLE `jobresponsibility`
  ADD PRIMARY KEY (`RespID`),
  ADD KEY `RefNo` (`RefNo`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `RefNo` (`RefNo`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`TaskID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contribution`
--
ALTER TABLE `contribution`
  MODIFY `ContributionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOIno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hobby`
--
ALTER TABLE `hobby`
  MODIFY `HobbyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobessential`
--
ALTER TABLE `jobessential`
  MODIFY `EssentialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobpreferable`
--
ALTER TABLE `jobpreferable`
  MODIFY `PreferableID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobresponsibility`
--
ALTER TABLE `jobresponsibility`
  MODIFY `RespID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contribution`
--
ALTER TABLE `contribution`
  ADD CONSTRAINT `contribution_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE;

--
-- Constraints for table `eoi`
--
ALTER TABLE `eoi`
  ADD CONSTRAINT `eoi_ibfk_1` FOREIGN KEY (`RefNo`) REFERENCES `jobs` (`RefNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `eoi_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hobby`
--
ALTER TABLE `hobby`
  ADD CONSTRAINT `hobby_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `jobessential`
--
ALTER TABLE `jobessential`
  ADD CONSTRAINT `jobessential_ibfk_1` FOREIGN KEY (`RefNo`) REFERENCES `jobs` (`RefNo`) ON DELETE CASCADE;

--
-- Constraints for table `jobpreferable`
--
ALTER TABLE `jobpreferable`
  ADD CONSTRAINT `jobpreferable_ibfk_1` FOREIGN KEY (`RefNo`) REFERENCES `jobs` (`RefNo`) ON DELETE CASCADE;

--
-- Constraints for table `jobresponsibility`
--
ALTER TABLE `jobresponsibility`
  ADD CONSTRAINT `jobresponsibility_ibfk_1` FOREIGN KEY (`RefNo`) REFERENCES `jobs` (`RefNo`) ON DELETE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
