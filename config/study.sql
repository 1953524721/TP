/*
 Navicat Premium Data Transfer

 Source Server         : mysql8.0
 Source Server Type    : MySQL
 Source Server Version : 80016
 Source Host           : 127.0.0.1:3306
 Source Schema         : study

 Target Server Type    : MySQL
 Target Server Version : 80016
 File Encoding         : 65001

 Date: 30/05/2019 21:11:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for browse
-- ----------------------------
DROP TABLE IF EXISTS `browse`;
CREATE TABLE `browse`  (
  `browse_id` int(11) NOT NULL AUTO_INCREMENT,
  `browse_ip` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ip地址',
  `browse_time` datetime(0) NULL DEFAULT NULL COMMENT '访问时间',
  `browse_name` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '浏览器内核',
  `browse_city` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '城市',
  PRIMARY KEY (`browse_id`) USING BTREE,
  UNIQUE INDEX `browse_id`(`browse_id`, `browse_ip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1130 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '浏览量' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of browse
-- ----------------------------

INSERT INTO `browse` VALUES (1, '127.0.0.1', '2019-05-30 21:07:12', NULL, 'XXXX内网IP内网IP');
INSERT INTO `browse` VALUES (2, '127.0.0.1', '2019-05-30 21:07:29', NULL, 'XXXX内网IP内网IP');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `user_pwd` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `user_status` tinyint(1) NULL DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', '46f94c8de14fb36680850768ff1b7f2a', 1);
INSERT INTO `user` VALUES (2, 'ceshi', 'ceshi', 1);

-- ----------------------------
-- Table structure for user_log
-- ----------------------------
DROP TABLE IF EXISTS `user_log`;
CREATE TABLE `user_log`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户',
  `user_city` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '城市',
  `user_ip` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'IP',
  `user_time` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '时间',
  `user_chrome` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '浏览器',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_log
-- ----------------------------
INSERT INTO `user_log` VALUES (1, 1, '1', '1', '1', '1');

SET FOREIGN_KEY_CHECKS = 1;
