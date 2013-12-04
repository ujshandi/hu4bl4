-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: hubla
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.10

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
-- Table structure for table `login_log`
--

DROP TABLE IF EXISTS `login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_log` (
  `login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `user_info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`login_time`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_log`
--

LOCK TABLES `login_log` WRITE;
/*!40000 ALTER TABLE `login_log` DISABLE KEYS */;
INSERT INTO `login_log` VALUES ('2013-11-28 13:20:51','192.168.0.1','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-11-28 16:05:46','192.168.0.1','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-11-30 14:59:17','192.168.0.1','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-12-02 02:21:37','192.168.0.1','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-12-02 02:23:02','192.168.0.1','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-12-03 16:46:14','192.168.0.1','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-12-03 16:47:10','192.168.0.35','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-12-03 19:52:17','192.168.0.1','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-12-04 09:23:56','192.168.0.1','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-12-04 11:07:20','192.168.0.35','id=8;name=superadmin;e1=022.04;e2=-1'),('2013-12-04 14:11:46','192.168.0.35','id=8;name=superadmin;e1=022.04;e2=-1');
/*!40000 ALTER TABLE `login_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portal_category`
--

DROP TABLE IF EXISTS `portal_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portal_category` (
  `category_id` smallint(6) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portal_category`
--

LOCK TABLES `portal_category` WRITE;
/*!40000 ALTER TABLE `portal_category` DISABLE KEYS */;
INSERT INTO `portal_category` VALUES (1,'Home'),(2,'Informasi_Berita_Kinerja'),(3,'Informasi_About'),(4,'Informasi_Akip'),(5,'Informasi_Regulasi'),(6,'Informasi_Faq'),(7,'Informasi_Kontak'),(8,'Link');
/*!40000 ALTER TABLE `portal_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portal_content`
--

DROP TABLE IF EXISTS `portal_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portal_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` smallint(6) NOT NULL,
  `content_title` varchar(100) DEFAULT NULL,
  `content` text,
  `summary` text,
  `url` varchar(50) DEFAULT NULL,
  `date_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`),
  KEY `fk_content_category` (`category_id`),
  CONSTRAINT `fk_content_category` FOREIGN KEY (`category_id`) REFERENCES `portal_category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portal_content`
--

LOCK TABLES `portal_content` WRITE;
/*!40000 ALTER TABLE `portal_content` DISABLE KEYS */;
INSERT INTO `portal_content` VALUES (2,3,'e-Performance','<p>e-Performance atau Sistem Aplikasi Pengukuran Kinerja adalah aplikasi yang berfungsi untuk membantu proses pengumpulan dan pengukuran data kinerja di lingkungan Kementerian Perhubungan. e-Performance dapat diakses melalui jaringan intranet/internet di alamat website Kementerian Perhubungan, yaitu http://www.dephub.go.id.</p>\n\n<p><br />\nFungsi-fungsi utama (features) yang dipunyai e-Performance adalah:</p>\n\n<ul>\n <li>Pengelolaan Data Rujukan</li>\n <li>Pengelolaan Data Induk</li>\n <li>Pengolahan Data Transaksi, meliputi RKT, PK dan capaian kinerja</li>\n <li>Pengukuran Kinerja</li>\n <li>Pelaporan</li>\n</ul>\n\n<p>Beberapa manfaat yang didapat dari penggunaan e-Performance:</p>\n\n<ul>\n <li>Terbentuknya keseragaman format data kinerja sesuai peraturan yang diacu, yaitu PermenPANRB Nomor 29 Tahun 2010.</li>\n <li>Meningkatnya akurasi hasil proses pengumpulan dan pengukuran data kinerja, karena data diinput dan diukur per periode tertentu (bulanan).</li>\n <li>Informasi dan laporan yang dihasilkan dapat digunakan untuk menyusun LAKIP sehing proses pembuatannya menjadi lebih mudah.</li>\n <li>Integrasi dengan sistem lain, seperti sistem e-Monitoring &amp; e-Reporting.</li>\n</ul>\n','<p>Pelaksanaan kegiatan pengembangan Sistem dan Aplikasi Pengukuran Data Kinerja Kementerian Perhubungan Berbasis Web dimaksudkan untuk membangun sistem pengumpulan dan pengukuran data kinerja di lingkungan Kementerian Perhubungan.</p>\n','','2013-06-27 01:27:07',1),(21,8,'Kementerian Perhubungan','0','','dephub.go.id','2013-06-27 01:21:21',1),(22,8,'Kementerian PAN dan Reformasi Birorasi','','','menpan.go.id','2013-06-27 01:22:22',1),(23,4,'SISTEM AKUNTABILITAS KINERJA INSTANSI PEMERINTAH','<p>Akuntabilitas Kinerja Instansi Pemerintah (AKIP) adalah perwujudan kewajiban suatu instansi pemerintah untuk mempertanggungjawabkan keberhasilan dan kegagalan pelaksanaan misi organisasi dalam mencapai sasaran dan tujuan yang telah ditetapkan melalui sistem pertanggungjawaban secara periodik. Sistem Akuntabilitas Kinerja Instansi Pemerintah (Sistem AKIP) adalah instrumen yang digunakan instansi pemerintah dalam memenuhi kewajiban untuk mempertanggungjawabkan keberhasilan dan kegagalan pelaksanaan misi organisasi. Sistem AKIP terdiri dari berbagai komponen yang merupakan satu kesatuan, yaitu perencanaan strategis, perencanaan kinerja, pengukuran kinerja, dan pelaporan kinerja. Gambar 2.3 berikut memperlihatkan hubungan keterkaitan antar komponen yang ada dalam Sistem AKIP.</p>\n\n<p>&nbsp;</p>\n\n<p><img alt=\"\" src=\"/upload/images/akip.png\"  width:784px\" /></p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>Gambar 2.3. Sistem AKIP</p>\n\n<p>&nbsp;</p>\n\n<p>Tujuan Sistem AKIP adalah untuk mendorong terciptanya akuntabilitas kinerja instansi pemerintah sebagai salah satu prasyarat untuk terciptanya pemerintah yang baik dan terpercaya. Sedangkan sasaran dari Sistem AKIP adalah:</p>\n\n<ol>\n <li>Menjadikan instansi pemerintah yang akuntabel sehingga dapat beroperasi secara efisien, efektif dan responsif terhadap aspirasi masyarakat dan lingkungannya.</li>\n <li>Terwujudnya transparansi instansi pemerintah.</li>\n <li>Terwujudnya partisipasi masyarakat dalam pelaksanaan pembangunan nasional.</li>\n <li>Terpeliharanya kepercayaan masyarakat kepada pemerintah.</li>\n</ol>\n\n<p>&nbsp;</p>\n\n<p>Pelaksanaan penyusunan Sistem AKIP dilakukan melalui tahap-tahap sebagai berikut:</p>\n\n<ol>\n <li>Mempersiapkan dan menyusun perencanaan strategik.</li>\n <li>Merumuskan visi, misi, faktor-faktor kunci keberhasilan, tujuan, sasaran dan strategi instansi pemerintah.</li>\n <li>Merumuskan indikator kinerja instansi pemerintah dengan berpedoman pada kegiatan yang dominan, menjadi isu nasional dan vital bagi pencapaian visi dan misi instansi pemerintah.</li>\n <li>Memantau dan mengamati pelaksanaan tugas pokok dan fungsi dengan seksama.</li>\n <li>Mengukur pencapaian kinerja dengan:</li>\n</ol>\n\n<ol>\n <li>Perbandingan kinerja aktual dengan rencana atau target.</li>\n <li>Perbandingan kinerja aktual dengan tahun-tahun sebelumnya.</li>\n <li>Perbandingan kinerja aktual dengan kinerja di negara-negara lain, atau dengan standar internasional.</li>\n</ol>\n\n<p>Melakukan evaluasi kinerja dengan:</p>\n\n<ol>\n <li>Menganalisis hasil pengukuran kinerja .</li>\n <li>Menginterprestasikan data yang diperoleh.</li>\n <li>Membuat pembobotan (rating) keberhasilan pencapaian program.</li>\n <li>Membandingkan pencapaian program dengan visi dan misi instansi pemerintah.</li>\n</ol>\n\n<p>Alat untuk melaksanakan akuntabilitas kinerja instansi pemerintah adalah Laporan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP).</p>\n','<p>Akuntabilitas Kinerja Instansi Pemerintah (AKIP) adalah perwujudan kewajiban suatu instansi pemerintah untuk mempertanggungjawabkan keberhasilan dan kegagalan pelaksanaan misi organisasi dalam mencapai sasaran dan tujuan yang telah ditetapkan melalui sistem pertanggungjawaban secara periodik</p>\n','','2013-07-05 02:49:34',1),(24,5,'Instruksi Presiden Nomor 7 Tahun 1999','<p>Instruksi Presiden Nomor 7 Tahun 1999 tentang Akuntabilitas Kinerja Instansi Pemerintah (AKIP).</p>\r\n','<ol>\r\n <li>Instruksi Presiden Nomor 7 Tahun 1999 tentang Akuntabilitas Kinerja Instansi Pemerintah (AKIP).</li>\r\n <li>Surat Keputusan Kepala Lembaga Administrasi Negara Nomor 239/IX/6/8/2003 tentang Perbaikan Pedoman Penyusunan Pelaporan Akuntabilitas Kinerja Instansi Pemerintah.</li>\r\n</ol>\r\n','','2013-07-09 22:13:02',1),(25,7,'Biro Perencanaan','<p>Biro Perencanaan</p>\r\n\r\n<p>Sekretariat Jenderal Kementerian Perhubungan</p>\r\n\r\n<p>Jalan Medan Merdeka Barat No. 8</p>\r\n\r\n<p>Gedung Cipta Lantai 3</p>\r\n','0','0','2013-07-09 22:15:21',1),(26,6,'Definisi Kinerja','<p>Apa yang dimaksud dengan kinerja</p>\r\n','<p>Kinerja (<em>performance</em>) dalam organisasi merupakan jawaban dari berhasil atau tidaknya tujuan organisasi yang telah ditetapkan. Secara umum, kinerja adalah sesuatu yang dicapai, prestasi yang diperlihatkan, atau kemampuan kerja (Kamus Besar Bahasa Indonesia)</p>\r\n','','2013-07-10 06:17:11',1),(27,5,'PP No 8 Tahun 2006','<p>&nbsp;</p>\r\n\r\n<p>Peraturan Pemerintah Nomor 8 Tahun 2006 tentang Pelaporan Keuangan dan Kinerja Instansi Pemerintah.</p>\r\n','0','','2013-07-10 16:16:22',1),(28,5,'Surat Keputusan Kepala Lembaga Administrasi Negara','<p>Surat Keputusan Kepala Lembaga Administrasi Negara Nomor 239/IX/6/8/2003 tentang Perbaikan Pedoman Penyusunan Pelaporan Akuntabilitas Kinerja Instansi Pemerintah</p>\r\n','0','','2013-07-10 16:19:22',1),(29,5,'PER/09/M.PAN/5/2007','<p>Peraturan Menteri Negara Pendayagunaan Aparatur Negara Nomor PER/09/M.PAN/5/2007 tentang Pedoman Umum Penetapan Indikator Kinerja Utama di Lingkungan Instansi Pemerintah</p>\r\n','0','','2013-07-10 16:20:08',1),(30,5,'PER M.PAN No  29 Tahun 2010','<p>Peraturan Menteri Negara Pendayagunaan Aparatur Negara dan Reformasi Birokrasi Nomor 29 Tahun 2010 tentang Pedoman Penyusunan Penetapan Kinerja dan Pelaporan Akuntabilitas Kinerja Instansi Pemerintah.</p>\r\n','0','','2013-07-10 16:21:28',1),(31,5,'Peraturan Menteri Perhubungan Nomor PM 68 Tahun 20','<p>Peraturan Menteri Perhubungan Nomor PM 68 Tahun 2012 tentang Penetapan Indikator Kinerja Utama (IKU) di Lingkungan Kementerian Perhubungan.</p>\r\n','0','','2013-07-10 16:22:23',1),(32,5,'Peraturan Menteri Perhubungan Nomor PM 69 Tahun 20','<p>Peraturan Menteri Perhubungan Nomor PM 69 Tahun 2012 tentang Pedoman Penyusunan Rencana Kinerja Tahunan, Penetapan Kinerja dan Laporan Akuntabilitas Kinerja di Lingkungan Kementerian Perhubungan.</p>\r\n','0','','2013-07-10 16:23:29',1),(33,5,'Peraturan Menteri Perhubungan Nomor PM 11 Tahun 20','<p>Peraturan Menteri Perhubungan Nomor PM 11 Tahun 2013 tentang Pedoman Pengumpulan Data Kinerja di Lingkungan Kementerian Perhubungan</p>\r\n','0','','2013-07-10 16:24:10',1),(34,5,'Peraturan Menteri Perhubungan Nomor PM 12 Tahun 20','<p>Peraturan Menteri Perhubungan Nomor PM 12 Tahun 2013 tentang Pedoman Pengukuran Indikator Kinerja di Lingkungan Kementerian Perhubungan.</p>\r\n','0','','2013-07-10 16:24:39',1),(35,2,'Akuntabilitas Kinerja Instansi Pemerintah Meningkat Signifikan','<p>Perkembangan akuntabilitas kinerja instansi pemerintah pusat dan provinsi dari tahun 2009 sampai 2012 mengalami peningkatan cukup signifikan. Tahun lalu, hanya ada dua instansi pusat yang mendapat nilai A, tahun ini bertambah menjadi tiga. Sedangkan pemerintah provinsi, tahun lalu baru dua yang mendapat nilai B, kini menjadi 6 provinsi.</p>\n\n<p>Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi (PANRB) Azwar Abubakar menyampaikan hal itu dalam laporannya pada penyerahan penghargaan capaian akuntabilitas kinerja terbaik bagi instansi pemerintah pusat dan pemerintah provinsi di Jakarta, Rabu (05/12).</p>\n\n<p>Ketiga instansi pusat yang mendapat nilai A dimaksud adalah Kementerian Keuangan, BPK, dan KPK. Sedangkan enam pemprov yang memperoleh nilai B adalah DIY, Jawa Tengah, Jawa Timur, Kalimantan Selatan, Kalimantan Timur, dan Sumatera Selatan. Mereka menerima penghargaan dari Wakil Presiden Boediono.</p>\n\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian atas laporan hasil evaluasi akuntabilitas kinerja tahun 2012 ini dilakukan terhadap 81 kementerian/lembaga, serta 33 provinsi. Selain 3 K/L yang memperoleh nilai A, sebanyak 26 K/L meraih nilai B, 48 k/L memperoleh nilai CC, dan 4 K/L mendapat nilai C. Adapun untuk pemerintah provinsi, tercatat ada 6 provinsi yang meraih nilai B, 17 mendapat nilai CC, 9 mendapat nilai C, dan masih ada satu provinsi yang nilainya D.</p>\n\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sistem akuntabilitas kinerja instansi pemerintah (SAKIP) merupakan penerapan manajemen kinerja pada sektor publik yang sejalan dan konsisten dengan penerapan reformasi birokrasi, yang berorientasi pada pencapaian outcomes dan upaya untuk mendapatkan ahsil yang lebih baik.</p>\n\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menurut Azwar Abubakar, SAKIP merupakan integrasi dari sistem perencanaan, system penganggaran dan system pelaporan kinerja, yang selaras dengan pelaksanaan sistem akuntabilitas keuangan. Dalam hal ini, setiap organisasi diwajibkan mencatat dan melaporkan setiap penggunaan keuangan negara serta kesesuaiannya dengan ketentuan yang berlaku. &ldquo;Kalau akuntabilitas keuangan hasilnya berupa laporan keuangan, sedangkan produk akhir dari SAKIP adalah LAKIP, yang menggambarkan kinerja yang dicapai oleh suatu instansi pemerintah atas pelaksanaan program dan kegiatan yang dibiayai APBN/APBD,&rdquo; ujar Menteri.</p>\n\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diungkapkan, dalam penilaian LAKIP ini materi yang dievaluasi meliputi 5 komponen. Komponen pertama adalah perencanaan kinerja, terdiri dari renstra, rncana kinerja tahunan, dan penetapan kinerja dengan bobot 35. Komponen kedua, yakni pengukuran kinerja, yang meliputi pemenuhan pengukuran, kualitas pengukuran, dan implementasi pengukuran dengan bobot 20.</p>\n\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelaporan kinerja yang merupakan komponen ketiga, terdiri dari pemenuhan laporan, penyajian informasi knerja, serta pemanfaatan informasi kinerja, diberi bobot 15. Sedangkan evaluasi kinerja yang terdiri dari pemenuhan evaluasi, kualitas evaluasi, dan pemanfaatan hasil evaluasi, diberi bobot 10. Untuk pencapaian kinerja, bobotnya 20, terdiri dari kinerja yang dilaporkan ( output dan outcome), dan kinerja lainnya.</p>\n\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nilai tertinggi dari evaluasi LAKIP adalah AA (memuaskan), dengan skor 85 &ndash; 100, sedangkan A (sangat baik) skornya 75 -85, CC (cukup baik) dengan skor 50 &ndash; 65, C (agak kurang) dengan skor 30 &ndash; 50, dan nilai D (kurang) dengan skor 0 &ndash; 30.</p>\n','<p>Perkembangan akuntabilitas kinerja instansi pemerintah pusat dan provinsi dari tahun 2009 sampai 2012 mengalami peningkatan cukup signifikan. Tahun lalu, hanya ada dua instansi pusat yang mendapat nilai A, tahun ini bertambah menjadi tiga. Sedangkan pemerintah provinsi, tahun lalu baru dua yang mendapat nilai B, kini menjadi 6 provinsi.</p>\n','http://www.menpan.go.id/berita-terkini/796-akuntab','2013-07-11 03:34:49',1),(36,1,'2012','0','0','0','2013-08-30 06:49:51',0);
/*!40000 ALTER TABLE `portal_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_checkpoint_e1`
--

DROP TABLE IF EXISTS `tbl_checkpoint_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_checkpoint_e1` (
  `id_checkpoint_e1` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pk_e1` int(11) NOT NULL,
  `unit_kerja` varchar(100) DEFAULT NULL,
  `periode` smallint(6) DEFAULT NULL,
  `kriteria` varchar(255) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `target` float DEFAULT NULL,
  `capaian` float DEFAULT NULL,
  `keterangan` text,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `nama_folder_pendukung` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_checkpoint_e1`),
  KEY `fk_checkpoint_penetapan_e1` (`id_pk_e1`),
  CONSTRAINT `fk_checkpoint_penetapan_e1` FOREIGN KEY (`id_pk_e1`) REFERENCES `tbl_pk_eselon1` (`id_pk_e1`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_checkpoint_e1`
--

LOCK TABLES `tbl_checkpoint_e1` WRITE;
/*!40000 ALTER TABLE `tbl_checkpoint_e1` DISABLE KEYS */;
INSERT INTO `tbl_checkpoint_e1` VALUES (77,77,'-',12,'Kejadian kecelakaan yang disebabkan oleh manusia','Jumlah kejadian kecelakaan yang disebabkan oleh manusia',31,24,NULL,NULL,NULL,NULL),(78,78,'-',12,'Kejadian kecelakaan yang disebabkan oleh teknis dan lain-lain','Jumlah kejadian kecelakaan yang disebabkan oleh teknis dan lain-lain',48,66,NULL,NULL,NULL,NULL),(79,79,'-',12,'Kapal yang memiliki sertifikat kelaiklautan kapal','Jumlah kapal yang memiliki sertifikat kelaiklautan kapal',7146,9298,NULL,NULL,NULL,NULL),(80,80,'-',12,'Rute perintis yang dilayani transportasi laut','Jumlah rute perintis yang dilayani transportasi laut',80,80,NULL,NULL,NULL,NULL),(81,81,'-',12,'Pelabuhan yang dapat menghubungkan daerah terpencil, terluar, daerah perbatasan, daerah belum berkembang dan daerah telah berkembang','Jumlah pelabuhan yang dapat menghubungkan daerah-daerah terpencil, terluar, daerah perbatasan, daerah belum berkembang dan daerah telah berkembang',393,386,NULL,NULL,NULL,NULL),(82,82,'-',12,'Penumpang transportasi laut yang terangkut','Jumlah penumpang transportasi laut yang terangkut',5.02766e+06,6.06157e+06,NULL,NULL,NULL,NULL),(83,83,'-',12,'Penumpang angkutan laut perintis','Jumlah penumpang angkutan laut perintis',629847,634000,NULL,NULL,NULL,NULL),(84,84,'-',12,'Muatan angkutan laut dalam negeri yang diangkut oleh kapal nasional','Jumlah muatan angkutan laut dalam negeri yang diangkut oleh kapal nasional',3.273e+08,3.51985e+08,NULL,NULL,NULL,NULL),(85,85,'-',12,'Pangsa muatan angkutan laut dalam negeri yang diangkut oleh kapal nasional','Persentase pangsa muatan angkutan laut dalam negeri yang diangkut oleh kapal nasional',98.85,98.9,NULL,NULL,NULL,NULL),(86,86,'-',12,'Muatan angkutan laut luar negeri yang diangkut oleh kapal nasional','Jumlah muatan angkutan laut luar negeri yang diangkut oleh kapal nasional',5.9599e+07,5.9851e+07,NULL,NULL,NULL,NULL),(87,87,'-',12,'Pangsa muatan angkutan laut luar negeri yang diangkut oleh kapal nasional','Persentase pangsa muatan angkutan laut luar negeri yang diangkut oleh kapal nasional',10,11.8,NULL,NULL,NULL,NULL),(88,88,'-',12,'Penurunan Turn-Around Time (TRT) di pelabuhan yang diusahakan','Penurunan Turn-Around Time (TRT) di pelabuhan yang diusahakan',30,0,NULL,NULL,NULL,NULL),(89,89,'-',12,'Pelabuhan mempunyai pencapaian Waiting Time (WT)','Jumlah pelabuhan mempunyai pencapaian Waiting Time (WT)',48,36,NULL,NULL,NULL,NULL),(90,90,'-',12,'Pelabuhan mempunyai pencapaian approach time (AT)','Jumlah pelabuhan mempunyai pencapaian approach time (AT)',48,36,NULL,NULL,NULL,NULL),(91,91,'-',12,'Pelabuhan mempunyai pencapaian Waktu Efektif (Effective Time/ET)','Jumlah pelabuhan mempunyai pencapaian Waktu Efektif (Effective Time/ET)',48,15,NULL,NULL,NULL,NULL),(92,92,'-',12,'MOU, perizinan, konstruksi, dan operasional kerjasama pemerintah dengan Pemda dan Swasta di bidang transportasi laut','Jumlah MOU, perizinan, konstruksi, dan operasional kerjasama pemerintah dengan Pemda dan Swasta di bidang transportasi laut',2,2,NULL,NULL,NULL,NULL),(93,93,'-',12,'Kebutuhan tenaga Marine Inspector A','Jumlah kebutuhan tenaga Marine Inspector A',60,60,NULL,NULL,NULL,NULL),(94,94,'-',12,'Kebutuhan tenaga Marine Inspector B','Jumlah kebutuhan tenaga Marine Inspector B',120,120,NULL,NULL,NULL,NULL),(95,95,'-',12,'Kebutuhan tenaga PPNS','Jumlah kebutuhan tenaga PPNS',60,59,NULL,NULL,NULL,NULL),(96,96,'-',12,'Tenaga PPNS','Jumlah tenaga PPNS',367,367,NULL,NULL,NULL,NULL),(97,97,'-',12,'Kebutuhan tenaga kesyahbandaran kelas A','Jumlah kebutuhan tenaga kesyahbandaran kelas A',60,60,NULL,NULL,NULL,NULL),(98,98,'-',12,'Kebutuhan tenaga kesyahbandaran kelas B','Jumlah kebutuhan tenaga kesyahbandaran kelas B',120,120,NULL,NULL,NULL,NULL),(99,99,'-',12,'Kebutuhan tenaga penanggulangan pencemaran','Jumlah kebutuhan tenaga penanggulangan pencemaran',0,0,NULL,NULL,NULL,NULL),(100,100,'-',12,'Kebutuhan tenaga penanggulangan kebakaran','Jumlah kebutuhan tenaga penanggulangan kebakaran',0,0,NULL,NULL,NULL,NULL),(101,101,'-',12,'Kebutuhan tenaga penyelam','Jumlah kebutuhan tenaga penyelam',0,0,NULL,NULL,NULL,NULL),(102,102,'-',12,'Nilai AKIP Direktorat Jenderal Perhubungan Laut','Nilai AKIP Direktorat Jenderal Perhubungan Laut',78,78,NULL,NULL,NULL,NULL),(103,103,'-',12,'Realisasi pendapatan Direktorat Jenderal Perhubungan Laut','Jumlah realisasi pendapatan Direktorat Jenderal Perhubungan Laut',3.31e+11,6.21e+11,NULL,NULL,NULL,NULL),(104,104,'-',12,'Realisasi belanja anggaran Direktorat Jenderal Perhubungan Laut','Jumlah realisasi belanja anggaran Direktorat Jenderal Perhubungan Laut',1.16e+13,9.99e+12,NULL,NULL,NULL,NULL),(105,105,'-',12,'Nilai BMN pada neraca Direktorat Jenderal Perhubungan Laut','Nilai BMN pada neraca Direktorat Jenderal Perhubungan Laut',2.67e+13,2.52e+13,NULL,NULL,NULL,NULL),(106,106,'-',12,'Penyelesaian regulasi','Jumlah penyelesaian regulasi',11,11,NULL,NULL,NULL,NULL),(107,107,'-',12,'Penurunan emisi gas buang (CO2) transportasi laut','Jumlah penurunan emisi gas buang (CO2) transportasi laut',0.4853,0.102,NULL,NULL,NULL,NULL),(108,108,'-',12,'Pelabuhan yang menerapkan Eco-Port (penanganan sampah dan kebersihan lingkungan pelabuhan)','Jumlah pelabuhan yang menerapkan Eco-Port (penanganan sampah dan kebersihan lingkungan pelabuhan)',6,6,NULL,NULL,NULL,NULL),(109,109,'-',12,'Pemilikan sertifikat IOPP (International Oil Polution Prevention)','Jumlah pemilikan sertifikat IOPP (International Oil Polution Prevention)',1021,972,NULL,NULL,NULL,NULL),(110,110,'-',12,'Pemilikan SNPP (Sertifikat Nasional Pencegahan Pencemaran)','Jumlah pemilikan SNPP (Sertifikat Nasional Pencegahan Pencemaran)',1527,1332,NULL,NULL,NULL,NULL),(111,111,'-',12,'Pemilikan sertifikat bahan cair beracun (Noxius Liquid Substance)','Jumlah pemilikan sertifikat bahan cair beracun (Noxius Liquid Substance)',134,107,NULL,NULL,NULL,NULL),(112,112,'-',12,'Pemilikan sertifikat ISPP (International Sewage Pollution Prevention)','Jumlah pemilikan sertifikat ISPP (International Sewage Pollution Prevention)',245,205,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_checkpoint_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_checkpoint_kl`
--

DROP TABLE IF EXISTS `tbl_checkpoint_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_checkpoint_kl` (
  `id_checkpoint_kl` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pk_kl` int(11) NOT NULL,
  `unit_kerja` varchar(100) DEFAULT NULL,
  `periode` smallint(6) DEFAULT NULL,
  `kriteria` varchar(255) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `target` float DEFAULT NULL,
  `capaian` float DEFAULT NULL,
  `keterangan` text,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `nama_folder_pendukung` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_checkpoint_kl`),
  KEY `fk_checkpoint_penetapan` (`id_pk_kl`),
  CONSTRAINT `fk_checkpoint_penetapan` FOREIGN KEY (`id_pk_kl`) REFERENCES `tbl_pk_kl` (`id_pk_kl`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_checkpoint_kl`
--

LOCK TABLES `tbl_checkpoint_kl` WRITE;
/*!40000 ALTER TABLE `tbl_checkpoint_kl` DISABLE KEYS */;
INSERT INTO `tbl_checkpoint_kl` VALUES (1,1,'Hubdat, KA, Hubla dan Hubud',12,'Kejadian kecelakaan transportasi nasional','Jumlah kejadian kecelakaan transportasi nasional',5003,5356,NULL,NULL,NULL,NULL),(2,2,'Hubla',12,'Gangguan keamanan pada sektor transportasi','Jumlah gangguan keamanan pada sektor transportasi',9,6,NULL,NULL,NULL,NULL),(3,3,'KA, Hubla dan Hubud',12,'Pencapaian On-Time Performance (OTP) sektor transportasi (selain transportasi darat)','Rata-rata persentase pencapaian On-Time Performance (OTP) sektor transportasi (selain transportasi darat)',71.73,72.24,NULL,NULL,NULL,NULL),(4,4,'Hubdat, KA, Hubla dan Hubud',12,'Sarana transportasi yang sudah tersertifikasi','Jumlah sarana transportasi yang sudah tersertifikasi',10981,13619,NULL,NULL,NULL,NULL),(5,5,'Hubdat, KA, dan Hubud',12,'Jumlah prasarana transportasi yang sudah tersertifikasi','Jumlah prasarana transportasi yang sudah tersertifikasi',32,13,NULL,NULL,NULL,NULL),(6,6,'Hubdat, KA, Hubla dan Hubud',12,'Lintas pelayanan angkutan perintis dan subsidi','Jumlah lintas pelayanan angkutan perintis dan subsidi',579,583,NULL,NULL,NULL,NULL),(7,7,'-',12,'Kontribusi sektor transportasi terhadap pertumbuhan ekonomi nasional','Persentase kontribusi sektor transportasi terhadap pertumbuhan ekonomi nasional',1.5,1.15,NULL,NULL,NULL,NULL),(8,8,'Hubdat, KA, Hubla dan Hubud',12,'Total produksi angkutan penumpang','Total produksi angkutan penumpang',8.37526e+08,8.30786e+08,NULL,NULL,NULL,NULL),(9,9,'Hubdat, KA, Hubla dan Hubud',12,'Total produksi angkutan barang','Total produksi angkutan barang',4.17313e+08,3.74727e+08,NULL,NULL,NULL,NULL),(10,10,'Hubdat, Hubla, Hubud, BPSDMP dan PKKPJT',12,'Infrastruktur transportasi yang siap ditawarkan melalui kerjasama Pemerintah-Swasta','Jumlah infrastruktur transportasi yang siap ditawarkan melalui kerjasama Pemerintah-Swasta',2,3,NULL,NULL,NULL,NULL),(11,11,'-',12,'Nilai AKIP Kementerian Perhubungan','Nilai AKIP Kementerian Perhubungan',0,0,NULL,NULL,NULL,NULL),(12,12,'-',12,'Opini BPK atas laporan keuangan Kementerian Perhubungan','Opini BPK atas laporan keuangan Kementerian Perhubungan',0,0,NULL,NULL,NULL,NULL),(13,13,'Setjen, Hubdat, Hubla, Hubud, KA, dan BPSDMP',12,'Aset negara yang berhasil diinventarisasi sesuai kaidah pengelolaan BMN','Nilai aset negara yang berhasil diinventarisasi sesuai kaidah pengelolaan BMN',1.25e+14,1.63e+14,NULL,NULL,NULL,NULL),(14,14,'Hubud',12,'SDM operator prasarana dan sarana transportasi yang telah memiliki sertifikat','Jumlah SDM operator prasarana dan sarana transportasi yang telah memiliki sertifikat',56396,58175,NULL,NULL,NULL,NULL),(15,15,'Hubdat, KA, Hubla dan Hubud',12,'SDM fungsional teknis Kementerian Perhubungan','Jumlah SDM fungsional teknis Kementerian Perhubungan',2249,3637,NULL,NULL,NULL,NULL),(16,16,'BPSDMP',12,'Lulusan diklat SDM Transportasi Darat, Laut, Udara, Perkeretaapian dan Aparatur','Jumlah lulusan diklat SDM Transportasi Darat, Laut, Udara, Perkeretaapian dan Aparatur',149216,162364,NULL,NULL,NULL,NULL),(17,17,'Biro Hukum, Hubdat, KA, Hubla, Hubud dan KSLN',12,'Peraturan perundang-undangan di sektor transportasi yang ditetapkan','Jumlah peraturan perundang-undangan di sektor transportasi yang ditetapkan',55,65,NULL,NULL,NULL,NULL),(18,18,'-',12,'Konsumsi energi tak terbarukan dari sektor transportasi nasional','Jumlah konsumsi energi tak terbarukan dari sektor transportasi nasional',3751.01,3758.48,NULL,NULL,NULL,NULL),(19,19,'-',12,'Emisi gas buang dari sektor transportasi nasional','Jumlah emisi gas buang dari sektor transportasi nasional',89571.3,88691.3,NULL,NULL,NULL,NULL),(20,20,'Hubdat, KA dan Hubla',12,'Penerapan teknologi ramah lingkungan pada sarana dan prasarana transportasi','Jumlah penerapan teknologi ramah lingkungan pada sarana dan prasarana transportasi',3052,2946,NULL,NULL,NULL,NULL),(21,21,'Hubdat, Hubla dan Hubud',12,'Lokasi simpul transportasi yang telah menerapkan konsep ramah lingkungan','Jumlah lokasi simpul transportasi yang telah menerapkan konsep ramah lingkungan',53,53,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_checkpoint_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_datapendukung_e1`
--

DROP TABLE IF EXISTS `tbl_datapendukung_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_datapendukung_e1` (
  `id_datapendukung_e1` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_checkpoint_e1` bigint(20) NOT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  `lokasi_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_datapendukung_e1`),
  KEY `fk_checkpoint_pendukung_e1` (`id_checkpoint_e1`),
  CONSTRAINT `fk_checkpoint_pendukung_e1` FOREIGN KEY (`id_checkpoint_e1`) REFERENCES `tbl_checkpoint_e1` (`id_checkpoint_e1`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_datapendukung_e1`
--

LOCK TABLES `tbl_datapendukung_e1` WRITE;
/*!40000 ALTER TABLE `tbl_datapendukung_e1` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_datapendukung_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_datapendukung_kl`
--

DROP TABLE IF EXISTS `tbl_datapendukung_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_datapendukung_kl` (
  `id_datapendukung_kl` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_checkpoint_kl` bigint(20) NOT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  `lokasi_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_datapendukung_kl`),
  KEY `fk_checkpoint_pendukung_kl` (`id_checkpoint_kl`),
  CONSTRAINT `fk_checkpoint_pendukung_kl` FOREIGN KEY (`id_checkpoint_kl`) REFERENCES `tbl_checkpoint_kl` (`id_checkpoint_kl`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_datapendukung_kl`
--

LOCK TABLES `tbl_datapendukung_kl` WRITE;
/*!40000 ALTER TABLE `tbl_datapendukung_kl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_datapendukung_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_eselon1`
--

DROP TABLE IF EXISTS `tbl_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_eselon1` (
  `kode_e1` varchar(10) NOT NULL,
  `kode_kl` varchar(10) NOT NULL,
  `nama_e1` varchar(70) DEFAULT NULL,
  `singkatan` varchar(30) NOT NULL,
  `nama_dirjen` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `gol` varchar(5) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `kunci` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`kode_e1`),
  KEY `fk_eselon1_kl` (`kode_kl`),
  CONSTRAINT `tbl_eselon1_ibfk_1` FOREIGN KEY (`kode_kl`) REFERENCES `tbl_kl` (`kode_kl`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_eselon1`
--

LOCK TABLES `tbl_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_eselon1` VALUES ('022.04','022','Direktorat Jenderal Perhubungan Laut','Ditjen Hubla','Capt. Bobby R. Mamahit','19560912 198503 1002','Pembina Utama','IV/E',NULL,NULL,1);
/*!40000 ALTER TABLE `tbl_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_eselon2`
--

DROP TABLE IF EXISTS `tbl_eselon2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_eselon2` (
  `kode_e2` varchar(10) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `nama_e2` varchar(70) DEFAULT NULL,
  `singkatan` varchar(30) NOT NULL,
  `nama_direktur` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `gol` varchar(5) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_e2`),
  KEY `FK_tbl_eselon2` (`kode_e1`),
  CONSTRAINT `tbl_eselon2_ibfk_1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_eselon2`
--

LOCK TABLES `tbl_eselon2` WRITE;
/*!40000 ALTER TABLE `tbl_eselon2` DISABLE KEYS */;
INSERT INTO `tbl_eselon2` VALUES ('022.04.01','022.04','Sekretaris Direktorat Jenderal Perhubungan Laut','Sesditjen Hubla','Capt. Erwin Rosmali, MM ','19550728 198503 1 00','Pembina Utama Muda ','IV/c',NULL,NULL),('022.04.02','022.04','Direktorat Kenavigasian','Ditnav','Ir. A.Tonny Budiono, MM','195807131986031001','Pembina Utama Madya','IV/d',NULL,NULL),('022.04.03','022.04','Direktorat Lalu Lintas dan Angkutan Laut','Ditlala','Adolf R. Tambunan','','','',NULL,NULL),('022.04.04','022.04','Direktorat Pelabuhan dan Pengerukan','Ditpelpeng','Ir. Kemal Heryandri, Dipl, HE','195701091986031001','Pembina Utama Muda','IV/c',NULL,'8;2013-12-04 12:14:53'),('022.04.05','022.04','Direktorat Perkapalan dan Kepelautan','DIT. KAPPEL','-','-','-','-','8;2013-12-04 17:47:16',NULL),('022.04.06','022.04','Direktorat Kesatuan Penjagaan Laut dan Pantai','Dit KPLP','Drs. TRI YUSWOYO, MSc, M. Mar. Eng','19541020 198303 1 00','Pembina Utama Madya ','IV/d',NULL,NULL);
/*!40000 ALTER TABLE `tbl_eselon2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_exception_ikk`
--

DROP TABLE IF EXISTS `tbl_exception_ikk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_exception_ikk` (
  `tahun` year(4) NOT NULL,
  `kode_ikk` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_exception_ikk`
--

LOCK TABLES `tbl_exception_ikk` WRITE;
/*!40000 ALTER TABLE `tbl_exception_ikk` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_exception_ikk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_exception_iku_eselon1`
--

DROP TABLE IF EXISTS `tbl_exception_iku_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_exception_iku_eselon1` (
  `tahun` year(4) NOT NULL,
  `kode_iku_e1` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_exception_iku_eselon1`
--

LOCK TABLES `tbl_exception_iku_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_exception_iku_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_exception_iku_eselon1` VALUES (2012,'IKUSSPD03.01'),(2012,'IKUSSPD03.02'),(2012,'IKUSSPL01.01'),(2012,'IKUSSPL01.02'),(2012,'IKUSSPL05.01'),(2012,'IKUSSPU01.02'),(2012,'IKUSSPU02.01'),(2012,'IKUSSPU02.02'),(2012,'IKUSSPU03.01'),(2012,'IKUSSPU04.01'),(2012,'IKUSSKA02.01'),(2012,'IKUSSKA03.01'),(2012,'IKUSSKA03.02'),(2013,'IKUSSPD03.01'),(2013,'IKUSSPD03.02'),(2013,'IKUSSPL01.01'),(2013,'IKUSSPL01.02'),(2013,'IKUSSPL05.01'),(2013,'IKUSSPU01.02'),(2013,'IKUSSPU02.01'),(2013,'IKUSSPU02.02'),(2013,'IKUSSPU03.01'),(2013,'IKUSSPU04.01'),(2013,'IKUSSKA02.01'),(2013,'IKUSSKA03.01'),(2013,'IKUSSKA03.02');
/*!40000 ALTER TABLE `tbl_exception_iku_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_exception_iku_kl`
--

DROP TABLE IF EXISTS `tbl_exception_iku_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_exception_iku_kl` (
  `tahun` year(4) NOT NULL,
  `kode_iku_kl` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_exception_iku_kl`
--

LOCK TABLES `tbl_exception_iku_kl` WRITE;
/*!40000 ALTER TABLE `tbl_exception_iku_kl` DISABLE KEYS */;
INSERT INTO `tbl_exception_iku_kl` VALUES (2012,'IKUSSKP01.01'),(2012,'IKUSSKP02.01'),(2012,'IKUSSKP03.01'),(2012,'IKUSSKP12.02'),(2013,'IKUSSKP01.01'),(2013,'IKUSSKP02.01'),(2013,'IKUSSKP03.01'),(2013,'IKUSSKP12.02');
/*!40000 ALTER TABLE `tbl_exception_iku_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_group_access`
--

DROP TABLE IF EXISTS `tbl_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_group_access` (
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `level_id` smallint(6) NOT NULL DEFAULT '0',
  `group_id` smallint(6) NOT NULL DEFAULT '0',
  `policy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`,`level_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_group_access`
--

LOCK TABLES `tbl_group_access` WRITE;
/*!40000 ALTER TABLE `tbl_group_access` DISABLE KEYS */;
INSERT INTO `tbl_group_access` VALUES (1,3,1,''),(2,3,1,'VIEW;PRINT;EXCEL;'),(3,3,1,'VIEW;PRINT;EXCEL;'),(4,3,1,'VIEW;PRINT;EXCEL;'),(6,3,1,'VIEW;PRINT;EXCEL;'),(7,3,1,'VIEW;PRINT;EXCEL;'),(30,3,1,''),(31,3,1,'VIEW;PRINT;EXCEL;'),(32,3,1,'VIEW;'),(33,3,1,''),(34,3,1,'VIEW;PRINT;EXCEL;'),(35,3,1,'VIEW;'),(36,3,1,''),(50,3,1,''),(51,3,1,'VIEW;PRINT;EXCEL;'),(52,3,1,'VIEW;'),(53,3,1,''),(100,3,1,''),(101,3,1,''),(102,3,1,'VIEW;PRINT;EXCEL;'),(103,3,1,'VIEW;PRINT;EXCEL;'),(104,3,1,''),(105,3,1,'VIEW;'),(106,3,1,''),(107,3,1,''),(108,3,1,''),(109,3,1,''),(150,3,1,''),(151,3,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(152,3,1,'VIEW;'),(153,3,1,''),(200,3,1,''),(201,3,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(202,3,1,'VIEW;'),(203,3,1,''),(250,3,1,''),(251,3,1,''),(252,3,1,'VIEW;PRINT;EXCEL;'),(253,3,1,'VIEW;'),(254,3,1,''),(255,3,1,''),(256,3,1,'VIEW;PRINT;EXCEL;'),(257,3,1,'VIEW;'),(258,3,1,''),(260,3,1,''),(261,3,1,'VIEW;PRINT;EXCEL;'),(262,3,1,'VIEW;'),(263,3,1,''),(265,3,1,''),(266,3,1,'VIEW;PRINT;EXCEL;'),(267,3,1,'VIEW;'),(268,3,1,''),(270,3,1,''),(271,3,1,'VIEW;PRINT;EXCEL;'),(272,3,1,'VIEW;'),(273,3,1,''),(274,3,1,'VIEW;PRINT;EXCEL;'),(300,3,1,''),(302,3,1,''),(303,3,1,''),(350,3,1,''),(351,3,1,''),(352,3,1,''),(353,3,1,''),(355,3,1,''),(356,3,1,''),(357,3,1,''),(358,3,1,''),(359,3,1,''),(360,3,1,''),(1,4,1,''),(2,4,1,'VIEW;PRINT;'),(3,4,1,'VIEW;PRINT;'),(4,4,1,'VIEW;PRINT;'),(6,4,1,'VIEW;PRINT;'),(7,4,1,'VIEW;PRINT;'),(30,4,1,''),(31,4,1,'VIEW;PRINT;'),(32,4,1,'VIEW;PRINT;'),(33,4,1,''),(34,4,1,'VIEW;PRINT;'),(35,4,1,'VIEW;PRINT;'),(36,4,1,''),(50,4,1,''),(51,4,1,'VIEW;PRINT;'),(52,4,1,'VIEW;PRINT;'),(53,4,1,''),(100,4,1,''),(101,4,1,''),(102,4,1,'VIEW;PRINT;'),(103,4,1,''),(104,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(105,4,1,'VIEW;PRINT;'),(106,4,1,''),(107,4,1,''),(108,4,1,''),(109,4,1,''),(150,4,1,''),(151,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;'),(152,4,1,'VIEW;PRINT;'),(153,4,1,''),(200,4,1,''),(201,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;'),(202,4,1,'VIEW;PRINT;'),(203,4,1,''),(250,4,1,''),(251,4,1,''),(252,4,1,'VIEW;PRINT;'),(253,4,1,'VIEW;PRINT;'),(254,4,1,''),(255,4,1,''),(256,4,1,'VIEW;PRINT;'),(257,4,1,'VIEW;PRINT;'),(258,4,1,''),(260,4,1,''),(261,4,1,'VIEW;PRINT;EXCEL;'),(262,4,1,'VIEW;'),(263,4,1,''),(265,4,1,''),(266,4,1,'VIEW;PRINT;'),(267,4,1,'VIEW;PRINT;'),(268,4,1,''),(270,4,1,''),(271,4,1,'VIEW;PRINT;'),(272,4,1,'VIEW;PRINT;'),(273,4,1,''),(274,4,1,''),(300,4,1,''),(302,4,1,''),(303,4,1,''),(350,4,1,''),(351,4,1,''),(352,4,1,''),(353,4,1,''),(355,4,1,''),(356,4,1,''),(357,4,1,''),(358,4,1,''),(359,4,1,''),(360,4,1,''),(1,3,2,''),(2,3,2,'VIEW;PRINT;EXCEL;'),(3,3,2,'VIEW;PRINT;EXCEL;'),(4,3,2,'VIEW;PRINT;EXCEL;'),(6,3,2,'VIEW;PRINT;EXCEL;'),(7,3,2,'VIEW;PRINT;EXCEL;'),(30,3,2,''),(31,3,2,''),(32,3,2,'VIEW;PRINT;EXCEL;'),(33,3,2,'VIEW;'),(34,3,2,''),(35,3,2,'VIEW;PRINT;EXCEL;'),(36,3,2,'VIEW;'),(50,3,2,''),(51,3,2,''),(52,3,2,'VIEW;PRINT;EXCEL;'),(53,3,2,'VIEW;'),(100,3,2,''),(101,3,2,''),(102,3,2,''),(103,3,2,''),(104,3,2,''),(105,3,2,'VIEW;PRINT;EXCEL;'),(106,3,2,'VIEW;PRINT;EXCEL;'),(107,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(108,3,2,'VIEW;'),(109,3,2,'VIEW;'),(150,3,2,''),(151,3,2,''),(152,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(153,3,2,'VIEW;'),(200,3,2,''),(201,3,2,''),(202,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(203,3,2,'VIEW;'),(250,3,2,''),(251,3,2,''),(252,3,2,''),(253,3,2,'VIEW;PRINT;EXCEL;'),(254,3,2,'VIEW;'),(255,3,2,''),(256,3,2,''),(257,3,2,'VIEW;PRINT;EXCEL;'),(258,3,2,'VIEW;'),(260,3,2,''),(261,3,2,''),(262,3,2,'VIEW;PRINT;EXCEL;'),(263,3,2,'VIEW;'),(265,3,2,''),(266,3,2,''),(267,3,2,'VIEW;PRINT;EXCEL;'),(268,3,2,'VIEW;'),(270,3,2,''),(271,3,2,''),(272,3,2,'VIEW;PRINT;EXCEL;'),(273,3,2,'VIEW;'),(274,3,2,'VIEW;PRINT;EXCEL;'),(300,3,2,''),(302,3,2,''),(303,3,2,''),(350,3,2,''),(351,3,2,''),(352,3,2,''),(353,3,2,''),(355,3,2,''),(356,3,2,''),(357,3,2,''),(358,3,2,''),(359,3,2,''),(360,3,2,''),(1,4,2,''),(2,4,2,'VIEW;PRINT;EXCEL;'),(3,4,2,'VIEW;PRINT;EXCEL;'),(4,4,2,'VIEW;PRINT;EXCEL;'),(6,4,2,'VIEW;PRINT;EXCEL;'),(7,4,2,'VIEW;PRINT;EXCEL;'),(30,4,2,''),(31,4,2,''),(32,4,2,'VIEW;PRINT;EXCEL;'),(33,4,2,'VIEW;'),(34,4,2,''),(35,4,2,'VIEW;PRINT;EXCEL;'),(36,4,2,'VIEW;'),(50,4,2,''),(51,4,2,''),(52,4,2,'VIEW;PRINT;EXCEL;'),(53,4,2,'VIEW;'),(100,4,2,''),(101,4,2,''),(102,4,2,''),(103,4,2,''),(104,4,2,''),(105,4,2,'VIEW;'),(106,4,2,'VIEW;PRINT;EXCEL;'),(107,4,2,''),(108,4,2,'VIEW;'),(109,4,2,''),(150,4,2,''),(151,4,2,''),(152,4,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(153,4,2,'VIEW;'),(200,4,2,''),(201,4,2,''),(202,4,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(203,4,2,'VIEW;'),(250,4,2,''),(251,4,2,''),(252,4,2,''),(253,4,2,'VIEW;PRINT;EXCEL;'),(254,4,2,'VIEW;'),(255,4,2,''),(256,4,2,''),(257,4,2,'VIEW;PRINT;EXCEL;'),(258,4,2,'VIEW;'),(260,4,2,''),(261,4,2,''),(262,4,2,'VIEW;PRINT;EXCEL;'),(263,4,2,'VIEW;'),(265,4,2,''),(266,4,2,''),(267,4,2,'VIEW;PRINT;EXCEL;'),(268,4,2,'VIEW;'),(270,4,2,''),(271,4,2,''),(272,4,2,'VIEW;PRINT;EXCEL;'),(273,4,2,'VIEW;'),(274,4,2,'VIEW;PRINT;EXCEL;'),(300,4,2,''),(302,4,2,''),(303,4,2,''),(350,4,2,''),(351,4,2,''),(352,4,2,''),(353,4,2,''),(355,4,2,''),(356,4,2,''),(357,4,2,''),(358,4,2,''),(359,4,2,''),(360,4,2,''),(1,3,3,''),(2,3,3,'VIEW;PRINT;EXCEL;'),(3,3,3,'VIEW;PRINT;EXCEL;'),(4,3,3,'VIEW;PRINT;EXCEL;'),(6,3,3,'VIEW;PRINT;EXCEL;'),(7,3,3,'VIEW;PRINT;EXCEL;'),(30,3,3,''),(31,3,3,''),(32,3,3,''),(33,3,3,'VIEW;PRINT;EXCEL;'),(34,3,3,''),(35,3,3,''),(36,3,3,'VIEW;PRINT;EXCEL;'),(50,3,3,''),(51,3,3,''),(52,3,3,''),(53,3,3,'VIEW;PRINT;EXCEL;'),(100,3,3,''),(101,3,3,''),(102,3,3,''),(103,3,3,''),(104,3,3,''),(105,3,3,''),(106,3,3,''),(107,3,3,''),(108,3,3,'VIEW;'),(109,3,3,'VIEW;PRINT;EXCEL;'),(150,3,3,''),(151,3,3,''),(152,3,3,''),(153,3,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,3,3,''),(201,3,3,''),(202,3,3,''),(203,3,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,3,3,''),(251,3,3,''),(252,3,3,''),(253,3,3,''),(254,3,3,'VIEW;PRINT;EXCEL;'),(255,3,3,''),(256,3,3,''),(257,3,3,''),(258,3,3,'VIEW;PRINT;EXCEL;'),(260,3,3,''),(261,3,3,''),(262,3,3,''),(263,3,3,'VIEW;PRINT;EXCEL;'),(265,3,3,''),(266,3,3,''),(267,3,3,''),(268,3,3,'VIEW;PRINT;EXCEL;'),(270,3,3,''),(271,3,3,''),(272,3,3,''),(273,3,3,'VIEW;PRINT;EXCEL;'),(274,3,3,'VIEW;PRINT;EXCEL;'),(300,3,3,''),(302,3,3,''),(303,3,3,''),(350,3,3,''),(351,3,3,''),(352,3,3,''),(353,3,3,''),(355,3,3,''),(356,3,3,''),(357,3,3,''),(358,3,3,''),(359,3,3,''),(360,3,3,''),(1,4,3,''),(2,4,3,'VIEW;PRINT;EXCEL;'),(3,4,3,'VIEW;PRINT;EXCEL;'),(4,4,3,'VIEW;PRINT;EXCEL;'),(6,4,3,'VIEW;PRINT;EXCEL;'),(7,4,3,'VIEW;PRINT;EXCEL;'),(30,4,3,''),(31,4,3,''),(32,4,3,''),(33,4,3,'VIEW;PRINT;EXCEL;'),(34,4,3,''),(35,4,3,''),(36,4,3,'VIEW;PRINT;EXCEL;'),(50,4,3,''),(51,4,3,''),(52,4,3,''),(53,4,3,'VIEW;PRINT;EXCEL;'),(100,4,3,''),(101,4,3,''),(102,4,3,''),(103,4,3,''),(104,4,3,''),(105,4,3,''),(106,4,3,''),(107,4,3,''),(108,4,3,'VIEW;PRINT;EXCEL;'),(109,4,3,''),(150,4,3,''),(151,4,3,''),(152,4,3,''),(153,4,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,4,3,''),(201,4,3,''),(202,4,3,''),(203,4,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,4,3,''),(251,4,3,''),(252,4,3,''),(253,4,3,''),(254,4,3,'VIEW;PRINT;EXCEL;'),(255,4,3,''),(256,4,3,''),(257,4,3,''),(258,4,3,'VIEW;PRINT;EXCEL;'),(260,4,3,''),(261,4,3,''),(262,4,3,''),(263,4,3,'VIEW;PRINT;EXCEL;'),(265,4,3,''),(266,4,3,''),(267,4,3,''),(268,4,3,'VIEW;PRINT;EXCEL;'),(270,4,3,''),(271,4,3,''),(272,4,3,''),(273,4,3,'VIEW;PRINT;EXCEL;'),(274,4,3,'VIEW;PRINT;EXCEL;'),(300,4,3,''),(302,4,3,''),(303,4,3,''),(350,4,3,''),(351,4,3,''),(352,4,3,''),(353,4,3,''),(355,4,3,''),(356,4,3,''),(357,4,3,''),(358,4,3,''),(359,4,3,''),(360,4,3,''),(0,4,1,''),(0,3,1,''),(0,3,2,''),(0,4,2,''),(0,3,3,''),(0,4,3,''),(1,2,3,''),(2,2,3,'VIEW;PRINT;EXCEL;'),(3,2,3,'VIEW;PRINT;EXCEL;'),(4,2,3,'VIEW;PRINT;EXCEL;'),(6,2,3,'VIEW;PRINT;EXCEL;'),(7,2,3,'VIEW;PRINT;EXCEL;'),(30,2,3,''),(31,2,3,'VIEW;PRINT;EXCEL;'),(32,2,3,'VIEW;PRINT;EXCEL;'),(33,2,3,'VIEW;PRINT;EXCEL;'),(34,2,3,'VIEW;PRINT;EXCEL;'),(35,2,3,'VIEW;PRINT;EXCEL;'),(36,2,3,'VIEW;PRINT;EXCEL;'),(50,2,3,''),(51,2,3,''),(52,2,3,'VIEW;PRINT;EXCEL;'),(53,2,3,'VIEW;PRINT;EXCEL;'),(100,2,3,''),(102,2,3,''),(103,2,3,''),(105,2,3,'VIEW;PRINT;EXCEL;'),(106,2,3,''),(108,2,3,'VIEW;PRINT;EXCEL;'),(109,2,3,'VIEW;PRINT;EXCEL;'),(150,2,3,''),(151,2,3,''),(152,2,3,''),(153,2,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,2,3,''),(201,2,3,''),(202,2,3,''),(203,2,3,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,2,3,''),(252,2,3,''),(253,2,3,''),(254,2,3,'VIEW;PRINT;EXCEL;'),(256,2,3,''),(257,2,3,''),(258,2,3,'VIEW;PRINT;EXCEL;'),(261,2,3,''),(262,2,3,''),(263,2,3,''),(266,2,3,''),(267,2,3,''),(268,2,3,'VIEW;PRINT;EXCEL;'),(271,2,3,''),(272,2,3,''),(273,2,3,'VIEW;PRINT;EXCEL;'),(274,2,3,''),(300,2,3,''),(302,2,3,''),(303,2,3,''),(350,2,3,''),(351,2,3,''),(352,2,3,''),(353,2,3,''),(356,2,3,''),(357,2,3,''),(358,2,3,''),(359,2,3,''),(360,2,3,''),(0,2,3,''),(1,2,1,''),(2,2,1,'VIEW;PRINT;EXCEL;'),(3,2,1,'VIEW;PRINT;EXCEL;'),(4,2,1,'VIEW;PRINT;EXCEL;'),(6,2,1,'VIEW;PRINT;EXCEL;'),(7,2,1,'VIEW;PRINT;EXCEL;'),(30,2,1,''),(31,2,1,'VIEW;PRINT;EXCEL;'),(32,2,1,'VIEW;PRINT;EXCEL;'),(33,2,1,'VIEW;PRINT;EXCEL;'),(34,2,1,'VIEW;PRINT;EXCEL;'),(35,2,1,'VIEW;PRINT;EXCEL;'),(36,2,1,'VIEW;PRINT;EXCEL;'),(50,2,1,''),(51,2,1,'VIEW;PRINT;EXCEL;'),(52,2,1,'VIEW;PRINT;EXCEL;'),(53,2,1,'VIEW;PRINT;EXCEL;'),(100,2,1,''),(102,2,1,'VIEW;PRINT;EXCEL;'),(103,2,1,'VIEW;PRINT;EXCEL;'),(105,2,1,'VIEW;PRINT;EXCEL;'),(106,2,1,'VIEW;PRINT;EXCEL;'),(108,2,1,'VIEW;PRINT;EXCEL;'),(109,2,1,'VIEW;PRINT;EXCEL;'),(150,2,1,''),(151,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(152,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(153,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,2,1,''),(201,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(202,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(203,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,2,1,''),(252,2,1,'VIEW;PRINT;EXCEL;'),(253,2,1,'VIEW;PRINT;EXCEL;'),(254,2,1,'VIEW;PRINT;EXCEL;'),(256,2,1,'VIEW;PRINT;EXCEL;'),(257,2,1,'VIEW;PRINT;EXCEL;'),(258,2,1,'VIEW;PRINT;EXCEL;'),(261,2,1,'VIEW;PRINT;EXCEL;'),(262,2,1,'VIEW;PRINT;EXCEL;'),(263,2,1,'VIEW;PRINT;EXCEL;'),(266,2,1,'VIEW;PRINT;EXCEL;'),(267,2,1,'VIEW;PRINT;EXCEL;'),(268,2,1,'VIEW;PRINT;EXCEL;'),(271,2,1,'VIEW;PRINT;EXCEL;'),(272,2,1,'VIEW;PRINT;EXCEL;'),(273,2,1,'VIEW;PRINT;EXCEL;'),(274,2,1,'VIEW;PRINT;EXCEL;'),(300,2,1,''),(302,2,1,'VIEW;ADD;EDIT;PRINT;'),(303,2,1,'EDIT;'),(350,2,1,''),(351,2,1,'PROSES;'),(352,2,1,'PROSES;'),(353,2,1,'PROSES;'),(356,2,1,'VIEW;PRINT;'),(357,2,1,'VIEW;PRINT;'),(358,2,1,'VIEW;PRINT;'),(359,2,1,'VIEW;PRINT;'),(360,2,1,'VIEW;PRINT;'),(0,2,1,''),(1,2,2,''),(2,2,2,'EXCEL;'),(3,2,2,'VIEW;PRINT;EXCEL;'),(4,2,2,'VIEW;PRINT;EXCEL;'),(6,2,2,'VIEW;PRINT;EXCEL;'),(7,2,2,'VIEW;PRINT;EXCEL;'),(30,2,2,''),(31,2,2,'VIEW;PRINT;EXCEL;'),(32,2,2,'VIEW;PRINT;EXCEL;'),(33,2,2,'VIEW;PRINT;EXCEL;'),(34,2,2,'VIEW;PRINT;EXCEL;'),(35,2,2,'VIEW;PRINT;EXCEL;'),(36,2,2,'VIEW;PRINT;EXCEL;'),(50,2,2,''),(51,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(52,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(53,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(100,2,2,''),(102,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(103,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(105,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(106,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(108,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(109,2,2,'VIEW;DELETE;PRINT;EXCEL;'),(150,2,2,''),(151,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(152,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(153,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(200,2,2,''),(201,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(202,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(203,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(250,2,2,''),(252,2,2,'VIEW;PRINT;EXCEL;'),(253,2,2,'VIEW;PRINT;EXCEL;'),(254,2,2,'VIEW;PRINT;EXCEL;'),(256,2,2,'VIEW;PRINT;EXCEL;'),(257,2,2,'VIEW;PRINT;EXCEL;'),(258,2,2,'VIEW;PRINT;EXCEL;'),(261,2,2,'VIEW;PRINT;EXCEL;'),(262,2,2,'VIEW;PRINT;EXCEL;'),(263,2,2,'VIEW;PRINT;EXCEL;'),(266,2,2,'VIEW;PRINT;EXCEL;'),(267,2,2,'VIEW;PRINT;EXCEL;'),(268,2,2,'VIEW;PRINT;EXCEL;'),(271,2,2,'VIEW;PRINT;EXCEL;'),(272,2,2,'VIEW;PRINT;EXCEL;'),(273,2,2,'VIEW;PRINT;EXCEL;'),(274,2,2,'VIEW;PRINT;EXCEL;'),(300,2,2,''),(302,2,2,'VIEW;ADD;EDIT;PRINT;'),(303,2,2,'EDIT;'),(350,2,2,''),(351,2,2,'PROSES;'),(352,2,2,'PROSES;'),(353,2,2,'PROSES;'),(356,2,2,'VIEW;PRINT;'),(357,2,2,'VIEW;PRINT;'),(358,2,2,'VIEW;PRINT;'),(359,2,2,'VIEW;PRINT;'),(360,2,2,'VIEW;PRINT;'),(0,2,2,''),(120,2,2,''),(122,2,2,''),(123,2,2,''),(125,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(126,2,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(127,2,2,''),(128,2,2,'VIEW;'),(290,2,2,''),(291,2,2,''),(292,2,2,'VIEW;'),(293,2,2,''),(294,2,2,'VIEW;'),(400,2,2,''),(401,2,2,''),(402,2,2,''),(404,2,2,''),(405,2,2,''),(406,2,2,''),(407,2,2,''),(408,2,2,''),(409,2,2,''),(120,4,1,''),(122,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;'),(123,4,1,'VIEW;ADD;EDIT;DELETE;PRINT;'),(125,4,1,'VIEW;'),(126,4,1,'VIEW;'),(127,4,1,'VIEW;'),(128,4,1,'VIEW;'),(290,4,1,''),(291,4,1,'VIEW;'),(292,4,1,'VIEW;'),(293,4,1,'VIEW;'),(294,4,1,'VIEW;'),(400,4,1,''),(401,4,1,''),(402,4,1,''),(404,4,1,''),(405,4,1,''),(406,4,1,''),(407,4,1,''),(408,4,1,''),(409,4,1,''),(120,2,1,''),(122,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(123,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(125,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(126,2,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(127,2,1,'VIEW;'),(128,2,1,'VIEW;'),(290,2,1,''),(291,2,1,'VIEW;'),(292,2,1,'VIEW;'),(293,2,1,'VIEW;'),(294,2,1,'VIEW;'),(400,2,1,''),(401,2,1,'VIEW;'),(402,2,1,'VIEW;DELETE;'),(404,2,1,'VIEW;'),(405,2,1,'VIEW;DELETE;'),(406,2,1,'VIEW;DELETE;'),(407,2,1,'VIEW;DELETE;'),(408,2,1,'VIEW;'),(409,2,1,'VIEW;DELETE;'),(123,3,3,''),(122,3,3,''),(120,3,3,''),(120,2,3,''),(122,2,3,''),(123,2,3,''),(125,2,3,''),(126,2,3,''),(127,2,3,''),(128,2,3,''),(290,2,3,''),(291,2,3,''),(292,2,3,''),(293,2,3,''),(294,2,3,''),(400,2,3,''),(401,2,3,''),(402,2,3,''),(404,2,3,''),(405,2,3,''),(406,2,3,''),(407,2,3,''),(408,2,3,''),(409,2,3,''),(120,3,1,''),(122,3,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(123,3,1,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(125,3,1,'VIEW;'),(126,3,1,'VIEW;'),(127,3,1,'VIEW;'),(128,3,1,'VIEW;'),(290,3,1,''),(291,3,1,'VIEW;'),(292,3,1,'VIEW;'),(293,3,1,'VIEW;'),(294,3,1,'VIEW;'),(400,3,1,''),(401,3,1,''),(402,3,1,''),(404,3,1,''),(405,3,1,''),(406,3,1,''),(407,3,1,''),(408,3,1,''),(409,3,1,''),(120,3,2,''),(122,3,2,''),(123,3,2,''),(125,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(126,3,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(127,3,2,''),(128,3,2,'VIEW;'),(290,3,2,''),(291,3,2,''),(292,3,2,'VIEW;'),(293,3,2,''),(294,3,2,'VIEW;'),(400,3,2,''),(401,3,2,''),(402,3,2,''),(404,3,2,''),(405,3,2,''),(406,3,2,''),(407,3,2,''),(408,3,2,''),(409,3,2,''),(120,4,2,''),(122,4,2,''),(123,4,2,''),(125,4,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(126,4,2,'VIEW;ADD;EDIT;DELETE;PRINT;EXCEL;'),(127,4,2,''),(128,4,2,'VIEW;'),(290,4,2,''),(291,4,2,''),(292,4,2,'VIEW;'),(293,4,2,''),(294,4,2,'VIEW;'),(400,4,2,''),(401,4,2,''),(402,4,2,''),(404,4,2,''),(405,4,2,''),(406,4,2,''),(407,4,2,''),(408,4,2,''),(409,4,2,''),(125,3,3,''),(126,3,3,''),(127,3,3,''),(128,3,3,''),(290,3,3,''),(291,3,3,''),(292,3,3,''),(293,3,3,''),(294,3,3,''),(400,3,3,''),(401,3,3,''),(402,3,3,''),(404,3,3,''),(405,3,3,''),(406,3,3,''),(407,3,3,''),(408,3,3,''),(409,3,3,''),(120,4,3,''),(122,4,3,''),(123,4,3,''),(125,4,3,''),(126,4,3,''),(127,4,3,''),(128,4,3,''),(290,4,3,''),(291,4,3,''),(292,4,3,''),(293,4,3,''),(294,4,3,''),(400,4,3,''),(401,4,3,''),(402,4,3,''),(404,4,3,''),(405,4,3,''),(406,4,3,''),(407,4,3,''),(408,4,3,''),(409,4,3,''),(1,5,1,''),(2,5,1,'VIEW;'),(3,5,1,'VIEW;'),(4,5,1,''),(6,5,1,''),(30,5,1,''),(31,5,1,'VIEW;'),(32,5,1,'VIEW;'),(33,5,1,''),(34,5,1,'VIEW;'),(35,5,1,'VIEW;'),(36,5,1,''),(50,5,1,''),(51,5,1,'VIEW;'),(52,5,1,'VIEW;'),(53,5,1,''),(100,5,1,''),(102,5,1,'VIEW;'),(103,5,1,'VIEW;'),(105,5,1,'VIEW;'),(106,5,1,'VIEW;'),(108,5,1,''),(109,5,1,''),(120,5,1,''),(122,5,1,''),(123,5,1,''),(125,5,1,''),(126,5,1,''),(127,5,1,'VIEW;'),(128,5,1,'VIEW;'),(150,5,1,''),(151,5,1,'VIEW;'),(152,5,1,'VIEW;'),(153,5,1,''),(200,5,1,''),(201,5,1,'VIEW;'),(202,5,1,'VIEW;'),(203,5,1,''),(250,5,1,''),(252,5,1,'VIEW;'),(253,5,1,'VIEW;'),(254,5,1,''),(256,5,1,'VIEW;'),(257,5,1,'VIEW;'),(258,5,1,''),(266,5,1,'VIEW;'),(267,5,1,'VIEW;'),(268,5,1,''),(271,5,1,'VIEW;'),(272,5,1,'VIEW;'),(273,5,1,''),(274,5,1,''),(290,5,1,''),(291,5,1,'VIEW;'),(292,5,1,'VIEW;'),(293,5,1,'VIEW;'),(294,5,1,'VIEW;'),(300,5,1,''),(302,5,1,''),(303,5,1,''),(350,5,1,''),(351,5,1,''),(352,5,1,''),(353,5,1,''),(356,5,1,''),(357,5,1,''),(359,5,1,''),(400,5,1,''),(401,5,1,''),(402,5,1,''),(404,5,1,''),(405,5,1,''),(406,5,1,''),(407,5,1,''),(408,5,1,''),(409,5,1,''),(0,5,1,''),(1,5,2,''),(2,5,2,'VIEW;'),(3,5,2,'VIEW;'),(4,5,2,'VIEW;'),(6,5,2,''),(30,5,2,''),(31,5,2,''),(32,5,2,'VIEW;'),(33,5,2,'VIEW;'),(34,5,2,''),(35,5,2,'VIEW;'),(36,5,2,'VIEW;'),(50,5,2,''),(51,5,2,''),(52,5,2,'VIEW;'),(53,5,2,'VIEW;'),(100,5,2,''),(102,5,2,''),(103,5,2,''),(105,5,2,'VIEW;'),(106,5,2,'VIEW;'),(108,5,2,'VIEW;'),(109,5,2,'VIEW;'),(120,5,2,''),(122,5,2,''),(123,5,2,''),(125,5,2,'VIEW;'),(126,5,2,'VIEW;'),(127,5,2,''),(128,5,2,'VIEW;'),(150,5,2,''),(151,5,2,''),(152,5,2,'VIEW;'),(153,5,2,'VIEW;'),(200,5,2,''),(201,5,2,''),(202,5,2,'VIEW;'),(203,5,2,'VIEW;'),(250,5,2,''),(252,5,2,''),(253,5,2,'VIEW;'),(254,5,2,'VIEW;'),(256,5,2,''),(257,5,2,'VIEW;'),(258,5,2,'VIEW;'),(266,5,2,''),(267,5,2,'VIEW;'),(268,5,2,''),(271,5,2,''),(272,5,2,'VIEW;'),(273,5,2,''),(274,5,2,''),(290,5,2,''),(291,5,2,''),(292,5,2,'VIEW;'),(293,5,2,''),(294,5,2,'VIEW;'),(300,5,2,''),(302,5,2,''),(303,5,2,''),(350,5,2,''),(351,5,2,''),(352,5,2,''),(353,5,2,''),(356,5,2,''),(357,5,2,''),(359,5,2,''),(400,5,2,''),(401,5,2,''),(402,5,2,''),(404,5,2,''),(405,5,2,''),(406,5,2,''),(407,5,2,''),(408,5,2,''),(409,5,2,''),(0,5,2,''),(1,5,3,''),(2,5,3,''),(3,5,3,''),(4,5,3,'VIEW;'),(6,5,3,''),(30,5,3,''),(31,5,3,''),(32,5,3,''),(33,5,3,'VIEW;'),(34,5,3,''),(35,5,3,''),(36,5,3,'VIEW;'),(50,5,3,''),(51,5,3,''),(52,5,3,''),(53,5,3,'VIEW;'),(100,5,3,''),(102,5,3,''),(103,5,3,''),(105,5,3,''),(106,5,3,''),(108,5,3,'VIEW;'),(109,5,3,'VIEW;'),(120,5,3,''),(122,5,3,''),(123,5,3,''),(125,5,3,''),(126,5,3,''),(127,5,3,''),(128,5,3,''),(150,5,3,''),(151,5,3,''),(152,5,3,''),(153,5,3,'VIEW;'),(200,5,3,''),(201,5,3,''),(202,5,3,''),(203,5,3,'VIEW;'),(250,5,3,''),(252,5,3,''),(253,5,3,''),(254,5,3,'VIEW;'),(256,5,3,''),(257,5,3,''),(258,5,3,'VIEW;'),(266,5,3,''),(267,5,3,''),(268,5,3,'VIEW;'),(271,5,3,''),(272,5,3,''),(273,5,3,'VIEW;'),(274,5,3,''),(290,5,3,''),(291,5,3,''),(292,5,3,''),(293,5,3,''),(294,5,3,''),(300,5,3,''),(302,5,3,''),(303,5,3,''),(350,5,3,''),(351,5,3,''),(352,5,3,''),(353,5,3,''),(356,5,3,''),(357,5,3,''),(359,5,3,''),(400,5,3,''),(401,5,3,''),(402,5,3,''),(404,5,3,''),(405,5,3,''),(406,5,3,''),(407,5,3,''),(408,5,3,''),(409,5,3,''),(0,5,3,''),(7,5,3,'VIEW;');
/*!40000 ALTER TABLE `tbl_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_group_level`
--

DROP TABLE IF EXISTS `tbl_group_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_group_level` (
  `level_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(40) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_group_level`
--

LOCK TABLES `tbl_group_level` WRITE;
/*!40000 ALTER TABLE `tbl_group_level` DISABLE KEYS */;
INSERT INTO `tbl_group_level` VALUES (1,'Superadmin',100),(2,'Administrator',90),(3,'Pimpinan',80),(4,'Staff/Operator',10),(5,'Guest',5);
/*!40000 ALTER TABLE `tbl_group_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_group_user`
--

DROP TABLE IF EXISTS `tbl_group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_group_user` (
  `group_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `app_type` enum('KL','E1','E2') DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_group_user`
--

LOCK TABLES `tbl_group_user` WRITE;
/*!40000 ALTER TABLE `tbl_group_user` DISABLE KEYS */;
INSERT INTO `tbl_group_user` VALUES (1,'Tingkat Kementerian','KL',9),(2,'Tingkat Eselon 1','E1',8),(3,'Tingkat Eselon 2','E2',7),(7,'SuperAdmin',NULL,100);
/*!40000 ALTER TABLE `tbl_group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ikk`
--

DROP TABLE IF EXISTS `tbl_ikk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ikk` (
  `tahun` year(4) NOT NULL,
  `kode_ikk` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `satuan` varchar(40) NOT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `kode_e2` varchar(10) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `kode_sasaran_e2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_ikk`,`tahun`),
  KEY `FK_tbl_ikk_e2` (`kode_e2`),
  KEY `FK_tbl_ikk_iku_e1` (`kode_iku_e1`),
  CONSTRAINT `tbl_ikk_ibfk_1` FOREIGN KEY (`kode_e2`) REFERENCES `tbl_eselon2` (`kode_e2`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_ikk_ibfk_2` FOREIGN KEY (`kode_iku_e1`) REFERENCES `tbl_iku_eselon1` (`kode_iku_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ikk`
--

LOCK TABLES `tbl_ikk` WRITE;
/*!40000 ALTER TABLE `tbl_ikk` DISABLE KEYS */;
INSERT INTO `tbl_ikk` VALUES (2013,'IKKSSDKPLP.02.02','Jumlah kejadian kecelakaan yang disebabkan oleh alam ','%','IKUSSPL01.02','022.04.06','138;2013-10-22 08:45:48',NULL,'SSDKPLP.02'),(2013,'IKKSSDKPLP.02.04','Terpenuhinya tingkat keandalan dan kecukupan sarana dan prasarana','unit','IKUSSPL02.01','022.04.06','138;2013-10-22 08:50:18','138;2013-10-22 09:16:53','SSDKPLP.02'),(2013,'IKKSSDKPLP.02.05','Jumlahkejadian jenis perampokan dan pencurian pada transportasi laut','%',NULL,'022.04.06','138;2013-10-22 09:53:03',NULL,'SSDKPLP.02'),(2013,'IKKSSDKPLP.02.06','Penurunan tingkat kejadian kecelakaan oleh manusia','%','IKUSSPL01.01','022.04.06','138;2013-10-22 08:43:07','138;2013-10-22 09:54:09','SSDKPLP.02'),(2013,'IKKSSDKPLP.03.03','Pelaksanaaan diklat teknis dan fungsional','org','IKUSSPL08.04','022.04.06','138;2013-10-22 09:33:04','138;2013-10-22 09:34:17','SSDKPLP.03'),(2013,'IKKSSDKPLP.03.05','Pelaksanaan diklat tenaga penanggulangan pencemaran','org','IKUSSPL08.06','022.04.06','138;2013-10-22 09:36:05',NULL,'SSDKPLP.03'),(2013,'IKKSSDKPLP.03.06','Pelaksanaan diklat pemadam kebakaran ','org','IKUSSPL08.07','022.04.06','138;2013-10-22 09:36:45',NULL,'SSDKPLP.03'),(2013,'IKKSSDKPLP.03.07','Pelaksanaaan diklat penyelam','org','IKUSSPL08.08','022.04.06','138;2013-10-22 09:37:19',NULL,'SSDKPLP.03'),(2013,'IKKSSDKPLP.03.08','Pelaksanaan diklat PPNS ','org','IKUSSPL08.02','022.04.06','138;2013-10-22 09:31:49','138;2013-10-22 09:57:56','SSDKPLP.03'),(2013,'IKKSSDKPLP.03.10','Pelaksaan diklat teknis dan fungsional','org','IKUSSPL08.04','022.04.06','138;2013-10-22 09:34:58','138;2013-10-22 09:59:54','SSDKPLP.03'),(2013,'IKKSSDKPLP.04.01','Pengadaaan Peralatan ','paket',NULL,'022.04.06','138;2013-10-22 09:48:14',NULL,'SSDKPLP.04'),(2013,'IKKSSDPK.01.01','Jumlah pelabuhan yang diusahakan secara komersial yang memenuhi standar kinerja','lokasi pelabuhan','IKUSSPL02.01','022.04.04','137;2013-10-22 06:40:41',NULL,'SSDPK.01'),(2013,'IKKSSDPK.01.02','Jumlah pelabuhan yang diselenggarakan oleh Pemerintah/UPP yang meningkat kinerja operasionalnya','lokasi pelabuhan','IKUSSPL02.01','022.04.04','137;2013-10-22 06:42:31',NULL,'SSDPK.01'),(2012,'IKKSSSDPL.01.01','Jumlah penyelenggaraan Diklat dan Bimtek terkait  administrasi dan kepegawaian ','diklat / bimtek','IKUSSPL08.04','022.04.01','8;2013-12-04 14:17:28',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.02','Jumlah penyelenggaraan Diklat dan Bimtek terkait pengelolaan keuangan','diklat / bimtek','IKUSSPL09.03','022.04.01','8;2013-12-04 14:21:42',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.03','Jumlah penyelenggaraan Diklat dan Bimtek terkait kelembagaan','diklat / bimtek','IKUSSPL07.01','022.04.01','8;2013-12-04 14:25:05',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.04','Jumlah penyelenggaraan Diklat dan Bimtek Bidang  Lalu Lintas dan Angkutan Laut','diklat / bimtek','IKUSSPL03.01','022.04.01','8;2013-12-04 14:29:08',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.05','Jumlah penyelenggaraan Diklat dan Bimtek  Bidang perkapalan dan kepelautan','diklat / bimtek','IKUSSPL08.03','022.04.01','8;2013-12-04 14:32:01',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.06','Jumlah penyelenggaraan Diklat dan Bimtek Bidang kenavigasian','diklat / bimtek','IKUSSPL08.04','022.04.01','8;2013-12-04 14:33:46',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.07','Jumlah penyelenggaraan Diklat dan Bimtek Bidang KPLP yg dilaksanakan','diklat / bimtek','IKUSSPL08.01','022.04.01','8;2013-12-04 14:37:33',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.08','Jumlah pembinaan, penyuluhan dan sosialisasi dalam rangka kepangkatan pegawai dan peningkatan kualitas serta disiplin pegawai','laporan','IKUSSPL08.04','022.04.01','8;2013-12-04 14:41:49',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.09','Jumlah pembinaan, penyuluhan dan  sosialisasi terkait SDM serta pengelolaan keuangan serta BMN','kegiatan','IKUSSPL09.04','022.04.01','8;2013-12-04 14:43:13',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.10','Jumlah pembinaan, penyuluhan dan sosialisasi terkait kelembagaan dan perencanaan','laporan','IKUSSPL07.01','022.04.01','8;2013-12-04 14:44:56',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.11','Jumlah pembinaan, penyuluhan dan sosialisasi di bidang Kepelabuhan dan Pengerukan ','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 14:46:48',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.12','Jumlah pembinaan, penyuluhan dan sosialisasi  bidang perkapalan dan kepelautan','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 14:47:42',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.13','Jumlah pembinaan, penyuluhan dan sosialisasi / workshop bidang KPLP ','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 14:49:07',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.14','Jumlah pertemuan dan rapat koordinasi dengan seluruh unit kerja di lingkungan Ditjen Hubla','laporan','IKUSSPL08.04','022.04.01','8;2013-12-04 14:50:07',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.15','Jumlah pertemuan dan rapat koordinasi terkait pegawai dan pengelolaan anggaran','laporan','IKUSSPL09.03','022.04.01','8;2013-12-04 14:51:20',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.16','Jumlah pertemuan dan rapat koordinasi di bidang Lalu Lintas dan Angkutan Laut','laporan','IKUSSPL03.01','022.04.01','8;2013-12-04 14:53:30',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.17','Jumlah pertemuan dan rapat koordinasi di bidang Kepelabuhanan dan Pengerukan','laporan',NULL,'022.04.01','8;2013-12-04 14:57:35',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.18','Jumlah pertemuan dan rapat koordinasi di bidang Perkapalan dan Kepelautan','laporan',NULL,'022.04.01','8;2013-12-04 14:58:59',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.19','Jumlah pertemuan dan rapat koordinasi di bidang Kenavigasian','laporan pertemuan',NULL,'022.04.01','8;2013-12-04 14:59:43',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.20','Jumlah pertemuan dan rapat koordinasi di bidang KPLP','laporan',NULL,'022.04.01','8;2013-12-04 15:00:32',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.21','Jumlah aplikasi yang terbangun terkait pengelolaan anggaran','aplikasi','IKUSSPL09.03','022.04.01','8;2013-12-04 15:01:29',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.22','Jumlah aplikasi yang terbangun terkait perencanaan ','aplikasi','IKUSSPL07.01','022.04.01','8;2013-12-04 15:04:24',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.23','Jumlah aplikasi yang terbangun dalam rangka peningkatan pelayanan bidang Lalu Lintas dan Angkutan Laut','aplikasi','IKUSSPL03.01','022.04.01','8;2013-12-04 15:05:08',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.24','Jumlah aplikasi yang terbangun dalam rangka peningkatan pelayanan Perkapalan dan Kepelautan','aplikasi','IKUSSPL06.02','022.04.01','8;2013-12-04 15:06:20',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.25','Jumlah aplikasi yang terbangun dalam rangka peningkatan pelayanan Kenavigasian','aplikasi','IKUSSPL03.01','022.04.01','8;2013-12-04 15:06:59',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.26','Jumlah  waktu beroperasionalnya  Peralatan Tracking System Pelayaran Perintis','aplikasi','IKUSSPL03.01','022.04.01','8;2013-12-04 15:10:57',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.01.27','Jumlah  waktu beroperasionalnya RMCS terkait kenavigasian','tahun','IKUSSPL03.01','022.04.01','8;2013-12-04 15:12:04',NULL,'SSSDPL.01'),(2012,'IKKSSSDPL.02.01','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang kepegawaian','laporan','IKUSSPL08.04','022.04.01','8;2013-12-04 15:25:26',NULL,'SSSDPL.02'),(2013,'IKKSSSDPL.02.01','Terpenuhinya kebutuhan laporan terkait adminisitrasi dan teknis','Laporan','IKUSSPL02.01','022.04.01','136;2013-10-22 08:37:49',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.02','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang keuangan','laporan','IKUSSPL09.03','022.04.01','8;2013-12-04 15:26:32',NULL,'SSSDPL.02'),(2013,'IKKSSSDPL.02.02','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang kepegawaian ','6 Laporan','IKUSSPL02.01','022.04.01','136;2013-10-22 08:39:02',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.03','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang perencanaan','laporan','IKUSSPL06.01','022.04.01','8;2013-12-04 15:28:10',NULL,'SSSDPL.02'),(2013,'IKKSSSDPL.02.03','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang perencanaan','6 Laporan','IKUSSPL02.01','022.04.01','136;2013-10-22 08:54:28',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.04','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang angkutan laut','laporan','IKUSSPL07.01','022.04.01','8;2013-12-04 15:29:07',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.05','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang kepelabuhanan dan pengerukan','laporan','IKUSSPL06.03','022.04.01','8;2013-12-04 15:30:29',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.06','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang perkapalan dan kepelautan','laporan','IKUSSPL07.01','022.04.01','8;2013-12-04 15:31:27',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.07','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang kenavigasian','laporan','IKUSSPL03.01','022.04.01','8;2013-12-04 15:32:30',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.08','Jumlah dokumen yang disusun untuk memenuhi kebutuhan administrasi dan teknis di bidang KPLP ','laporan',NULL,'022.04.01','8;2013-12-04 15:33:05',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.09','Jumlah studi dan kajian  yang disusun terkait fasilitas pelabuhan','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 15:36:36',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.10','Jumlah pedoman/standard yang disusun di bidang Kepelabuhanan ','pedoman/standard','IKUSSPL07.01','022.04.01','8;2013-12-04 15:38:12',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.11','Jumlah Protap yang disusun KPLP terkait keselamatan pelayaran','jenis Proptap',NULL,'022.04.01','8;2013-12-04 15:38:59',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.12','Jumlah laporan evaluasi dan monitoring yang disusun terkait pengelolaan dan penggunaan anggaran','laporan','IKUSSPL09.03','022.04.01','8;2013-12-04 15:39:54',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.13','Jumlah laporan evaluasi dan monitoring yang disusun terkait pelaksanaan pembangunan','laporan','IKUSSPL07.01','022.04.01','8;2013-12-04 15:41:42',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.14','Jumlah laporan evaluasi dan monitoring yang disusun terkait penyelenggaraan Kepelabuhan dan Pengerukan','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 15:42:33',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.15','Jumlah laporan evaluasi dan monitoring yang disusun terkait penyelenggaraan perkapalan dan kepelautan','laporan','IKUSSPL07.01','022.04.01','8;2013-12-04 15:43:32',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.16','Jumlah laporan evaluasi dan monitoring yang disusun terkait terkait penyelenggaraan kenavigasian','laporan','IKUSSPL07.01','022.04.01','8;2013-12-04 15:44:17',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.17','Jumlah laporan evaluasi dan monitoring yang disusun terkait terkait penyelenggaraan Kesatuan Penjagaan Laut dan Pantai  ','laporan',NULL,'022.04.01','8;2013-12-04 15:45:40',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.18','Jumlah gedung kantor yang fungsinya terpulihkan ','laporan','IKUSSPL10.01','022.04.01','8;2013-12-04 15:47:00',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.19','Jumlah waktu terpulihkannya fungsi peralatan/ perlengkapan kantor','tahun','IKUSSPL10.01','022.04.01','8;2013-12-04 15:47:53',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.20','Jumlah waktu terpulihkannya fungsi kendaraan bermotor untuk mendukung pelayanan administrasi dan operasional','tahun','IKUSSPL10.01','022.04.01','8;2013-12-04 15:48:52',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.21','Jumlah waktu terpenuhinya kebutuhan peralatan/perlengkapan kantor','tahun','IKUSSPL10.01','022.04.01','8;2013-12-04 15:49:22',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.22','Jumlah waktu terpenuhinya kebutuhan administrasi dan inventaris perkantoran','tahun','IKUSSPL10.01','022.04.01','8;2013-12-04 15:49:53',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.02.23','Jumlah tempat pelayanan yang meningkat kinerjanya dengan pengadaan sarana dan infrastruktur pelayanan satu atap','lokasi','IKUSSPL07.01','022.04.01','8;2013-12-04 15:50:48',NULL,'SSSDPL.02'),(2012,'IKKSSSDPL.03.01','Jumlah penyelenggaraan kegiatan delegasi /misi /tamu/ pers','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 15:52:12',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.02','Jumlah penyelenggaraan kegiatan peliputan berita','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 15:53:12',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.03','Jumlah penyelenggaraan kegiatan penyampaian informasi kepada masyarakat mengenai perhubungan laut','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 15:54:13',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.04','Jumlah penyelenggaraan kegiatan terkait hukum dan perkara','laporan','IKUSSPL07.01','022.04.01','8;2013-12-04 15:55:07',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.05','Jumlah penyelenggaraan kegiatan pertemuan dan kerjasama internasional','laporan','IKUSSPL04.05','022.04.01','8;2013-12-04 15:57:18',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.06','Jumlah laporan pelaksanaan sosialisasi peraturan-peraturan','sosialisasi','IKUSSPL06.02','022.04.01','8;2013-12-04 15:58:11',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.07','Jumlah RPP yang disusun','RPP',NULL,'022.04.01','8;2013-12-04 15:58:55',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.08','Jumlah RPM yang disusun','RPM',NULL,'022.04.01','8;2013-12-04 15:59:32',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.09','Jumlah Rancangan Keputusan Dirjen yang disusun','Rancangan Keputusan Dirjen','IKUSSPL07.01','022.04.01','8;2013-12-04 16:00:36',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.03.10','Jumlah dokumen peraturan yang tersusun','Dokumen Peraturan','IKUSSPL07.01','022.04.01','8;2013-12-04 16:01:23',NULL,'SSSDPL.03'),(2012,'IKKSSSDPL.04.01','Jumlah Protap yang disusun terkait perlindungan  lingkungan maritim','Protap',NULL,'022.04.01','8;2013-12-04 16:02:33',NULL,'SSSDPL.04'),(2012,'IKKSSSDPL.04.02','Jumlah pelaksanaan diklat   terkait perlindungan lingkungan maritim','Jenis diklat',NULL,'022.04.01','8;2013-12-04 16:03:10',NULL,'SSSDPL.04'),(2012,'IKKSSSDPL.04.03','Jumlah sosialisasi/uji petik terkait perlindungan lingkungan maritim ','laporan','IKUSSPL06.02','022.04.01','8;2013-12-04 16:04:04',NULL,'SSSDPL.04'),(2012,'IKKSSSDPL.04.04','Terwujudnya peningkatan pemahaman UPT terkait pencegahan pencemaran','laporan','IKUSSPL08.07','022.04.01','8;2013-12-04 16:04:39',NULL,'SSSDPL.04'),(2012,'IKKSSSDPL.04.05','Jumlah laporan pelaksanaan penyusunan dokumen lingkungan','laporan',NULL,'022.04.01','8;2013-12-04 16:05:36',NULL,'SSSDPL.04');
/*!40000 ALTER TABLE `tbl_ikk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ikk_log`
--

DROP TABLE IF EXISTS `tbl_ikk_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ikk_log` (
  `tahun` year(4) DEFAULT NULL,
  `kode_ikk` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `satuan` varchar(40) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `kode_e2` varchar(10) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ikk_log`
--

LOCK TABLES `tbl_ikk_log` WRITE;
/*!40000 ALTER TABLE `tbl_ikk_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ikk_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_iku_eselon1`
--

DROP TABLE IF EXISTS `tbl_iku_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_iku_eselon1` (
  `kode_e1` varchar(10) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kode_iku_e1` varchar(20) NOT NULL,
  `kode_iku_kl` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `satuan` varchar(40) NOT NULL,
  `kode_e2` varchar(10) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_iku_e1`,`tahun`),
  KEY `FK_tbl_iku_eselon1` (`kode_e1`),
  KEY `FK_tbl_iku_eselon1_iku_kl` (`kode_iku_kl`),
  KEY `FK_tbl_iku_eselon1_e2` (`kode_e2`),
  KEY `kode_e2_2` (`kode_e2`),
  CONSTRAINT `tbl_iku_eselon1_ibfk_1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_iku_eselon1`
--

LOCK TABLES `tbl_iku_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_iku_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_iku_eselon1` VALUES ('022.04',2012,'IKUSSPL01.01','IKUSSKP01.01','Jumlah kejadian kecelakaan yang disebabkan oleh manusia','Kejadian Kecelakaan',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL01.01','IKUSSKP01.01','Jumlah kejadian kecelakaan yang disebabkan oleh manusia','Kejadian Kecelakaan',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL01.02','IKUSSKP01.01','Jumlah kejadian kecelakaan yang disebabkan oleh teknis dan lain-lain','Kejadian Kecelakaan',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL01.02','IKUSSKP01.01','Jumlah kejadian kecelakaan yang disebabkan oleh teknis dan lain-lain','Kejadian Kecelakaan',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL02.01','IKUSSKP04.01','Jumlah kapal yang memiliki sertifikat kelaiklautan kapal','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL02.01','IKUSSKP04.01','Jumlah kapal yang memiliki sertifikat kelaiklautan kapal','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL03.01','IKUSSKP05.01','Jumlah rute perintis yang dilayani transportasi laut','Rute Perintis',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL03.01','IKUSSKP05.01','Jumlah rute perintis yang dilayani transportasi laut','Rute Perintis',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL03.02',NULL,'Jumlah pelabuhan yang dapat menghubungkan daerah-daerah terpencil, terluar, daerah perbatasan, daerah belum berkembang dan daerah telah berkembang','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL03.02',NULL,'Jumlah pelabuhan yang dapat menghubungkan daerah-daerah terpencil, terluar, daerah perbatasan, daerah belum berkembang dan daerah telah berkembang','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL04.01','IKUSSKP07.01','Jumlah penumpang transportasi laut yang terangkut','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL04.01','IKUSSKP07.01','Jumlah penumpang transportasi laut yang terangkut','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL04.02','IKUSSKP07.01','Jumlah penumpang angkutan laut perintis','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL04.02','IKUSSKP07.01','Jumlah penumpang angkutan laut perintis','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL04.03','IKUSSKP07.02','Jumlah muatan angkutan laut dalam negeri yang diangkut oleh kapal nasional','Ton',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL04.03','IKUSSKP07.02','Jumlah muatan angkutan laut dalam negeri yang diangkut oleh kapal nasional','Ton',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL04.04',NULL,'Persentase pangsa muatan angkutan laut dalam negeri yang diangkut oleh kapal nasional','%',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL04.04',NULL,'Persentase pangsa muatan angkutan laut dalam negeri yang diangkut oleh kapal nasional','%',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL04.05','IKUSSKP07.02','Jumlah muatan angkutan laut luar negeri yang diangkut oleh kapal nasional','Ton',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL04.05','IKUSSKP07.02','Jumlah muatan angkutan laut luar negeri yang diangkut oleh kapal nasional','Ton',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL04.06',NULL,'Persentase pangsa muatan angkutan laut luar negeri yang diangkut oleh kapal nasional','%',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL04.06',NULL,'Persentase pangsa muatan angkutan laut luar negeri yang diangkut oleh kapal nasional','%',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL05.01',NULL,'Penurunan Turn-Around Time (TRT) di pelabuhan yang diusahakan','Menit',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL05.01',NULL,'Penurunan Turn-Around Time (TRT) di pelabuhan yang diusahakan','Menit',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL06.01','IKUSSKP03.01','Jumlah pelabuhan mempunyai pencapaian Waiting Time (WT) sesuai SK Dirjen yang belaku terkait Standar Kinerja Pelayanan Operasional Pelabuhan','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL06.01','IKUSSKP03.01','Jumlah pelabuhan mempunyai pencapaian Waiting Time (WT) sesuai SK Dirjen yang belaku terkait Standar Kinerja Pelayanan Operasional Pelabuhan','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL06.02','IKUSSKP03.01','Jumlah pelabuhan mempunyai pencapaian approach time (AT) sesuai SK Dirjen yang berlaku terkait Standar Kinerja Pelayanan Operasional Pelabuhan','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL06.02','IKUSSKP03.01','Jumlah pelabuhan mempunyai pencapaian approach time (AT) sesuai SK Dirjen yang berlaku terkait Standar Kinerja Pelayanan Operasional Pelabuhan','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL06.03','IKUSSKP03.01','Jumlah pelabuhan mempunyai pencapaian Waktu Efektif (Effective Time/ET) sesuai SK Dirjen yang berlaku terkait Standar Kinerja Pelayanan Operasional Pelabuhan','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL06.03','IKUSSKP03.01','Jumlah pelabuhan mempunyai pencapaian Waktu Efektif (Effective Time/ET) sesuai SK Dirjen yang berlaku terkait Standar Kinerja Pelayanan Operasional Pelabuhan','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL07.01','IKUSSKP08.01','Jumlah MOU, perizinan, konstruksi, dan operasional kerjasama pemerintah dengan Pemda dan Swasta di bidang transportasi laut','Dokumen',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL07.01','IKUSSKP08.01','Jumlah MOU, perizinan, konstruksi, dan operasional kerjasama pemerintah dengan Pemda dan Swasta di bidang transportasi laut','Dokumen',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.01','IKUSSKP10.02','Jumlah kebutuhan tenaga Marine Inspector A','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.01','IKUSSKP10.02','Jumlah kebutuhan tenaga Marine Inspector A','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.02','IKUSSKP10.02','Jumlah kebutuhan tenaga Marine Inspector B','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.02','IKUSSKP10.02','Jumlah kebutuhan tenaga Marine Inspector B','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.03','IKUSSKP10.02','Jumlah kebutuhan tenaga PPNS','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.03','IKUSSKP10.02','Jumlah kebutuhan tenaga PPNS','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.04','IKUSSKP10.02','Jumlah tenaga PPNS','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.04','IKUSSKP10.02','Jumlah tenaga PPNS','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.05','IKUSSKP10.02','Jumlah kebutuhan tenaga kesyahbandaran kelas A','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.05','IKUSSKP10.02','Jumlah kebutuhan tenaga kesyahbandaran kelas A','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.06','IKUSSKP10.02','Jumlah kebutuhan tenaga kesyahbandaran kelas B','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.06','IKUSSKP10.02','Jumlah kebutuhan tenaga kesyahbandaran kelas B','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.07','IKUSSKP10.02','Jumlah kebutuhan tenaga penanggulangan pencemaran','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.07','IKUSSKP10.02','Jumlah kebutuhan tenaga penanggulangan pencemaran','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.08','IKUSSKP10.02','Jumlah kebutuhan tenaga penanggulangan kebakaran','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.08','IKUSSKP10.02','Jumlah kebutuhan tenaga penanggulangan kebakaran','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL08.09','IKUSSKP10.02','Jumlah kebutuhan tenaga penyelam','Orang',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL08.09','IKUSSKP10.02','Jumlah kebutuhan tenaga penyelam','Orang',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL09.01',NULL,'Nilai AKIP Direktorat Jenderal Perhubungan Laut','Nilai',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL09.01',NULL,'Nilai AKIP Direktorat Jenderal Perhubungan Laut','Nilai',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL09.02',NULL,'Jumlah realisasi pendapatan Direktorat Jenderal Perhubungan Laut','Rp.',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL09.02',NULL,'Jumlah realisasi pendapatan Direktorat Jenderal Perhubungan Laut','Rp.',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL09.03',NULL,'Jumlah realisasi belanja anggaran Direktorat Jenderal Perhubungan Laut','Rp.',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL09.03',NULL,'Jumlah realisasi belanja anggaran Direktorat Jenderal Perhubungan Laut','Rp.',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL09.04','IKUSSKP09.03','Nilai BMN pada neraca Direktorat Jenderal Perhubungan Laut','Rp.',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL09.04','IKUSSKP09.03','Nilai BMN pada neraca Direktorat Jenderal Perhubungan Laut','Rp.',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL10.01',NULL,'Jumlah penyelesaian regulasi','Regulasi',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL10.01',NULL,'Jumlah penyelesaian regulasi','Regulasi',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL11.01','IKUSSKP12.02','Jumlah penurunan emisi gas buang (CO2) transportasi laut','Mega Ton',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL11.01','IKUSSKP12.02','Jumlah penurunan emisi gas buang (CO2) transportasi laut','Mega Ton',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL12.01','IKUSSKP13.02','Jumlah pelabuhan yang menerapkan Eco-Port (penanganan sampah dan kebersihan lingkungan pelabuhan)','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL12.01','IKUSSKP13.02','Jumlah pelabuhan yang menerapkan Eco-Port (penanganan sampah dan kebersihan lingkungan pelabuhan)','Pelabuhan',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL12.02','IKUSSKP13.01','Jumlah pemilikan sertifikat IOPP (International Oil Polution Prevention)','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL12.02','IKUSSKP13.01','Jumlah pemilikan sertifikat IOPP (International Oil Polution Prevention)','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL12.03','IKUSSKP13.01','Jumlah pemilikan SNPP (Sertifikat Nasional Pencegahan Pencemaran)','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL12.03','IKUSSKP13.01','Jumlah pemilikan SNPP (Sertifikat Nasional Pencegahan Pencemaran)','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL12.04','IKUSSKP13.01','Jumlah pemilikan sertifikat bahan cair beracun (Noxius Liquid Substance)','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL12.04','IKUSSKP13.01','Jumlah pemilikan sertifikat bahan cair beracun (Noxius Liquid Substance)','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2012,'IKUSSPL12.05','IKUSSKP13.01','Jumlah pemilikan sertifikat ISPP (International Sewage Pollution Prevention)','Sertifikat',NULL,NULL,NULL,NULL),('022.04',2013,'IKUSSPL12.05','IKUSSKP13.01','Jumlah pemilikan sertifikat ISPP (International Sewage Pollution Prevention)','Sertifikat',NULL,NULL,NULL,'');
/*!40000 ALTER TABLE `tbl_iku_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_iku_eselon1_log`
--

DROP TABLE IF EXISTS `tbl_iku_eselon1_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_iku_eselon1_log` (
  `kode_e1` varchar(10) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `kode_iku_kl` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `satuan` varchar(40) DEFAULT NULL,
  `kode_e2` varchar(10) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_iku_eselon1_log`
--

LOCK TABLES `tbl_iku_eselon1_log` WRITE;
/*!40000 ALTER TABLE `tbl_iku_eselon1_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_iku_eselon1_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_iku_kl`
--

DROP TABLE IF EXISTS `tbl_iku_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_iku_kl` (
  `kode_kl` varchar(10) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kode_iku_kl` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `satuan` varchar(40) NOT NULL,
  `kode_e1` varchar(10) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `kode_sasaran_kl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_iku_kl`,`tahun`),
  KEY `FK_tbl_iku_kl` (`kode_kl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_iku_kl`
--

LOCK TABLES `tbl_iku_kl` WRITE;
/*!40000 ALTER TABLE `tbl_iku_kl` DISABLE KEYS */;
INSERT INTO `tbl_iku_kl` VALUES ('022',2012,'IKUSSKP01.01','Jumlah kejadian kecelakaan transportasi nasional yang disebabkan oleh faktor yang terkait dengan kewenangan Kementerian Perhubungan','Kejadian/Tahun',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP01.01','Jumlah kejadian kecelakaan transportasi nasional yang disebabkan oleh faktor yang terkait dengan kewenangan Kementerian Perhubungan','Kejadian/Tahun',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP02.01','Jumlah gangguan keamanan pada sektor transportasi oleh faktor yang terkait dengan kewenangan Kementerian Perhubungan','Kejadian/Tahun',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP02.01','Jumlah gangguan keamanan pada sektor transportasi oleh faktor yang terkait dengan kewenangan Kementerian Perhubungan','Kejadian/Tahun',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP03.01','Rata-rata persentase pencapaian On-Time Performance (OTP) sektor transportasi (selain transportasi darat)','%',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP03.01','Rata-rata persentase pencapaian On-Time Performance (OTP) sektor transportasi (selain transportasi darat)','%',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP04.01','Jumlah sarana transportasi yang sudah tersertifikasi','Unit',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP04.01','Jumlah sarana transportasi yang sudah tersertifikasi','Unit',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP04.02','Jumlah prasarana transportasi yang sudah tersertifikasi','Unit',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP04.02','Jumlah prasarana transportasi yang sudah tersertifikasi','Unit',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP05.01','Jumlah lintas pelayanan angkutan perintis dan subsidi','Lintas',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP05.01','Jumlah lintas pelayanan angkutan perintis dan subsidi','Lintas',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP06.01','Kontribusi sektor transportasi terhadap pertumbuhan ekonomi nasional','%',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP06.01','Kontribusi sektor transportasi terhadap pertumbuhan ekonomi nasional','%',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP07.01','Total produksi angkutan penumpang','Penumpang/Tahun',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP07.01','Total produksi angkutan penumpang','Penumpang/Tahun',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP07.02','Total produksi angkutan barang','Ton/Tahun',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP07.02','Total produksi angkutan barang','Ton/Tahun',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP08.01','Jumlah infrastruktur transportasi yang siap ditawarkan melalui kerjasama Pemerintah-Swasta','Jumlah Proyek yang Siap Ditawarkan Melal',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP08.01','Jumlah infrastruktur transportasi yang siap ditawarkan melalui kerjasama Pemerintah-Swasta','Jumlah Proyek yang Siap Ditawarkan Melal',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP09.01','Nilai AKIP Kementerian Perhubungan','Nilai',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP09.01','Nilai AKIP Kementerian Perhubungan','Nilai',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP09.02','Opini BPK atas laporan keuangan Kementerian Perhubungan','Opini',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP09.02','Opini BPK atas laporan keuangan Kementerian Perhubungan','Opini',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP09.03','Nilai aset negara yang berhasil diinventarisasi sesuai kaidah pengelolaan BMN','Rp Trilliun',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP09.03','Nilai aset negara yang berhasil diinventarisasi sesuai kaidah pengelolaan BMN','Rp Trilliun',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP10.01','Jumlah SDM operator prasarana dan sarana transportasi yang telah memiliki sertifikat','Orang',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP10.01','Jumlah SDM operator prasarana dan sarana transportasi yang telah memiliki sertifikat','Orang',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP10.02','Jumlah SDM fungsional teknis Kementerian Perhubungan','Orang',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP10.02','Jumlah SDM fungsional teknis Kementerian Perhubungan','Orang',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP10.03','Jumlah lulusan diklat SDM Transportasi Darat, Laut, Udara, Perkeretaapian dan Aparatur yang prima, profesional dan beretika yang dihasilkan setiap tahun yang sesuai standar kompetensi/kelulusan','Orang',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP10.03','Jumlah lulusan diklat SDM Transportasi Darat, Laut, Udara, Perkeretaapian dan Aparatur yang prima, profesional dan beretika yang dihasilkan setiap tahun yang sesuai standar kompetensi/kelulusan','Orang',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP11.01','Jumlah peraturan perundang-undangan di sektor transportasi yang ditetapkan','Peraturan',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP11.01','Jumlah peraturan perundang-undangan di sektor transportasi yang ditetapkan','Peraturan',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP12.01','Jumlah konsumsi energi tak terbarukan dari sektor transportasi nasional','Juta Liter/Tahun',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP12.01','Jumlah konsumsi energi tak terbarukan dari sektor transportasi nasional','Juta Liter/Tahun',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP12.02','Jumlah emisi gas buang dari sektor transportasi nasional','Juta Ton/Tahun',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP12.02','Jumlah emisi gas buang dari sektor transportasi nasional','Juta Ton/Tahun',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP13.01','Jumlah penerapan teknologi ramah lingkungan pada sarana dan prasarana transportasi','Lokasi (Unit)',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP13.01','Jumlah penerapan teknologi ramah lingkungan pada sarana dan prasarana transportasi','Lokasi (Unit)',NULL,NULL,NULL,NULL),('022',2012,'IKUSSKP13.02','Jumlah lokasi simpul transportasi yang telah menerapkan konsep ramah lingkungan','Lokasi',NULL,NULL,NULL,NULL),('022',2013,'IKUSSKP13.02','Jumlah lokasi simpul transportasi yang telah menerapkan konsep ramah lingkungan','Lokasi',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_iku_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_iku_kl_log`
--

DROP TABLE IF EXISTS `tbl_iku_kl_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_iku_kl_log` (
  `kode_kl` varchar(10) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `kode_iku_kl` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `satuan` varchar(40) DEFAULT NULL,
  `kode_e1` varchar(10) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_iku_kl_log`
--

LOCK TABLES `tbl_iku_kl_log` WRITE;
/*!40000 ALTER TABLE `tbl_iku_kl_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_iku_kl_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kegiatan_kl`
--

DROP TABLE IF EXISTS `tbl_kegiatan_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kegiatan_kl` (
  `id_kegiatan_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_kegiatan` varchar(20) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `kode_program` varchar(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `kode_e2` varchar(10) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kegiatan_kl`),
  KEY `FK_tbl_kegiatan_kl_eselon2` (`kode_e2`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kegiatan_kl`
--

LOCK TABLES `tbl_kegiatan_kl` WRITE;
/*!40000 ALTER TABLE `tbl_kegiatan_kl` DISABLE KEYS */;
INSERT INTO `tbl_kegiatan_kl` VALUES (23,2012,'022.04.08.1954','Pengelolaan dan Penyelenggaraan Kegiatan di Bidang Kenavigasian','022.04.08',1722804628000,'022.04.02',NULL,NULL),(24,2012,'022.04.08.1955','Pengelolaan dan Penyelenggaraan Kegiatan di Bidang Penjagaan Laut dan Pantai','022.04.08',1587162001000,'022.04.06',NULL,NULL),(25,2012,'022.04.08.1956','Pengelolaan dan Penyelenggaraan Kegiatan di Bidang Lalu Lintas Angkutan Laut','022.04.08',2911725000000,'022.04.03',NULL,NULL),(26,2012,'022.04.08.1957','Pengelolaan dan Penyelenggaraan Kegiatan di Bidang Pelabuhan dan Pengerukan','022.04.08',4247749000,'022.04.04',NULL,NULL),(27,2012,'022.04.08.1958','Pengelolaan dan Penyelenggaraan Kegiatan di Bidang Perkapalan dan Kepelautan','022.04.08',662563848000,'022.04.05',NULL,'8;2013-12-04 17:47:52'),(73,2013,'022.04.08.1959','Dukungan Manajemen dan Dukungan Teknis Lainnya Direktorat Jenderal Perhubungan Laut','022.04.08',240332805000,'022.04.01','7;2013-10-22 06:19:24',NULL),(78,2012,'022.04.08.1959','Dukungan Manajemen dan Dukungan Teknis Lainnya Direktorat Jenderal Perhubungan Laut','022.04.08',332097774000,'022.04.01',NULL,NULL),(79,2013,'022.04.08.1956','Pengelolaan dan Penyelenggaraan Kegiatan di Bidang Lalu Lintas Angkutan Laut','022.04.08',0,'022.04.03',NULL,NULL);
/*!40000 ALTER TABLE `tbl_kegiatan_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kinerja_eselon1`
--

DROP TABLE IF EXISTS `tbl_kinerja_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kinerja_eselon1` (
  `id_kinerja_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `kode_sasaran_e1` varchar(20) NOT NULL,
  `kode_iku_e1` varchar(20) NOT NULL,
  `realisasi` varchar(20) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `realisasi_persen` float DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `action_plan` text,
  PRIMARY KEY (`id_kinerja_e1`),
  KEY `FK_tbl_kinerja_eselon1` (`kode_e1`),
  KEY `FK_tbl_kinerja_eselon1_sasaran` (`kode_sasaran_e1`),
  KEY `FK_tbl_kinerja_eselon1_iku` (`kode_iku_e1`),
  CONSTRAINT `tbl_kinerja_eselon1_ibfk_1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_kinerja_eselon1_ibfk_2` FOREIGN KEY (`kode_sasaran_e1`) REFERENCES `tbl_sasaran_eselon1` (`kode_sasaran_e1`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_kinerja_eselon1_ibfk_3` FOREIGN KEY (`kode_iku_e1`) REFERENCES `tbl_iku_eselon1` (`kode_iku_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=573 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kinerja_eselon1`
--

LOCK TABLES `tbl_kinerja_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_kinerja_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_kinerja_eselon1` VALUES (77,2012,12,'022.04','SSPL.01','IKUSSPL01.01','24',NULL,NULL,129.17,NULL,NULL),(78,2012,12,'022.04','SSPL.01','IKUSSPL01.02','66',NULL,NULL,72.73,NULL,NULL),(79,2012,12,'022.04','SSPL.02','IKUSSPL02.01','9298',NULL,NULL,130.11,NULL,NULL),(80,2012,12,'022.04','SSPL.03','IKUSSPL03.01','80',NULL,NULL,100,NULL,NULL),(81,2012,12,'022.04','SSPL.03','IKUSSPL03.02','386',NULL,NULL,98.22,NULL,NULL),(82,2012,12,'022.04','SSPL.04','IKUSSPL04.01','6061571',NULL,NULL,120.56,NULL,NULL),(83,2012,12,'022.04','SSPL.04','IKUSSPL04.02','634000',NULL,NULL,100.66,NULL,NULL),(84,2012,12,'022.04','SSPL.04','IKUSSPL04.03','351985284',NULL,NULL,107.54,NULL,NULL),(85,2012,12,'022.04','SSPL.04','IKUSSPL04.04','98.9',NULL,NULL,100.05,NULL,NULL),(86,2012,12,'022.04','SSPL.04','IKUSSPL04.05','59851000',NULL,NULL,100.59,NULL,NULL),(87,2012,12,'022.04','SSPL.04','IKUSSPL04.06','11.8',NULL,NULL,118,NULL,NULL),(88,2012,12,'022.04','SSPL.05','IKUSSPL05.01','0',NULL,NULL,0,'Rata-rata TRT tahun 2012 sebesar 87.94 Jam/Kapal',NULL),(89,2012,12,'022.04','SSPL.06','IKUSSPL06.01','36',NULL,NULL,75,NULL,NULL),(90,2012,12,'022.04','SSPL.06','IKUSSPL06.02','36',NULL,NULL,75,NULL,NULL),(91,2012,12,'022.04','SSPL.06','IKUSSPL06.03','15',NULL,NULL,31.25,NULL,NULL),(92,2012,12,'022.04','SSPL.07','IKUSSPL07.01','2',NULL,NULL,100,NULL,NULL),(93,2012,12,'022.04','SSPL.08','IKUSSPL08.01','60',NULL,NULL,100,NULL,NULL),(94,2012,12,'022.04','SSPL.08','IKUSSPL08.02','120',NULL,NULL,100,NULL,NULL),(95,2012,12,'022.04','SSPL.08','IKUSSPL08.03','59',NULL,NULL,98.33,NULL,NULL),(96,2012,12,'022.04','SSPL.08','IKUSSPL08.04','367',NULL,NULL,100,NULL,NULL),(97,2012,12,'022.04','SSPL.08','IKUSSPL08.05','60',NULL,NULL,100,NULL,NULL),(98,2012,12,'022.04','SSPL.08','IKUSSPL08.06','120',NULL,NULL,100,NULL,NULL),(99,2012,12,'022.04','SSPL.08','IKUSSPL08.07','0',NULL,NULL,0,'Alokasi anggaran tidak ada karena penghematan',NULL),(100,2012,12,'022.04','SSPL.08','IKUSSPL08.08','0',NULL,NULL,0,'Alokasi anggaran tidak ada karena penghematan',NULL),(101,2012,12,'022.04','SSPL.08','IKUSSPL08.09','0',NULL,NULL,0,'Alokasi anggaran tidak ada karena penghematan',NULL),(102,2012,12,'022.04','SSPL.09','IKUSSPL09.01','78',NULL,NULL,100,NULL,NULL),(103,2012,12,'022.04','SSPL.09','IKUSSPL09.02','620559000000',NULL,NULL,187.21,NULL,NULL),(104,2012,12,'022.04','SSPL.09','IKUSSPL09.03','9993260000000',NULL,NULL,86.52,NULL,NULL),(105,2012,12,'022.04','SSPL.09','IKUSSPL09.04','25241600000000',NULL,NULL,94.61,NULL,NULL),(106,2012,12,'022.04','SSPL.10','IKUSSPL10.01','11',NULL,NULL,100,NULL,NULL),(107,2012,12,'022.04','SSPL.11','IKUSSPL11.01','0.102',NULL,NULL,20.59,NULL,NULL),(108,2012,12,'022.04','SSPL.12','IKUSSPL12.01','6',NULL,NULL,100,NULL,NULL),(109,2012,12,'022.04','SSPL.12','IKUSSPL12.02','972',NULL,NULL,95.2,NULL,NULL),(110,2012,12,'022.04','SSPL.12','IKUSSPL12.03','1332',NULL,NULL,87.23,NULL,NULL),(111,2012,12,'022.04','SSPL.12','IKUSSPL12.04','107',NULL,NULL,79.85,NULL,NULL),(112,2012,12,'022.04','SSPL.12','IKUSSPL12.05','205',NULL,NULL,80.33,NULL,NULL),(501,2013,3,'022.04','SSPL.01','IKUSSPL01.01','1',NULL,NULL,3.23,NULL,NULL),(502,2013,3,'022.04','SSPL.01','IKUSSPL01.02','4',NULL,NULL,8.33,NULL,NULL),(503,2013,3,'022.04','SSPL.02','IKUSSPL02.01','765',NULL,NULL,9.75,NULL,NULL),(504,2013,3,'022.04','SSPL.03','IKUSSPL03.01','80',NULL,NULL,100,NULL,NULL),(505,2013,3,'022.04','SSPL.03','IKUSSPL03.02','0',NULL,NULL,0,NULL,NULL),(506,2013,3,'022.04','SSPL.04','IKUSSPL04.01','2091240',NULL,NULL,31.4,NULL,NULL),(507,2013,3,'022.04','SSPL.04','IKUSSPL04.02','263110',NULL,NULL,41.5,NULL,NULL),(508,2013,3,'022.04','SSPL.04','IKUSSPL04.03','91677850',NULL,NULL,26.89,NULL,NULL),(509,2013,3,'022.04','SSPL.04','IKUSSPL04.04','25.75',NULL,NULL,26.25,NULL,NULL),(510,2013,3,'022.04','SSPL.04','IKUSSPL04.05','16732200',NULL,NULL,26.48,NULL,NULL),(511,2013,3,'022.04','SSPL.04','IKUSSPL04.06','3.05',NULL,NULL,29.53,NULL,NULL),(512,2013,3,'022.04','SSPL.05','IKUSSPL05.01','0',NULL,NULL,0,NULL,NULL),(513,2013,3,'022.04','SSPL.06','IKUSSPL06.01','36',NULL,NULL,75,NULL,NULL),(514,2013,3,'022.04','SSPL.06','IKUSSPL06.02','36',NULL,NULL,75,NULL,NULL),(515,2013,3,'022.04','SSPL.06','IKUSSPL06.03','15',NULL,NULL,31.25,NULL,NULL),(516,2013,3,'022.04','SSPL.07','IKUSSPL07.01','2',NULL,NULL,100,NULL,NULL),(517,2013,3,'022.04','SSPL.08','IKUSSPL08.01','0',NULL,NULL,0,NULL,NULL),(518,2013,3,'022.04','SSPL.08','IKUSSPL08.02','0',NULL,NULL,0,NULL,NULL),(519,2013,3,'022.04','SSPL.08','IKUSSPL08.03','0',NULL,NULL,0,NULL,NULL),(520,2013,3,'022.04','SSPL.08','IKUSSPL08.04','0',NULL,NULL,0,NULL,NULL),(521,2013,3,'022.04','SSPL.08','IKUSSPL08.05','0',NULL,NULL,0,NULL,NULL),(522,2013,3,'022.04','SSPL.08','IKUSSPL08.06','0',NULL,NULL,0,NULL,NULL),(523,2013,3,'022.04','SSPL.08','IKUSSPL08.07','0',NULL,NULL,0,NULL,NULL),(524,2013,3,'022.04','SSPL.08','IKUSSPL08.08','0',NULL,NULL,0,NULL,NULL),(525,2013,3,'022.04','SSPL.08','IKUSSPL08.09','0',NULL,NULL,0,NULL,NULL),(526,2013,3,'022.04','SSPL.09','IKUSSPL09.01','0',NULL,NULL,0,NULL,NULL),(527,2013,3,'022.04','SSPL.09','IKUSSPL09.02','56447402360',NULL,NULL,18.27,NULL,NULL),(528,2013,3,'022.04','SSPL.09','IKUSSPL09.03','418000000000',NULL,NULL,4.35,NULL,NULL),(529,2013,3,'022.04','SSPL.09','IKUSSPL09.04','0',NULL,NULL,0,NULL,NULL),(530,2013,3,'022.04','SSPL.10','IKUSSPL10.01','5',NULL,NULL,62.5,NULL,NULL),(531,2013,3,'022.04','SSPL.11','IKUSSPL11.01','0',NULL,NULL,0,NULL,NULL),(532,2013,3,'022.04','SSPL.12','IKUSSPL12.01','6',NULL,NULL,50,NULL,NULL),(533,2013,3,'022.04','SSPL.12','IKUSSPL12.02','50',NULL,NULL,4.46,NULL,NULL),(534,2013,3,'022.04','SSPL.12','IKUSSPL12.03','21',NULL,NULL,1.25,NULL,NULL),(535,2013,3,'022.04','SSPL.12','IKUSSPL12.04','9',NULL,NULL,5.92,NULL,NULL),(536,2013,3,'022.04','SSPL.12','IKUSSPL12.05','11',NULL,NULL,4.08,NULL,NULL),(537,2013,5,'022.04','SSPL.01','IKUSSPL01.01','0',NULL,NULL,0,NULL,NULL),(538,2013,5,'022.04','SSPL.01','IKUSSPL01.02','0',NULL,NULL,0,NULL,NULL),(539,2013,5,'022.04','SSPL.02','IKUSSPL02.01','709',NULL,NULL,9.03,NULL,NULL),(540,2013,5,'022.04','SSPL.03','IKUSSPL03.01','80',NULL,NULL,100,NULL,NULL),(541,2013,5,'022.04','SSPL.03','IKUSSPL03.02','0',NULL,NULL,0,NULL,NULL),(542,2013,5,'022.04','SSPL.04','IKUSSPL04.01','0',NULL,NULL,0,NULL,NULL),(543,2013,5,'022.04','SSPL.04','IKUSSPL04.02','0',NULL,NULL,0,NULL,NULL),(544,2013,5,'022.04','SSPL.04','IKUSSPL04.03','0',NULL,NULL,0,NULL,NULL),(545,2013,5,'022.04','SSPL.04','IKUSSPL04.04','0',NULL,NULL,0,NULL,NULL),(546,2013,5,'022.04','SSPL.04','IKUSSPL04.05','0',NULL,NULL,0,NULL,NULL),(547,2013,5,'022.04','SSPL.04','IKUSSPL04.06','0',NULL,NULL,0,NULL,NULL),(548,2013,5,'022.04','SSPL.05','IKUSSPL05.01','0',NULL,NULL,0,NULL,NULL),(549,2013,5,'022.04','SSPL.06','IKUSSPL06.01','0',NULL,NULL,0,NULL,NULL),(550,2013,5,'022.04','SSPL.06','IKUSSPL06.02','0',NULL,NULL,0,NULL,NULL),(551,2013,5,'022.04','SSPL.06','IKUSSPL06.03','0',NULL,NULL,0,NULL,NULL),(552,2013,5,'022.04','SSPL.07','IKUSSPL07.01','2',NULL,NULL,100,NULL,NULL),(553,2013,5,'022.04','SSPL.08','IKUSSPL08.01','0',NULL,NULL,0,NULL,NULL),(554,2013,5,'022.04','SSPL.08','IKUSSPL08.02','0',NULL,NULL,0,NULL,NULL),(555,2013,5,'022.04','SSPL.08','IKUSSPL08.03','0',NULL,NULL,0,NULL,NULL),(556,2013,5,'022.04','SSPL.08','IKUSSPL08.04','0',NULL,NULL,0,NULL,NULL),(557,2013,5,'022.04','SSPL.08','IKUSSPL08.05','0',NULL,NULL,0,NULL,NULL),(558,2013,5,'022.04','SSPL.08','IKUSSPL08.06','0',NULL,NULL,0,NULL,NULL),(559,2013,5,'022.04','SSPL.08','IKUSSPL08.07','0',NULL,NULL,0,NULL,NULL),(560,2013,5,'022.04','SSPL.08','IKUSSPL08.08','0',NULL,NULL,0,NULL,NULL),(561,2013,5,'022.04','SSPL.08','IKUSSPL08.09','0',NULL,NULL,0,NULL,NULL),(562,2013,5,'022.04','SSPL.09','IKUSSPL09.01','0',NULL,NULL,0,NULL,NULL),(563,2013,5,'022.04','SSPL.09','IKUSSPL09.02','0',NULL,NULL,0,NULL,NULL),(564,2013,5,'022.04','SSPL.09','IKUSSPL09.03','1283340286291',NULL,NULL,13.36,NULL,NULL),(565,2013,5,'022.04','SSPL.09','IKUSSPL09.04','0',NULL,NULL,0,NULL,NULL),(566,2013,5,'022.04','SSPL.10','IKUSSPL10.01','5',NULL,NULL,62.5,NULL,NULL),(567,2013,5,'022.04','SSPL.11','IKUSSPL11.01','0',NULL,NULL,0,NULL,NULL),(568,2013,5,'022.04','SSPL.12','IKUSSPL12.01','6',NULL,NULL,50,NULL,NULL),(569,2013,5,'022.04','SSPL.12','IKUSSPL12.02','42',NULL,NULL,3.74,NULL,NULL),(570,2013,5,'022.04','SSPL.12','IKUSSPL12.03','27',NULL,NULL,1.61,NULL,NULL),(571,2013,5,'022.04','SSPL.12','IKUSSPL12.04','4',NULL,NULL,2.63,NULL,NULL),(572,2013,5,'022.04','SSPL.12','IKUSSPL12.05','12',NULL,NULL,4.44,NULL,NULL);
/*!40000 ALTER TABLE `tbl_kinerja_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kinerja_eselon1_log`
--

DROP TABLE IF EXISTS `tbl_kinerja_eselon1_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kinerja_eselon1_log` (
  `id_kinerja_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `triwulan` int(11) DEFAULT NULL,
  `kode_e1` varchar(10) DEFAULT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `realisasi` varchar(20) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  `realisasi_persen` float DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `action_plan` text,
  PRIMARY KEY (`id_kinerja_e1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kinerja_eselon1_log`
--

LOCK TABLES `tbl_kinerja_eselon1_log` WRITE;
/*!40000 ALTER TABLE `tbl_kinerja_eselon1_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kinerja_eselon1_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kinerja_eselon2`
--

DROP TABLE IF EXISTS `tbl_kinerja_eselon2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kinerja_eselon2` (
  `id_kinerja_e2` int(11) NOT NULL AUTO_INCREMENT,
  `kode_e2` varchar(10) DEFAULT NULL,
  `tahun` year(4) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `kode_sasaran_e2` varchar(20) NOT NULL,
  `kode_ikk` varchar(20) NOT NULL,
  `realisasi` varchar(20) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `realisasi_persen` float DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_kinerja_e2`),
  KEY `FK_tbl_kinerja_eselon2_sasaran` (`kode_sasaran_e2`),
  KEY `FK_tbl_kinerja_eselon2_ikk` (`kode_ikk`),
  KEY `FK_tbl_kinerja_eselon2_e2` (`kode_e2`),
  CONSTRAINT `tbl_kinerja_eselon2_ibfk_2` FOREIGN KEY (`kode_sasaran_e2`) REFERENCES `tbl_sasaran_eselon2` (`kode_sasaran_e2`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_kinerja_eselon2_ibfk_3` FOREIGN KEY (`kode_ikk`) REFERENCES `tbl_ikk` (`kode_ikk`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_kinerja_eselon2_ibfk_4` FOREIGN KEY (`kode_e2`) REFERENCES `tbl_eselon2` (`kode_e2`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kinerja_eselon2`
--

LOCK TABLES `tbl_kinerja_eselon2` WRITE;
/*!40000 ALTER TABLE `tbl_kinerja_eselon2` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kinerja_eselon2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kinerja_eselon2_log`
--

DROP TABLE IF EXISTS `tbl_kinerja_eselon2_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kinerja_eselon2_log` (
  `id_kinerja_e2` int(11) NOT NULL AUTO_INCREMENT,
  `kode_e2` varchar(10) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `triwulan` int(11) DEFAULT NULL,
  `kode_sasaran_e2` varchar(20) DEFAULT NULL,
  `kode_ikk` varchar(20) DEFAULT NULL,
  `realisasi` varchar(20) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  `realisasi_persen` float DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_kinerja_e2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kinerja_eselon2_log`
--

LOCK TABLES `tbl_kinerja_eselon2_log` WRITE;
/*!40000 ALTER TABLE `tbl_kinerja_eselon2_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kinerja_eselon2_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kinerja_kl`
--

DROP TABLE IF EXISTS `tbl_kinerja_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kinerja_kl` (
  `id_kinerja_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `kode_kl` varchar(10) NOT NULL,
  `kode_sasaran_kl` varchar(20) NOT NULL,
  `kode_iku_kl` varchar(20) NOT NULL,
  `realisasi` varchar(20) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  `realisasi_persen` float DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `action_plan` text,
  PRIMARY KEY (`id_kinerja_kl`),
  KEY `FK_tbl_kinerja_kl` (`kode_kl`),
  KEY `FK_tbl_kinerja_kl_sasaran` (`kode_sasaran_kl`),
  KEY `FK_tbl_kinerja_kl_iku` (`kode_iku_kl`),
  CONSTRAINT `tbl_kinerja_kl_ibfk_1` FOREIGN KEY (`kode_kl`) REFERENCES `tbl_kl` (`kode_kl`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_kinerja_kl_ibfk_2` FOREIGN KEY (`kode_sasaran_kl`) REFERENCES `tbl_sasaran_kl` (`kode_sasaran_kl`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_kinerja_kl_ibfk_3` FOREIGN KEY (`kode_iku_kl`) REFERENCES `tbl_iku_kl` (`kode_iku_kl`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kinerja_kl`
--

LOCK TABLES `tbl_kinerja_kl` WRITE;
/*!40000 ALTER TABLE `tbl_kinerja_kl` DISABLE KEYS */;
INSERT INTO `tbl_kinerja_kl` VALUES (1,2012,12,'022','SSKP.01','IKUSSKP01.01','5356',NULL,NULL,91.73,'Menurun',NULL),(2,2012,12,'022','SSKP.02','IKUSSKP02.01','6',NULL,NULL,133.33,'Meningkat',NULL),(3,2012,12,'022','SSKP.03','IKUSSKP03.01','72.24',NULL,NULL,99.29,'Menurun',NULL),(4,2012,12,'022','SSKP.04','IKUSSKP04.01','13619',NULL,NULL,124.02,'Meningkat',NULL),(5,2012,12,'022','SSKP.04','IKUSSKP04.02','13',NULL,NULL,40.63,'Menurun',NULL),(6,2012,12,'022','SSKP.05','IKUSSKP05.01','583',NULL,NULL,100.69,'Meningkat',NULL),(7,2012,12,'022','SSKP.06','IKUSSKP06.01','1.15',NULL,NULL,76.67,'Menurun',NULL),(8,2012,12,'022','SSKP.07','IKUSSKP07.01','830785753',NULL,NULL,99.2,'Menurun',NULL),(9,2012,12,'022','SSKP.07','IKUSSKP07.02','374726641',NULL,NULL,89.8,'Menurun',NULL),(10,2012,12,'022','SSKP.08','IKUSSKP08.01','3',NULL,NULL,150,'Meningkat',NULL),(11,2012,12,'022','SSKP.09','IKUSSKP09.01','B',NULL,NULL,133.33,'Meningkat',NULL),(12,2012,12,'022','SSKP.09','IKUSSKP09.02','WDP',NULL,NULL,80,'Menurun',NULL),(13,2012,12,'022','SSKP.09','IKUSSKP09.03','162761231073098',NULL,NULL,130.45,'Meningkat',NULL),(14,2012,12,'022','SSKP.10','IKUSSKP10.01','58175',NULL,NULL,103.15,'Meningkat',NULL),(15,2012,12,'022','SSKP.10','IKUSSKP10.02','3637',NULL,NULL,161.72,'Meningkat',NULL),(16,2012,12,'022','SSKP.10','IKUSSKP10.03','162364',NULL,NULL,108.81,'Meningkat',NULL),(17,2012,12,'022','SSKP.11','IKUSSKP11.01','65',NULL,NULL,118.18,'Meningkat',NULL),(18,2012,12,'022','SSKP.12','IKUSSKP12.01','3758.48',NULL,NULL,100.2,'Meningkat',NULL),(19,2012,12,'022','SSKP.12','IKUSSKP12.02','88691.33',NULL,NULL,100.98,'Meningkat',NULL),(20,2012,12,'022','SSKP.13','IKUSSKP13.01','2946',NULL,NULL,96.53,'Menurun',NULL),(21,2012,12,'022','SSKP.13','IKUSSKP13.02','53',NULL,NULL,100,'Tetap',NULL);
/*!40000 ALTER TABLE `tbl_kinerja_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kinerja_kl_log`
--

DROP TABLE IF EXISTS `tbl_kinerja_kl_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kinerja_kl_log` (
  `id_kinerja_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `triwulan` int(11) DEFAULT NULL,
  `kode_kl` varchar(10) DEFAULT NULL,
  `kode_sasaran_kl` varchar(20) DEFAULT NULL,
  `kode_iku_kl` varchar(20) DEFAULT NULL,
  `realisasi` varchar(20) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  `realisasi_persen` float DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `action_plan` text,
  PRIMARY KEY (`id_kinerja_kl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kinerja_kl_log`
--

LOCK TABLES `tbl_kinerja_kl_log` WRITE;
/*!40000 ALTER TABLE `tbl_kinerja_kl_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kinerja_kl_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kke1_2_e1`
--

DROP TABLE IF EXISTS `tbl_kke1_2_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kke1_2_e1` (
  `kke12_e1_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) NOT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `sasaran_tepat` varchar(1) NOT NULL,
  `sasaran_tepat_nilai` float NOT NULL,
  `ik_tepat` varchar(1) NOT NULL,
  `ik_tepat_nilai` float NOT NULL,
  `target_tercapai` varchar(1) DEFAULT NULL,
  `target_tercapai_nilai` float NOT NULL,
  `kinerja_baik` varchar(1) DEFAULT NULL,
  `kinerja_baik_nilai` float NOT NULL,
  `data_andal` varchar(1) DEFAULT NULL,
  `data_andal_nilai` float NOT NULL,
  `log_insert` varchar(50) NOT NULL,
  `log_update` varchar(50) NOT NULL,
  PRIMARY KEY (`kke12_e1_id`),
  KEY `fk_tbl_kke1_2_e1_sasaran` (`kode_sasaran_e1`),
  KEY `fk_tbl_kke1_2_e1_iku` (`kode_iku_e1`),
  KEY `tahun` (`tahun`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kke1_2_e1`
--

LOCK TABLES `tbl_kke1_2_e1` WRITE;
/*!40000 ALTER TABLE `tbl_kke1_2_e1` DISABLE KEYS */;
INSERT INTO `tbl_kke1_2_e1` VALUES (1,2012,'SSPL.01','IKUSSPL01.01','A',1,'A',1,'A',1,'A',1,'A',1,'8;2013-11-25 18:28:15','8;2013-11-25 18:56:01'),(4,2012,'SSPL.01','IKUSSPL01.02','A',1,'B',0.75,'C',0.5,'D',0.25,'E',0,'8;2013-11-27 13:04:56','');
/*!40000 ALTER TABLE `tbl_kke1_2_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kke1_3_e1`
--

DROP TABLE IF EXISTS `tbl_kke1_3_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kke1_3_e1` (
  `kke13_e1_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) NOT NULL,
  `kode_sasaran_e1` varchar(20) NOT NULL,
  `kode_iku_e1` varchar(20) NOT NULL,
  `catatan_keuangan` varchar(1) NOT NULL,
  `catatan_keuangan_nilai` float NOT NULL,
  `masyarakat` varchar(1) NOT NULL,
  `masyarakat_nilai` float NOT NULL,
  `instansi_lainnya` varchar(1) NOT NULL,
  `instansi_lainnya_nilai` float NOT NULL,
  `transparansi` varchar(1) NOT NULL,
  `transparansi_nilai` float NOT NULL,
  `penghargaan` varchar(1) NOT NULL,
  `penghargaan_nilai` float NOT NULL,
  `log_insert` varchar(50) NOT NULL,
  `log_update` varchar(50) NOT NULL,
  PRIMARY KEY (`kke13_e1_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kke1_3_e1`
--

LOCK TABLES `tbl_kke1_3_e1` WRITE;
/*!40000 ALTER TABLE `tbl_kke1_3_e1` DISABLE KEYS */;
INSERT INTO `tbl_kke1_3_e1` VALUES (1,2012,'SSPL.01','IKUSSPL01.01','A',1,'A',1,'B',0.75,'B',0.75,'B',0.75,'8;2013-11-26 11:01:13','8;2013-11-26 11:04:52'),(2,2012,'SSPL.01','IKUSSPL01.02','A',1,'A',1,'E',0,'E',0,'E',0,'8;2013-11-26 11:05:03','');
/*!40000 ALTER TABLE `tbl_kke1_3_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kke2a_e1`
--

DROP TABLE IF EXISTS `tbl_kke2a_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kke2a_e1` (
  `kke2a_e1_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) NOT NULL,
  `kode_sasaran_e1` varchar(20) NOT NULL,
  `renstra_ip` varchar(1) NOT NULL,
  `renstra_ip_nilai` float NOT NULL,
  `rkt_ip` varchar(1) NOT NULL,
  `rkt_ip_nilai` float NOT NULL,
  `pk_ip` varchar(1) NOT NULL,
  `pk_ip_nilai` float NOT NULL,
  `log_insert` varchar(50) NOT NULL,
  `log_update` varchar(50) NOT NULL,
  PRIMARY KEY (`kke2a_e1_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kke2a_e1`
--

LOCK TABLES `tbl_kke2a_e1` WRITE;
/*!40000 ALTER TABLE `tbl_kke2a_e1` DISABLE KEYS */;
INSERT INTO `tbl_kke2a_e1` VALUES (1,2012,'SSPL.02','Y',1,'Y',1,'Y',1,'8;2013-11-26 12:53:06','8;2013-11-26 12:58:50'),(4,2012,'SSPL.01','T',0,'T',0,'T',0,'8;2013-11-26 13:03:23','');
/*!40000 ALTER TABLE `tbl_kke2a_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kke2b_e1`
--

DROP TABLE IF EXISTS `tbl_kke2b_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kke2b_e1` (
  `kke2b_e1_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) NOT NULL,
  `kode_sasaran_e1` varchar(20) NOT NULL,
  `renstra_a` varchar(1) NOT NULL,
  `renstra_a_nilai` float NOT NULL,
  `renstra_b` varchar(1) NOT NULL,
  `renstra_b_nilai` float NOT NULL,
  `rkt_a` varchar(1) NOT NULL,
  `rkt_a_nilai` float NOT NULL,
  `rkt_b` varchar(1) NOT NULL,
  `rkt_b_nilai` float NOT NULL,
  `pk_a` varchar(1) NOT NULL,
  `pk_a_nilai` float NOT NULL,
  `pk_b` varchar(1) NOT NULL,
  `pk_b_nilai` float NOT NULL,
  `log_insert` varchar(50) NOT NULL,
  `log_update` varchar(50) NOT NULL,
  PRIMARY KEY (`kke2b_e1_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kke2b_e1`
--

LOCK TABLES `tbl_kke2b_e1` WRITE;
/*!40000 ALTER TABLE `tbl_kke2b_e1` DISABLE KEYS */;
INSERT INTO `tbl_kke2b_e1` VALUES (1,2012,'SSPL.01','T',0,'T',0,'Y',1,'Y',1,'T',0,'T',0,'8;2013-11-26 13:40:23','8;2013-11-26 13:42:06'),(2,2012,'SSPL.02','T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'8;2013-11-26 13:42:26','');
/*!40000 ALTER TABLE `tbl_kke2b_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kke3a_e1`
--

DROP TABLE IF EXISTS `tbl_kke3a_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kke3a_e1` (
  `kke3a_e1_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) NOT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `jenis_dokumen` enum('renstra_ip','rkt_ip','pk_ip','iku_ip') NOT NULL,
  `renstra_ip` varchar(1) NOT NULL,
  `renstra_ip_nilai` float NOT NULL,
  `rkt_ip` varchar(1) NOT NULL,
  `rkt_ip_nilai` float NOT NULL,
  `pk_ip` varchar(1) DEFAULT NULL,
  `pk_ip_nilai` float NOT NULL,
  `iku_measurable` varchar(1) DEFAULT NULL,
  `iku_measurable_nilai` float NOT NULL,
  `iku_hasil` varchar(1) DEFAULT NULL,
  `iku_hasil_nilai` float NOT NULL,
  `iku_relevan` varchar(1) DEFAULT NULL,
  `iku_relevan_nilai` float NOT NULL,
  `iku_diukur` varchar(1) DEFAULT NULL,
  `iku_diukur_nilai` float NOT NULL,
  `kriteria_measurable` varchar(1) DEFAULT NULL,
  `kriteria_measurable_nilai` float NOT NULL,
  `kriteria_hasil` varchar(1) DEFAULT NULL,
  `kriteria_hasil_nilai` float NOT NULL,
  `kriteria_relevan` varchar(1) DEFAULT NULL,
  `kriteria_relevan_nilai` float NOT NULL,
  `kriteria_diukur` varchar(1) DEFAULT NULL,
  `kriteria_diukur_nilai` float NOT NULL,
  `pengukuran` varchar(1) DEFAULT NULL,
  `pengukuran_nilai` float NOT NULL,
  `log_insert` varchar(50) NOT NULL,
  `log_update` varchar(50) NOT NULL,
  PRIMARY KEY (`kke3a_e1_id`),
  KEY `fk_tbl_kke3a_e1_sasaran` (`kode_sasaran_e1`),
  KEY `fk_tbl_kke3a_e1_iku` (`kode_iku_e1`),
  KEY `tahun` (`tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kke3a_e1`
--

LOCK TABLES `tbl_kke3a_e1` WRITE;
/*!40000 ALTER TABLE `tbl_kke3a_e1` DISABLE KEYS */;
INSERT INTO `tbl_kke3a_e1` VALUES (1,2012,'SSPL.01','IKUSSPL01.01','renstra_ip','Y',1,'Y',1,'Y',1,'Y',1,'Y',1,'Y',1,'Y',1,'Y',1,'Y',1,'Y',1,'Y',1,'Y',1,'8;2013-11-26 14:47:03','8;2013-11-27 10:39:24');
/*!40000 ALTER TABLE `tbl_kke3a_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kke3b_e1`
--

DROP TABLE IF EXISTS `tbl_kke3b_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kke3b_e1` (
  `kke3b_e1_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) NOT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `jenis_dokumen` enum('renstra_ip','rkt_ip','pk_ip','iku_ip') NOT NULL,
  `renstra_a` varchar(1) NOT NULL,
  `renstra_a_nilai` float NOT NULL,
  `renstra_b` varchar(1) NOT NULL,
  `renstra_b_nilai` float NOT NULL,
  `rkt_a` varchar(1) NOT NULL,
  `rkt_a_nilai` float NOT NULL,
  `rkt_b` varchar(1) NOT NULL,
  `rkt_b_nilai` float NOT NULL,
  `pk_a` varchar(1) DEFAULT NULL,
  `pk_a_nilai` float NOT NULL,
  `pk_b` varchar(1) DEFAULT NULL,
  `pk_b_nilai` float NOT NULL,
  `iku_measurable_a` varchar(1) DEFAULT NULL,
  `iku_measurable_a_nilai` float NOT NULL,
  `iku_measurable_b` varchar(1) DEFAULT NULL,
  `iku_measurable_b_nilai` float NOT NULL,
  `iku_hasil_a` varchar(1) DEFAULT NULL,
  `iku_hasil_a_nilai` float NOT NULL,
  `iku_hasil_b` varchar(1) DEFAULT NULL,
  `iku_hasil_b_nilai` float NOT NULL,
  `iku_relevan_a` varchar(1) DEFAULT NULL,
  `iku_relevan_a_nilai` float NOT NULL,
  `iku_relevan_b` varchar(1) DEFAULT NULL,
  `iku_relevan_b_nilai` float NOT NULL,
  `iku_diukur_a` varchar(1) DEFAULT NULL,
  `iku_diukur_a_nilai` float NOT NULL,
  `iku_diukur_b` varchar(1) DEFAULT NULL,
  `iku_diukur_b_nilai` float NOT NULL,
  `kriteria_measurable_a` varchar(1) DEFAULT NULL,
  `kriteria_measurable_a_nilai` float NOT NULL,
  `kriteria_measurable_b` varchar(1) DEFAULT NULL,
  `kriteria_measurable_b_nilai` float NOT NULL,
  `kriteria_hasil_a` varchar(1) DEFAULT NULL,
  `kriteria_hasil_a_nilai` float NOT NULL,
  `kriteria_hasil_b` varchar(1) DEFAULT NULL,
  `kriteria_hasil_b_nilai` float NOT NULL,
  `kriteria_relevan_a` varchar(1) DEFAULT NULL,
  `kriteria_relevan_a_nilai` float NOT NULL,
  `kriteria_relevan_b` varchar(1) DEFAULT NULL,
  `kriteria_relevan_b_nilai` float NOT NULL,
  `kriteria_diukur_a` varchar(1) DEFAULT NULL,
  `kriteria_diukur_a_nilai` float NOT NULL,
  `kriteria_diukur_b` varchar(1) DEFAULT NULL,
  `kriteria_diukur_b_nilai` float NOT NULL,
  `pengukuran_a` varchar(1) DEFAULT NULL,
  `pengukuran_a_nilai` float NOT NULL,
  `pengukuran_b` varchar(1) DEFAULT NULL,
  `pengukuran_b_nilai` float NOT NULL,
  `log_insert` varchar(50) NOT NULL,
  `log_update` varchar(50) NOT NULL,
  PRIMARY KEY (`kke3b_e1_id`),
  KEY `fk_tbl_kke3a_e1_sasaran` (`kode_sasaran_e1`),
  KEY `fk_tbl_kke3a_e1_iku` (`kode_iku_e1`),
  KEY `tahun` (`tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kke3b_e1`
--

LOCK TABLES `tbl_kke3b_e1` WRITE;
/*!40000 ALTER TABLE `tbl_kke3b_e1` DISABLE KEYS */;
INSERT INTO `tbl_kke3b_e1` VALUES (1,2012,'SSPL.01','IKUSSPL01.01','renstra_ip','Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'Y',1,'T',0,'8;2013-11-27 10:40:59','8;2013-11-27 10:43:46');
/*!40000 ALTER TABLE `tbl_kke3b_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kl`
--

DROP TABLE IF EXISTS `tbl_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kl` (
  `kode_kl` varchar(10) NOT NULL,
  `nama_kl` varchar(50) NOT NULL,
  `singkatan` varchar(30) NOT NULL,
  `nama_menteri` varchar(50) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_kl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kl`
--

LOCK TABLES `tbl_kl` WRITE;
/*!40000 ALTER TABLE `tbl_kl` DISABLE KEYS */;
INSERT INTO `tbl_kl` VALUES ('022','Kementerian Perhubungan','Kemenhub','E.E. Mangindaan',NULL,NULL);
/*!40000 ALTER TABLE `tbl_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_komponen_lke`
--

DROP TABLE IF EXISTS `tbl_komponen_lke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_komponen_lke` (
  `id_komponen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_komponen` varchar(255) DEFAULT NULL,
  `induk` int(11) DEFAULT NULL,
  `persen` float DEFAULT '0',
  PRIMARY KEY (`id_komponen`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_komponen_lke`
--

LOCK TABLES `tbl_komponen_lke` WRITE;
/*!40000 ALTER TABLE `tbl_komponen_lke` DISABLE KEYS */;
INSERT INTO `tbl_komponen_lke` VALUES (1,'PERENCANAAN KINERJA',NULL,45),(2,'PENGUKURAN KINERJA',NULL,30),(3,'PELAPORAN KINERJA',NULL,25),(4,'EVALUASI KINERJA',NULL,0),(5,'PENCAPAIAN SASARAN/KINERJA ORGANISASI',NULL,0),(6,'DOKUMEN RENSTRA',1,16.07),(7,'PEMENUHAN RENSTRA',6,3.21),(8,'Dokumen Renstra telah ada',7,0),(9,'Dokumen Renstra Eselon I telah ada',7,0),(10,'Dokumen Renstra telah memuat visi, misi, tujuan, sasaran, program, indikator kinerja sasaran, target tahunan, indikator kinerja tujuan dan target jangka menengah ',7,0),(11,'KUALITAS RENSTRA',6,8.04),(12,'Tujuan dan sasaran telah berorientasi hasil ',11,0),(13,'Program/kegiatan merupakan cara untuk mencapai tujuan/sasaran/hasil program/hasil kegiatan',11,0),(14,'Renstra telah menyajikan IKU',11,0),(15,'Indikator kinerja tujuan (outcome) dan sasaran (outcome dan output) telah memenuhi kriteria indikator kinerja yang baik',11,0),(16,'Target kinerja ditetapkan dengan baik',11,0),(17,'Dokumen Renstra telah selaras dengan Dokumen RPJMN/Dokumen Renstra atasannya',11,0),(18,'Dokumen Renstra telah menetapkan hal-hal yang seharusnya ditetapkan (dalam kontrak kinerja/tugas fungsi)',11,0),(19,'IMPLEMENTASI RENSTRA',6,4.82),(20,'Dokumen Renstra digunakan sebagai acuan dalam penyusunan dokumen perencanaan tahunan',19,0),(21,'Dokumen Renstra digunakan sebagai acuan dalam penyusunan Dokumen Renstra unit kerja',19,0),(22,'Dokumen Renstra digunakan sebagai acuan penyusunan Dokumen Rencana Kerja dan Anggaran',19,0),(23,'Dokumen Renstra telah direviu secara berkala',19,0),(24,'DOKUMEN PERENCANAAN KINERJA TAHUNAN',1,9.64),(25,'PEMENUHAN PERENCANAAN KINERJA TAHUNAN',24,1.93),(26,'Dokumen RKT telah ada',25,0),(27,'Dokumen RKT unit kerja telah ada',25,0),(28,'Dokumen RKT disusun sebelum mengajukan RKA',25,0),(29,'Dokumen RKT telah memuat sasaran, program, indikator kinerja sasaran, dan target kinerja tahunan',25,0),(30,'KUALITAS PERENCANAAN KINERJA TAHUNAN',24,4.82),(31,'Sasaran telah berorientasi hasil ',30,0),(32,'Kegiatan dalam dokumen Renja merupakan cara untuk mencapai sasaran',30,0),(33,'RKT telah menyajikan IKU',30,0),(34,'Indikator kinerja sasaran dan kegiatan telah memenuhi kriteria indikator kinerja yang baik',30,0),(35,'Target kinerja ditetapkan dengan baik',30,0),(36,'Dokumen RKT telah selaras dengan dokumen Renstra dan dengan Dokumen RKP/RKT atasannya',30,0),(37,'IMPLEMENTASI PERENCANAAN KINERJA TAHUNAN',24,2.89),(38,'Dokumen RKT telah digunakan sebagai acuan untuk menyusun penetapan kinerja (PK) ',37,0),(39,'Dokumen RKT digunakan sebagai acuan dalam penyusunan RKT unit kerja',37,0),(40,'Dokumen RKT telah digunakan sebagai acuan untuk menyusun anggaran (RKA) (a.l. Target kinerja RKT vs Target kinerja RKA)',37,0),(41,'DOKUMEN PENETAPAN KINERJA',1,19.29),(42,'PEMENUHAN PK',41,3.86),(43,'Dokumen PK telah ada',42,0),(44,'Dokumen PK unit kerja telah ada',43,0),(45,'Dokumen PK disusun segera setelah anggaran disetujui',42,0),(46,'Dokumen PK telah memuat sasaran, program, indikator kinerja, dan target jangka pendek',42,0),(47,'KUALITAS PK',41,9.64),(48,'Sasaran telah berorientasi hasil ',47,0),(49,'PK telah menyajikan IKU',47,0),(50,'Indikator kinerja sasaran telah memenuhi kriteria indikator kinerja yang baik',47,0),(51,'Target kinerja ditetapkan dengan baik',47,0),(52,'Dokumen PK telah selaras dengan dokumen PK atasannya dan Dokumen RKT ',47,0),(53,'IMPLEMENTASI PK',41,5.79),(54,'Dokumen PK telah dimonitor pencapaiannya secara berkala',53,0),(55,'Dokumen PK telah dimanfaatkan dalam pengarahan dan pengorganisasian kegiatan ',53,0),(56,'Target kinerja yang diperjanjikan telah digunakan untuk mengukur keberhasilan ',53,0),(57,'PEMENUHAN PENGUKURAN',2,6),(58,'Telah terdapat indikator kinerja utama (IKU) sebagai ukuran kinerja secara formal ',57,0),(59,'IKU Eselon I telah ada',58,0),(60,'Terdapat mekanisme pengumpulan data kinerja',57,0),(61,'KUALITAS PENGUKURAN',2,15),(62,'IKU telah dapat diukur secara obyektif ',61,0),(63,'IKU telah menggambarkan hasil ',61,0),(64,'IKU telah relevan dengan kondisi yang akan diukur',61,0),(65,'IKU telah cukup untuk mengukur kinerja ',61,0),(66,'IKU telah diukur realisasinya',61,0),(67,'Indikator kinerja sasaran dapat diukur secara obyektif ',61,0),(68,'Indikator kinerja sasaran menggambarkan hasil ',61,0),(69,'Indikator kinerja sasaran relevan dengan sasaran yang akan diukur',61,0),(70,'Indikator kinerja sasaran cukup untuk mengukur sasarannya',61,0),(71,'Indikator kinerja sasaran telah diukur realisasinya',61,0),(72,'Pengumpulan data kinerja dapat diandalkan',61,0),(73,'Pengumpulan data kinerja dilakukan secara berkala (bulanan/triwulanan/semester)',61,0),(74,'IMPLEMENTASI PENGUKURAN',2,9),(75,'IKU telah dimanfaatkan dalam dokumen-dokumen perencanaan dan penganggaran',74,0),(76,'IKU telah dimanfaatkan untuk penilaian kinerja',74,0),(77,'IKU telah direviu secara berkala',74,0),(78,'Hasil pengukuran kinerja telah digunakan untuk penyusunan laporan kinerja',74,0),(79,'Pengukuran kinerja digunakan untuk pengendalian dan pemantauan kinerja secara berkala ',74,0),(80,'PEMENUHAN PELAPORAN',3,5),(81,'LAKIP telah disusun',80,0),(82,'LAKIP Eselon I telah disusun',81,0),(83,'LAKIP telah disampaikan tepat waktu ',80,0),(84,'LAKIP Eselon I telah disampaikan tepat waktu ',83,0),(85,'PENYAJIAN INFORMASI KINERJA',3,13.33),(86,'LAKIP bukan merupakan kompilasi dari Unit Kerja di bawahnya',85,0),(87,'LAKIP menyajikan informasi pencapaian sasaran yang berorientasi outcome',85,0),(88,'LAKIP menyajikan informasi mengenai pencapaian IKU',85,0),(89,'LAKIP menyajikan informasi mengenai kinerja yang telah diperjanjikan',85,0),(90,'LAKIP menyajikan evaluasi dan analisis mengenai capaian kinerja ',85,0),(91,'LAKIP menyajikan pembandingan data kinerja yang memadai antara realisasi tahun ini dengan realisasi tahun sebelumnya dan pembandingan lain yang diperlukan',85,0),(92,'LAKIP menyajikan informasi keuangan yang terkait dengan pencapaian kinerja',85,0),(93,'Informasi kinerja dalam LAKIP dapat diandalkan',85,0),(94,'PEMANFAATAN INFORMASI KINERJA',3,0),(95,'Informasi yang disajikan telah digunakan dalam perbaikan perencanaan ',94,0),(96,'Informasi yang disajikan telah digunakan untuk menilai dan memperbaiki pelaksanaan program dan kegiatan organisasi',94,0),(97,'Informasi yang disajikan telah digunakan untuk peningkatan kinerja ',94,0),(98,'Informasi yang disajikan telah digunakan untuk penilaian kinerja ',94,0),(99,'PEMENUHAN EVALUASI',4,0),(100,'Terdapat pedoman evaluasi akuntabilitas kinerja',99,0),(101,'Terdapat pemantauan mengenai kemajuan pencapaian kinerja beserta hambatannya ',99,0),(102,'Evaluasi program telah dilakukan',99,0),(103,'Evaluasi akuntabilitas kinerja atas unit kerja telah dilakukan',99,0),(104,'Hasil evaluasi telah disampaikan dan dikomunikasikan kepada pihak-pihak yang berkepentingan',99,0),(105,'KUALITAS EVALUASI',4,0),(106,'Evaluasi akuntabilitas kinerja dilaksanakan dengan menggunakan pedoman/juklak evaluasi yang selaras dengan pedoman/juklak evaluasi Menpan',105,0),(107,'Evaluasi akuntabilitas kinerja dilaksanakan oleh SDM yang berkompetensi',105,0),(108,'Pelaksanaan evaluasi akuntabilitas kinerja telah disupervisi dengan baik melalui pembahasan-pembahasan yang reguler dan bertahap',105,0),(109,'Hasil evaluasi akuntabilitas kinerja menggambarkan akuntabilitas kinerja yang dievaluasi',105,0),(110,'Hasil evaluasi akuntabilitas kinerja memberikan penilaian atas akuntabilitas kinerja masing-masing unit kerja',105,0),(111,'Evaluasi akuntabilitas kinerja telah memberikan rekomendasi-rekomendasi perbaikan manajemen kinerja yang dapat dilaksanakan',105,0),(112,'Evaluasi program dilaksanakan dalam rangka menilai keberhasilan program',105,0),(113,'Evaluasi program telah memberikan rekomendasi-rekomendasi perbaikan perencanaan kinerja yang dapat dilaksanakan',105,0),(114,'Evaluasi program telah memberikan rekomendasi-rekomendasi peningkatan kinerja yang dapat dilaksanakan',105,0),(115,'PEMANFAATAN EVALUASI',4,0),(116,'Hasil evaluasi program/akuntabilitas kinerja telah ditindaklanjuti untuk perbaikan perencanaan',115,0),(117,'Hasil evaluasi akuntabilitas kinerja telah ditindaklanjuti untuk perbaikan penerapan manajemen kinerja',115,0),(118,'Hasil evaluasi program telah ditindaklanjuti untuk perbaikan kinerja',115,0),(119,'Hasil evaluasi akuntabilitas kinerja telah ditindaklanjuti untuk mengukur keberhasilan unit kerja',115,0),(120,'KINERJA YANG DILAPORKAN (OUTPUT)',5,0),(121,'Target dapat dicapai',120,0),(122,'Capaian kinerja lebih baik dari tahun sebelumnya',120,0),(123,'Informasi mengenai kinerja dapat diandalkan ',120,0),(124,'KINERJA YANG DILAPORKAN (OUTCOME)',5,0),(125,'Target dapat dicapai',124,0),(126,'Capaian kinerja lebih baik dari tahun sebelumnya',124,0),(127,'Informasi mengenai kinerja dapat diandalkan ',124,0),(128,'KINERJA DARI PENILAIAN STAKEHOLDER',5,0),(129,'Kinerja Pengelolaan Keuangan',128,0),(130,'Kinerja dari Pendapat Masyarakat/Media',128,0),(131,'Kinerja dari Penilaian Instansi Pemerintah Lainnya',128,0),(132,'Kinerja Transparansi',128,0),(133,'Kinerja/Penghargaan Lainnya',128,0);
/*!40000 ALTER TABLE `tbl_komponen_lke` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lke_konversi`
--

DROP TABLE IF EXISTS `tbl_lke_konversi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lke_konversi` (
  `jenis_lke` varchar(10) NOT NULL DEFAULT '',
  `index_mutu` varchar(1) NOT NULL DEFAULT '',
  `unit_kerja` enum('e1','e2') NOT NULL DEFAULT 'e1',
  `konversi` float DEFAULT NULL,
  PRIMARY KEY (`jenis_lke`,`index_mutu`,`unit_kerja`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lke_konversi`
--

LOCK TABLES `tbl_lke_konversi` WRITE;
/*!40000 ALTER TABLE `tbl_lke_konversi` DISABLE KEYS */;
INSERT INTO `tbl_lke_konversi` VALUES ('lke_pusat','A','e1',1),('lke_pusat','B','e1',0.75),('lke_pusat','C','e1',0.5),('lke_pusat','D','e1',0.25),('lke_pusat','E','e1',0),('kke1_2','A','e1',1),('kke1_2','B','e1',0.75),('kke1_2','C','e1',0.5),('kke1_2','D','e1',0.25),('kke1_2','E','e1',0),('lke_pusat','Y','e1',1),('lke_pusat','T','e1',0),('kke1_3','A','e1',1),('kke1_3','B','e1',0.75),('kke1_3','C','e1',0.5),('kke1_3','D','e1',0.25),('kke1_3','E','e1',0),('kke2a','Y','e1',1),('kke2a','T','e1',0),('kke2b','Y','e1',1),('kke2b','T','e1',0),('kke3a','Y','e1',1),('kke3a','T','e1',0),('kke3b','Y','e1',1),('kke3b','T','e1',0);
/*!40000 ALTER TABLE `tbl_lke_konversi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lke_pusat`
--

DROP TABLE IF EXISTS `tbl_lke_pusat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lke_pusat` (
  `lkepusat_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `id_komponen` int(11) NOT NULL,
  `index_mutu` varchar(1) NOT NULL,
  `nilai` float NOT NULL,
  `ref` varchar(50) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`lkepusat_id`),
  KEY `id_komponen` (`id_komponen`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lke_pusat`
--

LOCK TABLES `tbl_lke_pusat` WRITE;
/*!40000 ALTER TABLE `tbl_lke_pusat` DISABLE KEYS */;
INSERT INTO `tbl_lke_pusat` VALUES (1,2013,10,'A',1,'','8;2013-11-19 17:36:00',NULL),(2,2013,8,'D',0.25,'','8;2013-11-19 17:41:30',NULL);
/*!40000 ALTER TABLE `tbl_lke_pusat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_masterpk_eselon1`
--

DROP TABLE IF EXISTS `tbl_masterpk_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_masterpk_eselon1` (
  `id_masterpk_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `kode_program` varchar(20) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_masterpk_e1`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_masterpk_eselon1`
--

LOCK TABLES `tbl_masterpk_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_masterpk_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_masterpk_eselon1` VALUES (4,2012,'022.04','022.04.08',NULL,NULL),(12,2013,'022.04','022.04.08',NULL,NULL);
/*!40000 ALTER TABLE `tbl_masterpk_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_masterpk_eselon2`
--

DROP TABLE IF EXISTS `tbl_masterpk_eselon2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_masterpk_eselon2` (
  `id_masterpk_e2` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_e2` varchar(10) NOT NULL,
  `kode_kegiatan` varchar(20) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_masterpk_e2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_masterpk_eselon2`
--

LOCK TABLES `tbl_masterpk_eselon2` WRITE;
/*!40000 ALTER TABLE `tbl_masterpk_eselon2` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_masterpk_eselon2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_masterpk_kl`
--

DROP TABLE IF EXISTS `tbl_masterpk_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_masterpk_kl` (
  `id_masterpk_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_kl` varchar(10) NOT NULL,
  `kode_program` varchar(20) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_masterpk_kl`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_masterpk_kl`
--

LOCK TABLES `tbl_masterpk_kl` WRITE;
/*!40000 ALTER TABLE `tbl_masterpk_kl` DISABLE KEYS */;
INSERT INTO `tbl_masterpk_kl` VALUES (1,2012,'022','022.01.01',NULL,NULL),(2,2012,'022','022.02.03',NULL,NULL),(3,2012,'022','022.03.06',NULL,NULL),(4,2012,'022','022.04.08',NULL,NULL),(5,2012,'022','022.05.09',NULL,NULL),(6,2012,'022','022.08.07',NULL,NULL),(7,2012,'022','022.11.04',NULL,NULL),(8,2012,'022','022.12.05',NULL,NULL),(9,2013,'022','022.01.01',NULL,NULL),(10,2013,'022','022.02.03',NULL,NULL),(11,2013,'022','022.03.06',NULL,NULL),(12,2013,'022','022.04.08',NULL,NULL),(13,2013,'022','022.05.09',NULL,NULL),(14,2013,'022','022.08.07',NULL,NULL),(15,2013,'022','022.11.04',NULL,NULL),(16,2013,'022','022.12.05',NULL,NULL);
/*!40000 ALTER TABLE `tbl_masterpk_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu` (
  `menu_id` smallint(6) NOT NULL DEFAULT '0',
  `menu_group` varchar(30) DEFAULT NULL,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_parent` smallint(6) DEFAULT NULL,
  `app_types` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `hide` smallint(6) DEFAULT NULL,
  `imported` smallint(6) DEFAULT '1',
  `policy` varchar(50) DEFAULT '',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu`
--

LOCK TABLES `tbl_menu` WRITE;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` VALUES (1,'RUJUKAN','Data Rujukan',NULL,'E1;E2;','#',0,1,''),(2,'RUJUKAN','Unit Kerja',1,'E1;E2;','#',0,1,''),(3,'RUJUKAN','Eselon I',2,'E1;E2;','rujukan/eselon1',0,1,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;'),(4,'RUJUKAN','Eselon II',2,'E1;E2;','rujukan/eselon2',0,1,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;'),(5,'RUJUKAN','Satuan Kerja',1,'E1;E2;','rujukan/satker',1,0,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;'),(6,'RUJUKAN','Program',1,'E1;E2;','rujukan/programkl',0,1,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;'),(7,'RUJUKAN','Kegiatan',1,'E1;E2;','rujukan/kegiatankl',0,1,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;'),(8,'RUJUKAN','Sub Kegiatan',1,'E1;E2;','rujukan/subkegiatankl',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;'),(10,'RUJUKAN','Sasaran',1,'E1;E2;','#',0,0,''),(11,'RUJUKAN','Sasaran Eselon I',10,'E1;','pengaturan/sasaran_eselon1',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;IMPORT;AUTOTAB;'),(12,'RUJUKAN','Sasaran Eselon II',10,'E1;E2;','pengaturan/sasaran_eselon2',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;IMPORT;AUTOTAB;'),(13,'RUJUKAN','Indikator Kinerja',1,'E1;E2;','#',0,1,''),(14,'RUJUKAN','IKU Eselon I',13,'E1;','pengaturan/iku_e1',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;IMPORT;AUTOTAB;'),(15,'RUJUKAN','IKK',13,'E1;E2;','pengaturan/ikk',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;IMPORT;AUTOTAB;'),(37,'PENGATURAN','Sasaran Program/Kegiatan',30,'E1;','pengaturan/sasaran_program',1,0,'ADD;EDIT;VIEW;PRINT;EXCEL;AUTOTAB;'),(50,'RKT','RKT',NULL,'E1;E2;','#',0,0,''),(52,'RKT','RKT Eselon I',50,'E1;','rencana/rkteselon1',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(53,'RKT','RKT Eselon II',50,'E1;E2;','rencana/rkteselon2',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(60,'KKA','KKA',NULL,'E1;E2;','#',0,0,''),(61,'KKA','KKA Eselon I',60,'E1;E2;','#',0,0,''),(62,'KKA','KKA Eselon II',60,'E1;E2;','#',0,0,''),(63,'KKA','Pra Monev',61,'E1;E2;','#',0,0,''),(64,'KKA','Pagu Usulan   Eselon I',63,'E1;E2;','kka/pre_usulan1_e1',0,0,'ADD;EDIT;VIEW;DELETE;PRINT;AUTOTAB;'),(65,'KKA','Pagu Indikatif   Eselon I',63,'E1;E2;','kka/pre_indikatif_e1',0,0,'ADD;EDIT;VIEW;DELETE;PRINT;AUTOTAB;'),(66,'KKA','Pagu Definitif   Eselon I',63,'E1;E2;','kka/pre_definitif_e1',0,0,'ADD;EDIT;VIEW;DELETE;PRINT;AUTOTAB;'),(67,'KKA','Pra Monev',62,'E1;E2;','#',0,0,''),(68,'KKA','Pagu Usulan   Eselon II',67,'E1;E2;','kka/pre_usulan1_e2',0,0,'ADD;EDIT;VIEW;DELETE;PRINT;AUTOTAB;'),(69,'KKA','Pagu Indikatif &nbsp;&nbsp; Eselon II',67,'E1;E2;','kka/pre_indikatif_e2',0,0,'ADD;EDIT;VIEW;DELETE;PRINT;AUTOTAB;'),(70,'KKA','Pagu Definitif  &nbsp;&nbsp;&nbsp;  Eselon II',67,'E1;E2;','kka/pre_definitif_e2',0,0,'ADD;EDIT;VIEW;DELETE;PRINT;AUTOTAB;'),(100,'PENETAPAN','PK',NULL,'E1;E2;','#',0,0,''),(104,'PENETAPAN','Eselon I',100,'E1;','#',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;'),(105,'PENETAPAN','PK Eselon I',104,'E1;','penetapan/penetapaneselon1',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(106,'PENETAPAN','Pengesahan PK Eselon I',104,'E1;','penetapan/pengesahan_penetapaneselon1',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(107,'PENETAPAN','Eselon II',100,'E1;E2;','#',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;'),(108,'PENETAPAN','PK Eselon II',107,'E1;E2;','penetapan/penetapaneselon2',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(109,'PENETAPAN','Pengesahan PK Eselon II',107,'E2;','penetapan/pengesahan_penetapaneselon2',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(120,'CHECKPOINT','Checkpoint',NULL,'E1;E2;','#',1,0,''),(124,'CHECKPOINT','Eselon I',120,'E1;','#',1,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;'),(125,'CHECKPOINT','Rencana Checkpoint Eselon I',124,'E1;','checkpoint/checkpointe1',1,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(126,'CHECKPOINT','Capaian Checkpoint Eselon I',124,'E1;','checkpoint/checkpointe1/capaian',1,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(128,'CHECKPOINT','Monitoring Checkpoint Eselon I',124,'E1;','checkpoint/monitoring_e1',1,0,'VIEW;AUTOTAB;'),(150,'REALISASI','Capaian Kinerja',NULL,'E1;E2;','#',0,0,''),(152,'REALISASI','Capaian Kinerja Eselon I',150,'E1;','realisasi/rseselon1',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(153,'REALISASI','Capaian Kinerja Eselon II',150,'E1;E2;','realisasi/rseselon2',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(200,'PENGUKURAN','Pengukuran Kinerja',NULL,'E1;E2;','#',0,0,''),(202,'PENGUKURAN','Kinerja Eselon I',200,'E1;','pengukuran/pengukuraneselon1',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(203,'PENGUKURAN','Kinerja Eselon II',200,'E1;E2;','pengukuran/pengukuraneselon2',0,0,'ADD;EDIT;VIEW;PRINT;EXCEL;DELETE;AUTOTAB;'),(300,'LKE','LKE',NULL,'E1;E2;','#',0,0,''),(302,'LKE','LKE Pusat',300,'E1;','lke/lkepusat',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(303,'LKE','KKE1-II Capaian',300,'E1;','lke/kke1_2',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(304,'LKE','KKE1-III Capaian',300,'E1;','lke/kke1_3',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(305,'LKE','KKE2A Sasaran',300,'E1;','lke/kke2a',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(306,'LKE','KKE2B Sasaran',300,'E1;','lke/kke2b',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(307,'LKE','KKE3A IK',300,'E1;','lke/kke3a',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(308,'LKE','KKE3B IK',300,'E1;','lke/kke3b',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(350,'REPORT','Laporan',NULL,'E1;E2;','#',0,0,''),(351,'REPORT','Rencana Kinerja Tahunan',350,'E1;E2;','#',0,0,''),(353,'REPORT','Lap. RKT Eselon I',351,'E1;','rencana/rpt_rkteselon1',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(354,'REPORT','Lap. RKT Eselon II',351,'E1;E2;','rencana/rpt_rkteselon2',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(355,'REPORT','Penetapan Kinerja',350,'E1;E2;','#',0,0,''),(357,'REPORT','Lap. PK Eselon I',355,'E1;','penetapan/rpt_penetapaneselon1',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(358,'REPORT','Lap. PK Eselon II',355,'E1;E2;','penetapan/rpt_penetapaneselon2',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(365,'REPORT','Realisasi Capaian Kinerja',350,'E1;E2;','#',0,0,''),(367,'REPORT','Capaian Kinerja Eselon I',365,'E1;','realisasi/rpt_capaian_kinerjae1',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(368,'REPORT','Capaian Kinerja Eselon II',365,'E1;E2;','realisasi/rpt_capaian_kinerjae2',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(370,'REPORT','Pengukuran Kinerja',350,'E1;E2;','#',0,0,''),(372,'REPORT','Pengukuran Kinerja Eselon I',370,'E1;','pengukuran/rpt_pengukurane1',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(373,'REPORT','Pengukuran Kinerja Eselon II',370,'E1;E2;','pengukuran/rpt_pengukurane2',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(374,'REPORT','Status Pengumpulan Data Kinerja',350,'E1;E2;','pengukuran/rpt_status_pengumpulan',0,0,'VIEW;PRINT;EXCEL;AUTOTAB;'),(450,'DASHBOARD','Dashboard',NULL,'E1;E2;','#',0,0,''),(451,'DASHBOARD','Dashboard Eselon I',450,'E1;','dashboard/dsb_e1',0,0,'VIEW;AUTOTAB;'),(452,'DASHBOARD','Capaian IKU Eselon I',450,'E1;','dashboard/dsb_capaian_e1',0,0,'VIEW;AUTOTAB;'),(500,'UTILITY','Utility',NULL,'E1;E2;','#',0,0,''),(501,'UTILITY','Pengguna Aplikasi',500,'E1;E2;','#',0,1,''),(502,'UTILITY','Grup Pengguna',501,'E1;E2;','admin/group_user',1,0,'ADD;EDIT;VIEW;PRINT;AUTOTAB;'),(503,'UTILITY','Pengguna',501,'E1;E2;','admin/user',0,0,'ADD;EDIT;VIEW;PRINT;AUTOTAB;'),(504,'UTILITY','Hak Pengguna',501,'E1;E2;','admin/group_access',0,0,'EDIT;AUTOTAB;'),(508,'UTILITY','Backup Data Kinerja',500,'E1;E2;','utility/backup_restore/backupView',0,0,'PROSES;AUTOTAB;'),(509,'UTILITY','Load Data Kinerja',500,'E1;E2;','utility/backup_restore/restoreView',0,0,'PROSES;AUTOTAB;'),(510,'UTILITY','Import Data Rujukan',500,'E1;E2;','utility/import',0,0,'PROSES;AUTOTAB;'),(511,'UTILITY','Export Data Kinerja',500,'E1;E2;','underconstruction',1,0,'PROSES;AUTOTAB;'),(512,'UTILITY','System Log',500,'E1;E2;','#',0,0,''),(513,'UTILITY','Pengaturan Data',512,'E1;E2;','utility/histori_pengaturan',0,0,'VIEW;PRINT;AUTOTAB;'),(514,'UTILITY','Rencana Kinerja',512,'E1;E2;','utility/histori_rencana',0,0,'VIEW;PRINT;AUTOTAB;'),(515,'UTILITY','Penetapan Kinerja',512,'E1;E2;','underconstruction',1,0,'VIEW;PRINT;AUTOTAB;'),(516,'UTILITY','Realisasi Kinerja',512,'E1;E2;','utility/histori_realisasi',0,0,'VIEW;PRINT;AUTOTAB;'),(517,'UTILITY','Pengukuran Kinerja',512,'E1;E2;','underconstruction',1,0,'VIEW;PRINT;AUTOTAB;');
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengukuran_eselon1`
--

DROP TABLE IF EXISTS `tbl_pengukuran_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengukuran_eselon1` (
  `id_pengukuran_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `kode_sasaran_e1` varchar(20) NOT NULL,
  `kode_iku_e1` varchar(20) NOT NULL,
  `realisasi` varchar(20) NOT NULL,
  `persen` double NOT NULL,
  `opini` varchar(255) NOT NULL,
  `persetujuan` tinyint(4) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pengukuran_e1`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengukuran_eselon1`
--

LOCK TABLES `tbl_pengukuran_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_pengukuran_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_pengukuran_eselon1` VALUES (77,2012,12,'022.04','SSPL.01','IKUSSPL01.01','24',129.17,'  ',1,NULL,NULL),(78,2012,12,'022.04','SSPL.01','IKUSSPL01.02','66',72.73,'  ',1,NULL,NULL),(79,2012,12,'022.04','SSPL.02','IKUSSPL02.01','9298',130.11,'  ',1,NULL,NULL),(80,2012,12,'022.04','SSPL.03','IKUSSPL03.01','80',100,'  ',1,NULL,NULL),(81,2012,12,'022.04','SSPL.03','IKUSSPL03.02','386',98.22,'  ',1,NULL,NULL),(82,2012,12,'022.04','SSPL.04','IKUSSPL04.01','6061571',120.56,'  ',1,NULL,NULL),(83,2012,12,'022.04','SSPL.04','IKUSSPL04.02','634000',100.66,'  ',1,NULL,NULL),(84,2012,12,'022.04','SSPL.04','IKUSSPL04.03','351985284',107.54,'  ',1,NULL,NULL),(85,2012,12,'022.04','SSPL.04','IKUSSPL04.04','98.9',100.05,'  ',1,NULL,NULL),(86,2012,12,'022.04','SSPL.04','IKUSSPL04.05','59851000',100.59,'  ',1,NULL,NULL),(87,2012,12,'022.04','SSPL.04','IKUSSPL04.06','11.8',118,'  ',1,NULL,NULL),(88,2012,12,'022.04','SSPL.05','IKUSSPL05.01','0',0,'  ',1,NULL,NULL),(89,2012,12,'022.04','SSPL.06','IKUSSPL06.01','36',75,'  ',1,NULL,NULL),(90,2012,12,'022.04','SSPL.06','IKUSSPL06.02','36',75,'  ',1,NULL,NULL),(91,2012,12,'022.04','SSPL.06','IKUSSPL06.03','15',31.25,'  ',1,NULL,NULL),(92,2012,12,'022.04','SSPL.07','IKUSSPL07.01','2',100,'  ',1,NULL,NULL),(93,2012,12,'022.04','SSPL.08','IKUSSPL08.01','60',100,'  ',1,NULL,NULL),(94,2012,12,'022.04','SSPL.08','IKUSSPL08.02','120',100,'  ',1,NULL,NULL),(95,2012,12,'022.04','SSPL.08','IKUSSPL08.03','59',98.33,'  ',1,NULL,NULL),(96,2012,12,'022.04','SSPL.08','IKUSSPL08.04','367',100,'  ',1,NULL,NULL),(97,2012,12,'022.04','SSPL.08','IKUSSPL08.05','60',100,'  ',1,NULL,NULL),(98,2012,12,'022.04','SSPL.08','IKUSSPL08.06','120',100,'  ',1,NULL,NULL),(99,2012,12,'022.04','SSPL.08','IKUSSPL08.07','0',0,'  ',1,NULL,NULL),(100,2012,12,'022.04','SSPL.08','IKUSSPL08.08','0',0,'  ',1,NULL,NULL),(101,2012,12,'022.04','SSPL.08','IKUSSPL08.09','0',0,'  ',1,NULL,NULL),(102,2012,12,'022.04','SSPL.09','IKUSSPL09.01','78',100,'  ',1,NULL,NULL),(103,2012,12,'022.04','SSPL.09','IKUSSPL09.02','620559000000',187.21,'  ',1,NULL,NULL),(104,2012,12,'022.04','SSPL.09','IKUSSPL09.03','9993260000000',86.52,'  ',1,NULL,NULL),(105,2012,12,'022.04','SSPL.09','IKUSSPL09.04','25241600000000',94.61,'  ',1,NULL,NULL),(106,2012,12,'022.04','SSPL.10','IKUSSPL10.01','11',100,'  ',1,NULL,NULL),(107,2012,12,'022.04','SSPL.11','IKUSSPL11.01','0.102',20.59,'  ',1,NULL,NULL),(108,2012,12,'022.04','SSPL.12','IKUSSPL12.01','6',100,'  ',1,NULL,NULL),(109,2012,12,'022.04','SSPL.12','IKUSSPL12.02','972',95.2,'  ',1,NULL,NULL),(110,2012,12,'022.04','SSPL.12','IKUSSPL12.03','1332',87.23,'  ',1,NULL,NULL),(111,2012,12,'022.04','SSPL.12','IKUSSPL12.04','107',79.85,'  ',1,NULL,NULL),(112,2012,12,'022.04','SSPL.12','IKUSSPL12.05','205',80.33,'  ',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_pengukuran_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengukuran_eselon1_log`
--

DROP TABLE IF EXISTS `tbl_pengukuran_eselon1_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengukuran_eselon1_log` (
  `id_pengukuran_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `triwulan` int(11) DEFAULT NULL,
  `kode_e1` varchar(10) DEFAULT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `realisasi` varchar(20) DEFAULT NULL,
  `persen` double DEFAULT NULL,
  `opini` varchar(255) DEFAULT NULL,
  `persetujuan` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_pengukuran_e1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengukuran_eselon1_log`
--

LOCK TABLES `tbl_pengukuran_eselon1_log` WRITE;
/*!40000 ALTER TABLE `tbl_pengukuran_eselon1_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pengukuran_eselon1_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengukuran_eselon2`
--

DROP TABLE IF EXISTS `tbl_pengukuran_eselon2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengukuran_eselon2` (
  `id_pengukuran_e2` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `kode_e2` varchar(10) NOT NULL,
  `kode_sasaran_e2` varchar(20) NOT NULL,
  `kode_ikk` varchar(20) NOT NULL,
  `realisasi` varchar(20) NOT NULL,
  `persen` double NOT NULL,
  `opini` varchar(255) NOT NULL,
  `persetujuan` tinyint(4) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pengukuran_e2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengukuran_eselon2`
--

LOCK TABLES `tbl_pengukuran_eselon2` WRITE;
/*!40000 ALTER TABLE `tbl_pengukuran_eselon2` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pengukuran_eselon2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengukuran_eselon2_log`
--

DROP TABLE IF EXISTS `tbl_pengukuran_eselon2_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengukuran_eselon2_log` (
  `id_pengukuran_e2` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `triwulan` int(11) DEFAULT NULL,
  `kode_e2` varchar(10) DEFAULT NULL,
  `kode_sasaran_e2` varchar(20) DEFAULT NULL,
  `kode_ikk` varchar(20) DEFAULT NULL,
  `realisasi` varchar(20) DEFAULT NULL,
  `persen` double DEFAULT NULL,
  `opini` varchar(255) DEFAULT NULL,
  `persetujuan` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_pengukuran_e2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengukuran_eselon2_log`
--

LOCK TABLES `tbl_pengukuran_eselon2_log` WRITE;
/*!40000 ALTER TABLE `tbl_pengukuran_eselon2_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pengukuran_eselon2_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengukuran_kl`
--

DROP TABLE IF EXISTS `tbl_pengukuran_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengukuran_kl` (
  `id_pengukuran_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `kode_kl` varchar(10) NOT NULL,
  `kode_sasaran_kl` varchar(20) NOT NULL,
  `kode_iku_kl` varchar(20) NOT NULL,
  `realisasi` varchar(20) NOT NULL,
  `persen` double NOT NULL,
  `opini` varchar(255) NOT NULL,
  `persetujuan` tinyint(4) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pengukuran_kl`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengukuran_kl`
--

LOCK TABLES `tbl_pengukuran_kl` WRITE;
/*!40000 ALTER TABLE `tbl_pengukuran_kl` DISABLE KEYS */;
INSERT INTO `tbl_pengukuran_kl` VALUES (1,2012,12,'022','SSKP.01','IKUSSKP01.01','5356',91.73,'  ',1,NULL,NULL),(2,2012,12,'022','SSKP.02','IKUSSKP02.01','6',133.33,'  ',1,NULL,NULL),(3,2012,12,'022','SSKP.03','IKUSSKP03.01','72.24',99.29,'  ',1,NULL,NULL),(4,2012,12,'022','SSKP.04','IKUSSKP04.01','13619',124.02,'  ',1,NULL,NULL),(5,2012,12,'022','SSKP.04','IKUSSKP04.02','13',40.63,'  ',1,NULL,NULL),(6,2012,12,'022','SSKP.05','IKUSSKP05.01','583',100.69,'  ',1,NULL,NULL),(7,2012,12,'022','SSKP.06','IKUSSKP06.01','1.15',76.67,'  ',1,NULL,NULL),(8,2012,12,'022','SSKP.07','IKUSSKP07.01','830785753',99.2,'  ',1,NULL,NULL),(9,2012,12,'022','SSKP.07','IKUSSKP07.02','374726641',89.8,'  ',1,NULL,NULL),(10,2012,12,'022','SSKP.08','IKUSSKP08.01','3',150,'  ',1,NULL,NULL),(11,2012,12,'022','SSKP.09','IKUSSKP09.01','B',133.33,'  ',1,NULL,NULL),(12,2012,12,'022','SSKP.09','IKUSSKP09.02','WDP',80,'  ',1,NULL,NULL),(13,2012,12,'022','SSKP.09','IKUSSKP09.03','162761231073098',130.45,'  ',1,NULL,NULL),(14,2012,12,'022','SSKP.10','IKUSSKP10.01','58175',103.15,'  ',1,NULL,NULL),(15,2012,12,'022','SSKP.10','IKUSSKP10.02','3637',161.72,'  ',1,NULL,NULL),(16,2012,12,'022','SSKP.10','IKUSSKP10.03','162364',108.81,'  ',1,NULL,NULL),(17,2012,12,'022','SSKP.11','IKUSSKP11.01','65',118.18,'  ',1,NULL,NULL),(18,2012,12,'022','SSKP.12','IKUSSKP12.01','3758.48',100.2,'  ',1,NULL,NULL),(19,2012,12,'022','SSKP.12','IKUSSKP12.02','88691.33',100.98,'  ',1,NULL,NULL),(20,2012,12,'022','SSKP.13','IKUSSKP13.01','2946',96.53,'  ',1,NULL,NULL),(21,2012,12,'022','SSKP.13','IKUSSKP13.02','53',100,'  ',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_pengukuran_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pengukuran_kl_log`
--

DROP TABLE IF EXISTS `tbl_pengukuran_kl_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pengukuran_kl_log` (
  `id_pengukuran_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `triwulan` int(11) DEFAULT NULL,
  `kode_kl` varchar(10) DEFAULT NULL,
  `kode_sasaran_kl` varchar(20) DEFAULT NULL,
  `kode_iku_kl` varchar(20) DEFAULT NULL,
  `realisasi` varchar(20) DEFAULT NULL,
  `persen` double DEFAULT NULL,
  `opini` varchar(255) DEFAULT NULL,
  `persetujuan` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_pengukuran_kl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pengukuran_kl_log`
--

LOCK TABLES `tbl_pengukuran_kl_log` WRITE;
/*!40000 ALTER TABLE `tbl_pengukuran_kl_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pengukuran_kl_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pk_eselon1`
--

DROP TABLE IF EXISTS `tbl_pk_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pk_eselon1` (
  `id_pk_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `kode_sasaran_e1` varchar(20) NOT NULL,
  `kode_iku_e1` varchar(20) NOT NULL,
  `target` varchar(20) NOT NULL,
  `penetapan` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pk_e1`),
  KEY `FK_tbl_pk_eselon1` (`kode_e1`),
  KEY `FK_tbl_pk_eselon1_sasaran` (`kode_sasaran_e1`),
  KEY `FK_tbl_pk_eselon1_iku` (`kode_iku_e1`),
  CONSTRAINT `tbl_pk_eselon1_ibfk_1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_pk_eselon1_ibfk_2` FOREIGN KEY (`kode_sasaran_e1`) REFERENCES `tbl_sasaran_eselon1` (`kode_sasaran_e1`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_pk_eselon1_ibfk_3` FOREIGN KEY (`kode_iku_e1`) REFERENCES `tbl_iku_eselon1` (`kode_iku_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pk_eselon1`
--

LOCK TABLES `tbl_pk_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_pk_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_pk_eselon1` VALUES (77,2012,'022.04','SSPL.01','IKUSSPL01.01','31','31',1,NULL,NULL),(78,2012,'022.04','SSPL.01','IKUSSPL01.02','48','48',1,NULL,NULL),(79,2012,'022.04','SSPL.02','IKUSSPL02.01','7146','7146',1,NULL,NULL),(80,2012,'022.04','SSPL.03','IKUSSPL03.01','80','80',1,NULL,NULL),(81,2012,'022.04','SSPL.03','IKUSSPL03.02','393','393',1,NULL,NULL),(82,2012,'022.04','SSPL.04','IKUSSPL04.01','5027658','5027658',1,NULL,NULL),(83,2012,'022.04','SSPL.04','IKUSSPL04.02','629847','629847',1,NULL,NULL),(84,2012,'022.04','SSPL.04','IKUSSPL04.03','327300000','327300000',1,NULL,NULL),(85,2012,'022.04','SSPL.04','IKUSSPL04.04','98.85','98.85',1,NULL,NULL),(86,2012,'022.04','SSPL.04','IKUSSPL04.05','59599000','59599000',1,NULL,NULL),(87,2012,'022.04','SSPL.04','IKUSSPL04.06','10','10',1,NULL,NULL),(88,2012,'022.04','SSPL.05','IKUSSPL05.01','30','30',1,NULL,NULL),(89,2012,'022.04','SSPL.06','IKUSSPL06.01','48','48',1,NULL,NULL),(90,2012,'022.04','SSPL.06','IKUSSPL06.02','48','48',1,NULL,NULL),(91,2012,'022.04','SSPL.06','IKUSSPL06.03','48','48',1,NULL,NULL),(92,2012,'022.04','SSPL.07','IKUSSPL07.01','2','2',1,NULL,NULL),(93,2012,'022.04','SSPL.08','IKUSSPL08.01','60','60',1,NULL,NULL),(94,2012,'022.04','SSPL.08','IKUSSPL08.02','120','120',1,NULL,NULL),(95,2012,'022.04','SSPL.08','IKUSSPL08.03','60','60',1,NULL,NULL),(96,2012,'022.04','SSPL.08','IKUSSPL08.04','367','367',1,NULL,NULL),(97,2012,'022.04','SSPL.08','IKUSSPL08.05','60','60',1,NULL,NULL),(98,2012,'022.04','SSPL.08','IKUSSPL08.06','120','120',1,NULL,NULL),(99,2012,'022.04','SSPL.08','IKUSSPL08.07','0','0',1,NULL,NULL),(100,2012,'022.04','SSPL.08','IKUSSPL08.08','0','0',1,NULL,NULL),(101,2012,'022.04','SSPL.08','IKUSSPL08.09','0','0',1,NULL,NULL),(102,2012,'022.04','SSPL.09','IKUSSPL09.01','78','78',1,NULL,NULL),(103,2012,'022.04','SSPL.09','IKUSSPL09.02','331485001206','331485001206',1,NULL,NULL),(104,2012,'022.04','SSPL.09','IKUSSPL09.03','11550550774000','11550550774000',1,NULL,NULL),(105,2012,'022.04','SSPL.09','IKUSSPL09.04','26680195570824','26680195570824',1,NULL,NULL),(106,2012,'022.04','SSPL.10','IKUSSPL10.01','11','11',1,NULL,NULL),(107,2012,'022.04','SSPL.11','IKUSSPL11.01','0.4853','0.4853',1,NULL,NULL),(108,2012,'022.04','SSPL.12','IKUSSPL12.01','6','6',1,NULL,NULL),(109,2012,'022.04','SSPL.12','IKUSSPL12.02','1021','1021',1,NULL,NULL),(110,2012,'022.04','SSPL.12','IKUSSPL12.03','1527','1527',1,NULL,NULL),(111,2012,'022.04','SSPL.12','IKUSSPL12.04','134','134',1,NULL,NULL),(112,2012,'022.04','SSPL.12','IKUSSPL12.05','245','245',1,NULL,NULL),(253,2013,'022.04','SSPL.01','IKUSSPL01.01','37','31',1,NULL,NULL),(254,2013,'022.04','SSPL.01','IKUSSPL01.02','21','48',1,NULL,NULL),(255,2013,'022.04','SSPL.02','IKUSSPL02.01','7.85','7850',1,NULL,NULL),(256,2013,'022.04','SSPL.03','IKUSSPL03.01','89','80',1,NULL,NULL),(257,2013,'022.04','SSPL.03','IKUSSPL03.02','528','386',1,NULL,NULL),(258,2013,'022.04','SSPL.04','IKUSSPL04.01','5027658','6660000',1,NULL,NULL),(259,2013,'022.04','SSPL.04','IKUSSPL04.02','629847','634000',1,NULL,NULL),(260,2013,'022.04','SSPL.04','IKUSSPL04.03','316480000','341000000',1,NULL,NULL),(261,2013,'022.04','SSPL.04','IKUSSPL04.04','98.82','98.1',1,NULL,NULL),(262,2013,'022.04','SSPL.04','IKUSSPL04.05','55180000','63200000',1,NULL,NULL),(263,2013,'022.04','SSPL.04','IKUSSPL04.06','9.5','10.33',1,NULL,NULL),(264,2013,'022.04','SSPL.05','IKUSSPL05.01','60','60',1,NULL,NULL),(265,2013,'022.04','SSPL.06','IKUSSPL06.01','48','48',1,NULL,NULL),(266,2013,'022.04','SSPL.06','IKUSSPL06.02','48','48',1,NULL,NULL),(267,2013,'022.04','SSPL.06','IKUSSPL06.03','48','48',1,NULL,NULL),(268,2013,'022.04','SSPL.07','IKUSSPL07.01','3','2',1,NULL,NULL),(269,2013,'022.04','SSPL.08','IKUSSPL08.01','60','60',1,NULL,NULL),(270,2013,'022.04','SSPL.08','IKUSSPL08.02','120','120',1,NULL,NULL),(271,2013,'022.04','SSPL.08','IKUSSPL08.03','60','427',1,NULL,NULL),(272,2013,'022.04','SSPL.08','IKUSSPL08.04','60','367',1,NULL,NULL),(273,2013,'022.04','SSPL.08','IKUSSPL08.05','60','60',1,NULL,NULL),(274,2013,'022.04','SSPL.08','IKUSSPL08.06','120','120',1,NULL,NULL),(275,2013,'022.04','SSPL.08','IKUSSPL08.07','60','60',1,NULL,NULL),(276,2013,'022.04','SSPL.08','IKUSSPL08.08','20','20',1,NULL,NULL),(277,2013,'022.04','SSPL.08','IKUSSPL08.09','20','20',1,NULL,NULL),(278,2013,'022.04','SSPL.09','IKUSSPL09.01','80','82',1,NULL,NULL),(279,2013,'022.04','SSPL.09','IKUSSPL09.02','309000000000','309026100000',1,NULL,NULL),(280,2013,'022.04','SSPL.09','IKUSSPL09.03','9600000000000','9610273494000',1,NULL,NULL),(281,2013,'022.04','SSPL.09','IKUSSPL09.04','33100000000000','33110421564824',1,NULL,NULL),(282,2013,'022.04','SSPL.10','IKUSSPL10.01','7','8',1,NULL,NULL),(283,2013,'022.04','SSPL.11','IKUSSPL11.01','1.6122','0.5252',1,NULL,NULL),(284,2013,'022.04','SSPL.12','IKUSSPL12.01','12','12',1,NULL,NULL),(285,2013,'022.04','SSPL.12','IKUSSPL12.02','1123','1123',1,NULL,NULL),(286,2013,'022.04','SSPL.12','IKUSSPL12.03','1679','1679',1,NULL,NULL),(287,2013,'022.04','SSPL.12','IKUSSPL12.04','152','152',1,NULL,NULL),(288,2013,'022.04','SSPL.12','IKUSSPL12.05','1679','270',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_pk_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pk_eselon1_log`
--

DROP TABLE IF EXISTS `tbl_pk_eselon1_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pk_eselon1_log` (
  `id_pk_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `kode_e1` varchar(10) DEFAULT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `penetapan` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_pk_e1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pk_eselon1_log`
--

LOCK TABLES `tbl_pk_eselon1_log` WRITE;
/*!40000 ALTER TABLE `tbl_pk_eselon1_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pk_eselon1_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pk_eselon2`
--

DROP TABLE IF EXISTS `tbl_pk_eselon2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pk_eselon2` (
  `id_pk_e2` int(11) NOT NULL AUTO_INCREMENT,
  `kode_e2` varchar(10) DEFAULT NULL,
  `tahun` year(4) NOT NULL,
  `kode_sasaran_e2` varchar(20) NOT NULL,
  `kode_ikk` varchar(20) NOT NULL,
  `target` varchar(20) NOT NULL,
  `penetapan` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pk_e2`),
  KEY `FK_tbl_pk_eselon2_sasaran` (`kode_sasaran_e2`),
  KEY `FK_tbl_pk_eselon2_ikk` (`kode_ikk`),
  KEY `FK_tbl_pk_eselon2_e2` (`kode_e2`),
  CONSTRAINT `tbl_pk_eselon2_ibfk_4` FOREIGN KEY (`kode_sasaran_e2`) REFERENCES `tbl_sasaran_eselon2` (`kode_sasaran_e2`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_pk_eselon2_ibfk_5` FOREIGN KEY (`kode_ikk`) REFERENCES `tbl_ikk` (`kode_ikk`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_pk_eselon2_ibfk_6` FOREIGN KEY (`kode_e2`) REFERENCES `tbl_eselon2` (`kode_e2`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pk_eselon2`
--

LOCK TABLES `tbl_pk_eselon2` WRITE;
/*!40000 ALTER TABLE `tbl_pk_eselon2` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pk_eselon2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pk_eselon2_log`
--

DROP TABLE IF EXISTS `tbl_pk_eselon2_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pk_eselon2_log` (
  `id_pk_e2` int(11) NOT NULL AUTO_INCREMENT,
  `kode_e2` varchar(10) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `kode_sasaran_e2` varchar(20) DEFAULT NULL,
  `kode_ikk` varchar(20) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `penetapan` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_pk_e2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pk_eselon2_log`
--

LOCK TABLES `tbl_pk_eselon2_log` WRITE;
/*!40000 ALTER TABLE `tbl_pk_eselon2_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pk_eselon2_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pk_kl`
--

DROP TABLE IF EXISTS `tbl_pk_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pk_kl` (
  `id_pk_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_kl` varchar(10) NOT NULL,
  `kode_sasaran_kl` varchar(20) NOT NULL,
  `kode_iku_kl` varchar(20) NOT NULL,
  `target` varchar(20) NOT NULL,
  `penetapan` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pk_kl`),
  KEY `FK_tbl_pk_kl` (`kode_kl`),
  KEY `FK_tbl_pk_kl_sasaran` (`kode_sasaran_kl`),
  KEY `FK_tbl_pk_kl_iku` (`kode_iku_kl`),
  CONSTRAINT `tbl_pk_kl_ibfk_1` FOREIGN KEY (`kode_kl`) REFERENCES `tbl_kl` (`kode_kl`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_pk_kl_ibfk_2` FOREIGN KEY (`kode_sasaran_kl`) REFERENCES `tbl_sasaran_kl` (`kode_sasaran_kl`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_pk_kl_ibfk_3` FOREIGN KEY (`kode_iku_kl`) REFERENCES `tbl_iku_kl` (`kode_iku_kl`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pk_kl`
--

LOCK TABLES `tbl_pk_kl` WRITE;
/*!40000 ALTER TABLE `tbl_pk_kl` DISABLE KEYS */;
INSERT INTO `tbl_pk_kl` VALUES (1,2012,'022','SSKP.01','IKUSSKP01.01','5233','5003',1,NULL,NULL),(2,2012,'022','SSKP.02','IKUSSKP02.01','9','9',1,NULL,NULL),(3,2012,'022','SSKP.03','IKUSSKP03.01','71.73','71.73',1,NULL,NULL),(4,2012,'022','SSKP.04','IKUSSKP04.01','5225','10981',1,NULL,NULL),(5,2012,'022','SSKP.04','IKUSSKP04.02','32','32',1,NULL,NULL),(6,2012,'022','SSKP.05','IKUSSKP05.01','564','579',1,NULL,NULL),(7,2012,'022','SSKP.06','IKUSSKP06.01','3.4','1.5',1,NULL,NULL),(8,2012,'022','SSKP.07','IKUSSKP07.01','840803197','837526346',1,NULL,NULL),(9,2012,'022','SSKP.07','IKUSSKP07.02','452122699.5','417313024',1,NULL,NULL),(10,2012,'022','SSKP.08','IKUSSKP08.01','2','2',1,NULL,NULL),(11,2012,'022','SSKP.09','IKUSSKP09.01','CC','CC',1,NULL,NULL),(12,2012,'022','SSKP.09','IKUSSKP09.02','WTP','WTP',1,NULL,NULL),(13,2012,'022','SSKP.09','IKUSSKP09.03','124772341185388','124772341185388',1,NULL,NULL),(14,2012,'022','SSKP.10','IKUSSKP10.01','56396','56396',1,NULL,NULL),(15,2012,'022','SSKP.10','IKUSSKP10.02','6168','2249',1,NULL,NULL),(16,2012,'022','SSKP.10','IKUSSKP10.03','163533','149216',1,NULL,NULL),(17,2012,'022','SSKP.11','IKUSSKP11.01','55','55',1,NULL,NULL),(18,2012,'022','SSKP.12','IKUSSKP12.01','51372.9','3751.01',1,NULL,NULL),(19,2012,'022','SSKP.12','IKUSSKP12.02','120.2','89571.33',1,NULL,NULL),(20,2012,'022','SSKP.13','IKUSSKP13.01','4884','3052',1,NULL,NULL),(21,2012,'022','SSKP.13','IKUSSKP13.02','53','53',1,NULL,NULL),(22,2013,'022','SSKP.01','IKUSSKP01.01','5022','4962',1,NULL,NULL),(23,2013,'022','SSKP.02','IKUSSKP02.01','8','8',1,NULL,NULL),(24,2013,'022','SSKP.03','IKUSSKP03.01','86.28','86.28',1,NULL,NULL),(25,2013,'022','SSKP.04','IKUSSKP04.01','25263','25263',1,NULL,NULL),(26,2013,'022','SSKP.04','IKUSSKP04.02','198','198',1,NULL,NULL),(27,2013,'022','SSKP.05','IKUSSKP05.01','632','632',1,NULL,NULL),(28,2013,'022','SSKP.06','IKUSSKP06.01','1.8','1.8',1,NULL,NULL),(29,2013,'022','SSKP.07','IKUSSKP07.01','1078924455','1078924455',1,NULL,NULL),(30,2013,'022','SSKP.07','IKUSSKP07.02','443054428','443054428',1,NULL,NULL),(31,2013,'022','SSKP.08','IKUSSKP08.01','3','3',1,NULL,NULL),(32,2013,'022','SSKP.09','IKUSSKP09.01','B','B',1,NULL,NULL),(33,2013,'022','SSKP.09','IKUSSKP09.02','WTP','WTP',1,NULL,NULL),(34,2013,'022','SSKP.09','IKUSSKP09.03','184153616755146','184153616755146',1,NULL,NULL),(35,2013,'022','SSKP.10','IKUSSKP10.01','65443','65443',1,NULL,NULL),(36,2013,'022','SSKP.10','IKUSSKP10.02','6919','6919',1,NULL,NULL),(37,2013,'022','SSKP.10','IKUSSKP10.03','177725','177725',1,NULL,NULL),(38,2013,'022','SSKP.11','IKUSSKP11.01','200','200',1,NULL,NULL),(39,2013,'022','SSKP.12','IKUSSKP12.01','51659.1','51659.1',1,NULL,NULL),(40,2013,'022','SSKP.12','IKUSSKP12.02','121','121',1,NULL,NULL),(41,2013,'022','SSKP.13','IKUSSKP13.01','5413','5413',1,NULL,NULL),(42,2013,'022','SSKP.13','IKUSSKP13.02','67','67',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_pk_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pk_kl_log`
--

DROP TABLE IF EXISTS `tbl_pk_kl_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pk_kl_log` (
  `id_pk_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `kode_kl` varchar(10) DEFAULT NULL,
  `kode_sasaran_kl` varchar(20) DEFAULT NULL,
  `kode_iku_kl` varchar(20) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `penetapan` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_pk_kl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pk_kl_log`
--

LOCK TABLES `tbl_pk_kl_log` WRITE;
/*!40000 ALTER TABLE `tbl_pk_kl_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pk_kl_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pre_usulan1_e1`
--

DROP TABLE IF EXISTS `tbl_pre_usulan1_e1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pre_usulan1_e1` (
  `preusulan1_e1_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `kode_e1` varchar(10) DEFAULT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `kode_kegiatan` varchar(20) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`preusulan1_e1_id`),
  KEY `fk_preusulan1_e1_eselon1` (`kode_e1`),
  KEY `fk_preusulan1_e1_sasaran` (`kode_sasaran_e1`),
  KEY `fk_preusulan1_e1_iku` (`kode_iku_e1`),
  CONSTRAINT `fk_preusulan1_e1_eselon1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`),
  CONSTRAINT `fk_preusulan1_e1_iku` FOREIGN KEY (`kode_iku_e1`) REFERENCES `tbl_iku_eselon1` (`kode_iku_e1`),
  CONSTRAINT `fk_preusulan1_e1_sasaran` FOREIGN KEY (`kode_sasaran_e1`) REFERENCES `tbl_sasaran_eselon1` (`kode_sasaran_e1`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pre_usulan1_e1`
--

LOCK TABLES `tbl_pre_usulan1_e1` WRITE;
/*!40000 ALTER TABLE `tbl_pre_usulan1_e1` DISABLE KEYS */;
INSERT INTO `tbl_pre_usulan1_e1` VALUES (2,2012,'022.04','SSPL.01','IKUSSPL01.02','001',200,'8;2013-11-30 17:41:34',NULL),(3,2013,'022.04','SSPL.01','IKUSSPL03.01','001',35000,'8;2013-11-30 17:53:23',NULL),(4,2013,'022.04','SSPL.01','IKUSSPL03.01','022.04.01.1954',2000,'8;2013-11-30 17:53:23',NULL);
/*!40000 ALTER TABLE `tbl_pre_usulan1_e1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pre_usulan1_e2`
--

DROP TABLE IF EXISTS `tbl_pre_usulan1_e2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pre_usulan1_e2` (
  `preusulan1_e2_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  `kode_e2` varchar(10) DEFAULT NULL,
  `kode_sasaran_e2` varchar(20) DEFAULT NULL,
  `kode_ikk` varchar(20) DEFAULT NULL,
  `kode_kegiatan` varchar(20) DEFAULT NULL,
  `kode_subkegiatan` varchar(20) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`preusulan1_e2_id`),
  KEY `fk_preusulan1_e2_eselon2` (`kode_e2`),
  KEY `fk_preusulan1_e2_sasaran` (`kode_sasaran_e2`),
  KEY `fk_preusulan1_e2_iku` (`kode_ikk`),
  CONSTRAINT `fk_preusulan1_e2_eselon2` FOREIGN KEY (`kode_e2`) REFERENCES `tbl_eselon2` (`kode_e2`),
  CONSTRAINT `fk_preusulan1_e2_iku` FOREIGN KEY (`kode_ikk`) REFERENCES `tbl_ikk` (`kode_ikk`),
  CONSTRAINT `fk_preusulan1_e2_sasaran` FOREIGN KEY (`kode_sasaran_e2`) REFERENCES `tbl_sasaran_eselon2` (`kode_sasaran_e2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pre_usulan1_e2`
--

LOCK TABLES `tbl_pre_usulan1_e2` WRITE;
/*!40000 ALTER TABLE `tbl_pre_usulan1_e2` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pre_usulan1_e2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_prefix`
--

DROP TABLE IF EXISTS `tbl_prefix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_prefix` (
  `kode_e1` varchar(10) NOT NULL DEFAULT '',
  `kode_e2` varchar(10) NOT NULL DEFAULT '',
  `deskripsi` varchar(50) DEFAULT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `prefix_iku` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_e1`,`kode_e2`),
  UNIQUE KEY `prefix_unique` (`prefix`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_prefix`
--

LOCK TABLES `tbl_prefix` WRITE;
/*!40000 ALTER TABLE `tbl_prefix` DISABLE KEYS */;
INSERT INTO `tbl_prefix` VALUES ('022.01','','Sekretariat Jenderal Kementerian Perhubungan','SJKP',NULL),('022.02','','Inspektorat Jenderal Kementerian Perhubungan','O',NULL),('022.03','','Direktorat Jenderal Perhubungan Darat',NULL,NULL),('022.04','','Direktorat Jenderal Perhubungan Laut','SSPL','IKU'),('022.05','','Direktorat Jenderal Perhubungan Udara',NULL,NULL),('022.08','','Direktorat Jenderal Perkeretaapian',NULL,NULL),('022.11','','Badan Penelitian dan Pengembangan Perhubungan',NULL,NULL),('022.12','','Badan Pengembangan Sumber Daya Manusia Perhubungan',NULL,NULL),('022.01','022.01.01','Biro Perencanaan','BP',NULL),('022.01','022.01.02','Biro Kepegawaian dan Organisasi','BKO',NULL),('022.01','022.01.03','Biro Keuangan dan Perlengkapan','BKP',NULL),('022.01','022.01.04','Biro Hukum dan Kerjasama Luar Negeri',NULL,NULL),('022.01','022.01.05','Biro Umum',NULL,NULL),('022.01','022.01.06','Pusat Komunikasi Publik',NULL,NULL),('022.01','022.01.07','Pusat Kajian Kemitraan dan Pelayanan Jasa Transpor',NULL,NULL),('022.01','022.01.08','Mahkamah Pelayaran',NULL,NULL),('022.01','022.01.09','Pusat Data dan Informasi',NULL,NULL),('022.01','022.01.10','Komite Nasional Keselamatan Transportasi',NULL,NULL),('022.02','022.02.01','Sekretariat Inspektorat Jenderal',NULL,NULL),('022.02','022.02.02','Inspektorat I',NULL,NULL),('022.02','022.02.03','Inspektorat II',NULL,NULL),('022.02','022.02.04','Inspektorat III',NULL,NULL),('022.02','022.02.05','Inspektorat IV',NULL,NULL),('022.02','022.02.06','Inspektorat V',NULL,NULL),('022.03','022.03.01','Sekretariat Direktorat Jenderal Perhubungan Darat',NULL,NULL),('022.03','022.03.02','Direktorat Lalu Lintas dan Angkutan Jalan',NULL,NULL),('022.03','022.03.03','Direktorat Lalu Lintas dan Angkutan Sungai, Danau ',NULL,NULL),('022.03','022.03.04','Direktorat Bina Sistem Transportasi Perkotaan',NULL,NULL),('022.03','022.03.05','Direktorat Keselamatan Transportasi Darat',NULL,NULL),('022.04','022.04.01','Sekretariat Direktorat Jenderal Perhubungan Laut','SSSDPL','IKK'),('022.04','022.04.02','Direktorat Lalu Lintas dan Angkutan Laut','SSDLLAL','IKK'),('022.04','022.04.03','Direktorat Pelabuhan dan Pengerukan','SSDPUK','IKK'),('022.04','022.04.04','Direktorat Perkapalan dan Kepelautan','SSDPK','IKK'),('022.04','022.04.05','Direktorat Kenavigasian','SSDK','IKK'),('022.04','022.04.06','Direktorat Kesatuan Penjagaan Laut dan Pantai','SSDKPLP','IKK'),('022.05','022.05.01','Sekretariat Direktorat Jenderal Perhubungan Udara',NULL,NULL),('022.05','022.05.02','Direktorat Angkutan Udara',NULL,NULL),('022.05','022.05.03','Direktorat Bandar Udara',NULL,NULL),('022.05','022.05.04','Direktorat Keamanan Penerbangan',NULL,NULL),('022.05','022.05.05','Direktorat Navigasi Penerbangan',NULL,NULL),('022.05','022.05.06','Direktorat Kelaikan Udara dan Pengoperasian Pesawa',NULL,NULL),('022.08','022.08.01','Sekretariat Direktorat Jenderal Perkeretaapian',NULL,NULL),('022.08','022.08.02','Direktorat Lalu Lintas dan Angkutan Kereta Api',NULL,NULL),('022.08','022.08.03','Direktorat Prasarana Perkeretaapian',NULL,NULL),('022.08','022.08.04','Direktorat Sarana Perkeretaapian',NULL,NULL),('022.08','022.08.05','Direktorat Keselamatan Perkeretaapian',NULL,NULL),('022.11','022.11.01','Sekretariat Badan Penelitian dan Pengembangan Perh',NULL,NULL),('022.11','022.11.02','Pusat Penelitian dan Pengembangan Manajemen Transp',NULL,NULL),('022.11','022.11.03','Pusat Penelitian dan Pengembangan Perhubungan Dara',NULL,NULL),('022.11','022.11.04','Pusat Penelitian dan Pengembangan Perhubungan Laut',NULL,NULL),('022.11','022.11.05','Pusat Penelitian dan Pengembangan Perhubungan Udar',NULL,NULL),('022.12','022.12.01','Sekretariat Badan Pengembangan Sumber Daya Manusia',NULL,NULL),('022.12','022.12.02','Pusat Pengembangan Sumber Daya Manusia Perhubungan',NULL,NULL),('022.12','022.12.03','Pusat Pengembangan Sumber Daya Manusia Perhubungan',NULL,NULL),('022.12','022.12.04','Pusat Pengembangan Sumber Daya Manusia Perhubungan',NULL,NULL),('022.12','022.12.05','Pusat Pengembangan Sumber Daya Manusia Aparatur Pe',NULL,NULL);
/*!40000 ALTER TABLE `tbl_prefix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_program_kl`
--

DROP TABLE IF EXISTS `tbl_program_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_program_kl` (
  `id_program_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_program` varchar(20) NOT NULL,
  `nama_program` varchar(200) DEFAULT NULL,
  `total` bigint(20) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_program_kl`),
  KEY `FK_tbl_program_kl_e1` (`kode_e1`),
  CONSTRAINT `tbl_program_kl_ibfk_1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_program_kl`
--

LOCK TABLES `tbl_program_kl` WRITE;
/*!40000 ALTER TABLE `tbl_program_kl` DISABLE KEYS */;
INSERT INTO `tbl_program_kl` VALUES (4,2012,'022.04.08','Pengelolaan dan Penyelenggaraan Transportasi Laut',11550550774000,'022.04',NULL,NULL),(12,2013,'022.04.08','Pengelolaan dan Penyelenggaraan Transportasi Laut',12598300000000,'022.04',NULL,NULL);
/*!40000 ALTER TABLE `tbl_program_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rkt_eselon1`
--

DROP TABLE IF EXISTS `tbl_rkt_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rkt_eselon1` (
  `id_rkt_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `kode_sasaran_e1` varchar(20) NOT NULL,
  `kode_iku_e1` varchar(20) NOT NULL,
  `target` varchar(20) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rkt_e1`),
  KEY `FK_tbl_rkt_eselon1_e1` (`kode_e1`),
  KEY `FK_tbl_rkt_eselon1_sasaran` (`kode_sasaran_e1`),
  KEY `FK_tbl_rkt_eselon1_iku` (`kode_iku_e1`),
  CONSTRAINT `tbl_rkt_eselon1_ibfk_1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_rkt_eselon1_ibfk_2` FOREIGN KEY (`kode_sasaran_e1`) REFERENCES `tbl_sasaran_eselon1` (`kode_sasaran_e1`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_rkt_eselon1_ibfk_3` FOREIGN KEY (`kode_iku_e1`) REFERENCES `tbl_iku_eselon1` (`kode_iku_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rkt_eselon1`
--

LOCK TABLES `tbl_rkt_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_rkt_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_rkt_eselon1` VALUES (77,2012,'022.04','SSPL.01','IKUSSPL01.01','31',1,NULL,NULL),(78,2012,'022.04','SSPL.01','IKUSSPL01.02','48',1,NULL,NULL),(79,2012,'022.04','SSPL.02','IKUSSPL02.01','7146',1,NULL,NULL),(80,2012,'022.04','SSPL.03','IKUSSPL03.01','80',1,NULL,NULL),(81,2012,'022.04','SSPL.03','IKUSSPL03.02','393',1,NULL,NULL),(82,2012,'022.04','SSPL.04','IKUSSPL04.01','5027658',1,NULL,NULL),(83,2012,'022.04','SSPL.04','IKUSSPL04.02','629847',1,NULL,NULL),(84,2012,'022.04','SSPL.04','IKUSSPL04.03','327300000',1,NULL,NULL),(85,2012,'022.04','SSPL.04','IKUSSPL04.04','98.85',1,NULL,NULL),(86,2012,'022.04','SSPL.04','IKUSSPL04.05','59599000',1,NULL,NULL),(87,2012,'022.04','SSPL.04','IKUSSPL04.06','10',1,NULL,NULL),(88,2012,'022.04','SSPL.05','IKUSSPL05.01','30',1,NULL,NULL),(89,2012,'022.04','SSPL.06','IKUSSPL06.01','48',1,NULL,NULL),(90,2012,'022.04','SSPL.06','IKUSSPL06.02','48',1,NULL,NULL),(91,2012,'022.04','SSPL.06','IKUSSPL06.03','48',1,NULL,NULL),(92,2012,'022.04','SSPL.07','IKUSSPL07.01','2',1,NULL,NULL),(93,2012,'022.04','SSPL.08','IKUSSPL08.01','60',1,NULL,NULL),(94,2012,'022.04','SSPL.08','IKUSSPL08.02','120',1,NULL,NULL),(95,2012,'022.04','SSPL.08','IKUSSPL08.03','60',1,NULL,NULL),(96,2012,'022.04','SSPL.08','IKUSSPL08.04','367',1,NULL,NULL),(97,2012,'022.04','SSPL.08','IKUSSPL08.05','60',1,NULL,NULL),(98,2012,'022.04','SSPL.08','IKUSSPL08.06','120',1,NULL,NULL),(99,2012,'022.04','SSPL.08','IKUSSPL08.07','0',1,NULL,NULL),(100,2012,'022.04','SSPL.08','IKUSSPL08.08','0',1,NULL,NULL),(101,2012,'022.04','SSPL.08','IKUSSPL08.09','0',1,NULL,NULL),(102,2012,'022.04','SSPL.09','IKUSSPL09.01','78',1,NULL,NULL),(103,2012,'022.04','SSPL.09','IKUSSPL09.02','331485001206',1,NULL,NULL),(104,2012,'022.04','SSPL.09','IKUSSPL09.03','11550550774000',1,NULL,NULL),(105,2012,'022.04','SSPL.09','IKUSSPL09.04','26680195570824',1,NULL,NULL),(106,2012,'022.04','SSPL.10','IKUSSPL10.01','11',1,NULL,NULL),(107,2012,'022.04','SSPL.11','IKUSSPL11.01','0.4853',1,NULL,NULL),(108,2012,'022.04','SSPL.12','IKUSSPL12.01','6',1,NULL,NULL),(109,2012,'022.04','SSPL.12','IKUSSPL12.02','1021',1,NULL,NULL),(110,2012,'022.04','SSPL.12','IKUSSPL12.03','1527',1,NULL,NULL),(111,2012,'022.04','SSPL.12','IKUSSPL12.04','134',1,NULL,NULL),(112,2012,'022.04','SSPL.12','IKUSSPL12.05','245',1,NULL,NULL),(253,2013,'022.04','SSPL.01','IKUSSPL01.01','37',1,NULL,NULL),(254,2013,'022.04','SSPL.01','IKUSSPL01.02','21',1,NULL,NULL),(255,2013,'022.04','SSPL.02','IKUSSPL02.01','7.85',1,NULL,NULL),(256,2013,'022.04','SSPL.03','IKUSSPL03.01','89',1,NULL,NULL),(257,2013,'022.04','SSPL.03','IKUSSPL03.02','528',1,NULL,NULL),(258,2013,'022.04','SSPL.04','IKUSSPL04.01','5027658',1,NULL,NULL),(259,2013,'022.04','SSPL.04','IKUSSPL04.02','629847',1,NULL,NULL),(260,2013,'022.04','SSPL.04','IKUSSPL04.03','316480000',1,NULL,NULL),(261,2013,'022.04','SSPL.04','IKUSSPL04.04','98.82',1,NULL,NULL),(262,2013,'022.04','SSPL.04','IKUSSPL04.05','55180000',1,NULL,NULL),(263,2013,'022.04','SSPL.04','IKUSSPL04.06','9.5',1,NULL,NULL),(264,2013,'022.04','SSPL.05','IKUSSPL05.01','60',1,NULL,NULL),(265,2013,'022.04','SSPL.06','IKUSSPL06.01','48',1,NULL,NULL),(266,2013,'022.04','SSPL.06','IKUSSPL06.02','48',1,NULL,NULL),(267,2013,'022.04','SSPL.06','IKUSSPL06.03','48',1,NULL,NULL),(268,2013,'022.04','SSPL.07','IKUSSPL07.01','3',1,NULL,NULL),(269,2013,'022.04','SSPL.08','IKUSSPL08.01','60',1,NULL,NULL),(270,2013,'022.04','SSPL.08','IKUSSPL08.02','120',1,NULL,NULL),(271,2013,'022.04','SSPL.08','IKUSSPL08.03','60',1,NULL,NULL),(272,2013,'022.04','SSPL.08','IKUSSPL08.04','60',1,NULL,NULL),(273,2013,'022.04','SSPL.08','IKUSSPL08.05','60',1,NULL,NULL),(274,2013,'022.04','SSPL.08','IKUSSPL08.06','120',1,NULL,NULL),(275,2013,'022.04','SSPL.08','IKUSSPL08.07','60',1,NULL,NULL),(276,2013,'022.04','SSPL.08','IKUSSPL08.08','20',1,NULL,NULL),(277,2013,'022.04','SSPL.08','IKUSSPL08.09','20',1,NULL,NULL),(278,2013,'022.04','SSPL.09','IKUSSPL09.01','80',1,NULL,NULL),(279,2013,'022.04','SSPL.09','IKUSSPL09.02','309000000000',1,NULL,NULL),(280,2013,'022.04','SSPL.09','IKUSSPL09.03','9600000000000',1,NULL,NULL),(281,2013,'022.04','SSPL.09','IKUSSPL09.04','33100000000000',1,NULL,NULL),(282,2013,'022.04','SSPL.10','IKUSSPL10.01','7',1,NULL,NULL),(283,2013,'022.04','SSPL.11','IKUSSPL11.01','1.6122',1,NULL,NULL),(284,2013,'022.04','SSPL.12','IKUSSPL12.01','12',1,NULL,NULL),(285,2013,'022.04','SSPL.12','IKUSSPL12.02','1123',1,NULL,NULL),(286,2013,'022.04','SSPL.12','IKUSSPL12.03','1679',1,NULL,NULL),(287,2013,'022.04','SSPL.12','IKUSSPL12.04','152',1,NULL,NULL),(288,2013,'022.04','SSPL.12','IKUSSPL12.05','1679',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_rkt_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rkt_eselon1_log`
--

DROP TABLE IF EXISTS `tbl_rkt_eselon1_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rkt_eselon1_log` (
  `id_rkt_e1` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `kode_e1` varchar(10) DEFAULT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `kode_iku_e1` varchar(20) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_rkt_e1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rkt_eselon1_log`
--

LOCK TABLES `tbl_rkt_eselon1_log` WRITE;
/*!40000 ALTER TABLE `tbl_rkt_eselon1_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_rkt_eselon1_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rkt_eselon2`
--

DROP TABLE IF EXISTS `tbl_rkt_eselon2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rkt_eselon2` (
  `id_rkt_e2` int(11) NOT NULL AUTO_INCREMENT,
  `kode_e2` varchar(10) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kode_sasaran_e2` varchar(20) NOT NULL,
  `kode_ikk` varchar(20) NOT NULL,
  `target` varchar(20) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rkt_e2`),
  KEY `FK_tbl_rkt_eselon2_sasaran` (`kode_sasaran_e2`),
  KEY `FK_tbl_rkt_eselon2_ikk` (`kode_ikk`),
  KEY `FK_tbl_rkt_eselon2_e2` (`kode_e2`),
  CONSTRAINT `tbl_rkt_eselon2_ibfk_4` FOREIGN KEY (`kode_sasaran_e2`) REFERENCES `tbl_sasaran_eselon2` (`kode_sasaran_e2`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_rkt_eselon2_ibfk_5` FOREIGN KEY (`kode_ikk`) REFERENCES `tbl_ikk` (`kode_ikk`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_rkt_eselon2_ibfk_6` FOREIGN KEY (`kode_e2`) REFERENCES `tbl_eselon2` (`kode_e2`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rkt_eselon2`
--

LOCK TABLES `tbl_rkt_eselon2` WRITE;
/*!40000 ALTER TABLE `tbl_rkt_eselon2` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_rkt_eselon2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rkt_eselon2_log`
--

DROP TABLE IF EXISTS `tbl_rkt_eselon2_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rkt_eselon2_log` (
  `id_rkt_e2` int(11) NOT NULL AUTO_INCREMENT,
  `kode_e2` varchar(10) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `kode_sasaran_e2` varchar(20) DEFAULT NULL,
  `kode_ikk` varchar(20) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_rkt_e2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rkt_eselon2_log`
--

LOCK TABLES `tbl_rkt_eselon2_log` WRITE;
/*!40000 ALTER TABLE `tbl_rkt_eselon2_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_rkt_eselon2_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rkt_kl`
--

DROP TABLE IF EXISTS `tbl_rkt_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rkt_kl` (
  `id_rkt_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_kl` varchar(10) NOT NULL,
  `kode_sasaran_kl` varchar(20) NOT NULL,
  `kode_iku_kl` varchar(20) NOT NULL,
  `target` varchar(20) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rkt_kl`),
  KEY `FK_tbl_rkt_kl` (`kode_kl`),
  KEY `FK_tbl_rkt_kl_sasaran` (`kode_sasaran_kl`),
  KEY `FK_tbl_rkt_kl_iku` (`kode_iku_kl`),
  CONSTRAINT `tbl_rkt_kl_ibfk_1` FOREIGN KEY (`kode_kl`) REFERENCES `tbl_kl` (`kode_kl`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_rkt_kl_ibfk_2` FOREIGN KEY (`kode_sasaran_kl`) REFERENCES `tbl_sasaran_kl` (`kode_sasaran_kl`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_rkt_kl_ibfk_3` FOREIGN KEY (`kode_iku_kl`) REFERENCES `tbl_iku_kl` (`kode_iku_kl`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rkt_kl`
--

LOCK TABLES `tbl_rkt_kl` WRITE;
/*!40000 ALTER TABLE `tbl_rkt_kl` DISABLE KEYS */;
INSERT INTO `tbl_rkt_kl` VALUES (1,2012,'022','SSKP.01','IKUSSKP01.01','5233',1,NULL,NULL),(2,2012,'022','SSKP.02','IKUSSKP02.01','9',1,NULL,NULL),(3,2012,'022','SSKP.03','IKUSSKP03.01','71.73',1,NULL,NULL),(4,2012,'022','SSKP.04','IKUSSKP04.01','5225',1,NULL,NULL),(5,2012,'022','SSKP.04','IKUSSKP04.02','32',1,NULL,NULL),(6,2012,'022','SSKP.05','IKUSSKP05.01','564',1,NULL,NULL),(7,2012,'022','SSKP.06','IKUSSKP06.01','3.4',1,NULL,NULL),(8,2012,'022','SSKP.07','IKUSSKP07.01','840803197',1,NULL,NULL),(9,2012,'022','SSKP.07','IKUSSKP07.02','452122699.5',1,NULL,NULL),(10,2012,'022','SSKP.08','IKUSSKP08.01','2',1,NULL,NULL),(11,2012,'022','SSKP.09','IKUSSKP09.01','CC',1,NULL,NULL),(12,2012,'022','SSKP.09','IKUSSKP09.02','WTP',1,NULL,NULL),(13,2012,'022','SSKP.09','IKUSSKP09.03','124772341185388',1,NULL,NULL),(14,2012,'022','SSKP.10','IKUSSKP10.01','56396',1,NULL,NULL),(15,2012,'022','SSKP.10','IKUSSKP10.02','6168',1,NULL,NULL),(16,2012,'022','SSKP.10','IKUSSKP10.03','163533',1,NULL,NULL),(17,2012,'022','SSKP.11','IKUSSKP11.01','55',1,NULL,NULL),(18,2012,'022','SSKP.12','IKUSSKP12.01','51372.9',1,NULL,NULL),(19,2012,'022','SSKP.12','IKUSSKP12.02','120.2',1,NULL,NULL),(20,2012,'022','SSKP.13','IKUSSKP13.01','4884',1,NULL,NULL),(21,2012,'022','SSKP.13','IKUSSKP13.02','53',1,NULL,NULL),(22,2013,'022','SSKP.01','IKUSSKP01.01','5022',1,NULL,NULL),(23,2013,'022','SSKP.02','IKUSSKP02.01','8',1,NULL,NULL),(24,2013,'022','SSKP.03','IKUSSKP03.01','86.28',1,NULL,NULL),(25,2013,'022','SSKP.04','IKUSSKP04.01','25263',1,NULL,NULL),(26,2013,'022','SSKP.04','IKUSSKP04.02','198',1,NULL,NULL),(27,2013,'022','SSKP.05','IKUSSKP05.01','632',1,NULL,NULL),(28,2013,'022','SSKP.06','IKUSSKP06.01','1.8',1,NULL,NULL),(29,2013,'022','SSKP.07','IKUSSKP07.01','1078924455',1,NULL,NULL),(30,2013,'022','SSKP.07','IKUSSKP07.02','443054428',1,NULL,NULL),(31,2013,'022','SSKP.08','IKUSSKP08.01','3',1,NULL,NULL),(32,2013,'022','SSKP.09','IKUSSKP09.01','B',1,NULL,NULL),(33,2013,'022','SSKP.09','IKUSSKP09.02','WTP',1,NULL,NULL),(34,2013,'022','SSKP.09','IKUSSKP09.03','184153616755146',1,NULL,NULL),(35,2013,'022','SSKP.10','IKUSSKP10.01','65443',1,NULL,NULL),(36,2013,'022','SSKP.10','IKUSSKP10.02','6919',1,NULL,NULL),(37,2013,'022','SSKP.10','IKUSSKP10.03','177725',1,NULL,NULL),(38,2013,'022','SSKP.11','IKUSSKP11.01','200',1,NULL,NULL),(39,2013,'022','SSKP.12','IKUSSKP12.01','51659.1',1,NULL,NULL),(40,2013,'022','SSKP.12','IKUSSKP12.02','121',1,NULL,NULL),(41,2013,'022','SSKP.13','IKUSSKP13.01','5413',1,NULL,NULL),(42,2013,'022','SSKP.13','IKUSSKP13.02','67',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_rkt_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rkt_kl_log`
--

DROP TABLE IF EXISTS `tbl_rkt_kl_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rkt_kl_log` (
  `id_rkt_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) DEFAULT NULL,
  `kode_kl` varchar(10) DEFAULT NULL,
  `kode_sasaran_kl` varchar(20) DEFAULT NULL,
  `kode_iku_kl` varchar(20) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_rkt_kl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rkt_kl_log`
--

LOCK TABLES `tbl_rkt_kl_log` WRITE;
/*!40000 ALTER TABLE `tbl_rkt_kl_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_rkt_kl_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sasaran_eselon1`
--

DROP TABLE IF EXISTS `tbl_sasaran_eselon1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sasaran_eselon1` (
  `tahun` year(4) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `kode_sasaran_e1` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kode_sasaran_kl` varchar(20) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_sasaran_e1`,`tahun`),
  KEY `FK_tbl_sasaran_eselon1` (`kode_e1`),
  KEY `FK_tbl_sasaran_eselon1_sasarankl` (`kode_sasaran_kl`),
  CONSTRAINT `tbl_sasaran_eselon1_ibfk_1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_sasaran_eselon1_ibfk_2` FOREIGN KEY (`kode_sasaran_kl`) REFERENCES `tbl_sasaran_kl` (`kode_sasaran_kl`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sasaran_eselon1`
--

LOCK TABLES `tbl_sasaran_eselon1` WRITE;
/*!40000 ALTER TABLE `tbl_sasaran_eselon1` DISABLE KEYS */;
INSERT INTO `tbl_sasaran_eselon1` VALUES (2012,'022.04','SSPL.01','Meningkatnya keselamatan pelayaran transportasi laut','SSKP.01',NULL,NULL),(2013,'022.04','SSPL.01','Meningkatnya keselamatan pelayaran transportasi laut','SSKP.01',NULL,NULL),(2012,'022.04','SSPL.02','Meningkatnya pemenuhan standar teknis dan standar operasional sarana dan prasarana transportasi laut','SSKP.04',NULL,NULL),(2013,'022.04','SSPL.02','Meningkatnya pemenuhan standar teknis dan standar operasional sarana dan prasarana transportasi laut','SSKP.04',NULL,NULL),(2012,'022.04','SSPL.03','Meningkatnya aksesibiltas masyarakat terhadap pelayanan sarana dan prasarana transportasi laut','SSKP.05',NULL,NULL),(2013,'022.04','SSPL.03','Meningkatnya aksesibiltas masyarakat terhadap pelayanan sarana dan prasarana transportasi laut','SSKP.05',NULL,NULL),(2012,'022.04','SSPL.04','Meningkatnya kapasitas pelayanan transportasi laut nasional','SSKP.03',NULL,NULL),(2013,'022.04','SSPL.04','Meningkatnya kapasitas pelayanan transportasi laut nasional','SSKP.03',NULL,NULL),(2012,'022.04','SSPL.05','Meningkatnya manfaat sub sektor transportasi laut terhadap ekonomi melalui pengurangan biaya transportasi penumpang dan barang','SSKP.06',NULL,NULL),(2013,'022.04','SSPL.05','Meningkatnya manfaat sub sektor transportasi laut terhadap ekonomi melalui pengurangan biaya transportasi penumpang dan barang','SSKP.06',NULL,NULL),(2012,'022.04','SSPL.06','Meningkatnya pelayanan pelayaran transportasi laut','SSKP.03',NULL,NULL),(2013,'022.04','SSPL.06','Meningkatnya pelayanan pelayaran transportasi laut','SSKP.03',NULL,NULL),(2012,'022.04','SSPL.07','Melanjutkan restrukturisasi kelembagaan di sub sektor transportasi laut ','SSKP.11',NULL,NULL),(2013,'022.04','SSPL.07','Melanjutkan restrukturisasi kelembagaan di sub sektor transportasi laut ','SSKP.11',NULL,NULL),(2012,'022.04','SSPL.08','Meningkatnya kualitas SDM di Sektor Transportasi Laut','SSKP.10',NULL,NULL),(2013,'022.04','SSPL.08','Meningkatnya kualitas SDM di Sektor Transportasi Laut','SSKP.10',NULL,NULL),(2012,'022.04','SSPL.09','Meningkatnya optimalisasi pengelolaan akuntabilitas kinerja, anggaran dan BMN Direktorat Jenderal Perhubungan Laut','SSKP.09',NULL,NULL),(2013,'022.04','SSPL.09','Meningkatnya optimalisasi pengelolaan akuntabilitas kinerja, anggaran dan BMN Direktorat Jenderal Perhubungan Laut','SSKP.09',NULL,NULL),(2012,'022.04','SSPL.10','Menurunnya dampak sub sektor transportasi laut terhadap lingkungan melalui pengurangan emisi gas buang','SSKP.12',NULL,NULL),(2013,'022.04','SSPL.10','Menurunnya dampak sub sektor transportasi laut terhadap lingkungan melalui pengurangan emisi gas buang','SSKP.12',NULL,NULL),(2012,'022.04','SSPL.11','Meningkatnya pelayanan dalam rangka perlindungan lingkungan maritim di bidang transportasi laut','SSKP.03',NULL,NULL),(2013,'022.04','SSPL.11','Meningkatnya pelayanan dalam rangka perlindungan lingkungan maritim di bidang transportasi laut','SSKP.03',NULL,NULL),(2012,'022.04','SSPL.12','Penataan peraturan perundang-undangan dan melanjutkan reformasi regulasi di bidang transportasi laut','SSKP.11',NULL,NULL),(2013,'022.04','SSPL.12','Penataan peraturan perundang-undangan dan melanjutkan reformasi regulasi di bidang transportasi laut','SSKP.11',NULL,NULL);
/*!40000 ALTER TABLE `tbl_sasaran_eselon1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sasaran_eselon1_log`
--

DROP TABLE IF EXISTS `tbl_sasaran_eselon1_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sasaran_eselon1_log` (
  `tahun` year(4) DEFAULT NULL,
  `kode_e1` varchar(10) DEFAULT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `kode_sasaran_kl` varchar(20) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sasaran_eselon1_log`
--

LOCK TABLES `tbl_sasaran_eselon1_log` WRITE;
/*!40000 ALTER TABLE `tbl_sasaran_eselon1_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sasaran_eselon1_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sasaran_eselon2`
--

DROP TABLE IF EXISTS `tbl_sasaran_eselon2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sasaran_eselon2` (
  `tahun` year(4) NOT NULL,
  `kode_e2` varchar(10) NOT NULL,
  `kode_sasaran_e2` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_sasaran_e2`,`tahun`),
  KEY `FK_tbl_sasaran_eselon2` (`kode_e2`),
  KEY `FK_tbl_sasaran_eselon2_sasarane1` (`kode_sasaran_e1`),
  CONSTRAINT `tbl_sasaran_eselon2_ibfk_1` FOREIGN KEY (`kode_e2`) REFERENCES `tbl_eselon2` (`kode_e2`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_sasaran_eselon2_ibfk_2` FOREIGN KEY (`kode_sasaran_e1`) REFERENCES `tbl_sasaran_eselon1` (`kode_sasaran_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sasaran_eselon2`
--

LOCK TABLES `tbl_sasaran_eselon2` WRITE;
/*!40000 ALTER TABLE `tbl_sasaran_eselon2` DISABLE KEYS */;
INSERT INTO `tbl_sasaran_eselon2` VALUES (2013,'022.04.06','SSDKPLP.02','Meningkatkan pelayanan keselamatan pelayaran dan keamanan transportasi laut','SSPL.01','138;2013-10-22 08:26:24',NULL),(2013,'022.04.06','SSDKPLP.03','Meningkatnya kualitas sumber daya manusia serta administrasi negara di sektor transportasi laut ','SSPL.08','138;2013-10-22 08:28:15',NULL),(2013,'022.04.06','SSDKPLP.04','Meningkatnya pemeliharaan dan kualitas lingkungan hidup serta pengehmatan penggunaan energi di bidang transportasi laut','SSPL.12','138;2013-10-22 08:29:47',NULL),(2013,'022.04.02','SSDLLAL.01','Meningkatnya Tingkat Kecukupan dan Keandalan Sarana Bantu Navigasi Pelayaran','SSPL.01','136;2013-10-22 06:20:46',NULL),(2013,'022.04.04','SSDPK.01','Meningkatnya kualitas pelayanan kepelabuhanan','SSPL.01','137;2013-10-22 06:35:00',NULL),(2013,'022.04.04','SSDPK.02','Meningkatnya keselamatan dalam penyelenggaraan pelabuhan','SSPL.01','137;2013-10-22 06:36:09',NULL),(2013,'022.04.04','SSDPK.03','Meningkatnya pembinaan pengusahaan pelabuhan','SSPL.02','137;2013-10-22 06:45:50',NULL),(2013,'022.04.04','SSDPK.04','Meningkatnya kualitas dan kuantitas tenaga profesional sesuai keahlian','SSPL.08','137;2013-10-22 06:46:45',NULL),(2013,'022.04.04','SSDPK.05','Meningkatnya pengembangan, pembangunan dan pemeliharaan fasilitas pelabuhan','SSPL.02','137;2013-10-22 06:48:56',NULL),(2013,'022.04.04','SSDPK.06','Terwujudnya pelabuhan yang berwawasan lingkungan','SSPL.12','137;2013-10-22 06:51:16',NULL),(2013,'022.04.04','SSDPK.07','Meningkatnya kualitas dan kuantitas kelembagaan dalam penyelenggaraan pelabuhan','SSPL.02','137;2013-10-22 06:54:31',NULL),(2013,'022.04.04','SSDPK.08','Meningkatnya manajemen Ditpelpeng dalam rangka mewujudkan instansi yang berkualitas dan akuntabel','SSPL.09','137;2013-10-22 06:55:37',NULL),(2013,'022.04.04','SSDPK.09','Meningkatnya peran serta pemerintah kabupaten/kota dalam mengelola pelabuhan dengan melaksanakan serah terima penyelenggaraan pelabuhan lokal kepada pemerintah kabupaten/kota','SSPL.03','137;2013-10-22 06:58:01',NULL),(2013,'022.04.04','SSDPK.10','Meningkatnya pengawasan dalam penyelenggaraan pemanduan penetapan lokasi, pembangunan dan pengoperasian pelabuhan, serta kegiatan pembangunan fasilitas pelabuhan','SSPL.01','137;2013-10-22 07:01:00',NULL),(2012,'022.04.01','SSSDPL.01','Meningkatnya Kualitas Sumber Daya Manusia dan teknologi pada sub sektor transportasi laut','SSPL.08','8;2013-12-04 14:07:41',NULL),(2013,'022.04.01','SSSDPL.01','Meningkatnya Kualitas Sumber Daya Manusia dan teknologi pada sub sektor transportasi laut','SSPL.08','136;2013-10-22 06:31:53',NULL),(2012,'022.04.01','SSSDPL.02','Meningkatnya pelayanan dukungan administrasi dan teknis','SSPL.08','8;2013-12-04 14:09:19',NULL),(2013,'022.04.01','SSSDPL.02','Meningkatnya pelayanan dukungan administrasi dan teknis','SSPL.02','136;2013-10-22 06:34:10',NULL),(2012,'022.04.01','SSSDPL.03','Meningkatkan Pelayanan Terkait Peraturan Perundang-Undangan Dan Kehumasan ','SSPL.12','8;2013-12-04 14:09:55',NULL),(2013,'022.04.01','SSSDPL.03','Meningkatkan Pelayanan Terkait Peraturan Perundang-Undangan Dan Kehumasan ','SSPL.10','136;2013-10-22 06:35:35',NULL),(2012,'022.04.01','SSSDPL.04','Meningkatnya pelayanan terkait Perlindungan  Lingkungan Maritim','SSPL.10','8;2013-12-04 14:10:57',NULL),(2013,'022.04.01','SSSDPL.04','Meningkatnya pelayanan terkait Perlindungan  Lingkungan Maritim','SSPL.12','136;2013-10-22 06:37:17',NULL);
/*!40000 ALTER TABLE `tbl_sasaran_eselon2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sasaran_eselon2_log`
--

DROP TABLE IF EXISTS `tbl_sasaran_eselon2_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sasaran_eselon2_log` (
  `tahun` year(4) DEFAULT NULL,
  `kode_e2` varchar(10) DEFAULT NULL,
  `kode_sasaran_e2` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `kode_sasaran_e1` varchar(20) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sasaran_eselon2_log`
--

LOCK TABLES `tbl_sasaran_eselon2_log` WRITE;
/*!40000 ALTER TABLE `tbl_sasaran_eselon2_log` DISABLE KEYS */;
INSERT INTO `tbl_sasaran_eselon2_log` VALUES (2012,'022.04.01','SSSDPL.01','Meningkatnya Kualitas Sumber Daya Manusia dan teknologi pada sub sektor transportasi laut','SSPL.08','INSERT;8;2013-12-04 14:07:41'),(2012,'022.04.01','SSSDPL.02','Meningkatnya pelayanan dukungan administrasi dan teknis','SSPL.08','INSERT;8;2013-12-04 14:09:19'),(2012,'022.04.01','SSSDPL.03','Meningkatkan Pelayanan Terkait Peraturan Perundang-Undangan Dan Kehumasan ','SSPL.12','INSERT;8;2013-12-04 14:09:55'),(2012,'022.04.01','SSSDPL.04','Meningkatnya pelayanan terkait Perlindungan  Lingkungan Maritim','SSPL.10','INSERT;8;2013-12-04 14:10:57');
/*!40000 ALTER TABLE `tbl_sasaran_eselon2_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sasaran_kl`
--

DROP TABLE IF EXISTS `tbl_sasaran_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sasaran_kl` (
  `tahun` year(4) NOT NULL,
  `kode_kl` varchar(10) NOT NULL,
  `kode_sasaran_kl` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_sasaran_kl`,`tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sasaran_kl`
--

LOCK TABLES `tbl_sasaran_kl` WRITE;
/*!40000 ALTER TABLE `tbl_sasaran_kl` DISABLE KEYS */;
INSERT INTO `tbl_sasaran_kl` VALUES (2012,'022','SSKP.01','Meningkatnya keselamatan transportasi',NULL,NULL),(2013,'022','SSKP.01','Meningkatnya keselamatan transportasi',NULL,NULL),(2012,'022','SSKP.02','Meningkatnya keamanan transportasi',NULL,NULL),(2013,'022','SSKP.02','Meningkatnya keamanan transportasi',NULL,NULL),(2012,'022','SSKP.03','Meningkatnya pelayanan transportasi',NULL,NULL),(2013,'022','SSKP.03','Meningkatnya pelayanan transportasi',NULL,NULL),(2012,'022','SSKP.04','Meningkatnya pemenuhan standar teknis dan standar operasional sarana dan prasarana trasnportasi',NULL,NULL),(2013,'022','SSKP.04','Meningkatnya pemenuhan standar teknis dan standar operasional sarana dan prasarana trasnportasi',NULL,NULL),(2012,'022','SSKP.05','Meningkatnya aksesibiltas masyarakat terhadap pelayanan sarana dan prasarana transportasi guna mendorong konektivitas antar wilayah',NULL,NULL),(2013,'022','SSKP.05','Meningkatnya aksesibiltas masyarakat terhadap pelayanan sarana dan prasarana transportasi guna mendorong konektivitas antar wilayah',NULL,NULL),(2012,'022','SSKP.06','Meningkatnya manfaat sektor transportasi terhadap pertumbuhan ekonomi',NULL,NULL),(2013,'022','SSKP.06','Meningkatnya manfaat sektor transportasi terhadap pertumbuhan ekonomi',NULL,NULL),(2012,'022','SSKP.07','Meningkatnya kapasitas sarana dan prasarana transportasi untuk mengurangi backlog dan bottleneck kapasitas infrastruktur transportasi',NULL,NULL),(2013,'022','SSKP.07','Meningkatnya kapasitas sarana dan prasarana transportasi untuk mengurangi backlog dan bottleneck kapasitas infrastruktur transportasi',NULL,NULL),(2012,'022','SSKP.08','Meningkatkan peran serta Pemda, BUMN dan swasta dalam penyediaan infrastruktur transportasi ',NULL,NULL),(2013,'022','SSKP.08','Meningkatkan peran serta Pemda, BUMN dan swasta dalam penyediaan infrastruktur transportasi ',NULL,NULL),(2012,'022','SSKP.09','Meningkatnya optimalisasi pengelolaan akuntabilitas kinerja, anggaran dan BMN',NULL,NULL),(2013,'022','SSKP.09','Meningkatnya optimalisasi pengelolaan akuntabilitas kinerja, anggaran dan BMN',NULL,NULL),(2012,'022','SSKP.10','Peningkatan kualitas SDM',NULL,NULL),(2013,'022','SSKP.10','Peningkatan kualitas SDM',NULL,NULL),(2012,'022','SSKP.11','Melanjutkan reformasi regulasi',NULL,NULL),(2013,'022','SSKP.11','Melanjutkan reformasi regulasi',NULL,NULL),(2012,'022','SSKP.12','Menurunnya dampak sektor transportasi terhadap lingkungan',NULL,NULL),(2013,'022','SSKP.12','Menurunnya dampak sektor transportasi terhadap lingkungan',NULL,NULL),(2012,'022','SSKP.13','Meningkatkan pengembangan teknologi transportasi yang efisien dan ramah lingkungan sebagai antisipasi terhadap perubahan iklim',NULL,NULL),(2013,'022','SSKP.13','Meningkatkan pengembangan teknologi transportasi yang efisien dan ramah lingkungan sebagai antisipasi terhadap perubahan iklim',NULL,NULL);
/*!40000 ALTER TABLE `tbl_sasaran_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sasaran_kl_log`
--

DROP TABLE IF EXISTS `tbl_sasaran_kl_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sasaran_kl_log` (
  `tahun` year(4) DEFAULT NULL,
  `kode_kl` varchar(10) DEFAULT NULL,
  `kode_sasaran_kl` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `log` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sasaran_kl_log`
--

LOCK TABLES `tbl_sasaran_kl_log` WRITE;
/*!40000 ALTER TABLE `tbl_sasaran_kl_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sasaran_kl_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_satker`
--

DROP TABLE IF EXISTS `tbl_satker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_satker` (
  `kode_satker` varchar(20) NOT NULL,
  `kode_e1` varchar(10) NOT NULL,
  `nama_satker` varchar(50) NOT NULL,
  `singkatan` varchar(30) DEFAULT NULL,
  `nama_kasatker` varchar(50) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_satker`),
  KEY `FK_tbl_satker_e1` (`kode_e1`),
  CONSTRAINT `tbl_satker_ibfk_1` FOREIGN KEY (`kode_e1`) REFERENCES `tbl_eselon1` (`kode_e1`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_satker`
--

LOCK TABLES `tbl_satker` WRITE;
/*!40000 ALTER TABLE `tbl_satker` DISABLE KEYS */;
INSERT INTO `tbl_satker` VALUES ('022.05.01.01','022.05','Satker Setditjen Perhubungan Udara',NULL,NULL,NULL,NULL),('022.05.03.01','022.05','Satker Direktorat Bandar Udara',NULL,NULL,NULL,NULL),('022.05.04.01','022.05','Satker Direktorat Keselamatan Penerbangan',NULL,NULL,NULL,NULL),('288944','022.04','PUSAT PENELITIAN DAN PENGEMBANGAN PERHUBUNGAN LAUT',NULL,NULL,NULL,NULL),('289962','022.04','PENGEMBANGAN FASPEL LAUT WANI - SULTENG',NULL,NULL,NULL,NULL),('412772','022.04','KANTOR PUSAT DITJEN PERHUBUNGAN LAUT',NULL,NULL,NULL,NULL),('414318','022.04','PUSAT PENGEMBANGAN SUMBER DAYA MANUSIA PERHUBUNGAN',NULL,NULL,NULL,NULL),('414349','022.04','BALAI PENDIDIKAN DAN PELATIHAN TRANSPORTASI LAUT',NULL,NULL,NULL,NULL),('439180','022.04','PENINGKATAN FUNGSI KESATUAN PENJAGAAN LAUT DAN PAN',NULL,NULL,NULL,NULL),('439196','022.04','PENINGKATAN FUNGSI PERKAPALAN DAN KEPELAUTAN PUSAT',NULL,NULL,NULL,NULL),('439454','022.04','PENINGKATAN KESELAMATAN LALU LINTAS ANGKUTAN LAUT ',NULL,NULL,NULL,NULL),('448101','022.04','PENGEMBANGAN FASPEL LAUT LABUHAN AMUK/BALI',NULL,NULL,NULL,NULL),('448141','022.04','PEMBANGUNAN FASPEL LAUT BULA/MALUKU',NULL,NULL,NULL,NULL),('448157','022.04','PEMBANGUNAN FASPEL LAUT DOBO / MALUKU',NULL,NULL,NULL,NULL),('448172','022.04','PENGEMBANGAN FASPEL LAUT TEPA/MALUKU',NULL,NULL,NULL,NULL),('448188','022.04','PEMBANGUNAN FASPEL LAUT LAKOR/WULUR/MALUKU',NULL,NULL,NULL,NULL),('448208','022.04','PEMBANGUNAN FASPEL LAUT FALABISAHAYA/MALUT',NULL,NULL,NULL,NULL),('448214','022.04','PEMBANGUNAN FASPEL LAUT TANJUNG BUTON/RIAU',NULL,NULL,NULL,NULL),('448220','022.04','PEMBANGUNAN FASPEL LAUT BITUNG/SULUT',NULL,NULL,NULL,NULL),('448239','022.04','PEMBANGUNAN FASPEL LAUT POLEWALI / SULBAR',NULL,NULL,NULL,NULL),('448245','022.04','PEMBANGUNAN FASPEL LAUT TAKALAR / SULSEL',NULL,NULL,NULL,NULL),('448251','022.04','PEMBANGUNAN FASPEL LAUT PAMATATA/SELAYAR/SULSEL',NULL,NULL,NULL,NULL),('448260','022.04','PEMBANGUNAN FASPEL LAUT BULUKUMBA / SULSEL',NULL,NULL,NULL,NULL),('448276','022.04','PEMBANGUNAN FASPEL LAUT PANTOLOAN/SULTENG',NULL,NULL,NULL,NULL),('448282','022.04','PEMBANGUNAN FASPEL LAUT TANGKIANG / SULTENG',NULL,NULL,NULL,NULL),('448291','022.04','PEMBANGUNAN FASPEL LAUT BELANG/SULUT',NULL,NULL,NULL,NULL),('448293','022.04','PEMBANGUNAN FASPEL LAUT MIANGAS / SULUT',NULL,NULL,NULL,NULL),('449591','022.04','PENGEMBANGAN FASPEL LAUT REO/WAYWOLE - NTT',NULL,NULL,NULL,NULL),('449627','022.04','PENGEMBANGAN FASILITAS PELABUHAN LAUT LARANTUKA',NULL,NULL,NULL,NULL),('489913','022.04','PEMBANGUNAN FASPEL LAUT TELUK MELANO KALBAR',NULL,NULL,NULL,NULL),('497964','022.04','PEMBANGUNAN FASPEL LAUT PULAU TERLUAR KEPULAUAN RI',NULL,NULL,NULL,NULL),('497989','022.04','PEMBANGUNAN FASPEL LAUT BATANG DAN REMBANG JATENG',NULL,NULL,NULL,NULL),('498009','022.04','PEMBANGUNAN FASPEL LAUT KALBUT JATIM',NULL,NULL,NULL,NULL),('498862','022.04','PEMBANGUNAN PELABUHAN LAUT TANJUNG TEMBAGA PROBOLI',NULL,NULL,NULL,NULL),('498871','022.04','PEMBANGUNAN FASPEL LAUT SAPE DAN CARIK NTB',NULL,NULL,NULL,NULL),('498887','022.04','PEMBANGUNAN FASPEL LAUT WINI NTT',NULL,NULL,NULL,NULL),('498907','022.04','PEMBANGUNAN FASPEL LAUT WURING,KOMODO,TENAU DAN MA',NULL,NULL,NULL,NULL),('498913','022.04','PEMBANGUNAN FASPEL LAUT TELUK MELANO KALBAR',NULL,NULL,NULL,NULL),('498922','022.04','PEMBANGUNAN FASPEL LAUT SINGKAWANG KALBAR',NULL,NULL,NULL,NULL),('498938','022.04','PEMBANGUNAN FASPEL LAUT TANJUNG BATU DAN PALAIHARI',NULL,NULL,NULL,NULL),('498950','022.04','PEMBANGUNAN FASPEL LAUT KUALA SEMBOJA DAN MALOY/SA',NULL,NULL,NULL,NULL),('498969','022.04','PEMBANGUNAN FASPEL LAUT PANTOLOAN SULTENG',NULL,NULL,NULL,NULL),('498975','022.04','PEMBANGUNAN FASPEL LAUT KONAWE SULTRA',NULL,NULL,NULL,NULL),('498981','022.04','PEMBANGUNAN FASPEL LAUT MACHINI BAJI',NULL,NULL,NULL,NULL),('498990','022.04','PEMBANGUNAN FASPEL LAUT PAMATATA SULSEL',NULL,NULL,NULL,NULL),('499001','022.04','PEMBANGUNAN FASPEL LAUT PALOPO DAN BELOPA SULSEL',NULL,NULL,NULL,NULL),('499010','022.04','PEMBANGUNAN FASPEL LAUT PASANG KAYU DAN BUDONG-BUD',NULL,NULL,NULL,NULL),('499026','022.04','PEMBANGUNAN FASPEL LAUT BOMBANA SULTRA',NULL,NULL,NULL,NULL),('499032','022.04','PEMBANGUNAN FASPEL LAUT BEMO MALUKU',NULL,NULL,NULL,NULL),('499041','022.04','PEMBANGUNAN FASPEL LAUT AMBALAU MALUKU',NULL,NULL,NULL,NULL),('499057','022.04','PEMBANGUNAN FASPEL LAUT NAMROLE MALUKU',NULL,NULL,NULL,NULL),('499063','022.04','PEMBANGUNAN FASPEL LAUT ADAULT MALUKU',NULL,NULL,NULL,NULL),('499072','022.04','PEMBANGUNAN FASPEL LAUT A.YANI TERNATE MALUKU',NULL,NULL,NULL,NULL),('499330','022.04','PEMBANGUNAN FASILITAS PELABUHAN LAUT GARONGKONG',NULL,NULL,NULL,NULL),('517882','022.04','UNIT PENYELENGGARA PELABUHAN TANJUNG LAUT',NULL,NULL,NULL,NULL),('520454','022.04','PANGKALAN PENJAGAAN LAUT DAN PANTAI TANJUNG PRIOK',NULL,NULL,NULL,NULL),('528895','022.04','PANGKALAN PENJAGAAN LAUT DAN PANTAI TANJUNG UBAN',NULL,NULL,NULL,NULL),('535457','022.04','PANGKALAN PENJAGAAN LAUT DAN PANTAI BITUNG',NULL,NULL,NULL,NULL),('535841','022.04','PANGKALAN PENJAGAAN LAUT DAN PANTAI SURABAYA',NULL,NULL,NULL,NULL),('652584','022.04','PANGKALAN PENJAGAAN LAUT DAN PANTAI DINAR/TUAL',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_satker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subkegiatan_kl`
--

DROP TABLE IF EXISTS `tbl_subkegiatan_kl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subkegiatan_kl` (
  `id_subkegiatan_kl` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `kode_subkegiatan` varchar(20) NOT NULL,
  `nama_subkegiatan` varchar(255) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `volume` double NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `kode_kegiatan` varchar(20) NOT NULL,
  `kode_satker` varchar(20) NOT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_subkegiatan_kl`),
  KEY `FK_tbl_subkegiatan_kl_satker` (`kode_satker`),
  CONSTRAINT `tbl_subkegiatan_kl_ibfk_1` FOREIGN KEY (`kode_satker`) REFERENCES `tbl_satker` (`kode_satker`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subkegiatan_kl`
--

LOCK TABLES `tbl_subkegiatan_kl` WRITE;
/*!40000 ALTER TABLE `tbl_subkegiatan_kl` DISABLE KEYS */;
INSERT INTO `tbl_subkegiatan_kl` VALUES (36,2012,'022.04.08.1955.001','Penyelam','',0,'orang',65520000,'022.04.08.1955','412772',NULL,NULL),(37,2012,'022.04.08.1955.002','Teknis Penyelam','',0,'orang',43668000,'022.04.08.1955','412772',NULL,NULL),(38,2012,'022.04.08.1955.003','OPERATOR RADIO','1',1,'Paket',1587162001000,'022.04.08.1955','412772',NULL,NULL),(39,2012,'022.04.08.1955.004','PENILAIAN KONDISI TEKNIS KAPAL PATROLI DAN ABK KPLP','-',1,'Paket',1587162001000,'022.04.08.1955','412772',NULL,NULL),(40,2012,'022.04.08.1955.005','EVALUASI UJI PETIK PENUGASAN PERWIRA JAGA DALAM PENERBITAN SURAT PERINTAH BERLAYAR (SPB)','-',1,'Paket',1587162001000,'022.04.08.1955','412772',NULL,NULL),(41,2012,'022.04.08.1955.006','EVALUASI UJI PETIK PEMBERKASAN KECELAKAAN KAPAL','-',1,'Paket',1587162001000,'022.04.08.1955','412772',NULL,NULL),(42,2012,'022.04.08.1955.007','MONITORING SISTEM PELAPORAN BIDANG KPLP','-',1,'Paket',1587162001000,'022.04.08.1955','412772',NULL,NULL),(43,2012,'022.04.08.1955.008','PEMETAAN DATA SUMBER DAYA MANUSIA PETUGAS KPLP','',1,'Paket',209900000,'022.04.08.1955','412772',NULL,NULL),(44,2012,'022.04.08.1955.009','PENYUSUNAN LAKIP DAN LAPORAN TAHUNAN DIT KPLP','',1,'Paket',72020000,'022.04.08.1955','412772',NULL,NULL),(45,2012,'022.04.08.1955.010','BIMBINGAN TEKNIS ADVOKASI DAN DESIMINASI DITJEN HUBLA ','',1,'Paket',270000000,'022.04.08.1955','412772',NULL,NULL),(46,2012,'022.04.08.1955.011','LATIHAN GULANG CEMAR AKIBAT TUMPAHAN MINYAK DI LAUT (MARPOLEX)','',1,'Paket',992300000,'022.04.08.1955','412772',NULL,NULL),(47,2012,'022.04.08.1955.012','BIMBINGAN TEKNIS DASAR KPLP','',1,'Paket',270000000,'022.04.08.1955','412772',NULL,NULL),(48,2012,'022.04.08.1955.013','UJI PETIK PENANGANAN MUATAN BARANG BERBAHAYA','-',1,'Paket',100500000,'022.04.08.1955','412772',NULL,NULL),(49,2012,'022.04.08.1955.014','RAKERNIS KPLP','-',1,'Paket',150000000,'022.04.08.1955','412772',NULL,NULL),(50,2012,'022.04.08.1955.015','RAKOR TEKNIS KESYAHBANDARAN','-',1,'Paket',268368000,'022.04.08.1955','412772',NULL,NULL),(51,2012,'022.04.08.1955.016','RAKOR TEKNIS PORT STATE CONTROL OFFICER (PSCO)','-',1,'Paket',249663000,'022.04.08.1955','412772',NULL,NULL),(52,2012,'022.04.08.1955.017','MONITORING SARANA DAN PRASARANA KPLP','-',1,'Paket',125000000,'022.04.08.1955','412772',NULL,NULL),(53,2012,'022.04.08.1955.018','UJI PETIK KESIAPAN OPERASIONAL DAN PENGAWAKAN KAPAL PATROLI','-',1,'Paket',125000000,'022.04.08.1955','412772',NULL,NULL),(54,2012,'022.04.08.1955.019','SOSIALISASI PERATURAN PERLINDUNGAN MARITIM','-',1,'Paket',300000000,'022.04.08.1955','412772',NULL,NULL),(55,2012,'022.04.08.1955.020','PELATIHAN PEMBENTUKAN PETUGAS PORT STATE CONTROL OFFICER (PSCO)','-',1,'Paket',221646000,'022.04.08.1955','412772',NULL,NULL),(56,2012,'022.04.08.1955.021','PENANGANAN TANGGAP DARURAT','-',1,'Paket',450000000,'022.04.08.1955','412772',NULL,NULL),(57,2012,'022.04.08.1955.022','PENINGKATAN KETERAMPILAN ISPS CODE','-',1,'Paket',150000000,'022.04.08.1955','412772',NULL,NULL),(58,2012,'022.04.08.1955.023','PENINGKATAN KETERAMPILAN PENYELAM','-',1,'Paket',437774000,'022.04.08.1955','412772',NULL,NULL),(59,2012,'022.04.08.1955.024','UP GRADING (PENYEGARAN) PENYIDIK PEGAWAI NEGERI SIPIL (PPNS) DITJEN HUBLA','-',1,'Paket',330000000,'022.04.08.1955','412772',NULL,NULL),(60,2012,'022.04.08.1955.025','PEMBENTUKAN PENYIDIK PEGAWAI NEGERI SIPIL (PPNS) REGULER (POLA 400 JAMPEL) DITJEN HUBLA','-',1,'Paket',868300000,'022.04.08.1955','412772',NULL,NULL),(61,2012,'022.04.08.1955.026','PEMBENTUKAN PENYIDIK PEGAWAI NEGERI SIPIL (PPNS) MANAJERIAL (POLA 200 JAMPEL) DITJEN HUBLA','-',1,'Paket',466155000,'022.04.08.1955','412772',NULL,NULL),(62,2012,'022.04.08.1955.027','PENYUSUNAN PROTAP SEARCH AND RESCUE (SAR) DI PELABUHAN','-',1,'Paket',138060000,'022.04.08.1955','412772',NULL,NULL),(63,2012,'022.04.08.1955.028','PENYELENGGARAAN PENYULUHAN PETUGAS PORT STATE CONTROL (PSC) DALAM RANGKA PELAKSANAAN CIC','-',1,'Paket',212690000,'022.04.08.1955','412772',NULL,NULL),(64,2012,'022.04.08.1955.029','MONITORING EVALUASI KLARIFIKASI PENYELIDIKAN DAN PENGAWASAN KESELAMATAN PELAYARAN PADA KANTOR ADPEL DAN UPP DITJEN HUBLA','-',1,'Paket',223815000,'022.04.08.1955','412772',NULL,NULL),(65,2012,'022.04.08.1955.030','PELAKSANAAN PENYELIDIKAN DAN/ ATAU INVESTIGASI AWAL SERTA PENGAWASAN KESELAMATAN PADA UNIT PELAKSANA TEKNIS DITJEN HUBLA','-',1,'Paket',271560000,'022.04.08.1955','412772',NULL,NULL),(66,2012,'022.04.08.1955.031','PENDAMPING/ ADVOKASI BAGI PEJABAT/ PEGAWAI YANG MENJALANI TUPOKSI DITJEN HUBLA','-',1,'Paket',221400000,'022.04.08.1955','412772',NULL,NULL),(67,2012,'022.04.08.1955.032','MONITORING DALAM RANGKA PENILAIAN KONDISI TEKNIS SENJATA API DAN AMUNISI','-',1,'Paket',250020000,'022.04.08.1955','412772',NULL,NULL),(68,2012,'022.04.08.1955.033','PENYUSUNAN PROTAP PENANGGULANGAN TUMPAHAN MINYAK DI PELABUHAN','-',1,'Paket',265129000,'022.04.08.1955','412772',NULL,NULL),(69,2012,'022.04.08.1955.034','PENYUSUNAN PROTAP PEMADAM KEBAKARAN DI PELABUHAN','-',1,'Paket',375215000,'022.04.08.1955','412772',NULL,NULL),(70,2012,'022.04.08.1955.035','PENYUSUNAN PROTAP PENANGANAN KERANGKA KAPAL DAN KEGIATAN SALVAGE','-',1,'Paket',316850000,'022.04.08.1955','412772',NULL,NULL),(71,2012,'022.04.08.1955.036','UJI PETIK PETUGAS PENGAWAS KAPAL-KAPAL BERBENDERA ASING','-',1,'Paket',107690000,'022.04.08.1955','412772',NULL,NULL),(72,2012,'022.04.08.1955.037','PELATIHAN PEMERIKSAAN KECELAKAAN KAPAL','-',1,'Paket',101102000,'022.04.08.1955','412772',NULL,NULL),(73,2012,'022.04.08.1955.038','WORKSHOP PENCEGAHAN KECELAKAAN KAPAL DAN PENANGANANNYA','-',1,'Paket',285182500,'022.04.08.1955','412772',NULL,NULL),(74,2012,'022.04.08.1956.001','PENYUSUNAN LAKIP DAN LAPORAN TAHUNAN DIT LALA','-',1,'Paket',158115000,'022.04.08.1956','412772',NULL,NULL),(75,2012,'022.04.08.1956.002','PENYELENGGARAAN SAIL INDONESIA','-',1,'Paket',677290000,'022.04.08.1956','412772',NULL,NULL),(76,2012,'022.04.08.1956.003','PENINGKATAN SDM BIDANG LALA','-',1,'Paket',428665000,'022.04.08.1956','412772',NULL,NULL),(77,2012,'022.04.08.1956.004','PEMBUATAN PROGRAM APLIKASI PENERIMAAN PNBP JASA ANGKUTAN LAUT','-',1,'Paket',150000000,'022.04.08.1956','412772',NULL,NULL),(78,2012,'022.04.08.1956.005','RAPAT KERJA TEKNIS (RAKERNIS) BIDANG LALU LINTAS DAN ANGKUTAN LAUT','-',1,'Paket',376565000,'022.04.08.1956','412772',NULL,NULL),(79,2012,'022.04.08.1956.005','Pembayaran Airtime Peralatan Tracking System Pelayaran Perintis (61 try x 12 bln x 950.000)','-',1,'Paket',695400000,'022.04.08.1956','412772',NULL,NULL),(80,2012,'022.04.08.1954.001','LANGGANAN DAYA JASA RMCS','-',1,'Paket',825000000,'022.04.08.1954','412772',NULL,NULL),(81,2012,'022.04.08.1954.002','PENGELOLAAN SISTEM INFORMASI KENAVIGASIAN','-',1,'Paket',280000000,'022.04.08.1954','412772',NULL,NULL),(82,2012,'022.04.08.1954.003','PENYUSUNAN LAKIP DAN LAPORAN TAHUNAN DIT KENAVIGASIAN','-',1,'Paket',50000052,'022.04.08.1954','412772',NULL,NULL),(83,2012,'022.04.08.1954.004','PELATIHAN TENAGA SURVEYOR HIDROGRAFI KENAVIGASIAN','-',1,'Paket',800000000,'022.04.08.1954','412772',NULL,NULL),(84,2012,'022.04.08.1954.005','RAKORNIS KENAVIGASIAN','-',1,'Paket',300000000,'022.04.08.1954','412772',NULL,NULL),(85,2012,'022.04.08.1954.006','MONITORING KEGIATAN PEMBANGUNAN SARANA PRASARANA KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(86,2012,'022.04.08.1954.007','PENCOCOKAN DAN PENELITIAN PNBP JASA RAMBU','-',1,'Paket',400000000,'022.04.08.1954','412772',NULL,NULL),(87,2012,'022.04.08.1954.008','SUPERVISI PEMELIHARAAN KAPAL NEGARA KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(88,2012,'022.04.08.1954.009','MENGIKUTI SIDANG ASIA PASIFIC TELECOMMUNITY PREPARATORY GROUP (APG 2012)','-',1,'Paket',336599000,'022.04.08.1954','412772',NULL,NULL),(89,2012,'022.04.08.1954.010','SUPERVISI PEMBINAAN SBNP / MONITORING PERAMBUAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(90,2012,'022.04.08.1954.011','PEMBINAAN TEKNIS FASILITAS PANGKALAN KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(91,2012,'022.04.08.1954.012','PEMBINAAN TEKNIS TELEKOMUNIKASI PELAYARAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(92,2012,'022.04.08.1954.013','MONITORING INVENTARISASI ASSET SBNP KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(93,2012,'022.04.08.1954.014','PELATIHAN OPERATOR VTS','-',1,'Paket',448600000,'022.04.08.1954','412772',NULL,NULL),(94,2012,'022.04.08.1954.015','PELATIHAN TTP3','-',1,'Paket',400000000,'022.04.08.1954','412772',NULL,NULL),(95,2012,'022.04.08.1954.016','PELATIHAN TEKNOLOGI MEKANIK LANJUTAN','-',1,'Paket',300000000,'022.04.08.1954','412772',NULL,NULL),(96,2012,'022.04.08.1954.017','PELATIHAN OPERATOR RADIO UMUM GMDS','-',1,'Paket',400000000,'022.04.08.1954','412772',NULL,NULL),(97,2012,'022.04.08.1954.018','MENGIKUTI SIDANG IALA','-',1,'Paket',500000000,'022.04.08.1954','412772',NULL,NULL),(98,2012,'022.04.08.1954.019','FINALISASI PEMBAHASAN PERMASALAHAN STRATEGIS BIDANG KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(99,2012,'022.04.08.1954.020','PENYUSUNAN PROGRAM KENAVIGASIAN','-',1,'Paket',231616000,'022.04.08.1954','412772',NULL,NULL),(100,2012,'022.04.08.1954.021','MENGIKUTI SIDANG WORLD RADIOCOMMUNICATION CONFERENCE (WRC 2012)','-',1,'Paket',300000000,'022.04.08.1954','412772',NULL,NULL),(101,2012,'022.04.08.1954.022','SERAH TERIMA PEMBANGUNAN KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(102,2012,'022.04.08.1954.023','UPGRADING KEPALA KELOMPOK KENAVIGASIAN','-',1,'Paket',600000000,'022.04.08.1954','412772',NULL,NULL),(103,2012,'022.04.08.1954.024','PENYUSUNAN PERATURAN-PERATURAN BIDANG KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(104,2012,'022.04.08.1954.025','SOSIALISASI PERATURAN MENTERI PERHUBUNGAN NOMOR KM.25 TAHUN 2011 TENTANG SBNP DAN KM.26 TAHUN 2011 TENTANG TELEKOMUNIKASI PELAYARAN','-',1,'Paket',500000000,'022.04.08.1954','412772',NULL,NULL),(105,2012,'022.04.08.1954.026','FORUM GROUP DISCUSSION (FGD) DENGAN TIGA FOKUS PEMBAHASAN YAITU KESELAMATAN PELAYARAN, PERLINDUNGAN MARITIM DAN IMPLEMENTASI KEBIJAKAN IMO','-',1,'Paket',150025000,'022.04.08.1954','412772',NULL,NULL),(106,2012,'022.04.08.1954.027','PENGADAAN ALAT PENGOLAH DATA KENAVIGASIAN','-',1,'Paket',800000000,'022.04.08.1954','412772',NULL,NULL),(107,2012,'022.04.08.1954.028','EVALUASI & PEMBINAAN SDM KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(108,2012,'022.04.08.1954.029','PEMUTAKHIRAN IJAZAH ANT/ ATT III DAN IV PELAUT KAPAL NEGARA KENAVIGASIAN','-',1,'Paket',1000000000,'022.04.08.1954','412772',NULL,NULL),(109,2012,'022.04.08.1954.030','KONSOLIDASI STRATEGIS BIDANG KENAVIGASIAN','-',1,'Paket',200000000,'022.04.08.1954','412772',NULL,NULL),(110,2012,'022.04.08.1957.001','PEMBINAAN DATA DAN INFORMASI KEPELABUHANAN','-',1,'Paket',626652000,'022.04.08.1957','412772',NULL,NULL),(111,2012,'022.04.08.1957.002','SERAH TERIMA HASIL PEMBANGUNAN DIT. PELPENG','-',1,'Paket',100000000,'022.04.08.1957','412772',NULL,NULL),(112,2012,'022.04.08.1957.003','PENYUSUNAN PEDOMAN HARGA SATUAN PEKERJAAN PENGERUKAN','-',1,'Paket',106000000,'022.04.08.1957','412772',NULL,NULL),(113,2012,'022.04.08.1957.004','PENYUSUNAN  LAKIP DAN LAPORAN TAHUNAN  DIT. PELPENG ','-',1,'Paket',201075000,'022.04.08.1957','412772',NULL,NULL),(114,2012,'022.04.08.1957.005','UPDATING DATA OPERASIONAL PELABUHAN TAHUN 2011','-',1,'Paket',156070000,'022.04.08.1957','412772',NULL,NULL),(115,2012,'022.04.08.1957.006','PENETAPAN 5 (LIMA) LOKASI PERAIRAN PANDU PADA PELABUHAN YANG DISELENGGARAKAN OELH PEMERINTAH','-',1,'Paket',192000000,'022.04.08.1957','412772',NULL,NULL),(116,2012,'022.04.08.1957.007','MONITORING PEMBINAAN UPT DALAM RANGKA DATABASE KEPELABUHAN','-',1,'Paket',139248000,'022.04.08.1957','412772',NULL,NULL),(117,2012,'022.04.08.1957.008','MONITORING DALAM RANGKA PEMBINAAN PEMANDUAN DI 10 (SEPULUH) LOKASI PELABUHAN','-',1,'Paket',150000000,'022.04.08.1957','412772',NULL,NULL),(118,2012,'022.04.08.1957.009','MONITORING PEMBINAAN UPP DALAM RANGKA PEMBANGUNAN DAN PENGEMBANGAN PELABUHAN (ECOPORT)','-',1,'Paket',90000000,'022.04.08.1957','412772',NULL,NULL),(119,2012,'022.04.08.1957.010','MONITORING DALAM RANGKA PEMBINAAN TEKNIS OPERASIONAL PELABUHAN PADA KANTOR UPP','-',1,'Paket',350000000,'022.04.08.1957','412772',NULL,NULL),(120,2012,'022.04.08.1957.011','MONITORING KEGIATAN PENYULUHAN PETUGAS PANDU DALAM RANGKA PEMANDUAN DAN PENUNDAAN KAPAL DI PELABUHAN KHUSUS','-',1,'Paket',172700000,'022.04.08.1957','412772',NULL,NULL),(121,2012,'022.04.08.1957.012','EVALUASI PELAYANAN SARANA DAN PRASARANA PEMANDUAN DI 10 (SEPULUH) LOKASI PELABUHAN','-',1,'Paket',209100000,'022.04.08.1957','412772',NULL,NULL),(122,2012,'022.04.08.1957.013','EVALUASI KEGIATAN PELABUHAN PADA PELABUHAN KHUSUS','-',1,'Paket',300000000,'022.04.08.1957','412772',NULL,NULL),(123,2012,'022.04.08.1957.014','EVALUASI KINERJA PELAYANAN OPRS PADA PELABUHAN YG DISELENGGARAKAN PELINDO','-',1,'Paket',260000000,'022.04.08.1957','412772',NULL,NULL),(124,2012,'022.04.08.1957.015','EVALUASI SISTEM DAN PROSEDUR PELAYANAN KAPAL BARANG DAN PENUMPANG SEBAGAI TINDAK LANJUT DARI KM. 21','-',1,'Paket',243630000,'022.04.08.1957','412772',NULL,NULL),(125,2012,'022.04.08.1957.016','EVALUASI HASIL KECELAKAAN KAPAL AKIBAT PEMANDUAN DI 10 (SEPULUH) LOKASI PELABUHAN','-',1,'Paket',247260000,'022.04.08.1957','412772',NULL,NULL),(126,2012,'022.04.08.1957.017','MONITORING PEMBANGUNAN FASILITAS PELABUHAN','-',1,'Paket',450070000,'022.04.08.1957','412772',NULL,NULL),(127,2012,'022.04.08.1957.018','MONITORING SIKK DAN SIKR','-',1,'Paket',300000000,'022.04.08.1957','412772',NULL,NULL),(128,2012,'022.04.08.1957.019','PENATARAN SURVEY KEPELABUHANAN ','-',1,'Paket',426000000,'022.04.08.1957','412772',NULL,NULL),(129,2012,'022.04.08.1957.020','PEMBINAAN TARIF JASA KEPELABUHANAN PADA UPP/ ADPEL','-',1,'Paket',500000000,'022.04.08.1957','412772',NULL,NULL),(130,2012,'022.04.08.1957.021','PEMBINAAN, PEMANTAUAN, EVALUASI DAN MONITORING TERHADAP KONTRIBUSI PELAKSANAAN JASA PENUNDAAN KAPAL DI BUP','-',1,'Paket',229740000,'022.04.08.1957','412772',NULL,NULL),(131,2012,'022.04.08.1957.022','MONITORING PELAPORAN DAN PEMBUKUAN PADA KANTOR UPP/ ADPEL TARIF JASA KEPELABUHANAN','-',1,'Paket',315000000,'022.04.08.1957','412772',NULL,NULL),(132,2012,'022.04.08.1957.023','MONITORING PELAKSANAAN TARIF PUNGUTAN UANG JASA KEPELABUHANAN','-',1,'Paket',500000000,'022.04.08.1957','412772',NULL,NULL),(133,2012,'022.04.08.1957.024','UPDATING DATA/PEMUTAKHIRAN DATA DALAM RANGKA REVIEW PENETAPAN RENCANA INDUK PELABUHAN','-',1,'Paket',239773000,'022.04.08.1957','412772',NULL,NULL),(134,2012,'022.04.08.1957.025','PENETAPAN LOKASI UNTUK MENETAPKAN TITIK KOORDINAT DLKR/ DLKP PELABUHAN','-',1,'Paket',434223000,'022.04.08.1957','412772',NULL,NULL),(135,2012,'022.04.08.1957.026','RAKORNIS DIT PELPENG','-',1,'Paket',300000000,'022.04.08.1957','412772',NULL,NULL),(136,2012,'022.04.08.1957.027','KAJIAN TEKNIS DAN PEDOMAN RANCANGAN KONSESI PENGUSAHAAN DAN PENGELOLAAN TERMINAL DI PELABUHAN','-',1,'Paket',466823000,'022.04.08.1957','412772',NULL,NULL),(137,2012,'022.04.08.1958.001','PENYELENGGARAAN PENYEGARAN PENINGKATAN KUALITAS TENAGA MARINE INSPECTOR DALAM RANGKA PENGUKUHAN','-',1,'Paket',561220000,'022.04.08.1958','412772',NULL,NULL),(138,2012,'022.04.08.1958.002','DEWAN PENGUJI KEAHLIAN PELAUT','-',1,'Paket',326520000,'022.04.08.1958','412772',NULL,NULL),(139,2012,'022.04.08.1958.003','MONITORING DALAM RANGKA PENILAIAN KONDISI TEKNIS KAPAL MARINE','-',1,'Paket',65310000,'022.04.08.1958','412772',NULL,NULL),(140,2012,'022.04.08.1958.004','PELAKSANAAN TINJAUAN DAN ASSESMENT QUALITY STANDAR SYSTEM &#40;QSS&#41; PADA LEMBAGA DIKLAT KEPELAUTAN','-',1,'Paket',91550000,'022.04.08.1958','412772',NULL,NULL),(141,2012,'022.04.08.1958.005','TEMU TEKNIS KELAIKLAUTAN KAPAL','-',1,'Paket',283100000,'022.04.08.1958','412772',NULL,NULL),(142,2012,'022.04.08.1958.006','KONSINYERING PENGUKURAN KAPAL','-',1,'Paket',242400000,'022.04.08.1958','412772',NULL,NULL),(143,2012,'022.04.08.1958.007','PEMBINAAN TEKNIS PENGUKURAN KAPAL','-',1,'Paket',144030000,'022.04.08.1958','412772',NULL,NULL),(144,2012,'022.04.08.1958.008','MONITORING DALAM RANGKA UJI PETIK BIDANG KELAIKLAUTAN KAPAL','-',1,'Paket',106140000,'022.04.08.1958','412772',NULL,NULL),(145,2012,'022.04.08.1958.009','PERJALANAN DINAS DALAM RANGKA PEMBINAAN TEKNIS PENDAFTARAN DAN KEBANGSAAN KAPAL','-',1,'Paket',151620000,'022.04.08.1958','412772',NULL,NULL),(146,2012,'022.04.08.1958.010','KONSOLIDASI STANDAR KAPAL NON KENVENSI','-',1,'Paket',188750000,'022.04.08.1958','412772',NULL,NULL),(147,2012,'022.04.08.1958.011','PELAKSANAAN WORKSHOP MARPOL 73/78','-',1,'Paket',186120000,'022.04.08.1958','412772',NULL,NULL),(148,2012,'022.04.08.1958.012','PENYUSUNAN LAKIP / LAPTAH DIT KAPPEL','-',1,'Paket',71200000,'022.04.08.1958','412772',NULL,NULL),(149,2012,'022.04.08.1958.013','PEMBINAAN TEKNIS PERHITUNGAN GARIS MUAT KAPAL, PELAKSANAAN STABILITAS DAN UJI COBA BERLAYAR (SEA TRIAL) KAPAL','-',1,'Paket',147810000,'022.04.08.1958','412772',NULL,NULL),(150,2012,'022.04.08.1958.014','PEMBINAAN PNBP JASA PERKAPALAN','-',1,'Paket',77970000,'022.04.08.1958','412772',NULL,NULL),(151,2012,'022.04.08.1958.015','BIMBINGAN TEKNIS PENCEGAHAN PENCEMARAN DARI KAPAL DAN MANAJEMEN KESELAMATAN PENGOPERASIAN KAPAL','-',1,'Paket',254820000,'022.04.08.1958','412772',NULL,NULL),(152,2012,'022.04.08.1958.016','BIMBINGAN TEKNIS KAPAL KECEPATAN TINGGI (HIGH SPEED CRAFT)','-',1,'Paket',257820000,'022.04.08.1958','412772',NULL,NULL),(153,2012,'022.04.08.1958.017','BIMBINGAN TEKNIS AUDITOR ISM CODE','-',1,'Paket',236300000,'022.04.08.1958','412772',NULL,NULL),(154,2012,'022.04.08.1958.018','SISTEM INFORMASI MANAJEMEN BANK SOAL DIKLAT KEPELAUTAN','-',1,'Paket',1300000000,'022.04.08.1958','412772',NULL,NULL),(155,2012,'022.04.08.1958.019','SISTEM MANAJEMEN DOKUMEN SECARA ELEKTRONIK PENGESAHAN GAMBAR KAPAL DIT KAPPEL','-',1,'Paket',920000000,'022.04.08.1958','412772',NULL,NULL);
/*!40000 ALTER TABLE `tbl_subkegiatan_kl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `user_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `passwd` varchar(100) DEFAULT NULL,
  `group_id` smallint(6) DEFAULT NULL,
  `app_type` enum('KL','E1','E2') DEFAULT NULL,
  `unit_kerja_e1` varchar(30) DEFAULT NULL,
  `unit_kerja_e2` varchar(30) DEFAULT NULL,
  `level_id` smallint(6) DEFAULT NULL,
  `log_insert` varchar(50) DEFAULT NULL,
  `log_update` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_group` (`group_id`),
  CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tbl_group_user` (`group_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'adminkl','Administrator KL','ac8210c537b72dd8e806cc298b0f9ea3',1,'KL',NULL,NULL,2,NULL,NULL),(4,'opkl','Operator KL','ac8210c537b72dd8e806cc298b0f9ea3',1,'KL',NULL,NULL,2,NULL,NULL),(5,'ope1','Operator Eselon 1','ac8210c537b72dd8e806cc298b0f9ea3',2,'E1',NULL,NULL,2,NULL,NULL),(6,'op32','Operator Eselon 2','ac8210c537b72dd8e806cc298b0f9ea3',3,'E2',NULL,NULL,2,NULL,NULL),(7,'hubla','Direktorat Jenderal Perhubungan Laut','ac8210c537b72dd8e806cc298b0f9ea3',2,'E1','022.04','-1',2,NULL,'8;2013-02-01 14:48:56'),(8,'superadmin','Administrator','734f1ec8d0d701d935eeb4c1d919f185',7,NULL,'-1','-1',1,NULL,'8;2013-09-02 05:25:04'),(95,'hubla2','Direktorat Jenderal Perhubungan Laut','ac8210c537b72dd8e806cc298b0f9ea3',2,'E1','022.04','-1',4,NULL,'8;2013-02-01 14:51:54'),(100,'guestkl','Guest Kementerian','66f7649530c0e3d593a484660804866a',1,'KL','-1','-1',5,'8;2013-06-11 10:40:04','8;2013-09-02 17:59:17'),(101,'gueste1','Guest Eselon 1','ac8210c537b72dd8e806cc298b0f9ea3',2,NULL,'-1','-1',5,'8;2013-09-02 18:00:11',NULL);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-04 19:57:32
