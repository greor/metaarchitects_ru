CREATE TABLE `projects` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL DEFAULT '',
	`image` VARCHAR(255) NOT NULL DEFAULT '',
	`parallax` VARCHAR(255) NOT NULL DEFAULT '',
	`parallax_title` VARCHAR(255) NOT NULL DEFAULT '',
	`parallax_descr` VARCHAR(255) NOT NULL DEFAULT '',
	`size` VARCHAR(255) NOT NULL DEFAULT '',
	`category` VARCHAR(255) NOT NULL,
	`text` TEXT NOT NULL,
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`position` INT(10) UNSIGNED NOT NULL,
	`title_tag` VARCHAR(255) NOT NULL DEFAULT '',
	`keywords_tag` VARCHAR(255) NOT NULL DEFAULT '',
	`description_tag` VARCHAR(255) NOT NULL DEFAULT '',
	`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`creator_id` INT(10) NOT NULL DEFAULT '0',
	`updated` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`updater_id` INT(10) NOT NULL DEFAULT '0',
	`deleted` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`deleter_id` INT(10) NOT NULL DEFAULT '0',
	`delete_bit` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=MyISAM
ROW_FORMAT=DEFAULT;
