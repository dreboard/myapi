<?php
/**
 * DIC configuration
 */
$container = $app->getContainer();

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        return $container['response']->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    };
};


//Override the default Not Found Handler
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('Page not found');
    };
};



// PDO database library
$container['db'] = function ($c) {
	$settings = $c->get('settings')['db'];
	$pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'],
		$settings['user'], $settings['pass']);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	return $pdo;
};

/**
 * @param $container
 * @return \Illuminate\Database\Capsule\Manager

$container['illuminate'] = function ($container) {

    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['illuminate']);
    //$capsule->setEventDispatcher(new Illuminate\Contracts\Events\Dispatcher(new Container));
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
*/
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['illuminate']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use($capsule) {
    return $capsule;
};
