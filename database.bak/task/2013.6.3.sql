/*
SQLyog Community v11.11 (32 bit)
MySQL - 5.1.30 : Database - m_question_133
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`m_question_133` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `m_question_133`;

/*Table structure for table `m_file` */

DROP TABLE IF EXISTS `m_file`;

CREATE TABLE `m_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(28) NOT NULL DEFAULT '',
  `file_size` varchar(28) NOT NULL DEFAULT '',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `m_file` */

insert  into `m_file`(`file_id`,`file_name`,`file_size`) values (2,'问答定义.xlsx','354.88');

/*Table structure for table `m_global` */

DROP TABLE IF EXISTS `m_global`;

CREATE TABLE `m_global` (
  `global_id` int(11) NOT NULL AUTO_INCREMENT,
  `global_pic_index` int(11) NOT NULL DEFAULT '10000' COMMENT '图片编号',
  `global_version` int(11) NOT NULL DEFAULT '1' COMMENT '使用题库版本号',
  PRIMARY KEY (`global_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

/*Data for the table `m_global` */

insert  into `m_global`(`global_id`,`global_pic_index`,`global_version`) values (1,10001,3);

/*Table structure for table `m_gm_dialog_1` */

DROP TABLE IF EXISTS `m_gm_dialog_1`;

CREATE TABLE `m_gm_dialog_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` int(11) NOT NULL DEFAULT '0',
  `rolename` varchar(28) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_ask_info` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_ask_time` int(11) NOT NULL DEFAULT '0',
  `gm_answer_info` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `gm_answer_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_roleid` (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `m_gm_dialog_1` */

insert  into `m_gm_dialog_1`(`id`,`roleid`,`rolename`,`role_ask_info`,`role_ask_time`,`gm_answer_info`,`gm_answer_time`) values (1,6,'T','T',1370083113,'',0),(2,6,'T','T',1370083390,'',0),(3,6,'T','T',1370083764,'',0),(4,6,'T','T',1370089814,'',0),(5,6,'T','T',1370094903,'',0),(6,6,'T','T',1370096726,'',0);

/*Table structure for table `m_gm_dialog_5` */

DROP TABLE IF EXISTS `m_gm_dialog_5`;

CREATE TABLE `m_gm_dialog_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` int(11) NOT NULL DEFAULT '0',
  `rolename` varchar(28) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_ask_info` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_ask_time` int(11) NOT NULL DEFAULT '0',
  `gm_answer_info` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `gm_answer_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_roleid` (`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `m_gm_dialog_5` */

/*Table structure for table `m_group` */

DROP TABLE IF EXISTS `m_group`;

CREATE TABLE `m_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `group_name` varchar(20) NOT NULL DEFAULT '',
  `group_permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `m_group` */

insert  into `m_group`(`id`,`group_id`,`group_name`,`group_permission`) values (1,1,'系统管理员',''),(2,2,'审核员',''),(3,3,'出题者','');

/*Table structure for table `m_history` */

DROP TABLE IF EXISTS `m_history`;

CREATE TABLE `m_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(28) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '9999',
  `question_type` int(11) NOT NULL DEFAULT '9999',
  `difficult` int(11) NOT NULL DEFAULT '9999',
  `user` varchar(28) NOT NULL DEFAULT 'all',
  `auditer` varchar(28) NOT NULL DEFAULT 'all',
  `date_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL DEFAULT '9999',
  `condition` tinyint(4) NOT NULL DEFAULT '1',
  `search` varchar(28) NOT NULL DEFAULT '',
  `order_item` tinyint(4) NOT NULL DEFAULT '1',
  `order` tinyint(4) NOT NULL DEFAULT '1',
  `pagination` int(11) NOT NULL DEFAULT '1',
  `total_pagination` int(11) NOT NULL DEFAULT '1',
  `exam` int(4) NOT NULL DEFAULT '1',
  `handicap` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `m_history` */

insert  into `m_history`(`id`,`user_name`,`type`,`question_type`,`difficult`,`user`,`auditer`,`date_start`,`date_end`,`status`,`condition`,`search`,`order_item`,`order`,`pagination`,`total_pagination`,`exam`,`handicap`) values (1,'admin',9999,9999,9999,'admin','all','0000-00-00 00:00:00','0000-00-00 00:00:00',2,1,'',1,1,1,1,21,3),(2,'chensi',9,9999,3,'all','all','0000-00-00 00:00:00','0000-00-00 00:00:00',9999,2,'',1,2,1,29,13,1),(3,'yinguojun',9,9999,9999,'yinguojun','all','2013-06-03 00:00:00','0000-00-00 00:00:00',9999,1,'',1,1,3,3,9,3),(4,'wangdongyi',9999,9999,9999,'wangdongyi','all','0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,'',1,1,1,1,21,2),(5,'lw',16,9999,9999,'SNY','all','0000-00-00 00:00:00','0000-00-00 00:00:00',9999,1,'',1,1,2,20,1,1),(6,'caimin',9999,1,1,'all','all','0000-00-00 00:00:00','0000-00-00 00:00:00',9999,1,'',1,1,1,1,1,1),(7,'qjc',9999,9999,9999,'chensi','all','0000-00-00 00:00:00','0000-00-00 00:00:00',9999,1,'',1,1,2,9,13,1),(8,'SNY',6,0,1,'all','all','0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,'',1,1,1,6,8,3);

/*Table structure for table `m_log` */

DROP TABLE IF EXISTS `m_log`;

CREATE TABLE `m_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_submit` varchar(28) NOT NULL DEFAULT '',
  `time_submit` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `question_num` int(11) NOT NULL DEFAULT '0',
  `question_detail` text NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `m_log` */

insert  into `m_log`(`log_id`,`name_submit`,`time_submit`,`question_num`,`question_detail`) values (1,'admin','2013-05-22 16:16:11',6305,'导入6305道题'),(2,'admin','2013-06-03 12:00:06',1,'off:[16110]'),(3,'admin','2013-06-03 15:20:25',1,'off:[14199]');

/*Table structure for table `m_question` */

DROP TABLE IF EXISTS `m_question`;

CREATE TABLE `m_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '索引',
  `type` int(4) NOT NULL DEFAULT '1' COMMENT '题库类型',
  `difficulty` smallint(6) NOT NULL DEFAULT '0' COMMENT '难度',
  `purpose` smallint(6) NOT NULL DEFAULT '0' COMMENT '用途',
  `question` varchar(256) NOT NULL DEFAULT '' COMMENT '题目-最多42个汉字',
  `icon` int(11) NOT NULL DEFAULT '0' COMMENT '图片编号',
  `pic_size` varchar(16) NOT NULL DEFAULT '0' COMMENT '图片大小',
  `question_type` smallint(6) NOT NULL DEFAULT '0' COMMENT '题目类型-0文字题1图形题2填字题3触摸题',
  `answer_num` tinyint(4) NOT NULL DEFAULT '0' COMMENT '答案个数-填字游戏需要知道要填几个空，只需要1个答案的题默认填0即可',
  `answer_1` varchar(64) NOT NULL DEFAULT '' COMMENT '最多12个汉字',
  `answer_2` varchar(64) NOT NULL DEFAULT '',
  `answer_3` varchar(64) NOT NULL DEFAULT '',
  `answer_4` varchar(64) NOT NULL DEFAULT '',
  `answer_5` varchar(64) NOT NULL DEFAULT '',
  `answer_6` varchar(64) NOT NULL DEFAULT '',
  `answer_7` varchar(64) NOT NULL DEFAULT '',
  `answer_8` varchar(64) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '题目的状态-1已删除0-未审核1审核未通过2-审核通过未更新到游戏内3-上架4-提交到使用题库5-使用中6-不使用',
  `name_origin` varchar(28) NOT NULL DEFAULT '' COMMENT '出题者',
  `name_update` varchar(28) NOT NULL DEFAULT '' COMMENT '最后修改人',
  `name_audit` varchar(28) NOT NULL DEFAULT '' COMMENT '审核者',
  `suggestion` varchar(256) NOT NULL DEFAULT '' COMMENT '修改意见',
  `time_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=22330 DEFAULT CHARSET=utf8;

/*Data for the table `m_question` */


/*Table structure for table `m_system` */

DROP TABLE IF EXISTS `m_system`;

CREATE TABLE `m_system` (
  `system_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `subindex` int(11) NOT NULL DEFAULT '1',
  `subtotalindex` int(11) NOT NULL DEFAULT '1',
  `offindex` int(11) NOT NULL DEFAULT '1',
  `offtotalindex` int(11) NOT NULL DEFAULT '1',
  `keyword` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`system_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `m_system` */

insert  into `m_system`(`system_id`,`user_name`,`subindex`,`subtotalindex`,`offindex`,`offtotalindex`,`keyword`) values (1,'admin',186,188,1,1,'2在地球上'),(2,'chensi',1,188,1,1,''),(3,'yinguojun',1,188,1,1,''),(4,'wangdongyi',1,188,1,1,''),(5,'lw',1,188,1,1,''),(6,'caimin',1,188,1,1,''),(7,'qjc',1,188,1,1,''),(8,'SNY',1,188,1,1,'');

/*Table structure for table `m_type_config` */

DROP TABLE IF EXISTS `m_type_config`;

CREATE TABLE `m_type_config` (
  `type_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `type_name` varchar(64) NOT NULL DEFAULT '',
  `section` int(11) NOT NULL DEFAULT '0',
  `status` smallint(4) NOT NULL DEFAULT '1',
  `visible` smallint(4) NOT NULL DEFAULT '1',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`type_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `m_type_config` */

insert  into `m_type_config`(`type_config_id`,`type_id`,`type_name`,`section`,`status`,`visible`,`update_time`) values (1,1,'热点',1,1,1,'0000-00-00 00:00:00'),(2,2,'音乐',1,1,1,'0000-00-00 00:00:00'),(3,3,'健康',12,1,1,'0000-00-00 00:00:00'),(4,4,'影视',1,1,1,'0000-00-00 00:00:00'),(5,5,'时尚',6,1,1,'0000-00-00 00:00:00'),(6,6,'科普',15,1,1,'0000-00-00 00:00:00'),(7,7,'宠物',7,1,1,'0000-00-00 00:00:00'),(8,8,'美食',8,1,1,'0000-00-00 00:00:00'),(9,9,'游戏',5,1,1,'0000-00-00 00:00:00'),(10,10,'娱乐',2,1,1,'0000-00-00 00:00:00'),(11,11,'搞怪',1,1,1,'0000-00-00 00:00:00'),(12,12,'动漫',3,1,1,'0000-00-00 00:00:00'),(13,13,'旅游',9,1,1,'0000-00-00 00:00:00'),(14,14,'生活',10,1,1,'0000-00-00 00:00:00'),(15,15,'体育',16,1,1,'0000-00-00 00:00:00'),(16,16,'小时候',1,1,1,'0000-00-00 00:00:00'),(17,17,'公务员',13,1,1,'0000-00-00 00:00:00'),(18,18,'文学',11,1,1,'0000-00-00 00:00:00'),(19,19,'英语',4,1,1,'0000-00-00 00:00:00'),(20,20,'星座',14,1,1,'0000-00-00 00:00:00'),(21,21,'综合',1,1,1,'0000-00-00 00:00:00'),(22,3000,'微信',999,1,1,'0000-00-00 00:00:00'),(23,3001,'PK',999,1,1,'0000-00-00 00:00:00');

/*Table structure for table `m_user` */

DROP TABLE IF EXISTS `m_user`;

CREATE TABLE `m_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `user_realname` varchar(50) NOT NULL DEFAULT '',
  `user_password` varchar(50) NOT NULL DEFAULT '',
  `user_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `m_user` */

insert  into `m_user`(`user_id`,`group_id`,`user_name`,`user_realname`,`user_password`,`user_status`) values (1,1,'admin','管理员','2295599446cdc6afbf2242181839f66c',1),(2,2,'chensi','陈思','2546dc8897d68b19f992186cdbb5ce65',1),(3,3,'yinguojun','尹国俊','6b5c347852b45a3ce3d96794e3a4bc93',1),(4,3,'wangdongyi','王东艺','f07642c710945944200524f0b2d6ed7d',1),(5,2,'lw','王正中','0b2bf133556f9c363a8a5a68c710628e',1),(6,3,'caimin','蔡敏','7e55a4f8291e5f953cbbebbd0f9cebd7',1),(7,3,'qjc','钱京晨','4177244a9bbc1bb1ef2d7b4e0f490698',1),(8,3,'SNY','邵宁宇','3ac554e01fba908a529785c3853eaa2a',1);

/*Table structure for table `m_user_details` */

DROP TABLE IF EXISTS `m_user_details`;

CREATE TABLE `m_user_details` (
  `user_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(28) NOT NULL DEFAULT '',
  `user_details_audit_pass` int(11) NOT NULL DEFAULT '0',
  `user_details_audit_not_pass` int(11) NOT NULL DEFAULT '0',
  `user_details_audit_need` int(11) NOT NULL DEFAULT '0',
  `user_details_record` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_details_this` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_details_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `m_user_details` */

insert  into `m_user_details`(`user_details_id`,`user_name`,`user_details_audit_pass`,`user_details_audit_not_pass`,`user_details_audit_need`,`user_details_record`,`user_details_this`) values (1,'admin',1,0,0,'2013-06-03 17:22:27','2013-06-03 17:22:27'),(2,'chensi',151,0,0,'2013-06-03 17:22:27','2013-06-03 09:38:41'),(3,'yinguojun',1236,0,1060,'2013-06-03 17:22:27','2013-06-03 12:50:58'),(4,'wangdongyi',0,0,1,'2013-06-03 17:22:27','2013-05-28 17:16:27'),(5,'lw',0,0,0,'2013-06-03 17:22:27','2013-06-03 15:25:44'),(6,'caimin',0,0,0,'2013-06-03 17:22:27','2013-05-22 15:43:23'),(7,'qjc',662,9,133,'2013-06-03 17:22:27','2013-06-03 12:04:25'),(8,'SNY',918,0,892,'2013-06-03 17:22:27','2013-06-03 13:36:20');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;