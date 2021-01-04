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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_type` enum('Text','MultipleChoice') COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_id` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `evaluation_grade` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `correct_answer` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_exam_id_foreign` (`exam_id`),
  KEY `questions_created_by_foreign` (`created_by`),
  CONSTRAINT `questions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (2,'alinin yaşı kaçtır?','Text',1,90005,40,'2021-01-02 17:20:02','2021-01-02 17:20:02',''),(3,'alinin yaşı kaçtır?','MultipleChoice',1,90005,40,'2021-01-02 18:33:26','2021-01-02 18:33:26',''),(4,'5+3','Text',1,90005,20,'2021-01-02 19:51:13','2021-01-02 19:51:13',''),(6,'5+7','Text',9,90005,10,'2021-01-02 19:59:51','2021-01-02 19:59:51',''),(7,'7+8','MultipleChoice',16,90005,10,'2021-01-02 20:12:50','2021-01-02 20:12:50','15'),(9,'5+5','MultipleChoice',16,90005,10,'2021-01-02 20:15:54','2021-01-02 20:15:54','10'),(10,'10+15','Text',15,90005,20,'2021-01-02 20:30:19','2021-01-02 20:30:19',NULL),(11,'10+15','Text',9,90005,15,'2021-01-02 20:31:30','2021-01-02 20:31:30',NULL),(12,'20+20','Text',15,90005,25,'2021-01-02 20:36:31','2021-01-02 20:36:31',NULL),(14,'35+40','MultipleChoice',9,90005,30,'2021-01-02 20:40:33','2021-01-02 20:40:33','75'),(15,'15+55','MultipleChoice',14,90005,45,'2021-01-02 20:42:46','2021-01-02 20:43:07','70'),(17,'100+150','MultipleChoice',4,90005,55,'2021-01-02 21:07:50','2021-01-02 21:07:50','250'),(19,'60+33','MultipleChoice',10,90005,53,'2021-01-02 21:11:02','2021-01-02 21:11:02','93'),(20,'90+10','MultipleChoice',15,90005,55,'2021-01-02 21:12:30','2021-01-02 21:12:30','100'),(21,'50+10/2','MultipleChoice',15,90005,15,'2021-01-02 21:14:36','2021-01-02 21:14:36','55'),(22,'43+88','MultipleChoice',12,90005,15,'2021-01-02 21:15:46','2021-01-02 21:15:46','131'),(23,'75+80','MultipleChoice',12,90005,25,'2021-01-02 21:16:35','2021-01-03 15:05:28','155'),(24,'10+15','MultipleChoice',8,90005,25,'2021-01-02 21:34:36','2021-01-03 17:07:10','25'),(25,'20+33','MultipleChoice',13,90005,20,'2021-01-02 21:35:20','2021-01-02 21:35:20','53'),(26,'20+25','MultipleChoice',10,90005,15,'2021-01-02 21:40:02','2021-01-02 21:40:02','45'),(27,'20+20','MultipleChoice',5,90005,15,'2021-01-02 21:41:14','2021-01-02 21:41:14','40'),(28,'100+100','MultipleChoice',15,90005,20,'2021-01-02 21:48:25','2021-01-02 21:48:25','200'),(29,'100+200','MultipleChoice',15,90005,50,'2021-01-02 21:50:37','2021-01-02 21:50:37','300'),(30,'60+30','MultipleChoice',12,90005,15,'2021-01-02 21:52:50','2021-01-02 21:52:50','90'),(31,'50x30','MultipleChoice',8,90005,35,'2021-01-02 22:11:21','2021-01-03 15:51:35','1500'),(33,'20+30','Text',1,90005,30,'2021-01-03 14:31:30','2021-01-03 14:31:39',NULL),(34,'15+30','Text',8,90005,30,'2021-01-03 15:54:24','2021-01-03 15:54:41',NULL);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-04  0:02:41
