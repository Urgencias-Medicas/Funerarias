-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: ::1    Database: local
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
-- Table structure for table `aseguradoras`
--

DROP TABLE IF EXISTS `aseguradoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `aseguradoras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aseguradoras`
--

LOCK TABLES `aseguradoras` WRITE;
/*!40000 ALTER TABLE `aseguradoras` DISABLE KEYS */;
/*!40000 ALTER TABLE `aseguradoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campanias`
--

DROP TABLE IF EXISTS `campanias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `campanias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `Aseguradora` int(11) NOT NULL,
  `Nombre_Aseguradora` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campanias`
--

LOCK TABLES `campanias` WRITE;
/*!40000 ALTER TABLE `campanias` DISABLE KEYS */;
INSERT INTO `campanias` VALUES (2,'Test campaña',7,'Aseguradora Prueba');
INSERT INTO `campanias` VALUES (3,'Test campaña 2',36,'Test 2');
/*!40000 ALTER TABLE `campanias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `casos`
--

DROP TABLE IF EXISTS `casos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `casos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agente` int(11) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Nombre` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Edad` int(11) DEFAULT NULL,
  `Aseguradora` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Causa` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Causa_Desc` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Causa_Especifica` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Direccion` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Departamento` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Municipio` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Padre` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `TelPadre` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Madre` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `TelMadre` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `NombreReporta` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `RelacionReporta` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `TelReporta` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Lugar` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Funeraria` int(11) DEFAULT NULL,
  `Funeraria_Nombre` text COLLATE utf8_persian_ci,
  `Estatus` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Reportar` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Costo` int(11) DEFAULT NULL,
  `Pagado` int(11) DEFAULT NULL,
  `Pendiente` int(11) DEFAULT NULL,
  `Solicitud` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Idioma` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Medico` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Tutor` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `ParentescoTutor` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `EmailTutor` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Comentario` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `TelTutor` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `DPITutor` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Evaluacion` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `casos`
--

LOCK TABLES `casos` WRITE;
/*!40000 ALTER TABLE `casos` DISABLE KEYS */;
INSERT INTO `casos` VALUES (3,NULL,1,'Estudiante de prueba',NULL,NULL,'2020-09-09','13:50:00','Test',NULL,NULL,'Esto es una prueba','GUATEMALA','MIXCO','Test',NULL,'Test',NULL,NULL,NULL,NULL,'6',6,'El Roble','Asignado','No',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (4,NULL,2,'Prueba Estudiante',NULL,NULL,'2020-09-09','18:01:00','Esto es una prueba',NULL,NULL,'Test','GUATEMALA','MIXCO','Test',NULL,'Test2',NULL,NULL,NULL,NULL,NULL,6,'El Roble','Cerrado','No',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (5,NULL,5,'Ana Lucía Robles',NULL,NULL,'2020-09-11','20:59:00','Muerte Natural',NULL,NULL,'Prueba de dirección','PETEN','Desconocido','Juan Robles',NULL,'Lucía Medina',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Abierto','No',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (6,NULL,4,'Patricia Morales',NULL,NULL,'2020-09-11','19:04:00','Muerte natural',NULL,NULL,'Test','IZABAL','TEST','Prueba',NULL,'Prueba',NULL,NULL,NULL,NULL,NULL,9,'Funeraria dos','Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (7,NULL,1,'Jefferson Morataya',NULL,NULL,'2020-09-11','15:15:00','Accidente',NULL,NULL,'Dirección de prueba Guatemala','GUATEMALA','Mixco','Test Padre',NULL,'Test Madre',NULL,NULL,NULL,NULL,'Edificio Tikal Futura',6,'El Roble','Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (8,NULL,2,'Luis Medina',NULL,NULL,'2020-09-11','16:44:00','Accidente',NULL,NULL,'Dirección de prueba capital','GUATEMALA','GUATEMALA','Test Padre',NULL,'Test Madre',NULL,NULL,NULL,NULL,'Edificio Miraflores',6,'El Roble','Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (9,NULL,5,'Ana Lucía Robles',NULL,NULL,'2020-09-19','10:55:00','Asesinato',NULL,NULL,'Ciudad de Guatemala','GUATEMALA','GUATEMALA','Test padre',NULL,'Test madre',NULL,NULL,NULL,NULL,'Boulevard Liberación',6,'El Roble','Asignado','No',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9);
INSERT INTO `casos` VALUES (10,NULL,2,'Luis Medina',NULL,NULL,'2020-09-19','10:10:00','Suicidio',NULL,NULL,'Guatemala','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Test Reporta','Tutor legal','12345678',NULL,6,'El Roble','Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (11,NULL,3,'Carlos Sagastume',NULL,NULL,'2020-09-19','14:55:00','Enfermedad Comun',NULL,NULL,'GUATEMALA','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Edgar Prueba','Tío del estudiante','12345678',NULL,6,'El Roble','Asignado','Si',1500,900,1600,'Pendiente',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (12,NULL,5,'Ana Lucía Robles',NULL,NULL,'2020-10-08','12:19:00','Accidente',NULL,NULL,'CC Miraflores','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Edwin Test','Tutor','12345678','CC Miraflores',6,'El Roble','Cerrado','No',1900,500,1400,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (13,NULL,6,'Juan Antonio Palma',NULL,NULL,'2020-10-08','12:39:00','Suicidio','Test de causa',NULL,'Roosevelt','GUATEMALA','GUATEMALA','Padre Test','12345678','Madre Test','87654321','Reporta test2','Tutor','54687213','Edificio Tikal Futura',6,'El Roble','Asignado','Si',2500,1864,636,'Pendiente',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9.5);
INSERT INTO `casos` VALUES (14,NULL,9,'Rosa Mendoza',NULL,NULL,'2020-10-26','19:19:00','Accidente',NULL,NULL,'Test','GUATEMALA','GUATEMALA','Test','12345678','Test','12345678','Edgar Ambrosio','Tester','12345678',NULL,6,'El Roble','Cerrado','Si',2000,1200,800,'Aprobar','Español','Test',NULL,NULL,NULL,'Sin comentarios',NULL,NULL,NULL);
INSERT INTO `casos` VALUES (15,NULL,8,'Silvia Arévalo',NULL,NULL,'2020-10-27','15:15:00','Accidente',NULL,NULL,'Test','GUATEMALA','GUATEMALA','Test Padre','12345678','Madre Test','12345678','Edgar Test','Doctor','85481813',NULL,6,'El Roble','Cerrado','Si',1500,600,900,'Declinar','Español','Edgar Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (16,NULL,5,'Ana Lucía Robles',NULL,NULL,'2020-10-27','16:10:00','Accidente',NULL,NULL,'Test','GUATEMALA','GUATEMALA','test','12138485','test','41414548','Edgar test','Test','15848415',NULL,NULL,NULL,'Cerrado','No',NULL,NULL,NULL,NULL,'Español','Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (17,2,5,'Ana Lucía Robles',NULL,NULL,'2020-11-14','15:00:00','Accidente','nueva causa 2',NULL,'test','GUATEMALA','GUATEMALA','test','18515815','test','18718185','test','test','15151818',NULL,6,'Funerales  El Roble','Asignado','No',5184,NULL,NULL,NULL,'Español','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (18,2,5,'Ana Lucía Robles',15,NULL,'2020-11-14','15:00:00','Accidente','test nuevo',NULL,'test','GUATEMALA','GUATEMALA','test','54141515','test','15151515','test','test','51515151',NULL,6,'Funerales  El Roble','Asignado','No',1500,NULL,NULL,'Declinar','Español','Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (19,2,5,'Ana Lucía Robles',12,'7','2020-11-14','15:00:00','Accidente','test nuevo 4','test','test234','PETEN','SAN JOSE','test','11111111','test','15185185','test3','test2','12345678','testtest',26,'\"Funeraria \"\"El Buen Pastor\"\"\"','Asignado','No',0,1415,-1415,NULL,'Española','Tests','testt','15151','155151','test','15151','1515',NULL);
INSERT INTO `casos` VALUES (20,2,15051,'Test Estudiante',15,'7','2020-11-23','15:03:00','Accidente','Se ahorcó test','Se colgó','test','GUATEMALA','GUATEMALA','test','15181818','test','18181818','test','test','15151515',NULL,6,'Funerales  El Roble','Cerrado','No',5184,NULL,NULL,NULL,'Español','Test',NULL,NULL,NULL,'Ninguno',NULL,NULL,9.5);
INSERT INTO `casos` VALUES (21,2,15154,'Test',15,'7','2020-11-24','15:15:00','Accidente','Test de causa','test','test','GUATEMALA','MIXCO','test','51515151','test','15151515','test','test','15151515',NULL,6,'Funerales  El Roble','Asignado','No',1500,NULL,NULL,NULL,'Español','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (22,2,1515,'test',18,'7','2020-11-05','15:15:00','Accidente','Test de causa','test','test','JUTIAPA','SAN JOSE ACATEMPA','test','15151515','test','15151515','test','test','15151515',NULL,NULL,NULL,'Abierto','No',NULL,NULL,NULL,NULL,'test','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `casos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `causas`
--

DROP TABLE IF EXISTS `causas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `causas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Causa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `causas`
--

LOCK TABLES `causas` WRITE;
/*!40000 ALTER TABLE `causas` DISABLE KEYS */;
INSERT INTO `causas` VALUES (1,'Test de causa');
INSERT INTO `causas` VALUES (4,'asdasdad');
INSERT INTO `causas` VALUES (5,'dddsd');
INSERT INTO `causas` VALUES (6,'fsdsfsdf');
INSERT INTO `causas` VALUES (7,'gsdf');
INSERT INTO `causas` VALUES (8,'test');
INSERT INTO `causas` VALUES (9,'testt');
INSERT INTO `causas` VALUES (10,'ddsdsd');
INSERT INTO `causas` VALUES (11,'fghfgh');
INSERT INTO `causas` VALUES (12,'fdsfdsf');
INSERT INTO `causas` VALUES (13,'nueva causa 2');
INSERT INTO `causas` VALUES (14,'gfgfgf');
INSERT INTO `causas` VALUES (15,'test nuevo');
INSERT INTO `causas` VALUES (16,'test nuevo 3');
INSERT INTO `causas` VALUES (17,'Se ahorcó test');
INSERT INTO `causas` VALUES (18,'asdddsad');
INSERT INTO `causas` VALUES (19,'nueva causa');
INSERT INTO `causas` VALUES (20,'test nuevo 2');
INSERT INTO `causas` VALUES (21,'nuevo test 3');
INSERT INTO `causas` VALUES (22,'test nuevo 4');
INSERT INTO `causas` VALUES (23,'test tail');
INSERT INTO `causas` VALUES (24,'test nuevo tail');
/*!40000 ALTER TABLE `causas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_funeraria`
--

DROP TABLE IF EXISTS `detalles_funeraria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detalles_funeraria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paso_uno` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `paso_dos` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `paso_tres` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_funeraria`
--

LOCK TABLES `detalles_funeraria` WRITE;
/*!40000 ALTER TABLE `detalles_funeraria` DISABLE KEYS */;
INSERT INTO `detalles_funeraria` VALUES (1,'Si','Si','Si');
INSERT INTO `detalles_funeraria` VALUES (2,'Si','Si','No');
INSERT INTO `detalles_funeraria` VALUES (3,'Si','Si','Si');
INSERT INTO `detalles_funeraria` VALUES (4,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (5,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (6,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (7,'No','Si','Si');
INSERT INTO `detalles_funeraria` VALUES (8,'Si','Si','Si');
INSERT INTO `detalles_funeraria` VALUES (9,'Si','No','Si');
INSERT INTO `detalles_funeraria` VALUES (10,'Si','Si','No');
INSERT INTO `detalles_funeraria` VALUES (11,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (12,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (13,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (14,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (15,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (16,'No','No','No');
INSERT INTO `detalles_funeraria` VALUES (17,'No','No','No');
/*!40000 ALTER TABLE `detalles_funeraria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
-- Table structure for table `funerarias`
--

DROP TABLE IF EXISTS `funerarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `funerarias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Funeraria` int(11) DEFAULT NULL,
  `Nombre` text,
  `Email` text,
  `Telefono` text,
  `Monto_Base` int(11) DEFAULT NULL,
  `Activa` text,
  `Id_Detalle` int(11) DEFAULT NULL,
  `Campanias` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funerarias`
--

LOCK TABLES `funerarias` WRITE;
/*!40000 ALTER TABLE `funerarias` DISABLE KEYS */;
INSERT INTO `funerarias` VALUES (1,6,'Funerales  El Roble','samedgar15@gmail.com','12345678',5184,'Si',9,'[{\"id\": \"2\", \"monto\": \"1100\", \"nombre\": \"Test campaña, Aseguradora Prueba\"}, {\"id\": \"3\", \"monto\": \"1500\", \"nombre\": \"Test campaña 2, Test 2\"}]');
INSERT INTO `funerarias` VALUES (2,13,'Funeraria Quetzaltenango','quetzaltenango@funeraria.com','12345678',10000,'Si',10,NULL);
INSERT INTO `funerarias` VALUES (3,1,'Funeraria La Piedad','','',0,'Si',11,NULL);
INSERT INTO `funerarias` VALUES (4,2,'Funeraria San Miguel','test@test.com','15151545',0,'Si',12,NULL);
INSERT INTO `funerarias` VALUES (5,3,'Funeraria Morazán','','',0,'Si',13,NULL);
INSERT INTO `funerarias` VALUES (6,5,'Funerales y Capillas San José','','',0,'Si',14,NULL);
INSERT INTO `funerarias` VALUES (7,10,'Funerales Carranza','','',0,'Si',15,NULL);
INSERT INTO `funerarias` VALUES (8,26,'\"Funeraria \"\"El Buen Pastor\"\"\"','samedgar15@gmail.com','15234584',0,'Si',16,NULL);
INSERT INTO `funerarias` VALUES (9,4,'Funeraria Hardelh','','',0,'Si',17,NULL);
/*!40000 ALTER TABLE `funerarias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_pagos`
--

DROP TABLE IF EXISTS `historial_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `historial_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caso` int(11) NOT NULL,
  `monto` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `factura` text CHARACTER SET utf8 COLLATE utf8_romanian_ci,
  `serie` text CHARACTER SET utf8 COLLATE utf8_romanian_ci,
  PRIMARY KEY (`id`),
  KEY `caso` (`caso`),
  CONSTRAINT `historial_pagos_ibfk_1` FOREIGN KEY (`caso`) REFERENCES `casos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_pagos`
--

LOCK TABLES `historial_pagos` WRITE;
/*!40000 ALTER TABLE `historial_pagos` DISABLE KEYS */;
INSERT INTO `historial_pagos` VALUES (1,11,100,'2020-10-08',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (2,11,50,'2020-10-07',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (3,11,50,'2020-10-08',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (4,11,50,'2020-10-01',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (5,11,150,'2020-10-02',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (6,11,200,'2020-10-05',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (7,11,150,'2020-09-01',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (8,11,100,'2020-08-05',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (9,11,50,'2020-10-07',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (10,12,500,'2020-10-08',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (11,13,500,'2020-10-08',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (12,13,50,'2020-10-08',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (13,13,100,'2020-10-13','15216',NULL);
INSERT INTO `historial_pagos` VALUES (14,13,100,'2020-10-13','123',NULL);
INSERT INTO `historial_pagos` VALUES (15,14,500,'2020-10-26','12',NULL);
INSERT INTO `historial_pagos` VALUES (16,14,700,'2020-10-26','13',NULL);
INSERT INTO `historial_pagos` VALUES (17,15,150,'2020-10-27','123',NULL);
INSERT INTO `historial_pagos` VALUES (18,15,350,'2020-10-27','122',NULL);
INSERT INTO `historial_pagos` VALUES (19,13,124,'2020-10-28','121a',NULL);
INSERT INTO `historial_pagos` VALUES (20,13,150,'2020-10-28','12154',NULL);
INSERT INTO `historial_pagos` VALUES (21,13,110,'2020-10-28','1111',NULL);
INSERT INTO `historial_pagos` VALUES (22,13,110,'2020-10-28','1111',NULL);
INSERT INTO `historial_pagos` VALUES (23,13,100,'2020-10-28','54818',NULL);
INSERT INTO `historial_pagos` VALUES (24,15,100,'2020-10-28','8481',NULL);
INSERT INTO `historial_pagos` VALUES (25,13,100,'2020-10-28','123223',NULL);
INSERT INTO `historial_pagos` VALUES (26,13,100,'2020-10-28','123223',NULL);
INSERT INTO `historial_pagos` VALUES (27,13,100,'2020-10-28','123223',NULL);
INSERT INTO `historial_pagos` VALUES (28,13,100,'2020-10-28','123223',NULL);
INSERT INTO `historial_pagos` VALUES (29,13,120,'2020-10-28','1502',NULL);
INSERT INTO `historial_pagos` VALUES (30,19,150,'2020-11-18','1',NULL);
INSERT INTO `historial_pagos` VALUES (31,19,150,'2020-11-20','15','E');
INSERT INTO `historial_pagos` VALUES (32,19,1000,'2020-11-21','12345','A');
INSERT INTO `historial_pagos` VALUES (33,19,15,'2020-12-07','5','A');
INSERT INTO `historial_pagos` VALUES (34,19,100,'2020-12-07','121','A');
/*!40000 ALTER TABLE `historial_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` VALUES (4,'2020_09_08_150617_create_permission_tables',2);
INSERT INTO `migrations` VALUES (5,'2020_10_14_003707_create_casos_table',0);
INSERT INTO `migrations` VALUES (6,'2020_10_14_003707_create_detalles_funeraria_table',0);
INSERT INTO `migrations` VALUES (7,'2020_10_14_003707_create_failed_jobs_table',0);
INSERT INTO `migrations` VALUES (8,'2020_10_14_003707_create_historial_pagos_table',0);
INSERT INTO `migrations` VALUES (9,'2020_10_14_003707_create_model_has_permissions_table',0);
INSERT INTO `migrations` VALUES (10,'2020_10_14_003707_create_model_has_roles_table',0);
INSERT INTO `migrations` VALUES (11,'2020_10_14_003707_create_notificaciones_table',0);
INSERT INTO `migrations` VALUES (12,'2020_10_14_003707_create_password_resets_table',0);
INSERT INTO `migrations` VALUES (13,'2020_10_14_003707_create_permissions_table',0);
INSERT INTO `migrations` VALUES (14,'2020_10_14_003707_create_role_has_permissions_table',0);
INSERT INTO `migrations` VALUES (15,'2020_10_14_003707_create_roles_table',0);
INSERT INTO `migrations` VALUES (16,'2020_10_14_003707_create_solicitudes_cobro_funerarias_table',0);
INSERT INTO `migrations` VALUES (17,'2020_10_14_003707_create_users_table',0);
INSERT INTO `migrations` VALUES (18,'2020_10_14_003709_add_foreign_keys_to_historial_pagos_table',0);
INSERT INTO `migrations` VALUES (19,'2020_10_14_003709_add_foreign_keys_to_model_has_permissions_table',0);
INSERT INTO `migrations` VALUES (20,'2020_10_14_003709_add_foreign_keys_to_model_has_roles_table',0);
INSERT INTO `migrations` VALUES (21,'2020_10_14_003709_add_foreign_keys_to_role_has_permissions_table',0);
INSERT INTO `migrations` VALUES (22,'2020_10_14_003709_add_foreign_keys_to_solicitudes_cobro_funerarias_table',0);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
 SET character_set_client = utf8mb4 ;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1);
INSERT INTO `model_has_roles` VALUES (2,'App\\User',2);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',3);
INSERT INTO `model_has_roles` VALUES (4,'App\\User',4);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',5);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',6);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',7);
INSERT INTO `model_has_roles` VALUES (1,'App\\User',9);
INSERT INTO `model_has_roles` VALUES (2,'App\\User',18);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',19);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',20);
INSERT INTO `model_has_roles` VALUES (2,'App\\User',21);
INSERT INTO `model_has_roles` VALUES (2,'App\\User',23);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',24);
INSERT INTO `model_has_roles` VALUES (2,'App\\User',25);
INSERT INTO `model_has_roles` VALUES (2,'App\\User',27);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',28);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funeraria` int(11) DEFAULT NULL,
  `contenido` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `estatus` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `caso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (1,NULL,'Test Notificación','Activa',NULL);
INSERT INTO `notificaciones` VALUES (2,6,'Test dos','Inactiva',NULL);
INSERT INTO `notificaciones` VALUES (3,6,'Test tres','Inactiva',NULL);
INSERT INTO `notificaciones` VALUES (4,6,'Caso #13 asignado.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (5,6,'Su solicitud #7 ha sido aprobada.','Inactiva',NULL);
INSERT INTO `notificaciones` VALUES (6,6,'Su solicitud #8 del caso #13 ha sido rechazada.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (7,6,'Su solicitud #9 del caso #13 ha sido rechazada.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (8,NULL,'El caso #13 tiene una nueva solicitud.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (9,6,'Su solicitud #10 del caso #13 ha sido aprobada.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (10,NULL,'El caso #13 tiene una nueva solicitud.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (11,6,'La solicitud del caso #13 ha sido aprobada.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (12,NULL,'El caso #13 tiene una nueva solicitud.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (13,6,'La solicitud del caso #13 ha sido aprobada.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (14,NULL,'El caso #13 tiene una nueva solicitud.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (15,6,'La solicitud del caso #13 ha sido rechazada.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (16,6,'Caso #11 asignado.','Inactiva',11);
INSERT INTO `notificaciones` VALUES (17,5,'Test funeraria 5','Activa',NULL);
INSERT INTO `notificaciones` VALUES (18,6,'Caso #13 asignado.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (19,NULL,'El caso #13 tiene una nueva solicitud.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (20,6,'La solicitud del caso #13 ha sido aprobada.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (21,NULL,'El caso #13 tiene una nueva solicitud.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (22,6,'La solicitud del caso #13 ha sido rechazada.','Inactiva',13);
INSERT INTO `notificaciones` VALUES (23,NULL,'El caso #13 tiene una nueva solicitud.','Activa',13);
INSERT INTO `notificaciones` VALUES (24,6,'La solicitud del caso #13 ha sido aprobada.','Activa',13);
INSERT INTO `notificaciones` VALUES (25,NULL,'El caso #11 tiene una nueva solicitud.','Activa',11);
INSERT INTO `notificaciones` VALUES (26,NULL,'Caso #','Inactiva',14);
INSERT INTO `notificaciones` VALUES (27,6,'Caso #14 asignado.','Activa',14);
INSERT INTO `notificaciones` VALUES (28,NULL,'El caso #14 tiene una nueva solicitud.','Activa',14);
INSERT INTO `notificaciones` VALUES (29,6,'La solicitud del caso #14 ha sido aprobada.','Activa',14);
INSERT INTO `notificaciones` VALUES (30,NULL,'El caso #14 se ha cerrado.','Inactiva',14);
INSERT INTO `notificaciones` VALUES (31,NULL,'El caso #14 se ha cerrado.','Inactiva',14);
INSERT INTO `notificaciones` VALUES (32,NULL,'El caso #14 se ha cerrado.','Activa',14);
INSERT INTO `notificaciones` VALUES (33,NULL,'Caso #','Activa',15);
INSERT INTO `notificaciones` VALUES (34,6,'Caso #15 asignado.','Activa',15);
INSERT INTO `notificaciones` VALUES (35,NULL,'El caso #15 tiene una nueva solicitud.','Activa',15);
INSERT INTO `notificaciones` VALUES (36,6,'La solicitud del caso #15 ha sido rechazada.','Activa',15);
INSERT INTO `notificaciones` VALUES (37,6,'El caso #15 se ha cerrado.','Activa',15);
INSERT INTO `notificaciones` VALUES (38,NULL,'Caso #16 creado.','Activa',16);
INSERT INTO `notificaciones` VALUES (39,NULL,'El caso #16 se ha cerrado.','Activa',16);
INSERT INTO `notificaciones` VALUES (40,NULL,'El caso #16 se ha cerrado.','Activa',16);
INSERT INTO `notificaciones` VALUES (41,NULL,'El caso #16 se ha cerrado.','Activa',16);
INSERT INTO `notificaciones` VALUES (42,NULL,'El caso #16 se ha cerrado.','Activa',16);
INSERT INTO `notificaciones` VALUES (43,NULL,'El caso #16 se ha cerrado.','Activa',16);
INSERT INTO `notificaciones` VALUES (44,NULL,'El caso #16 se ha cerrado.','Activa',16);
INSERT INTO `notificaciones` VALUES (45,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (46,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (47,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (48,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (49,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (50,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (51,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (52,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (53,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (54,6,'El caso #13 se ha cerrado.','Activa',13);
INSERT INTO `notificaciones` VALUES (55,NULL,'El caso #13 tiene una nueva solicitud.','Activa',13);
INSERT INTO `notificaciones` VALUES (56,NULL,'Caso #17 creado.','Activa',17);
INSERT INTO `notificaciones` VALUES (57,NULL,'Caso #18 creado.','Activa',18);
INSERT INTO `notificaciones` VALUES (58,NULL,'Caso #19 creado.','Activa',19);
INSERT INTO `notificaciones` VALUES (59,NULL,'Caso #1 actualizado.','Activa',1);
INSERT INTO `notificaciones` VALUES (60,NULL,'Caso #1 actualizado.','Activa',1);
INSERT INTO `notificaciones` VALUES (61,NULL,'Caso #1 actualizado.','Activa',1);
INSERT INTO `notificaciones` VALUES (62,NULL,'Caso #1 actualizado.','Activa',1);
INSERT INTO `notificaciones` VALUES (63,NULL,'Caso #1 actualizado.','Activa',1);
INSERT INTO `notificaciones` VALUES (64,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (65,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (66,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (67,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (68,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (69,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (70,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (71,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (72,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (73,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (74,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (75,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (76,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (77,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (78,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (79,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (80,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (81,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (82,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (83,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (84,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (85,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (86,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (87,6,'Caso #18 asignado.','Activa',18);
INSERT INTO `notificaciones` VALUES (88,6,'Caso #18 asignado.','Activa',18);
INSERT INTO `notificaciones` VALUES (89,6,'Caso #18 asignado.','Activa',18);
INSERT INTO `notificaciones` VALUES (90,6,'Caso #17 asignado.','Activa',17);
INSERT INTO `notificaciones` VALUES (91,6,'Caso #17 asignado.','Activa',17);
INSERT INTO `notificaciones` VALUES (92,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (93,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (94,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (95,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (96,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (97,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (98,1,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (99,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (100,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (101,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (102,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (103,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (104,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (105,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (106,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (107,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (108,NULL,'Caso #20 creado.','Activa',20);
INSERT INTO `notificaciones` VALUES (109,6,'Caso #20 asignado.','Activa',20);
INSERT INTO `notificaciones` VALUES (110,6,'El caso #20 se ha cerrado.','Activa',20);
INSERT INTO `notificaciones` VALUES (111,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (112,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (113,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (114,6,'El caso #19 se ha cerrado.','Activa',19);
INSERT INTO `notificaciones` VALUES (115,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (116,NULL,'Caso #13 actualizado.','Activa',13);
INSERT INTO `notificaciones` VALUES (117,NULL,'Caso #13 actualizado.','Activa',13);
INSERT INTO `notificaciones` VALUES (118,NULL,'Caso #13 actualizado.','Activa',13);
INSERT INTO `notificaciones` VALUES (119,NULL,'Caso #13 actualizado.','Activa',13);
INSERT INTO `notificaciones` VALUES (120,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (121,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (122,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (123,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (124,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (125,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (126,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (127,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (128,6,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (129,NULL,'Caso #21 creado.','Activa',21);
INSERT INTO `notificaciones` VALUES (130,NULL,'Caso #22 creado.','Activa',22);
INSERT INTO `notificaciones` VALUES (131,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (132,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (133,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (134,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (135,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (136,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (137,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (138,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (139,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (140,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (141,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (142,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (143,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (144,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (145,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (146,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (147,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (148,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (149,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (150,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (151,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (152,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (153,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (154,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (155,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (156,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (157,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (158,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (159,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (160,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (161,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (162,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (163,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (164,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (165,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (166,26,'Caso #19 asignado.','Activa',19);
INSERT INTO `notificaciones` VALUES (167,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (168,NULL,'Caso #19 actualizado.','Activa',19);
INSERT INTO `notificaciones` VALUES (169,NULL,'Caso #18 actualizado.','Activa',18);
INSERT INTO `notificaciones` VALUES (170,NULL,'El caso #18 tiene una nueva solicitud.','Activa',18);
INSERT INTO `notificaciones` VALUES (171,6,'La solicitud del caso #18 ha sido rechazada.','Activa',18);
INSERT INTO `notificaciones` VALUES (172,NULL,'El caso #18 tiene una nueva solicitud.','Activa',18);
INSERT INTO `notificaciones` VALUES (173,6,'La solicitud del caso #18 ha sido rechazada.','Activa',18);
INSERT INTO `notificaciones` VALUES (174,6,'Caso #21 asignado.','Activa',21);
INSERT INTO `notificaciones` VALUES (175,6,'Caso #21 asignado.','Activa',21);
INSERT INTO `notificaciones` VALUES (176,6,'Caso #21 asignado.','Activa',21);
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
 SET character_set_client = utf8mb4 ;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Agente','web','2020-09-09 01:57:39','2020-09-09 01:57:39');
INSERT INTO `roles` VALUES (2,'Personal','web','2020-09-09 01:57:39','2020-09-09 01:57:39');
INSERT INTO `roles` VALUES (3,'Funeraria','web','2020-09-09 01:57:39','2020-09-09 01:57:39');
INSERT INTO `roles` VALUES (4,'Super Admin','web','2020-09-09 01:57:39','2020-09-09 01:57:39');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes_cobro_funerarias`
--

DROP TABLE IF EXISTS `solicitudes_cobro_funerarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `solicitudes_cobro_funerarias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caso` int(11) NOT NULL,
  `estatus` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `costo` int(11) DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `caso` (`caso`),
  CONSTRAINT `solicitudes_cobro_funerarias_ibfk_1` FOREIGN KEY (`caso`) REFERENCES `casos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes_cobro_funerarias`
--

LOCK TABLES `solicitudes_cobro_funerarias` WRITE;
/*!40000 ALTER TABLE `solicitudes_cobro_funerarias` DISABLE KEYS */;
INSERT INTO `solicitudes_cobro_funerarias` VALUES (1,13,'Aprobar',2000,'Test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (3,11,'Declinar',2500,'Nuevo test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (4,11,'Aprobar',2500,'Test 2');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (5,13,'Aprobar',3000,'Costo aumentado por distancia');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (6,13,'Declinar',3500,'test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (7,13,'Aprobar',2000,'Test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (8,13,'Declinar',3000,'Nuevo test notificación');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (9,13,'Declinar',2500,'Test nuevo');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (10,13,'Aprobar',2500,'Test nuevo');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (11,13,'Aprobar',3000,'test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (12,13,'Aprobar',3200,'test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (13,13,'Declinar',3300,'test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (14,13,'Aprobar',2000,'Test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (15,13,'Declinar',2500,'test  2');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (16,13,'Aprobar',2500,'test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (17,11,'Pendiente',1800,'test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (18,14,'Aprobar',2000,'X o Y motivo');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (19,15,'Declinar',2000,'Test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (20,13,'Pendiente',3000,'test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (21,18,'Declinar',1800,'test');
INSERT INTO `solicitudes_cobro_funerarias` VALUES (22,18,'Declinar',1800,'test');
/*!40000 ALTER TABLE `solicitudes_cobro_funerarias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `funeraria` int(11) DEFAULT NULL,
  `activo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detalle` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Agente Call Center','agent@callcenter.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','1nPyn4QDB5bUqzPA7LEcoszkFoAwVZlPDCyINUh1Qt5uRMDoBdkzF61nuLSx','2020-09-09 01:57:39','2020-09-09 01:57:39',NULL,NULL,NULL);
INSERT INTO `users` VALUES (2,'Personal UM','personal@um.com','2020-09-09 01:57:39','$2y$10$mpS45hcRmh8IXwz4QQoKxe2vqqqqw3qKBVNyoxyK9pzSJJkLNF97i','7vksFH8GwQDXhJAXb9OJArWf8M2I2STKACazuWPhknvRRSkxwEMkwbFbE2UQ','2020-09-09 01:57:39','2020-10-28 09:50:20',NULL,NULL,NULL);
INSERT INTO `users` VALUES (3,'Funeraria','funeraria@um.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','DmSwWDOeI1Lg9chghCbTIPUFUvntev4GCI45zWs5zGR7SQqnqpaPoBZkTcmv','2020-09-09 01:57:39','2020-09-09 01:57:39',6,'Si',NULL);
INSERT INTO `users` VALUES (4,'test','admin@test.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','rjcMnEygeBpcwY5w1388BPILGeNXWbb41DCqxozh62PS05U5NooHJOcjGgpd','2020-09-09 01:57:39','2020-09-09 01:57:39',NULL,NULL,NULL);
INSERT INTO `users` VALUES (5,'Test Funeraria','funeraria@test.com',NULL,'$2y$10$VUmvDlbOYqPL0qMltjm15OQl1x8G9OpqFCjsGzevKg4ItfXdD1lMK',NULL,'2020-09-17 03:52:58','2020-09-17 06:50:01',1,'Si',1);
INSERT INTO `users` VALUES (6,'Funeraria de prueba','test@funeraria.com',NULL,'$2y$10$UT1HBPPcvbVWlIJ87EzOp.CAcuHdNg/oKp6IPQCpUph4XazgF5PsG',NULL,'2020-09-17 06:48:48','2020-09-17 06:48:48',NULL,'No',2);
INSERT INTO `users` VALUES (7,'Funeraria de prueba edit','funeraria@guatemala.com',NULL,'$2y$10$XN83vjdtpiVc.CeQB6M14.J4LzGNc0UcyKneOoeCbwIK6pPIdhLaa',NULL,'2020-09-19 23:07:04','2020-10-27 06:55:23',NULL,'No',3);
INSERT INTO `users` VALUES (9,'testRegistro','test@registro.com',NULL,'$2y$10$FCJU42hwHs1gGjJoNXDgNOapPl7E3o4iMU2zEF4megU1aHoIxFI6G',NULL,'2020-10-26 07:11:17','2020-10-26 07:11:17',NULL,NULL,NULL);
INSERT INTO `users` VALUES (18,'HilarioTest','Hilario@test.com',NULL,'$2y$10$KOlRQ/vWgBXeIFEj/Rms1OHKtomJaUo1iwcB9VSWYQ.Vxv4E9cQ2G',NULL,'2020-10-27 07:05:52','2020-10-27 07:05:52',NULL,NULL,NULL);
INSERT INTO `users` VALUES (19,'Funeraria de prueba','funeraria@fun.com',NULL,'$2y$10$kOECV64wzKzTD5ORJHCksOCsFFQKU3sMvYq2MZa0M5Wz35024pifO',NULL,'2020-10-27 07:07:29','2020-10-28 02:31:03',NULL,'No',7);
INSERT INTO `users` VALUES (20,'TestFunerariaTest','test@fun.com',NULL,'$2y$10$VT9UCeiiBhKYqXJGp668zuitPLv5Jrc6803YoVcto0GXgdjs2i4Hm',NULL,'2020-10-28 03:43:54','2020-10-28 03:44:17',NULL,'Si',8);
INSERT INTO `users` VALUES (21,'Test Edgar','Edgartest@mail.com',NULL,'$2y$10$udccaEOzu8m5Or7bMZgrKu1hqifxAcHbTd22Sa0bBt1UBn4qfFy4q',NULL,'2020-10-29 06:21:11','2020-10-29 06:21:11',NULL,NULL,NULL);
INSERT INTO `users` VALUES (23,'Test Edgar','Edgartest@mails.com',NULL,'$2y$10$VdMJb12O5k5uSdnj4qHDGO/P83ZOFpOFHVE8xs.LIINxPfOR9zkQq',NULL,'2020-10-29 06:29:12','2020-10-29 06:29:12',NULL,NULL,NULL);
INSERT INTO `users` VALUES (24,'test registro','registro@test.com',NULL,'$2y$10$O0RNpnBFYIi1eazAQIEOheVEEAd8ysTWzABFf9qy4N./JMCO4ymBK',NULL,'2020-11-21 01:26:35','2020-11-21 01:26:35',6,NULL,NULL);
INSERT INTO `users` VALUES (27,'test registro','samedgar151@gmail.com',NULL,'$2y$10$tOOckRqu8tSnTuNDgIKxO.eRN.D4pkNa02ZYVS8X47H/gLcgo2Cny',NULL,'2020-11-23 12:02:00','2020-11-23 12:02:00',NULL,NULL,NULL);
INSERT INTO `users` VALUES (28,'Edgar Ambrosio','samedgar15@gmail.com',NULL,'$2y$10$6jJO3h4un1p0pIBlnJq5I./81BAp.iMZwNxKW7Gt.6go/H7XpFPwG',NULL,'2020-11-24 05:17:20','2020-11-24 05:17:20',6,NULL,NULL);
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

-- Dump completed on 2020-12-09 14:39:28
