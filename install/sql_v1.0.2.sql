DROP TABLE IF EXISTS `ukyun_liar`;
CREATE TABLE `ukyun_liar` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `qq` varchar(150) DEFAULT NULL,
  `dengji` varchar(150) NULL,
  `xx` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;