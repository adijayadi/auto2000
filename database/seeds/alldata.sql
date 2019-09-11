-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table auto2000.d_customer
DROP TABLE IF EXISTS `d_customer`;
CREATE TABLE IF NOT EXISTS `d_customer` (
  `c_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `c_serial` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_plate` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_typecar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_jobdesc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_dateservice` date DEFAULT NULL,
  `c_dateplan` date DEFAULT NULL,
  `c_serviceadvisor` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_nameadvisor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_code` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_order` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_countservice` int(11) NOT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `d_customer_c_serial_index` (`c_serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.d_customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `d_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_customer` ENABLE KEYS */;

-- Dumping structure for table auto2000.d_customerremovable
DROP TABLE IF EXISTS `d_customerremovable`;
CREATE TABLE IF NOT EXISTS `d_customerremovable` (
  `cr_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cr_serial` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr_plate` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr_typecar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr_jobdesc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr_dateservice` date DEFAULT NULL,
  `cr_serviceadvisor` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr_direct` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cr_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`cr_id`),
  KEY `d_customerremovable_cr_serial_index` (`cr_serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.d_customerremovable: ~0 rows (approximately)
/*!40000 ALTER TABLE `d_customerremovable` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_customerremovable` ENABLE KEYS */;

-- Dumping structure for table auto2000.d_followup
DROP TABLE IF EXISTS `d_followup`;
CREATE TABLE IF NOT EXISTS `d_followup` (
  `fu_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fu_cid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fu_cstaff` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fu_date` date DEFAULT NULL,
  `fu_time` time DEFAULT NULL,
  `fu_plandate` date DEFAULT NULL,
  `fu_plantime` time DEFAULT NULL,
  `fu_updatedate` date DEFAULT NULL,
  `fu_updatetime` time DEFAULT NULL,
  `fu_bookingdate` date DEFAULT NULL,
  `fu_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`fu_id`),
  KEY `d_followup_fu_cid_index` (`fu_cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.d_followup: ~0 rows (approximately)
/*!40000 ALTER TABLE `d_followup` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_followup` ENABLE KEYS */;

-- Dumping structure for table auto2000.d_recap
DROP TABLE IF EXISTS `d_recap`;
CREATE TABLE IF NOT EXISTS `d_recap` (
  `re_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `re_dataadded` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_availabledata` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_totaldata` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_dateupload` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_ccustomer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`re_id`),
  UNIQUE KEY `d_recap_re_ccustomer_unique` (`re_ccustomer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.d_recap: ~0 rows (approximately)
/*!40000 ALTER TABLE `d_recap` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_recap` ENABLE KEYS */;

-- Dumping structure for table auto2000.d_resultfu
DROP TABLE IF EXISTS `d_resultfu`;
CREATE TABLE IF NOT EXISTS `d_resultfu` (
  `rf_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rf_csummary` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rf_cid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rf_cstaff` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rf_date` date DEFAULT NULL,
  `rf_reason` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`rf_id`),
  KEY `d_resultfu_rf_csummary_index` (`rf_csummary`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.d_resultfu: ~0 rows (approximately)
/*!40000 ALTER TABLE `d_resultfu` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_resultfu` ENABLE KEYS */;

-- Dumping structure for table auto2000.d_user
DROP TABLE IF EXISTS `d_user`;
CREATE TABLE IF NOT EXISTS `d_user` (
  `u_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `u_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_cmenu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_user` enum('A','S','U') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Admin',
  `u_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_lastlogin` datetime DEFAULT NULL,
  `u_lastlogout` datetime DEFAULT NULL,
  `u_create_at` datetime NOT NULL,
  `u_update_at` datetime NOT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.d_user: ~13 rows (approximately)
/*!40000 ALTER TABLE `d_user` DISABLE KEYS */;
REPLACE INTO `d_user` (`u_id`, `u_name`, `u_username`, `u_email`, `password`, `u_cmenu`, `u_group`, `u_user`, `u_code`, `u_lastlogin`, `u_lastlogout`, `u_create_at`, `u_update_at`, `status_data`) VALUES
	(1, 'Administrator', 'admin', '1admin@gmail.com', '$2y$10$cYcvIfc.LmG6j/2MO5/DUO0WZTp5uXoxqZxWdcNBOcpFfEzDQdK6S', 'admin', 'admin', 'A', 'CRUD1WIB', '2019-09-11 08:32:44', '2019-09-11 08:33:17', '2019-09-06 09:48:33', '2019-09-06 09:48:33', 'true'),
	(2, 'Nanang Hidayat', 'nanang', 'nananghidayat@gmail.com', '$2y$10$akOj9K1Di2IbGZ9TlOZR8.KegkknBS/eLSNGyK.W/gNitncS2GeBO', NULL, NULL, 'S', 'S1', NULL, NULL, '2019-09-06 09:50:55', '2019-09-06 09:50:55', 'true'),
	(3, 'Zainul Arifin', 'zainul', 'zainul@gmail.com', '$2y$10$qjDtJ.sAmhRVIGpr0TME1e.hHMSu5RuZrfMIFqWw4uRJmYDKK/9ty', NULL, NULL, 'S', 'S2', NULL, NULL, '2019-09-06 09:51:45', '2019-09-06 09:51:45', 'true'),
	(4, 'Achmad Nur Taufik', 'achmad', 'achmad@gmail.com', '$2y$10$OZvT/R6yY8CsFdW.y1sd2OMhp6sknBwGzXHmUS1WJgu.lG1zsLtuu', NULL, NULL, 'S', 'S3', NULL, NULL, '2019-09-06 09:52:33', '2019-09-06 09:52:33', 'true'),
	(5, 'Sandi Pawaka Rosadi', 'sandi', 'sandi@gmail.com', '$2y$10$xjX.b22zc6Haqxcc0oaMv.aMf6XSWrIWrETkTosW7VTvROsAFiGBu', NULL, NULL, 'S', 'S4', NULL, NULL, '2019-09-06 09:53:27', '2019-09-06 09:53:27', 'true'),
	(6, 'Made Agung Adhi Gunawan', 'made', 'made@gmail.com', '$2y$10$e4pUdsJh3DsFWq4kKwQmLex9vk3uhY.OMheMB9P8o2sq0j4aQyZu2', NULL, NULL, 'S', 'S5', NULL, NULL, '2019-09-06 09:53:56', '2019-09-06 09:53:56', 'true'),
	(7, 'Puji Santoso', 'Puji', 'puji@gmail.com', '$2y$10$Zn5yv3Ba512KRm/b1IzrGOYYS05IOoLy1KBlYKnN0vfiTqcnC0LLy', NULL, NULL, 'S', 'S6', NULL, NULL, '2019-09-06 09:54:29', '2019-09-06 09:54:29', 'true'),
	(8, 'Choirul Anam', 'choirul', 'choirul@gmail.com', '$2y$10$J3zLeIxXVp9zPEk8dH3Cmu4SWnANZ42hKT/LDOec3Yx0tc1R1YhSG', NULL, NULL, 'S', 'S7', '2019-09-06 17:22:40', '2019-09-06 17:24:27', '2019-09-06 09:56:12', '2019-09-06 09:56:12', 'true'),
	(9, 'Feri Wiyono Setyawan', 'feri', 'feri@gmail.com', '$2y$10$T7Qf4sVtx1IqzYUvamgp2eJiTQ4nttVMPMAEEpVmLg9G6tCL/as0K', NULL, NULL, 'S', 'S8', '2019-09-11 08:34:10', '2019-09-11 08:46:33', '2019-09-06 09:57:02', '2019-09-06 09:57:02', 'true'),
	(10, 'Hendri Susilo', 'hendri', 'Hendri@gmail.com', '$2y$10$GHKcdHKeIRihPaK2ZJPa6OPjfY/417gDoSt8i.rY9sJERtOVoCROm', NULL, NULL, 'S', 'S9', NULL, NULL, '2019-09-06 09:57:51', '2019-09-06 09:57:51', 'true'),
	(11, 'Moch Heru Dwi Prasetyo', 'heru', 'heru@gmail.com', '$2y$10$.mubkgPw31UkhwYzzly30OHXVo04XW.fdmBeKu8YjP3drV0CcjLDW', NULL, NULL, 'S', 'S10', '2019-09-11 08:46:39', '2019-09-11 08:47:36', '2019-09-06 09:58:45', '2019-09-06 09:58:45', 'true'),
	(12, 'Moh Alwi Imron', 'imron', 'imron@gmail.com', '$2y$10$nS/w8cntslSss1/fFfCNxe/2d0rTcqnDkwDCnXWIMEYG0oUhQa7he', NULL, NULL, 'S', 'S11', '2019-09-11 08:47:43', NULL, '2019-09-06 09:59:38', '2019-09-06 09:59:38', 'true'),
	(13, 'Nurwahyudi', 'wahyudi', 'Nurwahyudi@gmail.com', '$2y$10$beECgIxL9oT1egyke4AuruMtcgSmjUTjexDLc7k79r.mdVn5Kpobi', NULL, NULL, 'S', 'S12', NULL, NULL, '2019-09-06 10:00:42', '2019-09-06 10:00:42', 'true');
/*!40000 ALTER TABLE `d_user` ENABLE KEYS */;

-- Dumping structure for table auto2000.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.migrations: ~11 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_06_16_051300_d_customer', 1),
	(2, '2019_06_17_015726_m_sales', 1),
	(3, '2019_06_17_020000_m_vehicle', 1),
	(4, '2019_06_17_020411_m_reason', 1),
	(5, '2019_06_17_030643_d_recap', 1),
	(6, '2019_06_17_074050_d_customerremovable', 1),
	(7, '2019_06_23_042401_d_user', 1),
	(8, '2019_06_25_132020_d_followup', 1),
	(9, '2019_06_25_160922_d_resultfu', 1),
	(10, '2019_06_25_161311_m_summary', 1),
	(11, '2019_06_25_165338_d_log', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table auto2000.m_reason
DROP TABLE IF EXISTS `m_reason`;
CREATE TABLE IF NOT EXISTS `m_reason` (
  `r_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `r_reason` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_group` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.m_reason: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_reason` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_reason` ENABLE KEYS */;

-- Dumping structure for table auto2000.m_sales
DROP TABLE IF EXISTS `m_sales`;
CREATE TABLE IF NOT EXISTS `m_sales` (
  `s_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `s_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_nphone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `m_sales_s_email_unique` (`s_email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.m_sales: ~12 rows (approximately)
/*!40000 ALTER TABLE `m_sales` DISABLE KEYS */;
REPLACE INTO `m_sales` (`s_id`, `s_name`, `s_email`, `s_nphone`, `s_address`, `s_username`, `password`, `s_code`, `status_data`) VALUES
	(1, 'Nanang Hidayat', 'nananghidayat@gmail.com', '000000000', 'ganti saat login', 'nanang', '$2y$10$tfSTVSiA/Y0PBgkrb1h8V.hXuJ9FPUFwjWGBcyHYpvsV1m4MEg8ii', 'S1', 'true'),
	(2, 'Zainul Arifin', 'zainul@gmail.com', '000000', 'ganti saat login', 'zainul', '$2y$10$zFhxqjVS7Xd50ngjbdDdduYspyZDpCKTK.kEu76Rd/LG8rfOsf.c2', 'S2', 'true'),
	(3, 'Achmad Nur Taufik', 'achmad@gmail.com', '0000000', 'ganti saat login', 'achmad', '$2y$10$V3vqIerN409W./acebQLoO92uMXhXx8qHAj8b.5ik.6kixxbc8tgy', 'S3', 'true'),
	(4, 'Sandi Pawaka Rosadi', 'sandi@gmail.com', '00000000', 'ganti saat login', 'sandi', '$2y$10$ZVdZHyJ2LvPeOb5mnAuWC.s.r5Rj272E.v7hPyYAR9goPQVgQmc4m', 'S4', 'true'),
	(5, 'Made Agung Adhi Gunawan', 'made@gmail.com', '0000000', 'ganti saat login', 'made', '$2y$10$zHM5OKOONjmE88Xs9DNxDePNKUtAz.0kD/PSpvdl2Pn.zx9seJ0bu', 'S5', 'true'),
	(6, 'Puji Santoso', 'puji@gmail.com', '0000000', 'ganti saat login', 'Puji', '$2y$10$XFQTUaDOVCMtGsFBNShxgOQ.Em4wgtAIxvkSAetudz5IZGaS8XXk2', 'S6', 'true'),
	(7, 'Choirul Anam', 'choirul@gmail.com', '00000000', 'ganti saat login', 'choirul', '$2y$10$FSLTbdeUcZVDTTCHYvbKE.Ci3y/b5fsYmZd4XaT8i75wG27wvRDuu', 'S7', 'true'),
	(8, 'Feri Wiyono Setyawan', 'feri@gmail.com', '0000000', 'ganti saat login', 'feri', '$2y$10$oQqRIFnCQXIBO.aGrEKBT.NreMRrU6rcOBMLhiKKfqIh3IejOcJFy', 'S8', 'true'),
	(9, 'Hendri Susilo', 'Hendri@gmail.com', '000000', 'ganti saat login', 'hendri', '$2y$10$f5Jllz3W1.3x.5ZGQfKmt.aje.qASMZqaNUT0F8UvyXp/2zkxmbmm', 'S9', 'true'),
	(10, 'Moch Heru Dwi Prasetyo', 'heru@gmail.com', '0000000', 'ganti saat login', 'heru', '$2y$10$G0XjXo1DVNP980BVhr5IdOq6GQz3oH4ZZ1Z46/TUz2t2XgqRiPGQu', 'S10', 'true'),
	(11, 'Moh Alwi Imron', 'imron@gmail.com', '0000000', 'ganti saat login', 'imron', '$2y$10$2LnWyI4Bp8Esxf4nFJ0JnuXGgM/CJncw8W2ornF5bVE5NHTCFEA52', 'S11', 'true'),
	(12, 'Nurwahyudi', 'Nurwahyudi@gmail.com', '000000', 'ganti saat login', 'wahyudi', '$2y$10$HdbJpStEgt10vq3372.bBuQeEay5rFcPhrq5Qe46EIeyTZCL3SQse', 'S12', 'true');
/*!40000 ALTER TABLE `m_sales` ENABLE KEYS */;

-- Dumping structure for table auto2000.m_summary
DROP TABLE IF EXISTS `m_summary`;
CREATE TABLE IF NOT EXISTS `m_summary` (
  `s_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `s_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `m_summary_s_name_index` (`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.m_summary: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_summary` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_summary` ENABLE KEYS */;

-- Dumping structure for table auto2000.m_vehicle
DROP TABLE IF EXISTS `m_vehicle`;
CREATE TABLE IF NOT EXISTS `m_vehicle` (
  `v_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `v_owner` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `v_nphone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `v_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `v_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `v_plate` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `v_namecar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `v_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_data` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table auto2000.m_vehicle: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_vehicle` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_vehicle` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
