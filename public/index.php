<?php
/**
 * Entry point for API.
 *
 * @package    myapi
 * @version    v0.1.0
 *
 */
$allowed_hosts = array('localhost', 'mod-dev', 'mod-beta', 'mod-qa', 'mod-alpha', 'mod-test', 'incentisoft.com', 'bravolaptop97', 'hq-mod-01', 'azurewebsites.net');
if( str_ireplace($allowed_hosts, '', $_SERVER['HTTP_HOST']) == $_SERVER['HTTP_HOST'])
{
    die('Invalid Host');
}
unset($allowed_hosts);

if (stristr($_SERVER['HTTP_HOST'], "incentisoft.com") !== FALSE) {  //production url
    /*
     *---------------------------------------------------------------
     * APPLICATION ENVIRONMENT
     *---------------------------------------------------------------
     *
     * You can load different configurations depending on your
     * current environment. Setting the environment also influences
     * things like logging and error reporting.
     *
     * This can be set to anything, but default usage is:
     *
     *     development
     *     testing
     *     production
     *
     * NOTE: If you change these, also change the error_reporting() code below
     *
     */
    define('ENVIRONMENT', 'production');
} else if (in_array($_SERVER['HTTP_HOST'], array("mod-beta", "mod-qa", "mod-dev", 'azurewebsites.net'))) { //beta url
    /*
     *---------------------------------------------------------------
     * APPLICATION ENVIRONMENT
     *---------------------------------------------------------------
     *
     * You can load different configurations depending on your
     * current environment. Setting the environment also influences
     * things like logging and error reporting.
     *
     * This can be set to anything, but default usage is:
     *
     *     development
     *     testing
     *     production
     *
     * NOTE: If you change these, also change the error_reporting() code below
     *
     */
    define('ENVIRONMENT', 'testing');
} else if (in_array($_SERVER['HTTP_HOST'], array("mod-internal", "hq-mod-01"))) {
    define('ENVIRONMENT', 'internal');
} else {
    /*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
    define('ENVIRONMENT', 'development');
}

$settings = require __DIR__ . '/../src/composer.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Controllers;
use \Illuminate\Database\Capsule\Manager as Capsule;

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$lang  = require __DIR__ . '/../config/lang.php';
$app = new \Slim\App($settings);

require __DIR__ . '/../src/dependencies.php';// Set up dependencies

require __DIR__ . '/../src/middleware.php';// Register middleware

require __DIR__ . '/../src/routes.php';// Register routes

$app->getContainer()->get("db");
$app->run();