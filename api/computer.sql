/*
MySQL Backup
Database: computer
Backup Time: 2019-04-04 17:28:41
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `computer`.`column`;
DROP TABLE IF EXISTS `computer`.`news`;
DROP TABLE IF EXISTS `computer`.`news_images`;
DROP TABLE IF EXISTS `computer`.`slideshow`;
DROP TABLE IF EXISTS `computer`.`user`;
CREATE TABLE `column` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `index` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `is_start` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启动',
  `creation_time` int(10) NOT NULL COMMENT '创建时间',
  `modify_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
CREATE TABLE `news` (
  `id` bigint(20) NOT NULL,
  `title` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '内容',
  `describe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `cover` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '封面',
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类型',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '热点新闻',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶',
  `is_start` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启动',
  `column_id` bigint(20) unsigned NOT NULL COMMENT '对应的栏目id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '作者',
  `creation_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `modify_time` int(10) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `news_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片链接',
  `news_id` bigint(20) unsigned NOT NULL COMMENT '图片对应的新闻',
  `creation_time` int(10) DEFAULT NULL COMMENT '创建的时间',
  `modify_time` int(10) DEFAULT NULL COMMENT '修改的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `slideshow` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '轮播图标题',
  `describe` varchar(255) DEFAULT NULL COMMENT '轮播图描述',
  `type` varchar(255) DEFAULT NULL COMMENT '轮播图类型',
  `index` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `is_start` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启动',
  `news_id` bigint(20) unsigned NOT NULL COMMENT '对应的新闻id',
  `creation_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `modify_time` int(10) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '账号',
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `role` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色',
  `phone` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '手机',
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '邮箱',
  `creation_time` int(10) NOT NULL COMMENT '创建时间',
  `modify_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
BEGIN;
LOCK TABLES `computer`.`column` WRITE;
DELETE FROM `computer`.`column`;
INSERT INTO `computer`.`column` (`id`,`title`,`index`,`is_start`,`creation_time`,`modify_time`) VALUES (3, '111', 0, 1, 1554366110, 1554368747),(4, 'asd1', 0, 1, 1554366146, 1554366146),(5, 'asd12', 0, 1, 1554366223, 1554366223),(6, 'asd122', 0, 1, 1554366510, 1554366510),(7, '1112', 0, 1, 1554368942, 1554368942),(10, '2323sdsa', 0, 1, 1554368942, 1554368942),(13, '1121', 0, 1, 1554366110, 1554368747),(17, '2323sd1sa', 0, 1, 1554368942, 1554368942),(18, '23', 0, 1, 1554368942, 1554368942),(19, 'sadfff', 0, 0, 1554369498, 1554369498),(20, 'sadffffs', 0, 1, 1554369515, 1554369515),(21, 'sadffffsfff', 1, 1, 1554369529, 1554369529);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`news` WRITE;
DELETE FROM `computer`.`news`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`news_images` WRITE;
DELETE FROM `computer`.`news_images`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`slideshow` WRITE;
DELETE FROM `computer`.`slideshow`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `computer`.`user` WRITE;
DELETE FROM `computer`.`user`;
INSERT INTO `computer`.`user` (`id`,`name`,`username`,`password`,`role`,`phone`,`email`,`creation_time`,`modify_time`) VALUES (1, '超级管理员', 'admin', 'admin', 'superAdmin', NULL, NULL, 1553779168, 1553779168),(2, '小2', '1231', '123', 'admin', NULL, NULL, 1553779492, 1553779492),(3, '小3', '1232', '123', 'admin', NULL, NULL, 1553779508, 1553779508),(4, '小4', '1233', '123', 'admin', NULL, NULL, 1553779527, 1553779527),(5, '小5', '1234', '123', 'admin', NULL, NULL, 1553779611, 1553779611),(6, '小6', '1235', '123', 'admin', NULL, NULL, 1553779631, 1553779631),(7, '小7', '5556', '111', 'admin', NULL, NULL, 1553780685, 1553780685),(8, '小8', '5557', '111', 'admin', NULL, NULL, 1553780689, 1553780689),(9, '小9', '5558', '111', 'admin', NULL, NULL, 1553780708, 1553780708),(10, '小1', '是你', '111', 'admin', NULL, NULL, 1553781367, 1553781367),(11, '小可爱', '1234111', '123', 'admin', '101111', '100@qq.com', 1554030942, 1554030942);
UNLOCK TABLES;
COMMIT;
