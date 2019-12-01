SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `gallery`;
CREATE DATABASE `gallery` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci */;
USE `gallery`;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `comment` text COLLATE utf8_czech_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `comments` (`id`, `name`, `comment`, `date_added`) VALUES
(1,	'pepa',	'hola hoj kapitáne',	'2019-12-01 12:00:21'),
(2,	'karel',	'Paparapapa',	'2019-12-01 16:16:59'),
(3,	'Jiří Huml',	'funguje :)',	'2019-12-01 17:09:00'),
(4,	'Prokop Buben',	'o/',	'2019-12-01 17:25:44');

DROP TABLE IF EXISTS `pics`;
CREATE TABLE `pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumbnail_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `fullpic_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `pics` (`id`, `thumbnail_name`, `fullpic_name`, `caption`) VALUES
(1,	'wp-1.jpg',	'wp-1-thumb.jpg',	NULL),
(2,	'wp-2.jpg',	'wp-2-thumb.jpg',	NULL),
(3,	'wp-3.jpg',	'wp-3-thumb.jpg',	'Pirates of the Caribbean'),
(4,	'wp-4.jpg',	'wp-4-thumb.jpg',	'cyberpunk wallpaper'),
(5,	'wp-5.jpg',	'wp-5-thumb.jpg',	'Lucifer'),
(6,	'wp-6.jpg',	'wp-6-thumb.jpg',	NULL),
(7,	'wp-7.jpg',	'wp-7-thumb.jpg',	'the office wallpaper'),
(8,	'wp-8.jpg',	'wp-8-thumb.jpg',	'Stranger Things'),
(9,	'wp-9.jpg',	'wp-9-thumb.jpg',	NULL),
(10,	'wp-10.jpg',	'wp-10-thumb.jpg',	'Money Heist');