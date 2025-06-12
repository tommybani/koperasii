/*
 Navicat Premium Data Transfer

 Source Server         : ini mysql
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : koperasi

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 12/06/2025 13:57:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anggota
-- ----------------------------
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota`  (
  `anggota_id` int NOT NULL AUTO_INCREMENT,
  `anggota_no` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `anggota_nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `anggota_jk` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `anggota_tempat_lahir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `anggota_tanggal_lahir` date NOT NULL,
  `anggota_alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `anggota_no_identitas` int NOT NULL,
  `anggota_password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `anggota_hp` int NOT NULL,
  `anggota_foto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`anggota_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of anggota
-- ----------------------------
INSERT INTO `anggota` VALUES (13, 'A001', 'TOMMY BANI ADAM', 'L', 'apa', '2020-04-16', 'apa', 123, '5e8e6d2768bf9647437b0ece437827f8', 123, 'fe9f5e522a3469d873e0f03ee9a5d490.PNG');
INSERT INTO `anggota` VALUES (14, 'A002', 'IBNU BUKHARI', 'L', 'jakarta', '2020-04-24', 'APA', 123, '0f7aa6216bb1777dede73e2ad229ddcc', 123, '1aaea601e926cdeb462e3a786396e700.PNG');
INSERT INTO `anggota` VALUES (15, 'A003', 'ARNI', 'L', 'Jakarta', '2020-12-08', 'Cilacap', 123456789, '13627043a91878db780fb7fcd7e0c147', 4234324, '5dcb014af58babcc90ac3c0982c1694e.PNG');
INSERT INTO `anggota` VALUES (16, 'A004', 'YUNITA', 'P', 'jakarta', '2020-12-09', 'Cilacap', 575757575, '771393b4e52f91157c7a2dc3ab198037', 67676, '8aafb551c609fa638f60660ff9f98d64.PNG');
INSERT INTO `anggota` VALUES (17, 'A005', 'IQBAL TES', 'L', 'jakart', '2025-06-05', 'aaaa\r\nbbbbbbbb', 2147483647, '21d19c3560ddb85975b9dd27388b95b7', 9999, '84280832628349ce687fd49de98af2a5.jpg');

-- ----------------------------
-- Table structure for jenis_simpan
-- ----------------------------
DROP TABLE IF EXISTS `jenis_simpan`;
CREATE TABLE `jenis_simpan`  (
  `id_jenis` int NOT NULL AUTO_INCREMENT,
  `jenis_simpanan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_jenis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_simpan
-- ----------------------------
INSERT INTO `jenis_simpan` VALUES (1, 'Tabungan', 10000);
INSERT INTO `jenis_simpan` VALUES (2, 'Simpanan Pokok', 10000);

-- ----------------------------
-- Table structure for pengambilan
-- ----------------------------
DROP TABLE IF EXISTS `pengambilan`;
CREATE TABLE `pengambilan`  (
  `id_ambil` int NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `anggota_no` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jenis` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  `user_id` int NOT NULL,
  `tglinsert` datetime NOT NULL,
  PRIMARY KEY (`id_ambil`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pengambilan
-- ----------------------------
INSERT INTO `pengambilan` VALUES (4, '2020-12-09', 'A004', '1', 100000, 1, '2020-12-09 11:24:49');
INSERT INTO `pengambilan` VALUES (5, '2025-06-12', 'A005', '1', 10000, 1, '2025-06-12 06:50:53');

-- ----------------------------
-- Table structure for perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `perusahaan`;
CREATE TABLE `perusahaan`  (
  `perusahaan_id` int NOT NULL AUTO_INCREMENT,
  `judulurl` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_perusahaan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `lisensi_app` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`perusahaan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of perusahaan
-- ----------------------------
INSERT INTO `perusahaan` VALUES (1, 'KSU Karya Sejahtera', 'KSU Karya Sejahtera', 'KSU Karya Sejahtera', 'Kel. Gisikdrono, Kec. Semarang Barat, Kota Semarang', 'Lisensi XYZ');

-- ----------------------------
-- Table structure for pinjaman_detail
-- ----------------------------
DROP TABLE IF EXISTS `pinjaman_detail`;
CREATE TABLE `pinjaman_detail`  (
  `pinjaman_id_detail` int NOT NULL AUTO_INCREMENT,
  `id_pinjam` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cicilan` smallint NOT NULL,
  `angsuran` int NOT NULL,
  `bunga` int NOT NULL,
  `tgl_jatuh_tempo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jumlah_bayar` int NOT NULL,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`pinjaman_id_detail`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 103 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pinjaman_detail
-- ----------------------------
INSERT INTO `pinjaman_detail` VALUES (91, 'P0001', 1, 166667, 33333, '2020-12-08', '2020-12-08', 200000, '');
INSERT INTO `pinjaman_detail` VALUES (92, 'P0001', 2, 166667, 33333, '2021-01-08', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (93, 'P0001', 3, 166667, 33333, '2021-02-08', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (94, 'P0001', 4, 166667, 33333, '2021-03-08', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (95, 'P0001', 5, 166667, 33333, '2021-04-08', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (96, 'P0001', 6, 166667, 33333, '2021-05-08', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (97, 'P0002', 1, 166667, 33333, '2020-12-09', '2020-12-09', 200000, '');
INSERT INTO `pinjaman_detail` VALUES (98, 'P0002', 2, 166667, 33333, '2021-01-09', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (99, 'P0002', 3, 166667, 33333, '2021-02-09', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (100, 'P0002', 4, 166667, 33333, '2021-03-09', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (101, 'P0002', 5, 166667, 33333, '2021-04-09', '0000-00-00', 0, '');
INSERT INTO `pinjaman_detail` VALUES (102, 'P0002', 6, 166667, 33333, '2021-05-09', '0000-00-00', 0, '');

-- ----------------------------
-- Table structure for pinjaman_header
-- ----------------------------
DROP TABLE IF EXISTS `pinjaman_header`;
CREATE TABLE `pinjaman_header`  (
  `pinjam_id` int NOT NULL AUTO_INCREMENT,
  `id_pinjam` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl` date NOT NULL,
  `anggota_no` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  `lama` smallint NOT NULL,
  `bunga` smallint NOT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `biaya_admin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `simpanan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah_diterima` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pinjam_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pinjaman_header
-- ----------------------------
INSERT INTO `pinjaman_header` VALUES (18, 'P0001', '2020-12-08', 'A003', 1000000, 6, 20, '1', '100000', '100000', '800000');
INSERT INTO `pinjaman_header` VALUES (19, 'P0002', '2020-12-09', 'A004', 1000000, 6, 20, '1', '100000', '100000', '800000');

-- ----------------------------
-- Table structure for simpanan
-- ----------------------------
DROP TABLE IF EXISTS `simpanan`;
CREATE TABLE `simpanan`  (
  `id_simpanan` int NOT NULL AUTO_INCREMENT,
  `jumlah` int NOT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tglinsert` datetime NOT NULL,
  `tgl` date NOT NULL,
  `anggota_no` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jenis` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_simpanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of simpanan
-- ----------------------------
INSERT INTO `simpanan` VALUES (7, 100000, '1', '2020-12-08 05:28:37', '2020-12-08', 'A003', '2');
INSERT INTO `simpanan` VALUES (8, 200000, '1', '2020-12-09 11:19:58', '2020-12-09', 'A004', '1');
INSERT INTO `simpanan` VALUES (9, 100000, '1', '2020-12-09 11:21:10', '2020-12-09', 'A004', '2');
INSERT INTO `simpanan` VALUES (10, 80000, '1', '2025-06-12 06:50:28', '2025-06-12', 'A005', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` int NOT NULL,
  `foto` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Aeny Azimah Kafabih', 0, 'aku.JPEG');
INSERT INTO `user` VALUES (3, 'arni', '13627043a91878db780fb7fcd7e0c147', 'Aeny Azimah Kafabih', 0, '');

SET FOREIGN_KEY_CHECKS = 1;
