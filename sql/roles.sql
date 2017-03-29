CREATE TABLE `roles` (
	`rid` INT(11) NOT NULL AUTO_INCREMENT,
	`label` VARCHAR(50) NOT NULL DEFAULT 'No Label',
	`permission_ticket` INT(11) NOT NULL DEFAULT '1',
	`permission_user` INT(11) NOT NULL DEFAULT '1',
	`permission_category` INT(11) NOT NULL DEFAULT '1',
	`permission_status` INT(11) NOT NULL DEFAULT '1',
	`permission_role` INT(11) NOT NULL DEFAULT '1',
	PRIMARY KEY (`rid`)
)
COMMENT='User roles'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;
