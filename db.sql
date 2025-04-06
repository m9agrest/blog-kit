-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.4.21-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных blog
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blog`;

-- Дамп структуры для таблица blog.like
CREATE TABLE IF NOT EXISTS `like` (
  `post` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  UNIQUE KEY `post_user` (`post`,`user`),
  KEY `post` (`post`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица blog.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `answer` int(11) NOT NULL DEFAULT 0,
  `text` text COLLATE armscii8_bin DEFAULT NULL,
  `photo` tinytext COLLATE armscii8_bin DEFAULT NULL,
  `date` int(11) NOT NULL DEFAULT unix_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица blog.sub
CREATE TABLE IF NOT EXISTS `sub` (
  `user1` int(11) NOT NULL COMMENT 'кто подписан',
  `user2` int(11) NOT NULL COMMENT 'на кого подписан',
  UNIQUE KEY `user1_user2` (`user1`,`user2`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица blog.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE armscii8_bin NOT NULL,
  `photo` tinytext COLLATE armscii8_bin DEFAULT NULL,
  `email` tinytext COLLATE armscii8_bin NOT NULL,
  `password` tinytext COLLATE armscii8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Экспортируемые данные не выделены.

-- Дамп структуры для представление blog.v_post
-- Создание временной таблицы для обработки ошибок зависимостей представлений
CREATE TABLE `v_post` (
	`id` INT(11) NOT NULL,
	`user` INT(11) NOT NULL,
	`answer` INT(11) NOT NULL,
	`text` TEXT NULL COLLATE 'armscii8_bin',
	`photo` TINYTEXT NULL COLLATE 'armscii8_bin',
	`date` INT(11) NOT NULL,
	`comment` BIGINT(21) NOT NULL,
	`like` BIGINT(21) NOT NULL,
	`user_id` INT(11) NULL,
	`user_name` TINYTEXT NULL COLLATE 'armscii8_bin',
	`user_photo` TINYTEXT NULL COLLATE 'armscii8_bin'
) ENGINE=MyISAM;

-- Дамп структуры для представление blog.v_post_2
-- Создание временной таблицы для обработки ошибок зависимостей представлений
CREATE TABLE `v_post_2` (
	`id` INT(11) NOT NULL,
	`user` INT(11) NOT NULL,
	`answer` INT(11) NOT NULL,
	`text` TEXT NULL COLLATE 'armscii8_bin',
	`photo` TINYTEXT NULL COLLATE 'armscii8_bin',
	`date` INT(11) NOT NULL,
	`comment` BIGINT(21) NOT NULL,
	`like` BIGINT(21) NOT NULL,
	`user_id` INT(11) NULL,
	`user_name` TINYTEXT NULL COLLATE 'armscii8_bin',
	`user_photo` TINYTEXT NULL COLLATE 'armscii8_bin',
	`liker` INT(11) NULL
) ENGINE=MyISAM;

-- Дамп структуры для представление blog.v_user
-- Создание временной таблицы для обработки ошибок зависимостей представлений
CREATE TABLE `v_user` (
	`id` INT(11) NOT NULL,
	`name` TINYTEXT NOT NULL COLLATE 'armscii8_bin',
	`photo` TINYTEXT NULL COLLATE 'armscii8_bin',
	`email` TINYTEXT NOT NULL COLLATE 'armscii8_bin',
	`password` TINYTEXT NOT NULL COLLATE 'armscii8_bin',
	`sub` BIGINT(21) NOT NULL,
	`post` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Удаление временной таблицы и создание окончательной структуры представления
DROP TABLE IF EXISTS `v_post`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_post` AS SELECT p.*,
       COUNT(DISTINCT p2.id)  AS `comment`,  -- Считаем количество комментариев
       COUNT(DISTINCT l.user) AS `like`,     -- Считаем количество лайков
       u.id                   AS user_id,
       u.`name`               AS user_name,
       u.photo                AS user_photo
FROM      post   AS p
LEFT JOIN `user` AS u  ON u.id = p.`user`   -- Объединяем посты с пользователями
LEFT JOIN post   AS p2 ON p2.answer = p.id  -- Объединяем посты с комментариями (где p2 является ответом на p)
LEFT JOIN `like` AS l  ON l.post = p.id     -- Объединяем посты с лайками
GROUP BY p.id ; ;

-- Удаление временной таблицы и создание окончательной структуры представления
DROP TABLE IF EXISTS `v_post_2`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_post_2` AS SELECT p.*,
       l.`user` AS liker
FROM      v_post AS p
LEFT JOIN `like` AS l ON p.id = l.post

UNION

SELECT p2.*, NULL AS liker FROM v_post AS p2

ORDER BY liker DESC ; ;

-- Удаление временной таблицы и создание окончательной структуры представления
DROP TABLE IF EXISTS `v_user`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_user` AS SELECT u.*, 
       COUNT(DISTINCT s.user1) AS sub, -- Считаем количество подписчиков
       COUNT(DISTINCT p.id)    AS post -- Считаем количество постов
FROM     `user` AS u
LEFT JOIN sub   AS s ON s.user2 = u.id
LEFT JOIN post  AS p ON p.`user` = u.id 
GROUP BY u.id ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
