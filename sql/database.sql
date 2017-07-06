

-- Dumping database structure for tintin
CREATE DATABASE IF NOT EXISTS `tintin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tintin`;

-- Dumping structure for table tintin.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `removed` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Dumping data for table tintin.categories: ~5 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`cid`, `name`, `removed`) VALUES
	(1, 'New Feature', 'N'),
	(3, 'User Support', 'N'),
	(4, 'Client Request', 'N'),
	(19, 'Maintenance', 'N'),
	(20, 'Test', 'Y');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table tintin.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL DEFAULT 'No Label',
  `permission_ticket` int(11) NOT NULL DEFAULT '1',
  `permission_user` int(11) NOT NULL DEFAULT '1',
  `permission_category` int(11) NOT NULL DEFAULT '1',
  `permission_status` int(11) NOT NULL DEFAULT '1',
  `permission_role` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='User roles';

-- Dumping data for table tintin.roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`rid`, `label`, `permission_ticket`, `permission_user`, `permission_category`, `permission_status`, `permission_role`) VALUES
	(1, 'Administrator', 5, 3, 2, 3, 3);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table tintin.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL DEFAULT '1',
  `group_name` int(11) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `start_status` int(11) DEFAULT NULL,
  `closed_status` int(11) DEFAULT NULL,
  `css` text,
  `register_open` enum('Y','N') DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tintin.settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `group_name`, `owner`, `start_status`, `closed_status`, `css`, `register_open`) VALUES
	(1, NULL, NULL, 1, 5, '', NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table tintin.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `description` text,
  `place` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table tintin.statuses: ~8 rows (approximately)
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` (`sid`, `label`, `description`, `place`, `created`, `active`) VALUES
	(0, 'Cancelled', 'Cancelled tasks', 0, '2017-04-26 19:11:21', 'N'),
	(1, 'Backlog', 'Tickets to do later', 1, '2017-01-23 18:45:09', 'Y'),
	(2, 'Input', 'Tickets to work on next', 2, '2017-01-23 18:45:18', 'Y'),
	(3, 'Working', 'Tickets currently being worked on', 3, '2017-01-23 18:45:33', 'Y'),
	(4, 'Complete', 'Complete tasks', 4, '2017-01-23 18:45:48', 'Y'),
	(5, 'Closed', 'Closed tasks', 5, '2017-01-23 18:45:58', 'Y');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

-- Dumping structure for table tintin.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL,
  `worker` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Dumping structure key table tintin.users
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table tintin.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`uid`, `username`, `password`, `email`, `role`, `created`, `lastlogin`, `reset_token`, `reset_token_expire`, `removed`) VALUES
	(7, 'tom', '$2y$10$i/EzBdkmsnhvNP0nCMJhbuN5idvNfhIxHP1NB3hliLRuNnvQLEY9.', 'tom@mail.com', 1, '2017-01-27 21:43:07', NULL, NULL, NULL, 'Y'),
	(8, 'fin', '$2y$10$59CVgFVfst7iolQgST3ONeKBDWlnsT.r7CYG88Y.1Fy8qOsK7QmTK', 'codeafin@gmail.com', 1, '2017-03-27 21:44:08', NULL, NULL, NULL, 'Y');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table tintin.versions
CREATE TABLE IF NOT EXISTS `versions` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `comment` text,
  `difference` text,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
