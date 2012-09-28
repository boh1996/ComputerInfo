-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: computerinfo
-- ------------------------------------------------------
-- Server version	5.5.16

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
-- Current Database: `computerinfo`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `computerinfo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `computerinfo`;

--
-- Table structure for table `buildings`
--

DROP TABLE IF EXISTS `buildings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buildings` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `organization_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buildings`
--

LOCK TABLES `buildings` WRITE;
/*!40000 ALTER TABLE `buildings` DISABLE KEYS */;
/*!40000 ALTER TABLE `buildings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computer_graphic_settings`
--

DROP TABLE IF EXISTS `computer_graphic_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_graphic_settings` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `graphic_card_id` int(255) DEFAULT NULL,
  `computer_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_graphic_settings`
--

LOCK TABLES `computer_graphic_settings` WRITE;
/*!40000 ALTER TABLE `computer_graphic_settings` DISABLE KEYS */;
INSERT INTO `computer_graphic_settings` VALUES (1,1,1),(2,2,1);
/*!40000 ALTER TABLE `computer_graphic_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computer_group_members`
--

DROP TABLE IF EXISTS `computer_group_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_group_members` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `computer_id` int(255) DEFAULT NULL,
  `group_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_group_members`
--

LOCK TABLES `computer_group_members` WRITE;
/*!40000 ALTER TABLE `computer_group_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `computer_group_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computer_groups`
--

DROP TABLE IF EXISTS `computer_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_groups` (
  `id` int(255) NOT NULL,
  `organization_id` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_groups`
--

LOCK TABLES `computer_groups` WRITE;
/*!40000 ALTER TABLE `computer_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `computer_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computer_memory`
--

DROP TABLE IF EXISTS `computer_memory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_memory` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `computer_id` int(255) DEFAULT NULL,
  `total_physical_memory` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_memory`
--

LOCK TABLES `computer_memory` WRITE;
/*!40000 ALTER TABLE `computer_memory` DISABLE KEYS */;
INSERT INTO `computer_memory` VALUES (2,95,'400'),(3,1,'3241'),(4,2,'3241'),(5,3,'3241'),(6,4,'3241'),(7,5,'3241'),(8,6,'3241'),(9,7,'3241'),(10,8,'2039'),(11,9,'1976'),(12,10,'1015'),(13,11,'2039'),(14,12,'1015'),(15,13,'2038'),(16,14,'2039'),(17,15,'1015'),(18,16,'3241'),(19,17,'1015'),(20,18,'2039'),(21,19,'503'),(22,20,'1015'),(23,21,'2039'),(24,22,'2039'),(25,23,'3241'),(26,24,'2039'),(27,25,'2039'),(28,26,'503'),(29,27,'1903'),(30,28,'1015'),(31,29,'1015'),(32,30,'1015'),(33,31,'1015'),(34,32,'1015'),(35,33,'503'),(36,34,'503'),(37,35,'3543'),(38,36,'1015'),(39,37,'1014'),(40,38,'1014'),(41,39,'1015'),(42,40,'1014'),(43,41,'1015'),(44,42,'1014'),(45,43,'503'),(46,44,'503'),(47,45,'503'),(48,46,'503'),(49,47,'1015'),(50,48,'1015'),(51,49,'1015'),(52,50,'1015'),(53,51,'1015'),(54,52,'1015'),(55,53,'1015'),(56,54,'1015'),(57,55,'1015'),(58,56,'1015'),(59,57,'1015'),(60,58,'1015'),(61,59,'1903'),(62,60,'1015'),(63,61,'1015'),(64,62,'1015'),(65,63,'1015'),(66,64,'1015'),(67,65,'1976'),(68,66,'1903'),(69,67,'1976'),(70,68,'1903'),(71,69,'1903'),(72,70,'3241'),(73,71,'3241'),(74,72,'3241'),(75,73,'3241'),(76,74,'3241'),(77,75,'1015'),(78,76,'1015'),(79,77,'2039'),(80,78,'2039'),(81,79,'503'),(82,80,'502'),(83,81,'502'),(84,82,'502'),(85,83,'3241'),(86,84,'1015'),(87,85,'3543'),(88,86,'503'),(89,87,'503'),(90,88,'503'),(91,89,'1015'),(92,90,'1015'),(93,91,'1976'),(94,92,'1903'),(95,93,'1903'),(96,94,'1903');
/*!40000 ALTER TABLE `computer_memory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computer_memory_slots`
--

DROP TABLE IF EXISTS `computer_memory_slots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_memory_slots` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `computer_memory_id` int(255) DEFAULT NULL,
  `empty` varchar(5) DEFAULT '0',
  `capacity` varchar(100) DEFAULT NULL,
  `manufacturer_id` int(255) DEFAULT NULL,
  `serial` varchar(100) DEFAULT NULL,
  `part_number` varchar(150) DEFAULT NULL,
  `speed` int(100) DEFAULT NULL,
  `device_identifier` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_memory_slots`
--

LOCK TABLES `computer_memory_slots` WRITE;
/*!40000 ALTER TABLE `computer_memory_slots` DISABLE KEYS */;
INSERT INTO `computer_memory_slots` VALUES (37,3,'true','3000',NULL,NULL,NULL,NULL,NULL),(42,2,'true','2000',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `computer_memory_slots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computer_models`
--

DROP TABLE IF EXISTS `computer_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_models` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `device_type` varchar(200) DEFAULT NULL,
  `detection_string` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `model_code` varchar(200) DEFAULT NULL,
  `computer_series_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_models`
--

LOCK TABLES `computer_models` WRITE;
/*!40000 ALTER TABLE `computer_models` DISABLE KEYS */;
INSERT INTO `computer_models` VALUES (1,4,'2','OptiPlex 790','OptiPlex 790',NULL,NULL),(2,NULL,'1','','Unknown Model',NULL,NULL),(3,NULL,'1','Please wait while WMIC compiles updated MOF files.                           \n\n','Unknown Model',NULL,NULL),(4,1,'1','HP Compaq nc6120 (PN936AV)','nc6120','PN936AV',NULL),(5,1,'1','HP Compaq nc6400 (EH522AV)','nc6400','EH522AV',NULL),(6,5,'2','7738A52','7738A52',NULL,NULL),(7,1,'2','HP Compaq dc7100 SFF(DX878AV)','dc7100 SFF','DX878AV',NULL),(8,1,'1','HP ProBook 6450b','ProBook 6450b',NULL,NULL),(9,1,'2','HP Compaq dc7600 Small Form Factor','dc7600 Small Form Factor',NULL,NULL),(10,1,'2','HP d530 SFF(DC578AV)','d530 SFF','DC578AV',NULL),(11,1,'2','HP Compaq dc7900 Small Form Factor','dc7900 Small Form Factor',NULL,NULL),(12,6,'2','ESPRIMO E','ESPRIMO E',NULL,NULL),(13,1,'1','HP Compaq 6530b (GW688AV)','6530b','GW688AV',NULL),(14,3,'1','2888WHX','2888WHX',NULL,NULL),(15,1,'2','HP Pavilion dv7 Notebook PC','Pavilion dv7 Notebook PC',NULL,NULL),(16,1,'1',NULL,'Test1234',NULL,NULL);
/*!40000 ALTER TABLE `computer_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computer_processors`
--

DROP TABLE IF EXISTS `computer_processors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_processors` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `computer_id` int(255) DEFAULT NULL,
  `processor_model_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_processors`
--

LOCK TABLES `computer_processors` WRITE;
/*!40000 ALTER TABLE `computer_processors` DISABLE KEYS */;
INSERT INTO `computer_processors` VALUES (2,1,1),(3,2,1),(4,3,1),(5,4,1),(6,5,1),(7,6,1),(8,7,1),(9,8,2),(10,9,1),(11,10,3),(12,11,2),(13,12,3),(14,13,4),(15,14,2),(16,15,3),(17,16,1),(18,17,3),(19,18,2),(20,19,5),(21,20,3),(22,21,2),(23,22,2),(24,23,1),(25,24,2),(26,25,2),(27,26,5),(28,27,6),(29,28,3),(30,29,3),(31,30,7),(32,31,3),(33,32,7),(34,33,5),(35,34,8),(36,35,1),(37,36,3),(38,37,9),(39,38,9),(40,39,3),(41,40,9),(42,41,7),(43,42,9),(44,43,5),(45,44,5),(46,45,5),(47,46,5),(48,47,3),(49,48,3),(50,49,3),(51,50,3),(52,51,3),(53,52,7),(54,53,7),(55,54,7),(56,55,7),(57,56,7),(58,57,7),(59,58,7),(60,59,6),(61,60,7),(62,61,7),(63,62,7),(64,63,7),(65,64,7),(66,65,1),(67,66,6),(68,67,1),(69,68,6),(70,69,6),(71,70,1),(72,71,1),(73,72,1),(74,73,1),(75,74,1),(76,75,3),(77,76,3),(78,77,2),(79,78,2),(80,79,8),(81,80,10),(82,81,10),(83,82,10),(84,83,1),(85,84,7),(86,85,1),(87,86,5),(88,87,5),(89,88,5),(90,89,7),(91,90,7),(92,91,1),(93,92,6),(94,93,6),(95,94,6);
/*!40000 ALTER TABLE `computer_processors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computer_series`
--

DROP TABLE IF EXISTS `computer_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_series` (
  `id` int(255) NOT NULL,
  `manufacturer_id` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_series`
--

LOCK TABLES `computer_series` WRITE;
/*!40000 ALTER TABLE `computer_series` DISABLE KEYS */;
/*!40000 ALTER TABLE `computer_series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computers`
--

DROP TABLE IF EXISTS `computers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(200) DEFAULT NULL,
  `organization_id` int(255) DEFAULT NULL,
  `lan_mac` varchar(200) DEFAULT NULL,
  `wifi_mac` varchar(200) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `disk_space` varchar(200) DEFAULT NULL,
  `model_id` int(255) DEFAULT NULL,
  `serial` varchar(200) DEFAULT NULL,
  `screen_size_id` varchar(200) DEFAULT NULL,
  `cpu_id` int(255) DEFAULT NULL,
  `created_time` int(255) DEFAULT NULL,
  `last_updated` int(255) DEFAULT NULL,
  `location_id` int(255) DEFAULT NULL,
  `lan_macs` varchar(2000) DEFAULT NULL,
  `power_usage_per_hour` varchar(200) DEFAULT NULL,
  `operating_system_verison_id` varchar(200) DEFAULT NULL,
  `last_updated_user_id` int(255) DEFAULT NULL,
  `creator_user_id` int(255) DEFAULT NULL,
  `date_of_purchase` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computers`
--

LOCK TABLES `computers` WRITE;
/*!40000 ALTER TABLE `computers` DISABLE KEYS */;
INSERT INTO `computers` VALUES (1,'BUF92146',1,'78-2B-CB-B3-97-73','','10.87.45.109','465',1,'JQDF45J','1',1,1320661211,1346515274,7,';78-2B-CB-B3-97-73;',NULL,'1',1,1,NULL),(2,'BUF92915',1,'78-2B-CB-B3-BF-89',NULL,'10.87.45.82','465',1,'CMLF45J','1',1,1320660541,1346515275,16,';78-2B-CB-B3-BF-89;',NULL,'1',1,1,NULL),(3,'BUF92128',1,'78-2B-CB-B3-C5-57',NULL,'10.87.45.80','465',1,'DVDF45J','1',1,1320659790,1346515275,16,';78-2B-CB-B3-C5-57;',NULL,'1',1,1,NULL),(4,'BUF92914',1,'78-2B-CB-B3-E7-05',NULL,'10.87.45.88','465',1,'7JLF45J','1',1,1320657411,1346515275,3,';78-2B-CB-B3-E7-05;',NULL,'1',1,1,NULL),(5,'BUF92236',1,'78-2B-CB-B3-CE-1E',NULL,'10.87.45.77','465',1,'8TDF45J','1',1,1320657402,1346515276,3,';78-2B-CB-B3-CE-1E;',NULL,'1',1,1,NULL),(6,'BUF92130',1,'78-2B-CB-B3-D3-08',NULL,'10.87.45.87','465',1,'1QDF45J','1',1,1320657138,1346515276,3,';78-2B-CB-B3-D3-08;',NULL,'1',1,1,NULL),(7,'BUF92133',1,'78-2B-CB-B3-CC-8D',NULL,'10.87.45.93','465',1,'8RDF45J','1',1,1320657072,1346515276,3,';78-2B-CB-B3-CC-8D;',NULL,'1',1,1,NULL),(8,'BUF79455',1,'00-16-D4-BA-D0-0D',NULL,'10.97.246.26','74',2,'8RDF45J','2',2,1308827887,1346515277,26,';00-16-D4-BA-D0-0D;',NULL,'1',1,1,NULL),(9,'BUF8v',1,'00-16-D4-BA-D0-0D',NULL,'172.16.0.6','232',3,'CNU0162HL3','3',1,1308307819,1346515277,27,';00-16-D4-BA-D0-0D;',NULL,'1',1,1,NULL),(10,'UUF72966',1,'00-15-60-B8-0A-61',NULL,'10.97.248.201','37',4,'HUB6230329','4',3,1308304583,1346515278,28,';00-15-60-B8-0A-61;',NULL,'1',1,1,NULL),(11,'UUF79376',1,'00-16-D4-BA-DF-A5',NULL,'10.87.45.74','74',5,'HUB70502FJ','3',2,1308303999,1346515278,2,';00-16-D4-BA-DF-A5;',NULL,'1',1,1,NULL),(12,'UUF72962',1,'00-15-60-B8-0A-BA',NULL,'10.97.242.49','37',4,'HUB6230324','4',3,1308302662,1346515278,3,';00-15-60-B8-0A-BA;',NULL,'1',1,1,NULL),(13,'UUF80594',1,'00-1E-37-15-83-AF',NULL,'10.97.248.221','74',6,'L3E0184','2',4,1308302653,1346515279,4,';00-1E-37-15-83-AF;',NULL,'1',1,1,NULL),(14,'BUF79487',1,'00-16-D4-BA-D6-EA',NULL,'10.97.251.26','74',2,'L3E0184','3',2,1308826930,1346515280,5,';00-16-D4-BA-D6-EA;',NULL,'1',1,1,NULL),(15,'UUF74895',1,'00-15-60-B9-87-34',NULL,'10.97.255.239','37',4,'HUB6160V41','4',3,1308223644,1346515280,6,';00-15-60-B9-87-34;',NULL,'1',1,1,NULL),(16,'BUF92138',1,'78-2B-CB-B3-D7-66',NULL,'10.87.45.94','465',1,'9PDF45J','1',1,1320656905,1346515281,7,';78-2B-CB-B3-D7-66;',NULL,'1',1,1,NULL),(17,'UUF72969',1,'00-15-60-C0-79-E0',NULL,'10.97.240.168','37',4,'HUB6230323','3',3,1308223582,1346515282,8,';00-15-60-C0-79-E0;',NULL,'1',1,1,NULL),(18,'UUF79369',1,'00-16-D4-A3-75-0E',NULL,'10.97.253.246','74',5,'HUB7050083','3',2,1308223380,1346515283,9,';00-16-D4-A3-75-0E;',NULL,'1',1,1,NULL),(19,'UUF68512',1,'00-13-21-01-6F-85',NULL,'10.87.45.162','74',7,'CZC5152P8B','3',5,1308222598,1346515283,10,';00-13-21-01-6F-85;',NULL,'1',1,1,NULL),(20,'UUF72965',1,'00-15-60-B8-D9-76',NULL,'10.97.254.26','37',4,'HUB6230325','3',3,1308222441,1346515284,11,';00-15-60-B8-D9-76;',NULL,'1',1,1,NULL),(21,'BUF79456',1,'00-16-D4-A5-6F-AA',NULL,'10.97.243.233','74',5,'HUB70418B2','3',2,1308222239,1346515285,12,';00-16-D4-A5-6F-AA;',NULL,'1',1,1,NULL),(22,'BUF79458',1,'00-16-D4-A2-0C-81',NULL,'10.97.243.27','74',5,'HUB7050084','3',2,1308221618,1346515286,11,';00-16-D4-A2-0C-81;',NULL,'1',1,1,NULL),(23,'BUF92121',1,'78-2B-CB-B3-C1-AF',NULL,'10.87.45.92','465',1,'GVDF45J','1',1,1320656837,1346515287,7,';78-2B-CB-B3-C1-AF;',NULL,'1',1,1,NULL),(24,'BUF79469',1,'00-16-D4-B9-83-C4',NULL,'10.97.248.17','74',5,'HUB70502KN','2',2,1308219527,1346515288,3,';00-16-D4-B9-83-C4;',NULL,'1',1,1,NULL),(25,'UUF79377',1,'00-16-D4-A4-14-64',NULL,'10.97.245.223','74',5,'HUB704189Y','3',2,1308219527,1346515289,13,';00-16-D4-A4-14-64;',NULL,'1',1,1,NULL),(26,'UUF68507',1,'00-12-79-AD-D5-16',NULL,'10.87.45.112','74',7,'CZC5152P2B','1',5,1308218022,1346515289,14,';00-12-79-AD-D5-16;',NULL,'1',1,1,NULL),(27,'BUF86174',1,'1C-C1-DE-AE-B7-31',NULL,'10.87.45.155','298',8,'CNU0395KB7','5',6,1308219249,1346515290,3,';1C-C1-DE-AE-B7-31;',NULL,'1',1,1,NULL),(28,'UUF74900',1,'00-15-60-B8-03-71',NULL,'10.97.253.209','37',4,'HUB6160V4T','3',3,1308217929,1346515291,3,';00-15-60-B8-03-71;',NULL,'1',1,1,NULL),(29,'BUF74899',1,'00-15-60-B9-9B-2E',NULL,'10.97.246.107','37',4,'HUB6160V9Y','3',3,1308217873,1346515292,15,';00-15-60-B9-9B-2E;',NULL,'1',1,1,NULL),(30,'UUF74033',1,'00-17-08-5E-C4-4F',NULL,'10.87.45.149','74',9,'CZC6152DJW','1',7,1308217811,1346515292,16,';00-17-08-5E-C4-4F;',NULL,'1',1,1,NULL),(31,'UUF72961',1,'00-15-60-B8-0A-5D',NULL,'10.97.254.97','37',4,'HUB623032C','3',3,1308216898,1346515293,17,';00-15-60-B8-0A-5D;',NULL,'1',1,1,NULL),(32,'UUF74913',1,'00-16-35-A5-E3-DE',NULL,'10.87.45.93','74',9,'CZC6152DGB','6',7,1308216572,1346515296,7,';00-16-35-A5-E3-DE;',NULL,'1',1,1,NULL),(33,'UUF68502',1,'00-12-79-AD-E1-9B',NULL,'10.87.45.101','74',7,'CZC5152P44','3',5,1308216562,1346515297,7,';00-12-79-AD-E1-9B;',NULL,'1',1,1,NULL),(34,'UUF61285',1,'00-11-0A-3A-59-50',NULL,'10.87.45.98','37',10,'FRB4290LL5','1',8,1308216505,1346515298,18,';00-11-0A-3A-59-50;',NULL,'1',1,1,NULL),(35,'BUF84647',1,'00-25-B3-14-43-4E',NULL,'10.87.45.84','232',11,'CZC9425034','1',1,1320655858,1346515299,3,';00-25-B3-14-43-4E;',NULL,'1',1,1,NULL),(36,'UUF72967',1,'00-15-60-B8-0A-BF',NULL,'10.97.251.209','37',4,'HUB6230328','3',3,1308216284,1346515300,3,';00-15-60-B8-0A-BF;',NULL,'1',1,1,NULL),(37,'BUF78295',1,'00-19-99-00-66-E1',NULL,'10.87.45.99','74',12,'YKXR089029','1',9,1308216201,1346515301,7,';00-19-99-00-66-E1;',NULL,'1',1,1,NULL),(38,'BUF78293',1,'00-19-99-00-67-11',NULL,'10.87.45.138','74',12,'YKXR089013','1',9,1308216177,1346515302,7,';00-19-99-00-67-11;',NULL,'1',1,1,NULL),(39,'UUF87135',1,'00-15-60-BC-D4-B8',NULL,'10.87.45.92','37',4,'HUB6210L6K','3',3,1308216121,1346515303,3,';00-15-60-BC-D4-B8;',NULL,'1',1,1,NULL),(40,'BUF78292',1,'00-19-99-00-84-D6',NULL,'10.87.45.105','74',12,'YKXR089130','1',9,1308216065,1346515304,7,';00-19-99-00-84-D6;',NULL,'1',1,1,NULL),(41,'UUF72790',1,'00-16-35-A7-26-08',NULL,'10.87.45.144','74',9,'CZC6152DGQ','4',7,1308216024,1346515305,7,';00-16-35-A7-26-08;',NULL,'1',1,1,NULL),(42,'BUF78294',1,'00-19-99-00-66-77',NULL,'10.87.45.87','74',12,'YKXR089145','1',9,1308216004,1346515306,7,';00-19-99-00-66-77;',NULL,'1',1,1,NULL),(43,'UUF68765',1,'00-12-79-AA-5F-70',NULL,'10.87.45.96','74',7,'CZC5152Q65','3',5,1308215917,1346515307,7,';00-12-79-AA-5F-70;',NULL,'1',1,1,NULL),(44,'UUF68513',1,'00-13-21-01-B2-65',NULL,'10.87.45.95','74',7,'CZC5152P4C','3',5,1308215545,1346515308,7,';00-13-21-01-B2-65;',NULL,'1',1,1,NULL),(45,'UUF68503',1,'00-13-21-01-B2-74',NULL,'10.87.45.94','74',7,'CZC5152P03','1',5,1308215473,1346515309,7,';00-13-21-01-B2-74;',NULL,'1',1,1,NULL),(46,'UUF68768',1,'00-12-79-AD-E1-D3',NULL,'10.87.45.103','74',7,'CZC5152Q6C','3',5,1308215389,1346515310,7,';00-12-79-AD-E1-D3;',NULL,'1',1,1,NULL),(47,'UUF72963',1,'00-15-60-BE-EC-4C',NULL,'10.97.248.39','37',4,'HUB6230322','3',3,1308215112,1346515312,3,';00-15-60-BE-EC-4C;',NULL,'1',1,1,NULL),(48,'UUF72964',1,'00-15-60-B8-06-9F',NULL,'10.97.250.215','37',4,'HUB6230327','3',3,1308215094,1346515313,3,';00-15-60-B8-06-9F;',NULL,'1',1,1,NULL),(49,'UUF72968',1,'00-15-60-B8-06-77',NULL,'10.97.240.53','37',4,'HUB623032B','3',3,1308215016,1346515314,3,';00-15-60-B8-06-77;',NULL,'1',1,1,NULL),(50,'UUF74883',1,'00-15-60-B9-18-FE',NULL,'10.97.254.125','37',4,'HUB6160V6N','3',3,1308215672,1346515316,3,';00-15-60-B9-18-FE;',NULL,'1',1,1,NULL),(51,'UUF74896',1,'00-15-60-B8-86-24',NULL,'10.97.249.241','37',4,'HUB6160V40','3',3,1308215656,1346515321,3,';00-15-60-B8-86-24;',NULL,'1',1,1,NULL),(52,'UUF72992',1,'00-17-A4-1C-6E-AB',NULL,'10.87.45.9','74',9,'CZC6210WGW','1',7,1308213951,1346515322,19,';00-17-A4-1C-6E-AB;',NULL,'1',1,1,NULL),(53,'UUF72996',1,'00-17-A4-1C-6E-CC',NULL,'10.87.45.117','74',9,'CZC6210WGR','1',7,1308213777,1346515324,7,';00-17-A4-1C-6E-CC;',NULL,'1',1,1,NULL),(54,'UUF74030',1,'00-16-35-A7-25-D1',NULL,'10.87.45.86','74',9,'CZC6152D97','1',7,1308213723,1346515326,7,';00-16-35-A7-25-D1;',NULL,'1',1,1,NULL),(55,'UUF72995',1,'00-17-A4-1E-0D-19',NULL,'10.87.45.91','74',9,'CZC6210W8F','1',7,1308213697,1346515327,7,';00-17-A4-1E-0D-19;',NULL,'1',1,1,NULL),(56,'UUF74031',1,'00-16-35-AA-00-9E',NULL,'10.87.45.82','74',9,'CZC6152DJH','1',7,1308214053,1346515329,7,';00-16-35-AA-00-9E;',NULL,'1',1,1,NULL),(57,'UUF74034',1,'00-16-35-A9-FE-B1',NULL,'10.87.45.88','74',9,'CZC6152D99','1',7,1308213652,1346515335,7,';00-16-35-A9-FE-B1;',NULL,'1',1,1,NULL),(58,'UUF74032',1,'00-16-35-A5-E3-E9',NULL,'10.87.45.90','74',9,'CZC6152DLN','1',7,1308213588,1346515337,7,';00-16-35-A5-E3-E9;',NULL,'1',1,1,NULL),(59,'BUF86171',1,'1C-C1-DE-AE-79-2C',NULL,'10.87.45.142','298',8,'CNU0395LCG','5',6,1308213558,1346515339,3,';1C-C1-DE-AE-79-2C;',NULL,'1',1,1,NULL),(60,'UUF72792',1,'00-16-35-A7-25-D5',NULL,'10.87.45.85','74',9,'CZC6152DJ4','1',7,1308213501,1346515341,7,';00-16-35-A7-25-D5;',NULL,'1',1,1,NULL),(61,'UUF72991',1,'00-17-A4-1C-29-23',NULL,'10.87.45.81','74',9,'CZC6210WG7','1',7,1308213446,1346515343,7,';00-17-A4-1C-29-23;',NULL,'1',1,1,NULL),(62,'UUF72990',1,'00-17-A4-1D-C7-97',NULL,'10.87.45.83','74',9,'CZC6210WFK','1',7,1308213394,1346515345,7,';00-17-A4-1D-C7-97;',NULL,'1',1,1,NULL),(63,'UUF72994',1,'00-17-A4-1C-6E-E4',NULL,'10.87.45.125','74',9,'CZC6210WFV','1',7,1308213390,1346515348,7,';00-17-A4-1C-6E-E4;',NULL,'1',1,1,NULL),(64,'UUF72791',1,'00-16-35-A7-A2-91',NULL,'10.87.45.89','74',9,'CZC6152DBH','1',7,1308213371,1346515350,7,';00-16-35-A7-A2-91;',NULL,'1',1,1,NULL),(65,'BUF82313',1,'00-24-81-65-32-E2',NULL,'192.168.0.1','232',13,'CNU91659M1','2',1,1308213311,1346515352,3,';00-24-81-65-32-E2;',NULL,'1',1,1,NULL),(66,'BUF86175',1,'1C-C1-DE-AE-79-42',NULL,'10.87.45.139','298',8,'CNU0395LD4','5',6,1308213285,1346515354,3,';1C-C1-DE-AE-79-42;',NULL,'1',1,1,NULL),(67,'BUF82297',1,'00-24-81-65-FC-59',NULL,'10.97.252.254','232',13,'CNU91659MR','2',1,1308213256,1346515356,3,';00-24-81-65-FC-59;',NULL,'1',1,1,NULL),(68,'BUF86169',1,'1C-C1-DE-AE-B9-11',NULL,'10.87.45.119','298',8,'CNU04003R5','5',6,1308213235,1346515360,3,';1C-C1-DE-AE-B9-11;',NULL,'1',1,1,NULL),(69,'BUF86172',1,'1C-C1-DE-AE-B9-B3',NULL,'10.87.45.140','298',8,'CNU0395L94','5',6,1308213204,1346515363,3,';1C-C1-DE-AE-B9-B3;',NULL,'1',1,1,NULL),(70,'BUF92112',1,'78-2B-CB-B3-CE-12',NULL,'10.87.45.105','465',1,'JSDF45J','1',1,1320658364,1346515365,20,';78-2B-CB-B3-CE-12;',NULL,'1',1,1,NULL),(71,'BUF92229',1,'78-2B-CB-B3-E8-66',NULL,'10.87.45.73','465',1,'3PDF45J','1',1,1320657721,1346515368,3,';78-2B-CB-B3-E8-66;',NULL,'1',1,1,NULL),(72,'BUF92135',1,'78-2B-CB-B3-DC-49',NULL,'10.87.45.104','465',1,'6TDF45J','1',1,1320657582,1346515370,3,';78-2B-CB-B3-DC-49;',NULL,'1',1,1,NULL),(73,'BUF92144',1,'78-2B-CB-B3-CA-7D',NULL,'10.87.45.103','465',1,'GTDF45J','1',1,1320657534,1346515373,3,';78-2B-CB-B3-CA-7D;',NULL,'1',1,1,NULL),(74,'BUF92111',1,'78-2B-CB-B3-51-D5',NULL,'10.87.45.106','465',1,'4QDF45J','1',1,1320657473,1346515375,3,';78-2B-CB-B3-51-D5;',NULL,'1',1,1,NULL),(75,'UUF67692',1,'00-15-60-BE-03-8A',NULL,'10.97.248.37','37',4,'HUB6210LFY','3',3,1308304654,1346515377,21,';00-15-60-BE-03-8A;',NULL,'1',1,1,NULL),(76,'UUF74893',1,'00-15-60-B9-CB-40',NULL,'10.87.45.165','37',4,'HUB6160V5T','4',3,1308223514,1346515380,22,';00-15-60-B9-CB-40;',NULL,'1',1,1,NULL),(77,'BUF79484',1,'00-16-D4-BA-CF-AA',NULL,'10.97.253.6','74',5,'HUB70502K4','2',2,1308222126,1346515382,23,';00-16-D4-BA-CF-AA;',NULL,'1',1,1,NULL),(78,'BUF79374',1,'00-16-D4-B9-83-F6',NULL,'10.97.252.115','74',5,'HUB70502L0','2',2,1308221610,1346515384,24,';00-16-D4-B9-83-F6;',NULL,'1',1,1,NULL),(79,'UUF61291',1,'00-11-0A-3B-E5-15',NULL,'10.87.45.158','37',10,'FRB4290LKM','3',8,1308220680,1346515387,5,';00-11-0A-3B-E5-15;',NULL,'1',1,1,NULL),(80,'UUF70108',1,'00-11-25-AF-A6-92',NULL,'10.97.253.169','37',14,'L3HAXRM','3',10,1308220603,1346515389,25,';00-11-25-AF-A6-92;',NULL,'1',1,1,NULL),(81,'UUF70177',1,'00-11-25-48-1C-D1',NULL,'10.97.252.209','37',14,'L3HAYYK','3',10,1308220553,1346515392,25,';00-11-25-48-1C-D1;',NULL,'1',1,1,NULL),(82,'UUF70174',1,'00-11-25-48-19-1F',NULL,'10.97.253.207','37',14,'L3HAYNL','3',10,1308220139,1346515394,25,';00-11-25-48-19-1F;',NULL,'1',1,1,NULL),(83,'BUF92226',1,'78-2B-CB-B3-EF-34',NULL,'10.87.45.90','465',1,'FNDF45J','1',1,1320656880,1346515400,3,';78-2B-CB-B3-EF-34;',NULL,'1',1,1,NULL),(84,'UUF74911',1,'00-16-35-A7-A6-0A',NULL,'10.87.45.111','74',9,'CZC6152DFF','1',7,1308217927,1346515403,16,';00-16-35-A7-A6-0A;',NULL,'1',1,1,NULL),(85,'BUF84646',1,'00-25-B3-14-44-FD',NULL,'10.87.45.135','232',11,'CZC942503H','1',1,1308216376,1346515405,7,';00-25-B3-14-44-FD;',NULL,'1',1,1,NULL),(86,'UUF68505',1,'00-13-21-01-B2-A3',NULL,'10.87.45.107','74',7,'CZC5152P71','3',5,1308216352,1346515408,7,';00-13-21-01-B2-A3;',NULL,'1',1,1,NULL),(87,'UUF68767',1,'00-12-79-AA-63-AA',NULL,'10.87.45.100','74',7,'CZC5152Q46','3',5,1308215862,1346515411,7,';00-12-79-AA-63-AA;',NULL,'1',1,1,NULL),(88,'UUF68506',1,'00-13-21-01-6E-D8',NULL,'10.87.45.97','74',7,'CZC5152P8L','3',5,1308215763,1346515414,7,';00-13-21-01-6E-D8;',NULL,'1',1,1,NULL),(89,'UUF72993',1,'00-17-A4-1B-26-B0',NULL,'10.87.45.10','74',9,'CZC6210WD7','1',7,1308213794,1346515417,16,';00-17-A4-1B-26-B0;',NULL,'1',1,1,NULL),(90,'UUF72793',1,'00-16-35-A7-25-F7',NULL,'10.87.45.80','74',9,'CZC6152DJF','1',7,1308213611,1346515420,7,';00-16-35-A7-25-F7;',NULL,'1',1,1,NULL),(91,'BUF82312',1,'00-24-81-61-E4-56',NULL,'10.97.255.25','232',13,'CNU91658Y4','2',1,1308213091,1346515424,3,';00-24-81-61-E4-56;',NULL,'1',1,1,NULL),(92,'BUF86168',1,'1C-C1-DE-AE-C7-97',NULL,'10.87.45.133','298',8,'CNU0395L52','5',6,1308213084,1346515427,3,';1C-C1-DE-AE-C7-97;',NULL,'1',1,1,NULL),(93,'BUF86170',1,'1C-C1-DE-AE-E7-11',NULL,'10.87.45.131','298',8,'CNU04018CT','5',6,1308213067,1346515430,3,';1C-C1-DE-AE-E7-11;',NULL,'1',1,1,NULL),(94,'BUF86173',1,'1C-C1-DE-AE-69-9D',NULL,'10.87.45.136','298',8,'CNU04003QN','5',6,1308213078,1346515433,3,';1C-C1-DE-AE-69-9D;',NULL,'1',1,1,NULL),(95,'TestLink',1,'1C-C1-DE-AE-69-9D',NULL,'10.87.45.136','298',5,'CNU04003QN','5',NULL,1308213078,1346515436,4,';1C-C1-DE-AE-69-9D;',NULL,'1',1,1,NULL);
/*!40000 ALTER TABLE `computers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `connected_devices`
--

DROP TABLE IF EXISTS `connected_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connected_devices` (
  `id` int(255) NOT NULL,
  `device_id` int(255) DEFAULT NULL,
  `connected_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connected_devices`
--

LOCK TABLES `connected_devices` WRITE;
/*!40000 ALTER TABLE `connected_devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `connected_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `connected_to_printers`
--

DROP TABLE IF EXISTS `connected_to_printers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connected_to_printers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `device_id` int(255) DEFAULT NULL,
  `printer_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connected_to_printers`
--

LOCK TABLES `connected_to_printers` WRITE;
/*!40000 ALTER TABLE `connected_to_printers` DISABLE KEYS */;
/*!40000 ALTER TABLE `connected_to_printers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpus`
--

DROP TABLE IF EXISTS `cpus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cpus` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `cores` int(20) DEFAULT NULL,
  `clock_rate` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `detection_string` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpus`
--

LOCK TABLES `cpus` WRITE;
/*!40000 ALTER TABLE `cpus` DISABLE KEYS */;
INSERT INTO `cpus` VALUES (1,2,4,NULL,'Pentium III Xeon','Intel Pentium III Xeon-processor'),(2,2,2,'2.00GHz','Core 2 T7200','Intel(R) Core(TM)2 CPU         T7200  @ 2.00GHz'),(3,2,1,'1.73GHz','Pentium M','Intel(R) Pentium(R) M processor 1.73GHz'),(4,2,2,'2.00GHz','Core 2 Duo T7250','Intel(R) Core(TM)2 Duo CPU     T7250  @ 2.00GHz'),(5,2,2,'3.20GHz','Pentium 4','Intel(R) Pentium(R) 4 CPU 3.20GHz'),(6,2,4,NULL,'Pentium II','Intel Pentium II-processor'),(7,2,2,'3.00GHz','Pentium 4','Intel(R) Pentium(R) 4 CPU 3.00GHz'),(8,2,1,'2.80GHz','Pentium 4','Intel(R) Pentium(R) 4 CPU 2.80GHz'),(9,2,2,'1.80GHz','Core 2','Intel(R) Core(TM)2 CPU          4300  @ 1.80GHz'),(10,2,1,'1.60GHz','Pentium M','Intel(R) Pentium(R) M processor 1.60GHz');
/*!40000 ALTER TABLE `cpus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_categories`
--

DROP TABLE IF EXISTS `device_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_categories` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_categories`
--

LOCK TABLES `device_categories` WRITE;
/*!40000 ALTER TABLE `device_categories` DISABLE KEYS */;
INSERT INTO `device_categories` VALUES (1,'Computer'),(2,'Other');
/*!40000 ALTER TABLE `device_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_models`
--

DROP TABLE IF EXISTS `device_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_models` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `device_type_id` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_models`
--

LOCK TABLES `device_models` WRITE;
/*!40000 ALTER TABLE `device_models` DISABLE KEYS */;
INSERT INTO `device_models` VALUES (1,7,4,'FS100'),(2,8,4,'DMC-FS25'),(3,10,3,'TDP - T45'),(4,11,4,'HD 3G 4GB - Trend Black '),(5,12,3,'In2114'),(6,9,3,'CPx260'),(7,9,3,'CPx300'),(8,10,3,'TDP-T45'),(9,10,3,'TDP-x21'),(10,13,3,'MP772ST'),(11,10,3,'TDP-T90A');
/*!40000 ALTER TABLE `device_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_types`
--

DROP TABLE IF EXISTS `device_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `device_category_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_types`
--

LOCK TABLES `device_types` WRITE;
/*!40000 ALTER TABLE `device_types` DISABLE KEYS */;
INSERT INTO `device_types` VALUES (1,'Laptop','1'),(2,'Desktop','1'),(3,'Projector','2'),(4,'Camera','2'),(5,'Tablet','1'),(6,'Smartphone','2'),(7,'Unknown','1');
/*!40000 ALTER TABLE `device_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(200) DEFAULT NULL,
  `description` text,
  `model_id` int(255) DEFAULT NULL,
  `location_id` varchar(200) DEFAULT NULL,
  `serial` varchar(200) DEFAULT NULL,
  `year_of_purchase` varchar(200) DEFAULT NULL,
  `organization_id` int(255) DEFAULT NULL,
  `created_time` int(200) DEFAULT NULL,
  `last_updated` int(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,'UUF79062',NULL,1,'3',NULL,NULL,1,1337440562,1337440562),(2,'Lumix 04',NULL,2,'3',NULL,NULL,1,1337440562,1337440562),(3,'Lumix 01',NULL,2,'3',NULL,NULL,1,1337440562,1337440562),(4,'Lumix 02',NULL,2,'3',NULL,NULL,1,1337440562,1337440562),(5,'Lumix 03',NULL,2,'3',NULL,NULL,1,1337440562,1337440562),(6,'BUF78478',NULL,NULL,'3',NULL,NULL,1,1337440563,1337440563),(7,'UUF16016',NULL,3,'7',NULL,NULL,1,1337440563,1337440563),(8,'BUF8290',NULL,NULL,'13',NULL,NULL,1,1337440563,1337440563),(9,'BUF80284',NULL,NULL,'5',NULL,NULL,1,1337440563,1337440563),(10,'BUF80224',NULL,NULL,'30',NULL,NULL,1,1337440563,1337440563),(11,'Vado1',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(12,'Vado2',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(13,'Vado3',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(14,'Vado4',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(15,'Vado5',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(16,'BUF84785',NULL,5,'32',NULL,NULL,1,1337440563,1337440563),(17,'BUF78472',NULL,6,'33',NULL,NULL,1,1337440563,1337440563),(18,'BUF84121',NULL,7,'28',NULL,NULL,1,1337440563,1337440563),(19,'BUF84784',NULL,5,'22',NULL,NULL,1,1337440563,1337440563),(20,'BUF84120',NULL,7,'34',NULL,NULL,1,1337440563,1337440563),(21,'UUF76076',NULL,8,'7',NULL,NULL,1,1337440563,1337440563),(22,'BUF84123',NULL,7,'15',NULL,NULL,1,1337440563,1337440563),(23,'BUF78476',NULL,6,'17',NULL,NULL,1,1337440563,1337440563),(24,'BUF76078',NULL,8,'35',NULL,NULL,1,1337440563,1337440563),(25,'BUF80230',NULL,9,'24',NULL,NULL,1,1337440563,1337440563),(26,'BUF84122',NULL,7,'',NULL,NULL,1,1337440563,1337440563),(27,'BUF80219',NULL,9,'',NULL,NULL,1,1337440563,1337440563),(28,'BUF80204',NULL,9,'36',NULL,NULL,1,1337440563,1337440563),(29,'BUF80290',NULL,9,'13',NULL,NULL,1,1337440563,1337440563),(30,'BUF80203',NULL,9,'11',NULL,NULL,1,1337440563,1337440563),(31,'Y1',NULL,10,'37',NULL,NULL,1,1337440563,1337440563),(32,'BUF78475',NULL,6,'10',NULL,NULL,1,1337440563,1337440563),(33,'BUF80301',NULL,9,'12',NULL,NULL,1,1337440563,1337440563),(34,'BUF80296',NULL,9,'23',NULL,NULL,1,1337440563,1337440563),(35,'UUF71281',NULL,11,'2',NULL,NULL,1,1337440563,1337440563),(36,'Y2',NULL,10,'21',NULL,NULL,1,1337440563,1337440563),(37,'Y3',NULL,10,'8',NULL,NULL,1,1337440563,1337440563),(38,'Y4',NULL,10,'6',NULL,NULL,1,1337440563,1337440563),(39,'Y5',NULL,10,'9',NULL,NULL,1,1337440563,1337440563),(40,'BUF84783',NULL,5,'27',NULL,NULL,1,1337440563,1337440563);
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `organization_id` int(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (9,1,1);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floors`
--

DROP TABLE IF EXISTS `floors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `floors` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `building_id` int(255) DEFAULT NULL,
  `floor` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floors`
--

LOCK TABLES `floors` WRITE;
/*!40000 ALTER TABLE `floors` DISABLE KEYS */;
/*!40000 ALTER TABLE `floors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graphic_cards`
--

DROP TABLE IF EXISTS `graphic_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `graphic_cards` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `graphics_card_model_id` int(255) DEFAULT NULL,
  `driver_version` varchar(255) DEFAULT NULL,
  `driver_date` varchar(255) DEFAULT NULL,
  `screen_size_id` int(255) DEFAULT NULL,
  `ram_size` int(255) DEFAULT NULL,
  `computer_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graphic_cards`
--

LOCK TABLES `graphic_cards` WRITE;
/*!40000 ALTER TABLE `graphic_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `graphic_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graphics_card_models`
--

DROP TABLE IF EXISTS `graphics_card_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `graphics_card_models` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) DEFAULT NULL,
  `manufacturer_id` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `video_processor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graphics_card_models`
--

LOCK TABLES `graphics_card_models` WRITE;
/*!40000 ALTER TABLE `graphics_card_models` DISABLE KEYS */;
/*!40000 ALTER TABLE `graphics_card_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `floor_id` varchar(100) DEFAULT NULL,
  `building_id` varchar(100) DEFAULT NULL,
  `room_number` varchar(45) DEFAULT NULL,
  `organization_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (2,'23',NULL,NULL,'23',1),(3,'Biblioteket',NULL,NULL,NULL,1),(4,'EAT',NULL,NULL,NULL,1),(5,'45',NULL,NULL,'45',1),(6,'31',NULL,NULL,'31',1),(7,'42',NULL,NULL,'42',1),(8,'30',NULL,NULL,'30',1),(9,'33',NULL,NULL,'33',1),(10,'39',NULL,NULL,'39',1),(11,'36',NULL,NULL,'36',1),(12,'34',NULL,NULL,'34',1),(13,'44',NULL,NULL,'44',1),(14,'LV',NULL,NULL,NULL,1),(15,'41',NULL,NULL,'41',1),(16,'LA',NULL,NULL,NULL,1),(17,'40',NULL,NULL,'40',1),(18,'Biblo -ud',NULL,NULL,NULL,1),(19,'BOOKIT',NULL,NULL,NULL,1),(20,'Biblo Kontor',NULL,NULL,NULL,1),(21,'21',NULL,NULL,'21',1),(22,'32',NULL,NULL,'32',1),(23,'35',NULL,NULL,'35',1),(24,'49',NULL,NULL,'49',1),(25,'DIVERSE',NULL,NULL,NULL,1),(26,'20',NULL,NULL,'20',1),(27,'24',NULL,NULL,'24',1),(28,'22',NULL,NULL,'22',1),(30,'47',NULL,NULL,'47',1),(32,'46',NULL,NULL,'46',1),(33,'37',NULL,NULL,'37',1),(34,'25',NULL,NULL,'25',1),(36,'48',NULL,NULL,'48',1),(37,'38',NULL,NULL,'38',1);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `abbrevation` varchar(200) DEFAULT NULL,
  `website` varchar(400) DEFAULT NULL,
  `detection_string` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'Hewlett Packard','HP',NULL,'Hewlett-Packard'),(2,'Intel','Intel',NULL,'GenuineIntel'),(3,'IBM','IBM',NULL,'IBM'),(4,'Dell','Dell',NULL,'Dell'),(5,'Lenovo','Lenovo',NULL,'Lenovo'),(6,'Fujitsu Siemens','Fujitsu Siemens',NULL,'Fujitsu Siemens'),(7,'Canon','Canon',NULL,'Canon'),(8,'Panasonic','Panasonic',NULL,'Panasonic'),(9,'Hitachi','Hitachi',NULL,'Hitachi'),(10,'Toshiba','Toshiba',NULL,'Toshiba'),(11,'Creative','Creative',NULL,'Creative'),(12,'InFocus','InFocus',NULL,'InFocus'),(13,'BENQ','BENQ',NULL,'BENQ'),(14,'Apple','Apple',NULL,'Apple'),(15,'Google','Google',NULL,'Google'),(16,'Samsung','Samsung',NULL,'Samsung'),(17,'Compaq','Compaq',NULL,'Compaq'),(18,'Microsoft','Microsoft',NULL,'Microsoft Corporation'),(19,'NVIDIA','NVIDIA',NULL,'NVIDIA'),(20,'Advanced Micro Devices','AMD',NULL,'AMD'),(21,'ATI','ATI',NULL,NULL);
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operating_system_cores`
--

DROP TABLE IF EXISTS `operating_system_cores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operating_system_cores` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operating_system_cores`
--

LOCK TABLES `operating_system_cores` WRITE;
/*!40000 ALTER TABLE `operating_system_cores` DISABLE KEYS */;
INSERT INTO `operating_system_cores` VALUES (1,18,'Windows');
/*!40000 ALTER TABLE `operating_system_cores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operating_system_editions`
--

DROP TABLE IF EXISTS `operating_system_editions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operating_system_editions` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `detection_string` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operating_system_editions`
--

LOCK TABLES `operating_system_editions` WRITE;
/*!40000 ALTER TABLE `operating_system_editions` DISABLE KEYS */;
/*!40000 ALTER TABLE `operating_system_editions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operating_system_families`
--

DROP TABLE IF EXISTS `operating_system_families`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operating_system_families` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `core_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operating_system_families`
--

LOCK TABLES `operating_system_families` WRITE;
/*!40000 ALTER TABLE `operating_system_families` DISABLE KEYS */;
INSERT INTO `operating_system_families` VALUES (1,18,'Windows',1);
/*!40000 ALTER TABLE `operating_system_families` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operating_system_versions`
--

DROP TABLE IF EXISTS `operating_system_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operating_system_versions` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `version_number` varchar(255) DEFAULT NULL,
  `operating_system_id` int(255) DEFAULT NULL,
  `detection_string` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operating_system_versions`
--

LOCK TABLES `operating_system_versions` WRITE;
/*!40000 ALTER TABLE `operating_system_versions` DISABLE KEYS */;
INSERT INTO `operating_system_versions` VALUES (1,'Windows XP','5.1',1,'Windows XP'),(2,'Windows 2000','5.0',2,'Windows 2000'),(3,'Windows XP 64-Bit Edition','5.2',1,'Windows XP 64-Bit Edition'),(4,'Windows Server 2003','5.2',3,'Windows Server 2003'),(5,'Windows Server 2003 R2','5.2',3,'Windows Server 2003 R2'),(6,'Windows Vista','6.0',4,'Windows Vista'),(7,'Windows Server 2008','6.0',5,'Windows Server 2008'),(8,'Windows Server 2008 R2','6.1',5,'Windows Server 2008 R2'),(9,'Windows 7','6.1',6,'Windows 7'),(10,'Windows 8','6.2',14,'Windows 8');
/*!40000 ALTER TABLE `operating_system_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operating_systems`
--

DROP TABLE IF EXISTS `operating_systems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operating_systems` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `manufaturer_id` int(255) DEFAULT NULL,
  `family_id` int(255) DEFAULT NULL,
  `system_int` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operating_systems`
--

LOCK TABLES `operating_systems` WRITE;
/*!40000 ALTER TABLE `operating_systems` DISABLE KEYS */;
INSERT INTO `operating_systems` VALUES (1,'Windows XP',18,1,251),(2,'Windows 2000',18,1,250),(3,'Windows Server 2003',18,1,252),(4,'Windows Vista',18,1,260),(5,'Windows Server 2008',18,1,260),(6,'Windows 7',18,1,261),(7,'Windows 4.0',18,1,240),(8,'Windows NT 3.51',18,1,2351),(9,'Windows ME',18,1,1490),(10,'Windows 95',18,1,140),(11,'Windows 3.1',18,1,0),(12,'Windows 98',18,1,1410),(13,'Windows 2003',18,1,252),(14,'Windows 8',18,1,NULL);
/*!40000 ALTER TABLE `operating_systems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operation_system_installations`
--

DROP TABLE IF EXISTS `operation_system_installations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operation_system_installations` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `computer_id` int(255) DEFAULT NULL,
  `computer_name` varchar(150) DEFAULT NULL,
  `install_date` varchar(70) DEFAULT NULL,
  `service_pack` varchar(50) DEFAULT NULL,
  `system_drive` varchar(100) DEFAULT NULL,
  `version` varchar(30) DEFAULT NULL,
  `operating_system_edition_id` int(255) DEFAULT NULL,
  `operating_system_version_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operation_system_installations`
--

LOCK TABLES `operation_system_installations` WRITE;
/*!40000 ALTER TABLE `operation_system_installations` DISABLE KEYS */;
/*!40000 ALTER TABLE `operation_system_installations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organizations` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
INSERT INTO `organizations` VALUES (1,'Groendalsvaengets Skole','lal@lal.com');
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `print_locations`
--

DROP TABLE IF EXISTS `print_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `print_locations` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `computer_group_id` int(255) DEFAULT NULL,
  `printer_group_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `print_locations`
--

LOCK TABLES `print_locations` WRITE;
/*!40000 ALTER TABLE `print_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `print_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printer_group_members`
--

DROP TABLE IF EXISTS `printer_group_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printer_group_members` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `printer_id` int(255) DEFAULT NULL,
  `group_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printer_group_members`
--

LOCK TABLES `printer_group_members` WRITE;
/*!40000 ALTER TABLE `printer_group_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `printer_group_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printer_groups`
--

DROP TABLE IF EXISTS `printer_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printer_groups` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `organization_id` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printer_groups`
--

LOCK TABLES `printer_groups` WRITE;
/*!40000 ALTER TABLE `printer_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `printer_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printer_models`
--

DROP TABLE IF EXISTS `printer_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printer_models` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `manufacturer_id` int(255) DEFAULT NULL,
  `model_name` varchar(200) DEFAULT NULL,
  `color` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printer_models`
--

LOCK TABLES `printer_models` WRITE;
/*!40000 ALTER TABLE `printer_models` DISABLE KEYS */;
INSERT INTO `printer_models` VALUES (1,'LaserJet 4300',1,NULL,NULL),(2,'Officejet K5400',1,NULL,NULL),(3,'LaserJet 4350',1,NULL,NULL),(4,'JetDirect 1300n',1,NULL,NULL),(5,'LaserJet 4100',1,NULL,NULL);
/*!40000 ALTER TABLE `printer_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printers`
--

DROP TABLE IF EXISTS `printers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `location_id` varchar(255) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `mac` varchar(45) DEFAULT NULL,
  `model_id` int(255) DEFAULT NULL,
  `organization_id` int(255) DEFAULT NULL,
  `created_time` int(255) DEFAULT NULL,
  `last_updated` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printers`
--

LOCK TABLES `printers` WRITE;
/*!40000 ALTER TABLE `printers` DISABLE KEYS */;
INSERT INTO `printers` VALUES (1,'UUF61393','Biblo','3','10.87.45.14','00-0E-7F-3C-00-CF',1,1,1337443406,1344464817),(2,'BUF87512','LA Farve','16','10.87.45.16','00-21-5A-56-18-04',2,1,1337443406,1337443406),(3,'UUF60793','42','7','10.87.45.17','00-30-6E-FB-BF-BA',1,1,1337443406,1337443406),(4,'UUF76972','LA','16','10.87.45.15','00-1A-4B-1C-34-1B',3,1,1337443406,1337443406),(5,'UUF60470','Biblo Kontor','20','10.87.45.14','00-01-E6-E0-2D-A2',4,1,1337443406,1337443406),(6,'UUF55943','LV','14','10.87.45.13','00-01-E6-72-2B-05',5,1,1337443406,1337443406);
/*!40000 ALTER TABLE `printers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processor_architectures`
--

DROP TABLE IF EXISTS `processor_architectures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processor_architectures` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processor_architectures`
--

LOCK TABLES `processor_architectures` WRITE;
/*!40000 ALTER TABLE `processor_architectures` DISABLE KEYS */;
/*!40000 ALTER TABLE `processor_architectures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processor_families`
--

DROP TABLE IF EXISTS `processor_families`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processor_families` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `architecture_id` int(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processor_families`
--

LOCK TABLES `processor_families` WRITE;
/*!40000 ALTER TABLE `processor_families` DISABLE KEYS */;
INSERT INTO `processor_families` VALUES (1,2,'Xeon',NULL),(2,2,'Pentium',NULL),(3,2,'Core 2',NULL);
/*!40000 ALTER TABLE `processor_families` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processor_models`
--

DROP TABLE IF EXISTS `processor_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processor_models` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(255) DEFAULT NULL,
  `cores` int(30) DEFAULT NULL,
  `clock_rate` varchar(20) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `family_id` int(255) DEFAULT NULL,
  `threads` int(30) DEFAULT NULL,
  `max_clock_speed` varchar(20) DEFAULT NULL,
  `detection_string` varchar(300) DEFAULT NULL,
  `model_number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processor_models`
--

LOCK TABLES `processor_models` WRITE;
/*!40000 ALTER TABLE `processor_models` DISABLE KEYS */;
INSERT INTO `processor_models` VALUES (1,2,4,'0.7','Pentium III Xeon',1,1,'0.7','Intel Pentium III Xeon-processor',NULL),(2,2,2,'2.00','Core 2 T7200',2,NULL,'','Intel(R) Core(TM)2 CPU         T7200  @ 2.00GHz',NULL),(3,2,1,'1.73','Pentium M',3,NULL,'','Intel(R) Pentium(R) M processor 1.73GHz',NULL),(4,2,2,'2.00','Core 2 Duo T7250',2,NULL,'','Intel(R) Core(TM)2 Duo CPU     T7250  @ 2.00GHz',NULL),(5,2,2,'3.20','Pentium 4',3,NULL,'','Intel(R) Pentium(R) 4 CPU 3.20GHz',NULL),(6,2,4,NULL,'Pentium II',3,NULL,'','Intel Pentium II-processor',NULL),(7,2,2,'3.00','Pentium 4',3,NULL,'','Intel(R) Pentium(R) 4 CPU 3.00GHz',NULL),(8,2,1,'2.80','Pentium 4',3,NULL,'','Intel(R) Pentium(R) 4 CPU 2.80GHz',NULL),(9,2,2,'1.80','Core 2',2,NULL,'','Intel(R) Core(TM)2 CPU          4300  @ 1.80GHz',NULL),(10,2,1,'1.60','Pentium M',3,NULL,'','Intel(R) Pentium(R) M processor 1.60GHz',NULL);
/*!40000 ALTER TABLE `processor_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `screen_models`
--

DROP TABLE IF EXISTS `screen_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `screen_models` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pixel_per_inch` varchar(45) DEFAULT NULL,
  `manufacturer_id` int(255) DEFAULT NULL,
  `screen_size_id` int(255) DEFAULT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `power_usage` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `screen_models`
--

LOCK TABLES `screen_models` WRITE;
/*!40000 ALTER TABLE `screen_models` DISABLE KEYS */;
/*!40000 ALTER TABLE `screen_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `screen_sizes`
--

DROP TABLE IF EXISTS `screen_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `screen_sizes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `width` int(255) DEFAULT NULL,
  `height` int(255) DEFAULT NULL,
  `detection_string` varchar(2000) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `aspect_ratio` varchar(200) DEFAULT NULL,
  `abbrevation` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `screen_sizes`
--

LOCK TABLES `screen_sizes` WRITE;
/*!40000 ALTER TABLE `screen_sizes` DISABLE KEYS */;
INSERT INTO `screen_sizes` VALUES (1,1280,1024,'1280x1024','Super Extended Graphics Array','5:4','SXGA'),(2,1280,800,'1280x800','Wide XGA','8:5','WXGA'),(3,1024,768,'1024x768','Extended Graphics Array','4:3','XGA'),(4,800,600,'800x600','Super VGA','4:3','SVGA'),(5,1366,768,'1366x768','HD ready','16:9','HDR'),(6,1280,960,'1280x960','Super Extended Graphics Array-','4:3','SXGA?'),(7,160,120,'160x120','Quarter Quarter Video Graphics Array','4:3','QQVGA'),(8,240,160,'240x160','Half Quarter Video Graphics Array','4:3','HQVGA'),(9,320,240,'320x240','Quarter Video Graphics Array','4:3','QVGA'),(10,432,240,'432x240','Wide Quarter Video Graphics Array','9:5','WQVGA'),(11,384,240,'384x240','Wide Quarter Video Graphics Array','8:5','WQVGA'),(12,400,240,'400x240','Wide Quarter Video Graphics Array','5:3','WQVGA'),(13,480,320,'480x320','Half Video Graphics Array','3:2','HVGA'),(14,480,360,'480x360','Half Video Graphics Array','4:3','HVGA'),(15,480,272,'480x272','Half Video Graphics Array','16:9','HVGA'),(16,640,240,'640x240','Half Video Graphics Array','8:3','HVGA'),(17,640,480,'640x480','Video Graphics Array','4:3','VGA'),(18,800,480,'800x480','Wide Video Graphics Array','5:3','WVGA'),(19,854,480,'854x480','Wide Video Graphics Array','16:9','WVGA'),(20,848,480,'848x480','Wide Video Graphics Array','16:9','WVGA'),(21,1024,576,'1024x576','Wide Super Video Graphics Array','5:3','WSVGA'),(22,1024,600,'1024x600','Wide Super Video Graphics Array','16:9','WSVGA'),(23,1280,720,'1280x720','Wide eXtended Graphics Array','16:9','WXGA'),(24,1280,768,'1280x768','Wide eXtended Graphics Array','5:3','WXGA'),(25,1360,768,'1360x768','Wide eXtended Graphics Array','85:48','WXGA'),(26,1152,864,'1152x864','eXtended Graphics Array Plus','4:3','XGA+'),(27,1152,900,'1152x900','eXtended Graphics Array Plus','5:4','XGA+'),(28,1440,900,'1440x900','Wide eXtended Graphics Array Plus','16:10','WXGA+'),(29,1400,1050,'1400x1050','Super eXtended Graphics Array Plus','4:#','SXGA+'),(30,1680,1050,'1680x1050','Widescreen Super eXtended Graphics Array Plus','16:10','WSXGA+ '),(31,1600,1200,'1600x1200','Ultra eXtended Graphics Array','4:3','UXGA'),(32,1920,1200,'1920x1200','Widescreen Ultra eXtended Graphics Array','16:10','WUXGA'),(33,1600,768,'1600x768','Ultra Widescreen eXtended Graphics Array','33:16','UWXGA'),(34,2048,1536,'2048x1536','Quad eXtended Graphics Array','4:3','QXGA'),(35,2048,1152,'2048x1152','Quad Wide eXtended Graphics Array','16:9','QWXGA'),(36,2560,1600,'2560x1600','Wide Quad eXtended Graphics Array','16:10','WQXGA'),(37,2560,2048,'2560x2048','Quad Super eXtended Graphics Array','5:4','QSXGA'),(38,3200,2048,'3200x2048','Wide Quad Super eXtended Graphics Array','16:10','WQSXGA'),(39,3200,2400,'3200x2400','Quad Ultra Extended Graphics Array','4:3','QUXGA'),(40,3840,2400,'3840x2400','Wide Quad Ultra eXtended Graphics Array','16:9','WQUXGA'),(41,4096,3072,'4096x3072','Hex Extended Graphics Array','4:3','HXGA'),(42,5120,3200,'5120x3200','Wide Hex Extended Graphics Array','16:10','WHXGA'),(43,5120,4096,'5120x4096','Hex Super Extended Graphics Array','5:4','HSXGA'),(44,6400,4096,'6400x4096','Wide Hex Super Extended Graphics Array','1.56:1','WHSXGA'),(45,6400,4800,'6400x4800','Hex Ultra Extended Graphics Array','4:3','HUXGA'),(46,7680,4800,'7680x4800','Wide Hex Ultra Extended Graphics Array','16:10','WHUXGA'),(47,7680,4320,'7680x4320','Wide Hex Ultra Extended Graphics Array','16:9','WHUXGA'),(48,640,360,'640x360','ninth HD','16:9','nHD'),(49,960,540,'960x540','quarter HD','16:9','qHD'),(50,2560,1440,'2560x1440','Wide Quad High Definition','16:9','WQHD'),(51,3840,2160,'3840x2160','Quad Full High Definition','16:9','QFHD');
/*!40000 ALTER TABLE `screen_sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `screens`
--

DROP TABLE IF EXISTS `screens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `screens` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(200) DEFAULT NULL,
  `screen_model_id` int(255) DEFAULT NULL,
  `organization_id` int(255) DEFAULT NULL,
  `location_id` int(255) DEFAULT NULL,
  `created_time` int(255) DEFAULT NULL,
  `last_updated` int(255) DEFAULT NULL,
  `last_updated_user_id` int(255) DEFAULT NULL,
  `creator_user_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `screens`
--

LOCK TABLES `screens` WRITE;
/*!40000 ALTER TABLE `screens` DISABLE KEYS */;
/*!40000 ALTER TABLE `screens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(256) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `created_time` int(255) DEFAULT NULL,
  `offline` int(1) DEFAULT NULL,
  `time_to_live` int(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (4,'jdsNqwrkSgIqtKJu1qUd0ivF0sDTMpRWdXC7IRbSBYDIgJ0qag1nH0rPZgJMpkTt',1,1346584663,1,3600),(5,'w6Mz8RcyjGanGeWHeC8nO2cARfilGHdPpP7RcBKibB3ZEUSrUiIvpwlbEmbEAI1f',1,1346584764,1,0),(6,'8iF1JvpLTNj6hHoCbLQ0FnOvGM6xhGJFBCRGnOJx9ZGoIx0mrGJLwhZT81IcTNKm',1,1346585144,1,0),(7,'Y1OfjBSBeBPGWrFV4YPzU8tLWtAdNjBSmxPuxPobStbxwZVjBMQ94CwusZ0FURet',1,1346585808,0,3600),(8,'kOevt5t5BQ0YkfHM0VcwVB1GOnvNpWfqRuj1TuhaH1goiAGO6qXYH371cB3ywGxA',1,1346585851,0,3600),(9,'X324OQ8EJGOmtHBEfLNvADr41dbEsx3X1BY90SOSEsehZsQ52RHJw2Kc0cBj2ftr',1,1346585882,0,3600),(10,'w4A2mYPOnCc0Jpls6nKgIwF9fc2MReavKOSvWhYymtN0Hot4mpYlTmKt6ziXqKeH',1,1346585932,0,3600),(11,'UXV0uc4yciOZzGcCqGJYX0artv1pH3hXSEA1fhTWbiJQmMva8E1J9QnTlW1PUdry',1,1346585939,0,3600),(12,'3vQRhie7ZbBkEGMrlx2QmNWsMjhD6mut6hyswEFdjbZ04VIs1AGmBKoMhBmY7RWp',1,1346585984,0,3600),(13,'K4TZjqmNQvF0UVhrWKTzdbRTP4vnwtlwopKM96Q2UPRPyBUCX1iEIl4fynzcnwUf',1,1346585996,0,3600),(14,'X2uDRYwl1XqK3yEcvJBrTWJl45gZUvty9Z4DqwlzwY7XHLeZCmWIYqJRg17EPEVN',1,1346586005,0,3600),(15,'ya6cDx7GRidtaROr9Fb14hzgpuliPTdSGUqkNX6wBibshc7tMKnq0SP4W7AOSpmB',1,1346586067,0,3600),(16,'lSHOUw1p6RFg0fJSnq47bho6eROZnHSPxAIogSKpAyY586Rdndw7swXabrCfgkNR',1,1346586077,0,3600),(17,'lwoQcadmKzqVqkAwdwnvgAUnRXRQscN9UWVlCqYfWfkgObnAIivwCcqMZPmHNfR3',1,1346586083,0,3600),(18,'U5TfUMuajXEpJlprvKbR6JZe1Wk6PKYpVY1U2XAB08QhjFOn7sdBcSG69ysEyuXo',1,1346586087,0,3600),(19,'DsZYLyiSJPy5XIYF2DAJDG4873v29d1pIdzv4089Ml7nhZAl3A3NqduU6aVQE753',1,1346586103,0,3600),(20,'mIgciPBHU8tjDfwUlpMNcDxVxDw1c6HSo4eYb6b2MeF3viBNdjVDKhnHM40oZnAV',1,1346586105,0,3600),(21,'NxaPl6mDReIZMGrpzgpJSUumkVuNRQBZdUaKvQR7QashDO8r2gnVZoOh4cq5DRdh',1,1346586139,0,3600),(22,'KibmLnjBMpqphF2uD4qAGhRog0NZnsldTrBl3Yj0Lw1WjT749baeOcDLCjhW3Gzs',1,1346752710,0,3600),(23,'yQ7jy0TJhikSNxtkjDNJyLAiogk5U5xircUhtLE0UiIJXiGuLoF9lypi0f7rLqfJ',1,1346760109,0,3600),(24,'doeQEOP1ONODJaYeiNOobo4LbLjVDwz2n4x8AgCVgGpPCnRX3i7952RsbAX2W8yH',1,1346790199,0,3600),(25,'EFE2p5qwSeyPVRkemPkMd4mvIHbzeV6f4LuIzrJjQg2JprEt03gntGas1AeUxo8S',1,1346794816,0,3600),(26,'7zPaxYT3SNwHSVigQ1z5JUVmc3SgIFb7oD8t9WkNkHhQb6hNB1x4ReCoq9eWN12T',1,1346915254,0,3600),(27,'QV3qHp7FX5RFISto0goPD13z47t4mEFXy6RwjtJCfMCoqjwkthuRrVvtNqKYWwzP',1,1346916272,0,3600),(28,'aiL0JE5xnc8ctCwDpqWLIsJ8W0I8E1vQeIBeUMWtx3vimfrFC7I4tghF8G3PYAme',1,1346920449,0,3600),(29,'WgMyc7U4G53LWnop2AxpvxhYGWYIEhScZpteTlpxgqjeOvZJLKn4kuPRJ2sbGU97',1,1346920861,0,3600),(30,'q3oFjfUYukVPKqZAS6tfH4DFpikM20X3jiQIW9mZWdRqIwjaxFWm7H0rnHSofwm8',1,1346921061,0,3600),(31,'hQJjEauQMYVkOxs0Rzrc6OocPMZ83cSZ3OLy2PZm5sxmVsyFWAn4eAuJ7iGcb0K3',1,1346930349,0,3600),(32,'yOC7z7dKbRgbn0hPhRVjt1S1S7PDzQhpbC0os09euTUHvXC7g0NxUeGwZtpfdEYC',1,1346964300,0,3600),(33,'jyYmNQWXNzCapsRsJoZtv2RaGCORQaHPztQy5Kh7EdQFb1SPlB92nMI5JHI3N0zr',1,1346964584,0,3600),(34,'KGBa03IhQ1mTrT81hKFsdsfCuzLYD1j3nknFLZ2H7KMjmMJgbVojH7Ly21r1Zru9',1,1347032769,0,3600),(35,'rY4c02UokUhnzPnmimNWH4VCWCoYmgNmuUmdF49JdN2WQvXVReIy43L973Kiu9Jw',1,1347032793,0,3600),(36,'dacajXq84pSjpHR1lG27buPXfpEJH168ms5C2SmFMBJVc2Gh9Si1mSGBtU1RIWXT',1,1347036440,0,3600),(37,'QPOtYQV3qHp7FX5RFISto0goPD13z47t4mEFXy6RwjtJCfMCoqjwkthuRrVvtNqK',1,1347271117,0,3600),(38,'kHOTLibZkLjnZu9ctbezJ0dOwlunLCqfcFyNnVBiuRGChOgwNCPXfEv6lIBAQmfr',1,1347273580,0,3600),(39,'uvIaxm7BCkD4lPkZEV5AiDzonIs1ZxYgduOL5NDvU5NuyEiH8XZT2FnUH5inyDCK',1,1347273751,0,3600),(40,'9hwSkKDr0k0jRBZ2CMoEWTkK2GhklwWTMDXztKcFyz6jgPoOcJ7irupe2vKgCaRm',1,1347278105,0,3600),(41,'3PYZTQxZzaAlRros0kw9zBFHebQr7pP73vPqPU9OgdpdpwAuJVP37uGNgGvl10Yf',1,1347281966,0,3600),(42,'TlDfSL3kQZSu10qbHI2mqlMvnig2hvLVgZBNLOX5kbGaUugNgYfQvEYBHBAdN8sE',1,1347292437,0,3600),(43,'IuK1LSGt0p6LtsnxIxqpbtCYV4LDFEQWqKFZgcJ7ZgKx9yanGpV0t2lk82VcdADs',1,1347296055,0,3600),(44,'cItW8fwADGlm9uKubw8gpD7gX5jzxMzDnQKRG7jH7jfnVA7cDkVoQKqysEaCmJh7',1,1347300978,0,3600),(45,'PnUy8SQsPmgT9iqUdk10kqmApTElhazeig84jhDh59OmbvE3dZog42kRAl9WqjYd',1,1347357495,0,3600),(46,'4Pwfxgly9GiFhMfSFgw5rSP58Ot0jXAnSLwOcDkuVCp05usTnR9jeOJG6qdu6Oo1',1,1347361949,0,3600),(47,'2lk82VcdADsfIr7vluOdQLMWab5m8g9AM3esAeBcryrdHyGcn9UpFQ8wxIFCnkUJ',1,1347379149,0,3600),(48,'zO6eXOU01yrKiuW1ipazYMrlLiCGgdv1dIsuoRQTJIPfjZ0x0UWIAkqAsbxXsjEs',1,1347382810,0,3600),(49,'xwACeSYdCRxFpiMeFeEwg5WhrJj2yFpWlCFGR2yri3UOp8kTUaEBuJt8obDMPK0W',1,1347384756,0,3600),(50,'MlCYDhN5e0hiehspgR8EiyAHCNEp9G2CxilFfKBKiCTG6vOQDa8c7nPDcR5UgyUR',1,1347462113,0,3600),(51,'tg6wtlLWbofF95v65FSWZ7W5kCYozbaL3e5l7C1dtZq7dYi4hbaLexIGn6yz1yAH',1,1347532456,0,3600),(52,'eGwZtpfdEYCtUO952qaNfq9YlrsoAtPrDOoulJh90SCrmrGueADGM5MP2oYIE6AO',1,1347537230,0,3600),(53,'umkVuNRQBZdUaKvQR7QashDO8r2gnVZoOh4cq5DRdhH9kAv3dZQzHWRK98FvAvW7',1,1347542243,0,3600),(54,'lK147IkYjYe1jKXPiLkDlo0OTR5PvSMEkaL13thIXLljIWs4nRqzTErR78r3I7j5',1,1347547790,0,3600),(55,'2alFlgzgQDzD7NboMtAwKzXYZN40DHZfoPQbU1Rtolz3utzL0VEjgh0MkuCFYmy8',1,1347614971,0,3600),(56,'Oul2x3E5koSLjoACM8aUcLQYxZtEMPjrIv9Ijps9v4ST7VMDKORKET4Hsv23sUh6',1,1348314748,0,3600),(57,'oUMDwhfpvM1dzKLEqw0hi4PeJzYAsbZq7FvmDkbYwS4HUDFYZNfRmGZmlW1oBPLH',1,1348318612,0,3600),(58,'aQHcUavEewnJNwz7XZ6JTIBA25tNXOI0qCyEJy4plg6eXnCvVHyMycVCpkN9NAhP',1,1348322249,0,3600),(59,'Zk4NpQJ36CiVWtFNtrNlOw5GlTmwCKVPQogkgnIZebpya7DWBbxKgz1zmZpahDOj',1,1348325880,0,3600),(60,'3WPJFHwxO1hvwnu5sGIkdT5mD3wW540oB7O1HuwVAPxAt7ux2i8KfTSHO6FEKmKC',1,1348329830,0,3600),(61,'NhlsB0931xk6h5EkaxdEXaGtRA4UyKeB7JGU0hdtBkcMp9ZMA7JrnNDKn07im0JW',1,1348334199,0,3600),(62,'8yspH94VtAEgxg0gul2Mk1Y4uUzcOq2Of9sEgxHSuPSuJ7xO7SR51EgrvdYhRPN5',1,1348396789,0,3600),(63,'oeLUtHn6lPYymUgNnVm19wx7fkmMhN18pJkEZhpuY8xTFfLmdwiA3HUpYm65YPnt',1,1348404069,0,3600),(64,'OnVZPgvZJj3ZX42S6CcXQJ3gUw1DmDjzGixMOWr0FChzyBstJV2KPxGec3AK71HW',1,1348782355,0,3600),(65,'Qn6SHbghFiYGuF5j1ZfDiUJInNV5S4B9PtqZsiQzZsPTjDmc35yWkIzmZDITihpC',1,1348835413,0,3600),(66,'EHYrvjuVn8NabmR0YX5pLlihEINMtTUta03tzeVTMpDP2VDK6U4rMGqDhlB9QV9n',1,1348839053,0,3600);
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `google` varchar(250) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `login_token` varchar(64) DEFAULT NULL,
  `hashing_iterations` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test','test','Bo','hansen','d2edb6d96383b46987f645770cdabed6d83b1144cfc25f7d47deea6018caeb0fe35721b711500f3770d38f37fad63e8a7a0ab79ff2d3144eaf49423596bb53b8','ef2aae3439507f1f1f19df6bf9b497a1f10e7710ac968979188699e2404dcc5e',10),(2,NULL,NULL,'1',NULL,NULL,NULL,NULL),(3,'2','2','3',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-09-28 19:00:33
