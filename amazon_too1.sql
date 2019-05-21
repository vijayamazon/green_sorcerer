/*
SQLyog Community v12.5.1 (32 bit)
MySQL - 10.1.21-MariaDB : Database - amazon_tool
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`amazon_tool` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `amazon_tool`;

/*Table structure for table `amazon_profile` */

DROP TABLE IF EXISTS `amazon_profile`;

CREATE TABLE `amazon_profile` (
  `profile_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `profile_name` varchar(50) DEFAULT NULL,
  `seller_id` varchar(200) DEFAULT NULL,
  `auth_token` varchar(200) DEFAULT NULL,
  `access_key` varchar(200) DEFAULT NULL,
  `secret_key` varchar(200) DEFAULT NULL,
  `market_placeID` varchar(200) DEFAULT NULL,
  `markup_percent` float DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `amazon_profile` */

insert  into `amazon_profile`(`profile_id`,`profile_name`,`seller_id`,`auth_token`,`access_key`,`secret_key`,`market_placeID`,`markup_percent`) values 
(1,NULL,'A1RA2ZXUXLN6LW','amzn.mws.02af8e79-34db-5c46-72c9-158137c11ebd','AKIAJC2JEYCOZCQBYHGQ','JG+cHGVNX3CE1mJfEfbuEmUNQ3Po99sZCHPZfCfh','ATVPDKIKX0DER',50),
(2,NULL,'A1RA2ZXUXLN6LW','amzn.mws.02af8e79-34db-5c46-72c9-158137c11ebd','AKIAJC2JEYCOZCQBYHGQ','JG+cHGVNX3CE1mJfEfbuEmUNQ3Po99sZCHPZfCfh','A2EUQ1WTGCTBG2',50),
(3,NULL,'A1RA2ZXUXLN6LW','amzn.mws.02af8e79-34db-5c46-72c9-158137c11ebd','AKIAJC2JEYCOZCQBYHGQ','JG+cHGVNX3CE1mJfEfbuEmUNQ3Po99sZCHPZfCfh','A1AM78C64UM0Y8',50),
(4,NULL,'AFZ57S5NFQP29','amzn.mws.a0af09b6-8393-e9dc-0b83-4500b60ea4b1','AKIAJXC3NNU6INW2KPUQ','HXrmZ5YZvbw9oo+o4budSvuuWsKSYQp/ugt7eBHj','A1F83G8C2ARO7P',50),
(5,NULL,'A38SKQOKQ9RWGO','amzn.mws.8eab4db2-b81c-7d73-740b-63f78963da13','AKIAITPWI2CN73F44AFQ','CqkK54+dPBEZc1KeuN0kQfPfU+lo1g257CUjaNdd','A21TJRUUN4KGV',50),
(6,NULL,'A348XNKTAV3MDV','amzn.mws.2eb0eb59-b33f-ecda-e7ea-2fce349a8240','AKIAIVMO6YHTPXJOATCQ','vgUq5AfCYEQ9bh0XFEOG/BxCwOEt7h9c1t/hp5XJ','A1VC38T7YXB528',NULL);

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values 
('sg54bv3t5aovjbnuku5gs2nsdkod3fp4','::1',1524134220,'__ci_last_regenerate|i:1524134061;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('il1apo3s6go6ali99lorjloodmrjrkfd','::1',1524134743,'__ci_last_regenerate|i:1524134550;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('llmf2ri1nmqmqig07qnkvvmllk6fkvlu','::1',1524136882,'__ci_last_regenerate|i:1524136878;'),
('qe6kt9ppuqbouuvn5jd6rfjneff0vbgf','::1',1524136531,'__ci_last_regenerate|i:1524136364;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('q3r3kljbhs5u2u6k7npbr7s5bubkuk1q','::1',1524136049,'__ci_last_regenerate|i:1524135967;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}');

/*Table structure for table `product_info` */

DROP TABLE IF EXISTS `product_info`;

CREATE TABLE `product_info` (
  `pro_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pro_isbn` varchar(30) DEFAULT NULL,
  `pro_asin` varchar(30) DEFAULT NULL,
  `pro_asin_counts` varchar(10) DEFAULT NULL,
  `pro_weight` decimal(10,2) DEFAULT NULL,
  `pro_title` varchar(2000) DEFAULT NULL,
  `pro_image` varchar(2000) DEFAULT NULL,
  `pro_us_rank` varchar(20) DEFAULT NULL,
  `pro_us_price` decimal(10,2) DEFAULT NULL,
  `pro_ca_rank` varchar(20) DEFAULT NULL,
  `pro_ca_price` decimal(10,2) DEFAULT NULL,
  `pro_uk_rank` varchar(20) DEFAULT NULL,
  `pro_uk_price` decimal(10,2) DEFAULT NULL,
  `pro_mx_rank` varchar(20) DEFAULT NULL,
  `pro_mx_price` decimal(10,2) DEFAULT NULL,
  `pro_in_rank` varchar(20) DEFAULT NULL,
  `pro_in_price` decimal(10,2) DEFAULT NULL,
  `pro_jp_rank` varchar(20) DEFAULT NULL,
  `pro_jp_price` decimal(10,2) DEFAULT NULL,
  `pro_as_rank` varchar(20) DEFAULT NULL,
  `pro_as_price` decimal(10,2) DEFAULT NULL,
  `pro_color` varchar(10) DEFAULT NULL,
  `pro_sound` varchar(10) NOT NULL,
  `match_flag` tinyint(1) DEFAULT '0',
  `process_flag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pro_id`),
  UNIQUE KEY `pro_isbn` (`pro_isbn`),
  UNIQUE KEY `pro_isbn_2` (`pro_isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `product_info` */

insert  into `product_info`(`pro_id`,`pro_isbn`,`pro_asin`,`pro_asin_counts`,`pro_weight`,`pro_title`,`pro_image`,`pro_us_rank`,`pro_us_price`,`pro_ca_rank`,`pro_ca_price`,`pro_uk_rank`,`pro_uk_price`,`pro_mx_rank`,`pro_mx_price`,`pro_in_rank`,`pro_in_price`,`pro_jp_rank`,`pro_jp_price`,`pro_as_rank`,`pro_as_price`,`pro_color`,`pro_sound`,`match_flag`,`process_flag`) values 
(1,'0786936852417','B01MAZGH7Z','1',0.20,'Moana','http://ecx.images-amazon.com/images/I/61oDGN2zYiL._SL500_.jpg','50',12.76,'416',14.56,'200474',21.52,'11249',22.92,'',0.00,'105738',25.29,NULL,NULL,'#B2DFDB','s1',1,1),
(4,'9781932740073','1932740074','1',0.00,'On Becoming Baby Wise: Giving Your Infant the Gift of Nighttime Sleep','http://ecx.images-amazon.com/images/I/41pGNXbJfQL._SL500_.jpg','2975',13.25,'5918',13.86,'123227',13.38,'47394',17.33,'306421',13.39,'481644',16.15,NULL,NULL,'#B2DFDB','s1',1,1);

/*Table structure for table `rule_info` */

DROP TABLE IF EXISTS `rule_info`;

CREATE TABLE `rule_info` (
  `rule_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `min_sales_rank` varchar(20) DEFAULT NULL,
  `max_sales_rank` varchar(20) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `sound` varchar(5) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `rule_info` */

insert  into `rule_info`(`rule_id`,`min_sales_rank`,`max_sales_rank`,`net_amount`,`color`,`sound`,`is_active`,`is_deleted`) values 
(4,'1','10000',20.00,'#B2DFDB','s1',1,0);

/*Table structure for table `scr_user` */

DROP TABLE IF EXISTS `scr_user`;

CREATE TABLE `scr_user` (
  `scr_u_id` int(11) NOT NULL AUTO_INCREMENT,
  `scr_firstname` varchar(50) NOT NULL,
  `scr_lastname` varchar(50) NOT NULL,
  `scr_uname` varchar(120) NOT NULL,
  `scr_password` varchar(35) NOT NULL,
  `scr_is_admin` tinyint(1) NOT NULL,
  `scr_is_verified` tinyint(1) NOT NULL,
  `mail_verify_key` varchar(255) NOT NULL,
  `scr_active` tinyint(1) NOT NULL,
  `referal_key` varchar(100) NOT NULL,
  `cntry_id` tinyint(4) NOT NULL,
  `trial_count` smallint(4) NOT NULL DEFAULT '3',
  `mem_type` varchar(5) NOT NULL,
  `joined_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_img` varchar(250) NOT NULL DEFAULT 'no_img.gif',
  `sugest_src_ttl_count` int(11) NOT NULL,
  PRIMARY KEY (`scr_u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `scr_user` */

insert  into `scr_user`(`scr_u_id`,`scr_firstname`,`scr_lastname`,`scr_uname`,`scr_password`,`scr_is_admin`,`scr_is_verified`,`mail_verify_key`,`scr_active`,`referal_key`,`cntry_id`,`trial_count`,`mem_type`,`joined_on`,`profile_img`,`sugest_src_ttl_count`) values 
(1,'test','user','testuser@gmail.com','testuser',1,1,'verified',1,'',0,3,'','2017-08-06 03:06:13','no_img.gif',0),
(2,'demo','','demouser@gmail.com','demouser',2,1,'',1,'',0,3,'','2018-04-19 12:05:54','no_img.gif',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
