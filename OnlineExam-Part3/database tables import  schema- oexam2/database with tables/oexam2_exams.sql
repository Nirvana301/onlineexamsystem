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
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `duration` double(8,2) NOT NULL,
  `total_grade` double(8,2) NOT NULL,
  `attempts_allowed` int(11) NOT NULL DEFAULT 1,
  `weight` int(11) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `course_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exams_created_by_foreign` (`created_by`),
  KEY `exams_course_id_foreign` (`course_id`),
  CONSTRAINT `exams_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `exams_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
INSERT INTO `exams` VALUES (1,'midterm1','2020-12-20 09:00:00',120.00,70.00,2,NULL,90005,NULL,NULL,1),(3,'midterm1','2020-06-06 08:45:00',100.00,100.00,2,NULL,90005,NULL,NULL,2),(4,'midterm3','2020-06-06 09:00:00',60.00,100.00,1,NULL,90005,NULL,NULL,2),(5,'midterm4-2','2019-05-20 07:45:00',60.00,75.00,2,NULL,90005,NULL,NULL,2),(6,'midterm2','2020-06-15 08:45:00',65.00,100.00,1,NULL,90005,NULL,NULL,1),(8,'midterm4','2020-09-09 13:00:00',150.00,110.00,2,NULL,90005,NULL,NULL,1),(9,'quiz2','2021-05-10 10:00:00',20.00,50.00,1,NULL,90005,NULL,NULL,1),(10,'quiz1','2020-05-10 08:00:00',50.00,100.00,1,NULL,90005,NULL,NULL,1),(11,'quiz1','2020-10-10 07:15:00',50.00,80.00,2,NULL,90005,NULL,NULL,2),(12,'quiz2','2020-06-15 13:00:00',15.00,60.00,1,NULL,90005,NULL,NULL,2),(13,'exam3','2020-10-10 14:00:00',120.00,100.00,2,NULL,90005,NULL,NULL,2),(14,'exam4','2020-12-12 15:00:00',100.00,100.00,1,NULL,90005,NULL,NULL,2),(15,'quiz3','2020-12-10 07:15:00',30.00,30.00,2,NULL,90005,NULL,NULL,1),(16,'quiz5','2020-10-10 08:00:00',20.00,20.00,1,5,90005,'2021-01-02 14:24:35','2021-01-02 14:24:35',1);
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
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
