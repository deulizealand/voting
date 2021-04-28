# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.5.9-MariaDB)
# Database: voting
# Generation Time: 2021-04-28 09:19:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `vote_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `name`, `email`, `status`, `vote_status`, `created_at`, `updated_at`)
VALUES
	(2,'BPD ACEH','dapenbpdaceh@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(3,'BANK RIAU KEPRI','dapenbankriau@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(4,'BPD SUMATERA BARAT','dapenbpdsb@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(5,'BPD SUMATERA UTARA','dapenbanksumut@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(6,'H K B P','dapen_hkbp@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(7,'PERSERO BATAM, PT','dapenperserobatam@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(8,'SEMEN PADANG','dpsemenpadang@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(9,'TIRTA NUSANTARA','Dptnpdam.2012@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(10,'UNIVERSITAS MUHAMMADIYAH SUMUT','janurisuyono@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(11,'BPD BENGKULU','Dapen_bpd_bengkulu@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(12,'BPD JAMBI','dpbpdj@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(13,'BPD LAMPUNG','danapensiunbpdlampung@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(14,'BANK SUMSEL BABEL','dapen.bss@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(15,'BUKIT ASAM','luspa778@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(16,'PPIP PUSRI','ppip.pusri1106@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(17,'PUSRI','dapensri@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(18,'SEMEN BATURAJA, KARYAWAN','Irfan_dpksb@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(19,'ANGKASA PURA I','dapenra@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(20,'ASTRA DUA','cs@dapenastra.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(21,'ASTRA SATU',NULL,0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(22,'BPK PENABUR','dppenabur@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(23,'BANK TABUNGAN NEGARA','info@danapensiun-btn.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(24,'BANK DKI','dpbankdki@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(25,'BANK NEGARA INDONESIA','direksi@dapenbni.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(26,'BANK RAKYAT INDONESIA','dpbri@dapenbri.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(27,'BANK WINDU','agustinus.karno@idn.ccb.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(28,'BAPTIS INDONESIA','dpbi_jakarta@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(29,'BIRO KLASIFIKASI INDONESIA','one_dapenbki@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(30,'CHEVRON PACIFIC INDONESIA','LSiana@chevron.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(31,'DANAREKSA','danapensiun@danareksa.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(32,'DAPENMA PAMSI','dapenmapamsi@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(33,'GARUDA INDONESIA','jkthyga@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(34,'G P I B','Dapen_gpib.3110@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(35,'IP BOGASARI','dpip@bogasariflour.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(36,'JAKARTA INTERNATIONAL HOTELS & DEVELOPMENT','Dapen.jihd@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(37,'JIWASRAYA','dppk_jws@jiwasraya.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(38,'KALBE FARMA','dpkalbe@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(39,'COCA-COLA INDONESIA, KARYAWAN ','dpensiuncci@coca-cola.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(40,'KOMPAS GRAMEDIA','elly@keu.kompasgramedia.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(41,'KONPERENSI WALI GEREJA INDONESIA','Danapensiunkwi.gsa@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(42,'LEMBAGA ALKITAB INDONESIA','danapensiunlai@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(43,'BANK MANDIRI DUA','dpbmd@indosat.net.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(44,'BANK MANDIRI EMPAT','dpbme@dapenmandiri4.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(45,'MP BOGASARI','dpmp@bogasariflour.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(46,'MECOSIN INDONESIA','mecosin_finance@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(47,'OTORITAS JASA KEUANGAN','Dapen.ojk2014@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(48,'GELORA SENAYAN, PEGAWAI','dapenppkgbk@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(49,'PEMBANGUNAN JAYA GROUP, PEGAWAI','dpjaya@cbn.net.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(50,'RUMAH SAKIT BUDI KEMULIAAN, PEGAWAI','dapen_budikemuliaan@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(51,'PERTAMINA','sekretariat@dp-pertamina.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(52,'PFIZER INDONESIA','Mirna.Anggraeni@pfizer.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(53,'PROCTER & GAMBLE HOME PRODUCTS INDONESIA','noor.sa@pg.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(54,'PELNI, PT','dapen_pelni@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(55,'PUPUK KALTIM GROUP','herli59@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(56,'SYARIAH RUMAH SAKIT ISLAM JAKARTA','infodapersi@ymail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(57,'SAMUDERA INDONESIA','agus.rianto@samudera.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(58,'SINT CAROLUS','dpstcarolus@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(59,'SMART','dp.smart@sinarmas-agri.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(60,'TOYOTA ASTRA MOTOR','danapensiun@toyota.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(61,'UNIVERSITAS TRISAKTI','danapensiun@trisakti.ac.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(62,'WIDATRA BHAKTI','laksono@widatra.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(63,'AEROWISATA','admin@dapen.aerowisata.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(64,'ASDP','Tusti.muwarni@indonesiaferry.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(65,'ANEKA TAMBANG','dp_antam@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(66,'APAC INTI CORPORA','wayan.widia@apacinti.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(67,'ASKRIDA','dp.askrida@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(68,'ASURANSI JASA INDONESIA, PT','dapenjasindo@hotmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(69,'BAKRIE','danapensiunbakrie@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(70,'BANK BUKOPIN','dapenbukopin@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(71,'BANK CIMB NIAGA','dpbankniaga@cbn.net.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(72,'BANK CENTRAL ASIA','dana.pensiun.bca@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(73,'BANK INDONESIA','sdm@dapenbi.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(74,'BANK MANDIRI','dapenbm@dapenbankmandiri.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(75,'BASF INDONESIA','gandhibasf@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(76,'BANK MANDIRI SATU','dapen@dapenmandiri1.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(77,'BANK MANDIRI TIGA','dpbmtiga@dapenbankmandiritiga.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(78,'BRANTAS ABIPRAYA, PT','dapenbrantas@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(79,'CARDIG GROUP','dpcardiggroup@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(80,'DNP INDONESIA','tommy@dnpi.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(81,'ESSENCE INDONESIA','Didirohendi59@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(82,'FREEPORT INDONESIA COMPANY','rrantybt@fmi.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(83,'GEREJA KRISTEN INDONESIA','dpgki@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(84,'HARAPAN SEJAHTERA','nug_ahmad@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(85,'HOTEL INDONESIA INTERNASIONAL','danapensiunhii@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(86,'HUTAMA KARYA','dphutamakarya@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(87,'INDOMOBIL GROUP','dana.pensiun@indomobil.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(88,'INFOMEDIA NUSANTARA','mardi.susanto@infomedia.web.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(89,'INHUTANI','Ridoilahi68@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(90,'INTER PACIFIC','r.laurens@ag.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(91,'PROGRAM IURAN PASTI KRAMA YUDHA RATU MOTOR','dpip@krm.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(92,'JASA MARGA','dapenjasamarga@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(93,'JASA RAHARJA','dpjasaraharja@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(94,'BPJS KETENAGAKERJAAN, KARYAWAN','dpk-bpjstk@cbn.net.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(95,'INDOCEMENT TUNGGAL PRAKARSA, KARYAWAN','evilia@indocement.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(96,'PANIN BANK, KARYAWAN','miranda.liauw@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(97,'TASPEN, KARYAWAN','dpktaspen@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(98,'KIMIA FARMA','dpkimiafarma@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(99,'KRAMA YUDHA RATU MOTOR','dapen@krm.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(100,'KRAMA YUDHA TIGA BERLIAN MOTORS','ulyabayani.dapen@ktb.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(101,'L I A','liadapen@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(102,'LKBN ANTARA','dapenantara@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(103,'LUX INDONESIA','dapen@lux.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(104,'MITSUBISHI KRAMA YUDHA MOTORS & MANUFACTURING','dpmkm@ptmkm.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(105,'MITSUBISHI MOTORS KRAMA YUDHA SALES INDONESIA','dapen.mmksi@mitsubishi-motors.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(106,'NATOUR','dapenatour@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(107,'NINDYA KARYA','dapen@nindyakarya.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(108,'OTSUKA INDONESIA, PT','firmansy@ho.otsuka.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(109,'PEGADAIAN','dpegadaian@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(110,'PERKEBUNAN','dapen@dapenbun.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(111,'PERUM PERURI, PEGAWAI','peruridapen@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(112,'PERHUTANI','dppht@dapenperhutani.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(113,'PERTANI','dapen_pertani@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(114,'PERUSAHAAN PELABUHAN DAN PENGERUKAN','umum@dapenpelindo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(115,'PERUMNAS','dp.perumnas@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(116,'P G I','dapenpgi@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(117,'P L N','sesdapenpln@dppln.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(118,'PEMBANGUNAN PERUMAHAN, PT','dapen_dppp@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(119,'SEPATU BATA, PT','dapens@bataindonesia.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(120,'RAJAWALI NUSANTARA INDONESIA','dapen_rni@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(121,'SOLUSI BANGUN INDONESIA ','Gunardi.sbi@sig.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(122,'SWADHARMA INDOTAMA FINANCE','dpsif@ptsif.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(123,'TIGARAKSA SATRIA','Dapen-trs@tigaraksa.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(124,'TRAKINDO UTAMA','wagung@tiaramarga.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(125,'TRIPUTRA','dpt@triputra-group.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(126,'UNGGUL INDAH CAHAYA','dapen@uic.co.id ',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(127,'UNIVERSITAS MUHAMMADIYAH PROF. DR. HAMKA, PEGAWAI','dapenuhamka@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(128,'WIJAYA KARYA','dapen.wika@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(129,'WIJAYA KARYA PPIP','dapen.ppip@wika.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(130,'ANGKASA PURA II','sekretariat@dapenda.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(131,'BANK BJB','information@dapenbankbjb.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(132,'DELTA DJAKARTA','goenawan@deltajkt.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(133,'EVEREADY INDONESIA','yeni.yuanita@energizer.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(134,'GOODYEAR INDONESIA','widiayuliani_suhadi@goodyear.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(135,'INTI','dpinti@inti.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(136,'JASA TIRTA II','dpjasatirta2@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(137,'PUPUK KUJANG, KARYAWAN','dapen_kujang@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(138,'KRAKATAU STEEL','dpks2004@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(139,'LEN INDUSTRI','dapenlen@len.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(140,'MANDOM INDONESIA','dana.pensiun@mandom.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(141,'MITRA KRAKATAU','admin@dapenmitrakrakatau.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(142,'INDAH KARYA, PEGAWAI','danapensiunindahkarya@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(143,'POS INDONESIA','dapenpos_indonesia@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(144,'PINDAD, KARYAWAN PT','dapen@pindad.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(145,'RSUD AL IHSAN','dapen.alihsan@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(146,'SOUTH PACIFIC VISCOSE','dana.pensiun@pt-spv.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(147,'TELKOM','dapentelkom@dapentel.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(148,'UNIVERSITAS ISLAM BANDUNG','dapenunisba@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(149,'IP UNILEVER INDONESIA','dapen-ip.uli@unilever.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(150,'MP UNILEVER INDONESIA','dapen-mp.uli@unilever.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(151,'BPD DIY','dapenbpddiy@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(152,'BPD JAWA TENGAH','dapen_bank_jateng@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(153,'DUTA WACANA','dapendutawacana@staff.ukdw.ac.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(154,'GEREJA-GEREJA KRISTEN JAWA','sdpgkj@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(155,'KONIMEX','dapen@konimex.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(156,'LEMBAGA KATOLIK YADAPEN','yadapen@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(157,'MUHAMMADIYAH','dapenmuh@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(158,'YBW UII','dppuii@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(159,'PEMBINA POTENSI PEMBANGUNAN','dapenp3@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(160,'SARI HUSADA','dana.sh@danone.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(161,'SATYA WACANA','dpsw_salatiga@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(162,'SEKOLAH KRISTEN','dpsk_sltg@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(163,'SIDO MUNCUL','dapen_sidomuncul@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(164,'UNIVERSITAS MUHAMMADIYAH SURAKARTA','dapenums@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(165,'YAKKUM','dpyakkum@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(166,'BPD BALI','danapensiunbpdbali@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(167,'BANK NTB, PT ','danapensiun_ntb@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(168,'BPD NTT','dapen_bankntt@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(169,'DOK DAN PERKAPALAN SURABAYA','dapendps@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(170,'GARAM','dp.garam@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(171,'GREJA KRISTEN JAWI WETAN','dapen_gkjw@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(172,'GRAND HYATT BALI, KARYAWAN','ib.arnaya@hyatt.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(173,'BPD JAWA TIMUR, PEGAWAI','danapensiunbankjatim@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(174,'BANK BPR JATIM, PEGAWAI','dppbprjatim@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(175,'UNIVERSITAS MUHAMMADIYAH MALANG, PEGAWAI','dpp_umm@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(176,'PELINDO PURNAKARYA ','dppelindopurnakarya@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(177,'PENDIDIKAN CENDEKIA UTAMA','dapen_pcu@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(178,'PPPK PETRA','sekretariat@danapensiunpppkpetra.or.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(179,'PAL INDONESIA, KARYAWAN PT','dapen.palsby@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(180,'SEMEN GRESIK','dpsg@indo.net.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(181,'KEBON AGUNG, KARYAWAN STAF PT','danapensiunptkebonagung@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(182,'UNIVERSITAS MERDEKA MALANG','dpunmer.malang@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(183,'UNIVERSITAS SURABAYA','dapen_ubaya@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(184,'BANK KALBAR, PT','dapen_bk@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(185,'BPD KALSEL','dapenbpdks@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(186,'BPD KALTENG','dpbpkalteng@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(187,'KALTIM PRIMA COAL','candra.syarief@kpc.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(188,'PUPUK KALTIM','danapensiun@pupukkaltim.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(189,'BANK MALUKU','dapen_maluku@msn.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(190,'BANK PAPUA','dp.bank.papua@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(191,'BPD SULAWESI TENGAH','dapenbpdst@yahoo.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(192,'BPD SULAWESI TENGGARA','danapensiunbanksultra@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(193,'BPD SULSELBAR','dapen.bpdss@yahoo.co.id',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(194,'BPD SULAWESI UTARA GORONTALO','dapenbpdsulut@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(195,'SEMEN TONASA','samsulandi@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(196,'UKHUWAH UMI','dppkukhuwahumi@gmail.com',0,0,'2021-04-28 15:28:22','2021-04-28 15:28:22'),
	(197,'DP PAMSI','eko@dapenmapamsi.id',0,0,'2021-04-28 15:29:22','2021-04-28 15:29:22');

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(4,'2021_04_28_090559_create_votings_table',2),
	(7,'2021_04_28_090710_create_participants_table',2),
	(8,'2021_04_28_100039_add_fieldusername_to_users',3),
	(9,'2021_04_28_124424_add_fieldimage_to_participants',4),
	(10,'2021_04_28_132523_add_fielddapen_to_participants',5),
	(11,'2021_04_28_134500_add_fieldrole_to_users',6),
	(12,'2021_04_28_140016_create_schedule_votings_table',7),
	(13,'2021_04_28_140405_add_field_schedulevoting_to_members',8),
	(15,'2021_04_28_090632_create_members_table',9),
	(16,'2021_04_28_090559_create_positions_table',10),
	(17,'2021_04_28_090653_create_positions_table',11),
	(18,'2021_04_28_150503_add_field_memberid_to_users',11),
	(19,'2021_04_28_153809_add_field_status_to_members',12),
	(20,'2021_04_28_155127_add_field_votestatus_to_members',13);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table participants
# ------------------------------------------------------------

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_id` int(11) NOT NULL,
  `asal_dapen` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vote_count` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;

INSERT INTO `participants` (`id`, `name`, `position_id`, `asal_dapen`, `img_name`, `vote_count`, `status`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,'Abdul Jaelani',1,'Dana Pensiun BI','16195909886927.jpeg',0,0,4,'2021-04-28 13:23:08','2021-04-28 13:31:09'),
	(2,'Agus Mubarok',1,'Dana Pensiun PLN','16195916027503.jpeg',0,0,4,'2021-04-28 13:33:22','2021-04-28 13:33:22');

/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table positions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;

INSERT INTO `positions` (`id`, `name`, `status`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,'Ketua Umum',0,4,'2021-04-28 12:39:22','2021-04-28 14:33:03'),
	(2,'Ketua Pengawas',0,4,'2021-04-28 12:39:36','2021-04-28 14:32:54');

/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table schedule_votings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `schedule_votings`;

CREATE TABLE `schedule_votings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `voting_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voting_date` date NOT NULL,
  `voting_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `schedule_votings` WRITE;
/*!40000 ALTER TABLE `schedule_votings` DISABLE KEYS */;

INSERT INTO `schedule_votings` (`id`, `voting_name`, `voting_date`, `voting_time`, `user_id`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'MUNAS Luar Biasa Tahun 2021','2021-04-28','14:50:00',6,1,'2021-04-28 14:19:25','2021-04-28 14:55:52');

/*!40000 ALTER TABLE `schedule_votings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0 COMMENT '1 : Administrator, 2 : User, 3 : Pemilih',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role_id`, `email_verified_at`, `password`, `member_id`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(3,'Administrator','admin','admin@voting.com',1,'2021-04-28 10:04:02','$2y$10$SN2jYkO8kkV2JZiKCdBLOOE1JDPVj9bLVULp.y6UiCv56pZr/gNk6',0,NULL,'2021-04-28 10:04:02','2021-04-28 14:52:32'),
	(4,'Administrator','admin1','admin@votingku.com',1,'2021-04-28 10:04:02','$2y$10$9nnR59vqsRJPuTFcdmZTV.yyjxtp3jQ/vPLSBV1VpUfHyqzECOz4u',0,NULL,'2021-04-28 11:29:18','2021-04-28 11:29:18'),
	(5,'contoh','contoh','contoh@gmail.com',0,NULL,'$2y$10$JTuC3R/lBFrRc5sOJSMe4eryJ0ZogfhBNteSm6ke6X0mOFMT.aoWS',0,NULL,'2021-04-28 14:49:25','2021-04-28 14:49:25'),
	(6,'admini','admini','admini@test.com',0,NULL,'$2y$10$JFYt2mVcvsLfuKRZnIY/m.I2WWob/VwBTeqmsBYFDVJLhq9V70rE.',0,NULL,'2021-04-28 14:53:10','2021-04-28 14:53:10');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table votings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `votings`;

CREATE TABLE `votings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `participant_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `ip_address` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `votings_participant_id_unique` (`participant_id`),
  UNIQUE KEY `votings_member_id_unique` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
