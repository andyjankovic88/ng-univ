<?php

/**
 * Upgrade_<version>
 *
 * Add rules, activities and badge definitions for the pass_subject badges.
 *
 * @return array of sql queries;
 */
function ucroo_upgrade_1() {
  $sql = array();

  $sql = array(
      "SELECT count(*) from users",
//      "UPDATE `activity_types_recipients` SET `recipients`='contributors,author' WHERE `id`='3';",
//      "INSERT INTO `activity_types` (`type`, `name`, `has_activity`, `has_notification`, `has_email_notification`, `entity`, `grouping`) VALUES ('assessment_starts', 'Assessment starts', 1, 0, 0, 'assessment', 1)",
//      "INSERT INTO `activity_types` (`type`, `name`, `has_activity`, `has_notification`, `has_email_notification`, `entity`, `grouping`) VALUES ('assessment_reminder', 'Reminder about assessments closing', 1, 0, 0, 'assessment', 1);",
//      "INSERT INTO `activity_types_recipients` (`activity_type_id`, `recipients`, `action`) VALUES (7, 'contributors', 'activity')",
//      "INSERT INTO `activity_types_recipients` (`activity_type_id`, `recipients`, `action`) VALUES (8, 'contributors', 'activity')",
//      "UPDATE `activity_types` SET `entity`='class' WHERE `type`='feed_post'",
//      "UPDATE `activity_types` SET `entity`='class' WHERE `type`='feed_answer'",
//      "UPDATE `activity_types` SET `entity`='class' WHERE `type`='feed_answer_voted'"
  );

  return $sql;
}

function ucroo_upgrade_2() {
  $sql = array();

  $sql = array(
      "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;",
      "INSERT INTO user_groups (id,name,description,date_created,date_modified) VALUES(5, 'unadmin', 'University Admin', '2013-12-13 18:30:00', '2013-12-13 18:30:00');",
      "ALTER TABLE customgroups_member CHANGE COLUMN member_type member_type tinyint(5) NOT NULL DEFAULT '0';",
      "CREATE TABLE ucroo_feed_reported (id INT(11) NOT NULL AUTO_INCREMENT, feed_id INT(11) NOT NULL, reporter_id INT(11) NOT NULL, reported_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, flag SMALLINT(6) NOT NULL, PRIMARY KEY (id)) COLLATE='utf8_general_ci' ENGINE=InnoDB;",
      "ALTER TABLE feed_posts ADD COLUMN status SMALLINT(6) NOT NULL DEFAULT '1' AFTER date_modified;",
      "DROP TABLE final_year_event_member;",
      "DROP TABLE final_year_event;"
  );

  return $sql;
}

function ucroo_upgrade_3() {
  $sql = array();

  $sql = array(
      "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;",
      "ALTER TABLE service_dropin_details ADD COLUMN location VARCHAR(70) NULL AFTER dropin_end;",
      "ALTER TABLE service_pages  ADD COLUMN office_location VARCHAR(200) NULL DEFAULT NULL AFTER slug;"
  );

  return $sql;
}

function ucroo_upgrade_4() {
  $sql = array();

  $sql = array(
      "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;",
      "ALTER TABLE service_event  ADD COLUMN timezone VARCHAR(100) NULL DEFAULT NULL AFTER max_attendees;"
  );

  return $sql;
}

function ucroo_upgrade_5() {
  $sql = array();

//  $sql = array(
//      "ALTER TABLE service_event ADD COLUMN timezone VARCHAR(100) NULL DEFAULT NULL AFTER max_attendees;"
//  );

  return $sql;
}

function ucroo_upgrade_6() {
  $sql = array();

  $sql = array(
      "ALTER TABLE `user_meta` ADD COLUMN `staff_type` varchar(100) AFTER `position`, CHANGE COLUMN `first_name` `first_name` varchar(100) DEFAULT NULL AFTER `staff_type`, CHANGE COLUMN `last_name` `last_name` varchar(100) DEFAULT NULL AFTER `first_name`, CHANGE COLUMN `gender` `gender` varchar(6) DEFAULT NULL AFTER `last_name`, CHANGE COLUMN `birthdate` `birthdate` date DEFAULT NULL AFTER `gender`, CHANGE COLUMN `postcode` `postcode` int(11) DEFAULT NULL AFTER `birthdate`, CHANGE COLUMN `major` `major` varchar(100) DEFAULT NULL AFTER `postcode`, CHANGE COLUMN `picture` `picture` varchar(1000) DEFAULT NULL AFTER `major`, CHANGE COLUMN `uni_id` `uni_id` int(11) DEFAULT NULL AFTER `picture`, CHANGE COLUMN `available` `available` datetime DEFAULT NULL AFTER `uni_id`, CHANGE COLUMN `address1` `address1` varchar(100) DEFAULT NULL AFTER `available`, CHANGE COLUMN `address2` `address2` varchar(50) DEFAULT NULL AFTER `address1`, CHANGE COLUMN `address3` `address3` varchar(50) DEFAULT NULL AFTER `address2`, CHANGE COLUMN `city` `city` varchar(20) DEFAULT NULL AFTER `address3`, CHANGE COLUMN `state` `state` varchar(5) DEFAULT NULL AFTER `city`, CHANGE COLUMN `phone` `phone` varchar(15) DEFAULT NULL AFTER `state`, CHANGE COLUMN `start_year` `start_year` int(4) DEFAULT NULL AFTER `phone`, CHANGE COLUMN `year_of_completion` `year_of_completion` int(4) DEFAULT NULL AFTER `start_year`, CHANGE COLUMN `deleted_data` `deleted_data` text DEFAULT NULL AFTER `year_of_completion`, CHANGE COLUMN `date_created` `date_created` datetime NOT NULL AFTER `deleted_data`, CHANGE COLUMN `date_modified` `date_modified` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER `date_created`;"
  );

  return $sql;
}

function ucroo_upgrade_7() {
  $sql = array();

  $sql = array(
      "ALTER TABLE `permissions` CHANGE `object` `object` ENUM( 'feed', 'services', 'unit', 'club', 'study_group', 'club_committee', 'signup', 'account', 'year', 'university', 'faculty', 'service_page', 'service_staff', 'customgroups','mentors') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;",
      "INSERT INTO `permissions` (`id` ,`object` ,`action` ,`modes` ,`default` ,`is_group`) VALUES (NULL , 'mentors', 'post', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'question', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'link', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'pin', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'endorse', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'admin', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'notification', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'activity', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'email', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'like', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'subscribe', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'report', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'file', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'poll', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'tag', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'vote', 'view,edit,delete', NULL , '1'), (NULL , 'mentors', 'numposts', 'view,edit,delete', NULL , '1');",
      "ALTER TABLE `feed_posts`CHANGE `feed_object` `feed_object` enum('club','faculty','university','unit','study_group','club_committee','year','service_page','service_staff','final_year','customgroups','mentors') COLLATE 'utf8_general_ci' NOT NULL AFTER `id`,COMMENT='';",
      "CREATE TABLE ucroo_mentees (id INT(11) NOT NULL AUTO_INCREMENT,mentor_id INT(11) NOT NULL,user_id INT(11) NULL DEFAULT NULL,non_ucroo_id INT(11) NULL DEFAULT NULL,PRIMARY KEY (`id`)) COLLATE='latin1_swedish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;",
      "CREATE TABLE ucroo_mentor (id INT(11) NOT NULL AUTO_INCREMENT,user_id INT(11) NOT NULL,mentor_group_name VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',academic_topics VARCHAR(255) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',languages VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',hobbies VARCHAR(255) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',find_mentor SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '0-yes,1-no',count_mentees INT(6) NOT NULL,status INT(6) NOT NULL DEFAULT '0',date_created DATETIME NOT NULL,PRIMARY KEY (`id`),INDEX FK_ucroo_mentor_users (`user_id`),CONSTRAINT FK_ucroo_mentor_users FOREIGN KEY (`user_id`) REFERENCES users (`id`) ON UPDATE CASCADE ON DELETE CASCADE) COLLATE='utf8_general_ci' ENGINE=InnoDB AUTO_INCREMENT=1;"
  );

  return $sql;
}

function ucroo_upgrade_8() {
  $sql = array();

  $sql = array(
      "ALTER TABLE `ucroo_event`  ADD `uni_id` DOUBLE NOT NULL  AFTER `creator_id`;",
      "ALTER TABLE `customgroups` ADD `faculty_id` INT( 10 ) NULL DEFAULT NULL AFTER `privacy` , ADD `campus_id` DOUBLE NULL DEFAULT NULL AFTER `faculty_id`;"
  );

  return $sql;
}

function ucroo_upgrade_9() {
  $sql = array();

  $sql = array(
      "ALTER TABLE ucroo_event ADD COLUMN timezone VARCHAR(75) NULL AFTER location;"
  );

  return $sql;
}

function ucroo_upgrade_10() {
  $sql = array();

  $sql = array(
      "ALTER TABLE permissions CHANGE COLUMN action action ENUM('post','question','link','pin','endorse','admin','notification','activity','email','like','subscribe','report','file','poll','tag','vote','numposts','position','course','start','finish','faculty','degree','classes','connections','extracurr','timetable','status','create') NOT NULL AFTER object;"
  );

  return $sql;
}

function ucroo_upgrade_11() {
  $sql = array();

  $sql = array(
      "INSERT INTO `permissions` (`id` ,`object` ,`action` ,`modes` ,`default` ,`is_group`)VALUES (NULL , 'mentors', 'create', 'view,edit,delete', NULL , '1');"
  );

  return $sql;
}

function ucroo_upgrade_12() {
  $sql = array();

  $sql = array(
      "ALTER TABLE ucroo_mentor ADD COLUMN addable_mentees INT(6) NOT NULL COMMENT 'addable mentees that can join' AFTER count_mentees;"
  );

  return $sql;
}

function ucroo_upgrade_13() {
  $sql = array();

  $sql = array(
      "CREATE TABLE feed_posts_options (
  id INT(11) NOT NULL AUTO_INCREMENT,
  feed_id INT(11) NOT NULL,
  post_faculty_id VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
  post_campus_id VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
  post_course_id INT(11) NULL DEFAULT NULL,
  post_fb_page_id VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
  PRIMARY KEY (id),
  UNIQUE INDEX feed_id (feed_id),
  CONSTRAINT FK_feed_posts_options_feed_posts FOREIGN KEY (feed_id) REFERENCES feed_posts (id) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;"
  );

  return $sql;
}

/*
 * unsubscribe older students from first year feed
 */

function ucroo_upgrade_14() {

  $sql = array();

  $sql = array(
      "update user_feeds uf, year y
        set uf.subscribed = 0
        where uf.feed_object_id = y.id
        and uf.feed_object = 'year'
        and y.year = 1"
  );

  return $sql;
}

function ucroo_upgrade_15() {

  $sql = array();

  $sql = array(
      "ALTER TABLE ucroo_event ADD COLUMN campus_id DOUBLE NULL AFTER creator_id;"
  );

  return $sql;
}

function ucroo_upgrade_16() {

  $sql = array();

  $sql = array(
      "ALTER TABLE feed_posts ADD COLUMN post_faculty_id VARCHAR(150) NULL AFTER tags, ADD COLUMN post_campus_id VARCHAR(150) NULL AFTER post_faculty_id, ADD COLUMN post_fb_page_id VARCHAR(100) NULL AFTER post_campus_id, ADD COLUMN post_course_id INT(11) NULL AFTER post_fb_page_id;",
      "drop table feed_posts_options;"
  );

  return $sql;
}

/*
 * Update users first steps progress for new first steps and reset
 * first steps progress for academics, staff and uni admins except for
 * profile completion. I.e. if they have completed it don't bug them again.
 *
 * #1922 First Steps: Reorder, add explanatory text to each step and add steps related to new features
 */

function ucroo_upgrade_17() {
  $sql = array();

  $sql = array(
      "ALTER TABLE `users` CHANGE COLUMN `finished` `finished` int(7) UNSIGNED ZEROFILL DEFAULT NULL;",
      "UPDATE users
       SET `users`.`finished` = 1111111
       WHERE
         `users`.`group_id` = 2
       AND `users`.`finished` = 0011111;",
      "UPDATE users
       SET `finished` = SUBSTR(`finished`, -1, LENGTH(`finished`))
       WHERE
         `group_id` > 2;"
  );

  return $sql;
}

//function ucroo_upgrade_18()
//{
//  $sql = array();
//
//  $sql = array(
//// just delete the initial fk create statement from the o_migration.php file
////      "ALTER TABLE `service_admins` DROP FOREIGN KEY `FK_service_admins_service_non_ucroo_member`;",
//      "",
//      );
//
//  return $sql;
//}

function ucroo_upgrade_19() {
  $sql = array();

  $sql = array(
      "ALTER TABLE feed_posts ADD COLUMN deleted_datetime DATETIME NULL AFTER status;",
  );

  return $sql;
}

function ucroo_upgrade_20() {
  $sql = array();

  $sql = array(
      "ALTER TABLE permissions CHANGE COLUMN object object ENUM('feed','services','unit','club','study_group','club_committee','signup','account','year','university','faculty','service_page','service_staff','customgroups','mentors','university_staff') NOT NULL;",
      "INSERT INTO `permissions` (`id` ,`object` ,`action` ,`modes` ,`default` ,`is_group`) VALUES (NULL , 'university_staff', 'post', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'question', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'link', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'pin', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'endorse', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'admin', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'notification', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'activity', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'email', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'like', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'subscribe', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'report', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'file', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'poll', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'tag', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'vote', 'view,edit,delete', NULL , '1'), (NULL , 'university_staff', 'numposts', 'view,edit,delete', NULL , '1');",
      "ALTER TABLE `feed_posts` CHANGE `feed_object` `feed_object` enum('club','faculty','university','unit','study_group','club_committee','year','service_page','service_staff','final_year','customgroups','mentors','university_staff') COLLATE 'utf8_general_ci' NOT NULL AFTER `id`,COMMENT='';",
      "ALTER TABLE `user_feeds` CHANGE COLUMN `feed_object` `feed_object` ENUM('club','faculty','university','unit','study_group','year','service_page','service_staff','final_year','university_staff') NOT NULL AFTER `user_id`;",
      "CREATE TABLE university_staff (id INT(11) NOT NULL AUTO_INCREMENT, uni_id INT(11) NOT NULL, name VARCHAR(70) NOT NULL,PRIMARY KEY (id)) COLLATE='latin1_swedish_ci' ENGINE=InnoDB;"
  );

  return $sql;
}

function ucroo_upgrade_21() {

  $sql = array(
      "INSERT INTO `faculty` (uni_id, name, date_created) SELECT id,'- Not applicable', NOW() FROM university;"
  );

  return $sql;
}

function ucroo_upgrade_22() {

  $sql = array(
      "ALTER TABLE ucroo_mentor ADD faculty_id int(11) NULL AFTER addable_mentees, ADD faculty_id2 int(11) NULL AFTER faculty_id, COMMENT='';"
  );

  return $sql;
}

function ucroo_upgrade_23() {

  $sql = array("INSERT INTO permissions (`id`, `object`, `action`, `modes`, `default`, `is_group`) VALUES (NULL, 'university', 'pin', 'view,edit', NULL, '1')");

  return $sql;
}

////moving user group permissions into code to save the work of checking all the boxes
//function ucroo_upgrade_24()
//{
//
////  $sql = array(
////      "TRUNCATE TABLE user_groups_permissions;",
////      "INSERT INTO `user_groups_permissions` VALUES ('1', '1', '108', 'edit,view,delete'), ('2', '1', '119', 'edit,view'), ('3', '1', '109', 'edit,view,delete'), ('4', '1', '111', 'edit,view,delete'), ('5', '1', '112', 'edit,view,delete'), ('6', '1', '110', 'edit,view,delete'), ('7', '1', '113', 'edit,view'), ('8', '1', '114', 'edit,view'), ('9', '1', '115', 'edit,view'), ('10', '1', '116', 'edit,view'), ('11', '1', '117', 'edit,view,delete'), ('12', '1', '118', 'edit,view'), ('13', '1', '120', 'edit,view'), ('14', '1', '121', 'edit,view,delete'), ('15', '1', '69', 'edit,view'), ('16', '1', '57', 'edit,view,delete'), ('17', '1', '65', 'edit,view,delete'), ('18', '1', '64', 'edit,view'), ('19', '1', '67', 'edit,view'), ('20', '1', '68', 'edit,view'), ('21', '1', '59', 'edit,view,delete'), ('22', '1', '58', 'edit,view,delete'), ('23', '1', '60', 'edit,view,delete'), ('24', '1', '66', 'edit,view'), ('25', '1', '70', 'edit,view,delete'), ('26', '1', '72', 'edit,view,delete'), ('27', '1', '77', 'edit,view'), ('28', '1', '74', 'edit,view,delete'), ('29', '1', '76', 'edit,view,delete'), ('30', '1', '71', 'edit,view,delete'), ('31', '1', '79', 'edit,view'), ('32', '1', '78', 'edit,view'), ('33', '1', '75', 'edit,view'), ('34', '1', '73', 'edit,view,delete'), ('35', '1', '83', 'edit,view,delete'), ('36', '1', '87', 'edit,view'), ('37', '1', '84', 'edit,view,delete'), ('38', '1', '80', 'edit,view,delete'), ('39', '1', '81', 'edit,view,delete'), ('40', '1', '82', 'edit,view,delete'), ('41', '1', '88', 'edit,view,delete'), ('42', '1', '86', 'edit,view'), ('43', '1', '85', 'edit,view,delete'), ('44', '1', '91', 'view'), ('45', '1', '92', 'view'), ('46', '1', '93', 'view'), ('47', '1', '137', 'edit,view'), ('48', '1', '136', 'edit,view'), ('49', '1', '135', 'edit,view'), ('50', '1', '134', 'edit,view'), ('51', '1', '133', 'edit,view,delete'), ('52', '1', '132', 'edit,view'), ('53', '1', '131', 'edit,view,delete'), ('54', '1', '130', 'edit,view,delete'), ('55', '1', '129', 'edit,view,delete'), ('56', '1', '128', 'edit,view,delete'), ('57', '1', '144', 'edit,view'), ('58', '1', '145', 'edit,view'), ('59', '1', '146', 'edit,view'), ('60', '1', '220', 'edit,view'), ('61', '1', '143', 'edit,view,delete'), ('62', '1', '142', 'edit,view'), ('63', '1', '141', 'edit,view,delete'), ('64', '1', '140', 'edit,view,delete'), ('65', '1', '139', 'edit,view,delete'), ('66', '1', '138', 'edit,view,delete'), ('67', '1', '155', 'edit,view'), ('68', '1', '154', 'edit,view'), ('69', '1', '153', 'edit,view'), ('70', '1', '152', 'edit,view,delete'), ('71', '1', '151', 'edit,view'), ('72', '1', '150', 'edit,view,delete'), ('73', '1', '149', 'edit,view,delete'), ('74', '1', '148', 'edit,view,delete'), ('75', '1', '147', 'edit,view,delete'), ('76', '1', '165', 'edit,view,delete'), ('77', '1', '164', 'edit,view,delete'), ('78', '1', '163', 'edit,view,delete'), ('79', '1', '162', 'edit,view'), ('80', '1', '161', 'edit,view'), ('81', '1', '160', 'edit,view'), ('82', '1', '159', 'edit,view'), ('83', '1', '158', 'edit,view'), ('84', '1', '157', 'edit,view,delete'), ('85', '1', '156', 'edit,view,delete'), ('86', '1', '174', 'edit,view,delete'), ('87', '1', '173', 'edit,view'), ('88', '1', '172', 'edit,view'), ('89', '1', '171', 'edit,view,delete'), ('90', '1', '170', 'edit,view,delete'), ('91', '1', '169', 'edit,view,delete'), ('92', '1', '168', 'edit,view,delete'), ('93', '1', '167', 'edit,view,delete'), ('94', '1', '166', 'edit,view,delete'), ('95', '1', '182', 'edit,view,delete'), ('96', '1', '183', 'edit,view,delete'), ('97', '1', '184', 'edit,view,delete'), ('98', '1', '178', 'edit,view'), ('99', '1', '181', 'edit,view'), ('100', '1', '180', 'edit,view'), ('101', '1', '179', 'edit,view'), ('102', '1', '177', 'edit,view'), ('103', '1', '176', 'edit,view,delete'), ('104', '1', '175', 'edit,view,delete'), ('105', '1', '196', 'edit,view,delete'), ('106', '1', '197', 'edit,view,delete'), ('107', '1', '198', 'edit,view,delete'), ('108', '1', '199', 'edit,view,delete'), ('109', '1', '201', 'edit,view,delete'), ('110', '1', '195', 'edit,view,delete'), ('111', '1', '194', 'edit,view,delete'), ('112', '1', '185', 'edit,view,delete'), ('113', '1', '187', 'edit,view,delete'), ('114', '1', '188', 'edit,view,delete'), ('115', '1', '189', 'edit,view,delete'), ('116', '1', '190', 'edit,view,delete'), ('117', '1', '191', 'edit,view,delete'), ('118', '1', '192', 'edit,view,delete'), ('119', '1', '193', 'edit,view,delete'), ('120', '2', '108', 'edit,view,delete'), ('121', '2', '119', 'edit,view'), ('122', '2', '109', 'edit,view,delete'), ('123', '2', '111', 'edit,view,delete'), ('124', '2', '112', 'edit,view,delete'), ('125', '2', '110', 'edit,view,delete'), ('126', '2', '113', 'view'), ('127', '2', '115', 'edit,view'), ('128', '2', '116', 'edit,view'), ('129', '2', '117', 'view,delete'), ('130', '2', '118', 'edit,view'), ('131', '2', '120', 'edit,view'), ('132', '2', '121', 'edit,view'), ('133', '2', '69', 'edit,view'), ('134', '2', '57', 'edit,view,delete'), ('135', '2', '64', 'view'), ('136', '2', '67', 'edit,view'), ('137', '2', '68', 'edit,view'), ('138', '2', '59', 'edit,view,delete'), ('139', '2', '58', 'edit,view,delete'), ('140', '2', '60', 'edit,view,delete'), ('141', '2', '66', 'edit,view'), ('142', '2', '70', 'edit,view,delete'), ('143', '2', '72', 'edit,view,delete'), ('144', '2', '77', 'edit,view'), ('145', '2', '74', 'edit,view,delete'), ('146', '2', '71', 'edit,view,delete'), ('147', '2', '79', 'edit,view'), ('148', '2', '78', 'edit,view'), ('149', '2', '75', 'edit,view'), ('150', '2', '73', 'edit,view,delete'), ('151', '2', '83', 'edit,view,delete'), ('152', '2', '87', 'edit,view'), ('153', '2', '84', 'edit,view,delete'), ('154', '2', '80', 'edit,view,delete'), ('155', '2', '81', 'edit,view,delete'), ('156', '2', '82', 'edit,view,delete'), ('157', '2', '88', 'edit,view,delete'), ('158', '2', '86', 'edit,view'), ('159', '2', '91', 'view'), ('160', '2', '92', 'view'), ('161', '2', '93', 'view'), ('162', '2', '137', 'edit,view'), ('163', '2', '136', 'edit,view'), ('164', '2', '135', 'edit,view'), ('165', '2', '134', 'edit,view'), ('166', '2', '131', 'edit,view,delete'), ('167', '2', '130', 'edit,view,delete'), ('168', '2', '129', 'edit,view,delete'), ('169', '2', '128', 'edit,view,delete'), ('170', '2', '144', 'edit,view'), ('171', '2', '145', 'edit,view'), ('172', '2', '146', 'edit,view'), ('173', '2', '220', 'view'), ('174', '2', '142', 'edit,view'), ('175', '2', '141', 'edit,view,delete'), ('176', '2', '140', 'edit,view,delete'), ('177', '2', '139', 'edit,view,delete'), ('178', '2', '138', 'edit,view,delete'), ('179', '2', '155', 'edit,view'), ('180', '2', '154', 'edit,view'), ('181', '2', '153', 'edit,view'), ('182', '2', '151', 'edit,view'), ('183', '2', '150', 'edit,view,delete'), ('184', '2', '149', 'edit,view,delete'), ('185', '2', '148', 'edit,view,delete'), ('186', '2', '147', 'edit,view,delete'), ('187', '2', '165', 'edit,view,delete'), ('188', '2', '164', 'edit,view,delete'), ('189', '2', '163', 'edit,view,delete'), ('190', '2', '162', 'view'), ('191', '2', '161', 'edit,view'), ('192', '2', '160', 'edit,view'), ('193', '2', '159', 'edit,view'), ('194', '2', '158', 'edit,view'), ('195', '2', '157', 'edit,view,delete'), ('196', '2', '156', 'edit,view,delete'), ('197', '2', '174', 'edit,view,delete'), ('198', '2', '173', 'edit,view'), ('199', '2', '172', 'edit,view'), ('200', '2', '170', 'edit,view,delete'), ('201', '2', '169', 'edit,view,delete'), ('202', '2', '168', 'edit,view,delete'), ('203', '2', '167', 'edit,view,delete'), ('204', '2', '166', 'edit,view,delete'), ('205', '2', '182', 'edit,view,delete'), ('206', '2', '183', 'edit,view,delete'), ('207', '2', '184', 'edit,view,delete'), ('208', '2', '178', 'edit,view'), ('209', '2', '180', 'edit,view'), ('210', '2', '179', 'edit,view'), ('211', '2', '177', 'edit,view'), ('212', '2', '176', 'edit,view,delete'), ('213', '2', '175', 'edit,view,delete'), ('214', '2', '196', 'edit,view,delete'), ('215', '2', '197', 'edit,view,delete'), ('216', '2', '198', 'edit,view,delete'), ('217', '2', '199', 'edit,view,delete'), ('218', '2', '201', 'edit,view,delete'), ('219', '2', '202', 'edit,delete'), ('220', '2', '195', 'edit,view,delete'), ('221', '2', '194', 'edit,view,delete'), ('222', '2', '185', 'edit,view,delete'), ('223', '2', '187', 'edit,view,delete'), ('224', '2', '188', 'edit,view,delete'), ('225', '2', '189', 'edit,view,delete'), ('226', '2', '190', 'edit,view,delete'), ('227', '2', '191', 'edit,view,delete'), ('228', '2', '192', 'edit,view,delete'), ('229', '2', '193', 'edit,view,delete'), ('230', '3', '108', 'edit,view,delete'), ('231', '3', '119', 'edit,view'), ('232', '3', '109', 'edit,view,delete'), ('233', '3', '111', 'edit,view,delete'), ('234', '3', '112', 'edit,view,delete'), ('235', '3', '110', 'edit,view,delete'), ('236', '3', '113', 'edit,view'), ('237', '3', '114', 'edit,view'), ('238', '3', '115', 'edit,view'), ('239', '3', '116', 'edit,view'), ('240', '3', '117', 'view,delete'), ('241', '3', '118', 'edit,view'), ('242', '3', '120', 'view'), ('243', '3', '121', 'edit,view,delete'), ('244', '3', '69', 'edit,view'), ('245', '3', '57', 'edit,view,delete'), ('246', '3', '64', 'edit,view'), ('247', '3', '67', 'edit,view'), ('248', '3', '68', 'edit,view'), ('249', '3', '59', 'edit,view,delete'), ('250', '3', '58', 'edit,view,delete'), ('251', '3', '60', 'edit,view,delete'), ('252', '3', '66', 'edit,view'), ('253', '3', '70', 'edit,view,delete'), ('254', '3', '72', 'edit,view,delete'), ('255', '3', '77', 'edit,view'), ('256', '3', '74', 'edit,view,delete'), ('257', '3', '71', 'edit,view,delete'), ('258', '3', '79', 'edit,view'), ('259', '3', '78', 'edit,view'), ('260', '3', '75', 'edit,view'), ('261', '3', '73', 'edit,view,delete'), ('262', '3', '83', 'edit,view,delete'), ('263', '3', '87', 'edit,view'), ('264', '3', '84', 'edit,view,delete'), ('265', '3', '80', 'edit,view,delete'), ('266', '3', '81', 'edit,view,delete'), ('267', '3', '82', 'edit,view,delete'), ('268', '3', '88', 'edit,view,delete'), ('269', '3', '86', 'edit,view'), ('270', '3', '94', 'view'), ('271', '3', '89', 'view'), ('272', '3', '137', 'edit,view'), ('273', '3', '136', 'edit,view'), ('274', '3', '135', 'edit,view'), ('275', '3', '134', 'edit,view'), ('276', '3', '131', 'edit,view,delete'), ('277', '3', '130', 'edit,view,delete'), ('278', '3', '129', 'edit,view,delete'), ('279', '3', '128', 'edit,view,delete'), ('280', '3', '144', 'edit,view'), ('281', '3', '145', 'edit,view'), ('282', '3', '146', 'edit,view'), ('283', '3', '220', 'edit,view'), ('284', '3', '142', 'edit,view'), ('285', '3', '141', 'edit,view,delete'), ('286', '3', '140', 'edit,view,delete'), ('287', '3', '139', 'edit,view,delete'), ('288', '3', '138', 'edit,view,delete'), ('289', '3', '155', 'edit,view'), ('290', '3', '154', 'edit,view'), ('291', '3', '153', 'edit,view'), ('292', '3', '151', 'edit,view'), ('293', '3', '150', 'edit,view,delete'), ('294', '3', '149', 'edit,view,delete'), ('295', '3', '148', 'edit,view,delete'), ('296', '3', '147', 'edit,view,delete'), ('297', '3', '165', 'edit,view,delete'), ('298', '3', '164', 'edit,view,delete'), ('299', '3', '163', 'edit,view,delete'), ('300', '3', '162', 'edit,view'), ('301', '3', '161', 'edit,view'), ('302', '3', '160', 'edit,view'), ('303', '3', '159', 'edit,view'), ('304', '3', '158', 'edit,view'), ('305', '3', '157', 'edit,view,delete'), ('306', '3', '156', 'edit,view,delete'), ('307', '3', '174', 'edit,view,delete'), ('308', '3', '173', 'edit,view'), ('309', '3', '172', 'edit,view'), ('310', '3', '170', 'edit,view,delete'), ('311', '3', '169', 'edit,view,delete'), ('312', '3', '168', 'edit,view,delete'), ('313', '3', '167', 'edit,view,delete'), ('314', '3', '166', 'edit,view,delete'), ('315', '3', '182', 'edit,view,delete'), ('316', '3', '183', 'edit,view,delete'), ('317', '3', '184', 'edit,view,delete'), ('318', '3', '178', 'edit,view'), ('319', '3', '181', 'edit,view'), ('320', '3', '180', 'edit,view'), ('321', '3', '179', 'edit,view'), ('322', '3', '177', 'edit,view'), ('323', '3', '176', 'edit,view,delete'), ('324', '3', '175', 'edit,view,delete'), ('325', '3', '196', 'edit,view,delete'), ('326', '3', '197', 'edit,view,delete'), ('327', '3', '198', 'edit,view,delete'), ('328', '3', '199', 'edit,view,delete'), ('329', '3', '201', 'edit,view,delete'), ('330', '3', '202', 'edit,delete'), ('331', '3', '195', 'edit,view,delete'), ('332', '3', '194', 'edit,view,delete'), ('333', '3', '185', 'edit,view,delete'), ('334', '3', '187', 'edit,view,delete'), ('335', '3', '188', 'edit,view,delete'), ('336', '3', '189', 'edit,view,delete'), ('337', '3', '190', 'edit,view,delete'), ('338', '3', '191', 'edit,view,delete'), ('339', '3', '192', 'edit,view,delete'), ('340', '3', '193', 'edit,view,delete'), ('341', '3', '213', 'edit,view,delete'), ('342', '3', '214', 'edit,view,delete'), ('343', '3', '215', 'edit,view,delete'), ('344', '3', '216', 'edit,view,delete'), ('345', '3', '217', 'edit,view,delete'), ('346', '3', '218', 'edit,view,delete'), ('347', '3', '219', 'edit,view,delete'), ('348', '3', '211', 'edit,view,delete'), ('349', '3', '210', 'edit,view,delete'), ('350', '3', '209', 'edit,view,delete'), ('351', '3', '208', 'edit,view,delete'), ('352', '3', '207', 'edit,view,delete'), ('353', '3', '206', 'edit,view,delete'), ('354', '3', '205', 'edit,view,delete'), ('355', '3', '203', 'edit,view,delete'), ('356', '4', '108', 'edit,view'), ('357', '4', '119', 'edit,view'), ('358', '4', '109', 'edit,view'), ('359', '4', '111', 'edit,view'), ('360', '4', '112', 'view'), ('361', '4', '110', 'edit,view'), ('362', '4', '113', 'view'), ('363', '4', '115', 'edit,view'), ('364', '4', '116', 'edit,view'), ('365', '4', '118', 'edit,view'), ('366', '4', '120', 'view'), ('367', '4', '121', 'edit,view'), ('368', '4', '69', 'view'), ('369', '4', '57', 'view'), ('370', '4', '64', 'view'), ('371', '4', '67', 'edit,view'), ('372', '4', '68', 'edit,view'), ('373', '4', '59', 'edit,view,delete'), ('374', '4', '58', 'edit,view,delete'), ('375', '4', '60', 'edit,view,delete'), ('376', '4', '66', 'edit,view'), ('377', '4', '70', 'edit,view,delete'), ('378', '4', '72', 'edit,view,delete'), ('379', '4', '77', 'edit,view'), ('380', '4', '74', 'edit,view,delete'), ('381', '4', '71', 'edit,view,delete'), ('382', '4', '79', 'edit,view'), ('383', '4', '78', 'edit,view'), ('384', '4', '75', 'edit,view'), ('385', '4', '73', 'edit,view,delete'), ('386', '4', '83', 'edit,view,delete'), ('387', '4', '87', 'edit,view'), ('388', '4', '84', 'edit,view,delete'), ('389', '4', '80', 'edit,view,delete'), ('390', '4', '81', 'edit,view,delete'), ('391', '4', '82', 'edit,view,delete'), ('392', '4', '88', 'edit,view,delete'), ('393', '4', '86', 'edit,view'), ('394', '4', '94', 'view'), ('395', '4', '89', 'view'), ('396', '4', '137', 'view'), ('397', '4', '136', 'edit,view'), ('398', '4', '135', 'edit,view'), ('399', '4', '134', 'edit,view'), ('400', '4', '131', 'edit,view,delete'), ('401', '4', '130', 'edit,view,delete'), ('402', '4', '129', 'edit,view,delete'), ('403', '4', '128', 'edit,view'), ('404', '4', '144', 'edit,view'), ('405', '4', '145', 'edit,view'), ('406', '4', '146', 'view'), ('407', '4', '220', 'edit,view'), ('408', '4', '142', 'edit,view'), ('409', '4', '141', 'edit,view,delete'), ('410', '4', '140', 'edit,view,delete'), ('411', '4', '139', 'edit,view,delete'), ('412', '4', '138', 'edit,view,delete'), ('413', '4', '155', 'view'), ('414', '4', '154', 'edit,view'), ('415', '4', '153', 'edit,view'), ('416', '4', '151', 'edit,view'), ('417', '4', '150', 'edit,view,delete'), ('418', '4', '149', 'edit,view,delete'), ('419', '4', '148', 'edit,view,delete'), ('420', '4', '147', 'edit,view,delete'), ('421', '4', '165', 'edit,view,delete'), ('422', '4', '164', 'edit,view,delete'), ('423', '4', '163', 'edit,view,delete'), ('424', '4', '162', 'edit,view'), ('425', '4', '161', 'edit,view'), ('426', '4', '160', 'edit,view'), ('427', '4', '159', 'edit,view'), ('428', '4', '158', 'view'), ('429', '4', '157', 'view'), ('430', '4', '156', 'edit,view,delete'), ('431', '4', '174', 'edit,view,delete'), ('432', '4', '173', 'edit,view'), ('433', '4', '172', 'edit,view'), ('434', '4', '171', 'edit,view,delete'), ('435', '4', '170', 'edit,view,delete'), ('436', '4', '169', 'edit,view,delete'), ('437', '4', '168', 'edit,view,delete'), ('438', '4', '167', 'edit,view,delete'), ('439', '4', '166', 'edit,view,delete'), ('440', '4', '182', 'edit,view,delete'), ('441', '4', '183', 'edit,view,delete'), ('442', '4', '184', 'edit,view,delete'), ('443', '4', '178', 'edit,view'), ('444', '4', '181', 'edit,view'), ('445', '4', '180', 'edit,view'), ('446', '4', '179', 'edit,view'), ('447', '4', '177', 'edit,view'), ('448', '4', '176', 'edit,view,delete'), ('449', '4', '175', 'edit,view,delete'), ('450', '4', '196', 'edit,view,delete'), ('451', '4', '197', 'edit,view,delete'), ('452', '4', '198', 'edit,view,delete'), ('453', '4', '199', 'edit,view,delete'), ('454', '4', '201', 'edit,view,delete'), ('455', '4', '202', 'edit,delete'), ('456', '4', '195', 'edit,view,delete'), ('457', '4', '194', 'edit,view,delete'), ('458', '4', '185', 'edit,view,delete'), ('459', '4', '187', 'edit,view,delete'), ('460', '4', '188', 'edit,view,delete'), ('461', '4', '189', 'edit,view,delete'), ('462', '4', '190', 'edit,view,delete'), ('463', '4', '191', 'edit,view,delete'), ('464', '4', '192', 'edit,view,delete'), ('465', '4', '193', 'edit,view,delete'), ('466', '4', '213', 'edit,view,delete'), ('467', '4', '214', 'edit,view,delete'), ('468', '4', '215', 'edit,view,delete'), ('469', '4', '216', 'edit,view,delete'), ('470', '4', '217', 'edit,view,delete'), ('471', '4', '218', 'edit,view,delete'), ('472', '4', '219', 'edit,view,delete'), ('473', '4', '211', 'edit,view,delete'), ('474', '4', '210', 'edit,view,delete'), ('475', '4', '209', 'edit,view,delete'), ('476', '4', '208', 'edit,view,delete'), ('477', '4', '207', 'edit,view,delete'), ('478', '4', '206', 'edit,view,delete'), ('479', '4', '205', 'edit,view,delete'), ('480', '4', '203', 'edit,view,delete'), ('481', '5', '108', 'edit,view,delete'), ('482', '5', '119', 'edit,view'), ('483', '5', '109', 'edit,view,delete'), ('484', '5', '111', 'edit,view,delete'), ('485', '5', '112', 'edit,view,delete'), ('486', '5', '110', 'edit,view,delete'), ('487', '5', '113', 'edit,view'), ('488', '5', '114', 'edit,view'), ('489', '5', '115', 'edit,view'), ('490', '5', '116', 'edit,view'), ('491', '5', '117', 'edit,view,delete'), ('492', '5', '118', 'edit,view'), ('493', '5', '120', 'edit,view'), ('494', '5', '121', 'edit,view,delete'), ('495', '5', '69', 'edit,view'), ('496', '5', '57', 'edit,view,delete'), ('497', '5', '65', 'edit,view,delete'), ('498', '5', '64', 'edit,view'), ('499', '5', '67', 'edit,view'), ('500', '5', '68', 'edit,view'), ('501', '5', '59', 'edit,view,delete'), ('502', '5', '58', 'edit,view,delete'), ('503', '5', '60', 'edit,view,delete'), ('504', '5', '66', 'edit,view'), ('505', '5', '70', 'edit,view,delete'), ('506', '5', '72', 'edit,view,delete'), ('507', '5', '77', 'edit,view'), ('508', '5', '74', 'edit,view,delete'), ('509', '5', '76', 'edit,view,delete'), ('510', '5', '71', 'edit,view,delete'), ('511', '5', '79', 'edit,view'), ('512', '5', '78', 'edit,view'), ('513', '5', '75', 'edit,view'), ('514', '5', '73', 'edit,view,delete'), ('515', '5', '83', 'edit,view,delete'), ('516', '5', '87', 'edit,view'), ('517', '5', '84', 'edit,view,delete'), ('518', '5', '80', 'edit,view,delete'), ('519', '5', '81', 'edit,view,delete'), ('520', '5', '82', 'edit,view,delete'), ('521', '5', '88', 'edit,view,delete'), ('522', '5', '86', 'edit,view'), ('523', '5', '85', 'edit,view,delete'), ('524', '5', '94', 'view'), ('525', '5', '89', 'view'), ('526', '5', '91', 'view'), ('527', '5', '92', 'view'), ('528', '5', '93', 'view'), ('529', '5', '137', 'edit,view'), ('530', '5', '136', 'edit,view'), ('531', '5', '135', 'edit,view'), ('532', '5', '134', 'edit,view'), ('533', '5', '133', 'edit,view,delete'), ('534', '5', '132', 'edit,view'), ('535', '5', '131', 'edit,view,delete'), ('536', '5', '130', 'edit,view,delete'), ('537', '5', '129', 'edit,view,delete'), ('538', '5', '128', 'edit,view,delete'), ('539', '5', '144', 'edit,view'), ('540', '5', '145', 'edit,view'), ('541', '5', '146', 'edit,view'), ('542', '5', '220', 'edit,view'), ('543', '5', '143', 'edit,view,delete'), ('544', '5', '142', 'edit,view'), ('545', '5', '141', 'edit,view,delete'), ('546', '5', '140', 'edit,view,delete'), ('547', '5', '139', 'edit,view,delete'), ('548', '5', '138', 'edit,view,delete'), ('549', '5', '155', 'edit,view'), ('550', '5', '154', 'edit,view'), ('551', '5', '153', 'edit,view'), ('552', '5', '152', 'edit,view,delete'), ('553', '5', '151', 'edit,view'), ('554', '5', '150', 'edit,view,delete'), ('555', '5', '149', 'edit,view,delete'), ('556', '5', '148', 'edit,view,delete'), ('557', '5', '147', 'edit,view,delete'), ('558', '5', '165', 'edit,view,delete'), ('559', '5', '164', 'edit,view,delete'), ('560', '5', '163', 'edit,view,delete'), ('561', '5', '162', 'edit,view'), ('562', '5', '161', 'edit,view'), ('563', '5', '160', 'edit,view'), ('564', '5', '159', 'edit,view'), ('565', '5', '158', 'edit,view'), ('566', '5', '157', 'edit,view,delete'), ('567', '5', '156', 'edit,view,delete'), ('568', '5', '174', 'edit,view,delete'), ('569', '5', '173', 'edit,view'), ('570', '5', '172', 'edit,view'), ('571', '5', '171', 'edit,view,delete'), ('572', '5', '170', 'edit,view,delete'), ('573', '5', '169', 'edit,view,delete'), ('574', '5', '168', 'edit,view,delete'), ('575', '5', '167', 'edit,view,delete'), ('576', '5', '166', 'edit,view,delete'), ('577', '5', '182', 'edit,view,delete'), ('578', '5', '183', 'edit,view,delete'), ('579', '5', '184', 'edit,view,delete'), ('580', '5', '178', 'edit,view'), ('581', '5', '181', 'edit,view'), ('582', '5', '180', 'edit,view'), ('583', '5', '179', 'edit,view'), ('584', '5', '177', 'edit,view'), ('585', '5', '176', 'edit,view,delete'), ('586', '5', '175', 'edit,view,delete'), ('587', '5', '196', 'edit,view,delete'), ('588', '5', '197', 'edit,view,delete'), ('589', '5', '198', 'edit,view,delete'), ('590', '5', '199', 'edit,view,delete'), ('591', '5', '201', 'edit,view,delete'), ('592', '5', '202', 'edit,delete'), ('593', '5', '195', 'edit,view,delete'), ('594', '5', '194', 'edit,view,delete'), ('595', '5', '185', 'edit,view,delete'), ('596', '5', '187', 'edit,view,delete'), ('597', '5', '188', 'edit,view,delete'), ('598', '5', '189', 'edit,view,delete'), ('599', '5', '190', 'edit,view,delete'), ('600', '5', '191', 'edit,view,delete'), ('601', '5', '192', 'edit,view,delete'), ('602', '5', '193', 'edit,view,delete'), ('603', '5', '213', 'edit,view,delete'), ('604', '5', '214', 'edit,view,delete'), ('605', '5', '215', 'edit,view,delete'), ('606', '5', '216', 'edit,view,delete'), ('607', '5', '217', 'edit,view,delete'), ('608', '5', '218', 'edit,view,delete'), ('609', '5', '219', 'edit,view,delete'), ('610', '5', '211', 'edit,view,delete'), ('611', '5', '210', 'edit,view,delete'), ('612', '5', '209', 'edit,view,delete'), ('613', '5', '208', 'edit,view,delete'), ('614', '5', '207', 'edit,view,delete'), ('615', '5', '206', 'edit,view,delete'), ('616', '5', '205', 'edit,view,delete'), ('617', '5', '203', 'edit,view,delete');"
////      );
//
////  return $sql;
//}
//now going to clear the permissions table first before add in user_groups_permission
function ucroo_upgrade_25() {

  $sql = array(
      "TRUNCATE TABLE user_groups_permissions;",
      "SET FOREIGN_KEY_CHECKS=0;",
      "TRUNCATE TABLE permissions;",
      "SET FOREIGN_KEY_CHECKS=1;",
      "INSERT INTO `permissions` VALUES ('57', 'club', 'post', 'view,edit,delete', null, '1'), ('58', 'club', 'link', 'view,edit,delete', null, '1'), ('59', 'club', 'file', 'view,edit,delete', null, '1'), ('60', 'club', 'poll', 'view,edit,delete', null, '1'), ('64', 'club', 'pin', 'view,edit', null, '1'), ('65', 'club', 'admin', 'view,edit,delete', null, '1'), ('66', 'club', 'report', 'view,edit', null, '1'), ('67', 'club', 'notification', 'view,edit', null, '1'), ('68', 'club', 'email', 'view,edit', null, '1'), ('69', 'club', 'numposts', 'view,edit', null, '1'), ('70', 'study_group', 'post', 'view,edit,delete', null, '1'), ('71', 'study_group', 'question', 'view,edit,delete', null, '1'), ('72', 'study_group', 'link', 'view,edit,delete', null, '1'), ('73', 'study_group', 'file', 'view,edit,delete', null, '1'), ('74', 'study_group', 'poll', 'view,edit,delete', null, '1'), ('75', 'study_group', 'vote', 'view,edit', null, '1'), ('76', 'study_group', 'admin', 'view,edit,delete', null, '1'), ('77', 'study_group', 'report', 'view,edit', null, '1'), ('78', 'study_group', 'notification', 'view,edit', null, '1'), ('79', 'study_group', 'numposts', 'view,edit', null, '1'), ('80', 'club_committee', 'post', 'view,edit,delete', null, '1'), ('81', 'club_committee', 'link', 'view,edit,delete', null, '1'), ('82', 'club_committee', 'file', 'view,edit,delete', null, '1'), ('83', 'club_committee', 'poll', 'view,edit,delete', null, '1'), ('84', 'club_committee', 'pin', 'view,edit,delete', null, '1'), ('85', 'club_committee', 'admin', 'view,edit,delete', null, '1'), ('86', 'club_committee', 'report', 'view,edit', null, '1'), ('87', 'club_committee', 'notification', 'view,edit', null, '1'), ('88', 'club_committee', 'numposts', 'view,edit,delete', null, '1'), ('89', 'signup', 'position', 'view', null, '1'), ('91', 'signup', 'course', 'view', null, '1'), ('92', 'signup', 'start', 'view', null, '1'), ('93', 'signup', 'finish', 'view', null, '1'), ('94', 'signup', 'faculty', 'view', null, '1'), ('108', 'unit', 'post', 'view,edit,delete', null, '1'), ('109', 'unit', 'question', 'view,edit,delete', null, '1'), ('110', 'unit', 'link', 'view,edit,delete', null, '1'), ('111', 'unit', 'file', 'view,edit,delete', null, '1'), ('112', 'unit', 'poll', 'view,edit,delete', null, '1'), ('113', 'unit', 'pin', 'view,edit', null, '1'), ('114', 'unit', 'endorse', 'view,edit', null, '1'), ('115', 'unit', 'vote', 'view,edit', null, '1'), ('116', 'unit', 'vote', 'view,edit', null, '1'), ('117', 'unit', 'admin', 'view,edit,delete', null, '1'), ('118', 'unit', 'report', 'view,edit', null, '1'), ('119', 'unit', 'notification', 'view,edit', null, '1'), ('120', 'unit', 'numposts', 'view,edit', null, '1'), ('121', 'unit', 'tag', 'view,edit,delete', null, '1'), ('122', 'account', 'degree', 'connections,everyone', 'everyone', '0'), ('123', 'account', 'classes', 'connections,everyone', 'everyone', '0'), ('124', 'account', 'connections', 'connections,everyone', 'everyone', '0'), ('125', 'account', 'extracurr', 'connections,everyone', 'everyone', '0'), ('126', 'account', 'timetable', 'connections', 'connections', '0'), ('127', 'account', 'status', 'connections', 'connections', '0'), ('128', 'year', 'post', 'view,edit,delete', null, '1'), ('129', 'year', 'link', 'view,edit,delete', null, '1'), ('130', 'year', 'file', 'view,edit,delete', null, '1'), ('131', 'year', 'poll', 'view,edit,delete', null, '1'), ('132', 'year', 'pin', 'view,edit', null, '1'), ('133', 'year', 'admin', 'view,edit,delete', null, '1'), ('134', 'year', 'report', 'view,edit', null, '1'), ('135', 'year', 'notification', 'view,edit', null, '1'), ('136', 'year', 'email', 'view,edit', null, '1'), ('137', 'year', 'numposts', 'view,edit', null, '1'), ('138', 'university', 'post', 'view,edit,delete', null, '1'), ('139', 'university', 'link', 'view,edit,delete', null, '1'), ('140', 'university', 'file', 'view,edit,delete', null, '1'), ('141', 'university', 'poll', 'view,edit,delete', null, '1'), ('142', 'university', 'like', 'view,edit', null, '1'), ('143', 'university', 'admin', 'view,edit,delete', null, '1'), ('144', 'university', 'report', 'view,edit', null, '1'), ('145', 'university', 'notification', 'view,edit', null, '1'), ('146', 'university', 'numposts', 'view,edit', null, '1'), ('147', 'faculty', 'post', 'view,edit,delete', null, '1'), ('148', 'faculty', 'link', 'view,edit,delete', null, '1'), ('149', 'faculty', 'file', 'view,edit,delete', null, '1'), ('150', 'faculty', 'poll', 'view,edit,delete', null, '1'), ('151', 'faculty', 'like', 'view,edit', null, '1'), ('152', 'faculty', 'admin', 'view,edit,delete', null, '1'), ('153', 'faculty', 'report', 'view,edit', null, '1'), ('154', 'faculty', 'notification', 'view,edit', null, '1'), ('155', 'faculty', 'numposts', 'view,edit', null, '1'), ('156', 'service_page', 'admin', 'view,edit,delete', null, '1'), ('157', 'service_page', 'post', 'view,edit,delete', null, '1'), ('158', 'service_page', 'numposts', 'view,edit', null, '1'), ('159', 'service_page', 'email', 'view,edit', null, '1'), ('160', 'service_page', 'notification', 'view,edit', null, '1'), ('161', 'service_page', 'report', 'view,edit', null, '1'), ('162', 'service_page', 'pin', 'view,edit', null, '1'), ('163', 'service_page', 'poll', 'view,edit,delete', null, '1'), ('164', 'service_page', 'file', 'view,edit,delete', null, '1'), ('165', 'service_page', 'link', 'view,edit,delete', null, '1'), ('166', 'service_staff', 'post', 'view,edit,delete', null, '1'), ('167', 'service_staff', 'link', 'view,edit,delete', null, '1'), ('168', 'service_staff', 'file', 'view,edit,delete', null, '1'), ('169', 'service_staff', 'poll', 'view,edit,delete', null, '1'), ('170', 'service_staff', 'pin', 'view,edit,delete', null, '1'), ('171', 'service_staff', 'admin', 'view,edit,delete', null, '1'), ('172', 'service_staff', 'report', 'view,edit', null, '1'), ('173', 'service_staff', 'notification', 'view,edit', null, '1'), ('174', 'service_staff', 'numposts', 'view,edit,delete', null, '1'), ('175', 'customgroups', 'admin', 'view,edit,delete', null, '1'), ('176', 'customgroups', 'post', 'view,edit,delete', null, '1'), ('177', 'customgroups', 'numposts', 'view,edit', null, '1'), ('178', 'customgroups', 'email', 'view,edit', null, '1'), ('179', 'customgroups', 'notification', 'view,edit', null, '1'), ('180', 'customgroups', 'report', 'view,edit', null, '1'), ('181', 'customgroups', 'pin', 'view,edit', null, '1'), ('182', 'customgroups', 'poll', 'view,edit,delete', null, '1'), ('183', 'customgroups', 'file', 'view,edit,delete', null, '1'), ('184', 'customgroups', 'link', 'view,edit,delete', null, '1'), ('185', 'mentors', 'post', 'view,edit,delete', null, '1'), ('186', 'mentors', 'question', 'view,edit,delete', null, '1'), ('187', 'mentors', 'link', 'view,edit,delete', null, '1'), ('188', 'mentors', 'pin', 'view,edit,delete', null, '1'), ('189', 'mentors', 'endorse', 'view,edit,delete', null, '1'), ('190', 'mentors', 'admin', 'view,edit,delete', null, '1'), ('191', 'mentors', 'notification', 'view,edit,delete', null, '1'), ('192', 'mentors', 'activity', 'view,edit,delete', null, '1'), ('193', 'mentors', 'email', 'view,edit,delete', null, '1'), ('194', 'mentors', 'like', 'view,edit,delete', null, '1'), ('195', 'mentors', 'subscribe', 'view,edit,delete', null, '1'), ('196', 'mentors', 'report', 'view,edit,delete', null, '1'), ('197', 'mentors', 'file', 'view,edit,delete', null, '1'), ('198', 'mentors', 'poll', 'view,edit,delete', null, '1'), ('199', 'mentors', 'tag', 'view,edit,delete', null, '1'), ('200', 'mentors', 'vote', 'view,edit,delete', null, '1'), ('201', 'mentors', 'numposts', 'view,edit,delete', null, '1'), ('202', 'mentors', 'create', 'view,edit,delete', null, '1'), ('203', 'university_staff', 'post', 'view,edit,delete', null, '1'), ('204', 'university_staff', 'question', 'view,edit,delete', null, '1'), ('205', 'university_staff', 'link', 'view,edit,delete', null, '1'), ('206', 'university_staff', 'pin', 'view,edit,delete', null, '1'), ('207', 'university_staff', 'endorse', 'view,edit,delete', null, '1'), ('208', 'university_staff', 'admin', 'view,edit,delete', null, '1'), ('209', 'university_staff', 'notification', 'view,edit,delete', null, '1'), ('210', 'university_staff', 'activity', 'view,edit,delete', null, '1'), ('211', 'university_staff', 'email', 'view,edit,delete', null, '1'), ('212', 'university_staff', 'like', 'view,edit,delete', null, '1'), ('213', 'university_staff', 'subscribe', 'view,edit,delete', null, '1'), ('214', 'university_staff', 'report', 'view,edit,delete', null, '1'), ('215', 'university_staff', 'file', 'view,edit,delete', null, '1'), ('216', 'university_staff', 'poll', 'view,edit,delete', null, '1'), ('217', 'university_staff', 'tag', 'view,edit,delete', null, '1'), ('218', 'university_staff', 'vote', 'view,edit,delete', null, '1'), ('219', 'university_staff', 'numposts', 'view,edit,delete', null, '1'), ('220', 'university', 'pin', 'view,edit', null, '1');",
      "INSERT INTO `user_groups_permissions` VALUES ('1', '1', '108', 'edit,view,delete'), ('2', '1', '119', 'edit,view'), ('3', '1', '109', 'edit,view,delete'), ('4', '1', '111', 'edit,view,delete'), ('5', '1', '112', 'edit,view,delete'), ('6', '1', '110', 'edit,view,delete'), ('7', '1', '113', 'edit,view'), ('8', '1', '114', 'edit,view'), ('9', '1', '115', 'edit,view'), ('10', '1', '116', 'edit,view'), ('11', '1', '117', 'edit,view,delete'), ('12', '1', '118', 'edit,view'), ('13', '1', '120', 'edit,view'), ('14', '1', '121', 'edit,view,delete'), ('15', '1', '69', 'edit,view'), ('16', '1', '57', 'edit,view,delete'), ('17', '1', '65', 'edit,view,delete'), ('18', '1', '64', 'edit,view'), ('19', '1', '67', 'edit,view'), ('20', '1', '68', 'edit,view'), ('21', '1', '59', 'edit,view,delete'), ('22', '1', '58', 'edit,view,delete'), ('23', '1', '60', 'edit,view,delete'), ('24', '1', '66', 'edit,view'), ('25', '1', '70', 'edit,view,delete'), ('26', '1', '72', 'edit,view,delete'), ('27', '1', '77', 'edit,view'), ('28', '1', '74', 'edit,view,delete'), ('29', '1', '76', 'edit,view,delete'), ('30', '1', '71', 'edit,view,delete'), ('31', '1', '79', 'edit,view'), ('32', '1', '78', 'edit,view'), ('33', '1', '75', 'edit,view'), ('34', '1', '73', 'edit,view,delete'), ('35', '1', '83', 'edit,view,delete'), ('36', '1', '87', 'edit,view'), ('37', '1', '84', 'edit,view,delete'), ('38', '1', '80', 'edit,view,delete'), ('39', '1', '81', 'edit,view,delete'), ('40', '1', '82', 'edit,view,delete'), ('41', '1', '88', 'edit,view,delete'), ('42', '1', '86', 'edit,view'), ('43', '1', '85', 'edit,view,delete'), ('44', '1', '91', 'view'), ('45', '1', '92', 'view'), ('46', '1', '93', 'view'), ('47', '1', '137', 'edit,view'), ('48', '1', '136', 'edit,view'), ('49', '1', '135', 'edit,view'), ('50', '1', '134', 'edit,view'), ('51', '1', '133', 'edit,view,delete'), ('52', '1', '132', 'edit,view'), ('53', '1', '131', 'edit,view,delete'), ('54', '1', '130', 'edit,view,delete'), ('55', '1', '129', 'edit,view,delete'), ('56', '1', '128', 'edit,view,delete'), ('57', '1', '144', 'edit,view'), ('58', '1', '145', 'edit,view'), ('59', '1', '146', 'edit,view'), ('60', '1', '220', 'edit,view'), ('61', '1', '143', 'edit,view,delete'), ('62', '1', '142', 'edit,view'), ('63', '1', '141', 'edit,view,delete'), ('64', '1', '140', 'edit,view,delete'), ('65', '1', '139', 'edit,view,delete'), ('66', '1', '138', 'edit,view,delete'), ('67', '1', '155', 'edit,view'), ('68', '1', '154', 'edit,view'), ('69', '1', '153', 'edit,view'), ('70', '1', '152', 'edit,view,delete'), ('71', '1', '151', 'edit,view'), ('72', '1', '150', 'edit,view,delete'), ('73', '1', '149', 'edit,view,delete'), ('74', '1', '148', 'edit,view,delete'), ('75', '1', '147', 'edit,view,delete'), ('76', '1', '165', 'edit,view,delete'), ('77', '1', '164', 'edit,view,delete'), ('78', '1', '163', 'edit,view,delete'), ('79', '1', '162', 'edit,view'), ('80', '1', '161', 'edit,view'), ('81', '1', '160', 'edit,view'), ('82', '1', '159', 'edit,view'), ('83', '1', '158', 'edit,view'), ('84', '1', '157', 'edit,view,delete'), ('85', '1', '156', 'edit,view,delete'), ('86', '1', '174', 'edit,view,delete'), ('87', '1', '173', 'edit,view'), ('88', '1', '172', 'edit,view'), ('89', '1', '171', 'edit,view,delete'), ('90', '1', '170', 'edit,view,delete'), ('91', '1', '169', 'edit,view,delete'), ('92', '1', '168', 'edit,view,delete'), ('93', '1', '167', 'edit,view,delete'), ('94', '1', '166', 'edit,view,delete'), ('95', '1', '182', 'edit,view,delete'), ('96', '1', '183', 'edit,view,delete'), ('97', '1', '184', 'edit,view,delete'), ('98', '1', '178', 'edit,view'), ('99', '1', '181', 'edit,view'), ('100', '1', '180', 'edit,view'), ('101', '1', '179', 'edit,view'), ('102', '1', '177', 'edit,view'), ('103', '1', '176', 'edit,view,delete'), ('104', '1', '175', 'edit,view,delete'), ('105', '1', '196', 'edit,view,delete'), ('106', '1', '197', 'edit,view,delete'), ('107', '1', '198', 'edit,view,delete'), ('108', '1', '199', 'edit,view,delete'), ('109', '1', '201', 'edit,view,delete'), ('110', '1', '195', 'edit,view,delete'), ('111', '1', '194', 'edit,view,delete'), ('112', '1', '185', 'edit,view,delete'), ('113', '1', '187', 'edit,view,delete'), ('114', '1', '188', 'edit,view,delete'), ('115', '1', '189', 'edit,view,delete'), ('116', '1', '190', 'edit,view,delete'), ('117', '1', '191', 'edit,view,delete'), ('118', '1', '192', 'edit,view,delete'), ('119', '1', '193', 'edit,view,delete'), ('120', '2', '108', 'edit,view,delete'), ('121', '2', '119', 'edit,view'), ('122', '2', '109', 'edit,view,delete'), ('123', '2', '111', 'edit,view,delete'), ('124', '2', '112', 'edit,view,delete'), ('125', '2', '110', 'edit,view,delete'), ('126', '2', '113', 'view'), ('127', '2', '115', 'edit,view'), ('128', '2', '116', 'edit,view'), ('129', '2', '117', 'view,delete'), ('130', '2', '118', 'edit,view'), ('131', '2', '120', 'edit,view'), ('132', '2', '121', 'edit,view'), ('133', '2', '69', 'edit,view'), ('134', '2', '57', 'edit,view,delete'), ('135', '2', '64', 'view'), ('136', '2', '67', 'edit,view'), ('137', '2', '68', 'edit,view'), ('138', '2', '59', 'edit,view,delete'), ('139', '2', '58', 'edit,view,delete'), ('140', '2', '60', 'edit,view,delete'), ('141', '2', '66', 'edit,view'), ('142', '2', '70', 'edit,view,delete'), ('143', '2', '72', 'edit,view,delete'), ('144', '2', '77', 'edit,view'), ('145', '2', '74', 'edit,view,delete'), ('146', '2', '71', 'edit,view,delete'), ('147', '2', '79', 'edit,view'), ('148', '2', '78', 'edit,view'), ('149', '2', '75', 'edit,view'), ('150', '2', '73', 'edit,view,delete'), ('151', '2', '83', 'edit,view,delete'), ('152', '2', '87', 'edit,view'), ('153', '2', '84', 'edit,view,delete'), ('154', '2', '80', 'edit,view,delete'), ('155', '2', '81', 'edit,view,delete'), ('156', '2', '82', 'edit,view,delete'), ('157', '2', '88', 'edit,view,delete'), ('158', '2', '86', 'edit,view'), ('159', '2', '91', 'view'), ('160', '2', '92', 'view'), ('161', '2', '93', 'view'), ('162', '2', '137', 'edit,view'), ('163', '2', '136', 'edit,view'), ('164', '2', '135', 'edit,view'), ('165', '2', '134', 'edit,view'), ('166', '2', '131', 'edit,view,delete'), ('167', '2', '130', 'edit,view,delete'), ('168', '2', '129', 'edit,view,delete'), ('169', '2', '128', 'edit,view,delete'), ('170', '2', '144', 'edit,view'), ('171', '2', '145', 'edit,view'), ('172', '2', '146', 'edit,view'), ('173', '2', '220', 'view'), ('174', '2', '142', 'edit,view'), ('175', '2', '141', 'edit,view,delete'), ('176', '2', '140', 'edit,view,delete'), ('177', '2', '139', 'edit,view,delete'), ('178', '2', '138', 'edit,view,delete'), ('179', '2', '155', 'edit,view'), ('180', '2', '154', 'edit,view'), ('181', '2', '153', 'edit,view'), ('182', '2', '151', 'edit,view'), ('183', '2', '150', 'edit,view,delete'), ('184', '2', '149', 'edit,view,delete'), ('185', '2', '148', 'edit,view,delete'), ('186', '2', '147', 'edit,view,delete'), ('187', '2', '165', 'edit,view,delete'), ('188', '2', '164', 'edit,view,delete'), ('189', '2', '163', 'edit,view,delete'), ('190', '2', '162', 'view'), ('191', '2', '161', 'edit,view'), ('192', '2', '160', 'edit,view'), ('193', '2', '159', 'edit,view'), ('194', '2', '158', 'edit,view'), ('195', '2', '157', 'edit,view,delete'), ('196', '2', '156', 'edit,view,delete'), ('197', '2', '174', 'edit,view,delete'), ('198', '2', '173', 'edit,view'), ('199', '2', '172', 'edit,view'), ('200', '2', '170', 'edit,view,delete'), ('201', '2', '169', 'edit,view,delete'), ('202', '2', '168', 'edit,view,delete'), ('203', '2', '167', 'edit,view,delete'), ('204', '2', '166', 'edit,view,delete'), ('205', '2', '182', 'edit,view,delete'), ('206', '2', '183', 'edit,view,delete'), ('207', '2', '184', 'edit,view,delete'), ('208', '2', '178', 'edit,view'), ('209', '2', '180', 'edit,view'), ('210', '2', '179', 'edit,view'), ('211', '2', '177', 'edit,view'), ('212', '2', '176', 'edit,view,delete'), ('213', '2', '175', 'edit,view,delete'), ('214', '2', '196', 'edit,view,delete'), ('215', '2', '197', 'edit,view,delete'), ('216', '2', '198', 'edit,view,delete'), ('217', '2', '199', 'edit,view,delete'), ('218', '2', '201', 'edit,view,delete'), ('219', '2', '202', 'edit,delete'), ('220', '2', '195', 'edit,view,delete'), ('221', '2', '194', 'edit,view,delete'), ('222', '2', '185', 'edit,view,delete'), ('223', '2', '187', 'edit,view,delete'), ('224', '2', '188', 'edit,view,delete'), ('225', '2', '189', 'edit,view,delete'), ('226', '2', '190', 'edit,view,delete'), ('227', '2', '191', 'edit,view,delete'), ('228', '2', '192', 'edit,view,delete'), ('229', '2', '193', 'edit,view,delete'), ('230', '3', '108', 'edit,view,delete'), ('231', '3', '119', 'edit,view'), ('232', '3', '109', 'edit,view,delete'), ('233', '3', '111', 'edit,view,delete'), ('234', '3', '112', 'edit,view,delete'), ('235', '3', '110', 'edit,view,delete'), ('236', '3', '113', 'edit,view'), ('237', '3', '114', 'edit,view'), ('238', '3', '115', 'edit,view'), ('239', '3', '116', 'edit,view'), ('240', '3', '117', 'view,delete'), ('241', '3', '118', 'edit,view'), ('242', '3', '120', 'view'), ('243', '3', '121', 'edit,view,delete'), ('244', '3', '69', 'edit,view'), ('245', '3', '57', 'edit,view,delete'), ('246', '3', '64', 'edit,view'), ('247', '3', '67', 'edit,view'), ('248', '3', '68', 'edit,view'), ('249', '3', '59', 'edit,view,delete'), ('250', '3', '58', 'edit,view,delete'), ('251', '3', '60', 'edit,view,delete'), ('252', '3', '66', 'edit,view'), ('253', '3', '70', 'edit,view,delete'), ('254', '3', '72', 'edit,view,delete'), ('255', '3', '77', 'edit,view'), ('256', '3', '74', 'edit,view,delete'), ('257', '3', '71', 'edit,view,delete'), ('258', '3', '79', 'edit,view'), ('259', '3', '78', 'edit,view'), ('260', '3', '75', 'edit,view'), ('261', '3', '73', 'edit,view,delete'), ('262', '3', '83', 'edit,view,delete'), ('263', '3', '87', 'edit,view'), ('264', '3', '84', 'edit,view,delete'), ('265', '3', '80', 'edit,view,delete'), ('266', '3', '81', 'edit,view,delete'), ('267', '3', '82', 'edit,view,delete'), ('268', '3', '88', 'edit,view,delete'), ('269', '3', '86', 'edit,view'), ('270', '3', '94', 'view'), ('271', '3', '89', 'view'), ('272', '3', '137', 'edit,view'), ('273', '3', '136', 'edit,view'), ('274', '3', '135', 'edit,view'), ('275', '3', '134', 'edit,view'), ('276', '3', '131', 'edit,view,delete'), ('277', '3', '130', 'edit,view,delete'), ('278', '3', '129', 'edit,view,delete'), ('279', '3', '128', 'edit,view,delete'), ('280', '3', '144', 'edit,view'), ('281', '3', '145', 'edit,view'), ('282', '3', '146', 'edit,view'), ('283', '3', '220', 'edit,view'), ('284', '3', '142', 'edit,view'), ('285', '3', '141', 'edit,view,delete'), ('286', '3', '140', 'edit,view,delete'), ('287', '3', '139', 'edit,view,delete'), ('288', '3', '138', 'edit,view,delete'), ('289', '3', '155', 'edit,view'), ('290', '3', '154', 'edit,view'), ('291', '3', '153', 'edit,view'), ('292', '3', '151', 'edit,view'), ('293', '3', '150', 'edit,view,delete'), ('294', '3', '149', 'edit,view,delete'), ('295', '3', '148', 'edit,view,delete'), ('296', '3', '147', 'edit,view,delete'), ('297', '3', '165', 'edit,view,delete'), ('298', '3', '164', 'edit,view,delete'), ('299', '3', '163', 'edit,view,delete'), ('300', '3', '162', 'edit,view'), ('301', '3', '161', 'edit,view'), ('302', '3', '160', 'edit,view'), ('303', '3', '159', 'edit,view'), ('304', '3', '158', 'edit,view'), ('305', '3', '157', 'edit,view,delete'), ('306', '3', '156', 'edit,view,delete'), ('307', '3', '174', 'edit,view,delete'), ('308', '3', '173', 'edit,view'), ('309', '3', '172', 'edit,view'), ('310', '3', '170', 'edit,view,delete'), ('311', '3', '169', 'edit,view,delete'), ('312', '3', '168', 'edit,view,delete'), ('313', '3', '167', 'edit,view,delete'), ('314', '3', '166', 'edit,view,delete'), ('315', '3', '182', 'edit,view,delete'), ('316', '3', '183', 'edit,view,delete'), ('317', '3', '184', 'edit,view,delete'), ('318', '3', '178', 'edit,view'), ('319', '3', '181', 'edit,view'), ('320', '3', '180', 'edit,view'), ('321', '3', '179', 'edit,view'), ('322', '3', '177', 'edit,view'), ('323', '3', '176', 'edit,view,delete'), ('324', '3', '175', 'edit,view,delete'), ('325', '3', '196', 'edit,view,delete'), ('326', '3', '197', 'edit,view,delete'), ('327', '3', '198', 'edit,view,delete'), ('328', '3', '199', 'edit,view,delete'), ('329', '3', '201', 'edit,view,delete'), ('330', '3', '202', 'edit,delete'), ('331', '3', '195', 'edit,view,delete'), ('332', '3', '194', 'edit,view,delete'), ('333', '3', '185', 'edit,view,delete'), ('334', '3', '187', 'edit,view,delete'), ('335', '3', '188', 'edit,view,delete'), ('336', '3', '189', 'edit,view,delete'), ('337', '3', '190', 'edit,view,delete'), ('338', '3', '191', 'edit,view,delete'), ('339', '3', '192', 'edit,view,delete'), ('340', '3', '193', 'edit,view,delete'), ('341', '3', '213', 'edit,view,delete'), ('342', '3', '214', 'edit,view,delete'), ('343', '3', '215', 'edit,view,delete'), ('344', '3', '216', 'edit,view,delete'), ('345', '3', '217', 'edit,view,delete'), ('346', '3', '218', 'edit,view,delete'), ('347', '3', '219', 'edit,view,delete'), ('348', '3', '211', 'edit,view,delete'), ('349', '3', '210', 'edit,view,delete'), ('350', '3', '209', 'edit,view,delete'), ('351', '3', '208', 'edit,view,delete'), ('352', '3', '207', 'edit,view,delete'), ('353', '3', '206', 'edit,view,delete'), ('354', '3', '205', 'edit,view,delete'), ('355', '3', '203', 'edit,view,delete'), ('356', '4', '108', 'edit,view'), ('357', '4', '119', 'edit,view'), ('358', '4', '109', 'edit,view'), ('359', '4', '111', 'edit,view'), ('360', '4', '112', 'view'), ('361', '4', '110', 'edit,view'), ('362', '4', '113', 'view'), ('363', '4', '115', 'edit,view'), ('364', '4', '116', 'edit,view'), ('365', '4', '118', 'edit,view'), ('366', '4', '120', 'view'), ('367', '4', '121', 'edit,view'), ('368', '4', '69', 'view'), ('369', '4', '57', 'view'), ('370', '4', '64', 'view'), ('371', '4', '67', 'edit,view'), ('372', '4', '68', 'edit,view'), ('373', '4', '59', 'edit,view,delete'), ('374', '4', '58', 'edit,view,delete'), ('375', '4', '60', 'edit,view,delete'), ('376', '4', '66', 'edit,view'), ('377', '4', '70', 'edit,view,delete'), ('378', '4', '72', 'edit,view,delete'), ('379', '4', '77', 'edit,view'), ('380', '4', '74', 'edit,view,delete'), ('381', '4', '71', 'edit,view,delete'), ('382', '4', '79', 'edit,view'), ('383', '4', '78', 'edit,view'), ('384', '4', '75', 'edit,view'), ('385', '4', '73', 'edit,view,delete'), ('386', '4', '83', 'edit,view,delete'), ('387', '4', '87', 'edit,view'), ('388', '4', '84', 'edit,view,delete'), ('389', '4', '80', 'edit,view,delete'), ('390', '4', '81', 'edit,view,delete'), ('391', '4', '82', 'edit,view,delete'), ('392', '4', '88', 'edit,view,delete'), ('393', '4', '86', 'edit,view'), ('394', '4', '94', 'view'), ('395', '4', '89', 'view'), ('396', '4', '137', 'view'), ('397', '4', '136', 'edit,view'), ('398', '4', '135', 'edit,view'), ('399', '4', '134', 'edit,view'), ('400', '4', '131', 'edit,view,delete'), ('401', '4', '130', 'edit,view,delete'), ('402', '4', '129', 'edit,view,delete'), ('403', '4', '128', 'edit,view'), ('404', '4', '144', 'edit,view'), ('405', '4', '145', 'edit,view'), ('406', '4', '146', 'view'), ('407', '4', '220', 'edit,view'), ('408', '4', '142', 'edit,view'), ('409', '4', '141', 'edit,view,delete'), ('410', '4', '140', 'edit,view,delete'), ('411', '4', '139', 'edit,view,delete'), ('412', '4', '138', 'edit,view,delete'), ('413', '4', '155', 'view'), ('414', '4', '154', 'edit,view'), ('415', '4', '153', 'edit,view'), ('416', '4', '151', 'edit,view'), ('417', '4', '150', 'edit,view,delete'), ('418', '4', '149', 'edit,view,delete'), ('419', '4', '148', 'edit,view,delete'), ('420', '4', '147', 'edit,view,delete'), ('421', '4', '165', 'edit,view,delete'), ('422', '4', '164', 'edit,view,delete'), ('423', '4', '163', 'edit,view,delete'), ('424', '4', '162', 'edit,view'), ('425', '4', '161', 'edit,view'), ('426', '4', '160', 'edit,view'), ('427', '4', '159', 'edit,view'), ('428', '4', '158', 'view'), ('429', '4', '157', 'view'), ('430', '4', '156', 'edit,view,delete'), ('431', '4', '174', 'edit,view,delete'), ('432', '4', '173', 'edit,view'), ('433', '4', '172', 'edit,view'), ('434', '4', '171', 'edit,view,delete'), ('435', '4', '170', 'edit,view,delete'), ('436', '4', '169', 'edit,view,delete'), ('437', '4', '168', 'edit,view,delete'), ('438', '4', '167', 'edit,view,delete'), ('439', '4', '166', 'edit,view,delete'), ('440', '4', '182', 'edit,view,delete'), ('441', '4', '183', 'edit,view,delete'), ('442', '4', '184', 'edit,view,delete'), ('443', '4', '178', 'edit,view'), ('444', '4', '181', 'edit,view'), ('445', '4', '180', 'edit,view'), ('446', '4', '179', 'edit,view'), ('447', '4', '177', 'edit,view'), ('448', '4', '176', 'edit,view,delete'), ('449', '4', '175', 'edit,view,delete'), ('450', '4', '196', 'edit,view,delete'), ('451', '4', '197', 'edit,view,delete'), ('452', '4', '198', 'edit,view,delete'), ('453', '4', '199', 'edit,view,delete'), ('454', '4', '201', 'edit,view,delete'), ('455', '4', '202', 'edit,delete'), ('456', '4', '195', 'edit,view,delete'), ('457', '4', '194', 'edit,view,delete'), ('458', '4', '185', 'edit,view,delete'), ('459', '4', '187', 'edit,view,delete'), ('460', '4', '188', 'edit,view,delete'), ('461', '4', '189', 'edit,view,delete'), ('462', '4', '190', 'edit,view,delete'), ('463', '4', '191', 'edit,view,delete'), ('464', '4', '192', 'edit,view,delete'), ('465', '4', '193', 'edit,view,delete'), ('466', '4', '213', 'edit,view,delete'), ('467', '4', '214', 'edit,view,delete'), ('468', '4', '215', 'edit,view,delete'), ('469', '4', '216', 'edit,view,delete'), ('470', '4', '217', 'edit,view,delete'), ('471', '4', '218', 'edit,view,delete'), ('472', '4', '219', 'edit,view,delete'), ('473', '4', '211', 'edit,view,delete'), ('474', '4', '210', 'edit,view,delete'), ('475', '4', '209', 'edit,view,delete'), ('476', '4', '208', 'edit,view,delete'), ('477', '4', '207', 'edit,view,delete'), ('478', '4', '206', 'edit,view,delete'), ('479', '4', '205', 'edit,view,delete'), ('480', '4', '203', 'edit,view,delete'), ('481', '5', '108', 'edit,view,delete'), ('482', '5', '119', 'edit,view'), ('483', '5', '109', 'edit,view,delete'), ('484', '5', '111', 'edit,view,delete'), ('485', '5', '112', 'edit,view,delete'), ('486', '5', '110', 'edit,view,delete'), ('487', '5', '113', 'edit,view'), ('488', '5', '114', 'edit,view'), ('489', '5', '115', 'edit,view'), ('490', '5', '116', 'edit,view'), ('491', '5', '117', 'edit,view,delete'), ('492', '5', '118', 'edit,view'), ('493', '5', '120', 'edit,view'), ('494', '5', '121', 'edit,view,delete'), ('495', '5', '69', 'edit,view'), ('496', '5', '57', 'edit,view,delete'), ('497', '5', '65', 'edit,view,delete'), ('498', '5', '64', 'edit,view'), ('499', '5', '67', 'edit,view'), ('500', '5', '68', 'edit,view'), ('501', '5', '59', 'edit,view,delete'), ('502', '5', '58', 'edit,view,delete'), ('503', '5', '60', 'edit,view,delete'), ('504', '5', '66', 'edit,view'), ('505', '5', '70', 'edit,view,delete'), ('506', '5', '72', 'edit,view,delete'), ('507', '5', '77', 'edit,view'), ('508', '5', '74', 'edit,view,delete'), ('509', '5', '76', 'edit,view,delete'), ('510', '5', '71', 'edit,view,delete'), ('511', '5', '79', 'edit,view'), ('512', '5', '78', 'edit,view'), ('513', '5', '75', 'edit,view'), ('514', '5', '73', 'edit,view,delete'), ('515', '5', '83', 'edit,view,delete'), ('516', '5', '87', 'edit,view'), ('517', '5', '84', 'edit,view,delete'), ('518', '5', '80', 'edit,view,delete'), ('519', '5', '81', 'edit,view,delete'), ('520', '5', '82', 'edit,view,delete'), ('521', '5', '88', 'edit,view,delete'), ('522', '5', '86', 'edit,view'), ('523', '5', '85', 'edit,view,delete'), ('524', '5', '94', 'view'), ('525', '5', '89', 'view'), ('526', '5', '91', 'view'), ('527', '5', '92', 'view'), ('528', '5', '93', 'view'), ('529', '5', '137', 'edit,view'), ('530', '5', '136', 'edit,view'), ('531', '5', '135', 'edit,view'), ('532', '5', '134', 'edit,view'), ('533', '5', '133', 'edit,view,delete'), ('534', '5', '132', 'edit,view'), ('535', '5', '131', 'edit,view,delete'), ('536', '5', '130', 'edit,view,delete'), ('537', '5', '129', 'edit,view,delete'), ('538', '5', '128', 'edit,view,delete'), ('539', '5', '144', 'edit,view'), ('540', '5', '145', 'edit,view'), ('541', '5', '146', 'edit,view'), ('542', '5', '220', 'edit,view'), ('543', '5', '143', 'edit,view,delete'), ('544', '5', '142', 'edit,view'), ('545', '5', '141', 'edit,view,delete'), ('546', '5', '140', 'edit,view,delete'), ('547', '5', '139', 'edit,view,delete'), ('548', '5', '138', 'edit,view,delete'), ('549', '5', '155', 'edit,view'), ('550', '5', '154', 'edit,view'), ('551', '5', '153', 'edit,view'), ('552', '5', '152', 'edit,view,delete'), ('553', '5', '151', 'edit,view'), ('554', '5', '150', 'edit,view,delete'), ('555', '5', '149', 'edit,view,delete'), ('556', '5', '148', 'edit,view,delete'), ('557', '5', '147', 'edit,view,delete'), ('558', '5', '165', 'edit,view,delete'), ('559', '5', '164', 'edit,view,delete'), ('560', '5', '163', 'edit,view,delete'), ('561', '5', '162', 'edit,view'), ('562', '5', '161', 'edit,view'), ('563', '5', '160', 'edit,view'), ('564', '5', '159', 'edit,view'), ('565', '5', '158', 'edit,view'), ('566', '5', '157', 'edit,view,delete'), ('567', '5', '156', 'edit,view,delete'), ('568', '5', '174', 'edit,view,delete'), ('569', '5', '173', 'edit,view'), ('570', '5', '172', 'edit,view'), ('571', '5', '171', 'edit,view,delete'), ('572', '5', '170', 'edit,view,delete'), ('573', '5', '169', 'edit,view,delete'), ('574', '5', '168', 'edit,view,delete'), ('575', '5', '167', 'edit,view,delete'), ('576', '5', '166', 'edit,view,delete'), ('577', '5', '182', 'edit,view,delete'), ('578', '5', '183', 'edit,view,delete'), ('579', '5', '184', 'edit,view,delete'), ('580', '5', '178', 'edit,view'), ('581', '5', '181', 'edit,view'), ('582', '5', '180', 'edit,view'), ('583', '5', '179', 'edit,view'), ('584', '5', '177', 'edit,view'), ('585', '5', '176', 'edit,view,delete'), ('586', '5', '175', 'edit,view,delete'), ('587', '5', '196', 'edit,view,delete'), ('588', '5', '197', 'edit,view,delete'), ('589', '5', '198', 'edit,view,delete'), ('590', '5', '199', 'edit,view,delete'), ('591', '5', '201', 'edit,view,delete'), ('592', '5', '202', 'edit,delete'), ('593', '5', '195', 'edit,view,delete'), ('594', '5', '194', 'edit,view,delete'), ('595', '5', '185', 'edit,view,delete'), ('596', '5', '187', 'edit,view,delete'), ('597', '5', '188', 'edit,view,delete'), ('598', '5', '189', 'edit,view,delete'), ('599', '5', '190', 'edit,view,delete'), ('600', '5', '191', 'edit,view,delete'), ('601', '5', '192', 'edit,view,delete'), ('602', '5', '193', 'edit,view,delete'), ('603', '5', '213', 'edit,view,delete'), ('604', '5', '214', 'edit,view,delete'), ('605', '5', '215', 'edit,view,delete'), ('606', '5', '216', 'edit,view,delete'), ('607', '5', '217', 'edit,view,delete'), ('608', '5', '218', 'edit,view,delete'), ('609', '5', '219', 'edit,view,delete'), ('610', '5', '211', 'edit,view,delete'), ('611', '5', '210', 'edit,view,delete'), ('612', '5', '209', 'edit,view,delete'), ('613', '5', '208', 'edit,view,delete'), ('614', '5', '207', 'edit,view,delete'), ('615', '5', '206', 'edit,view,delete'), ('616', '5', '205', 'edit,view,delete'), ('617', '5', '203', 'edit,view,delete');"
  );

  return $sql;
}

//Added timezone to service event not needed as it was allready there in version 4 so reverting back
/* function ucroo_upgrade_26()
  {

  $sql = array(
  "ALTER TABLE service_event ADD timezone varchar(75) COLLATE 'utf8_general_ci' NULL AFTER location, COMMENT='';"
  );

  return $sql;
  } */

function ucroo_upgrade_27() {

  $sql = array(
      "INSERT INTO `campus` VALUES ('284','13','Other Site' ,'','2014-02-11 00:00:00','','')",
      "INSERT INTO `campus` VALUES ('285','13','Beechworth' ,'','2014-02-11 00:00:00','','')",
      "INSERT INTO `campus` VALUES ('286','13','Online'     ,'','2014-02-11 00:00:00','','')",
      "INSERT INTO `campus` VALUES ('287','13','City Campus (Collins St)'     ,'','2014-02-11 00:00:00','','')",
      "INSERT INTO `campus` VALUES ('288','13','City Campus (Franklin St)'    ,'','2014-02-11 00:00:00','','')",
  );

  return $sql;
}

/* Nirav(13-02-2014) - Change the datatype of office location from varchar to text */

function ucroo_upgrade_28() {

  $sql = array(
      "ALTER TABLE `service_pages` CHANGE COLUMN `office_location` `office_location` TEXT NULL DEFAULT NULL"
  );

  return $sql;
}

///*Prevent duplicate entry in year table*/
//function ucroo_upgrade_29()
//{
//
//  $sql = array(
//  "ALTER TABLE `year` ADD UNIQUE INDEX `uni_id_year_name` (`uni_id`, `year`, `name`);"
//      );
//
//  return $sql;
//}
//
///*reverting back the above upgrade_29*/
//function ucroo_upgrade_30()
//{
//
//  $sql = array(
//  "ALTER TABLE `year` DROP INDEX `uni_id_year_name`;"
//      );
//
//  return $sql;
//}
//adding internation field to user
//adding permissions as well
function ucroo_upgrade_31() {

  $sql = array(
      "ALTER TABLE `permissions` CHANGE COLUMN `action` `action` enum('post','question','link','pin','endorse','admin','notification','activity','email','like','subscribe','report','file','poll','tag','vote','numposts','position','course','start','finish','faculty','degree','classes','connections','extracurr','timetable','status','create','international') NOT NULL;",
      "INSERT INTO `permissions` (`object` ,`action` ,`modes` ,`default` ,`is_group`) VALUES ('signup', 'international', 'view', NULL , '1');",
      "SET @v1 := (SELECT MAX(id) from permissions);",
      "insert into user_groups_permissions (`user_group_id` ,`permission_id` ,`modes`) VALUES ( 2 , @v1 , 'view');",
      "ALTER TABLE `users` ADD COLUMN `international` int(1) AFTER `finished`, CHANGE COLUMN `prefered_email` `prefered_email` varchar(255) DEFAULT NULL AFTER `international`, CHANGE COLUMN `fb_publish_stream_request` `fb_publish_stream_request` tinyint(4) DEFAULT '0' AFTER `prefered_email`, CHANGE COLUMN `auth_token_mobile` `auth_token_mobile` varchar(255) DEFAULT NULL AFTER `fb_publish_stream_request`, CHANGE COLUMN `date_created` `date_created` datetime NOT NULL AFTER `auth_token_mobile`, CHANGE COLUMN `date_modified` `date_modified` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER `date_created`;"
  );

  return $sql;
}

//Adding campus id to service events
function ucroo_upgrade_32() {

  $sql = array(
      "ALTER TABLE `service_event` ADD COLUMN `campus_id` DOUBLE NOT NULL AFTER `max_attendees`;"
  );

  return $sql;
}

//Adding APO targeted to international students or not post_is_international
function ucroo_upgrade_33() {

  $sql = array(
      "ALTER TABLE feed_posts ADD COLUMN post_is_international TINYINT NULL AFTER post_campus_id;"
  );

  return $sql;
}

//Adding non ucroo member inviting feature in classes.
function ucroo_upgrade_34() {

  $sql = array(
      "ALTER TABLE unit_enrolment_current ADD non_ucroo_id INT NULL DEFAULT '0' AFTER user_id;",
      "ALTER TABLE unit_enrolment_current CHANGE user_id user_id INT( 11 ) NULL DEFAULT '0';"
  );

  return $sql;
}

//Creating table for mail queueing porpose
function ucroo_upgrade_39() {
  $sql = array(
      "DROP TABLE IF EXISTS mail_queue;",
      "CREATE TABLE IF NOT EXISTS `mail_queue` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `subject` varchar(245) NOT NULL,
      `html` varchar(254) NOT NULL,
      `to` varchar(254) NOT NULL,
      `from` varchar(254) NOT NULL,
      `queued` tinyint(4) NOT NULL DEFAULT '1',
      `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `created` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;"
  );
  return $sql;
}

//field type change for mail queue table.
function ucroo_upgrade_40() {
  $sql = array(
      "ALTER TABLE `mail_queue` CHANGE `html` `html` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;"
  );
  return $sql;
}

//Change the wrong timezone associated with Muldura Campus
function ucroo_upgrade_41() {
  $sql = array(
      "UPDATE `campus` SET `id` = '131', `uni_id` = '13', `name` = 'Mildura', `timezone_php` = 'Australia/Sydney', `date_created` = '2012-12-12 13:11:33', `date_modified` = now(), `live_id` = '' WHERE `id` = '131';"
  );
  return $sql;
}

//Change the blank faculty id for this particular course
function ucroo_upgrade_42() {
  $sql = array(
      "UPDATE `course` SET `id` = '4260', `name` = 'Bachelor of Business (Accountancy)', `uni_id` = '17', `faculty_id` = '315', `faculty_id2` = NULL, `date_created` = '2013-02-11 12:14:16', `date_modified` = now(), `course_code` = '', `live_id` = '' WHERE `id` = '4260';"
  );
  return $sql;
}

//Adding field for campus in dropin time.
function ucroo_upgrade_43() {
  $sql = array(
      "ALTER TABLE service_dropin_details ADD COLUMN campus_id INT(11) NULL AFTER service_page_id;"
  );
  return $sql;
}

//Removing wrong foreign key relation for service page events.
function ucroo_upgrade_44() {
  $sql = array(
      "ALTER TABLE `service_event_member` DROP FOREIGN KEY `FK_service_event_member_event`;"
  );
  return $sql;
}

function ucroo_upgrade_45() {
  $sql = array(
      "CREATE TABLE `ucroo_email_notification` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `sent_5` DATETIME NULL DEFAULT NULL,
  `sent_10` DATETIME NULL DEFAULT NULL,
  `sent_15` DATETIME NULL DEFAULT NULL,
  `sent_20` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
COLLATE='utf8_czech_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;"
  );
  return $sql;
}

function ucroo_upgrade_46() {
  $sql = array(
      "CREATE TABLE `study_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `uni_id` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `date` varchar(50) NOT NULL,
  `total_minutes` int(11) DEFAULT '0',
  `status` enum('A','M') NOT NULL DEFAULT 'A' COMMENT 'A-Automated,M-Manual',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
  );

  return $sql;
}

/**
 * to make blocked column to zero as now ignore connection means blocked .so they cant see same request again.
 */
function ucroo_upgrade_47() {
  $sql = array(
      "update connection set blocked =0;"
  );

  return $sql;
}

/**
 * to add new points entry for Add group and invite a group.
 */
function ucroo_upgrade_48() {
  $sql = array(
      "INSERT INTO points_karma_types (`description`, `points`, `date_created`, `date_modified`) VALUES ('Add Group', 10, '2014-04-17 11:07:50', '2012-07-12 11:07:50');",
      "INSERT INTO points_karma_types (`description`, `points`, `date_created`, `date_modified`) VALUES ('Invite to a Group', 1, '2014-04-17 11:07:50', '2012-07-12 11:07:50');"
  );

  return $sql;
}

function ucroo_upgrade_49() {
  $sql = array(
      "INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES ('university', 'vote', 'view,edit',  NULL, 1);"
  );

  return $sql;
}

function ucroo_upgrade_50() {
  $sql = array(
      "ALTER TABLE `users` ADD `ios_apn_token` varchar(64) COLLATE 'utf8_general_ci' NULL AFTER `auth_token_mobile`, COMMENT='';"
  );

  return $sql;
}

function ucroo_upgrade_51() {
  $sql = array(
      "ALTER TABLE `mail_queue`
  ADD `cron_type_id` int(11) NOT NULL AFTER `id`,
  COMMENT='';",
      "ALTER TABLE `mail_queue`
ADD `extra_entity` varchar(100) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `from`,
COMMENT='';",
      "ALTER TABLE `mail_queue`
ADD `user_to_id` int NULL AFTER `html`,
COMMENT='';",
      "CREATE TABLE `cron_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cron_type` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;",
      "INSERT INTO `cron_type` (`id`, `cron_type`, `created`) VALUES
    (1, 'remove_junk_notification', '2014-05-13 15:23:02');
  ",
      "CREATE TABLE `cron_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_id` int(11) NOT NULL,
  `cron_type_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  "
  );

  return $sql;
}

function ucroo_upgrade_52() {
  $sql = array(
      "CREATE TABLE `mail_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cron_type_id` int(11) NOT NULL,
  `subject` varchar(245) NOT NULL,
  `html` text NOT NULL,
  `user_to_id` int(11) NOT NULL,
  `to` varchar(254) NOT NULL,
  `extra_entity` varchar(100) NOT NULL,
  `queued` enum('0','1') NOT NULL COMMENT '0-Queued , 1- Processed',
  `opened` enum('0','1') NOT NULL COMMENT '0-Not Opened, 1 - Opened',
  `clicked` enum('0','1') NOT NULL COMMENT '0- Not Clicked, 1 Clicked',
  `deleted` enum('0','1') NOT NULL COMMENT '0 - Not Deleted, 1 Deleted',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
",
      "ALTER TABLE `mail_queue`
DROP `queued`,
DROP `sent`,
COMMENT='';",
      "ALTER TABLE users ADD COLUMN is_signed_flg TINYINT NOT NULL DEFAULT '0' AFTER date_modified;",
      "INSERT INTO `cron_type` (`cron_type`, `created`)
VALUES ('import_unit_members', now());",
      "INSERT INTO `cron_type` (`cron_type`, `created`)
VALUES ('import_Customgroups_member', now());",
      "INSERT INTO `cron_type` (`cron_type`, `created`)
VALUES ('import_Service_students', now());",
      "INSERT INTO `cron_type` (`cron_type`, `created`)
VALUES ('send_unread_notifications_email', now());",
      "INSERT INTO `cron_type` (`cron_type`, `created`)
VALUES ('email_notification_not_signedin', now());",
      "INSERT INTO `cron_type` (`cron_type`, `created`)
VALUES ('email_student_not_added_class', now());",
      "INSERT INTO `cron_type` (`cron_type`, `created`)
VALUES ('email_connection_awaiting', now());",
      "INSERT INTO `cron_type` (`cron_type`, `created`)
VALUES ('user_complete_profile', now());",
      "ALTER TABLE `mail_queue`
CHANGE `extra_entity` `extra_entity` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `from`,
COMMENT='';"
  );

  return $sql;
}

function ucroo_upgrade_53() {
  $sql = array(
      "INSERT INTO `cron_type` (`cron_type`, `created`) VALUES ('inactive_fb_users_email', now());"
  );

  return $sql;
}

function ucroo_upgrade_54() {
  $sql = array("INSERT INTO `cron_type` (`cron_type`, `created`) VALUES ('fb_ucroo_connection_suggestion', now());");
  return $sql;
}

function ucroo_upgrade_55() {
  $sql = array("CREATE TABLE ucroo_fb_friends (
              id INT(11) NOT NULL AUTO_INCREMENT,
              user_id INT(11) NOT NULL DEFAULT '0',
              fb_friend_id BIGINT(20) NOT NULL DEFAULT '0',
              PRIMARY KEY (id),
              INDEX FK_ucroo_fb_friends_users (user_id),
              CONSTRAINT FK_ucroo_fb_friends_users FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE
             )
             COMMENT='Facebook friends details'
             COLLATE='latin1_swedish_ci'
             ENGINE=InnoDB;");
  return $sql;
}

function ucroo_upgrade_56() {
  $sql = array("ALTER TABLE `mail_log` CHANGE COLUMN `to` `to` VARCHAR(64) NOT NULL AFTER `user_to_id`;",
      "ALTER TABLE `cron_type` ENGINE=InnoDB;",
      "ALTER TABLE `cron_log` ENGINE=InnoDB;",
      "ALTER TABLE `mail_log` ENGINE=InnoDB;"
  );
  return $sql;
}

function ucroo_upgrade_57() {
  $sql = array("ALTER TABLE `mail_queue` ADD `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0- Success , 1 Failed';");
  return $sql;
}

function ucroo_upgrade_58() {
  $sql = array("ALTER TABLE `mail_log` ADD COLUMN `mailgun_msg_id` VARCHAR(64) NOT NULL AFTER `opened`;");
  return $sql;
}

function ucroo_upgrade_59() {
  $sql = array("ALTER TABLE `users` ADD COLUMN `android_gcm` VARCHAR(64) NULL DEFAULT NULL AFTER `ios_apn_token`;");
  return $sql;
}

function ucroo_upgrade_60() {
  $sql = array("ALTER TABLE `connection` ADD COLUMN `is_conawaiting_flg` BIT NULL DEFAULT b'0' AFTER `banned`;");
  return $sql;
}

function ucroo_upgrade_61() {
  $sql = array("ALTER TABLE `permissions` CHANGE COLUMN `object` `object` ENUM('feed','services','unit','club','study_group',
                'club_committee','signup','account','year','university','faculty','service_page','service_staff','customgroups',
                'mentors','university_staff','marketplace') NOT NULL;",

                "INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES
                ('marketplace', 'admin',  'view,edit,delete', NULL, 1),
                ('marketplace', 'post', 'view,edit,delete', NULL, 1),
                ('marketplace', 'numposts', 'view,edit',  NULL, 1),
                ('marketplace', 'email',  'view,edit',  NULL, 1),
                ('marketplace', 'notification', 'view,edit',  NULL, 1),
                ('marketplace', 'file', 'view,edit,delete', NULL, 1);",

                "ALTER TABLE `feed_posts` CHANGE COLUMN `feed_object` `feed_object` ENUM('club','faculty','university','unit',
                'study_group','club_committee','year','service_page','service_staff','final_year','customgroups','mentors',
                'university_staff','marketplace') NOT NULL AFTER `id`;",

                "CREATE TABLE `ucroo_category` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `category_name` VARCHAR(50) NOT NULL COLLATE 'utf8_czech_ci',
                `module_name` VARCHAR(50) NOT NULL COLLATE 'utf8_czech_ci',
                PRIMARY KEY (`id`)) COMMENT='Generalized category table' COLLATE='utf8_czech_ci' ENGINE=InnoDB;",

                "CREATE TABLE `marketplace` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `category_id` INT(11) NULL DEFAULT NULL,
                `user_id` INT(11) NOT NULL,
                `item_name` VARCHAR(50) NOT NULL COLLATE 'utf8_czech_ci',
                `description` TEXT NOT NULL COLLATE 'utf8_czech_ci',
                `image_name` VARCHAR(25) NULL DEFAULT NULL COLLATE 'utf8_czech_ci',
                `price` DECIMAL(10,2) NOT NULL,
                `status` TINYINT(4) NOT NULL,
                `date_created` DATETIME NOT NULL,
                `date_updated` DATETIME NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                INDEX `FK_marketplace_users` (`user_id`),
                CONSTRAINT `FK_marketplace_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                ) COMMENT='Marketplace Feature' COLLATE='utf8_czech_ci' ENGINE=InnoDB;");
  return $sql;
}

function ucroo_upgrade_62() {
  $sql = array("ALTER TABLE `email_notification_block` ADD UNIQUE INDEX `user_id_type` (`user_id`, `type`);");
  return $sql;
}

function ucroo_upgrade_63() {
  $sql = array("ALTER TABLE `marketplace` CHANGE COLUMN `date_updated` `date_updated` TIMESTAMP NOT NULL AFTER `date_created`;",
                "ALTER TABLE `marketplace` CHANGE COLUMN `image_name` `image_name` VARCHAR(50) NULL DEFAULT NULL
                COLLATE 'utf8_czech_ci' AFTER `description`;");
  return $sql;
}

function ucroo_upgrade_64() {
  $sql = array("ALTER TABLE `feed_posts`
                ADD COLUMN `post_uni_id` INT(11) NULL AFTER `user_id`,
                ADD CONSTRAINT `FK_feed_posts_university` FOREIGN KEY (`post_uni_id`) REFERENCES `university` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;",
                "INSERT INTO `ucroo_category` (`category_name`, `module_name`) VALUES
                ('Accomodation',  'marketplace'),
                ('Books', 'marketplace'),
                ('Cars & Bikes',  'marketplace'),
                ('General Items', 'marketplace'),
                ('Household Items', 'marketplace'),
                ('Lost & Found',  'marketplace'),
                ('Technology',  'marketplace');");
  return $sql;
}

function ucroo_upgrade_65() {
  $sql = array("ALTER TABLE feed_posts CHANGE COLUMN `type` `type` ENUM('question','post','link','file','poll','event','selling_item')
                NULL DEFAULT NULL AFTER `user_id`;");
   return $sql;
}

function ucroo_upgrade_66() {
  $sql = array("ALTER TABLE `marketplace` ADD COLUMN `feed_post_id` INT(11) NOT NULL AFTER `user_id`;");
   return $sql;
}

function ucroo_upgrade_67() {
  $sql = array(" ALTER TABLE `marketplace` CHANGE COLUMN `feed_post_id` `feed_post_id` INT(11) NULL AFTER `user_id`;");
   return $sql;
}

function ucroo_upgrade_68() {
  $sql = array("ALTER TABLE `mail_log`  CHANGE COLUMN `extra_entity` `extra_entity` VARCHAR(100) NULL AFTER `to`;");
   return $sql;
}

function ucroo_upgrade_69() {
  $sql = array("INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES ('marketplace', 'report', 'view,edit,delete', NULL, 1);");
   return $sql;
}

function ucroo_upgrade_70() {
  $sql = array("ALTER TABLE `mail_queue` CHANGE COLUMN `status` `status` ENUM('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0- Success , 1 Processed , 2 FAILD , 3 SUCCESS' AFTER `extra_entity`;");
   return $sql;
}

function ucroo_upgrade_71() {
  $sql = array("INSERT INTO `cron_type` (`cron_type`, `created`) VALUES ('marketplace_item_post', NOW());");
   return $sql;
}

function ucroo_upgrade_72() {
  $sql = array("ALTER TABLE monitor_keywords ADD COLUMN `unit_id` INT(11) NULL AFTER `non_ucroo_id`;");
   return $sql;
}

function ucroo_upgrade_73() {
  $sql = array("ALTER TABLE users CHANGE COLUMN `android_gcm` `android_gcm` VARCHAR(255) CHARSET utf8 COLLATE utf8_general_ci NULL;");
   return $sql;
}

function ucroo_upgrade_74() {
  $sql = array("UPDATE university SET name='CQUniversity' WHERE `id`='4';");
   return $sql;
}

function ucroo_upgrade_75() {
  $sql = array("ALTER TABLE `service_event` CHANGE COLUMN `campus_id` `campus_id` DOUBLE NULL AFTER `max_attendees`;");
   return $sql;
}

function ucroo_upgrade_76() {
  $sql = array("UPDATE `points_incentive` SET `description` = 'Add a class' WHERE `id` = '4'");
  return $sql;
}

function ucroo_upgrade_77() {
  $sql = array("ALTER TABLE `unit_info_data` ADD COLUMN `added_user_id` INT(11) NOT NULL AFTER `uni_id`, ADD COLUMN `added_user_type` VARCHAR(25) NOT NULL AFTER `added_user_id`;");
  return $sql;
}

function ucroo_upgrade_78() {
  $sql = array("ALTER TABLE `club` ADD COLUMN `is_marked_for_member_fields` CHAR(1) NULL DEFAULT 'n' AFTER `finished`;");
  return $sql;
}

/*Removing unwanted ACL entries for marketplace*/
function ucroo_upgrade_79() {
  $sql = array("DELETE FROM `permissions` WHERE `object` = 'marketplace' AND ((`action` = 'post') OR (`action` = 'file') OR (`action` = 'numposts'));");
  return $sql;
}

function ucroo_upgrade_80() {
  $sql = array("ALTER TABLE `feedback` ADD COLUMN `user_id` INT(11) NULL DEFAULT NULL AFTER `id`;");
  return $sql;
}

function ucroo_upgrade_81() {
  $sql = array("INSERT INTO `cron_type` (`cron_type`, `created`) VALUES ('add_Customgroup_users', now());");
  return $sql;
}

function ucroo_upgrade_82() {
  $sql = array("UPDATE `university` SET `name` = 'Federation University Australia' WHERE `id` = '22';");
  return $sql;
}

function ucroo_upgrade_83() {
  $sql = array("INSERT INTO cron_type (`cron_type`, `created`) VALUES ('club_join_welcome_email', now());");
  return $sql;
}

function ucroo_upgrade_84() {
  $sql = array("CREATE TABLE `mailchimp_unsubscribed_list` (
  `unsubscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`unsubscribe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
  return $sql;
}

function ucroo_upgrade_85() {
  $sql = array("ALTER TABLE `club_members` ADD COLUMN `registration_type` VARCHAR(25) NULL DEFAULT NULL AFTER `payment_type`;");
  return $sql;
}

function ucroo_upgrade_86() {
  $sql = array("CREATE TABLE `user_blocked` (
               `id` INT(11) NOT NULL,
               `user_id` INT(11) NULL DEFAULT NULL,
               `block_user_id` INT(11) NULL DEFAULT NULL,
               PRIMARY KEY (`id`),
               INDEX `FK_user_blocked_users` (`user_id`),
               CONSTRAINT `FK_user_blocked_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
              )
              COLLATE='latin1_swedish_ci'
              ENGINE=InnoDB;",
              "ALTER TABLE `user_blocked` CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT FIRST;");

  return $sql;
}


function ucroo_upgrade_87() {
  $sql = array("ALTER TABLE `ucroo_event` ADD COLUMN `target_year` CHAR(10) NULL AFTER `end_date`;");
  return $sql;
}

function ucroo_upgrade_88() {
  $sql = array("ALTER TABLE `feed_posts` ADD COLUMN `post_year` TINYINT NULL DEFAULT NULL AFTER `post_uni_id`;");
  return $sql;
}

function ucroo_upgrade_89() {
   $sql = array(
          "ALTER TABLE `permissions` CHANGE COLUMN `action` `action` ENUM
          ('post','question','link','pin','endorse','admin','notification','activity','email','like','subscribe','report','file','poll','tag',
          'vote','numposts','position','course','start','finish','faculty','degree','classes','connections','extracurr','timetable',
          'status','create','international','studygroups','customgroups','mentorgroups') NOT NULL;",
          "INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES ('account',  'customgroups', 'connections,everyone', 'everyone', 0);",
          "INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES ('account',  'mentorgroups', 'connections,everyone', 'everyone', 0);",
          "INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES ('account',  'studygroups',  'connections,everyone', 'everyone', 0);");
   return $sql;
}

function ucroo_upgrade_90() {
   $sql = array(
    "ALTER TABLE `permissions` CHANGE COLUMN `action` `action` ENUM('post','question','link','pin','endorse','admin','notification','activity','email','like','subscribe','report','file','poll','tag','vote','numposts','position','course','start','finish','faculty','degree','classes','connections','extracurr','timetable','status','create','international','profilesearchable','studygroups','customgroups','mentorgroups') NOT NULL AFTER `object`;",
    "INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES ('account',  'profilesearchable',  'connections,everyone', 'everyone', 0);"
  );
    return $sql;
}

function ucroo_upgrade_91() {
  $sql = array(
        "INSERT INTO `university` (`name`, `code`, `state`, `short_name`, `aff_token`) VALUES
              ('Prince Patrick University', 'PRINC','Melbourne','Prince Patrick University','Prince Patrick University');",
          "INSERT INTO `campus` (`uni_id`,`name`,`timezone_php`,`date_created`,`date_modified`) VALUES
                ('39','Melbourne','Australia/Melbourne','2014-08-25 10:56:44','2014-08-25 10:56:50'),
                ('39','Ahmedabad','India','2014-08-25 10:56:44','2014-08-25 10:56:50');",
          "INSERT INTO `faculty` (`name`,`uni_id`,`date_created`,`date_modified`) VALUES
                ('Faculty of Information Technology','39','2014-08-25 11:04:13','2014-08-25 11:04:17'),
                ('Faculty of Business Studies','39','2014-08-25 11:04:13','2014-08-25 11:04:17') ,
                ('- Not applicable','39','2014-08-25 11:04:13','2014-08-25 11:04:17');",
          "INSERT INTO `unit` (`name`,`code`,`year`,`faculty_id`,`rating1`,`rating2`,`rating3`,`rating4`,`overall_rating`,`search`) VALUES
                ('Information Technology','PRI1101','3','528','0','0','0','0','0','PRI1101 Information Technology'),
                ('Marketing Management','PRI1102','3','528','0','0','0','0','0','PRI1102 Marketing Management'),
                ('Financial Management','PRI1103','3','528','0','0','0','0','0','PRI1103 Financial Management'),
                ('Social Work','PRI1104','3','528','0','0','0','0','0','PRI1104 Social Work'),
                ('Principles of Law','PRI1105','3','528','0','0','0','0','0','PRI1105 Principles of Law'),
                ('Cost Accounting','PRI1106','3','528','0','0','0','0','0','PRI1106 Cost Accounting'),
                ('Human Resources','PRI1107','3','528','0','0','0','0','0','PRI1107 Human Resources');",
        );
  return $sql;
}


function ucroo_upgrade_92() {
  $sql = array("UPDATE points_incentive SET percentage_points=15 WHERE id='3';");
  return $sql;
}

function ucroo_upgrade_93() {
  $sql = array(
    "ALTER TABLE `permissions` CHANGE COLUMN `object` `object` ENUM('feed','services','unit','club','study_group','club_committee','signup','account','year','university','faculty','service_page','service_staff','customgroups','mentors','university_staff','marketplace','university_rss') NOT NULL AFTER `id`;",
    "ALTER TABLE `feed_posts` CHANGE COLUMN `feed_object` `feed_object` ENUM('club','faculty','university','unit','study_group','club_committee','year','service_page','service_staff','final_year','customgroups','mentors','university_staff','marketplace','university_rss') NOT NULL AFTER `id`;",
    "INSERT INTO `permissions` (`id` ,`object` ,`action` ,`modes` ,`default` ,`is_group`) VALUES (NULL , 'university_rss', 'post', 'view,edit,delete', NULL , '1'), (NULL , 'university_rss', 'notification', 'view,edit,delete', NULL , '1'), (NULL , 'university_rss', 'activity', 'view,edit,delete', NULL , '1'), (NULL , 'university_rss', 'email', 'view,edit,delete', NULL , '1'), (NULL , 'university_rss', 'subscribe', 'view,edit,delete', NULL , '1'), (NULL , 'university_rss', 'report', 'view,edit,delete', NULL , '1'), (NULL , 'university_rss', 'vote', 'view,edit,delete', NULL , '1');",
    "CREATE TABLE `university_rss` (`id` INT NOT NULL AUTO_INCREMENT, `uni_id` INT NOT NULL, `name` VARCHAR(75) NOT NULL, PRIMARY KEY (`id`))"
    );
  return $sql;
}

function ucroo_upgrade_94() {
  $sql = array("CREATE TABLE `ucroo_rss_feed` (`id` int(11) NOT NULL AUTO_INCREMENT,`gu_id` varchar(100) NOT NULL,`title` varchar(100) NOT NULL,`content` text NOT NULL,`link` varchar(250) NOT NULL,`media` varchar(250) NOT NULL,`processed` bit(1) NOT NULL,`type` enum('FEED') NOT NULL,`date_created` datetime NOT NULL,`date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`),UNIQUE KEY `gu_id` (`gu_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
  return $sql;
}

function ucroo_upgrade_95() {
  $sql = array("ALTER TABLE `feed_tags` CHANGE COLUMN `feed_object` `feed_object` ENUM('club','faculty','university','unit','study_group','club_committee','university_staff') NOT NULL AFTER `id`;");
  return $sql;
}

function ucroo_upgrade_96() {
  $sql = array("ALTER TABLE `ucroo_rss_feed` CHANGE `gu_id` `gu_id` varchar(250) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `id`, COMMENT='';");
  return $sql;
}
//For ucroo university api
function ucroo_upgrade_97() {
  $sql = array("ALTER TABLE `university` ADD `app_key` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `aff_token`, ADD `secret_key` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `app_key`,COMMENT='';",
              "ALTER TABLE `unit_enrolment_current` ADD UNIQUE `user_id_unit_id` (`user_id`, `unit_id`);"
    );

  return $sql;
}

function ucroo_upgrade_98() {
  $sql = array("ALTER TABLE `users` ADD COLUMN `attempt_fail` TINYINT NULL DEFAULT NULL AFTER `active`, ADD COLUMN `attempt_fail_date` TIMESTAMP NULL DEFAULT NULL AFTER `attempt_fail`;",
              "ALTER TABLE `users` CHANGE COLUMN `attempt_fail` `attempt_fail` TINYINT(4) NULL DEFAULT '0' AFTER `active`;"
    );

  return $sql;
}

// adding LTI key and secret for CQU
function ucroo_upgrade_99() {
  $sql = array("INSERT INTO university_lti (uni_id, lti_key, lti_secret, date_created, date_modified) VALUES (4, 'cqu.edu.au', '547bed1d2ad96', NOW(), NOW())");

  return $sql;
}


function ucroo_upgrade_100() {
  $sql = array("ALTER TABLE `user_feeds`
 CHANGE COLUMN `feed_object` `feed_object` ENUM('club','faculty','university','unit','study_group','year','service_page','service_staff','final_year','university_staff','customgroups') NOT NULL AFTER `user_id`;");

  return $sql;
}


function ucroo_upgrade_101() {
  $sql = array("ALTER TABLE `club` ADD COLUMN `can_student_join` TINYINT(1) NOT NULL DEFAULT '1' AFTER `uni_id`;");

  return $sql;
}

//#3096
function ucroo_upgrade_102() {
  $sql = array("ALTER TABLE `study_log` ADD COLUMN `unit_code` VARCHAR(20) NULL AFTER `uni_id`;");

  return $sql;
}

//#3333
function ucroo_upgrade_103() {
  $sql = array("CREATE TABLE `ucroo_votes` (
 `id` INT(11) NOT NULL AUTO_INCREMENT,
 `post_id` INT(11) NOT NULL DEFAULT '0',
 `user_id` INT(11) NOT NULL DEFAULT '0',
 `type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '1=post,2=answer',
 `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 INDEX `user_id` (`user_id`),
 INDEX `post_id` (`post_id`),
 CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;");

  return $sql;
}

#3443
function ucroo_upgrade_104() {
  $sql = array("INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES (12, 16, 7, NULL, '1');
INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES (14, 16, 7, NULL, '1');
INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES (4, 16, 7, NULL, '1');
INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES (18, 16, 7, NULL, '1');
INSERT INTO `permissions` (`object`, `action`, `modes`, `default`, `is_group`) VALUES (13, 16, 7, NULL, '1');");

  return $sql;
}

//#3149
function ucroo_upgrade_105() {
  $sql = array("UPDATE `points_incentive` SET `description`='Invite a student to UCROO', `action_url`='/invites/'  WHERE `id`='6';");
  return $sql;
}

//#2861
function ucroo_upgrade_106() {
  $sql = array("INSERT INTO `cron_type` (`cron_type`, `created`) VALUES ('email_study_comparison', now());");

  return $sql;
}

//#3420
function ucroo_upgrade_107() {
  $sql = array("update `course` set `name` = REPLACE(name,' and ',' & ') WHERE name REGEXP '[[:<:]]and[[:>:]]';");

  return $sql;
}

//#2880
function ucroo_upgrade_108() {
  $sql = array("CREATE TABLE `ucroo_user_relationship` (
    `entity_type` ENUM('UNIT') NOT NULL,
    `entity_id` INT NOT NULL,
    `user_id_1` INT NOT NULL,
    `user_id_2` INT NULL,
    `flag` TINYINT NOT NULL,
    `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   )
   COMMENT='This table is for user and any other entity table(like unit)'
   COLLATE='latin1_swedish_ci'
   ENGINE=MyISAM
   ;");
  return $sql;
}
//#2880
function ucroo_upgrade_109() {
  $sql = array("ALTER TABLE `ucroo_user_relationship` ADD COLUMN `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);");
  return $sql;
}

//#2880
function ucroo_upgrade_110() {
  $sql = array("INSERT INTO `points_karma_types` (`description`, `points`, `date_created`, `date_modified`) VALUES ('Give Endorseing', '5', NOW(), NOW());
INSERT INTO `points_karma_types` (`description`, `points`,`date_created`,`date_modified`) VALUES ('Recieve Endorseing', '20', NOW(), NOW());
");
  return array();
}


//#3781
function ucroo_upgreade_111() {
  $sql = array(" ALTER TABLE `club`
    ADD COLUMN `membership_status` ENUM('Y','N') NOT NULL DEFAULT 'Y' AFTER `uni_id`,
    ADD COLUMN `membership_payment` ENUM('Y','N') NOT NULL DEFAULT 'Y' AFTER `membership_status`,
    ADD COLUMN `event_ticketing` ENUM('Y','N') NOT NULL DEFAULT 'Y' AFTER `membership_payment`,
    CHANGE COLUMN `can_student_join` `can_student_join` TINYINT(1) ZEROFILL NOT NULL DEFAULT '1' AFTER `event_ticketing`;");

  return $sql;
}

//#3799
function ucroo_upgrade_112() {
  $sql = array("ALTER TABLE `ucroo_user_relationship` CHANGE COLUMN `entity_type` `entity_type` ENUM('UNIT','FOLLOWING_CLUB') NOT NULL FIRST;");

  return $sql;
}

//#2811
function ucroo_upgrade_113() {
  $sql = array("ALTER TABLE `user_meta` ADD COLUMN `module_visited` VARCHAR(250) NULL DEFAULT NULL;");
  return $sql;
}

#2726
function ucroo_upgrade_114() {
  $sql = array("INSERT INTO `cron_type` (`cron_type`, `created`) VALUES ('fb_get_user', now());");

  return $sql;
}

// Nirav
// For Network Ananytics
function ucroo_upgrade_115() {
  $sql = array("CREATE TABLE `userlogin_log` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `login_date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `browser` VARCHAR(100) NOT NULL,
    `ip` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `FK__users_login_log` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
    )
    COLLATE='latin1_swedish_ci'
    ENGINE=InnoDB;");
  return $sql;
}

function ucroo_upgrade_116() {
  $sql = array(
    "ALTER TABLE `feed_posts` ADD COLUMN `comments_count` INT NULL DEFAULT '0' AFTER `comments`;",
    "ALTER TABLE `customgroups` ADD COLUMN `count_views` INT NULL DEFAULT '0' AFTER `slug`, COMMENT='';",
    "ALTER TABLE `service_pages` ADD COLUMN `count_views` INT NULL DEFAULT '0' AFTER `slug`, COMMENT=''",
    "ALTER TABLE `ucroo_mentor` ADD COLUMN `count_views` INT NULL DEFAULT '0' AFTER `status`, COMMENT=''",
    "ALTER TABLE `study_group` ADD COLUMN `count_views` INT NULL DEFAULT '0' AFTER `privacy`, COMMENT=''",
    "ALTER TABLE `user_meta` ADD COLUMN `count_profile_views` INT NULL DEFAULT '0' AFTER `deleted_data`;"
    );
  return $sql;
}
function ucroo_upgrade_117() {
  $sql = array(
    "ALTER TABLE `feed_answers` ADD COLUMN `comments_count` INT NULL DEFAULT '0' AFTER `comments`;"
    );
  return $sql;
}

function ucroo_upgrade_118() {
  $sql = array(
    "ALTER TABLE `userlogin_log` ADD COLUMN `type` VARCHAR(20) NOT NULL AFTER `user_id`;"
    );
  return $sql;
}

function ucroo_upgrade_119() {
  $sql = array(
    "ALTER TABLE `feed_posts` CHANGE COLUMN `type` `type` ENUM('event','file','link','post','poll','question','selling_item') NULL DEFAULT NULL AFTER `user_id`;"
    );
  return $sql;
}

function ucroo_upgrade_120() {
  $sql = array(
    "ALTER TABLE `user_meta` ADD COLUMN `connection_count` INT NULL DEFAULT NULL AFTER `date_modified`;"
    );
  return $sql;
}

//3818, new field for CSU ID
function ucroo_upgrade_121() {
  $sql = array(
    "ALTER TABLE `user_meta` ADD COLUMN `csu_id` INT(11) NULL DEFAULT NULL AFTER `uni_id`;"
    );
  return $sql;
}

//3804, mobile apps version checks
function ucroo_upgrade_122() {
  $sql = array(
    "ALTER TABLE `user_meta`
    ADD COLUMN `iphone_version` VARCHAR(50) NULL DEFAULT NULL AFTER `phone`,
    ADD COLUMN `android_version` VARCHAR(50) NULL DEFAULT NULL AFTER `iphone_version`;",

    "CREATE TABLE `ucroo_settings` (
     `key` VARCHAR(250) NULL,
     `value` TINYTEXT NULL
    )
    COLLATE='latin1_swedish_ci'
    ENGINE=MyISAM;",

    "INSERT INTO `ucroo_settings` (`key`, `value`) VALUES
    ('current_iphone_version',  '1.3'),
    ('current_android_version', '1.3');"
    );
  return $sql;
}


//To set old voted posts to null
function ucroo_upgrade_123() {
  $sql = array(
      'UPDATE `feed_posts` SET `num_votes` = NULL and `voters` = NULL'
  );
  return $sql;
}

// 3910, updated Add class link
function ucroo_upgrade_124() {
  $sql = array(
    "UPDATE `points_incentive` SET `action_url` = '/classes/setup' WHERE `id` = '4';"
    );
  return $sql;
}

// 3956, updated Add class link
function ucroo_upgrade_125() {
  $sql = array(
    "UPDATE `points_incentive` SET `action_url`='/connection/addnew' WHERE `id`='7';"
    );
  return $sql;
}

// Renamed student news to ucroo news
function ucroo_upgrade_126() {
  $sql = array(
    "UPDATE university_rss SET name = 'UCROO News';"
    );
  return $sql;
}

// Adding required cron types
function ucroo_upgrade_127() {
  $sql = array(
    "INSERT INTO `cron_type` (`cron_type`, `created`) VALUES
    ('classes', '2015-01-13 09:12:08'),
    ('feeds', '2015-01-13 09:12:08'),
    ('ratings', '2015-01-13 09:12:08'),
    ('clubs', '2015-01-13 09:12:08'),
    ('study_groups',  '2015-01-13 09:12:08'),
    ('service_page',  '2015-01-13 09:12:08'),
    ('customgroups',  '2015-01-13 09:12:08'),
    ('mentors', '2015-01-13 09:12:08'),
    ('connections', '2015-01-13 09:12:08');"
    );
  return $sql;
}

// 4187 
function ucroo_upgrade_128() {
  $sql = array(
    "CREATE TABLE ucroo_error_tracking (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL DEFAULT '0',
    `types` ENUM('IOS','Android','Web') NOT NULL DEFAULT 'IOS',
    `api_name` VARCHAR(100) NOT NULL,
    `version` VARCHAR(100) NOT NULL,
    `request` LONGBLOB NOT NULL,
    `response` LONGBLOB NOT NULL,
    `error_code` VARCHAR(100) NOT NULL,
    `extra` VARCHAR(255) NOT NULL,
    `date_created` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
    ) COLLATE='latin1_swedish_ci' ENGINE=InnoDB;");
  return $sql; 
}

#4242
function ucroo_upgrade_129() {
  $sql = array(
    "INSERT INTO `cron_type` (`cron_type`, `created`) VALUES ('delete_ra', now());",
    "INSERT INTO `cron_type` (`cron_type`, `created`) VALUES ('delete_notification', now());"
  );
  return $sql;
}

// 4295 - NIRAV
function ucroo_upgrade_130() {
  $sql = array("INSERT INTO `ucroo_category` (`category_name`, `module_name`) VALUES 
                ('Location', 'customgroups'),
                ('Academic', 'customgroups'),
                ('Sport', 'customgroups'),
                ('Interest/Hobby ', 'customgroups'),
                ('Other','customgroups');");
  return $sql; 
}

function ucroo_upgrade_131() {
  $sql = array(
    "ALTER TABLE `customgroups` ADD COLUMN `category_id` INT(11) NULL DEFAULT NULL AFTER `faculty_id`, ADD CONSTRAINT `FK_customgroups_ucroo_category` FOREIGN KEY (`category_id`) REFERENCES `ucroo_category` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;");
  return $sql; 
}

// #4295 Custom Groups improvements - 1


// 4185
function ucroo_upgrade_132() {
  $sql = array(
    "ALTER TABLE `ucroo_rss_feed` ADD COLUMN `date_fetch` DATETIME NOT NULL AFTER `date_created`;"
  );
  return $sql;
}

// 4239
function ucroo_upgrade_133() {
  $sql = array("ALTER TABLE `feed_answers` ADD COLUMN `isdeleted` TINYINT NOT NULL DEFAULT '0' AFTER `file_location`;");
  return $sql;
}

#4286
function ucroo_upgrade_134() {
  $sql = array(
    " ALTER TABLE study_group
    ADD COLUMN `purpose` ENUM('Exam Revision','Assignment Group','General Study','Other') NOT NULL AFTER `privacy`,
    ADD COLUMN `time_from` TIME NOT NULL AFTER `purpose`,
    ADD COLUMN `time_to` TIME NOT NULL AFTER `time_from`,
    ADD COLUMN `time_day` INT(10) NOT NULL AFTER `time_to`;"
  );
  return $sql;
}

function ucroo_upgrade_135() {
  $sql = array("ALTER TABLE `user_meta` ADD COLUMN `comment_count` INT NULL DEFAULT '0' AFTER `module_visited`;");
  return $sql;
}

function ucroo_upgrade_136() {
  $sql = array("ALTER TABLE `user_meta` ADD COLUMN `votes_count` INT(11) NULL DEFAULT '0' AFTER `comment_count`;");
  return $sql;
}

function ucroo_upgrade_137() {
  $sql = array("ALTER TABLE `feed_posts` ADD COLUMN `backup_comment_user_id` TEXT NULL AFTER `deleted_datetime`;");
  return $sql;
}

function ucroo_upgrade_138() {
  $sql = array("ALTER TABLE `feed_posts` ADD COLUMN `backup_voter_user_id` TEXT NULL AFTER `backup_comment_user_id`;");
  return $sql;
}

function ucroo_upgrade_139() {
  $sql = array("ALTER TABLE `feed_answers` ADD COLUMN `backup_comment_user_id` TEXT NULL AFTER `date_modified`");
  return $sql;
}

function ucroo_upgrade_140() {
  $sql = array("ALTER TABLE `feed_answers` ADD COLUMN `backup_voter_user_id` TEXT NULL AFTER `backup_comment_user_id`;");
  return $sql;
}

function ucroo_upgrade_141() {
  $sql = array("ALTER TABLE `user_meta` DROP COLUMN `comment_count`, DROP COLUMN `votes_count`;");
  return $sql;
}

function ucroo_upgrade_142() {
  $sql = array("CREATE TABLE `ucroo_student_analytics` (
 `user_id` INT(11) NOT NULL,
 `uni_id` INT(11) NOT NULL,
 `connection_count` INT(11) NOT NULL DEFAULT '0',
 `cont_total` INT(11) NOT NULL DEFAULT '0',
 `total_points` INT(11) NOT NULL DEFAULT '0',
 `current_points` INT(11) NOT NULL DEFAULT '0',
 `class_group_joined` INT(11) NOT NULL DEFAULT '0',
 `study_group_joined` INT(11) NOT NULL DEFAULT '0',
 `stu_service_foll` INT(11) NOT NULL DEFAULT '0',
 `mentor_group_joined` INT(11) NOT NULL DEFAULT '0',
 `club_following` INT(11) NOT NULL DEFAULT '0',
 `custom_group_following` INT(11) NOT NULL DEFAULT '0',
 `events_joined` INT(11) NOT NULL DEFAULT '0',
 `comment_count` INT(11) NOT NULL DEFAULT '0',
 `votes_count` INT(11) NOT NULL DEFAULT '0',
 `date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 UNIQUE INDEX `user_id` (`user_id`),
 INDEX `FK_ucroo_student_analytics_university` (`uni_id`),
 CONSTRAINT `FK_ucroo_student_analytics_university` FOREIGN KEY (`uni_id`) REFERENCES `university` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
 CONSTRAINT `FK_ucroo_student_analytics_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) COLLATE='utf8_general_ci'ENGINE=InnoDB;");
  return $sql;
}

function ucroo_upgrade_143() {
  $sql = array("ALTER TABLE `db_schema` ADD COLUMN `na_execution` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `version`;");
  return $sql;
}

//Update the selling user campus in feed post table for Marketplace Items
//Nirav : #4457 : 15-04-2015
function ucroo_upgrade_144() {
  $sql = array("UPDATE feed_posts fp SET fp.post_campus_id = (select u.campus_id from users u WHERE u.id = fp.user_id) WHERE feed_object = 'marketplace';");
  return $sql;
}

//#4265
function ucroo_upgrade_145() {
  $sql = array("ALTER TABLE `study_log` CHANGE COLUMN `status` `status` ENUM('A','M','R') NOT NULL DEFAULT 'A' COMMENT 'A-Automated,M-Manual' AFTER `total_minutes`;");
  return $sql;
}

//#3982
function ucroo_upgrade_146() {
  $sql = array(
        "UPDATE `points_incentive` SET `percentage_points`='30' WHERE `id`='1';",
        "DELETE FROM `points_incentive` WHERE `id`='2';",
        "UPDATE `points_incentive` SET `percentage_points`='20' WHERE `id`='3';",
        "DELETE FROM `points_incentive` WHERE `id`='6';",
        "UPDATE `points_incentive` SET `percentage_points`='10' WHERE `id`='7';"
         );
  return $sql;
}

//#4474
function ucroo_upgrade_147() {
  $sql = array("ALTER TABLE `marketplace` CHANGE COLUMN `date_updated` `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `date_created`;");
  return $sql;
}

//#3982
function ucroo_upgrade_148() {
  $sql = array(
        "UPDATE `points_incentive` SET `id`='2' WHERE `id`='3';",
        "UPDATE `points_incentive` SET `id`='3' WHERE `id`='4';",
        "UPDATE `points_incentive` SET `id`='4' WHERE `id`='5';",
        "UPDATE `points_incentive` SET `id`='5' WHERE `id`='7';",
        "DELETE FROM `points_incentive` WHERE `id`='8';",
        "INSERT INTO `points_incentive` (`id`, `description`, `percentage_points`, `action_url`, `date_created`, `date_modified`) VALUES ('6', 'Where did you go to school?', '1', '', '2015-05-14 11:07:50', '2015-05-14 11:07:50');",
        "INSERT INTO `points_incentive` (`id`, `description`, `percentage_points`, `date_created`, `date_modified`) VALUES ('7', 'Add your skills', '1', '2015-05-14 11:07:50', '2015-05-14 11:07:50');",
        "INSERT INTO `points_incentive` (`id`, `description`, `percentage_points`, `date_created`, `date_modified`) VALUES ('8', 'Add your interests', '1', '2015-05-14 11:07:50', '2015-05-14 11:07:50');",
        "INSERT INTO `points_incentive` (`id`, `description`, `percentage_points`, `date_created`, `date_modified`) VALUES ('9', 'Add your places', '3', '2015-05-14 11:07:50', '2015-05-14 11:07:50');",
        "INSERT INTO `points_incentive` (`id`, `description`, `percentage_points`, `date_created`, `date_modified`) VALUES ('10', 'What languages do you speak?', '3', '2015-05-14 11:07:50', '2015-05-14 11:07:50');",
        "INSERT INTO `points_incentive` (`id`, `description`, `percentage_points`, `date_created`, `date_modified`) VALUES ('11', 'Are you a member of any clubs?', '1', '2015-05-14 11:07:50', '2015-05-14 11:07:50');"
        );
  return $sql;
}

//3982-wrong-percentage
function ucroo_upgrade_149() {
  $sql = array("UPDATE `points_incentive` SET `description`='Make a connection' WHERE `id`='5';");
  return $sql;
}

//4757-target-post-cg
function ucroo_upgrade_150() {
  $sql = array(
    "ALTER TABLE `permissions` CHANGE COLUMN `action` `action` ENUM('post','question','link','pin','endorse','admin','notification','activity','email','like','subscribe','report','file','poll','tag','vote','numposts','position','course','start','finish','faculty','degree','classes','connections','extracurr','timetable','status','create','international','profilesearchable','studygroups','customgroups','mentorgroups','targetpost') NOT NULL AFTER `object`;",
    "INSERT INTO `permissions` (`object`, `action`, `modes`, `is_group`) VALUES ('university', 'targetpost', 'view,edit,delete', 1);",
    "INSERT INTO `permissions` (`object`, `action`, `modes`, `is_group`) VALUES ('service_page', 'targetpost', 'view,edit,delete', 1);",
    "INSERT INTO `permissions` (`object`, `action`, `modes`, `is_group`) VALUES ('customgroups', 'targetpost', 'view,edit,delete', 1);"
    );

  return $sql;
}


//4802
function ucroo_upgrade_151() {
  $sql = array("ALTER TABLE `campus`
 ADD COLUMN `latitude` VARCHAR(300) NOT NULL AFTER `timezone_php`,
 ADD COLUMN `longitude` VARCHAR(300) NOT NULL AFTER `latitude`;",
 "ALTER TABLE `user_settings`
 ADD COLUMN `campus_status` ENUM('1','0') NOT NULL DEFAULT '0' AFTER `hide_connection_info_popup`;"
 );
  return $sql;
}

function ucroo_upgrade_152() {
  $sql = array("ALTER TABLE `campus`
 ADD COLUMN `address` VARCHAR(300) NULL DEFAULT NULL AFTER `name`;",
 "ALTER TABLE `user_settings`
 CHANGE COLUMN `campus_status` `campus_status` ENUM('1','0') NULL DEFAULT '0' AFTER `hide_connection_info_popup`;"
 );
  return $sql;
}
// 4941
function ucroo_upgrade_153() {
  $sql = array("ALTER TABLE `ucroo_mentor`
 CHANGE COLUMN `academic_topics` `academic_topics` TEXT NULL DEFAULT NULL,
 CHANGE COLUMN `languages` `languages` TEXT NULL DEFAULT NULL,
 CHANGE COLUMN `hobbies` `hobbies` TEXT NULL DEFAULT NULL;",
 "UPDATE `ucroo_mentor` SET `academic_topics` = CONCAT(`academic_topics`,'\"]') WHERE `id` = '599' AND academic_topics NOT LIKE '%\"]%';"
 );
  return $sql;
}


//4664 - multiple mentors
function ucroo_upgrade_154() {
  $sql = array(
    "ALTER TABLE `ucroo_mentor` ADD COLUMN `group_id` INT(11) NOT NULL AFTER `id`;",
    "ALTER TABLE `ucroo_mentor` CHANGE COLUMN `mentor_group_name` `mentor_group_name` VARCHAR(100) NOT NULL COMMENT 'university program name' COLLATE 'latin1_swedish_ci' AFTER `user_id`,  ADD COLUMN `group_name` VARCHAR(100) NOT NULL COMMENT 'group name' AFTER `mentor_group_name`;",
    "ALTER TABLE `ucroo_mentor` CHANGE COLUMN `group_id` `group_id` INT(11) NULL AFTER `id`;",
    "update ucroo_mentor um set um.group_id=um.id;",
    "ALTER TABLE `ucroo_mentor` ADD COLUMN `is_creator` ENUM('0','1') NULL DEFAULT '1' AFTER `user_id`;",
    "update ucroo_mentor set is_creator = '1';"
   );

  return $sql;
}

//5004
function ucroo_upgrade_155() {
  $sql = array("ALTER TABLE `userlogin_log` ADD INDEX `login_date_time` (`login_date_time`);");

  return $sql;
}

/**
 * 30/07/15 - #4938 - Pratik - added new type for tracking api loading time ios
 */
function ucroo_upgrade_156() {
  $sql = array("ALTER TABLE `ucroo_error_tracking` CHANGE `types` `types` enum('IOS','Android','Web','IOS_LOAD_TIME') COLLATE 'latin1_swedish_ci' NOT NULL DEFAULT 'IOS' AFTER `user_id`, COMMENT='';");

  return $sql;
}

/**
 * 30/07/15 - #4980 - Jaymit - Updated ucroo category table to remove space after 'Interest/Hobby' category name.
 * Pass here fix id 12 as it is same in staging and live for 'Interest/Hobby' category.
 */
function ucroo_upgrade_157() {
    $sql = array("UPDATE `ucroo_category` SET `category_name` = 'Interest/Hobby' WHERE `ucroo_category`.`id` = 12;");
    return $sql;
}

//#4665
function ucroo_upgrade_158() {
  $sql = array("Delete study_log.* from study_log LEFT JOIN users ON users.id = study_log.user_id WHERE users.group_id != 2;");
  return $sql;
}

/**
 * 18/08/15 - #5152 - Jaymit - Event posted in feed with multiple campus concept & related changes, changed double to varchar.
 * 
 */
function ucroo_upgrade_159() {
    $sql = array(
    "ALTER TABLE `ucroo_event` CHANGE COLUMN `campus_id` `campus_id` VARCHAR(150) NULL DEFAULT NULL AFTER `creator_id`;",
    "ALTER TABLE `service_event` CHANGE COLUMN `campus_id` `campus_id` VARCHAR(150) NULL DEFAULT NULL AFTER `max_attendees`;"
   );
    return $sql;
}

/**
 * //11/09/15 - #5136 - Jaymit - CQU Add a checkbox in CQU signup for Students asking if they are VET Students.
 * 
 */
function ucroo_upgrade_160() {
    $sql = array("ALTER TABLE `user_meta` ADD COLUMN `vet` TINYINT(1) NULL DEFAULT NULL AFTER `phone`;");
    return $sql;
}

/**
 * 14/10/15 - #5504 - Jaymit - Invite contacts from email, added new cron type for email mail queue entry.
 * 
 */
function ucroo_upgrade_161() {
    $sql = array("INSERT INTO `ucroo_new`.`cron_type` (`cron_type`) VALUES ('invite_email');");
    return $sql;
}

/**
 * 15/10/15 - #5483 - Pratik - Added new cron type for monitor keywords email mail queue entry.
 * 
 */
function ucroo_upgrade_162() {
    $sql = array("INSERT INTO `cron_type` (`cron_type`, `is_active`, `created`) VALUES ('monitor_keyword', '1', now());");
    return $sql;
}

/**
 * 02/11/15 - #5679 - Jaymit - Subject invite lecturer, added new cron type for email mail queue entry.
 * 
 */
function ucroo_upgrade_163() {
    $sql = array("INSERT INTO `ucroo_new`.`cron_type` (`cron_type`) VALUES ('subject_invite_lecturer');");
    return $sql;
}

/**
 * 05/11/15 - #5679 - Jaymit - Subject setup invite colleague, added new cron type for email mail queue entry.
 * 
 */
function ucroo_upgrade_164() {
    $sql = array("INSERT INTO `ucroo_new`.`cron_type` (`cron_type`) VALUES ('subject_invite_colleague');");
    return $sql;
}

/**
 * 05/11/15 - #5679 - Jaymit - Subject setup monitor keyword add, added new cron type for email mail queue entry.
 * 
 */
function ucroo_upgrade_165() {
    $sql = array("INSERT INTO `ucroo_new`.`cron_type` (`cron_type`) VALUES ('monitor_keyword_add');");
    return $sql;
}

/**
 * 25/11/15 - #5772 - Jaymit - Service Page - new service created admin notification, added new cron type for email mail queue entry.
 * 
 */
function ucroo_upgrade_166()
{
    $sql = array("INSERT INTO `ucroo_new`.`cron_type` (`cron_type`) VALUES ('service_new_created');");
    return $sql;
}

/**
 * 25/11/15 - #5772 - Jaymit - Service Page - added as service staff member notification, added new cron type for email mail queue entry.
 * 
 */
function ucroo_upgrade_167()
{
    $sql = array("INSERT INTO `ucroo_new`.`cron_type` (`cron_type`) VALUES ('service_staff_member_added');");
    return $sql;
}

/**
 * 17/12/15 - #5831 - Jaymit - Mentorgroup - added member in mentorgroup notification, added new cron type for email mail queue entry.
 * 
 */
function ucroo_upgrade_168()
{
    $sql = array("INSERT INTO `ucroo_new`.`cron_type` (`cron_type`) VALUES ('mentorgroup_member_added');");
    return $sql;
}