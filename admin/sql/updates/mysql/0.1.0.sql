/* @ver. 0.1.0 */

DROP TABLE IF EXISTS `#__tsj_config`;

/* User Account System*/
/* User Account System: City Table*/
DROP TABLE IF EXISTS `#__tsj_city`;
CREATE TABLE `#__tsj_city`(
  `city_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `city` VARCHAR(50) NOT NULL COMMENT 'City name',
  PRIMARY KEY (`city_id`)
) ENGINE = MYISAM AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

/* User Account System: Street Table*/
DROP TABLE IF EXISTS `#__tsj_street`;
CREATE TABLE `#__tsj_street`(
  `street_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `street` VARCHAR(50) NOT NULL COMMENT 'Street name',
  PRIMARY KEY (`street_id`)
) ENGINE = MYISAM AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

/* User Account System: Adress Table*/
DROP TABLE IF EXISTS `#__tsj_address`;
CREATE TABLE `#__tsj_address`(
  `address_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `city_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_city.city_id',
  `street_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_street.street_id',
  `house` VARCHAR(10) NOT NULL COMMENT 'House number',
  `office` VARCHAR(10) NOT NULL COMMENT 'Office number',
  PRIMARY KEY (`address_id`)
) ENGINE = MYISAM AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

/* User Account System: Office Table*/
DROP TABLE IF EXISTS `#__tsj_office`;
CREATE TABLE `#__tsj_office`(
  `office_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `address_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_address.address_id',
  `sq` DOUBLE NOT NULL COMMENT 'office square in m2',
  `tel` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'telephone number MD5',
  PRIMARY KEY (`office_id`)
) ENGINE = MYISAM AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

/* User Account System: Account Table*/
DROP TABLE IF EXISTS `#__tsj_account`;
CREATE TABLE `#__tsj_account`(
  `account_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `office_id` INT(11) NOT NULL COMMENT 'FK to #__tsj_office.office_id',
  `username` VARCHAR(150) NOT NULL COMMENT 'FK to #__users.username',
  `cat` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Category',
  `lic` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'license',
  PRIMARY KEY (`account_id`),
  UNIQUE INDEX `office_id` (`office_id`),
  UNIQUE INDEX `username` (`username`)
) ENGINE = MYISAM AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;


/* Water Counters System */
/* Water Counters System: Office Counters Table */
DROP TABLE IF EXISTS `#__tsj_water_office`;
CREATE TABLE `#__tsj_water_office`(
  office_counter_id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  office_id INT(11) NOT NULL COMMENT 'FK to #__tsj_office.office_id',
  counts TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Count of point with water-counters',
  water_name_1 VARCHAR(50) DEFAULT 'Санузел' COMMENT 'Название точки 1',
  date_in_hot_p1 DATE DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
  ser_num_hot_p1 VARCHAR(50) DEFAULT NULL COMMENT 'Серийный номер',
  date_in_cold_p1 DATE DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
  ser_num_cold_p1 VARCHAR(50) DEFAULT NULL COMMENT 'Серийный номер',
  water_name_2 VARCHAR(50) DEFAULT 'Санузел 1' COMMENT 'Название точки 2',
  date_in_hot_p2 DATE DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
  ser_num_hot_p2 VARCHAR(50) DEFAULT NULL COMMENT 'Серийный номер',
  date_in_cold_p2 DATE DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
  ser_num_cold_p2 VARCHAR(50) DEFAULT NULL COMMENT 'Серийный номер',
  water_name_3 VARCHAR(50) DEFAULT 'Санузел 2' COMMENT 'Название точки 3',
  date_in_hot_p3 DATE DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
  ser_num_hot_p3 VARCHAR(50) DEFAULT NULL COMMENT 'Серийный номер',
  date_in_cold_p3 DATE DEFAULT NULL COMMENT 'дата ввода в эксп. счетчика',
  ser_num_cold_p3 VARCHAR(50) DEFAULT NULL COMMENT 'Серийный номер',
  PRIMARY KEY (office_counter_id)
) ENGINE = MYISAM AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

/* Water Counters System: Water Table */
DROP TABLE IF EXISTS `#__tsj_water_data`;
CREATE TABLE `#__tsj_water_data`(
  water_id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  office_counter_id INT(11) NOT NULL COMMENT 'FK to #__tsj_water_counter.water_counter_id',
  data_hot_c1 DOUBLE DEFAULT NULL COMMENT 'Data hot water counter m3',
  data_cold_c1 DOUBLE DEFAULT NULL COMMENT 'Data cold water counter m3',
  data_hot_c2 DOUBLE DEFAULT NULL COMMENT 'Date of delivery',
  data_cold_c2 DOUBLE DEFAULT NULL COMMENT 'Date of delivery',
  data_hot_c3 DOUBLE DEFAULT NULL COMMENT 'Date of delivery',
  data_cold_c3 DOUBLE DEFAULT NULL COMMENT 'Date of delivery',
  date_in DATE DEFAULT NULL COMMENT 'Date of delivery',
  PRIMARY KEY (water_id)
) ENGINE = MYISAM AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;


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
  `tarif_name` VARCHAR(20) NULL COMMENT 'Tarif name',
  `tarif` DOUBLE NULL COMMENT 'Main Tarif',
  `tarif_1` DOUBLE NULL COMMENT 'Tarif category 1',
  `tarif_2` DOUBLE NULL COMMENT 'Tarif category 2',
  PRIMARY KEY (`tarif_id`)
) ENGINE = MYISAM AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;