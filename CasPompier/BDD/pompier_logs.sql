-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pompier
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `action` varchar(255) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'2024-05-04 21:27:26','Suppression',NULL,NULL),(2,'2024-05-04 22:44:39','suppression','type_engin','Type d\'engin supprimé avec ID VSAV'),(3,'2024-05-04 23:02:49','insertion','type_engin','Nouveau type d\'engin ajouté avec ID VSR'),(4,'2024-05-04 23:04:27','suppression','type_engin','Type d\'engin supprimé avec ID VSR'),(5,'2024-05-04 23:04:50','insertion','type_engin','Nouveau type d\'engin ajouté avec ID VSR'),(6,'2024-05-04 23:06:24','mise à jour','type_engin','Type d\'engin mis à jour avec ID VSR'),(7,'2024-05-04 23:06:40','mise à jour','type_engin','Type d\'engin mis à jour avec ID CCF'),(8,'2024-05-04 23:07:10','mise à jour','type_engin','Type d\'engin mis à jour avec ID CCF'),(9,'2024-05-04 23:07:32','mise à jour','type_engin','Type d\'engin mis à jour avec ID VSR'),(10,'2024-05-05 09:32:46','mise à jour','type_engin','Type d\'engin mis à jour avec ID VSR'),(11,'2024-05-05 09:32:46','mise à jour','type_engin','Type d\'engin mis à jour avec ID CCF'),(12,'2024-05-06 11:29:58','suppression','pompier','Pompier supprimé avec matricule 887799'),(13,'2024-05-06 11:30:03','suppression','pompier','Pompier supprimé avec matricule 654352'),(14,'2024-05-06 11:33:49','suppression','pompier','Pompier supprimé avec matricule 782312'),(15,'2024-05-06 11:34:20','suppression','pompier','Pompier supprimé avec matricule 786572'),(16,'2024-05-06 11:34:22','suppression','pompier','Pompier supprimé avec matricule 876543'),(17,'2024-05-06 11:34:25','suppression','pompier','Pompier supprimé avec matricule 887769'),(18,'2024-05-06 11:34:26','suppression','pompier','Pompier supprimé avec matricule 898989'),(19,'2024-05-06 11:34:30','suppression','pompier','Pompier supprimé avec matricule 920372'),(20,'2024-05-06 11:34:31','suppression','pompier','Pompier supprimé avec matricule 920379'),(21,'2024-05-06 11:34:34','suppression','pompier','Pompier supprimé avec matricule 982726'),(22,'2024-05-06 11:35:57','suppression','pompier','Pompier supprimé avec matricule 986995'),(23,'2024-05-06 11:36:00','suppression','pompier','Pompier supprimé avec matricule 992312'),(24,'2024-05-06 11:36:03','suppression','pompier','Pompier supprimé avec matricule 1000000'),(25,'2024-05-06 11:42:00','insertion','pompier','Nouveau pompier ajouté avec matricule 12345'),(26,'2024-05-06 11:45:34','insertion','pompier','Nouveau pompier ajouté avec matricule 98765'),(27,'2024-05-06 11:47:43','insertion','pompier','Nouveau pompier ajouté avec matricule 24680'),(28,'2024-05-06 11:51:13','insertion','pompier','Nouveau pompier ajouté avec matricule 13579'),(29,'2024-05-06 11:54:04','insertion','pompier','Nouveau pompier ajouté avec matricule 54321'),(30,'2024-05-06 11:56:15','insertion','pompier','Nouveau pompier ajouté avec matricule 36912'),(31,'2024-05-06 11:58:22','insertion','pompier','Nouveau pompier ajouté avec matricule 78901'),(32,'2024-05-06 12:00:22','insertion','pompier','Nouveau pompier ajouté avec matricule 25846'),(33,'2024-05-06 12:02:26','insertion','pompier','Nouveau pompier ajouté avec matricule 65478'),(34,'2024-05-06 15:44:33','insertion','type_engin','Nouveau type d\'engin ajouté avec ID VSAV'),(35,'2024-05-06 15:59:11','suppression','type_engin','Type d\'engin supprimé avec ID VSAV'),(36,'2024-05-06 16:01:18','insertion','type_engin','Nouveau type d\'engin ajouté avec ID VSAV'),(37,'2024-05-06 16:01:25','suppression','type_engin','Type d\'engin supprimé avec ID VSAV'),(45,'2024-05-06 18:43:16','insertion','type_engin','Nouveau type d\'engin ajouté avec ID VSAV'),(46,'2024-05-06 19:30:51','insertion','engin','L\'engin FPT a été ajouté à la caserne Carcassonne avec pour ID 10'),(47,'2024-05-06 19:32:56','insertion','engin','L\'engin FPT a été ajouté à la caserne Carcassonne avec pour ID 11'),(48,'2024-05-06 21:55:08','insertion','pompier','Nouveau pompier ajouté avec matricule 12347'),(49,'2024-05-06 21:55:08','insertion','professionnel','Matricule: 12347, DateEmbauche: 2017-12-20'),(50,'2024-05-06 21:55:08','insertion','affectation','Affectation du pompier avec le matricule 12347 à la caserne Lille'),(51,'2024-05-06 23:31:04','suppression','employeur','Employeur supprimé avec ID 6'),(52,'2024-05-06 23:31:04','mise à jour','employeur','Employeur mis à jour avec ID 6');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-07  1:53:30
