<?php


const DBINIT = "CREATE TABLE IF NOT EXISTS university (
  uniID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(400) NOT NULL,
  links VARCHAR(200),
  PRIMARY KEY(uniID)
);

CREATE TABLE IF NOT EXISTS course (
  courseID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(400) NOT NULL,
  description VARCHAR(400) NOT NULL,
  links VARCHAR(200) NOT NULL,
  university INT NOT NULL,
  PRIMARY KEY(courseID),
  FOREIGN KEY(university) REFERENCES university(uniID)
);

CREATE TABLE IF NOT EXISTS profile (
  profileID INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(20),
  surname  VARCHAR(40),
  university INT NOT NULL,
  course INT,
  password VARCHAR(20) NOT NULL,
  PRIMARY KEY(profileID),
  FOREIGN KEY(university) REFERENCES university(uniID)
);

CREATE TABLE IF NOT EXISTS login (
  profileID INT NOT NULL,
  googleID VARCHAR(100) NOT NULL,
  PRIMARY KEY(googleID),
  FOREIGN KEY(profileID) REFERENCES profile (profileID)
);

CREATE TABLE IF NOT EXISTS `group` (
  groupID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(400) NOT NULL,
  links VARCHAR(200) NOT NULL,
  university INT NOT NULL,
  PRIMARY KEY(groupID),
  FOREIGN KEY(university) REFERENCES university(uniID)
);

CREATE TABLE IF NOT EXISTS profile_group (
  profileID INT NOT NULL,
  groupID INT NOT NULL,
  FOREIGN KEY(profileID) REFERENCES profile(profileID)
);

CREATE TABLE IF NOT EXISTS post(
  postID INT NOT NULL AUTO_INCREMENT,
  authorID INT NOT NULL,
  targetType ENUM('profile', 'group', 'course', 'university') NOT NULL,
  targetID INT NOT NULL,
  content VARCHAR (1000),
  created_time TIMESTAMP,
  updated_time TIMESTAMP NOT NULL,
  PRIMARY KEY(postID)
);

CREATE TABLE IF NOT EXISTS comment(
  commentID INT NOT NULL AUTO_INCREMENT,
  postID INT NOT NULL,
  authorID INT NOT NULL,
  content VARCHAR (500),
  time_stamp TIMESTAMP NOT NULL,
  PRIMARY KEY (commentID),
  FOREIGN KEY (postID) REFERENCES post(postID),
  FOREIGN KEY (authorID) REFERENCES profile(profileID)
)";

  const DUMMYDATA = "INSERT INTO university (name, description)
  VALUES ('University Of Portsmouth', 'Located in the center of the city of portsmouth');

  INSERT INTO profile (university, first_name, surname, password)
  VALUES (1, 'Thomas', 'George', 'root');

  INSERT INTO login (googleID, profileID)
  VALUES ('117888963949520601927', 1);

  INSERT INTO post (authorID, targetType, targetID, content, updated_time)
  VALUES (1, 'profile', 1, 'Hello Tom', now());

  INSERT INTO post (authorID, targetType, targetID, content, updated_time)
  VALUES (1, 'university', 1, 'I love university', now());

  INSERT INTO post (authorID, targetType, targetID, content, updated_time)
  VALUES (1, 'course', 1, 'This is a course', now());

  INSERT INTO post (authorID, targetType, targetID, content, updated_time)
  VALUES (1, 'group', 2, 'This is a group', now());

  INSERT INTO `group` (name, description, links, university)
  VALUES ('CU', 'Lets together', 'junk', 1);

  INSERT INTO `group` (name, description, links, university)
  VALUES ('Archery Socitey', 'And be alright', 'junk', 1);

  INSERT INTO comment (postID, authorID, content)
  VALUES (1, 1, 'Oh, Hello Other Tom');

  INSERT INTO course (name, description, links, university)
  VALUES ('Computer Science, Year 2 (2015)', 'For students studying comp sci yay!', 'junk', 1);
  ";

?>
