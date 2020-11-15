<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*

|--------------------------------------------------------------------------

| File and Directory Modes

|--------------------------------------------------------------------------

|

| These prefs are used when checking and setting modes when working

| with the file system.  The defaults are fine on servers with proper

| security, but you may wish (or even need) to change the values in

| certain environments (Apache running a separate process for each

| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should

| always be used to set the mode correctly.

|

*/

define('FILE_READ_MODE', 0644);

define('FILE_WRITE_MODE', 0666);

define('DIR_READ_MODE', 0755);

define('DIR_WRITE_MODE', 0777);



/*

|--------------------------------------------------------------------------

| File Stream Modes

|--------------------------------------------------------------------------

|

| These modes are used when working with fopen()/popen()

|

*/

define('SITE_NAME','School Management');
define('SITE_KEY','6LdPs8QUAAAAAOuTnjR6a2yQ8mqhRr3pcEneCsS_');//
define('SECRET_KEY','6Lcl0sQUAAAAAKC1kglY881ylpWC557M5VtjUqZo');//localhost

define('SURL','http://'.$_SERVER['HTTP_HOST'].'/baby_thrive/');



define('IMG',SURL.'images');

define('CSS',SURL.'css/');

define('FONTS',SURL.'font-awesome/');

define('JS',SURL.'js/');

define('VENDOR',SURL.'assets/vendor/');

define('AJAX',SURL.'assets/ajax/');

define('USER_FOLDER',SURL.'assets/user_files/');

define('CUSTOMER_FOLDER',SURL.'../assets/customer_files');

define('ATTACHMENT',SURL.'../attachments/');

define('SLIDER_IMAGES',SURL.'../assets/slider.images/');

define('SIMPLE_SLIDER_IMAGES',SURL.'slider_images/');

define('SERVICE_IMAGES',SURL.'../assets/serviceimages/');

define('SIMPLE_TESTIMONIALS_IMAGES',SURL.'../assets/testimonials/');

define('TREE',SURL.'assets/');

define('FRONT',SURL.'assets_front/');


define('SCRAPBOOK_IMAGES',SURL.'assets/scrapbook/');
define('PROJECTS_IMAGES',SURL.'assets/projects/');
define('CATEGORIES_IMAGES',SURL.'assets/categories/');



define('FOPEN_READ',							'rb');

define('FOPEN_READ_WRITE',						'r+b');

define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care

define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care

define('FOPEN_WRITE_CREATE',					'ab');

define('FOPEN_READ_WRITE_CREATE',				'a+b');

define('FOPEN_WRITE_CREATE_STRICT',				'xb');

define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');





/* End of file constants.php */

/* Location: ./application/config/constants.php */