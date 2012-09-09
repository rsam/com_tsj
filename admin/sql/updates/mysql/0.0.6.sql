DROP TABLE IF EXISTS `#__tsj_water`;
 
CREATE TABLE `#__tsj_water` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
 
INSERT INTO `#__tsj_water` (`name`) VALUES
	('Привет :) я из БД'),
	('Прощай :( я из БД');