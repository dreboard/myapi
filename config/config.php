<?php
/**
 * Config file
 *
 * @package     MyAPI\Support
 * @author      Andre Board
 * @version     v0.1.0
 * @since       0.1.0
 *
 */

ini_set('date.timezone', 'America/Chicago');

if(ENVIRONMENT == "development"){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
	ini_set('log_errors', 'logs/production.log');
}





//trigger_error('Thrown error', E_USER_WARNING);