/*
MySQL Backup
Database: computer
Backup Time: 2019-05-14 00:44:11
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `computer`.`column`;
DROP TABLE IF EXISTS `computer`.`news`;
DROP TABLE IF EXISTS `computer`.`news_images`;
DROP TABLE IF EXISTS `computer`.`recycle_bin`;
DROP TABLE IF EXISTS `computer`.`slideshow`;
DROP TABLE IF EXISTS `computer`.`user`;
CREATE TABLE `column` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `index` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `is_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启动',
  `creation_time` int(10) NOT NULL COMMENT '创建时间',
  `modify_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
CREATE TABLE `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `describe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '内容',
  `cover` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '图片新闻封面',
  `slideshow_cover` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '轮播图封面',
  `type` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '类型',
  `contributor` varchar(30) NOT NULL COMMENT '投稿者',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '热点新闻',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶',
  `is_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启动',
  `column_id` bigint(20) unsigned NOT NULL COMMENT '对应的栏目id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '管理员id',
  `creation_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `modify_time` int(10) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `news_ibfk_1` (`column_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`column_id`) REFERENCES `column` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
CREATE TABLE `news_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片链接',
  `news_id` bigint(20) unsigned NOT NULL COMMENT '图片对应的新闻',
  `creation_time` int(10) DEFAULT NULL COMMENT '创建的时间',
  `modify_time` int(10) DEFAULT NULL COMMENT '修改的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `recycle_bin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `describe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '内容',
  `cover` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '图片新闻封面',
  `slideshow_cover` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '轮播图封面',
  `type` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '类型',
  `contributor` varchar(30) NOT NULL COMMENT '投稿者',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '热点新闻',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶',
  `is_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启动',
  `column_id` bigint(20) unsigned NOT NULL COMMENT '对应的栏目id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '管理员id',
  `creation_time` int(10) NOT NULL COMMENT '创建时间',
  `modify_time` int(10) NOT NULL COMMENT '修改时间',
  `recycle_time` int(10) NOT NULL COMMENT '回收时间',
  PRIMARY KEY (`id`),
  KEY `news_ibfk_1` (`column_id`),
  CONSTRAINT `recycle_bin_ibfk_1` FOREIGN KEY (`column_id`) REFERENCES `column` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
CREATE TABLE `slideshow` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `index` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `is_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启动',
  `news_id` bigint(20) unsigned NOT NULL COMMENT '对应的新闻id',
  `creation_time` int(10) NOT NULL COMMENT '创建时间',
  `modify_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`),
  CONSTRAINT `slideshow_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '账号',
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `role` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色',
  `phone` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '手机',
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '邮箱',
  `is_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,是否激活',
  `creation_time` int(10) NOT NULL COMMENT '创建时间',
  `modify_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
BEGIN;
LOCK TABLES `computer`.`column` WRITE;
DELETE FROM `computer`.`column`;
INSERT INTO `computer`.`column` (`id`,`title`,`index`,`is_status`,`creation_time`,`modify_time`) VALUES (5, '2', 1, 1, 1554366223, 1557461627),(6, 'asd122', 0, 1, 1554366510, 1554366510),(7, '1112', 0, 1, 1554368942, 1554368942),(10, '2323sdsa', 0, 1, 1554368942, 1554368942),(13, '1121', 0, 1, 1554366110, 1554368747),(17, '2323sd1sa', 0, 1, 1554368942, 1554368942),(18, '23', 0, 1, 1554368942, 1555422577),(19, 'sadfff', 0, 0, 1554369498, 1554369498),(20, 'sadffffs', 0, 1, 1554369515, 1554369515),(21, 'sadffffsfff', 1, 1, 1554369529, 1554369529),(22, '你好', 0, 0, 1554737113, 1554737113),(23, '你好s', 0, 0, 1554737958, 1554737958),(25, '555', 0, 0, 1557464294, 1557464294),(26, '223', 1, 0, 1557464333, 1557464333),(27, '22323', 1, 1, 1557464369, 1557464369);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`news` WRITE;
DELETE FROM `computer`.`news`;
INSERT INTO `computer`.`news` (`id`,`title`,`describe`,`content`,`cover`,`slideshow_cover`,`type`,`contributor`,`is_hot`,`is_top`,`is_status`,`column_id`,`user_id`,`creation_time`,`modify_time`) VALUES (16, '我是新闻', '撒旦', '阿斯蒂芬发', '', '/computer/images/back3.png', '阿斯蒂芬', '案说法', 0, 0, 0, 7, 1, 1554394658, 1554394658),(17, '123', '撒旦', '阿斯蒂芬发', '', '', '阿斯蒂芬', '案说法', 0, 0, 0, 6, 1, 1554394672, 1554394672),(18, '555', '2', '1', '/computer/images/41eb7d00561daa28f0a0b603de18975c.jpg', '/computer/images/29381f30e924b899d0dfefe96e061d950b7bf604.jpg', '驱蚊器', '杨鸿燊', 0, 0, 0, 5, 4, 1557463767, 1557463767),(19, '555', '2', '1', '', '/computer/images/29381f30e924b899d0dfefe96e061d950b7bf604.jpg', '驱蚊器', '杨鸿燊', 0, 0, 0, 5, 4, 1557463788, 1557463788),(20, '555', '2', '1', '/computer/images/41eb7d00561daa28f0a0b603de18975c.jpg', '', '驱蚊器', '杨鸿燊', 0, 0, 0, 5, 4, 1557463795, 1557463795),(21, '555', '2', '1', '/computer/images/41eb7d00561daa28f0a0b603de18975c.jpg', '/computer/images/29381f30e924b899d0dfefe96e061d950b7bf604.jpg', '驱蚊器', '杨鸿燊', 0, 0, 0, 5, 4, 1557463800, 1557463800),(22, '555', '2', '1', '', '', '驱蚊器', '杨鸿燊', 0, 0, 0, 5, 4, 1557463811, 1557463811),(23, '555', '2', '1', '', '', '驱蚊器', '杨鸿燊', 0, 0, 0, 5, 4, 1557464235, 1557464235),(24, '1224', 'asd', NULL, '/computer/images/sssssssssssss', '', '1', 'ss', 0, 0, 0, 5, 4, 1557637820, 1557637820),(27, '1224', 'asd', NULL, '/computer/images/xdgshpvarmitcwlkuozyjqbfen1557642891-.jpeg', '', '1', 'ss', 0, 0, 0, 5, 4, 1557642891, 1557642891),(28, '1224', 'asd', NULL, '/computer/images/tqnboplkumwydicvsxgajefrhz1557642922.jpeg', '', '1', 'ss', 0, 0, 0, 5, 4, 1557642922, 1557642922),(30, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(31, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(32, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(33, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(34, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(35, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(36, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(37, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(38, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/41eb7d00561daa28f0a0b603de18975c.jpg', '/computer/images/back3.png', '阿斯蒂芬', '案说法', 0, 0, 0, 6, 1, 1554393812, 1554393812),(39, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/back3.png', '', '阿斯蒂芬', '案说法', 0, 0, 0, 5, 1, 1554393797, 1554393797),(40, '我是新闻', '撒旦', '阿斯蒂芬发', '/computer/images/41eb7d00561daa28f0a0b603de18975c.jpg', '/computer/images/back3.png', '阿斯蒂芬', '案说法', 0, 0, 0, 6, 1, 1554393812, 1554393812),(41, '1224', 'asd', '', '/computer/images/cover', '', '1', 'ss', 0, 0, 0, 5, 4, 1557642761, 1557642761),(42, '1224', 'asd', '', '/computer/images/cover', '', '1', 'ss', 0, 0, 0, 5, 4, 1557642868, 1557642868);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`news_images` WRITE;
DELETE FROM `computer`.`news_images`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`recycle_bin` WRITE;
DELETE FROM `computer`.`recycle_bin`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`slideshow` WRITE;
DELETE FROM `computer`.`slideshow`;
INSERT INTO `computer`.`slideshow` (`id`,`index`,`is_status`,`news_id`,`creation_time`,`modify_time`) VALUES (2, 1, 1, 17, 1, 1),(3, 0, 0, 18, 1557589728, 1557589728),(4, 9, 0, 19, 1557589759, 1557589759);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`user` WRITE;
DELETE FROM `computer`.`user`;
INSERT INTO `computer`.`user` (`id`,`name`,`username`,`password`,`role`,`phone`,`email`,`is_status`,`creation_time`,`modify_time`) VALUES (4, '小4', '1233', '123', 'admin', NULL, NULL, 1, 1553779527, 1557389103),(6, '小6', '1235', '123', 'admin', NULL, NULL, 1, 1553779631, 1553779631),(7, '小7', '5556', '111', 'admin', NULL, NULL, 1, 1553780685, 1553780685),(10, '小1', '是你', '111', 'admin', NULL, NULL, 1, 1553781367, 1553781367),(12, 'sad', 'safffffff', '4545454', 'admin', '5456464', '5454', 1, 1555343585, 1555343585),(14, '22323', '1', '1', 'admin', '23', '1', 1, 1557464712, 1557464712);
UNLOCK TABLES;
COMMIT;
