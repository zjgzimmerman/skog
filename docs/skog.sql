SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8 */;


CREATE DATABASE IF NOT EXISTS `skog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

USE `skog`;



CREATE TABLE IF NOT EXISTS `checklist` (
`checkID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(40) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `members` (
`id` int(4) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `username` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `messages` (
`messageID` int(11) NOT NULL,
  `tripID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `messageText` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `Trip` (
  `userID` int(11) NOT NULL,
`TripID` int(11) NOT NULL,
  `tripName` varchar(50) NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `CheckID` int(11) DEFAULT NULL,
  `ICEContact` varchar(100) DEFAULT NULL,
  `ParkSite` varchar(200) DEFAULT NULL,
  `map` mediumblob,
  `mapName` varchar(255) DEFAULT NULL,
  `mapType` varchar(50) DEFAULT NULL,
  `mapSize` bigint(20) unsigned DEFAULT NULL,
  `TripInfo` mediumtext,
  `ZipCode` varchar(15) DEFAULT NULL,
  `parkAddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tripInvite` (
  `tripID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `checklist`
 ADD PRIMARY KEY (`checkID`);

ALTER TABLE `members`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `messages`
 ADD PRIMARY KEY (`messageID`);

ALTER TABLE `Trip`
 ADD PRIMARY KEY (`TripID`);

ALTER TABLE `tripInvite`
 ADD PRIMARY KEY (`tripID`,`userID`);


ALTER TABLE `checklist`
MODIFY `checkID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;


ALTER TABLE `members`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

ALTER TABLE `messages`
MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

ALTER TABLE `Trip`
MODIFY `TripID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


INSERT INTO `members` (id, fName, lName, Email, username, password) VALUES (0, 'admin', 'admin', 'admin', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99');