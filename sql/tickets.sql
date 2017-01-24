CREATE TABLE `tickets` (
	`tid` INT(11) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50) NOT NULL,
	`description` TEXT NOT NULL,
	`category` INT(11) NOT NULL,
	`author` INT(11) NOT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`tid`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
