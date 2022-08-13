DROP TABLE IF EXISTS `ukyun_config`;
create table `ukyun_config` (
`k` varchar(32) NOT NULL,
`v` text NULL,
PRIMARY KEY  (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ukyun_config` VALUES ('title', 'UK云工作室官网');
INSERT INTO `ukyun_config` VALUES ('keywords', 'UK云工作室官网');
INSERT INTO `ukyun_config` VALUES ('description', 'UK云工作室官网');
INSERT INTO `ukyun_config` VALUES ('weburl', 'https://www.ukyun.cn/');
INSERT INTO `ukyun_config` VALUES ('banquan', 'UK云工作室');
INSERT INTO `ukyun_config` VALUES ('repair', '1');
INSERT INTO `ukyun_config` VALUES ('qq', '2874992246');
INSERT INTO `ukyun_config` VALUES ('mail', '2874992246@qq.com');
INSERT INTO `ukyun_config` VALUES ('dianhua', '1008611');
INSERT INTO `ukyun_config` VALUES ('qqqun', '732541300');
INSERT INTO `ukyun_config` VALUES ('qqqunurl', 'https://jq.qq.com/?_wv=1027&k=5MSQnpl');
INSERT INTO `ukyun_config` VALUES ('beian', '桂ICP备19025520号-1');
INSERT INTO `ukyun_config` VALUES ('lxkfurl', 'http://p.qiao.baidu.com/cps/chat?siteId=14300844&userId=29074329');
INSERT INTO `ukyun_config` VALUES ('tongji', '填友盟的统计代码(推荐图片样式)');
INSERT INTO `ukyun_config` VALUES ('urlname1', 'UK云工作室');
INSERT INTO `ukyun_config` VALUES ('url1', 'https://www.ukyun.cn');
INSERT INTO `ukyun_config` VALUES ('urlname2', 'UK云工作室');
INSERT INTO `ukyun_config` VALUES ('url2', 'https://www.ukyun.cn');
INSERT INTO `ukyun_config` VALUES ('urlname3', 'UK云工作室');
INSERT INTO `ukyun_config` VALUES ('url3', 'https://www.ukyun.cn');
INSERT INTO `ukyun_config` VALUES ('urlname4', 'UK云工作室');
INSERT INTO `ukyun_config` VALUES ('url4', 'https://www.ukyun.cn');
INSERT INTO `ukyun_config` VALUES ('music1', 'https://api.ukyun.cn/website/mp3/默认歌曲.mp3');
INSERT INTO `ukyun_config` VALUES ('music2', 'https://api.ukyun.cn/website/mp3/默认歌曲.mp3');
INSERT INTO `ukyun_config` VALUES ('music3', 'https://api.ukyun.cn/website/mp3/默认歌曲.mp3');
INSERT INTO `ukyun_config` VALUES ('tz', '可适当添加代码');
INSERT INTO `ukyun_config` VALUES ('gg', '可适当添加代码');
INSERT INTO `ukyun_config` VALUES ('muban', 'enterprise');
INSERT INTO `ukyun_config` VALUES ('apiurl', 'https://api.ukyun.cn/website');
INSERT INTO `ukyun_config` VALUES ('bjurl', 'https://api.ukyun.cn/sjbz/api.php?lx=meizi');
INSERT INTO `ukyun_config` VALUES ('sitename', 'UK云工作室-赞助系统');
INSERT INTO `ukyun_config` VALUES ('panel', 'UK云工作室');
INSERT INTO `ukyun_config` VALUES ('ym', 'https://www.ukyun.cn/beg');
INSERT INTO `ukyun_config` VALUES ('beggg', '可适当添加代码');
INSERT INTO `ukyun_config` VALUES ('money', '0.01');
INSERT INTO `ukyun_config` VALUES ('copy', 'UK云工作室');
INSERT INTO `ukyun_config` VALUES ('liuyan', '部分易支付会拦截，更改名字就好');
INSERT INTO `ukyun_config` VALUES ('begmusic', 'https://api.ukyun.cn/website/mp3/默认歌曲.mp3');
INSERT INTO `ukyun_config` VALUES ('kfqq', '2874992246');
INSERT INTO `ukyun_config` VALUES ('api', 'http://pay.ukyun.cn/');
INSERT INTO `ukyun_config` VALUES ('payid', '1000');
INSERT INTO `ukyun_config` VALUES ('ms', 'abcdef123456');
INSERT INTO `ukyun_config` VALUES ('begrepair', '1');
INSERT INTO `ukyun_config` VALUES ('shoprepair', '1');
INSERT INTO `ukyun_config` VALUES ('alipay_api', '2');
INSERT INTO `ukyun_config` VALUES ('tenpay_api', '2');
INSERT INTO `ukyun_config` VALUES ('qqpay_api', '2');
INSERT INTO `ukyun_config` VALUES ('wxpay_api', '2');
INSERT INTO `ukyun_config` VALUES ('anounce', '<h4>下单注意事项</h4><font color=blue>请勿重复下单，之前的单子刷完才能继续下单</font>');
INSERT INTO `ukyun_config` VALUES ('kaurl', '填发卡地址');
INSERT INTO `ukyun_config` VALUES ('modal', '可适当添加代码');

DROP TABLE IF EXISTS `ukyun_user`;
CREATE TABLE `ukyun_user` (
 `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(150) NOT NULL COMMENT '用户账号',
  `pass` varchar(150) NOT NULL COMMENT '登录密码',
  `qq` varchar(150) NOT NULL COMMENT '用户QQ',
  `actives` varchar(150) NOT NULL COMMENT '账号状态',
  `power` text COMMENT '用户权限',
  `name` text COMMENT '用户名字',
  `last` varchar(150) NOT NULL COMMENT '最后登录IP',
  `ip` varchar(150) NOT NULL COMMENT 'IP地址',
  `boss` varchar(150) NOT NULL COMMENT '用户上级',
  `access_token` text COMMENT '快捷QQ登录',
   PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ukyun_user`(`user`, `pass`, `qq`, `actives`, `power`, `name`, `last`, `ip`, `boss`, `access_token`) VALUES
('admin', '123456', '2874992246', '1', '超级管理', '辉辉很乖', 'NULL', 'NULL', '1', 'NULL');

DROP TABLE IF EXISTS `ukyun_daili`;
CREATE TABLE `ukyun_daili` (
 `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(150) NOT NULL COMMENT '用户账号',
  `pass` varchar(150) NOT NULL COMMENT '登录密码',
  `qq` varchar(150) NOT NULL COMMENT '用户QQ',
  `active` varchar(150) NOT NULL COMMENT '账号状态',
  `power` text COMMENT '用户权限',
  `name` text COMMENT '用户名字',
  `last` varchar(150) NOT NULL COMMENT '最后登录IP',
  `ip` varchar(150) NOT NULL COMMENT 'IP地址',
  `boss` varchar(150) NOT NULL COMMENT '用户上级',
  `access_token` text COMMENT '快捷QQ登录',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ukyun_log`;
CREATE TABLE `ukyun_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(150) DEFAULT NULL,
  `type` varchar(20) NULL,
  `date` datetime NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `data` text NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;