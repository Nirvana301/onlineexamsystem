-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: oexam2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `multiple_choice_submissions`
--

DROP TABLE IF EXISTS `multiple_choice_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `multiple_choice_submissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `answer_value` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_by` bigint(20) unsigned NOT NULL,
  `question_id` bigint(20) unsigned NOT NULL,
  `is_graded` tinyint(1) NOT NULL DEFAULT 0,
  `grade` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `multiple_choice_submissions_question_id_foreign` (`question_id`),
  KEY `multiple_choice_submissions_given_by_foreign` (`given_by`),
  CONSTRAINT `multiple_choice_submissions_given_by_foreign` FOREIGN KEY (`given_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `multiple_choice_submissions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multiple_choice_submissions`
--

LOCK TABLES `multiple_choice_submissions` WRITE;
/*!40000 ALTER TABLE `multiple_choice_submissions` DISABLE KEYS */;
INSERT INTO `multiple_choice_submissions` VALUES (9,'b)',20003,49,1,35.00,'2021-01-10 15:53:26','2021-01-10 15:53:26'),(10,'a)',20003,51,1,0.00,'2021-01-10 15:53:26','2021-01-10 15:53:26'),(11,'b',20003,55,1,50.00,'2021-01-10 16:18:42','2021-01-10 16:18:42'),(12,'a',20003,61,1,0.00,'2021-01-10 16:49:28','2021-01-10 16:49:28'),(13,'a',20003,59,1,50.00,'2021-01-10 16:49:59','2021-01-10 16:49:59'),(14,'b',20003,63,1,30.00,'2021-01-10 17:33:16','2021-01-10 17:33:16'),(15,'b',20003,64,1,0.00,'2021-01-10 17:33:16','2021-01-10 17:33:16'),(16,'b',20003,68,1,50.00,'2021-01-11 13:12:50','2021-01-11 13:12:50'),(17,'b',20003,69,1,50.00,'2021-01-30 20:03:55','2021-01-30 20:03:55'),(18,'b',20003,69,1,50.00,'2021-01-30 20:06:53','2021-01-30 20:06:53'),(19,'a',20003,77,0,NULL,'2021-01-31 23:38:17','2021-01-31 23:38:17'),(20,'b)',20003,97,1,50.00,'2021-02-02 18:58:31','2021-02-02 18:58:31'),(21,'b',20003,103,1,30.00,'2021-02-02 21:56:34','2021-02-02 21:56:34'),(22,'b',20003,103,1,30.00,'2021-02-02 21:56:44','2021-02-02 21:56:44'),(23,'c',20003,106,1,50.00,'2021-02-03 10:40:44','2021-02-03 10:40:44'),(24,'b',20003,113,1,50.00,'2021-02-03 14:07:49','2021-02-03 14:07:49'),(25,'b',20003,113,1,50.00,'2021-02-03 14:07:58','2021-02-03 14:07:58'),(26,'d',20003,115,1,50.00,'2021-02-03 14:23:56','2021-02-03 14:23:56'),(27,'d',20003,115,1,50.00,'2021-02-03 14:24:03','2021-02-03 14:24:03'),(28,'a',20003,118,1,0.00,'2021-02-03 16:53:48','2021-02-03 16:53:48'),(31,'b',20003,122,1,40.00,'2021-02-03 17:18:21','2021-02-03 17:18:21'),(32,'b',20003,122,1,40.00,'2021-02-03 17:18:27','2021-02-03 17:18:27');
/*!40000 ALTER TABLE `multiple_choice_submissions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-03 20:28:37
