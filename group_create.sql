use nzb_creator;
DROP TABLE IF EXISTS Groups;
CREATE TABLE `Groups` (
  `GroupID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(255) NOT NULL,
  `FirstPost` bigint(20) DEFAULT NULL,
  `LastPost` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`GroupID`),
  UNIQUE KEY `GroupID_UNIQUE` (`GroupID`),
  UNIQUE KEY `GroupName_UNIQUE` (`GroupName`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
