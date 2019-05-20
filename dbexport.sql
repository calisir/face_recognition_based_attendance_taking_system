-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host: localhost    Database: attendance
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `attendance` (
  `student` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `present` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student`,`class`,`week`),
  KEY `fk_attendance_2_idx` (`class`),
  CONSTRAINT `fk_attendance_1` FOREIGN KEY (`student`) REFERENCES `student` (`id`),
  CONSTRAINT `fk_attendance_2` FOREIGN KEY (`class`) REFERENCES `class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (100,1,1,1),(100,2,1,1),(100,3,1,1),(101,1,1,0),(101,2,1,0),(101,3,1,0),(102,1,1,0),(102,2,1,0),(102,3,1,0);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `classroom` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_class_1_idx` (`course`),
  KEY `fk_class_2_idx` (`period`),
  KEY `fk_class_3_idx` (`classroom`),
  CONSTRAINT `fk_class_1` FOREIGN KEY (`course`) REFERENCES `course` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_class_2` FOREIGN KEY (`period`) REFERENCES `period` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_class_3` FOREIGN KEY (`classroom`) REFERENCES `classroom` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES (1,492,49,11),(2,492,50,11),(3,492,51,11);
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom`
--

LOCK TABLES `classroom` WRITE;
/*!40000 ALTER TABLE `classroom` DISABLE KEYS */;
INSERT INTO `classroom` VALUES (11,'RZ-11'),(106,'T-106');
/*!40000 ALTER TABLE `classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `section` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `instructor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_course_1_idx` (`instructor`),
  CONSTRAINT `fk_course_1` FOREIGN KEY (`instructor`) REFERENCES `instructor` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (111,'1','CNG140',3),(140,'1','CNG140',1),(223,'1','CNG223',2),(242,'1','CNG242',4),(260,'1','CNG260',2),(281,'1','EEE281',7),(282,'1','EEE282',7),(300,'1','CNG300',6),(351,'1','CNG351',5),(442,'1','CNG442',4),(492,'1','CNG492',2);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrolled`
--

DROP TABLE IF EXISTS `enrolled`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `enrolled` (
  `student` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  PRIMARY KEY (`student`,`course`),
  KEY `fk_enrolled_2_idx` (`course`),
  CONSTRAINT `fk_enrolled_1` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_enrolled_2` FOREIGN KEY (`course`) REFERENCES `course` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrolled`
--

LOCK TABLES `enrolled` WRITE;
/*!40000 ALTER TABLE `enrolled` DISABLE KEYS */;
INSERT INTO `enrolled` VALUES (100,111),(101,111),(104,111),(107,111),(109,111),(111,111),(112,111),(113,111),(114,111),(102,242),(103,242),(104,242),(105,242),(106,242),(107,242),(108,242),(109,281),(110,281),(111,281),(112,281),(113,281),(114,281),(100,282),(101,282),(102,282),(115,282),(116,282),(117,282),(103,300),(104,300),(105,300),(106,300),(107,351),(108,351),(109,351),(110,351),(111,351),(112,351),(113,351),(100,442),(101,442),(102,442),(103,442),(114,442),(115,442),(116,442),(117,442),(100,492),(101,492),(102,492);
/*!40000 ALTER TABLE `enrolled` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor`
--

LOCK TABLES `instructor` WRITE;
/*!40000 ALTER TABLE `instructor` DISABLE KEYS */;
INSERT INTO `instructor` VALUES (0,'admin@admin','admin','1234','admin','admin'),(1,'otopcu@metu.edu.tr','otopcu','1234','Okan','Topçu'),(2,'eever@metu.edu.tr','eever','1234','Enver','Ever'),(3,'michael@metu.edu.tr','mstevens','1234','Michael','Stevens'),(4,'yyesilada@metu.edu.tr','yyesilada','1234','Yeliz','Yesilada'),(5,'icandan@metu.edu.tr','icandan','1234','Idil','Candan'),(6,'ielgedawy@metu.edu.tr','ielgedawy','1234','Islam','Elgedawy'),(7,'jkhan@metu.edu.tr','jkhan','1234','Jabran','Khan');
/*!40000 ALTER TABLE `instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objection`
--

DROP TABLE IF EXISTS `objection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `objection` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student` (`student`),
  KEY `class` (`class`),
  CONSTRAINT `objection_ibfk_1` FOREIGN KEY (`student`) REFERENCES `student` (`id`),
  CONSTRAINT `objection_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objection`
--

LOCK TABLES `objection` WRITE;
/*!40000 ALTER TABLE `objection` DISABLE KEYS */;
INSERT INTO `objection` VALUES (1,101,3);
/*!40000 ALTER TABLE `objection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `period`
--

DROP TABLE IF EXISTS `period`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` time NOT NULL,
  `day` varchar(45) NOT NULL,
  `finish` time DEFAULT NULL,
  PRIMARY KEY (`id`,`start`,`day`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `period`
--

LOCK TABLES `period` WRITE;
/*!40000 ALTER TABLE `period` DISABLE KEYS */;
INSERT INTO `period` VALUES (1,'08:40:00','Monday','09:30:00'),(2,'09:40:00','Monday','10:30:00'),(3,'10:40:00','Monday','11:30:00'),(4,'11:40:00','Monday','12:30:00'),(5,'12:40:00','Monday','13:30:00'),(6,'13:40:00','Monday','14:30:00'),(7,'14:40:00','Monday','15:30:00'),(8,'15:40:00','Monday','16:30:00'),(9,'16:40:00','Monday','17:30:00'),(10,'17:40:00','Monday','18:30:00'),(11,'18:40:00','Monday','19:30:00'),(12,'08:40:00','Tuesday','09:30:00'),(13,'09:40:00','Tuesday','10:30:00'),(14,'10:40:00','Tuesday','11:30:00'),(15,'11:40:00','Tuesday','12:30:00'),(16,'12:40:00','Tuesday','13:30:00'),(17,'13:40:00','Tuesday','14:30:00'),(18,'14:40:00','Tuesday','15:30:00'),(19,'15:40:00','Tuesday','16:30:00'),(20,'16:40:00','Tuesday','17:30:00'),(21,'17:40:00','Tuesday','18:30:00'),(22,'18:40:00','Tuesday','19:30:00'),(23,'08:40:00','Wednesday','09:30:00'),(24,'09:40:00','Wednesday','10:30:00'),(25,'10:40:00','Wednesday','11:30:00'),(26,'11:40:00','Wednesday','12:30:00'),(27,'12:40:00','Wednesday','13:30:00'),(28,'13:40:00','Wednesday','14:30:00'),(29,'14:40:00','Wednesday','15:30:00'),(30,'15:40:00','Wednesday','16:30:00'),(31,'16:40:00','Wednesday','17:30:00'),(32,'17:40:00','Wednesday','18:30:00'),(33,'18:40:00','Wednesday','19:30:00'),(34,'08:40:00','Thursday','09:30:00'),(35,'09:40:00','Thursday','10:30:00'),(36,'10:40:00','Thursday','11:30:00'),(37,'11:40:00','Thursday','12:30:00'),(38,'12:40:00','Thursday','13:30:00'),(39,'13:40:00','Thursday','14:30:00'),(40,'14:40:00','Thursday','15:30:00'),(41,'15:40:00','Thursday','16:30:00'),(42,'16:40:00','Thursday','17:30:00'),(43,'17:40:00','Thursday','18:30:00'),(44,'18:40:00','Thursday','19:30:00'),(45,'08:40:00','Friday','09:30:00'),(46,'09:40:00','Friday','10:30:00'),(47,'10:40:00','Friday','11:30:00'),(48,'11:40:00','Friday','12:30:00'),(49,'12:40:00','Friday','13:30:00'),(50,'13:40:00','Friday','14:30:00'),(51,'14:40:00','Friday','15:30:00'),(52,'15:40:00','Friday','16:30:00'),(53,'16:40:00','Friday','17:30:00'),(54,'17:40:00','Friday','18:30:00'),(55,'18:40:00','Friday','19:30:00'),(56,'08:40:00','Saturday','09:30:00'),(57,'09:40:00','Saturday','10:30:00'),(58,'10:40:00','Saturday','11:30:00'),(59,'11:40:00','Saturday','12:30:00'),(60,'12:40:00','Saturday','13:30:00'),(61,'13:40:00','Saturday','14:30:00'),(62,'14:40:00','Saturday','15:30:00'),(63,'15:40:00','Saturday','16:30:00'),(64,'16:40:00','Saturday','17:30:00'),(65,'17:40:00','Saturday','18:30:00'),(66,'18:40:00','Saturday','19:30:00'),(67,'08:40:00','Sunday','09:30:00'),(68,'09:40:00','Sunday','10:30:00'),(69,'10:40:00','Sunday','11:30:00'),(70,'11:40:00','Sunday','12:30:00'),(71,'12:40:00','Sunday','13:30:00'),(72,'13:40:00','Sunday','14:30:00'),(73,'14:40:00','Sunday','15:30:00'),(74,'15:40:00','Sunday','16:30:00'),(75,'16:40:00','Sunday','17:30:00'),(76,'17:40:00','Sunday','18:30:00'),(77,'18:40:00','Sunday','19:30:00');
/*!40000 ALTER TABLE `period` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `department` varchar(5) DEFAULT NULL,
  `videoStatus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (100,'cihan.gurbuz@metu.edu.tr','mustafa','1234','Mustafa','gurbuz','CNG',1),(101,'bugra.calisir@metu.edu.tr','alper','1234','Alper','Calisir','CNG',1),(102,'snnlsy@metu.edu.tr','sinan','1234','Sinan','Ulusoy','CNG',1),(103,'tima@metu.edu.tr','tima','1234','tima','bayeshov','CNG',1),(104,'sezinkoktas@metu.edu.tr','sezin','1234','Sezin','Koktas','CNG',0),(105,'johndoe@metu.edu.tr','john','1234','John','Doe','EEE',0),(106,'rylee@metu.edu.tr','rylee','1234','Rylee','Parrish','EEE',0),(107,'fateh@metu.edu.tr','fateh','1234','Fateh','West','EEE',0),(108,'isla@metu.edu.tr','isla','1234','Isla','Grace','EEE',0),(109,'mikail@metu.edu.tr','mikail','1234','Mikail','Nicholls','EEE',0),(110,'drake@metu.edu.tr','drake','1234','Drake','Villain','EEE',0),(111,'aleeza@metu.edu.tr','aleeza','1234','Aleeza','Waller','EEE',0),(112,'charley@metu.edu.tr','charley','1234','Charley','Ware','CNG',0),(113,'jax@metu.edu.tr','jax','1234','Jax','Lister','CNG',0),(114,'niyah@metu.edu.tr','niyah','1234','Niyah','Galloway','CNG',0),(115,'fannie@metu.edu.tr','fannie','1234','Fannie','Griffin','CNG',0),(116,'alex@metu.edu.tr','alex','1234','Alex','Strazsa','CNG',0),(117,'andrew@metu.edu.tr','andrew','1234','Andrew','Lennon','CNG',0);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-20 18:23:46
