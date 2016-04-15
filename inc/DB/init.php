<?php


const DBINIT = "--
-- Database: `uniPages`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `id` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE IF NOT EXISTS `Course` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `university` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Entity`
--

CREATE TABLE IF NOT EXISTS `Entity` (
  `id` int(11) NOT NULL,
  `type` enum('profile','university','course','group') NOT NULL,
  `entity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE IF NOT EXISTS `Group` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `university` int(11) NOT NULL,
  `course` int(11) DEFAULT NULL,
  `isprivate` tinyint(1) NOT NULL DEFAULT '0',
  `isunit` tinyint(1) NOT NULL DEFAULT '0',
  `owner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE IF NOT EXISTS `Login` (
  `id` varchar(21) NOT NULL,
  `profile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Membership`
--

CREATE TABLE IF NOT EXISTS `Membership` (
  `id` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `access` tinyint(3) NOT NULL,
  `entity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE IF NOT EXISTS `Post` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `flagged` tinyint(4) NOT NULL DEFAULT '0',
  `isquestion` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Profile`
--

CREATE TABLE IF NOT EXISTS `Profile` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `university` int(11) NOT NULL,
  `course` int(11) DEFAULT NULL,
  `bio` varchar(250) DEFAULT NULL,
  `privacy` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Repository`
--

CREATE TABLE IF NOT EXISTS `Repository` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `size` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Unit`
--

CREATE TABLE IF NOT EXISTS `Unit` (
  `course` int(11) NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `University`
--

CREATE TABLE IF NOT EXISTS `University` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comment`
--
ALTER TABLE  `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post` (`post`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `university` (`university`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `Entity`
--
ALTER TABLE `Entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `entity` (`entity`);

--
-- Indexes for table `Group`
--
ALTER TABLE `Group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `university` (`university`),
  ADD KEY `course` (`course`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile` (`profile`);

--
-- Indexes for table `Membership`
--
ALTER TABLE `Membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile` (`profile`),
  ADD KEY `entity` (`entity`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`),
  ADD KEY `target` (`target`);

--
-- Indexes for table `Profile`
--
ALTER TABLE `Profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course` (`course`),
  ADD KEY `eid` (`eid`),
  ADD KEY `profile-university` (`university`);

--
-- Indexes for table `Repository`
--
ALTER TABLE `Repository`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `Unit`
--
ALTER TABLE `Unit`
  ADD PRIMARY KEY (`group`);

--
-- Indexes for table `University`
--
ALTER TABLE `University`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entity` (`eid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `Course`
--
ALTER TABLE `Course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Entity`
--
ALTER TABLE `Entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `Group`
--
ALTER TABLE `Group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `Membership`
--
ALTER TABLE `Membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Profile`
--
ALTER TABLE `Profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Repository`
--
ALTER TABLE `Repository`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `University`
--
ALTER TABLE `University`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `comment-author` FOREIGN KEY (`author`) REFERENCES `Profile` (`id`),
  ADD CONSTRAINT `comment-post` FOREIGN KEY (`post`) REFERENCES `Post` (`id`);

--
-- Constraints for table `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `course-entity` FOREIGN KEY (`eid`) REFERENCES `Entity` (`id`),
  ADD CONSTRAINT `course-university` FOREIGN KEY (`university`) REFERENCES `University` (`id`);

--
-- Constraints for table `Group`
--
ALTER TABLE `Group`
  ADD CONSTRAINT `group-course` FOREIGN KEY (`course`) REFERENCES `Course` (`id`),
  ADD CONSTRAINT `group-entity` FOREIGN KEY (`eid`) REFERENCES `Entity` (`id`),
  ADD CONSTRAINT `group-university` FOREIGN KEY (`university`) REFERENCES `University` (`id`);

--
-- Constraints for table `Login`
--
ALTER TABLE `Login`
  ADD CONSTRAINT `login-profile` FOREIGN KEY (`profile`) REFERENCES `Profile` (`id`);

--
-- Constraints for table `Membership`
--
ALTER TABLE `Membership`
  ADD CONSTRAINT `membership-entity` FOREIGN KEY (`entity`) REFERENCES `Entity` (`id`),
  ADD CONSTRAINT `membership-profile` FOREIGN KEY (`profile`) REFERENCES `Profile` (`id`);

--
-- Constraints for table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `post-entity` FOREIGN KEY (`target`) REFERENCES `Entity` (`id`),
  ADD CONSTRAINT `post-profile` FOREIGN KEY (`author`) REFERENCES `Profile` (`id`);

--
-- Constraints for table `Profile`
--
ALTER TABLE `Profile`
  ADD CONSTRAINT `profile-course` FOREIGN KEY (`course`) REFERENCES `Course` (`id`),
  ADD CONSTRAINT `profile-entity` FOREIGN KEY (`eid`) REFERENCES `Entity` (`id`),
  ADD CONSTRAINT `profile-university` FOREIGN KEY (`university`) REFERENCES `University` (`id`);

--
-- Constraints for table `Repository`
--
ALTER TABLE `Repository`
  ADD CONSTRAINT `repository-entity` FOREIGN KEY (`eid`) REFERENCES `Entity` (`id`);

--
-- Constraints for table `University`
--
ALTER TABLE `University`
  ADD CONSTRAINT `university-entity` FOREIGN KEY (`eid`) REFERENCES `Entity` (`id`);

  ";

CONST DUMMYDATA = "
  INSERT INTO `Course` (`id`, `eid`, `name`, `description`, `university`) VALUES
  (4, 49, 'Web Tech (2016) (2nd Year)', 'The study of web technologies', 3);

  INSERT INTO `Entity` (`id`, `type`, `entity`) VALUES
  (48, 'university', 3),
  (49, 'course', 4),
  (50, 'profile', 12);

  INSERT INTO `Login` (`id`, `profile`) VALUES
  ('117888963949520601927', 12);

  INSERT INTO `Post` (`id`, `author`, `target`, `content`, `created`, `updated`, `flagged`, `isquestion`) VALUES
  (21, 12, 49, 'How is everyone enjoying the year?', '2016-04-15 08:22:00', '2016-04-15 08:22:00', 0, 0);

  INSERT INTO `Profile` (`id`, `eid`, `fname`, `surname`, `email`, `university`, `course`, `bio`, `privacy`) VALUES
  (12, 50, 'Bob', 'Jones', 'whatanemail@email.com', 3, 4, 'Hello, I\'m Bob', 0);

  INSERT INTO `University` (`id`, `eid`, `name`, `description`) VALUES
  (3, 48, 'University Of Portsmouth', 'Located in the heart of portsmouth');
";

?>
