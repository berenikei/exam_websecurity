-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: lifehack
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (3,'home','tricks for home'),(4,'office','tricks');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `topic_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'I will show how to hack nasa with HTML','2019-05-09 18:20:22','0000-00-00 00:00:00',1,7),(2,'Here is another comment lol','2019-05-09 18:20:25','0000-00-00 00:00:00',1,7),(3,'Here is another comment lol','2019-05-10 11:57:02','0000-00-00 00:00:00',25,7),(4,'Here is another comment lol','2019-05-09 18:20:25','0000-00-00 00:00:00',34,7),(5,'Here is another comment lol','2019-05-09 18:20:25','0000-00-00 00:00:00',34,7),(6,'Here is another comment lol','2019-05-09 18:20:25','0000-00-00 00:00:00',34,7),(7,'Here is another comment lol','2019-05-09 18:20:25','0000-00-00 00:00:00',34,7),(8,'Here is another comment lol','2019-05-09 18:20:25','0000-00-00 00:00:00',34,7),(9,'Here is another comment lol','2019-05-09 18:20:25','0000-00-00 00:00:00',34,7);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `topic_name` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT '2019-05-28 16:13:47',
  `category_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `featured_image_url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (1,'HACK NASA WITH HTML','2019-05-09 18:19:35','0000-00-00 00:00:00',4,7,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip\r\n',NULL),(8,'Don\'t Hack NASA','2019-05-09 18:19:35','0000-00-00 00:00:00',3,7,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip\r\n',NULL),(9,'V2 HACK NASA WITH HTML','2019-05-09 18:19:35','0000-00-00 00:00:00',4,7,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip\r\n',NULL),(25,'Test Topic','2019-05-10 09:49:53','0000-00-00 00:00:00',3,7,'Test Topic Test Topic Test Topic Test Topic Test Topic',NULL),(34,'ha ha ha ha','2019-05-10 10:38:54','0000-00-00 00:00:00',3,7,'ha he hu ha',NULL),(51,'testing markdown','2019-05-21 11:56:00','0000-00-00 00:00:00',3,7,'This text will appear in the editor',NULL),(52,'eeerqqdqw','2019-05-21 12:07:58','0000-00-00 00:00:00',3,7,'dasdasdas das das das da sda s',NULL),(53,'test topic','2019-05-21 12:28:32','0000-00-00 00:00:00',3,7,'This text will appear in the editor',NULL),(54,'TEST TEST TEST','2019-06-01 22:07:06','0000-00-00 00:00:00',3,7,'HOW COOL IS THAT FREAKING OPTION, BRUH? \n                    > This post has been edited by a moderator michal','featured-5cf0151238cb1.jpg'),(55,'testing markdown','2019-05-21 12:35:04','0000-00-00 00:00:00',3,7,'# This text will appear in the editor\n\n**should be bold**\n*should be italic*\n* heheh\n* dasda\n1.  one\n2.  two\n3.  three',NULL),(56,'testing','2019-05-21 12:46:31','0000-00-00 00:00:00',4,7,'Heeeey ! What\'s going on?',NULL),(57,'Xiaomi Mi Pad 4 Fastboot instructions (edit)','2019-05-26 09:08:34','0000-00-00 00:00:00',3,32,'# This is a new content :D',NULL),(58,'Sample image','2019-05-28 19:00:35','2019-05-28 19:00:35',3,32,'Write down your thoughts here... We support markdown syntax here.','mydrtvstructure.jpeg'),(59,'testing image','2019-05-28 19:02:13','2019-05-28 19:02:13',3,32,'Write down your thoughts here... We support markdown syntax here.','mydrtvstructure.jpeg'),(60,'sample here','2019-05-28 19:02:51','2019-05-28 19:02:51',3,32,'Write down your thoughts here... We support markdown syntax here.','mydrtvstructure.jpeg'),(61,'sample here','2019-05-28 19:05:42','2019-05-28 19:05:42',3,32,'Write down your thoughts here... We support markdown syntax here.','mydrtvstructure.jpeg'),(62,'dddddddd','2019-06-01 21:02:27','2019-05-28 19:08:07',3,32,'Write down your thoughts here... We support markdown syntax here.j','hack.php'),(63,'nfdjfdjfidjidfgdifgifdjglfdng','2019-05-30 17:38:26','2019-05-30 17:36:51',3,32,'Write down your thoughts here... We support markdown syntax here.','featured-5cf0151238cb1.jpg'),(64,'I love my grandpa','2019-05-31 15:05:41','2019-05-31 15:05:28',3,32,'# Story of my grandmother\nI love her and I think everyone should celebrate that, don\'t you think?','featured-5cf142b8d16f6.jpg'),(65,'Sample XSS attack ','2019-06-01 19:51:21','2019-06-01 19:50:08',3,32,'[XSS](javascript:alert%28sessionStorage.clear%28%29%29)','default.png'),(66,'I love my grandpa','2019-06-02 20:24:45','2019-06-02 20:24:31',3,38,'	djfhdjfhdkjhdjkfhsjkdhfj','default.png'),(67,'Test Test Test - ok NOT','2019-06-02 20:26:04','2019-06-02 20:26:04',3,38,'		Write down your thoughts here... We support markdown syntax here.','default.png');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_role` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (4,'user'),(5,'moderator'),(6,'admin');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password_hashed` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `date_createad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_role_id` bigint(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `activation_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID` (`id`),
  KEY `user_role_id` (`user_role_id`),
  CONSTRAINT `users_ibfk_3` FOREIGN KEY (`user_role_id`) REFERENCES `user_roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'peter','$2y$10$3W69JMBZXmjOiub6ol4m/.0uCDMbuUgu8gXJqpzeUwbBrXjJwLHQe','AKER@a.com','2019-05-30 18:17:24',4,1,''),(32,'michal','$2y$10$Dj2Oae9HsvqIOZs7c1ZQcOQzliOmyifvqyoqjBSTkAFOwvWtz1Ely','email@email.pl','2019-06-03 01:31:57',5,1,''),(33,'michal2','$2y$10$5dFJNDTiKoZfoJh175y2bO/QPYus5eqEEqh1WSUymW5f0hOPLpa/q','michal2@michal2.pl','2019-05-30 18:17:24',4,1,'b1781bdefd68f9d45d7fb73ef1490ca8'),(34,'michal3','$2y$10$zNJzCdn680ftgTDgsViLZuagpAa3WJnPeh6hsHlYU7DjDAlmx0P2u','michal3@michal.pl','2019-05-31 22:17:40',4,1,'493bc7cbc2fe90fcd28bf20f5e704f3a'),(35,'michal34','$2y$10$MFb7u8xvblTHOhHtcR/U1OrOggdr9M6yhN9eqm1b0RaSrumLtftWa','michal3@michal.pl.pl','2019-05-31 22:19:39',4,1,'c5c95b58812a1f83f385d8c96257224d'),(36,'newuser','$2y$10$WJckJKTk80SGbYEouXAYR.BRBbUqGp50xTOhjxypVsrA234p3UAm.','newuser@user.pl','2019-05-31 22:33:22',4,1,'a9b26d1c41874bc87328834a9cbf420a'),(38,'admin','$2y$10$2/4/5VpIvzGBv7nD9sE.perYDizOaMEpc25jsOT/SxyuVKKIL1D/.','sample@sample.pl','2019-06-02 18:21:05',6,1,'0ed87f84d1c8363e18bb1c3e4a6fa511');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'lifehack'
--
/*!50003 DROP PROCEDURE IF EXISTS `create_topic` */;
ALTER DATABASE `lifehack` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_topic`(IN `topic_name` VARCHAR(50) CHARSET utf8mb4, IN `category_id` BIGINT, IN `user_id` BIGINT, IN `content` TEXT CHARSET utf8mb4)
    NO SQL
INSERT INTO `topics`(`id`, `topic_name`, `date_created`, `category_id`, `user_id`, `content`) VALUES (NULL,topic_name,NULL,category_id,user_id,content) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `lifehack` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
/*!50003 DROP PROCEDURE IF EXISTS `get_comments_for_the_topic` */;
ALTER DATABASE `lifehack` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_comments_for_the_topic`(IN `topic` INT, IN `page_offset` INT)
    NO SQL
SELECT comments.content, comments.date_created, users.username
FROM `comments`
JOIN users ON comments.user_id = users.id
WHERE topic_id = topic
ORDER BY comments.date_created ASC
LIMIT 5 OFFSET page_offset ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `lifehack` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
/*!50003 DROP PROCEDURE IF EXISTS `get_number_of_comments` */;
ALTER DATABASE `lifehack` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_number_of_comments`(IN `topic` INT)
    NO SQL
SELECT COUNT(comments.id) AS totalComments
FROM `comments`JOIN users ON comments.user_id = users.id
WHERE topic_id = topic ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `lifehack` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
/*!50003 DROP PROCEDURE IF EXISTS `get_topics_from_category` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_topics_from_category`(IN wanted_category_id int)
SELECT topics.*, categories.category_name, categories.category_description, users.username
FROM topics
INNER JOIN categories ON topics.category_id=categories.id INNER JOIN users ON topics.user_id = users.id WHERE topics.category_id = wanted_category_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_topic_by_id` */;
ALTER DATABASE `lifehack` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_topic_by_id`(IN topic_id int unsigned)
SELECT topics.id, topics.topic_name, topics.date_created, topics.user_id, topics.featured_image_url , users.username, categories.category_name, categories.id AS category_id, topics.content, COUNT(comments.id) AS comments
FROM topics
JOIN users ON topics.user_id = users.id
JOIN categories ON topics.category_id = categories.id
JOIN comments ON comments.topic_id = topics.id
WHERE topics.id = topic_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `lifehack` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-03  3:33:24
