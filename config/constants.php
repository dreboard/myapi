<?php

/**
 * Constants file
 *
 * @package     MyAPI\Support
 * @author      Andre Board
 * @version     v0.1.0
 * @since       0.1.0
 *
 */


/*
 * APPLICATION ENVIRONMENT

 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */


if($_SERVER["REMOTE_ADDR"] == "127.0.0.1"){
	define('ENVIRONMENT', 'development');
}else{
	define('ENVIRONMENT', 'production');
}
