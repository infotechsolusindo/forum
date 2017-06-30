-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: newforum
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `wewenang` char(1) NOT NULL DEFAULT 'x',
  `created` timestamp NULL DEFAULT NULL,
  `lastmodify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun`
--

LOCK TABLES `akun` WRITE;
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
INSERT INTO `akun` VALUES ('brahmantyo.adi@gmail.com','d9b1d7db4cd6e70935368a1efb10e377','x','2017-06-26 23:06:26','2017-06-27 11:08:27');
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anggota` (
  `nra` varchar(20) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `namapanggilan` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `angkatan` char(4) NOT NULL,
  `jeniskelamin` enum('L','P') NOT NULL,
  `tempatlahir` char(15) NOT NULL,
  `tgllahir` date NOT NULL,
  `nomerponsel` char(15) DEFAULT NULL,
  `alamatdomisili` varchar(50) DEFAULT NULL,
  `pendidikanterakhir` enum('SMP','SMU','SMK','D1','D3','S1') DEFAULT NULL,
  `pekerjaan` varchar(30) DEFAULT NULL,
  `institusi` varchar(20) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'D',
  PRIMARY KEY (`nra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aturanseleksi`
--

DROP TABLE IF EXISTS `aturanseleksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aturanseleksi` (
  `angkatan` varchar(4) NOT NULL DEFAULT '1910',
  `tahap` int(2) NOT NULL DEFAULT '1',
  `nomerberkas` int(2) NOT NULL,
  `namaberkas` varchar(20) NOT NULL,
  `wajib` tinyint(1) NOT NULL DEFAULT '0',
  `admin` varchar(20) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aturanseleksi`
--

LOCK TABLES `aturanseleksi` WRITE;
/*!40000 ALTER TABLE `aturanseleksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `aturanseleksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen`
--

DROP TABLE IF EXISTS `dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen` (
  `iddokumen` int(11) NOT NULL AUTO_INCREMENT,
  `peserta` varchar(50) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `deskripsi` varchar(20) NOT NULL,
  `file` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`iddokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen`
--

LOCK TABLES `dokumen` WRITE;
/*!40000 ALTER TABLE `dokumen` DISABLE KEYS */;
INSERT INTO `dokumen` VALUES (1,'brahmantyo.adi@gmail.com','Berkas1','Biodata','-',NULL),(2,'brahmantyo.adi@gmail.com','Berkas2','Data Orang Tua / Wali','-',NULL),(3,'brahmantyo.adi@gmail.com','Berkas3','Ketrampilan','-',NULL),(4,'brahmantyo.adi@gmail.com','Berkas4','Data Sekolah','-',NULL),(5,'brahmantyo.adi@gmail.com','Berkas5','Lampiran','-',NULL),(6,'brahmantyo.adi@gmail.com','Berkas1','Biodata','-',NULL),(7,'brahmantyo.adi@gmail.com','Berkas2','Data Orang Tua / Wali','-',NULL),(8,'brahmantyo.adi@gmail.com','Berkas3','Ketrampilan','-',NULL),(9,'brahmantyo.adi@gmail.com','Berkas4','Data Sekolah','-',NULL),(10,'brahmantyo.adi@gmail.com','Berkas5','Lampiran','-',NULL);
/*!40000 ALTER TABLE `dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formulir`
--

DROP TABLE IF EXISTS `formulir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formulir` (
  `idform` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idform`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulir`
--

LOCK TABLES `formulir` WRITE;
/*!40000 ALTER TABLE `formulir` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum` (
  `idforum` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idforum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum`
--

LOCK TABLES `forum` WRITE;
/*!40000 ALTER TABLE `forum` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karir`
--

DROP TABLE IF EXISTS `karir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `karir` (
  `kodekarir` int(11) NOT NULL AUTO_INCREMENT,
  `nra` varchar(20) NOT NULL,
  `kategori` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `gaji` float DEFAULT NULL,
  `bataswaktu` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`kodekarir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karir`
--

LOCK TABLES `karir` WRITE;
/*!40000 ALTER TABLE `karir` DISABLE KEYS */;
/*!40000 ALTER TABLE `karir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kegiatan`
--

DROP TABLE IF EXISTS `kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kegiatan` (
  `kodekegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `nra` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jadwal` datetime NOT NULL,
  `durasi` int(11) NOT NULL,
  `biaya` float DEFAULT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`kodekegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatan`
--

LOCK TABLES `kegiatan` WRITE;
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komenkarir`
--

DROP TABLE IF EXISTS `komenkarir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komenkarir` (
  `kodekomenkarir` int(11) NOT NULL AUTO_INCREMENT,
  `kodekarir` int(11) NOT NULL,
  `nra` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`kodekomenkarir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komenkarir`
--

LOCK TABLES `komenkarir` WRITE;
/*!40000 ALTER TABLE `komenkarir` DISABLE KEYS */;
/*!40000 ALTER TABLE `komenkarir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komenkegiatan`
--

DROP TABLE IF EXISTS `komenkegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komenkegiatan` (
  `idkomenkegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `kodekegiatan` int(11) NOT NULL,
  `nra` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`idkomenkegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komenkegiatan`
--

LOCK TABLES `komenkegiatan` WRITE;
/*!40000 ALTER TABLE `komenkegiatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `komenkegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komenthread`
--

DROP TABLE IF EXISTS `komenthread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komenthread` (
  `kodekomenthread` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `kodethread` int(11) NOT NULL,
  `nra` varchar(20) NOT NULL,
  `waktu` time NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kodekomenthread`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komenthread`
--

LOCK TABLES `komenthread` WRITE;
/*!40000 ALTER TABLE `komenthread` DISABLE KEYS */;
/*!40000 ALTER TABLE `komenthread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendaftaran` (
  `idpendaftaran` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `peserta` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpendaftaran`),
  UNIQUE KEY `peserta` (`peserta`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftaran`
--

LOCK TABLES `pendaftaran` WRITE;
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
INSERT INTO `pendaftaran` VALUES (1,'2017-06-27','brahmantyo.adi@gmail.com','0');
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seleksi`
--

DROP TABLE IF EXISTS `seleksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seleksi` (
  `idseleksi` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idseleksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seleksi`
--

LOCK TABLES `seleksi` WRITE;
/*!40000 ALTER TABLE `seleksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `seleksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread`
--

DROP TABLE IF EXISTS `thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread` (
  `kodethread` int(11) NOT NULL AUTO_INCREMENT,
  `nra` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `topik` varchar(20) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`kodethread`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread`
--

LOCK TABLES `thread` WRITE;
/*!40000 ALTER TABLE `thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-28 11:43:16
