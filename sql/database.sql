-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table tintin.attachments
CREATE TABLE IF NOT EXISTS `attachments` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` text,
  `description` text,
  `upload_by` int(11) NOT NULL,
  `is_image` enum('Y','N') NOT NULL DEFAULT 'N',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `removed` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `removed` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table tintin.reports
CREATE TABLE IF NOT EXISTS `reports` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `query` text NOT NULL,
  `report_by` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL DEFAULT 'No Label',
  `permission_ticket` int(11) NOT NULL DEFAULT '1',
  `permission_user` int(11) NOT NULL DEFAULT '1',
  `permission_category` int(11) NOT NULL DEFAULT '1',
  `permission_status` int(11) NOT NULL DEFAULT '1',
  `permission_role` int(11) NOT NULL DEFAULT '1',
  `permission_report` int(11) NOT NULL DEFAULT '1',
  `permission_project` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='User roles';

-- Data exporting was unselected.
-- Dumping structure for table tintin.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL DEFAULT '1',
  `group_name` int(11) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `start_status` int(11) DEFAULT NULL,
  `work_start_status` int(11) DEFAULT NULL,
  `work_complete_status` int(11) DEFAULT NULL,
  `next_up_statuses` varchar(50) DEFAULT NULL,
  `kanban_statuses` varchar(50) DEFAULT NULL,
  `css` text,
  `register_open` enum('Y','N') DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `description` text,
  `place` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `worker` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `started` datetime DEFAULT NULL,
  `completed` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.users
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` datetime DEFAULT NULL,
  `reset_token` varchar(50) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL,
  `removed` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table tintin.versions
CREATE TABLE IF NOT EXISTS `versions` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `comment` text,
  `difference` text,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

INSERT INTO `statuses` (`sid`, `label`, `description`, `place`, `created`, `active`) VALUES (-1, 'Cancel', 'Cancelled tasks', 0, '2017-04-26 19:11:21', 'N');
INSERT INTO `statuses` (`sid`, `label`, `description`, `place`, `created`, `active`) VALUES (1, 'Backlog', 'Tickets to work on in the future', 0, '2017-01-23 18:45:09', 'Y');
INSERT INTO `statuses` (`sid`, `label`, `description`, `place`, `created`, `active`) VALUES (2, 'Input', 'Tickets to be worked on soon', 1, '2017-01-23 18:45:18', 'Y');
INSERT INTO `statuses` (`sid`, `label`, `description`, `place`, `created`, `active`) VALUES (3, 'Working', 'Tickets being worked on', 2, '2017-01-23 18:45:33', 'Y');
INSERT INTO `statuses` (`sid`, `label`, `description`, `place`, `created`, `active`) VALUES (4, 'Complete', 'Complete Tickets', 3, '2017-01-23 18:45:48', 'Y');

INSERT INTO `roles` (`rid`, `label`, `permission_ticket`, `permission_user`, `permission_category`, `permission_status`, `permission_role`, `permission_report`) VALUES (1, 'Administrator', 5, 3, 2, 3, 3, 3);
INSERT INTO `roles` (`rid`, `label`, `permission_ticket`, `permission_user`, `permission_category`, `permission_status`, `permission_role`, `permission_report`) VALUES (2, 'Standard User', 3, 1, 1, 1, 1, 1);

INSERT INTO `settings` (`id`, `group_name`, `owner`, `start_status`, `work_start_status`, `work_complete_status`, `next_up_statuses`, `kanban_statuses`, `css`, `register_open`) VALUES (1, NULL, NULL, 1, 3, 4, NULL, '1,2,3,4', '', NULL);

INSERT INTO `categories` (`name`, `removed`) VALUES ('New Feature', 'N');
INSERT INTO `categories` (`name`, `removed`) VALUES ('User Support', 'N');
INSERT INTO `categories` (`name`, `removed`) VALUES ('Client Request', 'N');
INSERT INTO `categories` (`name`, `removed`) VALUES ('Maintenance', 'N');
