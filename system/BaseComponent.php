<?php

namespace System;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use App\Helpers\{
    DateHelper, ArrayHelper
};

/**
 * Class BaseComponent
 * @package System
 */
class BaseComponent
{

    use DateHelper, ArrayHelper;
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
     * BaseComponent constructor.
     *
     * @param $c  "instance of global container"
     */
    public function __construct($c = null)
    {
        $container = $c;
        $lang = require __DIR__ . '/../config/lang.php';
    }

    /**
     * BaseSComponent Static Logger.
     * @param string $msg
     */
    public static function logError(string $msg):void
    {
        $logger = new Logger('api_logger');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());
        $logger->error('Analytics Exception', array('exception' => $msg));
    }
}
