USE `webtehnologijegranulo`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: novosti_db
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `administratori`
--

DROP TABLE IF EXISTS `administratori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administratori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administratori`
--

LOCK TABLES `administratori` WRITE;
/*!40000 ALTER TABLE `administratori` DISABLE KEYS */;
INSERT INTO `administratori` VALUES (1,'das','d41d8cd98f00b204e9800998ecf8427e','');
/*!40000 ALTER TABLE `administratori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komentari`
--

DROP TABLE IF EXISTS `komentari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `novost` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `tekst_komentara` varchar(800) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `vrijeme_komentara` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `autor` varchar(200) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_novosti_idx` (`novost`),
  CONSTRAINT `fk_novosti` FOREIGN KEY (`novost`) REFERENCES `novosti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentari`
--

LOCK TABLES `komentari` WRITE;
/*!40000 ALTER TABLE `komentari` DISABLE KEYS */;
INSERT INTO `komentari` VALUES (2,4,'2015-05-28','egranulo2@etf.unsa.ba','easddsa \r\n                ','2015-05-28 08:04:06','Eldar'),(3,7,'2015-05-28','egranulo2@etf.unsa.ba','asdasd \r\n                ','2015-05-28 10:22:48','Eldar');
/*!40000 ALTER TABLE `komentari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `novosti`
--

DROP TABLE IF EXISTS `novosti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `novosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `vrijeme_vijesti` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `autor` varchar(200) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `slika_url` varchar(300) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `opis_vijesti` varchar(700) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `detaljna_vijest` varchar(700) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `naslov` varchar(300) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novosti`
--

LOCK TABLES `novosti` WRITE;
/*!40000 ALTER TABLE `novosti` DISABLE KEYS */;
INSERT INTO `novosti` VALUES (4,'2015-05-28','2015-05-27 23:15:04','Eldar','http://www.vatropromet.hr/images/vatrogasni_aparati/Vatrogasni-aparat-P4.jpg','Ovo je neka viejst',NULL,'Ovo je naslov'),(7,'2015-05-28','2015-05-28 10:22:07','Eldar','http://www.ram-rijeka.com/Repository/Slike/largeImages/MGP-6-vatrogasni-aparat_v.jpg','Ovo je nova novost updateovana sad 				','Ovo je detaljnije nego sto je bilo prije haha\r\n						','Nova vijest jos novija'),(9,'2015-05-28','2015-05-28 19:31:52','dsa','',' \r\n						',' \r\n						','das'),(10,'2015-05-28','2015-05-28 19:31:52','dsa','',' \r\n						',' \r\n						','das'),(11,'2015-05-28','2015-05-28 19:31:53','dsa','',' \r\n						',' \r\n						','das'),(12,'2015-05-28','2015-05-28 19:31:53','dsa','dassd','','','das'),(13,'2015-05-28','2015-05-28 19:32:02','d','',' \r\n						',' \r\n						','asd'),(14,'2015-05-28','2015-05-28 19:33:23','da','',' \r\n						',' \r\n						','dsadas'),(15,'2015-05-28','2015-05-28 19:39:17','asd','','asd','das','dasasd');
/*!40000 ALTER TABLE `novosti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-28 22:20:55
