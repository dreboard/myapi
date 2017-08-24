<?php
/**
 * Config file
 *
 * @package     MyAPI\Support
 * @author      Andre Board
 * @since       v0.1.0
 *
 */
$path = '../vendor/autoload.php';
$settings_path = '../src/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path . PATH_SEPARATOR . $settings_path);
apache_setenv('APPLICATION_ENV','development');
ini_set('date.timezone', 'America/Chicago');

