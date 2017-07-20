<?php
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
define('PLATFORM', 'development');

switch (PLATFORM) {
    case 'development':
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        ini_set('log_errors', 'logs/production.log');
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}