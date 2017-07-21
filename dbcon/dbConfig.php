<?php
/**
 * Created by Wixzi Solutions.
 * User: Gautam
 * Date: 9/8/13
 * Time: 10:10 AM
 */
if (!defined("_VALID_PHP"))
    die('Direct access to this location is not allowed.');
//database server
define('DB_SERVER', "localhost");
//database name
define('DB_DATABASE', "administrator");
//database login name
define('DB_USER', "root");
//database login password
define('DB_PASS', "");

//Define your table names also
	define('TABLE_USER', "admin_users");
	define('TABLE_DEV_USER', "admin_dev_users");
	define('TABLE_SCHOOL', "admin_school");
	define('TABLE_DIVISION', "admin_division");
	define('TABLE_CLASS', "admin_class");
	define('TABLE_FEES', "admin_fees");
	define('TABLE_FEES_DEVELOPMENT', "admin_fees_development");
	define('TABLE_CLASS_MAPPING', "admin_class_mapping");
	define('TABLE_FEE_MAPPING', "admin_fee_mapping");
	define('TABLE_DEVELOPMENT_FEE_MAPPING', "admin_development_fee_mapping");
	define('TABLE_ADMISSION_FORM', "admin_admission_form");
	define('TABLE_APPLICATION_FEE', "admin_application_fee");
	define('TABLE_APPLICATION_RECEIPT', "application_fee_receipt");
	define('TABLE_NEW_APPLICATION', "admin_new_application_form");
	define('TABLE_DB_BACKUP', "admin_db_backup");
	define('TABLE_STUDENT', "admin_student");
	define('TABLE_STUDENT_FEE_PRIMARY', "admin_student_fee_primary");
	define('TABLE_STUDENT_FEE_SECONDARY', "admin_student_fee_secondary");
	define('TABLE_STUDENT_DEVELOPMENT_FEE', "admin_development_fee");
	define('TABLE_SCHOOL_CERTIFICATE', "admin_school_certificate");
	define('TABLE_SCHOOL_TC', "admin_school_tc");
	define('TABLE_STUDENT_DEVELOPMENT_FEE_PART', "admin_development_fee_part");
	define('TABLE_TC_OLD', "admin_student_old_data");


?>