/*
 Navicat Premium Data Transfer

 Source Server         : 121.40.203.96
 Source Server Type    : MySQL
 Source Server Version : 50537
 Source Host           : 121.40.203.96:3306
 Source Schema         : rbac

 Target Server Type    : MySQL
 Target Server Version : 50537
 File Encoding         : 65001

 Date: 23/01/2019 16:50:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_permission
-- ----------------------------
DROP TABLE IF EXISTS `admin_permission`;
CREATE TABLE `admin_permission`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限名称',
  `permission_menu_id` int(32) NOT NULL COMMENT '权限菜单id',
  `action_url` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_permission
-- ----------------------------
INSERT INTO `admin_permission` VALUES (4, '权限组', 3, 'permission/group', '0000-00-00 00:00:00', '2019-01-23 14:39:01', 1);
INSERT INTO `admin_permission` VALUES (5, '添加', 3, 'permission/create', '0000-00-00 00:00:00', '2019-01-23 14:39:09', 1);
INSERT INTO `admin_permission` VALUES (6, '删除', 3, 'permission/delete', '0000-00-00 00:00:00', '2019-01-23 14:39:16', 1);
INSERT INTO `admin_permission` VALUES (7, '编辑', 3, 'permission/update', '0000-00-00 00:00:00', '2019-01-23 14:39:21', 1);
INSERT INTO `admin_permission` VALUES (8, '列表', 3, 'permission/index', '0000-00-00 00:00:00', '2019-01-23 14:39:26', 1);
INSERT INTO `admin_permission` VALUES (10, '编辑', 1, 'user/update', '0000-00-00 00:00:00', '2019-01-23 14:38:51', 1);
INSERT INTO `admin_permission` VALUES (11, '添加', 1, 'user/create', '0000-00-00 00:00:00', '2019-01-23 14:38:48', 1);
INSERT INTO `admin_permission` VALUES (12, '锁定', 1, 'role/toggle', '0000-00-00 00:00:00', '2019-01-23 14:38:46', 1);
INSERT INTO `admin_permission` VALUES (13, '列表', 2, 'role/index', '0000-00-00 00:00:00', '2019-01-23 14:38:41', 1);
INSERT INTO `admin_permission` VALUES (14, '添加', 2, 'role/create', '0000-00-00 00:00:00', '2019-01-23 14:38:44', 1);
INSERT INTO `admin_permission` VALUES (15, '编辑', 2, 'role/update', '0000-00-00 00:00:00', '2019-01-23 14:38:37', 1);
INSERT INTO `admin_permission` VALUES (16, '锁定', 2, 'role/toggle', '0000-00-00 00:00:00', '2019-01-23 14:38:34', 1);
INSERT INTO `admin_permission` VALUES (17, '列表', 4, 'permission_menu/index', '0000-00-00 00:00:00', '2019-01-23 14:38:31', 1);
INSERT INTO `admin_permission` VALUES (18, '添加', 4, 'permission_menu/create', '0000-00-00 00:00:00', '2019-01-23 14:38:29', 1);
INSERT INTO `admin_permission` VALUES (19, '编辑', 4, 'permission_menu/update', '0000-00-00 00:00:00', '2019-01-23 14:38:24', 1);

-- ----------------------------
-- Table structure for admin_permission_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_permission_menu`;
CREATE TABLE `admin_permission_menu`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '权限菜单表',
  `permission_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '唯一标识',
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '菜单名称',
  `desc` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '菜单说明',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `status` tinyint(2) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_permission_menu
-- ----------------------------
INSERT INTO `admin_permission_menu` VALUES (1, 'super_admin', '管理员管理', '权限管理', '2019-01-21 13:03:24', '2019-01-23 11:31:22', 1);
INSERT INTO `admin_permission_menu` VALUES (2, 'admin_role', '角色管理', '权限管理', '2019-01-21 13:03:24', '2019-01-21 13:03:28', 1);
INSERT INTO `admin_permission_menu` VALUES (3, 'admin_permission', '权限管理', '权限管理', '2019-01-21 13:05:56', '2019-01-23 11:13:37', 1);
INSERT INTO `admin_permission_menu` VALUES (4, 'admin_permission_menu', '权限菜单组', '权限管理', '2019-01-21 13:09:11', '2019-01-23 11:36:56', 1);
INSERT INTO `admin_permission_menu` VALUES (12, 'user_manager', '用户管理', NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色名',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '该记录是否有效1：有效、0：无效',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `desc` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES (1, '管理员', 1, '2019-01-21 12:38:49', '2019-01-23 12:08:56', '拥有所有权限');
INSERT INTO `admin_role` VALUES (2, '测试22', 1, '0000-00-00 00:00:00', '2019-01-23 16:39:51', NULL);
INSERT INTO `admin_role` VALUES (3, '运营组', 1, '0000-00-00 00:00:00', '2019-01-23 16:39:58', NULL);
INSERT INTO `admin_role` VALUES (4, 'bbb', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- ----------------------------
-- Table structure for admin_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permission`;
CREATE TABLE `admin_role_permission`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `permission_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_role_permission
-- ----------------------------
INSERT INTO `admin_role_permission` VALUES (8, 1, '4', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (9, 1, '13', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (10, 1, '9', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (11, 1, '10', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (12, 1, '11', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (13, 1, '12', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (14, 1, '16', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (15, 1, '15', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (16, 1, '14', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (17, 1, '5', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (18, 1, '6', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (19, 1, '7', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (20, 1, '8', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (21, 1, '18', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (22, 1, '17', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (23, 1, '19', '2019-01-23 12:08:56', '2019-01-23 12:08:56');
INSERT INTO `admin_role_permission` VALUES (24, 3, '9', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (25, 3, '10', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (26, 3, '12', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (27, 3, '11', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (28, 3, '14', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (29, 3, '13', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (30, 3, '4', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (31, 3, '17', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (32, 3, '5', '2019-01-23 16:39:58', '2019-01-23 16:39:58');
INSERT INTO `admin_role_permission` VALUES (33, 3, '18', '2019-01-23 16:39:58', '2019-01-23 16:39:58');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `mail` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否为超级管理员1:是、0:否，默认不是',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '该条记录是否有效1:有效、0：无效',
  `created_at` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime NULL DEFAULT NULL COMMENT '更新时间',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `api_token` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `role_id` int(6) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES (1, 'admin', '', 0, 2, '2019-01-21 17:12:50', '2019-01-23 16:40:30', '0192023a7bbd73250516f069df18b500', '29071040853f1563cd7d54e23e82af2d', 1);
INSERT INTO `admin_user` VALUES (2, 'admin1', '', 0, 2, '2019-01-21 17:12:52', '2019-01-23 16:40:28', 'e00cf25ad42683b3df678c61f42c6bda', 'd9c3d5ab50b9f7fef1c58d20eb704fb3', 2);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mobile` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(2) NULL DEFAULT 1,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `login_at` datetime NULL DEFAULT NULL,
  `login_ip` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'fengshuang', '12121212', '18515019527', 1, '2019-01-23 14:47:43', '2019-01-23 14:47:46', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
