SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for courses
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `sks` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of courses
-- ----------------------------
BEGIN;
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (1, 'Algoritma dan Struktur Data', 'Semester 1', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (2, 'Basis Data', 'Semester 1', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (3, 'Sistem Operasi', 'Semester 2', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (4, 'Pemrograman Web', 'Semester 2', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (5, 'Jaringan Komputer', 'Semester 3', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (6, 'Kecerdasan Buatan', 'Semester 3', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (7, 'Rekayasa Perangkat Lunak', 'Semester 4', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (8, 'Manajemen Proyek TI', 'Semester 4', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (9, 'Pemrograman Mobile', 'Semester 5', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (10, 'Pemrograman Phyton', 'Semester 5', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (11, 'Keamanan Sistem Informasi', 'Semester 6', '3');
INSERT INTO `courses` (`id`, `course_name`, `semester`, `sks`) VALUES (12, 'Pengolahan Citra Digital', 'Semester 6', '3');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `username`, `password`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
