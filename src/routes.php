<?php
/**
 * Master routes file
 */

/**
 * Version 1.0 routes file
 */
$app->get( '/get_version', '\App\Controllers\HomeController:get_version' );

/**
 * Version 1.0 routes uri list
 */
require 'routes/v1.php';

/**
 * Version 2.0 routes uri list
 */
require 'routes/v2.php';

