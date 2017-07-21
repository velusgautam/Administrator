

-- Database Export for GNR Administration---
-- Database Name : administrator



-- Table Structure for Table : admin_application_form

DROP TABLE IF EXISTS admin_application_form;

CREATE TABLE `admin_application_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_code` int(5) NOT NULL,
  `admin_no` varchar(15) NOT NULL,
  `admission_date` date NOT NULL,
  `academic_year` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nationality` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `placeofbirth` varchar(100) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `caste` varchar(35) NOT NULL,
  `mothertongue` varchar(40) NOT NULL,
  `whethersct` varchar(15) NOT NULL,
  `talukdist` varchar(35) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_qualification` varchar(50) NOT NULL,
  `father_occupation` varchar(50) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_qualification` varchar(50) NOT NULL,
  `mother_occupation` varchar(45) NOT NULL,
  `noofbro` varchar(15) NOT NULL,
  `noofsis` varchar(15) NOT NULL,
  `standard_leaving` varchar(15) NOT NULL,
  `prev_school` text NOT NULL,
  `tcdate` varchar(100) NOT NULL,
  `annual_income` varchar(15) NOT NULL,
  `permanent_address` text NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `resi_no` varchar(15) NOT NULL,
  `office_no` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1 COMMENT='Table For Fee School Setting';

INSERT INTO admin_fee_mapping VALUES("66","1","1","150","3");
INSERT INTO admin_fee_mapping VALUES("67","1","2","200","3");
INSERT INTO admin_fee_mapping VALUES("100","1","1","300","5");
INSERT INTO admin_fee_mapping VALUES("101","1","2","400","5");
INSERT INTO admin_fee_mapping VALUES("102","1","3","500","5");
INSERT INTO admin_fee_mapping VALUES("103","1","4","200","5");
INSERT INTO admin_fee_mapping VALUES("104","1","5","600","5");
INSERT INTO admin_fee_mapping VALUES("105","1","6","800","5");
INSERT INTO admin_fee_mapping VALUES("106","1","7","10","5");
INSERT INTO admin_fee_mapping VALUES("107","2","1","300","5");
INSERT INTO admin_fee_mapping VALUES("108","2","2","600","5");
INSERT INTO admin_fee_mapping VALUES("109","2","3","700","5");
INSERT INTO admin_fee_mapping VALUES("110","4","1","200","5");
INSERT INTO admin_fee_mapping VALUES("111","4","2","300","5");



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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO admin_student VALUES("10","10","5","2014-07-12 00:00:00","2015-2016","1","1","1","NEERAJ","1","1","1","0","0","1","swaroop");
INSERT INTO admin_student VALUES("11","10","5","2014-07-01 00:00:00","2015-2016","1","1","1","NEERAJ","1","1","1","1","1","1","swaroop");
INSERT INTO admin_student VALUES("12","11","5","2014-07-12 00:00:00","2014-2015","2","4","1","VELU","1","1","0","0","0","1","swaroop");



-- Table Structure for Table : admin_student_fee_primary

DROP TABLE IF EXISTS admin_student_fee_primary;

CREATE TABLE `admin_student_fee_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(250) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `months` text NOT NULL,
  `months_count` int(11) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `cheque_no` int(11) NOT NULL,
  `cheque_date` date NOT NULL,
  `cheque_bank` varchar(100) NOT NULL,
  `grand_total` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO admin_student_fee_primary VALUES("1","10","NEERAJ","2015-2016","2014-07-12","May,June,July","3","Cash","0","0000-00-00","","3610");
INSERT INTO admin_student_fee_primary VALUES("2","10","NEERAJ","2015-2016","2014-07-12","May,June,July,August,September","5","Cash","0","0000-00-00","","10010");
INSERT INTO admin_student_fee_primary VALUES("3","10","NEERAJ","2015-2016","2014-07-12","May,June","2","Cash","0","0000-00-00","","2400");
INSERT INTO admin_student_fee_primary VALUES("4","10","NEERAJ","2015-2016","2014-07-12","May,June,July","3","Cash","0","0000-00-00","","900");
INSERT INTO admin_student_fee_primary VALUES("5","11","NEERAJ","2015-2016","2014-07-12","May,June,August","3","Cash","0","0000-00-00","","2700");
INSERT INTO admin_student_fee_primary VALUES("6","12","VELU","2014-2015","2014-07-12","May,June","2","Cash","0","0000-00-00","","1000");
INSERT INTO admin_student_fee_primary VALUES("7","12","VELU","2014-2015","2014-07-12","May,June,July,August,September,October,November,December,January,February,March,April","12","Cash","0","0000-00-00","","6000");
INSERT INTO admin_student_fee_primary VALUES("9","10","NEERAJ","2015-2016","2014-07-12","July,August,September","3","Cash","0","0000-00-00","","2100");
INSERT INTO admin_student_fee_primary VALUES("10","12","VELU","2014-2015","2014-07-12","May,June,July","3","Cheque","121","2014-07-09","Axis","600");



-- Table Structure for Table : admin_student_fee_secondary

DROP TABLE IF EXISTS admin_student_fee_secondary;

CREATE TABLE `admin_student_fee_secondary` (
  `fee_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `primary_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `fee_name` varchar(250) NOT NULL,
  `base` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `waive_off` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`fee_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

INSERT INTO admin_student_fee_secondary VALUES("1","1","1","TUITION FEE","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("2","1","2","COMPUTER FEE","400","3","1200","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("3","1","3","EXAM FEE","500","3","1500","0","1500");
INSERT INTO admin_student_fee_secondary VALUES("4","1","7","FEE RECEIPT","10","3","30","20","10");
INSERT INTO admin_student_fee_secondary VALUES("5","2","1","TUITION FEE","300","5","1500","0","1500");
INSERT INTO admin_student_fee_secondary VALUES("6","2","2","COMPUTER FEE","400","5","2000","0","2000");
INSERT INTO admin_student_fee_secondary VALUES("7","2","3","EXAM FEE","500","5","2500","0","2500");
INSERT INTO admin_student_fee_secondary VALUES("8","2","4","SMART CLASS","200","5","1000","0","1000");
INSERT INTO admin_student_fee_secondary VALUES("9","2","5","HOBBY CLASS","600","5","3000","0","3000");
INSERT INTO admin_student_fee_secondary VALUES("10","2","7","FEE RECEIPT","10","5","50","40","10");
INSERT INTO admin_student_fee_secondary VALUES("11","3","1","TUITION FEE","300","2","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("12","3","2","COMPUTER FEE","400","2","800","0","800");
INSERT INTO admin_student_fee_secondary VALUES("13","3","3","EXAM FEE","500","2","1000","0","1000");
INSERT INTO admin_student_fee_secondary VALUES("14","4","1","TUITION FEE","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("15","5","1","TUITION FEE","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("16","5","2","COMPUTER FEE","400","3","1200","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("17","5","4","SMART CLASS","200","3","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("18","6","1","TUITION FEE","200","2","400","0","400");
INSERT INTO admin_student_fee_secondary VALUES("19","6","2","COMPUTER FEE","300","2","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("20","7","1","TUITION FEE","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("21","7","2","COMPUTER FEE","300","12","3600","0","3600");
INSERT INTO admin_student_fee_secondary VALUES("24","9","1","TUITION FEE","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("25","9","2","COMPUTER FEE","400","3","1200","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("26","10","1","TUITION FEE","200","3","600","0","600");



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

INSERT INTO admin_users VALUES("22","Swaroop","swaroop","e6e061838856bf47e1de730719fb2609","-1","Administrator","1","2014-07-12 16:10:51","2014-07-03 21:10:03","2014-01-21","");



-- Table Structure for Table : temp_table_print

DROP TABLE IF EXISTS temp_table_print;

CREATE TABLE `temp_table_print` (
  `id` int(11) NOT NULL,
  `receipt_no` int(11) NOT NULL,
  `date` date NOT NULL,
  `student_name` text NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `division_name` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `months` text NOT NULL,
  `tuition_fees` text NOT NULL,
  `tuitio_fees_amount` double NOT NULL,
  `other_fees` text NOT NULL,
  `other_fees_amount` int(11) NOT NULL,
  `waived_off_amount` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



