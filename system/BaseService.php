<?php
namespace System;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

/**
 * Class BaseService
 * @package System
 */
class BaseService {

    /**
     * @var $container
     */
    protected $container;

    /**
     * @var array
     */
    protected $lang;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * BaseService constructor.
     *
     * @param $c
     */
    public function __construct($c = null)
    {
        $this->logger = new Logger('api_logger');
        $this->logger->pushHandler(new StreamHandler(
            __DIR__.'/../logs/app.log', Logger::DEBUG));
        $this->logger->pushHandler(new FirePHPHandler());
        $this->container = $c;
        $this->lang = require __DIR__ . '/../config/lang.php';
    }


}