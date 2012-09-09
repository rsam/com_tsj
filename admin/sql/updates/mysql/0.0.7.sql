DROP TABLE IF EXISTS `#__tsj_config`;

DROP TABLE IF EXISTS `#__tsj_city`;
CREATE TABLE `#__tsj_city` (
  `city_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `city` VARCHAR(50) NOT NULL COMMENT 'City name',
   PRIMARY KEY  (`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `#__tsj_street`;
CREATE TABLE `#__tsj_street` (
  `street_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `street` VARCHAR(50) NOT NULL COMMENT 'Street name',
   PRIMARY KEY  (`street_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `#__tsj_address`;
CREATE TABLE `#__tsj_address` (
  `address_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `city_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_city.city_id',
  `street_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_street.street_id',
  `house` VARCHAR(10) NOT NULL COMMENT 'House number',
  `office` VARCHAR(10) NOT NULL COMMENT 'Office number',
   PRIMARY KEY  (`address_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `#__tsj_office`;
CREATE TABLE `#__tsj_office` (
  `office_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `address_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_address.address_id',
  `sq` DOUBLE NOT NULL COMMENT 'office square in m2',
  `tel` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'telephone number MD5',
   PRIMARY KEY  (`office_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `#__tsj_account`;
CREATE TABLE `#__tsj_account` (
  `account_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `office_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_office.office_id',
  `username` VARCHAR(150) NOT NULL COMMENT 'FK to #__users.username',
  `cat` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Category',
  `lic` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'license',
   PRIMARY KEY  (`account_id`),
   UNIQUE INDEX `office_id` (`office_id`),
   UNIQUE INDEX `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `#__tsj_water_counter`;
CREATE TABLE `#__tsj_water_counter` (
  `water_counter_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `username` VARCHAR(150) NOT NULL COMMENT 'FK to #__users.username',
  `counts` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Count of point with water-counters',
  `name_1` VARCHAR(50) NULL COMMENT 'Name of point 1',
  `sn_hot_1` VARCHAR(50) NULL COMMENT 'SN counter for hot water',
  `date_hot_1` DATE NULL COMMENT 'Check date for hot water counter',
  `sn_cold_1` VARCHAR(50) NULL COMMENT 'SN counter for cold water',
  `date_cold_1` DATE NULL COMMENT 'Check date for cold water counter',
  `name_2` VARCHAR(50) NULL COMMENT 'Name of point 2',
  `sn_hot_2` VARCHAR(50) NULL COMMENT 'SN counter for hot water',
  `date_hot_2` DATE NULL COMMENT 'Check date for hot water counter',
  `sn_cold_2` VARCHAR(50) NULL COMMENT 'SN counter for cold water',
  `date_cold_2` DATE NULL COMMENT 'Check date for cold water counter',
  `name_3` VARCHAR(50) NULL COMMENT 'Name of point 3',
  `sn_hot_3` VARCHAR(50) NULL COMMENT 'SN counter for hot water',
  `date_hot_3` DATE NULL COMMENT 'Check date for hot water counter',
  `sn_cold_3` VARCHAR(50) NULL COMMENT 'SN counter for cold water',
  `date_cold_3` DATE NULL COMMENT 'Check date for cold water counter',
   PRIMARY KEY  (`water_counter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `#__tsj_water`;
CREATE TABLE `#__tsj_water` (
  `water_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `water_counter_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_water_counter.water_counter_id',
  `data_hot_1` DOUBLE NULL COMMENT 'Data hot water counter m3',
  `data_cold_1` DOUBLE NULL COMMENT 'Data cold water counter m3',
  `data_hot_2` DOUBLE NULL COMMENT 'Data hot water counter m3',
  `data_cold_2` DOUBLE NULL COMMENT 'Data cold water counter m3',
  `data_hot_3` DOUBLE NULL COMMENT 'Data hot water counter m3',
  `data_cold_3` DOUBLE NULL COMMENT 'Data cold water counter m3',
  `date_in` DATE NULL  COMMENT 'Date of delivery',
   PRIMARY KEY  (`water_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `#__tsj_gaz_counter`;
DROP TABLE IF EXISTS `#__tsj_gaz`;

DROP TABLE IF EXISTS `#__tsj_electro_counter`;
DROP TABLE IF EXISTS `#__tsj_electro`;