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
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,'Import','Look mum, I logged something',NULL,NULL,'App\\User',36,'[]','2021-05-03 20:42:04','2021-05-03 20:42:04');
INSERT INTO `activity_log` VALUES (2,'default','Look mum, I logged something',NULL,NULL,'App\\User',36,'[]','2021-05-03 20:42:50','2021-05-03 20:42:50');
INSERT INTO `activity_log` VALUES (3,'default','El documento patenteComercio fue Aprobado',NULL,NULL,'App\\User',2,'[]','2021-05-03 20:51:11','2021-05-03 20:51:11');
INSERT INTO `activity_log` VALUES (4,'default','El documento rtu fue Denegado',NULL,NULL,'App\\User',2,'[]','2021-05-03 20:51:27','2021-05-03 20:51:27');
INSERT INTO `activity_log` VALUES (5,'default','El documento licenciaSanitaria fue Aprobado en el caso No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-03 20:52:23','2021-05-03 20:52:23');
INSERT INTO `activity_log` VALUES (6,'default','Caso #25 asignado.',NULL,NULL,'App\\User',2,'[]','2021-05-03 20:56:53','2021-05-03 20:56:53');
INSERT INTO `activity_log` VALUES (7,'default','Caso #25 asignado a la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-03 21:04:58','2021-05-03 21:04:58');
INSERT INTO `activity_log` VALUES (8,'default','El documento dpi fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-03 22:24:46','2021-05-03 22:24:46');
INSERT INTO `activity_log` VALUES (9,'default','El documento dpi fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-03 22:25:06','2021-05-03 22:25:06');
INSERT INTO `activity_log` VALUES (10,'default','El documento dpi fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-03 22:26:21','2021-05-03 22:26:21');
INSERT INTO `activity_log` VALUES (11,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-03 22:28:09','2021-05-03 22:28:09');
INSERT INTO `activity_log` VALUES (12,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-03 22:54:09','2021-05-03 22:54:09');
INSERT INTO `activity_log` VALUES (13,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:24:51','2021-05-04 16:24:51');
INSERT INTO `activity_log` VALUES (14,'default','El documento rtu fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:24:53','2021-05-04 16:24:53');
INSERT INTO `activity_log` VALUES (15,'default','El documento manipulacionAlimentos fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:24:55','2021-05-04 16:24:55');
INSERT INTO `activity_log` VALUES (16,'default','El documento licManipulacionCuerpos fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:24:56','2021-05-04 16:24:56');
INSERT INTO `activity_log` VALUES (17,'default','El documento certManipulacionCuerpos fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:24:58','2021-05-04 16:24:58');
INSERT INTO `activity_log` VALUES (18,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:27:29','2021-05-04 16:27:29');
INSERT INTO `activity_log` VALUES (19,'default','El documento rtu fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:27:56','2021-05-04 16:27:56');
INSERT INTO `activity_log` VALUES (20,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:28:41','2021-05-04 16:28:41');
INSERT INTO `activity_log` VALUES (21,'default','El documento rtu fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:31:20','2021-05-04 16:31:20');
INSERT INTO `activity_log` VALUES (22,'default','El documento bioinfecciosos fue Aprobado para la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 16:31:23','2021-05-04 16:31:23');
INSERT INTO `activity_log` VALUES (23,'default','Se ha modificado la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 17:35:11','2021-05-04 17:35:11');
INSERT INTO `activity_log` VALUES (24,'default','Se ha modificado la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 17:35:32','2021-05-04 17:35:32');
INSERT INTO `activity_log` VALUES (25,'default','Se ha modificado la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 17:38:20','2021-05-04 17:38:20');
INSERT INTO `activity_log` VALUES (26,'default','Se ha modificado la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 17:39:08','2021-05-04 17:39:08');
INSERT INTO `activity_log` VALUES (27,'default','Se ha modificado la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:00:30','2021-05-04 21:00:30');
INSERT INTO `activity_log` VALUES (28,'default','Se ha modificado la funeraria No. 38',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:14:31','2021-05-04 21:14:31');
INSERT INTO `activity_log` VALUES (29,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:23:53','2021-05-04 21:23:53');
INSERT INTO `activity_log` VALUES (30,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:25:12','2021-05-04 21:25:12');
INSERT INTO `activity_log` VALUES (31,'default','El documento patenteComercio fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:05','2021-05-04 21:26:05');
INSERT INTO `activity_log` VALUES (32,'default','El documento dpi fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:07','2021-05-04 21:26:07');
INSERT INTO `activity_log` VALUES (33,'default','El documento licenciaSanitaria fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:08','2021-05-04 21:26:08');
INSERT INTO `activity_log` VALUES (34,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:17','2021-05-04 21:26:17');
INSERT INTO `activity_log` VALUES (35,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:27','2021-05-04 21:26:27');
INSERT INTO `activity_log` VALUES (36,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:35','2021-05-04 21:26:35');
INSERT INTO `activity_log` VALUES (37,'default','El documento rtu fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:38','2021-05-04 21:26:38');
INSERT INTO `activity_log` VALUES (38,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:41','2021-05-04 21:26:41');
INSERT INTO `activity_log` VALUES (39,'default','El documento licenciaSanitaria fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:47','2021-05-04 21:26:47');
INSERT INTO `activity_log` VALUES (40,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:26:50','2021-05-04 21:26:50');
INSERT INTO `activity_log` VALUES (41,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:30:07','2021-05-04 21:30:07');
INSERT INTO `activity_log` VALUES (42,'default','El documento licenciaSanitaria fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:30:09','2021-05-04 21:30:09');
INSERT INTO `activity_log` VALUES (43,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:30:12','2021-05-04 21:30:12');
INSERT INTO `activity_log` VALUES (44,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:31:25','2021-05-04 21:31:25');
INSERT INTO `activity_log` VALUES (45,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:31:34','2021-05-04 21:31:34');
INSERT INTO `activity_log` VALUES (46,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:31:46','2021-05-04 21:31:46');
INSERT INTO `activity_log` VALUES (47,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:32:01','2021-05-04 21:32:01');
INSERT INTO `activity_log` VALUES (48,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:32:43','2021-05-04 21:32:43');
INSERT INTO `activity_log` VALUES (49,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:32:48','2021-05-04 21:32:48');
INSERT INTO `activity_log` VALUES (50,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:33:09','2021-05-04 21:33:09');
INSERT INTO `activity_log` VALUES (51,'default','El documento dpi fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:36:52','2021-05-04 21:36:52');
INSERT INTO `activity_log` VALUES (52,'default','El documento rtu fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:36:54','2021-05-04 21:36:54');
INSERT INTO `activity_log` VALUES (53,'default','El documento licenciaSanitaria fue Aprobado para la funeraria No. 39',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:36:55','2021-05-04 21:36:55');
INSERT INTO `activity_log` VALUES (54,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:45:19','2021-05-04 21:45:19');
INSERT INTO `activity_log` VALUES (55,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:45:39','2021-05-04 21:45:39');
INSERT INTO `activity_log` VALUES (56,'default','El documento patenteComercio fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:45:50','2021-05-04 21:45:50');
INSERT INTO `activity_log` VALUES (57,'default','Se creo el nuevo caso No. 27',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:50:51','2021-05-04 21:50:51');
INSERT INTO `activity_log` VALUES (58,'default','Se ha creado la campañia Nueva campaña',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:54:15','2021-05-04 21:54:15');
INSERT INTO `activity_log` VALUES (59,'default','Caso #27 asignado a la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-04 21:56:06','2021-05-04 21:56:06');
INSERT INTO `activity_log` VALUES (60,'default','El hizo una solicitud para actualizar el costo del caso No. 27',NULL,NULL,'App\\User',5,'[]','2021-05-04 21:59:24','2021-05-04 21:59:24');
INSERT INTO `activity_log` VALUES (61,'default','La solicitud del caso #27 ha sido aprobada.',NULL,NULL,'App\\User',2,'[]','2021-05-04 22:00:48','2021-05-04 22:00:48');
INSERT INTO `activity_log` VALUES (62,'default','Se ha ingresado un nuevo pago en el caso No. {\"id\":27,\"Agente\":2,\"Codigo\":5,\"Nombre\":\"Ana Luc\\u00eda Robles\",\"Edad\":18,\"Aseguradora\":\"7\",\"Fecha\":\"2021-05-04\",\"Hora\":\"09:54:00\",\"Causa\":\"Suicidio\",\"Causa_Desc\":\"Test de causa\",\"Causa_Especifica\":\"Paro cardiorespiratorio por suspensi\\u00f3n\",\"Direccion\":\"12av el bosque 2-56 zona 11 de Mixco\",\"Departamento\":\"GUATEMALA\",\"Municipio\":\"GUATEMALA CITY\",\"Padre\":\"Juan Robles\",\"TelPadre\":\"15181818\",\"Madre\":\"Luc\\u00eda Medina\",\"TelMadre\":\"15151515\",\"NombreReporta\":\"Doctor Juan Alberto Garc\\u00eda\",\"RelacionReporta\":\"Doctor\",\"TelReporta\":\"41465939\",\"Lugar\":\"En su hogar\",\"Funeraria\":1,\"Funeraria_Nombre\":\"Funeraria La Piedad\",\"Estatus\":\"Asignado\",\"Reportar\":\"No\",\"Costo\":6000,\"Moneda\":\"GTQ\",\"Pagado\":1000,\"Pendiente\":5000,\"Solicitud\":\"Aprobar\",\"Idioma\":\"Espa\\u00f1ol\",\"Medico\":\"Edgar\",\"Tutor\":\"Hilario Menendez\",\"ParentescoTutor\":\"Maestro\",\"EmailTutor\":\"samuelambrosio99@gmail.com\",\"Comentario\":\"Test\",\"TelTutor\":\"49750995\",\"DPITutor\":\"3029999810108\",\"Evaluacion\":null}',NULL,NULL,'App\\User',2,'[]','2021-05-04 22:01:47','2021-05-04 22:01:47');
INSERT INTO `activity_log` VALUES (63,'default','El caso No. 27 se reportará Si',NULL,NULL,'App\\User',2,'[]','2021-05-04 22:03:08','2021-05-04 22:03:08');
INSERT INTO `activity_log` VALUES (64,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:29:02','2021-05-06 01:29:02');
INSERT INTO `activity_log` VALUES (65,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:29:20','2021-05-06 01:29:20');
INSERT INTO `activity_log` VALUES (66,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:29:41','2021-05-06 01:29:41');
INSERT INTO `activity_log` VALUES (67,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:29:48','2021-05-06 01:29:48');
INSERT INTO `activity_log` VALUES (68,'default','El documento bioinfecciosos fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:29:53','2021-05-06 01:29:53');
INSERT INTO `activity_log` VALUES (69,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:36:10','2021-05-06 01:36:10');
INSERT INTO `activity_log` VALUES (70,'default','El documento licenciaSanitaria fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:36:42','2021-05-06 01:36:42');
INSERT INTO `activity_log` VALUES (71,'default','El documento rtu fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:44:15','2021-05-06 01:44:15');
INSERT INTO `activity_log` VALUES (72,'default','El documento dpi fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 01:44:31','2021-05-06 01:44:31');
INSERT INTO `activity_log` VALUES (73,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 40',NULL,NULL,'App\\User',2,'[]','2021-05-06 02:45:39','2021-05-06 02:45:39');
INSERT INTO `activity_log` VALUES (74,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 41',NULL,NULL,'App\\User',2,'[]','2021-05-06 02:49:44','2021-05-06 02:49:44');
INSERT INTO `activity_log` VALUES (75,'default','El documento patenteComercio fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 02:50:25','2021-05-06 02:50:25');
INSERT INTO `activity_log` VALUES (76,'default','El documento dpi fue Aprobado para la funeraria No. 41',NULL,NULL,'App\\User',2,'[]','2021-05-06 02:50:28','2021-05-06 02:50:28');
INSERT INTO `activity_log` VALUES (77,'default','El documento licenciaSanitaria fue Aprobado para la funeraria No. 41',NULL,NULL,'App\\User',2,'[]','2021-05-06 02:50:30','2021-05-06 02:50:30');
INSERT INTO `activity_log` VALUES (78,'default','El documento rtu fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-06 02:50:40','2021-05-06 02:50:40');
INSERT INTO `activity_log` VALUES (79,'default','El documento patenteComercio fue Aprobado para la funeraria No. 41',NULL,NULL,'App\\User',2,'[]','2021-05-06 02:52:14','2021-05-06 02:52:14');
INSERT INTO `activity_log` VALUES (80,'default','El documento rtu fue Aprobado para la funeraria No. 41',NULL,NULL,'App\\User',2,'[]','2021-05-06 02:52:16','2021-05-06 02:52:16');
INSERT INTO `activity_log` VALUES (81,'default','Caso #26 modificado.',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:53:52','2021-05-08 03:53:52');
INSERT INTO `activity_log` VALUES (82,'default','Caso #26 asignado a la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:54:03','2021-05-08 03:54:03');
INSERT INTO `activity_log` VALUES (83,'default','Se ha creado un nuevo usuario con el siguiente email esamuelambrosio99@gmail.com',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:54:30','2021-05-08 03:54:30');
INSERT INTO `activity_log` VALUES (84,'default','Se ha ingresado un nuevo pago en el caso No. 27',NULL,NULL,'App\\User',42,'[]','2021-05-08 03:55:35','2021-05-08 03:55:35');
INSERT INTO `activity_log` VALUES (85,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 43',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:57:56','2021-05-08 03:57:56');
INSERT INTO `activity_log` VALUES (86,'default','El documento patenteComercio fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:58:03','2021-05-08 03:58:03');
INSERT INTO `activity_log` VALUES (87,'default','El documento rtu fue Aprobado para la funeraria No. 43',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:58:05','2021-05-08 03:58:05');
INSERT INTO `activity_log` VALUES (88,'default','El documento dpi fue Aprobado para la funeraria No. 43',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:58:07','2021-05-08 03:58:07');
INSERT INTO `activity_log` VALUES (89,'default','El documento licenciaSanitaria fue Aprobado para la funeraria No. 43',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:58:08','2021-05-08 03:58:08');
INSERT INTO `activity_log` VALUES (90,'default','El documento patenteComercio fue Aprobado para la funeraria No. 43',NULL,NULL,'App\\User',2,'[]','2021-05-08 03:58:28','2021-05-08 03:58:28');
INSERT INTO `activity_log` VALUES (91,'default','Caso #27 asignado a la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-08 04:13:42','2021-05-08 04:13:42');
INSERT INTO `activity_log` VALUES (92,'default','Se ha ingresado un nuevo pago en el caso No. 27',NULL,NULL,'App\\User',42,'[]','2021-05-08 04:15:28','2021-05-08 04:15:28');
INSERT INTO `activity_log` VALUES (93,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 44',NULL,NULL,'App\\User',2,'[]','2021-05-08 04:24:19','2021-05-08 04:24:19');
INSERT INTO `activity_log` VALUES (94,'default','El documento patenteComercio fue Denegado para la funeraria No. 6',NULL,NULL,'App\\User',2,'[]','2021-05-08 04:24:26','2021-05-08 04:24:26');
INSERT INTO `activity_log` VALUES (95,'default','El documento rtu fue Aprobado para la funeraria No. 44',NULL,NULL,'App\\User',2,'[]','2021-05-08 04:24:29','2021-05-08 04:24:29');
INSERT INTO `activity_log` VALUES (96,'default','El documento dpi fue Aprobado para la funeraria No. 44',NULL,NULL,'App\\User',2,'[]','2021-05-08 04:24:31','2021-05-08 04:24:31');
INSERT INTO `activity_log` VALUES (97,'default','El documento licenciaSanitaria fue Aprobado para la funeraria No. 44',NULL,NULL,'App\\User',2,'[]','2021-05-08 04:24:33','2021-05-08 04:24:33');
INSERT INTO `activity_log` VALUES (98,'default','El documento patenteComercio fue Aprobado para la funeraria No. 44',NULL,NULL,'App\\User',2,'[]','2021-05-08 04:25:08','2021-05-08 04:25:08');
INSERT INTO `activity_log` VALUES (99,'default','Se ha creado la campañia SeguRed',NULL,NULL,'App\\User',2,'[]','2021-05-11 15:48:12','2021-05-11 15:48:12');
INSERT INTO `activity_log` VALUES (100,'default','Se ha modificado la funeraria No. 3',NULL,NULL,'App\\User',2,'[]','2021-05-11 15:48:26','2021-05-11 15:48:26');
INSERT INTO `activity_log` VALUES (101,'default','Se ha modificado la funeraria No. 3',NULL,NULL,'App\\User',2,'[]','2021-05-11 15:58:34','2021-05-11 15:58:34');
INSERT INTO `activity_log` VALUES (102,'default','Se ha modificado la funeraria No. 3',NULL,NULL,'App\\User',2,'[]','2021-05-11 15:59:11','2021-05-11 15:59:11');
INSERT INTO `activity_log` VALUES (103,'default','Se ha modificado la funeraria No. 3',NULL,NULL,'App\\User',2,'[]','2021-05-11 15:59:31','2021-05-11 15:59:31');
INSERT INTO `activity_log` VALUES (104,'default','Se ha modificado la funeraria No. 3',NULL,NULL,'App\\User',2,'[]','2021-05-11 15:59:38','2021-05-11 15:59:38');
INSERT INTO `activity_log` VALUES (105,'default','Se ha modificado la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-11 16:00:27','2021-05-11 16:00:27');
INSERT INTO `activity_log` VALUES (106,'default','Se ha modificado la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-11 16:01:03','2021-05-11 16:01:03');
INSERT INTO `activity_log` VALUES (107,'default','Se ha modificado la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-11 16:01:42','2021-05-11 16:01:42');
INSERT INTO `activity_log` VALUES (108,'default','Se ha modificado la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-11 16:01:58','2021-05-11 16:01:58');
INSERT INTO `activity_log` VALUES (109,'default','Se ha modificado la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-11 21:18:12','2021-05-11 21:18:12');
INSERT INTO `activity_log` VALUES (110,'default','Se ha modificado la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-11 21:18:25','2021-05-11 21:18:25');
INSERT INTO `activity_log` VALUES (111,'default','Caso #27 modificado.',NULL,NULL,'App\\User',2,'[]','2021-05-14 23:35:17','2021-05-14 23:35:17');
INSERT INTO `activity_log` VALUES (112,'default','Caso #27 modificado.',NULL,NULL,'App\\User',2,'[]','2021-05-14 23:35:45','2021-05-14 23:35:45');
INSERT INTO `activity_log` VALUES (113,'default','Caso #27 modificado.',NULL,NULL,'App\\User',2,'[]','2021-05-14 23:38:18','2021-05-14 23:38:18');
INSERT INTO `activity_log` VALUES (114,'default','Caso #27 modificado.',NULL,NULL,'App\\User',2,'[]','2021-05-14 23:38:23','2021-05-14 23:38:23');
INSERT INTO `activity_log` VALUES (115,'default','Se subió el archivo Caso27-nuevotest-Personal UM-20210514.txt por el usuario Personal UM al caso #27',NULL,NULL,'App\\User',2,'[]','2021-05-15 01:41:12','2021-05-15 01:41:12');
INSERT INTO `activity_log` VALUES (116,'default','Se creo el nuevo caso No. 28',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:36:32','2021-05-15 02:36:32');
INSERT INTO `activity_log` VALUES (117,'default','Se subió el archivo Caso28-nuevotest-Personal UM-20210514.txt al caso #28',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:37:18','2021-05-15 02:37:18');
INSERT INTO `activity_log` VALUES (118,'default','Se subió el archivo Caso28-test-de-estrés-Personal UM-20210514.png al caso #28',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:37:20','2021-05-15 02:37:20');
INSERT INTO `activity_log` VALUES (119,'default','Caso #28 asignado a la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:38:21','2021-05-15 02:38:21');
INSERT INTO `activity_log` VALUES (120,'default','Se ha modificado la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:39:40','2021-05-15 02:39:40');
INSERT INTO `activity_log` VALUES (121,'default','Se ha ingresado un nuevo pago en el caso No. 28',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:39:57','2021-05-15 02:39:57');
INSERT INTO `activity_log` VALUES (122,'default','Se ha creado la campañia SeguRed',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:47:23','2021-05-15 02:47:23');
INSERT INTO `activity_log` VALUES (123,'default','Se ha eliminado la campañia No. 8',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:47:30','2021-05-15 02:47:30');
INSERT INTO `activity_log` VALUES (124,'default','Se ha modificado la funeraria No. 1',NULL,NULL,'App\\User',2,'[]','2021-05-15 02:47:55','2021-05-15 02:47:55');
INSERT INTO `activity_log` VALUES (125,'default','Se ha ingresado un nuevo pago en el caso No. 28',NULL,NULL,'App\\User',2,'[]','2021-05-15 03:16:40','2021-05-15 03:16:40');
INSERT INTO `activity_log` VALUES (126,'default','Se ha modificado la funeraria No. 33',NULL,NULL,'App\\User',2,'[]','2021-05-16 05:40:57','2021-05-16 05:40:57');
INSERT INTO `activity_log` VALUES (127,'default','Se ha modificado la funeraria No. 19',NULL,NULL,'App\\User',2,'[]','2021-05-16 05:43:34','2021-05-16 05:43:34');
INSERT INTO `activity_log` VALUES (128,'default','Se ha modificado la funeraria No. 19',NULL,NULL,'App\\User',2,'[]','2021-05-16 05:43:37','2021-05-16 05:43:37');
INSERT INTO `activity_log` VALUES (129,'default','Se ha modificado la funeraria No. 34',NULL,NULL,'App\\User',2,'[]','2021-05-16 08:01:28','2021-05-16 08:01:28');
INSERT INTO `activity_log` VALUES (130,'default','Se ha modificado la funeraria No. 34',NULL,NULL,'App\\User',2,'[]','2021-05-16 08:12:53','2021-05-16 08:12:53');
INSERT INTO `activity_log` VALUES (131,'default','Se ha modificado la funeraria No. 32',NULL,NULL,'App\\User',2,'[]','2021-05-17 00:19:36','2021-05-17 00:19:36');
INSERT INTO `activity_log` VALUES (132,'default','Se ha modificado la funeraria No. 40',NULL,NULL,'App\\User',2,'[]','2021-05-17 00:20:17','2021-05-17 00:20:17');
INSERT INTO `activity_log` VALUES (133,'default','Se ha modificado la funeraria No. 41',NULL,NULL,'App\\User',2,'[]','2021-05-17 06:45:13','2021-05-17 06:45:13');
INSERT INTO `activity_log` VALUES (134,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 06:49:44','2021-05-17 06:49:44');
INSERT INTO `activity_log` VALUES (135,'default','Se ha modificado la funeraria No. 43',NULL,NULL,'App\\User',2,'[]','2021-05-17 06:57:10','2021-05-17 06:57:10');
INSERT INTO `activity_log` VALUES (136,'default','Se ha modificado la funeraria No. 44',NULL,NULL,'App\\User',2,'[]','2021-05-17 06:59:09','2021-05-17 06:59:09');
INSERT INTO `activity_log` VALUES (137,'default','Se ha modificado la funeraria No. 44',NULL,NULL,'App\\User',2,'[]','2021-05-17 06:59:32','2021-05-17 06:59:32');
INSERT INTO `activity_log` VALUES (138,'default','Se ha modificado la funeraria No. 35',NULL,NULL,'App\\User',2,'[]','2021-05-17 07:10:30','2021-05-17 07:10:30');
INSERT INTO `activity_log` VALUES (139,'default','Se ha modificado la funeraria No. 7',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:18:05','2021-05-17 20:18:05');
INSERT INTO `activity_log` VALUES (140,'default','Se ha modificado la funeraria No. 40',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:24:14','2021-05-17 20:24:14');
INSERT INTO `activity_log` VALUES (141,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:28:21','2021-05-17 20:28:21');
INSERT INTO `activity_log` VALUES (142,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:29:57','2021-05-17 20:29:57');
INSERT INTO `activity_log` VALUES (143,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:34:41','2021-05-17 20:34:41');
INSERT INTO `activity_log` VALUES (144,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:35:30','2021-05-17 20:35:30');
INSERT INTO `activity_log` VALUES (145,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:42:37','2021-05-17 20:42:37');
INSERT INTO `activity_log` VALUES (146,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:43:08','2021-05-17 20:43:08');
INSERT INTO `activity_log` VALUES (147,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:47:08','2021-05-17 20:47:08');
INSERT INTO `activity_log` VALUES (148,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:47:11','2021-05-17 20:47:11');
INSERT INTO `activity_log` VALUES (149,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:50:09','2021-05-17 20:50:09');
INSERT INTO `activity_log` VALUES (150,'default','Se ha modificado la funeraria No. 36',NULL,NULL,'App\\User',2,'[]','2021-05-17 20:50:18','2021-05-17 20:50:18');
INSERT INTO `activity_log` VALUES (151,'default','Se ha ingresado un nuevo pago en el caso No. {\"id\":28,\"Agente\":2,\"Codigo\":15,\"Nombre\":\"Ana Luc\\u00eda Lopez\",\"Edad\":15,\"Aseguradora\":\"7\",\"Fecha\":\"2021-05-14\",\"Hora\":\"15:15:00\",\"Causa\":\"Suicidio\",\"Causa_Desc\":\"Test de causa\",\"Causa_Especifica\":\"Paro cardiorespiratorio por suspensi\\u00f3n\",\"Direccion\":\"12av el bosque 2-56 zona 11 de Mixco\",\"Departamento\":\"GUATEMALA\",\"Municipio\":\"GUATEMALA CITY\",\"Padre\":\"Juan Robles\",\"TelPadre\":\"81848484\",\"Madre\":\"Luc\\u00eda Medina\",\"TelMadre\":\"15151515\",\"NombreReporta\":\"Doctor Juan Alberto Garc\\u00eda\",\"RelacionReporta\":\"Doctor\",\"TelReporta\":\"49750995\",\"Lugar\":\"En su hogar\",\"Funeraria\":1,\"Funeraria_Nombre\":\"Funeraria La Piedad\",\"Estatus\":\"Asignado\",\"Reportar\":\"No\",\"Costo\":1000,\"Moneda\":\"USD\",\"Pagado\":800,\"Pendiente\":200,\"Solicitud\":null,\"Idioma\":\"Espa\\u00f1ol\",\"Medico\":\"Edgar\",\"Tutor\":\"Hilario Menendez\",\"ParentescoTutor\":\"Maestro\",\"EmailTutor\":\"samuelambrosio99@gmail.com\",\"Comentario\":\"test\",\"TelTutor\":\"49750995\",\"DPITutor\":\"3029999810108\",\"Evaluacion\":null,\"Certificado\":null,\"Poliza\":null,\"TipoAsegurado\":null}',NULL,NULL,'App\\User',2,'[]','2021-05-18 01:34:01','2021-05-18 01:34:01');
INSERT INTO `activity_log` VALUES (152,'default','Se ha ingresado un nuevo pago en el caso No. 28',NULL,NULL,'App\\User',2,'[]','2021-05-18 01:35:48','2021-05-18 01:35:48');
INSERT INTO `activity_log` VALUES (153,'default','Se ha ingresado un nuevo pago en el caso No. 28',NULL,NULL,'App\\User',2,'[]','2021-05-18 01:39:46','2021-05-18 01:39:46');
INSERT INTO `activity_log` VALUES (154,'default','Se ha ingresado un nuevo pago en el caso No. 28',NULL,NULL,'App\\User',2,'[]','2021-05-18 01:41:47','2021-05-18 01:41:47');
INSERT INTO `activity_log` VALUES (155,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 41',NULL,NULL,'App\\User',2,'[]','2021-05-18 02:22:05','2021-05-18 02:22:05');
INSERT INTO `activity_log` VALUES (156,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 41',NULL,NULL,'App\\User',2,'[]','2021-05-18 02:29:51','2021-05-18 02:29:51');
INSERT INTO `activity_log` VALUES (157,'default','El documento licenciaAmbiental fue Aprobado para la funeraria No. 43',NULL,NULL,'App\\User',2,'[]','2021-05-18 02:31:28','2021-05-18 02:31:28');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

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
  `Moneda` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campanias`
--

LOCK TABLES `campanias` WRITE;
/*!40000 ALTER TABLE `campanias` DISABLE KEYS */;
INSERT INTO `campanias` VALUES (2,'Test campaña',7,'Aseguradora Prueba','GTQ');
INSERT INTO `campanias` VALUES (3,'Test campaña 2',36,'Test 2','GTQ');
INSERT INTO `campanias` VALUES (4,'Test usd',1235,'TEst','USD');
INSERT INTO `campanias` VALUES (5,'Campaña nueva',7,'Aseguradora Prueba','USD');
INSERT INTO `campanias` VALUES (6,'Nueva campaña',7,'Aseguradora Prueba','GTQ');
INSERT INTO `campanias` VALUES (7,'SeguRed',7,'Segured','GTQ');
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
  `Funeraria_Nombre` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Estatus` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Reportar` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `Costo` int(11) DEFAULT NULL,
  `Moneda` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
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
  `Certificado` text COLLATE utf8_persian_ci,
  `Poliza` text COLLATE utf8_persian_ci,
  `TipoAsegurado` text COLLATE utf8_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `casos`
--

LOCK TABLES `casos` WRITE;
/*!40000 ALTER TABLE `casos` DISABLE KEYS */;
INSERT INTO `casos` VALUES (3,NULL,1,'Estudiante de prueba',NULL,NULL,'2020-09-09','13:50:00','Test',NULL,NULL,'Esto es una prueba','GUATEMALA','MIXCO','Test',NULL,'Test',NULL,NULL,NULL,NULL,'6',6,'Funerales  El Roble','Asignado','No',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (4,NULL,2,'Prueba Estudiante',NULL,NULL,'2020-09-09','18:01:00','Esto es una prueba',NULL,NULL,'Test','GUATEMALA','MIXCO','Test',NULL,'Test2',NULL,NULL,NULL,NULL,NULL,6,'Funerales  El Roble','Cerrado','No',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (5,NULL,5,'Ana Lucía Robles',15,NULL,'2020-09-11','20:59:00','Accidente','Test de causa',NULL,'Prueba de dirección','PETEN','DESCONOCIDO','Juan Robles',NULL,'Lucía Medina',NULL,NULL,NULL,NULL,NULL,1,'Funeraria La Piedad','Asignado','No',1000,'USD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (6,NULL,4,'Patricia Morales',NULL,NULL,'2020-09-11','19:04:00','Muerte natural',NULL,NULL,'Test','IZABAL','TEST','Prueba',NULL,'Prueba',NULL,NULL,NULL,NULL,NULL,9,'Funeraria dos','Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (7,NULL,1,'Jefferson Morataya',NULL,NULL,'2020-09-11','15:15:00','Accidente',NULL,NULL,'Dirección de prueba Guatemala','GUATEMALA','Mixco','Test Padre',NULL,'Test Madre',NULL,NULL,NULL,NULL,'Edificio Tikal Futura',6,'Funerales  El Roble','Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (8,NULL,2,'Luis Medina',NULL,NULL,'2020-09-11','16:44:00','Accidente',NULL,NULL,'Dirección de prueba capital','GUATEMALA','GUATEMALA','Test Padre',NULL,'Test Madre',NULL,NULL,NULL,NULL,'Edificio Miraflores',6,'Funerales  El Roble','Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (9,NULL,5,'Ana Lucía Robles',NULL,NULL,'2020-09-19','10:55:00','Asesinato',NULL,NULL,'Ciudad de Guatemala','GUATEMALA','GUATEMALA','Test padre',NULL,'Test madre',NULL,NULL,NULL,NULL,'Boulevard Liberación',6,'Funerales  El Roble','Asignado','No',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (10,NULL,2,'Luis Medina',NULL,NULL,'2020-09-19','10:10:00','Suicidio',NULL,NULL,'Guatemala','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Test Reporta','Tutor legal','12345678',NULL,6,'Funerales  El Roble','Asignado','Si',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (11,NULL,3,'Carlos Sagastume',NULL,NULL,'2020-09-19','14:55:00','Enfermedad Comun',NULL,NULL,'GUATEMALA','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Edgar Prueba','Tío del estudiante','12345678',NULL,6,'Funerales  El Roble','Asignado','Si',1500,NULL,900,1600,'Pendiente',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (12,NULL,5,'Ana Lucía Robles',NULL,NULL,'2020-10-08','12:19:00','Accidente',NULL,NULL,'CC Miraflores','GUATEMALA','GUATEMALA',NULL,NULL,NULL,NULL,'Edwin Test','Tutor','12345678','CC Miraflores',6,'Funerales  El Roble','Cerrado','No',1900,NULL,500,1400,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (13,NULL,6,'Juan Antonio Palma',NULL,NULL,'2020-10-08','12:39:00','Suicidio','Test de causa',NULL,'Roosevelt','GUATEMALA','GUATEMALA','Padre Test','12345678','Madre Test','87654321','Reporta test2','Tutor','54687213','Edificio Tikal Futura',6,'Funerales  El Roble','Asignado','Si',2500,NULL,1864,636,'Pendiente',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9.5,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (14,NULL,9,'Rosa Mendoza',NULL,NULL,'2020-10-26','19:19:00','Accidente',NULL,NULL,'Test','GUATEMALA','GUATEMALA','Test','12345678','Test','12345678','Edgar Ambrosio','Tester','12345678',NULL,6,'Funerales  El Roble','Cerrado','Si',2000,NULL,1200,800,'Aprobar','Español','Test',NULL,NULL,NULL,'Sin comentarios',NULL,NULL,8,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (15,NULL,8,'Silvia Arévalo',NULL,NULL,'2020-10-27','15:15:00','Accidente',NULL,NULL,'Test','GUATEMALA','GUATEMALA','Test Padre','12345678','Madre Test','12345678','Edgar Test','Doctor','85481813',NULL,6,'Funerales  El Roble','Cerrado','Si',1500,NULL,600,900,'Declinar','Español','Edgar Test',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (16,NULL,5,'Ana Lucía Robles',NULL,NULL,'2020-10-27','16:10:00','Accidente',NULL,NULL,'Test','GUATEMALA','GUATEMALA','test','12138485','test','41414548','Edgar test','Test','15848415',NULL,NULL,NULL,'Cerrado','No',NULL,NULL,NULL,NULL,NULL,'Español','Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (17,2,5,'Ana Lucía Robles',NULL,NULL,'2020-11-14','15:00:00','Accidente','nueva causa 2',NULL,'test','GUATEMALA','GUATEMALA','test','18515815','test','18718185','test','test','15151818',NULL,6,'Funerales  El Roble','Asignado','No',5184,NULL,NULL,NULL,NULL,'Español','test',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (18,2,5,'Ana Lucía Robles',15,NULL,'2020-11-14','15:00:00','Accidente','test nuevo',NULL,'test','GUATEMALA','GUATEMALA','test','54141515','test','15151515','test','test','51515151',NULL,6,'Funerales  El Roble','Asignado','No',1500,NULL,NULL,NULL,'Declinar','Español','Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (19,2,5,'Ana Lucía Robles',12,'7','2020-11-14','15:00:00','Accidente','test nuevo 4','test','test234','PETEN','SAN JOSE','test','11111111','test','15185185','test3','test2','12345678','testtest',26,'\"Funeraria \"\"El Buen Pastor\"\"\"','Cerrado','Si',0,NULL,1415,-1415,NULL,'Española','Tests','testt','15151','155151','test','15151','1515',NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (20,2,15051,'Test Estudiante',15,'7','2020-11-23','15:03:00','Accidente','Se ahorcó test','Se colgó','test','GUATEMALA','GUATEMALA','test','15181818','test','18181818','test','test','15151515',NULL,6,'Funerales  El Roble','Cerrado','No',5184,NULL,NULL,NULL,NULL,'Español','Test',NULL,NULL,NULL,'Ninguno',NULL,NULL,8,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (21,2,15154,'Test',15,'7','2020-11-24','15:15:00','Accidente','Test de causa','test','test','GUATEMALA','MIXCO','test','51515151','test','15151515','test','test','15151515',NULL,6,'Funerales  El Roble','Asignado','No',1500,NULL,3600,-2100,NULL,'Español','test',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (22,2,1515,'test',18,'7','2020-11-05','15:15:00','Accidente','Test de causa','test','test','JUTIAPA','SAN JOSE ACATEMPA','test','15151515','test','15151515','test','test','15151515',NULL,1,'Funeraria La Piedad','Asignado','No',5000,'GTQ',NULL,NULL,NULL,'test','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (23,2,6,'Juan Antonio Palma',25,'7','2021-04-16','15:01:00','Accidente','asdasdad','Test','12av el bosque 2-56 zona 11 de Mixco','GUATEMALA','GUATEMALA CITY','Juan Robles','12341854','Susana Robles','12515151','Doctor Juan Alberto García','Doctor','15158484','En su hogar',1,'Funeraria La Piedad','Asignado','No',5000,'GTQ',NULL,NULL,NULL,'Español','Edgar','Hilario Menendez','Maestro','samuelambrosio99@gmail.com','Test','49750995','3029999810108',NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (24,2,1516,'Estudiante Fallecido',6,'7','2021-04-16','15:01:00','Accidente','Test de causa','falleció','12av el bosque 2-56 zona 11 de Mixco','GUATEMALA','GUATEMALA CITY','Test Padre','15684818','Test Madre','18185151','Doctor Juan Alberto García','Doctor','15251545','En su hogar',1,'Funeraria La Piedad','Asignado','No',500,'USD',NULL,NULL,NULL,'Español','Edgar','Hilario Menendez','Maestro','samuelambrosio99@gmail.com','Test','49750995','3029999810108',NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (25,2,5,'Ana Lucía Robles',18,'7','2021-04-30','15:15:00','Accidente','Test de causa','Paro cardiorespiratorio por suspensión','12av el bosque 2-56 zona 11 de Mixco','GUATEMALA','GUATEMALA CITY','test','15181818','test','18181818','Doctor Juan Alberto García','Doctor','41465939','En su hogar',1,'Funeraria La Piedad','Asignado','No',5000,'GTQ',NULL,NULL,NULL,'Español','Edgar','Hilario Menendez','Maestro','samuelambrosio99@gmail.com','Test','49750995','3029999810108',NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (26,NULL,50125912,'Estudiante API',15,NULL,'2021-05-07',NULL,'Accidente','Test de causa',NULL,'Km 34 Carretera al Pacifico','ESCUINTLA','PALIN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'Funeraria La Piedad','Asignado',NULL,1000,'USD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `casos` VALUES (27,2,5,'Ana Lucía Robles',18,'7','2021-05-14',NULL,'Suicidio','Test de causa','Paro cardiorespiratorio por suspensión','12av el bosque 2-56 zona 11 de Mixco','GUATEMALA','GUATEMALA CITY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'En su hogar',1,'Funeraria La Piedad','Asignado','Si',5000,'GTQ',5000,0,'Aprobar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1515','123','Dependiente');
INSERT INTO `casos` VALUES (28,2,15,'Ana Lucía Lopez',15,'7','2021-05-14','15:15:00','Suicidio','Test de causa','Paro cardiorespiratorio por suspensión','12av el bosque 2-56 zona 11 de Mixco','GUATEMALA','GUATEMALA CITY','Juan Robles','81848484','Lucía Medina','15151515','Doctor Juan Alberto García','Doctor','49750995','En su hogar',1,'Funeraria La Piedad','Asignado','No',1000,'USD',925,75,NULL,'Español','Edgar','Hilario Menendez','Maestro','samuelambrosio99@gmail.com','test','49750995','3029999810108',NULL,NULL,NULL,NULL);
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
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcion` text NOT NULL,
  `valor` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'Tasa_Cambio','7.88');
INSERT INTO `configuracion` VALUES (2,'Campos_Check','[{\"campo\":\"1\",\"nombre\":\"Check 1\"}]');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_de_funerarias`
--

DROP TABLE IF EXISTS `detalle_de_funerarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detalle_de_funerarias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Funeraria` int(11) NOT NULL,
  `Campo` text,
  `Valor` text,
  `Estado` text,
  `Comentarios` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_de_funerarias`
--

LOCK TABLES `detalle_de_funerarias` WRITE;
/*!40000 ALTER TABLE `detalle_de_funerarias` DISABLE KEYS */;
INSERT INTO `detalle_de_funerarias` VALUES (9,34,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (10,34,'TipoFuneraria','A',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (11,34,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (12,34,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (13,34,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (14,34,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (15,34,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (16,34,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (17,34,'InfoGeneral',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (18,34,'Documentacion',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (19,35,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (20,35,'TipoFuneraria','B',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (21,35,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (22,35,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (23,35,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (24,35,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (25,35,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (26,35,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (27,35,'InfoGeneral',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (28,35,'Documentacion',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (29,36,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (30,36,'TipoFuneraria','B',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (31,36,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (32,36,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (33,36,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (34,36,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (35,36,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (36,36,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (37,36,'InfoGeneral',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (38,36,'Documentacion',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (39,36,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (40,36,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (41,36,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (42,36,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (43,36,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (44,37,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (45,37,'TipoFuneraria','A',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (46,37,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (47,37,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (48,37,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (49,37,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (50,37,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (51,37,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (52,37,'InfoGeneral',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (53,37,'Documentacion',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (54,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (55,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (56,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (57,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (58,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (59,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (60,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (61,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (62,37,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (63,38,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (64,38,'TipoFuneraria','A',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (65,38,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (66,38,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (67,38,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (68,38,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (69,38,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (70,38,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (71,38,'InfoGeneral',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (72,38,'Documentacion',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (73,6,'Documentacion',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (75,38,'Convenio',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (76,38,'Convenio',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (77,38,'Documentacion',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (78,38,'Documentacion',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (93,6,'Documentacion',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (103,39,'TipoFuneraria','A',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (104,39,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (105,39,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (106,39,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (107,39,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (108,39,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (109,39,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (110,39,'InfoGeneral',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (111,40,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (112,40,'TipoFuneraria','C',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (113,40,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (114,40,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (115,40,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (116,40,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (117,40,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (118,40,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (119,40,'InfoGeneral',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (120,40,'Documentacion',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (121,41,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (122,41,'LicenciaAmbiental','C','Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (123,41,'LicenciaAmbiental','1515','Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (124,41,'LicenciaAmbiental','12345678','Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (125,41,'LicenciaAmbiental','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes','Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (126,41,'LicenciaAmbiental','Guatemala','Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (127,41,'LicenciaAmbiental','Samuel Ambrosio','Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (128,41,'LicenciaAmbiental','53165894','Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (129,41,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (130,41,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (131,41,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (132,43,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (133,43,'TipoFuneraria','C',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (134,43,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (135,43,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (136,43,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (137,43,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (138,43,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (139,43,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (140,43,'InfoGeneral',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (141,43,'Documentacion',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (142,43,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (143,43,'Convenio',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (144,44,'LicenciaAmbiental',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (145,44,'TipoFuneraria','C',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (146,44,'NIT','1515',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (147,44,'Telefono','12345678',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (148,44,'Direccion','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (149,44,'Departamento','Guatemala',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (150,44,'NombreContacto','Samuel Ambrosio',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (151,44,'TelContacto','53165894',NULL,NULL);
INSERT INTO `detalle_de_funerarias` VALUES (152,44,'InfoGeneral',NULL,'Pendiente',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (153,44,'Documentacion',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (154,44,'LicenciaAmbiental',NULL,'Aprobado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (155,44,'Convenio',NULL,'Denegado',NULL);
INSERT INTO `detalle_de_funerarias` VALUES (158,41,'Documentacion',NULL,'Denegado',NULL);
/*!40000 ALTER TABLE `detalle_de_funerarias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_funeraria`
--

DROP TABLE IF EXISTS `detalles_funeraria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detalles_funeraria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Campos` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_funeraria`
--

LOCK TABLES `detalles_funeraria` WRITE;
/*!40000 ALTER TABLE `detalles_funeraria` DISABLE KEYS */;
INSERT INTO `detalles_funeraria` VALUES (1,'');
INSERT INTO `detalles_funeraria` VALUES (2,'');
INSERT INTO `detalles_funeraria` VALUES (3,'');
INSERT INTO `detalles_funeraria` VALUES (4,'');
INSERT INTO `detalles_funeraria` VALUES (5,'');
INSERT INTO `detalles_funeraria` VALUES (6,'');
INSERT INTO `detalles_funeraria` VALUES (7,'');
INSERT INTO `detalles_funeraria` VALUES (8,'');
INSERT INTO `detalles_funeraria` VALUES (9,'');
INSERT INTO `detalles_funeraria` VALUES (10,'');
INSERT INTO `detalles_funeraria` VALUES (11,'[{\"campo\":1,\"result\":\"Si\"}]');
INSERT INTO `detalles_funeraria` VALUES (12,'');
INSERT INTO `detalles_funeraria` VALUES (13,'');
INSERT INTO `detalles_funeraria` VALUES (14,'');
INSERT INTO `detalles_funeraria` VALUES (15,'');
INSERT INTO `detalles_funeraria` VALUES (16,'');
INSERT INTO `detalles_funeraria` VALUES (17,'');
INSERT INTO `detalles_funeraria` VALUES (18,'');
INSERT INTO `detalles_funeraria` VALUES (19,'');
INSERT INTO `detalles_funeraria` VALUES (20,'[{\"campo\":\"InfoGeneral\",\"result\":\"Si\"},{\"campo\":\"Documentos\",\"result\":\"Pendiente\"}, {\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (21,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (22,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (23,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (24,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (25,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (26,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (27,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (28,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (29,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (30,'[]');
INSERT INTO `detalles_funeraria` VALUES (31,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (32,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (33,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (34,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (35,'[{\"campo\":\"InfoGeneral\",\"result\":\"No\"},{\"campo\":\"Documentos\",\"result\":\"No\"},{\"campo\":\"Contrato\",\"result\":\"No\"}]');
INSERT INTO `detalles_funeraria` VALUES (36,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (37,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (38,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (39,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (40,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (41,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (42,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (43,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (44,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (45,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (46,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (47,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (48,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (49,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (50,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (51,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (52,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (53,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (54,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (55,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (56,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (57,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (58,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (59,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (60,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (61,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (62,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (63,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (64,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (65,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (66,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (67,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (68,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (69,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (70,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (71,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (72,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (73,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (74,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (75,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (76,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (77,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (78,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (79,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (80,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (81,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (82,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (83,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (84,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (85,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (86,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (87,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (88,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (89,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (90,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (91,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (92,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (93,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (94,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (95,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (96,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (97,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (98,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (99,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (100,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (101,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (102,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (103,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (104,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (105,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (106,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (107,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (108,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (109,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (110,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (111,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (112,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (113,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (114,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (115,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (116,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (117,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (118,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (119,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (120,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (121,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (122,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (123,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (124,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (125,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (126,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (127,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (128,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (129,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (130,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (131,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (132,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (133,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (134,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (135,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (136,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (137,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (138,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (139,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (140,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (141,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (142,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (143,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (144,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (145,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (146,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (147,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (148,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (149,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (150,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (151,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (152,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (153,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (154,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (155,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (156,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (157,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (158,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (159,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (160,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (161,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (162,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (163,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (164,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (165,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (166,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (167,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (168,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (169,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (170,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (171,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (172,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (173,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (174,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (175,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (176,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (177,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (178,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (179,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (180,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (181,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (182,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (183,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (184,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (185,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (186,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (187,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (188,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (189,'[{\"campo\":1,\"result\":\"No\"}');
INSERT INTO `detalles_funeraria` VALUES (190,'[{\"campo\":1,\"result\":\"No\"}');
/*!40000 ALTER TABLE `detalles_funeraria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentacion`
--

DROP TABLE IF EXISTS `documentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `documentacion` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Documento` text NOT NULL,
  `Descripcion` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentacion`
--

LOCK TABLES `documentacion` WRITE;
/*!40000 ALTER TABLE `documentacion` DISABLE KEYS */;
INSERT INTO `documentacion` VALUES (1,'Permiso...','Desc del documento 1');
INSERT INTO `documentacion` VALUES (2,'Certificación...','Desc del documento 2');
INSERT INTO `documentacion` VALUES (3,'Documento 3','Desc del documento 3');
/*!40000 ALTER TABLE `documentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos_funerarias`
--

DROP TABLE IF EXISTS `documentos_funerarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `documentos_funerarias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Funeraria` int(11) NOT NULL,
  `Documento` text,
  `Ruta` text,
  `Estatus` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `Comentarios` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos_funerarias`
--

LOCK TABLES `documentos_funerarias` WRITE;
/*!40000 ALTER TABLE `documentos_funerarias` DISABLE KEYS */;
INSERT INTO `documentos_funerarias` VALUES (1,6,'Permiso...','#','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (2,6,'Certificación...','#','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (3,33,'licenciaAmbiental','/images/Funeraria-33-licenciaAmbiental.gitignore','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (4,34,'licenciaAmbiental','/images/Funeraria-34-licenciaAmbiental.gitignore','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (5,34,'patenteComercio','/images/Funeraria-34-patenteComercio.gitignore','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (6,35,'licenciaAmbiental','/images/Funeraria-35-licenciaAmbiental.gitignore','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (7,36,'licenciaAmbiental','/images/Funeraria-36-licenciaAmbiental.gitignore','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (8,36,'patenteComercio','/images/Funeraria-36-patenteComercio.gitignore',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (9,36,'rtu','/images/Funeraria-36-rtu.gitignore',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (10,36,'licenciaSanitaria','/images/Funeraria-36-licenciaSanitaria.gitignore',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (11,36,'dpi','/images/Funeraria-36-dpi.gitignore',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (12,36,'certManipulacionCuerpos','/images/Funeraria-36-certManipulacionCuerpos.gitignore',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (13,37,'licenciaAmbiental','/images/Funeraria-37-licenciaAmbiental.pdf','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (14,37,'patenteComercio','/images/Funeraria-37-patenteComercio.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (15,37,'rtu','/images/Funeraria-37-rtu.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (16,37,'dpi','/images/Funeraria-37-dpi.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (17,37,'licenciaSanitaria','/images/Funeraria-37-licenciaSanitaria.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (18,37,'licenciaSanitaria','/images/Funeraria-37-licenciaSanitaria.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (19,37,'certManipulacionCuerpos','/images/Funeraria-37-certManipulacionCuerpos.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (20,37,'licManipulacionCuerpos','/images/Funeraria-37-licManipulacionCuerpos.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (21,37,'manipulacionAlimentos','/images/Funeraria-37-manipulacionAlimentos.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (22,37,'bioinfecciosos','/images/Funeraria-37-bioinfecciosos.pdf',NULL,NULL);
INSERT INTO `documentos_funerarias` VALUES (23,38,'licenciaAmbiental','/images/Funeraria-38-licenciaAmbiental.pdf','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (24,38,'patenteComercio','/images/Funeraria-38-patenteComercio.gitignore','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (25,38,'rtu','/images/Funeraria-38-rtu.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (26,38,'licenciaSanitaria','/images/Funeraria-38-licenciaSanitaria.pdf','Aprobado',NULL);
INSERT INTO `documentos_funerarias` VALUES (27,38,'dpi','/images/Funeraria-38-dpi.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (28,38,'certManipulacionCuerpos','/images/Funeraria-38-certManipulacionCuerpos.gitignore','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (29,38,'licManipulacionCuerpos','/images/Funeraria-38-licManipulacionCuerpos.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (30,38,'manipulacionAlimentos','/images/Funeraria-38-manipulacionAlimentos.pdf','Denegado','-test');
INSERT INTO `documentos_funerarias` VALUES (31,38,'bioinfecciosos','/images/Funeraria-38-bioinfecciosos.pdf','Denegado','asdasdddd');
INSERT INTO `documentos_funerarias` VALUES (43,40,'licenciaAmbiental','/images/Funeraria-40-licenciaAmbiental.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (44,41,'licenciaAmbiental','/images/Funeraria-41-licenciaAmbiental.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (45,41,'patenteComercio','/images/Funeraria-41-patenteComercio.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (46,41,'dpi','/images/Funeraria-41-dpi.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (47,41,'rtu','/images/Funeraria-41-rtu.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (48,41,'licenciaSanitaria','/images/Funeraria-41-licenciaSanitaria.gitignore','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (49,43,'licenciaAmbiental','/images/Funeraria-43-licenciaAmbiental.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (50,43,'patenteComercio','/images/Funeraria-43-patenteComercio.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (51,43,'rtu','/images/Funeraria-43-rtu.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (52,43,'dpi','/images/Funeraria-43-dpi.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (53,43,'licenciaSanitaria','/images/Funeraria-43-licenciaSanitaria.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (54,44,'licenciaAmbiental','/images/Funeraria-44-licenciaAmbiental.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (55,44,'patenteComercio','/images/Funeraria-44-patenteComercio.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (56,44,'rtu','/images/Funeraria-44-rtu.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (57,44,'dpi','/images/Funeraria-44-dpi.pdf','Aprobado','-');
INSERT INTO `documentos_funerarias` VALUES (58,44,'licenciaSanitaria','/images/Funeraria-44-licenciaSanitaria.pdf','Aprobado','-');
/*!40000 ALTER TABLE `documentos_funerarias` ENABLE KEYS */;
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
  `Funeraria_Registrada` int(11) DEFAULT NULL,
  `Nombre` text,
  `Email` text,
  `Telefono` text,
  `Monto_Base` int(11) DEFAULT NULL,
  `Activa` text,
  `Id_Detalle` int(11) DEFAULT NULL,
  `Campanias` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funerarias`
--

LOCK TABLES `funerarias` WRITE;
/*!40000 ALTER TABLE `funerarias` DISABLE KEYS */;
INSERT INTO `funerarias` VALUES (1,6,NULL,'Funeraria de prueba','test@funeraria.com',NULL,5184,'No',9,'[]');
INSERT INTO `funerarias` VALUES (2,13,NULL,'Funeraria Quetzaltenango','quetzaltenango@funeraria.com','12345678',10000,'Si',10,NULL);
INSERT INTO `funerarias` VALUES (3,1,1,'Funeraria La Piedad','samuelambrosio99@gmail.com','49750995',0,'Si',11,'[{\"id\": \"4\", \"monto\": \"1000\", \"nombre\": \"Test usd, TEst (USD)\", \"edad_final\": \"15\", \"edad_inicial\": \"10\"}, {\"id\": \"5\", \"monto\": \"500\", \"nombre\": \"Campaña nueva, Aseguradora Prueba (USD)\", \"edad_final\": \"9\", \"edad_inicial\": \"5\"}, {\"id\": \"7\", \"monto\": \"5000\", \"nombre\": \"SeguRed, Segured (GTQ)\", \"edad_final\": \"4\", \"edad_inicial\": \"1\"}]');
INSERT INTO `funerarias` VALUES (4,2,NULL,'Funeraria San Miguel','test@test.com','15151545',0,'Si',12,NULL);
INSERT INTO `funerarias` VALUES (5,3,NULL,'Funeraria La Piedad','samuelambrosio99@gmail.com','49750995',0,'Si',13,'[{\"id\": \"4\", \"monto\": \"1000\", \"nombre\": \"Test usd, TEst (USD)\", \"edad_final\": \"15\", \"edad_inicial\": \"10\"}, {\"id\": \"3\", \"monto\": \"5000\", \"nombre\": \"Test campaña 2, Test 2 (GTQ)\", \"edad_final\": \"30\", \"edad_inicial\": \"16\"}, {\"id\": \"5\", \"monto\": \"500\", \"nombre\": \"Campaña nueva, Aseguradora Prueba (USD)\", \"edad_final\": \"9\", \"edad_inicial\": \"5\"}, {\"id\": \"7\", \"monto\": \"3000\", \"nombre\": \"SeguRed, Segured (GTQ)\", \"edad_final\": \"12\", \"edad_inicial\": \"5\"}]');
INSERT INTO `funerarias` VALUES (6,5,NULL,'Funerales y Capillas San José','','',0,'Si',14,NULL);
INSERT INTO `funerarias` VALUES (7,10,NULL,'Funerales Carranza','','',0,'Si',15,NULL);
INSERT INTO `funerarias` VALUES (8,26,NULL,'\"Funeraria \"\"El Buen Pastor\"\"\"','samedgar15@gmail.com','15234584',0,'Si',16,NULL);
INSERT INTO `funerarias` VALUES (9,4,NULL,'Funeraria Hardelh','','',0,'Si',17,NULL);
INSERT INTO `funerarias` VALUES (14,38,NULL,'Funeraria registro','registro@funeraria.com',NULL,NULL,'Si',NULL,'[]');
INSERT INTO `funerarias` VALUES (18,8,NULL,'Funeraria El quetzalteco','','',0,'Si',39,NULL);
INSERT INTO `funerarias` VALUES (19,7,NULL,'Funeraria Zaculeu','','',0,'Si',40,NULL);
INSERT INTO `funerarias` VALUES (33,40,49,'test nuevo fun','fun@nueva.com','53165894',0,'Si',32,NULL);
INSERT INTO `funerarias` VALUES (34,36,50,'Nuevo test funeraria','nuevotest@funeraria.com','53165894',0,'Si',27,'[]');
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
  `comprobante` text CHARACTER SET utf8 COLLATE utf8_romanian_ci,
  PRIMARY KEY (`id`),
  KEY `caso` (`caso`),
  CONSTRAINT `historial_pagos_ibfk_1` FOREIGN KEY (`caso`) REFERENCES `casos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_pagos`
--

LOCK TABLES `historial_pagos` WRITE;
/*!40000 ALTER TABLE `historial_pagos` DISABLE KEYS */;
INSERT INTO `historial_pagos` VALUES (1,11,100,'2020-10-08',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (2,11,50,'2020-10-07',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (3,11,50,'2020-10-08',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (4,11,50,'2020-10-01',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (5,11,150,'2020-10-02',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (6,11,200,'2020-10-05',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (7,11,150,'2020-09-01',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (8,11,100,'2020-08-05',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (9,11,50,'2020-10-07',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (10,12,500,'2020-10-08',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (11,13,500,'2020-10-08',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (12,13,50,'2020-10-08',NULL,NULL,NULL);
INSERT INTO `historial_pagos` VALUES (13,13,100,'2020-10-13','15216',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (14,13,100,'2020-10-13','123',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (15,14,500,'2020-10-26','12',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (16,14,700,'2020-10-26','13',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (17,15,150,'2020-10-27','123',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (18,15,350,'2020-10-27','122',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (19,13,124,'2020-10-28','121a',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (20,13,150,'2020-10-28','12154',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (21,13,110,'2020-10-28','1111',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (22,13,110,'2020-10-28','1111',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (23,13,100,'2020-10-28','54818',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (24,15,100,'2020-10-28','8481',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (25,13,100,'2020-10-28','123223',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (26,13,100,'2020-10-28','123223',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (27,13,100,'2020-10-28','123223',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (28,13,100,'2020-10-28','123223',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (29,13,120,'2020-10-28','1502',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (30,19,150,'2020-11-18','1',NULL,NULL);
INSERT INTO `historial_pagos` VALUES (31,19,150,'2020-11-20','15','E',NULL);
INSERT INTO `historial_pagos` VALUES (32,19,1000,'2020-11-21','12345','A',NULL);
INSERT INTO `historial_pagos` VALUES (33,19,15,'2020-12-07','5','A',NULL);
INSERT INTO `historial_pagos` VALUES (34,19,100,'2020-12-07','121','A',NULL);
INSERT INTO `historial_pagos` VALUES (35,21,1200,'2021-04-30','123','E',NULL);
INSERT INTO `historial_pagos` VALUES (36,21,2400,'2021-04-30','1234','A',NULL);
INSERT INTO `historial_pagos` VALUES (37,27,1000,'2021-05-04','12345','E',NULL);
INSERT INTO `historial_pagos` VALUES (38,27,1000,'2021-05-07','12345','A',NULL);
INSERT INTO `historial_pagos` VALUES (39,27,1000,'2021-05-07','84818','E','/images/test.jpg');
INSERT INTO `historial_pagos` VALUES (40,27,1000,'2021-05-13','4344534','E','/images/Caso27-Reporte-Causas (1).pdf');
INSERT INTO `historial_pagos` VALUES (41,27,1000,'2021-05-13','634534','A','/images/Caso27-Reporte-Causas (1).pdf');
INSERT INTO `historial_pagos` VALUES (42,27,0,'2021-05-13','1515','E','/images/Caso27-Reporte-Causas (1).pdf');
INSERT INTO `historial_pagos` VALUES (43,27,0,'2021-05-13','1616','E','/images/Caso27-Reporte-Edades (1).pdf');
INSERT INTO `historial_pagos` VALUES (44,28,500,'2021-05-14','8595','A','/images/Caso28-nuevotest.txt');
INSERT INTO `historial_pagos` VALUES (45,28,100,'2021-05-14','12345','F','/images/Caso28-test-de-estrés.png');
INSERT INTO `historial_pagos` VALUES (46,28,100,'2021-05-14','1515','X','/images/Caso28-test-de-estrés.png');
INSERT INTO `historial_pagos` VALUES (47,28,1000,'2021-05-17','12345','C','/images/Caso28-test-de-estrés.png');
INSERT INTO `historial_pagos` VALUES (48,28,100,'2021-05-17','123','V','/images/Caso28-test-de-estrés.png');
INSERT INTO `historial_pagos` VALUES (49,28,100,'2021-05-17','131','V','/images/Caso28-test-de-estrés.png');
INSERT INTO `historial_pagos` VALUES (50,28,10,'2021-05-18','1515','G','/images/Caso28-test-de-estrés.png');
INSERT INTO `historial_pagos` VALUES (51,28,15,'2021-05-17','1515','J','/images/Caso28-nuevotest.txt');
/*!40000 ALTER TABLE `historial_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_funerarias_registradas`
--

DROP TABLE IF EXISTS `info_funerarias_registradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `info_funerarias_registradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funeraria` text NOT NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `departamento` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `municipio` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tel_contacto` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tel_coordinador` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `convenio` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tipo` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `estado` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_funerarias_registradas`
--

LOCK TABLES `info_funerarias_registradas` WRITE;
/*!40000 ALTER TABLE `info_funerarias_registradas` DISABLE KEYS */;
INSERT INTO `info_funerarias_registradas` VALUES (1,'Funeraria La Piedad','2da av. 6-92 Zona 1 Cobán, Alta Verapaz','ALTA VERAPAZ','COBAN','5202 4024','52024024','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (2,'Funeraria San Miguel ','Cantón Sandoval, San Miguel Chicaj ','BAJA VERAPAZ','SALAMA','46692308','46692308','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (3,'Funeraria Morazán','Calle Principal como a 100 metros de la entrada all campo de fútbol,  Barrio el Calvario,  Morazán, El Progreso.','EL PROGRESO','MORAZAN','5019-7670','5019-7670','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (4,'Funeraria Hardelh','2da. Calle 15-70 Zona 3 Santa Cruz del Quiché,  Quiché','QUICHE','SANTA CRUZ DEL QUICHE','573-31148','573-31148','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (5,'Funerales y Capillas San José','4av. Norte 3-40 Zona 2 Escuintla, Escuintla','ESCUINTLA','ESCUINTLA','5693-6646','4103-2103','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (6,'Funerales  El Roble','6ta Av.5-38 Colonia Landivar Zona 7, Guatemala, Guatemala','GUATEMALA','GUATEMALA','3199-0959','3199-0959','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (7,'Funeraria Zaculeu','Las Lagunas Z-10 Huehuetenango, Huehuetenango','HUEHUETENANGO','HUEHUETENANGO','57881600','57881600','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (8,'Funeraria El quetzalteco','Las Lagunas Z-10 Huehuetenango, Huehuetenango','HUEHUETENANGO','HUEHUETENANGO','4600-8222','5441-1193','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (9,'Funerales San José','3ra. Calle  1ra. Avenida Colonia San Agustín Santo Tomás de Castilla , Puerto Barrios, Izabal','IZABAL','PUERTO BARRIOS','5843-6536','5843-6536','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (10,'Funerales Carranza','Av. Chipilapa 2-89 Zona 2 Barrio la esperanza Jalapa, Jalapa','JALAPA','JALAPA','5470-9427','5692-5263 / 5692-5315 /46013843','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (11,'Funeraria Jutiapa','Calle 15 de Septiembre final a un costado de la emergencia del Hospital de Jutiapa Barrio Latino zona 1,  Jutiapa, Jutiapa','JUTIAPA','JUTIAPA','5046-9496','5046-9496','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (12,'\"Funerarias y Multiservicios  \"\"NAVARRO\"\"\"','Final Calle 15 de Septiembre, a un costado del Hospital Nacional, Jutiapa, Jutiapa','JUTIAPA','JUTIAPA','5161-2870','4569-0963','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (13,'Funeraria Quetzaltenango','10 Calle 12-38 Zona 1 Quetzlatenango, Quetzlatenango','QUETZALTENANGO','QUETZALTENANGO','4254-8836','4254-8836','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (14,'Funerales del Ángel','Dirección: 0 Calle, 4-69 zona 9 Quetzaltenango, Quetzaltenango. frente al Hospital Regional San Juan de Dios.','QUETZALTENANGO','QUETZALTENANGO','4003-6696','4003-6696','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (15,'Funerales Retalhuleu','7ma. Calle 1-32 Zona 1 Retalhuleu, Retalhule','RETALHULEU','RETALHULEU','4732-0522','4732-0522','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (16,'Funerales San Serbastían','Bulevar Centenario salida a Coatepeque a un costado del IGSS / Calle al cementerio, Retalhuleu , Retalhuleu ','RETALHULEU','RETALHULEU',' 5904-0933 ',' 5904-0933','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (17,'Funeraria La Eternidad','5ta. Calle 14-339 Z-5, San Marcos, San Marcos','SAN MARCOS','SAN MARCOS','5788-1600','5788-1600 / 5909-0790','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (18,'Funeraria Emmanuel','Calzada Principal Barrio San Pedro, Guazacapán, Santa Rosa','SANTA ROSA','GUAZACAPAN','54370818','54370818','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (19,'Funeraria El Último Recuerdo','Calzada Venancio Barrios 0-570 Zona 2 Sololá, Sololá ','SOLOLA','SOLOLA','57111085','57111085','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (20,'Fueraria Los Ángeles','1ra Avenida 2-+41 Zona 1 Mazatenango, Suchitepéquez','SUCHITEPEQUEZ','MAZATENANGO','3363-9952','3363-9952','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (21,'Funeraria La Providencia','Cantón El Pinal Totonicapán, Totonicapán','TOTONICAPAN','TOTONICAPAN','3075-0669','3075-0669','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (22,'Funeraria San Agustín','3ra. Calle 7-50 Zona 1 Teculután, Zacapa','ZACAPA','TECULUTAN','5815-4652','5815-4652','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (23,'Funerales Framach','5ta. Avenida 3-68 Zona1, Chimaltenango, Chimaltenango','CHIMALTENANGO','CHIMALTENANGO','5715-5206','5715-5206','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (24,'Funerales  El Roble','6ta Av.5-38 Colonia Landivar Zona 7, Guatemala, Guatemala','SACATEPEQUEZ','ANTIGUA GUATEMALA','3199-0959','3199-0959','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (25,'Funerales  El Roble','6ta Av.5-38 Colonia Landivar Zona 7, Guatemala, Guatemala','CHIQUIMULA','CHIQUIMULA','3199-0959','3199-0959','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (26,'\"Funeraria \"\"El Buen Pastor\"\"\"','30 Calle Barrio el Redentor  Zona 1 a un costado del Hospital Nacional, San Benito, Petén','PETEN','SAN BENITO','4598-3870','4598-3870','CONVENIO INDIVIVUAL',NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (49,'test nuevo fun','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes','Guatemala',NULL,'53165894','53165894',NULL,NULL,'Activo');
INSERT INTO `info_funerarias_registradas` VALUES (50,'Nuevo test funeraria','12av el bosque 2-56 zona 11 de Mixco, lo de fuentes','Guatemala',NULL,'53165894','53165894',NULL,NULL,'Activo');
/*!40000 ALTER TABLE `info_funerarias_registradas` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `migrations` VALUES (23,'2021_05_03_143320_create_activity_log_table',3);
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
INSERT INTO `model_has_roles` VALUES (3,'App\\User',29);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',30);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',31);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',32);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',33);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',34);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',35);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',36);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',37);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',38);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',39);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',40);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',41);
INSERT INTO `model_has_roles` VALUES (5,'App\\User',42);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',43);
INSERT INTO `model_has_roles` VALUES (3,'App\\User',44);
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
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
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
INSERT INTO `notificaciones` VALUES (177,1,'Caso #22 asignado.','Activa',22);
INSERT INTO `notificaciones` VALUES (178,1,'Caso #22 asignado.','Activa',22);
INSERT INTO `notificaciones` VALUES (179,NULL,'Caso #22 actualizado.','Activa',22);
INSERT INTO `notificaciones` VALUES (180,1,'El caso #22 se ha cerrado.','Activa',22);
INSERT INTO `notificaciones` VALUES (181,1,'El caso #22 se ha cerrado.','Activa',22);
INSERT INTO `notificaciones` VALUES (182,1,'Caso #22 asignado.','Activa',22);
INSERT INTO `notificaciones` VALUES (183,1,'Caso #22 asignado.','Activa',22);
INSERT INTO `notificaciones` VALUES (184,1,'Caso #22 asignado.','Activa',22);
INSERT INTO `notificaciones` VALUES (185,NULL,'Caso #23 creado.','Activa',23);
INSERT INTO `notificaciones` VALUES (186,1,'Caso #23 asignado.','Activa',23);
INSERT INTO `notificaciones` VALUES (187,1,'Caso #22 asignado.','Activa',22);
INSERT INTO `notificaciones` VALUES (188,NULL,'Caso #24 creado.','Activa',24);
INSERT INTO `notificaciones` VALUES (189,1,'Caso #24 asignado.','Activa',24);
INSERT INTO `notificaciones` VALUES (190,1,'Caso #23 asignado.','Activa',23);
INSERT INTO `notificaciones` VALUES (191,NULL,'Caso #5 actualizado.','Activa',5);
INSERT INTO `notificaciones` VALUES (192,1,'Caso #5 asignado.','Activa',5);
INSERT INTO `notificaciones` VALUES (193,1,'Caso #24 asignado.','Activa',24);
INSERT INTO `notificaciones` VALUES (194,1,'Caso #24 asignado.','Activa',24);
INSERT INTO `notificaciones` VALUES (195,NULL,'Caso #25 creado.','Activa',25);
INSERT INTO `notificaciones` VALUES (196,1,'Caso #25 asignado.','Activa',25);
INSERT INTO `notificaciones` VALUES (197,1,'Caso #25 asignado.','Activa',25);
INSERT INTO `notificaciones` VALUES (198,32,'Verifique su procedimiento de aplicación, un paso ha sido aprobado','Activa',NULL);
INSERT INTO `notificaciones` VALUES (199,1,'Caso #25 asignado.','Activa',25);
INSERT INTO `notificaciones` VALUES (200,32,'Verifique su procedimiento de aplicación, un paso ha sido aprobado','Activa',NULL);
INSERT INTO `notificaciones` VALUES (201,38,'Verifique su procedimiento de aplicación, un paso ha sido aprobado','Activa',NULL);
INSERT INTO `notificaciones` VALUES (202,38,'Verifique su procedimiento de aplicación, un paso ha sido aprobado','Activa',NULL);
INSERT INTO `notificaciones` VALUES (203,38,'Verifique su procedimiento de aplicación, un paso ha sido denegado','Activa',NULL);
INSERT INTO `notificaciones` VALUES (204,38,'Verifique su procedimiento de aplicación, un paso ha sido aprobado','Activa',NULL);
INSERT INTO `notificaciones` VALUES (205,38,'Verifique su procedimiento de aplicación, un paso ha sido aprobado','Activa',NULL);
INSERT INTO `notificaciones` VALUES (206,38,'Verifique su procedimiento de aplicación, un paso ha sido aprobado','Activa',NULL);
INSERT INTO `notificaciones` VALUES (207,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (208,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (209,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (210,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (211,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (212,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (213,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (214,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (215,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (216,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (217,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (218,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (219,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (220,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (221,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (222,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (223,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (224,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (225,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (226,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (227,38,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (228,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (229,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (230,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (231,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (232,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (233,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (234,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (235,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (236,39,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (237,NULL,'Caso #27 creado.','Activa',27);
INSERT INTO `notificaciones` VALUES (238,1,'Caso #27 asignado.','Activa',27);
INSERT INTO `notificaciones` VALUES (239,NULL,'El caso #27 tiene una nueva solicitud.','Activa',27);
INSERT INTO `notificaciones` VALUES (240,1,'La solicitud del caso #27 ha sido aprobada.','Activa',27);
INSERT INTO `notificaciones` VALUES (241,40,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (242,41,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (243,41,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (244,NULL,'Caso #26 actualizado.','Activa',26);
INSERT INTO `notificaciones` VALUES (245,1,'Caso #26 asignado.','Activa',26);
INSERT INTO `notificaciones` VALUES (246,43,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (247,1,'Caso #27 asignado.','Activa',27);
INSERT INTO `notificaciones` VALUES (248,44,'','Activa',NULL);
INSERT INTO `notificaciones` VALUES (249,NULL,'Caso #27 actualizado.','Activa',27);
INSERT INTO `notificaciones` VALUES (250,NULL,'Caso #27 actualizado.','Activa',27);
INSERT INTO `notificaciones` VALUES (251,NULL,'Caso #27 actualizado.','Activa',27);
INSERT INTO `notificaciones` VALUES (252,NULL,'Caso #27 actualizado.','Activa',27);
INSERT INTO `notificaciones` VALUES (253,NULL,'Caso #28 creado.','Activa',28);
INSERT INTO `notificaciones` VALUES (254,1,'Caso #28 asignado.','Activa',28);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `roles` VALUES (5,'Contabilidad','web','2020-09-09 01:57:39','2020-09-09 01:57:39');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
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
INSERT INTO `solicitudes_cobro_funerarias` VALUES (23,27,'Aprobar',6000,'La distancia es mayor');
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
  `tipo_funeraria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `activo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detalle` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Agente Call Center','agent@callcenter.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','1nPyn4QDB5bUqzPA7LEcoszkFoAwVZlPDCyINUh1Qt5uRMDoBdkzF61nuLSx','2020-09-09 01:57:39','2021-05-15 02:47:55',3,NULL,'Si',NULL);
INSERT INTO `users` VALUES (2,'Personal UM','personal@um.com','2020-09-09 01:57:39','$2y$10$mpS45hcRmh8IXwz4QQoKxe2vqqqqw3qKBVNyoxyK9pzSJJkLNF97i','eQ83Gejawnn65ZcEkKdDTyd24VRWgNUbPJHa2w3sXw3C0OKRtIfXFG4IeAdx','2020-09-09 01:57:39','2020-10-28 09:50:20',NULL,NULL,NULL,NULL);
INSERT INTO `users` VALUES (3,'Funeraria','funeraria@um.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Hc9YFXEi9Wbv16uTdDvIuYxqyrMD2qhkSJ4b4ldSy007qCi1IwKAfTt7KqKY','2020-09-09 01:57:39','2021-05-11 15:59:38',5,NULL,'Si',NULL);
INSERT INTO `users` VALUES (4,'test','admin@test.com','2020-09-09 01:57:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','rjcMnEygeBpcwY5w1388BPILGeNXWbb41DCqxozh62PS05U5NooHJOcjGgpd','2020-09-09 01:57:39','2020-09-09 01:57:39',NULL,NULL,NULL,NULL);
INSERT INTO `users` VALUES (5,'Test Funeraria','funeraria@test.com',NULL,'$2y$10$VUmvDlbOYqPL0qMltjm15OQl1x8G9OpqFCjsGzevKg4ItfXdD1lMK',NULL,'2020-09-17 03:52:58','2020-09-17 06:50:01',1,NULL,'Si',1);
INSERT INTO `users` VALUES (6,'Funeraria de prueba','test@funeraria.com',NULL,'$2y$10$UT1HBPPcvbVWlIJ87EzOp.CAcuHdNg/oKp6IPQCpUph4XazgF5PsG',NULL,'2020-09-17 06:48:48','2021-05-16 05:43:17',1,NULL,'No',2);
INSERT INTO `users` VALUES (7,'Funeraria de prueba edit','funeraria@guatemala.com',NULL,'$2y$10$XN83vjdtpiVc.CeQB6M14.J4LzGNc0UcyKneOoeCbwIK6pPIdhLaa',NULL,'2020-09-19 23:07:04','2021-05-17 20:18:05',30,NULL,'No',3);
INSERT INTO `users` VALUES (9,'testRegistro','test@registro.com',NULL,'$2y$10$FCJU42hwHs1gGjJoNXDgNOapPl7E3o4iMU2zEF4megU1aHoIxFI6G',NULL,'2020-10-26 07:11:17','2020-10-26 07:11:17',NULL,NULL,NULL,NULL);
INSERT INTO `users` VALUES (18,'HilarioTest','Hilario@test.com',NULL,'$2y$10$KOlRQ/vWgBXeIFEj/Rms1OHKtomJaUo1iwcB9VSWYQ.Vxv4E9cQ2G',NULL,'2020-10-27 07:05:52','2020-10-27 07:05:52',NULL,NULL,NULL,NULL);
INSERT INTO `users` VALUES (19,'Funeraria de prueba','funeraria@fun.com',NULL,'$2y$10$kOECV64wzKzTD5ORJHCksOCsFFQKU3sMvYq2MZa0M5Wz35024pifO',NULL,'2020-10-27 07:07:29','2021-05-16 05:43:37',NULL,NULL,'No',7);
INSERT INTO `users` VALUES (20,'TestFunerariaTest','test@fun.com',NULL,'$2y$10$VT9UCeiiBhKYqXJGp668zuitPLv5Jrc6803YoVcto0GXgdjs2i4Hm',NULL,'2020-10-28 03:43:54','2020-10-28 03:44:17',NULL,NULL,'Si',8);
INSERT INTO `users` VALUES (21,'Test Edgar','Edgartest@mail.com',NULL,'$2y$10$udccaEOzu8m5Or7bMZgrKu1hqifxAcHbTd22Sa0bBt1UBn4qfFy4q',NULL,'2020-10-29 06:21:11','2020-10-29 06:21:11',NULL,NULL,NULL,NULL);
INSERT INTO `users` VALUES (23,'Test Edgar','Edgartest@mails.com',NULL,'$2y$10$VdMJb12O5k5uSdnj4qHDGO/P83ZOFpOFHVE8xs.LIINxPfOR9zkQq',NULL,'2020-10-29 06:29:12','2020-10-29 06:29:12',NULL,NULL,NULL,NULL);
INSERT INTO `users` VALUES (24,'test registro','registro@test.com',NULL,'$2y$10$O0RNpnBFYIi1eazAQIEOheVEEAd8ysTWzABFf9qy4N./JMCO4ymBK',NULL,'2020-11-21 01:26:35','2020-11-21 01:26:35',6,NULL,NULL,NULL);
INSERT INTO `users` VALUES (27,'test registro','samedgar151@gmail.com',NULL,'$2y$10$tOOckRqu8tSnTuNDgIKxO.eRN.D4pkNa02ZYVS8X47H/gLcgo2Cny',NULL,'2020-11-23 12:02:00','2020-11-23 12:02:00',NULL,NULL,NULL,NULL);
INSERT INTO `users` VALUES (28,'Edgar Ambrosio','samedgar15@gmail.com',NULL,'$2y$10$6jJO3h4un1p0pIBlnJq5I./81BAp.iMZwNxKW7Gt.6go/H7XpFPwG',NULL,'2020-11-24 05:17:20','2020-11-24 05:17:20',6,NULL,NULL,NULL);
INSERT INTO `users` VALUES (29,'Funeraria de test','funerariade@test.com',NULL,'$2y$10$6sB5l7eyVuZpcDDcyJ.ScOpcMeXhElGB8.oJ86OHDbJDcDQy0XVdq',NULL,'2021-04-22 14:16:38','2021-04-22 14:16:38',NULL,NULL,'No',20);
INSERT INTO `users` VALUES (30,'Funeraria de prueba 2','prueba@funeraria.com',NULL,'$2y$10$pGSkxLTEtMkeGi.rCzavReEkOSHzJ/43MzeR..jUcfvTB.bWYbR1K',NULL,'2021-04-24 02:12:18','2021-05-16 07:59:05',NULL,NULL,'No',21);
INSERT INTO `users` VALUES (31,'Nueva funeraria','funeraria@nueva.com',NULL,'$2y$10$0AwM7fgsJq6zjLAFcvKaMuERIJ9YcY8VDypZb8C3D/Debe5x44Cry',NULL,'2021-04-24 03:41:11','2021-04-24 03:41:11',NULL,NULL,'No',22);
INSERT INTO `users` VALUES (32,'funeraria presentacion','presentacion@funeraria.com',NULL,'$2y$10$HedbA57XQvSoAWzbtbDv3uoGcaeZvtg6lh2dfzHZlZ95UVFok0asS',NULL,'2021-04-24 04:04:32','2021-05-17 00:19:36',NULL,NULL,'No',23);
INSERT INTO `users` VALUES (33,'Funeraria teest','teeest@funeraria.com',NULL,'$2y$10$UpBqrBY8NZDWtpKFPT9/pOAc3MfG2Kp086CB7ABRibDz0KDsqp8Eq',NULL,'2021-04-29 20:37:04','2021-05-16 05:40:57',NULL,NULL,'No',24);
INSERT INTO `users` VALUES (34,'Funeraria Live','live@funeraria.com',NULL,'$2y$10$/vdFDaUfEPWWkRidyLfxke9nIQYiOjliJvlb.SSu/FYR9YVl4A1.u',NULL,'2021-05-01 02:19:59','2021-05-16 08:12:53',NULL,NULL,'No',25);
INSERT INTO `users` VALUES (35,'Funeraria live test','Test@live.com',NULL,'$2y$10$eJeqC6qPhaksEdaSMYryb.I30dqOPZaUdweR.YljBrCG1A5/E4kKG',NULL,'2021-05-01 03:40:19','2021-05-17 07:10:30',NULL,'A','No',26);
INSERT INTO `users` VALUES (36,'Nuevo test funeraria','nuevotest@funeraria.com',NULL,'$2y$10$Pxb2Z4JRUq6FPWdtSjikcO2CLn4n0.g4VnD.ZlhsRfMcsmdmCqxEi',NULL,'2021-05-01 03:45:59','2021-05-17 20:50:18',34,'B','Si',27);
INSERT INTO `users` VALUES (37,'funeraria nueva','nueva@funeraria.com',NULL,'$2y$10$Q/Q7I1zN8laoueF0oaU1Dugmk7mGGPfJBGEx8mOnK2/JvC8FL2mmS',NULL,'2021-05-01 03:52:53','2021-05-01 03:53:21',NULL,'A','No',28);
INSERT INTO `users` VALUES (38,'Funeraria registro','registro@funeraria.com',NULL,'$2y$10$zmmLWxWbKNj/Y0SKoQK7OeV0qilWlHsBCkZZ4iu6rigGpKMQwpQ82',NULL,'2021-05-01 04:08:52','2021-05-04 21:14:31',NULL,'A','No',29);
INSERT INTO `users` VALUES (39,'Funeraria de prueba test','test@pruebafuneraria.com',NULL,'$2y$10$m4R4lWcL/DtWiMWeLgwVP.KwQYS7migm65UhCGFUyQBSd.hyJHm5C',NULL,'2021-05-04 21:19:39','2021-05-16 07:59:39',NULL,'A','No',NULL);
INSERT INTO `users` VALUES (40,'test nuevo fun','fun@nueva.com',NULL,'$2y$10$OLQ7PBxRzzGjJNiuMAlBEONI/IrYBwD1sDgqQJ9uP1vVlPGdEgNai',NULL,'2021-05-06 02:42:11','2021-05-17 20:24:14',33,'C','Si',32);
INSERT INTO `users` VALUES (41,'Test nueva fun','nueva@fun.com',NULL,'$2y$10$jIIdWS2e2D79Kw12kV9Qa.C5s4xk0TJ8vl9TpNAud19635ww1gMGu',NULL,'2021-05-06 02:48:45','2021-05-17 06:45:13',NULL,'C','No',33);
INSERT INTO `users` VALUES (42,'Edgar Ambrosio','esamuelambrosio99@gmail.com',NULL,'$2y$10$3djr/auy3IAptfUNU/wLPeqNXVUIiEJkj4qryJQ1IS4UYYeEsUZZ2','ssM8HtUESrDWmZOKxMYQXUCnyaKiMelhlCBzFolXF8ui8ZFddo6jEw4noy5c','2021-05-08 03:54:29','2021-05-08 03:54:29',NULL,NULL,NULL,31);
INSERT INTO `users` VALUES (43,'Nueva funeraria de prueba','prueba@test.com',NULL,'$2y$10$7gTqtSj6v/20B02wThrhhe.BRbAomnqG5Stl9FufXYDd0LAgB4ZXS',NULL,'2021-05-08 03:56:51','2021-05-17 06:57:10',NULL,'C','No',34);
INSERT INTO `users` VALUES (44,'Funeraria UM','um@funeraria.com',NULL,'$2y$10$67IeVOKEz7AAtejYqn8J3OdadqBLgnnXjw77pm2Uob549A4BgGw0y',NULL,'2021-05-08 04:20:05','2021-05-17 06:59:32',NULL,'C','No',35);
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

-- Dump completed on 2021-05-17 14:58:53
