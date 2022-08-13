DROP TABLE IF EXISTS `ukyun_list`;
CREATE TABLE `ukyun_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `url` varchar(20) NULL,
  `qq` varchar(20) DEFAULT NULL,
  `js` text NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;