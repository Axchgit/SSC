-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-01-02 09:45:00
-- 服务器版本： 5.7.24
-- PHP 版本： 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `ssc`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` char(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `salt`) VALUES
(1, 'admin', '58a03a518ca2f62ab1583cc7fe6786f3', 'iTca');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `cno` char(4) NOT NULL,
  `cname` char(16) NOT NULL,
  `credit` int(3) DEFAULT NULL,
  `tno` char(6) DEFAULT NULL,
  PRIMARY KEY (`cno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`cno`, `cname`, `credit`, `tno`) VALUES
('1004', '数据库系统', 4, '100001'),
('1012', '计算机网络', 3, NULL),
('4002', '数字电路', 3, '400007'),
('8001', '高等数学', 4, '800014'),
('1201', '英语', 4, '120036');

-- --------------------------------------------------------

--
-- 表的结构 `course_material`
--

DROP TABLE IF EXISTS `course_material`;
CREATE TABLE IF NOT EXISTS `course_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cno` int(11) DEFAULT NULL,
  `tno` int(11) NOT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `uploaddate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course_material`
--

INSERT INTO `course_material` (`id`, `cno`, `tno`, `mname`, `address`, `uploaddate`) VALUES
(20, 1004, 100001, '11', './public/course_material/php之进步.docx', '2020-01-02 09:29:53'),
(21, 1004, 100001, '11', './public/course_material/php之进步.docx', '2020-01-02 09:30:52'),
(22, 1004, 100001, '11', './public/course_material/', '2020-01-02 09:30:59'),
(23, 1004, 100001, '113', './public/course_material/', '2020-01-02 09:31:06');

-- --------------------------------------------------------

--
-- 表的结构 `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `sno` char(6) NOT NULL,
  `cno` char(4) NOT NULL,
  `grade` int(5) DEFAULT NULL,
  PRIMARY KEY (`sno`,`cno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `score`
--

INSERT INTO `score` (`sno`, `cno`, `grade`) VALUES
('121001', '1004', NULL),
('121002', '1004', 9),
('121004', '1004', 82),
('124001', '4002', 94),
('124002', '4002', 74),
('124003', '4002', 87),
('121001', '8001', 94),
('121002', '8001', 88),
('121004', '8001', 81),
('124001', '8001', 95),
('124002', '8001', 73),
('124003', '8001', 86),
('121001', '1201', NULL),
('121002', '1201', 87),
('121004', '1201', 76),
('124001', '1201', 92),
('124002', '1201', NULL),
('124003', '1201', 86),
('121001', '4002', NULL),
('121001', '1012', NULL),
('121008', '1004', NULL),
('124001', '1004', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `sno` char(6) NOT NULL,
  `password` char(12) NOT NULL,
  `sname` char(8) NOT NULL,
  `ssex` char(2) DEFAULT NULL,
  `sbirthday` date NOT NULL,
  `speciality` char(12) DEFAULT NULL,
  `sclass` char(6) DEFAULT NULL,
  `tc` int(4) DEFAULT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`sno`, `password`, `sname`, `ssex`, `sbirthday`, `speciality`, `sclass`, `tc`) VALUES
('121001', '123', '刘鹏翔', '男', '1992-08-25', '计算机', '201205', 52),
('121002', '123456', '李佳慧', '女', '1993-02-18', '计算机', '201205', 50),
('124001', '123456', '林琴', '女', '1992-03-21', '通信', '201236', 52),
('124002', '123456', '杨春容', '女', '1992-12-04', '通信', '201236', 48),
('124003', '123456', '徐良成', '男', '1993-05-15', '通信', '201236', 50),
('121008', '123456', '星辰好', '男', '2019-12-04', '计算机', '1000', 11);

-- --------------------------------------------------------

--
-- 表的结构 `student_work`
--

DROP TABLE IF EXISTS `student_work`;
CREATE TABLE IF NOT EXISTS `student_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wname` varchar(20) DEFAULT NULL,
  `sno` int(11) DEFAULT NULL,
  `sname` varchar(10) DEFAULT NULL,
  `cno` int(11) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `uploaddate` datetime DEFAULT NULL,
  `score` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student_work`
--

INSERT INTO `student_work` (`id`, `wname`, `sno`, `sname`, `cno`, `address`, `uploaddate`, `score`) VALUES
(7, NULL, NULL, NULL, 1004, NULL, NULL, NULL),
(8, NULL, NULL, NULL, 1004, NULL, NULL, NULL),
(9, NULL, NULL, NULL, 1004, NULL, NULL, NULL),
(10, NULL, NULL, NULL, 1004, NULL, NULL, NULL),
(11, NULL, NULL, NULL, 1004, NULL, NULL, NULL),
(12, NULL, NULL, NULL, 1004, NULL, NULL, NULL),
(13, '1111', 121001, '刘鹏翔', 1004, './public/student_work/php之进步.docx', '2020-01-02 09:16:55', NULL),
(14, '111', 121001, '刘鹏翔', 1004, './public/student_work/', '2020-01-02 09:17:27', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `tno` char(6) NOT NULL,
  `password` char(12) NOT NULL,
  `tname` char(8) NOT NULL,
  `tsex` char(2) NOT NULL,
  `tbirthday` date NOT NULL,
  `title` char(12) DEFAULT NULL,
  `school` char(12) DEFAULT NULL,
  PRIMARY KEY (`tno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`tno`, `password`, `tname`, `tsex`, `tbirthday`, `title`, `school`) VALUES
('100001', '123', '张博宇', '男', '1968-05-09', '教授', '计算机学院'),
('100021', '123456', '谢伟业', '男', '1982-11-07', '讲师', '计算机学院'),
('400007', '123456', '黄海玲', '女', '1976-04-21', '教授', '通信学院'),
('800014', '123456', '曾杰', '男', '1975-03-14', '副教授', '数学学院'),
('120036', '123456', '刘巧红', '女', '1972-01-28', '副教授', '外国语学院');

-- --------------------------------------------------------

--
-- 表的结构 `teacher_work`
--

DROP TABLE IF EXISTS `teacher_work`;
CREATE TABLE IF NOT EXISTS `teacher_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wname` varchar(20) NOT NULL,
  `cno` int(10) DEFAULT NULL,
  `tno` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `uploaddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher_work`
--

INSERT INTO `teacher_work` (`id`, `wname`, `cno`, `tno`, `address`, `uploaddate`) VALUES
(14, '1111', 1004, 100001, './public/teacher_work/', '2020-01-02 09:44:12'),
(12, '11', 1004, 100001, './public/teacher_work/文档 2.docx', '2019-12-18 07:49:55'),
(13, '111', 1004, 100001, './public/teacher_work/', '2020-01-02 09:44:04'),
(15, '11', 1004, 100001, './public/teacher_work/', '2020-01-02 09:44:18'),
(16, '11', 1004, 100001, './public/teacher_work/', '2020-01-02 09:44:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
