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

//Override the default php error Handler
$container['phpErrorHandler'] = function ($c) {
	return function ($request, $response, $error) use ($c) {
		// log error here
		return $c['response']->withStatus(500)
			->withHeader('Content-type', 'application/json')
			->withJson(["php_error" => "A php error has occured"]);
	};
};

unset($app->getContainer()['phpErrorHandler']);

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



// PDO database DSN for BaseModel::class
$container['db'] = function ($container) {
	try{
		$settings = $container->get('settings')['db'];
		$pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['database'],
			$settings['username'], $settings['password']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
	} catch (PDOException $e){

	}

};


// Instantiate Eloquent ORM
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['orm'] = function ($container) use($capsule) {
    return $capsule;
};


$container['BaseModel'] = function() use ($container){
	return new \System\BaseModel($container->get('dsn'));
};


$container['BaseController'] = function(){
	return new \System\BaseController();
};