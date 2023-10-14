-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: clinica_confident
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuarioId` int DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `usuarioId` (`usuarioId`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citasservicios`
--

DROP TABLE IF EXISTS `citasservicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citasservicios` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `citaId` int DEFAULT NULL,
  `servicioId` int DEFAULT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `citaId` (`citaId`),
  KEY `servicioId` (`servicioId`),
  CONSTRAINT `citasservicios_ibfk_1` FOREIGN KEY (`citaId`) REFERENCES `citas` (`Id`),
  CONSTRAINT `citasservicios_ibfk_2` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citasservicios`
--

LOCK TABLES `citasservicios` WRITE;
/*!40000 ALTER TABLE `citasservicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `citasservicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'Consulta general',100.00),(2,'Limpieza dental',100.00),(3,'Rellenos',100.00),(4,'Blanqueamiento dental',100.00),(5,'Extracciones',100.00),(6,'Coronas',100.00),(7,'Puentes fijos',100.00),(8,'Tratamiento Periodontal',100.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (4,'Gabriel','Garcia','ggarcia@gmail.com','$2y$10$MdsvBnS0M.mtHm6AzhsR.uTo59Z8NNtH835DSXJI9nfwvod9hC5/S','42157564',0,0,'6517858d9007f '),(6,'Walter','Coronado','coronado@gmail.com','$2y$10$4zNIOYuxkMAu8ZYzeIsLYegNEOeYs8XJ481o8L9krm4ILJZKtVpZO','45215478',0,0,'651786e21b6e8 '),(8,'Ruth','Ramirez','nfgg2@gmail.com','$2y$10$vdgrq.bQRFTQgtl0rK7C0uYkW.iEmef7vhzkIoE6i5iJ.yt763n0q','23456754',0,1,''),(9,'julio ','Cifu','dljgfhd@gmail.com','$2y$10$KMam2a9EAJTf3hcabUb5puMsHX8xTvtNmjANR/e57ebfUhA82P.TS','452154785',0,0,'6517a071c6a37 '),(10,'Patricia ','Hernandez','pt@gmail.com','$2y$10$8qOBCC/33/yx9hr49xLR3.PGaeaR1JZRadUXwQotPIG1Bkp9/Om9q','84264513',0,1,''),(11,'oswaldo','Perez','operez@gmail.com','$2y$10$iSyX6hGNMl.WgEfVcX9GYOk3eJuGNQmNT6WxszbvVCjhyvPBM/jIq','75412456',0,1,''),(12,'Patric','Lopez','pl@gmail.com','$2y$10$ydvCOKhmxys.RPK6p6J32.je0d2a0k6uG/bXCKano0SMFm3vV8vJS','54122354',0,1,''),(13,'Saulo','Cifuentes','sc@gmail.com','$2y$10$QfsThjZMetA0l44dT/h7L.PESf8jV1KBBQeglQF9FLW32yUGGFB1C','75412456',0,1,''),(14,'Emanuel ','Alvarez','alvarezema9@gmail.com','$2y$10$mQn/rX2bMtiwze.Ci.yaW.eJGdEGrnTZaOnL0HaDwwzqTr4z3XvOy','51884015',1,1,''),(15,'Alex','Torres','alex@gmail.com','$2y$10$AqJ.d4lbGxi.fbwnNHDFouxnKVeqFGYftK5UlYjSXmVKaqeK5PFti','54215463',0,1,''),(16,'ludwin','torres','ludwin@gmail.com','$2y$10$Edga.vSYcXtPy5lqAJi26OH9R8lOJAzrRDDm8HlotVpPI85sznSLS','52465155',0,1,''),(17,'Rebecka','Alvarez','rbk@gmail.com','$2y$10$bctM6sHKYaiIab/rlRsPaO.BYygnXMK2k.iYmMolmg67YMXy1YgfS','74512467',0,0,'651cd6203a32d ');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-14 12:03:52
