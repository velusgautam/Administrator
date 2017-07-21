

-- Database Export for GNR Administration---
-- Database Name : administrator



-- Table Structure for Table : admin_application_fee

DROP TABLE IF EXISTS admin_application_fee;

CREATE TABLE `admin_application_fee` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(200) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `school_id` int(10) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  PRIMARY KEY (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO admin_application_fee VALUES("3","Application Fees","250","1","2014-2015");
INSERT INTO admin_application_fee VALUES("5","Application Fees","1000","3","2014-2015");
INSERT INTO admin_application_fee VALUES("6","Application","300","5","2014-2015");



-- Table Structure for Table : admin_application_form

DROP TABLE IF EXISTS admin_application_form;

CREATE TABLE `admin_application_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_no` int(11) NOT NULL,
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
  `father_phone` varchar(200) NOT NULL,
  `father_email` varchar(200) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_qualification` varchar(50) NOT NULL,
  `mother_occupation` varchar(45) NOT NULL,
  `mother_phone` varchar(200) NOT NULL,
  `mother_email` varchar(200) NOT NULL,
  `noofbro` varchar(15) NOT NULL,
  `noofsis` varchar(15) NOT NULL,
  `standard_leaving` varchar(15) NOT NULL,
  `prev_school` text NOT NULL,
  `tcdate` varchar(100) NOT NULL,
  `annual_income` varchar(15) NOT NULL,
  `permanent_address` text NOT NULL,
  `resi_no` varchar(15) NOT NULL,
  `office_no` varchar(15) NOT NULL,
  `transfer_tc` int(11) NOT NULL,
  `transfer_mc` int(11) NOT NULL,
  `transfer_cc` int(11) NOT NULL,
  `fresh_bc` int(11) NOT NULL,
  `fresh_cc` int(11) NOT NULL,
  `reg_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO admin_application_form VALUES("18","24","3","","2014-08-06","2014-2015","TEST STUDENT1","","","0000-00-00","","","","","","","","","","","","","","","","","","","","","","","","","","1","0","0","0","0","0");
INSERT INTO admin_application_form VALUES("19","25","5","","2014-08-12","2014-2015","TEST STUDENT3","","","0000-00-00","","","","","","","","","","","","","","","","","","","","","","","","","","0","0","0","0","0","0");



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
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

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
INSERT INTO admin_class_mapping VALUES("142","3","1","1","1");
INSERT INTO admin_class_mapping VALUES("143","4","1","1","1");
INSERT INTO admin_class_mapping VALUES("144","4","2","1","1");
INSERT INTO admin_class_mapping VALUES("145","4","1","2","1");
INSERT INTO admin_class_mapping VALUES("146","4","2","2","1");
INSERT INTO admin_class_mapping VALUES("147","5","1","1","1");
INSERT INTO admin_class_mapping VALUES("148","5","2","1","1");
INSERT INTO admin_class_mapping VALUES("149","5","1","2","1");
INSERT INTO admin_class_mapping VALUES("150","5","2","2","1");



-- Table Structure for Table : admin_db_backup

DROP TABLE IF EXISTS admin_db_backup;

CREATE TABLE `admin_db_backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_name` varchar(250) NOT NULL,
  `backup_time` datetime NOT NULL,
  PRIMARY KEY (`backup_id`),
  UNIQUE KEY `backup_name` (`backup_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO admin_db_backup VALUES("19","db-backup--02-08-2014.sql","2014-08-02 00:00:00");
INSERT INTO admin_db_backup VALUES("20","db-backup--04-08-2014.sql","2014-08-04 00:00:00");
INSERT INTO admin_db_backup VALUES("21","db-backup--06-08-2014.sql","2014-08-06 00:00:00");



-- Table Structure for Table : admin_development_fee

DROP TABLE IF EXISTS admin_development_fee;

CREATE TABLE `admin_development_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `academic_year` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `cheque_no` varchar(30) NOT NULL,
  `cheque_date` date NOT NULL,
  `cheque_bank` varchar(100) NOT NULL,
  `development_fees` int(11) NOT NULL,
  `waive_off` int(10) NOT NULL,
  `add_on` int(10) NOT NULL,
  `total` int(12) NOT NULL,
  `payment_status` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO admin_development_fee VALUES("4","12","VELU","2014-2015","2014-07-17","Cheque","5145415","2014-07-17","SBI","55000","300","3000","57700","0");
INSERT INTO admin_development_fee VALUES("5","10","NEERAJ","2015-2016","2014-07-23","Cash","","0000-00-00","","35000","350","0","34650","0");
INSERT INTO admin_development_fee VALUES("6","16","TEST STUDENT3","2014-2015","2014-08-12","Cash","","0000-00-00","","45000","0","0","45000","0");
INSERT INTO admin_development_fee VALUES("7","15","TEST STUDENT1","2014-2015","2014-08-12","Cash","","0000-00-00","","25000","0","5000","15000","1");



-- Table Structure for Table : admin_development_fee_mapping

DROP TABLE IF EXISTS admin_development_fee_mapping;

CREATE TABLE `admin_development_fee_mapping` (
  `fee_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(5) NOT NULL,
  `fee_id` int(4) NOT NULL,
  `fee_amount` varchar(5) NOT NULL,
  `schl_id` int(4) NOT NULL,
  PRIMARY KEY (`fee_map_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Table For Development Fee School Setting';

INSERT INTO admin_development_fee_mapping VALUES("1","1","1","25000","3");
INSERT INTO admin_development_fee_mapping VALUES("2","1","1","35000","5");
INSERT INTO admin_development_fee_mapping VALUES("3","3","1","45000","5");
INSERT INTO admin_development_fee_mapping VALUES("4","4","1","55000","5");



-- Table Structure for Table : admin_development_fee_part

DROP TABLE IF EXISTS admin_development_fee_part;

CREATE TABLE `admin_development_fee_part` (
  `part_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `payment_now` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `development_fee` int(11) NOT NULL,
  `development_fee_id` int(11) NOT NULL,
  `academic_year` varchar(200) NOT NULL,
  PRIMARY KEY (`part_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1 COMMENT='Table For Fee School Setting';

INSERT INTO admin_fee_mapping VALUES("112","1","1","150","3");
INSERT INTO admin_fee_mapping VALUES("113","1","2","200","3");
INSERT INTO admin_fee_mapping VALUES("114","1","3","444","3");
INSERT INTO admin_fee_mapping VALUES("115","1","4","300","3");
INSERT INTO admin_fee_mapping VALUES("116","1","5","200","3");
INSERT INTO admin_fee_mapping VALUES("117","1","6","2500","3");
INSERT INTO admin_fee_mapping VALUES("118","1","7","25","3");
INSERT INTO admin_fee_mapping VALUES("119","1","1","300","5");
INSERT INTO admin_fee_mapping VALUES("120","1","2","400","5");
INSERT INTO admin_fee_mapping VALUES("121","1","3","500","5");
INSERT INTO admin_fee_mapping VALUES("122","1","4","200","5");
INSERT INTO admin_fee_mapping VALUES("123","1","5","600","5");
INSERT INTO admin_fee_mapping VALUES("124","1","6","800","5");
INSERT INTO admin_fee_mapping VALUES("125","1","7","10","5");
INSERT INTO admin_fee_mapping VALUES("126","3","1","200","5");
INSERT INTO admin_fee_mapping VALUES("127","3","2","200","5");
INSERT INTO admin_fee_mapping VALUES("128","3","3","200","5");
INSERT INTO admin_fee_mapping VALUES("129","3","4","200","5");
INSERT INTO admin_fee_mapping VALUES("130","3","5","200","5");
INSERT INTO admin_fee_mapping VALUES("131","3","6","200","5");
INSERT INTO admin_fee_mapping VALUES("132","3","7","200","5");
INSERT INTO admin_fee_mapping VALUES("133","4","1","200","5");
INSERT INTO admin_fee_mapping VALUES("134","4","2","300","5");
INSERT INTO admin_fee_mapping VALUES("135","4","3","200","5");
INSERT INTO admin_fee_mapping VALUES("136","4","4","200","5");
INSERT INTO admin_fee_mapping VALUES("137","4","5","200","5");
INSERT INTO admin_fee_mapping VALUES("138","4","6","200","5");
INSERT INTO admin_fee_mapping VALUES("139","4","7","200","5");



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



-- Table Structure for Table : admin_fees_development

DROP TABLE IF EXISTS admin_fees_development;

CREATE TABLE `admin_fees_development` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(150) NOT NULL,
  `status` int(3) NOT NULL,
  PRIMARY KEY (`fee_id`),
  UNIQUE KEY `fee_id` (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO admin_fees_development VALUES("1","DEVELOPMENT FEES","0");



-- Table Structure for Table : admin_new_application_form

DROP TABLE IF EXISTS admin_new_application_form;

CREATE TABLE `admin_new_application_form` (
  `application_no` int(11) NOT NULL AUTO_INCREMENT,
  `school_code` int(5) NOT NULL,
  `application_date` date NOT NULL,
  `academic_year` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_name` varchar(250) NOT NULL,
  `contact_number` varchar(25) NOT NULL,
  `class_applied` varchar(100) NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`application_no`),
  UNIQUE KEY `application_no` (`application_no`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO admin_new_application_form VALUES("24","3","2014-08-06","2014-2015","Test Student1","Test Student1","9124234243242","PRE KG","1");
INSERT INTO admin_new_application_form VALUES("25","5","2014-08-12","2014-2015","Test Student3","Test Father3","919090909090","KG","1");
INSERT INTO admin_new_application_form VALUES("26","5","2014-08-12","2014-2015","Test Student4","Test Father4","919090909090","PRE KG","0");
INSERT INTO admin_new_application_form VALUES("27","5","2014-08-12","2014-2015","Test Student5","Test Father5","919090909090","PRE KG","0");



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



-- Table Structure for Table : admin_school_certificate

DROP TABLE IF EXISTS admin_school_certificate;

CREATE TABLE `admin_school_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(150) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `f_year` varchar(25) NOT NULL,
  `t_year` varchar(25) NOT NULL,
  `s_from` varchar(25) NOT NULL,
  `s_to` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `conduct` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO admin_school_certificate VALUES("20","0000-00-00","13","VASU S GAUTAM","Subramanian","2014","2014","CLASS II","CLASS II","2000-10-09","Good");
INSERT INTO admin_school_certificate VALUES("21","0000-00-00","13","VASU S GAUTAM","Subramanian","2014","2014","CLASS II","CLASS II","2000-10-09","Good");
INSERT INTO admin_school_certificate VALUES("22","2014-07-31","13","VASU S GAUTAM","Subramanian","2014","2014","CLASS II","CLASS II","2000-10-09","Good");
INSERT INTO admin_school_certificate VALUES("23","2014-07-31","10","AMAL","Sasi","2014","2014","PRE KG","PRE KG","1970-01-01","Good");
INSERT INTO admin_school_certificate VALUES("24","2014-07-31","10","AMAL","Sasi","2014","2014","PRE KG","PRE KG","1970-01-01","Excellent");
INSERT INTO admin_school_certificate VALUES("25","2014-08-12","16","TEST STUDENT3","Test","2014","2014","UKG","UKG","2000-08-16","Good");



-- Table Structure for Table : admin_student

DROP TABLE IF EXISTS admin_student;

CREATE TABLE `admin_student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_no` int(11) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `schl_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `stream_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `student_name` varchar(300) NOT NULL,
  `status` int(11) NOT NULL,
  `registered_by` varchar(200) NOT NULL,
  `registered_date` date NOT NULL,
  `registered_class` varchar(10) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO admin_student VALUES("15","24","18","3","2014-08-06","2014-2015","2","1","2","TEST STUDENT1","1","swaroop","2014-08-06","1");
INSERT INTO admin_student VALUES("16","25","19","5","2014-08-12","2014-2015","1","3","1","TEST STUDENT3","1","swaroop","2014-08-12","3");



-- Table Structure for Table : admin_student_fee_primary

DROP TABLE IF EXISTS admin_student_fee_primary;

CREATE TABLE `admin_student_fee_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(250) NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `cheque_no` varchar(30) NOT NULL,
  `cheque_date` date NOT NULL,
  `cheque_bank` varchar(100) NOT NULL,
  `grand_total` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `STUDENT ID` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO admin_student_fee_primary VALUES("1","10","NEERAJ","2015-2016","2014-07-12","Cash","0","0000-00-00","","3610");
INSERT INTO admin_student_fee_primary VALUES("2","10","NEERAJ","2015-2016","2014-07-12","Cash","0","0000-00-00","","10010");
INSERT INTO admin_student_fee_primary VALUES("3","10","NEERAJ","2015-2016","2014-07-12","Cash","0","0000-00-00","","2400");
INSERT INTO admin_student_fee_primary VALUES("4","10","NEERAJ","2015-2016","2014-07-12","Cash","0","0000-00-00","","900");
INSERT INTO admin_student_fee_primary VALUES("5","11","NEERAJ","2015-2016","2014-07-12","Cash","0","0000-00-00","","2700");
INSERT INTO admin_student_fee_primary VALUES("6","12","VELU","2014-2015","2014-07-12","Cash","0","0000-00-00","","1000");
INSERT INTO admin_student_fee_primary VALUES("7","12","VELU","2014-2015","2014-07-12","Cash","0","0000-00-00","","6000");
INSERT INTO admin_student_fee_primary VALUES("9","10","NEERAJ","2015-2016","2014-07-12","Cash","0","0000-00-00","","2100");
INSERT INTO admin_student_fee_primary VALUES("10","12","VELU","2014-2015","2014-07-12","Cheque","121","2014-07-09","Axis","600");
INSERT INTO admin_student_fee_primary VALUES("11","10","NEERAJ","2015-2016","2014-07-23","Cash","","0000-00-00","","11210");
INSERT INTO admin_student_fee_primary VALUES("12","10","AMAL","2015-2016","2014-08-02","Cheque","5145415","2014-08-13","SBI","6010");
INSERT INTO admin_student_fee_primary VALUES("13","15","TEST STUDENT1","2014-2015","2014-08-06","Cash","","0000-00-00","","1050");
INSERT INTO admin_student_fee_primary VALUES("14","15","TEST STUDENT1","2014-2015","2014-08-10","Cash","","0000-00-00","","10113");
INSERT INTO admin_student_fee_primary VALUES("15","15","TEST STUDENT1","2014-2015","2014-08-10","Cash","","0000-00-00","","10113");
INSERT INTO admin_student_fee_primary VALUES("16","15","TEST STUDENT1","2014-2015","2014-08-10","Cash","","0000-00-00","","10113");
INSERT INTO admin_student_fee_primary VALUES("17","15","TEST STUDENT1","2014-2015","2014-08-10","Cash","","0000-00-00","","10113");
INSERT INTO admin_student_fee_primary VALUES("18","15","TEST STUDENT1","2014-2015","2014-08-10","Cash","","0000-00-00","","10113");
INSERT INTO admin_student_fee_primary VALUES("19","15","TEST STUDENT1","2014-2015","2014-08-10","Cheque","121za","2014-07-02","Axis","12957");
INSERT INTO admin_student_fee_primary VALUES("20","15","TEST STUDENT1","2014-2015","2014-08-10","Cheque","121za","2014-07-02","Axis","12957");
INSERT INTO admin_student_fee_primary VALUES("21","15","TEST STUDENT1","2014-2015","2014-08-10","Cash","","0000-00-00","","18553");
INSERT INTO admin_student_fee_primary VALUES("22","15","TEST STUDENT1","2014-2015","2014-08-10","Cash","","0000-00-00","","18553");
INSERT INTO admin_student_fee_primary VALUES("23","16","TEST STUDENT3","2014-2015","2014-08-12","Cash","","0000-00-00","","13800");
INSERT INTO admin_student_fee_primary VALUES("24","16","TEST STUDENT3","2014-2015","2014-08-12","Cash","","0000-00-00","","2600");



-- Table Structure for Table : admin_student_fee_secondary

DROP TABLE IF EXISTS admin_student_fee_secondary;

CREATE TABLE `admin_student_fee_secondary` (
  `fee_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `primary_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `fee_name` varchar(250) NOT NULL,
  `months` text NOT NULL,
  `base` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `waive_off` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`fee_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

INSERT INTO admin_student_fee_secondary VALUES("1","1","1","TUITION FEE","","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("2","1","2","COMPUTER FEE","","400","3","1200","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("3","1","3","EXAM FEE","","500","3","1500","0","1500");
INSERT INTO admin_student_fee_secondary VALUES("4","1","7","FEE RECEIPT","","10","3","30","20","10");
INSERT INTO admin_student_fee_secondary VALUES("5","2","1","TUITION FEE","","300","5","1500","0","1500");
INSERT INTO admin_student_fee_secondary VALUES("6","2","2","COMPUTER FEE","","400","5","2000","0","2000");
INSERT INTO admin_student_fee_secondary VALUES("7","2","3","EXAM FEE","","500","5","2500","0","2500");
INSERT INTO admin_student_fee_secondary VALUES("8","2","4","SMART CLASS","","200","5","1000","0","1000");
INSERT INTO admin_student_fee_secondary VALUES("9","2","5","HOBBY CLASS","","600","5","3000","0","3000");
INSERT INTO admin_student_fee_secondary VALUES("10","2","7","FEE RECEIPT","","10","5","50","40","10");
INSERT INTO admin_student_fee_secondary VALUES("11","3","1","TUITION FEE","","300","2","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("12","3","2","COMPUTER FEE","","400","2","800","0","800");
INSERT INTO admin_student_fee_secondary VALUES("13","3","3","EXAM FEE","","500","2","1000","0","1000");
INSERT INTO admin_student_fee_secondary VALUES("14","4","1","TUITION FEE","","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("15","5","1","TUITION FEE","","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("16","5","2","COMPUTER FEE","","400","3","1200","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("17","5","4","SMART CLASS","","200","3","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("18","6","1","TUITION FEE","","200","2","400","0","400");
INSERT INTO admin_student_fee_secondary VALUES("19","6","2","COMPUTER FEE","","300","2","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("20","7","1","TUITION FEE","","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("21","7","2","COMPUTER FEE","","300","12","3600","0","3600");
INSERT INTO admin_student_fee_secondary VALUES("24","9","1","TUITION FEE","","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("25","9","2","COMPUTER FEE","","400","3","1200","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("26","10","1","TUITION FEE","","200","3","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("27","11","1","TUITION FEE","","300","4","1200","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("28","11","2","COMPUTER FEE","","400","4","1600","0","1600");
INSERT INTO admin_student_fee_secondary VALUES("29","11","3","EXAM FEE","","500","4","2000","0","2000");
INSERT INTO admin_student_fee_secondary VALUES("30","11","4","SMART CLASS","","200","4","800","0","800");
INSERT INTO admin_student_fee_secondary VALUES("31","11","5","HOBBY CLASS","","600","4","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("32","11","6","ALUMNI FEES","","800","4","3200","0","3200");
INSERT INTO admin_student_fee_secondary VALUES("33","11","7","FEE RECEIPT","","10","4","40","30","10");
INSERT INTO admin_student_fee_secondary VALUES("34","12","1","TUITION FEE","","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("35","12","2","COMPUTER FEE","","400","3","1200","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("36","12","3","EXAM FEE","","500","3","1500","0","1500");
INSERT INTO admin_student_fee_secondary VALUES("37","12","4","SMART CLASS","","200","3","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("38","12","5","HOBBY CLASS","","600","3","1800","0","1800");
INSERT INTO admin_student_fee_secondary VALUES("39","12","7","FEE RECEIPT","","10","3","10","0","10");
INSERT INTO admin_student_fee_secondary VALUES("40","13","1","TUITION FEE","","150","3","450","0","450");
INSERT INTO admin_student_fee_secondary VALUES("41","13","2","COMPUTER FEE","","200","3","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("42","18","1","TUITION FEE","May,June,July,August,September,October,November,December,January,February,March,April","150","12","150","0","1800");
INSERT INTO admin_student_fee_secondary VALUES("43","18","2","COMPUTER FEE","June,July,August","200","3","200","0","600");
INSERT INTO admin_student_fee_secondary VALUES("44","18","3","EXAM FEE","August,September","444","2","444","0","888");
INSERT INTO admin_student_fee_secondary VALUES("45","18","4","SMART CLASS","June,July,September,October","300","4","300","0","1200");
INSERT INTO admin_student_fee_secondary VALUES("46","18","5","HOBBY CLASS","July,August,September","200","3","200","0","600");
INSERT INTO admin_student_fee_secondary VALUES("47","18","6","ALUMNI FEES","June,July","2500","2","2500","0","5000");
INSERT INTO admin_student_fee_secondary VALUES("48","18","7","FEE RECEIPT"," ","0","1","0","0","25");
INSERT INTO admin_student_fee_secondary VALUES("49","19","1","TUITION FEE","May,June,July,August,September,October,November,December,January,February,March,April","150","12","150","0","1800");
INSERT INTO admin_student_fee_secondary VALUES("50","19","2","COMPUTER FEE","June,August,September","200","3","200","0","600");
INSERT INTO admin_student_fee_secondary VALUES("51","19","3","EXAM FEE","June,August,September","444","3","444","0","1332");
INSERT INTO admin_student_fee_secondary VALUES("52","19","4","SMART CLASS","June,August,September","300","3","300","0","900");
INSERT INTO admin_student_fee_secondary VALUES("53","19","5","HOBBY CLASS","June,July,August,October","200","4","200","0","800");
INSERT INTO admin_student_fee_secondary VALUES("54","19","6","ALUMNI FEES","June,July,September","2500","3","2500","0","7500");
INSERT INTO admin_student_fee_secondary VALUES("55","19","7","FEE RECEIPT"," ","0","1","0","0","25");
INSERT INTO admin_student_fee_secondary VALUES("56","20","1","TUITION FEE","May,June,July,August,September,October,November,December,January,February,March,April","150","12","150","0","1800");
INSERT INTO admin_student_fee_secondary VALUES("57","20","2","COMPUTER FEE","June,August,September","200","3","200","0","600");
INSERT INTO admin_student_fee_secondary VALUES("58","20","3","EXAM FEE","June,August,September","444","3","444","0","1332");
INSERT INTO admin_student_fee_secondary VALUES("59","20","4","SMART CLASS","June,August,September","300","3","300","0","900");
INSERT INTO admin_student_fee_secondary VALUES("60","20","5","HOBBY CLASS","June,July,August,October","200","4","200","0","800");
INSERT INTO admin_student_fee_secondary VALUES("61","20","6","ALUMNI FEES","June,July,September","2500","3","2500","0","7500");
INSERT INTO admin_student_fee_secondary VALUES("62","20","7","FEE RECEIPT"," ","0","1","0","0","25");
INSERT INTO admin_student_fee_secondary VALUES("63","21","1","TUITION FEE","May,June,July,August,September,October,November,December,January,February,March,April","150","12","1800","0","1800");
INSERT INTO admin_student_fee_secondary VALUES("64","21","2","COMPUTER FEE","May,June,July,August,September,October,November,December,January,February,March,April","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("65","21","3","EXAM FEE","May,June,July,August,September,October,November,December,January,February,March,April","444","12","5328","0","5328");
INSERT INTO admin_student_fee_secondary VALUES("66","21","4","SMART CLASS","June,August,September","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("67","21","5","HOBBY CLASS","May,June,July","200","3","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("68","21","6","ALUMNI FEES","June,July,August","2500","3","7500","0","7500");
INSERT INTO admin_student_fee_secondary VALUES("69","21","7","FEE RECEIPT"," ","25","1","25","0","25");
INSERT INTO admin_student_fee_secondary VALUES("70","22","1","TUITION FEE","May,June,July,August,September,October,November,December,January,February,March,April","150","12","1800","0","1800");
INSERT INTO admin_student_fee_secondary VALUES("71","22","2","COMPUTER FEE","May,June,July,August,September,October,November,December,January,February,March,April","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("72","22","3","EXAM FEE","May,June,July,August,September,October,November,December,January,February,March,April","444","12","5328","0","5328");
INSERT INTO admin_student_fee_secondary VALUES("73","22","4","SMART CLASS","June,August,September","300","3","900","0","900");
INSERT INTO admin_student_fee_secondary VALUES("74","22","5","HOBBY CLASS","May,June,July","200","3","600","0","600");
INSERT INTO admin_student_fee_secondary VALUES("75","22","6","ALUMNI FEES","June,July,August","2500","3","7500","0","7500");
INSERT INTO admin_student_fee_secondary VALUES("76","22","7","FEE RECEIPT"," ","25","1","25","0","25");
INSERT INTO admin_student_fee_secondary VALUES("77","23","1","TUITION FEE","May,June,July,August,September,October,November,December,January,February,March,April","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("78","23","2","COMPUTER FEE","May,August,September,October,November,December,January,February,March,April","200","10","2000","0","2000");
INSERT INTO admin_student_fee_secondary VALUES("79","23","3","EXAM FEE","May,June,July,August,September,October,November,December,January,February,March,April","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("80","23","4","SMART CLASS","May,June,July,October,November,December,January,February,March,April","200","10","2000","0","2000");
INSERT INTO admin_student_fee_secondary VALUES("81","23","5","HOBBY CLASS","May,June,July,August,September,October,November,December,January,February,March,April","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("82","23","6","ALUMNI FEES","May,June,July,August,September,October,November,December,January,February,March,April","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("83","23","7","FEE RECEIPT"," ","200","1","200","0","200");
INSERT INTO admin_student_fee_secondary VALUES("84","24","1","TUITION FEE","May,June,July,August,September,October,November,December,January,February,March,April","200","12","2400","0","2400");
INSERT INTO admin_student_fee_secondary VALUES("85","24","7","FEE RECEIPT"," ","200","1","200","0","200");



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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO admin_users VALUES("22","Swaroop","swaroop","e6e061838856bf47e1de730719fb2609","-1","Administrator","1","2014-08-12 07:22:32","2014-08-12 07:21:03","2014-01-21","");
INSERT INTO admin_users VALUES("23","Velu","user","e6e061838856bf47e1de730719fb2609","4","Administrator","2","2014-07-17 18:22:00","2014-07-17 18:26:54","2014-01-21","");
INSERT INTO admin_users VALUES("24","test","test","098f6bcd4621d373cade4e832627b4f6","5","Staff","2","2014-08-06 19:35:46","2014-08-06 19:43:04","0000-00-00","23123132");



-- Table Structure for Table : application_fee_receipt

DROP TABLE IF EXISTS application_fee_receipt;

CREATE TABLE `application_fee_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_no` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `school_code` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `entered_by` varchar(250) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO application_fee_receipt VALUES("1","20","250","1","Velu S Gautam","Swaroop","2");
INSERT INTO application_fee_receipt VALUES("2","20","250","1","Velu S Gautam","Swaroop","2");
INSERT INTO application_fee_receipt VALUES("3","20","250","1","Velu S Gautam","Swaroop","2");
INSERT INTO application_fee_receipt VALUES("4","21","150","5","Vasu S Gautam","test","1");
INSERT INTO application_fee_receipt VALUES("5","23","1000","3","Test Studen2","Swaroop","6");
INSERT INTO application_fee_receipt VALUES("6","24","1000","3","Test Student1","Swaroop","2");



