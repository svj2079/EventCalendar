-- MariaDB dump 10.17  Distrib 10.4.10-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: eventcalendar
-- ------------------------------------------------------
-- Server version	10.4.10-MariaDB

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
-- Table structure for table `EventAccess`
--

DROP TABLE IF EXISTS `EventAccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventAccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) DEFAULT NULL,
  `AccessType` enum('READ','WRITE') COLLATE utf8_persian_ci DEFAULT NULL,
  `EventID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='دسترسی مدیران';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventAccess`
--

LOCK TABLES `EventAccess` WRITE;
/*!40000 ALTER TABLE `EventAccess` DISABLE KEYS */;
INSERT INTO `EventAccess` VALUES (6,216,'WRITE',24),(7,401366302,'READ',24),(8,31,'READ',25),(9,401377479,'WRITE',21),(10,401369284,'WRITE',23);
/*!40000 ALTER TABLE `EventAccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_persian_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `CreatorID` int(11) DEFAULT NULL,
  `EventTypeID` int(11) DEFAULT NULL,
  `title` varchar(45) COLLATE utf8_persian_ci DEFAULT NULL,
  `ForProf` enum('YES','NO') COLLATE utf8_persian_ci DEFAULT NULL,
  `ForStudent` enum('YES','NO') COLLATE utf8_persian_ci DEFAULT NULL,
  `ForStaff` enum('YES','NO') COLLATE utf8_persian_ci DEFAULT NULL,
  `UnitID` int(11) DEFAULT NULL,
  `SubUnitID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='رویداد';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (31,'2020-09-28 00:00:00','2021-03-22 23:59:00','',1,1,47,'t','NO','NO','NO',61,1),(20,'2021-09-24 02:11:00','2021-10-24 16:11:00','انتخاب واحد',3,1,32,'test3 test',NULL,NULL,NULL,NULL,NULL),(21,'2021-09-24 12:12:00','2021-10-24 00:10:00','test',2,1,32,'sahar','NO','NO','NO',NULL,NULL),(22,'2021-09-24 00:11:00','2021-10-24 11:12:00','test test1',2,1,47,'test1',NULL,NULL,NULL,NULL,NULL),(23,'2021-09-24 00:11:00','2021-10-24 16:12:00','test test2',2,1,33,'test2','YES','YES','YES',NULL,NULL),(24,'2020-09-28 12:11:00','2021-10-24 16:12:00','test3',1,1,47,'test2','NO','NO','NO',11,220),(25,'2021-03-22 00:07:00','2021-03-22 00:09:00','',1,1,47,'سحر','NO','NO','NO',61,1),(26,'2020-09-28 00:00:00','2021-03-22 23:59:00','',1,1,47,'mytest','NO','NO','NO',61,1),(27,'2020-09-28 00:00:00','2021-03-22 23:59:00','',1,1,47,'mytest2','NO','NO','NO',61,1),(28,'2020-09-28 00:00:00','2021-03-22 23:59:00','',1,1,47,'1','NO','NO','NO',61,1),(29,'2021-03-22 00:00:00','2021-10-24 23:59:00','',1,1,47,'2','NO','NO','NO',61,1),(30,'2020-09-28 00:00:00','2021-10-24 23:59:00','',1,1,47,'4','NO','NO','NO',61,1),(32,'2020-09-28 00:00:00','2021-10-24 23:59:00','',1,1,47,'test2','NO','NO','NO',61,1),(33,'2021-03-20 00:00:00','1921-03-20 23:59:00','test test2',1,1,47,'test3 test','NO','NO','NO',61,1),(34,'2020-09-28 00:00:00','2021-03-22 23:59:00','',1,1,47,'ldshaghbvpfuigqepihfbclaksjhdbf','NO','NO','NO',61,1),(35,'2020-09-28 00:00:00','2021-03-22 23:59:00','',1,1,47,'test3 test','NO','NO','NO',61,1),(36,'2021-03-22 00:00:00','2021-10-24 23:59:00','',1,1,47,'ldshaghbvpfuigqepihfbclaksjhdbf','NO','NO','NO',61,1),(39,'2022-02-21 00:00:00','2022-03-23 23:59:00','',1,1,47,'سحر','NO','NO','NO',61,1),(38,'2020-09-28 00:00:00','2021-03-22 23:59:00','this is\r\ntest',1,1,47,'test textarea','NO','NO','NO',61,1);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventTaskPerson`
--

DROP TABLE IF EXISTS `EventTaskPerson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventTaskPerson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EventTaskID` int(11) DEFAULT NULL,
  `PersonID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='افراد مرتبط به رویداد';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventTaskPerson`
--

LOCK TABLES `EventTaskPerson` WRITE;
/*!40000 ALTER TABLE `EventTaskPerson` DISABLE KEYS */;
INSERT INTO `EventTaskPerson` VALUES (1,6,100520),(2,7,703751),(3,8,348),(4,9,401365363),(5,9,327),(7,9,230);
/*!40000 ALTER TABLE `EventTaskPerson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventTaskPersonNotify`
--

DROP TABLE IF EXISTS `EventTaskPersonNotify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventTaskPersonNotify` (
  `EventTaskPersonNotifyID` int(11) NOT NULL AUTO_INCREMENT,
  `NotifyType` enum('EMAIL','SMS','TASK') COLLATE utf8_persian_ci DEFAULT NULL,
  `SendDate` datetime DEFAULT NULL,
  `PersonID` int(11) DEFAULT NULL,
  `EventTaskID` int(11) DEFAULT NULL,
  PRIMARY KEY (`EventTaskPersonNotifyID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='دریافت مشخصات اطلاع رسانی ارسال شده';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventTaskPersonNotify`
--

LOCK TABLES `EventTaskPersonNotify` WRITE;
/*!40000 ALTER TABLE `EventTaskPersonNotify` DISABLE KEYS */;
/*!40000 ALTER TABLE `EventTaskPersonNotify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventTasks`
--

DROP TABLE IF EXISTS `EventTasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventTasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) COLLATE utf8_persian_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `EventID` int(11) DEFAULT NULL,
  `NotifyByEmail` enum('YES','NO') COLLATE utf8_persian_ci DEFAULT NULL,
  `NotifyBySms` enum('YES','NO') COLLATE utf8_persian_ci DEFAULT NULL,
  `NotifyByTask` enum('YES','NO') COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='فعالیت های رویداد';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventTasks`
--

LOCK TABLES `EventTasks` WRITE;
/*!40000 ALTER TABLE `EventTasks` DISABLE KEYS */;
INSERT INTO `EventTasks` VALUES (1,'انتخاب واحد2',2,17,NULL,NULL,NULL),(2,'انتخاب واحد',1,17,NULL,NULL,NULL),(3,'انتخاب واحد2',1,20,NULL,NULL,NULL),(7,'test',2,20,NULL,NULL,NULL),(6,'test',1,21,'NO','NO','YES'),(8,'jkjk',1,23,NULL,NULL,NULL),(9,'test',4,24,NULL,NULL,NULL),(10,'vgjvg',1,1,NULL,NULL,NULL),(11,'vgjvg',1,1,NULL,NULL,NULL),(15,'test2',1,21,NULL,NULL,NULL),(13,'',1,24,NULL,NULL,NULL),(14,'test2',1,20,NULL,NULL,NULL),(16,'test',2,31,'YES','NO','YES');
/*!40000 ALTER TABLE `EventTasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventTypes`
--

DROP TABLE IF EXISTS `EventTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventTypes`
--

LOCK TABLES `EventTypes` WRITE;
/*!40000 ALTER TABLE `EventTypes` DISABLE KEYS */;
INSERT INTO `EventTypes` VALUES (47,'omid'),(31,'test3'),(32,'test'),(33,'test2'),(34,'test3');
/*!40000 ALTER TABLE `EventTypes` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-12 16:40:43
