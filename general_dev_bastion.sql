/*
 Navicat Premium Data Transfer

 Source Server         : bastionLLC
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : eschborn.lysithea.dreamhost.com:3306
 Source Schema         : general_dev_bastion

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 01/01/2021 14:29:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contactChannels
-- ----------------------------
DROP TABLE IF EXISTS `contactChannels`;
CREATE TABLE `contactChannels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personId` int(11) NOT NULL,
  `channelName` varchar(255) NOT NULL,
  `channelValue` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for contactHistory
-- ----------------------------
DROP TABLE IF EXISTS `contactHistory`;
CREATE TABLE `contactHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `targetPersonId` int(11) NOT NULL,
  `originPersonId` int(11) NOT NULL,
  `contactDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for EventListing
-- ----------------------------
DROP TABLE IF EXISTS `EventListing`;
CREATE TABLE `EventListing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personId` int(11) NOT NULL,
  `EventListing` varchar(450) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for lastContacted
-- ----------------------------
DROP TABLE IF EXISTS `lastContacted`;
CREATE TABLE `lastContacted` (
  `id` int(11) NOT NULL,
  `targetPersonId` int(11) NOT NULL,
  `originPersonId` int(11) NOT NULL,
  `lastContactedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for messageSynopsis
-- ----------------------------
DROP TABLE IF EXISTS `messageSynopsis`;
CREATE TABLE `messageSynopsis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personId` int(11) NOT NULL,
  `messageSynopsis` varchar(450) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for people
-- ----------------------------
DROP TABLE IF EXISTS `people`;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `possessingUserId` int(11) NOT NULL DEFAULT '44',
  PRIMARY KEY (`id`),
  UNIQUE KEY `people_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10011 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for personType
-- ----------------------------
DROP TABLE IF EXISTS `personType`;
CREATE TABLE `personType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personId` int(11) NOT NULL,
  `typeName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `pw_hash` varchar(254) DEFAULT NULL,
  `username` varchar(254) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `organizatio` int(11) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `sessionID` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Triggers structure for table lastContacted
-- ----------------------------
DROP TRIGGER IF EXISTS `lastContacted`;
delimiter ;;
CREATE TRIGGER `lastContacted` BEFORE UPDATE ON `lastContacted` FOR EACH ROW begin
insert into general_dev_bastion.contactHistory(targetPersonId, originPersonId, contactDate) 
values (old.targetPersonId, old.originPersonId, old.lastContactedDate);
end
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
