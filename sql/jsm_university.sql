-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2025 at 09:53 AM
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
-- Database: `jsm_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `AID` int(11) NOT NULL,
  `Task` varchar(128) NOT NULL,
  `Description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contribution`
--

CREATE TABLE `contribution` (
  `CID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `AID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Gender` varchar(2) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `Suburb` varchar(40) NOT NULL,
  `Postcode` int(11) NOT NULL,
  `State` varchar(3) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `PhoneNo` varchar(12) NOT NULL,
  `Skills` varchar(128) DEFAULT NULL,
  `OtherSkills` varchar(1024) DEFAULT NULL,
  `Status` enum('New','Current','Final') DEFAULT 'New'
) ;

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
  `FunFact` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `UserID`, `FullName`, `Bio`, `FavLanguage`, `FavQuote`, `DreamJob`, `CodingSnack`, `HomeTown`, `ProgLang`, `FunFact`) VALUES
(105118283, 1, 'Jonathon Taylor', 'Jonathon is a 21 year old male and second year student from Melbourne Australia, \r\n    he is currently pursuing a Bachelors Degree in Computer Science, majoring in Cyber Security', 'Dutch', 'Streef niet naar succes als dat is wat je wilt; \r\n    gewoon doen waar je van houdt en in gelooft en de rest komt vanzelf.', 'Security Engineer', 'Coffee', 'Bairnsdale, Australia', 'C#', 'Train the combat sport of Muay Thai in Thailand'),
(105920789, 2, 'Shaun Vambe', 'Shaun is a 19 year old male first year student from Melbourne Australia, \r\n    he is currently pursuing a Bachelors Degree in Data Science', 'Portuguese', 'A melhor vingança é ser diferente daquele que causou o dano.', 'Data scientist at a leading finance firm', 'Coffee', 'Melbourne, Australia', 'HTML', 'His favourite Batman comic is Dark Victory.'),
(106188591, 3, 'Morgan Hopkins', 'Morgan is a 36 year old male first year student from Melbourne, Australia. He is currently pursuing a Bachelors Degree in Data Science', 'Mandarin', '天下萬物都處於徹底的混亂之中;情況非常好', 'Cybernetic Systems Engineer', 'Whisky', 'Chelsea Heights', 'Python', 'Cycled solo across England, Wales and Ireland');

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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `member` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `name`, `member`) VALUES
(1, 'jtaylor', '$2y$10$kW77vmuDacOofRxIMK9SxeLF/1ePo3JjFUbdw4yBAkYzCDICKbm9G', 'Jonathon', 1),
(2, 'svambe', '$2y$10$0zacz.ShUcNZ1UN5JSfjSuyXI/2FMc0qaiZXUi7y3hcImysK43Trm', 'Shaun', NULL),
(3, 'mhopkins', '$2y$10$j8kxqiEo0iQZT5QcwgIY0eRef.D7j29OorAcwewX4hCQufcLr/06m', 'Morgan', NULL),
(5, 'Admin', '$2y$10$veJddWdhghRjSOkaEVZ7quqHxV4kq8UcI5NVNsVB1DS91Xe23m0xG', 'Administrator', NULL);

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `contribution`
--
ALTER TABLE `contribution`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `SID` (`SID`),
  ADD KEY `AID` (`AID`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOIno`),
  ADD UNIQUE KEY `ID` (`ID`,`RefNo`),
  ADD KEY `RefNo` (`RefNo`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contribution`
--
ALTER TABLE `contribution`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOIno` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contribution`
--
ALTER TABLE `contribution`
  ADD CONSTRAINT `contribution_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE,
  ADD CONSTRAINT `contribution_ibfk_2` FOREIGN KEY (`AID`) REFERENCES `about` (`AID`) ON DELETE CASCADE;

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
