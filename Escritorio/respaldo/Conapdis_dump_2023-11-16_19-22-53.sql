-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: conapdis
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artificios`
--

DROP TABLE IF EXISTS `artificios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artificios` (
  `id` varchar(10) NOT NULL,
  `nombre_artificio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artificios`
--

LOCK TABLES `artificios` WRITE;
/*!40000 ALTER TABLE `artificios` DISABLE KEYS */;
INSERT INTO `artificios` VALUES ('-ortesis','Ortesis'),('-protesis','Protesis');
/*!40000 ALTER TABLE `artificios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atencion_recibida`
--

DROP TABLE IF EXISTS `atencion_recibida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atencion_recibida` (
  `id` varchar(10) NOT NULL,
  `nombre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atencion_recibida`
--

LOCK TABLES `atencion_recibida` WRITE;
/*!40000 ALTER TABLE `atencion_recibida` DISABLE KEYS */;
INSERT INTO `atencion_recibida` VALUES ('-audio','Audiometria'),('-ayudatec','Ayuda Tecnica'),('-encuen','Encuentro'),('-jorna','Jornada'),('-orientado','Orientado'),('-orte','Ortesis'),('-prote','Protesis'),('-remitido','Remitido'),('-taller','Taller');
/*!40000 ALTER TABLE `atencion_recibida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atenciones`
--

DROP TABLE IF EXISTS `atenciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atenciones` (
  `numero_aten` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `fecha_aten` date DEFAULT NULL,
  `atencion_solicitada` text DEFAULT NULL,
  `atencion_recibida` varchar(10) DEFAULT NULL,
  `atencion_brindada` varchar(10) DEFAULT NULL,
  `statu` text DEFAULT NULL,
  `por` int(12) DEFAULT NULL,
  PRIMARY KEY (`numero_aten`),
  KEY `cedula` (`cedula`),
  KEY `atencion_recibida` (`atencion_recibida`),
  KEY `atencion_brindada` (`atencion_brindada`),
  KEY `por` (`por`),
  CONSTRAINT `atenciones_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `atenciones_ibfk_2` FOREIGN KEY (`atencion_recibida`) REFERENCES `tipo_ayuda_tecnica` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `atenciones_ibfk_3` FOREIGN KEY (`atencion_brindada`) REFERENCES `atencion_recibida` (`id`) ON DELETE CASCADE,
  CONSTRAINT `atenciones_ibfk_4` FOREIGN KEY (`por`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atenciones`
--

LOCK TABLES `atenciones` WRITE;
/*!40000 ALTER TABLE `atenciones` DISABLE KEYS */;
INSERT INTO `atenciones` VALUES (209,4581245,'2023-08-28',NULL,NULL,'-remitido','En espera',NULL),(214,4585899,'2023-10-23','Baston de apoyo',NULL,'-remitido','En espera',NULL),(215,30165406,'2023-10-23','Felula',NULL,'-remitido','En espera',NULL),(216,30165402,'2023-10-23','Silla de rueda ergonomica N18',NULL,'-remitido','En espera',NULL),(217,30165406,'2023-10-23','Muletas talla L',NULL,'-remitido','En espera',NULL),(218,13894817,'2023-10-23','Andadera',NULL,'-remitido','En espera',NULL),(224,30165406,'2023-10-23','Silla a motor',NULL,'-remitido','En espera',NULL),(241,124584,'2023-11-16','Silla a motor','21-sllm','-ayudatec','En espera',30165406),(242,124584,'2023-11-16','Muletas talla M','2-MuletasM','-ayudatec','En espera',30165406),(243,13711717,'2023-11-16','Muletas canadienses pediatricas','12-Mucp','-ayudatec','En espera',1111111),(244,137117171,'2023-11-16','Cojin antiescaras','20-Rglp','-ayudatec','En espera',1111111);
/*!40000 ALTER TABLE `atenciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atenciones_coordinaciones`
--

DROP TABLE IF EXISTS `atenciones_coordinaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atenciones_coordinaciones` (
  `asignado` int(12) DEFAULT NULL,
  `numero_aten` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `fecha_aten` date DEFAULT NULL,
  `atencion_solicitada` text DEFAULT NULL,
  `atencion_recibida` varchar(10) DEFAULT NULL,
  `atencion_brindada` varchar(10) DEFAULT NULL,
  `statu` text DEFAULT NULL,
  `por` int(12) DEFAULT NULL,
  PRIMARY KEY (`numero_aten`),
  KEY `cedula` (`cedula`),
  KEY `atencion_recibida` (`atencion_recibida`),
  KEY `atencion_brindada` (`atencion_brindada`),
  KEY `por` (`por`),
  KEY `asignado` (`asignado`),
  CONSTRAINT `atenciones_coordinaciones_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `atenciones_coordinaciones_ibfk_2` FOREIGN KEY (`atencion_recibida`) REFERENCES `tipo_ayuda_tecnica` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `atenciones_coordinaciones_ibfk_3` FOREIGN KEY (`atencion_brindada`) REFERENCES `atencion_recibida` (`id`) ON DELETE CASCADE,
  CONSTRAINT `atenciones_coordinaciones_ibfk_4` FOREIGN KEY (`por`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `atenciones_coordinaciones_ibfk_5` FOREIGN KEY (`asignado`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atenciones_coordinaciones`
--

LOCK TABLES `atenciones_coordinaciones` WRITE;
/*!40000 ALTER TABLE `atenciones_coordinaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `atenciones_coordinaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audiometria`
--

DROP TABLE IF EXISTS `audiometria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audiometria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `fecha_cita` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `audiometria_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audiometria`
--

LOCK TABLES `audiometria` WRITE;
/*!40000 ALTER TABLE `audiometria` DISABLE KEYS */;
/*!40000 ALTER TABLE `audiometria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ayudas_tec`
--

DROP TABLE IF EXISTS `ayudas_tec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ayudas_tec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_ayuda_tec` varchar(10) DEFAULT NULL,
  `cedula` int(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_ayuda_tec` (`tipo_ayuda_tec`,`cedula`),
  KEY `ayudas_tec_ibfk_1` (`cedula`),
  CONSTRAINT `ayudas_tec_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `ayudas_tec_ibfk_2` FOREIGN KEY (`tipo_ayuda_tec`) REFERENCES `tipo_ayuda_tecnica` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ayudas_tec`
--

LOCK TABLES `ayudas_tec` WRITE;
/*!40000 ALTER TABLE `ayudas_tec` DISABLE KEYS */;
/*!40000 ALTER TABLE `ayudas_tec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancosvzla`
--

DROP TABLE IF EXISTS `bancosvzla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bancosvzla` (
  `id-banco` int(11) NOT NULL,
  `nombre-Banco` text NOT NULL,
  PRIMARY KEY (`id-banco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancosvzla`
--

LOCK TABLES `bancosvzla` WRITE;
/*!40000 ALTER TABLE `bancosvzla` DISABLE KEYS */;
INSERT INTO `bancosvzla` VALUES (1,'BANCO CENTRAL DE VENEZUELA'),(102,'BANCO DE VENEZUELA S.A.C.A. BANCO UNIVERSAL'),(104,'VENEZOLANO DE CRÉDITO, S.A. BANCO UNIVERSAL'),(105,'BANCO MERCANTIL, C.A. S.A.C.A. BANCO UNIVERSAL'),(108,'BANCO PROVINCIAL, S.A. BANCO UNIVERSAL'),(114,'BANCO DEL CARIBE, C.A. BANCO UNIVERSAL'),(115,'BANCO EXTERIOR, C.A. BANCO UNIVERSAL'),(116,'BANCO OCCIDENTAL DE DESCUENTO BANCO UNIVERSAL, C.A.'),(128,'BANCO CARONI, C.A. BANCO UNIVERSAL'),(134,'BANESCO BANCO UNIVERSAL S.A.C.A.'),(137,'BANCO SOFITASA BANCO UNIVERSAL, C.A.'),(138,'BANCO PLAZA, BANCO UNIVERSAL C.A.'),(146,'BANCO DE LA GENTE EMPRENDEDORA BANGENTE, C.A.'),(149,'BANCO DEL PUEBLO SOBERANO, BANCO DE DESARROLLO'),(151,'BFC BANCO FONDO COMUN C.A. BANCO UNIVERSAL'),(157,'DELSUR BANCO UNIVERSAL, C.A.'),(163,'BANCO DEL TESORO, C.A. BANCO UNIVERSAL'),(166,'BANCO AGRICOLA DE VENEZUELA, C.A. BANCO UNIVERSAL'),(168,'BANCRECER S.A. BANCO DE DESARROLLO'),(169,'MI BANCO, BANCO MICROFINANCIERO, C.A.'),(171,'BANCO ACTIVO, C.A. BANCO UNIVERSAL'),(172,'BANCAMIGA BANCO MICROFINANCIERO, C.A.'),(173,'BANCO INTERNACIONAL DE DESARROLLO, C.A. BANCO UNIVERSAL'),(174,'BANPLUS BANCO UNIVERAL, C.A.'),(175,'BANCO BICENTENARIO BANCO UNIVERSAL, C.A.'),(176,'NOVO BANCO, S.A. SUCURSAL VENEZUELA BANCO UNIVERSAL'),(177,'BANCO DE LA FUERZA ARMADA NACIONAL BOLIVARIANA, B.U.'),(190,'CITIBANK N.A.'),(191,'BANCO NACIONAL CRÉDITO, C.A. BANCO UNIVERSAL');
/*!40000 ALTER TABLE `bancosvzla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ben_eliminados`
--

DROP TABLE IF EXISTS `ben_eliminados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ben_eliminados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) DEFAULT NULL,
  `nombre` text DEFAULT NULL,
  `apellido` text DEFAULT NULL,
  `discapacidad` varchar(10) DEFAULT NULL,
  `fecha_eliminacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ben_eliminados`
--

LOCK TABLES `ben_eliminados` WRITE;
/*!40000 ALTER TABLE `ben_eliminados` DISABLE KEYS */;
INSERT INTO `ben_eliminados` VALUES (38,30165406,'DEIKER','FERNANDEZ','TrstHemrr','2023-08-19 23:40:28'),(39,4857859,'Yaji','Lopez','Alzheimer','2023-08-20 14:46:44'),(40,30165403,'DEIKER','FERNANDEZ','Seguera_To','2023-08-20 14:46:45'),(41,30165404,'DEIKER','FERNANDEZ','Anacusia','2023-08-20 14:46:45'),(42,30165406,'deiker','Fernandez','IRC_HEMO','2023-08-20 14:46:45'),(43,30165406,'DEIKER','FERNANDEZ','Sordo','2023-08-21 10:21:36'),(44,4584875,'Miguel','Lopez','AparatoFon','2023-08-21 10:24:03'),(45,48445,'Kelvin','Pena','acondro','2023-08-21 10:24:48'),(46,34234,'valentina','corral','Sordo','2023-08-21 11:13:31'),(47,23445,'betania','herlo','acondro','2023-08-21 13:33:03'),(48,132444,'david','martinez','CegHipo','2023-08-21 13:33:17'),(49,654326,'carlos','ramirez','CegHipo','2023-08-21 14:04:25'),(50,123456,'maria','gonzalez','Baja_Visio','2023-08-22 16:06:08'),(51,301265401,'adsad','asddas','acondro','2023-08-23 12:50:31'),(52,151642,'asdasd','dadsd','acondro','2023-08-23 12:50:37'),(53,15848,'Kelvin','Pena','acondro','2023-08-24 09:38:28'),(54,62654,'Deiker','fernandez','acondro','2023-08-24 09:38:28'),(55,215154,'sdasd','sadasd','acondro','2023-08-24 09:38:28'),(56,484545,'Kelvin','Pela','AnemiaCrni','2023-08-24 09:38:28'),(57,521548,'Carol','Perez','Anacusia','2023-08-24 09:38:28'),(58,585548,'Kelvin','Pena','AnemiaCrni','2023-08-24 09:38:28'),(59,1515546,'Kelvin','Pel','acondro','2023-08-24 09:38:28'),(60,4582151,'pastor','contreras','acondro','2023-08-24 09:38:28'),(61,4584485,'Kelvin','contreras','acondro','2023-08-24 09:38:28'),(62,5145131,'Kelvin','Pelo','acondro','2023-08-24 09:38:28'),(63,20125151,'Kelvin','Plo','acondro','2023-08-24 09:38:28'),(64,30165402,'Deiker','Fernandez','Baja_Visio','2023-08-24 09:38:28'),(65,34341234,'VALENTINA','perez','acondro','2023-08-24 09:38:28'),(66,971423738,'gerardio','perez','DeficitDG','2023-08-24 09:38:28'),(67,123456,'Columba','Chapellin','1-AS/D','2023-09-02 17:12:26'),(68,10722053,'ELIBERTO ANTONIO','VAZQUEZ MEJIAS','DeficitDG','2023-09-15 20:32:09'),(69,12731757,'CAROLINA','CRESPO','1-AS/D','2023-10-26 12:31:24'),(70,28484435,'MIguel Angel','Lopez Gonzalez','1-AS/D','2023-10-26 12:31:59');
/*!40000 ALTER TABLE `ben_eliminados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beneficiario`
--

DROP TABLE IF EXISTS `beneficiario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiario` (
  `cedula` int(12) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `fecha_naci` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `edad` int(2) NOT NULL,
  `sexo` char(1) NOT NULL,
  `edo_civil` text NOT NULL,
  `nro_hijo` int(2) DEFAULT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `discapacidad` varchar(10) NOT NULL,
  `atencion_solicitada` varchar(10) NOT NULL,
  `certificado` varchar(50) DEFAULT NULL,
  `registrado_por` text DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`cedula`),
  KEY `estado` (`estado`),
  KEY `discapacidad` (`discapacidad`),
  KEY `atencion_solicitada` (`atencion_solicitada`),
  CONSTRAINT `beneficiario_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`),
  CONSTRAINT `beneficiario_ibfk_3` FOREIGN KEY (`atencion_solicitada`) REFERENCES `tipoatencion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `beneficiario_ibfk_4` FOREIGN KEY (`discapacidad`) REFERENCES `discapacid_e` (`id_e`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficiario`
--

LOCK TABLES `beneficiario` WRITE;
/*!40000 ALTER TABLE `beneficiario` DISABLE KEYS */;
INSERT INTO `beneficiario` VALUES (124584,'Carlos','Lopez Gonzalez','2002-09-18','hola@gmail.com','04120183670',21,'M','casado/a',2,'14','223','601','AnemiaCrni','1-oac','2','Deiker fernandez','2023-10-03'),(487848,'Maria Inalda','Gonzalez Torrealba','1979-09-18','hola@gmail.com','04120183670',44,'M','soltero/a',2,'1','1','1','motora','0-aten-coo','215487','Deiker fernandez','2023-10-26'),(1236655,'Alguien con ','apellido doble','2002-09-18','hola@gmail.com','04120183670',21,'M','casado/a',3,'4','36','107','VIH','1-oac','','Deiker fernandez','2023-11-02'),(1545856,'Carlos Jose','Fernandez carvajal','1976-09-21','alexis.veitia@gmail.com','04263059427',46,'M','casado/a',2,'10','104','333','Baja_Visio','3-orypro','','Deiker fernandez','2023-09-04'),(4549646,'Luis samen','carvajal','2002-09-18','deiker1842@gmail.com','04263059427',20,'M','casado/a',2,'13','179','515','VIH','0-aten-coo','','alexander','2023-09-09'),(4581245,'Kelvin','Perez','2002-09-18','kelvineitor3004@gmail.com','04241018208',20,'M','casado/a',2,'1','1','1','1-AS/D','0-aten-coo','','Deiker fernandez','2023-08-24'),(4585899,'Miguel','Palacios','2002-09-18','deiker1842@gmail.com','04263059427',20,'M','casado/a',2,'4','36','107','1-AS/D','0-aten-coo','','Deiker fernandez','2023-09-03'),(4858584,'Deiker José','Fernández Carvajal','2002-09-18','deiker1842@gmail.com','04120183670',20,'M','casado/a',2,'10','104','333','1-AS/D','0-aten-coo','','Deiker fernandez','2023-09-04'),(10722053,'ELIBERTO ANTONIO','VAZQUEZ MEJIAS','1969-02-24','Carmenguillerminalopez@gmail.com','04120183670',54,'M','casado/a',1,'24','462','1124','DeficitDG','0-aten-coo','1','Deiker fernandez','2023-09-16'),(12545859,'Carlos Sebastian','Perez Gonzalez','1995-12-17','deiker1842@gmail.com','04263059427',27,'M','soltero/a',1,'21','390','979','AparatoFon','0-aten-coo','52552525','alexander','2023-09-09'),(13711717,'DEIKER','FERNANDEZ','2001-09-18','deiker1842@gmail.com','04263059427',21,'M','casado/a',2,'4','36','107','1-AS/D','1-oac','','Deiker fernandez','2023-09-02'),(13894817,'EVELYN','FERNANDEZ','2002-09-18','deiker1842@gmail.com','04263059427',20,'M','casado/a',2,'12','144','457','1-AS/D','1-oac','','Deiker fernandez','2023-09-02'),(28484465,'hsf','dsdsd','1998-01-02','hola@gmail.com','04167045216',25,'M','casado/a',-1,'1','1','1','BVAnac','0-aten-coo','','Deiker fernandez','2023-10-05'),(30165402,'DEIKER','FERNANDEZ','2002-09-18','deiker1842@gmail.com','04263059427',20,'M','casado/a',2,'2','10','330','1-AS/D','1-oac','','Deiker fernandez','2023-09-06'),(30165406,'DEIKER','CHAPELLIN','2002-09-18','deiker1842@gmail.com','04263059427',20,'M','casado/a',2,'3','29','81','insuficie','1-oac','62626226626','Deiker fernandez','2023-09-02'),(48758452,'Evelyn Edidd','Chapellin Fuentes','1979-03-09','deiker1842@gmail.com','04263059427',44,'F','soltero/a',2,'14','241','648','AparatoFon','0-aten-coo','','Deiker fernandez','2023-10-23'),(137117171,'Columba','Chapellin','2002-09-18','deiker1842@gmail.com','04263059427',20,'M','casado/a',1,'7','77','258','1-AS/D','0-aten-coo','','Deiker fernandez','2023-09-06'),(137117175,'Deiker','CHAPELLIN','2002-09-18','deiker1842@gmail.com','04263059427',20,'M','casado/a',2,'3','29','81','1-AS/D','0-aten-coo','','Deiker fernandez','2023-09-03');
/*!40000 ALTER TABLE `beneficiario` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `beneficiario_AI` AFTER INSERT ON `beneficiario` FOR EACH ROW INSERT INTO reg_beneficiario(cedula, nombre, apellido, registrado_por, INSERTADO) 
VALUES(NEW.cedula, NEW.nombre, NEW.apellido, NEW.registrado_por, NOW()) */;;
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
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ELIMBEN_AD` AFTER DELETE ON `beneficiario` FOR EACH ROW INSERT INTO ben_eliminados ( cedula, nombre, apellido, discapacidad,  fecha_eliminacion) 
VALUES (OLD.cedula, OLD.nombre, OLD.apellido, OLD.discapacidad,  NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `caracteristicas_protesis`
--

DROP TABLE IF EXISTS `caracteristicas_protesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracteristicas_protesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_historia` int(11) NOT NULL,
  `tipo_rodilla` text NOT NULL,
  `tipo_pie` text NOT NULL,
  `tipo_socket` text NOT NULL,
  `clasificacion_socket` text NOT NULL,
  `metodo_suspension` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_cita` (`id_historia`),
  KEY `id_historia` (`id_historia`),
  CONSTRAINT `caracteristicas_protesis_ibfk_1` FOREIGN KEY (`id_historia`) REFERENCES `historia_medica_protesis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracteristicas_protesis`
--

LOCK TABLES `caracteristicas_protesis` WRITE;
/*!40000 ALTER TABLE `caracteristicas_protesis` DISABLE KEYS */;
INSERT INTO `caracteristicas_protesis` VALUES (8,19,'Convencional','Articulado','De succión','Cuadrilatero','Correa eslatica'),(9,20,'Convencional','Dinamico','Contacto total','Inclusion isquial','Correa a supracondilar');
/*!40000 ALTER TABLE `caracteristicas_protesis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita_ortesis_protesis`
--

DROP TABLE IF EXISTS `cita_ortesis_protesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita_ortesis_protesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `laboratorio` varchar(10) DEFAULT NULL,
  `fecha_cita` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laboratorio` (`laboratorio`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `cita_ortesis_protesis_ibfk_2` FOREIGN KEY (`laboratorio`) REFERENCES `laboratorio` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `cita_ortesis_protesis_ibfk_3` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita_ortesis_protesis`
--

LOCK TABLES `cita_ortesis_protesis` WRITE;
/*!40000 ALTER TABLE `cita_ortesis_protesis` DISABLE KEYS */;
INSERT INTO `cita_ortesis_protesis` VALUES (59,4549646,NULL,'2002-09-18'),(60,4549646,NULL,'2002-09-18'),(61,1545856,NULL,'2002-09-18'),(62,1545856,NULL,'2022-09-28'),(63,4858584,NULL,NULL);
/*!40000 ALTER TABLE `cita_ortesis_protesis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordinaciones_estadales`
--

DROP TABLE IF EXISTS `coordinaciones_estadales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coordinaciones_estadales` (
  `id` varchar(12) NOT NULL,
  `nombre_coordinacion` text NOT NULL,
  `municipio` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `municipio` (`municipio`),
  CONSTRAINT `coordinaciones_estadales_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordinaciones_estadales`
--

LOCK TABLES `coordinaciones_estadales` WRITE;
/*!40000 ALTER TABLE `coordinaciones_estadales` DISABLE KEYS */;
INSERT INTO `coordinaciones_estadales` VALUES ('C-amaz','Amazonas',NULL),('C-Anzo','Anzoátegui',NULL),('C-Apu','Apure',NULL),('C-Arag','Aragua',NULL),('C-Bar','Barinas',NULL),('C-Bolv','Bolivar',NULL),('C-Cbb','Carabobo',NULL),('C-Coj','Cojedes',NULL),('C-Dct','Distrito Capital',NULL),('C-Dlta','Delta Amacuro',NULL),('C-falc','Falcón',NULL),('C-guar','Guárico',NULL),('C-lar','Lara',NULL),('C-Lguai','La Guaira',NULL),('C-merid','Mérida',NULL),('C-miran','Miranda',NULL),('C-monag','Monagas',NULL),('C-Nva-es','Nueva Esparta',NULL),('C-port','Portuguesa',NULL),('C-sucr','Sucre',NULL),('C-tach','Táchira',NULL),('C-Trujillo','Trujillo',NULL),('C-Yarac','Yaracuy',NULL),('C-Zla','Zulia',NULL);
/*!40000 ALTER TABLE `coordinaciones_estadales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id` varchar(10) NOT NULL,
  `nombre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES ('1-Salud','D. Salud'),('2-M. Vivie','Mision Vivienda');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_cuidador`
--

DROP TABLE IF EXISTS `detalles_cuidador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_cuidador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(11) NOT NULL,
  `nombre` text DEFAULT NULL,
  `cedula_r` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `detalles_cuidador_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_cuidador`
--

LOCK TABLES `detalles_cuidador` WRITE;
/*!40000 ALTER TABLE `detalles_cuidador` DISABLE KEYS */;
INSERT INTO `detalles_cuidador` VALUES (128,12545859,'Carlos Sebastian','30165406');
/*!40000 ALTER TABLE `detalles_cuidador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_emprendimiento`
--

DROP TABLE IF EXISTS `detalles_emprendimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_emprendimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(11) DEFAULT NULL,
  `nombre_emprendimiento` text DEFAULT NULL,
  `rif_emprendimiento` varchar(50) DEFAULT NULL,
  `area_comercial` text DEFAULT NULL,
  `banco` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `detalles_emprendimiento_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_emprendimiento`
--

LOCK TABLES `detalles_emprendimiento` WRITE;
/*!40000 ALTER TABLE `detalles_emprendimiento` DISABLE KEYS */;
INSERT INTO `detalles_emprendimiento` VALUES (131,487848,'khjkhjk','545848','Artesanal','');
/*!40000 ALTER TABLE `detalles_emprendimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_institucionales`
--

DROP TABLE IF EXISTS `detalles_institucionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_institucionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(11) DEFAULT NULL,
  `proteccion_social` char(3) DEFAULT NULL,
  `institucion_registrado` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `detalles_institucionales_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_institucionales`
--

LOCK TABLES `detalles_institucionales` WRITE;
/*!40000 ALTER TABLE `detalles_institucionales` DISABLE KEYS */;
INSERT INTO `detalles_institucionales` VALUES (192,4581245,'no',NULL),(194,30165406,'no',NULL),(195,13894817,'no',NULL),(196,13711717,'no',NULL),(198,137117175,'no',NULL),(199,4585899,'no',NULL),(200,1545856,'no',NULL),(201,4858584,'no',NULL),(202,30165402,'no',NULL),(203,137117171,'no',NULL),(204,12545859,'no',NULL),(205,4549646,'no',NULL),(207,10722053,'no',NULL),(208,124584,'no',NULL),(209,28484465,'no',NULL),(211,48758452,'no',NULL),(212,487848,'si',NULL),(213,1236655,'no',NULL);
/*!40000 ALTER TABLE `detalles_institucionales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discapacid`
--

DROP TABLE IF EXISTS `discapacid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discapacid` (
  `nombre_discapacidad` text NOT NULL,
  `id_disca` varchar(10) NOT NULL,
  PRIMARY KEY (`id_disca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discapacid`
--

LOCK TABLES `discapacid` WRITE;
/*!40000 ALTER TABLE `discapacid` DISABLE KEYS */;
INSERT INTO `discapacid` VALUES ('Sin discapacidad','1-AS/D'),('Cardiovascular','10-cardiov'),('Hematológica','11-Hematol'),('Inmunológica','12-Inmunol'),('Respiratoria','13-Respira'),('Sistema Digestivo','14-S.Diges'),('Metabólico/endocrino','15-met/end'),('Músculo esquelética','2-m.esque'),('Acondroplasia','21-acondro'),('Nefrologicas','22-nefrol'),('Sindrome de weaver','23-weaver'),('Piel y estructuras relacionadas','24-piel'),('Neurologicos','25-neurol'),('Visual','3-visual'),('Auditiva','4-auditiva'),('Intelectual','6-intelec'),('Psicosocial','7-psicosoc'),('Sordoceguera','8-Sordoceg'),('Voz y habla','9-voz-habl');
/*!40000 ALTER TABLE `discapacid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discapacid_e`
--

DROP TABLE IF EXISTS `discapacid_e`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discapacid_e` (
  `nombre_e` text NOT NULL,
  `id_e` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `general` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_e`),
  KEY `general` (`general`),
  CONSTRAINT `discapacid_e_ibfk_1` FOREIGN KEY (`general`) REFERENCES `discapacid` (`id_disca`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discapacid_e`
--

LOCK TABLES `discapacid_e` WRITE;
/*!40000 ALTER TABLE `discapacid_e` DISABLE KEYS */;
INSERT INTO `discapacid_e` VALUES ('Sin discapacidad','1-AS/D','1-AS/D'),('Acondroplasia clásica','acondro','21-acondro'),('Alzheimer','Alzheimer','6-intelec'),('Anacusia','Anacusia','4-auditiva'),('Anemia Crónica','AnemiaCrni','11-Hematol'),('Ausencia del Aparato Fonador','AparatoFon','9-voz-habl'),('Baja Visión','Baja_Visio','3-visual'),('Baja Visión con Anacusia','BVAnac','8-Sordoceg'),('Baja Visión con Hipoacusia','BVHipo','8-Sordoceg'),('cardiopatía isquémica crónica','cardiopati','10-cardiov'),('Ceguera con Anacusia','CegAnac','8-Sordoceg'),('Ceguera con Hipoacusia','CegHipo','8-Sordoceg'),('Déficit del desarrollo global','DeficitDG','6-intelec'),('Disfunción Intestinal Crónica','DiscIntCr','14-S.Diges'),('Displasia distrófica','displasia','21-acondro'),('Distrofia muscular','Distrofia ','2-m.esque'),('Síndrome de Down','Down','6-intelec'),('enfermedad pulmonar obstructiva crónica','epoc','13-Respira'),('Eritema verrugoso','eritemaver','24-piel'),('Esclerodermia','escleroder','24-piel'),('Esclerosis Múltiple','esclerosis','25-neurol'),('Esquizofrenia','ESQ','7-psicosoc'),('Hidrocefalia','hidrocefal','25-neurol'),('Hipoacusia','Hipoacusia','4-auditiva'),('Hipocondroplásia','hipocondro','21-acondro'),('Insuficiencia Hepática','InsufHepat','14-S.Diges'),('insuficiencia cardiaca','insuficie','10-cardiov'),('Insuficiencia Renal Crónica en Hemodiálisis','IRC_HEMO','22-nefrol'),('Macrocefalia','macrocefal','25-neurol'),('Malformaciones cardiacas','Malformaci','10-cardiov'),('Microcefalia','microcefal','25-neurol'),('motora','motora','2-m.esque'),('Neurofibromatosis (bultos benignos en la piel)','neurofibro','24-piel'),('Obesidad Mórbida','Obesidad-M','15-met/end'),('Osteoacondrodisplásia','osteodispl','21-acondro'),('Parálisis cerebral','paralisis','25-neurol'),('Parkinson','parkinson','25-neurol'),('Pseudoacondroplásia','pseudoacon','21-acondro'),('Quemadura deformante de la piel','quemadurap','24-piel'),('Síndromes con afecciones cognitivas','S.Acogniti','6-intelec'),('Seguera Total','Seguera_To','3-visual'),('Sordoceguera','SordCeg','8-Sordoceg'),('Sordo','Sordo','4-auditiva'),('Síndrome de Weaver','SWeaver','23-weaver'),('Trastorno de ansiedad generalizado','TAG','7-psicosoc'),('Trastorno bipolar','TB','7-psicosoc'),('Trastornos del Espectro Autista TEA','TEA','7-psicosoc'),('Trastorno esquizo-afectivo','TESQAF','7-psicosoc'),('Trastornos Hemorrágicos','TrstHemrr','11-Hematol'),('La malformación de la vena de Galeno','vena_galen','25-neurol'),('Vestibular','Vestibular','4-auditiva'),('Inmunodeficiencias: VIH','VIH','12-Inmunol');
/*!40000 ALTER TABLE `discapacid_e` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuentros`
--

DROP TABLE IF EXISTS `encuentros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encuentros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_encuentro` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `actividad` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado` (`estado`,`municipio`),
  KEY `municipio` (`municipio`),
  KEY `parroquia` (`parroquia`),
  CONSTRAINT `encuentros_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  CONSTRAINT `encuentros_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE,
  CONSTRAINT `encuentros_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuentros`
--

LOCK TABLES `encuentros` WRITE;
/*!40000 ALTER TABLE `encuentros` DISABLE KEYS */;
INSERT INTO `encuentros` VALUES (12,'2024-02-01','2','10','330','charla');
/*!40000 ALTER TABLE `encuentros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escuela_comunitaria`
--

DROP TABLE IF EXISTS `escuela_comunitaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escuela_comunitaria` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `Tema` text NOT NULL,
  `comunidad` text NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `estado` (`estado`,`municipio`,`parroquia`),
  KEY `municipio` (`municipio`),
  KEY `parroquia` (`parroquia`),
  CONSTRAINT `escuela_comunitaria_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  CONSTRAINT `escuela_comunitaria_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`),
  CONSTRAINT `escuela_comunitaria_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escuela_comunitaria`
--

LOCK TABLES `escuela_comunitaria` WRITE;
/*!40000 ALTER TABLE `escuela_comunitaria` DISABLE KEYS */;
INSERT INTO `escuela_comunitaria` VALUES (16,'2023-04-12','2023-04-21','Cultura general','Alicia Benites','5','54','157'),(18,'2023-04-19','2023-04-19','Cultura general','Ni idea','8','91','294'),(19,'2023-08-24','2023-08-30','Sistemas','Alicia Benites','5','54','157');
/*!40000 ALTER TABLE `escuela_comunitaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_muñon`
--

DROP TABLE IF EXISTS `estado_muñon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_muñon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_historia` int(11) NOT NULL,
  `forma` text NOT NULL,
  `cicatriz` text NOT NULL,
  `piel` text NOT NULL,
  `musculatura` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_cita` (`id_historia`),
  KEY `id_historia` (`id_historia`),
  CONSTRAINT `estado_muñon_ibfk_1` FOREIGN KEY (`id_historia`) REFERENCES `historia_medica_protesis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `estado_muñon_ibfk_2` FOREIGN KEY (`id_historia`) REFERENCES `historia_medica_protesis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_muñon`
--

LOCK TABLES `estado_muñon` WRITE;
/*!40000 ALTER TABLE `estado_muñon` DISABLE KEYS */;
INSERT INTO `estado_muñon` VALUES (9,19,'Cilindrica','Sensible','Callosa','Firme'),(10,20,'Cilindrica','Sensible','Decolorada','Intermedia');
/*!40000 ALTER TABLE `estado_muñon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id_estados` varchar(10) NOT NULL,
  `nombre_estado` text NOT NULL,
  PRIMARY KEY (`id_estados`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES ('1','Amazonas'),('10','Falcón'),('11','Guárico'),('12','Lara'),('13','Mérida'),('14','Miranda'),('15','Monagas'),('16','Nueva Esparta'),('17','Portuguesa'),('18','Sucre'),('19','Táchira'),('2','Anzoátegui'),('20','Trujillo'),('21','La Guaira'),('22','Yaracuy'),('23','Zulia'),('24','Distrito Capital'),('25','Dependencias Federales'),('3','Apure'),('4','Aragua'),('5','Barinas'),('6','Bolívar'),('7','Carabobo'),('8','Cojedes'),('9','Delta Amacuro');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencia`
--

DROP TABLE IF EXISTS `gerencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencia` (
  `id` varchar(5) NOT NULL,
  `Nombre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencia`
--

LOCK TABLES `gerencia` WRITE;
/*!40000 ALTER TABLE `gerencia` DISABLE KEYS */;
INSERT INTO `gerencia` VALUES ('1Tec','Tecnologia'),('2Atc','Atencion Ciudadano'),('3Gtnd','Gestion y desarrollo social'),('4Gtno','Gestion operativa estadal'),('5Logi','Gestion logistica y infrastructura');
/*!40000 ALTER TABLE `gerencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historia_medica`
--

DROP TABLE IF EXISTS `historia_medica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historia_medica` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `artificio` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `artificio_medidas` text NOT NULL,
  `diseño` text DEFAULT NULL,
  `lado_afectado` text DEFAULT NULL,
  `zona_del_lado` text DEFAULT NULL,
  `nervio` text DEFAULT NULL,
  `tecnico` text DEFAULT NULL,
  `fecha_medidas` date DEFAULT NULL,
  `fecha_apertura` date DEFAULT NULL,
  `solicitud` text NOT NULL,
  `clasificacion` text DEFAULT NULL,
  `codigo_cita` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  KEY `artificio` (`artificio`),
  KEY `codigo_cita` (`codigo_cita`),
  CONSTRAINT `historia_medica_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `historia_medica_ibfk_2` FOREIGN KEY (`artificio`) REFERENCES `artificios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historia_medica_ibfk_3` FOREIGN KEY (`codigo_cita`) REFERENCES `cita_ortesis_protesis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia_medica`
--

LOCK TABLES `historia_medica` WRITE;
/*!40000 ALTER TABLE `historia_medica` DISABLE KEYS */;
INSERT INTO `historia_medica` VALUES (27,4549646,'-ortesis','ort-super','convencional','Derecho','hombro','Paralisis de plexo braquial',NULL,'2002-09-18','2023-10-19','Inmovulizador de hombro',NULL,60),(28,1545856,'-ortesis','ort-infe',NULL,NULL,NULL,NULL,NULL,'2002-09-18','2023-10-19','Aparato largo con banda pelvica',NULL,61);
/*!40000 ALTER TABLE `historia_medica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historia_medica_protesis`
--

DROP TABLE IF EXISTS `historia_medica_protesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historia_medica_protesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_cita` int(11) NOT NULL,
  `cedula` int(12) NOT NULL,
  `nivel_actividad` text NOT NULL,
  `lado_amputacion` text NOT NULL,
  `nivel_amputacion` text NOT NULL,
  `z_afectada` text NOT NULL,
  `estado_munon` int(11) DEFAULT NULL,
  `caracteristicas_pro` int(11) DEFAULT NULL,
  `diseno` text NOT NULL,
  `fecha_medidas` date NOT NULL,
  `fecha_cita` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_munon` (`estado_munon`,`caracteristicas_pro`),
  KEY `codigo_cita` (`codigo_cita`),
  KEY `caracteristicas_pro` (`caracteristicas_pro`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `historia_medica_protesis_ibfk_1` FOREIGN KEY (`estado_munon`) REFERENCES `estado_muñon` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historia_medica_protesis_ibfk_2` FOREIGN KEY (`caracteristicas_pro`) REFERENCES `caracteristicas_protesis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historia_medica_protesis_ibfk_3` FOREIGN KEY (`codigo_cita`) REFERENCES `cita_ortesis_protesis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historia_medica_protesis_ibfk_4` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia_medica_protesis`
--

LOCK TABLES `historia_medica_protesis` WRITE;
/*!40000 ALTER TABLE `historia_medica_protesis` DISABLE KEYS */;
INSERT INTO `historia_medica_protesis` VALUES (19,59,4549646,'Sedentaria','Derecho','Pierna','Desarticulado de pelvis',NULL,NULL,'Modulares','2002-09-18','2023-10-16'),(20,62,1545856,'Sedentaria','Derecho','Brazo','Metacarpiana',NULL,NULL,'Convencional','2022-09-28','2023-10-19');
/*!40000 ALTER TABLE `historia_medica_protesis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intentos_sesion`
--

DROP TABLE IF EXISTS `intentos_sesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intentos_sesion` (
  `cedula` int(11) NOT NULL,
  `intentos` int(11) NOT NULL DEFAULT 0,
  `ultimo_intento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intentos_sesion`
--

LOCK TABLES `intentos_sesion` WRITE;
/*!40000 ALTER TABLE `intentos_sesion` DISABLE KEYS */;
/*!40000 ALTER TABLE `intentos_sesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jornada`
--

DROP TABLE IF EXISTS `jornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jornada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `numero_personas` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `municipio` (`municipio`),
  KEY `estado` (`estado`),
  KEY `parroquia` (`parroquia`),
  CONSTRAINT `jornada_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE,
  CONSTRAINT `jornada_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE,
  CONSTRAINT `jornada_ibfk_3` FOREIGN KEY (`parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jornada`
--

LOCK TABLES `jornada` WRITE;
/*!40000 ALTER TABLE `jornada` DISABLE KEYS */;
/*!40000 ALTER TABLE `jornada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorio` (
  `id` varchar(10) NOT NULL,
  `nombre_laboratorio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorio`
--

LOCK TABLES `laboratorio` WRITE;
/*!40000 ALTER TABLE `laboratorio` DISABLE KEYS */;
INSERT INTO `laboratorio` VALUES ('4-tomedi','Toma medidas'),('5-pruebar','Prueba artificio'),('ortesis2','Laboratorio ortesis'),('protesis1','Laboratorio Protesis');
/*!40000 ALTER TABLE `laboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorios`
--

DROP TABLE IF EXISTS `laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lab` text NOT NULL,
  `estado` varchar(19) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` text NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorios`
--

LOCK TABLES `laboratorios` WRITE;
/*!40000 ALTER TABLE `laboratorios` DISABLE KEYS */;
INSERT INTO `laboratorios` VALUES (1,'LABORATORIO DE  ÓRTESIS Y PRÓTESIS  DR. NARCISO VELÁSQUEZ ','Anzoategui','Anaco ','Anaco ','SECTOR LAS COLINAS, AL LADO DE LA CLÍNICA MUNICIPAL','ORTOPROTESISANZOATEGUI@GMAIL.COM','0412-947-12-51'),(6,'LABORATORIO DE ÓRTESIS Y PRÓTESIS   DR. FRANCISCO ANTONIO RISQUEZ CARACAS ','Distrito capital','Libertador','San jose','COTIZA, AVENIDA PRINCIPAL, HOSPITAL DR. FRANCISCO ANTONIO RISQUEZ','ORTOPROTESISRISQUEZ@GMAIL.COM','0426-212-22-34'),(7,'LABORATORIO DE ÓRTESIS Y PRÓTESIS','Carabobo','Guacara','Guacara','COMUNAS GUERRA DE TACARIGUA SECTOR ARAGUITA, MUN. GUACARA','ORTOPROTESISCARABOBO@GMAIL.COM','0412-8361955'),(8,'LABORATORIO DE ÓRTESIS Y PRÓTESIS   AMBULATORIO TIPO  III DR. DANIEL CAMEJO ACOSTA','Lara',' IRIBARREN','IRIBARREN','AMBULATORIO TIPO III DR. DANIEL CAMEJO ACOSTA, SECTOR OESTE, REDOMA EL OBELISCO AV. ROTARIA Y FLORENCIO JIMÉNEZ  ','ORTOPROTESISLARAAMB@GMAIL.COM','0412-095-41-29'),(9,'LABORATORIO DE ÓRTESIS Y PRÓTESIS   HOSPITAL UNIVERSITARIO DE LOS ANDES','Merida','LIBERTADOR','DOMINGO PEÑA',' CALLES CAMPO DE ORO, HOSPITAL UNIVERSITARIO DE LOS ANDES.','ORTOPROTESISMERIDA@GMAIL.COM','0414-758-15-73'),(10,'LABORATORIO DE ÓRTESIS Y PRÓTESIS  DR. JOSÉ GREGORIO HERNÁNDEZ','Miranda','GUACAIPURO','LOS TEQUES',' AVENIDA VÍCTOR BAPTISTA, CORPORACIÓN DE SALUD ESTADO MIRANDA,  A UNA CUADRA DE LA ESTACIÓN DEL METRO ALÍ PRIMERA ','ORTOPROTESISMIRANDA@GMAIL.COM','0412-579-92-17 '),(11,'LABORATORIO DE ÓRTESIS Y PRÓTESIS  HOSPITAL UNIVERSITARIO DE MARACAIBO','Zulia','MARACAIBO','JUANA DE AVILA',' AVENIDA 16 GUAJIRA, VÍA A ZIRUMA, FRENTE A ANTIGUO RECTORADO LUZ, AVENIDA 16.','ORTOPROTESISZULIA@GMAIL.COM','0426-1231426'),(12,'LABORATORIO DE ÓRTESIS Y PRÓTESIS  “HOSPITAL DR. JULIO RODRÍGUEZ”','Sucre','SUCRE ','ALTAGRACIA','CUMANA AV. PRINCIPAL DE LOS COCOS,  AL LADO DE LA FARMACIA DE ALTO COSTO DEL SEGURO SOCIAL','ORTOPROTESISSUCRE@GMAIL.COM','0424-848-90-32'),(13,'LABORATORIO DE ÓRTESIS Y PRÓTESIS  “DR. TORIBIO GARCÍA RODRIGUEZ”','Nueva Esparta','Nueva Esparta','LA ASUNCION','AV. CONSTITUCION EDIFICIO IPASME PISO 1.','ORTOPROTESISNUEVAESPARTA@GMAIL.COM','0412-3599216');
/*!40000 ALTER TABLE `laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos_escuela`
--

DROP TABLE IF EXISTS `modulos_escuela`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos_escuela` (
  `id_curso` int(11) NOT NULL,
  `profesor` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `nombre_modulo` text NOT NULL,
  `contenido` text NOT NULL,
  `modulo` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`modulo`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `modulos_escuela_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `escuela_comunitaria` (`id_curso`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos_escuela`
--

LOCK TABLES `modulos_escuela` WRITE;
/*!40000 ALTER TABLE `modulos_escuela` DISABLE KEYS */;
INSERT INTO `modulos_escuela` VALUES (16,'Deiker fernandez','2023-04-20','07:00:00','Modulo  I','JIIIIIIIIIIIII',3),(16,'Deiker fernandez','2023-04-22','14:56:00','Modulo  II','hhhhhh',4),(16,'Pedro perez','2023-04-19','07:00:00','Modulo III','Lorem ipsum es el texto que se usa habitualmente en diseÃ±o grÃ¡fico en demostraciones de tipografÃ­as o de borradores de diseÃ±o para probar el diseÃ±o visual antes de insertar el texto final',5),(16,'Alexis Veitia','2023-05-05','07:00:00','Modulo iV','Planificacion de un juego',6),(18,'Deiker fernandez','2023-04-19','08:00:00','Modulo  I','AAAAAAAA',7),(18,'Alexis Veitia','2023-04-06','20:00:00','Modulo  II','AAAAAAAAAAAAAAAAA',8),(18,'Pedro perez','2023-04-21','22:00:00','Modulo iV','Proporcionalidad y porcentaje.',9),(19,'Pedro perez','2002-09-18','06:30:00','Modulo  I',',jl,jhlj',10);
/*!40000 ALTER TABLE `modulos_escuela` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipios` (
  `id_municipios` varchar(20) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `nombre` text NOT NULL,
  PRIMARY KEY (`id_municipios`),
  KEY `estado` (`estado`),
  CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id_estados`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` VALUES ('1','1','Alto Orinoco'),('10','2','Manuel Ezequiel Bruzual'),('100','9','Antonio Díaz'),('101','9','Casacoima'),('102','9','Pedernales'),('103','9','Tucupita'),('104','10','Acosta'),('105','10','Bolívar'),('106','10','Buchivacoa'),('107','10','Cacique Manaure'),('108','10','Carirubana'),('109','10','Colina'),('11','2','Diego Bautista Urbaneja'),('110','10','Dabajuro'),('111','10','Democracia'),('112','10','Falcon'),('113','10','Federacion'),('114','10','Jacura'),('115','10','Jose Laurencio Silva'),('116','10','Los Taques'),('117','10','Mauroa'),('118','10','Miranda'),('119','10','Monseñor Iturriza'),('12','2','Fernando Peñalver'),('120','10','Palmasola'),('121','10','Petit'),('122','10','Piritu'),('123','10','San Francisco'),('124','10','Sucre'),('125','10','Tocopero'),('126','10','Union'),('127','10','Urumaco'),('128','10','Zamora'),('129','11','Camaguan'),('13','2','Francisco Del Carmen Carvajal'),('130','11','Chaguaramas'),('131','11','El Socorro'),('132','11','Jose Felix Ribas'),('133','11','Jose Tadeo Monagas'),('134','11','Juan German Roscio'),('135','11','Julian Mellado'),('136','11','Las Mercedes'),('137','11','Leonardo Infante'),('138','11','Pedro Zaraza'),('139','11','Ortíz'),('14','2','General Sir Arthur McGregor'),('140','11','San Geronimo de Guayabal'),('141','11','San Jose de Guaribe'),('142','11','Santa Maria de Ipire'),('143','11','Sebastian Francisco de Miranda'),('144','12','Andres Eloy Blanco'),('145','12','Crespo'),('146','12','Iribarren'),('147','12','Jiménez'),('148','12','Moran'),('149','12','Palavecino'),('15','2','Guanta'),('150','12','Simon Planas'),('151','12','Torres'),('152','12','Urdaneta'),('16','2','Independencia'),('17','2','Jose Gregorio Monagas'),('179','13','Alberto Adriani'),('18','2','Juan Antonio Sotillo'),('180','13','Andres Bello'),('181','13','Antonio Pinto Salinas'),('182','13','Aricagua'),('183','13','Arzobispo Chacón'),('184','13','Campo Elias'),('185','13','Caracciolo Parra Olmedo'),('186','13','Cardenal Quintero'),('187','13','Guaraque'),('188','13','Julio Cesar Salas'),('189','13','Justo Briceño'),('19','2','Juan Manuel Cajigal'),('190','13','Libertador'),('191','13','Miranda'),('192','13','Obispo Ramos de Lora'),('193','13','Padre Noguera'),('194','13','Pueblo Llano'),('195','13','Rangel'),('196','13','Rivas Dávila'),('197','13','Santos Marquina'),('198','13','Sucre'),('199','13','Tovar'),('2','1','Atabapo'),('20','2','Libertad'),('200','13','Tulio Febres Cordero'),('201','13','Zea'),('21','2','Francisco de Miranda'),('22','2','Pedro María Freites'),('223','14','Acevedo'),('224','14','Andrés Bello'),('225','14','Baruta'),('226','14','Brión'),('227','14','Buroz'),('228','14','Carrizal'),('229','14','Chacao'),('23','2','Píritu'),('230','14','Cristóbal Rojas'),('231','14','El Hatillo'),('232','14','Guaicaipuro'),('233','14','Independencia'),('234','14','Lander'),('235','14','Los Salias'),('236','14','Páez'),('237','14','Paz Castillo'),('238','14','Pedro Gual'),('239','14','Plaza'),('24','2','San José de Guanipa'),('240','14','Simón Bolívar'),('241','14','Sucre'),('242','14','Urdaneta'),('243','14','Zamora'),('25','2','San Juan de Capistrano'),('258','15','Acosta'),('259','15','Aguasay'),('26','2','Santa Ana'),('260','15','Bolívar'),('261','15','Caripe'),('262','15','Cedeño'),('263','15','Ezequiel Zamora'),('264','15','Libertador'),('265','15','Maturín'),('266','15','Piar'),('267','15','Punceres'),('268','15','Santa Bárbara'),('269','15','Sotillo'),('27','2','Simón Bolívar'),('270','15','Uracoa'),('271','16','Antolín del Campo'),('272','16','Arismendi'),('273','16','García'),('274','16','Gómez'),('275','16','Maneiro'),('276','16','Marcano'),('277','16','Mariño'),('278','16','Península de Macanao'),('279','16','Tubores'),('28','2','Simón Rodríguez'),('280','16','Villalba'),('281','16','Díaz'),('282','17','Agua Blanca'),('283','17','Araure'),('284','17','Esteller'),('285','17','Guanare'),('286','17','Guanarito'),('287','17','Monseñor José Vicente de Unda'),('288','17','Ospino'),('289','17','Páez'),('29','3','Achaguas'),('290','17','Papelón'),('291','17','San Genaro de Boconoíto'),('292','17','San Rafael de Onoto'),('293','17','Santa Rosalía'),('294','17','Sucre'),('295','17','Turén'),('296','18','Andrés Eloy Blanco'),('297','18','Andrés Mata'),('298','18','Arismendi'),('299','18','Benítez'),('3','1','Atures'),('30','3','Biruaca'),('300','18','Bermúdez'),('301','18','Bolívar'),('302','18','Cajigal'),('303','18','Cruz Salmerón Acosta'),('304','18','Libertador'),('305','18','Mariño'),('306','18','Mejía'),('307','18','Montes'),('308','18','Ribero'),('309','18','Sucre'),('31','3','Muñóz'),('310','18','Valdéz'),('32','3','Páez'),('33','3','Pedro Camejo'),('34','3','Rómulo Gallegos'),('341','19','Andrés Bello'),('342','19','Antonio Rómulo Costa'),('343','19','Ayacucho'),('344','19','Bolívar'),('345','19','Cárdenas'),('346','19','Córdoba'),('347','19','Fernández Feo'),('348','19','Francisco de Miranda'),('349','19','García de Hevia'),('35','3','San Fernando'),('350','19','Guásimos'),('351','19','Independencia'),('352','19','Jáuregui'),('353','19','José María Vargas'),('354','19','Junín'),('355','19','Libertad'),('356','19','Libertador'),('357','19','Lobatera'),('358','19','Michelena'),('359','19','Panamericano'),('36','4','Atanasio Girardot'),('360','19','Pedro María Ureña'),('361','19','Rafael Urdaneta'),('362','19','Samuel Darío Maldonado'),('363','19','San Cristóbal'),('364','19','Seboruco'),('365','19','Simón Rodríguez'),('366','19','Sucre'),('367','19','Torbes'),('368','19','Uribante'),('369','19','San Judas Tadeo'),('37','4','Bolívar'),('370','20','Andrés Bello'),('371','20','Boconó'),('372','20','Bolívar'),('373','20','Candelaria'),('374','20','Carache'),('375','20','Escuque'),('376','20','José Felipe Márquez Cañizalez'),('377','20','Juan Vicente Campos Elías'),('378','20','La Ceiba'),('379','20','Miranda'),('38','4','Camatagua'),('380','20','Monte Carmelo'),('381','20','Motatán'),('382','20','Pampán'),('383','20','Pampanito'),('384','20','Rafael Rangel'),('385','20','San Rafael de Carvajal'),('386','20','Sucre'),('387','20','Trujillo'),('388','20','Urdaneta'),('389','20','Valera'),('39','4','Francisco Linares Alcántara'),('390','21','Vargas'),('391','22','Arístides Bastidas'),('392','22','Bolívar'),('4','1','Autana'),('40','4','José Ángel Lamas'),('407','22','Bruzual'),('408','22','Cocorote'),('409','22','Independencia'),('41','4','José Félix Ribas'),('410','22','José Antonio Páez'),('411','22','La Trinidad'),('412','22','Manuel Monge'),('413','22','Nirgua'),('414','22','Peña'),('415','22','San Felipe'),('416','22','Sucre'),('417','22','Urachiche'),('418','22','José Joaquín Veroes'),('42','4','José Rafael Revenga'),('43','4','Libertador'),('44','4','Mario Briceño Iragorry'),('441','23','Almirante Padilla'),('442','23','Baralt'),('443','23','Cabimas'),('444','23','Catatumbo'),('445','23','Colón'),('446','23','Francisco Javier Pulgar'),('447','23','Páez'),('448','23','Jesús Enrique Losada'),('449','23','Jesús María Semprún'),('45','4','Ocumare de la Costa de Oro'),('450','23','La Cañada de Urdaneta'),('451','23','Lagunillas'),('452','23','Machiques de Perijá'),('453','23','Mara'),('454','23','Maracaibo'),('455','23','Miranda'),('456','23','Rosario de Perijá'),('457','23','San Francisco'),('458','23','Santa Rita'),('459','23','Simón Bolívar'),('46','4','San Casimiro'),('460','23','Sucre'),('461','23','Valmore Rodríguez'),('462','24','Libertador'),('47','4','San Sebastián'),('48','4','Santiago Mariño'),('49','4','Santos Michelena'),('5','1','Manapiare'),('50','4','Sucre'),('51','4','Tovar'),('52','4','Urdaneta'),('53','4','Zamora'),('54','5','Alberto Arvelo Torrealba'),('55','5','Andrés Eloy Blanco'),('56','5','Antonio José de Sucre'),('57','5','Arismendi'),('58','5','Barinas'),('59','5','Bolívar'),('6','1','Maroa'),('60','5','Cruz Paredes'),('61','5','Ezequiel Zamora'),('62','5','Obispos'),('63','5','Pedraza'),('64','5','Rojas'),('65','5','Sosa'),('66','6','Caroní'),('67','6','Cedeño'),('68','6','El Callao'),('69','6','Gran Sabana'),('7','1','Río Negro'),('70','6','Heres'),('71','6','Piar'),('72','6','Angostura (Raúl Leoni)'),('73','6','Roscio'),('74','6','Sifontes'),('75','6','Sucre'),('76','6','Padre Pedro Chien'),('77','7','Bejuma'),('78','7','Carlos Arvelo'),('79','7','Diego Ibarra'),('8','2','Anaco'),('80','7','Guacara'),('81','7','Juan José Mora'),('82','7','Libertador'),('83','7','Los Guayos'),('84','7','Miranda'),('85','7','Montalbán'),('86','7','Naguanagua'),('87','7','Puerto Cabello'),('88','7','San Diego'),('89','7','San Joaquín'),('9','2','Aragua'),('90','7','Valencia'),('91','8','Anzoátegui'),('92','8','Tinaquillo'),('93','8','Girardot'),('94','8','Lima Blanco'),('95','8','Pao de San Juan Bautista'),('96','8','Ricaurte'),('97','8','Rómulo Gallegos'),('98','8','San Carlos'),('99','8','Tinaco');
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orientaciones`
--

DROP TABLE IF EXISTS `orientaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orientaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `fecha_orientacion` date NOT NULL,
  `cedula` int(11) NOT NULL,
  `por` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  KEY `por` (`por`),
  CONSTRAINT `orientaciones_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `orientaciones_ibfk_2` FOREIGN KEY (`por`) REFERENCES `usuario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orientaciones`
--

LOCK TABLES `orientaciones` WRITE;
/*!40000 ALTER TABLE `orientaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `orientaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ortesis`
--

DROP TABLE IF EXISTS `ortesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ortesis` (
  `id` varchar(10) NOT NULL,
  `nombre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ortesis`
--

LOCK TABLES `ortesis` WRITE;
/*!40000 ALTER TABLE `ortesis` DISABLE KEYS */;
INSERT INTO `ortesis` VALUES ('ort-infe','Ortesis inferior'),('ort-super','Ortesis superior');
/*!40000 ALTER TABLE `ortesis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parroquia`
--

DROP TABLE IF EXISTS `parroquia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parroquia` (
  `id` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `nombre_parroquia` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `municipio` (`municipio`),
  CONSTRAINT `parroquia_ibfk_2` FOREIGN KEY (`municipio`) REFERENCES `municipios` (`id_municipios`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parroquia`
--

LOCK TABLES `parroquia` WRITE;
/*!40000 ALTER TABLE `parroquia` DISABLE KEYS */;
INSERT INTO `parroquia` VALUES ('1','1','Alto Orinoco'),('10','3','Luis Alberto Gómez'),('100','33','Cunaviche'),('1000','413','Nirgua'),('1001','414','San Andrés'),('1002','414','Yaritagua'),('1003','415','San Javier'),('1004','415','Albarico'),('1005','415','San Felipe'),('1006','416','Sucre'),('1007','417','Urachiche'),('1008','418','El Guayabo'),('1009','418','Farriar'),('101','34','Elorza'),('1010','441','Isla de Toas'),('1011','441','Monagas'),('1012','442','San Timoteo'),('1013','442','General Urdaneta'),('1014','442','Libertador'),('1015','442','Marcelino Briceño'),('1016','442','Pueblo Nuevo'),('1017','442','Manuel Guanipa Matos'),('1018','443','Ambrosio'),('1019','443','Carmen Herrera'),('102','34','La Trinidad'),('1020','443','La Rosa'),('1021','443','Germán Ríos Linares'),('1022','443','San Benito'),('1023','443','Rómulo Betancourt'),('1024','443','Jorge Hernández'),('1025','443','Punta Gorda'),('1026','443','Arístides Calvani'),('1027','444','Encontrados'),('1028','444','Udón Pérez'),('1029','445','Moralito'),('103','35','San Fernando'),('1030','445','San Carlos del Zulia'),('1031','445','Santa Cruz del Zulia'),('1032','445','Santa Bárbara'),('1033','445','Urribarrí'),('1034','446','Carlos Quevedo'),('1035','446','Francisco Javier Pulgar'),('1036','446','Simón Rodríguez'),('1037','446','Guamo-Gavilanes'),('1038','448','La Concepción'),('1039','448','San José'),('104','35','El Recreo'),('1040','448','Mariano Parra León'),('1041','448','José Ramón Yépez'),('1042','449','Jesús María Semprún'),('1043','449','Barí'),('1044','450','Concepción'),('1045','450','Andrés Bello'),('1046','450','Chiquinquirá'),('1047','450','El Carmelo'),('1048','450','Potreritos'),('1049','451','Libertad'),('105','35','Peñalver'),('1050','451','Alonso de Ojeda'),('1051','451','Venezuela'),('1052','451','Eleazar López Contreras'),('1053','451','Campo Lara'),('1054','452','Bartolomé de las Casas'),('1055','452','Libertad'),('1056','452','Río Negro'),('1057','452','San José de Perijá'),('1058','453','San Rafael'),('1059','453','La Sierrita'),('106','35','San Rafael de Atamaica'),('1060','453','Las Parcelas'),('1061','453','Luis de Vicente'),('1062','453','Monseñor Marcos Sergio Godoy'),('1063','453','Ricaurte'),('1064','453','Tamare'),('1065','454','Antonio Borjas Romero'),('1066','454','Bolívar'),('1067','454','Cacique Mara'),('1068','454','Carracciolo Parra Pérez'),('1069','454','Cecilio Acosta'),('107','36','Pedro José Ovalles'),('1070','454','Cristo de Aranza'),('1071','454','Coquivacoa'),('1072','454','Chiquinquirá'),('1073','454','Francisco Eugenio Bustamante'),('1074','454','Idelfonzo Vásquez'),('1075','454','Juana de Ávila'),('1076','454','Luis Hurtado Higuera'),('1077','454','Manuel Dagnino'),('1078','454','Olegario Villalobos'),('1079','454','Raúl Leoni'),('108','36','Joaquín Crespo'),('1080','454','Santa Lucía'),('1081','454','Venancio Pulgar'),('1082','454','San Isidro'),('1083','455','Altagracia'),('1084','455','Faría'),('1085','455','Ana María Campos'),('1086','455','San Antonio'),('1087','455','San José'),('1088','456','Donaldo García'),('1089','456','El Rosario'),('109','36','José Casanova Godoy'),('1090','456','Sixto Zambrano'),('1091','457','San Francisco'),('1092','457','El Bajo'),('1093','457','Domitila Flores'),('1094','457','Francisco Ochoa'),('1095','457','Los Cortijos'),('1096','457','Marcial Hernández'),('1097','458','Santa Rita'),('1098','458','El Mene'),('1099','458','Pedro Lucas Urribarrí'),('11','3','Pahueña Limón de Parhueña'),('110','36','Madre María de San José'),('1100','458','José Cenobio Urribarrí'),('1101','459','Rafael Maria Baralt'),('1102','459','Manuel Manrique'),('1103','459','Rafael Urdaneta'),('1104','460','Bobures'),('1105','460','Gibraltar'),('1106','460','Heras'),('1107','460','Monseñor Arturo Álvarez'),('1108','460','Rómulo Gallegos'),('1109','460','El Batey'),('111','36','Andrés Eloy Blanco'),('1110','461','Rafael Urdaneta'),('1111','461','La Victoria'),('1112','461','Raúl Cuenca'),('1113','447','Sinamaica'),('1114','447','Alta Guajira'),('1115','447','Elías Sánchez Rubio'),('1116','447','Guajira'),('1117','462','Altagracia'),('1118','462','Antímano'),('1119','462','Caricuao'),('112','36','Los Tacarigua'),('1120','462','Catedral'),('1121','462','Coche'),('1122','462','El Junquito'),('1123','462','El Paraíso'),('1124','462','El Recreo'),('1125','462','El Valle'),('1126','462','La Candelaria'),('1127','462','La Pastora'),('1128','462','La Vega'),('1129','462','Macarao'),('113','36','Las Delicias'),('1130','462','San Agustín'),('1131','462','San Bernardino'),('1132','462','San José'),('1133','462','San Juan'),('1134','462','San Pedro'),('1135','462','Santa Rosalía'),('1136','462','Santa Teresa'),('1137','462','Sucre (Catia)'),('1138','462','23 de enero'),('114','36','Choroní'),('115','37','Bolívar'),('116','38','Camatagua'),('117','38','Carmen de Cura'),('118','39','Santa Rita'),('119','39','Francisco de Miranda'),('12','3','Platanillal Platanillal'),('120','39','Moseñor Feliciano González'),('121','40','Santa Cruz'),('122','41','José Félix Ribas'),('123','41','Castor Nieves Ríos'),('124','41','Las Guacamayas'),('125','41','Pao de Zárate'),('126','41','Zuata'),('127','42','José Rafael Revenga'),('128','43','Palo Negro'),('129','43','San Martín de Porres'),('13','4','Samariapo'),('130','44','El Limón'),('131','44','Caña de Azúcar'),('132','45','Ocumare de la Costa'),('133','46','San Casimiro'),('134','46','Güiripa'),('135','46','Ollas de Caramacate'),('136','46','Valle Morín'),('137','47','San Sebastían'),('138','48','Turmero'),('139','48','Arevalo Aponte'),('14','4','Sipapo'),('140','48','Chuao'),('141','48','Samán de Güere'),('142','48','Alfredo Pacheco Miranda'),('143','49','Santos Michelena'),('144','49','Tiara'),('145','50','Cagua'),('146','50','Bella Vista'),('147','51','Tovar'),('148','52','Urdaneta'),('149','52','Las Peñitas'),('15','4','Munduapo'),('150','52','San Francisco de Cara'),('151','52','Taguay'),('152','53','Zamora'),('153','53','Magdaleno'),('154','53','San Francisco de Asís'),('155','53','Valles de Tucutunemo'),('156','53','Augusto Mijares'),('157','54','Sabaneta'),('158','54','Juan Antonio Rodríguez Domínguez'),('159','55','El Cantón'),('16','4','Guayapo'),('160','55','Santa Cruz de Guacas'),('161','55','Puerto Vivas'),('162','56','Ticoporo'),('163','56','Nicolás Pulido'),('164','56','Andrés Bello'),('165','57','Arismendi'),('166','57','Guadarrama'),('167','57','La Unión'),('168','57','San Antonio'),('169','58','Barinas'),('17','5','Alto Ventuari'),('170','58','Alberto Arvelo Larriva'),('171','58','San Silvestre'),('172','58','Santa Inés'),('173','58','Santa Lucía'),('174','58','Torumos'),('175','58','El Carmen'),('176','58','Rómulo Betancourt'),('177','58','Corazón de Jesús'),('178','58','Ramón Ignacio Méndez'),('179','58','Alto Barinas'),('18','5','Medio Ventuari'),('180','58','Manuel Palacio Fajardo'),('181','58','Juan Antonio Rodríguez Domínguez'),('182','58','Dominga Ortiz de Páez'),('183','59','Barinitas'),('184','59','Altamira de Cáceres'),('185','59','Calderas'),('186','60','Barrancas'),('187','60','El Socorro'),('188','60','Mazparrito'),('189','61','Santa Bárbara'),('19','5','Bajo Ventuari'),('190','61','Pedro Briceño Méndez'),('191','61','Ramón Ignacio Méndez'),('192','61','José Ignacio del Pumar'),('193','62','Obispos'),('194','62','Guasimitos'),('195','62','El Real'),('196','62','La Luz'),('197','63','Ciudad Bolívia'),('198','63','José Ignacio Briceño'),('199','63','José Félix Ribas'),('2','1','Huachamacare Acanaña'),('20','6','Victorino'),('200','63','Páez'),('201','64','Libertad'),('202','64','Dolores'),('203','64','Santa Rosa'),('204','64','Palacio Fajardo'),('205','65','Ciudad de Nutrias'),('206','65','El Regalo'),('207','65','Puerto Nutrias'),('208','65','Santa Catalina'),('209','66','Cachamay'),('21','6','Comunidad'),('210','66','Chirica'),('211','66','Dalla Costa'),('212','66','Once de Abril'),('213','66','Simón Bolívar'),('214','66','Unare'),('215','66','Universidad'),('216','66','Vista al Sol'),('217','66','Pozo Verde'),('218','66','Yocoima'),('219','66','5 de Julio'),('22','7','Casiquiare'),('220','67','Cedeño'),('221','67','Altagracia'),('222','67','Ascensión Farreras'),('223','67','Guaniamo'),('224','67','La Urbana'),('225','67','Pijiguaos'),('226','68','El Callao'),('227','69','Gran Sabana'),('228','69','Ikabarú'),('229','70','Catedral'),('23','7','Cocuy'),('230','70','Zea'),('231','70','Orinoco'),('232','70','José Antonio Páez'),('233','70','Marhuanta'),('234','70','Agua Salada'),('235','70','Vista Hermosa'),('236','70','La Sabanita'),('237','70','Panapana'),('238','71','Andrés Eloy Blanco'),('239','71','Pedro Cova'),('24','7','San Carlos de Río Negro'),('240','72','Raúl Leoni'),('241','72','Barceloneta'),('242','72','Santa Bárbara'),('243','72','San Francisco'),('244','73','Roscio'),('245','73','Salóm'),('246','74','Sifontes'),('247','74','Dalla Costa'),('248','74','San Isidro'),('249','75','Sucre'),('25','7','Solano'),('250','75','Aripao'),('251','75','Guarataro'),('252','75','Las Majadas'),('253','75','Moitaco'),('254','76','Padre Pedro Chien'),('255','76','Río Grande'),('256','77','Bejuma'),('257','77','Canoabo'),('258','77','Simón Bolívar'),('259','78','Güigüe'),('26','8','Anaco'),('260','78','Carabobo'),('261','78','Tacarigua'),('262','79','Mariara'),('263','79','Aguas Calientes'),('264','80','Ciudad Alianza'),('265','80','Guacara'),('266','80','Yagua'),('267','81','Morón'),('268','81','Yagua'),('269','82','Tocuyito'),('27','8','San Joaquín'),('270','82','Independencia'),('271','83','Los Guayos'),('272','84','Miranda'),('273','85','Montalbán'),('274','86','Naguanagua'),('275','87','Bartolomé Salóm'),('276','87','Democracia'),('277','87','Fraternidad'),('278','87','Goaigoaza'),('279','87','Juan José Flores'),('28','9','Cachipo'),('280','87','Unión'),('281','87','Borburata'),('282','87','Patanemo'),('283','88','San Diego'),('284','89','San Joaquín'),('285','90','Candelaria'),('286','90','Catedral'),('287','90','El Socorro'),('288','90','Miguel Peña'),('289','90','Rafael Urdaneta'),('29','9','Aragua de Barcelona'),('290','90','San Blas'),('291','90','San José'),('292','90','Santa Rosa'),('293','90','Negro Primero'),('294','91','Cojedes'),('295','91','Juan de Mata Suárez'),('296','92','Tinaquillo'),('297','93','El Baúl'),('298','93','Sucre'),('299','94','La Aguadita'),('3','1','Marawaka Toky Shamanaña'),('30','11','Lechería'),('300','94','Macapo'),('301','95','El Pao'),('302','96','El Amparo'),('303','96','Libertad de Cojedes'),('304','97','Rómulo Gallegos'),('305','98','San Carlos de Austria'),('306','98','Juan Ángel Bravo'),('307','98','Manuel Manrique'),('308','99','General en Jefe José Laurencio Silva'),('309','100','Curiapo'),('31','11','El Morro'),('310','100','Almirante Luis Brión'),('311','100','Francisco Aniceto Lugo'),('312','100','Manuel Renaud'),('313','100','Padre Barral'),('314','100','Santos de Abelgas'),('315','101','Imataca'),('316','101','Cinco de Julio'),('317','101','Juan Bautista Arismendi'),('318','101','Manuel Piar'),('319','101','Rómulo Gallegos'),('32','12','Puerto Píritu'),('320','102','Pedernales'),('321','102','Luis Beltrán Prieto Figueroa'),('322','103','San José (Delta Amacuro)'),('323','103','José Vidal Marcano'),('324','103','Juan Millán'),('325','103','Leonardo Ruíz Pineda'),('326','103','Mariscal Antonio José de Sucre'),('327','103','Monseñor Argimiro García'),('328','103','San Rafael (Delta Amacuro)'),('329','103','Virgen del Valle'),('33','12','San Miguel'),('330','10','Clarines'),('331','10','Guanape'),('332','10','Sabana de Uchire'),('333','104','Capadare'),('334','104','La Pastora'),('335','104','Libertador'),('336','104','San Juan de los Cayos'),('337','105','Aracua'),('338','105','La Peña'),('339','105','San Luis'),('34','12','Sucre'),('340','106','Bariro'),('341','106','Borojó'),('342','106','Capatárida'),('343','106','Guajiro'),('344','106','Seque'),('345','106','Zazárida'),('346','106','Valle de Eroa'),('347','107','Cacique Manaure'),('348','108','Norte'),('349','108','Carirubana'),('35','13','Valle de Guanape'),('350','108','Santa Ana'),('351','108','Urbana Punta Cardón'),('352','109','La Vela de Coro'),('353','109','Acurigua'),('354','109','Guaibacoa'),('355','109','Las Calderas'),('356','109','Macoruca'),('357','110','Dabajuro'),('358','111','Agua Clara'),('359','111','Avaria'),('36','13','Santa Bárbara'),('360','111','Pedregal'),('361','111','Piedra Grande'),('362','111','Purureche'),('363','112','Adaure'),('364','112','Adícora'),('365','112','Baraived'),('366','112','Buena Vista'),('367','112','Jadacaquiva'),('368','112','El Vínculo'),('369','112','El Hato'),('37','14','El Chaparro'),('370','112','Moruy'),('371','112','Pueblo Nuevo'),('372','113','Agua Larga'),('373','113','El Paují'),('374','113','Independencia'),('375','113','Mapararí'),('376','114','Agua Linda'),('377','114','Araurima'),('378','114','Jacura'),('379','115','Tucacas'),('38','14','Tomás Alfaro'),('380','115','Boca de Aroa'),('381','116','Los Taques'),('382','116','Judibana'),('383','117','Mene de Mauroa'),('384','117','San Félix'),('385','117','Casigua'),('386','118','Guzmán Guillermo'),('387','118','Mitare'),('388','118','Río Seco'),('389','118','Sabaneta'),('39','14','Calatrava'),('390','118','San Antonio'),('391','118','San Gabriel'),('392','118','Santa Ana'),('393','119','Boca del Tocuyo'),('394','119','Chichiriviche'),('395','119','Tocuyo de la Costa'),('396','120','Palmasola'),('397','121','Cabure'),('398','121','Colina'),('399','121','Curimagua'),('4','1','Mavaka Mavaka'),('40','15','Guanta'),('400','122','San José de la Costa'),('401','122','Píritu'),('402','123','San Francisco'),('403','124','Sucre'),('404','124','Pecaya'),('405','125','Tocópero'),('406','126','El Charal'),('407','126','Las Vegas del Tuy'),('408','126','Santa Cruz de Bucaral'),('409','127','Bruzual'),('41','15','Chorrerón'),('410','127','Urumaco'),('411','128','Puerto Cumarebo'),('412','128','La Ciénaga'),('413','128','La Soledad'),('414','128','Pueblo Cumarebo'),('415','128','Zazárida'),('416','113','Churuguara'),('417','129','Camaguán'),('418','129','Puerto Miranda'),('419','129','Uverito'),('42','16','Mamo'),('420','130','Chaguaramas'),('421','131','El Socorro'),('422','132','Tucupido'),('423','132','San Rafael de Laya'),('424','133','Altagracia de Orituco'),('425','133','San Rafael de Orituco'),('426','133','San Francisco Javier de Lezama'),('427','133','Paso Real de Macaira'),('428','133','Carlos Soublette'),('429','133','San Francisco de Macaira'),('43','16','Soledad'),('430','133','Libertad de Orituco'),('431','134','Cantaclaro'),('432','134','San Juan de los Morros'),('433','134','Parapara'),('434','135','El Sombrero'),('435','135','Sosa'),('436','136','Las Mercedes'),('437','136','Cabruta'),('438','136','Santa Rita de Manapire'),('439','137','Valle de la Pascua'),('44','17','Mapire'),('440','137','Espino'),('441','138','San José de Unare'),('442','138','Zaraza'),('443','139','San José de Tiznados'),('444','139','San Francisco de Tiznados'),('445','139','San Lorenzo de Tiznados'),('446','139','Ortiz'),('447','140','Guayabal'),('448','140','Cazorla'),('449','141','San José de Guaribe'),('45','17','Piar'),('450','141','Uveral'),('451','142','Santa María de Ipire'),('452','142','Altamira'),('453','143','El Calvario'),('454','143','El Rastro'),('455','143','Guardatinajas'),('456','143','Capital Urbana Calabozo'),('457','144','Quebrada Honda de Guache'),('458','144','Pío Tamayo'),('459','144','Yacambú'),('46','17','Santa Clara'),('460','145','Fréitez'),('461','145','José María Blanco'),('462','146','Catedral'),('463','146','Concepción'),('464','146','El Cují'),('465','146','Juan de Villegas'),('466','146','Santa Rosa'),('467','146','Tamaca'),('468','146','Unión'),('469','146','Aguedo Felipe Alvarado'),('47','17','San Diego de Cabrutica'),('470','146','Buena Vista'),('471','146','Juárez'),('472','147','Juan Bautista Rodríguez'),('473','147','Cuara'),('474','147','Diego de Lozada'),('475','147','Paraíso de San José'),('476','147','San Miguel'),('477','147','Tintorero'),('478','147','José Bernardo Dorante'),('479','147','Coronel Mariano Peraza '),('48','17','Uverito'),('480','148','Bolívar'),('481','148','Anzoátegui'),('482','148','Guarico'),('483','148','Hilario Luna y Luna'),('484','148','Humocaro Alto'),('485','148','Humocaro Bajo'),('486','148','La Candelaria'),('487','148','Morán'),('488','149','Cabudare'),('489','149','José Gregorio Bastidas'),('49','17','Zuata'),('490','149','Agua Viva'),('491','150','Sarare'),('492','150','Buría'),('493','150','Gustavo Vegas León'),('494','151','Trinidad Samuel'),('495','151','Antonio Díaz'),('496','151','Camacaro'),('497','151','Castañeda'),('498','151','Cecilio Zubillaga'),('499','151','Chiquinquirá'),('5','1','Sierra Parima Parimabé'),('50','18','Puerto La Cruz'),('500','151','El Blanco'),('501','151','Espinoza de los Monteros'),('502','151','Lara'),('503','151','Las Mercedes'),('504','151','Manuel Morillo'),('505','151','Montaña Verde'),('506','151','Montes de Oca'),('507','151','Torres'),('508','151','Heriberto Arroyo'),('509','151','Reyes Vargas'),('51','18','Pozuelos'),('510','151','Altagracia'),('511','152','Siquisique'),('512','152','Moroturo'),('513','152','San Miguel'),('514','152','Xaguas'),('515','179','Presidente Betancourt'),('516','179','Presidente Páez'),('517','179','Presidente Rómulo Gallegos'),('518','179','Gabriel Picón González'),('519','179','Héctor Amable Mora'),('52','19','Onoto'),('520','179','José Nucete Sardi'),('521','179','Pulido Méndez'),('522','180','La Azulita'),('523','181','Santa Cruz de Mora'),('524','181','Mesa Bolívar'),('525','181','Mesa de Las Palmas'),('526','182','Aricagua'),('527','182','San Antonio'),('528','183','Canagua'),('529','183','Capurí'),('53','19','San Pablo'),('530','183','Chacantá'),('531','183','El Molino'),('532','183','Guaimaral'),('533','183','Mucutuy'),('534','183','Mucuchachí'),('535','184','Fernández Peña'),('536','184','Matriz'),('537','184','Montalbán'),('538','184','Acequias'),('539','184','Jají'),('54','20','San Mateo'),('540','184','La Mesa'),('541','184','San José del Sur'),('542','185','Tucaní'),('543','185','Florencio Ramírez'),('544','186','Santo Domingo'),('545','186','Las Piedras'),('546','187','Guaraque'),('547','187','Mesa de Quintero'),('548','187','Río Negro'),('549','188','Arapuey'),('55','20','El Carito'),('550','188','Palmira'),('551','189','San Cristóbal de Torondoy'),('552','189','Torondoy'),('553','190','Antonio Spinetti Dini'),('554','190','Arias'),('555','190','Caracciolo Parra Pérez'),('556','190','Domingo Peña'),('557','190','El Llano'),('558','190','Gonzalo Picón Febres'),('559','190','Jacinto Plaza'),('56','20','Santa Inés'),('560','190','Juan Rodríguez Suárez'),('561','190','Lasso de la Vega'),('562','190','Mariano Picón Salas'),('563','190','Milla'),('564','190','Osuna Rodríguez'),('565','190','Sagrario'),('566','190','El Morro'),('567','190','Los Nevados'),('568','191','Andrés Eloy Blanco'),('569','191','La Venta'),('57','20','La Romereña'),('570','191','Piñango'),('571','191','Timotes'),('572','192','Eloy Paredes'),('573','192','San Rafael de Alcázar'),('574','192','Santa Elena de Arenales'),('575','193','Santa María de Caparo'),('576','194','Pueblo Llano'),('577','195','Cacute'),('578','195','La Toma'),('579','195','Mucuchíes'),('58','21','Atapirire'),('580','195','Mucurubá'),('581','195','San Rafael'),('582','196','Gerónimo Maldonado'),('583','196','Bailadores'),('584','197','Tabay'),('585','198','Chiguará'),('586','198','Estánquez'),('587','198','Lagunillas'),('588','198','La Trampa'),('589','198','Pueblo Nuevo del Sur'),('59','21','Boca del Pao'),('590','198','San Juan'),('591','199','El Amparo'),('592','199','El Llano'),('593','199','San Francisco'),('594','199','Tovar'),('595','200','Independencia'),('596','200','María de la Concepción Palacios Blanco'),('597','200','Nueva Bolivia'),('598','200','Santa Apolonia'),('599','201','Caño El Tigre'),('6','2','Ucata Laja Lisa'),('60','21','El Pao'),('600','201','Zea'),('601','223','Aragüita'),('602','223','Arévalo González'),('603','223','Capaya'),('604','223','Caucagua'),('605','223','Panaquire'),('606','223','Ribas'),('607','223','El Café'),('608','223','Marizapa'),('609','224','Cumbo'),('61','21','Pariaguán'),('610','224','San José de Barlovento'),('611','225','El Cafetal'),('612','225','Las Minas'),('613','225','Nuestra Señora del Rosario'),('614','226','Higuerote'),('615','226','Curiepe'),('616','226','Tacarigua de Brión'),('617','227','Mamporal'),('618','228','Carrizal'),('619','229','Chacao'),('62','22','Cantaura'),('620','230','Charallave'),('621','230','Las Brisas'),('622','231','El Hatillo'),('623','232','Altagracia de la Montaña'),('624','232','Cecilio Acosta'),('625','232','Los Teques'),('626','232','El Jarillo'),('627','232','San Pedro'),('628','232','Tácata'),('629','232','Paracotos'),('63','22','Libertador'),('630','233','Cartanal'),('631','233','Santa Teresa del Tuy'),('632','234','La Democracia'),('633','234','Ocumare del Tuy'),('634','234','Santa Bárbara'),('635','235','San Antonio de los Altos'),('636','236','Río Chico'),('637','236','El Guapo'),('638','236','Tacarigua de la Laguna'),('639','236','Paparo'),('64','22','Santa Rosa'),('640','236','San Fernando del Guapo'),('641','237','Santa Lucía del Tuy'),('642','238','Cúpira'),('643','238','Machurucuto'),('644','239','Guarenas'),('645','240','San Antonio de Yare'),('646','240','San Francisco de Yare'),('647','241','Leoncio Martínez'),('648','241','Petare'),('649','241','Caucagüita'),('65','22','Urica'),('650','241','Filas de Mariche'),('651','241','La Dolorita'),('652','242','Cúa'),('653','242','Nueva Cúa'),('654','243','Guatire'),('655','243','Bolívar'),('656','258','San Antonio de Maturín'),('657','258','San Francisco de Maturín'),('658','259','Aguasay'),('659','260','Caripito'),('66','23','Píritu'),('660','261','El Guácharo'),('661','261','La Guanota'),('662','261','Sabana de Piedra'),('663','261','San Agustín'),('664','261','Teresen'),('665','261','Caripe'),('666','262','Areo'),('667','262','Capital Cedeño'),('668','262','San Félix de Cantalicio'),('669','262','Viento Fresco'),('67','23','San Francisco'),('670','263','El Tejero'),('671','263','Punta de Mata'),('672','264','Chaguaramas'),('673','264','Las Alhuacas'),('674','264','Tabasca'),('675','264','Temblador'),('676','265','Alto de los Godos'),('677','265','Boquerón'),('678','265','Las Cocuizas'),('679','265','La Cruz'),('68','24','San José de Guanipa'),('680','265','San Simón'),('681','265','El Corozo'),('682','265','El Furrial'),('683','265','Jusepín'),('684','265','La Pica'),('685','265','San Vicente'),('686','266','Aparicio'),('687','266','Aragua de Maturín'),('688','266','Chaguamal'),('689','266','El Pinto'),('69','25','Boca de Uchire'),('690','266','Guanaguana'),('691','266','La Toscana'),('692','266','Taguaya'),('693','267','Cachipo'),('694','267','Quiriquire'),('695','268','Santa Bárbara'),('696','269','Barrancas'),('697','269','Los Barrancos de Fajardo'),('698','270','Uracoa'),('699','271','Antolín del Campo'),('7','2','Yapacana Macuruco'),('70','25','Boca de Chávez'),('700','272','Arismendi'),('701','273','García'),('702','273','Francisco Fajardo'),('703','274','Bolívar'),('704','274','Guevara'),('705','274','Matasiete'),('706','274','Santa Ana'),('707','274','Sucre'),('708','275','Aguirre'),('709','275','Maneiro'),('71','26','Pueblo Nuevo'),('710','276','Adrián'),('711','276','Juan Griego'),('712','276','Yaguaraparo'),('713','277','Porlamar'),('714','278','San Francisco de Macanao'),('715','278','Boca de Río'),('716','279','Tubores'),('717','279','Los Baleales'),('718','280','Vicente Fuentes'),('719','280','Villalba'),('72','26','Santa Ana'),('720','281','San Juan Bautista'),('721','281','Zabala'),('722','283','Capital Araure'),('723','283','Río Acarigua'),('724','284','Capital Esteller'),('725','284','Uveral'),('726','285','Guanare'),('727','285','Córdoba'),('728','285','San José de la Montaña'),('729','285','San Juan de Guanaguanare'),('73','27','Bergantín'),('730','285','Virgen de la Coromoto'),('731','286','Guanarito'),('732','286','Trinidad de la Capilla'),('733','286','Divina Pastora'),('734','287','Monseñor José Vicente de Unda'),('735','287','Peña Blanca'),('736','288','Capital Ospino'),('737','288','Aparición'),('738','288','La Estación'),('739','289','Páez'),('74','27','Caigua'),('740','289','Payara'),('741','289','Pimpinela'),('742','289','Ramón Peraza'),('743','290','Papelón'),('744','290','Caño Delgadito'),('745','291','San Genaro de Boconoito'),('746','291','Antolín Tovar'),('747','292','San Rafael de Onoto'),('748','292','Santa Fe'),('749','292','Thermo Morles'),('75','27','El Carmen'),('750','293','Santa Rosalía'),('751','293','Florida'),('752','294','Sucre'),('753','294','Concepción'),('754','294','San Rafael de Palo Alzado'),('755','294','Uvencio Antonio Velásquez'),('756','294','San José de Saguaz'),('757','294','Villa Rosa'),('758','295','Turén'),('759','295','Canelones'),('76','27','El Pilar'),('760','295','Santa Cruz'),('761','295','San Isidro Labrador'),('762','296','Mariño'),('763','296','Rómulo Gallegos'),('764','297','San José de Aerocuar'),('765','297','Tavera Acosta'),('766','298','Río Caribe'),('767','298','Antonio José de Sucre'),('768','298','El Morro de Puerto Santo'),('769','298','Puerto Santo'),('77','27','Naricual'),('770','298','San Juan de las Galdonas'),('771','299','El Pilar'),('772','299','El Rincón'),('773','299','General Francisco Antonio Váquez'),('774','299','Guaraúnos'),('775','299','Tunapuicito'),('776','299','Unión'),('777','300','Santa Catalina'),('778','300','Santa Rosa'),('779','300','Santa Teresa'),('78','27','San Crsitóbal'),('780','300','Bolívar'),('781','300','Maracapana'),('782','302','Libertad'),('783','302','El Paujil'),('784','302','Yaguaraparo'),('785','303','Cruz Salmerón Acosta'),('786','303','Chacopata'),('787','303','Manicuare'),('788','304','Tunapuy'),('789','304','Campo Elías'),('79','28','Edmundo Barrios'),('790','305','Irapa'),('791','305','Campo Claro'),('792','305','Maraval'),('793','305','San Antonio de Irapa'),('794','305','Soro'),('795','306','Mejía'),('796','307','Cumanacoa'),('797','307','Arenas'),('798','307','Aricagua'),('799','307','Cogollar'),('8','2','Caname Guarinuma'),('80','28','Miguel Otero Silva'),('800','307','San Fernando'),('801','307','San Lorenzo'),('802','308','Villa Frontado (Muelle de Cariaco)'),('803','308','Catuaro'),('804','308','Rendón'),('805','308','San Cruz'),('806','308','Santa María'),('807','309','Altagracia'),('808','309','Santa Inés'),('809','309','Valentín Valiente'),('81','29','Achaguas'),('810','309','Ayacucho'),('811','309','San Juan'),('812','309','Raúl Leoni'),('813','309','Gran Mariscal'),('814','310','Cristóbal Colón'),('815','310','Bideau'),('816','310','Punta de Piedras'),('817','310','Güiria'),('818','341','Andrés Bello'),('819','342','Antonio Rómulo Costa'),('82','29','Apurito'),('820','343','Ayacucho'),('821','343','Rivas Berti'),('822','343','San Pedro del Río'),('823','344','Bolívar'),('824','344','Palotal'),('825','344','General Juan Vicente Gómez'),('826','344','Isaías Medina Angarita'),('827','345','Cárdenas'),('828','345','Amenodoro Ángel Lamus'),('829','345','La Florida'),('83','29','El Yagual'),('830','346','Córdoba'),('831','347','Fernández Feo'),('832','347','Alberto Adriani'),('833','347','Santo Domingo'),('834','348','Francisco de Miranda'),('835','349','García de Hevia'),('836','349','Boca de Grita'),('837','349','José Antonio Páez'),('838','350','Guásimos'),('839','351','Independencia'),('84','29','Guachara'),('840','351','Juan Germán Roscio'),('841','351','Román Cárdenas'),('842','352','Jáuregui'),('843','352','Emilio Constantino Guerrero'),('844','352','Monseñor Miguel Antonio Salas'),('845','353','José María Vargas'),('846','354','Junín'),('847','354','La Petrólea'),('848','354','Quinimarí'),('849','354','Bramón'),('85','29','Mucuritas'),('850','355','Libertad'),('851','355','Cipriano Castro'),('852','355','Manuel Felipe Rugeles'),('853','356','Libertador'),('854','356','Doradas'),('855','356','Emeterio Ochoa'),('856','356','San Joaquín de Navay'),('857','357','Lobatera'),('858','357','Constitución'),('859','358','Michelena'),('86','29','Queseras del medio'),('860','359','Panamericano'),('861','359','La Palmita'),('862','360','Pedro María Ureña'),('863','360','Nueva Arcadia'),('864','361','Delicias'),('865','361','Pecaya'),('866','362','Samuel Darío Maldonado'),('867','362','Boconó'),('868','362','Hernández'),('869','363','La Concordia'),('87','30','Biruaca'),('870','363','San Juan Bautista'),('871','363','Pedro María Morantes'),('872','363','San Sebastián'),('873','363','Dr. Francisco Romero Lobo'),('874','364','Seboruco'),('875','365','Simón Rodríguez'),('876','366','Sucre'),('877','366','Eleazar López Contreras'),('878','366','San Pablo'),('879','367','Torbes'),('88','31','Bruzual'),('880','368','Uribante'),('881','368','Cárdenas'),('882','368','Juan Pablo Peñalosa'),('883','368','Potosí'),('884','369','San Judas Tadeo'),('885','370','Araguaney'),('886','370','El Jaguito'),('887','370','La Esperanza'),('888','370','Santa Isabel'),('889','371','Boconó'),('89','31','Mantecal'),('890','371','El Carmen'),('891','371','Mosquey'),('892','371','Ayacucho'),('893','371','Burbusay'),('894','371','General Ribas'),('895','371','Guaramacal'),('896','371','Vega de Guaramacal'),('897','371','Monseñor Jáuregui'),('898','371','Rafael Rangel'),('899','371','San Miguel'),('9','3','Fernando Girón Tovar'),('90','31','Quintero'),('900','371','San José'),('901','372','Sabana Grande'),('902','372','Cheregüé'),('903','372','Granados'),('904','373','Arnoldo Gabaldón'),('905','373','Bolivia'),('906','373','Carrillo'),('907','373','Cegarra'),('908','373','Chejendé'),('909','373','Manuel Salvador Ulloa'),('91','31','Rincón Hondo'),('910','373','San José'),('911','374','Carache'),('912','374','La Concepción'),('913','374','Cuicas'),('914','374','Panamericana'),('915','374','Santa Cruz'),('916','375','Escuque'),('917','375','La Unión'),('918','375','Santa Rita'),('919','375','Sabana Libre'),('92','31','San Vicente'),('920','376','El Socorro'),('921','376','Los Caprichos'),('922','376','Antonio José de Sucre'),('923','377','Campo Elías'),('924','377','Arnoldo Gabaldón'),('925','378','Santa Apolonia'),('926','378','El Progreso'),('927','378','La Ceiba'),('928','378','Tres de Febrero'),('929','379','El Dividive'),('93','32','Guasdualito'),('930','379','Agua Santa'),('931','379','Agua Caliente'),('932','379','El Cenizo'),('933','379','Valerita'),('934','380','Monte Carmelo'),('935','380','Buena Vista'),('936','380','Santa María del Horcón'),('937','381','Motatán'),('938','381','El Baño'),('939','381','Jalisco'),('94','32','Aramendi'),('940','382','Pampán'),('941','382','Flor de Patria'),('942','382','La Paz'),('943','382','Santa Ana'),('944','383','Pampanito'),('945','383','La Concepción'),('946','383','Pampanito II'),('947','384','Betijoque'),('948','384','José Gregorio Hernández'),('949','384','La Pueblita'),('95','32','El Amparo'),('950','384','Los Cedros'),('951','385','Carvajal'),('952','385','Campo Alegre'),('953','385','Antonio Nicolás Briceño'),('954','385','José Leonardo Suárez'),('955','386','Sabana de Mendoza'),('956','386','Junín'),('957','386','Valmore Rodríguez'),('958','386','El Paraíso'),('959','387','Andrés Linares'),('96','32','San Camilo'),('960','387','Chiquinquirá'),('961','387','Cristóbal Mendoza'),('962','387','Cruz Carrillo'),('963','387','Matriz'),('964','387','Monseñor Carrillo'),('965','387','Tres Esquinas'),('966','388','Cabimbú'),('967','388','Jajó'),('968','388','La Mesa de Esnujaque'),('969','388','Santiago'),('97','32','Urdaneta'),('970','388','Tuñame'),('971','388','La Quebrada'),('972','389','Juan Ignacio Montilla'),('973','389','La Beatriz'),('974','389','La Puerta'),('975','389','Mendoza del Valle de Momboy'),('976','389','Mercedes Díaz'),('977','389','San Luis'),('978','390','Caraballeda'),('979','390','Carayaca'),('98','33','San Juan de Payara'),('980','390','Carlos Soublette'),('981','390','Caruao Chuspa'),('982','390','Catia La Mar'),('983','390','El Junko'),('984','390','La Guaira'),('985','390','Macuto'),('986','390','Maiquetía'),('987','390','Naiguatá'),('988','390','Urimare'),('989','391','Arístides Bastidas'),('99','33','Codazzi'),('990','392','Bolívar'),('991','407','Chivacoa'),('992','407','Campo Elías'),('993','408','Cocorote'),('994','409','Independencia'),('995','410','José Antonio Páez'),('996','411','La Trinidad'),('997','412','Manuel Monge'),('998','413','Salóm'),('999','413','Temerla');
/*!40000 ALTER TABLE `parroquia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participante_curso`
--

DROP TABLE IF EXISTS `participante_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participante_curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `curso` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participante_curso`
--

LOCK TABLES `participante_curso` WRITE;
/*!40000 ALTER TABLE `participante_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `participante_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participante_encuentro`
--

DROP TABLE IF EXISTS `participante_encuentro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participante_encuentro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `fecha_recibido` date NOT NULL,
  `encuentro` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `taller` (`encuentro`),
  KEY `cedula` (`cedula`),
  CONSTRAINT `participante_encuentro_ibfk_1` FOREIGN KEY (`encuentro`) REFERENCES `encuentros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `participante_encuentro_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `beneficiario` (`cedula`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participante_encuentro`
--

LOCK TABLES `participante_encuentro` WRITE;
/*!40000 ALTER TABLE `participante_encuentro` DISABLE KEYS */;
/*!40000 ALTER TABLE `participante_encuentro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participante_escuela`
--

DROP TABLE IF EXISTS `participante_escuela`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participante_escuela` (
  `cedula` int(10) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `discapacidad` varchar(10) DEFAULT NULL,
  `id_curso` int(11) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  PRIMARY KEY (`cedula`),
  KEY `id_curso` (`id_curso`),
  KEY `discapacidad` (`discapacidad`),
  KEY `estado` (`estado`,`municipio`,`parroquia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participante_escuela`
--

LOCK TABLES `participante_escuela` WRITE;
/*!40000 ALTER TABLE `participante_escuela` DISABLE KEYS */;
/*!40000 ALTER TABLE `participante_escuela` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participante_taller`
--

DROP TABLE IF EXISTS `participante_taller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participante_taller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `fecha_recibido` date NOT NULL,
  `taller` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `taller` (`taller`),
  KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participante_taller`
--

LOCK TABLES `participante_taller` WRITE;
/*!40000 ALTER TABLE `participante_taller` DISABLE KEYS */;
/*!40000 ALTER TABLE `participante_taller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas_jornadas`
--

DROP TABLE IF EXISTS `personas_jornadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas_jornadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(10) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `discapacidad` varchar(10) NOT NULL,
  `ayuda_tecnica` varchar(10) NOT NULL,
  `fecha_jaten` date DEFAULT NULL,
  `numero_jornada` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ayuda_tecnica` (`ayuda_tecnica`,`numero_jornada`),
  KEY `discapacidad` (`discapacidad`),
  KEY `numero_jornada` (`numero_jornada`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas_jornadas`
--

LOCK TABLES `personas_jornadas` WRITE;
/*!40000 ALTER TABLE `personas_jornadas` DISABLE KEYS */;
INSERT INTO `personas_jornadas` VALUES (3,4585458,'DEIKER','FERNANDEZ','AnemiaCrni','2-muletas','2023-08-21',22),(4,4585458,'DEIKER','FERNANDEZ','ESQ','2-muletas','2023-08-21',22),(10,5145131,'Kelvin','Pea','acondro','5-ap.audio','2023-08-23',24),(11,54544,'efds','wd','eritemaver','-MuletasCa','2023-08-23',25),(12,4858584,'MIguel Angel','Lopez Gonzalez','1-AS/D','1.7-COP','2023-10-10',24),(13,4885451,'MIguel Angel','Lopez Gonzalez','1-AS/D','9-felula','2023-10-10',24);
/*!40000 ALTER TABLE `personas_jornadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `porcentajes`
--

DROP TABLE IF EXISTS `porcentajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `porcentajes` (
  `fecha` varchar(255) DEFAULT NULL,
  `porcentaje` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `porcentajes`
--

LOCK TABLES `porcentajes` WRITE;
/*!40000 ALTER TABLE `porcentajes` DISABLE KEYS */;
INSERT INTO `porcentajes` VALUES ('2023-07-27',15.2),('2023-07-28',2.9),('2023-07-30',0),('2023-07-31',0),('2023-08-02',0),('2023-08-05',3.7),('2023-08-06',0),('2023-08-07',0),('2023-08-09',0),('0000-00-00',100),('August',100),('September',85.7),('October',23.5),('November',5.6);
/*!40000 ALTER TABLE `porcentajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `protesis`
--

DROP TABLE IF EXISTS `protesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `protesis` (
  `id` varchar(10) NOT NULL,
  `nombre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `protesis`
--

LOCK TABLES `protesis` WRITE;
/*!40000 ALTER TABLE `protesis` DISABLE KEYS */;
INSERT INTO `protesis` VALUES ('1-Su-D','Superior Derecha'),('2-Su-I','Superior Izquierda'),('3-Inf-D','Inferior derecha'),('4-Inf-I','Inferior Inzquierda');
/*!40000 ALTER TABLE `protesis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prueba_artificios`
--

DROP TABLE IF EXISTS `prueba_artificios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prueba_artificios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `fecha_pruebas` date DEFAULT NULL,
  `pruebas` text DEFAULT NULL,
  `artificio_prueba` varchar(10) DEFAULT NULL,
  `statu` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  KEY `artificio_prueba` (`artificio_prueba`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prueba_artificios`
--

LOCK TABLES `prueba_artificios` WRITE;
/*!40000 ALTER TABLE `prueba_artificios` DISABLE KEYS */;
/*!40000 ALTER TABLE `prueba_artificios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_beneficiario`
--

DROP TABLE IF EXISTS `reg_beneficiario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reg_beneficiario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) DEFAULT NULL,
  `nombre` text DEFAULT NULL,
  `apellido` text DEFAULT NULL,
  `registrado_por` tinytext DEFAULT NULL,
  `INSERTADO` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_beneficiario`
--

LOCK TABLES `reg_beneficiario` WRITE;
/*!40000 ALTER TABLE `reg_beneficiario` DISABLE KEYS */;
INSERT INTO `reg_beneficiario` VALUES (12,30165406,'DEIKER','FERNANDEZ','Deiker fernandez','2023-08-19 20:50:31'),(13,30165406,'deiker','Fernandez','Deiker fernandez','2023-08-20 09:15:15'),(14,30165404,'DEIKER','FERNANDEZ','Deiker fernandez','2023-08-20 10:45:03'),(15,30165403,'DEIKER','FERNANDEZ','Deiker fernandez','2023-08-20 10:50:18'),(16,4857859,'Yaji','Lopez','Deiker fernandez','2023-08-20 13:26:34'),(17,30165406,'DEIKER','FERNANDEZ','Deiker fernandez','2023-08-20 17:13:09'),(18,4584875,'Miguel','Lopez','Deiker fernandez','2023-08-20 17:26:57'),(19,48445,'Kelvin','Pena','Deiker fernandez','2023-08-21 09:43:08'),(20,654326,'carlos','ramirez','Deiker fernandez','2023-08-21 10:31:20'),(21,34234,'valentina','corral','Deiker fernandez','2023-08-21 10:35:15'),(22,132444,'david','martinez','alexander','2023-08-21 10:38:18'),(23,23445,'betania','herlo','alexander','2023-08-21 10:39:52'),(24,971423738,'gerardio','perez','alexander','2023-08-21 10:44:29'),(25,62654,'Deiker','fernandez','alexander','2023-08-21 14:13:47'),(26,123456,'maria','gonzalez','erika jimenez','2023-08-22 15:49:34'),(27,15848,'Kelvin','Pena','Deiker fernandez','2023-08-23 10:20:13'),(28,585548,'Kelvin','Pena','Deiker fernandez','2023-08-23 10:36:14'),(29,484545,'Kelvin','Pela','Deiker fernandez','2023-08-23 10:37:01'),(30,1515546,'Kelvin','Pel','Deiker fernandez','2023-08-23 10:39:01'),(31,34341234,'VALENTINA','perez','Daniel ','2023-08-23 11:29:37'),(32,521548,'Carol','Perez','Deiker fernandez','2023-08-23 12:01:26'),(33,4584485,'Kelvin','contreras','Deiker fernandez','2023-08-23 12:37:55'),(34,5145131,'Kelvin','Pelo','Deiker fernandez','2023-08-23 12:40:27'),(35,4582151,'pastor','contreras','Deiker fernandez','2023-08-23 12:41:13'),(36,151642,'asdasd','dadsd','Deiker fernandez','2023-08-23 12:46:34'),(37,301265401,'adsad','asddas','Deiker fernandez','2023-08-23 12:47:02'),(38,20125151,'Kelvin','Plo','Deiker fernandez','2023-08-23 13:01:32'),(39,215154,'sdasd','sadasd','Deiker fernandez','2023-08-23 13:02:04'),(40,30165402,'Deiker','Fernandez','Yohanna Ballesteros','2023-08-23 13:54:02'),(41,4581245,'Kelvin','Perez','Deiker fernandez','2023-08-24 09:38:12'),(42,12731757,'CAROLINA','CRESPO','felix key','2023-08-28 10:38:24'),(43,30165406,'DEIKER','CHAPELLIN','Deiker fernandez','2023-09-02 16:45:44'),(44,13894817,'EVELYN','FERNANDEZ','Deiker fernandez','2023-09-02 16:46:56'),(45,13711717,'DEIKER','FERNANDEZ','Deiker fernandez','2023-09-02 16:48:11'),(46,123456,'Columba','Chapellin','Deiker fernandez','2023-09-02 16:50:08'),(47,137117175,'Deiker','CHAPELLIN','Deiker fernandez','2023-09-03 15:37:52'),(48,4585899,'Miguel','Palacios','Deiker fernandez','2023-09-03 15:39:06'),(49,1545856,'Carlos Jose','Fernandez carvajal','Deiker fernandez','2023-09-04 08:00:13'),(50,4858584,'Deiker José','Fernández Carvajal','Deiker fernandez','2023-09-04 08:02:39'),(51,30165402,'DEIKER','FERNANDEZ','Deiker fernandez','2023-09-06 12:03:27'),(52,137117171,'Columba','Chapellin','Deiker fernandez','2023-09-06 12:09:58'),(53,12545859,'Carlos Sebastian','Perez Gonzalez','alexander','2023-09-09 10:12:35'),(54,4549646,'Luis samen','carvajal','alexander','2023-09-09 10:43:30'),(55,10722053,'ELIBERTO ANTONIO','VAZQUEZ MEJIAS','Deiker fernandez','2023-09-14 19:11:27'),(56,10722053,'ELIBERTO ANTONIO','VAZQUEZ MEJIAS','Deiker fernandez','2023-09-15 20:38:46'),(57,124584,'Carlos','Lopez Gonzalez','Deiker fernandez','2023-10-03 12:10:34'),(58,28484465,'hsf','dsdsd','Deiker fernandez','2023-10-05 14:08:01'),(59,28484435,'MIguel Angel','Lopez Gonzalez','Deiker fernandez','2023-10-05 14:50:38'),(60,48758452,'Evelyn Edidd','Chapellin Fuentes','Deiker fernandez','2023-10-23 12:02:07'),(61,487848,'Maria Inalda','Gonzalez Torrealba','Deiker fernandez','2023-10-26 12:24:03'),(62,1236655,'Alguien con ','apellido doble','Deiker fernandez','2023-11-02 11:35:17');
/*!40000 ALTER TABLE `reg_beneficiario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remitidos`
--

DROP TABLE IF EXISTS `remitidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remitidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `departamento` varchar(5) NOT NULL,
  `coordinacion` varchar(12) DEFAULT NULL,
  `por` text NOT NULL,
  `gerencia_remitente` varchar(5) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` text NOT NULL,
  `statu` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  KEY `departamento` (`departamento`),
  KEY `gerencia_remitente` (`gerencia_remitente`),
  KEY `coordinacion` (`coordinacion`),
  CONSTRAINT `remitidos_ibfk_1` FOREIGN KEY (`coordinacion`) REFERENCES `coordinaciones_estadales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remitidos`
--

LOCK TABLES `remitidos` WRITE;
/*!40000 ALTER TABLE `remitidos` DISABLE KEYS */;
INSERT INTO `remitidos` VALUES (73,4585899,'4Gtno',NULL,'30165406','2Atc','2023-10-23','Remitido por busqueda de aparato de audiometria',NULL),(74,30165406,'4Gtno','C-monag','30165406','2Atc','2023-10-23','Porque quiere un curso','Aceptado'),(75,13894817,'4Gtno','C-amaz','30165406','2Atc','2023-10-23','Necesita andadera y por oac no lo tenemos',NULL),(76,30165406,'4Gtno','C-amaz','30165406','2Atc','2023-10-23','necesita silla a motor','Aceptado'),(77,30165406,'2Atc',NULL,'12345','4Gtno','2023-10-23','Remitido por busqueda de aparato de audiometria',NULL);
/*!40000 ALTER TABLE `remitidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reparacion_artificios`
--

DROP TABLE IF EXISTS `reparacion_artificios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reparacion_artificios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `fecha_reparacion` date DEFAULT NULL,
  `artificio` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reparacion_artificios`
--

LOCK TABLES `reparacion_artificios` WRITE;
/*!40000 ALTER TABLE `reparacion_artificios` DISABLE KEYS */;
INSERT INTO `reparacion_artificios` VALUES (5,30165406,NULL,'punta'),(6,13711717,NULL,NULL),(7,30165406,NULL,NULL);
/*!40000 ALTER TABLE `reparacion_artificios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` varchar(5) NOT NULL,
  `nombre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES ('1adm','administrador'),('2coor','Coordinador'),('3supe','Superusuario'),('coorA','Coordinador de area'),('coorN','Coordinacion nacional');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguimiento`
--

DROP TABLE IF EXISTS `seguimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `descripcion` text NOT NULL,
  `seguimiento` varchar(10) DEFAULT NULL,
  `fecha_seguimiento` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguimiento`
--

LOCK TABLES `seguimiento` WRITE;
/*!40000 ALTER TABLE `seguimiento` DISABLE KEYS */;
INSERT INTO `seguimiento` VALUES (30,48758452,'Se le asigno fecha para venir a buscar el 26-11-2023',NULL,'2023-10-26');
/*!40000 ALTER TABLE `seguimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes_desarrollo`
--

DROP TABLE IF EXISTS `solicitudes_desarrollo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes_desarrollo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `solicitud` varchar(10) NOT NULL,
  `fecha_asig` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  KEY `solicitud` (`solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes_desarrollo`
--

LOCK TABLES `solicitudes_desarrollo` WRITE;
/*!40000 ALTER TABLE `solicitudes_desarrollo` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitudes_desarrollo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes_encuentro`
--

DROP TABLE IF EXISTS `solicitudes_encuentro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes_encuentro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `solicitud` varchar(10) NOT NULL,
  `fecha_asig` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  KEY `solicitud` (`solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes_encuentro`
--

LOCK TABLES `solicitudes_encuentro` WRITE;
/*!40000 ALTER TABLE `solicitudes_encuentro` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitudes_encuentro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taller`
--

DROP TABLE IF EXISTS `taller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_taller` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `parroquia` varchar(10) NOT NULL,
  `actividad` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado` (`estado`,`municipio`),
  KEY `municipio` (`municipio`),
  KEY `parroquia` (`parroquia`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taller`
--

LOCK TABLES `taller` WRITE;
/*!40000 ALTER TABLE `taller` DISABLE KEYS */;
INSERT INTO `taller` VALUES (17,'2002-02-18','15','258','656','charla'),(20,'0200-09-18','4','36','107','charla');
/*!40000 ALTER TABLE `taller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_ayuda_tecnica`
--

DROP TABLE IF EXISTS `tipo_ayuda_tecnica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_ayuda_tecnica` (
  `id` varchar(10) NOT NULL,
  `nombre_tipoayuda` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_ayuda_tecnica`
--

LOCK TABLES `tipo_ayuda_tecnica` WRITE;
/*!40000 ALTER TABLE `tipo_ayuda_tecnica` DISABLE KEYS */;
INSERT INTO `tipo_ayuda_tecnica` VALUES ('-bastonRas','Baston de rastreo plegable numero 48'),('-MuletasCa','Muletas canadienses adultos'),('1-silla.r','Silla de rueda'),('1.1-S.E16','Silla de rueda ergonómica N16'),('1.1-S.E18','Silla de rueda ergonómica N18'),('1.2-S.E14','Silla de rueda ergonómica N14'),('1.4-S.R.A.','Silla de ruedas reclinable '),('1.5-SRPE','Silla de rueda pediátrica ergonómica'),('1.6-SRB','Silla de rueda bariátricas'),('1.7-COP','Coche ortopédico pediátrico'),('10-Cola','Colchon antiescaras'),('10-lentes','Lentes'),('11-Coj','Cojin antiescaras'),('11-pañales','Pañales'),('12-Mucp','Muletas canadienses pediatricas'),('12-Pro-aud','Protesis auditivas'),('13-Brpl34','Baston de rastreo plegable numero 34'),('13-Pro-cad','Protesis de Cadera'),('14-Brpl36','Baston de rastreo plegable numero 36'),('14-Pro-rod','Protesis de rodilla'),('15-Brpl38','Baston de rastreo plegable numero 38'),('15-Brpl44','Baston de rastreo plegable numero 44'),('15-Pro-den','Protesis Dental'),('16-Brpl46','Baston de rastreo plegable numero 46'),('18-Brpl50','Baston de rastreo plegable numero 50'),('19-Brpl52','Baston de rastreo plegable numero 52'),('2-muletas','Muletas'),('2-MuletasL','Muletas talla L'),('2-MuletasM','Muletas talla M'),('2-MuletasS','Muletas talla S'),('20-Rglp','Regleta con punzon'),('21-Btrpd','Baston de rastreo pediatricos'),('21-sllm','Silla a motor'),('22-Apm','Andadera pediatrica multifuncional'),('23-Apr','Andadera pediatrica con ruedas'),('25-Anpp','Andadera pediatrica posterior'),('26-Anpf','Andadera pediatrica fija'),('27-Sllc','Silla de rueda clinica'),('28-chorm','Coche ortopedico mediano'),('29-chorg','Coche ortopedico grande'),('3-baston','Baston de punto'),('30-sllsr','Silla sanitaria sin ruedas'),('31-sllsr','Silla sanitaria con ruedas'),('4-baston.p','Baston de 4 Puntas'),('5-ap.audio','Aparato de audiometria'),('6-andadera','Andadera adulto fija'),('7-CamaCli','Cama Clinica'),('8-Grab','Grabadora'),('9-felula','Ferula'),('S/N','Sin entrega');
/*!40000 ALTER TABLE `tipo_ayuda_tecnica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoatencion`
--

DROP TABLE IF EXISTS `tipoatencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoatencion` (
  `id` varchar(10) NOT NULL,
  `nombre_atencion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoatencion`
--

LOCK TABLES `tipoatencion` WRITE;
/*!40000 ALTER TABLE `tipoatencion` DISABLE KEYS */;
INSERT INTO `tipoatencion` VALUES ('0-aten-coo',' coordinación estatal\r\n'),('1-oac','Atencion a traves de OAC'),('10-partic','Participante taller'),('11-partic','Participante Encuentro'),('2-ayudte','Entrega Ayuda Tecnica'),('3-orypro','Cita laboratorio ortesis y protesis'),('4-tomedi','Toma Medidas'),('5-pruebar','Prueba artifcio'),('6-repaart','Reparacion Artificio'),('7-audiom','Audiometria'),('8-calibr','Calibracion de Protesis Auditivas'),('9-soliproa','Solicitud de protesis auditivas');
/*!40000 ALTER TABLE `tipoatencion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toma_medidas`
--

DROP TABLE IF EXISTS `toma_medidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toma_medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(12) NOT NULL,
  `fecha_medidas` date DEFAULT NULL,
  `medidas` decimal(10,0) DEFAULT NULL,
  `artificio` varchar(10) DEFAULT NULL,
  `codigo_cita` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`),
  KEY `codigo_cita` (`codigo_cita`),
  CONSTRAINT `toma_medidas_ibfk_1` FOREIGN KEY (`codigo_cita`) REFERENCES `cita_ortesis_protesis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toma_medidas`
--

LOCK TABLES `toma_medidas` WRITE;
/*!40000 ALTER TABLE `toma_medidas` DISABLE KEYS */;
INSERT INTO `toma_medidas` VALUES (47,4549646,'2002-09-18',NULL,'-protesis',59),(48,4549646,'2002-09-18',NULL,'ort-super',60),(49,1545856,'2002-09-18',NULL,'ort-infe',61),(50,1545856,'2022-09-28',NULL,'-protesis',62);
/*!40000 ALTER TABLE `toma_medidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `cedula` int(12) NOT NULL,
  `nombre` text NOT NULL,
  `passwordd` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `sexo` char(1) NOT NULL,
  `gerencia` varchar(5) NOT NULL,
  `rol` varchar(5) NOT NULL,
  `coordinacion` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `gerencia` (`gerencia`),
  KEY `rol` (`rol`),
  KEY `coordinacion` (`coordinacion`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`gerencia`) REFERENCES `gerencia` (`id`) ON DELETE CASCADE,
  CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1111111,'Prueba encrypt','$2y$10$UAY.NqhTKr1t3ABGdChKnOOpveJTn0mwwV7KncxdDkCZvu/rJ.4/u','hola@gmail.com','04120183670','m','2Atc','3supe',NULL),(8683522,'Felix Key','$2y$10$4zpI/TuhnI0XjG6k1M6qqO2dmpcOnwehERiosa6RMhpyizRCt4yAi','key522@gmail.com','04267705580','m','2Atc','1adm',NULL),(28484435,'Gerardo Salazar','$2y$10$xMk5Nqb8y/Mj6oWBtZrVxeLDNB49/tSyBb4ZjTh4YyXOWOhoBFB4a','hola@gmail.com','04120155452','m','2Atc','3supe',NULL),(30165406,'Deiker Fernandez','$2y$10$BPpOYZVeB3PFdg.QLSeu1u9UXeZsmCqwuseKnXJPlXYv4c97/6t7m','deiker1842@gmail.com','04120183670','m','2Atc','3supe',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-16 19:23:02
