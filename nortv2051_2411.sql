CREATE DATABASE  IF NOT EXISTS `nortv` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `nortv`;
-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: nortv
-- ------------------------------------------------------
-- Server version	5.5.52-0+deb8u1

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
-- Table structure for table `Abonado`
--

DROP TABLE IF EXISTS `Abonado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Abonado` (
  `idAbonado` int(11) NOT NULL AUTO_INCREMENT,
  `dni` int(11) NOT NULL,
  `apellidoNombre` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAbonado`)
) ENGINE=InnoDB AUTO_INCREMENT=18001 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Abonado`
--

LOCK TABLES `Abonado` WRITE;
/*!40000 ALTER TABLE `Abonado` DISABLE KEYS */;
INSERT INTO `Abonado` VALUES (12868,28343560,'Vega, Rafaela','obligado 4475 - M.Belen','3235353564','3355224444','esteemail@hotmail.com'),(15468,38111111,'Brado, Alam','Planta Urbana - Cote Lai','3235353566','3355224422','estudiante@utnfrrre.edu'),(16100,25222555,'Leiva, Leila','Nomeacuerdo 503 - Fontana','3235353568','3355224400','aprobamexfa@bd.edu.ar'),(16132,20632995,'Perez, Jose Danie','Av. 9 de julio 23 - Barranqueras','3624482222','3624668855','miemail@mail.com'),(16145,21860598,'Gonzalez, Estela','Irigoyen 44 Resistencia','3235353563','3355224455','otroemail@tumail.com'),(16578,32456666,'Saez, Daniel','bÂ°100 viv - fontana','3235353565','3355224433','daniel@saez.com'),(16584,39111322,'Santana, RubÃ©n','Lote 234 - Charadai','3235353567','3355224411','bd@tsp.edu.ar'),(17432,35442123,'Simpsons, Bartolomeo','Av.Siempre Viva 742- Resistencia','3624442671','3624611968','notengo@mail.com'),(18000,24666358,'Lopez, Rodrigo','san martin 502 - Colonia Benitez','3235353569','3355224499','micasa@internet.com.ar');
/*!40000 ALTER TABLE `Abonado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Conexion`
--

DROP TABLE IF EXISTS `Conexion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Conexion` (
  `idConexion` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(45) DEFAULT NULL,
  `fechaInstalacionReal` datetime DEFAULT NULL,
  `coordenadas` varchar(45) DEFAULT NULL,
  `esMoroso` bit(1) DEFAULT NULL,
  `idAbonado` int(11) NOT NULL,
  `idEstadoConexion` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL,
  `idLocalidad` int(11) NOT NULL,
  PRIMARY KEY (`idConexion`),
  KEY `fk_Conexion_Abonado1_idx` (`idAbonado`),
  KEY `fk_Conexion_EstadoConexion1_idx` (`idEstadoConexion`),
  KEY `fk_Conexion_Servicio1_idx` (`idServicio`),
  KEY `fk_Conexion_Localidad1_idx` (`idLocalidad`),
  CONSTRAINT `fk_Conexion_Abonado1` FOREIGN KEY (`idAbonado`) REFERENCES `Abonado` (`idAbonado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Conexion_EstadoConexion1` FOREIGN KEY (`idEstadoConexion`) REFERENCES `EstadoConexion` (`idEstadoConexion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Conexion_Localidad1` FOREIGN KEY (`idLocalidad`) REFERENCES `Localidad` (`idLocalidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Conexion_Servicio1` FOREIGN KEY (`idServicio`) REFERENCES `Servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Conexion`
--

LOCK TABLES `Conexion` WRITE;
/*!40000 ALTER TABLE `Conexion` DISABLE KEYS */;
INSERT INTO `Conexion` VALUES (123,'Av. 9 de julio 233','2016-01-15 00:00:00','','',16132,1,1,2),(124,'Irigoyen 44','2016-01-18 00:00:00','','',16145,1,2,1),(125,'obligado 4475','2016-03-15 00:00:00','','',12868,1,3,5),(126,'bÂ°100 viv ','2016-06-15 00:00:00','','',16578,4,1,3),(127,'Planta Urbana ','2016-07-16 00:00:00','','',15468,3,2,7),(128,'Lote 234 ','2016-08-15 00:00:00','','',16584,1,3,8),(129,'Nomeacuerdo 503','2016-09-28 00:00:00','','',16100,3,1,3),(130,'san martin 502 ','2016-10-15 00:00:00','','',18000,1,2,6),(131,'Av.Siempre Viva 742','2016-11-15 00:00:00','','',17432,1,3,1),(132,'otro domicilio 742','0000-00-00 00:00:00','','',16132,2,1,1),(133,'mi otra casa 433','0000-00-00 00:00:00','','',16145,2,2,1);
/*!40000 ALTER TABLE `Conexion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ConexionEnHojaRuta`
--

DROP TABLE IF EXISTS `ConexionEnHojaRuta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ConexionEnHojaRuta` (
  `idConexion` int(11) NOT NULL,
  `idHojaRuta` int(11) NOT NULL,
  PRIMARY KEY (`idConexion`,`idHojaRuta`),
  KEY `fk_ConexionEnHojaRuta_Conexion1_idx` (`idConexion`),
  KEY `fk_ConexionEnHojaRuta_HojaRuta1_idx` (`idHojaRuta`),
  CONSTRAINT `fk_ConexionEnHojaRuta_Conexion1` FOREIGN KEY (`idConexion`) REFERENCES `Conexion` (`idConexion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ConexionEnHojaRuta_HojaRuta1` FOREIGN KEY (`idHojaRuta`) REFERENCES `HojaRuta` (`idHojaRuta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ConexionEnHojaRuta`
--

LOCK TABLES `ConexionEnHojaRuta` WRITE;
/*!40000 ALTER TABLE `ConexionEnHojaRuta` DISABLE KEYS */;
INSERT INTO `ConexionEnHojaRuta` VALUES (126,1),(127,2),(129,3),(130,4),(132,5),(133,5);
/*!40000 ALTER TABLE `ConexionEnHojaRuta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ContrataConexion`
--

DROP TABLE IF EXISTS `ContrataConexion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ContrataConexion` (
  `idAbonado` int(11) NOT NULL,
  `idConexion` int(11) NOT NULL,
  `idViaComunicacion` int(11) NOT NULL,
  `fechaInstalacion1` datetime NOT NULL,
  `fechaInstalacion2` datetime NOT NULL,
  PRIMARY KEY (`idAbonado`,`idConexion`,`idViaComunicacion`),
  KEY `fk_ContrataConexion_ViaComunicacion1_idx` (`idViaComunicacion`),
  KEY `fk_ContrataConexion_Conexion1_idx` (`idConexion`),
  KEY `fk_ContrataConexion_Abonado1_idx` (`idAbonado`),
  CONSTRAINT `fk_ContrataConexion_Abonado1` FOREIGN KEY (`idAbonado`) REFERENCES `Abonado` (`idAbonado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ContrataConexion_Conexion1` FOREIGN KEY (`idConexion`) REFERENCES `Conexion` (`idConexion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ContrataConexion_ViaComunicacion1` FOREIGN KEY (`idViaComunicacion`) REFERENCES `ViaComunicacion` (`idViaComunicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ContrataConexion`
--

LOCK TABLES `ContrataConexion` WRITE;
/*!40000 ALTER TABLE `ContrataConexion` DISABLE KEYS */;
INSERT INTO `ContrataConexion` VALUES (16100,129,3,'2016-09-28 17:32:00','2016-09-30 00:00:00'),(16132,123,2,'2016-01-13 08:40:00','2016-01-15 00:00:00'),(16132,132,2,'2016-07-14 17:32:00','2016-07-30 00:00:00'),(16145,124,2,'2016-01-18 18:18:00','2016-01-20 00:00:00'),(16145,133,3,'2016-05-11 14:22:00','2016-05-20 00:00:00');
/*!40000 ALTER TABLE `ContrataConexion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ContrataEvento`
--

DROP TABLE IF EXISTS `ContrataEvento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ContrataEvento` (
  `idAbonado` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  PRIMARY KEY (`idAbonado`,`idEvento`),
  KEY `fk_ContrataEvento_Abonado1_idx` (`idAbonado`),
  KEY `fk_ContrataEvento_EventoYPeliculas1_idx` (`idEvento`),
  CONSTRAINT `fk_ContrataEvento_Abonado1` FOREIGN KEY (`idAbonado`) REFERENCES `Abonado` (`idAbonado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ContrataEvento_EventoYPeliculas1` FOREIGN KEY (`idEvento`) REFERENCES `EventoYPeliculas` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ContrataEvento`
--

LOCK TABLES `ContrataEvento` WRITE;
/*!40000 ALTER TABLE `ContrataEvento` DISABLE KEYS */;
INSERT INTO `ContrataEvento` VALUES (12868,1),(12868,3),(16584,1),(17432,1),(17432,2),(17432,3);
/*!40000 ALTER TABLE `ContrataEvento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EquipoTecnico`
--

DROP TABLE IF EXISTS `EquipoTecnico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EquipoTecnico` (
  `idEquipoTecnico` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculoAsignado` varchar(45) DEFAULT NULL,
  `idZona` int(11) NOT NULL,
  PRIMARY KEY (`idEquipoTecnico`),
  KEY `fk_EquipoTecnico_Zona1_idx` (`idZona`),
  CONSTRAINT `fk_EquipoTecnico_Zona1` FOREIGN KEY (`idZona`) REFERENCES `Zona` (`idZona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EquipoTecnico`
--

LOCK TABLES `EquipoTecnico` WRITE;
/*!40000 ALTER TABLE `EquipoTecnico` DISABLE KEYS */;
INSERT INTO `EquipoTecnico` VALUES (1,'MQD725',1),(2,'MZT432',2),(3,'LZH732',3),(4,'PTO725',4),(5,'PNE705',1);
/*!40000 ALTER TABLE `EquipoTecnico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EstadoConexion`
--

DROP TABLE IF EXISTS `EstadoConexion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EstadoConexion` (
  `idEstadoConexion` int(11) NOT NULL,
  `nombreEstadoConexion` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  PRIMARY KEY (`idEstadoConexion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EstadoConexion`
--

LOCK TABLES `EstadoConexion` WRITE;
/*!40000 ALTER TABLE `EstadoConexion` DISABLE KEYS */;
INSERT INTO `EstadoConexion` VALUES (1,'correcto','verde'),(2,'nueva','azul'),(3,'limitado','amarillo'),(4,'corte','rojo');
/*!40000 ALTER TABLE `EstadoConexion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventoYPeliculas`
--

DROP TABLE IF EXISTS `EventoYPeliculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EventoYPeliculas` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEvento` varchar(45) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `costoEvento` double DEFAULT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventoYPeliculas`
--

LOCK TABLES `EventoYPeliculas` WRITE;
/*!40000 ALTER TABLE `EventoYPeliculas` DISABLE KEYS */;
INSERT INTO `EventoYPeliculas` VALUES (1,'2016-11-25 23:00:00','0000-00-00 00:00:00',NULL),(2,'2016-12-15 18:00:00','0000-00-00 00:00:00',NULL),(3,'2016-11-25 19:30:00','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `EventoYPeliculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HojaRuta`
--

DROP TABLE IF EXISTS `HojaRuta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HojaRuta` (
  `idHojaRuta` int(11) NOT NULL AUTO_INCREMENT,
  `fechaEmision` datetime NOT NULL,
  PRIMARY KEY (`idHojaRuta`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HojaRuta`
--

LOCK TABLES `HojaRuta` WRITE;
/*!40000 ALTER TABLE `HojaRuta` DISABLE KEYS */;
INSERT INTO `HojaRuta` VALUES (1,'2016-11-14 00:00:00'),(2,'2016-11-15 00:00:00'),(3,'2016-11-16 00:00:00'),(4,'2016-11-17 00:00:00'),(5,'2016-11-18 00:00:00');
/*!40000 ALTER TABLE `HojaRuta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Insumo`
--

DROP TABLE IF EXISTS `Insumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Insumo` (
  `idInsumo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreInsumo` varchar(45) NOT NULL,
  `unidadesMedida` varchar(45) NOT NULL,
  PRIMARY KEY (`idInsumo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Insumo`
--

LOCK TABLES `Insumo` WRITE;
/*!40000 ALTER TABLE `Insumo` DISABLE KEYS */;
INSERT INTO `Insumo` VALUES (1,'Cable Exterior','mts'),(2,'Cable Interior','mts'),(3,'decodificador','unidad'),(4,'patchcords 3mts','unidad'),(5,'patchcords 5mts','unidad'),(6,'grampas','unidad'),(7,'no insume','');
/*!40000 ALTER TABLE `Insumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Localidad`
--

DROP TABLE IF EXISTS `Localidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Localidad` (
  `idLocalidad` int(11) NOT NULL,
  `nombreLocalidad` varchar(45) NOT NULL,
  `codigoPostal` varchar(45) NOT NULL,
  `idZona` int(11) NOT NULL,
  PRIMARY KEY (`idLocalidad`),
  KEY `fk_Localidad_Zona_idx` (`idZona`),
  CONSTRAINT `fk_Localidad_Zona` FOREIGN KEY (`idZona`) REFERENCES `Zona` (`idZona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Localidad`
--

LOCK TABLES `Localidad` WRITE;
/*!40000 ALTER TABLE `Localidad` DISABLE KEYS */;
INSERT INTO `Localidad` VALUES (1,'Resistencia ','3500',1),(2,'Barranqueras','3503',1),(3,'Fontana','3514',2),(4,'Tirol','3505',2),(5,'Margarita Belen','3505',3),(6,'Colonia Benitez','3505',3),(7,'Cote Lai','3513',4),(8,'Charadai','3513',4);
/*!40000 ALTER TABLE `Localidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PrioridadTrabajo`
--

DROP TABLE IF EXISTS `PrioridadTrabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PrioridadTrabajo` (
  `idPrioridadTrabajo` int(11) NOT NULL,
  `nombrePrioridad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPrioridadTrabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PrioridadTrabajo`
--

LOCK TABLES `PrioridadTrabajo` WRITE;
/*!40000 ALTER TABLE `PrioridadTrabajo` DISABLE KEYS */;
INSERT INTO `PrioridadTrabajo` VALUES (1,'Alta'),(2,'Media'),(3,'Baja');
/*!40000 ALTER TABLE `PrioridadTrabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reclamo`
--

DROP TABLE IF EXISTS `Reclamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reclamo` (
  `idReclamo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `estadoReclamo` varchar(45) NOT NULL,
  PRIMARY KEY (`idReclamo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reclamo`
--

LOCK TABLES `Reclamo` WRITE;
/*!40000 ALTER TABLE `Reclamo` DISABLE KEYS */;
INSERT INTO `Reclamo` VALUES (1,'sin señal','pendiente'),(2,'no veo canales peliculas','pendiente de revision'),(3,'se ve con rayas','cerrado'),(4,'sin señal','cerrado'),(5,'faltan canales','pendiente de revision'),(6,'se ve con fantasmas','pendiente'),(7,'no veo  canales hd','pendiente');
/*!40000 ALTER TABLE `Reclamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReclamosRealizado`
--

DROP TABLE IF EXISTS `ReclamosRealizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ReclamosRealizado` (
  `idAbonado` int(11) NOT NULL,
  `idReclamo` int(11) NOT NULL,
  `idConexion` int(11) NOT NULL,
  `idViaComunicacion` int(11) NOT NULL,
  `fechaReclamo` datetime NOT NULL,
  PRIMARY KEY (`idAbonado`,`idReclamo`,`idConexion`),
  KEY `fk_ReclamosRealizado_Abonado1_idx` (`idAbonado`),
  KEY `fk_ReclamosRealizado_Conexion1_idx` (`idConexion`),
  KEY `fk_ReclamosRealizado_ViaComunicacion1_idx` (`idViaComunicacion`),
  KEY `fk_ReclamosRealizado_Reclamo1_idx` (`idReclamo`),
  CONSTRAINT `fk_ReclamosRealizado_Abonado1` FOREIGN KEY (`idAbonado`) REFERENCES `Abonado` (`idAbonado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ReclamosRealizado_Conexion1` FOREIGN KEY (`idConexion`) REFERENCES `Conexion` (`idConexion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ReclamosRealizado_Reclamo1` FOREIGN KEY (`idReclamo`) REFERENCES `Reclamo` (`idReclamo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ReclamosRealizado_ViaComunicacion1` FOREIGN KEY (`idViaComunicacion`) REFERENCES `ViaComunicacion` (`idViaComunicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReclamosRealizado`
--

LOCK TABLES `ReclamosRealizado` WRITE;
/*!40000 ALTER TABLE `ReclamosRealizado` DISABLE KEYS */;
INSERT INTO `ReclamosRealizado` VALUES (15468,1,127,2,'2016-08-09 10:30:00'),(15468,4,127,2,'2016-09-21 14:23:00'),(16100,5,129,3,'2016-08-02 18:57:00'),(16100,6,129,1,'2016-07-15 16:00:00');
/*!40000 ALTER TABLE `ReclamosRealizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Servicio`
--

DROP TABLE IF EXISTS `Servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Servicio` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `costo` double DEFAULT NULL,
  `cantCanales` int(11) DEFAULT NULL,
  `cantCanalesHD` int(11) DEFAULT NULL,
  `cantCanalesPelicula` int(11) DEFAULT NULL,
  `esPremium` bit(1) DEFAULT NULL,
  `esPlus` bit(1) DEFAULT NULL,
  `esEstandar` bit(1) DEFAULT NULL,
  `nombreServicio` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Servicio`
--

LOCK TABLES `Servicio` WRITE;
/*!40000 ALTER TABLE `Servicio` DISABLE KEYS */;
INSERT INTO `Servicio` VALUES (1,500,40,0,0,'\0','\0','','Estandar'),(2,600,40,2,4,'\0','','\0','Plus'),(3,700,46,4,0,'','\0','\0','Premium');
/*!40000 ALTER TABLE `Servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tarea`
--

DROP TABLE IF EXISTS `Tarea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tarea` (
  `idTarea` int(11) NOT NULL AUTO_INCREMENT,
  `nombreTarea` varchar(45) NOT NULL,
  PRIMARY KEY (`idTarea`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tarea`
--

LOCK TABLES `Tarea` WRITE;
/*!40000 ALTER TABLE `Tarea` DISABLE KEYS */;
INSERT INTO `Tarea` VALUES (1,'Cambio Decodificador'),(2,'Cambio Bajada'),(3,'Cableado Domicilio'),(4,'Calibrar Señal'),(5,'Quitar Bajada'),(6,'Instalacion Nueva');
/*!40000 ALTER TABLE `Tarea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TareaPorTrabajo`
--

DROP TABLE IF EXISTS `TareaPorTrabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TareaPorTrabajo` (
  `idTrabajo` int(11) NOT NULL,
  `idTarea` int(11) NOT NULL,
  PRIMARY KEY (`idTrabajo`,`idTarea`),
  KEY `fk_TareaPorTrabajo_Tarea1_idx` (`idTarea`),
  KEY `fk_TareaPorTrabajo_Trabajo1_idx` (`idTrabajo`),
  CONSTRAINT `fk_TareaPorTrabajo_Tarea1` FOREIGN KEY (`idTarea`) REFERENCES `Tarea` (`idTarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TareaPorTrabajo_Trabajo1` FOREIGN KEY (`idTrabajo`) REFERENCES `Trabajo` (`idTrabajo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TareaPorTrabajo`
--

LOCK TABLES `TareaPorTrabajo` WRITE;
/*!40000 ALTER TABLE `TareaPorTrabajo` DISABLE KEYS */;
INSERT INTO `TareaPorTrabajo` VALUES (2,1),(5,1),(1,2),(4,2),(10,2),(11,2),(1,3),(3,3),(4,3),(7,3),(6,4),(8,5),(9,5),(12,5),(13,6),(14,6);
/*!40000 ALTER TABLE `TareaPorTrabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Trabajo`
--

DROP TABLE IF EXISTS `Trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Trabajo` (
  `idTrabajo` int(11) NOT NULL AUTO_INCREMENT,
  `idPrioridadTrabajo` int(11) NOT NULL,
  `estadoTrabajo` varchar(45) DEFAULT NULL,
  `idHojaRuta` int(11) NOT NULL,
  PRIMARY KEY (`idTrabajo`),
  KEY `fk_Trabajo_PrioridadTrabajo1_idx` (`idPrioridadTrabajo`),
  KEY `fk_Trabajo_HojaRuta1_idx` (`idHojaRuta`),
  CONSTRAINT `fk_Trabajo_HojaRuta1` FOREIGN KEY (`idHojaRuta`) REFERENCES `HojaRuta` (`idHojaRuta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Trabajo_PrioridadTrabajo1` FOREIGN KEY (`idPrioridadTrabajo`) REFERENCES `PrioridadTrabajo` (`idPrioridadTrabajo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Trabajo`
--

LOCK TABLES `Trabajo` WRITE;
/*!40000 ALTER TABLE `Trabajo` DISABLE KEYS */;
INSERT INTO `Trabajo` VALUES (1,1,'solucionado',1),(2,1,'no solucionado',1),(3,1,'ausente',2),(4,1,'solucionado',2),(5,1,'solucionado',3),(6,1,'no solucionado',4),(7,1,'solucionado',5),(8,1,'no solucionado',5),(9,1,'solucionado',1),(10,3,'solucionado',2),(11,3,'solucionado',3),(12,1,'solucionado',4),(13,1,'solucionado',5),(14,1,'solucionado',5);
/*!40000 ALTER TABLE `Trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TrabajoRealizado`
--

DROP TABLE IF EXISTS `TrabajoRealizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TrabajoRealizado` (
  `idEquipoTecnico` int(11) NOT NULL,
  `idInsumo` int(11) NOT NULL,
  `idTrabajo` int(11) NOT NULL,
  `cantInsumos` int(11) DEFAULT NULL,
  `fechaTrabajo` datetime NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  PRIMARY KEY (`idEquipoTecnico`,`idInsumo`,`idTrabajo`),
  KEY `fk_TrabajoRealizado_EquipoTecnico1_idx` (`idEquipoTecnico`),
  KEY `fk_TrabajoRealizado_Insumo1_idx` (`idInsumo`),
  KEY `fk_TrabajoRealizado_Trabajo1_idx` (`idTrabajo`),
  CONSTRAINT `fk_TrabajoRealizado_EquipoTecnico1` FOREIGN KEY (`idEquipoTecnico`) REFERENCES `EquipoTecnico` (`idEquipoTecnico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrabajoRealizado_Insumo1` FOREIGN KEY (`idInsumo`) REFERENCES `Insumo` (`idInsumo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrabajoRealizado_Trabajo1` FOREIGN KEY (`idTrabajo`) REFERENCES `Trabajo` (`idTrabajo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrabajoRealizado`
--

LOCK TABLES `TrabajoRealizado` WRITE;
/*!40000 ALTER TABLE `TrabajoRealizado` DISABLE KEYS */;
INSERT INTO `TrabajoRealizado` VALUES (1,1,1,20,'2016-11-14 09:55:00','\r'),(1,1,4,25,'2016-11-15 11:23:00','\r'),(1,2,1,10,'2016-11-14 10:00:00','\r'),(1,2,3,15,'2016-11-15 11:02:00','\r'),(1,2,4,18,'2016-11-17 17:40:00','\r'),(1,2,7,25,'2016-11-18 17:10:00','cable anterior en mal estado\r'),(1,3,2,1,'2016-11-15 16:20:00','\r'),(1,3,5,1,'2016-11-16 17:32:00','\r'),(1,7,6,0,'2016-11-17 11:54:00','\"se calibro el deco'),(2,7,9,0,'2016-11-14 10:10:00','\r'),(3,1,11,32,'2016-11-16 09:50:00','\r'),(3,7,12,0,'2016-11-17 19:30:00','\r'),(4,1,10,35,'2016-11-15 09:03:00','\r'),(5,1,13,30,'2016-11-18 16:50:00','\r'),(5,1,14,28,'2016-11-18 19:41:00','\r'),(5,2,13,12,'2016-11-18 08:40:00','\r'),(5,2,14,15,'2016-11-18 20:30:00','\r'),(5,3,13,1,'2016-11-18 09:15:00','\r'),(5,3,14,1,'2016-11-18 20:50:00',''),(5,7,8,0,'2016-11-18 09:10:00','se retira deco\r');
/*!40000 ALTER TABLE `TrabajoRealizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ViaComunicacion`
--

DROP TABLE IF EXISTS `ViaComunicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ViaComunicacion` (
  `idViaComunicacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombreViaComunicacion` varchar(45) NOT NULL,
  PRIMARY KEY (`idViaComunicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ViaComunicacion`
--

LOCK TABLES `ViaComunicacion` WRITE;
/*!40000 ALTER TABLE `ViaComunicacion` DISABLE KEYS */;
INSERT INTO `ViaComunicacion` VALUES (1,'Web'),(2,'Telefonica'),(3,'Personal');
/*!40000 ALTER TABLE `ViaComunicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Zona`
--

DROP TABLE IF EXISTS `Zona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Zona` (
  `idZona` int(11) NOT NULL AUTO_INCREMENT,
  `nombreZona` varchar(45) NOT NULL,
  PRIMARY KEY (`idZona`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Zona`
--

LOCK TABLES `Zona` WRITE;
/*!40000 ALTER TABLE `Zona` DISABLE KEYS */;
INSERT INTO `Zona` VALUES (1,'Zona1'),(2,'Zona2'),(3,'Zona3'),(4,'Zona4');
/*!40000 ALTER TABLE `Zona` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-24 20:52:09
