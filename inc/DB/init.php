<?php


const DBINIT = "CREATE TABLE IF NOT EXISTS `Comment` (
   `id` int(11) not null auto_increment,
   `post` int(11) not null,
   `author` int(11) not null,
   `content` varchar(500) not null,
   `created` timestamp not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `Course` (
   `id` int(11) not null auto_increment,
   `name` varchar(100) not null,
   `description` varchar(400),
   `university` int(11) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `Entity` (
   `id` int(11) not null,
   `type` enum('profile','university','course','group') not null,
   `entity` int(11) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Group` (
   `id` int(11) not null,
   `name` varchar(100) not null,
   `description` varchar(400),
   `university` int(11) not null,
   `course` int(11),
   `isprivate` tinyint(4) not null default '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Links` (
   `entity` int(11) not null,
   `hyperlink` varchar(400) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Login` (
   `id` varchar(21) not null,
   `profile` int(11) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Membership` (
   `profile` int(11) not null,
   `access` bit(1) not null,
   `entity` int(11) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Post` (
   `id` int(11) not null auto_increment,
   `author` int(11) not null,
   `target` int(11) not null,
   `content` varchar(500) not null,
   `created` timestamp not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
   `updated` timestamp not null default '0000-00-00 00:00:00',
   `flagged` tinyint(4) not null default '0',
   `isquestion` tinyint(4) not null default '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `Profile` (
   `id` int(11) not null auto_increment,
   `fname` varchar(20) not null,
   `surname` varchar(40) not null,
   `email` varchar(100),
   `university` int(11) not null,
   `course` int(11),
   `extension` varchar(10),
   `bio` varchar(250),
   `privacy` tinyint(4) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `Repository` (
   `id` int(11) not null auto_increment,
   `name` varchar(40) not null,
   `extension` varchar(10) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `Unit` (
   `course` int(11) not null,
   `group` int(11) not null,
   PRIMARY KEY (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `University` (
   `id` int(11) not null auto_increment,
   `name` varchar(100) not null,
   `description` varchar(400),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

  const DUMMYDATA = "INSERT INTO University (name, description)
  VALUES ('University Of Portsmouth', 'Located in the center of the city of portsmouth');

  INSERT INTO Profile (university, fname, surname, privacy)
  VALUES (1, 'Thomas', 'George', 1);

  ";

?>
