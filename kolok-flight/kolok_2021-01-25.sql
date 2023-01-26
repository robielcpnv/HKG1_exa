# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.5.5-10.1.14-MariaDB)
# Base de données: kolok
# Temps de génération: 2018-01-25 22:23:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table offer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `offer`;

CREATE TABLE `offer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `published_on` date NOT NULL,
  `available_on` date NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(1023) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;

INSERT INTO `offer` (`id`, `published_on`, `available_on`, `address`, `description`, `author_id`)
VALUES
	(1,'2018-01-24','2018-01-20','Rue du Midi 10','SuperCool',2),
	(2,'2018-01-23','2018-03-01','La Bas - en bas','wiejf iwfh owirfhj oierh ioerh oierh goier hgioerh gioerh ioer hgioer hgoier hgioer hgioer hgioer hgioer hgioerh oier',1),
	(10,'2018-01-25','2018-02-04','Au fond à gauche','aa',1);

/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(63) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `name`, `password`, `email`)
VALUES
	(1,'jack','Jack Palance','$2y$10$r4b49m2H5VU6IAhhiWuQweJWdKxX5HPjGE0NTnrOe0RX1bw7X35OK','jack.palance@example.com'),
	(2,'joe','Joe Dalton','$2y$10$JADalstjdJOSdWUgXJQ45.qXLiejWtvpOKz5mpWol6yAGYJ.FjTIO','joe@dalton.com'),
	(7,'willy','William','$2y$10$/2A4zxUewtYlkim4tEWUq.t1/4ZdKu5nT4C1q5FaiPJJY1v6o1h.C','willy@dalton.com');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table star
# ------------------------------------------------------------

DROP TABLE IF EXISTS `star`;

CREATE TABLE `star` (
  `user_id` int(11) unsigned NOT NULL,
  `offer_id` int(11) unsigned NOT NULL,
  `count` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `star` WRITE;
/*!40000 ALTER TABLE `star` DISABLE KEYS */;

INSERT INTO `star` (`user_id`, `offer_id`, `count`)
VALUES
	(2,1,'5'),
	(7,10,'1'),
	(1,1,'3');

/*!40000 ALTER TABLE `star` ENABLE KEYS */;
UNLOCK TABLES;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
