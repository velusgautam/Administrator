

-- Database Export for GNR Administration---
-- Database Name : administrator



-- Table Structure for Table : admin_application_form

DROP TABLE IF EXISTS admin_application_form;

CREATE TABLE `admin_application_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_code` int(5) NOT NULL,
  `admin_no` varchar(10) NOT NULL,
  `admission_date` date NOT NULL,
  `academic_year` varchar(25) NOT NULL,
  `name` varchar(15) NOT NULL,
  `nationality` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `placeofbirth` varchar(15) NOT NULL,
  `religion` varchar(15) NOT NULL,
  `caste` varchar(15) NOT NULL,
  `mothertongue` varchar(15) NOT NULL,
  `whethersct` varchar(15) NOT NULL,
  `talukdist` varchar(15) NOT NULL,
  `father_name` varchar(15) NOT NULL,
  `father_qualification` varchar(15) NOT NULL,
  `father_occupation` varchar(15) NOT NULL,
  `mother_name` varchar(15) NOT NULL,
  `mother_qualification` varchar(15) NOT NULL,
  `mother_occupation` varchar(15) NOT NULL,
  `noofbro` varchar(15) NOT NULL,
  `noofsis` varchar(15) NOT NULL,
  `standard_leaving` varchar(15) NOT NULL,
  `prev_school` text NOT NULL,
  `tcdate` varchar(15) NOT NULL,
  `annual_income` varchar(15) NOT NULL,
  `permanent_address` text NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `resi_no` varchar(15) NOT NULL,
  `office_no` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO admin_application_form VALUES("10","5","2121","2014-06-11","2015-2016","Neeraj","Indian","Male","0000-00-00","Bangalore","","","Malayalam","No","bangalore","Sasi","Engineer","Software Engine","","Engineer","Software Engine","21","21","10","English","12/12/2012","1000000","Bangalore, Kollam","919898998988","98989898989","889898","kansdkasnkd@aknkas.com");
INSERT INTO admin_application_form VALUES("11","5","2121","2014-06-11","2014-2015","Velu","Indian","Male","2014-06-18","Bangalore","Hindu","Ezhava","Malayalam","No","Bangalore","Subra","Engineer","Software Engine","Sasikala","Engineer","Software Engine","21","21","PRE KG","English","12/12/2012","1000000","Bangalore, Kollam","91989899898","98989898989","889898","kansdkasnkd@aknkas.com");



-- Table Structure for Table : admin_class

DROP TABLE IF EXISTS admin_class;

CREATE TABLE `admin_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO admin_class VALUES("1","PRE KG","0");
INSERT INTO admin_class VALUES("2","KG","0");
INSERT INTO admin_class VALUES("3","UKG","0");
INSERT INTO admin_class VALUES("4","CLASS I","0");
INSERT INTO admin_class VALUES("5","CLASS II","0");



-- Table Structure for Table : admin_class_mapping

DROP TABLE IF EXISTS admin_class_mapping;

CREATE TABLE `admin_class_mapping` (
  `class_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(5) NOT NULL,
  `division_id` int(5) NOT NULL,
  `stream_id` int(5) NOT NULL COMMENT '1:ICSE 2:STATE',
  `schl_id` int(11) NOT NULL,
  PRIMARY KEY (`class_map_id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

INSERT INTO admin_class_mapping VALUES("38","1","1","1","5");
INSERT INTO admin_class_mapping VALUES("39","1","4","1","5");
INSERT INTO admin_class_mapping VALUES("40","3","1","1","5");
INSERT INTO admin_class_mapping VALUES("41","3","1","2","5");
INSERT INTO admin_class_mapping VALUES("42","4","1","2","5");
INSERT INTO admin_class_mapping VALUES("43","1","1","1","6");
INSERT INTO admin_class_mapping VALUES("92","1","1","1","2");
INSERT INTO admin_class_mapping VALUES("93","1","2","1","2");
INSERT INTO admin_class_mapping VALUES("112","1","4","1","8");
INSERT INTO admin_class_mapping VALUES("113","1","1","2","8");
INSERT INTO admin_class_mapping VALUES("114","1","4","2","8");
INSERT INTO admin_class_mapping VALUES("115","2","2","1","8");
INSERT INTO admin_class_mapping VALUES("116","2","4","1","8");
INSERT INTO admin_class_mapping VALUES("117","2","1","2","8");
INSERT INTO admin_class_mapping VALUES("118","3","1","1","8");
INSERT INTO admin_class_mapping VALUES("119","3","4","2","8");
INSERT INTO admin_class_mapping VALUES("120","1","1","1","3");
INSERT INTO admin_class_mapping VALUES("121","1","2","1","3");
INSERT INTO admin_class_mapping VALUES("122","1","1","2","3");
INSERT INTO admin_class_mapping VALUES("123","1","2","2","3");
INSERT INTO admin_class_mapping VALUES("124","2","1","1","3");
INSERT INTO admin_class_mapping VALUES("125","2","2","1","3");
INSERT INTO admin_class_mapping VALUES("126","2","1","2","3");
INSERT INTO admin_class_mapping VALUES("127","2","2","2","3");
INSERT INTO admin_class_mapping VALUES("128","3","1","1","3");
INSERT INTO admin_class_mapping VALUES("129","3","2","1","3");
INSERT INTO admin_class_mapping VALUES("130","4","1","1","3");
INSERT INTO admin_class_mapping VALUES("131","4","2","1","3");
INSERT INTO admin_class_mapping VALUES("132","5","1","1","3");
INSERT INTO admin_class_mapping VALUES("133","5","2","1","3");



-- Table Structure for Table : admin_db_backup

DROP TABLE IF EXISTS admin_db_backup;

CREATE TABLE `admin_db_backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_name` varchar(250) NOT NULL,
  `backup_time` datetime NOT NULL,
  PRIMARY KEY (`backup_id`),
  UNIQUE KEY `backup_name` (`backup_name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO admin_db_backup VALUES("7","db-backup--01-07-2014sql","2014-07-02 01:13:37");
INSERT INTO admin_db_backup VALUES("12","db-backup--01-07-2014.sql","2014-07-02 01:17:06");
INSERT INTO admin_db_backup VALUES("13","db-backup--06-07-2014.sql","2014-07-06 17:44:22");



-- Table Structure for Table : admin_division

DROP TABLE IF EXISTS admin_division;

CREATE TABLE `admin_division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `division_name` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO admin_division VALUES("1","A","0");
INSERT INTO admin_division VALUES("2","B","0");
INSERT INTO admin_division VALUES("3","C","0");
INSERT INTO admin_division VALUES("4","D","0");



-- Table Structure for Table : admin_fee_mapping

DROP TABLE IF EXISTS admin_fee_mapping;

CREATE TABLE `admin_fee_mapping` (
  `fee_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(5) NOT NULL,
  `fee_id` int(4) NOT NULL,
  `fee_amount` varchar(5) NOT NULL,
  `schl_id` int(4) NOT NULL,
  PRIMARY KEY (`fee_map_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1 COMMENT='Table For Fee School Setting';

INSERT INTO admin_fee_mapping VALUES("66","1","1","150","3");
INSERT INTO admin_fee_mapping VALUES("67","1","2","200","3");
INSERT INTO admin_fee_mapping VALUES("90","1","1","300","5");
INSERT INTO admin_fee_mapping VALUES("91","1","2","400","5");
INSERT INTO admin_fee_mapping VALUES("92","1","3","500","5");
INSERT INTO admin_fee_mapping VALUES("93","1","4","200","5");
INSERT INTO admin_fee_mapping VALUES("94","1","5","600","5");
INSERT INTO admin_fee_mapping VALUES("95","1","6","800","5");
INSERT INTO admin_fee_mapping VALUES("96","1","7","10","5");
INSERT INTO admin_fee_mapping VALUES("97","2","1","300","5");
INSERT INTO admin_fee_mapping VALUES("98","2","2","600","5");
INSERT INTO admin_fee_mapping VALUES("99","2","3","700","5");



-- Table Structure for Table : admin_fees

DROP TABLE IF EXISTS admin_fees;

CREATE TABLE `admin_fees` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(150) NOT NULL,
  `status` int(3) NOT NULL,
  PRIMARY KEY (`fee_id`),
  UNIQUE KEY `fee_id` (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO admin_fees VALUES("1","TUITION FEE","0");
INSERT INTO admin_fees VALUES("2","COMPUTER FEE","0");
INSERT INTO admin_fees VALUES("3","EXAM FEE","0");
INSERT INTO admin_fees VALUES("4","SMART CLASS","0");
INSERT INTO admin_fees VALUES("5","HOBBY CLASS","0");
INSERT INTO admin_fees VALUES("6","ALUMNI FEES","0");
INSERT INTO admin_fees VALUES("7","FEE RECEIPT","0");



-- Table Structure for Table : admin_school

DROP TABLE IF EXISTS admin_school;

CREATE TABLE `admin_school` (
  `schl_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(200) NOT NULL,
  `school_code` varchar(20) NOT NULL,
  `school_address` text NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`schl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO admin_school VALUES("1","St Marks Public School","SMPS","No. 37, 1st Main, 3rd Phase, JP Nagar, Bangalore - 560078","1");
INSERT INTO admin_school VALUES("2","Sai Vidya Kendra","SVK","No. 724, 18th Main, 38th Cross, 4th T Block, Jayanagar, Bangalore - 560041","1");
INSERT INTO admin_school VALUES("3","Diana Memorial High School","DMHS","No. 45/46, 4th Main, Vijaya Layout, Arakere, Bangalore - 560076","1");
INSERT INTO admin_school VALUES("4","Little Millennium - Vijaya Bank Layout","LMVBL","#993, D.C. Halli Main Road, MSRS Nagar, Vijaya Bank Layout, Bangalore - 560076","1");
INSERT INTO admin_school VALUES("5","Little Millennium - Bilekahalli","LMBLK","A5, Ranka Villa, Ranka Colony, Bilekahalli, Bangalore - 560076","1");
INSERT INTO admin_school VALUES("6","Little Millennium - Hulimavu","LMHUL","SOS Childrens Villages of India, SOS Post, Doddakammanahalli Main Road, Hulimavu, Bangalore - 560076","1");
INSERT INTO admin_school VALUES("7","Mothers Touch - Vijaya Bank Layout","MTVBL","#993, D.C. Halli Main Road, MSRS Nagar, Vijaya Bank Layout, Bangalore - 560076","1");
INSERT INTO admin_school VALUES("8","Mothers Touch - Bilekahalli","MTBLK","A5, Ranka Villa, Ranka Colony Road, Bilekahalli, Bangalore - 560076","1");



-- Table Structure for Table : admin_student

DROP TABLE IF EXISTS admin_student;

CREATE TABLE `admin_student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `schl_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `stream_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `student_name` varchar(300) NOT NULL,
  `transfer_tc` int(11) NOT NULL,
  `transfer_mc` int(11) NOT NULL,
  `transfer_cc` int(11) NOT NULL,
  `fresh_bc` int(11) NOT NULL,
  `fresh_cc` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `registered_by` varchar(200) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO admin_student VALUES("10","10","5","2014-07-01 00:00:00","2015-2016","1","1","1","NEERAJ","0","0","0","0","0","1","swaroop");
INSERT INTO admin_student VALUES("11","10","5","2014-07-01 00:00:00","2015-2016","1","1","1","NEERAJ","1","1","1","0","0","1","swaroop");



-- Table Structure for Table : admin_users

DROP TABLE IF EXISTS admin_users;

CREATE TABLE `admin_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `schl_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `login` datetime NOT NULL,
  `logout` datetime NOT NULL,
  `date` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO admin_users VALUES("1","Gautam","wixziAdmin","e6e061838856bf47e1de730719fb2609","-1","Administrator","1","2014-01-22 23:44:20","2014-05-31 17:27:21","0000-00-00","919387879787");
INSERT INTO admin_users VALUES("22","Swaroop","swaroop","e6e061838856bf47e1de730719fb2609","-1","Administrator","1","2014-07-06 17:35:20","2014-07-03 21:10:03","2014-01-21","");



