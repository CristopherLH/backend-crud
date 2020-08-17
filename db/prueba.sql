/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : localhost:3306
 Source Schema         : prueba

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 17/08/2020 18:26:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for state
-- ----------------------------
DROP TABLE IF EXISTS `state`;
CREATE TABLE `state`  (
  `id_state` int NOT NULL AUTO_INCREMENT,
  `description_state` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_state`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of state
-- ----------------------------
INSERT INTO `state` VALUES (1, 'Activo');
INSERT INTO `state` VALUES (2, 'Bloqueado');
INSERT INTO `state` VALUES (3, 'Eliminado');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `name_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `last_name_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `state_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `login_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `date_created` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `date_updated` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Cristopher', 'Landeo', '1', 'clandeo', 'd7416380bea3deeffaa942591263d351', '2020-08-17 18:20:45', '2020-08-17 18:24:46');
INSERT INTO `user` VALUES (2, 'Michael', 'Huaman', '2', 'chuaman', 'e10adc3949ba59abbe56e057f20f883e', '2020-08-17 18:21:11', '2020-08-17 18:25:06');
INSERT INTO `user` VALUES (3, 'Sebastian', 'Marcos', '3', 'sebas25', '202cb962ac59075b964b07152d234b70', '2020-08-17 18:21:47', '2020-08-17 18:25:13');
INSERT INTO `user` VALUES (4, 'Alex', 'Martines', '1', 'martin25', '06d86297d6e28d4637d60c86c2a2f5b6', '2020-08-17 18:23:45', NULL);
INSERT INTO `user` VALUES (5, 'Sandra', 'Suarez', '1', 'suar25', '7c4121d27bf970f00f1dfdcee8f43a5d', '2020-08-17 18:24:13', NULL);

-- ----------------------------
-- Procedure structure for SP_GET_STATES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_GET_STATES`;
delimiter ;;
CREATE PROCEDURE `SP_GET_STATES`()
BEGIN
	select id_state, description_state from state;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_GET_USERS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_GET_USERS`;
delimiter ;;
CREATE PROCEDURE `SP_GET_USERS`(p_filter longtext, p_state_user TINYINT, p_opt tinyint)
BEGIN
	select id_user, name_user, last_name_user, state_user, login_user, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') date_created, DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') date_updated
	from `user`
	where if (p_opt = 1, state_user = p_state_user, name_user like concat('%', IFNULL(p_filter, ''), '%') or login_user like concat('%', IFNULL(p_filter,''), '%')) ;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_GET_USERS_ID
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_GET_USERS_ID`;
delimiter ;;
CREATE PROCEDURE `SP_GET_USERS_ID`(p_id_user int)
BEGIN
	select id_user, name_user, last_name_user, state_user, login_user
	from `user`
	where id_user = p_id_user;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_USERS_INSERT_UPDATE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_USERS_INSERT_UPDATE`;
delimiter ;;
CREATE PROCEDURE `SP_USERS_INSERT_UPDATE`(p_id_user int, p_name_user varchar(255), p_last_name_user varchar(255), p_login_user varchar(255), p_password_user varchar(255), p_state_user int)
BEGIN
	if isnull(p_id_user) then
		if exists(select login_user from `user` where login_user = p_login_user) then
			select 'warning' response, 'Login ya existe' message;
		else
			insert into `user` (name_user, last_name_user, login_user, password_user, state_user)
			values (p_name_user, p_last_name_user, p_login_user, MD5(p_password_user), p_state_user);
			select 'success' response, 'Registrado' message, LAST_INSERT_ID() id;
		end if;
	else
		if exists(select login_user from `user` where login_user = p_login_user and id_user != p_id_user) then
			select 'warning' response, 'Login ya existe' message;
		else
			update `user`
			set name_user = p_name_user,
					login_user = p_login_user,
					last_name_user = p_last_name_user,
					password_user = IFNULL(MD5(p_password_user), password_user),
					state_user = p_state_user
			where id_user = p_id_user;
			select 'success' response, 'Modificado' message, p_id_user id;
		end if;
	end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_USER_ACTIVE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_USER_ACTIVE`;
delimiter ;;
CREATE PROCEDURE `SP_USER_ACTIVE`(p_id_user int)
BEGIN
	#Routine body goes here...
		UPDATE `user` set state_user = 1
	WHERE id_user = p_id_user;
	select 'success' response, 'activado' message;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_USER_DELETE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_USER_DELETE`;
delimiter ;;
CREATE PROCEDURE `SP_USER_DELETE`(p_id_user int)
BEGIN
	#Routine body goes here...
	UPDATE `user` set state_user = 3 
	WHERE id_user = p_id_user;
	select 'success' response, 'eliminado' message;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
