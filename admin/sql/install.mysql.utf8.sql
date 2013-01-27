DROP TABLE IF EXISTS `#__tsj_config`;
DROP TABLE IF EXISTS `#__tsj_office`;

/* Config*/
/* Config: cfg Table*/
DROP TABLE IF EXISTS `#__tsj_cfg`;
CREATE TABLE `#__tsj_cfg` (
	`cfg_name` VARCHAR(100) NOT NULL DEFAULT '',
	`cfg_value` VARCHAR(2048) NOT NULL DEFAULT '',
	UNIQUE INDEX `cfg_name` (`cfg_name`)
)
COLLATE='utf8_unicode_ci'
AUTO_INCREMENT=1
DEFAULT CHARSET=utf8
ENGINE=InnoDB;

/* Add default value*/
INSERT INTO `#__tsj_cfg`(`cfg_name`, `cfg_value`)
VALUES ('water_linksn','');

INSERT INTO `#__tsj_cfg`(`cfg_name`, `cfg_value`)
VALUES ('water_prefix_text','');

INSERT INTO `#__tsj_cfg`(`cfg_name`, `cfg_value`)
VALUES ('water_startDay','1');

INSERT INTO `#__tsj_cfg`(`cfg_name`, `cfg_value`)
VALUES ('water_stopDay','31');

/* User Account System*/
/* User Account System: City Table*/
DROP TABLE IF EXISTS `#__tsj_city`;
CREATE TABLE `#__tsj_city` (
	`city_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`city` VARCHAR(50) NOT NULL COMMENT 'City name' COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`city_id`)
)
COLLATE='utf8_unicode_ci'
AUTO_INCREMENT=1
DEFAULT CHARSET=utf8
ENGINE=InnoDB;

/* User Account System: Street Table*/
DROP TABLE IF EXISTS `#__tsj_street`;
CREATE TABLE `#__tsj_street` (
	`street_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`street` VARCHAR(50) NOT NULL COMMENT 'Street name' COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`street_id`)
)
COLLATE='utf8_unicode_ci'
AUTO_INCREMENT=1
DEFAULT CHARSET=utf8
ENGINE=InnoDB;

/* User Account System: Adress Table*/
DROP TABLE IF EXISTS `#__tsj_address`;
CREATE TABLE `#__tsj_address` (
	`address_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`city_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_city.city_id',
	`street_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_street.street_id',
	`house` VARCHAR(10) NOT NULL COMMENT 'House number' COLLATE 'utf8_unicode_ci',
	`office` VARCHAR(10) NOT NULL COMMENT 'Office number' COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`address_id`),
	INDEX `FK_db_tsj_address_db_tsj_city` (`city_id`),
	INDEX `FK_db_tsj_address_db_tsj_street` (`street_id`),
	CONSTRAINT `FK_db_tsj_address_db_tsj_city` FOREIGN KEY (`city_id`) REFERENCES `#__tsj_city` (`city_id`),
	CONSTRAINT `FK_db_tsj_address_db_tsj_street` FOREIGN KEY (`street_id`) REFERENCES `#__tsj_street` (`street_id`)
)
COLLATE='utf8_unicode_ci'
AUTO_INCREMENT=1
DEFAULT CHARSET=utf8
ENGINE=InnoDB;

/* User Account System: Account Table*/
DROP TABLE IF EXISTS `#__tsj_account`;
CREATE TABLE `#__tsj_account` (
	`account_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`user_id` INT(11) NOT NULL COMMENT 'FK to #__users.id',
	`address_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_address.address_id',
	`account_num` VARCHAR(50) NOT NULL COMMENT 'account number' COLLATE 'utf8_unicode_ci',
	`sq` DOUBLE NOT NULL COMMENT 'office square in m2',
	`tel` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'telephone number' COLLATE 'utf8_unicode_ci',
	`cat` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Tarifs category',
	`lic` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'license',
	PRIMARY KEY (`account_id`),
	UNIQUE INDEX `account_num` (`account_num`),
	INDEX `FK_db_tsj_account_db_tsj_address` (`address_id`),
	INDEX `FK_db_tsj_account_db_users` (`user_id`),
	CONSTRAINT `FK_db_tsj_account_db_tsj_address` FOREIGN KEY (`address_id`) REFERENCES `#__tsj_address` (`address_id`),
	CONSTRAINT `FK_db_tsj_account_db_users` FOREIGN KEY (`user_id`) REFERENCES `#__users` (`id`)
)
COLLATE='utf8_unicode_ci'
AUTO_INCREMENT=1
DEFAULT CHARSET=utf8
ENGINE=InnoDB;

/* Water Counters System */
/* Water Counters System: Office Counters Table */
DROP TABLE IF EXISTS `#__tsj_water_office`;
CREATE TABLE `#__tsj_water_office`(
	`office_counter_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`account_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_office.office_id',
	`counts` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Count of point with water-counters',
	`water_name_1` VARCHAR(50) NULL DEFAULT 'Санузел' COMMENT 'Название точки 1',
	`date_in_hot_p1` DATE NULL DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
	`ser_num_hot_p1` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Серийный номер',
	`date_in_cold_p1` DATE NULL DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
	`ser_num_cold_p1` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Серийный номер',
	`water_name_2` VARCHAR(50) NULL DEFAULT 'Санузел 1' COMMENT 'Название точки 2',
	`date_in_hot_p2` DATE NULL DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
	`ser_num_hot_p2` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Серийный номер',
	`date_in_cold_p2` DATE NULL DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
	`ser_num_cold_p2` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Серийный номер',
	`water_name_3` VARCHAR(50) NULL DEFAULT 'Санузел 2' COMMENT 'Название точки 3',
	`date_in_hot_p3` DATE NULL DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
	`ser_num_hot_p3` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Серийный номер',
	`date_in_cold_p3` DATE NULL DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
	`ser_num_cold_p3` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Серийный номер',
	PRIMARY KEY (`office_counter_id`)
)
COLLATE='utf8_unicode_ci'
AUTO_INCREMENT=1
DEFAULT CHARSET=utf8
ENGINE=InnoDB;

/* Water Counters System: Water Table */
DROP TABLE IF EXISTS `#__tsj_water_data`;
CREATE TABLE `#__tsj_water_data`(
	`water_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`office_counter_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_water_counter.water_counter_id',
	`data_hot_c1` DOUBLE NULL DEFAULT NULL COMMENT 'Data hot water counter m3',
	`data_cold_c1` DOUBLE NULL DEFAULT NULL COMMENT 'Data cold water counter m3',
	`data_hot_c2` DOUBLE NULL DEFAULT NULL COMMENT 'Date of delivery',
	`data_cold_c2` DOUBLE NULL DEFAULT NULL COMMENT 'Date of delivery',
	`data_hot_c3` DOUBLE NULL DEFAULT NULL COMMENT 'Date of delivery',
	`data_cold_c3` DOUBLE NULL DEFAULT NULL COMMENT 'Date of delivery',
	`date_in` DATE NULL DEFAULT NULL COMMENT 'Date of delivery',
	PRIMARY KEY (`water_id`)
)
COLLATE='utf8_unicode_ci'
AUTO_INCREMENT=1
DEFAULT CHARSET=utf8
ENGINE=InnoDB;


/* Gaz Counters System */
DROP TABLE IF EXISTS `#__tsj_gaz_office`;
DROP TABLE IF EXISTS `#__tsj_gaz_data`;

/* Electrocity Counters System */
DROP TABLE IF EXISTS `#__tsj_electro_office`;
DROP TABLE IF EXISTS `#__tsj_electro_data`;

/* Tarifs System */
/* Tarifs System: Tarifs Table */
DROP TABLE IF EXISTS `#__tsj_tarif`;
CREATE TABLE `#__tsj_tarif`(
  `tarif_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `tarif_name` VARCHAR(100) NULL COMMENT 'Tarif name',
  `tarif_name_short` VARCHAR(20) NULL COMMENT 'Tarif name short',
  `tarif` DOUBLE NULL COMMENT 'Main Tarif',
  `tarif_1` DOUBLE NULL COMMENT 'Tarif category 1',
  `tarif_2` DOUBLE NULL COMMENT 'Tarif category 2',
  PRIMARY KEY (`tarif_id`)
)
COLLATE='utf8_unicode_ci'
AUTO_INCREMENT=0
DEFAULT CHARSET=utf8
ENGINE=InnoDB;