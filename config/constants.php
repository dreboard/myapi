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

if($_SERVER['APPLICATION_ENV'] == 'development'){
	define('TRACKING_CODE', 'UA-104186490-2');
} else {
	define('TRACKING_CODE', 'UA-104186490-1');
}
