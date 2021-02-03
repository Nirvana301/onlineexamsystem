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
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `given_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assistant_id` bigint(20) unsigned NOT NULL DEFAULT 2,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_course_name_unique` (`course_name`),
  KEY `courses_given_by_foreign` (`given_by`),
  KEY `courses_assistant_id_foreign` (`assistant_id`),
  CONSTRAINT `courses_assistant_id_foreign` FOREIGN KEY (`assistant_id`) REFERENCES `users` (`id`),
  CONSTRAINT `courses_given_by_foreign` FOREIGN KEY (`given_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'CSE312 (Analysis of Algorithms)',90005,NULL,NULL,80010),(2,'SE301 (Software Engineering)',90005,NULL,NULL,80010),(3,'CSE111 (Introduction to Java)',90009,NULL,NULL,80002),(4,'CSE202 (Data Structures & Algorithms)',90005,NULL,NULL,80010),(5,'CSE007 (Computer Engineering Orientation)',90005,NULL,NULL,80002),(6,'HSS100 (Ethics & Society I)',90003,NULL,NULL,80009),(7,'HSS101 (Ethics & Society II)',90003,NULL,NULL,80009),(8,'HSS200 (Professional Ethics I)',90003,NULL,NULL,80009),(9,'HSS201 (Professional Ethics II)',90003,NULL,NULL,80009),(10,'CE101 (Construction Engineering)',90004,NULL,NULL,80001),(11,'CE202 (Water resources Engineering)',90004,NULL,NULL,80001),(12,'CE341 (Environmental Engineering)',90004,NULL,NULL,80001),(13,'CE352 (Irrigation Engineering)',90004,NULL,NULL,80001),(14,'CE404 (Materials Engineering)',90004,NULL,NULL,80001),(15,'LA100 (Landscape Architecture I)',90006,NULL,NULL,80004),(16,'LA101 (Landscape Architecture II)',90006,NULL,NULL,80004),(17,'LA200 (Landscape Design I)',90006,NULL,NULL,80004),(18,'LA201 (Landscape Design II)',90006,NULL,NULL,80004),(19,'LA341 (Landscape Design Project)',90006,NULL,NULL,80004),(20,'CT302 (Film Criticism & Analysis I)',90007,NULL,NULL,80005),(21,'CT400 (Film Theory I)',90007,NULL,NULL,80005),(22,'CT452 (History of Film I)',90007,NULL,NULL,80005),(23,'CT490 (Film Production Theory)',90007,NULL,NULL,80005),(24,'ME301 (Dynamics & Control I)',90008,NULL,NULL,80006),(25,'ME311 (Dynamics & Control II)',90008,NULL,NULL,80006),(26,'ME400 (Mechanics & Materials I)',90008,NULL,NULL,80006),(27,'ME454 (Mechanics & Materials II)',90008,NULL,NULL,80006),(28,'ME490 (Design & Manufacturing)',90008,NULL,NULL,80006),(29,'SE302 (Web Programming & Design)',90009,NULL,NULL,80010),(30,'CSE252 (Programming Language Concepts)',90009,NULL,NULL,80002),(31,'CSE341 (Computer Organization)',90009,NULL,NULL,80002),(32,'SE304 (Software Development Practice)',90009,NULL,NULL,80002),(33,'IE101 (Engineering Statistics I)',90010,NULL,NULL,80008),(34,'IE201 (Engineering Statistics II)',90010,NULL,NULL,80008),(35,'IE341 (Quality Planning & Control I)',90010,NULL,NULL,80008),(36,'IE252 (Quality Planning & Control II)',90010,NULL,NULL,80008),(37,'IE304 (Production Operations Planning)',90010,NULL,NULL,80008),(38,'SE406 (Software Architecture)',90005,NULL,NULL,80010),(39,'HSS341 (Ethics & Biotechnology)',90003,NULL,NULL,80009),(40,'CT222 (Production & Directing)',90007,NULL,NULL,80005);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-03 20:28:38
