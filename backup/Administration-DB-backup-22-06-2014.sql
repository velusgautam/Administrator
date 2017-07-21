DROP TABLE admin_application_form;

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

INSERT INTO admin_application_form VALUES("1","0","2121","0000-00-00","","Neeraj","Indian","Male","0000-00-00","Bangalore","Hindu","","Malayalam","No","bangalore","Sasi","Engineer","Software Engine","Sasssii","Engineer","Software Engine","21","21","10","English","12/12/2012","1000000","Bangalore, Kollam","919898998988","98989898989","889898","kansdkasnkd@akn");
INSERT INTO admin_application_form VALUES("2","0","2121","0000-00-00","","Neeraj","Indian","Male","0000-00-00","Bangalore","Hindu","","Malayalam","No","bangalore","Sasi","Engineer","Software Engine","Sasssii","Engineer","Software Engine","21","21","10","English","12/12/2012","1000000","Bangalore, Kollam","919898998988","98989898989","889898","kansdkasnkd@akn");
INSERT INTO admin_application_form VALUES("3","0","2121","0000-00-00","","Neeraj","Indian","Male","0000-00-00","Bangalore","Hindu","","Malayalam","No","bangalore","Sasi","Engineer","Software Engine","Sasssii","Engineer","Software Engine","21","21","10","English","12/12/2012","1000000","Bangalore, Kollam","919898998988","98989898989","889898","kansdkasnkd@akn");
INSERT INTO admin_application_form VALUES("4","0","2121","0000-00-00","","Neeraj","Indian","Male","0000-00-00","Bangalore","Hindu","","Malayalam","","bangalore","Sasi","Engineer","Software Engine","Sasssii","Engineer","Software Engine","21","21","10","English","12/12/2012","1000000","Bangalore, Kollam","919898998988","98989898989","889898","kansdkasnkd@aknkas.com");
INSERT INTO admin_application_form VALUES("5","0","","0000-00-00","","","","Male","0000-00-00","","","","","","","","","","","","","","","","","","","","91","","","");
INSERT INTO admin_application_form VALUES("6","0","","0000-00-00","","","","Male","0000-00-00","","","","","","","","","","","","","","","","","","","","91","","","");
INSERT INTO admin_application_form VALUES("7","0","","0000-00-00","","","","Male","0000-00-00","","","","","","","","","","","","","","","","","","","","91","","","");
INSERT INTO admin_application_form VALUES("8","0","","0000-00-00","2013-2014","B.Sc Hons (Fore","Indian","Male","0000-00-00","Bangalore","Hindh","","Bengalo","Saaass","Kollam","Saaass","Saaass","Saaass","Saaass","Saaass","Saaass","13","2","12","English","asdasd","1521515","asdasd, asdasd,asdasd","9154459","65959595","959599","");
INSERT INTO admin_application_form VALUES("9","5","2121","2014-06-11","2015-2016","Neeraj","Indian","Male","0000-00-00","Bangalore","","","Malayalam","No","bangalore","Sasi","Engineer","Software Engine","","Engineer","Software Engine","21","21","10","English","12/12/2012","1000000","Bangalore, Kollam","919898998988","98989898989","889898","kansdkasnkd@aknkas.com");
INSERT INTO admin_application_form VALUES("10","5","2121","2014-06-11","2015-2016","Neeraj","Indian","Male","0000-00-00","Bangalore","","","Malayalam","No","bangalore","Sasi","Engineer","Software Engine","","Engineer","Software Engine","21","21","10","English","12/12/2012","1000000","Bangalore, Kollam","919898998988","98989898989","889898","kansdkasnkd@aknkas.com");
INSERT INTO admin_application_form VALUES("11","5","2121","2014-06-11","2015-2016","Neeraj","Indian","Male","2014-06-18","Bangalore","","","Malayalam","No","bangalore","Sasi","Engineer","Software Engine","","Engineer","Software Engine","21","21","10","English","12/12/2012","1000000","Bangalore, Kollam","919898998988","98989898989","889898","kansdkasnkd@aknkas.com");



DROP TABLE admin_class;

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



DROP TABLE admin_class_mapping;

CREATE TABLE `admin_class_mapping` (
  `class_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(5) NOT NULL,
  `division_id` int(5) NOT NULL,
  `stream_id` int(5) NOT NULL COMMENT '1:ICSE 2:STATE',
  `schl_id` int(11) NOT NULL,
  PRIMARY KEY (`class_map_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

INSERT INTO admin_class_mapping VALUES("38","1","1","1","5");
INSERT INTO admin_class_mapping VALUES("39","1","4","1","5");
INSERT INTO admin_class_mapping VALUES("40","3","1","1","5");
INSERT INTO admin_class_mapping VALUES("41","3","1","2","5");
INSERT INTO admin_class_mapping VALUES("42","4","1","2","5");
INSERT INTO admin_class_mapping VALUES("43","1","1","1","6");
INSERT INTO admin_class_mapping VALUES("85","1","1","1","3");
INSERT INTO admin_class_mapping VALUES("86","1","1","2","3");
INSERT INTO admin_class_mapping VALUES("87","2","1","1","3");
INSERT INTO admin_class_mapping VALUES("88","3","2","2","3");
INSERT INTO admin_class_mapping VALUES("89","4","2","2","3");
INSERT INTO admin_class_mapping VALUES("90","5","2","1","3");
INSERT INTO admin_class_mapping VALUES("91","5","3","1","3");
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



DROP TABLE admin_division;

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



DROP TABLE admin_fee_mapping;

CREATE TABLE `admin_fee_mapping` (
  `fee_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(5) NOT NULL,
  `fee_id` int(4) NOT NULL,
  `fee_amount` varchar(5) NOT NULL,
  `schl_id` int(4) NOT NULL,
  PRIMARY KEY (`fee_map_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1 COMMENT='Table For Fee School Setting';

INSERT INTO admin_fee_mapping VALUES("66","1","1","150","3");
INSERT INTO admin_fee_mapping VALUES("67","1","2","200","3");
INSERT INTO admin_fee_mapping VALUES("68","2","1","350","5");
INSERT INTO admin_fee_mapping VALUES("69","2","2","450","5");



DROP TABLE admin_fees;

CREATE TABLE `admin_fees` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(150) NOT NULL,
  `fee_amount` decimal(10,0) NOT NULL,
  `status` int(3) NOT NULL,
  PRIMARY KEY (`fee_id`),
  UNIQUE KEY `fee_id` (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO admin_fees VALUES("1","COMPUTER FEE","500","0");
INSERT INTO admin_fees VALUES("2","OTHER FEES","0","0");



DROP TABLE admin_school;

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



DROP TABLE admin_users;

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
INSERT INTO admin_users VALUES("22","Swaroop","swaroop","e6e061838856bf47e1de730719fb2609","-1","Administrator","1","2014-06-22 22:11:52","2014-06-19 08:59:13","2014-01-21","");



