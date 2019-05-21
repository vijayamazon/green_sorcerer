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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `amazon_profile` */

insert  into `amazon_profile`(`profile_id`,`profile_name`,`seller_id`,`auth_token`,`access_key`,`secret_key`,`market_placeID`,`markup_percent`) values 
(1,NULL,'A1RA2ZXUXLN6LW','amzn.mws.02af8e79-34db-5c46-72c9-158137c11ebd','AKIAJC2JEYCOZCQBYHGQ','JG+cHGVNX3CE1mJfEfbuEmUNQ3Po99sZCHPZfCfh','ATVPDKIKX0DER',50),
(2,NULL,'A1RA2ZXUXLN6LW','amzn.mws.02af8e79-34db-5c46-72c9-158137c11ebd','AKIAJC2JEYCOZCQBYHGQ','JG+cHGVNX3CE1mJfEfbuEmUNQ3Po99sZCHPZfCfh','A2EUQ1WTGCTBG2',NULL),
(3,NULL,'A1RA2ZXUXLN6LW','amzn.mws.02af8e79-34db-5c46-72c9-158137c11ebd','AKIAJC2JEYCOZCQBYHGQ','JG+cHGVNX3CE1mJfEfbuEmUNQ3Po99sZCHPZfCfh','A1AM78C64UM0Y8',NULL),
(4,NULL,'AFZ57S5NFQP29','amzn.mws.a0af09b6-8393-e9dc-0b83-4500b60ea4b1','AKIAJXC3NNU6INW2KPUQ','HXrmZ5YZvbw9oo+o4budSvuuWsKSYQp/ugt7eBHj','A1F83G8C2ARO7P',NULL);

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
('tqtmekhl6rm5utd9onp5g4ro1nopv17d','::1',1519288775,'__ci_last_regenerate|i:1519288668;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('rrofe8tn4b8u7f4ukd85r8m9ar2a6kgt','::1',1519290108,'__ci_last_regenerate|i:1519289826;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('dsr3p1enjmejfgo7arso23npc9p8rib6','::1',1519290196,'__ci_last_regenerate|i:1519290195;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('en3qmlt80tcpp3t5gr8l74oiospqkd3g','::1',1519291880,'__ci_last_regenerate|i:1519291596;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('a89hh8hipmogn0b1v1n71qaj3gvndjjq','::1',1519292279,'__ci_last_regenerate|i:1519292132;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('k821rm0o0vjv4lfptcqa7rsid4vuichg','::1',1519292781,'__ci_last_regenerate|i:1519292494;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('2l2nb2h1qk216e3a743o3ofecni9gate','::1',1519293033,'__ci_last_regenerate|i:1519292798;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('jodl21t9753khl06thg2enehmi33r8at','::1',1519293232,'__ci_last_regenerate|i:1519293231;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('q19ca6odhek6vt1c0legnln76oenbvbv','::1',1519294578,'__ci_last_regenerate|i:1519294561;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('ll47osvpae41vbvfgm844fig5h0qr3j9','::1',1519303241,'__ci_last_regenerate|i:1519303210;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('umn3j25jg5j88hq39uo32kskc3u75iom','::1',1519307848,'__ci_last_regenerate|i:1519307840;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('icu7493rq025pl1r4thaec52dte55o1m','::1',1519309289,'__ci_last_regenerate|i:1519309088;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('v0r3h9smcadkt8820ltknudfbg69npcj','::1',1519309602,'__ci_last_regenerate|i:1519309583;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('huqfiftjqbeh8nr1bfgv4do78k7lmuhl','::1',1519310616,'__ci_last_regenerate|i:1519310613;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('dhs017mpprcorijdls45m82rav61f2d1','::1',1519360470,'__ci_last_regenerate|i:1519360470;'),
('v6ssqh7qihf30b09migphafqeu2fcp72','::1',1519360951,'__ci_last_regenerate|i:1519360948;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('d72qarmmjil2th3a4lrssdbj1d4bgg3f','::1',1519362410,'__ci_last_regenerate|i:1519362406;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('bbrds58d3i741vd82pckk4c1n17lnb6r','::1',1519363344,'__ci_last_regenerate|i:1519363344;'),
('867vkmv6i4kl72vf4h54eaqged9u4go6','::1',1519448211,'__ci_last_regenerate|i:1519448066;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('d1qmbn9pjkopoiae1cq4uherq6p4vhi4','::1',1519454215,'__ci_last_regenerate|i:1519454215;'),
('ltrj095oofa93l6fs2vktp8598992t28','::1',1519454267,'__ci_last_regenerate|i:1519454215;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('0aumuvjkrc9jovrtg8225ohebr27gtkf','::1',1519454215,'__ci_last_regenerate|i:1519454215;'),
('om8qk48gikeb0bk3cl9esi7vn8gm3t19','::1',1519467614,'__ci_last_regenerate|i:1519467514;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}'),
('cfmjaf02a5g44im0o3egrp46tq1inen5','::1',1519468829,'__ci_last_regenerate|i:1519468734;user_logged_in|a:6:{s:5:\"uname\";s:18:\"testuser@gmail.com\";s:5:\"fname\";s:4:\"test\";s:5:\"lname\";s:4:\"user\";s:2:\"id\";s:1:\"1\";s:7:\"isadmin\";s:1:\"1\";s:10:\"isverified\";s:1:\"1\";}');

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
  `pro_us_price` varchar(20) DEFAULT NULL,
  `pro_ca_rank` varchar(20) DEFAULT NULL,
  `pro_ca_price` varchar(20) DEFAULT NULL,
  `pro_uk_rank` varchar(20) DEFAULT NULL,
  `pro_uk_price` varchar(20) DEFAULT NULL,
  `pro_mx_rank` varchar(20) DEFAULT NULL,
  `pro_mx_price` varchar(20) DEFAULT NULL,
  `pro_in_rank` varchar(20) DEFAULT NULL,
  `pro_in_price` varchar(20) DEFAULT NULL,
  `pro_ja_rank` varchar(20) DEFAULT NULL,
  `pro_ja_price` varchar(20) DEFAULT NULL,
  `pro_as_rank` varchar(20) DEFAULT NULL,
  `pro_as_price` varchar(20) DEFAULT NULL,
  `process_flag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `product_info` */

insert  into `product_info`(`pro_id`,`pro_isbn`,`pro_asin`,`pro_asin_counts`,`pro_weight`,`pro_title`,`pro_image`,`pro_us_rank`,`pro_us_price`,`pro_ca_rank`,`pro_ca_price`,`pro_uk_rank`,`pro_uk_price`,`pro_mx_rank`,`pro_mx_price`,`pro_in_rank`,`pro_in_price`,`pro_ja_rank`,`pro_ja_price`,`pro_as_rank`,`pro_as_price`,`process_flag`) values 
(1,'9781912032990','1912032996','1',0.00,'Think and Grow Rich','http://ecx.images-amazon.com/images/I/419pvokaQuL._SL500_.jpg','11243',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(2,'9780867166194','0867166193','1',0.68,'Good News About Sex & Marriage (Revised Edition): Answers to Your Honest Questions about Catholic Teaching','http://ecx.images-amazon.com/images/I/516zfYx2SUL._SL500_.jpg','34496',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(3,'9781420948424','1420948423','1',0.42,'Kokoro','http://ecx.images-amazon.com/images/I/61dAoCPrxLL._SL500_.jpg','1039431',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(4,'9781932740073','1932740074','1',0.00,'On Becoming Baby Wise: Giving Your Infant the Gift of Nighttime Sleep','http://ecx.images-amazon.com/images/I/41pGNXbJfQL._SL500_.jpg','2359',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(5,'9781442412705','1442412704','1',0.25,'Dream Big: Michael Jordan and the Pursuit of Excellence','http://ecx.images-amazon.com/images/I/51EzqS6khTL._SL500_.jpg','16050',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(6,'9781501705519','1501705512','1',0.00,'The Despot\'s Guide to Wealth Management: On the International Campaign against Grand Corruption','http://ecx.images-amazon.com/images/I/51DnhzaGybL._SL500_.jpg','245873',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(7,'9781501150326','1501150324','1',0.00,'The Devil\'s Triangle (A Brit in the FBI)','http://ecx.images-amazon.com/images/I/513nWIBd1mL._SL500_.jpg','103977',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(8,'9780985414801','0985414804','1',0.56,'The New Elevator Pitch','http://ecx.images-amazon.com/images/I/51U-C89IoSL._SL500_.jpg','332257',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(9,'9780545556170','0545556171','1',0.00,'Meet the Bigfeet (The Yeti Files #1)','http://ecx.images-amazon.com/images/I/51sFFkCoMML._SL500_.jpg','21304',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
(10,'9781510706019','1510706011','1',0.00,'Creeper Invasion: An Unofficial Minetrapped Adventure, #5 (The Unofficial Minetrapped Adventure Series)','http://ecx.images-amazon.com/images/I/51x4-sRE9RL._SL500_.jpg','728206',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `scr_user` */

insert  into `scr_user`(`scr_u_id`,`scr_firstname`,`scr_lastname`,`scr_uname`,`scr_password`,`scr_is_admin`,`scr_is_verified`,`mail_verify_key`,`scr_active`,`referal_key`,`cntry_id`,`trial_count`,`mem_type`,`joined_on`,`profile_img`,`sugest_src_ttl_count`) values 
(1,'test','user','testuser@gmail.com','testuser',1,1,'verified',1,'',0,3,'','2017-08-06 03:06:13','no_img.gif',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
