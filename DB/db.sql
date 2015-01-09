/*
SQLyog Community v11.51 (64 bit)
MySQL - 5.5.32 : Database - compass
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`compass` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `modules` */

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `module_path` tinytext NOT NULL,
  `module_status` tinyint(1) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `modules` */

insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (1,'content_management','modules/content_management/content_management.php',1,'2010-09-23 11:43:22','2010-09-23 11:43:22');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (3,'banners_management','modules/banners_management/banners_management.php',1,'2010-09-23 13:02:08','2010-09-23 13:02:08');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (4,'advertisment_management','modules/advertisment_management/advertisment_management.php',1,'2010-09-23 13:25:37','2010-09-23 13:25:37');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (5,'news_n_events_management','modules/news_n_events_management/news_n_events_management.php',1,'2010-09-23 14:27:50','2010-09-23 14:27:50');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (6,'faq_management','modules/faq_management/faq_management.php',1,'2010-09-23 15:04:16','2010-09-23 15:04:16');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (7,'newsletter_management','modules/newsletter_management/newsletter_management.php',1,'2010-09-28 18:03:39','2010-09-28 18:03:39');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (8,'counties_management','modules/counties_management/counties_management.php',1,'2010-09-29 14:33:55','2010-09-29 14:33:55');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (9,'category_management','modules/category_management/category_management.php',1,'2010-09-29 17:23:08','2010-09-29 17:23:08');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (10,'user_management','modules/user_management/user_management.php',1,'2010-10-07 12:00:13','2010-10-07 12:00:13');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (11,'advert_management','modules/advert_management/advert_management.php',1,'2010-10-07 12:09:57','2010-10-07 12:09:57');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (12,'blog_management','modules/blog_management/blog_management.php',1,'2010-12-06 16:50:39','2010-12-06 16:50:39');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (13,'order_management','modules/order_management/order_management.php',1,'2012-06-12 13:05:19','2012-06-12 13:05:19');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (15,'employee_management','modules/employee_management/employee_management.php',1,'2013-05-17 05:48:15','2013-05-17 05:48:15');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (16,'department_management','modules/department_management/department_management.php',1,'2013-05-17 22:56:50','2013-05-17 22:56:50');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (17,'tour_management','modules/tour_management/tour_management.php',1,'2013-05-18 05:47:23','2013-05-18 05:47:23');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (18,'team_management','modules/team_management/team_management.php',1,'2013-05-21 00:09:14','2013-05-21 00:09:14');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (19,'pdf_management','modules/pdf_management/pdf_management.php',1,'2013-05-22 01:32:31','2013-05-22 01:32:31');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (20,'checklist_management','modules/checklist_management/checklist_management.php',1,'2013-05-22 04:52:51','2013-05-22 04:52:51');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (21,'crewpretourchecklist_management','modules/crewpretourchecklist_management/crewpretourchecklist_management.php',1,'2013-05-22 23:56:22','2013-05-22 23:56:22');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (22,'checktype_management','modules/checktype_management/checktype_management.php',1,'2013-05-24 23:48:28','2013-05-24 23:48:28');
insert  into `modules`(`module_id`,`module_name`,`module_path`,`module_status`,`addeddate`,`modifieddate`) values (23,'maintab_management','modules/maintab_management/maintab_management.php',1,'2013-05-27 23:38:46','2013-05-27 23:38:46');

/*Table structure for table `tbl_all_vehicle_circulation_papers` */

CREATE TABLE `tbl_all_vehicle_circulation_papers` (
  `vehicle_circulation_papers_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_document_id` int(11) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `registration_detail` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`vehicle_circulation_papers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_all_vehicle_circulation_papers` */

insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (166,1,'Honda','0123456','07/07/2018','2013-05-28 04:02:18','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (167,1,'Honda','36985214','12/12/2014','2013-05-28 04:02:18','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (168,1,'Suzuki','E1245KL','01/01/2020','2013-05-28 04:02:18','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (169,1,'','','','2013-05-28 04:02:18','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (170,1,'','','','2013-05-28 04:02:18','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (171,1,'','','','2013-05-28 04:02:18','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (172,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (173,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (174,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (175,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (176,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (177,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (178,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (179,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_circulation_papers`(`vehicle_circulation_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (180,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');

/*Table structure for table `tbl_all_vehicle_insurance_papers` */

CREATE TABLE `tbl_all_vehicle_insurance_papers` (
  `vehicle_insurance_papers_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_document_id` int(11) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `registration_detail` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`vehicle_insurance_papers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_all_vehicle_insurance_papers` */

insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (166,1,'Mercedes','457898E45','18/09/2019','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (167,1,'Nissan','345345345','18/09/2019','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (168,1,'Nissan','5444444','1/1/1212','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (169,1,'Mercedes','65987845451','2/08/1987','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (170,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (171,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (172,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (173,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (174,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (175,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (176,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (177,1,'','','','2013-05-28 04:02:19','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (178,1,'','','','2013-05-28 04:02:20','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (179,1,'','','','2013-05-28 04:02:20','0000-00-00 00:00:00');
insert  into `tbl_all_vehicle_insurance_papers`(`vehicle_insurance_papers_id`,`vehicle_document_id`,`vehicle_name`,`registration_detail`,`expiry_date`,`addeddate`,`modifieddate`) values (180,1,'','','','2013-05-28 04:02:20','0000-00-00 00:00:00');

/*Table structure for table `tbl_checklist_type_category` */

CREATE TABLE `tbl_checklist_type_category` (
  `checklist_type_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_id` int(11) NOT NULL,
  `tour_type_category` varchar(255) NOT NULL,
  `checktype_status` tinyint(1) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`checklist_type_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_checklist_type_category` */

insert  into `tbl_checklist_type_category`(`checklist_type_category_id`,`checklist_id`,`tour_type_category`,`checktype_status`,`addeddate`,`modifieddate`) values (1,3,'Bikes/ 4x4',1,'2013-05-25 00:13:30','2013-05-25 00:51:34');
insert  into `tbl_checklist_type_category`(`checklist_type_category_id`,`checklist_id`,`tour_type_category`,`checktype_status`,`addeddate`,`modifieddate`) values (2,3,'Admin',1,'2013-05-25 00:52:28','0000-00-00 00:00:00');
insert  into `tbl_checklist_type_category`(`checklist_type_category_id`,`checklist_id`,`tour_type_category`,`checktype_status`,`addeddate`,`modifieddate`) values (5,3,'General',1,'2013-05-25 00:53:34','0000-00-00 00:00:00');
insert  into `tbl_checklist_type_category`(`checklist_type_category_id`,`checklist_id`,`tour_type_category`,`checktype_status`,`addeddate`,`modifieddate`) values (6,4,'Bike Briefing Checklist',1,'2013-05-25 01:56:54','2013-05-25 02:19:53');

/*Table structure for table `tbl_contents` */

CREATE TABLE `tbl_contents` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `content_title` tinytext NOT NULL,
  `content_text` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `sef_link` varchar(255) NOT NULL,
  `content_status` tinyint(1) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_contents` */

insert  into `tbl_contents`(`content_id`,`parent_id`,`content_title`,`content_text`,`meta_title`,`meta_description`,`meta_keywords`,`sef_link`,`content_status`,`addeddate`,`modifieddate`) values (1,0,'How it Works','<p>There are many variations of passages of  Lorem Ipsum available, but the majority have suffered alteration in some  form, by injected humour, or randomised words which don	 look even  slightly believable. If you are going to use a passage of Lorem Ipsum,  you need to be sure there isn	 anything embarrassing hidden in the  middle of text. All the Lorem Ipsum generators on the Internet tend to  repeat predefined chunks as necessary, making this the first true  generator on the Internet. It uses a dictionary of over 200 Latin words,  combined with a handful of model sentence structures, to generate Lorem  Ipsum which looks reasonable. The generated Lorem Ipsum is therefore  always free from repetition, injected humour, or non-characteristic  words etc.</p>\r\n<p>There are many variations of passages of  Lorem Ipsum available, but the majority have suffered alteration in some  form, by injected humour, or randomised words which don	 look even  slightly believable. If you are going to use a passage of Lorem Ipsum,  you need to be sure there isn	 anything embarrassing hidden in the  middle of text. All the Lorem Ipsum generators on the Internet tend to  repeat predefined chunks as necessary, making this the first true  generator on the Internet. It uses a dictionary of over 200 Latin words,  combined with a handful of model sentence structures, to generate Lorem  Ipsum which looks reasonable. The generated Lorem Ipsum is therefore  always free from repetition, injected humour, or non-characteristic  words etc.</p>\r\n<p>&nbsp;</p>\r\n<p>There are many variations of passages of  Lorem Ipsum available, but the majority have suffered alteration in some  form, by injected humour, or randomised words which don	 look even  slightly believable. If you are going to use a passage of Lorem Ipsum,  you need to be sure there isn	 anything embarrassing hidden in the  middle of text. All the Lorem Ipsum generators on the Internet tend to  repeat predefined chunks as necessary, making this the first true  generator on the Internet. It uses a dictionary of over 200 Latin words,  combined with a handful of model sentence structures, to generate Lorem  Ipsum which looks reasonable. The generated Lorem Ipsum is therefore  always free from repetition, injected humour, or non-characteristic  words etc.</p>','How it Works Meta Title','How it Works Meta Description','How it Works Keywords','',1,'2013-05-03 00:13:24','2013-05-03 00:13:24');
insert  into `tbl_contents`(`content_id`,`parent_id`,`content_title`,`content_text`,`meta_title`,`meta_description`,`meta_keywords`,`sef_link`,`content_status`,`addeddate`,`modifieddate`) values (2,0,'About Us','<p>There are many variations of passages of  Lorem Ipsum available, but the majority have suffered alteration in some  form, by injected humour, or randomised words which don	 look even  slightly believable. If you are going to use a passage of Lorem Ipsum,  you need to be sure there isn	 anything embarrassing hidden in the  middle of text. All the Lorem Ipsum generators on the Internet tend to  repeat predefined chunks as necessary, making this the first true  generator on the Internet. It uses a dictionary of over 200 Latin words,  combined with a handful of model sentence structures, to generate Lorem  Ipsum which looks reasonable. The generated Lorem Ipsum is therefore  always free from repetition, injected humour, or non-characteristic  words etc.</p>','About Us','About Us Meta Description','About Us Keywords','',1,'2013-05-03 00:17:07','2013-05-03 00:17:07');
insert  into `tbl_contents`(`content_id`,`parent_id`,`content_title`,`content_text`,`meta_title`,`meta_description`,`meta_keywords`,`sef_link`,`content_status`,`addeddate`,`modifieddate`) values (3,0,'Contact Us','<p>Contact Details comes Here!!!</p>','Contact Us ','Contact Us','Contact Us','',1,'2013-05-03 00:17:54','2013-05-03 00:17:54');

/*Table structure for table `tbl_crew_pre_tour_checklist` */

CREATE TABLE `tbl_crew_pre_tour_checklist` (
  `crew_pre_tour_checklist_id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_id` int(11) NOT NULL,
  `crew_pre_tour_type` tinyint(1) NOT NULL,
  `crew_pre_tour_text` varchar(500) NOT NULL,
  `crew_pre_tour_status` tinyint(1) NOT NULL,
  `checklist_checked_status` varchar(100) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`crew_pre_tour_checklist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_crew_pre_tour_checklist` */

insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (4,3,1,'Pre tour maintenance, available in DB at Compass-Vehicle Service Schedule',1,'on','2013-05-25 01:01:31','2013-05-25 04:52:59');
insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (5,3,1,'Update Logbooks, available in DB at Compass-Vehicle Service Schedule',1,'on','2013-05-25 01:01:45','2013-05-25 04:52:59');
insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (6,3,2,'Print route notes and maps for tour, available in DB at Compass-Documents for Crew-Route Notes and Maps',1,'on','2013-05-25 01:02:09','2013-05-25 04:52:59');
insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (7,3,2,'Check arrival times/dates of clients and check transfers available in Tour Manifests ',1,'on','2013-05-25 01:02:18','2013-05-25 04:52:59');
insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (8,3,5,'Check all authorizations for bikes and 4x4 in order',1,'on','2013-05-25 01:02:31','2013-05-25 04:52:59');
insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (9,4,5,'Print copy of Pre Departure notes available in DB at Compass-Documents for crew-Crew stationary',1,'','2013-05-25 02:18:02','0000-00-00 00:00:00');
insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (10,4,2,'Print copy of Pre Departure notes available in DB at Compass-Documents for crew-Crew stationary',1,'','2013-05-25 02:18:39','0000-00-00 00:00:00');
insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (11,5,5,'Print copy of Pre Departure notes available in DB at Compass-Documents for crew-Crew stationary',1,'','2013-05-25 02:18:54','0000-00-00 00:00:00');
insert  into `tbl_crew_pre_tour_checklist`(`crew_pre_tour_checklist_id`,`checklist_id`,`crew_pre_tour_type`,`crew_pre_tour_text`,`crew_pre_tour_status`,`checklist_checked_status`,`addeddate`,`modifieddate`) values (12,4,6,'Print copy of Pre Departure notes available in DB at Compass-Documents for crew-Crew stationary',1,'on','2013-05-25 02:23:19','2013-05-25 02:23:51');

/*Table structure for table `tbl_department` */

CREATE TABLE `tbl_department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) NOT NULL,
  `dept_status` tinyint(1) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_department` */

insert  into `tbl_department`(`dept_id`,`dept_name`,`dept_status`,`addeddate`,`modifieddate`) values (1,'Technical',1,'2013-05-17 23:19:29','2013-05-17 23:37:40');
insert  into `tbl_department`(`dept_id`,`dept_name`,`dept_status`,`addeddate`,`modifieddate`) values (2,'Support',1,'2013-05-17 23:36:16','0000-00-00 00:00:00');

/*Table structure for table `tbl_downloads` */

CREATE TABLE `tbl_downloads` (
  `pdf_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdf_name` varchar(255) NOT NULL,
  `pdf_description` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`pdf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_downloads` */

insert  into `tbl_downloads`(`pdf_id`,`pdf_name`,`pdf_description`,`pdf_file`,`status`,`addeddate`,`modifieddate`) values (4,'Tour Image','<p>This Is Image for Tour De Australia</p>','4WEfByIjYngiCpaqN8HGAxMmFksehlJXwSbo15OQK0DLPZTr6Desert.jpg',1,'2013-05-22 02:15:14','2013-05-22 02:27:03');
insert  into `tbl_downloads`(`pdf_id`,`pdf_name`,`pdf_description`,`pdf_file`,`status`,`addeddate`,`modifieddate`) values (10,'Incident report','','6KjuCEZrLbApXw43WFmaIi7D0Bd2qVO1yoJG9RPQUzteYnckhIncidentreport.docx',1,'2013-05-22 02:17:21','2013-05-22 02:26:43');
insert  into `tbl_downloads`(`pdf_id`,`pdf_name`,`pdf_description`,`pdf_file`,`status`,`addeddate`,`modifieddate`) values (11,'letter head','<p>letter head</p>','6e9xvTQ8oMq4fumKdjt2UkAzNlasPcgISiJVpZGbhCBEnW3Xwletterhead.docx',1,'2013-05-22 02:17:33','2013-05-22 02:24:33');

/*Table structure for table `tbl_employe_to_team` */

CREATE TABLE `tbl_employe_to_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `addeddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employe_to_team` */

insert  into `tbl_employe_to_team`(`id`,`employee_id`,`team_id`,`status`,`addeddate`) values (12,5,2,1,'2013-05-22 01:10:48');
insert  into `tbl_employe_to_team`(`id`,`employee_id`,`team_id`,`status`,`addeddate`) values (15,4,1,1,'2013-05-22 23:31:05');
insert  into `tbl_employe_to_team`(`id`,`employee_id`,`team_id`,`status`,`addeddate`) values (16,5,1,1,'2013-05-22 23:31:05');

/*Table structure for table `tbl_employees` */

CREATE TABLE `tbl_employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_full_name` varchar(255) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `employee_image` varchar(200) NOT NULL,
  `employee_status` tinyint(1) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employees` */

insert  into `tbl_employees`(`employee_id`,`employee_full_name`,`employee_email`,`dept_id`,`employee_image`,`employee_status`,`available`,`addeddate`,`modifieddate`) values (1,'James','james@compass.com.au',2,'data/EqWoaVYUAxRjuiptvS2DmzsrClFMXg3O9dJwnyZG0LPQHBcN8Hydrangeas.jpg',1,1,'2013-05-18 03:17:58','2013-05-21 01:02:47');
insert  into `tbl_employees`(`employee_id`,`employee_full_name`,`employee_email`,`dept_id`,`employee_image`,`employee_status`,`available`,`addeddate`,`modifieddate`) values (3,'Paul Wills','paul@compass.com.au',1,'data/yVhn3ta7wl1spvgIZW6AqOi8JQYFDjRbCzoKHu9NUXETM2fL5Chrysanthemum.jpg',1,1,'2013-05-18 04:22:33','2013-05-21 01:05:10');
insert  into `tbl_employees`(`employee_id`,`employee_full_name`,`employee_email`,`dept_id`,`employee_image`,`employee_status`,`available`,`addeddate`,`modifieddate`) values (4,'Phil Jhon','bandesha_@hotmail.com',2,'data/Rh9Q8KDwkNoJHdbyBYsZUS03tu4PMGqrW2AXeczE716VC5nTvJellyfish.jpg',1,1,'2013-05-18 04:52:40','2013-05-21 01:06:03');
insert  into `tbl_employees`(`employee_id`,`employee_full_name`,`employee_email`,`dept_id`,`employee_image`,`employee_status`,`available`,`addeddate`,`modifieddate`) values (5,'Cnab','mrcnab@gmail.com',1,'data/HhsRnw5FGBcZpr1Jg7zfVWOCkbLIeTuXK9ENtDyP026i8o3dY547793_10200861921092097_1546918351_n.jpg',1,1,'2013-05-20 23:50:37','2013-05-21 01:17:25');

/*Table structure for table `tbl_post_tour` */

CREATE TABLE `tbl_post_tour` (
  `post_tour_id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `have_you_completed_your_accounts` varchar(3) NOT NULL,
  `have_you_collected_questionnaires` varchar(3) NOT NULL,
  `have_you_emailed_wages_sheet` varchar(3) NOT NULL,
  `have_you_uploaded_waypoints_into_db` varchar(3) NOT NULL,
  `when_were_the_waypoints_updated` varchar(200) NOT NULL,
  `have_you_updated_the_tour_manual` varchar(3) NOT NULL,
  `addeddate` datetime NOT NULL,
  PRIMARY KEY (`post_tour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_post_tour` */

insert  into `tbl_post_tour`(`post_tour_id`,`tour_id`,`team_id`,`have_you_completed_your_accounts`,`have_you_collected_questionnaires`,`have_you_emailed_wages_sheet`,`have_you_uploaded_waypoints_into_db`,`when_were_the_waypoints_updated`,`have_you_updated_the_tour_manual`,`addeddate`) values (1,2,1,'No','Yes','No','Yes','21/12/2012','No','2013-05-28 06:22:20');

/*Table structure for table `tbl_pre_tour_paper_work` */

CREATE TABLE `tbl_pre_tour_paper_work` (
  `pre_tour_paper_work_id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `do_you_have_tour_manifest` varchar(3) NOT NULL,
  `do_you_have_client_manifest` varchar(3) NOT NULL,
  `do_you_have_itinerary_manifest` varchar(3) NOT NULL,
  `do_you_have_passenger_manifest` varchar(3) NOT NULL,
  `do_you_have_welcome_letter_prepared` varchar(3) NOT NULL,
  `do_you_have_hotel_list_prepared` varchar(3) NOT NULL,
  `do_you_have_tour_dossier_printed` varchar(3) NOT NULL,
  `do_you_have_pre_departure_meeting_checklist` varchar(3) NOT NULL,
  `do_you_have_bike_briefing_checklist` varchar(3) NOT NULL,
  `do_you_have_all_city_sheets_for_tour_printed` varchar(3) NOT NULL,
  `do_you_have_enough_tshirts_ordered` varchar(3) NOT NULL,
  `do_you_have_tour_maps_and_route_notes` varchar(3) NOT NULL,
  `have_you_read_the_crew_training_manual` varchar(3) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`pre_tour_paper_work_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pre_tour_paper_work` */

insert  into `tbl_pre_tour_paper_work`(`pre_tour_paper_work_id`,`tour_id`,`team_id`,`do_you_have_tour_manifest`,`do_you_have_client_manifest`,`do_you_have_itinerary_manifest`,`do_you_have_passenger_manifest`,`do_you_have_welcome_letter_prepared`,`do_you_have_hotel_list_prepared`,`do_you_have_tour_dossier_printed`,`do_you_have_pre_departure_meeting_checklist`,`do_you_have_bike_briefing_checklist`,`do_you_have_all_city_sheets_for_tour_printed`,`do_you_have_enough_tshirts_ordered`,`do_you_have_tour_maps_and_route_notes`,`have_you_read_the_crew_training_manual`,`addeddate`,`modifieddate`) values (1,2,1,'No','No','Yes','No','No','No','Yes','Yes','No','Yes','No','No','No','2013-05-28 05:22:00','2013-05-28 05:23:52');

/*Table structure for table `tbl_teams` */

CREATE TABLE `tbl_teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `team_status` tinyint(1) NOT NULL DEFAULT '1',
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_teams` */

insert  into `tbl_teams`(`team_id`,`team_name`,`tour_id`,`team_status`,`addeddate`,`modifieddate`) values (1,'Team A',2,1,'2013-05-21 02:54:26','2013-05-22 23:31:05');
insert  into `tbl_teams`(`team_id`,`team_name`,`tour_id`,`team_status`,`addeddate`,`modifieddate`) values (2,'Team B',3,1,'2013-05-21 02:55:50','2013-05-22 01:10:48');

/*Table structure for table `tbl_tour_form_checklists_manager` */

CREATE TABLE `tbl_tour_form_checklists_manager` (
  `checklist_id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_title` varchar(255) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `checklist_status` tinyint(1) NOT NULL,
  `starteddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  `finisheddate` datetime NOT NULL,
  PRIMARY KEY (`checklist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_tour_form_checklists_manager` */

insert  into `tbl_tour_form_checklists_manager`(`checklist_id`,`checklist_title`,`tour_id`,`team_id`,`checklist_status`,`starteddate`,`modifieddate`,`finisheddate`) values (3,'Pre Tour Crew Check List',2,1,1,'2013-05-23 01:23:30','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `tbl_tour_form_checklists_manager`(`checklist_id`,`checklist_title`,`tour_id`,`team_id`,`checklist_status`,`starteddate`,`modifieddate`,`finisheddate`) values (4,'Pre-Departure Meeting (PDM) Checklist',2,1,1,'2013-05-23 01:26:11','2013-05-23 02:01:54','0000-00-00 00:00:00');
insert  into `tbl_tour_form_checklists_manager`(`checklist_id`,`checklist_title`,`tour_id`,`team_id`,`checklist_status`,`starteddate`,`modifieddate`,`finisheddate`) values (5,'New Check List',3,2,1,'2013-05-23 05:55:02','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `tbl_tours` */

CREATE TABLE `tbl_tours` (
  `tour_id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_name` varchar(255) NOT NULL,
  `tour_description` text NOT NULL,
  `tour_location` varchar(255) NOT NULL,
  `tour_start_date` varchar(255) NOT NULL,
  `tour_end_date` varchar(255) NOT NULL,
  `tour_status` tinyint(1) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`tour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_tours` */

insert  into `tbl_tours`(`tour_id`,`tour_name`,`tour_description`,`tour_location`,`tour_start_date`,`tour_end_date`,`tour_status`,`addeddate`,`modifieddate`) values (2,'South America Tours','<p>For choosing <a class=\"yellow-color\" href=\"http://www.webmarketingexperts.com.au/\" target=\"_blank\"> Web Marketing Experts</a> Content Management System. We sincerely hope that this Content  Management System will enable you to successfully manage your website.</p>','Argentina','05/23/2013','05/31/2013',1,'2013-05-20 23:23:49','2013-05-20 23:33:27');
insert  into `tbl_tours`(`tour_id`,`tour_name`,`tour_description`,`tour_location`,`tour_start_date`,`tour_end_date`,`tour_status`,`addeddate`,`modifieddate`) values (3,'Tour De Australia','<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>','Melbourne to Sydney','05/31/2013','06/27/2013',1,'2013-05-20 23:34:33','0000-00-00 00:00:00');
insert  into `tbl_tours`(`tour_id`,`tour_name`,`tour_description`,`tour_location`,`tour_start_date`,`tour_end_date`,`tour_status`,`addeddate`,`modifieddate`) values (4,'','','','','',0,'2013-07-02 07:10:36','0000-00-00 00:00:00');
insert  into `tbl_tours`(`tour_id`,`tour_name`,`tour_description`,`tour_location`,`tour_start_date`,`tour_end_date`,`tour_status`,`addeddate`,`modifieddate`) values (5,'','','','','',0,'2013-08-23 08:07:00','0000-00-00 00:00:00');

/*Table structure for table `tbl_vehicle_document` */

CREATE TABLE `tbl_vehicle_document` (
  `vehicle_document_id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `do_you_have_all_vehicle_titles` varchar(3) NOT NULL,
  `do_you_have_all_vehicle_authorisation_papers` varchar(3) NOT NULL,
  `do_you_have_all_vehicle_circulation_papers` varchar(3) NOT NULL,
  `do_you_have_vehicle_insurance_papers` varchar(3) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`vehicle_document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_vehicle_document` */

insert  into `tbl_vehicle_document`(`vehicle_document_id`,`tour_id`,`team_id`,`do_you_have_all_vehicle_titles`,`do_you_have_all_vehicle_authorisation_papers`,`do_you_have_all_vehicle_circulation_papers`,`do_you_have_vehicle_insurance_papers`,`addeddate`,`modifieddate`) values (1,2,1,'Yes','Yes','No','No','2013-05-28 03:55:14','2013-05-28 04:02:18');

/*Table structure for table `tbl_vehicle_maintenance` */

CREATE TABLE `tbl_vehicle_maintenance` (
  `vehicle_maintenance_id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `has_all_pre_tour_maintenance_as_per_schedule_been_performed` varchar(3) NOT NULL,
  `have_vehicle_logbooks_been_updated_in_db` varchar(3) NOT NULL,
  `when_were_the_logbooks_last_updated` varchar(200) NOT NULL,
  `has_inventory_list_been_updated_in_db` varchar(3) NOT NULL,
  `when_was_the_inventory_list_updated` varchar(200) NOT NULL,
  `have_any_required_spare_parts_been_updated` varchar(3) NOT NULL,
  `when_were_required_spare_parts_updated` varchar(200) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`vehicle_maintenance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_vehicle_maintenance` */

insert  into `tbl_vehicle_maintenance`(`vehicle_maintenance_id`,`tour_id`,`team_id`,`has_all_pre_tour_maintenance_as_per_schedule_been_performed`,`have_vehicle_logbooks_been_updated_in_db`,`when_were_the_logbooks_last_updated`,`has_inventory_list_been_updated_in_db`,`when_was_the_inventory_list_updated`,`have_any_required_spare_parts_been_updated`,`when_were_required_spare_parts_updated`,`addeddate`,`modifieddate`) values (1,2,1,'No','Yes','23/12/2014','No','29/06/2013','Yes','12/04/2012','2013-05-28 05:50:31','2013-05-28 06:05:25');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `addeddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_type`,`team_id`,`user_name`,`user_password`,`first_name`,`last_name`,`user_email`,`phoneNumber`,`address`,`user_status`,`addeddate`,`modifieddate`) values (1,1,0,'admin','admin','Compass Tours','Admin','mrcnab@gmail.com','','',1,'2009-01-07 17:48:32','2009-01-13 16:15:34');
insert  into `users`(`user_id`,`user_type`,`team_id`,`user_name`,`user_password`,`first_name`,`last_name`,`user_email`,`phoneNumber`,`address`,`user_status`,`addeddate`,`modifieddate`) values (4,2,1,'admin321','adminpassword','My New Team','','','','',1,'2013-05-21 02:54:26','2013-05-22 23:31:05');
insert  into `users`(`user_id`,`user_type`,`team_id`,`user_name`,`user_password`,`first_name`,`last_name`,`user_email`,`phoneNumber`,`address`,`user_status`,`addeddate`,`modifieddate`) values (5,2,2,'administrator','administratorpass','Team B','','','','',1,'2013-05-21 02:55:50','2013-05-22 01:10:48');
insert  into `users`(`user_id`,`user_type`,`team_id`,`user_name`,`user_password`,`first_name`,`last_name`,`user_email`,`phoneNumber`,`address`,`user_status`,`addeddate`,`modifieddate`) values (6,2,3,'hello','hello','test team','','','','',1,'2013-05-21 05:48:01','0000-00-00 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
