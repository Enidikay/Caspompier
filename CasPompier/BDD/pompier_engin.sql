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
-- Table structure for table `engin`
--

DROP TABLE IF EXISTS `engin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `engin` (
  `Numéro` int(11) NOT NULL AUTO_INCREMENT,
  `Caserne_id` int(11) NOT NULL,
  `Type_Engin_id` varchar(255) NOT NULL,
  PRIMARY KEY (`Numéro`,`Caserne_id`,`Type_Engin_id`),
  KEY `Caserne_id` (`Caserne_id`),
  KEY `Type_Engin_id` (`Type_Engin_id`),
  CONSTRAINT `engin_ibfk_cascade_1` FOREIGN KEY (`Type_Engin_id`) REFERENCES `type_engin` (`id`) ON DELETE CASCADE,
  CONSTRAINT `engin_ibfk_cascade_2` FOREIGN KEY (`Caserne_id`) REFERENCES `caserne` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engin`
--

LOCK TABLES `engin` WRITE;
/*!40000 ALTER TABLE `engin` DISABLE KEYS */;
INSERT INTO `engin` VALUES (1,1,'EPA'),(2,1,'EPA'),(2,3,'CCF'),(4,3,'CCF'),(5,3,'FPT'),(6,3,'FPT'),(7,3,'FPT'),(8,3,'FPT'),(10,2,'FPT'),(11,2,'FPT');
/*!40000 ALTER TABLE `engin` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_insert_engin
AFTER INSERT ON engin
FOR EACH ROW
BEGIN
    DECLARE caserne_name VARCHAR(255);

    -- Requête SQL pour obtenir le nom de la caserne
    SELECT Nom INTO caserne_name FROM caserne WHERE id = NEW.Caserne_id;

    -- Appeler la procédure LogOperation en passant les informations nécessaires
    CALL LogOperation('insertion', 'engin', CONCAT('L\'engin ', NEW.Type_Engin_id, ' a été ajouté à la caserne ', caserne_name, ' avec pour ID ', NEW.Numéro));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_update_engin
AFTER UPDATE ON engin
FOR EACH ROW
BEGIN
    DECLARE caserne_name_old VARCHAR(255);
    DECLARE caserne_name_new VARCHAR(255);

    -- Requête SQL pour obtenir le nom de l'ancienne caserne
    SELECT Nom INTO caserne_name_old FROM caserne WHERE id = OLD.Caserne_id;

    -- Requête SQL pour obtenir le nom de la nouvelle caserne
    SELECT Nom INTO caserne_name_new FROM caserne WHERE id = NEW.Caserne_id;

    -- Appeler la procédure LogOperation en passant les informations nécessaires
    CALL LogOperation('modification', 'engin', CONCAT('L\'engin ', OLD.Type_Engin_id, ' a été déplacé de la caserne ', caserne_name_old, ' à la caserne ', caserne_name_new, ' avec pour ID ', OLD.Numéro));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_delete_engin
AFTER DELETE ON engin
FOR EACH ROW
BEGIN
    DECLARE caserne_name VARCHAR(255);

    -- Requête SQL pour obtenir le nom de la caserne
    SELECT Nom INTO caserne_name FROM caserne WHERE id = OLD.Caserne_id;

    -- Appeler la procédure LogOperation en passant les informations nécessaires
    CALL LogOperation('suppression', 'engin', CONCAT('L\'engin ', OLD.Type_Engin_id, ' a été supprimé de la caserne ', caserne_name, ' avec pour ID ', OLD.Numéro));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-07  1:53:30
