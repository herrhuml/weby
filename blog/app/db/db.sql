-- Adminer 4.7.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `content`, `created_at`) VALUES
(1,	3,	'herr',	'herr@gg.com',	'boží',	'2019-11-28 18:49:05'),
(2,	3,	'herr',	'herr@gg.com',	'boží',	'2019-11-28 18:49:32'),
(3,	1,	'herr',	'herr@gg.com',	'test',	'2019-11-28 18:49:46'),
(4,	3,	'pepa',	'',	'hahah',	'2019-11-28 18:58:56'),
(5,	1,	'kokotko33',	'kokotko33@kill.me',	'hehe',	'2019-11-28 20:13:03');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`) VALUES
(1,	'Article One',	'Lorem ipusm dolor one',	'2019-11-22 21:39:30'),
(2,	'Article Two',	'Lorem ipsum dolor two',	'2019-11-22 21:39:30'),
(3,	'Article Three',	'Lorem ipsum dolor three',	'2019-11-22 21:39:30');

-- 2019-11-28 21:29:22