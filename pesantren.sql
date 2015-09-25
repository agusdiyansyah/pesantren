/*
Navicat MySQL Data Transfer

Source Server         : data
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : pesantren

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-09-26 00:48:05
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of meta
-- ----------------------------
INSERT INTO `meta` VALUES ('1', '1', 'debit', '220');
INSERT INTO `meta` VALUES ('2', '2', 'kredit', '50');
INSERT INTO `meta` VALUES ('37', '3', 'taxJenis', 'agus');
INSERT INTO `meta` VALUES ('38', '3', 'taxJenis', 'kredit');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` smallint(6) DEFAULT '0',
  `type` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `jml` varchar(20) DEFAULT NULL,
  `memo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES ('1', '0', '1', '2015-09-01', 'debit 1', '100', '-');
INSERT INTO `transaksi` VALUES ('3', '37', '2', '2015-09-04', 'kredit 1', '20', '{\"file\":\"292491_380770571987039_1244660777_n.jpg\",\"memo\":\"memo\"}');
INSERT INTO `transaksi` VALUES ('6', '0', '1', '2015-09-01', 'debit tanggal 1', '100', '-');
INSERT INTO `transaksi` VALUES ('7', '0', '1', '2015-09-11', 'debit tanggal sebellas', '20', '-');
INSERT INTO `transaksi` VALUES ('8', '38', '2', '2015-09-25', 'kredit', '20', '{\"file\":\"26471212.jpg\",\"memo\":\"memo\"}');
INSERT INTO `transaksi` VALUES ('9', '38', '2', '2015-09-25', 'aksoako', '10', '{\"file\":\"abim.jpg\",\"memo\":\"-\"}');
