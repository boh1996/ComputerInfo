-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: localhost    Database: computerinfo
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

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `computerinfo2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `computerinfo2`;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_models`
--

LOCK TABLES `computer_models` WRITE;
/*!40000 ALTER TABLE `computer_models` DISABLE KEYS */;
INSERT INTO `computer_models` VALUES (1,4,'2','OptiPlex 790','OptiPlex 790',NULL,NULL),(2,NULL,'1','','Unknown Model',NULL,NULL),(3,NULL,'1','Please wait while WMIC compiles updated MOF files.                           \n\n','Unknown Model',NULL,NULL),(4,1,'1','HP Compaq nc6120 (PN936AV)','nc6120','PN936AV',NULL),(5,1,'1','HP Compaq nc6400 (EH522AV)','nc6400','EH522AV',NULL),(6,5,'2','7738A52','7738A52',NULL,NULL),(7,1,'2','HP Compaq dc7100 SFF(DX878AV)','dc7100 SFF','DX878AV',NULL),(8,1,'1','HP ProBook 6450b','ProBook 6450b',NULL,NULL),(9,1,'2','HP Compaq dc7600 Small Form Factor','dc7600 Small Form Factor',NULL,NULL),(10,1,'2','HP d530 SFF(DC578AV)','d530 SFF','DC578AV',NULL),(11,1,'2','HP Compaq dc7900 Small Form Factor','dc7900 Small Form Factor',NULL,NULL),(12,6,'2','ESPRIMO E','ESPRIMO E',NULL,NULL),(13,1,'1','HP Compaq 6530b (GW688AV)','6530b','GW688AV',NULL),(14,3,'1','2888WHX','2888WHX',NULL,NULL),(15,1,'2','HP Pavilion dv7 Notebook PC','Pavilion dv7 Notebook PC',NULL,NULL);
/*!40000 ALTER TABLE `computer_models` ENABLE KEYS */;
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
  `ram_size` varchar(200) DEFAULT NULL,
  `model_id` int(255) DEFAULT NULL,
  `serial` varchar(200) DEFAULT NULL,
  `screen_size_id` varchar(200) DEFAULT NULL,
  `cpu_id` int(255) DEFAULT NULL,
  `created_time` int(255) DEFAULT NULL,
  `last_updated` int(255) DEFAULT NULL,
  `location_id` int(255) DEFAULT NULL,
  `lan_macs` varchar(2000) DEFAULT NULL,
  `power_usage_per_hour` varchar(200) DEFAULT NULL,
  `operating_system_id` varchar(200) DEFAULT NULL,
  `last_updated_user_id` int(255) DEFAULT NULL,
  `creator_user_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computers`
--

LOCK TABLES `computers` WRITE;
/*!40000 ALTER TABLE `computers` DISABLE KEYS */;
INSERT INTO `computers` VALUES (1,'BUF92146',1,'78-2B-CB-B3-97-73',NULL,'10.87.45.109','465','3241',1,'JQDF45J','1',1,1320661211,1320661211,7,';78-2B-CB-B3-97-73;',NULL,'1',1,1),(2,'BUF92915',1,'78-2B-CB-B3-BF-89',NULL,'10.87.45.82','465','3241',1,'CMLF45J','1',1,1320660541,1320660541,16,';78-2B-CB-B3-BF-89;',NULL,'1',1,1),(3,'BUF92128',1,'78-2B-CB-B3-C5-57',NULL,'10.87.45.80','465','3241',1,'DVDF45J','1',1,1320659790,1320659790,16,';78-2B-CB-B3-C5-57;',NULL,'1',1,1),(4,'BUF92914',1,'78-2B-CB-B3-E7-05',NULL,'10.87.45.88','465','3241',1,'7JLF45J','1',1,1320657411,1320657411,3,';78-2B-CB-B3-E7-05;',NULL,'1',1,1),(5,'BUF92236',1,'78-2B-CB-B3-CE-1E',NULL,'10.87.45.77','465','3241',1,'8TDF45J','1',1,1320657402,1320657402,3,';78-2B-CB-B3-CE-1E;',NULL,'1',1,1),(6,'BUF92130',1,'78-2B-CB-B3-D3-08',NULL,'10.87.45.87','465','3241',1,'1QDF45J','1',1,1320657138,1320657138,3,';78-2B-CB-B3-D3-08;',NULL,'1',1,1),(7,'BUF92133',1,'78-2B-CB-B3-CC-8D',NULL,'10.87.45.93','465','3241',1,'8RDF45J','1',1,1320657072,1320657072,3,';78-2B-CB-B3-CC-8D;',NULL,'1',1,1),(8,'BUF79455',1,'00-16-D4-BA-D0-0D',NULL,'10.97.246.26','74','2039',2,'','2',2,1308827887,1308827887,26,';00-16-D4-BA-D0-0D;',NULL,'1',1,1),(9,'BUF8v',1,NULL,NULL,'172.16.0.6','232','1976',3,'CNU0162HL3','3',1,1308307819,1308307819,27,NULL,NULL,'1',1,1),(10,'UUF72966',1,'00-15-60-B8-0A-61',NULL,'10.97.248.201','37','1015',4,'HUB6230329','4',3,1308304583,1308304583,28,';00-15-60-B8-0A-61;',NULL,'1',1,1),(11,'UUF79376',1,'00-16-D4-BA-DF-A5',NULL,'10.87.45.74','74','2039',5,'HUB70502FJ','3',2,1308303999,1308303999,2,';00-16-D4-BA-DF-A5;',NULL,'1',1,1),(12,'UUF72962',1,'00-15-60-B8-0A-BA',NULL,'10.97.242.49','37','1015',4,'HUB6230324','4',3,1308302662,1308302662,3,';00-15-60-B8-0A-BA;',NULL,'1',1,1),(13,'UUF80594',1,'00-1E-37-15-83-AF',NULL,'10.97.248.221','74','2038',6,'L3E0184','2',4,1308302653,1308302653,4,';00-1E-37-15-83-AF;',NULL,'1',1,1),(14,'BUF79487',1,'00-16-D4-BA-D6-EA',NULL,'10.97.251.26','74','2039',2,'','3',2,1308826930,1308826930,5,';00-16-D4-BA-D6-EA;',NULL,'1',1,1),(15,'UUF74895',1,'00-15-60-B9-87-34',NULL,'10.97.255.239','37','1015',4,'HUB6160V41','4',3,1308223644,1308223644,6,';00-15-60-B9-87-34;',NULL,'1',1,1),(16,'BUF92138',1,'78-2B-CB-B3-D7-66',NULL,'10.87.45.94','465','3241',1,'9PDF45J','1',1,1320656905,1320656905,7,';78-2B-CB-B3-D7-66;',NULL,'1',1,1),(17,'UUF72969',1,'00-15-60-C0-79-E0',NULL,'10.97.240.168','37','1015',4,'HUB6230323','3',3,1308223582,1308223582,8,';00-15-60-C0-79-E0;',NULL,'1',1,1),(18,'UUF79369',1,'00-16-D4-A3-75-0E',NULL,'10.97.253.246','74','2039',5,'HUB7050083','3',2,1308223380,1308223380,9,';00-16-D4-A3-75-0E;',NULL,'1',1,1),(19,'UUF68512',1,'00-13-21-01-6F-85',NULL,'10.87.45.162','74','503',7,'CZC5152P8B','3',5,1308222598,1308222598,10,';00-13-21-01-6F-85;',NULL,'1',1,1),(20,'UUF72965',1,'00-15-60-B8-D9-76',NULL,'10.97.254.26','37','1015',4,'HUB6230325','3',3,1308222441,1308222441,11,';00-15-60-B8-D9-76;',NULL,'1',1,1),(21,'BUF79456',1,'00-16-D4-A5-6F-AA',NULL,'10.97.243.233','74','2039',5,'HUB70418B2','3',2,1308222239,1308222239,12,';00-16-D4-A5-6F-AA;',NULL,'1',1,1),(22,'BUF79458',1,'00-16-D4-A2-0C-81',NULL,'10.97.243.27','74','2039',5,'HUB7050084','3',2,1308221618,1308221618,11,';00-16-D4-A2-0C-81;',NULL,'1',1,1),(23,'BUF92121',1,'78-2B-CB-B3-C1-AF',NULL,'10.87.45.92','465','3241',1,'GVDF45J','1',1,1320656837,1320656837,7,';78-2B-CB-B3-C1-AF;',NULL,'1',1,1),(24,'BUF79469',1,'00-16-D4-B9-83-C4',NULL,'10.97.248.17','74','2039',5,'HUB70502KN','2',2,1308219527,1308219527,3,';00-16-D4-B9-83-C4;',NULL,'1',1,1),(25,'UUF79377',1,'00-16-D4-A4-14-64',NULL,'10.97.245.223','74','2039',5,'HUB704189Y','3',2,1308219527,1308219527,13,';00-16-D4-A4-14-64;',NULL,'1',1,1),(26,'UUF68507',1,'00-12-79-AD-D5-16',NULL,'10.87.45.112','74','503',7,'CZC5152P2B','1',5,1308218022,1308218022,14,';00-12-79-AD-D5-16;',NULL,'1',1,1),(27,'BUF86174',1,'1C-C1-DE-AE-B7-31',NULL,'10.87.45.155','298','1903',8,'CNU0395KB7','5',6,1308219249,1308219249,3,';1C-C1-DE-AE-B7-31;',NULL,'1',1,1),(28,'UUF74900',1,'00-15-60-B8-03-71',NULL,'10.97.253.209','37','1015',4,'HUB6160V4T','3',3,1308217929,1308217929,3,';00-15-60-B8-03-71;',NULL,'1',1,1),(29,'BUF74899',1,'00-15-60-B9-9B-2E',NULL,'10.97.246.107','37','1015',4,'HUB6160V9Y','3',3,1308217873,1308217873,15,';00-15-60-B9-9B-2E;',NULL,'1',1,1),(30,'UUF74033',1,'00-17-08-5E-C4-4F',NULL,'10.87.45.149','74','1015',9,'CZC6152DJW','1',7,1308217811,1308217811,16,';00-17-08-5E-C4-4F;',NULL,'1',1,1),(31,'UUF72961',1,'00-15-60-B8-0A-5D',NULL,'10.97.254.97','37','1015',4,'HUB623032C','3',3,1308216898,1308216898,17,';00-15-60-B8-0A-5D;',NULL,'1',1,1),(32,'UUF74913',1,'00-16-35-A5-E3-DE',NULL,'10.87.45.93','74','1015',9,'CZC6152DGB','6',7,1308216572,1308216572,7,';00-16-35-A5-E3-DE;',NULL,'1',1,1),(33,'UUF68502',1,'00-12-79-AD-E1-9B',NULL,'10.87.45.101','74','503',7,'CZC5152P44','3',5,1308216562,1308216562,7,';00-12-79-AD-E1-9B;',NULL,'1',1,1),(34,'UUF61285',1,'00-11-0A-3A-59-50',NULL,'10.87.45.98','37','503',10,'FRB4290LL5','1',8,1308216505,1308216505,18,';00-11-0A-3A-59-50;',NULL,'1',1,1),(35,'BUF84647',1,'00-25-B3-14-43-4E',NULL,'10.87.45.84','232','3543',11,'CZC9425034','1',1,1320655858,1320655858,3,';00-25-B3-14-43-4E;',NULL,'1',1,1),(36,'UUF72967',1,'00-15-60-B8-0A-BF',NULL,'10.97.251.209','37','1015',4,'HUB6230328','3',3,1308216284,1308216284,3,';00-15-60-B8-0A-BF;',NULL,'1',1,1),(37,'BUF78295',1,'00-19-99-00-66-E1',NULL,'10.87.45.99','74','1014',12,'YKXR089029','1',9,1308216201,1308216201,7,';00-19-99-00-66-E1;',NULL,'1',1,1),(38,'BUF78293',1,'00-19-99-00-67-11',NULL,'10.87.45.138','74','1014',12,'YKXR089013','1',9,1308216177,1308216177,7,';00-19-99-00-67-11;',NULL,'1',1,1),(39,'UUF87135',1,'00-15-60-BC-D4-B8',NULL,'10.87.45.92','37','1015',4,'HUB6210L6K','3',3,1308216121,1308216121,3,';00-15-60-BC-D4-B8;',NULL,'1',1,1),(40,'BUF78292',1,'00-19-99-00-84-D6',NULL,'10.87.45.105','74','1014',12,'YKXR089130','1',9,1308216065,1308216065,7,';00-19-99-00-84-D6;',NULL,'1',1,1),(41,'UUF72790',1,'00-16-35-A7-26-08',NULL,'10.87.45.144','74','1015',9,'CZC6152DGQ','4',7,1308216024,1308216024,7,';00-16-35-A7-26-08;',NULL,'1',1,1),(42,'BUF78294',1,'00-19-99-00-66-77',NULL,'10.87.45.87','74','1014',12,'YKXR089145','1',9,1308216004,1308216004,7,';00-19-99-00-66-77;',NULL,'1',1,1),(43,'UUF68765',1,'00-12-79-AA-5F-70',NULL,'10.87.45.96','74','503',7,'CZC5152Q65','3',5,1308215917,1308215917,7,';00-12-79-AA-5F-70;',NULL,'1',1,1),(44,'UUF68513',1,'00-13-21-01-B2-65',NULL,'10.87.45.95','74','503',7,'CZC5152P4C','3',5,1308215545,1308215545,7,';00-13-21-01-B2-65;',NULL,'1',1,1),(45,'UUF68503',1,'00-13-21-01-B2-74',NULL,'10.87.45.94','74','503',7,'CZC5152P03','1',5,1308215473,1308215473,7,';00-13-21-01-B2-74;',NULL,'1',1,1),(46,'UUF68768',1,'00-12-79-AD-E1-D3',NULL,'10.87.45.103','74','503',7,'CZC5152Q6C','3',5,1308215389,1308215389,7,';00-12-79-AD-E1-D3;',NULL,'1',1,1),(47,'UUF72963',1,'00-15-60-BE-EC-4C',NULL,'10.97.248.39','37','1015',4,'HUB6230322','3',3,1308215112,1308215112,3,';00-15-60-BE-EC-4C;',NULL,'1',1,1),(48,'UUF72964',1,'00-15-60-B8-06-9F',NULL,'10.97.250.215','37','1015',4,'HUB6230327','3',3,1308215094,1308215094,3,';00-15-60-B8-06-9F;',NULL,'1',1,1),(49,'UUF72968',1,'00-15-60-B8-06-77',NULL,'10.97.240.53','37','1015',4,'HUB623032B','3',3,1308215016,1308215016,3,';00-15-60-B8-06-77;',NULL,'1',1,1),(50,'UUF74883',1,'00-15-60-B9-18-FE',NULL,'10.97.254.125','37','1015',4,'HUB6160V6N','3',3,1308215672,1308215672,3,';00-15-60-B9-18-FE;',NULL,'1',1,1),(51,'UUF74896',1,'00-15-60-B8-86-24',NULL,'10.97.249.241','37','1015',4,'HUB6160V40','3',3,1308215656,1308215656,3,';00-15-60-B8-86-24;',NULL,'1',1,1),(52,'UUF72992',1,'00-17-A4-1C-6E-AB',NULL,'10.87.45.9','74','1015',9,'CZC6210WGW','1',7,1308213951,1308213951,19,';00-17-A4-1C-6E-AB;',NULL,'1',1,1),(53,'UUF72996',1,'00-17-A4-1C-6E-CC',NULL,'10.87.45.117','74','1015',9,'CZC6210WGR','1',7,1308213777,1308213777,7,';00-17-A4-1C-6E-CC;',NULL,'1',1,1),(54,'UUF74030',1,'00-16-35-A7-25-D1',NULL,'10.87.45.86','74','1015',9,'CZC6152D97','1',7,1308213723,1308213723,7,';00-16-35-A7-25-D1;',NULL,'1',1,1),(55,'UUF72995',1,'00-17-A4-1E-0D-19',NULL,'10.87.45.91','74','1015',9,'CZC6210W8F','1',7,1308213697,1308213697,7,';00-17-A4-1E-0D-19;',NULL,'1',1,1),(56,'UUF74031',1,'00-16-35-AA-00-9E',NULL,'10.87.45.82','74','1015',9,'CZC6152DJH','1',7,1308214053,1308214053,7,';00-16-35-AA-00-9E;',NULL,'1',1,1),(57,'UUF74034',1,'00-16-35-A9-FE-B1',NULL,'10.87.45.88','74','1015',9,'CZC6152D99','1',7,1308213652,1308213652,7,';00-16-35-A9-FE-B1;',NULL,'1',1,1),(58,'UUF74032',1,'00-16-35-A5-E3-E9',NULL,'10.87.45.90','74','1015',9,'CZC6152DLN','1',7,1308213588,1308213588,7,';00-16-35-A5-E3-E9;',NULL,'1',1,1),(59,'BUF86171',1,'1C-C1-DE-AE-79-2C',NULL,'10.87.45.142','298','1903',8,'CNU0395LCG','5',6,1308213558,1308213558,3,';1C-C1-DE-AE-79-2C;',NULL,'1',1,1),(60,'UUF72792',1,'00-16-35-A7-25-D5',NULL,'10.87.45.85','74','1015',9,'CZC6152DJ4','1',7,1308213501,1308213501,7,';00-16-35-A7-25-D5;',NULL,'1',1,1),(61,'UUF72991',1,'00-17-A4-1C-29-23',NULL,'10.87.45.81','74','1015',9,'CZC6210WG7','1',7,1308213446,1308213446,7,';00-17-A4-1C-29-23;',NULL,'1',1,1),(62,'UUF72990',1,'00-17-A4-1D-C7-97',NULL,'10.87.45.83','74','1015',9,'CZC6210WFK','1',7,1308213394,1308213394,7,';00-17-A4-1D-C7-97;',NULL,'1',1,1),(63,'UUF72994',1,'00-17-A4-1C-6E-E4',NULL,'10.87.45.125','74','1015',9,'CZC6210WFV','1',7,1308213390,1308213390,7,';00-17-A4-1C-6E-E4;',NULL,'1',1,1),(64,'UUF72791',1,'00-16-35-A7-A2-91',NULL,'10.87.45.89','74','1015',9,'CZC6152DBH','1',7,1308213371,1308213371,7,';00-16-35-A7-A2-91;',NULL,'1',1,1),(65,'BUF82313',1,'00-24-81-65-32-E2',NULL,'192.168.0.1','232','1976',13,'CNU91659M1','2',1,1308213311,1308213311,3,';00-24-81-65-32-E2;',NULL,'1',1,1),(66,'BUF86175',1,'1C-C1-DE-AE-79-42',NULL,'10.87.45.139','298','1903',8,'CNU0395LD4','5',6,1308213285,1308213285,3,';1C-C1-DE-AE-79-42;',NULL,'1',1,1),(67,'BUF82297',1,'00-24-81-65-FC-59',NULL,'10.97.252.254','232','1976',13,'CNU91659MR','2',1,1308213256,1308213256,3,';00-24-81-65-FC-59;',NULL,'1',1,1),(68,'BUF86169',1,'1C-C1-DE-AE-B9-11',NULL,'10.87.45.119','298','1903',8,'CNU04003R5','5',6,1308213235,1308213235,3,';1C-C1-DE-AE-B9-11;',NULL,'1',1,1),(69,'BUF86172',1,'1C-C1-DE-AE-B9-B3',NULL,'10.87.45.140','298','1903',8,'CNU0395L94','5',6,1308213204,1308213204,3,';1C-C1-DE-AE-B9-B3;',NULL,'1',1,1),(70,'BUF92112',1,'78-2B-CB-B3-CE-12',NULL,'10.87.45.105','465','3241',1,'JSDF45J','1',1,1320658364,1320658364,20,';78-2B-CB-B3-CE-12;',NULL,'1',1,1),(71,'BUF92229',1,'78-2B-CB-B3-E8-66',NULL,'10.87.45.73','465','3241',1,'3PDF45J','1',1,1320657721,1320657721,3,';78-2B-CB-B3-E8-66;',NULL,'1',1,1),(72,'BUF92135',1,'78-2B-CB-B3-DC-49',NULL,'10.87.45.104','465','3241',1,'6TDF45J','1',1,1320657582,1320657582,3,';78-2B-CB-B3-DC-49;',NULL,'1',1,1),(73,'BUF92144',1,'78-2B-CB-B3-CA-7D',NULL,'10.87.45.103','465','3241',1,'GTDF45J','1',1,1320657534,1320657534,3,';78-2B-CB-B3-CA-7D;',NULL,'1',1,1),(74,'BUF92111',1,'78-2B-CB-B3-51-D5',NULL,'10.87.45.106','465','3241',1,'4QDF45J','1',1,1320657473,1320657473,3,';78-2B-CB-B3-51-D5;',NULL,'1',1,1),(75,'UUF67692',1,'00-15-60-BE-03-8A',NULL,'10.97.248.37','37','1015',4,'HUB6210LFY','3',3,1308304654,1308304654,21,';00-15-60-BE-03-8A;',NULL,'1',1,1),(76,'UUF74893',1,'00-15-60-B9-CB-40',NULL,'10.87.45.165','37','1015',4,'HUB6160V5T','4',3,1308223514,1308223514,22,';00-15-60-B9-CB-40;',NULL,'1',1,1),(77,'BUF79484',1,'00-16-D4-BA-CF-AA',NULL,'10.97.253.6','74','2039',5,'HUB70502K4','2',2,1308222126,1308222126,23,';00-16-D4-BA-CF-AA;',NULL,'1',1,1),(78,'BUF79374',1,'00-16-D4-B9-83-F6',NULL,'10.97.252.115','74','2039',5,'HUB70502L0','2',2,1308221610,1308221610,24,';00-16-D4-B9-83-F6;',NULL,'1',1,1),(79,'UUF61291',1,'00-11-0A-3B-E5-15',NULL,'10.87.45.158','37','503',10,'FRB4290LKM','3',8,1308220680,1308220680,5,';00-11-0A-3B-E5-15;',NULL,'1',1,1),(80,'UUF70108',1,'00-11-25-AF-A6-92',NULL,'10.97.253.169','37','502',14,'L3HAXRM','3',10,1308220603,1308220603,25,';00-11-25-AF-A6-92;',NULL,'1',1,1),(81,'UUF70177',1,'00-11-25-48-1C-D1',NULL,'10.97.252.209','37','502',14,'L3HAYYK','3',10,1308220553,1308220553,25,';00-11-25-48-1C-D1;',NULL,'1',1,1),(82,'UUF70174',1,'00-11-25-48-19-1F',NULL,'10.97.253.207','37','502',14,'L3HAYNL','3',10,1308220139,1308220139,25,';00-11-25-48-19-1F;',NULL,'1',1,1),(83,'BUF92226',1,'78-2B-CB-B3-EF-34',NULL,'10.87.45.90','465','3241',1,'FNDF45J','1',1,1320656880,1320656880,3,';78-2B-CB-B3-EF-34;',NULL,'1',1,1),(84,'UUF74911',1,'00-16-35-A7-A6-0A',NULL,'10.87.45.111','74','1015',9,'CZC6152DFF','1',7,1308217927,1308217927,16,';00-16-35-A7-A6-0A;',NULL,'1',1,1),(85,'BUF84646',1,'00-25-B3-14-44-FD',NULL,'10.87.45.135','232','3543',11,'CZC942503H','1',1,1308216376,1308216376,7,';00-25-B3-14-44-FD;',NULL,'1',1,1),(86,'UUF68505',1,'00-13-21-01-B2-A3',NULL,'10.87.45.107','74','503',7,'CZC5152P71','3',5,1308216352,1308216352,7,';00-13-21-01-B2-A3;',NULL,'1',1,1),(87,'UUF68767',1,'00-12-79-AA-63-AA',NULL,'10.87.45.100','74','503',7,'CZC5152Q46','3',5,1308215862,1308215862,7,';00-12-79-AA-63-AA;',NULL,'1',1,1),(88,'UUF68506',1,'00-13-21-01-6E-D8',NULL,'10.87.45.97','74','503',7,'CZC5152P8L','3',5,1308215763,1308215763,7,';00-13-21-01-6E-D8;',NULL,'1',1,1),(89,'UUF72993',1,'00-17-A4-1B-26-B0',NULL,'10.87.45.10','74','1015',9,'CZC6210WD7','1',7,1308213794,1308213794,16,';00-17-A4-1B-26-B0;',NULL,'1',1,1),(90,'UUF72793',1,'00-16-35-A7-25-F7',NULL,'10.87.45.80','74','1015',9,'CZC6152DJF','1',7,1308213611,1308213611,7,';00-16-35-A7-25-F7;',NULL,'1',1,1),(91,'BUF82312',1,'00-24-81-61-E4-56',NULL,'10.97.255.25','232','1976',13,'CNU91658Y4','2',1,1308213091,1308213091,3,';00-24-81-61-E4-56;',NULL,'1',1,1),(92,'BUF86168',1,'1C-C1-DE-AE-C7-97',NULL,'10.87.45.133','298','1903',8,'CNU0395L52','5',6,1308213084,1308213084,3,';1C-C1-DE-AE-C7-97;',NULL,'1',1,1),(93,'BUF86170',1,'1C-C1-DE-AE-E7-11',NULL,'10.87.45.131','298','1903',8,'CNU04018CT','5',6,1308213067,1308213067,3,';1C-C1-DE-AE-E7-11;',NULL,'1',1,1),(94,'BUF86173',1,'1C-C1-DE-AE-69-9D',NULL,'10.87.45.136','298','1903',8,'CNU04003QN','5',6,1308213078,1308213078,3,';1C-C1-DE-AE-69-9D;',NULL,'1',1,1),(95,'Test',1,'Test',NULL,'Tst',NULL,NULL,1,NULL,'1',NULL,1308213078,1308213078,4,NULL,NULL,'1',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connected_to_printers`
--

LOCK TABLES `connected_to_printers` WRITE;
/*!40000 ALTER TABLE `connected_to_printers` DISABLE KEYS */;
INSERT INTO `connected_to_printers` VALUES (1,1,1);
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
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `device_category_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_types`
--

LOCK TABLES `device_types` WRITE;
/*!40000 ALTER TABLE `device_types` DISABLE KEYS */;
INSERT INTO `device_types` VALUES (1,'Laptop','1'),(2,'Desktop','1'),(3,'Projector','2'),(4,'Camera','2');
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
INSERT INTO `devices` VALUES (1,'UUF79062',NULL,1,'3',NULL,NULL,1,1337440562,1337440562),(2,'Lumix 04',NULL,2,'3',NULL,NULL,1,1337440562,1337440562),(3,'Lumix 01',NULL,2,'3',NULL,NULL,1,1337440562,1337440562),(4,'Lumix 02',NULL,2,'3',NULL,NULL,1,1337440562,1337440562),(5,'Lumix 03',NULL,2,'3',NULL,NULL,1,1337440562,1337440562),(6,'BUF78478',NULL,NULL,'3',NULL,NULL,1,1337440563,1337440563),(7,'UUF16016',NULL,3,'7',NULL,NULL,1,1337440563,1337440563),(8,'BUF8290',NULL,NULL,'13',NULL,NULL,1,1337440563,1337440563),(9,'BUF80284',NULL,NULL,'5',NULL,NULL,1,1337440563,1337440563),(10,'BUF80224',NULL,NULL,'30',NULL,NULL,1,1337440563,1337440563),(11,'Vado1',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(12,'Vado2',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(13,'Vado3',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(14,'Vado4',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(15,'Vado5',NULL,4,'3',NULL,NULL,1,1337440563,1337440563),(16,'buf84785',NULL,5,'32',NULL,NULL,1,1337440563,1337440563),(17,'BUF78472',NULL,6,'33',NULL,NULL,1,1337440563,1337440563),(18,'BUF84121',NULL,7,'28',NULL,NULL,1,1337440563,1337440563),(19,'BUF84784',NULL,5,'22',NULL,NULL,1,1337440563,1337440563),(20,'BUF84120',NULL,7,'34',NULL,NULL,1,1337440563,1337440563),(21,'UUF76076',NULL,8,'7',NULL,NULL,1,1337440563,1337440563),(22,'BUF84123',NULL,7,'15',NULL,NULL,1,1337440563,1337440563),(23,'BUF78476',NULL,6,'17',NULL,NULL,1,1337440563,1337440563),(24,'BUF76078',NULL,8,'35',NULL,NULL,1,1337440563,1337440563),(25,'BUF80230',NULL,9,'24',NULL,NULL,1,1337440563,1337440563),(26,'BUF84122',NULL,7,'',NULL,NULL,1,1337440563,1337440563),(27,'BUF80219',NULL,9,'',NULL,NULL,1,1337440563,1337440563),(28,'BUF80204',NULL,9,'36',NULL,NULL,1,1337440563,1337440563),(29,'BUF80290',NULL,9,'13',NULL,NULL,1,1337440563,1337440563),(30,'BUF80203',NULL,9,'11',NULL,NULL,1,1337440563,1337440563),(31,'Y1',NULL,10,'37',NULL,NULL,1,1337440563,1337440563),(32,'BUF78475',NULL,6,'10',NULL,NULL,1,1337440563,1337440563),(33,'BUF80301',NULL,9,'12',NULL,NULL,1,1337440563,1337440563),(34,'BUF80296',NULL,9,'23',NULL,NULL,1,1337440563,1337440563),(35,'UUF71281',NULL,11,'2',NULL,NULL,1,1337440563,1337440563),(36,'Y2',NULL,10,'21',NULL,NULL,1,1337440563,1337440563),(37,'Y3',NULL,10,'8',NULL,NULL,1,1337440563,1337440563),(38,'Y4',NULL,10,'6',NULL,NULL,1,1337440563,1337440563),(39,'Y5',NULL,10,'9',NULL,NULL,1,1337440563,1337440563),(40,'BUF84783',NULL,5,'27',NULL,NULL,1,1337440563,1337440563);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,1,1);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'Hewlett Packard','HP',NULL),(2,'Intel','Intel',NULL),(3,'IBM','IBM',NULL),(4,'Dell','Dell',NULL),(5,'Lenovo','Lenovo',NULL),(6,'Fujitsu Siemens','Fujitsu Siemens',NULL),(7,'Canon','Canon',NULL),(8,'Panasonic','Panasonic',NULL),(9,'Hitachi','Hitachi',NULL),(10,'Toshiba','Toshiba',NULL),(11,'Creative','Creative',NULL),(12,'InFocus','InFocus',NULL),(13,'BENQ','BENQ',NULL),(14,'Apple','Apple',NULL),(15,'Google','Google',NULL),(16,'Samsung','Samsung',NULL),(17,'Compaq','Compaq',NULL),(18,'Microsoft','Microsoft',NULL);
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
-- Table structure for table `operating_systems`
--

DROP TABLE IF EXISTS `operating_systems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operating_systems` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `manufaturer_id` int(255) DEFAULT NULL,
  `detection_string` varchar(200) DEFAULT NULL,
  `version` varchar(200) DEFAULT NULL,
  `family_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operating_systems`
--

LOCK TABLES `operating_systems` WRITE;
/*!40000 ALTER TABLE `operating_systems` DISABLE KEYS */;
INSERT INTO `operating_systems` VALUES (1,'Windows XP',18,'Windows XP','XP',1);
/*!40000 ALTER TABLE `operating_systems` ENABLE KEYS */;
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
INSERT INTO `printer_models` VALUES (1,'HP LaserJet 4300',1,NULL,NULL),(2,'HP Officejet K5400',1,NULL,NULL),(3,'HP LaserJet 4350',1,NULL,NULL),(4,'HP JetDirect 1300n',1,NULL,NULL),(5,'HP LaserJet 4100',1,NULL,NULL);
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
INSERT INTO `printers` VALUES (1,'UUF61393','Biblo','3','10.87.45.14','00-0E-7F-3C-00-CF',1,1,1337443406,1337443406),(2,'BUF87512','LA Farve','16','10.87.45.16','00-21-5A-56-18-04',2,1,1337443406,1337443406),(3,'UUF60793','42','7','10.87.45.17','00-30-6E-FB-BF-BA',1,1,1337443406,1337443406),(4,'UUF76972','LA','16','10.87.45.15','00-1A-4B-1C-34-1B',3,1,1337443406,1337443406),(5,'UUF60470','Biblo Kontor','20','10.87.45.14','00-01-E6-E0-2D-A2',4,1,1337443406,1337443406),(6,'UUF55943','LV','14','10.87.45.13','00-01-E6-72-2B-05',5,1,1337443406,1337443406);
/*!40000 ALTER TABLE `printers` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `screens`
--

LOCK TABLES `screens` WRITE;
/*!40000 ALTER TABLE `screens` DISABLE KEYS */;
INSERT INTO `screens` VALUES (1,'Lal',1,1,3,NULL,1340553279,NULL,NULL),(2,'Lal2',NULL,1,3,1340553297,1340555199,1,NULL),(3,'Lal3',NULL,1,3,1340555214,1340555234,2,1),(4,'Hola',1,1,NULL,1341360835,1341360938,1,NULL);
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
  `token` varchar(128) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `created_time` int(255) DEFAULT NULL,
  `offline` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (10,'r831Y4JCl8hw43Yj',1,1335368359,'0');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test','test','Bo'),(2,NULL,NULL,'1');
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

-- Dump completed on 2012-07-12  0:38:28
