CREATE TABLE `versions` (
	`vid` INT(11) NOT NULL AUTO_INCREMENT,
	`user` INT(11) NOT NULL,
	`comment` TEXT NULL,
	`fromstatus` INT(11) NULL DEFAULT NULL,
	`tostatus` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`vid`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
