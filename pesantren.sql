/*
Navicat MySQL Data Transfer

Source Server         : data
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : pesantren

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-09-24 14:33:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for debit
-- ----------------------------
DROP TABLE IF EXISTS `debit`;
CREATE TABLE `debit` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `debit` varchar(20) DEFAULT NULL,
  `memo` text,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of debit
-- ----------------------------
INSERT INTO `debit` VALUES ('1', '2015-09-24', 'asd', '1000', '-');

-- ----------------------------
-- Table structure for kredit
-- ----------------------------
DROP TABLE IF EXISTS `kredit`;
CREATE TABLE `kredit` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `jenis` tinyint(4) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `kredit` varchar(20) DEFAULT NULL,
  `memo` text,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kredit
-- ----------------------------
INSERT INTO `kredit` VALUES ('11', '2015-09-24', '37', 'asdasd', '123', 'asdasd', '292491_380770571987039_1244660777_n.jpg');

-- ----------------------------
-- Table structure for meta
-- ----------------------------
DROP TABLE IF EXISTS `meta`;
CREATE TABLE `meta` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT NULL,
  `key` varchar(8) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of meta
-- ----------------------------
INSERT INTO `meta` VALUES ('1', '1', 'debit', '1000');
INSERT INTO `meta` VALUES ('2', '2', 'kredit', '123');
INSERT INTO `meta` VALUES ('37', '3', 'taxJenis', 'agus');
