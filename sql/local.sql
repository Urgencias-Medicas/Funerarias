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
-- Table structure for table `casos`
--

DROP TABLE IF EXISTS `casos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `casos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` int(11) DEFAULT NULL,
  `Nombre` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Causa` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
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
  `Estatus` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Reportar` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Costo` int(11) DEFAULT NULL,
  `Pagado` int(11) DEFAULT NULL,
  `Pendiente` int(11) DEFAULT NULL,
  `Solicitud` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Idioma` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Medico` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Tutor` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `TelTutor` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `DPITutor` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `casos`
--

LOCK TABLES `casos` WRITE;
/*!40000 ALTER TABLE `casos` DISABLE KEYS */;
INSERT INTO `casos` VALUES (3,1,'Estudiante de prueba','2020-09-09','13:50:00','Test','Esto es una prueba','Guatemala','Mixco','Test',NULL,'Test',NULL,NULL,NULL,NULL,'6',6,'Asignado',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (4,2,'Prueba Estudiante','2020-09-09','18:01:00','Esto es una prueba','Test','Guatemala','Mixco','Test',NULL,'Test2',NULL,NULL,NULL,NULL,NULL,6,'Cerrado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (5,5,'Ana Lucía Robles','2020-09-11','20:59:00','Muerte Natural','Prueba de dirección','Petén','Desconocido','Juan Robles',NULL,'Lucía Medina',NULL,NULL,NULL,NULL,NULL,NULL,'Abierto',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (6,4,'Patricia Morales','2020-09-11','19:04:00','Muerte natural','Test','Izabal',NULL,'Prueba',NULL,'Prueba',NULL,NULL,NULL,NULL,NULL,9,'Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (7,1,'Jefferson Morataya','2020-09-11','15:15:00','Accidente','Dirección de prueba Guatemala','Guatemala','Mixco','Test Padre',NULL,'Test Madre',NULL,NULL,NULL,NULL,'Edificio Tikal Futura',6,'Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (8,2,'Luis Medina','2020-09-11','16:44:00','Accidente','Dirección de prueba capital','Guatemala','Guatemala','Test Padre',NULL,'Test Madre',NULL,NULL,NULL,NULL,'Edificio Miraflores',6,'Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (9,5,'Ana Lucía Robles','2020-09-19','10:55:00','Asesinato','Ciudad de Guatemala','Guatemala','Guatemala','Test padre',NULL,'Test madre',NULL,NULL,NULL,NULL,'Boulevard Liberación',6,'Asignado','No',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (10,2,'Luis Medina','2020-09-19','10:10:00','Suicidio','Guatemala','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Test Reporta','Tutor legal','12345678',NULL,6,'Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (11,3,'Carlos Sagastume','2020-09-19','14:55:00','Enfermedad Comun','GUATEMALA','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Edgar Prueba','Tío del estudiante','12345678',NULL,6,'Asignado','Si',1500,900,1600,'Aprobar',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (12,5,'Ana Lucía Robles','2020-10-08','12:19:00','Accidente','CC Miraflores','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Edwin Test','Tutor','12345678','CC Miraflores',6,'Cerrado','No',1900,500,1400,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (13,6,'Juan Antonio Palma','2020-10-08','12:39:00','Accidente','Roosevelt','GUATEMALA','GUATEMALA','Padre Test','12345678','Madre Test','87654321','Reporta test','Tutor','54687213','Edificio Tikal Futura',6,'Asignado','Si',2500,750,1750,'Aprobar',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `casos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_funeraria`
--

LOCK TABLES `detalles_funeraria` WRITE;
/*!40000 ALTER TABLE `detalles_funeraria` DISABLE KEYS */;
INSERT INTO `detalles_funeraria` VALUES (1,'Si','Si','Si');
INSERT INTO `detalles_funeraria` VALUES (2,'Si','Si','No');
INSERT INTO `detalles_funeraria` VALUES (3,'Si','Si','Si');
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
  PRIMARY KEY (`id`),
  KEY `caso` (`caso`),
  CONSTRAINT `historial_pagos_ibfk_1` FOREIGN KEY (`caso`) REFERENCES `casos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_pagos`
--

LOCK TABLES `historial_pagos` WRITE;
/*!40000 ALTER TABLE `historial_pagos` DISABLE KEYS */;
INSERT INTO `historial_pagos` VALUES (1,11,100,'2020-10-08',NULL);
INSERT INTO `historial_pagos` VALUES (2,11,50,'2020-10-07',NULL);
INSERT INTO `historial_pagos` VALUES (3,11,50,'2020-10-08',NULL);
INSERT INTO `historial_pagos` VALUES (4,11,50,'2020-10-01',NULL);
INSERT INTO `historial_pagos` VALUES (5,11,150,'2020-10-02',NULL);
INSERT INTO `historial_pagos` VALUES (6,11,200,'2020-10-05',NULL);
INSERT INTO `historial_pagos` VALUES (7,11,150,'2020-09-01',NULL);
INSERT INTO `historial_pagos` VALUES (8,11,100,'2020-08-05',NULL);
INSERT INTO `historial_pagos` VALUES (9,11,50,'2020-10-07',NULL);
INSERT INTO `historial_pagos` VALUES (10,12,500,'2020-10-08',NULL);
INSERT INTO `historial_pagos` VALUES (11,13,500,'2020-10-08',NULL);
INSERT INTO `historial_pagos` VALUES (12,13,50,'2020-10-08',NULL);
INSERT INTO `historial_pagos` VALUES (13,13,100,'2020-10-13','15216');
INSERT INTO `historial_pagos` VALUES (14,13,100,'2020-10-13','123');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Agente Call Center','agent@callcenter.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','1nPyn4QDB5bUqzPA7LEcoszkFoAwVZlPDCyINUh1Qt5uRMDoBdkzF61nuLSx','2020-09-09 01:57:39','2020-09-09 01:57:39',NULL,NULL,NULL);
INSERT INTO `users` VALUES (2,'Personal UM','personal@um.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','pYcZsh1IAqjWnfZtj2Rwz96QlYWYgAnwBJQScsfMWIyITsvoPm70E7S1yZOD','2020-09-09 01:57:39','2020-09-09 01:57:39',NULL,NULL,NULL);
INSERT INTO `users` VALUES (3,'Funeraria','funeraria@um.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','VsvZwGc7yIJM5lwoyY5cfJZcliiRfTwzLkG2r5y9IHGpYtwPLt5wpsHPUgRF','2020-09-09 01:57:39','2020-09-09 01:57:39',6,'Si',NULL);
INSERT INTO `users` VALUES (4,'test','admin@test.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','rjcMnEygeBpcwY5w1388BPILGeNXWbb41DCqxozh62PS05U5NooHJOcjGgpd','2020-09-09 01:57:39','2020-09-09 01:57:39',NULL,NULL,NULL);
INSERT INTO `users` VALUES (5,'Test Funeraria','funeraria@test.com',NULL,'$2y$10$VUmvDlbOYqPL0qMltjm15OQl1x8G9OpqFCjsGzevKg4ItfXdD1lMK',NULL,'2020-09-17 03:52:58','2020-09-17 06:50:01',1,'Si',1);
INSERT INTO `users` VALUES (6,'Funeraria de prueba','test@funeraria.com',NULL,'$2y$10$UT1HBPPcvbVWlIJ87EzOp.CAcuHdNg/oKp6IPQCpUph4XazgF5PsG',NULL,'2020-09-17 06:48:48','2020-09-17 06:48:48',NULL,'No',2);
INSERT INTO `users` VALUES (7,'Funeraria de prueba','funeraria@guatemala.com',NULL,'$2y$10$XN83vjdtpiVc.CeQB6M14.J4LzGNc0UcyKneOoeCbwIK6pPIdhLaa',NULL,'2020-09-19 23:07:04','2020-09-20 00:10:29',NULL,'No',3);
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

-- Dump completed on 2020-10-14 13:26:32
