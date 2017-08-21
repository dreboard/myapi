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

if($_SERVER['APPLICATION_ENV'] == 'production'){
	define('TRACKING_CODE', 'UA-104186490-1');  // Only production uses the -1 property
} else {
	define('TRACKING_CODE', 'UA-104186490-2');  // For all other environments
}
