<?php
/*
|--------------------------------------------------------------------------
| Global Constants
|--------------------------------------------------------------------------
|
| These variables are required throughout the application 
| on various pages
|
*/

/* config variables. if they're not in the db then it uses the installation default values: */

$config['site_name']                = 'Just3Click';
$config['home_url']                 = 'http://www.just3click.com/';
$config['contact_email']            = 'admin@localhost';
$config['home']             		= 'admin';
											
$config['template_path']			 = 'template/default/';
$config['backend_path']	 			= 'template/backend/';
$config['helpfile_content_path']	 = 'contents/helpfiles/';
$config['filemanager']		 		= 'template/file_manager/';
$config['profile_picture_path']		 = 'contents/profile_images';
$config['javascript_path']		 	 = 'js/';
$config['third_party_path']		 	 = 'application/third_party/';
define('FILEMANAGER','template/file_manager/');
define('BASE_URL', '');
// User Work Status
define ('WORK_STATUS_NOT_AVAILABLE', 		0);
define ('WORK_STATUS_AVAILABLE', 			1);
define ('WORK_STATUS_BUSY', 			    2);
// Allowed file types to upload
$config['allowed_extensions']		 = array ( 'jpg', 'jpeg', 'gif', 'png', 'bmp', 'txt', 'doc', 'rtf', 'docx', 'pdf', 'avi', 
												   'mp3', 'flv', 'mp4', 'wmv', 'rar', 'zip' );
// Maximum upload file size (Default=10MB)
$config['max_file_size']             = 52428800;  

// Default Instructor Modules
$config['default_instructor_modules']  = '';  

@date_default_timezone_set('Asia/Calcutta');

/* DATABASE TABLE PREFIX */
define('TABLE_PREFIX', 'j3c_');
/* USERS ACCOUNT TYPES */
define('STATUS_DISABLED',  		0);

// FILE/FOLDER
define('TYPE_FILE',  			1);
define('TYPE_FOLDER',  			2);

/* Method of adding question */
define('MANUAL_METHOD', 1);
define('AUTO_METHOD', 2);

define("PKG",					1);
define("PRD",					2);

/* FLAGS TO DEFINE WHICH FUNCTION TYPE TO USE 
   FOR DIFFERENT INPUT FIELDS
*/
define('VALIDATE_REGULAR_STRING', 1);
define('VALIDATE_NAME_TITLE', 2);

define("HOURLY_PLAN",	1);
define("JOB_PLAN",		2);

/* YEAR RANGE TO BE SHOWN ON PAGES */
// Only 100 years to be displayed for selection
$currentYear = date('Y');
$yearFrom = $currentYear - 1;
$yearTo = $currentYear + 4;
define('YEAR_FROM', $yearFrom);
define('YEAR_TO', $yearTo);

// MODE FOR FROM WHERE THE RELEASE DATE FUNCTION IS CALLING
define('YEAR_MODE_DOB', 1);
define('YEAR_MODE_RELEASE', 2);

define('page_limit', '5');
define('per_page', '10');

define ('MAP_API', 				            '7t1tod3lgnq1xnzru2dvga7nutiddhjk');
define ('REST_API', 				        'ynu7mjdxl4ls9axnu8qapfkculnjj8nu');
//======= menu module ===============
$config['menu'] = array(
						"home" => array("Home", "main/", ""),
						/*"products" => array("Products", "main/products", ""),*/
						"enquiry" => array("Enquiries", "main/enquiryBox", ""),
						"privecy" => array("Privecy & Policy", "main/privecy_policy", ""),
						/*,"contact" => array("Contact Us", "main/contact", "")*/
					);
//====================================

// calendar 
$config['calendar']['month_array'] = array ('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June',
								'7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
$config['calendar']['day_type'] = 'long';

$config['calendar']['template'] = '
			{table_open}<table class="table table-bordered table-condensed fc" cellpadding="0" cellspacing="0">{/table_open}

			{heading_row_start}<tr>{/heading_row_start}

				{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
				{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
				{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

			{heading_row_end}</tr>{/heading_row_end}

			{week_row_start}<tr>{/week_row_start}
				{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}

			{cal_row_start}<tr>{/cal_row_start}
				{cal_cell_start}<td>{/cal_cell_start}

			{cal_cell_content}<a {content} >{day}</a>{/cal_cell_content}
			{cal_cell_content_today}<div class="today"><span class="day_listing"><a href="{content}">{day}</a></span></div>{/cal_cell_content_today}
			
			{cal_cell_no_content}<span class="day_listing">{day}</span>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}

			{cal_cell_blank}&nbsp;{/cal_cell_blank}

			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end} 

			{table_close}</table>{/table_close}
';
