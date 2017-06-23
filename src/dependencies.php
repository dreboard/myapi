<?php
/**
 * DIC configuration
 */
$container = $app->getContainer();

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        return $container['response']->withStatus(500)
	        ->withJson(["server_error" => "500 Internal site error"]);
    };
};

//Override the default Not Allowed Handler
$container['notAllowedHandler'] = function ($container) {
	return function ($request, $response, $methods) use ($container) {
		return $container['response']
			->withStatus(405)
			->withHeader('Allow', implode(', ', $methods))
			->withHeader('Content-type', 'application/json')
			->withJson(["method_error" => "Method wrong for this request"]);
	};
};

//Override the default Not Found Handler
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->withJson(["client_error" => "404 Page not found"]);
    };
};



// PDO database DSN
$container['dsn'] = function ($container) {
	$settings = $container->get('settings')['db'];
	$pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['database'],
		$settings['username'], $settings['password']);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	return $pdo;
};


// Instantiate Eloquent ORM
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use($capsule) {
    return $capsule;
};
$container['BaseModel'] = function(){
	return new \System\BaseModel();
};