<?php

/*
 * copy migrations scripts here.
 * any db_delta scripts that are greater than revision 3431 (I think)
 */

  $sqlm = "

-- insert SQL statements here
  
ALTER TABLE `user_feeds` CHANGE `feed_object` `feed_object` ENUM( 'club', 'faculty', 'university', 'unit', 'study_group', 'year', 'service_page' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;


--
-- Table structure for table `service_admins`
--

CREATE TABLE IF NOT EXISTS `service_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `non_ucroo_id` int(11) DEFAULT NULL,
  `service_page_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_page_id` (`service_page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_dropin_details`
--

CREATE TABLE IF NOT EXISTS `service_dropin_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_page_id` int(11) NOT NULL,
  `dropin_day` varchar(50) NOT NULL,
  `dropin_start` time NOT NULL,
  `dropin_end` time NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_page_id` (`service_page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_event`
--

CREATE TABLE IF NOT EXISTS `service_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_page_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `picture_thumb` varchar(300) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(100) NOT NULL,
  `creator_id` int(10) NOT NULL,
  `max_attendees` varchar(5) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_page_id` (`service_page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_event_member`
--

CREATE TABLE IF NOT EXISTS `service_event_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_page_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_member`
--

CREATE TABLE IF NOT EXISTS `service_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_page_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `non_ucroo_id` int(11) unsigned DEFAULT NULL,
  `student_email` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_page_id` (`service_page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_non_ucroo_member`
--

CREATE TABLE IF NOT EXISTS `service_non_ucroo_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_page_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_pages`
--

CREATE TABLE IF NOT EXISTS `service_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `uni_id` int(11) NOT NULL,
  `faculty_id` int(10) DEFAULT NULL,
  `campus_id` double NOT NULL,
  `owner_user_id` int(10) NOT NULL,
  `member_message` text,
  `slug` varchar(100) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

ALTER TABLE `user_feeds` CHANGE `feed_object` `feed_object` ENUM( 'club', 'faculty', 'university', 'unit', 'study_group', 'year', 'service_page', 'service_staff' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;


-- Feed post table change for service pages
ALTER TABLE `feed_posts` CHANGE `feed_object` `feed_object` ENUM( 'club', 'faculty', 'university', 'unit', 'study_group', 'club_committee', 'year', 'service_page', 'service_staff' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

-- Permissions table for service feed and service staff feed.
ALTER TABLE `permissions` CHANGE `object` `object` ENUM( 'feed', 'services', 'unit', 'club', 'study_group', 'club_committee', 'signup', 'account', 'year', 'university', 'faculty', 'service_page', 'service_staff' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;



-- Giving permissions to the Service Pages on the admin side for feeds and other changes.
INSERT INTO `permissions` (
`id` ,`object` ,`action` ,`modes` ,`default` ,`is_group`
)
VALUES
(NULL , 'service_page', 'admin', 'view,edit,delete', NULL , '1'),
(NULL , 'service_page', 'post', 'view,edit,delete', NULL , '1'),
(NULL , 'service_page', 'numposts', 'view,edit', NULL , '1'),
(NULL , 'service_page', 'email', 'view,edit', NULL , '1'),
(NULL , 'service_page', 'notification', 'view,edit', NULL , '1'),
(NULL , 'service_page', 'report', 'view,edit', NULL , '1'),
(NULL , 'service_page', 'pin', 'view,edit', NULL , '1'),
(NULL , 'service_page', 'poll', 'view,edit,delete', NULL , '1'),
(NULL , 'service_page', 'file', 'view,edit,delete', NULL , '1'),
(NULL , 'service_page', 'link', 'view,edit,delete', NULL , '1'),
(NULL, 'service_staff', 'post', 'view,edit,delete', NULL, 1),
(NULL, 'service_staff', 'link', 'view,edit,delete', NULL, 1),
(NULL, 'service_staff', 'file', 'view,edit,delete', NULL, 1),
(NULL, 'service_staff', 'poll', 'view,edit,delete', NULL, 1),
(NULL, 'service_staff', 'pin', 'view,edit,delete', NULL, 1),
(NULL, 'service_staff', 'admin', 'view,edit,delete', NULL, 1),
(NULL, 'service_staff', 'report', 'view,edit', NULL, 1),
(NULL, 'service_staff', 'notification', 'view,edit', NULL, 1),
(NULL, 'service_staff', 'numposts', 'view,edit,delete', NULL, 1);

-- Giving permissions to the Service Pages, manual entry for different module permissions.
INSERT INTO `user_groups_permissions` (`id`, `user_group_id`, `permission_id`, `modes`) VALUES
(NULL, 1, 174, 'edit,view,delete'),
(NULL, 3, 174, 'edit,view,delete'),
(NULL, 4, 174, 'edit,view,delete'),
(NULL, 2, 174, 'edit,view,delete'),
(NULL, 2, 173, 'edit,view'),
(NULL, 1, 173, 'edit,view'),
(NULL, 3, 173, 'edit,view'),
(NULL, 4, 173, 'edit,view'),
(NULL, 4, 172, 'edit,view'),
(NULL, 3, 172, 'edit,view'),
(NULL, 1, 172, 'edit,view'),
(NULL, 2, 172, 'edit,view'),
(NULL, 4, 171, 'edit,view,delete'),
(NULL, 1, 171, 'edit,view,delete'),
(NULL, 3, 170, 'edit,view,delete'),
(NULL, 2, 170, 'edit,view,delete'),
(NULL, 1, 170, 'edit,view,delete'),
(NULL, 4, 170, 'edit,view,delete'),
(NULL, 2, 169, 'edit,view,delete'),
(NULL, 1, 169, 'edit,view,delete'),
(NULL, 4, 169, 'edit,view,delete'),
(NULL, 3, 169, 'edit,view,delete'),
(NULL, 2, 168, 'edit,view,delete'),
(NULL, 3, 168, 'edit,view,delete'),
(NULL, 4, 168, 'edit,view,delete'),
(NULL, 1, 168, 'edit,view,delete'),
(NULL, 3, 167, 'edit,view,delete'),
(NULL, 2, 167, 'edit,view,delete'),
(NULL, 4, 167, 'edit,view,delete'),
(NULL, 1, 167, 'edit,view,delete'),
(NULL, 2, 166, 'edit,view,delete'),
(NULL, 1, 166, 'edit,view,delete'),
(NULL, 3, 166, 'edit,view,delete'),
(NULL, 4, 166, 'edit,view,delete'),
(NULL, 4, 165, 'edit,view,delete'),
(NULL, 3, 165, 'edit,view,delete'),
(NULL, 1, 165, 'edit,view,delete'),
(NULL, 2, 165, 'edit,view,delete'),
(NULL, 2, 164, 'edit,view,delete'),
(NULL, 4, 164, 'edit,view,delete'),
(NULL, 1, 164, 'edit,view,delete'),
(NULL, 3, 164, 'edit,view,delete'),
(NULL, 4, 163, 'edit,view,delete'),
(NULL, 1, 163, 'edit,view,delete'),
(NULL, 3, 163, 'edit,view,delete'),
(NULL, 2, 163, 'edit,view,delete'),
(NULL, 4, 162, 'view'),
(NULL, 2, 162, 'view'),
(NULL, 3, 162, 'edit,view'),
(NULL, 1, 162, 'edit,view'),
(NULL, 2, 161, 'edit,view'),
(NULL, 4, 161, 'edit,view'),
(NULL, 1, 161, 'edit,view'),
(NULL, 3, 161, 'edit,view'),
(NULL, 4, 160, 'edit,view'),
(NULL, 3, 160, 'edit,view'),
(NULL, 1, 160, 'edit,view'),
(NULL, 2, 160, 'edit,view'),
(NULL, 2, 159, 'edit,view'),
(NULL, 4, 159, 'edit,view'),
(NULL, 1, 159, 'edit,view'),
(NULL, 3, 159, 'edit,view'),
(NULL, 1, 158, 'edit,view'),
(NULL, 4, 158, 'view'),
(NULL, 2, 158, 'edit,view'),
(NULL, 3, 158, 'edit,view'),
(NULL, 1, 157, 'edit,view,delete'),
(NULL, 4, 157, 'view'),
(NULL, 2, 157, 'edit,view,delete'),
(NULL, 3, 157, 'edit,view,delete'),
(NULL, 1, 156, 'edit,view,delete'),
(NULL, 4, 156, 'edit,view,delete');  


ALTER TABLE `service_event_member` ADD `member_email` VARCHAR( 500 ) NULL AFTER `user_id`;

ALTER TABLE `service_event_member` DROP `service_page_id`;

ALTER TABLE `feed_posts` CHANGE `feed_object` `feed_object` ENUM('club','faculty','university','unit','study_group','club_committee','year','service_page','service_staff','final_year') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `user_feeds` CHANGE `feed_object` `feed_object` ENUM('club','faculty','university','unit','study_group','year','service_page','service_staff','final_year') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

DROP TABLE IF EXISTS `final_year_event`;
CREATE TABLE `final_year_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_id` int(10) NOT NULL COMMENT 'University Id',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `picture_thumb` varchar(300) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(100) NOT NULL,
  `creator_id` int(10) NOT NULL,
  `max_attendees` varchar(5) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `final_year_event_member`;
CREATE TABLE `final_year_event_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `member_email` varchar(500) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

ALTER TABLE `final_year_event_member`
ADD FOREIGN KEY (`event_id`) REFERENCES `final_year_event` (`id`);

CREATE TABLE IF NOT EXISTS `university_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `uni_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

ALTER TABLE `university_admin`
ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `feed_posts`
CHANGE `type` `type` enum('question','post','link','file','poll','event') COLLATE 'utf8_general_ci' NULL AFTER `user_id`,
COMMENT='';

ALTER TABLE `final_year_event`	CHANGE COLUMN `uni_id` `uni_id` INT(11) NOT NULL COMMENT 'University Id' AFTER `id`;
ALTER TABLE `final_year_event`	CHANGE COLUMN `creator_id` `creator_id` INT(11) NOT NULL AFTER `location`;
ALTER TABLE `final_year_event`	CHANGE COLUMN `max_attendees` `max_attendees` INT(11) NULL DEFAULT NULL AFTER `creator_id`;
ALTER TABLE `final_year_event_member`	CHANGE COLUMN `member_email` `member_email` VARCHAR(254) NULL DEFAULT NULL AFTER `user_id`;



ALTER TABLE `service_admins`	CHANGE COLUMN `non_ucroo_id` `non_ucroo_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `user_id`;

ALTER TABLE `service_dropin_details`	ADD CONSTRAINT `FK_service_dropin_details_service_pages` FOREIGN KEY (`service_page_id`) REFERENCES `service_pages` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `service_event`	ADD CONSTRAINT `FK_service_event_service_pages` FOREIGN KEY (`service_page_id`) REFERENCES `service_pages` (`id`) ON 
UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `service_event_member`	ADD CONSTRAINT `FK_service_event_member_service_event` FOREIGN KEY (`event_id`) REFERENCES `service_event` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `service_event_member`	CHANGE COLUMN `member_email` `member_email` VARCHAR(254) NULL DEFAULT NULL AFTER `user_id`;

ALTER TABLE `service_event_member`	ADD CONSTRAINT `FK_service_event_member_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `service_event`	ALTER `creator_id` DROP DEFAULT;

ALTER TABLE `service_event`	CHANGE COLUMN `creator_id` `creator_id` INT(11) NOT NULL AFTER `location`;

ALTER TABLE `service_member`	CHANGE COLUMN `student_email` `student_email` VARCHAR(254) NULL DEFAULT NULL AFTER `non_ucroo_id`;

ALTER TABLE `service_member`	ADD CONSTRAINT `FK_service_member_service_pages` FOREIGN KEY (`service_page_id`) REFERENCES `service_pages` (`id`) ON 
UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `service_non_ucroo_member`	ALTER `email` DROP DEFAULT;

ALTER TABLE `service_non_ucroo_member`	CHANGE COLUMN `first_name` `first_name` VARCHAR(100) NULL DEFAULT NULL AFTER `service_page_id`;

ALTER TABLE `service_non_ucroo_member`	CHANGE COLUMN `last_name` `last_name` VARCHAR(100) NULL DEFAULT NULL AFTER `first_name`;

ALTER TABLE `service_non_ucroo_member`	CHANGE COLUMN `email` `email` VARCHAR(254) NOT NULL AFTER `last_name`;

CREATE TABLE `service_suggestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `service_page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `service_suggestions`	ADD CONSTRAINT `FK_service_suggestions_university` FOREIGN KEY (`uni_id`) REFERENCES `university` (`id`) ON 
UPDATE CASCADE ON DELETE CASCADE;

Update service_non_ucroo_member set service_page_id=null where service_page_id=0;

Update service_admins set user_id=null where user_id=0;

Update service_admins set non_ucroo_id=null where non_ucroo_id=0;

ALTER TABLE `university`
ADD `policy` text COLLATE 'utf8_general_ci' NULL AFTER `aff_token`,
COMMENT='';


CREATE TABLE `non_ucroo_member` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`first_name` VARCHAR(50) NULL,
`last_name` VARCHAR(50) NULL,
`email` VARCHAR(254) NOT NULL,
`date_created` DATETIME NULL,
`date_modified` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;


CREATE TABLE `customgroups` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(70) NOT NULL,
	`description` TEXT NOT NULL,
	`privacy` TINYINT(4) NOT NULL DEFAULT '0',
	`owner_user_id` INT(11) NOT NULL,
	`slug` VARCHAR(100) NULL DEFAULT NULL,
	`date_created` DATETIME NOT NULL,
	`date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	INDEX `FK_customgroups_users` (`owner_user_id`),
	CONSTRAINT `FK_customgroups_users` FOREIGN KEY (`owner_user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPACT
AUTO_INCREMENT=1;

CREATE TABLE `customgroups_member` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`customgroups_id` INT(11) NOT NULL,
	`user_id` INT(11) NULL DEFAULT NULL,
	`non_ucroo_id` INT(11) NULL DEFAULT NULL,
	`member_email` VARCHAR(254) NULL DEFAULT NULL,
	`member_type` TINYINT(5) NULL DEFAULT NULL,
	`date_created` DATETIME NOT NULL,
	`date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	INDEX `customgroups_id` (`customgroups_id`),
	INDEX `FK_customgroups_member_non_ucroo_member` (`non_ucroo_id`),
	CONSTRAINT `FK_customgroups_member_non_ucroo_member` FOREIGN KEY (`non_ucroo_id`) REFERENCES `non_ucroo_member` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `FK_customgroups_member_customgroups` FOREIGN KEY (`customgroups_id`) REFERENCES `customgroups` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPACT
AUTO_INCREMENT=1;


CREATE TABLE `ucroo_event` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`module_id` INT(10) NOT NULL,
	`module_name` VARCHAR(35) NOT NULL,
	`title` VARCHAR(70) NOT NULL,
	`description` TEXT NOT NULL,
	`picture` VARCHAR(100) NULL DEFAULT NULL,
	`picture_thumb` VARCHAR(300) NULL DEFAULT NULL,
	`start_date` DATETIME NOT NULL,
	`end_date` DATETIME NOT NULL,
	`location` VARCHAR(100) NOT NULL,
	`creator_id` INT(11) NOT NULL,
	`max_attendees` VARCHAR(5) NULL DEFAULT NULL,
	`date_created` DATETIME NOT NULL,
	`date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	INDEX `customgroups_id` (`module_id`),
	INDEX `FK_ucroo_event_users` (`creator_id`),
	CONSTRAINT `FK_ucroo_event_users` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPACT
AUTO_INCREMENT=1;

CREATE TABLE `ucroo_event_member` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`event_id` INT(11) NOT NULL,
	`user_id` INT(11) NULL DEFAULT NULL,
	`member_email` VARCHAR(254) NULL DEFAULT NULL,
	`date_created` DATETIME NOT NULL,
	`date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	INDEX `event_id` (`event_id`),
	INDEX `FK_customgroups_member_users` (`user_id`),
	CONSTRAINT `FK_ucroo_event_member_ucroo_event` FOREIGN KEY (`event_id`) REFERENCES `ucroo_event` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPACT
AUTO_INCREMENT=1;


ALTER TABLE `customgroups` ADD `uni_id` INT( 11 ) NOT NULL AFTER `owner_user_id`;


ALTER TABLE `permissions` CHANGE `object` `object` ENUM( 'feed', 'services', 'unit', 'club', 'study_group', 'club_committee', 'signup', 'account', 'year', 'university', 'faculty', 'service_page', 'service_staff', 'customgroups') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;


INSERT INTO `permissions` (`id` ,`object` ,`action` ,`modes` ,`default` ,`is_group`) VALUES 
(NULL , 'customgroups', 'admin', 'view,edit,delete', NULL , '1'), 
(NULL , 'customgroups', 'post', 'view,edit,delete', NULL , '1'), 
(NULL , 'customgroups', 'numposts', 'view,edit', NULL , '1'), 
(NULL , 'customgroups', 'email', 'view,edit', NULL , '1'), 
(NULL , 'customgroups', 'notification', 'view,edit', NULL , '1'), 
(NULL , 'customgroups', 'report', 'view,edit', NULL , '1'), 
(NULL , 'customgroups', 'pin', 'view,edit', NULL , '1'), 
(NULL , 'customgroups', 'poll', 'view,edit,delete', NULL , '1'), 
(NULL , 'customgroups', 'file', 'view,edit,delete', NULL , '1'), 
(NULL , 'customgroups', 'link', 'view,edit,delete', NULL , '1');


ALTER TABLE `university_admin`
ADD `non_ucroo_id` int(11) NULL,
ADD `date_created` datetime NULL AFTER `non_ucroo_id`,
ADD `date_modified` timestamp NULL AFTER `date_created`,
COMMENT=''; 
ALTER TABLE `university_admin`
DROP FOREIGN KEY `university_admin_ibfk_1`,
ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `university_admin`
ADD FOREIGN KEY (`uni_id`) REFERENCES `university` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `university_admin`
ADD FOREIGN KEY (`non_ucroo_id`) REFERENCES `non_ucroo_member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE `monitor_keywords` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`user_id` INT(11) NULL DEFAULT NULL,
`uni_id` INT(11) NOT NULL,
`non_ucroo_id` INT(11) NOT NULL,
`keyword` VARCHAR(255) NOT NULL,
`notify_all` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '1 - Notify All Admin , 0- Default',
`date_created` DATETIME NOT NULL,
`date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
INDEX `user_id` (`user_id`),
INDEX `FK_monitor_keywords_university` (`uni_id`),
INDEX `FK_monitor_keywords_non_ucroo_member` (`non_ucroo_id`),
CONSTRAINT `FK_monitor_keywords_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT `FK_monitor_keywords_university` FOREIGN KEY (`uni_id`) REFERENCES `university` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT `FK_monitor_keywords_non_ucroo_member` FOREIGN KEY (`non_ucroo_id`) REFERENCES `non_ucroo_member` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `monitor_keywords`
CHANGE `non_ucroo_id` `non_ucroo_id` int(11) NULL AFTER `uni_id`,
COMMENT='';



  ";

  
?>
