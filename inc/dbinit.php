<?php


const DBINIT = "CREATE TABLE IF NOT EXISTS university (
  uniID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(400) NOT NULL,
  links VARCHAR(200),
  PRIMARY KEY(uniID)
);

CREATE TABLE IF NOT EXISTS profile (
  profileID INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(20),
  surname  VARCHAR(40),
  university INT NOT NULL,
  password VARCHAR(20) NOT NULL,
  PRIMARY KEY(profileID),
  FOREIGN KEY(university) REFERENCES university(uniID)
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

CREATE TABLE IF NOT EXISTS post(
  postID INT NOT NULL AUTO_INCREMENT,
  author INT NOT NULL,
  target ENUM('profile', 'group', 'university'),
  targetID INT NOT NULL,
  content VARCHAR (1000),
  time_stamp TIMESTAMP,
  updated_time TIMESTAMP,
  PRIMARY KEY(postID)
);";

  const DUMMYDATA = "INSERT INTO university (name, description)
  VALUES ('University Of Portsmouth', 'Located in the center of the city of portsmouth');

  INSERT INTO profile (university, first_name, surname, password)
  VALUES (1, 'Thomas', 'George', 'root');

  INSERT INTO post (author, target, targetID, content)
  VALUES (1, 'profile', 1, 'Hello Tom');

  INSERT INTO post (author, target, targetID, content)
  VALUES (1, 'university', 1, 'I love university');

  INSERT INTO `group` (name, description, links, university)
  VALUES ('Computer Science, Year 2 (2015)', 'For students studying comp sci yay!', 'junk', 1);
  ";

?>
