-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: salinio_database
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=341 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,'auth','User logged in automatically','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 06:44:06','2025-10-19 06:44:06'),(2,'supplier','Added new Supplier','App\\Models\\Supplier',NULL,1,'App\\Models\\User',1,'{\"name\":\"BOSSING\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372530\"}',NULL,'2025-10-19 07:55:40','2025-10-19 07:55:40'),(3,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 08:15:30','2025-10-19 08:15:30'),(4,'auth','User logged in automatically','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 18:01:11','2025-10-19 18:01:11'),(5,'auth','User logged in automatically','App\\Models\\User',NULL,3,'App\\Models\\User',3,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 19:47:10','2025-10-19 19:47:10'),(6,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 19:50:07','2025-10-19 19:50:07'),(7,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 20:23:24','2025-10-19 20:23:24'),(8,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 20:23:37','2025-10-19 20:23:37'),(9,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 20:23:46','2025-10-19 20:23:46'),(10,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 21:27:55','2025-10-19 21:27:55'),(11,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 22:29:03','2025-10-19 22:29:03'),(12,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 22:30:04','2025-10-19 22:30:04'),(13,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-19 23:35:27','2025-10-19 23:35:27'),(14,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-20 13:43:04','2025-10-20 13:43:04'),(15,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-21 23:19:58','2025-10-21 23:19:58'),(16,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-22 13:16:11','2025-10-22 13:16:11'),(17,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-22 14:33:02','2025-10-22 14:33:02'),(18,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-23 19:44:54','2025-10-23 19:44:54'),(19,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-23 22:07:53','2025-10-23 22:07:53'),(20,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-23 23:36:42','2025-10-23 23:36:42'),(21,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-23 23:40:52','2025-10-23 23:40:52'),(22,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-23 23:41:56','2025-10-23 23:41:56'),(23,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-23 23:47:37','2025-10-23 23:47:37'),(24,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-23 23:47:46','2025-10-23 23:47:46'),(25,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 01:03:16','2025-10-24 01:03:16'),(26,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 01:03:25','2025-10-24 01:03:25'),(27,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 01:18:37','2025-10-24 01:18:37'),(28,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 01:18:46','2025-10-24 01:18:46'),(29,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 02:20:28','2025-10-24 02:20:28'),(30,'default','Updated VAT.','App\\Models\\Vat',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"0.12\",\"active\":1,\"created_at\":null,\"updated_at\":null},\"new\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"12.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-24T10:24:13.000000Z\"}}',NULL,'2025-10-24 02:24:13','2025-10-24 02:24:13'),(31,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 02:44:35','2025-10-24 02:44:35'),(32,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 04:01:15','2025-10-24 04:01:15'),(33,'supplier','Added new Supplier','App\\Models\\Supplier',NULL,2,'App\\Models\\User',5,'{\"name\":\"BOSS\",\"email\":\"danmichaelantiquina14@email.com\",\"phone\":\"09517372523\"}',NULL,'2025-10-24 05:48:52','2025-10-24 05:48:52'),(34,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 08:39:11','2025-10-24 08:39:11'),(35,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:41:23','2025-10-24 18:41:23'),(36,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:41:32','2025-10-24 18:41:32'),(37,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:41:40','2025-10-24 18:41:40'),(38,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:48:16','2025-10-24 18:48:16'),(39,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:48:29','2025-10-24 18:48:29'),(40,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:48:43','2025-10-24 18:48:43'),(41,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:48:53','2025-10-24 18:48:53'),(42,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:51:57','2025-10-24 18:51:57'),(43,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:52:05','2025-10-24 18:52:05'),(44,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:52:43','2025-10-24 18:52:43'),(45,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-24 18:52:53','2025-10-24 18:52:53'),(46,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-25 02:33:41','2025-10-25 02:33:41'),(47,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-25 07:05:16','2025-10-25 07:05:16'),(48,'customer','Added new Customer','App\\Models\\Customer',NULL,2,'App\\Models\\User',5,'{\"name\":\"Angelo Lopez\",\"email\":\"gelo6403@gmail.com\",\"phone\":\"09159381304\",\"new\":{\"name\":\"Angelo Lopez\",\"email\":\"gelo6403@gmail.com\",\"phone\":\"09159381304\"}}',NULL,'2025-10-25 07:24:12','2025-10-25 07:24:12'),(49,'default','Updated Supplier information.','App\\Models\\Supplier',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"BOSSING\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372530\",\"address\":\"Block 5 South Daang Hari\",\"image\":\"uploads\\/supplier_image\\/1846426300492627.png\",\"created_at\":\"2025-10-19T15:55:40.000000Z\",\"updated_at\":\"2025-10-19T15:55:40.000000Z\"},\"new\":{\"id\":1,\"name\":\"BOSSING\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372538\",\"address\":\"Block 5 South Daang Hari\",\"image\":\"uploads\\/supplier_image\\/1846426300492627.png\",\"created_at\":\"2025-10-19T15:55:40.000000Z\",\"updated_at\":\"2025-10-25T15:58:59.000000Z\"}}',NULL,'2025-10-25 07:58:59','2025-10-25 07:58:59'),(50,'default','Deleted a Supplier record.','App\\Models\\Supplier',NULL,2,'App\\Models\\User',5,'{\"old\":{\"id\":2,\"name\":\"BOSS\",\"email\":\"danmichaelantiquina14@email.com\",\"phone\":\"09517372523\",\"address\":\"Block 5 South Daang Hari\",\"image\":\"uploads\\/supplier_image\\/1846871308408931.png\",\"created_at\":\"2025-10-24T13:48:52.000000Z\",\"updated_at\":\"2025-10-24T13:48:52.000000Z\"}}',NULL,'2025-10-25 07:59:25','2025-10-25 07:59:25'),(51,'default','Updated VAT.','App\\Models\\Vat',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"12.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-24T10:24:13.000000Z\"},\"new\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"100.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-25T16:23:34.000000Z\"}}',NULL,'2025-10-25 08:23:34','2025-10-25 08:23:34'),(52,'default','Updated VAT.','App\\Models\\Vat',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"100.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-25T16:23:34.000000Z\"},\"new\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"13.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-25T16:23:45.000000Z\"}}',NULL,'2025-10-25 08:23:45','2025-10-25 08:23:45'),(53,'default','Updated VAT.','App\\Models\\Vat',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"13.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-25T16:23:45.000000Z\"},\"new\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"13.00\",\"active\":0,\"created_at\":null,\"updated_at\":\"2025-10-25T16:23:56.000000Z\"}}',NULL,'2025-10-25 08:23:56','2025-10-25 08:23:56'),(54,'default','Updated VAT.','App\\Models\\Vat',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"13.00\",\"active\":0,\"created_at\":null,\"updated_at\":\"2025-10-25T16:23:56.000000Z\"},\"new\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"15.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-25T16:24:08.000000Z\"}}',NULL,'2025-10-25 08:24:08','2025-10-25 08:24:08'),(55,'discount','Updated Discount information.','App\\Models\\Discount',NULL,2,'App\\Models\\User',5,'{\"old\":{\"id\":2,\"name\":\"pwd\",\"rate\":\"6.00\",\"vat_exempt\":0,\"active\":1,\"created_at\":\"2025-10-25T16:26:31.000000Z\",\"updated_at\":\"2025-10-25T16:26:31.000000Z\"},\"new\":{\"id\":2,\"name\":\"pwd\",\"rate\":\"6.00\",\"vat_exempt\":1,\"active\":0,\"created_at\":\"2025-10-25T16:26:31.000000Z\",\"updated_at\":\"2025-10-25T16:26:46.000000Z\"}}',NULL,'2025-10-25 08:26:46','2025-10-25 08:26:46'),(56,'default','Deleted a Discount record.','App\\Models\\Discount',NULL,2,'App\\Models\\User',5,'{\"old\":{\"id\":2,\"name\":\"pwd\",\"rate\":\"6.00\",\"vat_exempt\":1,\"active\":0,\"created_at\":\"2025-10-25T16:26:31.000000Z\",\"updated_at\":\"2025-10-25T16:26:46.000000Z\"}}',NULL,'2025-10-25 08:26:54','2025-10-25 08:26:54'),(57,'default','Deleted a Discount record.','App\\Models\\Discount',NULL,3,'App\\Models\\User',5,'{\"old\":{\"id\":3,\"name\":\"pdw\",\"rate\":\"100.00\",\"vat_exempt\":1,\"active\":1,\"created_at\":\"2025-10-25T16:28:10.000000Z\",\"updated_at\":\"2025-10-25T16:28:10.000000Z\"}}',NULL,'2025-10-25 08:28:17','2025-10-25 08:28:17'),(58,'default','Deleted a Discount record.','App\\Models\\Discount',NULL,4,'App\\Models\\User',5,'{\"old\":{\"id\":4,\"name\":\"888888888888\",\"rate\":\"12.00\",\"vat_exempt\":1,\"active\":1,\"created_at\":\"2025-10-25T16:29:12.000000Z\",\"updated_at\":\"2025-10-25T16:29:12.000000Z\"}}',NULL,'2025-10-25 08:30:55','2025-10-25 08:30:55'),(59,'default','Deleted a Discount record.','App\\Models\\Discount',NULL,5,'App\\Models\\User',5,'{\"old\":{\"id\":5,\"name\":\"senior\",\"rate\":\"12.00\",\"vat_exempt\":1,\"active\":1,\"created_at\":\"2025-10-25T16:31:23.000000Z\",\"updated_at\":\"2025-10-25T16:31:23.000000Z\"}}',NULL,'2025-10-25 08:33:15','2025-10-25 08:33:15'),(60,'default','Updated Product information.','App\\Models\\Product',NULL,3,'App\\Models\\User',5,'{\"old\":{\"id\":3,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000003\",\"product_image\":\"uploads\\/product_image\\/1846665738578626.png\",\"category_id\":1,\"subcategory_id\":1,\"brand_id\":1,\"description\":\"no not all damn it\",\"dosage_form\":\"Syrup\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":\"headache\",\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-22T07:21:26.000000Z\",\"updated_at\":\"2025-10-22T07:21:26.000000Z\"},\"new\":{\"id\":3,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000003\",\"product_image\":\"uploads\\/product_image\\/1846665738578626.png\",\"category_id\":1,\"subcategory_id\":1,\"brand_id\":1,\"description\":\"no not all damn it\",\"dosage_form\":\"Syrup\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":\"headache\",\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-22T07:21:26.000000Z\",\"updated_at\":\"2025-10-25T16:48:33.000000Z\"}}',NULL,'2025-10-25 08:48:34','2025-10-25 08:48:34'),(61,'default','Updated Product information.','App\\Models\\Product',NULL,4,'App\\Models\\User',5,'{\"old\":{\"id\":4,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000004\",\"product_image\":\"uploads\\/product_image\\/1846973336713174.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":4,\"description\":\"ddfghjklkjhgfdxcghjklkjhgcgjk\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Unisex\",\"age_group\":\"Kids\",\"health_concern\":\"headache\",\"selling_price\":\"0.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-25T16:50:34.000000Z\",\"updated_at\":\"2025-10-25T16:50:34.000000Z\"},\"new\":{\"id\":4,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000004\",\"product_image\":\"uploads\\/product_image\\/1846973336713174.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":4,\"description\":\"ddfghjklkjhgfdxcghjklkjhgcgjk\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Unisex\",\"age_group\":\"Kids\",\"health_concern\":\"headache\",\"selling_price\":\"0.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-25T16:50:34.000000Z\",\"updated_at\":\"2025-10-25T16:51:19.000000Z\"}}',NULL,'2025-10-25 08:51:19','2025-10-25 08:51:19'),(62,'default','Updated Product information.','App\\Models\\Product',NULL,4,'App\\Models\\User',5,'{\"old\":{\"id\":4,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000004\",\"product_image\":\"uploads\\/product_image\\/1846973336713174.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":4,\"description\":\"ddfghjklkjhgfdxcghjklkjhgcgjk\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Unisex\",\"age_group\":\"Kids\",\"health_concern\":\"headache\",\"selling_price\":\"0.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-25T16:50:34.000000Z\",\"updated_at\":\"2025-10-25T16:51:19.000000Z\"},\"new\":{\"id\":4,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000004\",\"product_image\":\"uploads\\/product_image\\/1846973336713174.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":4,\"description\":\"ddfghjklkjhgfdxcghjklkjhgcgjk\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Unisex\",\"age_group\":\"Kids\",\"health_concern\":\"headache\",\"selling_price\":\"0.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-25T16:50:34.000000Z\",\"updated_at\":\"2025-10-25T17:07:59.000000Z\"}}',NULL,'2025-10-25 09:07:59','2025-10-25 09:07:59'),(63,'default','Updated Product information.','App\\Models\\Product',NULL,5,'App\\Models\\User',5,'{\"old\":{\"id\":5,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000005\",\"product_image\":\"uploads\\/product_image\\/1846974276025257.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":1,\"description\":\"sdfsdfsdfsdfsdf\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":\"headache\",\"selling_price\":\"0.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-25T17:05:30.000000Z\",\"updated_at\":\"2025-10-25T17:05:30.000000Z\"},\"new\":{\"id\":5,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000005\",\"product_image\":\"uploads\\/product_image\\/1846974276025257.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":1,\"description\":\"sdfsdfsdfsdfsdf\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":\"headache\",\"selling_price\":\"0.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-25T17:05:30.000000Z\",\"updated_at\":\"2025-10-25T17:08:11.000000Z\"}}',NULL,'2025-10-25 09:08:11','2025-10-25 09:08:11'),(64,'default','Deleted a Product record.','App\\Models\\Product',NULL,5,'App\\Models\\User',5,'{\"old\":{\"id\":5,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000005\",\"product_image\":\"uploads\\/product_image\\/1846974276025257.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":1,\"description\":\"sdfsdfsdfsdfsdf\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":\"headache\",\"selling_price\":\"0.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-25T17:05:30.000000Z\",\"updated_at\":\"2025-10-25T17:08:11.000000Z\"}}',NULL,'2025-10-25 09:08:26','2025-10-25 09:08:26'),(65,'default','Deleted a Product record.','App\\Models\\Product',NULL,4,'App\\Models\\User',5,'{\"old\":{\"id\":4,\"product_name\":\"Biogesic 500mg\",\"product_code\":\"PC000004\",\"product_image\":\"uploads\\/product_image\\/1846973336713174.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":4,\"description\":\"ddfghjklkjhgfdxcghjklkjhgcgjk\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Unisex\",\"age_group\":\"Kids\",\"health_concern\":\"headache\",\"selling_price\":\"0.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-25T16:50:34.000000Z\",\"updated_at\":\"2025-10-25T17:07:59.000000Z\"}}',NULL,'2025-10-25 09:08:54','2025-10-25 09:08:54'),(66,'default','Updated Supplier information.','App\\Models\\Supplier',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"BOSSING\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372538\",\"address\":\"Block 5 South Daang Hari\",\"image\":\"uploads\\/supplier_image\\/1846426300492627.png\",\"created_at\":\"2025-10-19T15:55:40.000000Z\",\"updated_at\":\"2025-10-25T15:58:59.000000Z\"},\"new\":{\"id\":1,\"name\":\"BOSSINGs\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372538\",\"address\":\"Block 5 South Daang H\",\"image\":\"uploads\\/supplier_image\\/1846426300492627.png\",\"created_at\":\"2025-10-19T15:55:40.000000Z\",\"updated_at\":\"2025-10-25T17:47:39.000000Z\"}}',NULL,'2025-10-25 09:47:39','2025-10-25 09:47:39'),(67,'supplier','Added new Supplier','App\\Models\\Supplier',NULL,3,'App\\Models\\User',5,'{\"name\":\"Angelo Lopez\",\"email\":\"gelo6403@gmail.com\",\"phone\":\"09159381304\"}',NULL,'2025-10-25 09:54:21','2025-10-25 09:54:21'),(68,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-25 11:55:40','2025-10-25 11:55:40'),(69,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-25 18:48:05','2025-10-25 18:48:05'),(70,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-25 19:57:33','2025-10-25 19:57:33'),(71,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-25 19:57:48','2025-10-25 19:57:48'),(72,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 02:36:38','2025-10-26 02:36:38'),(73,'customer','Added new Customer','App\\Models\\Customer',NULL,3,'App\\Models\\User',5,'{\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"phone\":\"09123939191\",\"new\":{\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"phone\":\"09123939191\"}}',NULL,'2025-10-26 03:08:25','2025-10-26 03:08:25'),(74,'default','Deleted a customer record.','App\\Models\\Customer',NULL,3,'App\\Models\\User',5,'{\"old\":{\"id\":3,\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"password\":null,\"phone\":\"09123939191\",\"address\":\"muntinlupa\",\"image\":null,\"added_by_staff\":1,\"remember_token\":null}}',NULL,'2025-10-26 03:08:47','2025-10-26 03:08:47'),(75,'customer','Added new Customer','App\\Models\\Customer',NULL,4,'App\\Models\\User',5,'{\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"phone\":\"09123939191\",\"new\":{\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"phone\":\"09123939191\"}}',NULL,'2025-10-26 03:11:09','2025-10-26 03:11:09'),(76,'default','Deleted a customer record.','App\\Models\\Customer',NULL,4,'App\\Models\\User',5,'{\"old\":{\"id\":4,\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"password\":null,\"phone\":\"09123939191\",\"address\":\"muntinlupa\",\"image\":null,\"added_by_staff\":1,\"remember_token\":null}}',NULL,'2025-10-26 03:11:41','2025-10-26 03:11:41'),(77,'customer','Added new Customer','App\\Models\\Customer',NULL,5,'App\\Models\\User',5,'{\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"phone\":\"09123939191\",\"new\":{\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"phone\":\"09123939191\"}}',NULL,'2025-10-26 03:15:48','2025-10-26 03:15:48'),(78,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 04:11:04','2025-10-26 04:11:04'),(79,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 04:18:53','2025-10-26 04:18:53'),(80,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 04:20:04','2025-10-26 04:20:04'),(81,'auth','User logged in automatically','App\\Models\\User',NULL,7,'App\\Models\\User',7,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 04:20:23','2025-10-26 04:20:23'),(82,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',7,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 04:48:36','2025-10-26 04:48:36'),(83,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 04:48:43','2025-10-26 04:48:43'),(84,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 06:11:21','2025-10-26 06:11:21'),(85,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 14:26:53','2025-10-26 14:26:53'),(86,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 17:28:36','2025-10-26 17:28:36'),(87,'auth','User logged in automatically','App\\Models\\Customer',NULL,1,'App\\Models\\Customer',1,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 17:41:28','2025-10-26 17:41:28'),(88,'default','Deleted a customer record.','App\\Models\\Customer',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"Salinio\",\"email\":\"SalinioPharma@yahoo.com\",\"password\":\"$2y$10$xoDPXjOLNcqS8PIz8ApkyO7vpt\\/mx0cPHY.XSrIpjzCIHnDWmKxvW\",\"phone\":\"09517272521\",\"address\":null,\"image\":\"frontend\\/assets\\/customer_image\\/1847060452977994.jpg\",\"added_by_staff\":0,\"remember_token\":\"RQFZa8Ii3dgVUBcypshKrrGIyVHWu8BrCNKOOCikihzIIo7ahupnLUKbtppi\"}}',NULL,'2025-10-26 19:42:47','2025-10-26 19:42:47'),(89,'customer','Added new Customer','App\\Models\\Customer',NULL,6,'App\\Models\\User',5,'{\"name\":\"Bosske12\",\"email\":\"danmichaelantiquina23@outlook.com\",\"phone\":\"09514272530\",\"new\":{\"name\":\"Bosske12\",\"email\":\"danmichaelantiquina23@outlook.com\",\"phone\":\"09514272530\"}}',NULL,'2025-10-26 19:48:17','2025-10-26 19:48:17'),(90,'customer','Updated customer information.','App\\Models\\Customer',NULL,6,'App\\Models\\User',5,'{\"old\":{\"name\":\"Bosske12\",\"email\":\"danmichaelantiquina23@outlook.com\",\"phone\":\"09514272530\"},\"new\":{\"name\":\"Bosske12\",\"email\":\"danmichaelantiquina23@outlook.com\",\"phone\":\"09514272530\"}}',NULL,'2025-10-26 19:54:38','2025-10-26 19:54:38'),(91,'auth','User logged in automatically','App\\Models\\Customer',NULL,7,'App\\Models\\Customer',7,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-26 20:41:52','2025-10-26 20:41:52'),(92,'auth','User logged in automatically','App\\Models\\Customer',NULL,7,'App\\Models\\Customer',7,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 01:13:03','2025-10-27 01:13:03'),(93,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',7,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 01:13:08','2025-10-27 01:13:08'),(94,'auth','User logged in automatically','App\\Models\\Customer',NULL,7,'App\\Models\\Customer',7,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36\"}',NULL,'2025-10-27 01:20:27','2025-10-27 01:20:27'),(95,'auth','User logged in automatically','App\\Models\\Customer',NULL,7,'App\\Models\\Customer',7,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36\"}',NULL,'2025-10-27 04:56:59','2025-10-27 04:56:59'),(96,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 05:41:23','2025-10-27 05:41:23'),(97,'supplier','Deleted a Supplier record.','App\\Models\\Supplier',NULL,3,'App\\Models\\User',5,'{\"old\":{\"id\":3,\"name\":\"Angelo Lopez\",\"email\":\"gelo6403@gmail.com\",\"phone\":\"09159381304\",\"address\":\"taguig city\",\"image\":\"uploads\\/supplier_image\\/1846977349211817.png\",\"created_at\":\"2025-10-25T17:54:21.000000Z\",\"updated_at\":\"2025-10-25T17:54:21.000000Z\"}}',NULL,'2025-10-27 06:43:31','2025-10-27 06:43:31'),(98,'supplier','Added new Supplier','App\\Models\\Supplier',NULL,4,'App\\Models\\User',5,'{\"name\":\"john carlo dote\",\"email\":\"dotelangmalakas@gmail.com\",\"phone\":\"09123939191\"}',NULL,'2025-10-27 06:47:58','2025-10-27 06:47:58'),(99,'customer','Added new Customer','App\\Models\\Customer',NULL,8,'App\\Models\\User',5,'{\"name\":\"zxcvbnm\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\",\"new\":{\"name\":\"zxcvbnm\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\"}}',NULL,'2025-10-27 06:49:43','2025-10-27 06:49:43'),(100,'customer','Updated customer information.','App\\Models\\Customer',NULL,8,'App\\Models\\User',5,'{\"old\":{\"name\":\"zxcvbnm\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\"},\"new\":{\"name\":\"zxcvbnmzxcvb\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\"}}',NULL,'2025-10-27 06:49:55','2025-10-27 06:49:55'),(101,'default','Deleted a customer record.','App\\Models\\Customer',NULL,8,'App\\Models\\User',5,'{\"old\":{\"id\":8,\"name\":\"zxcvbnmzxcvb\",\"email\":\"zxcvbnm@gmail.com\",\"password\":null,\"phone\":\"09123456789\",\"address\":\"zxcvbnmfghjk\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761576583\\/customers\\/d2fgj7egprsa0hx5ckpd.png\",\"added_by_staff\":1,\"remember_token\":null}}',NULL,'2025-10-27 06:50:01','2025-10-27 06:50:01'),(102,'supplier','Added new Supplier','App\\Models\\Supplier',NULL,5,'App\\Models\\User',5,'{\"name\":\"zxcvbnm\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\"}',NULL,'2025-10-27 06:51:27','2025-10-27 06:51:27'),(103,'customer','Added new Customer','App\\Models\\Customer',NULL,9,'App\\Models\\User',5,'{\"name\":\"zxcvbnm\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\",\"new\":{\"name\":\"zxcvbnm\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\"}}',NULL,'2025-10-27 06:54:06','2025-10-27 06:54:06'),(104,'supplier','Updated Supplier information.','App\\Models\\Supplier',NULL,5,'App\\Models\\User',5,'{\"old\":{\"name\":\"zxcvbnm\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\",\"address\":\"zxcvbnmfghjk\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761576687\\/suppliers\\/ijdwtuwcpb6odaqabaxd.png\"},\"new\":{\"name\":\"zxcvbnmxcvbn\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\",\"address\":\"zxcvbnmfghjk\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761576687\\/suppliers\\/ijdwtuwcpb6odaqabaxd.png\"}}',NULL,'2025-10-27 06:55:31','2025-10-27 06:55:31'),(105,'supplier','Deleted a Supplier record.','App\\Models\\Supplier',NULL,5,'App\\Models\\User',5,'{\"old\":{\"id\":5,\"name\":\"zxcvbnmxcvbn\",\"email\":\"zxcvbnm@gmail.com\",\"phone\":\"09123456789\",\"address\":\"zxcvbnmfghjk\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761576687\\/suppliers\\/ijdwtuwcpb6odaqabaxd.png\",\"created_at\":\"2025-10-27T14:51:27.000000Z\",\"updated_at\":\"2025-10-27T14:55:31.000000Z\"}}',NULL,'2025-10-27 06:55:43','2025-10-27 06:55:43'),(106,'default','Deleted a customer record.','App\\Models\\Customer',NULL,9,'App\\Models\\User',5,'{\"old\":{\"id\":9,\"name\":\"zxcvbnm\",\"email\":\"zxcvbnm@gmail.com\",\"password\":null,\"phone\":\"09123456789\",\"address\":\"zxcvbnmfghjk\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761576845\\/customers\\/e6q5btvol2oiipppvr0y.png\",\"added_by_staff\":1,\"remember_token\":null}}',NULL,'2025-10-27 06:55:53','2025-10-27 06:55:53'),(107,'default','Deleted a Product record.','App\\Models\\Product',NULL,6,'App\\Models\\User',5,'{\"old\":{\"id\":6,\"product_name\":\"zxcvbnm\",\"product_code\":\"PC000004\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761577518\\/products\\/ou2qcb8nwcw6r0pad7cg.png\",\"category_id\":1,\"subcategory_id\":1,\"brand_id\":1,\"description\":\"jiojoijkkjknm\",\"dosage_form\":\"Syrup\",\"target_gender\":\"Unisex\",\"age_group\":\"Kids\",\"health_concern\":\"zxcvbnm\",\"selling_price\":\"200.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-27T15:05:18.000000Z\",\"updated_at\":\"2025-10-27T15:05:18.000000Z\"}}',NULL,'2025-10-27 08:03:07','2025-10-27 08:03:07'),(108,'default','Deleted a Product record.','App\\Models\\Product',NULL,7,'App\\Models\\User',5,'{\"old\":{\"id\":7,\"product_name\":\"xcvbjgfcvbn\",\"product_code\":\"PC000005\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761578055\\/products\\/bnggwoifu09f9k08n6q5.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":1,\"description\":\"xcvhgfxcvbnjhgf\",\"dosage_form\":\"Tablet\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":\"headache\",\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-27T15:14:16.000000Z\",\"updated_at\":\"2025-10-27T15:14:16.000000Z\"}}',NULL,'2025-10-27 08:03:14','2025-10-27 08:03:14'),(109,'customer','Added new Customer','App\\Models\\Customer',NULL,10,'App\\Models\\User',5,'{\"name\":\"Dan michael Cape Antiquina\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372530\",\"new\":{\"name\":\"Dan michael Cape Antiquina\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372530\"}}',NULL,'2025-10-27 08:13:30','2025-10-27 08:13:30'),(110,'customer','Added new Customer','App\\Models\\Customer',NULL,11,'App\\Models\\User',5,'{\"name\":\"pharmasad\",\"email\":\"pharma14@gmail.com\",\"phone\":\"09123939197\",\"new\":{\"name\":\"pharmasad\",\"email\":\"pharma14@gmail.com\",\"phone\":\"09123939197\"}}',NULL,'2025-10-27 08:22:12','2025-10-27 08:22:12'),(111,'supplier','Added new supplier.','App\\Models\\Supplier',NULL,6,'App\\Models\\User',5,'{\"name\":\"pharma\",\"email\":\"pharmaaa@gmail.com\",\"phone\":\"09123939181\"}',NULL,'2025-10-27 08:37:02','2025-10-27 08:37:02'),(112,'customer','Added new Customer','App\\Models\\Customer',NULL,12,'App\\Models\\User',5,'{\"name\":\"sdfghjk\",\"email\":\"sdfghjk@gmail.com\",\"phone\":\"09123456788\",\"new\":{\"name\":\"sdfghjk\",\"email\":\"sdfghjk@gmail.com\",\"phone\":\"09123456788\"}}',NULL,'2025-10-27 08:55:56','2025-10-27 08:55:56'),(113,'customer','Added new Customer','App\\Models\\Customer',NULL,13,'App\\Models\\User',5,'{\"name\":\"fghjiuytrdcvbjuy\",\"email\":\"ghjuytgji876tghj8@gmail.com\",\"phone\":\"09123456777\",\"new\":{\"name\":\"fghjiuytrdcvbjuy\",\"email\":\"ghjuytgji876tghj8@gmail.com\",\"phone\":\"09123456777\"}}',NULL,'2025-10-27 09:03:13','2025-10-27 09:03:13'),(114,'customer','Added new Customer','App\\Models\\Customer',NULL,14,'App\\Models\\User',5,'{\"name\":\"fghjiuytrdcvbjuy\",\"email\":\"ghjuytgji876tghj8@gmail.com\",\"phone\":\"09123456777\",\"new\":{\"name\":\"fghjiuytrdcvbjuy\",\"email\":\"ghjuytgji876tghj8@gmail.com\",\"phone\":\"09123456777\"}}',NULL,'2025-10-27 09:08:10','2025-10-27 09:08:10'),(115,'default','Deleted a customer record.','App\\Models\\Customer',NULL,14,'App\\Models\\User',5,'{\"old\":{\"id\":14,\"name\":\"fghjiuytrdcvbjuy\",\"email\":\"ghjuytgji876tghj8@gmail.com\",\"password\":null,\"phone\":\"09123456777\",\"address\":\"ghjuytfcvbnjuytf\",\"image\":null,\"added_by_staff\":1,\"remember_token\":null}}',NULL,'2025-10-27 09:08:28','2025-10-27 09:08:28'),(116,'customer','Added new Customer','App\\Models\\Customer',NULL,15,'App\\Models\\User',5,'{\"name\":\"exvbhytresdfgh\",\"email\":\"tfcvbhytfdcvbh@gmail.com\",\"phone\":\"09123456779\",\"new\":{\"name\":\"exvbhytresdfgh\",\"email\":\"tfcvbhytfdcvbh@gmail.com\",\"phone\":\"09123456779\"}}',NULL,'2025-10-27 09:10:21','2025-10-27 09:10:21'),(117,'customer','Updated customer information.','App\\Models\\Customer',NULL,15,'App\\Models\\User',5,'{\"old\":{\"name\":\"exvbhytresdfgh\",\"email\":\"tfcvbhytfdcvbh@gmail.com\",\"phone\":\"09123456779\"},\"new\":{\"name\":\"exvbhytresdfgh\",\"email\":\"tfcvbhytfdcvbh@gmail.com\",\"phone\":\"09123456779\"}}',NULL,'2025-10-27 09:11:00','2025-10-27 09:11:00'),(118,'customer','Updated customer information.','App\\Models\\Customer',NULL,15,'App\\Models\\User',5,'{\"old\":{\"name\":\"exvbhytresdfgh\",\"email\":\"tfcvbhytfdcvbh@gmail.com\",\"phone\":\"09123456779\"},\"new\":{\"name\":\"exvbhytresdfghvbhjkl\",\"email\":\"tfcvbhytfdcvbh@gmail.com\",\"phone\":\"09123456779\"}}',NULL,'2025-10-27 09:12:11','2025-10-27 09:12:11'),(119,'default','Deleted a customer record.','App\\Models\\Customer',NULL,15,'App\\Models\\User',5,'{\"old\":{\"id\":15,\"name\":\"exvbhytresdfghvbhjkl\",\"email\":\"tfcvbhytfdcvbh@gmail.com\",\"password\":null,\"phone\":\"09123456779\",\"address\":\"edxcvgytfghuj\",\"image\":null,\"added_by_staff\":1,\"remember_token\":null}}',NULL,'2025-10-27 09:12:17','2025-10-27 09:12:17'),(120,'supplier','Added new supplier.','App\\Models\\Supplier',NULL,7,'App\\Models\\User',5,'{\"name\":\"pharmas\",\"email\":\"pharmaaam@gmail.com\",\"phone\":\"09123939189\"}',NULL,'2025-10-27 09:14:15','2025-10-27 09:14:15'),(121,'supplier','Updated Supplier information.','App\\Models\\Supplier',NULL,7,'App\\Models\\User',5,'{\"old\":{\"name\":\"pharmas\",\"email\":\"pharmaaam@gmail.com\",\"phone\":\"09123939189\",\"address\":\"muntinlupa\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761585254\\/suppliers\\/i6wwiucadojawfnmruzf.png\"},\"new\":{\"name\":\"pharmasnjk\",\"email\":\"pharmaaam\\/\\/\\/@gmail.com\",\"phone\":\"09123939189\",\"address\":\"muntinlupa\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761585254\\/suppliers\\/i6wwiucadojawfnmruzf.png\"}}',NULL,'2025-10-27 09:14:33','2025-10-27 09:14:33'),(122,'supplier','Updated Supplier information.','App\\Models\\Supplier',NULL,7,'App\\Models\\User',5,'{\"old\":{\"name\":\"pharmasnjk\",\"email\":\"pharmaaam\\/\\/\\/@gmail.com\",\"phone\":\"09123939189\",\"address\":\"muntinlupa\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761585254\\/suppliers\\/i6wwiucadojawfnmruzf.png\"},\"new\":{\"name\":\"pharmasnjk\\/\\/\\/\\/\\/\",\"email\":\"pharmaaam\\/\\/\\/@gmail.com\",\"phone\":\"09123939189\",\"address\":\"muntinlupa\\/\\/\\/\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761585254\\/suppliers\\/i6wwiucadojawfnmruzf.png\"}}',NULL,'2025-10-27 09:16:14','2025-10-27 09:16:14'),(123,'supplier','Deleted a Supplier record.','App\\Models\\Supplier',NULL,7,'App\\Models\\User',5,'{\"old\":{\"id\":7,\"name\":\"pharmasnjk\\/\\/\\/\\/\\/\",\"email\":\"pharmaaam\\/\\/\\/@gmail.com\",\"phone\":\"09123939189\",\"address\":\"muntinlupa\\/\\/\\/\",\"image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761585254\\/suppliers\\/i6wwiucadojawfnmruzf.png\",\"created_at\":\"2025-10-27T17:14:15.000000Z\",\"updated_at\":\"2025-10-27T17:16:14.000000Z\"}}',NULL,'2025-10-27 09:45:21','2025-10-27 09:45:21'),(124,'supplier','Deleted a Supplier record.','App\\Models\\Supplier',NULL,6,'App\\Models\\User',5,'{\"old\":{\"id\":6,\"name\":\"pharma\",\"email\":\"pharmaaa@gmail.com\",\"phone\":\"09123939181\",\"address\":\"muntinlupa\",\"image\":null,\"created_at\":\"2025-10-27T16:37:02.000000Z\",\"updated_at\":\"2025-10-27T16:37:02.000000Z\"}}',NULL,'2025-10-27 09:53:46','2025-10-27 09:53:46'),(125,'supplier','Added new supplier.','App\\Models\\Supplier',NULL,8,'App\\Models\\User',5,'{\"name\":\"pharma\",\"email\":\"pharmaaa@gmail.com\",\"phone\":\"09123939181\"}',NULL,'2025-10-27 09:53:57','2025-10-27 09:53:57'),(126,'supplier','Deleted a Supplier record.','App\\Models\\Supplier',NULL,8,'App\\Models\\User',5,'{\"old\":{\"id\":8,\"name\":\"pharma\",\"email\":\"pharmaaa@gmail.com\",\"phone\":\"09123939181\",\"address\":\"muntinlupa\",\"image\":null,\"created_at\":\"2025-10-27T17:53:57.000000Z\",\"updated_at\":\"2025-10-27T17:53:57.000000Z\"}}',NULL,'2025-10-27 09:54:03','2025-10-27 09:54:03'),(127,'supplier','Added new supplier.','App\\Models\\Supplier',NULL,9,'App\\Models\\User',5,'{\"name\":\"pharma\",\"email\":\"pharmaaa\\/\\/\\/@gmail.com\",\"phone\":\"09123939181\"}',NULL,'2025-10-27 09:54:14','2025-10-27 09:54:14'),(128,'default','Updated Product information.','App\\Models\\Product',NULL,12,'App\\Models\\User',5,'{\"old\":{\"id\":12,\"product_name\":\"Coke 500ml\",\"product_code\":\"PC000010\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761588762\\/products\\/rmhuwzkdycba0uuiwrsq.jpg\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":5,\"description\":\"sssssssssssssssss\",\"dosage_form\":\"Tablet\",\"target_gender\":\"Male\",\"age_group\":\"Kids\",\"health_concern\":\"Pain Relief\",\"selling_price\":\"15.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-27T18:12:44.000000Z\",\"updated_at\":\"2025-10-27T18:12:44.000000Z\"},\"new\":{\"id\":12,\"product_name\":\"Coke 500ml\",\"product_code\":\"PC000010\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761588762\\/products\\/rmhuwzkdycba0uuiwrsq.jpg\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":4,\"description\":\"sssssssssssssssss\",\"dosage_form\":\"Tablet\",\"target_gender\":\"Male\",\"age_group\":\"Kids\",\"health_concern\":\"Pain Relief\",\"selling_price\":\"15.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-27T18:12:44.000000Z\",\"updated_at\":\"2025-10-27T18:15:55.000000Z\"}}',NULL,'2025-10-27 10:15:55','2025-10-27 10:15:55'),(129,'default','Deleted a Product record.','App\\Models\\Product',NULL,11,'App\\Models\\User',5,'{\"old\":{\"id\":11,\"product_name\":\"thermometer\",\"product_code\":\"PC000009\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761581549\\/products\\/ztzkysqs8f9kd38c0bb0.jpg\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":1,\"description\":\"dssssssssssssssssssssssssssssssssss\",\"dosage_form\":\"Ointment\",\"target_gender\":\"Unisex\",\"age_group\":\"Kids\",\"health_concern\":\"asdddddddddddddddd\",\"selling_price\":\"15.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-27T16:12:30.000000Z\",\"updated_at\":\"2025-10-27T16:12:30.000000Z\"}}',NULL,'2025-10-27 11:19:23','2025-10-27 11:19:23'),(130,'default','Deleted a Product record.','App\\Models\\Product',NULL,13,'App\\Models\\User',5,'{\"old\":{\"id\":13,\"product_name\":\"zxcvbnm\",\"product_code\":\"PC000011\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761589106\\/products\\/qfebcfuhgpzgfrmldrig.jpg\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":5,\"description\":\"sssssssssssssssssssssssssssssssssssssssssssss\",\"dosage_form\":\"Syrup\",\"target_gender\":\"Female\",\"age_group\":\"Adults\",\"health_concern\":\"Pain Relief\",\"selling_price\":\"400.00\",\"has_expiration\":0,\"prescription_required\":0,\"created_at\":\"2025-10-27T18:18:28.000000Z\",\"updated_at\":\"2025-10-27T18:18:28.000000Z\"}}',NULL,'2025-10-27 11:19:27','2025-10-27 11:19:27'),(131,'default','Deleted a Product record.','App\\Models\\Product',NULL,12,'App\\Models\\User',5,'{\"old\":{\"id\":12,\"product_name\":\"Coke 500ml\",\"product_code\":\"PC000010\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1761588762\\/products\\/rmhuwzkdycba0uuiwrsq.jpg\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":4,\"description\":\"sssssssssssssssss\",\"dosage_form\":\"Tablet\",\"target_gender\":\"Male\",\"age_group\":\"Kids\",\"health_concern\":\"Pain Relief\",\"selling_price\":\"15.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2025-10-27T18:12:44.000000Z\",\"updated_at\":\"2025-10-27T18:15:55.000000Z\"}}',NULL,'2025-10-27 11:19:34','2025-10-27 11:19:34'),(132,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 12:49:52','2025-10-27 12:49:52'),(133,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 12:57:55','2025-10-27 12:57:55'),(134,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 13:21:12','2025-10-27 13:21:12'),(135,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 13:43:12','2025-10-27 13:43:12'),(136,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 13:59:14','2025-10-27 13:59:14'),(137,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 14:00:52','2025-10-27 14:00:52'),(138,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 14:01:10','2025-10-27 14:01:10'),(139,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 14:02:49','2025-10-27 14:02:49'),(140,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 14:04:33','2025-10-27 14:04:33'),(141,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 14:04:56','2025-10-27 14:04:56'),(142,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 14:10:24','2025-10-27 14:10:24'),(143,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 14:44:13','2025-10-27 14:44:13'),(144,'auth','User logged in automatically','App\\Models\\Customer',NULL,7,'App\\Models\\Customer',7,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36\"}',NULL,'2025-10-27 14:52:48','2025-10-27 14:52:48'),(145,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 15:00:00','2025-10-27 15:00:00'),(146,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 16:15:14','2025-10-27 16:15:14'),(147,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 21:16:46','2025-10-27 21:16:46'),(148,'default','Updated VAT.','App\\Models\\Vat',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"15.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-25T16:24:08.000000Z\"},\"new\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"100.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-28T05:58:52.000000Z\"}}',NULL,'2025-10-27 21:58:52','2025-10-27 21:58:52'),(149,'default','Updated VAT.','App\\Models\\Vat',NULL,1,'App\\Models\\User',5,'{\"old\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"100.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-28T05:58:52.000000Z\"},\"new\":{\"id\":1,\"name\":\"standard vat\",\"rate\":\"15.00\",\"active\":1,\"created_at\":null,\"updated_at\":\"2025-10-28T05:59:23.000000Z\"}}',NULL,'2025-10-27 21:59:23','2025-10-27 21:59:23'),(150,'discount','Updated Discount information.','App\\Models\\Discount',NULL,6,'App\\Models\\User',5,'{\"old\":{\"id\":6,\"name\":\"PWD\",\"rate\":\"100.00\",\"vat_exempt\":1,\"active\":1,\"created_at\":\"2025-10-28T05:59:57.000000Z\",\"updated_at\":\"2025-10-28T05:59:57.000000Z\"},\"new\":{\"id\":6,\"name\":\"PWD\",\"rate\":\"12.00\",\"vat_exempt\":1,\"active\":1,\"created_at\":\"2025-10-28T05:59:57.000000Z\",\"updated_at\":\"2025-10-28T06:00:17.000000Z\"}}',NULL,'2025-10-27 22:00:17','2025-10-27 22:00:17'),(151,'auth','User logged in automatically','App\\Models\\Customer',NULL,17,'App\\Models\\Customer',17,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36 Edg\\/141.0.0.0\"}',NULL,'2025-10-27 22:12:21','2025-10-27 22:12:21'),(152,'auth','User logged in automatically','App\\Models\\Customer',NULL,17,'App\\Models\\Customer',17,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-26 01:58:22','2025-11-26 01:58:22'),(153,'auth','User logged in automatically','App\\Models\\Customer',NULL,17,'App\\Models\\Customer',17,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-26 01:58:28','2025-11-26 01:58:28'),(154,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-30 05:27:50','2025-11-30 05:27:50'),(155,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-30 06:12:10','2025-11-30 06:12:10'),(156,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-30 06:14:47','2025-11-30 06:14:47'),(157,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-30 06:19:27','2025-11-30 06:19:27'),(158,'auth','User logged in automatically','App\\Models\\User',NULL,12,'App\\Models\\User',12,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-30 06:19:57','2025-11-30 06:19:57'),(159,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',12,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-30 06:21:50','2025-11-30 06:21:50'),(160,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-30 06:21:58','2025-11-30 06:21:58'),(161,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-11-30 06:39:35','2025-11-30 06:39:35'),(162,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-12-01 04:24:58','2025-12-01 04:24:58'),(163,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/142.0.0.0 Safari\\/537.36 Edg\\/142.0.0.0\"}',NULL,'2025-12-01 04:29:03','2025-12-01 04:29:03'),(164,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2025-12-22 20:09:28','2025-12-22 20:09:28'),(165,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2025-12-22 21:21:36','2025-12-22 21:21:36'),(166,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2025-12-25 23:48:47','2025-12-25 23:48:47'),(167,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2025-12-26 01:00:03','2025-12-26 01:00:03'),(168,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-02 05:44:08','2026-01-02 05:44:08'),(169,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-02 05:57:38','2026-01-02 05:57:38'),(170,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-08 06:16:44','2026-01-08 06:16:44'),(171,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-08 06:41:29','2026-01-08 06:41:29'),(172,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-08 06:46:44','2026-01-08 06:46:44'),(173,'auth','User logged in automatically','App\\Models\\Customer',NULL,19,'App\\Models\\Customer',19,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-08 07:22:37','2026-01-08 07:22:37'),(174,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',19,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-08 07:22:59','2026-01-08 07:22:59'),(175,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-08 07:30:37','2026-01-08 07:30:37'),(176,'auth','User logged in automatically','App\\Models\\Customer',NULL,19,'App\\Models\\Customer',19,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-08 08:15:40','2026-01-08 08:15:40'),(177,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-10 06:35:52','2026-01-10 06:35:52'),(178,'auth','User logged in automatically','App\\Models\\Customer',NULL,19,'App\\Models\\Customer',19,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-10 08:19:10','2026-01-10 08:19:10'),(179,'supplier','Added new supplier.','App\\Models\\Supplier',NULL,10,'App\\Models\\User',5,'{\"name\":\"bosske\",\"email\":\"danmichaelantiquina9@gmail.com\",\"phone\":\"09517372630\"}',NULL,'2026-01-10 08:49:53','2026-01-10 08:49:53'),(180,'auth','User logged in automatically','App\\Models\\Customer',NULL,19,'App\\Models\\Customer',19,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-10 19:38:45','2026-01-10 19:38:45'),(181,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',19,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-10 21:19:26','2026-01-10 21:19:26'),(182,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-10 21:19:37','2026-01-10 21:19:37'),(183,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-10 21:48:34','2026-01-10 21:48:34'),(184,'auth','User logged in automatically','App\\Models\\Customer',NULL,20,'App\\Models\\Customer',20,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-10 21:49:14','2026-01-10 21:49:14'),(185,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-10 21:52:54','2026-01-10 21:52:54'),(186,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-15 07:42:16','2026-01-15 07:42:16'),(187,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-15 07:42:28','2026-01-15 07:42:28'),(188,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-15 07:43:15','2026-01-15 07:43:15'),(189,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-15 07:44:30','2026-01-15 07:44:30'),(190,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-16 07:22:19','2026-01-16 07:22:19'),(191,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-16 07:22:33','2026-01-16 07:22:33'),(192,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-16 09:00:55','2026-01-16 09:00:55'),(193,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-16 09:40:08','2026-01-16 09:40:08'),(194,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-16 21:16:30','2026-01-16 21:16:30'),(195,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36 Edg\\/143.0.0.0\"}',NULL,'2026-01-16 22:27:45','2026-01-16 22:27:45'),(196,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-18 21:30:50','2026-01-18 21:30:50'),(197,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-18 21:39:19','2026-01-18 21:39:19'),(198,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-18 21:39:49','2026-01-18 21:39:49'),(199,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-18 22:03:40','2026-01-18 22:03:40'),(200,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-18 22:04:08','2026-01-18 22:04:08'),(201,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-18 22:09:00','2026-01-18 22:09:00'),(202,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/143.0.0.0 Safari\\/537.36\"}',NULL,'2026-01-18 22:15:51','2026-01-18 22:15:51'),(203,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-19 21:05:27','2026-01-19 21:05:27'),(204,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 02:24:02','2026-01-20 02:24:02'),(205,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 04:19:59','2026-01-20 04:19:59'),(206,'auth','User logged in automatically','App\\Models\\User',NULL,13,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 04:20:16','2026-01-20 04:20:16'),(207,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 05:05:06','2026-01-20 05:05:06'),(208,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 05:05:14','2026-01-20 05:05:14'),(209,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 07:13:35','2026-01-20 07:13:35'),(210,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 19:43:21','2026-01-20 19:43:21'),(211,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 19:43:30','2026-01-20 19:43:30'),(212,'auth','User logged in automatically','App\\Models\\User',NULL,13,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-20 19:43:40','2026-01-20 19:43:40'),(213,'auth','User logged in automatically','App\\Models\\User',NULL,13,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 05:29:39','2026-01-21 05:29:39'),(214,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 06:12:06','2026-01-21 06:12:06'),(215,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 06:12:18','2026-01-21 06:12:18'),(216,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 06:15:56','2026-01-21 06:15:56'),(217,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 06:50:11','2026-01-21 06:50:11'),(218,'auth','User logged in automatically','App\\Models\\User',NULL,13,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 06:50:21','2026-01-21 06:50:21'),(219,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 06:50:39','2026-01-21 06:50:39'),(220,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 06:50:46','2026-01-21 06:50:46'),(221,'auth','User logged in automatically','App\\Models\\User',NULL,13,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 06:57:16','2026-01-21 06:57:16'),(222,'auth','User logged in automatically','App\\Models\\User',NULL,13,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 23:11:20','2026-01-21 23:11:20'),(223,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 23:11:25','2026-01-21 23:11:25'),(224,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-21 23:11:33','2026-01-21 23:11:33'),(225,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 00:51:48','2026-01-22 00:51:48'),(226,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 01:09:52','2026-01-22 01:09:52'),(227,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 03:42:29','2026-01-22 03:42:29'),(228,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 04:21:45','2026-01-22 04:21:45'),(229,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 04:37:07','2026-01-22 04:37:07'),(230,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 05:54:15','2026-01-22 05:54:15'),(231,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 05:54:25','2026-01-22 05:54:25'),(232,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 05:55:28','2026-01-22 05:55:28'),(233,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 07:58:39','2026-01-22 07:58:39'),(234,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 07:59:00','2026-01-22 07:59:00'),(235,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 09:08:19','2026-01-22 09:08:19'),(236,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-22 09:09:41','2026-01-22 09:09:41'),(237,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-23 02:01:40','2026-01-23 02:01:40'),(238,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-23 02:10:02','2026-01-23 02:10:02'),(239,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-23 06:37:45','2026-01-23 06:37:45'),(240,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-23 08:03:16','2026-01-23 08:03:16'),(241,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-23 08:03:42','2026-01-23 08:03:42'),(242,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-23 09:17:04','2026-01-23 09:17:04'),(243,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-24 06:20:28','2026-01-24 06:20:28'),(244,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-24 06:21:13','2026-01-24 06:21:13'),(245,'auth','User logged in automatically','App\\Models\\User',NULL,13,'App\\Models\\User',13,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-24 06:23:02','2026-01-24 06:23:02'),(246,'supplier','Added new supplier.','App\\Models\\Supplier',NULL,11,'App\\Models\\User',5,'{\"name\":\"Sulaik\",\"email\":\"Sulaik123@gmail.com\",\"phone\":\"09234234234\"}',NULL,'2026-01-24 07:20:23','2026-01-24 07:20:23'),(247,'supplier','Updated Supplier information.','App\\Models\\Supplier',NULL,11,'App\\Models\\User',5,'{\"old\":{\"name\":\"Sulaik\",\"email\":\"Sulaik123@gmail.com\",\"phone\":\"09234234234\",\"address\":\"Tabi tabi lang\",\"image\":null},\"new\":{\"name\":\"Sulaikpogi\",\"email\":\"Sulaik123@gmail.com\",\"phone\":\"09234234234\",\"address\":\"Tabi tabi lang\",\"image\":null}}',NULL,'2026-01-24 07:20:56','2026-01-24 07:20:56'),(248,'supplier','Deleted a Supplier record.','App\\Models\\Supplier',NULL,11,'App\\Models\\User',5,'{\"old\":{\"id\":11,\"name\":\"Sulaikpogi\",\"email\":\"Sulaik123@gmail.com\",\"phone\":\"09234234234\",\"address\":\"Tabi tabi lang\",\"image\":null,\"created_at\":\"2026-01-24T15:20:23.000000Z\",\"updated_at\":\"2026-01-24T15:20:56.000000Z\"}}',NULL,'2026-01-24 07:21:29','2026-01-24 07:21:29'),(249,'supplier','Added new supplier.','App\\Models\\Supplier',NULL,12,'App\\Models\\User',5,'{\"name\":\"Sulaikpogi\",\"email\":\"Sulaik1234@gmail.com\",\"phone\":\"09234234234\"}',NULL,'2026-01-24 07:22:33','2026-01-24 07:22:33'),(250,'supplier','Added new supplier.','App\\Models\\Supplier',NULL,13,'App\\Models\\User',5,'{\"name\":\"Sulaikpogi\",\"email\":\"Sulaik123@gmail.com\",\"phone\":\"09234234232\"}',NULL,'2026-01-24 07:24:42','2026-01-24 07:24:42'),(251,'supplier','Deleted a Supplier record.','App\\Models\\Supplier',NULL,12,'App\\Models\\User',5,'{\"old\":{\"id\":12,\"name\":\"Sulaikpogi\",\"email\":\"Sulaik1234@gmail.com\",\"phone\":\"09234234234\",\"address\":\"Tabi tabi lang\",\"image\":null,\"created_at\":\"2026-01-24T15:22:33.000000Z\",\"updated_at\":\"2026-01-24T15:22:33.000000Z\"}}',NULL,'2026-01-24 07:24:52','2026-01-24 07:24:52'),(252,'supplier','Updated Supplier information.','App\\Models\\Supplier',NULL,13,'App\\Models\\User',5,'{\"old\":{\"name\":\"Sulaikpogi\",\"email\":\"Sulaik123@gmail.com\",\"phone\":\"09234234232\",\"address\":\"Tabi tabi langdasda\",\"image\":null},\"new\":{\"name\":\"Sulaikpoginawww\",\"email\":\"Sulaik123@gmail.coms\",\"phone\":\"09234234231\",\"address\":\"Tabi tabi langdasdaw\",\"image\":null}}',NULL,'2026-01-24 07:25:14','2026-01-24 07:25:14'),(253,'supplier','Updated Supplier information.','App\\Models\\Supplier',NULL,13,'App\\Models\\User',5,'{\"old\":{\"name\":\"Sulaikpoginawww\",\"email\":\"Sulaik123@gmail.coms\",\"phone\":\"09234234231\",\"address\":\"Tabi tabi langdasdaw\",\"image\":null},\"new\":{\"name\":\"Sulaikpoginawww\",\"email\":\"Sulaik123@gmail.comsasd\",\"phone\":\"09234234231\",\"address\":\"Tabi tabi langdasdaw\",\"image\":null}}',NULL,'2026-01-24 07:25:25','2026-01-24 07:25:25'),(254,'supplier','Deleted a Supplier record.','App\\Models\\Supplier',NULL,13,'App\\Models\\User',5,'{\"old\":{\"id\":13,\"name\":\"Sulaikpoginawww\",\"email\":\"Sulaik123@gmail.comsasd\",\"phone\":\"09234234231\",\"address\":\"Tabi tabi langdasdaw\",\"image\":null,\"created_at\":\"2026-01-24T15:24:42.000000Z\",\"updated_at\":\"2026-01-24T15:25:25.000000Z\"}}',NULL,'2026-01-24 07:26:24','2026-01-24 07:26:24'),(255,'default','Updated Product information.','App\\Models\\Product',NULL,18,'App\\Models\\User',5,'{\"old\":{\"id\":18,\"product_name\":\"zxcvbnm\",\"product_code\":\"PC000012\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1769270096\\/products\\/jkwlcodr5bkphp89rof7.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":8,\"description\":\"asdasdasdjasdajsd\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Male\",\"age_group\":\"Kids\",\"health_concern\":\"anxiety\",\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2026-01-24T15:54:56.000000Z\",\"updated_at\":\"2026-01-24T15:54:56.000000Z\"},\"new\":{\"id\":18,\"product_name\":\"zxcvbnm\",\"product_code\":\"PC000012\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1769270393\\/products\\/mdoc98duqfl1govput5i.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":8,\"description\":\"asdasdasdjasdajsd\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Male\",\"age_group\":\"Kids\",\"health_concern\":\"anxiety\",\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2026-01-24T15:54:56.000000Z\",\"updated_at\":\"2026-01-24T15:59:53.000000Z\"}}',NULL,'2026-01-24 07:59:53','2026-01-24 07:59:53'),(256,'default','Deleted a Product record.','App\\Models\\Product',NULL,18,'App\\Models\\User',5,'{\"old\":{\"id\":18,\"product_name\":\"zxcvbnm\",\"product_code\":\"PC000012\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1769270393\\/products\\/mdoc98duqfl1govput5i.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":8,\"description\":\"asdasdasdjasdajsd\",\"dosage_form\":\"Capsule\",\"target_gender\":\"Male\",\"age_group\":\"Kids\",\"health_concern\":\"anxiety\",\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2026-01-24T15:54:56.000000Z\",\"updated_at\":\"2026-01-24T15:59:53.000000Z\"}}',NULL,'2026-01-24 08:00:14','2026-01-24 08:00:14'),(257,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-24 09:04:52','2026-01-24 09:04:52'),(258,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-24 09:06:07','2026-01-24 09:06:07'),(259,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-24 10:13:47','2026-01-24 10:13:47'),(260,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-25 01:34:36','2026-01-25 01:34:36'),(261,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-25 01:35:31','2026-01-25 01:35:31'),(262,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-25 19:52:40','2026-01-25 19:52:40'),(263,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-25 23:08:56','2026-01-25 23:08:56'),(264,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-26 02:30:03','2026-01-26 02:30:03'),(265,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-27 04:52:02','2026-01-27 04:52:02'),(266,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-27 05:00:26','2026-01-27 05:00:26'),(267,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-27 05:28:20','2026-01-27 05:28:20'),(268,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-27 22:14:10','2026-01-27 22:14:10'),(269,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-27 23:24:43','2026-01-27 23:24:43'),(270,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-27 23:24:53','2026-01-27 23:24:53'),(271,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}',NULL,'2026-01-28 04:32:13','2026-01-28 04:32:13'),(272,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}',NULL,'2026-01-28 04:33:08','2026-01-28 04:33:08'),(273,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-29 00:59:38','2026-01-29 00:59:38'),(274,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-29 01:29:46','2026-01-29 01:29:46'),(275,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-29 01:30:00','2026-01-29 01:30:00'),(276,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-29 04:05:38','2026-01-29 04:05:38'),(277,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-29 04:46:42','2026-01-29 04:46:42'),(278,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-29 16:35:59','2026-01-29 16:35:59'),(279,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-29 16:41:46','2026-01-29 16:41:46'),(280,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-30 00:45:34','2026-01-30 00:45:34'),(281,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-30 00:46:22','2026-01-30 00:46:22'),(282,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-30 08:16:22','2026-01-30 08:16:22'),(283,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 06:16:51','2026-01-31 06:16:51'),(284,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 06:47:45','2026-01-31 06:47:45'),(285,'supplier','Updated Supplier information.','App\\Models\\Supplier',NULL,9,'App\\Models\\User',5,'{\"old\":{\"name\":\"pharma\",\"email\":\"pharmaaa\\/\\/\\/@gmail.com\",\"phone\":\"09123939181\",\"address\":\"muntinlupa\",\"image\":null},\"new\":{\"name\":\"pharma\",\"email\":\"tarucjohneric19@gmail.com\",\"phone\":\"09123939181\",\"address\":\"muntinlupa\",\"image\":null}}',NULL,'2026-01-31 08:21:37','2026-01-31 08:21:37'),(286,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:11:07','2026-01-31 10:11:07'),(287,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:13:06','2026-01-31 10:13:06'),(288,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:13:23','2026-01-31 10:13:23'),(289,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:18:36','2026-01-31 10:18:36'),(290,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:32:43','2026-01-31 10:32:43'),(291,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:37:52','2026-01-31 10:37:52'),(292,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:41:29','2026-01-31 10:41:29'),(293,'auth','User logged in automatically','App\\Models\\Customer',NULL,18,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:41:46','2026-01-31 10:41:46'),(294,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',18,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:44:17','2026-01-31 10:44:17'),(295,'auth','User logged in automatically','App\\Models\\Customer',NULL,21,'App\\Models\\Customer',21,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:46:12','2026-01-31 10:46:12'),(296,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',21,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:47:20','2026-01-31 10:47:20'),(297,'auth','User logged in automatically','App\\Models\\Customer',NULL,21,'App\\Models\\Customer',21,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:47:41','2026-01-31 10:47:41'),(298,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-01-31 10:51:32','2026-01-31 10:51:32'),(299,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-01 03:31:43','2026-02-01 03:31:43'),(300,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-01 06:20:35','2026-02-01 06:20:35'),(301,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-01 20:17:37','2026-02-01 20:17:37'),(302,'default','Updated Product information.','App\\Models\\Product',NULL,19,'App\\Models\\User',5,'{\"old\":{\"id\":19,\"product_name\":\"Biogesic1000mg\",\"product_code\":\"PC000012\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1770008483\\/products\\/d51drzmjhfegg9jy6aom.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":8,\"description\":null,\"dosage_form\":\"Syrup\",\"target_gender\":null,\"age_group\":null,\"health_concern\":null,\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2026-02-02T05:01:24.000000Z\",\"updated_at\":\"2026-02-02T05:01:24.000000Z\"},\"new\":{\"id\":19,\"product_name\":\"Biogesic1000mg\",\"product_code\":\"PC000012\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1770008483\\/products\\/d51drzmjhfegg9jy6aom.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":8,\"description\":\"eto na pangmalakasan\",\"dosage_form\":\"Syrup\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":null,\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2026-02-02T05:01:24.000000Z\",\"updated_at\":\"2026-02-02T05:15:53.000000Z\"}}',NULL,'2026-02-01 21:15:53','2026-02-01 21:15:53'),(303,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-02 01:48:40','2026-02-02 01:48:40'),(304,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-02 01:48:57','2026-02-02 01:48:57'),(305,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-02 02:39:12','2026-02-02 02:39:12'),(306,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-02 02:44:57','2026-02-02 02:44:57'),(307,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-02 03:31:17','2026-02-02 03:31:17'),(308,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-02 20:22:47','2026-02-02 20:22:47'),(309,'supplier','Updated Supplier information.','App\\Models\\Supplier',NULL,1,'App\\Models\\User',5,'{\"old\":{\"name\":\"BOSSINGs\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372538\",\"address\":\"Block 5 South Daang H\",\"image\":\"uploads\\/supplier_image\\/1846426300492627.png\"},\"new\":{\"name\":\"BOSSINGs\",\"email\":\"danmichaelantiquina14@outlook.com\",\"phone\":\"09517372538\",\"address\":\"Block 5 South Daang H\",\"image\":\"uploads\\/supplier_image\\/1846426300492627.png\"}}',NULL,'2026-02-02 20:38:25','2026-02-02 20:38:25'),(310,'default','Updated Product information.','App\\Models\\Product',NULL,19,'App\\Models\\User',5,'{\"old\":{\"id\":19,\"product_name\":\"Biogesic1000mg\",\"product_code\":\"PC000012\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1770008483\\/products\\/d51drzmjhfegg9jy6aom.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":8,\"description\":\"eto na pangmalakasan\",\"dosage_form\":\"Syrup\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":null,\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2026-02-02T05:01:24.000000Z\",\"updated_at\":\"2026-02-02T05:15:53.000000Z\"},\"new\":{\"id\":19,\"product_name\":\"Biogesic1000mg\",\"product_code\":\"PC000012\",\"product_image\":\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1770008483\\/products\\/d51drzmjhfegg9jy6aom.png\",\"category_id\":3,\"subcategory_id\":2,\"brand_id\":8,\"description\":\"eto na pangmalakasan\",\"dosage_form\":\"Syrup\",\"target_gender\":\"Unisex\",\"age_group\":\"All\",\"health_concern\":null,\"selling_price\":\"20.00\",\"has_expiration\":1,\"prescription_required\":0,\"created_at\":\"2026-02-02T05:01:24.000000Z\",\"updated_at\":\"2026-02-03T05:33:40.000000Z\"}}',NULL,'2026-02-02 21:33:40','2026-02-02 21:33:40'),(311,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-03 08:30:47','2026-02-03 08:30:47'),(312,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-03 09:57:40','2026-02-03 09:57:40'),(313,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}',NULL,'2026-02-03 10:09:09','2026-02-03 10:09:09'),(314,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-04 06:37:04','2026-02-04 06:37:04'),(315,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-04 06:38:10','2026-02-04 06:38:10'),(316,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-04 09:18:46','2026-02-04 09:18:46'),(317,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 05:06:30','2026-02-05 05:06:30'),(318,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 06:24:27','2026-02-05 06:24:27'),(319,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 09:39:38','2026-02-05 09:39:38'),(320,'auth','User logged in automatically','App\\Models\\Customer',NULL,16,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 09:40:20','2026-02-05 09:40:20'),(321,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',16,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 09:51:22','2026-02-05 09:51:22'),(322,'auth','User logged in automatically','App\\Models\\Customer',NULL,22,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 09:53:59','2026-02-05 09:53:59'),(323,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 09:54:28','2026-02-05 09:54:28'),(324,'auth','User logged in automatically','App\\Models\\Customer',NULL,22,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 10:06:27','2026-02-05 10:06:27'),(325,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 10:51:54','2026-02-05 10:51:54'),(326,'auth','User logged in automatically','App\\Models\\Customer',NULL,22,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 23:56:22','2026-02-05 23:56:22'),(327,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-05 23:57:47','2026-02-05 23:57:47'),(328,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-07 06:05:36','2026-02-07 06:05:36'),(329,'auth','User logged in automatically','App\\Models\\Customer',NULL,22,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-07 18:48:44','2026-02-07 18:48:44'),(330,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-09 02:31:56','2026-02-09 02:31:56'),(331,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-09 04:50:44','2026-02-09 04:50:44'),(332,'auth','User logged in automatically','App\\Models\\Customer',NULL,22,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-09 05:04:04','2026-02-09 05:04:04'),(333,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-09 05:09:09','2026-02-09 05:09:09'),(334,'auth','User logged in automatically','App\\Models\\Customer',NULL,22,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-09 05:09:17','2026-02-09 05:09:17'),(335,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-09 05:10:23','2026-02-09 05:10:23'),(336,'auth','User logged in automatically','App\\Models\\Customer',NULL,22,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}',NULL,'2026-02-09 05:15:48','2026-02-09 05:15:48'),(337,'auth','User logged out automatically',NULL,NULL,NULL,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}',NULL,'2026-02-09 05:28:13','2026-02-09 05:28:13'),(338,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36\"}',NULL,'2026-02-09 05:28:50','2026-02-09 05:28:50'),(339,'auth','User logged in automatically','App\\Models\\Customer',NULL,22,'App\\Models\\Customer',22,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-09 06:11:41','2026-02-09 06:11:41'),(340,'auth','User logged in automatically','App\\Models\\User',NULL,5,'App\\Models\\User',5,'{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/144.0.0.0 Safari\\/537.36 Edg\\/144.0.0.0\"}',NULL,'2026-02-10 22:26:45','2026-02-10 22:26:45');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_customer_id_foreign` (`customer_id`),
  CONSTRAINT `addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,18,'bosske','09517372530','Block 5 South Daang Hari','sdh','Muntinlupa',0,'2026-01-23 03:27:32','2026-01-23 08:18:41'),(2,18,'gagi','09517372532','Block 5 South Daang Hari','gagi','Muntinlupa',0,'2026-01-23 04:39:30','2026-01-23 08:18:41'),(3,18,'negats','09517372532','Block 5 South Daang Hari','gagi','Muntinlupa',0,'2026-01-23 04:48:33','2026-01-23 08:18:41'),(4,18,'Dan michael Cape Antiquina','09517372530','Block 5 South Daang Hari','taguigeneo','Muntinlupa',0,'2026-01-23 04:52:54','2026-01-23 08:18:41'),(5,18,'sucat','09517372530','Block 5 South Daang Hari','taguigeneo','Muntinlupa',0,'2026-01-23 04:58:04','2026-01-23 08:18:41'),(6,18,'sucat','09517372530','Block 5 South Daang Hari','taguigeneo','Muntinlupa',1,'2026-01-23 08:18:41','2026-01-23 08:18:41'),(7,16,'Dan michael Cape Antiquina','09517372530','Block 5 South Daang Hari','SDH','Muntinlupa',1,'2026-02-03 08:31:08','2026-02-03 08:31:08'),(8,22,'Dan michael Cape Antiquina','09517372530','Block 5 South Daang Hari','SDH','Muntinlupa',1,'2026-02-06 02:32:37','2026-02-06 02:32:37');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `attend_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (9,7,'2025-10-27','present','2025-10-27 06:56:23','2025-10-27 06:56:23'),(10,8,'2025-10-27','present','2025-10-27 06:56:23','2025-10-27 06:56:23'),(11,7,'2025-10-29','present','2025-10-27 06:56:39','2025-10-27 06:56:39'),(12,8,'2025-10-29','present','2025-10-27 06:56:39','2025-10-27 06:56:39');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Silicon Valley','uploads/brand_image/1846426483998581.png','the best of the best',NULL,NULL),(5,'chrome','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761538628/brands/nmnv1per7nq5ygm4wgjk.png','asdas','2025-10-26 20:17:11','2025-10-26 20:17:11'),(7,'sdfsdfsdfsdf','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761585185/brands/tvii8gbmu9azlilq1ibk.png','sdfsdfsdfs','2025-10-27 09:13:06','2025-10-27 09:13:06'),(8,'github','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1766467585/brands/p5rgbgwtgmzequd3zirm.png','gihtubina','2025-12-22 21:26:25','2025-12-22 21:26:25'),(10,'gengeng','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1770094578/brands/gc8fz2pabsildh3ytapf.png','hhahahaha','2026-02-02 20:56:21','2026-02-02 20:56:21');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_titles`
--

DROP TABLE IF EXISTS `business_titles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business_titles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_titles`
--

LOCK TABLES `business_titles` WRITE;
/*!40000 ALTER TABLE `business_titles` DISABLE KEYS */;
INSERT INTO `business_titles` VALUES (1,'Salinio Drug Pharmacy',NULL,'2026-01-28 04:55:28');
/*!40000 ALTER TABLE `business_titles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('pos_ecommerce_cachecategories','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:7:{i:0;O:19:\"App\\Models\\Category\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:1;s:13:\"category_name\";s:4:\"Hair\";s:4:\"slug\";s:4:\"hair\";s:10:\"created_at\";s:19:\"2025-10-19 15:53:34\";s:10:\"updated_at\";s:19:\"2025-10-19 15:53:34\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:1;s:13:\"category_name\";s:4:\"Hair\";s:4:\"slug\";s:4:\"hair\";s:10:\"created_at\";s:19:\"2025-10-19 15:53:34\";s:10:\"updated_at\";s:19:\"2025-10-19 15:53:34\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:1;O:19:\"App\\Models\\Category\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:2;s:13:\"category_name\";s:8:\"Skincare\";s:4:\"slug\";s:8:\"skincare\";s:10:\"created_at\";s:19:\"2025-10-19 16:18:34\";s:10:\"updated_at\";s:19:\"2025-10-19 16:21:38\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:2;s:13:\"category_name\";s:8:\"Skincare\";s:4:\"slug\";s:8:\"skincare\";s:10:\"created_at\";s:19:\"2025-10-19 16:18:34\";s:10:\"updated_at\";s:19:\"2025-10-19 16:21:38\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:2;O:19:\"App\\Models\\Category\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:3;s:13:\"category_name\";s:6:\"Health\";s:4:\"slug\";s:6:\"health\";s:10:\"created_at\";s:19:\"2025-10-19 16:22:17\";s:10:\"updated_at\";s:19:\"2025-10-19 16:22:17\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:3;s:13:\"category_name\";s:6:\"Health\";s:4:\"slug\";s:6:\"health\";s:10:\"created_at\";s:19:\"2025-10-19 16:22:17\";s:10:\"updated_at\";s:19:\"2025-10-19 16:22:17\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:3;O:19:\"App\\Models\\Category\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:4;s:13:\"category_name\";s:6:\"Makeup\";s:4:\"slug\";s:6:\"makeup\";s:10:\"created_at\";s:19:\"2025-10-19 16:22:43\";s:10:\"updated_at\";s:19:\"2025-10-19 16:22:43\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:4;s:13:\"category_name\";s:6:\"Makeup\";s:4:\"slug\";s:6:\"makeup\";s:10:\"created_at\";s:19:\"2025-10-19 16:22:43\";s:10:\"updated_at\";s:19:\"2025-10-19 16:22:43\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:4;O:19:\"App\\Models\\Category\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:6;s:13:\"category_name\";s:13:\"Personal Care\";s:4:\"slug\";s:13:\"personal-care\";s:10:\"created_at\";s:19:\"2025-10-19 16:23:35\";s:10:\"updated_at\";s:19:\"2025-10-19 16:23:35\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:6;s:13:\"category_name\";s:13:\"Personal Care\";s:4:\"slug\";s:13:\"personal-care\";s:10:\"created_at\";s:19:\"2025-10-19 16:23:35\";s:10:\"updated_at\";s:19:\"2025-10-19 16:23:35\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:5;O:19:\"App\\Models\\Category\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:8;s:13:\"category_name\";s:4:\"gaga\";s:4:\"slug\";s:4:\"gaga\";s:10:\"created_at\";s:19:\"2025-10-27 19:29:57\";s:10:\"updated_at\";s:19:\"2025-10-27 19:29:57\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:8;s:13:\"category_name\";s:4:\"gaga\";s:4:\"slug\";s:4:\"gaga\";s:10:\"created_at\";s:19:\"2025-10-27 19:29:57\";s:10:\"updated_at\";s:19:\"2025-10-27 19:29:57\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:6;O:19:\"App\\Models\\Category\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:9;s:13:\"category_name\";s:8:\"pleaseee\";s:4:\"slug\";s:8:\"pleaseee\";s:10:\"created_at\";s:19:\"2025-10-27 19:32:27\";s:10:\"updated_at\";s:19:\"2025-10-27 19:32:27\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:9;s:13:\"category_name\";s:8:\"pleaseee\";s:4:\"slug\";s:8:\"pleaseee\";s:10:\"created_at\";s:19:\"2025-10-27 19:32:27\";s:10:\"updated_at\";s:19:\"2025-10-27 19:32:27\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',2086154456);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Hair','hair','2025-10-19 07:53:34','2025-10-19 07:53:34'),(2,'Skincare','skincare','2025-10-19 08:18:34','2025-10-19 08:21:38'),(3,'Health','health','2025-10-19 08:22:17','2025-10-19 08:22:17'),(4,'Makeup','makeup','2025-10-19 08:22:43','2025-10-19 08:22:43'),(6,'Personal Care','personal-care','2025-10-19 08:23:35','2025-10-19 08:23:35'),(8,'gaga','gaga','2025-10-27 11:29:57','2025-10-27 11:29:57'),(9,'pleaseee','pleaseee','2025-10-27 11:32:27','2025-10-27 11:32:27');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) unsigned NOT NULL,
  `receiver_id` bigint(20) unsigned NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
INSERT INTO `chats` VALUES (40,5,16,'naknang',0,'2025-12-26 02:33:49','2025-12-26 02:33:49'),(41,16,5,'etibac',0,'2025-12-26 02:44:53','2025-12-26 02:44:53'),(42,5,16,'nani',0,'2025-12-26 02:45:05','2025-12-26 02:45:05'),(43,16,5,'sd',0,'2025-12-26 02:51:42','2025-12-26 02:51:42'),(44,16,5,'asd',0,'2025-12-26 02:51:47','2025-12-26 02:51:47'),(45,16,5,'boss kaba',0,'2025-12-26 02:51:51','2025-12-26 02:51:51'),(46,16,5,'taena neto',0,'2025-12-26 02:51:56','2025-12-26 02:51:56'),(47,16,5,'laskas mo boy',0,'2025-12-26 02:52:02','2025-12-26 02:52:02'),(48,5,16,'edi waw',0,'2025-12-26 02:52:29','2025-12-26 02:52:29'),(49,5,16,'baliw kaba',0,'2025-12-26 02:52:35','2025-12-26 02:52:35'),(50,16,5,'oo nalng',0,'2025-12-26 02:52:44','2025-12-26 02:52:44'),(51,16,5,'eto na',0,'2025-12-26 02:52:51','2025-12-26 02:52:51'),(52,16,5,'gasoas',0,'2025-12-26 02:53:00','2025-12-26 02:53:00'),(53,16,5,'eya',0,'2025-12-26 02:53:06','2025-12-26 02:53:06'),(54,16,5,'oo nalngs',0,'2025-12-26 02:53:14','2025-12-26 02:53:14'),(55,16,5,'bosss',0,'2026-01-02 06:13:53','2026-01-02 06:13:53'),(60,18,5,'hello po',0,'2026-01-18 22:47:34','2026-01-18 22:47:34'),(61,5,18,'anong concern po',0,'2026-01-18 22:47:44','2026-01-18 22:47:44'),(62,18,5,'ask lng po ako about if open ung store niyo',0,'2026-01-18 22:48:03','2026-01-18 22:48:03'),(63,5,18,'yes po',0,'2026-01-18 22:48:11','2026-01-18 22:48:11'),(64,18,5,'thanks',0,'2026-01-18 22:48:16','2026-01-18 22:48:16'),(65,5,18,'bosrap',0,'2026-01-28 04:34:14','2026-01-28 04:34:14'),(66,18,5,'bakit',0,'2026-01-28 04:34:21','2026-01-28 04:34:21');
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `added_by_staff` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_google_id_unique` (`google_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (2,'Angelo Lopez','gelo6403@gmail.com',NULL,'09159381304','taguig city','uploads/customer_image/1846967903243512.png',1,NULL,'2025-10-25 07:24:12','2025-10-25 07:24:12',NULL),(5,'john carlo dote','dotelangmalakas@gmail.com',NULL,'09123939191','muntinlupa',NULL,1,NULL,'2025-10-26 03:15:48','2025-10-26 03:15:48',NULL),(6,'Bosske12','danmichaelantiquina23@outlook.com',NULL,'09514272530','muntinlupa','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761537275/customers/gqzfbsjbslaqgimiym2x.png',1,NULL,'2025-10-26 19:48:17','2025-10-26 19:54:38',NULL),(16,'salinio','danmichaelantiquina15@gmail.com','$2y$10$3W9MlBj/VtHwL6pJlxuENuEzEEe1kE15aCDMMe2qp.Dq70aI4mEKq','+639159381304',NULL,NULL,0,NULL,'2025-10-27 14:10:24','2025-10-27 14:10:24',NULL),(17,'tarucjohn','taruc14@gmail.com','$2y$10$NAICwYIu3xJr5IkCyDZTP.Fjs69SU4aGujiIQ637oaldMMfgOfhWa','09382481713',NULL,NULL,0,NULL,'2025-10-27 22:12:21','2025-10-27 22:12:21',NULL),(18,'Antiquina Danmichaels','danmichaelantiquina22@gmail.com','$2y$10$bFkEoZp1vxiCsxiEmu3XkOrf7g3pVvy3hi/.uQ00uaUbYsnQV/ple','+639391600935',NULL,NULL,0,NULL,'2026-01-08 06:16:44','2026-01-31 10:44:03',NULL),(19,'John Eric Taruc','tarucjohneric19@gmail.com','$2y$10$SeHcjo8QxR8ILMaxaTOIeeKt1mgRk/C9vzwyeYbnINROwLLT4Vh2.','9391600935',NULL,NULL,1,NULL,'2026-01-08 07:22:37','2026-01-08 07:22:37',NULL),(20,'Aljon','aljonf728@gmail.com','$2y$10$2qGnj0SOw16yOzEj9pYGfe13kokxkg.eqWrsTQ23KgmE1pT3EalRi','+639123939191',NULL,NULL,1,NULL,'2026-01-10 21:49:14','2026-01-10 21:49:14',NULL),(21,'Vex','asdasdasd@gmail.com','$2y$10$AQDS5k34aUf4mP71cRLRou7STbVhDTdfFhU0hBMPmFCfleZbTiUK2','093242342342342342342sda34234',NULL,NULL,0,NULL,'2026-01-31 10:46:12','2026-01-31 10:46:12',NULL),(22,'Dan michael Cape Antiquina','danmichaelantiquina9@gmail.com','$2y$10$.bu.8AWH2W/2apvj98Vyoe4x8odIru2O1.3DJTA/ekprTC6VvpLbu','+639517372530',NULL,'https://res.cloudinary.com/dqhdcwq3q/image/upload/v1770317668/customer_images/dbjwloraiq7fnaylbskr.jpg',0,'lq6B8ulFqUHFrIvirXnSVv21L9yB2t7DPECqD48j2quKmQNrPwEdXf1DlMKV','2026-02-05 09:53:59','2026-02-09 05:15:42',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deliveries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_order_id` bigint(20) unsigned NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deliveries_purchase_order_id_foreign` (`purchase_order_id`),
  CONSTRAINT `deliveries_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
INSERT INTO `deliveries` VALUES (12,36,'2026-01-19',NULL,NULL,'2026-01-19 00:43:59','2026-01-19 00:43:59'),(13,48,'2026-02-03',NULL,'genggeng','2026-02-03 06:57:58','2026-02-03 06:57:58');
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_items`
--

DROP TABLE IF EXISTS `delivery_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `batch_number` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `quantity_received` int(11) NOT NULL DEFAULT 0,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_items_delivery_id_foreign` (`delivery_id`),
  KEY `delivery_items_product_id_foreign` (`product_id`),
  CONSTRAINT `delivery_items_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `delivery_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_items`
--

LOCK TABLES `delivery_items` WRITE;
/*!40000 ALTER TABLE `delivery_items` DISABLE KEYS */;
INSERT INTO `delivery_items` VALUES (13,12,3,'BATCH-20260119-3-MAZT','2029-07-11',9,15.00,'2026-01-19 00:43:59','2026-01-19 00:43:59'),(14,12,10,'BATCH-20260119-10-ZQKI','2028-06-13',8,190.00,'2026-01-19 00:43:59','2026-01-19 00:43:59'),(15,13,1,'BATCH-20260203-1-LBCH',NULL,7,90.00,'2026-02-03 06:57:58','2026-02-03 06:57:58');
/*!40000 ALTER TABLE `delivery_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `vat_exempt` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,'senior',12.00,1,1,'2025-10-24 02:29:17','2025-10-24 02:29:17'),(6,'PWD',12.00,1,1,'2025-10-27 21:59:57','2025-10-27 22:00:17'),(7,'gege',12.00,1,1,'2026-01-20 06:01:23','2026-01-20 06:01:23');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `details` text NOT NULL,
  `amount` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'werwerwerwerwerwe','200','October','2025','25-10-2025','2025-10-25 08:12:38','2025-10-25 10:54:36'),(3,'werwerwerwerwerwe','100','October','2025','25-10-2025','2025-10-25 10:48:27',NULL),(4,'Ink','400','October','2025','28-10-2025','2025-10-27 22:06:09',NULL);
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero_sliders`
--

DROP TABLE IF EXISTS `hero_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hero_sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero_sliders`
--

LOCK TABLES `hero_sliders` WRITE;
/*!40000 ALTER TABLE `hero_sliders` DISABLE KEYS */;
INSERT INTO `hero_sliders` VALUES (5,'SALINIO DRUG',NULL,'https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761631395/heroslider/fdr7cjjde1o6vp47fuz3.png',NULL,0,1,'2025-10-27 22:03:16','2025-10-27 22:03:16');
/*!40000 ALTER TABLE `hero_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `supplier_id` bigint(20) unsigned DEFAULT NULL,
  `batch_number` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `cost_price` decimal(10,2) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventories_product_id_foreign` (`product_id`),
  KEY `inventories_supplier_id_foreign` (`supplier_id`),
  KEY `inventories_batch_number_index` (`batch_number`),
  KEY `inventories_expiry_date_index` (`expiry_date`),
  KEY `inventories_cost_price_index` (`cost_price`),
  CONSTRAINT `inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inventories_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` VALUES (1,1,1,'BATCH-20251019-1-DQEI','2029-01-30','2025-10-19',-1,'active',90.00,100.00,'2025-10-19 08:13:45','2025-11-30 06:42:31'),(2,2,1,'BATCH-20251020-2-LXGW','2024-11-18','2025-10-20',2,'expired',15.00,20.00,'2025-10-19 20:11:05','2026-02-05 09:06:44'),(3,9,4,'BATCH-20251027-9-YAPL',NULL,'2025-10-27',0,'active',13.00,15.00,'2025-10-27 12:33:34','2026-02-09 07:23:09'),(4,3,4,'BATCH-20251027-3-LL86','2025-12-24','2025-10-27',0,'active',15.00,20.00,'2025-10-27 12:39:05','2026-01-24 08:50:09'),(5,3,9,'BATCH-20251028-3-QD1H','2027-07-07','2025-10-28',0,'active',18.00,20.00,'2025-10-27 21:36:05','2026-01-24 08:50:09'),(6,1,9,'BATCH-20251028-1-G7D7','2026-11-26','2025-10-28',0,'active',95.00,100.00,'2025-10-27 21:36:05','2026-02-09 05:10:02'),(7,1,4,'BATCH-20251028-1-CHZA','2027-11-18','2025-10-28',0,'active',30.00,100.00,'2025-10-27 21:38:21','2026-02-09 05:10:02'),(8,1,9,'BATCH-20260108-1-VFOQ','2026-06-24','2026-01-08',0,'active',26.00,100.00,'2026-01-08 08:19:46','2026-02-09 05:10:02'),(9,2,1,'BATCH-20260110-2-X2YR','2026-06-09','2026-01-10',20,'active',18.00,20.00,'2026-01-10 07:14:18','2026-01-10 07:14:18'),(10,3,10,'BATCH-20260119-3-MAZT','2029-07-11','2026-01-19',5,'active',15.00,20.00,'2026-01-19 00:43:59','2026-01-24 08:50:09'),(11,10,10,'BATCH-20260119-10-ZQKI','2028-06-13','2026-01-19',0,'active',190.00,200.00,'2026-01-19 00:43:59','2026-02-06 02:58:20'),(12,1,10,'BATCH-20260203-1-LBCH',NULL,'2026-02-03',0,'active',90.00,100.00,'2026-02-03 06:57:58','2026-02-09 05:10:02'),(13,9,NULL,NULL,NULL,'2026-02-09',5,'active',0.00,15.00,'2026-02-09 07:15:52','2026-02-09 07:23:09');
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `medially_type` varchar(255) NOT NULL,
  `medially_id` bigint(20) unsigned NOT NULL,
  `file_url` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `size` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_medially_type_medially_id_index` (`medially_type`,`medially_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_12_23_120000_create_shoppingcart_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2025_07_19_055714_create_attendances_table',1),(7,'2025_07_23_101705_create_expenses_table',1),(8,'2025_08_14_151204_create_permission_tables',1),(9,'2025_08_24_113144_create_hero_sliders_table',1),(10,'2025_08_30_061326_create_brands_table',1),(11,'2025_08_30_172551_create_business_titles_table',2),(12,'2025_09_21_092501_add_must_change_password_to_users_table',3),(13,'2025_09_21_104501_add_temp_password_to_users_table',3),(14,'2025_10_04_140620_create_vats_table',3),(15,'2025_10_04_150134_create_discounts_table',3),(16,'2025_10_10_015433_create_activity_log_table',3),(17,'2025_10_10_015434_add_event_column_to_activity_log_table',3),(18,'2025_10_10_015435_add_batch_uuid_column_to_activity_log_table',3),(19,'2025_10_19_010937_create_all_tables',4),(20,'2025_10_19_151315_add_group_name_to_permissions_table',5),(21,'2025_10_19_160929_create_purchase_order_items_table',6),(22,'2025_10_24_041609_add_status_to_inventories_table',7),(23,'2020_06_14_000001_create_media_table',8),(24,'2025_12_26_075207_create_chats_table',8),(25,'2025_12_26_075747_create_chats_table',9),(26,'2026_01_15_152644_add_google_id_to_customers_table',10),(27,'2026_01_17_060104_add_supplier_confirmation_to_purchase_orders',11),(28,'2026_01_19_071123_add_expiration_date_to_purchase_order_items_table',12),(29,'2026_01_20_100156_create_riders_table',13),(30,'2026_01_20_100310_add_delivery_fields_to_orders_table',14),(31,'2026_01_20_101625_create_riders_table',15),(32,'2026_01_21_152806_add_courier_and_tracking_to_orders_table',16),(33,'2026_01_23_105909_create_addresses_table',17),(34,'2026_01_25_090449_create_mock_shipments_table',18),(35,'2026_01_29_112357_create_return_requests_table',19),(36,'2026_01_29_112431_create_return_shipments_table',19),(37,'2026_01_30_070739_add_sms_sent_at_to_mock_shipments_table',20),(38,'2026_02_01_144920_create_sessions_table',21),(39,'2026_02_02_045755_make_ecommerce_fields_nullable_in_products_table',22),(40,'2026_02_02_105916_create_cache_table',23),(41,'2026_02_03_160548_add_paypal_order_id_to_orders',24),(42,'2026_02_05_125536_add_paypal_capture_id_to_orders_table',25),(43,'2026_02_05_135341_add_refund_columns_to_return_requests_table',26),(44,'2026_02_05_153300_update_return_requests_table_for_refunds',27);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mock_shipments`
--

DROP TABLE IF EXISTS `mock_shipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mock_shipments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `delivery_status` enum('ready_for_shipment','picked_up','out_for_delivery','delivered') NOT NULL DEFAULT 'ready_for_shipment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sms_sent_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mock_shipments_tracking_number_unique` (`tracking_number`),
  KEY `mock_shipments_order_id_foreign` (`order_id`),
  CONSTRAINT `mock_shipments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mock_shipments`
--

LOCK TABLES `mock_shipments` WRITE;
/*!40000 ALTER TABLE `mock_shipments` DISABLE KEYS */;
INSERT INTO `mock_shipments` VALUES (17,157,'jnt4323441','delivered','2026-02-05 09:04:25','2026-02-05 09:06:15','2026-02-05 09:05:17'),(18,162,'jnt7786915','delivered','2026-02-05 10:28:52','2026-02-05 10:30:16','2026-02-05 10:29:20'),(19,174,'jnt4694972','delivered','2026-02-09 06:13:06','2026-02-09 06:15:15','2026-02-09 06:14:16');
/*!40000 ALTER TABLE `mock_shipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\User',4),(1,'App\\Models\\User',5),(2,'App\\Models\\User',2),(2,'App\\Models\\User',8),(2,'App\\Models\\User',9),(2,'App\\Models\\User',10),(2,'App\\Models\\User',12),(3,'App\\Models\\User',7),(6,'App\\Models\\User',11);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `batch_number` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unitcost` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `profit` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orderdetails_order_id_foreign` (`order_id`),
  KEY `orderdetails_product_id_foreign` (`product_id`),
  CONSTRAINT `orderdetails_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orderdetails_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetails`
--

LOCK TABLES `orderdetails` WRITE;
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
INSERT INTO `orderdetails` VALUES (100,157,2,NULL,1,15.00,NULL,5.00,'2026-02-05 09:02:48','2026-02-05 09:06:44'),(101,159,1,NULL,1,NULL,NULL,NULL,'2026-02-05 09:43:25','2026-02-05 09:43:25'),(102,161,1,NULL,1,NULL,NULL,NULL,'2026-02-05 10:09:46','2026-02-05 10:09:46'),(103,162,1,NULL,1,95.00,NULL,5.00,'2026-02-05 10:15:26','2026-02-05 10:36:06'),(104,168,9,NULL,1,13.00,NULL,2.00,'2026-02-06 02:53:18','2026-02-06 02:53:18'),(105,169,1,NULL,1,95.00,NULL,5.00,'2026-02-06 02:55:57','2026-02-06 02:55:57'),(106,170,10,NULL,14,190.00,NULL,140.00,'2026-02-06 02:58:20','2026-02-06 02:58:20'),(107,172,9,'BATCH-20251027-9-YAPL',6,13.00,90.00,12.00,'2026-02-07 06:17:22','2026-02-07 06:17:22'),(108,173,1,NULL,65,73.40,NULL,1729.00,'2026-02-09 05:10:02','2026-02-09 05:10:02'),(109,174,9,NULL,6,13.00,NULL,12.00,'2026-02-09 06:12:10','2026-02-09 06:12:10'),(110,175,9,NULL,2,13.00,NULL,4.00,'2026-02-09 07:22:15','2026-02-09 07:22:15'),(111,176,9,NULL,13,12.00,NULL,39.00,'2026-02-09 07:23:09','2026-02-09 07:23:09');
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_source` enum('POS','ECOM') NOT NULL DEFAULT 'POS',
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_type` varchar(255) NOT NULL DEFAULT 'In-Store',
  `shipped_at` datetime DEFAULT NULL,
  `shipped_by` bigint(20) unsigned DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `cancelled_by` bigint(20) unsigned DEFAULT NULL,
  `cancelled_by_role` enum('customer','admin') DEFAULT NULL,
  `cancel_reason` text DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `total_products` int(11) NOT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `vat_status` varchar(255) NOT NULL DEFAULT 'taxable',
  `discount` decimal(10,2) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `delivery_status` varchar(50) NOT NULL DEFAULT 'pending',
  `courier` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `rider_id` bigint(20) unsigned DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `paypal_order_id` varchar(255) DEFAULT NULL,
  `paypal_capture_id` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `pay` decimal(10,2) DEFAULT NULL,
  `change_amount` decimal(10,2) DEFAULT NULL,
  `due` decimal(10,2) DEFAULT NULL,
  `shipping_address_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_paypal_order_id_unique` (`paypal_order_id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  KEY `orders_created_by_foreign` (`created_by`),
  KEY `orders_shipped_by_foreign` (`shipped_by`),
  KEY `orders_cancelled_by_foreign` (`cancelled_by`),
  KEY `orders_shipping_address_id_foreign` (`shipping_address_id`),
  KEY `orders_rider_id_foreign` (`rider_id`),
  CONSTRAINT `orders_cancelled_by_foreign` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_shipped_by_foreign` FOREIGN KEY (`shipped_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_shipping_address_id_foreign` FOREIGN KEY (`shipping_address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (157,'ECOM',16,NULL,'2026-02-05 17:02:12','completed','Delivery','2026-02-05 17:04:25',5,NULL,NULL,NULL,NULL,'2026-02-05 17:06:44',1,20.00,2.14,'taxable',NULL,'Salinio99753678',20.00,'refunded','picked_up','jnt',NULL,NULL,NULL,NULL,'paypal','9JM12258MU5197506','65716304717852727',NULL,20.00,NULL,0.00,7,'2026-02-05 09:02:12','2026-02-05 09:16:28'),(158,'POS',16,NULL,'2026-02-05 17:41:29','cancelled','In-Store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,100.00,10.71,'taxable',NULL,'Salinio45416709',100.00,'pending','pending','jnt',NULL,NULL,NULL,NULL,'paypal','1DW0520090071125D',NULL,NULL,100.00,NULL,0.00,7,'2026-02-05 09:41:29','2026-02-05 09:49:22'),(159,'ECOM',16,NULL,'2026-02-05 17:43:14','cancelled','Delivery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,100.00,10.71,'taxable',NULL,'Salinio99172275',100.00,'paid','pending','jnt',NULL,NULL,NULL,NULL,'paypal','2XX25877ST7494443','16L41185S7262580N',NULL,100.00,NULL,0.00,7,'2026-02-05 09:43:14','2026-02-05 09:49:44'),(160,'POS',22,NULL,'2026-02-05 18:08:48','cancelled','In-Store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,100.00,10.71,'taxable',NULL,'Salinio16563149',100.00,'pending','pending','jnt',NULL,NULL,NULL,NULL,'paypal',NULL,NULL,NULL,100.00,NULL,0.00,NULL,'2026-02-05 10:08:48','2026-02-05 10:11:11'),(161,'ECOM',22,NULL,'2026-02-05 18:09:33','pending','Delivery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,100.00,10.71,'taxable',NULL,'Salinio62722231',100.00,'unpaid','pending','jnt',NULL,NULL,NULL,NULL,'cod',NULL,NULL,NULL,100.00,NULL,0.00,NULL,'2026-02-05 10:09:46','2026-02-05 10:09:46'),(162,'ECOM',22,NULL,'2026-02-05 18:15:08','completed','Delivery','2026-02-05 18:28:52',NULL,NULL,NULL,NULL,NULL,'2026-02-05 18:36:06',1,100.00,10.71,'taxable',NULL,'Salinio36791354',100.00,'paid','picked_up','jnt',NULL,NULL,NULL,NULL,'paypal','72U03203T4454954P','8JV55817BC4922805',NULL,100.00,NULL,0.00,NULL,'2026-02-05 10:15:08','2026-02-05 10:36:07'),(163,'POS',22,NULL,'2026-02-06 10:34:36','pending','In-Store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,100.00,10.71,'taxable',NULL,'Salinio75740798',100.00,'pending','pending','jnt',NULL,NULL,NULL,NULL,'paypal','2D297000G9036760V',NULL,NULL,100.00,NULL,0.00,8,'2026-02-06 02:34:36','2026-02-06 02:34:38'),(168,'ECOM',22,NULL,'2026-02-06 10:53:13','pending','Delivery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,15.00,1.61,'taxable',NULL,'Salinio94992957',15.00,'unpaid','pending','jnt',NULL,NULL,NULL,NULL,'cod',NULL,NULL,NULL,15.00,NULL,0.00,8,'2026-02-06 02:53:18','2026-02-06 02:53:18'),(169,'ECOM',22,NULL,'2026-02-06 10:55:20','processing','Delivery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,100.00,10.71,'taxable',NULL,'Salinio80055355',100.00,'paid','pending','jnt',NULL,NULL,NULL,NULL,'paypal','6VT3963740578424J','9EE551138R928443M',NULL,100.00,NULL,0.00,8,'2026-02-06 02:55:20','2026-02-06 02:55:57'),(170,'ECOM',22,NULL,'2026-02-06 10:57:24','pending','Delivery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,2800.00,300.00,'taxable',NULL,'Salinio49559180',2800.00,'unpaid','pending','jnt',NULL,NULL,NULL,NULL,'cod',NULL,NULL,NULL,2800.00,NULL,0.00,8,'2026-02-06 02:58:20','2026-02-06 02:58:20'),(171,'POS',22,NULL,'2026-02-06 11:27:09','pending','In-Store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,15.00,1.61,'taxable',NULL,'Salinio74461210',15.00,'pending','pending','jnt',NULL,NULL,NULL,NULL,'paypal','92802995L0993580W',NULL,NULL,15.00,NULL,0.00,NULL,'2026-02-06 03:27:09','2026-02-06 03:27:12'),(172,'POS',NULL,5,'2026-02-07 14:17:22','complete','In-Store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,6,78.26,11.74,'Taxable',0.00,'INV-959798',90.00,'paid','pending',NULL,NULL,NULL,NULL,NULL,'Handcash',NULL,NULL,NULL,90.00,0.00,0.00,NULL,'2026-02-07 06:17:22','2026-02-07 06:17:22'),(173,'ECOM',22,NULL,'2026-02-09 13:09:58','pending','Delivery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,65,6500.00,696.43,'taxable',NULL,'Salinio71733363',6500.00,'unpaid','pending','jnt',NULL,NULL,NULL,NULL,'cod',NULL,NULL,NULL,6500.00,NULL,0.00,8,'2026-02-09 05:10:02','2026-02-09 05:10:02'),(174,'ECOM',22,NULL,'2026-02-09 14:12:05','completed','Delivery','2026-02-09 14:13:06',5,NULL,NULL,NULL,NULL,'2026-02-09 14:15:29',6,90.00,9.64,'taxable',NULL,'Salinio38273824',90.00,'refunded','picked_up','jnt',NULL,NULL,NULL,NULL,'cod',NULL,NULL,NULL,90.00,NULL,0.00,8,'2026-02-09 06:12:09','2026-02-09 07:15:52'),(175,'ECOM',22,NULL,'2026-02-09 15:22:11','pending','Delivery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,30.00,3.21,'taxable',NULL,'Salinio66583374',30.00,'unpaid','pending','jnt',NULL,NULL,NULL,NULL,'cod',NULL,NULL,NULL,30.00,NULL,0.00,8,'2026-02-09 07:22:15','2026-02-09 07:22:15'),(176,'ECOM',22,NULL,'2026-02-09 15:23:06','pending','Delivery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,13,195.00,20.89,'taxable',NULL,'Salinio70532825',195.00,'unpaid','pending','jnt',NULL,NULL,NULL,NULL,'cod',NULL,NULL,NULL,195.00,NULL,0.00,8,'2026-02-09 07:23:09','2026-02-09 07:23:09');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('pharma14@gmail.com','$2y$10$IepUYZ98SjpU/9hAkw.tve6ajN.CdEc2Hw7BBPCZpkziZ9DAHQSoO','2025-10-27 10:37:43'),('pharma@gmail.com','$2y$10$JdfICzt5nGGCMdbJqxscN.vnO0K5wCFWopSbGP5DqtsDeVIi.a0Jy','2026-01-08 06:55:18'),('tarucjohneric19@gmail.com','$2y$10$IB.y//JuiWTeuSxrQC/zReOh7t9rPlNISyXhzSzkZ8gNaaG2ca6Au','2026-01-08 07:24:20'),('danmichaelantiquina14@outlook.com','$2y$10$K1rB/O3/OMpsj5sskoE/0OIwdDcf6rMXL9wX6hMik0oSamPydKZYG','2026-02-05 09:54:44');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (99,'can-view-audit-trail','web','2026-02-01 22:17:15','2026-02-02 20:34:06','audit'),(100,'can-view-audit-by-action','web','2026-02-01 22:18:04','2026-02-01 22:18:04','audit'),(101,'can-view-audit-by-log','web','2026-02-01 22:18:19','2026-02-01 22:18:19','audit'),(102,'can-manage-backup-database','web','2026-02-01 22:20:13','2026-02-01 22:20:13','backup'),(103,'can-manage-categories','web','2026-02-01 22:22:12','2026-02-01 22:48:09','categories'),(105,'can-view-customer-chat','web','2026-02-01 22:24:38','2026-02-01 22:24:38','chat-customer'),(106,'can-manage-commerce-settings','web','2026-02-01 22:26:08','2026-02-01 22:26:08','commerce'),(107,'can-access-dashboard','web','2026-02-01 22:27:40','2026-02-01 22:27:40','dashboard'),(108,'can-view-dashboard-analytics','web','2026-02-01 22:27:55','2026-02-01 22:27:55','dashboard'),(109,'can-manage-expenses','web','2026-02-01 22:30:41','2026-02-01 22:30:41','expense'),(110,'can-view-inventory','web','2026-02-01 22:36:23','2026-02-01 22:36:23','inventory'),(111,'can-manage-customer-order','web','2026-02-01 22:36:37','2026-02-01 22:36:37','customer-orders'),(112,'can-manage-permission','web','2026-02-01 22:38:02','2026-02-01 22:38:02','permissions'),(113,'can-add-roles-in-permissions','web','2026-02-01 22:38:13','2026-02-01 22:38:13','permissions'),(114,'can-access-pos','web','2026-02-01 22:38:45','2026-02-01 22:38:45','point-of-sale'),(115,'can-manage-purchase-order','web','2026-02-01 22:41:14','2026-02-01 22:41:14','purchase-orders'),(116,'can-create-pO','web','2026-02-01 22:41:30','2026-02-01 22:41:30','purchase-orders'),(117,'can-received-deliveries','web','2026-02-01 22:41:52','2026-02-01 22:41:52','purchase-orders'),(118,'can-manage-return-orders','web','2026-02-01 22:43:31','2026-02-01 22:43:31','returns'),(119,'can-manage-roles','web','2026-02-01 22:44:32','2026-02-01 22:44:32','roles'),(120,'can-view-roles','web','2026-02-01 22:45:22','2026-02-01 22:45:22','roles'),(121,'can-create-roles','web','2026-02-01 22:45:48','2026-02-01 22:45:48','roles'),(122,'can-manage-sub-categories','web','2026-02-01 22:48:33','2026-02-01 22:48:33','sub-category'),(125,'can-manage-system-settings','web','2026-02-01 22:52:30','2026-02-01 22:52:30','system-settings'),(126,'can-change-system-titles','web','2026-02-01 22:53:04','2026-02-01 22:53:04','system-settings'),(127,'can-change-banner/slider','web','2026-02-01 22:53:16','2026-02-01 22:53:16','system-settings'),(128,'can-manage-user-accounts','web','2026-02-01 22:55:27','2026-02-01 22:55:27','user-accounts'),(129,'can-view-all-users','web','2026-02-01 22:55:45','2026-02-01 22:55:45','user-accounts'),(130,'can-create-users','web','2026-02-01 22:55:54','2026-02-01 22:55:54','user-accounts'),(131,'can-manage-suppliers','web','2026-02-02 00:02:05','2026-02-02 00:02:05','suppliers'),(132,'can-view-all-suppliers','web','2026-02-02 00:02:16','2026-02-02 00:02:16','suppliers'),(133,'can-create-suppliers','web','2026-02-02 00:02:28','2026-02-02 00:02:28','suppliers'),(134,'can-manage-brand','web','2026-02-02 00:04:04','2026-02-02 00:04:04','brand'),(135,'can-view-all-brand','web','2026-02-02 00:04:13','2026-02-02 00:04:13','brand'),(136,'can-create-brand','web','2026-02-02 00:04:23','2026-02-02 00:04:23','brand'),(137,'can-manage-products','web','2026-02-02 00:09:24','2026-02-02 00:09:24','products'),(138,'can-view-all-products','web','2026-02-02 00:09:36','2026-02-02 00:09:36','products'),(139,'can-create-products','web','2026-02-02 00:09:47','2026-02-02 00:09:47','products'),(140,'can-view-reports','web','2026-02-02 00:16:16','2026-02-02 00:16:16','reports'),(141,'can-view-daily-sales','web','2026-02-02 00:16:32','2026-02-02 00:16:32','reports'),(142,'can-view-top-sellings','web','2026-02-02 00:16:49','2026-02-02 00:16:49','reports'),(145,'can-view-sub-categories','web','2026-02-02 20:27:35','2026-02-02 20:27:35','sub-category');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `subcategory_id` bigint(20) unsigned DEFAULT NULL,
  `brand_id` bigint(20) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `dosage_form` enum('Tablet','Capsule','Syrup','Cream','Ointment') NOT NULL DEFAULT 'Tablet',
  `target_gender` varchar(255) DEFAULT 'Unisex',
  `age_group` varchar(255) DEFAULT 'All',
  `health_concern` varchar(255) DEFAULT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `has_expiration` tinyint(1) NOT NULL DEFAULT 1,
  `prescription_required` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  KEY `products_product_code_index` (`product_code`),
  KEY `products_brand_id_foreign` (`brand_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Sunsilk 50ml','PC000001','uploads/product_image/1846426549146615.png',1,1,1,'shampoo that you cant forget','Syrup','Male','Kids','anxiety',100.00,0,0,'2025-10-19 07:59:37','2025-10-19 07:59:37'),(2,'Biogesic 500mg','PC000002','uploads/product_image/1846472474024204.png',3,2,1,'bio degradable medicine supplies','Capsule','Unisex','All','headache',20.00,1,0,'2025-10-19 20:09:34','2025-10-19 20:09:34'),(3,'Biogesic 500mg','PC000003','uploads/product_image/1846665738578626.png',1,1,1,'no not all damn it','Syrup','Unisex','All','headache',20.00,1,0,'2025-10-21 23:21:26','2025-10-25 08:48:33'),(8,'Biogesic 500mg','PC000006','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761578821/products/yhysmnvavinleykqwydb.png',3,2,1,'asddddddddddddddddddddd','Ointment','Unisex','All','asdsad',200.00,1,0,'2025-10-27 07:27:03','2025-10-27 07:27:03'),(9,'thermometer','PC000007','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761580633/products/pv5miwqwfjmcoamgxsjt.png',3,2,1,'asdddddddddddddddddddddddd','Syrup','Male','All',NULL,15.00,1,0,'2025-10-27 07:57:14','2025-10-27 07:57:14'),(10,'bearbrand','PC000008','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761581080/products/iuajdov9m4xb16qiyzc6.jpg',3,2,1,'asdddddddddddddddddddddad','Capsule','Unisex','Adults','asdasdadsa',200.00,1,0,'2025-10-27 08:04:41','2025-10-27 08:04:41'),(14,'Cetaphil','PC000009','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761592906/products/g3ipfabv611mcnqikbkl.png',3,2,1,'Moisturizer','Cream','Unisex','All','none',750.00,1,0,'2025-10-27 11:21:47','2025-10-27 11:21:47'),(16,'Cetaphil','PC000010','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761594613/products/fh2cvyzc2bfpdfao2nbn.png',9,5,5,'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz','Tablet','Male','All','none',750.00,1,0,'2025-10-27 11:50:14','2025-10-27 11:50:14'),(17,'Biogesic 500mg','PC000011','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761596201/products/lgw5csgnrlhncrkf8dvv.png',9,5,7,'sadddddddddddddddddddddd','Ointment','Female','All','ssssssssssssssss',25.00,1,0,'2025-10-27 12:16:42','2025-10-27 12:16:42'),(19,'Biogesic1000mg','PC000012','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1770008483/products/d51drzmjhfegg9jy6aom.png',3,2,8,'eto na pangmalakasan','Syrup','Unisex','All',NULL,20.00,1,0,'2026-02-01 21:01:24','2026-02-02 21:33:40');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order_items`
--

DROP TABLE IF EXISTS `purchase_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  KEY `purchase_order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `purchase_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order_items`
--

LOCK TABLES `purchase_order_items` WRITE;
/*!40000 ALTER TABLE `purchase_order_items` DISABLE KEYS */;
INSERT INTO `purchase_order_items` VALUES (7,11,1,20,NULL,0.00,0.00,'2025-10-27 17:09:17','2025-10-27 17:09:17'),(13,16,16,4,NULL,730.00,2920.00,'2026-01-10 08:50:40','2026-01-10 08:50:40'),(14,17,16,4,NULL,730.00,2920.00,'2026-01-10 08:53:09','2026-01-10 08:53:09'),(15,18,16,4,NULL,730.00,2920.00,'2026-01-10 08:55:16','2026-01-10 08:55:16'),(16,19,16,4,NULL,730.00,2920.00,'2026-01-10 08:57:25','2026-01-10 08:57:25'),(17,20,16,4,NULL,730.00,2920.00,'2026-01-10 08:58:52','2026-01-10 08:58:52'),(18,21,16,4,NULL,730.00,2920.00,'2026-01-10 09:02:36','2026-01-10 09:02:36'),(19,22,16,4,NULL,730.00,2920.00,'2026-01-10 09:03:27','2026-01-10 09:03:27'),(20,23,2,5,NULL,15.00,75.00,'2026-01-16 09:03:04','2026-01-16 09:03:04'),(21,25,1,6,NULL,90.00,540.00,'2026-01-16 22:30:21','2026-01-16 22:30:21'),(22,26,1,6,NULL,90.00,540.00,'2026-01-16 22:31:20','2026-01-16 22:31:20'),(23,27,1,6,NULL,90.00,540.00,'2026-01-16 22:32:06','2026-01-16 22:32:06'),(24,28,3,6,NULL,19.00,114.00,'2026-01-16 22:40:59','2026-01-16 22:40:59'),(25,28,8,1,NULL,189.00,189.00,'2026-01-16 22:40:59','2026-01-16 22:40:59'),(36,34,2,11,NULL,17.00,187.00,'2026-01-19 00:32:42','2026-01-19 00:32:42'),(37,34,1,1,NULL,90.00,90.00,'2026-01-19 00:32:42','2026-01-19 00:32:42'),(40,36,10,8,'2028-06-13',190.00,1520.00,'2026-01-19 00:42:32','2026-01-19 00:43:23'),(41,36,3,9,'2029-07-11',15.00,135.00,'2026-01-19 00:42:32','2026-01-19 00:43:23'),(42,37,1,6,NULL,90.00,540.00,'2026-01-22 06:18:29','2026-01-22 06:18:29'),(43,38,2,5,NULL,17.00,85.00,'2026-01-31 07:22:58','2026-01-31 07:22:58'),(44,39,1,8,NULL,90.00,720.00,'2026-01-31 08:17:36','2026-01-31 08:17:36'),(45,40,1,1,NULL,0.00,0.00,'2026-01-31 08:19:40','2026-01-31 08:19:40'),(46,41,8,10,NULL,190.00,1900.00,'2026-01-31 08:20:46','2026-01-31 08:20:46'),(47,42,1,11,NULL,90.00,990.00,'2026-01-31 08:32:40','2026-01-31 08:32:40'),(48,43,1,8,NULL,90.00,720.00,'2026-02-02 04:04:18','2026-02-02 04:04:18'),(49,44,1,7,NULL,90.00,630.00,'2026-02-02 04:21:23','2026-02-02 04:21:23'),(50,44,2,8,NULL,15.00,120.00,'2026-02-02 04:21:23','2026-02-02 04:21:23'),(51,45,1,7,NULL,90.00,630.00,'2026-02-02 04:25:01','2026-02-02 04:25:01'),(52,45,2,8,NULL,15.00,120.00,'2026-02-02 04:25:01','2026-02-02 04:25:01'),(53,46,1,7,NULL,90.00,630.00,'2026-02-02 04:41:21','2026-02-02 04:41:21'),(54,46,2,8,NULL,15.00,120.00,'2026-02-02 04:41:21','2026-02-02 04:41:21'),(55,47,1,7,NULL,90.00,630.00,'2026-02-03 06:51:38','2026-02-03 06:51:38'),(56,48,1,7,NULL,90.00,630.00,'2026-02-03 06:56:57','2026-02-03 06:57:36'),(57,49,1,1,NULL,0.00,0.00,'2026-02-10 22:27:11','2026-02-10 22:27:11'),(58,49,2,1,NULL,0.00,0.00,'2026-02-10 22:27:11','2026-02-10 22:27:11'),(59,50,1,1,NULL,0.00,0.00,'2026-02-10 22:35:40','2026-02-10 22:35:40'),(60,51,1,1,NULL,0.00,0.00,'2026-02-10 22:37:00','2026-02-10 22:37:00'),(61,52,1,1,NULL,0.00,0.00,'2026-02-10 22:43:37','2026-02-10 22:43:37'),(62,53,1,1,NULL,0.00,0.00,'2026-02-10 22:47:00','2026-02-10 22:47:00');
/*!40000 ALTER TABLE `purchase_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_number` varchar(255) NOT NULL,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `expected_delivery_date` date DEFAULT NULL,
  `status` enum('draft','confirmed','sent','partially_received','received') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `supplier_confirmation_token` char(36) DEFAULT NULL,
  `supplier_confirmed_at` timestamp NULL DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_orders_po_number_unique` (`po_number`),
  UNIQUE KEY `purchase_orders_supplier_confirmation_token_unique` (`supplier_confirmation_token`),
  KEY `purchase_orders_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_orders`
--

LOCK TABLES `purchase_orders` WRITE;
/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
INSERT INTO `purchase_orders` VALUES (11,'PO-690017BDAD0E9',4,'2025-11-07','sent','2025-10-27 17:09:17','2025-10-27 17:09:17',NULL,NULL,NULL),(16,'PO-69628360356ED',10,'2026-01-22','sent','2026-01-10 08:50:40','2026-01-10 08:50:40',NULL,NULL,NULL),(17,'PO-696283F51933D',9,'2026-01-20','sent','2026-01-10 08:53:09','2026-01-10 08:53:09',NULL,NULL,NULL),(18,'PO-696284748F711',10,'2026-01-21','sent','2026-01-10 08:55:16','2026-01-10 08:55:16',NULL,NULL,NULL),(19,'PO-696284F577893',10,'2026-01-20','sent','2026-01-10 08:57:25','2026-01-10 08:57:25',NULL,NULL,NULL),(20,'PO-6962854C39943',10,'2026-01-14','sent','2026-01-10 08:58:52','2026-01-10 08:58:52',NULL,NULL,NULL),(21,'PO-6962862C4884A',10,'2026-01-13','sent','2026-01-10 09:02:36','2026-01-10 09:02:36',NULL,NULL,NULL),(22,'PO-6962865F5D0EB',10,'2026-01-14','sent','2026-01-10 09:03:27','2026-01-10 09:03:27',NULL,NULL,NULL),(23,'PO-696A6F486AC31',10,'2026-01-20','sent','2026-01-16 09:03:04','2026-01-16 09:03:04',NULL,NULL,NULL),(24,'PO-696B2C0C090D1',10,'2026-01-26','sent','2026-01-16 22:28:28','2026-01-16 22:28:28','75b4b50e-29f5-424e-8108-1ef230f998c4',NULL,NULL),(25,'PO-696B2C7D1960A',10,'2026-01-20','sent','2026-01-16 22:30:21','2026-01-16 22:30:21','1d8331fd-c4c4-4938-9a4a-c5a844a739cd',NULL,NULL),(26,'PO-696B2CB86838E',10,'2026-01-27','sent','2026-01-16 22:31:20','2026-01-16 22:31:20','084de6a6-e40e-491c-b698-fcae79ed633c',NULL,NULL),(27,'PO-696B2CE65FD1B',10,'2026-01-20','sent','2026-01-16 22:32:06','2026-01-16 22:32:06','2d6cb277-7b32-4819-9db3-d8339e78b549',NULL,NULL),(28,'PO-696B2EFB208F9',10,'2026-01-21','sent','2026-01-16 22:40:59','2026-01-16 22:40:59','efea18cc-8ca0-4cc4-ad29-f583da843ed7',NULL,NULL),(34,'PO-696DEC2AB1A40',10,NULL,'sent','2026-01-19 00:32:42','2026-01-19 00:32:42','335b8172-d53a-401c-9176-ccaf23327c10',NULL,NULL),(36,'PO-696DEE78AB1E3',10,'2026-01-30','received','2026-01-19 00:42:32','2026-01-19 00:43:59',NULL,'2026-01-19 00:43:23',NULL),(37,'PO-697231B56C848',10,NULL,'sent','2026-01-22 06:18:29','2026-01-22 06:18:29','58f86e1c-d743-40c8-9a1a-f677a08ebcd3',NULL,NULL),(38,'PO-697E1E5281F7C',10,NULL,'sent','2026-01-31 07:22:58','2026-01-31 07:22:58','31086ff7-5361-42fe-82f3-0db937629451',NULL,NULL),(39,'PO-697E2B209561D',10,NULL,'sent','2026-01-31 08:17:36','2026-01-31 08:17:36','35d637cc-9e6d-4276-b8db-6363f3ac3bc3',NULL,NULL),(40,'PO-697E2B9BE79E2',10,NULL,'sent','2026-01-31 08:19:39','2026-01-31 08:19:40','71400e01-d9aa-4707-bebe-94182769920d',NULL,NULL),(41,'PO-697E2BDEBBB5F',10,NULL,'sent','2026-01-31 08:20:46','2026-01-31 08:20:46','59834b99-b025-42db-9378-0d3880945ce1',NULL,NULL),(42,'PO-697E2EA8022A9',9,NULL,'sent','2026-01-31 08:32:40','2026-01-31 08:32:40','3c76b571-de5a-4686-bda9-66be05ccc002',NULL,NULL),(43,'PO-698092C20AC4E',10,NULL,'sent','2026-02-02 04:04:18','2026-02-02 04:04:18','e2292b9c-1afa-41b5-a519-5151efb5dbfe',NULL,NULL),(44,'PO-698096C3B8D4B',10,NULL,'sent','2026-02-02 04:21:23','2026-02-02 04:21:23','38497b68-e96d-4a19-b38f-31e1fe60da51',NULL,NULL),(45,'PO-6980979D8DFE5',10,NULL,'sent','2026-02-02 04:25:01','2026-02-02 04:25:01','4a951b54-bb90-462f-a4d7-c7130b2de32c',NULL,NULL),(46,'PO-69809B7173117',10,NULL,'sent','2026-02-02 04:41:21','2026-02-02 04:41:21','abf779ad-d4ac-4bb4-91b9-86c5bcc9e311',NULL,NULL),(47,'PO-69820B79BB18B',10,NULL,'sent','2026-02-03 06:51:37','2026-02-03 06:51:38','9969b908-b6de-45d4-a888-03a283eeefa6',NULL,NULL),(48,'PO-69820CB991D98',10,'2026-02-12','received','2026-02-03 06:56:57','2026-02-03 06:57:58',NULL,'2026-02-03 06:57:36',NULL),(49,'PO-698C213F8DACA',10,NULL,'sent','2026-02-10 22:27:11','2026-02-10 22:27:11','73187f75-ada1-40fa-a35f-f48084faeb90',NULL,NULL),(50,'PO-698C233BCE251',10,NULL,'sent','2026-02-10 22:35:39','2026-02-10 22:35:40','bf8c5041-dda3-46dc-870e-774014ccfadb',NULL,NULL),(51,'PO-698C238C3FF43',10,NULL,'sent','2026-02-10 22:37:00','2026-02-10 22:37:00','41c0a6da-0249-4c06-88d1-a10586c9b04f',NULL,NULL),(52,'PO-698C2518E66BC',10,NULL,'sent','2026-02-10 22:43:36','2026-02-10 22:43:36','20d4f568-0fdf-46a3-bf1b-90861476724b',NULL,NULL),(53,'PO-698C25E4A6462',10,NULL,'sent','2026-02-10 22:47:00','2026-02-10 22:47:00','ba817e2d-90ab-456c-b8a3-5672b63771da',NULL,NULL);
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_requests`
--

DROP TABLE IF EXISTS `return_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `reason` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` enum('pending','approved','in_transit','received','refunded','rejected') NOT NULL DEFAULT 'pending',
  `refund_id` varchar(255) DEFAULT NULL,
  `refund_amount` decimal(10,2) DEFAULT NULL,
  `refunded_at` timestamp NULL DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photos`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `return_requests_order_id_foreign` (`order_id`),
  CONSTRAINT `return_requests_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_requests`
--

LOCK TABLES `return_requests` WRITE;
/*!40000 ALTER TABLE `return_requests` DISABLE KEYS */;
INSERT INTO `return_requests` VALUES (4,157,'wrong_item','gegeeeeeeeeeeeeeeeee',1,'refunded','0TJ85628C9321942R',20.00,'2026-02-05 09:16:28',NULL,'[\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1770311363\\/customerProofRequest\\/inh1pfwe7gfnxe2cxzu4.png\"]','2026-02-05 09:09:26','2026-02-05 09:16:28'),(5,162,'defective','engot kasi ba',1,'rejected',NULL,NULL,NULL,NULL,'[\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1770316691\\/customerProofRequest\\/oap2uegcsfwnkaywyqrx.png\"]','2026-02-05 10:38:14','2026-02-05 10:43:34'),(6,174,'not_as_described','gaigiiiiasida',6,'refunded',NULL,90.00,'2026-02-09 07:15:52',NULL,'[\"https:\\/\\/res.cloudinary.com\\/dqhdcwq3q\\/image\\/upload\\/v1770646588\\/customerProofRequest\\/hzjsvqg0fxjpdd3yerde.png\"]','2026-02-09 06:16:29','2026-02-09 07:15:52');
/*!40000 ALTER TABLE `return_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_shipments`
--

DROP TABLE IF EXISTS `return_shipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_shipments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `return_request_id` bigint(20) unsigned NOT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `shipment_status` enum('ready_for_pickup','picked_up','in_transit','delivered') NOT NULL DEFAULT 'ready_for_pickup',
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `return_shipments_return_request_id_foreign` (`return_request_id`),
  CONSTRAINT `return_shipments_return_request_id_foreign` FOREIGN KEY (`return_request_id`) REFERENCES `return_requests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_shipments`
--

LOCK TABLES `return_shipments` WRITE;
/*!40000 ALTER TABLE `return_shipments` DISABLE KEYS */;
INSERT INTO `return_shipments` VALUES (15,4,'RET-JNT-AGCVJD3A3R','delivered','2026-02-05 09:12:45',NULL,'2026-02-05 09:11:58','2026-02-05 09:12:45'),(16,5,'RET-JNT-3WZRMJNAKG','delivered','2026-02-05 10:39:11',NULL,'2026-02-05 10:38:50','2026-02-05 10:39:11'),(17,6,'RET-JNT-J5LLZYT29L','delivered','2026-02-09 06:17:43',NULL,'2026-02-09 06:17:25','2026-02-09 06:17:43');
/*!40000 ALTER TABLE `return_shipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riders`
--

DROP TABLE IF EXISTS `riders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `riders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `vehicle_type` varchar(255) DEFAULT NULL,
  `availability` enum('available','busy') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `riders_user_id_unique` (`user_id`),
  CONSTRAINT `riders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riders`
--

LOCK TABLES `riders` WRITE;
/*!40000 ALTER TABLE `riders` DISABLE KEYS */;
INSERT INTO `riders` VALUES (1,13,'car','available','2026-01-20 02:52:09','2026-01-20 03:15:22');
/*!40000 ALTER TABLE `riders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','web','2025-10-19 07:05:57','2025-10-19 07:05:57'),(2,'Cashier','web','2025-10-19 19:30:22','2025-10-27 15:05:39'),(3,'Staff','web','2025-10-19 19:30:31','2025-10-19 19:30:31'),(6,'Admin','web','2025-10-27 16:28:42','2025-10-27 16:28:42');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('EC1gxHnCeisOCqZSkXb1ZIhoFCNFMyDourEpePPo',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRGZIVzZvZGVaZ2NNNThCTHViN1lBOERWUWV4a282bmxQU3VteUZIZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9iYWNrdXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O3M6NDoiY2FydCI7YToxOntzOjEzOiJwdXJjaGFzZU9yZGVyIjtPOjI5OiJJbGx1bWluYXRlXFN1cHBvcnRcQ29sbGVjdGlvbiI6Mjp7czo4OiIAKgBpdGVtcyI7YTowOnt9czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO319fQ==',1770794598),('FaXDFrfDFqryvjQUsI0JTA7lv4RQsNs0PNsoUgIy',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibWNPdHZjUGVNSjVvWGFlWkFBb1Bpd21rald0RVVNRzVFTm9UUE5pcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdXBwbGllci9jb25maXJtLzIwZDRmNTY4LTBmZGYtNDZhMy1iZjFiLTkwODYxNDc2NzI0YiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770793155);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) NOT NULL,
  `instance` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`identifier`,`instance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shoppingcart`
--

LOCK TABLES `shoppingcart` WRITE;
/*!40000 ALTER TABLE `shoppingcart` DISABLE KEYS */;
INSERT INTO `shoppingcart` VALUES ('12','default','O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}','2025-11-30 06:21:50','2025-11-30 06:21:50'),('16','ecommerce','O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}','2026-02-05 09:51:22','2026-02-05 09:51:22'),('18','ecommerce','O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{s:32:\"2470718ecf5caeaa23807b8411c2d065\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":11:{s:5:\"rowId\";s:32:\"2470718ecf5caeaa23807b8411c2d065\";s:2:\"id\";i:11;s:3:\"qty\";i:2;s:4:\"name\";s:9:\"bearbrand\";s:5:\"price\";d:200;s:6:\"weight\";d:20;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":2:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:95:\"https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761581080/products/iuajdov9m4xb16qiyzc6.jpg\";s:10:\"product_id\";i:10;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:7:\"taxRate\";i:12;s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";N;s:46:\"\0Gloudemans\\Shoppingcart\\CartItem\0discountRate\";i:0;s:8:\"instance\";s:9:\"ecommerce\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}','2026-01-31 10:44:17','2026-01-31 10:44:17'),('19','ecommerce','O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:2:{s:32:\"ad193f42b62158c20030a7836f26b4ee\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":11:{s:5:\"rowId\";s:32:\"ad193f42b62158c20030a7836f26b4ee\";s:2:\"id\";i:4;s:3:\"qty\";i:2;s:4:\"name\";s:14:\"Biogesic 500mg\";s:5:\"price\";d:20;s:6:\"weight\";d:20;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":2:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"uploads/product_image/1846665738578626.png\";s:10:\"product_id\";i:3;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:7:\"taxRate\";i:12;s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";N;s:46:\"\0Gloudemans\\Shoppingcart\\CartItem\0discountRate\";i:0;s:8:\"instance\";s:9:\"ecommerce\";}s:32:\"0f2eb0e900d1751edffdc0b4b5d83f1e\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":11:{s:5:\"rowId\";s:32:\"0f2eb0e900d1751edffdc0b4b5d83f1e\";s:2:\"id\";i:2;s:3:\"qty\";s:1:\"1\";s:4:\"name\";s:14:\"Biogesic 500mg\";s:5:\"price\";d:20;s:6:\"weight\";d:20;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":2:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"uploads/product_image/1846472474024204.png\";s:10:\"product_id\";i:2;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:7:\"taxRate\";i:12;s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";N;s:46:\"\0Gloudemans\\Shoppingcart\\CartItem\0discountRate\";i:0;s:8:\"instance\";s:9:\"ecommerce\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}','2026-01-10 21:19:26','2026-01-10 21:19:26'),('7','default','O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}','2025-10-26 04:48:36','2025-10-26 04:48:36');
/*!40000 ALTER TABLE `shoppingcart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,'Shampoos',1,'2025-10-19 07:53:47','2025-10-25 08:01:44'),(2,'medicine',3,'2025-10-19 20:07:48','2025-10-19 20:07:48'),(5,'BOSSING',9,'2025-10-27 11:45:24','2025-10-27 11:45:24'),(6,'Chart FGP Theme desktop',1,'2026-01-24 07:36:52','2026-01-24 07:36:52'),(7,'GENGGENG',3,'2026-02-02 20:49:39','2026-02-02 20:49:39');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'BOSSINGs','danmichaelantiquina14@outlook.com','09517372538','Block 5 South Daang H','uploads/supplier_image/1846426300492627.png','2025-10-19 07:55:40','2026-02-02 20:38:25'),(4,'john carlo dote','dotelangmalakas@gmail.com','09123939191','muntinlupa','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761576477/suppliers/vevzgwoanbnsqryek4mg.png','2025-10-27 06:47:57','2025-10-27 06:47:57'),(9,'pharma','tarucjohneric19@gmail.com','09123939181','muntinlupa',NULL,'2025-10-27 09:54:14','2026-01-31 08:21:37'),(10,'bosske','danmichaelantiquina9@gmail.com','09517372630','taguigeni',NULL,'2026-01-10 08:49:53','2026-01-10 08:49:53');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `must_change_password` tinyint(1) NOT NULL DEFAULT 1,
  `temp_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'Admin User','admin@example.com','09123456789','https://res.cloudinary.com/dqhdcwq3q/image/upload/v1761536374/profile/bd9hcwh8613pp1tglo9n.png','2025-10-19 23:48:05','$2y$10$CsDpX.728B3foZiBOjdMr.A3QrAtJi8i8.ZhtrubH05ZVUttEqjta',NULL,'2025-10-19 19:49:51','2025-10-26 19:39:37',0,NULL),(6,'admin','admin14@gmail.com','09123939191',NULL,NULL,'$2y$10$0U9i3iH1Yoj5yKxC5XNJfugnq6r/lEvJ5u3W670CCQ2U5sBvhUg9i',NULL,'2025-10-19 19:51:48','2025-10-19 19:51:48',1,'TsQxbW8l9C'),(7,'Staff','staff@email.com','09159381304',NULL,NULL,'$2y$10$pspMCaEXMdojZsd/F3HxT.G7zF0/f93gXEi64wxRP5NmigDjC8nXC',NULL,'2025-10-19 19:52:16','2025-10-26 04:42:32',0,'Staff12345'),(9,'salinio','salinas@yahoo.com','09517372530',NULL,NULL,'$2y$10$kNom3Z2vLsaxlX4BK8w8ou1qOqcCRe8VD8DCf0vV73kmUA1hQVaiO',NULL,'2025-10-27 15:12:22','2025-10-27 15:12:22',1,'ed8UVQZmWz'),(10,'Dan michael Cape Antiquina','danmichaelantiquina13@outlook.com','09517372536',NULL,NULL,'$2y$10$/TzzVhLSBIY8LKJZX.fNieRwWwYqbd4mvv0GNGNJnrZvsvBeE7mza',NULL,'2025-10-27 16:13:50','2025-10-27 16:13:50',1,'rrrCMRNAvJ'),(11,'Dan michael Cape Antiquina','danmichaelant@outlook.com','09517372537',NULL,NULL,'$2y$10$iMlBCWOcTvXYeAbWlMY7w.yXUKrJPjrQ0wwSljtiReWjcTcRAyOH.',NULL,'2025-10-27 16:29:06','2025-10-27 16:29:06',1,'7SbWaSPvnG'),(12,'taruccc','tarucc12@gmail.com','09517372531',NULL,NULL,'$2y$10$2RXwXKVWiTMB0McJtH9GWOnY44cRLhP.LhT6AcxK2nFELRqjQ6GtO',NULL,'2025-11-30 06:18:38','2025-11-30 06:21:21',0,NULL),(13,'karnal','karnal@gmail.com','09517372539',NULL,NULL,'$2y$10$qrYRw8dejuxjIOg/o3TffuVZUMQnKDcRBDncumZv.aIQmV/5LIxXS',NULL,'2026-01-20 02:52:09','2026-01-20 04:20:40',0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vats`
--

DROP TABLE IF EXISTS `vats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `rate` decimal(5,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vats`
--

LOCK TABLES `vats` WRITE;
/*!40000 ALTER TABLE `vats` DISABLE KEYS */;
INSERT INTO `vats` VALUES (1,'standard vat',15.00,1,NULL,'2025-10-27 21:59:23');
/*!40000 ALTER TABLE `vats` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-11 15:24:14
