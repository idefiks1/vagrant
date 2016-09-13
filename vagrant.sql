/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50550
Source Host           : localhost:3306
Source Database       : vagrant

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2016-09-08 16:56:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `id_user` int(4) NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', 'admin', '1', '13423456778', '2016-09-07');
INSERT INTO `comments` VALUES ('7', 'admin', '1', '2', '2016-09-07');
INSERT INTO `comments` VALUES ('27', 'test3', '0', 'agfagas11111', '2016-09-08');
INSERT INTO `comments` VALUES ('28', 'admin', '0', 'zfbhzdfhzdb', '2016-09-08');
INSERT INTO `comments` VALUES ('29', 'admin', '0', 'Comment from admin alalalalalalllllllllllllllllllllllllllllllll', '2016-09-08');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `users` VALUES ('2', 'idefiks', '', '827ccb0eea8a706c4c34a16891f84e7b');
INSERT INTO `users` VALUES ('3', 'test', '', 'cfcd208495d565ef66e7dff9f98764da');
INSERT INTO `users` VALUES ('4', 'test1', '', 'cfcd208495d565ef66e7dff9f98764da');
INSERT INTO `users` VALUES ('5', 'test3', '', 'cfcd208495d565ef66e7dff9f98764da');
