-- MariaDB dump 10.17  Distrib 10.4.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: sialan
-- ------------------------------------------------------
-- Server version	10.4.13-MariaDB

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
-- Table structure for table `absens`
--

DROP TABLE IF EXISTS `absens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `absens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bio_nid` bigint(20) unsigned DEFAULT NULL,
  `pangkat_id` bigint(20) unsigned DEFAULT NULL,
  `instansi_id` bigint(20) unsigned DEFAULT NULL,
  `tgl_absen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `absens_bio_nid_foreign` (`bio_nid`),
  KEY `absens_pangkat_id_foreign` (`pangkat_id`),
  KEY `absens_instansi_id_foreign` (`instansi_id`),
  CONSTRAINT `absens_bio_nid_foreign` FOREIGN KEY (`bio_nid`) REFERENCES `biodatas` (`nid`) ON UPDATE CASCADE,
  CONSTRAINT `absens_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `absens_pangkat_id_foreign` FOREIGN KEY (`pangkat_id`) REFERENCES `ranks` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absens`
--

LOCK TABLES `absens` WRITE;
/*!40000 ALTER TABLE `absens` DISABLE KEYS */;
INSERT INTO `absens` VALUES (2,123456789123456789,1,1,'2020-06-30 22:00:00'),(3,123456789123456789,1,1,'2020-07-01 22:00:00'),(4,123456789123456789,1,1,'2020-07-02 22:00:00'),(5,123456789123456789,1,1,'2020-07-05 22:00:00'),(6,123456789123456789,1,1,'2020-07-06 22:00:00'),(7,123456789123456789,1,1,'2020-07-07 22:00:00'),(8,123456789123456789,1,1,'2020-07-08 22:00:00'),(9,123456789123456789,1,1,'2020-07-09 22:00:00'),(10,123456789123456789,1,1,'2020-07-12 22:00:00'),(11,123456789123456789,1,1,'2020-07-13 22:00:00'),(12,123456789123456789,1,1,'2020-07-14 22:00:00'),(13,123456789123456789,1,1,'2020-07-15 22:00:00'),(14,123456789123456789,1,1,'2020-07-16 22:00:00'),(15,123456789123456789,1,1,'2020-07-19 22:00:00'),(16,123456789123456789,1,1,'2020-07-20 22:00:00'),(17,123456789123456789,1,1,'2020-07-21 22:00:00'),(18,123456789123456789,1,1,'2020-07-22 22:00:00'),(19,123456789123456789,1,1,'2020-07-23 22:00:00'),(20,123456789123456789,1,1,'2020-07-27 15:55:25'),(21,123456789123456789,1,1,'2020-07-28 22:00:00'),(22,123456789123456789,1,1,'2020-07-29 22:00:00'),(23,123456789123456789,1,1,'2020-07-30 22:00:00'),(24,123456789123456789,1,1,'2020-07-26 23:02:23'),(25,4451,1,1,'2020-07-28 18:42:10'),(26,4451,1,1,'2020-07-29 18:09:51'),(27,1234,2,1,'2020-07-29 18:10:35'),(28,4451,1,1,'2020-07-30 21:02:26'),(29,1234,2,1,'2020-07-31 01:36:35'),(30,123556666,1,4,'2020-07-31 07:52:25'),(31,123456789123456987,2,1,'2020-07-31 08:30:43'),(32,4451,1,1,'2020-07-31 22:09:14'),(33,123556666,1,1,'2020-08-02 00:53:53'),(34,4451,1,1,'2020-08-02 00:54:07'),(35,123556666,1,1,'2020-08-03 01:18:09');
/*!40000 ALTER TABLE `absens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anouncements`
--

DROP TABLE IF EXISTS `anouncements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anouncements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_creator` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anouncements`
--

LOCK TABLES `anouncements` WRITE;
/*!40000 ALTER TABLE `anouncements` DISABLE KEYS */;
/*!40000 ALTER TABLE `anouncements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biodatas`
--

DROP TABLE IF EXISTS `biodatas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biodatas` (
  `nid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmpt_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jkel` tinyint(1) DEFAULT NULL,
  `pangkat_id` bigint(20) unsigned DEFAULT NULL,
  `instansi_id` bigint(20) unsigned DEFAULT NULL,
  `profil_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'person.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`nid`),
  KEY `biodatas_pangkat_id_foreign` (`pangkat_id`),
  KEY `biodatas_instansi_id_foreign` (`instansi_id`),
  CONSTRAINT `biodatas_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `biodatas_pangkat_id_foreign` FOREIGN KEY (`pangkat_id`) REFERENCES `ranks` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123456789123456988 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biodatas`
--

LOCK TABLES `biodatas` WRITE;
/*!40000 ALTER TABLE `biodatas` DISABLE KEYS */;
INSERT INTO `biodatas` VALUES (1234,'User1','Trenggalen','1699-06-05',1,2,1,'person.png','2020-07-28 19:04:42','2020-07-29 18:07:47'),(4450,'Admin Pusat','Trenggalen','1966-02-03',1,1,1,'person.png','2020-07-28 18:14:14','2020-07-31 00:04:50'),(4451,'Admin Instansi','Trenggalen','1988-12-02',1,1,1,'person.png','2020-07-28 18:13:42','2020-07-29 15:21:06'),(11111,'Super',NULL,NULL,NULL,NULL,NULL,'person.png',NULL,NULL),(123556666,'Universitas Papua','Trenggalen','2020-07-28',1,1,1,'person.png','2020-07-31 07:51:40','2020-08-03 01:19:35'),(123456789123456789,'Murni Widayat','Trenggalen','1988-06-02',1,1,1,'person.png','2020-07-27 14:16:50','2020-07-31 01:20:24'),(123456789123456987,'Pengguna Baru','Trenggalen','2020-12-05',1,2,1,'person.png','2020-07-31 08:29:38','2020-07-31 08:30:17');
/*!40000 ALTER TABLE `biodatas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_kegiatans`
--

DROP TABLE IF EXISTS `doc_kegiatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doc_kegiatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desk` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `absen_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doc_kegiatans_absen_id_foreign` (`absen_id`),
  CONSTRAINT `doc_kegiatans_absen_id_foreign` FOREIGN KEY (`absen_id`) REFERENCES `absens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_kegiatans`
--

LOCK TABLES `doc_kegiatans` WRITE;
/*!40000 ALTER TABLE `doc_kegiatans` DISABLE KEYS */;
/*!40000 ALTER TABLE `doc_kegiatans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `holi_date` date NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `holidays_holi_date_unique` (`holi_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instansis`
--

DROP TABLE IF EXISTS `instansis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instansis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_ins` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instansis`
--

LOCK TABLES `instansis` WRITE;
/*!40000 ALTER TABLE `instansis` DISABLE KEYS */;
INSERT INTO `instansis` VALUES (1,'Universitas Cendrawasih','Jayapura - Papua'),(2,'Akademi Tenik Biak','Biak Papua'),(3,'Universitas Papua','Manokwari Papua Barat'),(4,'Universitas Muhamadiah','Sorong Papua Barat');
/*!40000 ALTER TABLE `instansis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_08_19_000000_create_failed_jobs_table',1),(2,'2020_06_18_043240_create_ranks_table',1),(3,'2020_06_22_221255_create_instansis_table',1),(4,'2020_07_07_032715_create_anouncements_table',1),(5,'2020_07_13_040334_cerate_password_resets_table',1),(6,'2020_07_15_052024_create_holidays_table',1),(7,'2020_07_17_042222_create_biodatas_table',1),(8,'2020_07_18_000000_create_users_table',1),(9,'2020_07_23_014100_create_absens_table',1),(10,'2020_07_23_020034_create_doc_kegiatans_table',1),(11,'2020_07_23_115339_alter_add_constrained_table',1),(13,'2020_07_31_062715_create_ttd_references_table',2),(16,'2020_07_31_212559_create_surat_tjs_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('widayatmurni@gmail.com','xJmLrMagXAdPFOmcRJZMaX2zIcSyZoSRACafGWDkK03dgRzVHvizJQw8Yiod',0,'2020-07-31 08:04:54','2020-07-31 08:04:54');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranks`
--

DROP TABLE IF EXISTS `ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pangkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranks`
--

LOCK TABLES `ranks` WRITE;
/*!40000 ALTER TABLE `ranks` DISABLE KEYS */;
INSERT INTO `ranks` VALUES (1,'Pembina Utama Madya / IVd'),(2,'Pengatur');
/*!40000 ALTER TABLE `ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surat_tjs`
--

DROP TABLE IF EXISTS `surat_tjs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat_tjs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bio_nid` bigint(20) unsigned NOT NULL,
  `instansi_id` bigint(20) unsigned NOT NULL,
  `periode` date NOT NULL,
  `file_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surat_tjs_bio_nid_foreign` (`bio_nid`),
  KEY `surat_tjs_instansi_id_foreign` (`instansi_id`),
  CONSTRAINT `surat_tjs_bio_nid_foreign` FOREIGN KEY (`bio_nid`) REFERENCES `biodatas` (`nid`),
  CONSTRAINT `surat_tjs_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surat_tjs`
--

LOCK TABLES `surat_tjs` WRITE;
/*!40000 ALTER TABLE `surat_tjs` DISABLE KEYS */;
INSERT INTO `surat_tjs` VALUES (1,4451,1,'2020-08-01','20200803120805.jpg','2020-08-03 03:08:05','2020-08-03 03:08:05');
/*!40000 ALTER TABLE `surat_tjs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ttd_references`
--

DROP TABLE IF EXISTS `ttd_references`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ttd_references` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi_id` bigint(20) unsigned NOT NULL,
  `bio_nid` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ttd_references_instansi_id_foreign` (`instansi_id`),
  KEY `ttd_references_bio_nid_foreign` (`bio_nid`),
  CONSTRAINT `ttd_references_bio_nid_foreign` FOREIGN KEY (`bio_nid`) REFERENCES `biodatas` (`nid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ttd_references_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ttd_references`
--

LOCK TABLES `ttd_references` WRITE;
/*!40000 ALTER TABLE `ttd_references` DISABLE KEYS */;
INSERT INTO `ttd_references` VALUES (1,'Kepala Kantor Urusan Universitas',1,4451);
/*!40000 ALTER TABLE `ttd_references` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `level` enum('super','admin','instansi','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `bio_nid` bigint(20) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_bio_nid_foreign` (`bio_nid`),
  CONSTRAINT `users_bio_nid_foreign` FOREIGN KEY (`bio_nid`) REFERENCES `biodatas` (`nid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'super@admin.mail.com','$2y$10$YgrBjPLoxnyyHRnZlRhN6OtMZS88XP8X0IexZ4o6pOq7FmRyxdNem',NULL,'super',11111,NULL,NULL,NULL),(2,'widayatmurni@gmail.com','$2y$10$bsnHjmnWGWoLZtHOdy5DTufDnN5/MGJ3Kx8JlsmYuwUGPbxEIzZLe',NULL,'instansi',123456789123456789,NULL,'2020-07-27 14:16:50','2020-08-03 10:39:14'),(3,'instansi@admin.mail.com','$2y$10$8OfCx0wzqT6aRoELbJQuCu1x4.wUKmIISEkrkDbu0B0.pE3JRF/7K',NULL,'instansi',4451,NULL,'2020-07-28 18:13:42','2020-07-28 18:13:42'),(4,'pusat@admin.mail.com','$2y$10$uVG0HcZ3ADVfLtq0HhITe.3Eo7d37B3QeWI3Xf30nI5n4ZyMDFH3.',NULL,'admin',4450,NULL,'2020-07-28 18:14:14','2020-07-28 18:14:14'),(5,'user1@user.com','$2y$10$zVXU.OM1tvPM1MdU3/GDuu.IyQyrAuaPWkx.ZhSUMDIiSbpCSSVH6',NULL,'user',1234,NULL,'2020-07-28 19:04:42','2020-07-28 19:04:42'),(7,'user3@user.com','$2y$10$NoMNq5BozsJzAuQRG3xa7udzLLxrqBeDrNuMuXjB6MyorGQkI8TBG',NULL,'user',123556666,NULL,'2020-07-31 07:51:40','2020-07-31 07:51:40'),(8,'penggunabaru@mail.com','$2y$10$JQBy8y3cBarVlbNsMn//5Od8LUrFrF1.rpfNf5qeu8SPG5fUYbeAi',NULL,'user',123456789123456987,NULL,'2020-07-31 08:29:38','2020-07-31 08:29:38');
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

-- Dump completed on 2020-08-04 12:01:37
