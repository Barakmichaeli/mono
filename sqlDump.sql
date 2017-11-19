CREATE DATABASE  IF NOT EXISTS `accounts` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `accounts`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: accounts
-- ------------------------------------------------------
-- Server version	5.7.19-log

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
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information` (
  `username` varchar(255) NOT NULL,
  `access_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES ('barak','2017-11-19 00:30:55','LOGIN'),('barak','2017-11-19 00:31:01','LOGOUT'),('barak','2017-11-19 00:36:36','RESET'),('barak','2017-11-19 00:38:58','FORGET'),('barak','2017-11-19 00:39:20','RESET'),('barak','2017-11-19 00:39:29','LOGIN'),('barak','2017-11-19 00:39:58','LOGOUT'),('barak','2017-11-19 00:40:11','LOGIN'),('barak','2017-11-19 00:40:14','LOGOUT'),('barak','2017-11-19 00:40:15','LOGIN'),('barak','2017-11-19 00:40:59','REGISTER'),('barak','2017-11-19 00:41:06','LOGOUT');
/*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monolith_users`
--

DROP TABLE IF EXISTS `monolith_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monolith_users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `verified` int(20) DEFAULT '1',
  `hashkey` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monolith_users`
--

LOCK TABLES `monolith_users` WRITE;
/*!40000 ALTER TABLE `monolith_users` DISABLE KEYS */;
INSERT INTO `monolith_users` VALUES ('barak','barak6546@gmail.com','$2y$10$juqGJsa81Subco7n4zbRuujSnDGaEe2DvqjOX9OiSYKyXsEKTtc0G','a283c2fa682d70aae6928ffd73c13363',1,'09853c7fb1d3f8ee67a61b6bf4a7f8e6');
/*!40000 ALTER TABLE `monolith_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-19  2:43:39
