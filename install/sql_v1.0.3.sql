DROP TABLE IF EXISTS `ukyun_shops`;
CREATE TABLE `ukyun_shops` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '10',
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `active` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ukyun_orders`;
CREATE TABLE `ukyun_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `zid` int(11) NOT NULL DEFAULT '0',
  `qq` varchar(20) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `url` varchar(32) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ukyun_kms`;
CREATE TABLE `ukyun_kms` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `km` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `addtime` timestamp NULL DEFAULT NULL,
  `user` varchar(20) NOT NULL DEFAULT '0',
  `usetime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ukyun_pay`;
CREATE TABLE `ukyun_pay` (
  `trade_no` varchar(64) NOT NULL,
  `type` varchar(20) NULL,
  `tid` int(11) NOT NULL,
  `qq` varchar(20) NOT NULL,
  `addtime` datetime NULL,
  `endtime` datetime NULL,
  `name` varchar(64) NULL,
  `money` varchar(32) NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;